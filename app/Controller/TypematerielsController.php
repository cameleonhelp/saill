<?php
App::uses('AppController', 'Controller');
/**
 * Typemateriels Controller
 *
 * @property Typemateriel $Typemateriel
 */
class TypematerielsController extends AppController {
 
    public $paginate = array(
        'limit' => 15,
        'order' => array('Typemateriel.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
            $this->Session->delete('history');
            if (isAuthorized('typemateriels', 'index')) :
		$this->set('title_for_layout','Types de matériel');
                $this->Typemateriel->recursive = 0;
		$this->set('typemateriels', $this->paginate());
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
            if (isAuthorized('typemateriels', 'view')) :
		$this->set('title_for_layout','Types de matériel');
                if (!$this->Typemateriel->exists($id)) {
			throw new NotFoundException(__('Type de matériel incorrect'));
		}
		$options = array('conditions' => array('Typemateriel.' . $this->Typemateriel->primaryKey => $id),'recursive'=>0);
		$this->set('typemateriel', $this->Typemateriel->find('first', $options));
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
            if (isAuthorized('typemateriels', 'add')) :
		$this->set('title_for_layout','Types de matériel');
                if ($this->request->is('post')) :
			$this->Typemateriel->create();
			if ($this->Typemateriel->save($this->request->data)) {
				$this->Session->setFlash(__('Type de matériel sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Type de matériel incorrect, veuillez corriger le type de matériel'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('typemateriels', 'edit')) :
		$this->set('title_for_layout','Types de matériel');
                if (!$this->Typemateriel->exists($id)) {
			throw new NotFoundException(__('Type de matériel incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Typemateriel->save($this->request->data)) {
				$this->Session->setFlash(__('Type de matériel sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Type de matériel incorrect, veuillez corriger le type de matériel'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Typemateriel.' . $this->Typemateriel->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Typemateriel->find('first', $options);
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
            if (isAuthorized('typemateriels', 'delete')) :
		$this->set('title_for_layout','Types de matériel');
                $this->Typemateriel->id = $id;
		if (!$this->Typemateriel->exists()) {
			throw new NotFoundException(__('Type de matériel incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Typemateriel->delete()) {
			$this->Session->setFlash(__('Type de matériel supprimé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Type de matériel <b>NON</b> supprimé'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('typemateriels', 'index')) :
                $this->set('title_for_layout','Types de matériel');
                $keyword=isset($this->params->data['Typemateriel']['SEARCH']) ? $this->params->data['Typemateriel']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Typemateriel.NOM LIKE '%".$keyword."%'","Typemateriel.DESCRIPTION LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Typemateriel->recursive = 0;
                $this->set('typemateriels', $this->paginate());              
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
        }            
}
