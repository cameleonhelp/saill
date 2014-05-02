<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Envversions');
App::import('Controller', 'Entites');
App::import('Controller', 'Assoentiteutilisateurs');
/**
 * Envoutils Controller
 *
 * @property Envoutil $Envoutil
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class EnvoutilsController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Envoutil.NOM'=>'asc'));
	public $components = array('History','Common');
        
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Outils (Logiciels, Système d'exploitation)" : $title;
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
                return array('OR'=>array('Envoutil.entite_id IN ('.$visibility.')','Envoutil.entite_id IS NULL'));
            else:
                return array('OR'=>array('Envoutil.entite_id ='.userAuth('entite_id'),'Envoutil.entite_id IS NULL'));
            endif;
        }
        
        public function get_envoutil_actif_filter($id){
            $result = array();
            switch($id):
                case null:
                case 1:
                    $result['condition']="Envoutil.ACTIF=1";
                    $result['filter'] = 'actives';
                    break;
                case 0:
                    $result['condition']="Envoutil.ACTIF=0";
                    $result['filter'] = 'inactives';
                    break;
            endswitch;
            return $result;
        }
        
        public function get_envoutil_os_filter($id){
            $result = array();
            switch($id):
                    case null:                    
                    case 3:
                        $result['condition']="1=1";
                        $result['filter'] = ' qui sont des OS ou des logiciels';
                        break; 
                    case 1:
                        $result['condition']="Envoutil.OS=1";
                        $result['filter'] = ' qui sont des OS';
                        break;
                    case 0:
                        $result['condition']="Envoutil.OS=0";
                        $result['filter'] = ' qui sont des logiciels';
                        break;
                endswitch;   
            return $result;
        }
        
        public function get_envoutil_entite_filter($id,$visibility){
            $result = array();
            switch($id):
                case null:
                case 'tous':
                    if($visibility == null):
                        $result['condition']='1=1';
                    elseif ($visibility!=''):
                        $result['condition']=array('OR'=>array('Envoutil.entite_id IN ('.$visibility.')','Envoutil.entite_id IS NULL'));
                    else:
                        $result['condition']=array('OR'=>array('Envoutil.entite_id ='.userAuth('entite_id'),'Envoutil.entite_id IS NULL'));
                    endif;                      
                    $result['filter'] = ' de tous les cercles';
                    break;
                default:
                    $result['condition']='Envoutil.entite_id ='.$id;
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
	public function index($actif=null,$os=null,$entite=null) {
            $this->set_title();
            if (isAuthorized('envoutils', 'index')) :
                $visibility = $this->get_visibility();                
                $restriction= $this->get_restriction($visibility);
                $getactif = $this->get_envoutil_actif_filter($actif);
                $getos = $this->get_envoutil_os_filter($os);
                $getentite = $this->get_envoutil_entite_filter($entite, $visibility);
                $this->set('strfilter',$getactif['filter'].$getos['filter'].$getentite['filter']);
                $newcondition = array($restriction,$getactif['condition'],$getos['condition'],$getentite['condition']);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));   
		$this->set('envoutils', $this->paginate());
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
            if (isAuthorized('envoutils', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Envoutil->validate = array();
                        $this->History->goBack(1);
                    else:                
                        $this->request->data['Envoutil']['entite_id']=userAuth('entite_id');
			$this->Envoutil->create();
			if ($this->Envoutil->save($this->request->data)) {
				$this->Session->setFlash(__('Outils sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Outils incorrect, veuillez corriger l\'application',true),'flash_failure');
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
            if (isAuthorized('envoutils', 'edit')) :            
		if (!$this->Envoutil->exists($id)) {
			throw new NotFoundException(__('Outils incorrect'));
		}
                $ObjEnvversions = new EnvversionsController();
                $versions = $ObjEnvversions->get_version_for($id,1);                  
                $this->set('envversions',$versions);                
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Envoutil->validate = array();
                        $this->History->goBack(2);
                    else:                    
			if ($this->Envoutil->save($this->request->data)) {
				$this->Session->setFlash(__('Outils sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Outils incorrect, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
                    $options = array('conditions' => array('Envoutil.' . $this->Envoutil->primaryKey => $id));
                    $this->request->data = $this->Envoutil->find('first', $options);
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
            if (isAuthorized('envoutils', 'delete')) : 
		$this->Envoutil->id = $id;
		if (!$this->Envoutil->exists()) {
			throw new NotFoundException(__('Outils incorrect'));
		}
		if ($this->Envoutil->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Outils supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Outils <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Envoutil->id = $id;
                $obj = $this->Envoutil->find('first',array('conditions'=>array('Envoutil.id'=>$id),'recursive'=>0));
                $newactif = $obj['Envoutil']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Envoutil->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search($actif=null,$os=null,$entite=null,$keywords=null){
            $this->set_title();
            if (isAuthorized('envoutils', 'index')) :
                if(isset($this->params->data['Envoutil']['SEARCH'])):
                    $keywords = $this->params->data['Envoutil']['SEARCH'];
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
                    $getactif = $this->get_envoutil_actif_filter($actif);
                    $getos = $this->get_envoutil_os_filter($os);
                    $getentite = $this->get_envoutil_entite_filter($entite, $visibility);
                    $this->set('strfilter',$getactif['filter'].$getos['filter'].$getentite['filter']);
                    $newcondition = array($restriction,$getactif['condition'],$getos['condition'],$getentite['condition']);
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Envoutil.NOM LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newcondition,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                    $this->set('envoutils', $this->paginate());    
                    $ObjEntites = new EntitesController();
                    $cercles = $ObjEntites->get_all();  
                    $this->set(compact('cercles'));                    
                else:
                    $this->redirect(array('action'=>'index',$actif,$os,$entite));
                endif; 
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;  
        }
        
        public function get_list_os($actif=1){
            $list = $this->Envoutil->find('all',array('conditions'=>array('Envoutil.ACTIF'=>$actif,'Envoutil.OS'=>1),'recursive'=>0));
            return $list;
        }
        
        public function get_list($actif=null){
            $visibility = $this->get_visibility();                
            $conditions[]= $this->get_restriction($visibility);               
            $conditions[] = $actif == null ? '1=1' : 'Envoutil.ACTIF='.$actif; 
            $list = $this->Envoutil->find('all',array('conditions'=>$conditions,'order'=>array('Envoutil.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }
        
        public function get_list_software($actif=1){
            $visibility = $this->get_visibility();                
            $conditions[]= $this->get_restriction($visibility);               
            $conditions[] = $actif == null ? '1=1' : 'Envoutil.ACTIF='.$actif;           
            $list = $this->Envoutil->find('all',array('conditions'=>array('Envoutil.ACTIF'=>$actif,'Envoutil.OS'=>0,$condition),'recursive'=>0));
            return $list;
        }  

        public function get_select($actif=null){
            $visibility = $this->get_visibility();                
            $conditions[]= $this->get_restriction($visibility);               
            $conditions[] = $actif == null ? '1=1' : 'Envoutil.ACTIF='.$actif; 
            $list = $this->Envoutil->find('list',array('fields'=>array('Envoutil.id','Envoutil.NOM'),'conditions'=>$conditions,'order'=>array('Envoutil.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }
        
        public function get_select_os($actif=1){
            $visibility = $this->get_visibility();                
            $conditions[]= $this->get_restriction($visibility);               
            $conditions[] = $actif == null ? '1=1' : 'Envoutil.ACTIF='.$actif;        
            $conditions = array_merge($conditions,array('Envoutil.OS'=>1));
            $list = $this->Envoutil->find('list',array('fields'=>array('Envoutil.id','Envoutil.NOM'),'conditions'=>$conditions,'order'=>array('Envoutil.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }
        
        public function get_select_software($actif=1){
            $visibility = $this->get_visibility();                
            $conditions[]= $this->get_restriction($visibility);               
            $conditions[] = $actif == null ? '1=1' : 'Envoutil.ACTIF='.$actif; 
            $conditions = array_merge($conditions,array('Envoutil.OS'=>1));
            $list = $this->Envoutil->find('list',array('fields'=>array('Envoutil.id','Envoutil.NOM'),'conditions'=>$conditions,'order'=>array('Envoutil.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }  

        public function getbynom($nom){
            $this->Envoutil->recursive = 0;
            $obj = $this->Envoutil->findByNom($nom);
            return $obj;
        }        
}
