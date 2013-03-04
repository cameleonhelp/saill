<?php
App::uses('AppController', 'Controller');
/**
 * Domaines Controller
 *
 * @property Domaine $Domaine
 */
class DomainesController extends AppController {

        public $paginate = array(
        'limit' => 15,
        'order' => array('Domaine.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
            
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Domaine->recursive = 0;
		$this->set('domaines', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Domaine->exists($id)) {
			throw new NotFoundException(__('Domaine incorrect'),'default',array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Domaine.' . $this->Domaine->primaryKey => $id));
		$this->set('domaine', $this->Domaine->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Domaine->create();
			if ($this->Domaine->save($this->request->data)) {
				$this->Session->setFlash(__('Domaine sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Domaine incorrect, veuillez corriger le domaine'),'default',array('class'=>'alert alert-error'));
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
		if (!$this->Domaine->exists($id)) {
			throw new NotFoundException(__('Domaine incorrect'),'default',array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Domaine->save($this->request->data)) {
				$this->Session->setFlash(__('Domaine sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Domaine incorrect, veuillez corriger le domaine'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Domaine.' . $this->Domaine->primaryKey => $id));
			$this->request->data = $this->Domaine->find('first', $options);
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
		$this->Domaine->id = $id;
		if (!$this->Domaine->exists()) {
			throw new NotFoundException(__('Domaine incorrect'),'default',array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Domaine->delete()) {
			$this->Session->setFlash(__('Domaine supprimé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Domaine NON supprimé'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $keyword=$this->params->data['Domaine']['SEARCH']; 
                $newconditions = array('OR'=>array("Domaine.NOM LIKE '%".$keyword."%'","Domaine.DESCRIPTION LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Domaine->recursive = 0;
                $this->set('domaines', $this->paginate());               
                $this->render('index');
        }               
}
