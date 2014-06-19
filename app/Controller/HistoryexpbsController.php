<?php
App::uses('AppController', 'Controller');
/**
 * Historyexpbs Controller
 *
 * @property Historyexpb $Historyexpb
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class HistoryexpbsController extends AppController {

/**
 * index method
 *
 * @return void
 */
//	public function index() {
//		$this->Historyexpb->recursive = 0;
//		$this->set('historyexpbs', $this->Paginator->paginate());
//	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function view($id = null) {
//		if (!$this->Historyexpb->exists($id)) {
//			throw new NotFoundException(__('Invalid historyexpb'));
//		}
//		$options = array('conditions' => array('Historyexpb.' . $this->Historyexpb->primaryKey => $id));
//		$this->set('historyexpb', $this->Historyexpb->find('first', $options));
//	}

/**
 * add method
 *
 * @return void
 */
//	public function add() {
//		if ($this->request->is('post')) {
//			$this->Historyexpb->create();
//			if ($this->Historyexpb->save($this->request->data)) {
//				$this->Session->setFlash(__('The historyexpb has been saved.'));
//				return $this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The historyexpb could not be saved. Please, try again.'));
//			}
//		}
//		$expressionbesoins = $this->Historyexpb->Expressionbesoin->find('list');
//		$etats = $this->Historyexpb->Etat->find('list');
//		$this->set(compact('expressionbesoins', 'etats'));
//	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function edit($id = null) {
//		if (!$this->Historyexpb->exists($id)) {
//			throw new NotFoundException(__('Invalid historyexpb'));
//		}
//		if ($this->request->is('post') || $this->request->is('put')) {
//			if ($this->Historyexpb->save($this->request->data)) {
//				$this->Session->setFlash(__('The historyexpb has been saved.'));
//				return $this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The historyexpb could not be saved. Please, try again.'));
//			}
//		} else {
//			$options = array('conditions' => array('Historyexpb.' . $this->Historyexpb->primaryKey => $id));
//			$this->request->data = $this->Historyexpb->find('first', $options);
//		}
//		$expressionbesoins = $this->Historyexpb->Expressionbesoin->find('list');
//		$etats = $this->Historyexpb->Etat->find('list');
//		$this->set(compact('expressionbesoins', 'etats'));
//	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function delete($id = null) {
//		$this->Historyexpb->id = $id;
//		if (!$this->Historyexpb->exists()) {
//			throw new NotFoundException(__('Invalid historyexpb'));
//		}
//		$this->request->onlyAllow('post', 'delete');
//		if ($this->Historyexpb->delete()) {
//			$this->Session->setFlash(__('The historyexpb has been deleted.'));
//		} else {
//			$this->Session->setFlash(__('The historyexpb could not be deleted. Please, try again.'));
//		}
//		return $this->redirect(array('action' => 'index'));
//	}
       
    /**
     * renvois la liste des historique sur les expression s de besoin
     * 
     * @param string $id
     * @return array
     */
    public function get_list($id){
        $list = $this->Historyexpb->find('all',array('conditions'=>array('Historyexpb.expressionbesoins_id'=>$id),'order'=>array('Historyexpb.created'=>'desc'),'recursive'=>0));
        return $list;
    }            
}