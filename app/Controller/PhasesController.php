<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
App::import('Controller', 'Entites');
/**
 * Phases Controller
 *
 * @property Phase $Phase
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class PhasesController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Phase.NOM'=>'asc'));
	public $components = array('History','Common');
        
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Phase" : $title;
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
                return array('OR'=>array('Phase.entite_id IN ('.$visibility.')','Phase.entite_id IS NULL'));
            else:
                return array('OR'=>array('Phase.entite_id ='.userAuth('entite_id'),'Phase.entite_id IS NULL'));
            endif;
        }
        
        public function get_phase_actif_filter($id){
            $result = array();
            switch($id):
                case null:
                case 1:
                    $result['condition']="Phase.ACTIF=1";
                    $result['filter'] = 'actives';
                    break;
                case 0:
                    $result['condition']="Phase.ACTIF=0";
                    $result['filter'] = 'inactives';
                    break;
            endswitch;
            return $result;
        }
        
        public function get_phase_entite_filter($id,$visibility){
            $result = array();
            switch($id):
                case null:
                case 'tous':
                    if($visibility == null):
                        $result['condition']='1=1';
                    elseif ($visibility!=''):
                        $result['condition']=array('OR'=>array('Phase.entite_id IN ('.$visibility.')','Phase.entite_id IS NULL'));
                    else:
                        $result['condition']=array('OR'=>array('Phase.entite_id ='.userAuth('entite_id'),'Phase.entite_id IS NULL'));
                    endif;                      
                    $result['filter'] = ' de tous les cercles';
                    break;
                default:
                    $result['condition']='Phase.entite_id ='.$id;
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
            if (isAuthorized('phases', 'index')) :               
                $visibility = $this->get_visibility();                
                $restriction= $this->get_restriction($visibility);
                $getactif = $this->get_phase_actif_filter($actif);
                $getentite = $this->get_phase_entite_filter($entite, $visibility);
                $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));   
		$this->set('phases', $this->paginate());
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
            if (isAuthorized('phases', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Phase->validate = array();
                        $this->History->goBack(1);
                    else:                   
                        $this->request->data['Phase']['entite_id']=userAuth('entite_id');
			$this->Phase->create();
			if ($this->Phase->save($this->request->data)) {
				$this->Session->setFlash(__('Phase sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Phase incorrecte, veuillez corriger l\'application',true),'flash_failure');
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
            if (isAuthorized('phases', 'edit')) :            
		if (!$this->Phase->exists($id)) {
			throw new NotFoundException(__('Phase incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Phase->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Phase->save($this->request->data)) {
				$this->Session->setFlash(__('Phase sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Phase incorrecte, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
                    $options = array('conditions' => array('Phase.' . $this->Phase->primaryKey => $id));
                    $this->request->data = $this->Phase->find('first', $options);
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
            if (isAuthorized('phases', 'delete')) : 
		$this->Phase->id = $id;
		if (!$this->Phase->exists()) {
			throw new NotFoundException(__('Phase incorrecte'));
		}
		if ($this->Phase->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Phase supprimée',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Phase <b>NON</b> supprimée',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Phase->id = $id;
                $obj = $this->Phase->find('first',array('conditions'=>array('Phase.id'=>$id),'recursive'=>0));
                $newactif = $obj['Phase']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Phase->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search($actif=null,$entite=null,$keywords=null){
            if (isAuthorized('phases', 'index')) :
                if(isset($this->params->data['Phase']['SEARCH'])):
                    $keywords = $this->params->data['Phase']['SEARCH'];
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
                    $getactif = $this->get_phase_actif_filter($actif);
                    $getentite = $this->get_phase_entite_filter($entite, $visibility);
                    $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                    $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Phase.NOM LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newcondition,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                    $this->set('phases', $this->paginate());  
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
            $conditions[] = $actif == null ? '1=1' : 'Phase.ACTIF='.$actif;  
            $list = $this->Phase->find('list',array('fields'=>array('Phase.id','Phase.NOM'),'conditions'=>$conditions,'order'=>array('Phase.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }       
        
        public function get_list($actif=null){
            $visibility = $this->get_visibility();                
            $conditions[]= $this->get_restriction($visibility);               
            $conditions[] = $actif == null ? '1=1' : 'Phase.ACTIF='.$actif;  
            $list = $this->Phase->find('all',array('fields'=>array('Phase.id','Phase.NOM'),'conditions'=>$conditions,'order'=>array('Phase.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }     
        
        public function getbynom($nom){
            $this->Phase->recursive = 0;
            $obj = $this->Phase->findByNom($nom);
            return $obj;
        }         
}
