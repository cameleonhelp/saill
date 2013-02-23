<?php
App::uses('AppController', 'Controller');
/**
 * Autorisations Controller
 *
 * @property Autorisation $Autorisation
 */
class AutorisationsController extends AppController {
 
    public $paginate = array(
        'limit' => 15,
        'order' => array('Autorisation.profil_id' => 'asc','Autorisation.MODEL' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
 /**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Autorisation->recursive = 0;
		$this->set('autorisations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Autorisation->exists($id)) {
			throw new NotFoundException(__('Autorisation incorrecte'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Autorisation.' . $this->Autorisation->primaryKey => $id));
		$this->set('autorisation', $this->Autorisation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $models = $this->Autorisation->findAllTables($this->Autorisation);
                $this->set('models',$models);
                $profil = $this->Autorisation->Profil->find('list',array('fields' => array('id', 'NOM')));
                $this->set('profil',$profil);
		if ($this->request->is('post')) {
			$this->Autorisation->create();
			if ($this->Autorisation->save($this->request->data)) {
				$this->Session->setFlash(__('Autorisation sauvegardée'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Autorisation incorrecte, veuillez corriger l\'autorisation'),true,array('class'=>'alert alert-error'));
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
                $models = $this->Autorisation->findAllTables($this->Autorisation);
                $this->set('models',$models);            
                $profil = $this->Autorisation->Profil->find('list',array('fields' => array('id', 'NOM')));
                $this->set('profil',$profil);                
		if (!$this->Autorisation->exists($id)) {
			throw new NotFoundException(__('Autorisation incorrecte'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Autorisation->save($this->request->data)) {
				$this->Session->setFlash(__('Autorisation sauvegardée'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Autorisation incorrecte, veuillez corriger l\'autorisation'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Autorisation.' . $this->Autorisation->primaryKey => $id));
			$this->request->data = $this->Autorisation->find('first', $options);
                        $this->set('autorisation', $this->Autorisation->find('first', $options));
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
		$this->Autorisation->id = $id;
		if (!$this->Autorisation->exists()) {
			throw new NotFoundException(__('Autorisation incorrecte'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Autorisation->delete()) {
			$this->Session->setFlash(__('Autorisation supprimée'),true,array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Autorisation NON supprimée'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}
}
