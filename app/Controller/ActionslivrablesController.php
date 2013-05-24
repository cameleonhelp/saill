<?php
App::uses('AppController', 'Controller');
/**
 * Actionslivrables Controller
 *
 * @property Actionslivrable $Actionslivrable
 */
class ActionslivrablesController extends AppController {
        public $components = array('History');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Actionslivrable->recursive = 0;
		$this->set('actionslivrables', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Actionslivrable->exists($id)) {
			throw new NotFoundException(__('Invalid actionslivrable'));
		}
		$options = array('conditions' => array('Actionslivrable.' . $this->Actionslivrable->primaryKey => $id));
		$this->set('actionslivrable', $this->Actionslivrable->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id=null) {
                $this->set('title_for_layout','Association d\'un livrable à une action');
		if ($this->request->is('post')) {
			$this->Actionslivrable->create();
			if ($this->Actionslivrable->save($this->request->data)) {
				$this->Session->setFlash(__('Livrable ajouté à l\'action'),'default',array('class'=>'alert alert-success'));
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Le livrable n\'a pas été ajouté à l\'action'),'default',array('class'=>'alert alert-error'));
			}
		}
		$livrables = $this->Actionslivrable->Livrable->find('list',array('fields'=>array('Livrable.id','Livrable.NOM'),'order'=>array('Livrable.NOM'=>'asc'))); //,'conditions'=>array('Actionslivrable.action_id'=>$id)
		$this->set(compact('livrables'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
                $this->set('title_for_layout','Association d\'un livrable à une action');
		if (!$this->Actionslivrable->exists($id)) {
			throw new NotFoundException(__('Association incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Actionslivrable->save($this->request->data)) {
				$this->Session->setFlash(__('The actionslivrable has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The actionslivrable could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Actionslivrable.' . $this->Actionslivrable->primaryKey => $id));
			$this->request->data = $this->Actionslivrable->find('first', $options);
		}
		$livrables = $this->Actionslivrable->Livrable->find('list',array('fields'=>array('Livrable.id','Livrable.NOM'),'order'=>array('Livrable.NOM'=>'asc'))); //,'conditions'=>array('Actionslivrable.action_id'=>$id)
		$actions = $this->Actionslivrable->Action->find('list',array('fields'=>array('Action.id','Action.OBJET'),'order'=>array('Action.OBJET'=>'asc'))); //,'conditions'=>array('Actionslivrable.action_id'=>$id)
		$this->set(compact('livrables', 'actions'));
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
                $this->set('title_for_layout','Association d\'un livrable à une action');
		$this->Actionslivrable->id = $id;
		if (!$this->Actionslivrable->exists()) {
			throw new NotFoundException(__('Association incorrecte'));
		}
		if ($this->Actionslivrable->delete()) {
			$this->Session->setFlash(__('Association supprimée'),'default',array('class'=>'alert alert-success'));
			$this->History->goBack();
		}
		$this->Session->setFlash(__('Association <b>NON</b> supprimée'),'default',array('class'=>'alert alert-error'));
		$this->History->goBack();
	}
}
