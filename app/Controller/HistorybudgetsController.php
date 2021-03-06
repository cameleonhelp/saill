<?php
App::uses('AppController', 'Controller');
/**
 * Historybudgets Controller
 *
 * @property Historybudget $Historybudget
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class HistorybudgetsController extends AppController {
    /**
     * variables utilisées au niveau du controller
     */
    public $components = array('History','Common');
                        
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Budget d'une activité" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }              
        
    /**
     * permet d'autoriser l'utilisation de méthodes sans authentification
     */
    public function beforeFilter() {   
        $this->Auth->allow(array('json_get_info'));
        parent::beforeFilter();
    }  
        
    /**
     * liste l'historique du budget
     * 
     * @param string $id
     * @throws UnauthorizedException
     */
    public function index($id=null) {
        if (isAuthorized('activites', 'index') && $id!=null) :
            $historybudgets = $this->Historybudget->find('all',array('conditions'=>array('Historybudget.activite_id'=>$id),'recursive'=>-1,'order'=>array('Historybudget.ANNEE'=>'desc')));
            $this->set('historybudgets', $historybudgets);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");           
        endif;  
    }

    /**
     * ajout un historique du budget pour une activité
     * 
     * @param string $activite_id
     * @throws UnauthorizedException
     */
    public function add($activite_id=null) {
        $activite_id = $activite_id==null ? $this->request->data['Historybudget']['activite_id'] : $activite_id;
        $this->set_title();
        $lastcheck = $this->Historybudget->find('first',array('fields'=>array('id'),'conditions'=>array('activite_id'=>$activite_id,'ACTIF'=>1),'recursive'=>0));  
        if (isAuthorized('activites', 'add') && $activite_id!=null) :            
            if ($this->request->is('post')) :
                    $this->Historybudget->create();
                    if ($this->Historybudget->save($this->request->data)) {
                        $history_id = $this->Historybudget->getInsertID();
                        $history = $this->Historybudget->find('first',array('conditions'=>array('id'=>$history_id),'recursive'=>-1));
                        $lastidcheck = isset($lastcheck['Historybudget']['id']) ? $lastcheck['Historybudget']['id'] : null;                          
                        if ($history['Historybudget']['ACTIF']==1) {$this->saveActiviteBudget($history['Historybudget']['activite_id'], $history_id,$lastidcheck);}                          
                    } 
                    $this->Session->setFlash(__('Historique du budget sauvegardé',true),'flash_success');
                    $this->History->goBack(1);
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");           
        endif;                 
    }

    /**
     * modification d'un buget d'une activité
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        $this->set_title();
        $id = $id == null ? $this->request->data['Historybudget']['id'] : $id;
        if (isAuthorized('activites', 'edit') && $id!=null) :
            if (!$this->Historybudget->exists($id)) {
                    throw new NotFoundException(__('Historique de budget invalide.'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Historybudget->validate = array();
                    $this->History->goBack(1);
                else:    
                    $history = $this->Historybudget->find('first',array('conditions'=>array('id'=>$id),'recursive'=>-1));
                    $lastcheck = $this->Historybudget->find('first',array('fields'=>array('id'),'conditions'=>array('activite_id'=>$history['Historybudget']['activite_id'],'ACTIF'=>1),'recursive'=>-1)); 
                    $lastidcheck = isset($lastcheck['Historybudget']['id']) ? $lastcheck['Historybudget']['id'] : null;
                    $this->Historybudget->id = $id;
                    if ($this->Historybudget->save($this->request->data)) {
                        $newhistory = $this->Historybudget->find('first',array('conditions'=>array('id'=>$id),'recursive'=>-1));
                        if ($newhistory['Historybudget']['ACTIF']==1) {$this->saveActiviteBudget($newhistory['Historybudget']['activite_id'], $id,$lastidcheck);}
                        if ($history['Historybudget']['ACTIF']==1 && $newhistory['Historybudget']['ACTIF']==0){$this->resethistory($id,$newhistory['Historybudget']['activite_id']);}
                        $this->Session->setFlash(__('Historique du budget modifié',true),'flash_success');
                        $this->History->goBack(1);                       
                    } 
                endif;
            } else {
                    $options = array('conditions' => array('Historybudget.' . $this->Historybudget->primaryKey => $id));
                    $this->request->data = $this->Historybudget->find('first', $options);
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");           
        endif; 
    }

    /**
     * supprime le budget sur une activité
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        if (isAuthorized('activites', 'delete') && $id!=null) :
            $this->Historybudget->id = $id;
            if (!$this->Historybudget->exists()) {
                    throw new NotFoundException(__('Historique de budget invalide.'));
            }
            $newhistory = $this->Historybudget->find('first',array('conditions'=>array('id'=>$id),'recursive'=>-1));
            if ($this->Historybudget->delete()) {
                    if ($newhistory['Historybudget']['ACTIF']==1){$this->resethistory($id,$newhistory['Historybudget']['activite_id']);}
                    $this->Session->setFlash(__('Historique de l\'activité supprimé',true),'flash_success');
                    $this->History->goBack(0);
            }
            $this->Session->setFlash(__('Historique de l\'activité <b>NON</b> supprimé',true),'flash_failure');
            $this->History->goBack(0);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");         
        endif;                   
    }

    /**
     * déclare un budget actif
     * 
     * @throws UnauthorizedException
     */
    public function budgetisactif(){
        if (isAuthorized('activites', 'edit')) :
            $id = $this->request->data('id');
            $activite_id = $this->request->data('activite_id');
            $lastcheck = $this->Historybudget->find('first',array('fields'=>array('id'),'conditions'=>array('activite_id'=>$activite_id,'ACTIF'=>1),'recursive'=>-1)); 
            $lastidcheck = isset($lastcheck['Historybudget']['id']) ? $lastcheck['Historybudget']['id'] : null;
            $this->saveActiviteBudget($activite_id,$id,$lastidcheck);
            $this->Historybudget->id = $id;
            $this->Historybudget->saveField('ACTIF', 1);
            exit();
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");           
        endif;             
    }

    /**
     * enregistre le budget sur l'activité
     * 
     * @param string $activite_id
     * @param string $history_id
     * @param string $lastcheck
     */
    public function saveActiviteBudget($activite_id=null,$history_id=null,$lastcheck=null){
        if($history_id != null):
        $history = $this->Historybudget->find('first',array('conditions'=>array('Historybudget.id'=>$history_id)));
        $this->Historybudget->Activite->id=$activite_id;
        $this->Historybudget->Activite->saveField('BUDJETRA', $history['Historybudget']['PREVU']);
        $this->Historybudget->Activite->saveField('BUDGETREVU', $history['Historybudget']['REVU']);
        if ($lastcheck!=null && $lastcheck!=$history_id):
            $this->Historybudget->id = $lastcheck;
            $this->Historybudget->saveField('ACTIF', 0);
        endif;
        endif;
    }

    /**
     * vide les information saisie précédemment
     * 
     * @param string $id
     * @param string $activite_id
     */
    public function resethistory($id=null,$activite_id=null){
        $this->Historybudget->Activite->id=$activite_id;
        $this->Historybudget->Activite->saveField('BUDJETRA', '');
        $this->Historybudget->Activite->saveField('BUDGETREVU', '');            
        $this->Historybudget->id = $id;
        $this->Historybudget->saveField('ACTIF', 0);            
    }

    /**
     * renvois les informations du budget
     * 
     * @param string $id
     * @return json
     */
    public function json_get_info($id){
        $this->autoRender = false;
        $conditions[] = 'Historybudget.id='.$id;
        $return = $this->Historybudget->find('all',array('conditions'=>$conditions,'recursive'=>-1));
        $result = json_encode($return);
        return $result;
    }

    /**
     * mise à jour dynamique du budget
     * 
     * @throws UnauthorizedException
     */
    public function ajaxedit() {
        $this->autoRender = false;
        if (isAuthorized('activites', 'edit')) :
            if ($this->request->is('post') || $this->request->is('put')) :
                    $id = $this->request->data['Historybudget']['id'];
                    if ($this->Historybudget->save($this->request->data)) {
                            $this->Session->setFlash(__('Modification sauvegardée',true),'flash_success');
                    } else {
                            $this->Session->setFlash(__('Objet incorrect, veuillez corriger l\'objet',true),'flash_failure');
                    }
                    $this->History->notmove();                        
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }  
}
