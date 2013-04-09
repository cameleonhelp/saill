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
	public function add() {
            if (isAuthorized('plancharges', 'add')) :
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
		$plancharges = $this->Detailplancharge->Plancharge->find('list');
		$utilisateurs = $this->Detailplancharge->Utilisateur->find('list');
		$domaines = $this->Detailplancharge->Domaine->find('list');
		$activites = $this->Detailplancharge->Activite->find('list');
		$this->set(compact('plancharges', 'utilisateurs', 'domaines', 'activites'));
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
           if (isAuthorized('plancharges', 'edit')) :
                $this->set('title_for_layout','Plan de charge');  
		if (!$this->Detailplancharge->exists($id)) {
			throw new NotFoundException(__('Plan de charge incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Detailplancharge->save($this->request->data)) {
				$this->Session->setFlash(__('Plan de charge sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Plan de charge incorrect, veuillez corriger le plan de charge'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Detailplancharge.' . $this->Detailplancharge->primaryKey => $id));
			$this->request->data = $this->Detailplancharge->find('first', $options);
		}
		$plancharges = $this->Detailplancharge->Plancharge->find('list');
		$utilisateurs = $this->Detailplancharge->Utilisateur->find('list');
		$domaines = $this->Detailplancharge->Domaine->find('list');
		$activites = $this->Detailplancharge->Activite->find('list');
		$this->set(compact('plancharges', 'utilisateurs', 'domaines', 'activites'));
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
