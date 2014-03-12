<?php
App::uses('AppController', 'Controller');
/**
 * Versions Controller
 *
 * @property Version $Version
 * @property PaginatorComponent $Paginator
 */
class VersionsController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Version.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null) {
            $this->set('title_for_layout','Versions');
            if (isAuthorized('versions', 'index')) :  
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Version.ACTIF=1";
                        $strfilter = 'actifs';
                        break;
                    case 0:
                        $newconditions[]="Version.ACTIF=0";
                        $strfilter = 'inactifs';
                        break;
                endswitch;
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Version->recursive = 0;
		$this->set('versions', $this->paginate());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
                $this->set('title_for_layout','Versions');
		if (!$this->Version->exists($id)) {
			throw new NotFoundException(__('Versions incorrecte'));
		}
		$options = array('conditions' => array('Version.' . $this->Version->primaryKey => $id));
		$this->set('version', $this->Version->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','Versions');
            if (isAuthorized('versions', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Version->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Version->create();
			if ($this->Version->save($this->request->data)) {
				$this->Session->setFlash(__('Version sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Version incorrecte, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
            $this->set('title_for_layout','Versions');
            if (isAuthorized('versions', 'edit')) :            
		if (!$this->Version->exists($id)) {
			throw new NotFoundException(__('Versions incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Version->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Version->save($this->request->data)) {
				$this->Session->setFlash(__('Version sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Version incorrecte, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Version.' . $this->Version->primaryKey => $id));
			$this->request->data = $this->Version->find('first', $options);
		}
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
            $this->set('title_for_layout','Versions');
            if (isAuthorized('versions', 'delete')) : 
		$this->Version->id = $id;
		if (!$this->Version->exists()) {
			throw new NotFoundException(__('Versions incorrecte'));
		}
		if ($this->Version->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Version supprimée',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Version <b>NON</b> supprimée',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Version->id = $id;
                $obj = $this->Version->find('first',array('conditions'=>array('Version.id'=>$id),'recursive'=>0));
                $newactif = $obj['Version']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Version->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
	public function ajaxdelete($id = null) {
            $this->set('title_for_layout','Versions');
            $this->autoRender = false;
            if (isAuthorized('versions', 'delete')) : 
		$this->Version->id = $id;
		if (!$this->Version->exists()) {
			throw new NotFoundException(__('Versions incorrecte'));
		}
		if ($this->Version->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Version supprimée',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Version <b>NON</b> supprimée',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        public function search(){
            $this->set('title_for_layout','Versions');
            if (isAuthorized('versions', 'index')) :
                $keyword=isset($this->params->data['Version']['SEARCH']) ? $this->params->data['Version']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Version.NOM LIKE '%".$keyword."%'","Version.PVU LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Version->recursive = 0;
                $this->set('versions', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=1){
            $listentite = $this->requestAction('assoentiteutilisateurs/json_get_my_entite/'.userAuth('id'));
            $conditions[]="Lot.entite_id IN (".$listentite.')';     
            $conditions[] = 'Version.ACTIF='.$actif;
            $list = $this->Version->find('list',array('fields'=>array('Version.id','Version.NOM'),'conditions'=>$conditions,'order'=>array('Version.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }
        
        public function get_list($actif=1){
            $listentite = $this->requestAction('assoentiteutilisateurs/json_get_my_entite/'.userAuth('id'));
            $conditions[]="Lot.entite_id IN (".$listentite.')';     
            $conditions[] = 'Version.ACTIF='.$actif;            
            $list = $this->Version->find('all',array('fields'=>array('Version.id','Version.NOM'),'conditions'=>$conditions,'order'=>array('Version.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }        
        
        public function get_version_for($id=null,$actif=null){
            $conditions[] = $actif == null ? '1=1' : 'Version.ACTIF='.$actif;
            $conditions[] = 'Version.lot_id='.$id;
            $list = $this->Version->find('all',array('conditions'=>$conditions,'order'=>array('Version.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }      
        
        public function json_get_version_for($id=null,$actif=null){
            $this->autoRender = false;
            $conditions[] = $actif == null ? '1=1' : 'Version.ACTIF='.$actif;
            $conditions[] = !in_array($id, array('4','3','5'))? 'Version.lot_id='.$id : '1=1';
            $versions = $this->Version->find('all',array('conditions'=>$conditions,'recursive'=>-1,'order'=>array('Version.NOM'=>'asc')));
            foreach($versions as $version):
                $listversions["NOM"]=$version["Version"]["id"];
            endforeach;
            $result = json_encode($versions);
            return $result;
        } 
        
        public function json_get_version_info($id=null){
            $this->autoRender = false;
            $conditions[] = 'Version.id='.$id;
            $version = $this->Version->find('all',array('conditions'=>$conditions,'recursive'=>0,'order'=>array('Version.NOM'=>'asc')));
            $result = json_encode($version);
            return $result;
        }
        
	public function ajaxadd() {
            $this->set('title_for_layout','Versions');
            $this->autoRender = false;
            if (isAuthorized('versions', 'add')) :
		if ($this->request->is('post')) :
			$this->Version->create();

			if ($this->Version->save($this->request->data)) {
				$this->Session->setFlash(__('Version sauvegardée',true),'flash_success');
				$this->History->notmove();
                        } else {
				$this->Session->setFlash(__('Version incorrecte, veuillez corriger l\'application',true),'flash_failure');
			}
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}   
        
	public function ajaxedit() {
            $this->set('title_for_layout','Versions');
            $this->autoRender = false;
            if (isAuthorized('versions', 'edit')) : 
		if ($this->request->is('post') || $this->request->is('put')) :
                        $id = $this->request->data['Version']['id'];
			if ($this->Version->save($this->request->data)) {
				$this->Session->setFlash(__('Version sauvegardée',true),'flash_success');
                                $this->History->notmove();
			} else {
				$this->Session->setFlash(__('Version incorrecte, veuillez corriger l\'application',true),'flash_failure');
			}
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}   
        
        public function getbynom($nom){
            $this->Version->recursive = 0;
            $obj = $this->Version->findByNom($nom);
            return $obj;
        }         
}