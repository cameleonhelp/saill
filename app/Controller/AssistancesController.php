<?php
App::uses('AppController', 'Controller');
/**
 * Assistances Controller
 *
 * @property Assistance $Assistance
 */
class AssistancesController extends AppController {

        public $paginate = array(
        'limit' => 15,
        'order' => array('Assistance.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
        
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Assistance->recursive = 0;
		$this->set('assistances', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Assistance->exists($id)) {
			throw new NotFoundException(__('Assistance incorrecte'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Assistance.' . $this->Assistance->primaryKey => $id));
		$this->set('assistance', $this->Assistance->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Assistance->create();
			if ($this->Assistance->save($this->request->data)) {
				$this->Session->setFlash(__('Assistance sauvegardée'),true,array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Assistance incorrecte, veuillez corriger l\'assistance'),true,array('class'=>'alert alert-error'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Assistance->exists($id)) {
			throw new NotFoundException(__('Assistance incorrectee'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Assistance->save($this->request->data)) {
				$this->Session->setFlash(__('Assistance sauvegardée'),true,array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Assistance incorrecte, veuillez corriger l\'assistance'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Assistance.' . $this->Assistance->primaryKey => $id));
			$this->request->data = $this->Assistance->find('first', $options);
		}
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
		$this->Assistance->id = $id;
		if (!$this->Assistance->exists()) {
			throw new NotFoundException(__('Assistance incorrecte'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Assistance->delete()) {
			$this->Session->setFlash(__('Assistance supprimée'),true,array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Assistance NON supprimée'),true,array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $keyword=$this->params->data['Assistance']['SEARCH']; 
                $newconditions = array('OR'=>array("Assistance.NOM LIKE '%".$keyword."%'","Assistance.DESCRIPTION LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Assistance->recursive = 0;
                $this->set('assistances', $this->paginate());           
                $this->render('/Assistances/index');
        }         
}
