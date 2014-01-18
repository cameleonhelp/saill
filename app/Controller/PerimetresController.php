<?php
App::uses('AppController', 'Controller');
/**
 * Perimetres Controller
 *
 * @property Perimetre $Perimetre
 * @property PaginatorComponent $Paginator
 */
class PerimetresController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Perimetre.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null) {
            $this->set('title_for_layout','Périmètres');
            if (isAuthorized('perimetres', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Perimetre.ACTIF=1";
                        $strfilter = 'actifs';
                        break;
                    case 0:
                        $newconditions[]="Perimetre.ACTIF=0";
                        $strfilter = 'inactifs';
                        break;
                endswitch;
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Perimetre->recursive = 0;
		$this->set('perimetres', $this->paginate());
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
                $this->set('title_for_layout','Périmètres');
		if (!$this->Perimetre->exists($id)) {
			throw new NotFoundException(__('Périmètres incorrect'));
		}
		$options = array('conditions' => array('Perimetre.' . $this->Perimetre->primaryKey => $id));
		$this->set('perimetre', $this->Perimetre->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','Périmètres');
            if (isAuthorized('perimetres', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Perimetre->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Perimetre->create();
			if ($this->Perimetre->save($this->request->data)) {
				$this->Session->setFlash(__('Périmètre sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Périmètre incorrect, veuillez corriger l\'application',true),'flash_failure');
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
            $this->set('title_for_layout','Périmètres');
            if (isAuthorized('perimetres', 'edit')) :            
		if (!$this->Perimetre->exists($id)) {
			throw new NotFoundException(__('Périmètres incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Perimetre->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Perimetre->save($this->request->data)) {
				$this->Session->setFlash(__('Périmètre sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Périmètre incorrect, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Perimetre.' . $this->Perimetre->primaryKey => $id));
			$this->request->data = $this->Perimetre->find('first', $options);
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
            $this->set('title_for_layout','Périmètres');
            if (isAuthorized('perimetres', 'delete')) : 
		$this->Perimetre->id = $id;
		if (!$this->Perimetre->exists()) {
			throw new NotFoundException(__('Périmètres incorrect'));
		}
		if ($this->Perimetre->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Périmètre supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Périmètre <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Perimetre->id = $id;
                $obj = $this->Perimetre->find('first',array('conditions'=>array('Perimetre.id'=>$id),'recursive'=>0));
                $newactif = $obj['Perimetre']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Perimetre->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            $this->set('title_for_layout','Périmètres');
            if (isAuthorized('perimetres', 'index')) :
                $keyword=isset($this->params->data['Perimetre']['SEARCH']) ? $this->params->data['Perimetre']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Perimetre.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Perimetre->recursive = 0;
                $this->set('perimetres', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=1){
            $list = $this->Perimetre->find('list',array('fields'=>array('Perimetre.id','Perimetre.NOM'),'conditions'=>array('Perimetre.ACTIF'=>$actif),'order'=>array('Perimetre.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }   
               
        public function get_list($actif=null){
            $conditions[] = $actif == null ? '1=1' : 'Perimetre.ACTIF='.$actif;
            $list = $this->Perimetre->find('all',array('fields'=>array('Perimetre.id','Perimetre.NOM'),'conditions'=>$conditions,'order'=>array('Perimetre.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }      
        
        public function getbynom($nom){
            $this->Perimetre->recursive = 0;
            $obj = $this->Perimetre->findByNom($nom);
            return $obj;
        }         
}
