<?php
App::uses('AppController', 'Controller');
/**
 * Historyintegrations Controller
 *
 * @property Historyintegration $Historyintegration
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class HistoryintegrationsController extends AppController {

/**
 * index method
 *
 * @return void
 */
//	public function index() {
//		$this->Historyintegration->recursive = 0;
//		$this->set('historyintegrations', $this->Paginator->paginate());
//	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function view($id = null) {
//		if (!$this->Historyintegration->exists($id)) {
//			throw new NotFoundException(__('Invalid historyintegration'));
//		}
//		$options = array('conditions' => array('Historyintegration.' . $this->Historyintegration->primaryKey => $id));
//		$this->set('historyintegration', $this->Historyintegration->find('first', $options));
//	}

/**
 * add method
 *
 * @return void
 */
//	public function add() {
//		if ($this->request->is('post')) {
//			$this->Historyintegration->create();
//			if ($this->Historyintegration->save($this->request->data)) {
//				$this->Session->setFlash(__('The historyintegration has been saved.'));
//				return $this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The historyintegration could not be saved. Please, try again.'));
//			}
//		}
//		$intergrationapplicatives = $this->Historyintegration->Intergrationapplicative->find('list');
//		$this->set(compact('intergrationapplicatives'));
//	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function edit($id = null) {
//		if (!$this->Historyintegration->exists($id)) {
//			throw new NotFoundException(__('Invalid historyintegration'));
//		}
//		if ($this->request->is(array('post', 'put'))) {
//			if ($this->Historyintegration->save($this->request->data)) {
//				$this->Session->setFlash(__('The historyintegration has been saved.'));
//				return $this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The historyintegration could not be saved. Please, try again.'));
//			}
//		} else {
//			$options = array('conditions' => array('Historyintegration.' . $this->Historyintegration->primaryKey => $id));
//			$this->request->data = $this->Historyintegration->find('first', $options);
//		}
//		$intergrationapplicatives = $this->Historyintegration->Intergrationapplicative->find('list');
//		$this->set(compact('intergrationapplicatives'));
//	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function delete($id = null) {
//		$this->Historyintegration->id = $id;
//		if (!$this->Historyintegration->exists()) {
//			throw new NotFoundException(__('Invalid historyintegration'));
//		}
//		$this->request->onlyAllow('post', 'delete');
//		if ($this->Historyintegration->delete()) {
//			$this->Session->setFlash(__('The historyintegration has been deleted.'));
//		} else {
//			$this->Session->setFlash(__('The historyintegration could not be deleted. Please, try again.'));
//		}
//		return $this->redirect(array('action' => 'index'));
//	}
        
    /**
     * renvois la liste des historique sur l'intégration applicative
     * 
     * @param string $id
     * @return array
     */
    public function get_list($id){
        $list = $this->Historyintegration->find('all',array('conditions'=>array('Historyintegration.intergrationapplicative_id'=>$id),'order'=>array('Historyintegration.created'=>'desc'),'recursive'=>0));
        return $list;
    }           
}
