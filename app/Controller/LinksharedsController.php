<?php
App::uses('AppController', 'Controller');
/**
 * Linkshareds Controller
 *
 * @property Linkshared $Linkshared
 */
class LinksharedsController extends AppController {
        public $components = array('History','Common'); 
    public $paginate = array(
        'limit' => 25,
        'order' => array('Linkshared.NOM' => 'asc'),
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
            $this->set('title_for_layout','Liens partagés');
            $this->Linkshared->recursive = 0;
            $this->set('linkshareds', $this->paginate());              
        }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
            if (isAuthorized('linkshareds', 'view')) :
                $this->set('title_for_layout','Liens partagés');
                if (!$this->Linkshared->exists($id)) {
			throw new NotFoundException(__('Lien partagé incorrect'));
		}
		$options = array('conditions' => array('Linkshared.' . $this->Linkshared->primaryKey => $id));
		$this->set('linkshared', $this->Linkshared->find('first', $options));
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
            if (isAuthorized('linkshareds', 'add')) :
                $this->set('title_for_layout','Liens partagés');
                if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Linkshared->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Linkshared->create();
			if ($this->Linkshared->save($this->request->data)) {
				$this->Session->setFlash(__('Lien partagé sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Lien partagé incorrect, veuillez corriger le lien partagé',true),'flash_failure');
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
            if (isAuthorized('linkshareds', 'edit')) :
                $this->set('title_for_layout','Liens partagés');
                if (!$this->Linkshared->exists($id)) {
			throw new NotFoundException(__('Lien partagé incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Linkshared->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Linkshared->save($this->request->data)) {
				$this->Session->setFlash(__('Lien partagé sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Lien partagé incorrect, veuillez corriger le lien partagé',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Linkshared.' . $this->Linkshared->primaryKey => $id));
			$this->request->data = $this->Linkshared->find('first', $options);
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
            if (isAuthorized('linkshareds', 'delete')) :
                $this->set('title_for_layout','Liens partagés');
                $this->Linkshared->id = $id;
		if (!$this->Linkshared->exists()) {
			throw new NotFoundException(__('Lien partagé incorrect'));
		}
		if ($this->Linkshared->delete()) {
			$this->Session->setFlash(__('Lien partagé supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Lien partagé <b>NON</b> supprimé',true),'flash_failure');
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
            if (isAuthorized('linkshareds', 'index')) :
                $this->set('title_for_layout','Liens partagés');
                $keyword=isset($this->params->data['Linkshared']['SEARCH']) ? $this->params->data['Linkshared']['SEARCH'] : '';  
                $newconditions = array('OR'=>array("Linkshared.NOM LIKE '%".$keyword."%'","Linkshared.LINK LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions)); 
                $this->autoRender = false;
                $this->Linkshared->recursive = 0;
                $this->set('linkshareds', $this->paginate());              
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        }   
}        
