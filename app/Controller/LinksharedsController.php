<?php
App::uses('AppController', 'Controller');
/**
 * Linkshareds Controller
 *
 * @property Linkshared $Linkshared
 */
class LinksharedsController extends AppController {
 
    public $paginate = array(
        'limit' => 15,
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
            if (isAuthorized('linkshareds', 'add')) :
                $this->set('title_for_layout','Liens partagés');
                if ($this->request->is('post')) :
			$this->Linkshared->create();
			if ($this->Linkshared->save($this->request->data)) {
				$this->Session->setFlash(__('Lien partagé sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Lien partagé incorrect, veuillez corriger le lien partagé'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('linkshareds', 'edit')) :
                $this->set('title_for_layout','Liens partagés');
                if (!$this->Linkshared->exists($id)) {
			throw new NotFoundException(__('Lien partagé incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Linkshared->save($this->request->data)) {
				$this->Session->setFlash(__('Lien partagé sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Lien partagé incorrect, veuillez corriger le lien partagé'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Linkshared.' . $this->Linkshared->primaryKey => $id));
			$this->request->data = $this->Linkshared->find('first', $options);
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
            if (isAuthorized('linkshareds', 'delete')) :
                $this->set('title_for_layout','Liens partagés');
                $this->Linkshared->id = $id;
		if (!$this->Linkshared->exists()) {
			throw new NotFoundException(__('Lien partagé incorrect'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Linkshared->delete()) {
			$this->Session->setFlash(__('Lien partagé supprimé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Lien partagé <b>NON</b> supprimé'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('linkshareds', 'index')) :
                $this->set('title_for_layout','Liens partagés');
                $keyword=$this->params->data['Linkshared']['SEARCH']; 
                $newconditions = array('OR'=>array("Linkshared.NOM LIKE '%".$keyword."%'","Linkshared.LINK LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions)); 
                $this->autoRender = false;
                $this->Linkshared->recursive = 0;
                $this->set('linkshareds', $this->paginate());              
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
        }   
}        
