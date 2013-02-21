<?php
App::uses('AppController', 'Controller');
/**
 * Linkshareds Controller
 *
 * @property Linkshared $Linkshared
 */
class LinksharedsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
                $this->set('title_for_layout','Liens partagés');
                $this->Linkshared->recursive = 0;
		$this->set('linkshareds', $this->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
                $this->set('title_for_layout','Liens partagés');
                if (!$this->Linkshared->exists($id)) {
			throw new NotFoundException(__('Invalid linkshared'));
		}
		$options = array('conditions' => array('Linkshared.' . $this->Linkshared->primaryKey => $id));
		$this->set('linkshared', $this->Linkshared->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $this->set('title_for_layout','Liens partagés');
                if ($this->request->is('post')) {
			$this->Linkshared->create();
			if ($this->Linkshared->save($this->request->data)) {
				$this->Session->setFlash(__('The linkshared has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The linkshared could not be saved. Please, try again.'));
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
                $this->set('title_for_layout','Liens partagés');
                if (!$this->Linkshared->exists($id)) {
			throw new NotFoundException(__('Invalid linkshared'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Linkshared->save($this->request->data)) {
				$this->Session->setFlash(__('The linkshared has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The linkshared could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Linkshared.' . $this->Linkshared->primaryKey => $id));
			$this->request->data = $this->Linkshared->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
                $this->set('title_for_layout','Liens partagés');
                $this->Linkshared->id = $id;
		if (!$this->Linkshared->exists()) {
			throw new NotFoundException(__('Invalid linkshared'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Linkshared->delete()) {
			$this->Session->setFlash(__('Linkshared deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Linkshared was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
