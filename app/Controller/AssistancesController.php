<?php
App::uses('AppController', 'Controller');
/**
 * Assistances Controller
 *
 * @property Assistance $Assistance
 */
class AssistancesController extends AppController {
        public $components = array('History','Common');
        public $paginate = array(
        'limit' => 25,
        'order' => array('Assistance.NOM' => 'asc'),
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
            if (isAuthorized('assistances', 'index')) :
		$this->Assistance->recursive = 0;
		$this->set('assistances', $this->paginate());
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
            if (isAuthorized('assistances', 'view')) :
		if (!$this->Assistance->exists($id)) {
			throw new NotFoundException(__('Assistance incorrecte'));
		}
		$options = array('conditions' => array('Assistance.' . $this->Assistance->primaryKey => $id));
		$this->set('assistance', $this->Assistance->find('first', $options));
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
            if (isAuthorized('assistances', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Assistance->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Assistance->create();
			if ($this->Assistance->save($this->request->data)) {
				$this->Session->setFlash(__('Assistance sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Assistance incorrecte, veuillez corriger l\'assistance',true),'flash_failure');
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
            if (isAuthorized('assistances', 'edit')) :
		if (!$this->Assistance->exists($id)) {
			throw new NotFoundException(__('Assistance incorrectee'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Assistance->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Assistance->save($this->request->data)) {
				$this->Session->setFlash(__('Assistance sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Assistance incorrecte, veuillez corriger l\'assistance',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Assistance.' . $this->Assistance->primaryKey => $id));
			$this->request->data = $this->Assistance->find('first', $options);
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
            if (isAuthorized('assistances', 'delete')) :
		$this->Assistance->id = $id;
		if (!$this->Assistance->exists()) {
			throw new NotFoundException(__('Assistance incorrecte'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Assistance->delete()) {
			$this->Session->setFlash(__('Assistance supprimée',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Assistance NON supprimée',true),'flash_failure');
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
            if (isAuthorized('assistances', 'index')) :
                $keyword=isset($this->params->data['Assistance']['SEARCH']) ? $this->params->data['Assistance']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Assistance.NOM LIKE '%".$keyword."%'","Assistance.DESCRIPTION LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Assistance->recursive = 0;
                $this->set('assistances', $this->paginate());           
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
        }         
}
