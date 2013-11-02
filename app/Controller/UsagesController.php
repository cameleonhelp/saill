<?php
App::uses('AppController', 'Controller');
/**
 * Usages Controller
 *
 * @property Usage $Usage
 * @property PaginatorComponent $Paginator
 */
class UsagesController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Usage.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null) {
            if (isAuthorized('usages', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Usage.ACTIF=1";
                        $strfilter = 'actifs';
                        break;
                    case 0:
                        $newconditions[]="Usage.ACTIF=0";
                        $strfilter = 'inactifs';
                        break;
                endswitch;
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Usage->recursive = 0;
		$this->set('usages', $this->paginate());
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
		if (!$this->Usage->exists($id)) {
			throw new NotFoundException(__('Usage incorrect'));
		}
		$options = array('conditions' => array('Usage.' . $this->Usage->primaryKey => $id));
		$this->set('usage', $this->Usage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('usages', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Usage->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Usage->create();
			if ($this->Usage->save($this->request->data)) {
				$this->Session->setFlash(__('Usage sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Usage incorrect, veuillez corriger l\'application',true),'flash_failure');
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
            if (isAuthorized('usages', 'edit')) :            
		if (!$this->Usage->exists($id)) {
			throw new NotFoundException(__('Usage incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Usage->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Usage->save($this->request->data)) {
				$this->Session->setFlash(__('Usage sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Usage incorrect, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Usage.' . $this->Usage->primaryKey => $id));
			$this->request->data = $this->Usage->find('first', $options);
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
            if (isAuthorized('usages', 'delete')) : 
		$this->Usage->id = $id;
		if (!$this->Usage->exists()) {
			throw new NotFoundException(__('Usage incorrect'));
		}
		if ($this->Usage->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Usage supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Usage <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Usage->id = $id;
                $obj = $this->Usage->find('first',array('conditions'=>array('Usage.id'=>$id),'recursive'=>0));
                $newactif = $obj['Usage']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Usage->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            if (isAuthorized('usages', 'index')) :
                $keyword=isset($this->params->data['Usage']['SEARCH']) ? $this->params->data['Usage']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Usage.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Usage->recursive = 0;
                $this->set('usages', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=1){
            $list = $this->Usage->find('list',array('fields'=>array('Usage.id','Usage.NOM'),'conditions'=>array('Usage.ACTIF'=>$actif),'recursive'=>0));
            return $list;
        }  
        
        public function get_list($actif=null){
            $conditions[] = $actif == null ? '1=1' : 'Usage.ACTIF='.$actif;
            $list = $this->Usage->find('all',array('fields'=>array('Usage.id','Usage.NOM'),'conditions'=>$conditions,'recursive'=>0));
            return $list;
        }       
        
        public function getbynom($nom){
            $this->Usage->recursive = 0;
            $obj = $this->Usage->findByNom($nom);
            return $obj;
        }             
}   