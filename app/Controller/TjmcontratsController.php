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
		$this->set('title_for_layout','TJM contrats');
                $this->Tjmcontrat->recursive = 0;
		$this->set('tjmcontrats', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('title_for_layout','TJM contrats');
                if (!$this->Tjmcontrat->exists($id)) {
			throw new NotFoundException(__('TJM contrat incorrect'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Tjmcontrat.' . $this->Tjmcontrat->primaryKey => $id));
		$this->set('tjmcontrat', $this->Tjmcontrat->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','TJM contrats');
                if ($this->request->is('post')) {
			$this->Tjmcontrat->create();
			if ($this->Tjmcontrat->save($this->request->data)) {
				$this->Session->setFlash(__('TJM contrat sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('TJM contrat incorrect, veuillez corriger le TJM contrat'),true,array('class'=>'alert alert-error'));
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
		$this->set('title_for_layout','TJM contrats');
                if (!$this->Tjmcontrat->exists($id)) {
			throw new NotFoundException(__('TJM contrat incorrect'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Tjmcontrat->save($this->request->data)) {
				$this->Session->setFlash(__('TJM contrat sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('TJM contrat incorrect, veuillez corriger le TJM contrat'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Tjmcontrat.' . $this->Tjmcontrat->primaryKey => $id));
			$this->request->data = $this->Tjmcontrat->find('first', $options);
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
		$this->set('title_for_layout','TJM contrats');
                $this->Tjmcontrat->id = $id;
		if (!$this->Tjmcontrat->exists()) {
			throw new NotFoundException(__('TJM contrat incorrect'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Tjmcontrat->delete()) {
			$this->Session->setFlash(__('TJM contrat supprimé'),true,array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('TJM contrat <b>NON</b> supprimé'),true,array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $this->set('title_for_layout','TJM contrats');
                $keyword=$this->params->data['Tjmcontrat']['SEARCH']; 
                $newconditions = array('OR'=>array("Tjmcontrat.TJM LIKE '%".$keyword."%'","Tjmcontrat.ANNEE LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions)); 
                $this->autoRender = false;
                $this->Tjmcontrat->recursive = 0;
                $this->set('tjmcontrats', $this->paginate());            
                $this->render('index');
        }         
}
