<?php
App::uses('AppController', 'Controller');
/**
 * Materielautres Controller
 *
 * @property Materielautre $Materielautre
 */
class MaterielautresController extends AppController {
 
    public $paginate = array(
        'limit' => 15,
        'order' => array('Materielautre.typemateriel_id' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
                $this->set('title_for_layout','Périphériques');
		$this->Materielautre->recursive = 0;
		$this->set('materielautres', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
                $this->set('title_for_layout','Périphériques');
                if (!$this->Materielautre->exists($id)) {
			throw new NotFoundException(__('Périphérique incorrect'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Materielautre.' . $this->Materielautre->primaryKey => $id));
		$this->set('materielautre', $this->Materielautre->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $this->set('title_for_layout','Périphériques');
                $peripherique = $this->Materielautre->Typemateriel->find('list',array('fields' => array('id', 'NOM')));
                $this->set('peripherique',$peripherique);                
		if ($this->request->is('post')) {
			$this->Materielautre->create();
			if ($this->Materielautre->save($this->request->data)) {
				$this->Session->setFlash(__('Périphérique sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Périphérique incorrect, veuillez corriger le périphérique'),true,array('class'=>'alert alert-error'));
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
                $this->set('title_for_layout','Périphériques');
                $peripherique = $this->Materielautre->Typemateriel->find('list',array('fields' => array('id', 'NOM')));
                $this->set('peripherique',$peripherique); 
                if (!$this->Materielautre->exists($id)) {
			throw new NotFoundException(__('Périphérique incorrect'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Materielautre->save($this->request->data)) {
				$this->Session->setFlash(__('Périphérique sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Périphérique incorrect, veuillez corriger le périphérique'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Materielautre.' . $this->Materielautre->primaryKey => $id));
			$this->request->data = $this->Materielautre->find('first', $options);
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
                $this->set('title_for_layout','Périphériques');
		$this->Materielautre->id = $id;
		if (!$this->Materielautre->exists()) {
			throw new NotFoundException(__('Périphérique incorrect'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Materielautre->delete()) {
			$this->Session->setFlash(__('Périphérique supprimé'),true,array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Périphérique <b>NON</b> supprimé'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}
        
/**
 * dupliquer method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function dupliquer($id = null) {
                $this->set('title_for_layout','Périphériques');
		$this->Materielautre->id = $id;
                $record = $this->Materielautre->read();
                unset($record['Materielautre']['id']);
                unset($record['Materielautre']['created']);
                unset($record['Materielautre']['modified']);
                $this->Materielautre->create();
                if ($this->Materielautre->save($record)) {
                        $this->Session->setFlash(__('Périphérique dupliqué'),true,array('class'=>'alert alert-success'));
                        $this->redirect(array('action' => 'index'));
                } 
		$this->Session->setFlash(__('Périphérique <b>NON</b> dupliqué'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}        
}
