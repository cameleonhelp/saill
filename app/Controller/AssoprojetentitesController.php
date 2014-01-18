<?php
App::uses('AppController', 'Controller');
/**
 * Assoprojetentites Controller
 *
 * @property Assoprojetentite $Assoprojetentite
 * @property PaginatorComponent $Paginator
 */
class AssoprojetentitesController extends AppController {

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
		$this->Assoprojetentite->recursive = 0;
		$this->set('assoprojetentites', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Assoprojetentite->exists($id)) {
			throw new NotFoundException(__('Invalid assoprojetentite'));
		}
		$options = array('conditions' => array('Assoprojetentite.' . $this->Assoprojetentite->primaryKey => $id));
		$this->set('assoprojetentite', $this->Assoprojetentite->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Assoprojetentite->create();
			if ($this->Assoprojetentite->save($this->request->data)) {
				$this->Session->setFlash(__('The assoprojetentite has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assoprojetentite could not be saved. Please, try again.'));
			}
		}
		$entites = $this->Assoprojetentite->Entite->find('list');
		$projets = $this->Assoprojetentite->Projet->find('list');
		$this->set(compact('entites', 'projets'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Assoprojetentite->exists($id)) {
			throw new NotFoundException(__('Invalid assoprojetentite'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Assoprojetentite->save($this->request->data)) {
				$this->Session->setFlash(__('The assoprojetentite has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assoprojetentite could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Assoprojetentite.' . $this->Assoprojetentite->primaryKey => $id));
			$this->request->data = $this->Assoprojetentite->find('first', $options);
		}
		$entites = $this->Assoprojetentite->Entite->find('list');
		$projets = $this->Assoprojetentite->Projet->find('list');
		$this->set(compact('entites', 'projets'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Assoprojetentite->id = $id;
		if (!$this->Assoprojetentite->exists()) {
			throw new NotFoundException(__('Invalid assoprojetentite'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Assoprojetentite->delete()) {
			$this->Session->setFlash(__('The assoprojetentite has been deleted.'));
		} else {
			$this->Session->setFlash(__('The assoprojetentite could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
