<?php
App::uses('AppController', 'Controller');
/**
 * Dossierpartages Controller
 *
 * @property Dossierpartage $Dossierpartage
 */
class DossierpartagesController extends AppController {
        public $components = array('History','Common');
        
        public $paginate = array(
        'limit' => 25,
        'order' => array('Dossierpartage.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
        public function get_visibility(){
            if(userAuth('profil_id')==1):
                return null;
            else:
                return $this->requestAction('assoentiteutilisateurs/json_get_all_users_actif_nogenerique/'.userAuth('id'));
            endif;
        }
        
        public function get_restriction($visibility){
            if($visibility == null):
                return '1=1';
            elseif ($visibility!=''):
                return array('OR'=>array('Dossierpartage.utilisateur_id IN ('.$visibility.')','Dossierpartage.utilisateur_id IS NULL'));
            else:
                return array('OR'=>array('Dossierpartage.utilisateur_id ='.userAuth('id'),'Dossierpartage.utilisateur_id IS NULL'));
            endif;
        }
        
        public function get_list_utilisateur($visibility){
            if($visibility == null):
                 $condition = array("Utilisateur.id > 1","Utilisateur.profil_id > 0","Utilisateur.ACTIF"=>1);
            elseif ($visibility!=''):
                $condition = array("Utilisateur.id > 1","Utilisateur.profil_id > 0","Utilisateur.ACTIF"=>1,'Utilisateur.id IN ('.$visibility.')');
            else:
                $condition = array("Utilisateur.id > 1","Utilisateur.profil_id > 0","Utilisateur.ACTIF"=>1,'Utilisateur.id ='.userAuth('id'));
            endif;            
            return $this->Dossierpartage->Utilisateur->find('list',array('fields' => array('Utilisateur.id', 'Utilisateur.NOMLONG'),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'conditions'=>$condition));              
        }     
/**
 * index method
 *
 * @return void
 */
	public function index() {
            $this->set('title_for_layout','Partages réseaux');
            if (isAuthorized('dossierpartages', 'index')) :
                $listusers = $this->get_visibility();
                $newcondition = $this->get_restriction($listusers);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));
		$this->set('dossierpartages', $this->paginate());
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
	public function add() {
            $this->set('title_for_layout','Partages réseaux');
            if (isAuthorized('dossierpartages', 'add')) :            
                if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Dossierpartage->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Dossierpartage->create();
			if ($this->Dossierpartage->save($this->request->data)) {
				$this->Session->setFlash(__('Dossier partagé sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Dossier partagé incorrecte, veuilez corriger le dossier partagé',true),'flash_failure');
			}
                    endif;
		endif;
                $listusers = $this->get_visibility();
                $gestionnaire = $this->get_list_utilisateur($listusers);
                $this->set('gestionnaire',$gestionnaire);                 
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
	public function edit($id = null) {
            $this->set('title_for_layout','Partages réseaux');
            if (isAuthorized('dossierpartages', 'edit')) :    
                if (!$this->Dossierpartage->exists($id)) {
			throw new NotFoundException(__('Dossier partagé incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Dossierpartage->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Dossierpartage->save($this->request->data)) {
				$this->Session->setFlash(__('Dossier partagé sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Dossier partagé incorrecte, veuillez corriger le dossier partagé',true),'flash_failure');
			}
                    endif;
		} else {
                    $options = array('conditions' => array('Dossierpartage.' . $this->Dossierpartage->primaryKey => $id),'recursive'=>0);
                    $this->request->data = $this->Dossierpartage->find('first', $options);
                    $listusers = $this->get_visibility();
                    $gestionnaire = $this->get_list_utilisateur($listusers);
                    $this->set('gestionnaire',$gestionnaire);                         
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
	public function delete($id = null) {
            $this->set('title_for_layout','Partages réseaux');
            if (isAuthorized('dossierpartages', 'delete')) :
                $this->Dossierpartage->id = $id;
		if (!$this->Dossierpartage->exists()) {
			throw new NotFoundException(__('Dossier partagé incorrecte'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Dossierpartage->delete()) {
			$this->Session->setFlash(__('Dossier partagé supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Dossier partagé NON supprimé',true),'flash_failure');
		$this->History->goBack(1);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search($keywords=null) {
            $this->set('title_for_layout','Partages réseaux');
            if (isAuthorized('dossierpartages', 'index')) :
                if(isset($this->params->data['Dossierpartage']['SEARCH'])):
                    $keywords = $this->params->data['Dossierpartage']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords)); 
                    $listusers = $this->get_visibility();
                    $newcondition = $this->get_restriction($listusers);
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Dossierpartage.NOM LIKE '%".$value."%'","Dossierpartage.DESCRIPTION LIKE '%".$value."%'","Dossierpartage.GROUPEAD LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newcondition,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                    $this->set('dossierpartages', $this->paginate());     
                else:
                    $this->redirect(array('action'=>'index'));
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        } 
        
        public function get_list_shared(){
            $list = $this->Dossierpartage->find('list',array('fields'=>array('id','NOM'),"recursive"=>1));
            return $list;
        }
        
        public function get_list(){
            $visibility = $this->get_visibility();
            $conditions = $this->get_restriction($visibility);
            $list = $this->Dossierpartage->find('list',array('fields'=>array('id','NOM'),'conditions'=>$conditions,'order'=>array('Dossierpartage.NOM'=>'asc'),"recursive"=>1));
            return $list;
        }
            
        public function get_all(){
            $visibility = $this->get_visibility();
            $conditions = $this->get_restriction($visibility);
            $list = $this->Dossierpartage->find('all',array('conditions'=>$conditions,'order'=>array('Dossierpartage.NOM'=>'asc'),"recursive"=>1));
            return $list;
        }             
}        
