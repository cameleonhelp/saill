<?php
App::uses('AppController', 'Controller');
/**
 * Architectures Controller
 *
 * @property Architecture $Architecture
 * @property PaginatorComponent $Paginator
 */
class ArchitecturesController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Architecture.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null) {
            if (isAuthorized('architectures', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Architecture.ACTIF=1";
                        $strfilter = 'actives';
                        break;
                    case 0:
                        $newconditions[]="Architecture.ACTIF=0";
                        $strfilter = 'inactives';
                        break;
                endswitch;
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Architecture->recursive = 0;
		$this->set('architectures', $this->paginate());
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
		if (!$this->Architecture->exists($id)) {
			throw new NotFoundException(__('Architecture incorrect'));
		}
		$options = array('conditions' => array('Architecture.' . $this->Architecture->primaryKey => $id));
		$this->set('architecture', $this->Architecture->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('architectures', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Architecture->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Architecture->create();
			if ($this->Architecture->save($this->request->data)) {
				$this->Session->setFlash(__('Architecture sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Architecture incorrecte, veuillez corriger l\'architecture',true),'flash_failure');
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
            if (isAuthorized('architectures', 'edit')) :
		if (!$this->Architecture->exists($id)) {
			throw new NotFoundException(__('Architecture incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Architecture->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Architecture->save($this->request->data)) {
				$this->Session->setFlash(__('Architecture sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Architecture incorrecte, veuillez corriger l\'architecture',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Architecture.' . $this->Architecture->primaryKey => $id));
			$this->request->data = $this->Architecture->find('first', $options);
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
            if (isAuthorized('architectures', 'delete')) :
		$this->Architecture->id = $id;
		if (!$this->Architecture->exists()) {
			throw new NotFoundException(__('Architecture incorrect'));
		}
		if ($this->Architecture->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Architecture supprimée',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Architecture <b>NON</b> supprimée',true),'flash_failure');
		}
		return $this->redirect(array('action' => 'index'));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
    
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Architecture->id = $id;
                $architecture = $this->Architecture->find('first',array('conditions'=>array('Architecture.id'=>$id),'recursive'=>0));
                $newactif = $architecture['Architecture']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Architecture->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            if (isAuthorized('architectures', 'index')) :
                $keyword=isset($this->params->data['Architecture']['SEARCH']) ? $this->params->data['Architecture']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Architecture.NOM LIKE '%".$keyword."%'","Architecture.COMMENTAIRE LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Architecture->recursive = 0;
                $this->set('architectures', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }    
        
        public function get_select($actif=1){
            $list = $this->Architecture->find('list',array('fields'=>array('Architecture.id','Architecture.NOM'),'conditions'=>array('Architecture.ACTIF'=>$actif),'recursive'=>0));
            return $list;
        }    
        
        public function get_list($actif=null){
            $conditions[] = $actif == null ? '1=1' : 'Architecture.ACTIF='.$actif;
            $list = $this->Architecture->find('all',array('fields'=>array('Architecture.id','Architecture.NOM'),'conditions'=>$conditions,'recursive'=>0));
            return $list;
        }       
        
        public function getbynom($nom){
            $this->Architecture->recursive = 0;
            $obj = $this->Architecture->findByNom($nom);
            return $obj;
        }         
}
