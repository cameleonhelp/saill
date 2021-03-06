<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
App::import('Controller', 'Entites');
App::import('Controller', 'Envoutils');
/**
 * Mws Controller
 *
 * @property Mw $Mw
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class MwsController extends AppController {
    /**
     * variables globales utilisées au niveau du controller
     */
    public $paginate = array('limit' => 25,'order'=>array('Mw.NOM'=>'asc'));
    public $components = array('History','Common');

    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Middleware" : $title;
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
            return array('OR'=>array('Mw.entite_id IN ('.$visibility.')','Mw.entite_id IS NULL'));
        else:
            return array('OR'=>array('Mw.entite_id ='.userAuth('entite_id'),'Mw.entite_id IS NULL'));
        endif;
    }

    /**
     * filtre le middleware par son statut actif
     * 
     * @param string $id
     * @return string
     */
    public function get_mw_actif_filter($id){
        $result = array();
        switch($id):
            case null:
            case 1:
                $result['condition']="Mw.ACTIF=1";
                $result['filter'] = 'actives';
                break;
            case 0:
                $result['condition']="Mw.ACTIF=0";
                $result['filter'] = 'inactives';
                break;
        endswitch;
        return $result;
    }

    /**
     * filtre le middleware par l'outil
     * 
     * @param string $id
     * @return string
     */
    public function get_mw_envoutil_filter($id){
        $result = array();
        switch($id):
            case null:
            case 'tous':
                $result['condition']="1=1";
                $result['filter'] = ' de tous les outils';
                break;
            default:
                $result['condition']="Mw.envoutil_id=".$envoutil;
                $nomenvoutil = $this->Mw->Envoutil->findById($envoutil);
                $result['filter'] = ' pour l\'outil '.$nomenvoutil['Envoutil']['NOM'];
                break;
        endswitch;
        return $result;
    }        

    /**
     * filtre le middleware par l'entité
     * 
     * @param string $id
     * @param string $visibility
     * @return string
     */
    public function get_mw_entite_filter($id,$visibility){
        $result = array();
        switch($id):
            case null:
            case 'tous':
                if($visibility == null):
                    $result['condition']='1=1';
                elseif ($visibility!=''):
                    $result['condition']=array('OR'=>array('Mw.entite_id IN ('.$visibility.')','Mw.entite_id IS NULL'));
                else:
                    $result['condition']=array('OR'=>array('Mw.entite_id ='.userAuth('entite_id'),'Mw.entite_id IS NULL'));
                endif;                      
                $result['filter'] = ' de tous les cercles';
                break;
            default:
                $result['condition']='Mw.entite_id ='.$id;
                $ObjEntites = new EntitesController();
                $nom = $ObjEntites->get_entite_nom($id);
                $result['filter'] = 'ayant pour entité '.$nom;
        endswitch;
        return $result;
    }  

    /**
     * liste les middlewares
     * 
     * @param string $actif
     * @param string $envoutil
     * @param string $entite
     * @throws UnauthorizedException
     */
    public function index($actif=null,$envoutil=null,$entite=null) {
        $this->set_title();
        if (isAuthorized('mws', 'index')) :
            $visibility = $this->get_visibility();                
            $restriction= $this->get_restriction($visibility);
            $getactif = $this->get_mw_actif_filter($actif);
            $getenvoutil = $this->get_mw_envoutil_filter($envoutil);
            $getentite = $this->get_mw_entite_filter($entite, $visibility);
            $this->set('strfilter',$getactif['filter'].$getenvoutil['filter'].$getentite['filter']);
            $newcondition = array($restriction,$getactif['condition'],$getenvoutil['condition'],$getentite['condition']);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0)); 
            $this->set('mws', $this->paginate());
            $ObjEntites = new EntitesController();
            $ObjEnvoutils = new EnvoutilsController();
            $envoutils = $ObjEnvoutils->get_list(1);
            $cercles = $ObjEntites->get_all();
            $this->set(compact('cercles','envoutils'));
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }

    /**
     * ajoute un middleware
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        $this->set_title();
        if (isAuthorized('mws', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Mw->validate = array();
                    $this->History->goBack(1);
                else:                     
                    if ($this->isUniqueField(array('Mw.NOM'=>$this->request->data['Mw']['NOM'],'Mw.entite_id'=>userAuth('entite_id')))):
                        $this->Mw->create();
                        if ($this->Mw->save($this->request->data)) {
                                $this->Session->setFlash(__('Middleware sauvegardé',true),'flash_success');
                                $this->History->goBack(1);
                        } else {
                                $this->Session->setFlash(__('Middleware incorrect, veuillez corriger l\'application',true),'flash_failure');
                        }
                    else:
                        $this->Session->setFlash(__('Le nom du middleware existe déjà, veuillez corriger l\'application',true),'flash_failure');
                    endif;
                endif;
            endif;
            $ObjEntites = new EntitesController();
            $ObjEnvoutils = new EnvoutilsController();
            $envoutils = $ObjEnvoutils->get_select(1);
            $cercles = $ObjEntites->find_list_cercle();
            $this->set(compact('cercles','envoutils'));                                
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }

    /**
     * test si le middleware est unique en fonction des conditions
     * 
     * @param array $array
     * @return boolean
     */
    public function isUniqueField($array){
        $options = array('conditions' => $array);
        $result = $this->Mw->find('count', $options);
        if ($result> 0):
            return false;
        else:
            return true;
        endif;
    }

    /**
     * met à jour le middleware
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        $this->set_title();
        if (isAuthorized('mws', 'edit')) :    
            if (!$this->Mw->exists($id)) {
                    throw new NotFoundException(__('Middleware incorrect'));
            }
            if ($this->request->is('post') || $this->request->is('put')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Mw->validate = array();
                    $this->History->goBack(1);
                else:                     
                    if ($this->isUniqueFieldUntilId('Mw.NOM',$this->request->data['Mw']['NOM'],$id)):
                        if ($this->Mw->save($this->request->data)) {
                                $this->Session->setFlash(__('Middleware sauvegardé',true),'flash_success');
                                $this->History->goBack(1);
                        } else {
                                $this->Session->setFlash(__('Middleware incorrect, veuillez corriger l\'application',true),'flash_failure');
                        }
                    else:
                        $this->Session->setFlash(__('Le nom du middleware existe déjà, veuillez corriger l\'application',true),'flash_failure');
                    endif;
                endif;
            else:
                $options = array('conditions' => array('Mw.' . $this->Mw->primaryKey => $id));
                $mw = $this->Mw->find('first', $options); 
                $ObjEntites = new EntitesController();
                $ObjEnvoutils = new EnvoutilsController();
                $envoutils = $ObjEnvoutils->get_select(1);
                $cercles = $ObjEntites->find_list_cercle();
                $this->set(compact('cercles','envoutils','mw'));     
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * test si le middleware est unique pour un champs et une valeur et un id différent
     * 
     * @param string $field
     * @param string $value
     * @param string $id
     * @return boolean
     */
    public function isUniqueFieldUntilId($field,$value,$id){
        $options = array('conditions' => array($field=>$value,'Mw.id !='.$id));
        $result = $this->Mw->find('count', $options);
        if ($result> 0):
            return false;
        else:
            return true;
        endif;
    }

    /**
     * supprime un middleware
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        $this->set_title();
        if (isAuthorized('mws', 'delete')) : 
            $this->Mw->id = $id;
            if (!$this->Mw->exists()) {
                    throw new NotFoundException(__('Middleware incorrect'));
            }
            if ($this->Mw->saveField('ACTIF',0)) {
                    $this->Session->setFlash(__('Middleware supprimé',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Middleware <b>NON</b> supprimé',true),'flash_failure');
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
            $this->Mw->id = $id;
            $obj = $this->Mw->find('first',array('conditions'=>array('Mw.id'=>$id),'recursive'=>0));
            $newactif = $obj['Mw']['ACTIF'] == 1 ? 0 : 1;
            if ($this->Mw->saveField('ACTIF',$newactif)) {
                    $this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
            }
            exit();
    }

    /**
     * recherche de middleware
     * 
     * @param string $actif
     * @param string $envoutil
     * @param string $entite
     * @param string $keywords
     */
    public function search($actif=null,$envoutil=null,$entite=null,$keywords=null){
        $this->set_title();
        if (isAuthorized('mws', 'index')) :
            if(isset($this->params->data['Mw']['SEARCH'])):
                $keywords = $this->params->data['Mw']['SEARCH'];
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
                $getactif = $this->get_mw_actif_filter($actif);
                $getenvoutil = $this->get_mw_envoutil_filter($envoutil);
                $getentite = $this->get_mw_entite_filter($entite, $visibility);
                $this->set('strfilter',$getactif['filter'].$getenvoutil['filter'].$getentite['filter']);
                $newcondition = array($restriction,$getactif['condition'],$getenvoutil['condition'],$getentite['condition']);
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Mw.NOM LIKE '%".$value."%'","Mw.PVU LIKE '%".$value."%'","Mw.COUTUNITAIRE LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newcondition,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                $this->set('mws', $this->paginate()); 
                $ObjEntites = new EntitesController();
                $cercles = $ObjEntites->get_all();
                $this->set(compact('cercles'));                    
            else:
                $this->redirect(array('action'=>'index',$actif,$envoutil,$entite));
            endif;  
       endif;
    }

    /**
     * renvois la liste pour les select des middlewares
     * 
     * @param string $actif
     * @return array
     */
    public function get_select($actif=1){
        $visibility = $this->get_visibility();                
        $conditions[]= $this->get_restriction($visibility);               
        $conditions[] = $actif == null ? '1=1' : 'Mw.ACTIF='.$actif;
        $list = $this->Mw->find('list',array('fields'=>array('Mw.id','Mw.NOM'),'conditions'=>$conditions,'order'=>array('Mw.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }         
}
