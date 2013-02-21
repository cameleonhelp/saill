<?php
App::uses('AppController', 'Controller');
/**
 * Contrats Controller
 *
 * @property Contrat $Contrat
 */
class ContratsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Contrat->recursive = 0;
		$this->set('contrats', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Contrat->exists($id)) {
			throw new NotFoundException(__('Invalid contrat'));
		}
		$options = array('conditions' => array('Contrat.' . $this->Contrat->primaryKey => $id));
		$this->set('contrat', $this->Contrat->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Contrat->create();
			if ($this->Contrat->save($this->request->data)) {
				$this->Session->setFlash(__('The contrat has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contrat could not be saved. Please, try again.'));
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
		if (!$this->Contrat->exists($id)) {
			throw new NotFoundException(__('Invalid contrat'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Contrat->save($this->request->data)) {
				$this->Session->setFlash(__('The contrat has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contrat could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Contrat.' . $this->Contrat->primaryKey => $id));
			$this->request->data = $this->Contrat->find('first', $options);
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
		$this->Contrat->id = $id;
		if (!$this->Contrat->exists()) {
			throw new NotFoundException(__('Invalid contrat'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Contrat->delete()) {
			$this->Session->setFlash(__('Contrat deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Contrat was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
