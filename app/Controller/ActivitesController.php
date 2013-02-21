<?php
App::uses('AppController', 'Controller');
/**
 * Activites Controller
 *
 * @property Activite $Activite
 */
class ActivitesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Activite->recursive = 0;
		$this->set('activites', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Activite->exists($id)) {
			throw new NotFoundException(__('Invalid activite'));
		}
		$options = array('conditions' => array('Activite.' . $this->Activite->primaryKey => $id));
		$this->set('activite', $this->Activite->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Activite->create();
			if ($this->Activite->save($this->request->data)) {
				$this->Session->setFlash(__('The activite has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The activite could not be saved. Please, try again.'));
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
		if (!$this->Activite->exists($id)) {
			throw new NotFoundException(__('Invalid activite'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Activite->save($this->request->data)) {
				$this->Session->setFlash(__('The activite has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The activite could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Activite.' . $this->Activite->primaryKey => $id));
			$this->request->data = $this->Activite->find('first', $options);
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
		$this->Activite->id = $id;
		if (!$this->Activite->exists()) {
			throw new NotFoundException(__('Invalid activite'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Activite->delete()) {
			$this->Session->setFlash(__('Activite deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Activite was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
