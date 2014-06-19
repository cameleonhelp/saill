<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
App::import('Controller', 'Entites');
/**
 * Localites Controller
 *
 * @property Localite $Localite
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class LocalitesController extends AppController {
    /**
     * variables globales utilisées au niveau du controller
     */
    public $paginate = array('limit' => 25,'order'=>array('Localite.NOM'=>'asc'));
    public $components = array('History','Common');

    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Localité" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }              
        
    /**
     * récupère le périmètre de visibilité de l'utilisateur
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
     * Applique la restriction sur le périmètre de visibilité
     * 
     * @param string $visibility
     * @return string
     */
    public function get_restriction($visibility){
        if($visibility == null):
            return '1=1';
        elseif ($visibility!=''):
            return array('OR'=>array('Localite.entite_id IN ('.$visibility.')','Localite.entite_id IS NULL'));
        else:
            return array('OR'=>array('Localite.entite_id ='.userAuth('entite_id'),'Localite.entite_id IS NULL'));
        endif;
    }

    /**
     * filtre la localité en fonction de l'état
     * 
     * @param string $id
     * @return string
     */
    public function get_localite_actif_filter($id){
        $result = array();
        switch($id):
            case null:
            case 1:
                $result['condition']="Localite.ACTIF=1";
                $result['filter'] = 'actives';
                break;
            case 0:
                $result['condition']="Localite.ACTIF=0";
                $result['filter'] = 'inactives';
                break;
        endswitch;
        return $result;
    }

    /**
     * filtre les localité par entité
     * 
     * @param string $id
     * @param string $visibility
     * @return string
     */
    public function get_loclaite_entite_filter($id,$visibility){
        $result = array();
        switch($id):
            case null:
            case 'tous':
                if($visibility == null):
                    $result['condition']='1=1';
                elseif ($visibility!=''):
                    $result['condition']=array('OR'=>array('Localite.entite_id IN ('.$visibility.')','Localite.entite_id IS NULL'));
                else:
                    $result['condition']=array('OR'=>array('Localite.entite_id ='.userAuth('entite_id'),'Localite.entite_id IS NULL'));
                endif;                      
                $result['filter'] = ' de tous les cercles';
                break;
            default:
                $result['condition']='Localite.entite_id ='.$id;
                $ObjEntites = new EntitesController();	
                $nom = $ObjEntites->get_entite_nom($id);
                $result['filter'] = 'ayant pour entité '.$nom;
        endswitch;
        return $result;
    }    

    /**
     * liste les localités
     * 
     * @param string $actif
     * @param string $entite
     * @throws UnauthorizedException
     */
    public function index($actif=null,$entite=null) {
        $this->set_title();
        if (isAuthorized('localites', 'index')) :
            $visibility = $this->get_visibility();                
            $restriction= $this->get_restriction($visibility);
            $getactif = $this->get_localite_actif_filter($actif);
            $getentite = $this->get_loclaite_entite_filter($entite, $visibility);
            $this->set('strfilter',$getactif['filter'].$getentite['filter']);
            $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));   
            $this->set('localites', $this->paginate());
            $ObjEntites = new EntitesController();	
            $cercles = $ObjEntites->get_all();
            $this->set(compact('cercles'));
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }
          
    /**
     * ajoute une localité
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        $this->set_title();
        if (isAuthorized('localites', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Localite->validate = array();
                    $this->History->goBack(1);
                else:                    
                    $this->request->data['Localite']['entite_id']=userAuth('entite_id');
                    $this->Localite->create();
                    if ($this->Localite->save($this->request->data)) {
                            $this->Session->setFlash(__('Localité sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Localité incorrecte, veuillez corriger l\'application',true),'flash_failure');
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
     * met à jour une localité
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        $this->set_title();
        if (isAuthorized('localites', 'edit')) :            
            if (!$this->Localite->exists($id)) {
                    throw new NotFoundException(__('Localité incorrecte'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Localite->validate = array();
                    $this->History->goBack(1);
                else:                    
                    if ($this->Localite->save($this->request->data)) {
                            $this->Session->setFlash(__('Localité sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Localité incorrecte, veuillez corriger l\'application',true),'flash_failure');
                    }
                endif;
            } else {
                $options = array('conditions' => array('Localite.' . $this->Localite->primaryKey => $id));
                $this->request->data = $this->Localite->find('first', $options);
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
     * supprime une localité
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        $this->set_title();
        if (isAuthorized('localites', 'delete')) : 
            $this->Localite->id = $id;
            if (!$this->Localite->exists()) {
                    throw new NotFoundException(__('Localité incorrecte'));
            }
            if ($this->Localite->saveField('ACTIF',0)) {
                    $this->Session->setFlash(__('Localité supprimée',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Localité <b>NON</b> supprimée',true),'flash_failure');
            }
            $this->History->notmove();
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }

    /**
     * changement dynamique de l'état
     */
    public function ajax_actif(){
            $id = $this->request->data('id');
            $this->Localite->id = $id;
            $obj = $this->Localite->find('first',array('conditions'=>array('Localite.id'=>$id),'recursive'=>0));
            $newactif = $obj['Localite']['ACTIF'] == 1 ? 0 : 1;
            if ($this->Localite->saveField('ACTIF',$newactif)) {
                    $this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
            }
            exit();
    }

    /**
     * recherche de localité
     * 
     * @param string $actif
     * @param string $entite
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function  search($actif=null,$entite=null,$keywords=null){
        $this->set_title();
        if (isAuthorized('localites', 'index')) :
            if(isset($this->params->data['Localite']['SEARCH'])):
                $keywords = $this->params->data['Localite']['SEARCH'];
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
                $getactif = $this->get_localite_actif_filter($actif);
                $getentite = $this->get_loclaite_entite_filter($entite, $visibility);
                $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Localite.NOM LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newcondition,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                $this->set('etats', $this->paginate());
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
     * renvois la liste des localités pour un select
     * 
     * @param string $actif
     * @return array
     */
    public function get_select($actif=1){
        $visibility = $this->get_visibility();                
        $conditions[]= $this->get_restriction($visibility);               
        $conditions[] = $actif == null ? '1=1' : 'Localite.ACTIF='.$actif;               
        $list = $this->Localite->find('list',array('fields'=>array('Localite.id','Localite.NOM'),'conditions'=>$conditions,'order'=>array('Localite.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }      

    /**
     * renvois la liste des localités
     * 
     * @param string $actif
     * @return array
     */
    public function get_list($actif=1){
        $visibility = $this->get_visibility();                
        $conditions[]= $this->get_restriction($visibility);               
        $conditions[] = $actif == null ? '1=1' : 'Localite.ACTIF='.$actif;                
        $list = $this->Localite->find('all',array('fields'=>array('Localite.id','Localite.NOM'),'conditions'=>$conditions,'recursive'=>0));
        return $list;
    }            
}
