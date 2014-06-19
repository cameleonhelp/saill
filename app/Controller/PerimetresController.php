<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
App::import('Controller', 'Entites');
/**
 * Perimetres Controller
 *
 * @property Perimetre $Perimetre
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class PerimetresController extends AppController {
    /**
     * Variables globales utilisées au niveau du controller
     */
    public $paginate = array('limit' => 25,'order'=>array('Perimetre.NOM'=>'asc'));
    public $components = array('History','Common');

    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Périmètres" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }              

    /**
     * calcule le périmètre de visibilité de l'utilisateur
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
     * renvois le filtre permettant de réduire le périmètre de visibilité
     * 
     * @param string $visibility
     * @return string
     */
    public function get_restriction($visibility){
        if($visibility == null):
            return '1=1';
        elseif ($visibility!=''):
            return array('OR'=>array('Perimetre.entite_id IN ('.$visibility.')','Perimetre.entite_id IS NULL'));
        else:
            return array('OR'=>array('Perimetre.entite_id ='.userAuth('entite_id'),'Perimetre.entite_id IS NULL'));
        endif;
    }

    /**
     * filtre le périmetre par le statut actif
     * 
     * @param string $id
     * @return string
     */
    public function get_perimetre_actif_filter($id){
        $result = array();
        switch($id):
            case null:
            case 1:
                $result['condition']="Perimetre.ACTIF=1";
                $result['filter'] = 'actives';
                break;
            case 0:
                $result['condition']="Perimetre.ACTIF=0";
                $result['filter'] = 'inactives';
                break;
        endswitch;
        return $result;
    }

    /**
     * filtre le périmètre par l'entité
     * 
     * @param string $id
     * @param string $visibility
     * @return string
     */
    public function get_perimetre_entite_filter($id,$visibility){
        $result = array();
        switch($id):
            case null:
            case 'tous':
                if($visibility == null):
                    $result['condition']='1=1';
                elseif ($visibility!=''):
                    $result['condition']=array('OR'=>array('Perimetre.entite_id IN ('.$visibility.')','Perimetre.entite_id IS NULL'));
                else:
                    $result['condition']=array('OR'=>array('Perimetre.entite_id ='.userAuth('entite_id'),'Perimetre.entite_id IS NULL'));
                endif;                      
                $result['filter'] = ' de tous les cercles';
                break;
            default:
                $result['condition']='Perimetre.entite_id ='.$id;
                $ObjEntites = new EntitesController();
                $nom = $ObjEntites->get_entite_nom($id); 
                $result['filter'] = 'ayant pour entité '.$nom;
        endswitch;
        return $result;
    }                

    /**
     * liste des périmètres
     * 
     * @param string $actif
     * @param string $entite
     * @throws UnauthorizedException
     */
    public function index($actif=null,$entite=null) {
        $this->set_title();
        if (isAuthorized('perimetres', 'index')) :
            $visibility = $this->get_visibility();                
            $restriction= $this->get_restriction($visibility);
            $getactif = $this->get_perimetre_actif_filter($actif);
            $getentite = $this->get_perimetre_entite_filter($entite, $visibility);
            $this->set('strfilter',$getactif['filter'].$getentite['filter']);
            $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));   
            $this->set('perimetres', $this->paginate());
            $ObjEntites = new EntitesController();
            $cercles = $ObjEntites->get_all();
            $this->set(compact('cercles'));
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }

    /**
     * ajoute un périmètre
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        $this->set_title();
        if (isAuthorized('perimetres', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Perimetre->validate = array();
                    $this->History->goBack(1);
                else:                
                    $this->request->data['Perimetre']['entite_id']=userAuth('entite_id');
                    $this->Perimetre->create();
                    if ($this->Perimetre->save($this->request->data)) {
                            $this->Session->setFlash(__('Périmètre sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Périmètre incorrect, veuillez corriger l\'application',true),'flash_failure');
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
     * met à jour un périmètre
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        $this->set_title();
        if (isAuthorized('perimetres', 'edit')) :            
            if (!$this->Perimetre->exists($id)) {
                    throw new NotFoundException(__('Périmètres incorrect'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Perimetre->validate = array();
                    $this->History->goBack(1);
                else:                    
                    if ($this->Perimetre->save($this->request->data)) {
                            $this->Session->setFlash(__('Périmètre sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Périmètre incorrect, veuillez corriger l\'application',true),'flash_failure');
                    }
                endif;
            } else {
                $options = array('conditions' => array('Perimetre.' . $this->Perimetre->primaryKey => $id));
                $this->request->data = $this->Perimetre->find('first', $options);
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
     * supprime un périmètre
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        $this->set_title();
        if (isAuthorized('perimetres', 'delete')) : 
            $this->Perimetre->id = $id;
            if (!$this->Perimetre->exists()) {
                    throw new NotFoundException(__('Périmètres incorrect'));
            }
            if ($this->Perimetre->saveField('ACTIF',0)) {
                    $this->Session->setFlash(__('Périmètre supprimé',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Périmètre <b>NON</b> supprimé',true),'flash_failure');
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
            $this->Perimetre->id = $id;
            $obj = $this->Perimetre->find('first',array('conditions'=>array('Perimetre.id'=>$id),'recursive'=>0));
            $newactif = $obj['Perimetre']['ACTIF'] == 1 ? 0 : 1;
            if ($this->Perimetre->saveField('ACTIF',$newactif)) {
                    $this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
            }
            exit();
    }

    /**
     * recherche de périmètres
     * 
     * @param string $actif
     * @param string $entite
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($actif=null,$entite=null,$keywords=null){
        $this->set_title();
        if (isAuthorized('perimetres', 'index')) :
            if(isset($this->params->data['Perimetre']['SEARCH'])):
                $keywords = $this->params->data['Perimetre']['SEARCH'];
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
                $getactif = $this->get_perimetre_actif_filter($actif);
                $getentite = $this->get_perimetre_entite_filter($entite, $visibility);
                $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Perimetre.NOM LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newcondition,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                $this->set('perimetres', $this->paginate()); 
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
     * renvois la liste des périmètres pour les selects
     * 
     * @param string $actif
     * @return array
     */
    public function get_select($actif=1){
        $visibility = $this->get_visibility();                
        $conditions[]= $this->get_restriction($visibility);               
        $conditions[] = $actif == null ? '1=1' : 'Perimetre.ACTIF='.$actif;    
        $list = $this->Perimetre->find('list',array('fields'=>array('Perimetre.id','Perimetre.NOM'),'conditions'=>$conditions,'order'=>array('Perimetre.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }   

    /**
     * renvois la liste des périmètre 
     * 
     * @param string $actif
     * @return array
     */
    public function get_list($actif=null){
        $visibility = $this->get_visibility();                
        $conditions[]= $this->get_restriction($visibility);               
        $conditions[] = $actif == null ? '1=1' : 'Perimetre.ACTIF='.$actif;    
        $list = $this->Perimetre->find('all',array('fields'=>array('Perimetre.id','Perimetre.NOM'),'conditions'=>$conditions,'order'=>array('Perimetre.NOM'=>'asc'),'recursive'=>-1));
        return $list;
    }      

    /**
     * renvois le périmètre à partir de son nom
     * 
     * @param string $nom
     * @return array
     */
    public function getbynom($nom){
        $this->Perimetre->recursive = 0;
        $obj = $this->Perimetre->findByNom($nom);
        return $obj;
    }         
}
