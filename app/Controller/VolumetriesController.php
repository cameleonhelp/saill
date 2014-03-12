<?php
App::uses('AppController', 'Controller');
/**
 * Volumetries Controller
 *
 * @property Volumetry $Volumetry
 * @property PaginatorComponent $Paginator
 */
class VolumetriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Volumetry.NOM'=>'asc'));
	public $components = array('History','Common');

        public function get_visibility(){
            if(userAuth('profil_id')==1):
                return null;
            else:
                return $this->requestAction('assoentiteutilisateurs/json_get_my_entite/'.userAuth('id'));
            endif;
        }
        
        public function get_restriction($visibility){
            if($visibility == null):
                return '1=1';
            elseif ($visibility!=''):
                return array('OR'=>array('Volumetry.entite_id IN ('.$visibility.')','Volumetry.entite_id IS NULL'));
            else:
                return array('OR'=>array('Volumetry.entite_id ='.userAuth('entite_id'),'Volumetry.entite_id IS NULL'));
            endif;
        }
        
        public function get_volumetry_actif_filter($id){
            $result = array();
            switch($id):
                case null:
                case 1:
                    $result['condition']="Volumetry.ACTIF=1";
                    $result['filter'] = 'actives';
                    break;
                case 0:
                    $result['condition']="Volumetry.ACTIF=0";
                    $result['filter'] = 'inactives';
                    break;
            endswitch;
            return $result;
        }
        
        public function get_volumetry_entite_filter($id,$visibility){
            $result = array();
            switch($id):
                case null:
                case 'tous':
                    if($visibility == null):
                        $result['condition']='1=1';
                    elseif ($visibility!=''):
                        $result['condition']=array('OR'=>array('Volumetry.entite_id IN ('.$visibility.')','Volumetry.entite_id IS NULL'));
                    else:
                        $result['condition']=array('OR'=>array('Volumetry.entite_id ='.userAuth('entite_id'),'Volumetry.entite_id IS NULL'));
                    endif;                      
                    $result['filter'] = ' de tous les cercles';
                    break;
                default:
                    $result['condition']='Volumetry.entite_id ='.$id;
                    $nom = $this->requestAction('entites/get_entite_nom/'.$id);
                    $result['filter'] = 'ayant pour entité '.$nom;
            endswitch;
            return $result;
        }        
/**
 * index method
 *
 * @return void
 */
	public function index($actif=null,$entite=null) {
            if (isAuthorized('volumetries', 'index')) :               
                $visibility = $this->get_visibility();                
                $restriction= $this->get_restriction($visibility);
                $getactif = $this->get_volumetry_actif_filter($actif);
                $getentite = $this->get_volumetry_entite_filter($entite, $visibility);
                $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));   
		$this->set('volumetries', $this->paginate());
                $cercles = $this->requestAction('entites/get_all');
                $this->set(compact('cercles'));
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
            $this->set('title_for_layout','Volumétries');
            if (isAuthorized('volumetries', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Volumetry->validate = array();
                        $this->History->goBack(1);
                    else:                     
                        $this->request->data['Volumetry']['entite_id']=userAuth('entite_id');
			$this->Volumetry->create();
			if ($this->Volumetry->save($this->request->data)) {
				$this->Session->setFlash(__('Volumétrie sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Volumétrie incorrecte, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		endif;
                $cercles = $this->requestAction('entites/find_list_cercle');
                $this->set(compact('cercles')); 
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
            $this->set('title_for_layout','Volumétries');
            if (isAuthorized('volumetries', 'edit')) :            
		if (!$this->Volumetry->exists($id)) {
			throw new NotFoundException(__('Volumétrie incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Volumetry->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Volumetry->save($this->request->data)) {
				$this->Session->setFlash(__('Volumétrie sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Volumétrie incorrecte, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
                    $options = array('conditions' => array('Volumetry.' . $this->Volumetry->primaryKey => $id));
                    $this->request->data = $this->Volumetry->find('first', $options);
                    $cercles = $this->requestAction('entites/find_list_cercle');
                    $this->set(compact('cercles'));                     
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
            $this->set('title_for_layout','Volumétries');
            if (isAuthorized('volumetries', 'delete')) : 
		$this->Volumetry->id = $id;
		if (!$this->Volumetry->exists()) {
			throw new NotFoundException(__('Volumétrie incorrecte'));
		}
		if ($this->Volumetry->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Volumétrie supprimée',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Volumétrie <b>NON</b> supprimée',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Volumetry->id = $id;
                $obj = $this->Volumetry->find('first',array('conditions'=>array('Volumetry.id'=>$id),'recursive'=>0));
                $newactif = $obj['Volumetry']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Volumetry->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search($actif=null,$entite=null,$keywords=null){
            if (isAuthorized('volumetries', 'index')) :
                if(isset($this->params->data['Volumetry']['SEARCH'])):
                    $keywords = $this->params->data['Volumetry']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords)); 
                    $visibility = $this->get_visibility();                
                    $restriction= $this->get_restriction($visibility);
                    $getactif = $this->get_volumetry_actif_filter($actif);
                    $getentite = $this->get_volumetry_entite_filter($entite, $visibility);
                    $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                    $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Volumetry.NOM LIKE '%".$value."%'","Volumetry.VALEUR LIKE '%".$value."%'","Volumetry.COMMENTAIRE LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newcondition,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                    $this->set('volumetries', $this->paginate());    
                    $cercles = $this->requestAction('entites/get_all');
                    $this->set(compact('cercles'));                    
                else:
                    $this->redirect(array('action'=>'index',$actif,$entite));
                endif;                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=1){
            $visibility = $this->get_visibility();                
            $conditions[]= $this->get_restriction($visibility);               
            $conditions[] = $actif == null ? '1=1' : 'Volumetry.ACTIF='.$actif;
            $list = $this->Volumetry->find('list',array('fields'=>array('Volumetry.id','Volumetry.NOM'),'conditions'=>$conditions,'order'=>array('Volumetry.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }      
        
        public function get_list($actif=null){
            $visibility = $this->get_visibility();                
            $conditions[]= $this->get_restriction($visibility);               
            $conditions[] = $actif == null ? '1=1' : 'Volumetry.ACTIF='.$actif;
            $list = $this->Volumetry->find('all',array('fields'=>array('Volumetry.id','Volumetry.NOM'),'conditions'=>$conditions,'order'=>array('Volumetry.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }   
        
        public function getbynom($nom){
            $this->Volumetry->recursive = 0;
            $obj = $this->Volumetry->findByNom($nom);
            return $obj;
        }         
}
