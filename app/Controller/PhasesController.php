<?php
App::uses('AppController', 'Controller');
/**
 * Phases Controller
 *
 * @property Phase $Phase
 * @property PaginatorComponent $Paginator
 */
class PhasesController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Phase.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null) {
            if (isAuthorized('phases', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Phase.ACTIF=1";
                        $strfilter = 'actives';
                        break;
                    case 0:
                        $newconditions[]="Phase.ACTIF=0";
                        $strfilter = 'inactives';
                        break;
                endswitch;
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Phase->recursive = 0;
		$this->set('phases', $this->paginate());
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
		if (!$this->Phase->exists($id)) {
			throw new NotFoundException(__('Phase incorrecte'));
		}
		$options = array('conditions' => array('Phase.' . $this->Phase->primaryKey => $id));
		$this->set('phase', $this->Phase->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','Phase');
            if (isAuthorized('phases', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Phase->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Phase->create();
			if ($this->Phase->save($this->request->data)) {
				$this->Session->setFlash(__('Phase sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Phase incorrecte, veuillez corriger l\'application',true),'flash_failure');
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
            $this->set('title_for_layout','Phase');
            if (isAuthorized('phases', 'edit')) :            
		if (!$this->Phase->exists($id)) {
			throw new NotFoundException(__('Phase incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Phase->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Phase->save($this->request->data)) {
				$this->Session->setFlash(__('Phase sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Phase incorrecte, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Phase.' . $this->Phase->primaryKey => $id));
			$this->request->data = $this->Phase->find('first', $options);
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
            $this->set('title_for_layout','Phase');
            if (isAuthorized('phases', 'delete')) : 
		$this->Phase->id = $id;
		if (!$this->Phase->exists()) {
			throw new NotFoundException(__('Phase incorrecte'));
		}
		if ($this->Phase->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Phase supprimée',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Phase <b>NON</b> supprimée',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Phase->id = $id;
                $obj = $this->Phase->find('first',array('conditions'=>array('Phase.id'=>$id),'recursive'=>0));
                $newactif = $obj['Phase']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Phase->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            $this->set('title_for_layout','Phase');
            if (isAuthorized('phases', 'index')) :
                $keyword=isset($this->params->data['Phase']['SEARCH']) ? $this->params->data['Phase']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Phase.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Phase->recursive = 0;
                $this->set('phases', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=1){
            $list = $this->Phase->find('list',array('fields'=>array('Phase.id','Phase.NOM'),'conditions'=>array('Phase.ACTIF'=>$actif),'recursive'=>0));
            return $list;
        }       
        
        public function get_list($actif=null){
            $conditions[] = $actif == null ? '1=1' : 'Phase.ACTIF='.$actif;
            $list = $this->Phase->find('all',array('fields'=>array('Phase.id','Phase.NOM'),'conditions'=>$conditions,'recursive'=>0));
            return $list;
        }     
        
        public function getbynom($nom){
            $this->Phase->recursive = 0;
            $obj = $this->Phase->findByNom($nom);
            return $obj;
        }         
}
