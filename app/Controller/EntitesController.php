<?php
App::uses('AppController', 'Controller');
/**
 * Entites Controller
 *
 * @property Entite $Entite
 * @property PaginatorComponent $Paginator
 */
class EntitesController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $components = array('History','Common');  
        public $paginate = array(
        'limit' => 25,
        'order' => array('Entite.NOM' => 'asc'),
        );

/**
 * index method
 *
 * @return void
 */
	public function index() {
                $this->set('title_for_layout','Cercles de visibilité');
		$this->Entite->recursive = 0;
		$this->set('entites', $this->paginate());
                $all_utilisateurs = $this->requestAction(('utilisateurs/get_list_actif'));
                $utilisateurs_select = null;
                $count_utilisateurs = 0;
                $all_projets = $this->requestAction(('projets/get_list_actif'));
                $projets_select = $this->requestAction('projets/get_list_projet');  
                $count_projets = 0;
                $this->set(compact('all_utilisateurs','utilisateurs_select','all_projets','projets_select','count_utilisateurs','count_projets'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Entite->exists($id)) {
			throw new NotFoundException(__('Invalid entite'));
		}
		$options = array('conditions' => array('Entite.' . $this->Entite->primaryKey => $id));
		$this->set('entite', $this->Entite->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $this->set('title_for_layout','Cercle de visibilité');
		if ($this->request->is('post')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Achat->validate = array();
                        $this->History->goBack(1);
                    else:                      
			$this->Entite->create();
			if ($this->Entite->save($this->request->data)) {
				$this->Session->setFlash(__('The entite has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The entite could not be saved. Please, try again.'));
			}
                    endif;
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
                $this->set('title_for_layout','Cercle de visibilité');
		if (!$this->Entite->exists($id)) {
			throw new NotFoundException(__('Invalid entite'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Achat->validate = array();
                        $this->History->goBack(1);
                    else:                      
                        $this->Entite->id = $id;
			if ($this->Entite->save($this->request->data)) {
				$this->Session->setFlash(__('The entite has been modified.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The entite could not be saved. Please, try again.'));
			}
                    endif;
		} else {
			$options = array('conditions' => array('Entite.' . $this->Entite->primaryKey => $id));
			$this->request->data = $this->Entite->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
                $this->set('title_for_layout','Cercle de visibilité');
		$this->Entite->id = $id;
		if (!$this->Entite->exists()) {
			throw new NotFoundException(__('Invalid entite'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Entite->delete()) {
			$this->Session->setFlash(__('The entite has been deleted.'));
		} else {
			$this->Session->setFlash(__('The entite could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
