<?php
App::uses('AppController', 'Controller');
App::uses('AssoentiteutilisateursController', 'Controller');
App::uses('EntitesController', 'Controller');
App::uses('BiensController', 'Controller');
/**
 * Cpuses Controller
 *
 * @property Cpus $Cpus
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class CpusesController extends AppController {

    /**
     * Components
     */
    public $paginate = array('limit' => 25,'order'=>array('Cpus.NOM'=>'asc'));
    public $components = array('History','Common');
        
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Processeurs" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }           
        
    /**
     * autorise l'utilisation de certaines méthodes sans authentification
     */
    public function beforeFilter() {   
        $this->Auth->allow(array('json_get_info'));
        parent::beforeFilter();
    }  

    /**
     * retourne le périmètre de visibilité
     * 
     * @return null
     */
    public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            return $ObjAssoentiteutilisateurs->json_get_my_entite(userAuth('id'));
        endif;
    }

    /**
     * applique la restriction du périmétre de visibilité
     * 
     * @param string $visibility
     * @return string
     */
    public function get_restriction($visibility){
        if($visibility == null):
            return '1=1';
        elseif ($visibility!=''):
            return array('OR'=>array('Cpus.entite_id IN ('.$visibility.')','Cpus.entite_id IS NULL'));
        else:
            return array('OR'=>array('Cpus.entite_id ='.userAuth('entite_id'),'Cpus.entite_id IS NULL'));
        endif;
    }

    /**
     * filtre les cpu actif ou non
     * 
     * @param string $id
     * @return string
     */
    public function get_cpu_actif_filter($id){
        $result = array();
        switch($id):
            case null:
            case 1:
                $result['condition']="Cpus.ACTIF=1";
                $result['filter'] = 'actives';
                break;
            case 0:
                $result['condition']="Cpus.ACTIF=0";
                $result['filter'] = 'inactives';
                break;
        endswitch;
        return $result;
    }    

    /**
     * filtre les cpu par entité
     * 
     * @param string $id
     * @param string $visibility
     * @return string
     */
    public function get_cpu_entite_filter($id,$visibility){
        $result = array();
        switch($id):
            case null:
            case 'tous':
                if($visibility == null):
                    $result['condition']='1=1';
                elseif ($visibility!=''):
                    $result['condition']=array('OR'=>array('Cpus.entite_id IN ('.$visibility.')','Cpus.entite_id IS NULL'));
                else:
                    $result['condition']=array('OR'=>array('Cpus.entite_id ='.userAuth('entite_id'),'Cpus.entite_id IS NULL'));
                endif;                      
                $result['filter'] = ' de tous les cercles';
                break;
            default:
                $result['condition']='Cpus.entite_id ='.$id;
                $ObjEntites = new EntitesController();	
                $nom = $ObjEntites->get_entite_nom($id);
                $result['filter'] = 'ayant pour entité '.$nom;
        endswitch;
        return $result;
    }          

    /**
    * liste les cpus
    *
    * @param string $actif
    * @param string $entite
    * @throws UnauthorizedException
    */
    public function index($actif=null,$entite=null) {
        $this->set_title();
        if (isAuthorized('cpuses', 'index')) :
            $visibility = $this->get_visibility();                
            $restriction= $this->get_restriction($visibility);
            $getactif = $this->get_cpu_actif_filter($actif);
            $getentite = $this->get_cpu_entite_filter($entite, $visibility);
            $this->set('strfilter',$getactif['filter'].$getentite['filter']);
            $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));   
            $this->set('cpuses', $this->paginate());
            $ObjEntites = new EntitesController();	
            $cercles = $ObjEntites->get_all();
            $this->set(compact('cercles'));
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }

    /**
     * Ajout de cpu
     *
     * @return void
     */
    public function add() {
        $this->set_title();
        if (isAuthorized('cpuses', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Cpus->validate = array();
                    $this->History->goBack(1);
                else:                    
                    $this->request->data['Cpus']['entite_id']=userAuth('entite_id');
                    $this->Cpus->create();
                    if ($this->Cpus->save($this->request->data)) {
                            $this->Session->setFlash(__('Cpu sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Cpu incorrect, veuillez corriger l\'application',true),'flash_failure');
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
     * Modification du cpu
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $this->set_title();
        if (isAuthorized('cpuses', 'edit')) :            
            if (!$this->Cpus->exists($id)) {
                    throw new NotFoundException(__('CPU incorrect'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Cpus->validate = array();
                    $this->History->goBack(1);
                else:                    
                    if ($this->Cpus->save($this->request->data)) {
                            $this->Session->setFlash(__('Cpu sauvegardé',true),'flash_success');
                            //mise à jour de tous les biens ayant le même CPU
                            $options = array('pass'=>array($id,$this->request->data['Cpus']['PVU']));
                            $ObjBiens = new BiensController();
                            $ObjBiens->ajax_update_cpu($options);
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Cpu incorrect, veuillez corriger l\'application',true),'flash_failure');
                    }
                endif;
            } else {
                $options = array('conditions' => array('Cpus.' . $this->Cpus->primaryKey => $id));
                $this->request->data = $this->Cpus->find('first', $options);
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
     * suppression du cpu
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->set_title();
        if (isAuthorized('cpuses', 'delete')) : 
            $this->Cpus->id = $id;
            if (!$this->Cpus->exists()) {
                    throw new NotFoundException(__('CPU incorrect'));
            }
            if ($this->Cpus->saveField('ACTIF',0)) {
                    $this->Session->setFlash(__('Cpu supprimé',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Cpu <b>NON</b> supprimé',true),'flash_failure');
            }
            $this->History->notmove();
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }

    /**
     * modification du statut actif en dynamique (Ajax)
     */
    public function ajax_actif(){
            $id = $this->request->data('id');
            $this->Cpus->id = $id;
            $obj = $this->Cpus->find('first',array('conditions'=>array('Cpus.id'=>$id),'recursive'=>0));
            $newactif = $obj['Cpus']['ACTIF'] == 1 ? 0 : 1;
            if ($this->Cpus->saveField('ACTIF',$newactif)) {
                    $this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
            }
            exit();
    }

    /**
     * recherche de cpu
     * 
     * @param string $actif
     * @param string $entite
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($actif=null,$entite=null,$keywords=null){
        $this->set_title();
        if (isAuthorized('cpuses', 'index')) :
            if(isset($this->params->data['Cpus']['SEARCH'])):
                $keywords = $this->params->data['Cpus']['SEARCH'];
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
                $getactif = $this->get_cpu_actif_filter($actif);
                $getentite = $this->get_cpu_entite_filter($entite, $visibility);
                $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Cpus.NOM LIKE '%".$value."%'","Cpus.ORDER LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newcondition,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                $this->set('cpuses', $this->paginate());    
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

    /**
     * liste des cpu pour les select
     * 
     * @param string $actif
     * @return array
     */
    public function get_select($actif=1){
        $visibility = $this->get_visibility();                
        $conditions[]= $this->get_restriction($visibility);        
        $conditions[]='Cpus.ACTIF='.$actif;  
        $list = $this->Cpus->find('list',array('fields'=>array('Cpus.id','Cpus.NOM'),'conditions'=>$conditions,'order'=>array('Cpus.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }     

    /**
     * liste des CPU pour les menus
     * 
     * @param string $actif
     * @return string
     */
    public function get_all($actif=1){
        $visibility = $this->get_visibility();                
        $conditions[]= $this->get_restriction($visibility);        
        $conditions[]='Cpus.ACTIF='.$actif;  
        $list = $this->Cpus->find('all',array('conditions'=>$conditions,'order'=>array('Cpus.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }             

    /**
     * trouve un cpu par son nom
     * 
     * @param string $nom
     * @return string
     */
    public function getbynom($nom){
        $this->Cpus->recursive = 0;
        $obj = $this->Cpus->findByNom($nom);
        return $obj;
    }  

    /**
     * trouve les information du cpu
     * 
     * @param string $id
     * @return json
     */
    public function json_get_info($id=null){
        $this->autoRender = false;
        $conditions[] = 'Cpus.id='.$id;
        $obj = $this->Cpus->find('all',array('conditions'=>$conditions,'recursive'=>0));
        $result = json_encode($obj);
        return $result;
    }       
}
