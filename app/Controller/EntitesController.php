<?php
App::uses('AppController', 'Controller');
/**
 * Entites Controller
 *
 * @property Entite $Entite
 * @property PaginatorComponent $Paginator
 */
class EntitesController extends AppController {

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
		$this->Entite->recursive = 0;
		$this->set('entites', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Entite->exists($id)) {
			throw new NotFoundException(__('Invalid entite'));
		}
		$options = array('conditions' => array('Entite.' . $this->Entite->primaryKey => $id));
		$this->set('entite', $this->Entite->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Entite->create();
			if ($this->Entite->save($this->request->data)) {
				$this->Session->setFlash(__('The entite has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The entite could not be saved. Please, try again.'));
			}
		}
		$utilisateurs = $this->Entite->Utilisateur->find('list');
		$this->set(compact('utilisateurs'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Entite->exists($id)) {
			throw new NotFoundException(__('Invalid entite'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Entite->save($this->request->data)) {
				$this->Session->setFlash(__('The entite has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The entite could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Entite.' . $this->Entite->primaryKey => $id));
			$this->request->data = $this->Entite->find('first', $options);
		}
		$utilisateurs = $this->Entite->Utilisateur->find('list');
		$this->set(compact('utilisateurs'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Entite->id = $id;
		if (!$this->Entite->exists()) {
			throw new NotFoundException(__('Invalid entite'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Entite->delete()) {
			$this->Session->setFlash(__('The entite has been deleted.'));
		} else {
			$this->Session->setFlash(__('The entite could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
