<?php
App::uses('AppController', 'Controller');
/**
 * Lots Controller
 *
 * @property Lot $Lot
 * @property PaginatorComponent $Paginator
 */
class LotsController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Lot.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null) {
            if (isAuthorized('lots', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Lot.ACTIF=1";
                        $strfilter = 'actifs';
                        break;
                    case 0:
                        $newconditions[]="Lot.ACTIF=0";
                        $strfilter = 'inactifs';
                        break;
                endswitch;
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Lot->recursive = 0;
		$this->set('lots', $this->paginate());
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
		if (!$this->Lot->exists($id)) {
			throw new NotFoundException(__('Invalid cpus'));
		}
		$options = array('conditions' => array('Lot.' . $this->Lot->primaryKey => $id));
		$this->set('cpus', $this->Lot->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('lots', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Lot->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Lot->create();
			if ($this->Lot->save($this->request->data)) {
				$this->Session->setFlash(__('Lot sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Lot incorrect, veuillez corriger l\'application',true),'flash_failure');
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
            if (isAuthorized('lots', 'edit')) :            
		if (!$this->Lot->exists($id)) {
			throw new NotFoundException(__('Lot incorrect'));
		}
                $versions = $this->requestAction('versions/get_version_for/'.$id."/1");
                $this->set('versions',$versions);
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Lot->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Lot->save($this->request->data)) {
				$this->Session->setFlash(__('Lot sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Lot incorrect, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Lot.' . $this->Lot->primaryKey => $id));
			$this->request->data = $this->Lot->find('first', $options);
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
            if (isAuthorized('lots', 'delete')) : 
		$this->Lot->id = $id;
		if (!$this->Lot->exists()) {
			throw new NotFoundException(__('Lot incorrect'));
		}
		if ($this->Lot->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Lot supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Lot <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Lot->id = $id;
                $obj = $this->Lot->find('first',array('conditions'=>array('Lot.id'=>$id),'recursive'=>0));
                $newactif = $obj['Lot']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Lot->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            if (isAuthorized('lots', 'index')) :
                $keyword=isset($this->params->data['Lot']['SEARCH']) ? $this->params->data['Lot']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Lot.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Lot->recursive = 0;
                $this->set('lots', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=1){
            $list = $this->Lot->find('list',array('fields'=>array('Lot.id','Lot.NOM'),'conditions'=>array('Lot.ACTIF'=>$actif),'recursive'=>0));
            return $list;
        }       
             
        public function get_list($actif=null){
            $conditions[] = $actif == null ? '1=1' : 'Lot.ACTIF='.$actif;
            $list = $this->Lot->find('all',array('fields'=>array('Lot.id','Lot.NOM'),'conditions'=>$conditions,'recursive'=>0));
            return $list;
        } 
        
        public function getbynom($nom){
            $this->Lot->recursive = 0;
            $obj = $this->Lot->findByNom($nom);
            return $obj;
        }          
}