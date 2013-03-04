<?php
App::uses('AppController', 'Controller');
/**
 * Affectations Controller
 *
 * @property Affectation $Affectation
 */
class AffectationsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index($id = null) {
		$this->Affectation->recursive = 0;
                $liste = $this->Affectation->find('all',array('conditions'=>array('Affectation.utilisateur_id'=>$id)));                
		$this->set('affectations', $liste);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Affectation->exists($id)) {
			throw new NotFoundException(__('Affectation incorrecte'),'default',array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Affectation.' . $this->Affectation->primaryKey => $id));
		$this->set('affectation', $this->Affectation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($userid = null) {
                $activites = $this->Affectation->Activite->find('list',array('fields'=>array('id','NOM')));
		$this->set('activites', $activites);            
		if ($this->request->is('post')) {
                        $this->Affectation->utilisateur_id = $userid;
			$this->Affectation->create();
			if ($this->Affectation->save($this->request->data)) {
                                $history['Historyutilisateur']['utilisateur_id']=$userid;
                                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - ajout d'une affectation";
                                $this->Affectation->Utilisateur->Historyutilisateur->save($history);     
				$this->Session->setFlash(__('Affectation sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(2));
			} else {
				$this->Session->setFlash(__('Affectation incorrecte, veuillez corriger l\'affectation'),'default',array('class'=>'alert alert-error'));
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
                $activites = $this->Affectation->Activite->find('list',array('fields'=>array('id','NOM')));
		$this->set('activites', $activites);             
		if (!$this->Affectation->exists($id)) {
			throw new NotFoundException(__('Affectation incorrecte'),'default',array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Affectation->save($this->request->data)) {
                                $history['Historyutilisateur']['utilisateur_id']=$userid;
                                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - mise à jour d'une affectation";
                                $this->Affectation->Utilisateur->Historyutilisateur->save($history);                            
				$this->Session->setFlash(__('Affectation sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(2));
			} else {
				$this->Session->setFlash(__('Affectation incorrecte, veuillez corriger làffectation'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Affectation.' . $this->Affectation->primaryKey => $id));
			$this->request->data = $this->Affectation->find('first', $options);
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
	public function delete($id = null,$userid = null) {
		$this->Affectation->id = $id;
		if (!$this->Affectation->exists()) {
			throw new NotFoundException(__('Affectation incorrecte'),'default',array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Affectation->delete()) {
                        $history['Historyutilisateur']['utilisateur_id']=$userid;
                        $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - suppression d'une affectation";
                        $this->Affectation->Utilisateur->Historyutilisateur->save($history);                     
			$this->Session->setFlash(__('Affectation supprimée'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Affectation <b>NON</b> supprimée'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
	}
}
