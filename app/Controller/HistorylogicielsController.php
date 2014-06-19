<?php
App::uses('AppController', 'Controller');
/**
 * Historylogiciels Controller
 *
 * @property Historylogiciel $Historylogiciel
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class HistorylogicielsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
//	public function index() {
//		$this->Historylogiciel->recursive = 0;
//		$this->set('historylogiciels', $this->paginate());
//	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function view($id = null) {
//		if (!$this->Historylogiciel->exists($id)) {
//			throw new NotFoundException(__('Invalid historylogiciel'));
//		}
//		$options = array('conditions' => array('Historylogiciel.' . $this->Historylogiciel->primaryKey => $id));
//		$this->set('historylogiciel', $this->Historylogiciel->find('first', $options));
//	}

/**
 * add method
 *
 * @return void
 */
//	public function add() {
//		if ($this->request->is('post')) {
//			$this->Historylogiciel->create();
//			if ($this->Historylogiciel->save($this->request->data)) {
//				$this->Session->setFlash(__('The historylogiciel has been saved.'));
//				return $this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The historylogiciel could not be saved. Please, try again.'));
//			}
//		}
//		$logiciels = $this->Historylogiciel->Logiciel->find('list');
//		$this->set(compact('logiciels'));
//	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function edit($id = null) {
//		if (!$this->Historylogiciel->exists($id)) {
//			throw new NotFoundException(__('Invalid historylogiciel'));
//		}
//		if ($this->request->is('post') || $this->request->is('put')) {
//			if ($this->Historylogiciel->save($this->request->data)) {
//				$this->Session->setFlash(__('The historylogiciel has been saved.'));
//				return $this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The historylogiciel could not be saved. Please, try again.'));
//			}
//		} else {
//			$options = array('conditions' => array('Historylogiciel.' . $this->Historylogiciel->primaryKey => $id));
//			$this->request->data = $this->Historylogiciel->find('first', $options);
//		}
//		$logiciels = $this->Historylogiciel->Logiciel->find('list');
//		$this->set(compact('logiciels'));
//	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function delete($id = null) {
//		$this->Historylogiciel->id = $id;
//		if (!$this->Historylogiciel->exists()) {
//			throw new NotFoundException(__('Invalid historylogiciel'));
//		}
//		$this->request->onlyAllow('post', 'delete');
//		if ($this->Historylogiciel->delete()) {
//			$this->Session->setFlash(__('The historylogiciel has been deleted.'));
//		} else {
//			$this->Session->setFlash(__('The historylogiciel could not be deleted. Please, try again.'));
//		}
//		return $this->redirect(array('action' => 'index'));
//	}
     
    /**
     * renvois la liste des historique logiciels
     * 
     * @param string $id
     * @return array
     */
    public function get_list_for_logiciel($id){
        $list = $this->Historylogiciel->find('all',array('conditions'=>array('Assobienlogiciel.logiciel_id'=>$id),'order'=>array('Historylogiciel.created'=>'desc'),'recursive'=>0));
        return $list;
    }           
}
