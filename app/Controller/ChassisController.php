<?php
App::uses('AppController', 'Controller');
/**
 * Chassis Controller
 *
 * @property Chassis $Chassis
 * @property PaginatorComponent $Paginator
 */
class ChassisController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Chassis.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null,$localite=null) {
            $this->set('title_for_layout','Chassis');
            if (isAuthorized('chassis', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Chassis.ACTIF=1";
                        $strfilter = 'actifs';
                        break;
                    case 0:
                        $newconditions[]="Chassis.ACTIF=0";
                        $strfilter = 'inactifs';
                        break;
                endswitch;
                switch($localite):
                    case null:
                        $newconditions[]="1=1";
                        $strfilter .= ' de toutes les localités';
                        break;
                    default:
                        $newconditions[]="Chassis.localite_id=".$localite;
                        $nomlocalite = $this->Chassis->Localite->findById($localite);
                        $strfilter .= ' se situant à '.$nomlocalite['Localite']['NOM'];
                        break;
                endswitch;                 
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Chassis->recursive = 0;
		$this->set('chassis', $this->paginate());
                $localites = $this->requestAction('localites/get_list');
                $this->set('localites',$localites);
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
                $this->set('title_for_layout','Chassis');
		if (!$this->Chassis->exists($id)) {
			throw new NotFoundException(__('Chassis incorrect'));
		}
		$options = array('conditions' => array('Chassis.' . $this->Chassis->primaryKey => $id));
		$this->set('chassis', $this->Chassis->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','Chassis');
            if (isAuthorized('chassis', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Chassis->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Chassis->create();
			if ($this->Chassis->save($this->request->data)) {
				$this->Session->setFlash(__('Chassis sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Chassis incorrect, veuillez corriger le chassis',true),'flash_failure');
			}
                    endif;
		endif;
                $localites = $this->requestAction('localites/get_select/1');
                $this->set('localites',$localites);
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
            $this->set('title_for_layout','Chassis');
            if (isAuthorized('chassis', 'edit')) :            
		if (!$this->Chassis->exists($id)) {
			throw new NotFoundException(__('Chassis incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Chassis->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Chassis->save($this->request->data)) {
				$this->Session->setFlash(__('Chassis sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Chassis incorrect, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Chassis.' . $this->Chassis->primaryKey => $id));
			$this->request->data = $this->Chassis->find('first', $options);
                        $localites = $this->requestAction('localites/get_select/1');
                        $this->set('localites',$localites);                        
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
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
            $this->set('title_for_layout','Chassis');
            if (isAuthorized('chassis', 'delete')) : 
		$this->Chassis->id = $id;
		if (!$this->Chassis->exists()) {
			throw new NotFoundException(__('Chassis incorrect'));
		}
		if ($this->Chassis->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Chassis supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Chassis <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Chassis->id = $id;
                $obj = $this->Chassis->find('first',array('conditions'=>array('Chassis.id'=>$id),'recursive'=>0));
                $newactif = $obj['Chassis']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Chassis->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            $this->set('title_for_layout','Chassis');
            if (isAuthorized('chassis', 'index')) :
                $keyword=isset($this->params->data['Chassis']['SEARCH']) ? $this->params->data['Chassis']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Chassis.NOM LIKE '%".$keyword."%'","Chassis.NIVEAU LIKE '%".$keyword."%'","Chassis.ARMOIRE LIKE '%".$keyword."%'","Chassis.PVU LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Chassis->recursive = 0;
                $this->set('chassis', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=null){
            $conditions[] = $actif == null ? '1=1' : 'Chassis.ACTIF='.$actif;
            $list = $this->Chassis->find('list',array('fields'=>array('Chassis.id','Chassis.NOM'),'conditions'=>$conditions,'recursive'=>0));
            return $list;
        }    
        
        public function getbynom($nom){
            $this->Chassis->recursive = 0;
            $obj = $this->Chassis->findByNom($nom);
            return $obj;
        }        
}
