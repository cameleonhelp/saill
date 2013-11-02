<?php
App::uses('AppController', 'Controller');
/**
 * Historybiens Controller
 *
 * @property Historybien $Historybien
 * @property PaginatorComponent $Paginator
 */
class HistorybiensController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('order'=>array('Historybien.created'=>'desc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Historybien->recursive = 0;
		$this->set('historybiens', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Historybien->exists($id)) {
			throw new NotFoundException(__('Invalid historybien'));
		}
		$options = array('conditions' => array('Historybien.' . $this->Historybien->primaryKey => $id));
		$this->set('historybien', $this->Historybien->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Historybien->create();
			if ($this->Historybien->save($this->request->data)) {
				$this->Session->setFlash(__('The historybien has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The historybien could not be saved. Please, try again.'));
			}
		}
		$biens = $this->Historybien->Bien->find('list');
		$this->set(compact('biens'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Historybien->exists($id)) {
			throw new NotFoundException(__('Invalid historybien'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Historybien->save($this->request->data)) {
				$this->Session->setFlash(__('The historybien has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The historybien could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Historybien.' . $this->Historybien->primaryKey => $id));
			$this->request->data = $this->Historybien->find('first', $options);
		}
		$biens = $this->Historybien->Bien->find('list');
		$this->set(compact('biens'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Historybien->id = $id;
		if (!$this->Historybien->exists()) {
			throw new NotFoundException(__('Invalid historybien'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Historybien->delete()) {
			$this->Session->setFlash(__('The historybien has been deleted.'));
		} else {
			$this->Session->setFlash(__('The historybien could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function get_list($id){
            $list = $this->Historybien->find('all',array('conditions'=>array('Historybien.biens_id'=>$id),'order'=>array('Historybien.created'=>'desc'),'recursive'=>0));
            return $list;
        }    
}        
