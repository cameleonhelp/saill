<?php
App::uses('AppController', 'Controller');
/**
 * Dotations Controller
 *
 * @property Dotation $Dotation
 */
class DotationsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Dotation->recursive = 0;
		$this->set('dotations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Dotation->exists($id)) {
			throw new NotFoundException(__('Invalid dotation'));
		}
		$options = array('conditions' => array('Dotation.' . $this->Dotation->primaryKey => $id));
		$this->set('dotation', $this->Dotation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Dotation->create();
			if ($this->Dotation->save($this->request->data)) {
				$this->Session->setFlash(__('The dotation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dotation could not be saved. Please, try again.'));
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
		if (!$this->Dotation->exists($id)) {
			throw new NotFoundException(__('Invalid dotation'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Dotation->save($this->request->data)) {
				$this->Session->setFlash(__('The dotation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dotation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Dotation.' . $this->Dotation->primaryKey => $id));
			$this->request->data = $this->Dotation->find('first', $options);
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
		$this->Dotation->id = $id;
		if (!$this->Dotation->exists()) {
			throw new NotFoundException(__('Invalid dotation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Dotation->delete()) {
			$this->Session->setFlash(__('Dotation deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Dotation was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
