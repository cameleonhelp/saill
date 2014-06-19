<?php
App::uses('AppController', 'Controller');
/**
 * Affectations Controller
 *
 * @property Affectation $Affectation
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class AffectationsController extends AppController {
        public $components = array('History','Common');        
        
        public function beforeFilter() {   
            $this->Auth->allow(array('json_get_this'));
            parent::beforeFilter();
        }  
        
    /**
     * Retourne la liste des affectation pour un utilisateur
     * 
     * @param int $id
     * @throws UnauthorizedException
     * @return Affectation
     */
    public function index($id = null) {
        if (isAuthorized('affectations', 'index')) :
            $this->Affectation->recursive = 0;
            $liste = $this->Affectation->find('all',array('conditions'=>array('Affectation.utilisateur_id'=>$id)));                
            $this->set('affectations', $liste);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");           
        endif;                
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//    public function view($id = null) {
//        if (isAuthorized('affectations', 'view')) :
//            if (!$this->Affectation->exists($id)) {
//                    throw new NotFoundException(__('Affectation incorrecte'));
//            }
//            $options = array('conditions' => array('Affectation.' . $this->Affectation->primaryKey => $id));
//            $this->set('affectation', $this->Affectation->find('first', $options));
//        else :
//            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
//            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");          
//        endif;                
//    }

    /**
     * Ajout d'une affectation à un agent
     * 
     * @param int $userid
     * @throws UnauthorizedException
     * @return void
     */
    public function add($userid = null) {
        if (isAuthorized('affectations', 'add')) :
            $activites = $this->Affectation->Activite->find('all',array('fields' => array('id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'conditions'=>array('Activite.ACTIVE'=>1),'recursive'=>0));
            $this->set('activites', $activites);            
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Affectation->validate = array();
                    $this->History->goBack(1);
                else:                    
                    $this->Affectation->utilisateur_id = $userid;
                    $this->Affectation->create();
                    if ($this->Affectation->save($this->request->data)) {
                            $history['Historyutilisateur']['utilisateur_id']=$userid;
                            $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - ajout d'une affectation par ".userAuth('NOMLONG');
                            $this->Affectation->Utilisateur->Historyutilisateur->save($history);     
                            $this->Session->setFlash(__('Affectation sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Affectation incorrecte, veuillez corriger l\'affectation',true),'flash_failure');
                    }
                endif;
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");         
        endif;                
    }

    /**
     * Modifier l'afectation d'un agent
     * 
     * @param int $id
     * @param int $userid
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @return void
     */
    public function edit($id = null,$userid = null) {
        if (isAuthorized('affectations', 'edit')) :
            $activites = $this->Affectation->Activite->find('all',array('fields' => array('id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'conditions'=>array('Activite.projet_id>1','Activite.ACTIVE'=>1),'recursive'=>0));
            $this->set('activites', $activites);             
            if (!$this->Affectation->exists($id)) {
                    throw new NotFoundException(__('Affectation incorrecte'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Affectation->validate = array();
                    $this->History->goBack(1);
                else:                    
                    if ($this->Affectation->save($this->request->data)) {
                            $history['Historyutilisateur']['utilisateur_id']=$userid;
                            $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - mise à jour d'une affectation par ".userAuth('NOMLONG');
                            $this->Affectation->Utilisateur->Historyutilisateur->save($history);                            
                            $this->Session->setFlash(__('Affectation sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Affectation incorrecte, veuillez corriger làffectation',true),'flash_failure');
                    }
                endif;
            } else {
                    $options = array('conditions' => array('Affectation.' . $this->Affectation->primaryKey => $id));
                    $this->request->data = $this->Affectation->find('first', $options);
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");           
        endif;                
    }

    /**
     * supprime une affectation pour un utilisateur
     * 
     * @param int $id
     * @param int $userid
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @return void
     */
    public function delete($id = null,$userid = null) {
        if (isAuthorized('affectations', 'delete')) :
            $this->Affectation->id = $id;
            if (!$this->Affectation->exists()) {
                    throw new NotFoundException(__('Affectation incorrecte'));
            }
            if ($this->Affectation->delete()) {
                    $history['Historyutilisateur']['utilisateur_id']=$userid;
                    $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - suppression d'une affectation par ".userAuth('NOMLONG');
                    $this->Affectation->Utilisateur->Historyutilisateur->save($history);                     
                    $this->Session->setFlash(__('Affectation supprimée',true),'flash_success');
                    $this->History->goBack(0);
            }
            $this->Session->setFlash(__('Affectation <b>NON</b> supprimée',true),'flash_failure');
            $this->History->goBack(0);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");           
        endif;                
    }
    
    /**
     * Ajoute les indisponibilité pour un agent
     * 
     * @param int $id
     * @return void
     */    
    public function addIndisponibilite($id=null){
        $societe = $this->Affectation->Utilisateur->find('first',array('fields'=>array('societe_id'),'conditions'=>array('Utilisateur.id'=>$id),'recursive'=>-1));
        if ($societe == 1 ):
            $absences = $this->Affectation->Activite->find('all',array('fields'=>array('Activite.id'),'conditions'=>array('Activite.projet_id'=>1),'recursive'=>-1));
        else :
            $absences = $this->Affectation->Activite->find('all',array('fields'=>array('Activite.id'),'conditions'=>array('Activite.projet_id'=>1,'Activite.id'=>array(1,5)),'recursive'=>-1));
        endif;
        foreach ($absences as $absence) {
            unset($record);
            $record['Affectation']['utilisateur_id'] = $id;
            $record['Affectation']['activite_id'] = $absence['Activite']['id'];
            $this->Affectation->create();
            if ($this->Affectation->save($record)) {
                $history['Historyutilisateur']['utilisateur_id']=$id;
                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - ajout d'une affectation par ".userAuth('NOMLONG');
                $this->Affectation->Utilisateur->Historyutilisateur->create();
                $this->Affectation->Utilisateur->Historyutilisateur->save($history);     
                $this->Session->setFlash(__('Affectation sauvegardée',true),'flash_success');
            } else {
                $this->Session->setFlash(__('Affectation <b>NON</b> sauvegardée',true),'flash_failure');
            }
        }            
        $this->History->goBack(1);

    }
        
    /**
     * Retourne la liste pour les selects des affectation d'un agent
     * 
     * @param int $id de l'agent
     * @return type
     */
    public function get_list($id){
        $options = array('Affectation.utilisateur_id' => $id);
        return $this->Affectation->find('list',array('fields' => array('Affectation.activite_id','Activite.NOM'),'conditions'=> $options,'order'=>array('Activite.NOM'=>'asc'),'recursive'=>0));
    }

    /**
     * Retourne toutes les affectation d'un agent
     * 
     * @param int $id de l'agent
     * @return type
     */    
    public function get_all($id){
        $options = array('Affectation.utilisateur_id' => $id);
        return $this->Affectation->find('all',array('order'=>array('Activite.NOM'=>'asc'),'conditions'=>$options,'recursive'=>0));
    }       
        
    /**
     * Retourn le nombre d'affectation pour un agent
     * 
     * @param int $id
     * @return int
     */
    public function get_compteur($id){
        $options =array('Affectation.utilisateur_id' => $id);
        return $this->Affectation->find('first',array('fields'=>array('count(Affectation.id) AS nbAffectation'),'conditions' =>$options,'recursive'=>0));
    }      
        
    /**
     * Ajoute l'affectation de façon dynamique (Ajax)
     */
    public function addto(){
        $this->autoRender = false;
        $this->request->data['Affectation']['created'] = date('Y-m-d');
        $this->request->data['Affectation']['modified'] = date('Y-m-d');
        $this->Affectation->create();
        if($this->Affectation->save($this->request->data)):
            $this->Session->setFlash(__('Affectation sauvegardée',true),'flash_success');
        else:
            $this->Session->setFlash(__('Affectation incorrecte, veuillez corriger l\'affectation',true),'flash_failure');
        endif;
        $this->History->goback(0);
    }
      
    /**
     * Modifie de façon dynamique une affectation (Ajax)
     */
    public function editto(){
        $this->autoRender = false;
        $this->request->data['Affectation']['modified'] = date('Y-m-d');
        $this->Affectation->id = $this->request->data['Affectation']['id'];
        if($this->Affectation->save($this->request->data)):
            $this->Session->setFlash(__('Affectation mise à jour',true),'flash_success');
        else:
            $this->Session->setFlash(__('Affectation incorrecte, veuillez corriger l\'affectation',true),'flash_failure');
        endif;
        $this->History->goback(0);
    }        
        
    /**
     * retourne les informations sur les affectation d'un agent de façon dynamique (Json/Ajax)
     * 
     * @param int $id
     * @return json
     */
    public function json_get_this($id=null){
        $this->autoRender = false;
        $result = null;
        if($id!=null):
        $conditions[] = 'Affectation.id='.$id;
        $return = $this->Affectation->find('first',array('conditions'=>$conditions,'recursive'=>-1));
        $result = json_encode($return);
        endif;
        return $result;
    }        
}
