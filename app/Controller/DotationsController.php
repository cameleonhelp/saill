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
            if (isAuthorized('dotations', 'index')) :
		$this->Dotation->recursive = 0;
                $liste = $this->Dotation->find('all',array('conditions'=>array('Dotation.utilisateur_id'=>$id)));
		$this->set('dotations', $liste);
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
            if (isAuthorized('dotations', 'view')) :
		if (!$this->Dotation->exists($id)) {
			throw new NotFoundException(__('Dotation incorrecte'));
		}
		$options = isset($id) ? array('conditions' => array('Dotation.' . $this->Dotation->primaryKey => $id)) : '';
		$this->set('dotation', $this->Dotation->find('first', $options));
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
            if (isAuthorized('dotations', 'add')) :
                $conditions = array('Materielinformatique.ETAT ='=>'En stock');
                if (userAuth('WIDEAREA')==0) {$restriction[]="Materielinformatique.section_id=".userAuth('section_id'); $conditions = array_merge_recursive($conditions,$restriction);}
                $matinformatique = $this->Dotation->Materielinformatique->find('list',array('fields'=>array('id','NOM'),'conditions'=>$conditions,'order'=>array('Materielinformatique.NOM'=>'asc'),'recursive'=>-1));
		$this->set('matinformatique', $matinformatique);
                $matautre = $this->Dotation->Typemateriel->find('list',array('fields'=>array('id','NOM'),'conditions'=>array('Typemateriel.id >2'),'order'=>array('Typemateriel.NOM'=>"asc"),'recursive'=>-1));
		$this->set('matautre', $matautre);                
		if ($this->request->is('post')) :
                        $this->Dotation->utilisateur_id = $userid;
			$this->Dotation->create();
                        $idmat = $this->request->data['Dotation']['materielinformatiques_id'];
			if ($this->Dotation->save($this->request->data,false)) {
                                if(isset($this->request->data['Dotation']['materielinformatiques_id']) && !empty($this->request->data['Dotation']['materielinformatiques_id'])){
                                    $this->Dotation->Materielinformatique->id = $idmat;
                                    $record = $this->Dotation->Materielinformatique->read();
                                    $record['Materielinformatique']['ETAT'] = $record['Materielinformatique']['ETAT']=='En stock' ? 'En dotation' : 'En stock';
                                    $record['Materielinformatique']['created'] = isset($record['Materielinformatique']['created']) ? $record['Materielinformatique']['created'] : date('Y-m-d');
                                    $record['Materielinformatique']['modified'] = date('Y-m-d');                
                                    $this->Dotation->Materielinformatique->save($record,false);
                                }
                                $history['Historyutilisateur']['utilisateur_id']=$userid;
                                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - ajout d'une dotation";
                                $this->Dotation->Utilisateur->Historyutilisateur->save($history);                               
				$this->Session->setFlash(__('Dotation sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Dotation incorrecte, veuillez corriger la dotation'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('dotations', 'edit')) :
		if (!$this->Dotation->exists($id)) {
			throw new NotFoundException(__('Dotation incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Dotation->save($this->request->data)) {
                                $history['Historyutilisateur']['utilisateur_id']=$userid;
                                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - mise à jour de la dotation dotation";
                                $this->Dotation->Utilisateur->Historyutilisateur->save($history); 				
                            $this->Session->setFlash(__('Dotation sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Dotation incorrecte, veuillez corriger la dotation'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Dotation.' . $this->Dotation->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Dotation->find('first', $options);
        		$this->set('dotation', $this->Dotation->find('first', $options));                        
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
            if (isAuthorized('dotations', 'delete')) :
		$this->Dotation->id = $id;
		if (!$this->Dotation->exists()) {
			throw new NotFoundException(__('Dotation incorrecte'));
		}
		if ($this->Dotation->delete()) {
                        $history['Historyutilisateur']['utilisateur_id']=$userid;
                        $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - suppression d'une dotation";
                        $this->Dotation->Utilisateur->Historyutilisateur->save($history);                     
			$this->Session->setFlash(__('Dotation supprimée'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Dotation <b>NON</b> supprimée'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}
}
