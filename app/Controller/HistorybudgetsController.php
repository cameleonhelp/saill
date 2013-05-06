<?php
App::uses('AppController', 'Controller');
/**
 * Historybudgets Controller
 *
 * @property Historybudget $Historybudget
 */
class HistorybudgetsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index($id=null) {
            if (isAuthorized('activites', 'index') && $id!=null) :
		$historybudgets = $this->Historybudget->find('all',array('conditions'=>array('Historybudget.activite_id'=>$id),'recursive'=>-1,'order'=>array('Historybudget.ANNEE'=>'desc')));
		$this->set('historybudgets', $historybudgets);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();           
            endif;  
	}

/**
 * add method
 *
 * @return void
 */
	public function add($activite_id=null) {
            $this->set('title_for_layout','Nouveau budget');
            $lastcheck = $this->Historybudget->find('first',array('fields'=>array('id'),'conditions'=>array('activite_id'=>$activite_id,'ACTIF'=>1),'recursive'=>-1));  
            if (isAuthorized('activites', 'add') && $activite_id!=null) :            
		if ($this->request->is('post')) :
			$this->Historybudget->create();
			if ($this->Historybudget->save($this->request->data)) {
                            $history_id = $this->Historybudget->getInsertID();
                            $history = $this->Historybudget->find('first',array('conditions'=>array('id'=>$history_id),'recursive'=>-1));
                            $lastidcheck = isset($lastcheck['Historybudget']['id']) ? $lastcheck['Historybudget']['id'] : null;
                            if ($history['Historybudget']['ACTIF']==1) {$this->saveActiviteBudget($history['Historybudget']['activite_id'], $history_id,$lastidcheck);}                          
			} 
                        $this->Session->setFlash(__('Historique du budget sauvegardé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion(1));                        
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();           
            endif;                 
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
            $this->set('title_for_layout','Modification du budget');
            if (isAuthorized('activites', 'edit') && $id!=null) :
		if (!$this->Historybudget->exists($id)) {
			throw new NotFoundException(__('Historique de budget invalide.'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                        $history = $this->Historybudget->find('first',array('conditions'=>array('id'=>$id),'recursive'=>-1));
                        $lastcheck = $this->Historybudget->find('first',array('fields'=>array('id'),'conditions'=>array('activite_id'=>$history['Historybudget']['activite_id'],'ACTIF'=>1),'recursive'=>-1)); 
			$lastidcheck = isset($lastcheck['Historybudget']['id']) ? $lastcheck['Historybudget']['id'] : null;
                        $this->Historybudget->id = $id;
                        if ($this->Historybudget->save($this->request->data)) {
                            $newhistory = $this->Historybudget->find('first',array('conditions'=>array('id'=>$id),'recursive'=>-1));
                            if ($newhistory['Historybudget']['ACTIF']==1) {$this->saveActiviteBudget($newhistory['Historybudget']['activite_id'], $id,$lastidcheck);}
                            if ($history['Historybudget']['ACTIF']==1 && $newhistory['Historybudget']['ACTIF']==0){$this->resethistory($id,$newhistory['Historybudget']['activite_id']);}
                            $this->Session->setFlash(__('Historique du budget modifié'),'default',array('class'=>'alert alert-success'));
                            $this->redirect($this->goToPostion(1));                             
			} 
		} else {
			$options = array('conditions' => array('Historybudget.' . $this->Historybudget->primaryKey => $id));
			$this->request->data = $this->Historybudget->find('first', $options);
		}
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();           
            endif; 
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
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
                        $this->Session->setFlash(__('Historique de l\'activité supprimé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion(0));
		}
		$this->Session->setFlash(__('Historique de l\'activité <b>NON</b> supprimé'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion(0));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();         
            endif;                   
	}
        
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
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();           
            endif;             
        }
        
        public function saveActiviteBudget($activite_id=null,$history_id=null,$lastcheck=null){
            $history = $this->Historybudget->find('first',array('conditions'=>array('Historybudget.id'=>$history_id)));
            $this->Historybudget->Activite->id=$activite_id;
            $this->Historybudget->Activite->saveField('BUDJETRA', $history['Historybudget']['PREVU']);
            $this->Historybudget->Activite->saveField('BUDGETREVU', $history['Historybudget']['REVU']);
            if ($lastcheck!=null && $lastcheck!=$history_id):
                $this->Historybudget->id = $lastcheck;
                $this->Historybudget->saveField('ACTIF', 0);
            endif;
        }
        
        public function resethistory($id=null,$activite_id=null){
            $this->Historybudget->Activite->id=$activite_id;
            $this->Historybudget->Activite->saveField('BUDJETRA', '');
            $this->Historybudget->Activite->saveField('BUDGETREVU', '');            
            $this->Historybudget->id = $id;
            $this->Historybudget->saveField('ACTIF', 0);            
        }
}
