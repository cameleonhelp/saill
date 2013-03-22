<?php
App::uses('AppController', 'Controller');
/**
 * Tjmcontrats Controller
 *
 * @property Tjmcontrat $Tjmcontrat
 */
class TjmcontratsController extends AppController {
 
    public $paginate = array(
        'limit' => 15,
        'order' => array('Tjmcontrat.TJM' => 'asc'),
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
            if (isAuthorized('tjmcontrats', 'index')) :
		$this->set('title_for_layout','TJM contrats');
                $this->Tjmcontrat->recursive = 0;
		$this->set('tjmcontrats', $this->paginate());
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
            if (isAuthorized('tjmcontrats', 'view')) :
		$this->set('title_for_layout','TJM contrats');
                if (!$this->Tjmcontrat->exists($id)) {
			throw new NotFoundException(__('TJM contrat incorrect'));
		}
		$options = array('conditions' => array('Tjmcontrat.' . $this->Tjmcontrat->primaryKey => $id));
		$this->set('tjmcontrat', $this->Tjmcontrat->find('first', $options));
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
            if (isAuthorized('tjmcontrats', 'add')) :
		$this->set('title_for_layout','TJM contrats');
                if ($this->request->is('post')) :
			$this->Tjmcontrat->create();
			if ($this->Tjmcontrat->save($this->request->data)) {
				$this->Session->setFlash(__('TJM contrat sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('TJM contrat incorrect, veuillez corriger le TJM contrat'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('tjmcontrats', 'edit')) :
		$this->set('title_for_layout','TJM contrats');
                if (!$this->Tjmcontrat->exists($id)) {
			throw new NotFoundException(__('TJM contrat incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tjmcontrat->save($this->request->data)) {
				$this->Session->setFlash(__('TJM contrat sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('TJM contrat incorrect, veuillez corriger le TJM contrat'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Tjmcontrat.' . $this->Tjmcontrat->primaryKey => $id));
			$this->request->data = $this->Tjmcontrat->find('first', $options);
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
            if (isAuthorized('tjmcontrats', 'delete')) :
		$this->set('title_for_layout','TJM contrats');
                $this->Tjmcontrat->id = $id;
		if (!$this->Tjmcontrat->exists()) {
			throw new NotFoundException(__('TJM contrat incorrect'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tjmcontrat->delete()) {
			$this->Session->setFlash(__('TJM contrat supprimé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('TJM contrat <b>NON</b> supprimé'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('tjmcontrats', 'index')) :
                $this->set('title_for_layout','TJM contrats');
                $keyword=$this->params->data['Tjmcontrat']['SEARCH']; 
                $newconditions = array('OR'=>array("Tjmcontrat.TJM LIKE '%".$keyword."%'","Tjmcontrat.ANNEE LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions)); 
                $this->autoRender = false;
                $this->Tjmcontrat->recursive = 0;
                $this->set('tjmcontrats', $this->paginate());            
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
        }         
}
