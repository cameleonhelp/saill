<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
/**
 * Dossierpartages Controller
 *
 * @property Dossierpartage $Dossierpartage
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class DossierpartagesController extends AppController {

    /**
     * variables globales utilisées au niveau du controller
     */
    public $components = array('History','Common');

    public $paginate = array(
    'limit' => 25,
    'order' => array('Dossierpartage.NOM' => 'asc'),
    );
        
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Dossiers réseaux partagés" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }           
    
    /**
     * permet de limiter le périmèter de visibilité
     * 
     * @return null
     */
    public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            return $ObjAssoentiteutilisateurs->json_get_all_users_actif_nogenerique(userAuth('id'));                
        endif;
    }

    /**
     * applique le périmètre de visibilité
     * 
     * @param type $visibility
     * @return string
     */
    public function get_restriction($visibility){
        if($visibility == null):
            return '1=1';
        elseif ($visibility!=''):
            return array('OR'=>array('Dossierpartage.utilisateur_id IN ('.$visibility.')','Dossierpartage.utilisateur_id IS NULL'));
        else:
            return array('OR'=>array('Dossierpartage.utilisateur_id ='.userAuth('id'),'Dossierpartage.utilisateur_id IS NULL'));
        endif;
    }

    /**
     * retourne la liste des utilisateurs
     * 
     * @param string $visibility
     * @return array
     */
    public function get_list_utilisateur($visibility){
        if($visibility == null):
             $condition = array("Utilisateur.id > 1","Utilisateur.profil_id > 0","Utilisateur.ACTIF"=>1);
        elseif ($visibility!=''):
            $condition = array("Utilisateur.id > 1","Utilisateur.profil_id > 0","Utilisateur.ACTIF"=>1,'Utilisateur.id IN ('.$visibility.')');
        else:
            $condition = array("Utilisateur.id > 1","Utilisateur.profil_id > 0","Utilisateur.ACTIF"=>1,'Utilisateur.id ='.userAuth('id'));
        endif;            
        return $this->Dossierpartage->Utilisateur->find('list',array('fields' => array('Utilisateur.id', 'Utilisateur.NOMLONG'),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'conditions'=>$condition));              
    }     

    /**
     * liste des dossiers partagés
     * 
     * @throws UnauthorizedException
     */
    public function index() {
        $this->set_title();
        if (isAuthorized('dossierpartages', 'index')) :
            $listusers = $this->get_visibility();
            $newcondition = $this->get_restriction($listusers);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));
            $this->set('dossierpartages', $this->paginate());
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * ajout d'un dossier partagé
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        $this->set_title();
        if (isAuthorized('dossierpartages', 'add')) :            
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Dossierpartage->validate = array();
                    $this->History->goBack(1);
                else:                    
                    $this->Dossierpartage->create();
                    if ($this->Dossierpartage->save($this->request->data)) {
                            $this->Session->setFlash(__('Dossier partagé sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Dossier partagé incorrecte, veuilez corriger le dossier partagé',true),'flash_failure');
                    }
                endif;
            endif;
            $listusers = $this->get_visibility();
            $gestionnaire = $this->get_list_utilisateur($listusers);
            $this->set('gestionnaire',$gestionnaire);                 
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * modification d'un dossier partagé
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        $this->set_title();
        if (isAuthorized('dossierpartages', 'edit')) :    
            if (!$this->Dossierpartage->exists($id)) {
                    throw new NotFoundException(__('Dossier partagé incorrecte'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Dossierpartage->validate = array();
                    $this->History->goBack(1);
                else:                    
                    if ($this->Dossierpartage->save($this->request->data)) {
                            $this->Session->setFlash(__('Dossier partagé sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Dossier partagé incorrecte, veuillez corriger le dossier partagé',true),'flash_failure');
                    }
                endif;
            } else {
                $options = array('conditions' => array('Dossierpartage.' . $this->Dossierpartage->primaryKey => $id),'recursive'=>0);
                $this->request->data = $this->Dossierpartage->find('first', $options);
                $listusers = $this->get_visibility();
                $gestionnaire = $this->get_list_utilisateur($listusers);
                $this->set('gestionnaire',$gestionnaire);                         
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * suppression d'un dossier partagé
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        $this->set_title();
        if (isAuthorized('dossierpartages', 'delete')) :
            $this->Dossierpartage->id = $id;
            if (!$this->Dossierpartage->exists()) {
                    throw new NotFoundException(__('Dossier partagé incorrecte'));
            }
            //$this->request->onlyAllow('post', 'delete');
            if ($this->Dossierpartage->delete()) {
                    $this->Session->setFlash(__('Dossier partagé supprimé',true),'flash_success');
                    $this->History->goBack(1);
            }
            $this->Session->setFlash(__('Dossier partagé NON supprimé',true),'flash_failure');
            $this->History->goBack(1);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * recherche du dossier partagé
     * 
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($keywords=null) {
        $this->set_title();
        if (isAuthorized('dossierpartages', 'index')) :
            if(isset($this->params->data['Dossierpartage']['SEARCH'])):
                $keywords = $this->params->data['Dossierpartage']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $arkeywords = explode(' ',trim($keywords)); 
                $listusers = $this->get_visibility();
                $newcondition = $this->get_restriction($listusers);
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Dossierpartage.NOM LIKE '%".$value."%'","Dossierpartage.DESCRIPTION LIKE '%".$value."%'","Dossierpartage.GROUPEAD LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newcondition,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                $this->set('dossierpartages', $this->paginate());     
            else:
                $this->redirect(array('action'=>'index'));
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    } 
    
    /**
     * liste des dossiers partagés
     * 
     * @param string $id entite
     * @return array
     */
    public function get_list_shared($id=null){
        if ($id== null):
            $visibility = $this->get_visibility();
            $conditions = $this->get_restriction($visibility);
        else:
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            $visibility = $ObjAssoentiteutilisateurs->json_get_all_users_actif_nogenerique_for_entite($id);
            $conditions = $this->get_restriction($visibility);
        endif;            
        $list = $this->Dossierpartage->find('list',array('fields'=>array('id','NOM'),'conditions'=>$conditions,'order'=>array('Dossierpartage.NOM'=>'asc'),"recursive"=>1));
        return $list;
    }

    /**
     * retourne la liste des dossiers paratgés pour les select
     * 
     * @return array
     */
    public function get_list(){
        $visibility = $this->get_visibility();
        $conditions = $this->get_restriction($visibility);
        $list = $this->Dossierpartage->find('list',array('fields'=>array('id','NOM'),'conditions'=>$conditions,'order'=>array('Dossierpartage.NOM'=>'asc'),"recursive"=>1));
        return $list;
    }

    /**
     * retourne la liste des dossiers partagés pour les menus par exemple
     * 
     * @return array
     */
    public function get_all(){
        $visibility = $this->get_visibility();
        $conditions = $this->get_restriction($visibility);
        $list = $this->Dossierpartage->find('all',array('conditions'=>$conditions,'order'=>array('Dossierpartage.NOM'=>'asc'),"recursive"=>1));
        return $list;
    }             
}        
