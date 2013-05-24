<?php
App::uses('AppController', 'Controller');
/**
 * Replacestrings Controller
 *
 * @property Replacestring $Replacestring
 */
class ReplacestringsController extends AppController {
        public $components = array('History');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Replacestring->recursive = 0;
		$this->set('replacestrings', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Replacestring->exists($id)) {
			throw new NotFoundException(__('Invalid replacestring'));
		}
		$options = array('conditions' => array('Replacestring.' . $this->Replacestring->primaryKey => $id));
		$this->set('replacestring', $this->Replacestring->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Replacestring->create();
			if ($this->Replacestring->save($this->request->data)) {
				$this->Session->setFlash(__('The replacestring has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The replacestring could not be saved. Please, try again.'));
			}
		}
		$mailtemplates = $this->Replacestring->Mailtemplate->find('list');
		$this->set(compact('mailtemplates'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Replacestring->exists($id)) {
			throw new NotFoundException(__('Invalid replacestring'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Replacestring->save($this->request->data)) {
				$this->Session->setFlash(__('The replacestring has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The replacestring could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Replacestring.' . $this->Replacestring->primaryKey => $id));
			$this->request->data = $this->Replacestring->find('first', $options);
		}
		$mailtemplates = $this->Replacestring->Mailtemplate->find('list');
		$this->set(compact('mailtemplates'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Replacestring->id = $id;
		if (!$this->Replacestring->exists()) {
			throw new NotFoundException(__('Invalid replacestring'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Replacestring->delete()) {
			$this->Session->setFlash(__('Replacestring deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Replacestring was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
