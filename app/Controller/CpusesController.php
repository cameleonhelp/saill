<?php
App::uses('AppController', 'Controller');
/**
 * Cpuses Controller
 *
 * @property Cpus $Cpus
 * @property PaginatorComponent $Paginator
 */
class CpusesController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Cpus.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null) {
            $this->set('title_for_layout','CPU');
            if (isAuthorized('cpuses', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Cpus.ACTIF=1";
                        $strfilter = 'actifs';
                        break;
                    case 0:
                        $newconditions[]="Cpus.ACTIF=0";
                        $strfilter = 'inactifs';
                        break;
                endswitch;
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Cpus->recursive = 0;
		$this->set('cpuses', $this->paginate());
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
                $this->set('title_for_layout','CPU');
		if (!$this->Cpus->exists($id)) {
			throw new NotFoundException(__('CPU incorrect'));
		}
		$options = array('conditions' => array('Cpus.' . $this->Cpus->primaryKey => $id));
		$this->set('cpus', $this->Cpus->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','CPU');
            if (isAuthorized('cpuses', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Cpus->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Cpus->create();
			if ($this->Cpus->save($this->request->data)) {
				$this->Session->setFlash(__('Cpu sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Cpu incorrect, veuillez corriger l\'application',true),'flash_failure');
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
            $this->set('title_for_layout','CPU');
            if (isAuthorized('cpuses', 'edit')) :            
		if (!$this->Cpus->exists($id)) {
			throw new NotFoundException(__('CPU incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Cpus->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Cpus->save($this->request->data)) {
				$this->Session->setFlash(__('Cpu sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Cpu incorrect, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Cpus.' . $this->Cpus->primaryKey => $id));
			$this->request->data = $this->Cpus->find('first', $options);
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
            $this->set('title_for_layout','CPU');
            if (isAuthorized('cpuses', 'delete')) : 
		$this->Cpus->id = $id;
		if (!$this->Cpus->exists()) {
			throw new NotFoundException(__('CPU incorrect'));
		}
		if ($this->Cpus->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Cpu supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Cpu <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Cpus->id = $id;
                $obj = $this->Cpus->find('first',array('conditions'=>array('Cpus.id'=>$id),'recursive'=>0));
                $newactif = $obj['Cpus']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Cpus->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            $this->set('title_for_layout','CPU');
            if (isAuthorized('cpuses', 'index')) :
                $keyword=isset($this->params->data['Cpus']['SEARCH']) ? $this->params->data['Cpus']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Cpus.NOM LIKE '%".$keyword."%'","Cpus.PVU LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Cpus->recursive = 0;
                $this->set('cpuses', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=1){
            $list = $this->Cpus->find('list',array('fields'=>array('Cpus.id','Cpus.NOM'),'conditions'=>array('Cpus.ACTIF'=>$actif),'recursive'=>0));
            return $list;
        }     
        
        public function getbynom($nom){
            $this->Cpus->recursive = 0;
            $obj = $this->Cpus->findByNom($nom);
            return $obj;
        }          
}
