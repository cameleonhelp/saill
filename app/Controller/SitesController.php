<?php
App::uses('AppController', 'Controller');
/**
 * Sites Controller
 *
 * @property Site $Site
 */
class SitesController extends AppController {
        public $components = array('History','Common'); 
    public $paginate = array(
        'limit' => 25,
        'order' => array('Site.NOM' => 'asc'),
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
            if (isAuthorized('sites', 'index')) :
		$this->Site->recursive = 0;
		$this->set('sites', $this->paginate());
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
            if (isAuthorized('sites', 'view')) :
		if (!$this->Site->exists($id)) {
			throw new NotFoundException(__('Site incorrect'));
		}
		$options = array('conditions' => array('Site.' . $this->Site->primaryKey => $id),'recursive'=>0);
		$this->set('site', $this->Site->find('first', $options));
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
            if (isAuthorized('sites', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Site->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Site->create();
			if ($this->Site->save($this->request->data)) {
				$this->Session->setFlash(__('Site sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Site incorrecte, veuillez corriger le site',true),'flash_failure');
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
            if (isAuthorized('sites', 'edit')) :
		if (!$this->Site->exists($id)) {
			throw new NotFoundException(__('Site incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Site->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Site->save($this->request->data)) {
				$this->Session->setFlash(__('Site sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Site incorrect, veuillez corriger le site',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Site.' . $this->Site->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Site->find('first', $options);
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
            if (isAuthorized('sites', 'delete')) :
		$this->Site->id = $id;
		if (!$this->Site->exists()) {
			throw new NotFoundException(__('Site incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Site->delete()) {
			$this->Session->setFlash(__('Site supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(___('Site <b>NON</b> supprimé',true),'flash_failure');
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
            if (isAuthorized('sites', 'index')) :
                $keyword=isset($this->params->data['Site']['SEARCH']) ? $this->params->data['Site']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Site.NOM LIKE '%".$keyword."%'","Site.DESCRIPTION LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Site->recursive = 0;
                $this->set('sites', $this->paginate());              
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        }         
}
