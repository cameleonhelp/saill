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
		$this->set('title_for_layout','Types de matériel');
                $this->Typemateriel->recursive = 0;
		$this->set('typemateriels', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('title_for_layout','Types de matériel');
                if (!$this->Typemateriel->exists($id)) {
			throw new NotFoundException(__('Type de matériel incorrect'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Typemateriel.' . $this->Typemateriel->primaryKey => $id));
		$this->set('typemateriel', $this->Typemateriel->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','Types de matériel');
                if ($this->request->is('post')) {
			$this->Typemateriel->create();
			if ($this->Typemateriel->save($this->request->data)) {
				$this->Session->setFlash(__('Type de matériel sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Type de matériel incorrect, veuillez corriger le type de matériel'),true,array('class'=>'alert alert-error'));
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
		$this->set('title_for_layout','Types de matériel');
                if (!$this->Typemateriel->exists($id)) {
			throw new NotFoundException(__('Type de matériel incorrect'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Typemateriel->save($this->request->data)) {
				$this->Session->setFlash(__('Type de matériel sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Type de matériel incorrect, veuillez corriger le type de matériel'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Typemateriel.' . $this->Typemateriel->primaryKey => $id));
			$this->request->data = $this->Typemateriel->find('first', $options);
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
		$this->set('title_for_layout','Types de matériel');
                $this->Typemateriel->id = $id;
		if (!$this->Typemateriel->exists()) {
			throw new NotFoundException(__('Type de matériel incorrect'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Typemateriel->delete()) {
			$this->Session->setFlash(__('Type de matériel supprimé'),true,array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Type de matériel <b>NON</b> supprimé'),true,array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $this->set('title_for_layout','Types de matériel');
                $keyword=$this->params->data['Typemateriel']['SEARCH']; 
                $newconditions = array('OR'=>array("Typemateriel.NOM LIKE '%".$keyword."%'","Typemateriel.DESCRIPTION LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Typemateriel->recursive = 0;
                $this->set('typemateriels', $this->paginate());              
                $this->render('index');
        }            
}
