<?php
App::uses('AppController', 'Controller');
/**
 * Profils Controller
 *
 * @property Profil $Profil
 */
class ProfilsController extends AppController {

    public $paginate = array(
        'limit' => 15,
        'order' => array('Profil.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Profil->recursive = 0;
		$this->set('profils', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Profil->exists($id)) {
			throw new NotFoundException(__('Profil incorrect'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Profil.' . $this->Profil->primaryKey => $id));
		$this->set('profil', $this->Profil->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Profil->create();
			if ($this->Profil->save($this->request->data)) {
				$this->Session->setFlash(__('Profil sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Profil incorrect, veuillez corriger le profil'),true,array('class'=>'alert alert-error'));
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
		if (!$this->Profil->exists($id)) {
			throw new NotFoundException(__('Profil incorrect'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Profil->save($this->request->data)) {
				$this->Session->setFlash(__('Profil sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Profil incorrect, veuillez corriger le profil'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Profil.' . $this->Profil->primaryKey => $id));
			$this->request->data = $this->Profil->find('first', $options);
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
		$this->Profil->id = $id;
		if (!$this->Profil->exists()) {
			throw new NotFoundException(__('Profil incorrect'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Profil->delete()) {
			$this->Session->setFlash(__('Profil supprimé'),true,array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Profil NON supprimé'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}
}