<?php
App::uses('AppController', 'Controller');
/**
 * Planetapes Controller
 *
 * @property Planetape $Planetape
 * @property PaginatorComponent $Paginator
 */
class PlanetapesController extends AppController {

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
		$this->Planetape->recursive = 0;
		$this->set('planetapes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Planetape->exists($id)) {
			throw new NotFoundException(__('Invalid planetape'));
		}
		$options = array('conditions' => array('Planetape.' . $this->Planetape->primaryKey => $id));
		$this->set('planetape', $this->Planetape->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Planetape->create();
			if ($this->Planetape->save($this->request->data)) {
				$this->Session->setFlash(__('The planetape has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The planetape could not be saved. Please, try again.'));
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
		if (!$this->Planetape->exists($id)) {
			throw new NotFoundException(__('Invalid planetape'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Planetape->save($this->request->data)) {
				$this->Session->setFlash(__('The planetape has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The planetape could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Planetape.' . $this->Planetape->primaryKey => $id));
			$this->request->data = $this->Planetape->find('first', $options);
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
		$this->Planetape->id = $id;
		if (!$this->Planetape->exists()) {
			throw new NotFoundException(__('Invalid planetape'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Planetape->delete()) {
			$this->Session->setFlash(__('The planetape has been deleted.'));
		} else {
			$this->Session->setFlash(__('The planetape could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
