<?php
App::uses('AppController', 'Controller');
/**
 * Applications Controller
 *
 * @property Application $Application
 * @property PaginatorComponent $Paginator
 */
class ApplicationsController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Application.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null) {
            if (isAuthorized('applications', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Application.ACTIF=1";
                        $strfilter = 'actives';
                        break;
                    case 0:
                        $newconditions[]="Application.ACTIF=0";
                        $strfilter = 'inactives';
                        break;
                endswitch;
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Application->recursive = 0;
		$this->set('applications', $this->paginate());
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
		if (!$this->Application->exists($id)) {
			throw new NotFoundException(__('Application incorrecte'));
		}
		$options = array('conditions' => array('Application.' . $this->Application->primaryKey => $id));
		$this->set('application', $this->Application->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('applications', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Application->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Application->create();
			if ($this->Application->save($this->request->data)) {
				$this->Session->setFlash(__('Application sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Application incorrecte, veuillez corriger l\'application',true),'flash_failure');
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
            if (isAuthorized('applications', 'edit')) :
		if (!$this->Application->exists($id)) {
			throw new NotFoundException(__('Application incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Application->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Application->save($this->request->data)) {
				$this->Session->setFlash(__('Application sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Application incorrecte, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Application.' . $this->Application->primaryKey => $id));
			$this->request->data = $this->Application->find('first', $options);
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
            if (isAuthorized('applications', 'delete')) :
		$this->Application->id = $id;
		if (!$this->Application->exists()) {
			throw new NotFoundException(__('Application incorrecte'));
		}
		if ($this->Application->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Application supprimée',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Application <b>NON</b> supprimée',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Application->id = $id;
                $application = $this->Application->find('first',array('conditions'=>array('Application.id'=>$id),'recursive'=>0));
                $newactif = $application['Application']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Application->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            if (isAuthorized('applications', 'index')) :
                $keyword=isset($this->params->data['Application']['SEARCH']) ? $this->params->data['Application']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Application.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Application->recursive = 0;
                $this->set('applications', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=1,$all=0){
            $list = $this->Application->find('list',array('fields'=>array('Application.id','Application.NOM'),'conditions'=>array('Application.ACTIF'=>$actif),'order'=>array('Application.NOM'=>'asc'),'recursive'=>0));
            if ($all==1) $list = array_merge(array(0=>"Toutes les applications"),$list);
            return $list;
        }    
        
        public function get_list($actif=null){
            $conditions[] = $actif == null ? '1=1' : 'Application.ACTIF='.$actif;
            $list = $this->Application->find('all',array('fields'=>array('Application.id','Application.NOM'),'order'=>array('Application.NOM'=>'asc'),'conditions'=>$conditions,'recursive'=>0));
            return $list;
        }        
        
        public function getbynom($nom){
            $this->Application->recursive = 0;
            $obj = $this->Application->findByNom($nom);
            return $obj;
        }          
}
