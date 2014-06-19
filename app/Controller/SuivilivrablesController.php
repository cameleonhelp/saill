<?php
App::uses('AppController', 'Controller');
/**
 * Suivilivrables Controller
 *
 * @property Suivilivrable $Suivilivrable
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class SuivilivrablesController extends AppController {
    /**
     * Variables globales utilisées au niveau du controller
     */
    public $components = array('History','Common');
    public $paginate = array(
    'order' => array('Suivilivrable.created' => 'asc','Suivilivrable.id'=>'asc'),
      );

    /**
     * liste du suivi des livrables
     */
    public function index() {
            $this->Suivilivrable->recursive = 0;
            $this->set('suivilivrables', $this->paginate());
    }

//	public function view($id = null) {
//		if (!$this->Suivilivrable->exists($id)) {
//			throw new NotFoundException(__('Invalid suivilivrable'));
//		}
//		$options = array('conditions' => array('Suivilivrable.' . $this->Suivilivrable->primaryKey => $id));
//		$this->set('suivilivrable', $this->Suivilivrable->find('first', $options));
//	}

//	public function add() {           
//		if ($this->request->is('post')) {
//			$this->Suivilivrable->create();
//			if ($this->Suivilivrable->save($this->request->data)) {
//				//$this->Session->setFlash(__('The suivilivrable has been saved'));
//				$this->History->goBack(1);
//			} else {
//				//$this->Session->setFlash(__('The suivilivrable could not be saved. Please, try again.'));
//			}
//		}
//	}
//
//	public function edit($id = null) {
//		if (!$this->Suivilivrable->exists($id)) {
//			throw new NotFoundException(__('Invalid suivilivrable'));
//		}
//		if ($this->request->is('post') || $this->request->is('put')) {
//			if ($this->Suivilivrable->save($this->request->data)) {
//				//$this->Session->setFlash(__('The suivilivrable has been saved'));
//				$this->History->goBack(1);
//			} else {
//				//$this->Session->setFlash(__('The suivilivrable could not be saved. Please, try again.'));
//			}
//		} else {
//			$options = array('conditions' => array('Suivilivrable.' . $this->Suivilivrable->primaryKey => $id));
//			$this->request->data = $this->Suivilivrable->find('first', $options);
//		}
//	}
//
//	public function delete($id = null) {
//		$this->Suivilivrable->id = $id;
//		if (!$this->Suivilivrable->exists()) {
//			throw new NotFoundException(__('Invalid suivilivrable'));
//		}
//		//$this->request->onlyAllow('post', 'delete');
//		if ($this->Suivilivrable->delete()) {
//			//$this->Session->setFlash(__('Suivilivrable deleted'));
//			$this->History->goBack(1);
//		}
//		//$this->Session->setFlash(__('Suivilivrable was not deleted'));
//		$this->History->goBack(1);
//	}
}
