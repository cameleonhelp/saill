<?php
App::uses('AppController', 'Controller');
/**
 * Changelogversions Controller
 *
 * @property Changelogversion $Changelogversion
 * @property PaginatorComponent $Paginator
 */
class ChangelogversionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Changelogversion.VERSION'=>'desc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index() {
                $this->set('title_for_layout','Liste des versions de SAILL');
		$this->Changelogversion->recursive = 0;
		$this->set('changelogversions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Changelogversion->exists($id)) {
			throw new NotFoundException(__('Invalid changelogversion'));
		}
		$options = array('conditions' => array('Changelogversion.' . $this->Changelogversion->primaryKey => $id));
		$this->set('changelogversion', $this->Changelogversion->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $this->set('title_for_layout','Liste des versions de SAILL');
		if ($this->request->is('post')) {                    
                    $version = $this->Changelogversion->find('all',array('conditions'=>array('Changelogversion.VERSION'=>$this->request->data['Changelogversion']['VERSION']),'recursive'=>0));
                    if(count($version)==0):
                        $this->Changelogversion->create();
                        if ($this->Changelogversion->save($this->request->data)) {
                                $this->Session->setFlash(__('Version sauvegardée',true),'flash_success');
                        } else {
                                $this->Session->setFlash(__('Version incorrecte, veuillez corriger la version',true),'flash_failure');
                        }
                    else:
                        $this->Session->setFlash(__('Version déjà existante',true),'flash_failure');
                    endif;
                    return $this->redirect(array('action' => 'index'));
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit() {
                $this->autoRender = false;
                $this->Changelogversion->id = $this->request->data['Changelogversion']['id'];
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Changelogversion->saveField('DATEPREVUE', $this->request->data['Changelogversion']['DATE'])) {
                                $options = array('pass'=>array($this->request->data['Changelogversion']['id'],$this->request->data['Changelogversion']['DATE']));
                                $this->Changelogversion->requestAction('changelogreponses/updateresponses/',$options);
				$this->Session->setFlash(__('Version sauvegardée',true),'flash_success');
			} else {
				$this->Session->setFlash(__('Version incorrecte, veuillez corriger la version',true),'flash_failure');
			}
                        return $this->redirect(array('action' => 'index'));
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
                $this->set('title_for_layout','Liste des versions de SAILL');
		$this->Changelogversion->id = $id;
		if (!$this->Changelogversion->exists()) {
			throw new NotFoundException(__('Version de SAILL incorrecte'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Changelogversion->delete()) {
			$this->Session->setFlash(__('Version supprimée',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Version <b>NON</b> ne peut pas être supprimée',true),'flash_failure');
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function ajax_changeetat($id=null){
                $this->set('title_for_layout','Liste des versions de SAILL');
                $newid = $id == null ? $this->request->data('id') : $id;
                $result = false;
                $this->Changelogversion->id = $newid;
                $obj = $this->Changelogversion->find('first',array('conditions'=>array('Changelogversion.id'=>$newid),'recursive'=>0));
                $newactif = $obj['Changelogversion']['ETAT'] == 1 ? 0 : 1;
                if ($this->Changelogversion->saveField('ETAT',$newactif)) {
                        if($newactif==1):
                            $this->requestAction('changelogdemandes/close/'.$obj['Changelogversion']['id']);
                            $this->Changelogversion->saveField('DATEREELLE',date('Y-m-d H:i:s'));
                        else:
                            $this->requestAction('changelogdemandes/open/'.$obj['Changelogversion']['id']);
                            $this->Changelogversion->saveField('DATEREELLE',null);
                        endif;
                        if ($id==null):
                            $this->Session->setFlash(__('Modification de l\'état de la version prise en compte',true),'flash_success');
                        else:
                            $result = true;
                        endif;
                } else {
                        if ($id==null):
                            $this->Session->setFlash(__('Modification de l\'état de la version <b>NON</b> prise en compte',true),'flash_failure');
                        else:
                            $result = false;
                        endif;
                }
		if ($id==null):
                    exit();
                else:
                    return $result;
                endif;
        }          

        public function get_select_all(){
            $list = $this->Changelogversion->find('list',array('fields'=>array('Changelogversion.id','Changelogversion.VERSION'),'order'=>array('Changelogversion.VERSION'=>'asc'),'recursive'=>0));
            return $list;
        }           
        
        public function get_select_open(){
            $conditions[] = 'Changelogversion.ETAT=0';
            $list = $this->Changelogversion->find('list',array('fields'=>array('Changelogversion.id','Changelogversion.VERSION'),'conditions'=>$conditions,'order'=>array('Changelogversion.VERSION'=>'asc'),'recursive'=>0));
            return $list;
        }     
        
        public function get_all_close(){
            $conditions[] = 'Changelogversion.ETAT=1';
            $list = $this->Changelogversion->find('all',array('fields'=>array('Changelogversion.id,Changelogversion.DATEREELLE','Changelogversion.VERSION'),'conditions'=>$conditions,'order'=>array('Changelogversion.VERSION'=>'desc'),'recursive'=>0));
            return $list;
        } 
        
        public function json_get_info($id){
            $this->autoRender = false;
            $conditions[] = 'Changelogversion.id='.$id;
            $obj = $this->Changelogversion->find('first',array('conditions'=>$conditions,'recursive'=>-1));
            $result = json_encode($obj);
            return $result;
        }
        
        public function getnextversion(){
            $conditions[] = 'Changelogversion.ETAT=0';
            $list = $this->Changelogversion->find('all',array('conditions'=>$conditions,'order'=>array('Changelogversion.VERSION'=>'asc'),'recursive'=>0));
            return $list;
        }
}
