<?php
App::uses('AppController', 'Controller');
/**
 * Historyactions Controller
 *
 * @property Historyaction $Historyaction
 */
class HistoryactionsController extends AppController {
        public $components = array('History');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Historyaction->recursive = 0;
		$this->set('historyactions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Historyaction->exists($id)) {
			throw new NotFoundException(__('Invalid historyaction'));
		}
		$options = array('conditions' => array('Historyaction.' . $this->Historyaction->primaryKey => $id));
		$this->set('historyaction', $this->Historyaction->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Historyaction->create();
			if ($this->Historyaction->save($this->request->data)) {
				$this->Session->setFlash(__('The historyaction has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The historyaction could not be saved. Please, try again.'));
			}
		}
		$actions = $this->Historyaction->Action->find('list');
		$utilisateurs = $this->Historyaction->Utilisateur->find('list');
		$this->set(compact('actions', 'utilisateurs'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Historyaction->exists($id)) {
			throw new NotFoundException(__('Invalid historyaction'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Historyaction->save($this->request->data)) {
				$this->Session->setFlash(__('The historyaction has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The historyaction could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Historyaction.' . $this->Historyaction->primaryKey => $id));
			$this->request->data = $this->Historyaction->find('first', $options);
		}
		$actions = $this->Historyaction->Action->find('list');
		$utilisateurs = $this->Historyaction->Utilisateur->find('list');
		$this->set(compact('actions', 'utilisateurs'));
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
		$this->Historyaction->id = $id;
		if (!$this->Historyaction->exists()) {
			throw new NotFoundException(__('Invalid historyaction'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Historyaction->delete()) {
			$this->Session->setFlash(__('Historyaction deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Historyaction was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
