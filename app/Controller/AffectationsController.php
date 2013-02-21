<?php
App::uses('AppController', 'Controller');
/**
 * Affectations Controller
 *
 * @property Affectation $Affectation
 */
class AffectationsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Affectation->recursive = 0;
		$this->set('affectations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Affectation->exists($id)) {
			throw new NotFoundException(__('Invalid affectation'));
		}
		$options = array('conditions' => array('Affectation.' . $this->Affectation->primaryKey => $id));
		$this->set('affectation', $this->Affectation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Affectation->create();
			if ($this->Affectation->save($this->request->data)) {
				$this->Session->setFlash(__('The affectation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The affectation could not be saved. Please, try again.'));
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
		if (!$this->Affectation->exists($id)) {
			throw new NotFoundException(__('Invalid affectation'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Affectation->save($this->request->data)) {
				$this->Session->setFlash(__('The affectation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The affectation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Affectation.' . $this->Affectation->primaryKey => $id));
			$this->request->data = $this->Affectation->find('first', $options);
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
		$this->Affectation->id = $id;
		if (!$this->Affectation->exists()) {
			throw new NotFoundException(__('Invalid affectation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Affectation->delete()) {
			$this->Session->setFlash(__('Affectation deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Affectation was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
