<?php
App::uses('AppController', 'Controller');
/**
 * Outils Controller
 *
 * @property Outil $Outil
 */
class OutilsController extends AppController {

        public $paginate = array(
        'limit' => 15,
        'order' => array('Outil.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
        
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Outil->recursive = 0;
		$this->set('outils', $this->paginate());
	}
        
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Outil->exists($id)) {
			throw new NotFoundException(__('Outil incorrect'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Outil.' . $this->Outil->primaryKey => $id));
		$this->set('outil', $this->Outil->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $gestionnaire = $this->Outil->Utilisateur->find('list',array('fields' => array('id', 'NOM')));              
                $this->set('gestionnaire',$gestionnaire);            
		if ($this->request->is('post')) {
			$this->Outil->create();
			if ($this->Outil->save($this->request->data)) {
				$this->Session->setFlash(__('Outil sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Outil incorrect, veuillez corriger l\'outil'),true,array('class'=>'alert alert-error'));
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
                $gestionnaire = $this->Outil->Utilisateur->find('list',array('fields' => array('id', 'NOM')));
                $this->set('gestionnaire',$gestionnaire);            
		if (!$this->Outil->exists($id)) {
			throw new NotFoundException(__('Outil incorrect'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Outil->save($this->request->data)) {
				$this->Session->setFlash(__('Outil sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Outil incorrect, veuillez corriger l\'outil'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Outil.' . $this->Outil->primaryKey => $id));
			$this->request->data = $this->Outil->find('first', $options);
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
		$this->Outil->id = $id;
		if (!$this->Outil->exists()) {
			throw new NotFoundException(__('Outil incorrect'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Outil->delete()) {
			$this->Session->setFlash(__('Outil supprimé'),true,array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Outil NON supprimé'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}
}