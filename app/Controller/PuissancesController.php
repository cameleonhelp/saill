<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
App::import('Controller', 'Applications');
App::import('Controller', 'Entites');
/**
 * Puissances Controller
 *
 * @property Puissance $Puissance
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class PuissancesController extends AppController {
    /**
     * variables globales utilisées au niveau du controller
     */
    public $paginate = array('limit' => 25,'order'=>array('Puissance.NOM'=>'asc'));
    public $components = array('History','Common');

    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Puissances" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }              

    /**
     * calcul le périmètre de visibilité
     * 
     * @return string
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
     * filtre sur le périmètre de visibilité
     * 
     * @param string $visibility
     * @return string
     */
    public function get_restriction($visibility){
        if($visibility == null):
            return '1=1';
        elseif ($visibility!=''):
            return array('OR'=>array('Puissance.entite_id IN ('.$visibility.')','Puissance.entite_id IS NULL'));
        else:
            return array('OR'=>array('Puissance.entite_id ='.userAuth('entite_id'),'Puissance.entite_id IS NULL'));
        endif;
    }

    /**
     * filtre les puissance sur le statut actif
     * 
     * @param string $id
     * @return string
     */
    public function get_puissance_actif_filter($id){
        $result = array();
        switch($id):
            case null:
            case 1:
                $result['condition']="Puissance.ACTIF=1";
                $result['filter'] = 'actives';
                break;
            case 0:
                $result['condition']="Puissance.ACTIF=0";
                $result['filter'] = 'inactives';
                break;
        endswitch;
        return $result;
    }

    /**
     * filtre les puissances sur les applications
     * 
     * @param string $id
     * @return string
     */
    public function get_puissance_apllication_filter($id){
        $result = array();
        switch($id):
            case null:
            case 'all' :
                $result['condition']="1=1";
                $result['filter'] = ' pour tous les applications';
                break;
            default:
                $result['condition']="Puissance.application_id=".$id;
                $this->Puissance->Application->id = $id;
                $nom = $this->Puissance->Application->read('NOM');
                $result['filter'] = ' pour '.$nom['Application']['NOM'];
                break;
        endswitch;
        return $result;
    }        

    /**
     * filtre les puissance si est considéré comme database
     * 
     * @param string $id
     * @return string
     */
    public function get_puissance_is_database_filter($id){
        $result = array();
        switch($id):
            case null:
            case 0:
                $result['condition']="Puissance.DATABASE=1";
                $result['filter']  = ', qui sont serveur de bases de données';
                break;
            case 1 :
                $result['condition']="Puissance.DATABASE=0";
                $result['filter'] = '';
                break;   
        endswitch;
        return $result;
    }

    /**
     * filtre les puissance si est considéré comme application
     * 
     * @param string $id
     * @return string
     */
    public function get_puissance_is_application_filter($id){
        $result = array();
        switch($id):
            case null:
            case 0:
                $result['condition']="Puissance.APPLICATION=1";
                $result['filter'] = ', qui sont serveurs d\'applications';
                break;
            case 1:
                $result['condition']="Puissance.APPLICATION=0";
                $result['filter'] = '';
                break; 
        endswitch;
        return $result;
    }

    /**
     * filtre les puissances par entité
     * 
     * @param string $id
     * @param string $visibility
     * @return string
     */
    public function get_puissance_entite_filter($id,$visibility){
        $result = array();
        switch($id):
            case null:
            case 'tous':
                if($visibility == null):
                    $result['condition']='1=1';
                elseif ($visibility!=''):
                    $result['condition']=array('OR'=>array('Puissance.entite_id IN ('.$visibility.')','Puissance.entite_id IS NULL'));
                else:
                    $result['condition']=array('OR'=>array('Puissance.entite_id ='.userAuth('entite_id'),'Puissance.entite_id IS NULL'));
                endif;                      
                $result['filter'] = ' de tous les cercles';
                break;
            default:
                $result['condition']='Puissance.entite_id ='.$id;
                $ObjEntites = new EntitesController();
                $nom = $ObjEntites->get_entite_nom($id);
                $result['filter'] = 'ayant pour entité '.$nom;
        endswitch;
        return $result;
    }        

    /**
     * liste les puissances
     * 
     * @param string $actif
     * @param string $application
     * @param string $isDB
     * @param string $isApp
     * @param string $entite
     * @throws UnauthorizedException
     */
    public function index($actif=null,$application=null,$isDB=null,$isApp=null,$entite=null) {
        $this->set_title();            
        if (isAuthorized('puissances', 'index')) :
            $visibility = $this->get_visibility();                
            $restriction= $this->get_restriction($visibility);
            $getactif = $this->get_puissance_actif_filter($actif);
            $getapplication = $this->get_puissance_apllication_filter($application);
            $getisDB = $this->get_puissance_is_database_filter($isDB);
            $getisApp = $this->get_puissance_is_application_filter($isApp);
            $getentite = $this->get_puissance_entite_filter($entite, $visibility);
            $this->set('strfilter',$getactif['filter'].$getapplication['filter'].$getentite['filter'].$getisDB['filter'].$getisApp['filter']);
            $newcondition = array($restriction,$getactif['condition'],$getapplication['condition'],$getentite['condition']); 
            $OR = array('OR'=>array($getisDB['condition'],$getisApp['condition']));
            $newconditions = array_merge($newcondition,$OR);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));                
            $this->set('puissances', $this->paginate());
            $ObjEntites = new EntitesController();
            $ObjApplications = new ApplicationsController();
            $applications = $ObjApplications->get_list(1);
            $cercles = $ObjEntites->get_all();
            $this->set(compact('applications','cercles'));                             
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }

    /**
     * Ajoute une puissance
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        $this->set_title();
        if (isAuthorized('puissances', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Puissance->validate = array();
                    $this->History->goBack(1);
                else:                   
                    $this->request->data['Puissance']['entite_id']=userAuth('entite_id');
                    $this->Puissance->create();
                    if ($this->Puissance->save($this->request->data)) {
                            $this->Session->setFlash(__('Puissance sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Puissance incorrecte, veuillez corriger l\'application',true),'flash_failure');
                    }
                endif;
            endif;
            $ObjEntites = new EntitesController();
            $ObjApplications = new ApplicationsController();
            $applications = $ObjApplications->get_select(1,1);
            $cercles = $ObjEntites->find_list_cercle();
            $this->set(compact('applications','cercles'));              
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }

    /**
     * Met à jour la puissance
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        $this->set_title();
        if (isAuthorized('puissances', 'edit')) :            
            if (!$this->Puissance->exists($id)) {
                    throw new NotFoundException(__('Puissances incorrecte'));
            }              
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Puissance->validate = array();
                    $this->History->goBack(1);
                else:                     
                    if ($this->Puissance->save($this->request->data)) {
                            $this->Session->setFlash(__('Puissance sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Puissance incorrecte, veuillez corriger l\'application',true),'flash_failure');
                    }
                endif;
            } else {
                $options = array('conditions' => array('Puissance.' . $this->Puissance->primaryKey => $id));
                $this->request->data = $this->Puissance->find('first', $options);
                $ObjEntites = new EntitesController();
                $ObjApplications = new ApplicationsController();
                $applications = $ObjApplications->get_select(1,1);
                $cercles = $ObjEntites->find_list_cercle();
                $this->set(compact('applications','cercles'));                          
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * Supprime la puissance
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        $this->set_title();
        if (isAuthorized('puissances', 'delete')) : 
            $this->Puissance->id = $id;
            if (!$this->Puissance->exists()) {
                    throw new NotFoundException(__('Puissances incorrecte'));
            }
            if ($this->Puissance->saveField('ACTIF',0)) {
                    $this->Session->setFlash(__('Puissance supprimée',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Puissance <b>NON</b> supprimée',true),'flash_failure');
            }
            $this->History->notmove();
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }

    /**
     * mise à jour dynamique du statut actif
     */
    public function ajax_actif(){
            $id = $this->request->data('id');
            $this->Puissance->id = $id;
            $obj = $this->Puissance->find('first',array('conditions'=>array('Puissance.id'=>$id),'recursive'=>0));
            $newactif = $obj['Puissance']['ACTIF'] == 1 ? 0 : 1;
            if ($this->Puissance->saveField('ACTIF',$newactif)) {
                    $this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
            }
            exit();
    }

    /**
     * recherche de puissances
     * 
     * @param string $actif
     * @param string $application
     * @param string $isDB
     * @param string $isApp
     * @param string $entite
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($actif=null,$application=null,$isDB=null,$isApp=null,$entite=null,$keywords=null){
        $this->set_title();
        if (isAuthorized('puissances', 'index')) :
            if(isset($this->params->data['Puissance']['SEARCH'])):
                $keywords = $this->params->data['Puissance']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $visibility = $this->get_visibility();                
                $restriction= $this->get_restriction($visibility);
                $getactif = $this->get_puissance_actif_filter($actif);
                $getapplication = $this->get_puissance_apllication_filter($application);
                $getisDB = $this->get_puissance_is_database_filter($isDB);
                $getisApp = $this->get_puissance_is_application_filter($isApp);
                $getentite = $this->get_puissance_entite_filter($entite, $visibility);
                $this->set('strfilter',$getactif['filter'].$getapplication['filter'].$getentite['filter'].$getisDB['filter'].$getisApp['filter']);
                $newcondition = array($restriction,$getactif['condition'],$getapplication['condition'],$getentite['condition']); 
                $OR = array('OR'=>array($getisDB['condition'],$getisApp['condition']));
                $newconditions = array_merge($newcondition,$OR);    
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Puissance.NOM LIKE '%".$value."%'","Puissance.PUISSANCE LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newcondition,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                              
                $this->set('puissances', $this->paginate());
                $ObjEntites = new EntitesController();
                $ObjApplications = new ApplicationsController();
                $applications = $ObjApplications->get_list(1);
                $cercles = $ObjEntites->get_all();
                $this->set(compact('applications','cercles'));                     
            else:
                $this->redirect(array('action'=>'index',$actif,$application,$isDB,$isApp,$entite));
            endif;                   
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;  
    }

    /**
     * renvois la liste des puissances pour les select
     * 
     * @param string $actif
     * @return array
     */
    public function get_select($actif=1){
        $visibility = $this->get_visibility();                
        $conditions[]= $this->get_restriction($visibility);               
        $conditions[] = $actif == null ? '1=1' : 'Puissance.ACTIF='.$actif;  
        $list = $this->Puissance->find('list',array('fields'=>array('Puissance.id','Puissance.NOM'),'conditions'=>$conditions,'order'=>array('Puissance.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }    

    /**
     * renvois la liste des puissances
     * 
     * @param string $actif
     * @return tarrayype
     */
    public function get_list($actif=null){
        $visibility = $this->get_visibility();                
        $conditions[]= $this->get_restriction($visibility);               
        $conditions[] = $actif == null ? '1=1' : 'Puissance.ACTIF='.$actif;  
        $list = $this->Puissance->find('all',array('fields'=>array('Puissance.id','Puissance.NOM'),'conditions'=>$conditions,'order'=>array('Puissance.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }     

    /**
     * renvois la puissance en fonction du nom
     * 
     * @param string $nom
     * @return array
     */
    public function getbynom($nom){
        $this->Puissance->recursive = 0;
        $obj = $this->Puissance->findByNom($nom);
        return $obj;
    }         
}