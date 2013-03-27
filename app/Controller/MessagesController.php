<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 */
class MessagesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }  
    
    public $paginate = array(
        'limit' => 15,
        'order' => array('Message.id' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
            if (isAuthorized('messages', 'index')) :
		$this->Message->recursive = 0;
		$this->set('messages', $this->paginate());
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
               if (isAuthorized('messages', 'view')) :
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Message incorrect'));
		}
		$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
		$this->set('message', $this->Message->find('first', $options));
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
            if (isAuthorized('messages', 'add')) :
		if ($this->request->is('post')) :
			$this->Message->create();
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('Message sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Message incorrect, veuillez corriger le message.'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('messages', 'edit')) :
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Message incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('Message sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Message incorrect, veuillez corriger le message.'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
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
            if (isAuthorized('messages', 'delete')) :
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Message incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Message->delete()) {
			$this->Session->setFlash(__('Message supprimé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Message NON supprimé.'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}

/**
 * activeMessage method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return les messages actifs
 */        
        public function activeMessage() {
            $today = date('Y-m-d');
            if(isset($this->params['requested'])) { //s’il s’agit de l’appel pour l’élément
                $activeMessages = $this->Message->find('all',array('conditions' => array("OR" => array('Message.DATELIMITE' => NULL,'Message.DATELIMITE >=' => $today)),'order'=>array('Message.id asc')));
            return $activeMessages;
            }
           
        }
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
            if (isAuthorized('messages', 'index')) :
                $keyword=isset($this->params->data['Message']['SEARCH']) ? $this->params->data['Message']['SEARCH'] : '';  
                $newconditions = array("Message.LIBELLE LIKE '%".$keyword."%'");
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                //$this->set('messages',$this->Message->search($this->data['Message']['MessageSEARCH'])); 
                $this->autoRender = false;
                $this->Message->recursive = 0;
                $this->set('messages', $this->paginate());
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
        }        
}
