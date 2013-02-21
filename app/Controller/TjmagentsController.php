<?php
App::uses('AppController', 'Controller');
/**
 * Tjmagents Controller
 *
 * @property Tjmagent $Tjmagent
 */
class TjmagentsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout','TJM agents');
                $this->Tjmagent->recursive = 0;
		$this->set('tjmagents', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('title_for_layout','TJM agents');
                if (!$this->Tjmagent->exists($id)) {
			throw new NotFoundException(__('Invalid tjmagent'));
		}
		$options = array('conditions' => array('Tjmagent.' . $this->Tjmagent->primaryKey => $id));
		$this->set('tjmagent', $this->Tjmagent->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','TJM agents');
                if ($this->request->is('post')) {
			$this->Tjmagent->create();
			if ($this->Tjmagent->save($this->request->data)) {
				$this->Session->setFlash(__('The tjmagent has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tjmagent could not be saved. Please, try again.'));
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
		$this->set('title_for_layout','TJM agents');
                if (!$this->Tjmagent->exists($id)) {
			throw new NotFoundException(__('Invalid tjmagent'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tjmagent->save($this->request->data)) {
				$this->Session->setFlash(__('The tjmagent has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tjmagent could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Tjmagent.' . $this->Tjmagent->primaryKey => $id));
			$this->request->data = $this->Tjmagent->find('first', $options);
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
		$this->set('title_for_layout','TJM agents');
                $this->Tjmagent->id = $id;
		if (!$this->Tjmagent->exists()) {
			throw new NotFoundException(__('Invalid tjmagent'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tjmagent->delete()) {
			$this->Session->setFlash(__('Tjmagent deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tjmagent was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
