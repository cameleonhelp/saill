<?php
App::uses('AppController', 'Controller');
/**
 * Activitesreelles Controller
 *
 * @property Activitesreelle $Activitesreelle
 */
class ActivitesreellesController extends AppController {

        public $paginate = array(
        'limit' => 15,
        'order' => array('Activitesreelle.DATE' => 'desc'),
        );
        
/**
 * index method
 *
 * @return void
 */
	public function index($id=null) {
                $this->set('title_for_layout','Feuilles de temps');
		$this->Activitesreelle->recursive = 0;
		$this->set('activitesreelles', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
                $this->set('title_for_layout','Feuilles de temps');            
		if (!$this->Activitesreelle->exists($id)) {
			throw new NotFoundException(__('Feuille de temps incorrecte'));
		}
		$options = array('conditions' => array('Activitesreelle.' . $this->Activitesreelle->primaryKey => $id));
		$this->set('activitesreelle', $this->Activitesreelle->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $this->set('title_for_layout','Feuilles de temps');            
		if ($this->request->is('post')) {
			$this->Activitesreelle->create();
			if ($this->Activitesreelle->save($this->request->data)) {
				$this->Session->setFlash(__('Feuille de temps sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Feuille de temps incorrecte, veuillez corriger la feuille de temps'),'default',array('class'=>'alert alert-error'));
			}
		}
		$utilisateurs = $this->Activitesreelle->Utilisateur->find('list');
		$actions = $this->Activitesreelle->Action->find('list');
		$this->set(compact('utilisateurs', 'actions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
                $this->set('title_for_layout','Feuilles de temps');            
		if (!$this->Activitesreelle->exists($id)) {
			throw new NotFoundException(__('Feuille de temps incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Activitesreelle->save($this->request->data)) {
				$this->Session->setFlash(__('Feuille de temps sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Feuille de temps incorrecte veuillez corriger la feuille de temps'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Activitesreelle.' . $this->Activitesreelle->primaryKey => $id));
			$this->request->data = $this->Activitesreelle->find('first', $options);
		}
		$utilisateurs = $this->Activitesreelle->Utilisateur->find('list');
		$actions = $this->Activitesreelle->Action->find('list');
		$this->set(compact('utilisateurs', 'actions'));
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
                $this->set('title_for_layout','Feuilles de temps');            
		$this->Activitesreelle->id = $id;
		if (!$this->Activitesreelle->exists()) {
			throw new NotFoundException(__('Feuille de temps incorrecte'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Activitesreelle->delete()) {
				$this->Session->setFlash(__('Feuille de temps supprimée'),'default',array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index'));
		}
				$this->Session->setFlash(__('Feuille de temps <b>NON</b> supprimée'),'default',array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $this->set('title_for_layout','feuilles de temps');
                $keyword=$this->params->data['Activitesreelle']['SEARCH']; 
                $newconditions = array('OR'=>array("Utilisateur.NOM LIKE '%".$keyword."%'","Utilisateur.PRENOM LIKE '%".$keyword."%'","Activite.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Listediffusion->recursive = 0;
                $this->set('activitesreelles', $this->paginate());              
                $this->render('index');
        }            
}
