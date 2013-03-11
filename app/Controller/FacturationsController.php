<?php
App::uses('AppController', 'Controller');
/**
 * Facturations Controller
 *
 * @property Facturation $Facturation
 */
class FacturationsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Facturation->recursive = 0;
		$this->set('facturations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Facturation->exists($id)) {
			throw new NotFoundException(__('Invalid facturation'));
		}
		$options = array('conditions' => array('Facturation.' . $this->Facturation->primaryKey => $id));
		$this->set('facturation', $this->Facturation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Facturation->create();
			if ($this->Facturation->save($this->request->data)) {
				$this->Session->setFlash(__('The facturation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The facturation could not be saved. Please, try again.'));
			}
		}
		$utilisateurs = $this->Facturation->Utilisateur->find('list');
		$actions = $this->Facturation->Action->find('list');
		$this->set(compact('utilisateurs', 'actions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Facturation->exists($id)) {
			throw new NotFoundException(__('Invalid facturation'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Facturation->save($this->request->data)) {
				$this->Session->setFlash(__('The facturation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The facturation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Facturation.' . $this->Facturation->primaryKey => $id));
			$this->request->data = $this->Facturation->find('first', $options);
		}
		$utilisateurs = $this->Facturation->Utilisateur->find('list');
		$actions = $this->Facturation->Action->find('list');
		$this->set(compact('utilisateurs', 'actions'));
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
		$this->Facturation->id = $id;
		if (!$this->Facturation->exists()) {
			throw new NotFoundException(__('Invalid facturation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Facturation->delete()) {
			$this->Session->setFlash(__('Facturation deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Facturation was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
