<?php
App::uses('AppController', 'Controller');
/**
 * Sections Controller
 *
 * @property Section $Section
 */
class SectionsController extends AppController {
        public $components = array('History','Common'); 
    public $paginate = array(
        'limit' => 25,
        'order' => array('Section.NOM' => 'asc'),
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
            if (isAuthorized('sections', 'index')) :
		$this->Section->recursive = 0;
		$this->set('sections', $this->paginate());
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
            if (isAuthorized('sections', 'view')) :
		if (!$this->Section->exists($id)) {
			throw new NotFoundException(__('Section incorrecte'));
		}
		$options = array('conditions' => array('Section.' . $this->Section->primaryKey => $id),'recursive'=>0);
		$this->set('section', $this->Section->find('first', $options));
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
            if (isAuthorized('sections', 'add')) :
                $responsable = $this->Section->Utilisateur->find('list',array('fields' => array('id', 'NOMLONG'),'conditions'=>array('id >'=>1,'HIERARCHIQUE'=>1)));
                $this->set('responsable',$responsable);
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Section->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Section->create();
			if ($this->Section->save($this->request->data)) {
				$this->Session->setFlash(__('Section sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Section incorrecte, veuillez corriger la section',true),'flash_failure');
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
            if (isAuthorized('sections', 'edit')) :
                $responsable = $this->Section->Utilisateur->find('list',array('fields' => array('id', 'NOMLONG'),'conditions'=>array('id >'=>1,'HIERARCHIQUE'=>1)));
                $this->set('responsable',$responsable);		
                if (!$this->Section->exists($id)) {
			throw new NotFoundException(__('Section incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Section->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Section->save($this->request->data)) {
				$this->Session->setFlash(__('Section sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Section incorrecte, veuillez corriger la section',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Section.' . $this->Section->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Section->find('first', $options);
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
            if (isAuthorized('sections', 'delete')) :            
		$this->Section->id = $id;
		if (!$this->Section->exists()) {
			throw new NotFoundException(__('Section incorrecte'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Section->delete()) {
			$this->Session->setFlash(__('Section supprimée',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Section <b>NON</b> supprimée',true),'flash_failure');
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
            if (isAuthorized('sections', 'index')) :
                $keyword=isset($this->params->data['Section']['SEARCH']) ? $this->params->data['Section']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Section.NOM LIKE '%".$keyword."%'","Section.DESCRIPTION LIKE '%".$keyword."%'","(CONCAT(Utilisateur.NOM, ' ', Utilisateur.PRENOM)) LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Section->recursive = 0;
                $this->set('sections', $this->paginate());              
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        }      
        
        public function getList(){
            $sections = $this->Section->find('list', array('fields'=>array('id','NOM'),'order'=>array('NOM'=>'asc'),'recursive'=>-1));
            return $sections;
        }
}
