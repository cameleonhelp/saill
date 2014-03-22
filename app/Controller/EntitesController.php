<?php
App::uses('AppController', 'Controller');
/**
 * Entites Controller
 *
 * @property Entite $Entite
 * @property PaginatorComponent $Paginator
 */
class EntitesController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $components = array('History','Common');  
        public $paginate = array(
        'limit' => 25,
        'order' => array('Entite.NOM' => 'asc'),
        );
        
        public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:
            return $this->find_str_id_cercle(userAuth('id')); 
        endif;
        }
        
        public function get_cercle($visibility){
            if($visibility == null):
                $result['condition']='1=1';
            elseif ($visibility!=''):
                $result['condition']="Entite.id IN (".$visibility.")";
            else:
                $result['condition']="Entite.id =".userAuth('entite_id');
            endif; 
        }

        public function get_entite_nom($id){
            $obj = $this->Entite->find('first',array('fields'=>array('Entite.NOM'),'conditions'=>array('Entite.id'=>$id),'recursive'=>-1));
            return $obj['Entite']['NOM'];
        }
        
        public function get_all(){
            $visibility = $this->get_visibility();                
            $conditions[]= $this->get_cercle($visibility);        
            $list = $this->Entite->find('all',array('conditions'=>$conditions,'order'=>array('Entite.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }             
/**
 * index method
 *
 * @return void
 */
	public function index() {
            $this->set('title_for_layout','Cercles de visibilité');
            if (isAuthorized('entites', 'index')) :   
                $listentite = $this->get_visibility();
                $getcercle = $this->get_cercle($listentite);
                $newcondition = array($getcercle['condition']);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));
                $this->set('entites', $this->paginate());
                $list_sections = $this->Entite->requestAction('sections/getList');
                $all_utilisateurs = $this->requestAction('utilisateurs/get_list_all_actif');
                $utilisateurs_select = null;
                $count_utilisateurs = 0;
                $all_projets = $this->requestAction(('projets/get_list_actif'));
                $projets_select = $this->requestAction('projets/get_list_projet');  
                $count_projets = 0;
                $this->set(compact('all_utilisateurs','utilisateurs_select','all_projets','projets_select','count_utilisateurs','count_projets','list_sections'));
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
            $this->set('title_for_layout','Cercle de visibilité');
            if (isAuthorized('entites', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Entite->validate = array();
                        $this->History->goBack(1);
                    else:                      
			$this->Entite->create();
			if ($this->Entite->save($this->request->data)) {
				$this->Session->setFlash(__('Cercle de visibilté sauvegardé',true),'flash_success');
				$this->History->goBack(1); 
			} else {
				$this->Session->setFlash(__('Cercle de visibilté incorrect, veuillez corriger le cercle de visibilté',true),'flash_failure');
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
	public function edit($id = null) {
             $this->set('title_for_layout','Cercle de visibilité');
             if (isAuthorized('entites', 'edit')) :
		if (!$this->Entite->exists($id)) {
			throw new NotFoundException(__('Cercle de visibilité invalide'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Entite->validate = array();
                        $this->History->goBack(1);
                    else:                      
                        $this->Entite->id = $id;
			if ($this->Entite->save($this->request->data)) {
				$this->Session->setFlash(__('Cercle de visibilté sauvegardé',true),'flash_success');
				$this->History->goBack(1); 
			} else {
				$this->Session->setFlash(__('Cercle de visibilté incorrect, veuillez corriger le cercle de visibilté',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Entite.' . $this->Entite->primaryKey => $id));
			$this->request->data = $this->Entite->find('first', $options);
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
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
            $this->set('title_for_layout','Cercle de visibilité');
            if (isAuthorized('entites', 'delete')) :                
		$this->Entite->id = $id;
		if (!$this->Entite->exists()) {
			throw new NotFoundException(__('Cercle de visibilité invalide'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Entite->delete()) {
			$this->Session->setFlash(__('Cercle de visibilté supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Cercle de visibilté <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->goBack(1); 
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}

        public function find_all_cercle($utilisateur_id=null){
            $tmp = $utilisateur_id != null ? $this->requestAction('assoentiteutilisateurs/json_get_my_entite/'.$utilisateur_id) : $this->requestAction('assoentiteutilisateurs/json_get_my_entite');
            $conditions = array();
            $conditions[]=array('Entite.id IN ('.$tmp.')');
            $order = array();
            $order[]=array('Entite.NOM'=>'asc');
            $list = $this->Entite->find('all',array('order'=>$order,'conditions'=>$conditions,'recursive'=>1));
            return $list;
        }
        
        public function find_all_cercle_not_empty($utilisateur=null){
            $tmp = $utilisateur != null ? $this->requestAction('assoentiteutilisateurs/json_get_my_entite/'.$utilisateur) : $this->requestAction('assoentiteutilisateurs/json_get_my_entite');
            $sql = "select Entite.*, count(assoentiteutilisateurs.id) AS ASSO FROM entites AS Entite
                    left join assoentiteutilisateurs on Entite.id = assoentiteutilisateurs.entite_id
                    WHERE Entite.ACTIF = 1
                    AND Entite.id IN (".$tmp.")
                    group by assoentiteutilisateurs.entite_id";
            $cercles = $this->Entite->query($sql);
            foreach ($cercles as $cercle):
                if ($cercle[0]['ASSO'] != 0):
                    $result[]['Entite'] = $cercle['Entite'];
                endif;
            endforeach;
            return $result;
        }
        
        public function find_str_id_cercle($utilisateur_id){
            $tmp = $this->requestAction("assoentiteutilisateurs/json_get_my_entite/".$utilisateur_id);
            $conditions = array();  
            $conditions[]=array('Entite.id IN ('.$tmp.')');
            $order = array();
            $order[]=array('Entite.id'=>'asc');
            $objs = $this->Entite->find('all',array('order'=>$order,'conditions'=>$conditions,'recursive'=>1));
            $list = '';
            if(count($objs) > 0):
                foreach($objs as $obj):
                    $list .= $obj['Entite']['id'].",";
                endforeach;
                return substr_replace($list ,"",-1);
            else :
                return '0';
            endif;
        } 
        
        public function find_list_cercle($utilisateur_id=null){
            if(userAuth('profil_id')==1):
                $conditions[]=array('1=1');
                $order[]=array('Entite.NOM'=>'asc');
                $fields = array('Entite.id','Entite.NOM');
            else:            
                $tmp = $utilisateur_id != null ? $this->requestAction('assoentiteutilisateurs/json_get_my_entite/'.$utilisateur_id) : $this->requestAction('assoentiteutilisateurs/json_get_my_entite');
                $conditions[]=array('Entite.id IN ('.$tmp.')');
                $order[]=array('Entite.NOM'=>'asc');
                $fields = array('Entite.id','Entite.NOM');
            endif;
            $list = $this->Entite->find('list',array('fields'=>$fields,'order'=>$order,'conditions'=>$conditions,'recursive'=>1));
            return $list;
        } 
        
        public function find_list_all_actif_cercle(){
            $conditions = array();
            $conditions[]=array('Entite.ACTIF'=>1);
            $order = array();
            $order[]=array('Entite.NOM'=>'asc');
            $fields = array('Entite.id','Entite.NOM');
            $list = $this->Entite->find('list',array('fields'=>$fields,'order'=>$order,'conditions'=>$conditions,'recursive'=>1));
            return $list;
        }   
        
	public function search($keywords=null) {
            $this->set('title_for_layout','Cercles de visibilité');
            if (isAuthorized('entites', 'index')) :
                if(isset($this->params->data['Autorisation']['SEARCH'])):
                    $keywords = $this->params->data['Autorisation']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords));                 
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Entite.NOM LIKE '%".$value."%'","Entite.COMMENTAIRE LIKE '%".$value."%'"));     
                    endforeach;
                    $listentite = $this->get_visibility();
                    $getcercle = $this->get_cercle($listentite);
                    $newcondition = array($getcercle['condition']);
                    $list_sections = $this->Entite->requestAction('sections/getList');
                    $all_utilisateurs = $this->requestAction('utilisateurs/get_list_all_actif');
                    $utilisateurs_select = null;
                    $count_utilisateurs = 0;
                    $all_projets = $this->requestAction(('projets/get_list_actif'));
                    $projets_select = $this->requestAction('projets/get_list_projet');  
                    $count_projets = 0;
                    $this->set(compact('all_utilisateurs','utilisateurs_select','all_projets','projets_select','count_utilisateurs','count_projets','list_sections'));                    
                    $conditions = array($newcondition,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions));        
                    $this->set('entites', $this->paginate());          
                else:
                    $this->redirect(array('action'=>'index'));
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        }          
}
