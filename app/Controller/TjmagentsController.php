<?php
App::uses('AppController', 'Controller');
/**
 * Tjmagents Controller
 *
 * @property Tjmagent $Tjmagent
 */
class TjmagentsController extends AppController {
        public $components = array('History','Common');
    public $paginate = array(
        'limit' => 25,
        'order' => array('Tjmagent.NOM' => 'asc'),
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
            //$this->Session->delete('history');
            if (isAuthorized('tjmagents', 'index')) :
		$this->set('title_for_layout','TJM agents');
                $this->Tjmagent->recursive = 0;
		$this->set('tjmagents', $this->paginate());
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
            if (isAuthorized('tjmagents', 'view')) :
		$this->set('title_for_layout','TJM agents');
                if (!$this->Tjmagent->exists($id)) {
			throw new NotFoundException(__('TJM agent incorrect'));
		}
		$options = array('conditions' => array('Tjmagent.' . $this->Tjmagent->primaryKey => $id),'recursive'=>0);
		$this->set('tjmagent', $this->Tjmagent->find('first', $options));
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
            if (isAuthorized('tjmagents', 'add')) :
		$this->set('title_for_layout','TJM agents');
                if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Tjmagent->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Tjmagent->create();
			if ($this->Tjmagent->save($this->request->data)) {
				$this->Session->setFlash(__('TJM agent sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('TJM agent incorrect, veuillez corriger le TJM agent',true),'flash_failure');
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
            if (isAuthorized('tjmagents', 'edit')) :
		$this->set('title_for_layout','TJM agents');
                if (!$this->Tjmagent->exists($id)) {
			throw new NotFoundException(__('TJM agent incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Tjmagent->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Tjmagent->save($this->request->data)) {
				$this->Session->setFlash(__('TJM agent sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('TJM agent incorrect, veuillez corriger le TJM agent',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Tjmagent.' . $this->Tjmagent->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Tjmagent->find('first', $options);
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
            if (isAuthorized('tjmagents', 'delete')) :
		$this->set('title_for_layout','TJM agents');
                $this->Tjmagent->id = $id;
		if (!$this->Tjmagent->exists()) {
			throw new NotFoundException(__('TJM agent incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Tjmagent->delete()) {
			$this->Session->setFlash(__('TJM agent supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('TJM agent <b>NON</b> supprimé',true),'flash_failure');
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
            if (isAuthorized('tjmagents', 'index')) :
                $this->set('title_for_layout','TJM agents');
                $keyword=isset($this->params->data['Tjmagent']['SEARCH']) ? $this->params->data['Tjmagent']['SEARCH'] : '';  
                $newconditions = array('OR'=>array("Tjmagent.NOM LIKE '%".$keyword."%'","Tjmagent.ANNEE LIKE '%".$keyword."%'","Tjmagent.TARIFHT LIKE '%".$keyword."%'","Tjmagent.TARIFTTC LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions)); 
                $this->autoRender = false;
                $this->Tjmagent->recursive = 0;
                $this->set('tjmagents', $this->paginate());            
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        }  
              
}
