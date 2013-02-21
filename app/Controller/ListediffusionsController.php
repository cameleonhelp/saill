<?php
App::uses('AppController', 'Controller');
/**
 * Listediffusions Controller
 *
 * @property Listediffusion $Listediffusion
 */
class ListediffusionsController extends AppController {

        public $paginate = array(
        'limit' => 15,
        'order' => array('Listediffusion.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
            
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout','Listes de diffusion');
                $this->Listediffusion->recursive = 0;
		$this->set('listediffusions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('title_for_layout','Listes de diffusion');
                if (!$this->Listediffusion->exists($id)) {
			throw new NotFoundException(__('Liste de diffusion incorrecte'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Listediffusion.' . $this->Listediffusion->primaryKey => $id));
		$this->set('listediffusion', $this->Listediffusion->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','Listes de diffusion');
                if ($this->request->is('post')) {
			$this->Listediffusion->create();
			if ($this->Listediffusion->save($this->request->data)) {
				$this->Session->setFlash(__('Liste de diffusion sauvegardée'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Liste de diffusion incorrecte, veuillez corriger la liste de diffusion'),true,array('class'=>'alert alert-error'));
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
		$this->set('title_for_layout','Listes de diffusion');
                if (!$this->Listediffusion->exists($id)) {
			throw new NotFoundException(__('Liste de diffusion incorrecte'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Listediffusion->save($this->request->data)) {
				$this->Session->setFlash(__('Liste de diffusion sauvegardée'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Liste de diffusion incorrecte, veuillez corriger la liste de diffusion'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Listediffusion.' . $this->Listediffusion->primaryKey => $id));
			$this->request->data = $this->Listediffusion->find('first', $options);
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
		$this->set('title_for_layout','Listes de diffusion');
                $this->Listediffusion->id = $id;
		if (!$this->Listediffusion->exists()) {
			throw new NotFoundException(__('Liste de diffusion incorrecte'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Listediffusion->delete()) {
			$this->Session->setFlash(__('Liste de diffusion supprimée'),true,array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Liste de diffusion NON supprimée'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}
}