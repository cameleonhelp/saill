<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
App::import('Controller', 'Entites');
/**
 * Types Controller
 *
 * @property Type $Type
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class TypesController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Type.NOM'=>'asc'));
	public $components = array('History','Common');

    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Type d'environnement" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }         
        
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
                return array('OR'=>array('Type.entite_id IN ('.$visibility.')','Type.entite_id IS NULL'));
            else:
                return array('OR'=>array('Type.entite_id ='.userAuth('entite_id'),'Type.entite_id IS NULL'));
            endif;
        }
        
        public function get_type_actif_filter($id){
            $result = array();
            switch($id):
                case null:
                case 1:
                    $result['condition']="Type.ACTIF=1";
                    $result['filter'] = 'actives';
                    break;
                case 0:
                    $result['condition']="Type.ACTIF=0";
                    $result['filter'] = 'inactives';
                    break;
            endswitch;
            return $result;
        }
        
        public function get_type_entite_filter($id,$visibility){
            $result = array();
            switch($id):
                case null:
                case 'tous':
                    if($visibility == null):
                        $result['condition']='1=1';
                    elseif ($visibility!=''):
                        $result['condition']=array('OR'=>array('Type.entite_id IN ('.$visibility.')','Type.entite_id IS NULL'));
                    else:
                        $result['condition']=array('OR'=>array('Type.entite_id ='.userAuth('entite_id'),'Type.entite_id IS NULL'));
                    endif;                      
                    $result['filter'] = ' de tous les cercles';
                    break;
                default:
                    $result['condition']='Type.entite_id ='.$id;
                    $ObjEntites = new EntitesController();	
                    $ObjEntites = new EntitesController();	
                    $nom =$ObjEntites->get_entite_nom($id);
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
            $this->set_title();
            if (isAuthorized('types', 'index')) :               
                $visibility = $this->get_visibility();                
                $restriction= $this->get_restriction($visibility);
                $getactif = $this->get_type_actif_filter($actif);
                $getentite = $this->get_type_entite_filter($entite, $visibility);
                $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));   
		$this->set('types', $this->paginate());
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
            $this->set_title();
            if (isAuthorized('types', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Type->validate = array();
                        $this->History->goBack(1);
                    else:              
                        $this->request->data['Type']['entite_id']=userAuth('entite_id');
			$this->Type->create();
			if ($this->Type->save($this->request->data)) {
				$this->Session->setFlash(__('Type d\'environnement sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Type d\'environnement incorrect, veuillez corriger le type d\'environnement',true),'flash_failure');
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
            $this->set_title();
            if (isAuthorized('types', 'edit')) :            
		if (!$this->Type->exists($id)) {
			throw new NotFoundException(__('Type d\'environnement incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Type->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Type->save($this->request->data)) {
				$this->Session->setFlash(__('Type d\'environnement sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Type d\'environnement incorrect, veuillez corriger le type d\'environnement',true),'flash_failure');
			}
                    endif;
		} else {
                    $options = array('conditions' => array('Type.' . $this->Type->primaryKey => $id));
                    $this->request->data = $this->Type->find('first', $options);
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
            $this->set_title();
            if (isAuthorized('types', 'delete')) : 
		$this->Type->id = $id;
		if (!$this->Type->exists()) {
			throw new NotFoundException(__('Type d\'environnement incorrect'));
		}
		if ($this->Type->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Type d\'environnement supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Type d\'environnement <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Type->id = $id;
                $obj = $this->Type->find('first',array('conditions'=>array('Type.id'=>$id),'recursive'=>0));
                $newactif = $obj['Type']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Type->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search($actif=null,$entite=null,$keywords=null){
            $this->set_title();
            if (isAuthorized('types', 'index')) :
                if(isset($this->params->data['Type']['SEARCH'])):
                    $keywords = $this->params->data['Type']['SEARCH'];
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
                    $getactif = $this->get_type_actif_filter($actif);
                    $getentite = $this->get_type_entite_filter($entite, $visibility);
                    $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                    $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Type.NOM LIKE '%".$value."%'","Type.ORDER LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newcondition,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                    $this->set('types', $this->paginate());  
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
            $conditions[] = $actif == null ? '1=1' : 'Type.ACTIF='.$actif;               
            $list = $this->Type->find('list',array('fields'=>array('Type.id','Type.NOM'),'conditions'=>$conditions,'order'=>array('Type.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }        
        
        public function get_list($actif=null){
            $visibility = $this->get_visibility();                
            $conditions[]= $this->get_restriction($visibility);               
            $conditions[] = $actif == null ? '1=1' : 'Type.ACTIF='.$actif;  
            $list = $this->Type->find('all',array('fields'=>array('Type.id','Type.NOM'),'conditions'=>$conditions,'order'=>array('Type.NOM'=>'asc'),'recursive'=>-1));
            return $list;
        }    
        
        public function getbynom($nom){
            $this->Type->recursive = 0;
            $obj = $this->Type->findByNom($nom);
            return $obj;
        }           
}
