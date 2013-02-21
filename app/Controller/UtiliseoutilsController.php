<?php
App::uses('AppController', 'Controller');
/**
 * Utiliseoutils Controller
 *
 * @property Utiliseoutil $Utiliseoutil
 */
class UtiliseoutilsController extends AppController {
 
    public $paginate = array(
        'limit' => 15,
        'order' => array('Utiliseoutil.utilisateur_id' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout','Ouvertures des droits');
                $this->paginate = array('conditions' => array('Utiliseoutil.STATUT !=' => 'Retour utilisateur'));
                $this->Utiliseoutil->recursive = 0;
		$this->set('utiliseoutils', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('title_for_layout','Ouvertures des droits');
                if (!$this->Utiliseoutil->exists($id)) {
			throw new NotFoundException(__('Ouvertures des droits incorrecte'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Utiliseoutil.' . $this->Utiliseoutil->primaryKey => $id));
		$this->set('utiliseoutil', $this->Utiliseoutil->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','Ouvertures des droits');
                $utilisateur = $this->Utiliseoutil->Utilisateur->find('list',array('fields' => array('id', 'NOMLONG')));
                $this->set('utilisateur',$utilisateur);  
                $outil = $this->Utiliseoutil->Outil->find('list',array('fields' => array('id', 'NOM')));
                $this->set('outil',$outil);  
                $listediffusion = $this->Utiliseoutil->Listediffusion->find('list',array('fields' => array('id', 'NOM')));
                $this->set('listediffusion',$listediffusion); 
                $dossierpartage  = $this->Utiliseoutil->Dossierpartage->find('list',array('fields' => array('id', 'NOM')));
                $this->set('dossierpartage',$dossierpartage );  
                $etat = Configure::read('etatOuvertureDroit');
                $this->set('etat',$etat);                 
                if ($this->request->is('post')) {
			$this->Utiliseoutil->create();
			if ($this->Utiliseoutil->save($this->request->data)) {
				$this->Session->setFlash(__('Ouvertures des droits sauvegardée'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Ouvertures des droits incorrecte, veuillez corriger cette ouverture de droit'),true,array('class'=>'alert alert-error'));
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
		$this->set('title_for_layout','Ouvertures des droits');
                $utilisateur = $this->Utiliseoutil->Utilisateur->find('list',array('fields' => array('id', 'NOM')));
                $this->set('utilisateur',$utilisateur);  
                $outil = $this->Utiliseoutil->Outil->find('list',array('fields' => array('id', 'NOM')));
                $this->set('outil',$outil);  
                $listediffusion = $this->Utiliseoutil->Listediffusion->find('list',array('fields' => array('id', 'NOM')));
                $this->set('listediffusion',$listediffusion); 
                $dossierpartage  = $this->Utiliseoutil->Dossierpartage->find('list',array('fields' => array('id', 'NOM')));
                $this->set('dossierpartage',$dossierpartage );  
                $etat = Configure::read('etatOuvertureDroit');
                $this->set('etat',$etat);    
                if (!$this->Utiliseoutil->exists($id)) {
			throw new NotFoundException(__('Ouvertures des droits incorrecte'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Utiliseoutil->save($this->request->data)) {
				$this->Session->setFlash(__('Ouvertures des droits sauvegardée'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Ouvertures des droits incorrecte, veuillez corriger cette ouverture de droit'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Utiliseoutil.' . $this->Utiliseoutil->primaryKey => $id));
			$this->request->data = $this->Utiliseoutil->find('first', $options);
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
		$this->set('title_for_layout','Ouvertures des droits');
                $this->Utiliseoutil->id = $id;
		if (!$this->Utiliseoutil->exists()) {
			throw new NotFoundException(__('Ouvertures des droits incorrecte'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Utiliseoutil->delete()) {
			$this->Session->setFlash(__('Ouvertures des droits supprimée'),true,array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Ouvertures des droits <b>NON</b> supprimée'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}
        
  /**
 * progressState method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function progressState($id = null) {
		$this->set('title_for_layout','Ouvertures des droits');
                $this->Utiliseoutil->id = $id;
                //lecture
                //affectation nouvel état
		if (!$this->Utiliseoutil->exists()) {
			throw new NotFoundException(__('Ouvertures des droits incorrecte'),true,array('class'=>'alert alert-error'));
		}
                /*if ($this->Utiliseoutil->save($this->request->data)) {
                    $this->Session->setFlash(__('Ouvertures des droits progression de l\'état'),true,array('class'=>'alert alert-success'));
                    $this->redirect(array('action' => 'index'));
                }*/
		$this->Session->setFlash(__('Ouvertures des droits <b>NON</b> progression de l\'état'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}      
}
