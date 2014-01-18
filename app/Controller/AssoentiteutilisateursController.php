<?php
App::uses('AppController', 'Controller');
/**
 * Assoentiteutilisateurs Controller
 *
 * @property Assoentiteutilisateur $Assoentiteutilisateur
 * @property PaginatorComponent $Paginator
 */
class AssoentiteutilisateursController extends AppController {

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
		$this->Assoentiteutilisateur->recursive = 0;
		$this->set('assoentiteutilisateurs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Assoentiteutilisateur->exists($id)) {
			throw new NotFoundException(__('Invalid assoentiteutilisateur'));
		}
		$options = array('conditions' => array('Assoentiteutilisateur.' . $this->Assoentiteutilisateur->primaryKey => $id));
		$this->set('assoentiteutilisateur', $this->Assoentiteutilisateur->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Assoentiteutilisateur->create();
			if ($this->Assoentiteutilisateur->save($this->request->data)) {
				$this->Session->setFlash(__('The assoentiteutilisateur has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assoentiteutilisateur could not be saved. Please, try again.'));
			}
		}
		$entites = $this->Assoentiteutilisateur->Entite->find('list');
		$utilisateurs = $this->Assoentiteutilisateur->Utilisateur->find('list');
		$this->set(compact('entites', 'utilisateurs'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Assoentiteutilisateur->exists($id)) {
			throw new NotFoundException(__('Invalid assoentiteutilisateur'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Assoentiteutilisateur->save($this->request->data)) {
				$this->Session->setFlash(__('The assoentiteutilisateur has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assoentiteutilisateur could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Assoentiteutilisateur.' . $this->Assoentiteutilisateur->primaryKey => $id));
			$this->request->data = $this->Assoentiteutilisateur->find('first', $options);
		}
		$entites = $this->Assoentiteutilisateur->Entite->find('list');
		$utilisateurs = $this->Assoentiteutilisateur->Utilisateur->find('list');
		$this->set(compact('entites', 'utilisateurs'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Assoentiteutilisateur->id = $id;
		if (!$this->Assoentiteutilisateur->exists()) {
			throw new NotFoundException(__('Invalid assoentiteutilisateur'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Assoentiteutilisateur->delete()) {
			$this->Session->setFlash(__('The assoentiteutilisateur has been deleted.'));
		} else {
			$this->Session->setFlash(__('The assoentiteutilisateur could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
