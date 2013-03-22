<?php
App::uses('AppController', 'Controller');
/**
 * Listediffusions Controller
 *
 * @property Listediffusion $Listediffusion
 */
class ListediffusionsController extends AppController {

        public $paginate = array(
        'limit' => 15,
        'order' => array('Listediffusion.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
            
/**
 * index method
 *
 * @return void
 */
	public function index() {
            if (isAuthorized('listediffusions', 'index')) :
		$this->set('title_for_layout','Listes de diffusion');
                $this->Listediffusion->recursive = 0;
		$this->set('listediffusions', $this->paginate());
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
            if (isAuthorized('listediffusions', 'view')) :
		$this->set('title_for_layout','Listes de diffusion');
                if (!$this->Listediffusion->exists($id)) {
			throw new NotFoundException(__('Liste de diffusion incorrecte'));
		}
		$options = array('conditions' => array('Listediffusion.' . $this->Listediffusion->primaryKey => $id));
		$this->set('listediffusion', $this->Listediffusion->find('first', $options));
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
            if (isAuthorized('listediffusions', 'add')) :
		$this->set('title_for_layout','Listes de diffusion');
                if ($this->request->is('post')) :
			$this->Listediffusion->create();
			if ($this->Listediffusion->save($this->request->data)) {
				$this->Session->setFlash(__('Liste de diffusion sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Liste de diffusion incorrecte, veuillez corriger la liste de diffusion'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('listediffusions', 'edit')) :
		$this->set('title_for_layout','Listes de diffusion');
                if (!$this->Listediffusion->exists($id)) {
			throw new NotFoundException(__('Liste de diffusion incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Listediffusion->save($this->request->data)) {
				$this->Session->setFlash(__('Liste de diffusion sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Liste de diffusion incorrecte, veuillez corriger la liste de diffusion'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Listediffusion.' . $this->Listediffusion->primaryKey => $id));
			$this->request->data = $this->Listediffusion->find('first', $options);
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
            if (isAuthorized('listediffusions', 'delete')) :
		$this->set('title_for_layout','Listes de diffusion');
                $this->Listediffusion->id = $id;
		if (!$this->Listediffusion->exists()) {
			throw new NotFoundException(__('Liste de diffusion incorrecte'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Listediffusion->delete()) {
			$this->Session->setFlash(__('Liste de diffusion supprimée'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Liste de diffusion NON supprimée'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('listediffusions', 'index')) :
                $this->set('title_for_layout','Listes de diffusion');
                $keyword=$this->params->data['Listediffusion']['SEARCH']; 
                $newconditions = array('OR'=>array("Listediffusion.NOM LIKE '%".$keyword."%'","Listediffusion.DESCRIPTION LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Listediffusion->recursive = 0;
                $this->set('listediffusions', $this->paginate());              
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
        }         
}
