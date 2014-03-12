<?php
App::uses('AppController', 'Controller');
/**
 * Outils Controller
 *
 * @property Outil $Outil
 */
class OutilsController extends AppController {
        public $components = array('History','Common');
        public $paginate = array(
        'limit' => 25,
        'order' => array('Outil.NOM' => 'asc'),
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
                return array('OR'=>array('Outil.utilisateur_id IN ('.$visibility.')','Outil.utilisateur_id IS NULL'));
            else:
                return array('OR'=>array('Outil.utilisateur_id ='.userAuth('id'),'Outil.utilisateur_id IS NULL'));
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
            return $this->Outil->Utilisateur->find('list',array('fields' => array('Utilisateur.id', 'Utilisateur.NOMLONG'),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'conditions'=>$condition));              
        }        
        
/**
 * index method
 *
 * @return void
 */
	public function index() {
            if (isAuthorized('outils', 'index')) :
                $listusers = $this->get_visibility();
                $newcondition = $this->get_restriction($listusers);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));                 
		$this->set('outils', $this->paginate());
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
            if (isAuthorized('outils', 'add')) :           
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Outil->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Outil->create();
			if ($this->Outil->save($this->request->data)) :
				$this->Session->setFlash(__('Outil sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			else :
				$this->Session->setFlash(__('Outil incorrect, veuillez corriger l\'outil',true),'flash_failure');
			endif;
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
            if (isAuthorized('outils', 'edit')) :         
		if (!$this->Outil->exists($id)) {
			throw new NotFoundException(__('Outil incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Outil->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Outil->save($this->request->data)) {
				$this->Session->setFlash(__('Outil sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Outil incorrect, veuillez corriger l\'outil',true),'flash_failure');
			}
                    endif;
		} else {
                    $options = array('conditions' => array('Outil.' . $this->Outil->primaryKey => $id),'recursive'=>0);
                    $this->request->data = $this->Outil->find('first', $options);
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
            if (isAuthorized('outils', 'delete')) :
		$this->Outil->id = $id;
		if (!$this->Outil->exists()) {
			throw new NotFoundException(__('Outil incorrect'));
		}
		if ($this->Outil->delete()) {
			$this->Session->setFlash(__('Outil supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Outil NON supprimé',true),'flash_failure');
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
            if (isAuthorized('outils', 'index')) :
                if(isset($this->params->data['Outil']['SEARCH'])):
                    $keywords = $this->params->data['Outil']['SEARCH'];
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
                        $ornewconditions[] = array('OR'=>array("Outil.NOM LIKE '%".$value."%'","Outil.DESCRIPTION LIKE '%".$value."%'","(CONCAT(Utilisateur.NOM, ' ', Utilisateur.PRENOM)) LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newcondition,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                    $this->set('outils', $this->paginate());     
                else:
                    $this->redirect(array('action'=>'index'));
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        }  
        
        public function get_list_outil(){
            $list = $this->Outil->find('list',array('fields'=>array('id','NOM'),"recursive"=>1));
            return $list;
        }
              
}
