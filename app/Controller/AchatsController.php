<?php
App::uses('AppController', 'Controller');
/**
 * Achats Controller
 *
 * @property Achat $Achat
 */
class AchatsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Achat->recursive = 0;
		$this->set('achats', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Achat->exists($id)) {
			throw new NotFoundException(__('Invalid achat'));
		}
		$options = array('conditions' => array('Achat.' . $this->Achat->primaryKey => $id));
		$this->set('achat', $this->Achat->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Achat->create();
			if ($this->Achat->save($this->request->data)) {
				$this->Session->setFlash(__('The achat has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The achat could not be saved. Please, try again.'));
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
		if (!$this->Achat->exists($id)) {
			throw new NotFoundException(__('Invalid achat'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Achat->save($this->request->data)) {
				$this->Session->setFlash(__('The achat has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The achat could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Achat.' . $this->Achat->primaryKey => $id));
			$this->request->data = $this->Achat->find('first', $options);
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
		$this->Achat->id = $id;
		if (!$this->Achat->exists()) {
			throw new NotFoundException(__('Invalid achat'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Achat->delete()) {
			$this->Session->setFlash(__('Achat deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Achat was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
