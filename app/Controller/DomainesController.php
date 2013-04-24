<?php
App::uses('AppController', 'Controller');
/**
 * Domaines Controller
 *
 * @property Domaine $Domaine
 */
class DomainesController extends AppController {

        public $paginate = array(
        'limit' => 15,
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
            $this->Session->delete('history');
            if (isAuthorized('domaines', 'index')) :
		$this->Domaine->recursive = 0;
		$this->set('domaines', $this->paginate());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
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
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
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
			$this->Domaine->create();
			if ($this->Domaine->save($this->request->data)) {
				$this->Session->setFlash(__('Domaine sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Domaine incorrect, veuillez corriger le domaine'),'default',array('class'=>'alert alert-error'));
			}
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
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
			if ($this->Domaine->save($this->request->data)) {
				$this->Session->setFlash(__('Domaine sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Domaine incorrect, veuillez corriger le domaine'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Domaine.' . $this->Domaine->primaryKey => $id));
			$this->request->data = $this->Domaine->find('first', $options);
		}
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
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
			$this->Session->setFlash(__('Domaine supprimé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Domaine NON supprimé'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
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
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
        }               
}
