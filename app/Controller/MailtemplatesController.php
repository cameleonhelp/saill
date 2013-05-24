<?php
App::uses('AppController', 'Controller');
/**
 * Mailtemplates Controller
 *
 * @property Mailtemplate $Mailtemplate
 */
class MailtemplatesController extends AppController {
        public $components = array('History');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Mailtemplate->recursive = 0;
		$this->set('mailtemplates', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Mailtemplate->exists($id)) {
			throw new NotFoundException(__('Invalid mailtemplate'));
		}
		$options = array('conditions' => array('Mailtemplate.' . $this->Mailtemplate->primaryKey => $id));
		$this->set('mailtemplate', $this->Mailtemplate->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Mailtemplate->create();
			if ($this->Mailtemplate->save($this->request->data)) {
				$this->Session->setFlash(__('The mailtemplate has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mailtemplate could not be saved. Please, try again.'));
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
		if (!$this->Mailtemplate->exists($id)) {
			throw new NotFoundException(__('Invalid mailtemplate'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Mailtemplate->save($this->request->data)) {
				$this->Session->setFlash(__('The mailtemplate has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mailtemplate could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Mailtemplate.' . $this->Mailtemplate->primaryKey => $id));
			$this->request->data = $this->Mailtemplate->find('first', $options);
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
		$this->Mailtemplate->id = $id;
		if (!$this->Mailtemplate->exists()) {
			throw new NotFoundException(__('Invalid mailtemplate'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Mailtemplate->delete()) {
			$this->Session->setFlash(__('Mailtemplate deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Mailtemplate was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
