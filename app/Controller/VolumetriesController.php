<?php
App::uses('AppController', 'Controller');
/**
 * Volumetries Controller
 *
 * @property Volumetry $Volumetry
 * @property PaginatorComponent $Paginator
 */
class VolumetriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Volumetry.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null) {
            $this->set('title_for_layout','Volumétries');
            if (isAuthorized('volumetries', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Volumetry.ACTIF=1";
                        $strfilter = 'actives';
                        break;
                    case 0:
                        $newconditions[]="Volumetry.ACTIF=0";
                        $strfilter = 'inactives';
                        break;
                endswitch;
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Volumetry->recursive = 0;
		$this->set('volumetries', $this->paginate());
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
                $this->set('title_for_layout','Volumétries');
		if (!$this->Volumetry->exists($id)) {
			throw new NotFoundException(__('Volumétrie incorrecte'));
		}
		$options = array('conditions' => array('Volumetry.' . $this->Volumetry->primaryKey => $id));
		$this->set('volumetry', $this->Volumetry->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','Volumétries');
            if (isAuthorized('volumetries', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Volumetry->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Volumetry->create();
			if ($this->Volumetry->save($this->request->data)) {
				$this->Session->setFlash(__('Volumétrie sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Volumétrie incorrecte, veuillez corriger l\'application',true),'flash_failure');
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
            $this->set('title_for_layout','Volumétries');
            if (isAuthorized('volumetries', 'edit')) :            
		if (!$this->Volumetry->exists($id)) {
			throw new NotFoundException(__('Volumétrie incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Volumetry->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Volumetry->save($this->request->data)) {
				$this->Session->setFlash(__('Volumétrie sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Volumétrie incorrecte, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Volumetry.' . $this->Volumetry->primaryKey => $id));
			$this->request->data = $this->Volumetry->find('first', $options);
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
            $this->set('title_for_layout','Volumétries');
            if (isAuthorized('volumetries', 'delete')) : 
		$this->Volumetry->id = $id;
		if (!$this->Volumetry->exists()) {
			throw new NotFoundException(__('Volumétrie incorrecte'));
		}
		if ($this->Volumetry->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Volumétrie supprimée',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Volumétrie <b>NON</b> supprimée',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Volumetry->id = $id;
                $obj = $this->Volumetry->find('first',array('conditions'=>array('Volumetry.id'=>$id),'recursive'=>0));
                $newactif = $obj['Volumetry']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Volumetry->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            $this->set('title_for_layout','Volumétries');
            if (isAuthorized('volumetries', 'index')) :
                $keyword=isset($this->params->data['Volumetry']['SEARCH']) ? $this->params->data['Volumetry']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Volumetry.NOM LIKE '%".$keyword."%'","Volumetry.VALEUR LIKE '%".$keyword."%'","Volumetry.COMMENTAIRE LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Volumetry->recursive = 0;
                $this->set('volumetries', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=1){
            $list = $this->Volumetry->find('list',array('fields'=>array('Volumetry.id','Volumetry.NOM'),'conditions'=>array('Volumetry.ACTIF'=>$actif),'recursive'=>0));
            return $list;
        }      
        
        public function get_list($actif=null){
            $conditions[] = $actif == null ? '1=1' : 'Volumetry.ACTIF='.$actif;
            $list = $this->Volumetry->find('all',array('fields'=>array('Volumetry.id','Volumetry.NOM'),'conditions'=>$conditions,'recursive'=>0));
            return $list;
        }   
        
        public function getbynom($nom){
            $this->Volumetry->recursive = 0;
            $obj = $this->Volumetry->findByNom($nom);
            return $obj;
        }         
}
