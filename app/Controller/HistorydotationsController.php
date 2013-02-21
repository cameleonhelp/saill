<?php
App::uses('AppController', 'Controller');
/**
 * Historydotations Controller
 *
 * @property Historydotation $Historydotation
 */
class HistorydotationsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Historydotation->recursive = 0;
		$this->set('historydotations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Historydotation->exists($id)) {
			throw new NotFoundException(__('Invalid historydotation'));
		}
		$options = array('conditions' => array('Historydotation.' . $this->Historydotation->primaryKey => $id));
		$this->set('historydotation', $this->Historydotation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Historydotation->create();
			if ($this->Historydotation->save($this->request->data)) {
				$this->Session->setFlash(__('The historydotation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The historydotation could not be saved. Please, try again.'));
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
		if (!$this->Historydotation->exists($id)) {
			throw new NotFoundException(__('Invalid historydotation'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Historydotation->save($this->request->data)) {
				$this->Session->setFlash(__('The historydotation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The historydotation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Historydotation.' . $this->Historydotation->primaryKey => $id));
			$this->request->data = $this->Historydotation->find('first', $options);
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
		$this->Historydotation->id = $id;
		if (!$this->Historydotation->exists()) {
			throw new NotFoundException(__('Invalid historydotation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Historydotation->delete()) {
			$this->Session->setFlash(__('Historydotation deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Historydotation was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
