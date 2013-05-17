<?php
App::uses('AppController', 'Controller');
/**
 * Params Controller
 *
 * @property Param $Param
 */
class ParamsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Param->recursive = 0;
		$this->set('params', $this->paginate());
                $this->set('title_for_layout','Paramètres du site');
	}
        
	public function savebdd() {
                $this->set('title_for_layout','Sauvegarde du site');
                $this->Session->setFlash(__('Base de données sauvegardé'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'restorebdd'));
	}  
        
	public function restorebdd() {
                $this->set('title_for_layout','Restauration du site');
                $this->goToPostion();
	}          

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Param->exists($id)) {
			throw new NotFoundException(__('Invalid param'));
		}
		$options = array('conditions' => array('Param.' . $this->Param->primaryKey => $id));
		$this->set('param', $this->Param->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Param->create();
			if ($this->Param->save($this->request->data)) {
				$this->Session->setFlash(__('The param has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The param could not be saved. Please, try again.'));
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
		if (!$this->Param->exists($id)) {
			throw new NotFoundException(__('Invalid param'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Param->save($this->request->data)) {
				$this->Session->setFlash(__('The param has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The param could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Param.' . $this->Param->primaryKey => $id));
			$this->request->data = $this->Param->find('first', $options);
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
		$this->Param->id = $id;
		if (!$this->Param->exists()) {
			throw new NotFoundException(__('Invalid param'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Param->delete()) {
			$this->Session->setFlash(__('Param deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Param was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
