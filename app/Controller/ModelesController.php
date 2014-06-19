<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
App::import('Controller', 'Entites');
/**
 * Modeles Controller
 *
 * @property Modele $Modele
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class ModelesController extends AppController {
    /**
     * variables globales utilisées au niveau du controller
     */
    public $paginate = array('limit' => 25,'order'=>array('Modele.NOM'=>'asc'));
    public $components = array('History','Common');

    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Modèles" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }              

    /**
     * calcule le périmètre de visibilité
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
     * applique le périmètre de visibilité
     * 
     * @param string $visibility
     * @return string
     */
    public function get_restriction($visibility){
        if($visibility == null):
            return '1=1';
        elseif ($visibility!=''):
            return array('OR'=>array('Modele.entite_id IN ('.$visibility.')','Modele.entite_id IS NULL'));
        else:
            return array('OR'=>array('Modele.entite_id ='.userAuth('entite_id'),'Modele.entite_id IS NULL'));
        endif;
    }

    /**
     * filtre les modèle en fonction de l'état actif
     * 
     * @param string $id
     * @return string
     */
    public function get_modele_actif_filter($id){
        $result = array();
        switch($id):
            case null:
            case 1:
                $result['condition']="Modele.ACTIF=1";
                $result['filter'] = 'actives';
                break;
            case 0:
                $result['condition']="Modele.ACTIF=0";
                $result['filter'] = 'inactives';
                break;
        endswitch;
        return $result;
    }

    /**
     * filtre les modèle en fonction de l'entité
     * 
     * @param string $id
     * @param string $visibility
     * @return string
     */
    public function get_modele_entite_filter($id,$visibility){
        $result = array();
        switch($id):
            case null:
            case 'tous':
                if($visibility == null):
                    $result['condition']='1=1';
                elseif ($visibility!=''):
                    $result['condition']=array('OR'=>array('Modele.entite_id IN ('.$visibility.')','Modele.entite_id IS NULL'));
                else:
                    $result['condition']=array('OR'=>array('Modele.entite_id ='.userAuth('entite_id'),'Modele.entite_id IS NULL'));
                endif;                      
                $result['filter'] = ' de tous les cercles';
                break;
            default:
                $result['condition']='Modele.entite_id ='.$id;
                $ObjEntites = new EntitesController();		
                $nom = $ObjEntites->get_entite_nom($id);
                $result['filter'] = 'ayant pour entité '.$nom;
        endswitch;
        return $result;
    }                

    /**
     * liste les modèles
     * 
     * @param string $actif
     * @param string $entite
     * @throws UnauthorizedException
     */
    public function index($actif=null,$entite=null) {
        $this->set_title();
        if (isAuthorized('modeles', 'index')) :
            $visibility = $this->get_visibility();                
            $restriction= $this->get_restriction($visibility);
            $getactif = $this->get_modele_actif_filter($actif);
            $getentite = $this->get_modele_entite_filter($entite, $visibility);
            $this->set('strfilter',$getactif['filter'].$getentite['filter']);
            $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));   
            $this->set('modeles', $this->paginate());
            $ObjEntites = new EntitesController();		
            $cercles = $ObjEntites->get_all();
            $this->set(compact('cercles'));
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }

    /**
     * ajoute un nouveau modèle
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        $this->set_title();
        if (isAuthorized('modeles', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Modele->validate = array();
                    $this->History->goBack(1);
                else:             
                    $this->request->data['Modele']['entite_id']=userAuth('entite_id');
                    $this->Modele->create();
                    if ($this->Modele->save($this->request->data)) {
                            $this->Session->setFlash(__('Modèle sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Modèle incorrect, veuillez corriger l\'application',true),'flash_failure');
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
     * met à jour un modèle
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        $this->set_title();
        if (isAuthorized('modeles', 'edit')) :            
            if (!$this->Modele->exists($id)) {
                    throw new NotFoundException(__('Modèle incorrect'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Modele->validate = array();
                    $this->History->goBack(1);
                else:                     
                    if ($this->Modele->save($this->request->data)) {
                            $this->Session->setFlash(__('Modèle sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Modèle incorrect, veuillez corriger l\'application',true),'flash_failure');
                    }
                endif;
            } else {
                $options = array('conditions' => array('Modele.' . $this->Modele->primaryKey => $id));
                $this->request->data = $this->Modele->find('first', $options);
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
     * supprime un modèle
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        $this->set_title();
        if (isAuthorized('modeles', 'delete')) : 
            $this->Modele->id = $id;
            if (!$this->Modele->exists()) {
                    throw new NotFoundException(__('Modèle incorrect'));
            }
            if ($this->Modele->saveField('ACTIF',0)) {
                    $this->Session->setFlash(__('Modèle supprimé',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Modèle <b>NON</b> supprimé',true),'flash_failure');
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
            $this->Modele->id = $id;
            $obj = $this->Modele->find('first',array('conditions'=>array('Modele.id'=>$id),'recursive'=>0));
            $newactif = $obj['Modele']['ACTIF'] == 1 ? 0 : 1;
            if ($this->Modele->saveField('ACTIF',$newactif)) {
                    $this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
            }
            exit();
    }

    /**
     * recherche de modèles
     * 
     * @param string $actif
     * @param string $entite
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($actif=null,$entite=null,$keywords=null){
        $this->set_title();
        if (isAuthorized('modeles', 'index')) :
            if(isset($this->params->data['Modele']['SEARCH'])):
                $keywords = $this->params->data['Modele']['SEARCH'];
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
                $getactif = $this->get_modele_actif_filter($actif);
                $getentite = $this->get_modele_entite_filter($entite, $visibility);
                $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Modele.NOM LIKE '%".$value."%'","Modele.NBU LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newcondition,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                $this->set('modeles', $this->paginate());   
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
     * liste pour les select des modèles
     * 
     * @param string $actif
     * @return string
     */
    public function get_select($actif=1){
        $visibility = $this->get_visibility();                
        $conditions[]= $this->get_restriction($visibility);               
        $conditions[] = $actif == null ? '1=1' : 'Modele.ACTIF='.$actif;          
        $list = $this->Modele->find('list',array('fields'=>array('Modele.id','Modele.NOM'),'conditions'=>$conditions,'order'=>array('Modele.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }     

    /**
     * renvois le modèle en fonction de son nom
     * 
     * @param string $nom
     * @return string
     */
    public function getbynom($nom){
        $this->Modele->recursive = 0;
        $obj = $this->Modele->findByNom($nom);
        return $obj;
    }
}
