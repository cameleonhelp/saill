<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 */
class MessagesController extends AppController {

    
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
		$this->Message->recursive = 0;
		$this->set('messages', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Message incorrect'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
		$this->set('message', $this->Message->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Message->create();
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('Message sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Message incorrect, veuillez corriger le message.'),true,array('class'=>'alert alert-error'));
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
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Message incorrect'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('Message sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Message incorrect, veuillez corriger le message.'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
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
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Message incorrect'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Message->delete()) {
			$this->Session->setFlash(__('Message supprimé'),true,array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Message NON supprimé.'),true,array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
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
                $keyword=$this->params->data['Message']['SEARCH']; 
                //$newconditions = array('OR'=>array("Message.LIBELLE LIKE '%$keyword%'","ModelName.name LIKE '%$keyword%'", "ModelName.email LIKE '%$keyword%'")  );
                $newconditions = array("Message.LIBELLE LIKE '%".$keyword."%'");
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                //$this->set('messages',$this->Message->search($this->data['Message']['MessageSEARCH'])); 
                $this->autoRender = false;
                $this->Message->recursive = 0;
                $this->set('messages', $this->paginate());
                $this->render('index');
        }        
}
