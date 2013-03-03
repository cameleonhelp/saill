<?php
App::uses('AppController', 'Controller');
/**
 * Dossierpartages Controller
 *
 * @property Dossierpartage $Dossierpartage
 */
class DossierpartagesController extends AppController {

    public $paginate = array(
        'limit' => 15,
        'order' => array('Dossierpartage.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout','Partages réseaux');
                $this->Dossierpartage->recursive = 0;
		$this->set('dossierpartages', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('title_for_layout','Partages réseaux');
                if (!$this->Dossierpartage->exists($id)) {
			throw new NotFoundException(__('Dossier partagé incorrecte'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Dossierpartage.' . $this->Dossierpartage->primaryKey => $id));
		$this->set('dossierpartage', $this->Dossierpartage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','Partages réseaux');
                if ($this->request->is('post')) {
			$this->Dossierpartage->create();
			if ($this->Dossierpartage->save($this->request->data)) {
				$this->Session->setFlash(__('Dossier partagé sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Dossier partagé incorrecte, veuilez corriger le dossier partagé'),true,array('class'=>'alert alert-error'));
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
		$this->set('title_for_layout','Partages réseaux');
                if (!$this->Dossierpartage->exists($id)) {
			throw new NotFoundException(__('Dossier partagé incorrecte'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Dossierpartage->save($this->request->data)) {
				$this->Session->setFlash(__('Dossier partagé sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Dossier partagé incorrecte, veuillez corriger le dossier partagé'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Dossierpartage.' . $this->Dossierpartage->primaryKey => $id));
			$this->request->data = $this->Dossierpartage->find('first', $options);
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
		$this->set('title_for_layout','Partages réseaux');
                $this->Dossierpartage->id = $id;
		if (!$this->Dossierpartage->exists()) {
			throw new NotFoundException(__('Dossier partagé incorrecte'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Dossierpartage->delete()) {
			$this->Session->setFlash(__('Dossier partagé supprimé'),true,array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Dossier partagé NON supprimé'),true,array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $this->set('title_for_layout','Partages réseaux');
                $keyword=$this->params->data['Dossierpartage']['SEARCH']; 
                $newconditions = array('OR'=>array("Dossierpartage.NOM LIKE '%".$keyword."%'","Dossierpartage.DESCRIPTION LIKE '%".$keyword."%'","Dossierpartage.GROUPEAD LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Dossierpartage->recursive = 0;
                $this->set('dossierpartages', $this->paginate());              
                $this->render('index');
        }            
}        
