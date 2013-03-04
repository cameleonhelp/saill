<?php
App::uses('AppController', 'Controller');
/**
 * Tjmagents Controller
 *
 * @property Tjmagent $Tjmagent
 */
class TjmagentsController extends AppController {
 
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
		$this->set('title_for_layout','TJM agents');
                $this->Tjmagent->recursive = 0;
		$this->set('tjmagents', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('title_for_layout','TJM agents');
                if (!$this->Tjmagent->exists($id)) {
			throw new NotFoundException(__('TJM agent incorrect'),'default',array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Tjmagent.' . $this->Tjmagent->primaryKey => $id));
		$this->set('tjmagent', $this->Tjmagent->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','TJM agents');
                if ($this->request->is('post')) {
			$this->Tjmagent->create();
			if ($this->Tjmagent->save($this->request->data)) {
				$this->Session->setFlash(__('TJM agent sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('TJM agent incorrect, veuillez corriger le TJM agent'),'default',array('class'=>'alert alert-error'));
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
		$this->set('title_for_layout','TJM agents');
                if (!$this->Tjmagent->exists($id)) {
			throw new NotFoundException(__('TJM agent incorrect'),'default',array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tjmagent->save($this->request->data)) {
				$this->Session->setFlash(__('TJM agent sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('TJM agent incorrect, veuillez corriger le TJM agent'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Tjmagent.' . $this->Tjmagent->primaryKey => $id));
			$this->request->data = $this->Tjmagent->find('first', $options);
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
		$this->set('title_for_layout','TJM agents');
                $this->Tjmagent->id = $id;
		if (!$this->Tjmagent->exists()) {
			throw new NotFoundException(__('TJM agent incorrect'),'default',array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tjmagent->delete()) {
			$this->Session->setFlash(__('TJM agent supprimé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('TJM agent <b>NON</b> supprimé'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
	}
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $this->set('title_for_layout','TJM agents');
                $keyword=$this->params->data['Tjmagent']['SEARCH']; 
                $newconditions = array('OR'=>array("Tjmagent.NOM LIKE '%".$keyword."%'","Tjmagent.ANNEE LIKE '%".$keyword."%'","Tjmagent.TARIFHT LIKE '%".$keyword."%'","Tjmagent.TARIFTTC LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions)); 
                $this->autoRender = false;
                $this->Tjmagent->recursive = 0;
                $this->set('tjmagents', $this->paginate());            
                $this->render('index');
        }         
}
