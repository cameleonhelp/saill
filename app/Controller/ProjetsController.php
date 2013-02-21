<?php
App::uses('AppController', 'Controller');
/**
 * Projets Controller
 *
 * @property Projet $Projet
 */
class ProjetsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Projet->recursive = 0;
		$this->set('projets', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Projet->exists($id)) {
			throw new NotFoundException(__('Invalid projet'));
		}
		$options = array('conditions' => array('Projet.' . $this->Projet->primaryKey => $id));
		$this->set('projet', $this->Projet->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Projet->create();
			if ($this->Projet->save($this->request->data)) {
				$this->Session->setFlash(__('The projet has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The projet could not be saved. Please, try again.'));
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
		if (!$this->Projet->exists($id)) {
			throw new NotFoundException(__('Invalid projet'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Projet->save($this->request->data)) {
				$this->Session->setFlash(__('The projet has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The projet could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Projet.' . $this->Projet->primaryKey => $id));
			$this->request->data = $this->Projet->find('first', $options);
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
		$this->Projet->id = $id;
		if (!$this->Projet->exists()) {
			throw new NotFoundException(__('Invalid projet'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Projet->delete()) {
			$this->Session->setFlash(__('Projet deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Projet was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
