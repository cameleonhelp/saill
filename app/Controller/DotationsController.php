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
                $matinformatique = $this->Dotation->Materielinformatique->find('list',array('fields'=>array('id','NOM'),'conditions'=>array('Materielinformatique.ETAT ='=>'En stock')));
		$this->set('matinformatique', $matinformatique);
                $matautre = $this->Dotation->Typemateriel->find('list',array('fields'=>array('id','NOM'),'conditions'=>array('Typemateriel.id >2')));
		$this->set('matautre', $matautre);                
		if ($this->request->is('post')) {
                        $this->Dotation->utilisateur_id = $userid;
			$this->Dotation->create();
                        $idmat = $this->request->data['Dotation']['materielinformatiques_id'];
			if ($this->Dotation->save($this->request->data,false)) {
                                if(isset($this->request->data['Dotation']['materielinformatiques_id']) && !empty($this->request->data['Dotation']['materielinformatiques_id'])){
                                    $this->Dotation->Materielinformatique->id = $idmat;
                                    $record = $this->Dotation->Materielinformatique->read();
                                    $record['Materielinformatique']['ETAT'] = $record['Materielinformatique']['ETAT']=='En stock' ? 'En dotation' : 'En stock';
                                    $record['Materielinformatique']['created'] = $record['Materielinformatique']['created'];
                                    $record['Materielinformatique']['modified'] = date('Y-m-d');                
                                    $this->Dotation->Materielinformatique->save($record,false);
                                }
                                $history['Historyutilisateur']['utilisateur_id']=$userid;
                                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - ajout d'une dotation";
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
		if (!$this->Dotation->exists($id)) {
			throw new NotFoundException(__('Dotation incorrecte'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Dotation->save($this->request->data)) {
                                $history['Historyutilisateur']['utilisateur_id']=$userid;
                                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - mise à jour de la dotation dotation";
                                $this->Dotation->Utilisateur->Historyutilisateur->save($history); 				
                            $this->Session->setFlash(__('Dotation sauvegardée'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('controller'=>'Utilisateurs','action' => 'edit',$userid));
			} else {
				$this->Session->setFlash(__('Dotation incorrecte, veuillez corriger la dotation'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Dotation.' . $this->Dotation->primaryKey => $id));
			$this->request->data = $this->Dotation->find('first', $options);
        		$this->set('dotation', $this->Dotation->find('first', $options));                        
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
		$this->Dotation->id = $id;
		if (!$this->Dotation->exists()) {
			throw new NotFoundException(__('Dotation incorrecte'),true,array('class'=>'alert alert-error'));
		}
		if ($this->Dotation->delete()) {
                        $history['Historyutilisateur']['utilisateur_id']=$userid;
                        $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - suppression d'une dotation";
                        $this->Dotation->Utilisateur->Historyutilisateur->save($history);                     
			$this->Session->setFlash(__('Dotation supprimée'),true,array('class'=>'alert alert-success'));
			$this->redirect(array('controller'=>'Utilisateurs','action' => 'edit',$userid));
		}
		$this->Session->setFlash(__('Dotation <b>NON</b> supprimée'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('controller'=>'Utilisateurs','action' => 'edit',$userid));
	}
}
