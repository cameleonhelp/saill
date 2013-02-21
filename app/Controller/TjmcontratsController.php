<?php
App::uses('AppController', 'Controller');
/**
 * Tjmcontrats Controller
 *
 * @property Tjmcontrat $Tjmcontrat
 */
class TjmcontratsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout','TJM contrats');
                $this->Tjmcontrat->recursive = 0;
		$this->set('tjmcontrats', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('title_for_layout','TJM contrats');
                if (!$this->Tjmcontrat->exists($id)) {
			throw new NotFoundException(__('Invalid tjmcontrat'));
		}
		$options = array('conditions' => array('Tjmcontrat.' . $this->Tjmcontrat->primaryKey => $id));
		$this->set('tjmcontrat', $this->Tjmcontrat->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','TJM contrats');
                if ($this->request->is('post')) {
			$this->Tjmcontrat->create();
			if ($this->Tjmcontrat->save($this->request->data)) {
				$this->Session->setFlash(__('The tjmcontrat has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tjmcontrat could not be saved. Please, try again.'));
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
		$this->set('title_for_layout','TJM contrats');
                if (!$this->Tjmcontrat->exists($id)) {
			throw new NotFoundException(__('Invalid tjmcontrat'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tjmcontrat->save($this->request->data)) {
				$this->Session->setFlash(__('The tjmcontrat has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tjmcontrat could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Tjmcontrat.' . $this->Tjmcontrat->primaryKey => $id));
			$this->request->data = $this->Tjmcontrat->find('first', $options);
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
		$this->set('title_for_layout','TJM contrats');
                $this->Tjmcontrat->id = $id;
		if (!$this->Tjmcontrat->exists()) {
			throw new NotFoundException(__('Invalid tjmcontrat'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tjmcontrat->delete()) {
			$this->Session->setFlash(__('Tjmcontrat deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tjmcontrat was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
