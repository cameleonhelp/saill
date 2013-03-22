<?php
App::uses('AppController', 'Controller');
/**
 * Societes Controller
 *
 * @property Societe $Societe
 */
class SocietesController extends AppController {
 
    public $paginate = array(
        'limit' => 15,
        'order' => array('Societe.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
            if (isAuthorized('societes', 'index')) :
		$this->Societe->recursive = 0;
		$this->set('societes', $this->paginate());
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
            if (isAuthorized('societes', 'view')) :
		if (!$this->Societe->exists($id)) {
			throw new NotFoundException(__('Société incorrecte'));
		}
		$options = array('conditions' => array('Societe.' . $this->Societe->primaryKey => $id));
		$this->set('societe', $this->Societe->find('first', $options));
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
            if (isAuthorized('societes', 'add')) :
		if ($this->request->is('post')) :
			$this->Societe->create();
			if ($this->Societe->save($this->request->data)) {
				$this->Session->setFlash(__('Société sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Société incorrecte, veuillez corriger la société'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('societes', 'edit')) :
		if (!$this->Societe->exists($id)) {
			throw new NotFoundException(__('Société incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Societe->save($this->request->data)) {
				$this->Session->setFlash(__('Société sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Société incorrecte, veuillez corriger la société'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Societe.' . $this->Societe->primaryKey => $id));
			$this->request->data = $this->Societe->find('first', $options);
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
            if (isAuthorized('societes', 'delete')) :
		$this->Societe->id = $id;
		if (!$this->Societe->exists()) {
			throw new NotFoundException(__('Société incorrecte'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Societe->delete()) {
			$this->Session->setFlash(__('Société supprimé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Société <b>NON</b> supprime'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('societes', 'index')) :
                $keyword=$this->params->data['Societe']['SEARCH']; 
                $newconditions = array('OR'=>array("Societe.NOM LIKE '%".$keyword."%'","Societe.NOMCONTACT LIKE '%".$keyword."%'","Societe.TELEPHONE LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Societe->recursive = 0;
                $this->set('societes', $this->paginate());              
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
        }            
}
