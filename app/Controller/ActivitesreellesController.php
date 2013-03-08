<?php
App::uses('AppController', 'Controller');
/**
 * Activitesreelles Controller
 *
 * @property Activitesreelle $Activitesreelle
 */
class ActivitesreellesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Activitesreelle->recursive = 0;
		$this->set('activitesreelles', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Activitesreelle->exists($id)) {
			throw new NotFoundException(__('Invalid activitesreelle'));
		}
		$options = array('conditions' => array('Activitesreelle.' . $this->Activitesreelle->primaryKey => $id));
		$this->set('activitesreelle', $this->Activitesreelle->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Activitesreelle->create();
			if ($this->Activitesreelle->save($this->request->data)) {
				$this->Session->setFlash(__('The activitesreelle has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The activitesreelle could not be saved. Please, try again.'));
			}
		}
		$utilisateurs = $this->Activitesreelle->Utilisateur->find('list');
		$actions = $this->Activitesreelle->Action->find('list');
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
		if (!$this->Activitesreelle->exists($id)) {
			throw new NotFoundException(__('Invalid activitesreelle'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Activitesreelle->save($this->request->data)) {
				$this->Session->setFlash(__('The activitesreelle has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The activitesreelle could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Activitesreelle.' . $this->Activitesreelle->primaryKey => $id));
			$this->request->data = $this->Activitesreelle->find('first', $options);
		}
		$utilisateurs = $this->Activitesreelle->Utilisateur->find('list');
		$actions = $this->Activitesreelle->Action->find('list');
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
		$this->Activitesreelle->id = $id;
		if (!$this->Activitesreelle->exists()) {
			throw new NotFoundException(__('Invalid activitesreelle'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Activitesreelle->delete()) {
			$this->Session->setFlash(__('Activitesreelle deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Activitesreelle was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
