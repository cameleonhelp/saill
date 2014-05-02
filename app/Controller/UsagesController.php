<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
App::import('Controller', 'Entites');
/**
 * Usages Controller
 *
 * @property Usage $Usage
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class UsagesController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Usage.NOM'=>'asc'));
	public $components = array('History','Common');

        public function get_visibility(){
            if(userAuth('profil_id')==1):
                return null;
            else:
                $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
                return $ObjAssoentiteutilisateurs->json_get_my_entite(userAuth('id'));
            endif;
        }
        
        public function get_restriction($visibility){
            if($visibility == null):
                return '1=1';
            elseif ($visibility!=''):
                return array('OR'=>array('Usage.entite_id IN ('.$visibility.')','Usage.entite_id IS NULL'));
            else:
                return array('OR'=>array('Usage.entite_id ='.userAuth('entite_id'),'Usage.entite_id IS NULL'));
            endif;
        }
        
        public function get_usage_actif_filter($id){
            $result = array();
            switch($id):
                case null:
                case 1:
                    $result['condition']="Usage.ACTIF=1";
                    $result['filter'] = 'actives';
                    break;
                case 0:
                    $result['condition']="Usage.ACTIF=0";
                    $result['filter'] = 'inactives';
                    break;
            endswitch;
            return $result;
        }
        
        public function get_usage_entite_filter($id,$visibility){
            $result = array();
            switch($id):
                case null:
                case 'tous':
                    if($visibility == null):
                        $result['condition']='1=1';
                    elseif ($visibility!=''):
                        $result['condition']=array('OR'=>array('Usage.entite_id IN ('.$visibility.')','Usage.entite_id IS NULL'));
                    else:
                        $result['condition']=array('OR'=>array('Usage.entite_id ='.userAuth('entite_id'),'Usage.entite_id IS NULL'));
                    endif;                      
                    $result['filter'] = ' de tous les cercles';
                    break;
                default:
                    $result['condition']='Usage.entite_id ='.$id;
                    $ObjEntites = new EntitesController();	
                    $ObjEntites = new EntitesController();	
                    $nom = $ObjEntites->get_entite_nom($id);
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
            if (isAuthorized('usages', 'index')) :               
                $visibility = $this->get_visibility();                
                $restriction= $this->get_restriction($visibility);
                $getactif = $this->get_usage_actif_filter($actif);
                $getentite = $this->get_usage_entite_filter($entite, $visibility);
                $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));   
		$this->set('usages', $this->paginate());
                $ObjEntites = new EntitesController();	
                $cercles = $ObjEntites->get_all();
                $this->set(compact('cercles'));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                 
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('usages', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Usage->validate = array();
                        $this->History->goBack(1);
                    else:               
                        $this->request->data['Usage']['entite_id']=userAuth('entite_id');
			$this->Usage->create();
			if ($this->Usage->save($this->request->data)) {
				$this->Session->setFlash(__('Usage sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Usage incorrect, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		endif;
                $ObjEntites = new EntitesController();	
                $cercles = $ObjEntites->find_list_cercle();
                $this->set(compact('cercles'));   
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
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
            if (isAuthorized('usages', 'edit')) :            
		if (!$this->Usage->exists($id)) {
			throw new NotFoundException(__('Usage incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Usage->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Usage->save($this->request->data)) {
				$this->Session->setFlash(__('Usage sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Usage incorrect, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
                    $options = array('conditions' => array('Usage.' . $this->Usage->primaryKey => $id));
                    $this->request->data = $this->Usage->find('first', $options);
                    $ObjEntites = new EntitesController();	
                    $cercles = $ObjEntites->find_list_cercle();
                    $this->set(compact('cercles'));                       
		}
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
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
            if (isAuthorized('usages', 'delete')) : 
		$this->Usage->id = $id;
		if (!$this->Usage->exists()) {
			throw new NotFoundException(__('Usage incorrect'));
		}
		if ($this->Usage->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Usage supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Usage <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Usage->id = $id;
                $obj = $this->Usage->find('first',array('conditions'=>array('Usage.id'=>$id),'recursive'=>0));
                $newactif = $obj['Usage']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Usage->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search($actif=null,$entite=null,$keywords=null){
            if (isAuthorized('usages', 'index')) :
                if(isset($this->params->data['Usage']['SEARCH'])):
                    $keywords = $this->params->data['Usage']['SEARCH'];
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
                    $getactif = $this->get_usage_actif_filter($actif);
                    $getentite = $this->get_usage_entite_filter($entite, $visibility);
                    $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                    $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Usage.NOM LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newcondition,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                    $this->set('usages', $this->paginate()); 
                    $ObjEntites = new EntitesController();	
                    $cercles = $ObjEntites->get_all();
                    $this->set(compact('cercles'));                    
                else:
                    $this->redirect(array('action'=>'index',$actif,$entite));
                endif;                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;  
        }
        
        public function get_select($actif=1){
            $visibility = $this->get_visibility();                
            $conditions[]= $this->get_restriction($visibility);               
            $conditions[] = $actif == null ? '1=1' : 'Usage.ACTIF='.$actif; 
            $list = $this->Usage->find('list',array('fields'=>array('Usage.id','Usage.NOM'),'conditions'=>$conditions,'order'=>array('Usage.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }  
        
        public function get_list($actif=null){
            $visibility = $this->get_visibility();                
            $conditions[]= $this->get_restriction($visibility);               
            $conditions[] = $actif == null ? '1=1' : 'Usage.ACTIF='.$actif; 
            $list = $this->Usage->find('all',array('fields'=>array('Usage.id','Usage.NOM'),'conditions'=>$conditions,'order'=>array('Usage.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }       
        
        public function getbynom($nom){
            $this->Usage->recursive = 0;
            $obj = $this->Usage->findByNom($nom);
            return $obj;
        }             
}   