<?php
App::uses('AppController', 'Controller');
/**
 * Actionslivrables Controller
 *
 * @property Actionslivrable $Actionslivrable
 */
class ActionslivrablesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Actionslivrable->recursive = 0;
		$this->set('actionslivrables', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Actionslivrable->exists($id)) {
			throw new NotFoundException(__('Invalid actionslivrable'));
		}
		$options = array('conditions' => array('Actionslivrable.' . $this->Actionslivrable->primaryKey => $id));
		$this->set('actionslivrable', $this->Actionslivrable->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Actionslivrable->create();
			if ($this->Actionslivrable->save($this->request->data)) {
				$this->Session->setFlash(__('The actionslivrable has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The actionslivrable could not be saved. Please, try again.'));
			}
		}
		$livrables = $this->Actionslivrable->Livrable->find('list');
		$actions = $this->Actionslivrable->Action->find('list');
		$this->set(compact('livrables', 'actions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Actionslivrable->exists($id)) {
			throw new NotFoundException(__('Invalid actionslivrable'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Actionslivrable->save($this->request->data)) {
				$this->Session->setFlash(__('The actionslivrable has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The actionslivrable could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Actionslivrable.' . $this->Actionslivrable->primaryKey => $id));
			$this->request->data = $this->Actionslivrable->find('first', $options);
		}
		$livrables = $this->Actionslivrable->Livrable->find('list');
		$actions = $this->Actionslivrable->Action->find('list');
		$this->set(compact('livrables', 'actions'));
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
		$this->Actionslivrable->id = $id;
		if (!$this->Actionslivrable->exists()) {
			throw new NotFoundException(__('Invalid actionslivrable'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Actionslivrable->delete()) {
			$this->Session->setFlash(__('Actionslivrable deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Actionslivrable was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
