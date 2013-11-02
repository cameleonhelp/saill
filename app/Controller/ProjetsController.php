<?php
App::uses('AppController', 'Controller');
/**
 * Projets Controller
 *
 * @property Projet $Projet
 */
class ProjetsController extends AppController {
        public $components = array('History','Common');
        public $paginate = array(
        'limit' => 25,
        'order' => array('Projet.NOM' => 'asc'),
        'conditions' => array('Projet.id >' => 1),
        //'group'=>array('Projet.contrat_id'),
        );
/**
 * index method
 *
 * @return void
 */
	public function index($filtreEtat=null,$filtreContrat=null) {
            //$this->Session->delete('history');
            if (isAuthorized('projets', 'index')) :
                switch ($filtreContrat){
                    case 'tous':
                    case null:
                        $newconditions[]="1=1";
                        $fcontrat = "tous les contrats";
                        break;
                    default :
                        $newconditions[]="Contrat.NOM='".$filtreContrat."'";
                        $fcontrat = "le contrat ".$filtreContrat;
                        break;                      
                }  
                $this->set('fcontrat',$fcontrat);
                switch ($filtreEtat){
                    case 'tous':
                        $newconditions[]="1=1";
                        $fetat = "tous les projets";
                        break;
                    case 'actif':
                    case null:                        
                        $newconditions[]="Projet.ACTIF=1";
                        $fetat = "tous les projets actifs";
                        break;  
                    case 'inactif':
                        $newconditions[]="Projet.ACTIF=0";
                        $fetat = "tous les projets inactifs";
                        break;                                         
                }    
                $this->set('fetat',$fetat); 
                $contrats = $this->Projet->Contrat->find('all',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Contrat.id>1','recursive'=>-1));
                $this->set('contrats',$contrats);                
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Projet->recursive = 0;
		$this->set('projets', $this->paginate());
                $this->Session->delete('xls_export');
                $export = $this->Projet->find('all',array('conditions'=>$newconditions,'order' => array('Projet.NOM' => 'asc'),'recursive'=>0));
                $this->Session->write('xls_export',$export);                   
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
            if (isAuthorized('projets', 'view')) :
		if (!$this->Projet->exists($id)) {
			throw new NotFoundException(__('Projet incorrect'));
		}
		$options = array('conditions' => array('Projet.' . $this->Projet->primaryKey => $id));
		$this->set('projet', $this->Projet->find('first', $options));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('projets', 'add')) :
                $contrats = $this->Projet->Contrat->find('list',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Contrat.id>1','recursive'=>-1));
                $this->set('contrats',$contrats);
                $typeProjet = Configure::read('typeProjet');
                $this->set('type',$typeProjet);
                $factureProjet = Configure::read('factureProjet');
                $this->set('facturation',$factureProjet);                
                if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Projet->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Projet->create();
			if ($this->Projet->save($this->request->data)) {
				$this->Session->setFlash(__('Projet sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Projet incorrect, veuillez corriger le projet',true),'flash_failure');
			}
                    endif;
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
            if (isAuthorized('projets', 'edit')) :
                $contrats = $this->Projet->Contrat->find('list',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Contrat.id>1','recursive'=>-1));
                $this->set('contrats',$contrats);  
                $typeProjet = Configure::read('typeProjet');
                $this->set('type',$typeProjet);
                $factureProjet = Configure::read('factureProjet');
                $this->set('facturation',$factureProjet);                   
                if (!$this->Projet->exists($id)) {
			throw new NotFoundException(__('Projet incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Projet->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Projet->save($this->request->data)) {
				$this->Session->setFlash(__('Projet sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Projet incorrect, veuillez corriger le projet',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Projet.' . $this->Projet->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Projet->find('first', $options);
		}
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
            if (isAuthorized('projets', 'delete')) :
		$this->Projet->id = $id;
		if (!$this->Projet->exists()) {
			throw new NotFoundException(__('Projet incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Projet->delete()) {
			$this->Session->setFlash(__('Projet supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Projet <b>NON</b> supprimé',true),'flash_failure');
		$this->History->goBack(1);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}
        
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
            if (isAuthorized('projets', 'index')) :
                $keyword=isset($this->params->data['Projet']['SEARCH']) ? $this->params->data['Projet']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Projet.NOM LIKE '%".$keyword."%'","Contrat.NOM LIKE '%".$keyword."%'","Projet.NUMEROGALLILIE LIKE '%".$keyword."%'","Projet.COMMENTAIRE LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Projet->recursive = 0;
                $this->set('utilisateurs', $this->paginate());
                $this->Session->delete('xls_export');
                $export = $this->Projet->find('all',array('conditions'=>$newconditions));
                $this->Session->write('xls_export',$export);                
                $contrats = $this->Projet->Contrat->find('all',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Contrat.id>1','recursive'=>0));
                $this->set('contrats',$contrats);
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        }      
        
/**
 * export_xls
 * 
 */       
	function export_xls() {
		$data = $this->Session->read('xls_export');
                $this->Session->delete('xls_export');                
		$this->set('rows',$data);
		$this->render('export_xls','export_xls');
	}         
}
