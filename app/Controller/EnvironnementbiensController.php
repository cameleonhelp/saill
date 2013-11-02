<?php
App::uses('AppController', 'Controller');
/**
 * Environnementbiens Controller
 *
 * @property Environnementbien $Environnementbien
 * @property PaginatorComponent $Paginator
 */
class EnvironnementbiensController extends AppController {

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
		$this->Environnementbien->recursive = 0;
		$this->set('environnementbiens', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Environnementbien->exists($id)) {
			throw new NotFoundException(__('Invalid environnementbien'));
		}
		$options = array('conditions' => array('Environnementbien.' . $this->Environnementbien->primaryKey => $id));
		$this->set('environnementbien', $this->Environnementbien->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Environnementbien->create();
			if ($this->Environnementbien->save($this->request->data)) {
				$this->Session->setFlash(__('The environnementbien has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The environnementbien could not be saved. Please, try again.'));
			}
		}
		$expressionbesoins = $this->Environnementbien->Expressionbesoin->find('list');
		$biens = $this->Environnementbien->Bien->find('list');
		$this->set(compact('expressionbesoins', 'biens'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Environnementbien->exists($id)) {
			throw new NotFoundException(__('Invalid environnementbien'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Environnementbien->save($this->request->data)) {
				$this->Session->setFlash(__('The environnementbien has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The environnementbien could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Environnementbien.' . $this->Environnementbien->primaryKey => $id));
			$this->request->data = $this->Environnementbien->find('first', $options);
		}
		$expressionbesoins = $this->Environnementbien->Expressionbesoin->find('list');
		$biens = $this->Environnementbien->Bien->find('list');
		$this->set(compact('expressionbesoins', 'biens'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Environnementbien->id = $id;
		if (!$this->Environnementbien->exists()) {
			throw new NotFoundException(__('Invalid environnementbien'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Environnementbien->delete()) {
			$this->Session->setFlash(__('The environnementbien has been deleted.'));
		} else {
			$this->Session->setFlash(__('The environnementbien could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
