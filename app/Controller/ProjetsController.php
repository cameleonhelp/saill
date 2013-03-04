<?php
App::uses('AppController', 'Controller');
/**
 * Projets Controller
 *
 * @property Projet $Projet
 */
class ProjetsController extends AppController {

        public $paginate = array(
        'limit' => 15,
        'order' => array('Projet.NOM' => 'asc'),
        'conditions' => array('Projet.id >' => 1),
        //'group'=>array('Projet.contrat_id'),
        );
/**
 * index method
 *
 * @return void
 */
	public function index($filtreEtat,$filtreContrat) {
                switch ($filtreContrat){
                    case 'tous':
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
                        $newconditions[]="Projet.ACTIF=1";
                        $fetat = "tous les projets actifs";
                        break;  
                    case 'inactif':
                        $newconditions[]="Projet.ACTIF=0";
                        $fetat = "tous les projets inactifs";
                        break;                                         
                }    
                $this->set('fetat',$fetat); 
                $contrats = $this->Projet->Contrat->find('all',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Contrat.id>1'));
                $this->set('contrats',$contrats);                
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Projet->recursive = 0;
		$this->set('projets', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Projet->exists($id)) {
			throw new NotFoundException(__('Projet incorrect'));
		}
		$options = array('conditions' => array('Projet.' . $this->Projet->primaryKey => $id));
		$this->set('projet', $this->Projet->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $contrats = $this->Projet->Contrat->find('list',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Contrat.id>1'));
                $this->set('contrats',$contrats);
                $typeProjet = Configure::read('typeProjet');
                $this->set('type',$typeProjet);
                $factureProjet = Configure::read('factureProjet');
                $this->set('facturation',$factureProjet);                
                if ($this->request->is('post')) {
			$this->Projet->create();
			if ($this->Projet->save($this->request->data)) {
				$this->Session->setFlash(__('Projet sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Projet incorrect, veuillez corriger le projet'),'default',array('class'=>'alert alert-error'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
                $contrats = $this->Projet->Contrat->find('list',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Contrat.id>1'));
                $this->set('contrats',$contrats);  
                $typeProjet = Configure::read('typeProjet');
                $this->set('type',$typeProjet);
                $factureProjet = Configure::read('factureProjet');
                $this->set('facturation',$factureProjet);                   
                if (!$this->Projet->exists($id)) {
			throw new NotFoundException(__('Projet incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Projet->save($this->request->data)) {
				$this->Session->setFlash(__('Projet sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Projet incorrect, veuillez corriger le projet'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Projet.' . $this->Projet->primaryKey => $id));
			$this->request->data = $this->Projet->find('first', $options);
		}
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
		$this->Projet->id = $id;
		if (!$this->Projet->exists()) {
			throw new NotFoundException(__('Projet incorrect'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Projet->delete()) {
			$this->Session->setFlash(__('Projet supprimé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Projet <b>NON</b> supprimé'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
	}
        
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $keyword=$this->params->data['Projet']['SEARCH']; 
                $newconditions = array('OR'=>array("Projet.NOM LIKE '%".$keyword."%'","Contrat.NOM LIKE '%".$keyword."%'","Projet.NUMEROGALLILIE LIKE '%".$keyword."%'","Projet.COMMENTAIRE LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Projet->recursive = 0;
                $this->set('utilisateurs', $this->paginate());
                $contrats = $this->Projet->Contrat->find('all',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Contrat.id>1'));
                $this->set('contrats',$contrats);
                $this->render('index');
        }          
}
