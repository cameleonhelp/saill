<?php
App::uses('AppController', 'Controller');
/**
 * Dotations Controller
 *
 * @property Dotation $Dotation
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class DotationsController extends AppController {
    /**
     * variables globales utilisées au niveau du controller
     */
    public $components = array('History','Common');

    public function beforeFilter() {   
        $this->Auth->allow(array('json_get_this'));
        parent::beforeFilter();
    }   
        
    /**
     * liste des dotations
     * 
     * @param string $id
     * @throws UnauthorizedException
     */
    public function index($id = null) {
        if (isAuthorized('dotations', 'index') || isAuthorized('dotations', 'myprofil')) :
            $this->Dotation->recursive = 0;
            $liste = $this->Dotation->find('all',array('conditions'=>array('Dotation.utilisateur_id'=>$id)));
            $this->set('dotations', $liste);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * OBSOLETE
     */
//    public function view($id = null) {
//        if (isAuthorized('dotations', 'view')) :
//            if (!$this->Dotation->exists($id)) {
//                    throw new NotFoundException(__('Dotation incorrecte'));
//            }
//            $options = isset($id) ? array('conditions' => array('Dotation.' . $this->Dotation->primaryKey => $id)) : '';
//            $this->set('dotation', $this->Dotation->find('first', $options));
//        else :
//            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
//            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
//        endif;                
//    }

    /**
     * ajout d'une dotation
     * 
     * @param string $userid
     * @throws UnauthorizedException
     */
    public function add($userid = null) {
        $userid = $userid==null ? $this->request->data['Dotation']['utilisateur_id']: $userid;
        $this->autoRender = false;
        if (isAuthorized('dotations', 'add') || isAuthorized('dotations', 'myprofil')) :            
            $this->Dotation->utilisateur_id = $userid;
            $this->Dotation->create();
            $idmat = isset($this->request->data['Dotation']['materielinformatiques_id']) ? $this->request->data['Dotation']['materielinformatiques_id'] : null;
            if ($this->Dotation->save($this->request->data,false)) {
                    if(isset($this->request->data['Dotation']['materielinformatiques_id']) && !empty($this->request->data['Dotation']['materielinformatiques_id'])){
                        $this->Dotation->Materielinformatique->id = $idmat;
                        $record = $this->Dotation->Materielinformatique->read();
                        $record['Materielinformatique']['ETAT'] = $record['Materielinformatique']['ETAT']=='En stock' ? 'En dotation' : 'En stock';
                        $record['Materielinformatique']['created'] = isset($record['Materielinformatique']['created']) ? $record['Materielinformatique']['created'] : date('Y-m-d');
                        $record['Materielinformatique']['modified'] = date('Y-m-d');                
                        $this->Dotation->Materielinformatique->save($record,false);
                    }
                    $history['Historyutilisateur']['utilisateur_id']=$userid;
                    $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - ajout d'une dotation";
                    $this->Dotation->Utilisateur->Historyutilisateur->save($history);                               
                    $this->Session->setFlash(__('Dotation sauvegardée',true),'flash_success');
            } else {
                    $this->Session->setFlash(__('Dotation incorrecte, veuillez corriger la dotation',true),'flash_failure');
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * mise à jour de la dotation pour un utilisateur
     * 
     * @param string $id
     * @param string $userid
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null,$userid = null) {
        if (isAuthorized('dotations', 'edit') || isAuthorized('dotations', 'myprofil')) :
            if (!$this->Dotation->exists($id)) {
                    throw new NotFoundException(__('Dotation incorrecte'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Dotation->validate = array();
                    $this->History->goBack(1);
                else:                    
                    if ($this->Dotation->save($this->request->data)) {
                            $history['Historyutilisateur']['utilisateur_id']=$userid;
                            $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - mise à jour de la dotation dotation";
                            $this->Dotation->Utilisateur->Historyutilisateur->save($history); 				
                        $this->Session->setFlash(__('Dotation sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Dotation incorrecte, veuillez corriger la dotation',true),'flash_failure');
                    }
                endif;
            } else {
                    $options = array('conditions' => array('Dotation.' . $this->Dotation->primaryKey => $id),'recursive'=>0);
                    $this->request->data = $this->Dotation->find('first', $options);
                    $this->set('dotation', $this->Dotation->find('first', $options));                        
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * suppression de la dotation
     * 
     * @param string $id
     * @param string $userid
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null,$userid = null) {
        if (isAuthorized('dotations', 'delete')) :
            $this->Dotation->id = $id;
            if (!$this->Dotation->exists()) {
                    throw new NotFoundException(__('Dotation incorrecte'));
            }
            if ($this->Dotation->delete()) {
                    $history['Historyutilisateur']['utilisateur_id']=$userid;
                    $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - suppression d'une dotation";
                    $this->Dotation->Utilisateur->Historyutilisateur->save($history);                     
                    $this->Session->setFlash(__('Dotation supprimée',true),'flash_success');
                    $this->History->goBack(0);
            }
            $this->Session->setFlash(__('Dotation <b>NON</b> supprimée',true),'flash_failure');
            $this->History->goBack(0);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }
      
    /**
     * met à jour les informlations lors de la réception du matériel
     * 
     * @param string $id
     * @param string $userid
     */
    public function reception($id,$userid){
        $this->Dotation->id = $id;
        $dotation = $this->Dotation->find('all',array('conditions'=>array('Dotation.id'=>$id),'recursive'=>-1));
        $this->Dotation->saveField('DATEREMISE',date('Y-m-d'));
        $this->Dotation->saveField('utilisateur_id',0);
        $history['Historyutilisateur']['utilisateur_id']=$userid;
        $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - mise à jour de la dotation dotation";
        $this->Dotation->Utilisateur->Historyutilisateur->save($history); 				
    }

    /**
     * retourne la liste des dotations
     * 
     * @param string $id
     * @return array
     */
    public function get_list($id){
        $options = array('Dotation.utilisateur_id='.$id);
        return $this->Dotation->find('list',array('fields' => array('Dotation.id','Materielinformatique.NOM'),'conditions' =>$options,'order'=>array('Materielinformatique.NOM'=>'asc','Typemateriel.NOM'=>'asc'),'recursive'=>0));
    }

    /**
     * retourne la liste de dotations
     * 
     * @param string $id
     * @return string
     */
    public function get_all($id){
        $options = array('Dotation.utilisateur_id='.$id);
        return $this->Dotation->find('all',array('conditions' =>$options,'order'=>array('Materielinformatique.NOM'=>'asc','Typemateriel.NOM'=>'asc'),'recursive'=>0));
    }    

    /**
     * retourne le nombre de dotation pour un utilisateur
     * 
     * @param string $id utilisateur
     * @return int
     */
    public function get_compteur($id){
        $options =array('Dotation.utilisateur_id' => $id);
        return $this->Dotation->find('first',array('fields'=>array('count(Dotation.id) AS nbDotation'),'conditions' =>$options,'recursive'=>0));
    }     

    /**
     * 
     * @param type $id
     * @return boolean
     */
    public function ajaxdelete($id=null){
        $this->autoRender = false;
        if (isAuthorized('dotations', 'delete')) :
            $this->Dotation->id = $id;
            if (!$this->Dotation->exists()) {
                    return false;
            }
            if ($this->Dotation->delete()) :
                return true;
            endif;
        else:
            return false;
        endif;
    }

    /**
     * 
     * @param type $obj
     * @return boolean
     */
    public function ajaxadd($obj){
        $this->autoRender = false;
        $record['Dotation']['materielinformatiques_id'] = $obj['Materielinformatique']['id'];
        $record['Dotation']['utilisateur_id'] = $obj['Materielinformatique']['utilisateur_id'];
        $record['Dotation']['DATERECEPTION'] = date('Y-m-d');
        $record['Dotation']['created'] = date('Y-m-d');
        $record['Dotation']['modified'] = date('Y-m-d');
        $this->Dotation->create();
        if($this->Dotation->save($record)):
            return true;
        else:
            return false;
        endif;
    }

    /**
     * 
     */
    public function addto(){
        $this->autoRender = false;
        $this->request->data['Dotation']['created'] = date('Y-m-d');
        $this->request->data['Dotation']['modified'] = date('Y-m-d');
        $this->Dotation->create();
        if($this->Dotation->save($this->request->data)):
            $this->Session->setFlash(__('Dotation sauvegardée',true),'flash_success');
        else:
            $this->Session->setFlash(__('Dotation incorrecte, veuillez corriger la dotation',true),'flash_failure');
        endif;
        $this->History->goback(0);
    }

    /**
     * 
     */
    public function editto(){
        $this->autoRender = false;
        $this->request->data['Dotation']['modified'] = date('Y-m-d');
        $this->Dotation->id = $this->request->data['Dotation']['id'];
        if($this->Dotation->save($this->request->data)):
            $this->Session->setFlash(__('Dotation mise à jour',true),'flash_success');
        else:
            $this->Session->setFlash(__('Dotation incorrecte, veuillez corriger la dotation',true),'flash_failure');
        endif;
        $this->History->goback(0);
    }        

    /**
     * 
     * @param type $id
     * @return type
     */
    public function json_get_this($id=null){
        $this->autoRender = false;
        $result = null;
        if($id!=null):
        $conditions[] = 'Dotation.id='.$id;
        $return = $this->Dotation->find('first',array('conditions'=>$conditions,'recursive'=>-1));
        $result = json_encode($return);
        endif;
        return $result;
    }
}
