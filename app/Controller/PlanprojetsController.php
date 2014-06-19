<?php
App::uses('AppController', 'Controller');
/**
 * Planprojets Controller
 *
 * @property Planprojet $Planprojet
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 * EN PREVISION POUR GANTT
 */
class PlanprojetsController extends AppController {

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
		$this->Planprojet->recursive = 0;
		$this->set('planprojets', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Planprojet->exists($id)) {
			throw new NotFoundException(__('Invalid planprojet'));
		}
		$options = array('conditions' => array('Planprojet.' . $this->Planprojet->primaryKey => $id));
		$this->set('planprojet', $this->Planprojet->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Planprojet->create();
			if ($this->Planprojet->save($this->request->data)) {
				$this->Session->setFlash(__('The planprojet has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The planprojet could not be saved. Please, try again.'));
			}
		}
		$utilisateurs = $this->Planprojet->Utilisateur->find('list');
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
		if (!$this->Planprojet->exists($id)) {
			throw new NotFoundException(__('Invalid planprojet'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Planprojet->save($this->request->data)) {
				$this->Session->setFlash(__('The planprojet has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The planprojet could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Planprojet.' . $this->Planprojet->primaryKey => $id));
			$this->request->data = $this->Planprojet->find('first', $options);
		}
		$utilisateurs = $this->Planprojet->Utilisateur->find('list');
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
		$this->Planprojet->id = $id;
		if (!$this->Planprojet->exists()) {
			throw new NotFoundException(__('Invalid planprojet'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Planprojet->delete()) {
			$this->Session->setFlash(__('The planprojet has been deleted.'));
		} else {
			$this->Session->setFlash(__('The planprojet could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
