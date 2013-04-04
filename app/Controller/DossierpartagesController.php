<?php
App::uses('AppController', 'Controller');
/**
 * Dossierpartages Controller
 *
 * @property Dossierpartage $Dossierpartage
 */
class DossierpartagesController extends AppController {

    public $paginate = array(
        'limit' => 15,
        'order' => array('Dossierpartage.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
            if (isAuthorized('dossierpartages', 'index')) :
		$this->set('title_for_layout','Partages réseaux');
                $this->Dossierpartage->recursive = 0;
		$this->set('dossierpartages', $this->paginate());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
            if (isAuthorized('dossierpartages', 'view')) :
		$this->set('title_for_layout','Partages réseaux');
                if (!$this->Dossierpartage->exists($id)) {
			throw new NotFoundException(__('Dossier partagé incorrecte'));
		}
		$options = array('conditions' => array('Dossierpartage.' . $this->Dossierpartage->primaryKey => $id),'recursive'=>0);
		$this->set('dossierpartage', $this->Dossierpartage->find('first', $options));
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
            if (isAuthorized('dossierpartages', 'add')) :
		$this->set('title_for_layout','Partages réseaux');
                if ($this->request->is('post')) :
			$this->Dossierpartage->create();
			if ($this->Dossierpartage->save($this->request->data)) {
				$this->Session->setFlash(__('Dossier partagé sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Dossier partagé incorrecte, veuilez corriger le dossier partagé'),'default',array('class'=>'alert alert-error'));
			}
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
            if (isAuthorized('dossierpartages', 'edit')) :
		$this->set('title_for_layout','Partages réseaux');
                if (!$this->Dossierpartage->exists($id)) {
			throw new NotFoundException(__('Dossier partagé incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Dossierpartage->save($this->request->data)) {
				$this->Session->setFlash(__('Dossier partagé sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Dossier partagé incorrecte, veuillez corriger le dossier partagé'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Dossierpartage.' . $this->Dossierpartage->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Dossierpartage->find('first', $options);
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
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
            if (isAuthorized('dossierpartages', 'delete')) :
		$this->set('title_for_layout','Partages réseaux');
                $this->Dossierpartage->id = $id;
		if (!$this->Dossierpartage->exists()) {
			throw new NotFoundException(__('Dossier partagé incorrecte'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Dossierpartage->delete()) {
			$this->Session->setFlash(__('Dossier partagé supprimé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Dossier partagé NON supprimé'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
            if (isAuthorized('dossierpartages', 'index')) :
                $this->set('title_for_layout','Partages réseaux');
                $keyword=isset($this->params->data['Dossierpartage']['SEARCH']) ? $this->params->data['Dossierpartage']['SEARCH'] : '';  
                $newconditions = array('OR'=>array("Dossierpartage.NOM LIKE '%".$keyword."%'","Dossierpartage.DESCRIPTION LIKE '%".$keyword."%'","Dossierpartage.GROUPEAD LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Dossierpartage->recursive = 0;
                $this->set('dossierpartages', $this->paginate());              
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
        }            
}        
