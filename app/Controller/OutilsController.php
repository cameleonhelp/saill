<?php
App::uses('AppController', 'Controller');
/**
 * Outils Controller
 *
 * @property Outil $Outil
 */
class OutilsController extends AppController {
        public $components = array('History','Common');
        public $paginate = array(
        'limit' => 25,
        'order' => array('Outil.NOM' => 'asc'),
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
            if (isAuthorized('outils', 'index')) :
		$this->Outil->recursive = 0;
		$this->set('outils', $this->paginate());
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
            if (isAuthorized('outils', 'view')) :
		if (!$this->Outil->exists($id)) {
			throw new NotFoundException(__('Outil incorrect'));
		}
		$options = array('conditions' => array('Outil.' . $this->Outil->primaryKey => $id),'recursive'=>0);
		$this->set('outil', $this->Outil->find('first', $options));
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
            if (isAuthorized('outils', 'add')) :
                $gestionnaire = $this->Outil->Utilisateur->find('list',array('fields' => array('Utilisateur.id', 'Utilisateur.NOMLONG'),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id > 0')));              
                $this->set('gestionnaire',$gestionnaire);            
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Outil->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Outil->create();
			if ($this->Outil->save($this->request->data)) {
				$this->Session->setFlash(__('Outil sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Outil incorrect, veuillez corriger l\'outil',true),'flash_failure');
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
            if (isAuthorized('outils', 'edit')) :
                $gestionnaire = $this->Outil->Utilisateur->find('list',array('fields' => array('Utilisateur.id', 'Utilisateur.NOMLONG'),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id > 0'),'recursive'=>-1));              
                $this->set('gestionnaire',$gestionnaire);            
		if (!$this->Outil->exists($id)) {
			throw new NotFoundException(__('Outil incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Outil->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Outil->save($this->request->data)) {
				$this->Session->setFlash(__('Outil sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Outil incorrect, veuillez corriger l\'outil',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Outil.' . $this->Outil->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Outil->find('first', $options);
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
            if (isAuthorized('outils', 'delete')) :
		$this->Outil->id = $id;
		if (!$this->Outil->exists()) {
			throw new NotFoundException(__('Outil incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Outil->delete()) {
			$this->Session->setFlash(__('Outil supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Outil NON supprimé',true),'flash_failure');
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
            if (isAuthorized('outils', 'index')) :
                $keyword=isset($this->params->data['Outil']['SEARCH']) ? $this->params->data['Outil']['SEARCH'] : '';  
                $newconditions = array('OR'=>array("Outil.NOM LIKE '%".$keyword."%'","Outil.DESCRIPTION LIKE '%".$keyword."%'","(CONCAT(Utilisateur.NOM, ' ', Utilisateur.PRENOM)) LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Outil->recursive = 0;
                $this->set('outils', $this->paginate());              
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        }  
        
        public function get_list_outil(){
            $list = $this->Outil->find('list',array('fields'=>array('id','NOM'),"recursive"=>1));
            return $list;
        }
              
}
