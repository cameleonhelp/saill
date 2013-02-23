<?php
App::uses('AppController', 'Controller');
/**
 * Materielinformatiques Controller
 *
 * @property Materielinformatique $Materielinformatique
 */
class MaterielinformatiquesController extends AppController {
 
    public $paginate = array(
        'limit' => 15,
        'order' => array('Materielinformatique.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
                $this->set('title_for_layout','Postes informatique');
		$this->Materielinformatique->recursive = 0;
		$this->set('materielinformatiques', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('title_for_layout','Postes informatique');
                if (!$this->Materielinformatique->exists($id)) {
			throw new NotFoundException(__('Postes informatique incorrect'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Materielinformatique.' . $this->Materielinformatique->primaryKey => $id));
		$this->set('materielinformatique', $this->Materielinformatique->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $peripherique = $this->Materielinformatique->Typemateriel->find('list',array('fields' => array('id', 'NOM')));
                $this->set('peripherique',$peripherique);                
                $section = $this->Materielinformatique->Section->find('list',array('fields' => array('id', 'NOM')));
                $this->set('section',$section);  
                $assistance = $this->Materielinformatique->Assistance->find('list',array('fields' => array('id', 'NOM')));
                $this->set('assistance',$assistance); 
                $etat = Configure::read('etatMaterielInformatique');
                $this->set('etat',$etat); 
                $this->set('title_for_layout','Postes informatique');
                if ($this->request->is('post')) {
			$this->Materielinformatique->create();
			if ($this->Materielinformatique->save($this->request->data)) {
				$this->Session->setFlash(__('Postes informatique sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Postes informatique incorrect, veuillez corriger le poste informatique'),true,array('class'=>'alert alert-error'));
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
		$this->set('title_for_layout','Postes informatique');
                $peripherique = $this->Materielinformatique->Typemateriel->find('list',array('fields' => array('id', 'NOM')));
                $this->set('peripherique',$peripherique);                
                $section = $this->Materielinformatique->Section->find('list',array('fields' => array('id', 'NOM')));
                $this->set('section',$section);  
                $assistance = $this->Materielinformatique->Assistance->find('list',array('fields' => array('id', 'NOM')));
                $this->set('assistance',$assistance); 
                $etat = Configure::read('etatMaterielInformatique');
                $this->set('etat',$etat); 
                if (!$this->Materielinformatique->exists($id)) {
			throw new NotFoundException(__('Postes informatique incorrect'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Materielinformatique->save($this->request->data)) {
				$this->Session->setFlash(__('Postes informatique sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Postes informatique incorrect, veuillez corriger le poste informatique'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Materielinformatique.' . $this->Materielinformatique->primaryKey => $id));
			$this->request->data = $this->Materielinformatique->find('first', $options);
                        $this->set('materielinformatique',$this->request->data);
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
		$this->set('title_for_layout','Postes informatique');
                $this->Materielinformatique->id = $id;
		if (!$this->Materielinformatique->exists()) {
			throw new NotFoundException(__('Postes informatique incorrect'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Materielinformatique->delete()) {
			$this->Session->setFlash(__('Postes informatique supprimé'),true,array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Postes informatique <b>NON</b> supprimé'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}
}
