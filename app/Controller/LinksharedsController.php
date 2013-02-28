<?php
App::uses('AppController', 'Controller');
/**
 * Linkshareds Controller
 *
 * @property Linkshared $Linkshared
 */
class LinksharedsController extends AppController {
 
    public $paginate = array(
        'limit' => 15,
        'order' => array('Linkshared.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
                $this->set('title_for_layout','Liens partagés');
                $this->Linkshared->recursive = 0;
		$this->set('linkshareds', $this->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
                $this->set('title_for_layout','Liens partagés');
                if (!$this->Linkshared->exists($id)) {
			throw new NotFoundException(__('Lien partagé incorrect'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Linkshared.' . $this->Linkshared->primaryKey => $id));
		$this->set('linkshared', $this->Linkshared->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $this->set('title_for_layout','Liens partagés');
                if ($this->request->is('post')) {
			$this->Linkshared->create();
			if ($this->Linkshared->save($this->request->data)) {
				$this->Session->setFlash(__('Lien partagé sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Lien partagé incorrect, veuillez corriger le lien partagé'),true,array('class'=>'alert alert-error'));
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
                $this->set('title_for_layout','Liens partagés');
                if (!$this->Linkshared->exists($id)) {
			throw new NotFoundException(__('Lien partagé incorrect'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Linkshared->save($this->request->data)) {
				$this->Session->setFlash(__('Lien partagé sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Lien partagé incorrect, veuillez corriger le lien partagé'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Linkshared.' . $this->Linkshared->primaryKey => $id));
			$this->request->data = $this->Linkshared->find('first', $options);
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
                $this->set('title_for_layout','Liens partagés');
                $this->Linkshared->id = $id;
		if (!$this->Linkshared->exists()) {
			throw new NotFoundException(__('Lien partagé incorrect'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Linkshared->delete()) {
			$this->Session->setFlash(__('Lien partagé supprimé'),true,array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Lien partagé <b>NON</b> supprimé'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $this->set('title_for_layout','Liens partagés');
                $keyword=$this->params->data['Linkshared']['SEARCH']; 
                $newconditions = array('OR'=>array("Linkshared.NOM LIKE '%".$keyword."%'","Linkshared.LINK LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions)); 
                $this->autoRender = false;
                $this->Linkshared->recursive = 0;
                $this->set('linkshareds', $this->paginate());              
                $this->render('/linkshareds/index'); 
        }   
}        
