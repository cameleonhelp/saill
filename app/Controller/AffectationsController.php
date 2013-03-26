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
            if (isAuthorized('affectations', 'index')) :
		$this->Affectation->recursive = 0;
                $liste = $this->Affectation->find('all',array('conditions'=>array('Affectation.utilisateur_id'=>$id)));                
		$this->set('affectations', $liste);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();           
            endif;                
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
            if (isAuthorized('affectations', 'view')) :
		if (!$this->Affectation->exists($id)) {
			throw new NotFoundException(__('Affectation incorrecte'));
		}
		$options = array('conditions' => array('Affectation.' . $this->Affectation->primaryKey => $id));
		$this->set('affectation', $this->Affectation->find('first', $options));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();          
            endif;                
	}

/**
 * add method
 *
 * @return void
 */
	public function add($userid = null) {
            if (isAuthorized('affectations', 'add')) :
                $activites = $this->Affectation->Activite->find('all',array('fields' => array('id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'conditions'=>array('Activite.projet_id>1','Activite.ACTIVE'=>1)));
		$this->set('activites', $activites);            
		if ($this->request->is('post')) :
                        $this->Affectation->utilisateur_id = $userid;
			$this->Affectation->create();
			if ($this->Affectation->save($this->request->data)) {
                                $history['Historyutilisateur']['utilisateur_id']=$userid;
                                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - ajout d'une affectation par ".userAuth('NOMLONG');
                                $this->Affectation->Utilisateur->Historyutilisateur->save($history);     
				$this->Session->setFlash(__('Affectation sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(2));
			} else {
				$this->Session->setFlash(__('Affectation incorrecte, veuillez corriger l\'affectation'),'default',array('class'=>'alert alert-error'));
			}
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();         
            endif;                
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null,$userid = null) {
            if (isAuthorized('affectations', 'edit')) :
                $activites = $this->Affectation->Activite->find('all',array('fields' => array('id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'conditions'=>array('Activite.projet_id>1','Activite.ACTIVE'=>1)));
		$this->set('activites', $activites);             
		if (!$this->Affectation->exists($id)) {
			throw new NotFoundException(__('Affectation incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Affectation->save($this->request->data)) {
                                $history['Historyutilisateur']['utilisateur_id']=$userid;
                                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - mise à jour d'une affectation par ".userAuth('NOMLONG');
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
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();           
            endif;                
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
            if (isAuthorized('affectations', 'delete')) :
		$this->Affectation->id = $id;
		if (!$this->Affectation->exists()) {
			throw new NotFoundException(__('Affectation incorrecte'));
		}
		if ($this->Affectation->delete()) {
                        $history['Historyutilisateur']['utilisateur_id']=$userid;
                        $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - suppression d'une affectation par ".userAuth('NOMLONG');
                        $this->Affectation->Utilisateur->Historyutilisateur->save($history);                     
			$this->Session->setFlash(__('Affectation supprimée'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Affectation <b>NON</b> supprimée'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();           
            endif;                
	}
        
        public function addIndisponibilite($id=null){
            $absences = $this->Affectation->Activite->find('all',array('fields'=>array('Activite.id'),'conditions'=>array('Activite.projet_id'=>1)));
            foreach ($absences as $absence) {
                unset($record);
                $record['Affectation']['utilisateur_id'] = $id;
                $record['Affectation']['activite_id'] = $absence['Activite']['id'];
                if ($this->Affectation->save($record)) {
                    $history['Historyutilisateur']['utilisateur_id']=$id;
                    $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - ajout d'une affectation par ".userAuth('NOMLONG');
                    $this->Affectation->Utilisateur->Historyutilisateur->save($history);     
                    $this->Session->setFlash(__('Affectation sauvegardée'),'default',array('class'=>'alert alert-success'));
                }
            }
            $this->redirect($this->goToPostion());
            
        }
}
