<?php
App::uses('AppController', 'Controller');
/**
 * Dotations Controller
 *
 * @property Dotation $Dotation
 */
class DotationsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index($id = null) {
		$this->Dotation->recursive = 0;
                $liste = $this->Dotation->find('all',array('conditions'=>array('Dotation.utilisateur_id'=>$id)));
		$this->set('dotations', $liste);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Dotation->exists($id)) {
			throw new NotFoundException(__('Dotation incorrecte'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Dotation.' . $this->Dotation->primaryKey => $id));
		$this->set('dotation', $this->Dotation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($userid = null) {
                $matinformatique = $this->Dotation->Materielinformatique->find('list',array('fields'=>array('id','NOM')));
		$this->set('matinformatique', $matinformatique);
                $matautre = $this->Dotation->Materielautre->find('all',array('fields'=>array('Materielautre.id','Typemateriel.NOM')));
		$this->set('matautre', $matautre);                
		if ($this->request->is('post')) {
                        $this->Dotation->utilisateur_id = $userid;
			$this->Dotation->create();
			if ($this->Dotation->save($this->request->data)) {
                                $history['Historyutilisateur']['utilisateur_id']=$userid;
                                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - Ajout d'une dotation";
                                $this->Dotation->Utilisateur->Historyutilisateur->save($history);                               
				$this->Session->setFlash(__('Dotation sauvegardée'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('controller'=>'Utilisateurs','action' => 'edit',$userid));
			} else {
				$this->Session->setFlash(__('Dotation incorrecte, veuillez corriger la dotation'),true,array('class'=>'alert alert-error'));
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
	public function edit($id = null,$userid = null) {
                $matinformatique = $this->Dotation->Materielinformatique->find('list',array('fields'=>array('id','NOM')));
		$this->set('matinformatique', $matinformatique);
                $matautre = $this->Dotation->Materielautre->find('list',array('fields'=>array('Materielautre.id','Materielautre.id')));
		$this->set('matautre', $matautre);             
		if (!$this->Dotation->exists($id)) {
			throw new NotFoundException(__('Dotation incorrecte'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Dotation->save($this->request->data)) {
                                $history['Historyutilisateur']['utilisateur_id']=$userid;
                                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - Mise à jour de la dotation dotation";
                                $this->Dotation->Utilisateur->Historyutilisateur->save($history); 				
                            $this->Session->setFlash(__('Dotation sauvegardée'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Dotation incorrecte, veuillez corriger la dotation'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Dotation.' . $this->Dotation->primaryKey => $id));
			$this->request->data = $this->Dotation->find('first', $options);
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
		$this->Dotation->id = $id;
		if (!$this->Dotation->exists()) {
			throw new NotFoundException(__('Dotation incorrecte'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Dotation->delete()) {
			$this->Session->setFlash(__('Dotation supprimée'),true,array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Dotation <b>NON</b> supprimée'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}
}
