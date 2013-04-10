<?php
App::uses('AppController', 'Controller');
/**
 * Detailplancharges Controller
 *
 * @property Detailplancharge $Detailplancharge
 */
class DetailplanchargesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index($id=null) {
            if (isAuthorized('plancharges', 'index')) :
                $this->set('title_for_layout','Plan de charge');             
		$this->Detailplancharge->recursive = 0;
		$this->set('detailplancharges', $this->paginate());
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
	public function add($id=null) {
            if (isAuthorized('plancharges', 'add')) :
                $this->set('title_for_layout','Plan de charge');  
                /** lister tous les utilisateur pouvant être ajouter au plan de charge **/
                
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();            
            endif;  
        }
        
        
        public function save(){
                $this->set('title_for_layout','Plan de charge');            
		if ($this->request->is('post')) :
			$this->Detailplancharge->create();
			if ($this->Detailplancharge->save($this->request->data)) {
				$this->Session->setFlash(__('Plan de charge sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Plan de charge incorrect, veuillez corriger le plan de charge'),'default',array('class'=>'alert alert-error'));
			}
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
            if (isAuthorized('plancharges', 'add')) :
                $this->set('title_for_layout','Plan de charge'); 
                $newconditions = array('Detailplancharge.plancharge_id'=>$id);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));            
		$this->Detailplancharge->recursive = 0;
		$this->set('detailplancharges', $this->paginate());
                $this->render('index');
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
		$this->Detailplancharge->id = $id;
		if (!$this->Detailplancharge->exists()) {
			throw new NotFoundException(__('Plan de charge incorrect'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Detailplancharge->delete()) {
			$this->Session->setFlash(__('Detailplancharge deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Detailplancharge was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
