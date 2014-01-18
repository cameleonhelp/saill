<?php
App::uses('AppController', 'Controller');
/**
 * Localites Controller
 *
 * @property Localite $Localite
 * @property PaginatorComponent $Paginator
 */
class LocalitesController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Localite.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null) {
            $this->set('title_for_layout','Localités');
            if (isAuthorized('localites', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Localite.ACTIF=1";
                        $strfilter = 'actives';
                        break;
                    case 0:
                        $newconditions[]="Localite.ACTIF=0";
                        $strfilter = 'inactives';
                        break;
                endswitch;
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Localite->recursive = 0;
		$this->set('localites', $this->paginate());
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
		if (!$this->Localite->exists($id)) {
			throw new NotFoundException(__('Invalid cpus'));
		}
		$options = array('conditions' => array('Localite.' . $this->Localite->primaryKey => $id));
		$this->set('cpus', $this->Localite->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','Localités');
            if (isAuthorized('localites', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Localite->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Localite->create();
			if ($this->Localite->save($this->request->data)) {
				$this->Session->setFlash(__('Localité sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Localité incorrecte, veuillez corriger l\'application',true),'flash_failure');
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
            $this->set('title_for_layout','Localités');
            if (isAuthorized('localites', 'edit')) :            
		if (!$this->Localite->exists($id)) {
			throw new NotFoundException(__('Localité incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Localite->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Localite->save($this->request->data)) {
				$this->Session->setFlash(__('Localité sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Localité incorrecte, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Localite.' . $this->Localite->primaryKey => $id));
			$this->request->data = $this->Localite->find('first', $options);
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
            $this->set('title_for_layout','Localités');
            if (isAuthorized('localites', 'delete')) : 
		$this->Localite->id = $id;
		if (!$this->Localite->exists()) {
			throw new NotFoundException(__('Localité incorrecte'));
		}
		if ($this->Localite->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Localité supprimée',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Localité <b>NON</b> supprimée',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Localite->id = $id;
                $obj = $this->Localite->find('first',array('conditions'=>array('Localite.id'=>$id),'recursive'=>0));
                $newactif = $obj['Localite']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Localite->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            $this->set('title_for_layout','Localités');
            if (isAuthorized('localites', 'index')) :
                $keyword=isset($this->params->data['Localite']['SEARCH']) ? $this->params->data['Localite']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Localite.NOM LIKE '%".$keyword."%'","Localite.ORDER LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Localite->recursive = 0;
                $this->set('localites', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=1){
            $list = $this->Localite->find('list',array('fields'=>array('Localite.id','Localite.NOM'),'conditions'=>array('Localite.ACTIF'=>$actif),'order'=>array('Localite.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }      
        
        public function get_list($actif=1){
            $list = $this->Localite->find('all',array('fields'=>array('Localite.id','Localite.NOM'),'conditions'=>array('Localite.ACTIF'=>$actif),'recursive'=>0));
            return $list;
        }            
}
