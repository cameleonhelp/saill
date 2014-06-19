<?php
App::uses('AppController', 'Controller');
/**
 * Assoutilisateurtjms Controller
 *
 * @property Assoutilisateurtjm $Assoutilisateurtjm
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class AssoutilisateurtjmsController extends AppController {

    /**
     * variables utilisées au niveau du controller
     */
    public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
//	public function index() {
//		$this->Assoutilisateurtjm->recursive = 0;
//		$this->set('assoutilisateurtjms', $this->Paginator->paginate());
//	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function view($id = null) {
//		if (!$this->Assoutilisateurtjm->exists($id)) {
//			throw new NotFoundException(__('Invalid assoutilisateurtjm'));
//		}
//		$options = array('conditions' => array('Assoutilisateurtjm.' . $this->Assoutilisateurtjm->primaryKey => $id));
//		$this->set('assoutilisateurtjm', $this->Assoutilisateurtjm->find('first', $options));
//	}

/**
 * add method
 *
 * @return void
 */
//	public function add() {
//		if ($this->request->is('post')) {
//			$this->Assoutilisateurtjm->create();
//			if ($this->Assoutilisateurtjm->save($this->request->data)) {
//				$this->Session->setFlash(__('The assoutilisateurtjm has been saved.'));
//				return $this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The assoutilisateurtjm could not be saved. Please, try again.'));
//			}
//		}
//		$utilisateurs = $this->Assoutilisateurtjm->Utilisateur->find('list');
//		$tjmagents = $this->Assoutilisateurtjm->Tjmagent->find('list');
//		$this->set(compact('utilisateurs', 'tjmagents'));
//	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function edit($id = null) {
//		if (!$this->Assoutilisateurtjm->exists($id)) {
//			throw new NotFoundException(__('Invalid assoutilisateurtjm'));
//		}
//		if ($this->request->is(array('post', 'put'))) {
//			if ($this->Assoutilisateurtjm->save($this->request->data)) {
//				$this->Session->setFlash(__('The assoutilisateurtjm has been saved.'));
//				return $this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The assoutilisateurtjm could not be saved. Please, try again.'));
//			}
//		} else {
//			$options = array('conditions' => array('Assoutilisateurtjm.' . $this->Assoutilisateurtjm->primaryKey => $id));
//			$this->request->data = $this->Assoutilisateurtjm->find('first', $options);
//		}
//		$utilisateurs = $this->Assoutilisateurtjm->Utilisateur->find('list');
//		$tjmagents = $this->Assoutilisateurtjm->Tjmagent->find('list');
//		$this->set(compact('utilisateurs', 'tjmagents'));
//	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function delete($id = null) {
//		$this->Assoutilisateurtjm->id = $id;
//		if (!$this->Assoutilisateurtjm->exists()) {
//			throw new NotFoundException(__('Invalid assoutilisateurtjm'));
//		}
//		$this->request->onlyAllow('post', 'delete');
//		if ($this->Assoutilisateurtjm->delete()) {
//			$this->Session->setFlash(__('The assoutilisateurtjm has been deleted.'));
//		} else {
//			$this->Session->setFlash(__('The assoutilisateurtjm could not be deleted. Please, try again.'));
//		}
//		return $this->redirect(array('action' => 'index'));
//	}
}
