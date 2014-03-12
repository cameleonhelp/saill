<?php
App::uses('AppController', 'Controller');
/**
 * Dotations Controller
 *
 * @property Dotation $Dotation
 */
class DotationsController extends AppController {
        public $components = array('History','Common');
/**
 * index method
 *
 * @return void
 */
	public function index($id = null) {
            if (isAuthorized('dotations', 'index') || isAuthorized('dotations', 'myprofil')) :
		$this->Dotation->recursive = 0;
                $liste = $this->Dotation->find('all',array('conditions'=>array('Dotation.utilisateur_id'=>$id)));
		$this->set('dotations', $liste);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}

/**
 * add method
 *
 * @return void
 */
	public function add($userid = null) {
            if (isAuthorized('dotations', 'add') || isAuthorized('dotations', 'myprofil')) :
                $conditions = array('Materielinformatique.ETAT ='=>'En stock');
                if (userAuth('WIDEAREA')==0) {$restriction[]="Materielinformatique.section_id=".userAuth('section_id'); $conditions = array_merge_recursive($conditions,$restriction);}
                $matinformatique = $this->Dotation->Materielinformatique->find('list',array('fields'=>array('id','NOM'),'conditions'=>$conditions,'order'=>array('Materielinformatique.NOM'=>'asc'),'recursive'=>-1));
		$this->set('matinformatique', $matinformatique);
                $matautre = $this->Dotation->Typemateriel->find('list',array('fields'=>array('id','NOM'),'conditions'=>array('Typemateriel.id >2'),'order'=>array('Typemateriel.NOM'=>"asc"),'recursive'=>-1));
		$this->set('matautre', $matautre);                
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Dotation->validate = array();
                        $this->History->goBack(1);
                    else:                    
                        $this->Dotation->utilisateur_id = $userid;
			$this->Dotation->create();
                        $idmat = isset($this->request->data['Dotation']['materielinformatiques_id']) ? $this->request->data['Dotation']['materielinformatiques_id'] : null;
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
				$this->Session->setFlash(__('Dotation sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Dotation incorrecte, veuillez corriger la dotation',true),'flash_failure');
			}
                    endif;                        
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
            if (isAuthorized('dotations', 'edit') || isAuthorized('dotations', 'myprofil')) :
		if (!$this->Dotation->exists($id)) {
			throw new NotFoundException(__('Dotation incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Dotation->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Dotation->save($this->request->data)) {
                                $history['Historyutilisateur']['utilisateur_id']=$userid;
                                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - mise à jour de la dotation dotation";
                                $this->Dotation->Utilisateur->Historyutilisateur->save($history); 				
                            $this->Session->setFlash(__('Dotation sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Dotation incorrecte, veuillez corriger la dotation',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Dotation.' . $this->Dotation->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Dotation->find('first', $options);
        		$this->set('dotation', $this->Dotation->find('first', $options));                        
		}
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
			$this->Session->setFlash(__('Dotation supprimée',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Dotation <b>NON</b> supprimée',true),'flash_failure');
		$this->History->goBack(1);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}
        
        public function reception($id,$userid){
            $this->Dotation->id = $id;
            $dotation = $this->Dotation->find('all',array('conditions'=>array('Dotation.id'=>$id),'recursive'=>-1));
            $this->Dotation->saveField('DATEREMISE',date('Y-m-d'));
            $this->Dotation->saveField('utilisateur_id',0);
            $history['Historyutilisateur']['utilisateur_id']=$userid;
            $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - mise à jour de la dotation dotation";
            $this->Dotation->Utilisateur->Historyutilisateur->save($history); 				
        }
        
        public function get_list($id){
            $options = array('Dotation.utilisateur_id='.$id);
            return $this->Dotation->find('list',array('fields' => array('Dotation.id','Materielinformatique.NOM'),'conditions' =>$options,'order'=>array('Materielinformatique.NOM'=>'asc','Typemateriel.NOM'=>'asc'),'recursive'=>0));
        }
        
        public function get_all($id){
            $options = array('Dotation.utilisateur_id='.$id);
            return $this->Dotation->find('all',array('conditions' =>$options,'order'=>array('Materielinformatique.NOM'=>'asc','Typemateriel.NOM'=>'asc'),'recursive'=>0));
        }    
        
        public function get_compteur($id){
            $options =array('Dotation.utilisateur_id' => $id);
            return $this->Dotation->find('first',array('fields'=>array('count(Dotation.id) AS nbDotation'),'conditions' =>$options,'recursive'=>0));
        }        
}
