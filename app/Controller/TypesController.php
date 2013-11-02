<?php
App::uses('AppController', 'Controller');
/**
 * Types Controller
 *
 * @property Type $Type
 * @property PaginatorComponent $Paginator
 */
class TypesController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25);
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null) {
            $this->set('title_for_layout','Type d\'environnement');
            if (isAuthorized('types', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Type.ACTIF=1";
                        $strfilter = 'actifs';
                        break;
                    case 0:
                        $newconditions[]="Type.ACTIF=0";
                        $strfilter = 'inactifs';
                        break;
                endswitch;
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Type->recursive = 0;
		$this->set('types', $this->paginate());
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
                $this->set('title_for_layout','Type d\'environnement');
		if (!$this->Type->exists($id)) {
			throw new NotFoundException(__('Type d\'environnement incorrect'));
		}
		$options = array('conditions' => array('Type.' . $this->Type->primaryKey => $id));
		$this->set('type', $this->Type->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','Type d\'environnement');
            if (isAuthorized('types', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Type->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Type->create();
			if ($this->Type->save($this->request->data)) {
				$this->Session->setFlash(__('Type d\'environnement sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Type d\'environnement incorrect, veuillez corriger le type d\'environnement',true),'flash_failure');
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
            $this->set('title_for_layout','Type d\'environnement');
            if (isAuthorized('types', 'edit')) :            
		if (!$this->Type->exists($id)) {
			throw new NotFoundException(__('Type d\'environnement incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Type->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Type->save($this->request->data)) {
				$this->Session->setFlash(__('Type d\'environnement sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Type d\'environnement incorrect, veuillez corriger le type d\'environnement',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Type.' . $this->Type->primaryKey => $id));
			$this->request->data = $this->Type->find('first', $options);
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
            $this->set('title_for_layout','Type d\'environnement');
            if (isAuthorized('types', 'delete')) : 
		$this->Type->id = $id;
		if (!$this->Type->exists()) {
			throw new NotFoundException(__('Type d\'environnement incorrect'));
		}
		if ($this->Type->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Type d\'environnement supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Type d\'environnement <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Type->id = $id;
                $obj = $this->Type->find('first',array('conditions'=>array('Type.id'=>$id),'recursive'=>0));
                $newactif = $obj['Type']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Type->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            $this->set('title_for_layout','Type d\'environnement');
            if (isAuthorized('types', 'index')) :
                $keyword=isset($this->params->data['Type']['SEARCH']) ? $this->params->data['Type']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Type.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Type->recursive = 0;
                $this->set('types', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=1){
            $list = $this->Type->find('list',array('fields'=>array('Type.id','Type.NOM'),'conditions'=>array('Type.ACTIF'=>$actif),'recursive'=>0));
            return $list;
        }        
        
        public function get_list($actif=null){
            $conditions[] = $actif == null ? '1=1' : 'Type.ACTIF='.$actif;
            $list = $this->Type->find('all',array('fields'=>array('Type.id','Type.NOM'),'conditions'=>$conditions,'recursive'=>0));
            return $list;
        }    
        
        public function getbynom($nom){
            $this->Type->recursive = 0;
            $obj = $this->Type->findByNom($nom);
            return $obj;
        }           
}
