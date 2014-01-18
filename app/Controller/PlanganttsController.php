<?php
App::uses('AppController', 'Controller');
/**
 * Plangantts Controller
 *
 * @property Plangantt $Plangantt
 * @property PaginatorComponent $Paginator
 */
class PlanganttsController extends AppController {

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
		$this->Plangantt->recursive = 0;
		$this->set('plangantts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Plangantt->exists($id)) {
			throw new NotFoundException(__('Invalid plangantt'));
		}
		$options = array('conditions' => array('Plangantt.' . $this->Plangantt->primaryKey => $id));
		$this->set('plangantt', $this->Plangantt->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Plangantt->create();
			if ($this->Plangantt->save($this->request->data)) {
				$this->Session->setFlash(__('The plangantt has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The plangantt could not be saved. Please, try again.'));
			}
		}
		$planetapes = $this->Plangantt->Planetape->find('list');
		$planprojets = $this->Plangantt->Planprojet->find('list');
		$utilisateurs = $this->Plangantt->Utilisateur->find('list');
		$this->set(compact('planetapes', 'planprojets', 'utilisateurs'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Plangantt->exists($id)) {
			throw new NotFoundException(__('Invalid plangantt'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Plangantt->save($this->request->data)) {
				$this->Session->setFlash(__('The plangantt has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The plangantt could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Plangantt.' . $this->Plangantt->primaryKey => $id));
			$this->request->data = $this->Plangantt->find('first', $options);
		}
		$planetapes = $this->Plangantt->Planetape->find('list');
		$planprojets = $this->Plangantt->Planprojet->find('list');
		$utilisateurs = $this->Plangantt->Utilisateur->find('list');
		$this->set(compact('planetapes', 'planprojets', 'utilisateurs'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Plangantt->id = $id;
		if (!$this->Plangantt->exists()) {
			throw new NotFoundException(__('Invalid plangantt'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Plangantt->delete()) {
			$this->Session->setFlash(__('The plangantt has been deleted.'));
		} else {
			$this->Session->setFlash(__('The plangantt could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
