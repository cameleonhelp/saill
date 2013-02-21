<?php
App::uses('AppController', 'Controller');
/**
 * Livrables Controller
 *
 * @property Livrable $Livrable
 */
class LivrablesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Livrable->recursive = 0;
		$this->set('livrables', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Livrable->exists($id)) {
			throw new NotFoundException(__('Invalid livrable'));
		}
		$options = array('conditions' => array('Livrable.' . $this->Livrable->primaryKey => $id));
		$this->set('livrable', $this->Livrable->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Livrable->create();
			if ($this->Livrable->save($this->request->data)) {
				$this->Session->setFlash(__('The livrable has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The livrable could not be saved. Please, try again.'));
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
		if (!$this->Livrable->exists($id)) {
			throw new NotFoundException(__('Invalid livrable'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Livrable->save($this->request->data)) {
				$this->Session->setFlash(__('The livrable has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The livrable could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Livrable.' . $this->Livrable->primaryKey => $id));
			$this->request->data = $this->Livrable->find('first', $options);
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
		$this->Livrable->id = $id;
		if (!$this->Livrable->exists()) {
			throw new NotFoundException(__('Invalid livrable'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Livrable->delete()) {
			$this->Session->setFlash(__('Livrable deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Livrable was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
