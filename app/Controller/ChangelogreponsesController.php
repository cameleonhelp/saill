<?php
App::uses('AppController', 'Controller');
/**
 * Changelogreponses Controller
 *
 * @property Changelogreponse $Changelogreponse
 * @property PaginatorComponent $Paginator
 */
class ChangelogreponsesController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('order'=>array('Changelogreponse.created'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Changelogreponse->recursive = 0;
		$this->set('changelogreponses', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if ($this->request->is('post')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Changelogdemande->validate = array();
                        $this->History->goBack(1);
                    endif;
		}                
                //$id = demande_id
                $this->set('title_for_layout','Liste des réponses');
                $changelogreponses = $this->get_all_reponses($id);
                $changelogdemande = $this->requestAction('changelogdemandes/get_info/'.$id);
		$this->set(compact('changelogreponses','changelogdemande'));
                $changelogetats = Configure::read('changelogEtatDemande');  
                $changelogtypes = Configure::read('changelogType');  
                $changelogcriticites = Configure::read('changelogCriticite');  
		$this->set(compact('changelogetats','changelogtypes','changelogcriticites'));                   
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id) {
            $this->set('title_for_layout','Répondre à une demande');
		if ($this->request->is('post')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Changelogreponse->validate = array();
                        return $this->redirect(array('controller'=>'changelogdemandes','action' => 'index',0,1));
                    else:              
                        if($this->request->data['Changelogreponse']['REPONSE']!=''):
                            $this->Changelogreponse->create();
                            if ($this->Changelogreponse->save($this->request->data)) {
                                    //edit changelogdemande pour mettre à jour les champs ETAT, TYPE et CRITICITE
                                    $this->Session->setFlash(__('Réponse sauvegardée',true),'flash_success');
                            } else {
                                    $this->Session->setFlash(__('Réponse incorrecte, veuillez corriger la réponse',true),'flash_failure');
                            }
                        endif;
                        $this->Changelogreponse->Changelogdemande->id = $id;
                        $this->Changelogreponse->Changelogdemande->saveField('ETAT', $this->request->data['Changelogreponse']['ETAT']);
                        $this->Changelogreponse->Changelogdemande->saveField('TYPE', $this->request->data['Changelogreponse']['TYPE']);
                        $this->Changelogreponse->Changelogdemande->saveField('CRITICITE', $this->request->data['Changelogreponse']['CRITICITE']);
                        if($this->request->data['Changelogreponse']['ETAT']== 2 || $this->request->data['Changelogreponse']['ETAT']== 4 ):
                            $this->Changelogreponse->Changelogdemande->saveField('OPEN', 0);
                        endif;
                        if($this->request->data['Changelogreponse']['DATEPREVUE']!= ''):
                            $this->Changelogreponse->Changelogdemande->saveField('DATEPREVUE', $this->request->data['Changelogreponse']['DATEPREVUE']);
                        endif;                        
                        if($this->request->data['Changelogreponse']['CRITICITE']!=''):
                            $this->Changelogreponse->Changelogdemande->saveField('changelogversion_id', $this->request->data['Changelogreponse']['version_id']);
                        endif;                            
                        return $this->redirect(array('controller'=>'changelogdemandes','action' => 'index',0,1));
                    endif;
		}
                $changelogetats = Configure::read('changelogEtatDemande');  
                $changelogtypes = Configure::read('changelogType');  
                $changelogcriticites = Configure::read('changelogCriticite');  
		$this->set(compact('changelogetats','changelogtypes','changelogcriticites'));                    
		$changelogdemande = $this->requestAction('changelogdemandes/get_info/'.$id);
                $changelogversions = $this->requestAction('changelogversions/get_select_open');
                $changelogreponses = $this->get_all_reponses($id);
		$this->set(compact('changelogdemande','changelogversions','changelogreponses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Changelogreponse->exists($id)) {
			throw new NotFoundException(__('Invalid changelogreponse'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Changelogreponse->save($this->request->data)) {
				$this->Session->setFlash(__('The changelogreponse has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The changelogreponse could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Changelogreponse.' . $this->Changelogreponse->primaryKey => $id));
			$this->request->data = $this->Changelogreponse->find('first', $options);
		}
		$changelogdemandes = $this->Changelogreponse->Changelogdemande->find('list');
		$utilisateurs = $this->Changelogreponse->Utilisateur->find('list');
		$this->set(compact('changelogdemandes', 'utilisateurs'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Changelogreponse->id = $id;
		if (!$this->Changelogreponse->exists()) {
			throw new NotFoundException(__('Invalid changelogreponse'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Changelogreponse->delete()) {
			$this->Session->setFlash(__('The changelogreponse has been deleted.'));
		} else {
			$this->Session->setFlash(__('The changelogreponse could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function get_all_reponses($id){
            $objs = $this->Changelogreponse->find('all',array('conditions'=>array('Changelogreponse.changelogdemande_id'=>$id),'order'=>array('Changelogreponse.created'=>'desc'),'recursive'=>0));
            return $objs;
        }
        
        public function json_get_info($id){
            $this->autoRender = false;
            $conditions[] = 'Changelogreponse.id='.$id;
            $result = $this->Changelogreponse->find('first',array('conditions'=>$conditions,'recursive'=>-1));
            return json_encode($result);
        }
        
        public function ajaxedit(){
            $this->autoRender = false;
            $this->Changelogreponse->id = $this->request->data('id');
            if ($this->Changelogreponse->saveField('REPONSE',$this->request->data('memo'))) {
                    $this->Session->setFlash(__('Réponse sauvegardée',true),'flash_success');
                    $this->History->notmove();
            } else {
                    $this->Session->setFlash(__('Réponse incorrecte, veuillez corriger la réponse',true),'flash_failure');
            }
}
}
