<?php
App::uses('AppController', 'Controller');
/**
 * Domaines Controller
 *
 * @property Domaine $Domaine
 */
class DomainesController extends AppController {
        public $components = array('History','Common');
        public $paginate = array(
        'limit' => 25,
        'order' => array('Domaine.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
            
/**
 * index method
 *
 * @return void
 */
	public function index() {
            //$this->Session->delete('history');
            if (isAuthorized('domaines', 'index')) :
		$this->Domaine->recursive = 0;
		$this->set('domaines', $this->paginate());
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
            if (isAuthorized('domaines', 'view')) :
		if (!$this->Domaine->exists($id)) {
			throw new NotFoundException(__('Domaine incorrect'));
		}
		$options = array('conditions' => array('Domaine.' . $this->Domaine->primaryKey => $id),'recursive'=>0);
		$this->set('domaine', $this->Domaine->find('first', $options));
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
            if (isAuthorized('domaines', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Domaine->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Domaine->create();
			if ($this->Domaine->save($this->request->data)) {
				$this->Session->setFlash(__('Domaine sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Domaine incorrect, veuillez corriger le domaine',true),'flash_failure');
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
            if (isAuthorized('domaines', 'edit')) :
		if (!$this->Domaine->exists($id)) {
			throw new NotFoundException(__('Domaine incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Domaine->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Domaine->save($this->request->data)) {
				$this->Session->setFlash(__('Domaine sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Domaine incorrect, veuillez corriger le domaine',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Domaine.' . $this->Domaine->primaryKey => $id));
			$this->request->data = $this->Domaine->find('first', $options);
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
            if (isAuthorized('domaines', 'delete')) :
		$this->Domaine->id = $id;
		if (!$this->Domaine->exists()) {
			throw new NotFoundException(__('Domaine incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Domaine->delete()) {
			$this->Session->setFlash(__('Domaine supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Domaine NON supprimé',true),'flash_failure');
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
            if (isAuthorized('domaines', 'index')) :
                $keyword=isset($this->params->data['Domaine']['SEARCH']) ? $this->params->data['Domaine']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Domaine.NOM LIKE '%".$keyword."%'","Domaine.DESCRIPTION LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Domaine->recursive = 0;
                $this->set('domaines', $this->paginate());               
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        }               
}
