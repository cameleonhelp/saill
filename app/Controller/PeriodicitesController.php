<?php
App::uses('AppController', 'Controller');
/**
 * Periodicites Controller
 *
 * @property Periodicite $Periodicite
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class PeriodicitesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Periodicite->recursive = 0;
		$this->set('periodicites', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Periodicite->exists($id)) {
			throw new NotFoundException(__('Invalid periodicite'));
		}
		$options = array('conditions' => array('Periodicite.' . $this->Periodicite->primaryKey => $id));
		$this->set('periodicite', $this->Periodicite->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Periodicite->create();
			if ($this->Periodicite->save($this->request->data)) {
				$this->Session->setFlash(__('The periodicite has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The periodicite could not be saved. Please, try again.'));
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
		if (!$this->Periodicite->exists($id)) {
			throw new NotFoundException(__('Invalid periodicite'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Periodicite->save($this->request->data)) {
				$this->Session->setFlash(__('The periodicite has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The periodicite could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Periodicite.' . $this->Periodicite->primaryKey => $id));
			$this->request->data = $this->Periodicite->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Periodicite->id = $id;
		if (!$this->Periodicite->exists()) {
			throw new NotFoundException(__('Invalid periodicite'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Periodicite->delete()) {
			$this->Session->setFlash(__('Periodicite deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Periodicite was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
