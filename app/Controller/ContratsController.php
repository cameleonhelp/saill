<?php
App::uses('AppController', 'Controller');
/**
 * Contrats Controller
 *
 * @property Contrat $Contrat
 */
class ContratsController extends AppController {
        public $components = array('History','Common');
        public $paginate = array(
        'limit' => 25,
        'order' => array('Contrat.NOM' => 'asc'),
        'conditions' => array('Contrat.id >' => 1),
        );
/**
 * index method
 *
 * @return void
 */
	public function index($filtre=null) {
            //$this->Session->delete('history');
            $listcontrats = $this->requestAction('assoprojetentites/find_str_id_contrats/'.userAuth('id'));
            if (isAuthorized('contrats', 'index')) :
                switch ($filtre){
                    case 'tous':    
                        $newconditions[]="Contrat.id IN (".$listcontrats.')';
                        $fcontrat = "tous les contrats";
                        break;
                    case 'actif':
                    case '<':
                    case null:    
                        $newconditions[]="Contrat.id IN (".$listcontrats.')';
                        $newconditions[]="Contrat.ACTIF=1";
                        $fcontrat = "tous les contrats actifs";
                        break;  
                    case 'inactif':
                        $newconditions[]="Contrat.id IN (".$listcontrats.')';
                        $newconditions[]="Contrat.ACTIF=0";
                        $fcontrat = "tous les contrats inactifs";
                        break;                     
                }    
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Contrat->recursive = 0;
		$this->set('contrats', $this->paginate());
                $this->set('fcontrat',$fcontrat);
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
            if (isAuthorized('contrats', 'view')) :
		if (!$this->Contrat->exists($id)) {
			throw new NotFoundException(__('Contrat incorrect'));
		}
		$options = array('conditions' => array('Contrat.' . $this->Contrat->primaryKey => $id));
		$this->set('contrat', $this->Contrat->find('first', $options));
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
            if (isAuthorized('contrats', 'add')) :
                $tjmcontrats = $this->Contrat->Tjmcontrat->find('list',array('fields' => array('id', 'TJM'),'recursive'=>-1));
                $this->set('tjmcontrats',$tjmcontrats);             
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Contrat->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Contrat->create();
			if ($this->Contrat->save($this->request->data)) {
				$this->Session->setFlash(__('Contrat sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Contrat incorrect, veuillez corriger le contrat',true),'flash_failure');
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
            if (isAuthorized('contrats', 'edit')) :
                $tjmcontrats = $this->Contrat->Tjmcontrat->find('list',array('fields' => array('id', 'TJM'),'recursive'=>-1));
                $this->set('tjmcontrats',$tjmcontrats);            
		if (!$this->Contrat->exists($id)) {
			throw new NotFoundException(__('Contrat incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Contrat->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Contrat->save($this->request->data)) {
                                $this->Contrat->id = $id;
                                $contrat = $this->Contrat->read('ACTIF');   
                                if($contrat['Contrat']['ACTIF']==false):
                                    $actif = 0;
                                    App::import('Controller', 'Projets');
                                    $thisprojet = new ProjetsController();
                                    $thisprojet->set_actif($id, $actif);
                                endif;                            
				$this->Session->setFlash(__('Contrat sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Contrat incorrect, veuillez corriger le contrat',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Contrat.' . $this->Contrat->primaryKey => $id));
			$this->request->data = $this->Contrat->find('first', $options);
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
            if (isAuthorized('contrats', 'delete')) :
		$this->Contrat->id = $id;
		if (!$this->Contrat->exists()) {
			throw new NotFoundException(__('Contrat incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Contrat->delete()) {
			$this->Session->setFlash(__('Contrat supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Contrat <b>NON</b> supprimé',true),'flash_failure');
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
            if (isAuthorized('contrats', 'index')) :
                $keyword=isset($this->params->data['Contrat']['SEARCH']) ? $this->params->data['Contrat']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Contrat.NOM LIKE '%".$keyword."%'","Contrat.DESCRIPTION LIKE '%".$keyword."%'","Contrat.ANNEEDEBUT LIKE '%".$keyword."%'","Contrat.ANNEEFIN LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Contrat->recursive = 0;
                $this->set('contrats', $this->paginate());              
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        }      
        
}
