<?php
App::uses('AppController', 'Controller');
/**
 * Dossierpartages Controller
 *
 * @property Dossierpartage $Dossierpartage
 */
class DossierpartagesController extends AppController {
        public $components = array('History','Common');
    public $paginate = array(
        'limit' => 25,
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
            //$this->Session->delete('history');
            if (isAuthorized('dossierpartages', 'index')) :
		$this->set('title_for_layout','Partages réseaux');
                $this->Dossierpartage->recursive = 0;
		$this->set('dossierpartages', $this->paginate());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
                $gestionnaire = $this->Dossierpartage->Utilisateur->find('list',array('fields' => array('Utilisateur.id', 'Utilisateur.NOMLONG'),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id > 0')));              
                $this->set('gestionnaire',$gestionnaire);                
		$this->set('title_for_layout','Partages réseaux');
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
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
                $gestionnaire = $this->Dossierpartage->Utilisateur->find('list',array('fields' => array('Utilisateur.id', 'Utilisateur.NOMLONG'),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id > 0')));              
                $this->set('gestionnaire',$gestionnaire);                
		$this->set('title_for_layout','Partages réseaux');
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
		}
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
			$this->Session->setFlash(__('Dossier partagé supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Dossier partagé NON supprimé',true),'flash_failure');
		$this->History->goBack(1);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        } 
        
        public function get_list_shared(){
            $list = $this->Dossierpartage->find('list',array('fields'=>array('id','NOM'),"recursive"=>1));
            return $list;
        }
}        
