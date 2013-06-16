<?php
App::uses('AppController', 'Controller');
/**
 * Tjmagents Controller
 *
 * @property Tjmagent $Tjmagent
 */
class TjmagentsController extends AppController {
        public $components = array('History');
    public $paginate = array(
        'limit' => 15,
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
            if (isAuthorized('tjmagents', 'view')) :
		$this->set('title_for_layout','TJM agents');
                if (!$this->Tjmagent->exists($id)) {
			throw new NotFoundException(__('TJM agent incorrect'));
		}
		$options = array('conditions' => array('Tjmagent.' . $this->Tjmagent->primaryKey => $id),'recursive'=>0);
		$this->set('tjmagent', $this->Tjmagent->find('first', $options));
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
            if (isAuthorized('tjmagents', 'add')) :
		$this->set('title_for_layout','TJM agents');
                if ($this->request->is('post')) :
			$this->Tjmagent->create();
			if ($this->Tjmagent->save($this->request->data)) {
				$this->Session->setFlash(__('TJM agent sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('TJM agent incorrect, veuillez corriger le TJM agent'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('tjmagents', 'edit')) :
		$this->set('title_for_layout','TJM agents');
                if (!$this->Tjmagent->exists($id)) {
			throw new NotFoundException(__('TJM agent incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tjmagent->save($this->request->data)) {
				$this->Session->setFlash(__('TJM agent sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('TJM agent incorrect, veuillez corriger le TJM agent'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Tjmagent.' . $this->Tjmagent->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Tjmagent->find('first', $options);
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
            if (isAuthorized('tjmagents', 'delete')) :
		$this->set('title_for_layout','TJM agents');
                $this->Tjmagent->id = $id;
		if (!$this->Tjmagent->exists()) {
			throw new NotFoundException(__('TJM agent incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Tjmagent->delete()) {
			$this->Session->setFlash(__('TJM agent supprimé'),'default',array('class'=>'alert alert-success'));
			$this->History->goBack();
		}
		$this->Session->setFlash(__('TJM agent <b>NON</b> supprimé'),'default',array('class'=>'alert alert-error'));
		$this->History->goBack();
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
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
        }  
              
}
