<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
/**
 * @versions Controller
 *
 * @property Version $Version
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class VersionsController extends AppController {
    /**
     * Variables globales utilisées au niveau du controller
     */
    public $paginate = array('limit' => 25,'order'=>array('Version.NOM'=>'asc'));
    public $components = array('History','Common');

    /**
     * méthode permettant d'utiliser des méthodes sans authentification
     */
    public function beforeFilter() {   
        $this->Auth->allow(array('json_get_version_for','json_get_version_info'));
        parent::beforeFilter();
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
            return "1=1";
        elseif ($visibility !=""):
            return "Lot.entite_id IN (".$visibility.')'; 
        else:
            return "Lot.entite_id=".userAuth('entite_id');
        endif;
    }

    /**
     * filtre les version par statut actif
     * 
     * @param string $actif
     * @return string
     */
    public function get_version_actif_filter($actif){
        $result = array();
        switch($actif):
            case null:
            case 1:
                $result['condition']="Version.ACTIF=1";
                $result['filter'] = 'actifs';
                break;
            case 0:
                $result['condition']="Version.ACTIF=0";
                $result['filter']= 'inactifs';
                break;
        endswitch;
        return $result;
    }

    /**
     * liste des versions
     * 
     * @param string $actif
     * @throws UnauthorizedException
     */
    public function index($actif=null) {
        if (isAuthorized('versions', 'index')) :  
            $getactif = $this->get_version_actif_filter($actif);
            $this->set('strfilter',$getactif['filter']);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$getactif['condition'],'recursive'=>0));                
            $this->set('versions', $this->paginate());
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }

    /**
     * ajoute une version
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        if (isAuthorized('versions', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Version->validate = array();
                    $this->History->goBack(1);
                else:                     
                    $this->Version->create();
                    if ($this->Version->save($this->request->data)) {
                            $this->Session->setFlash(__('Version sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Version incorrecte, veuillez corriger l\'application',true),'flash_failure');
                    }
                endif;
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }

    /**
     * met à jour une version 
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        if (isAuthorized('versions', 'edit')) :            
            if (!$this->Version->exists($id)) {
                    throw new NotFoundException(__('Versions incorrecte'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Version->validate = array();
                    $this->History->goBack(1);
                else:                     
                    if ($this->Version->save($this->request->data)) {
                            $this->Session->setFlash(__('Version sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Version incorrecte, veuillez corriger l\'application',true),'flash_failure');
                    }
                endif;
            } else {
                    $options = array('conditions' => array('Version.' . $this->Version->primaryKey => $id));
                    $this->request->data = $this->Version->find('first', $options);
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * supprime la version
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        if (isAuthorized('versions', 'delete')) : 
            $this->Version->id = $id;
            if (!$this->Version->exists()) {
                    throw new NotFoundException(__('Versions incorrecte'));
            }
            if ($this->Version->saveField('ACTIF',0)) {
                    $this->Session->setFlash(__('Version supprimée',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Version <b>NON</b> supprimée',true),'flash_failure');
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
            $this->Version->id = $id;
            $obj = $this->Version->find('first',array('conditions'=>array('Version.id'=>$id),'recursive'=>0));
            $newactif = $obj['Version']['ACTIF'] == 1 ? 0 : 1;
            if ($this->Version->saveField('ACTIF',$newactif)) {
                    $this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
            }
            exit();
    }

    /**
     * suppression dynamique de la version
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function ajaxdelete($id = null) {
        $this->autoRender = false;
        if (isAuthorized('versions', 'delete')) : 
            $this->Version->id = $id;
            if (!$this->Version->exists()) {
                    throw new NotFoundException(__('Versions incorrecte'));
            }
            if ($this->Version->saveField('ACTIF',0)) {
                    $this->Session->setFlash(__('Version supprimée',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Version <b>NON</b> supprimée',true),'flash_failure');
            }
            $this->History->notmove();
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }

    /**
     * renvois la liste des verison pour les selects
     * 
     * @param string $actif
     * @return array
     */
    public function get_select($actif=1){
        $listentite = $this->get_visibility();
        $conditions[]=$this->get_restriction($listentite);     
        $conditions[] = 'Version.ACTIF='.$actif;
        $list = $this->Version->find('list',array('fields'=>array('Version.id','Version.NOM'),'conditions'=>$conditions,'order'=>array('Version.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }

    /**
     * renvois la liste des versions
     * 
     * @param string $actif
     * @return array
     */
    public function get_list($actif=1){
        $listentite = $this->get_visibility();
        $conditions[]=$this->get_restriction($listentite);
        $conditions[] = 'Version.ACTIF='.$actif;            
        $list = $this->Version->find('all',array('fields'=>array('Version.id','Version.NOM'),'conditions'=>$conditions,'order'=>array('Version.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }        

    /**
     * renvois  la liste des version pour un lot
     * 
     * @param string $id du lot
     * @param string $actif
     * @return array
     */
    public function get_version_for($id=null,$actif=null){
        $conditions[] = $actif == null ? '1=1' : 'Version.ACTIF='.$actif;
        $conditions[] = 'Version.lot_id='.$id;
        $list = $this->Version->find('all',array('conditions'=>$conditions,'order'=>array('Version.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }      

    /**
     * renvois la liste des verison pour un lot
     * 
     * @param string $id
     * @param string $actif
     * @return json
     */
    public function json_get_version_for($id=null,$actif=null){
        $this->autoRender = false;
        $conditions[] = $actif == null ? '1=1' : 'Version.ACTIF='.$actif;
        $conditions[] = !in_array($id, array('4','3','5'))? 'Version.lot_id='.$id : '1=1';
        $versions = $this->Version->find('all',array('conditions'=>$conditions,'recursive'=>-1,'order'=>array('Version.NOM'=>'asc')));
        foreach($versions as $version):
            $listversions["NOM"]=$version["Version"]["id"];
        endforeach;
        $result = json_encode($versions);
        return $result;
    } 

    /**
     * renvois les information de la version
     * 
     * @param string $id
     * @return array
     */
    public function json_get_version_info($id=null){
        $this->autoRender = false;
        $conditions[] = 'Version.id='.$id;
        $version = $this->Version->find('all',array('conditions'=>$conditions,'recursive'=>0,'order'=>array('Version.NOM'=>'asc')));
        $result = json_encode($version);
        return $result;
    }

    /**
     * ajout dynamique d'uns version
     * 
     * @throws UnauthorizedException
     */
    public function ajaxadd() {
        $this->autoRender = false;
        if (isAuthorized('versions', 'add')) :
            if ($this->request->is('post')) :
                    $this->Version->create();

                    if ($this->Version->save($this->request->data)) {
                            $this->Session->setFlash(__('Version sauvegardée',true),'flash_success');
                            $this->History->notmove();
                    } else {
                            $this->Session->setFlash(__('Version incorrecte, veuillez corriger l\'application',true),'flash_failure');
                    }
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }   

    /**
     * mise à jour dynamique d'une version
     * 
     * @throws UnauthorizedException
     */
    public function ajaxedit() {
        $this->autoRender = false;
        if (isAuthorized('versions', 'edit')) : 
            if ($this->request->is('post') || $this->request->is('put')) :
                    $id = $this->request->data['Version']['id'];
                    if ($this->Version->save($this->request->data)) {
                            $this->Session->setFlash(__('Version sauvegardée',true),'flash_success');
                            $this->History->notmove();
                    } else {
                            $this->Session->setFlash(__('Version incorrecte, veuillez corriger l\'application',true),'flash_failure');
                    }
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }   

    /**
     * renvois la version à partir de son nom
     * 
     * @param type $nom
     * @return type
     */
    public function getbynom($nom){
        $this->Version->recursive = 0;
        $obj = $this->Version->findByNom($nom);
        return $obj;
    }         
}