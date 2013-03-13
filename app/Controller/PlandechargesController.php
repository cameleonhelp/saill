<?php
App::uses('AppController', 'Controller');
/**
 * Plandecharges Controller
 *
 * @property Plandecharge $Plandecharge
 */
class PlandechargesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Plandecharge->recursive = 0;
		$this->set('plandecharges', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Plandecharge->exists($id)) {
			throw new NotFoundException(__('Invalid plandecharge'));
		}
		$options = array('conditions' => array('Plandecharge.' . $this->Plandecharge->primaryKey => $id));
		$this->set('plandecharge', $this->Plandecharge->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Plandecharge->create();
			if ($this->Plandecharge->save($this->request->data)) {
				$this->Session->setFlash(__('The plandecharge has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The plandecharge could not be saved. Please, try again.'));
			}
		}
		$affectations = $this->Plandecharge->Affectation->find('list');
		$this->set(compact('affectations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Plandecharge->exists($id)) {
			throw new NotFoundException(__('Invalid plandecharge'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Plandecharge->save($this->request->data)) {
				$this->Session->setFlash(__('The plandecharge has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The plandecharge could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Plandecharge.' . $this->Plandecharge->primaryKey => $id));
			$this->request->data = $this->Plandecharge->find('first', $options);
		}
		$affectations = $this->Plandecharge->Affectation->find('list');
		$this->set(compact('affectations'));
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
		$this->Plandecharge->id = $id;
		if (!$this->Plandecharge->exists()) {
			throw new NotFoundException(__('Invalid plandecharge'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Plandecharge->delete()) {
			$this->Session->setFlash(__('Plandecharge deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Plandecharge was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
