<?php
App::uses('AppController', 'Controller');
/**
 * Envversions Controller
 *
 * @property Envversion $Envversion
 * @property PaginatorComponent $Paginator
 */
class EnvversionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Envversion.VERSION'=>'asc','Envversion.EDITION'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Envversion->recursive = 0;
		$this->set('envversions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Envversion->exists($id)) {
			throw new NotFoundException(__('Invalid envversion'));
		}
		$options = array('conditions' => array('Envversion.' . $this->Envversion->primaryKey => $id));
		$this->set('envversion', $this->Envversion->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Envversion->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Envversion->create();
			if ($this->Envversion->save($this->request->data)) {
				$this->Session->setFlash(__('The envversion has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The envversion could not be saved. Please, try again.'));
			}
                    endif;
		}
		$envoutils = $this->Envversion->Envoutil->find('list');
		$this->set(compact('envoutils'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Envversion->exists($id)) {
			throw new NotFoundException(__('Invalid envversion'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Envversion->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Envversion->save($this->request->data)) {
				$this->Session->setFlash(__('The envversion has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The envversion could not be saved. Please, try again.'));
			}
                    endif;
		} else {
			$options = array('conditions' => array('Envversion.' . $this->Envversion->primaryKey => $id));
			$this->request->data = $this->Envversion->find('first', $options);
		}
		$envoutils = $this->Envversion->Envoutil->find('list');
		$this->set(compact('envoutils'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Envversion->id = $id;
		if (!$this->Envversion->exists()) {
			throw new NotFoundException(__('Invalid envversion'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Envversion->delete()) {
			$this->Session->setFlash(__('The envversion has been deleted.'));
		} else {
			$this->Session->setFlash(__('The envversion could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Envversion->id = $id;
                $obj = $this->Envversion->find('first',array('conditions'=>array('Envversion.id'=>$id),'recursive'=>0));
                $newactif = $obj['Envversion']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Envversion->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function get_version_for($id=null,$actif=null){
            $conditions[] = $actif == null ? '1=1' : 'Envversion.ACTIF='.$actif;
            $conditions[] = 'Envversion.envoutil_id='.$id;
            $list = $this->Envversion->find('all',array('conditions'=>$conditions,'order'=>array('Envversion.VERSION'=>'asc','Envversion.EDITION'=>'asc'),'recursive'=>0));
            return $list;
        }      
        
        public function json_get_version_for($id=null,$actif=null){
            $this->autoRender = false;
            $conditions[] = $actif == null ? '1=1' : 'Envversion.ACTIF='.$actif;
            $conditions[] = 'Envversion.envoutil_id='.$id;
            $versions = $this->Envversion->find('all',array('conditions'=>$conditions,'order'=>array('Envversion.VERSION'=>'asc','Envversion.EDITION'=>'asc'),'recursive'=>-1));
            $result = json_encode($versions);
            return $result;
        } 
        
        public function get_select_version_for($id=null,$actif=null){
            //TODO : limiter aux version de mes outils
            $conditions[] = $actif == null ? '1=1' : 'Envversion.ACTIF='.$actif;
            $conditions[] = 'Envversion.envoutil_id='.$id;
            $list = $this->Envversion->find('list',array('fields'=>array('id','VERSIONEDITION'),'conditions'=>$conditions,'order'=>array('Envversion.VERSIONEDITION'=>'asc'),'recursive'=>0));
            return $list;
        }          
        
        public function json_get_version_info($id=null){
            $this->autoRender = false;
            $conditions[] = 'Envversion.id='.$id;
            $version = $this->Envversion->find('all',array('conditions'=>$conditions,'recursive'=>-1));
            $result = json_encode($version);
            return $result;
        }
        
	public function ajaxadd() {
            $this->set('title_for_layout','Envversions');
            $this->autoRender = false;
            if (isAuthorized('envversions', 'add')) :
		if ($this->request->is('post')) :
			$this->Envversion->create();
			if ($this->Envversion->save($this->request->data)) {
				$this->Session->setFlash(__('Version sauvegardée',true),'flash_success');
                        } else {
				$this->Session->setFlash(__('Version incorrecte, veuillez corriger la version',true),'flash_failure');
			}
			$this->History->notmove();                       
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}   
        
	public function ajaxedit() {
            $this->set('title_for_layout','Envversions');
            $this->autoRender = false;
            if (isAuthorized('envversions', 'edit')) : 
		if ($this->request->is('post') || $this->request->is('put')) :
                        $id = $this->request->data['Envversion']['id'];
			if ($this->Envversion->save($this->request->data)) {
				$this->Session->setFlash(__('Version sauvegardée',true),'flash_success');
			} else {
				$this->Session->setFlash(__('Version incorrecte, veuillez corriger la version',true),'flash_failure');
			}
                        $this->History->notmove();
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}      
        
	public function ajaxdelete($id = null) {
            $this->set('title_for_layout','Envversions');
            $this->autoRender = false;
            if (isAuthorized('envversions', 'delete')) : 
		$this->Envversion->id = $id;
		if (!$this->Envversion->exists()) {
			throw new NotFoundException(__('Envversions incorrecte'));
		}
		if ($this->Envversion->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Version supprimée',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Version <b>NON</b> supprimée',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}        
        
        public function getbyversion($nom){
            $this->Envversion->recursive = 0;
            $params = explode(" ", $nom);
            $version = isset($params[0]) ? $params[0] : '';
            $edition = isset($params[1]) ? $params[1] : '';
            $obj = $this->Envversion->find('first',array('conditions'=>array('Envversion.VERSION'=>$version,'Envversion.EDITION'=>$edition),'recursive'=>'0'));
            return $obj;
        }        
}
