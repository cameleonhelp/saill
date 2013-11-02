<?php
App::uses('AppController', 'Controller');
/**
 * Etats Controller
 *
 * @property Etat $Etat
 * @property PaginatorComponent $Paginator
 */
class EtatsController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Etat.ORDER'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null) {
            if (isAuthorized('etats', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Etat.ACTIF=1";
                        $strfilter = 'actifs';
                        break;
                    case 0:
                        $newconditions[]="Etat.ACTIF=0";
                        $strfilter = 'inactifs';
                        break;
                endswitch;
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Etat->recursive = 0;
		$this->set('etats', $this->paginate());
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
		if (!$this->Etat->exists($id)) {
			throw new NotFoundException(__('Invalid cpus'));
		}
		$options = array('conditions' => array('Etat.' . $this->Etat->primaryKey => $id));
		$this->set('cpus', $this->Etat->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('etats', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Etat->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Etat->create();
			if ($this->Etat->save($this->request->data)) {
				$this->Session->setFlash(__('Etat sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Etat incorrect, veuillez corriger l\'application',true),'flash_failure');
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
            if (isAuthorized('etats', 'edit')) :            
		if (!$this->Etat->exists($id)) {
			throw new NotFoundException(__('Etat incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Etat->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Etat->save($this->request->data)) {
				$this->Session->setFlash(__('Etat sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Etat incorrect, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Etat.' . $this->Etat->primaryKey => $id));
			$this->request->data = $this->Etat->find('first', $options);
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
            if (isAuthorized('etats', 'delete')) : 
		$this->Etat->id = $id;
		if (!$this->Etat->exists()) {
			throw new NotFoundException(__('Etat incorrect'));
		}
		if ($this->Etat->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Etat supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Etat <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Etat->id = $id;
                $cpu = $this->Etat->find('first',array('conditions'=>array('Etat.id'=>$id),'recursive'=>0));
                $newactif = $cpu['Etat']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Etat->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            if (isAuthorized('etats', 'index')) :
                $keyword=isset($this->params->data['Etat']['SEARCH']) ? $this->params->data['Etat']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Etat.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Etat->recursive = 0;
                $this->set('etats', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=1){
            $list = $this->Etat->find('list',array('fields'=>array('Etat.id','Etat.NOM'),'conditions'=>array('Etat.ACTIF'=>$actif),'order'=>array('Etat.ORDER'=>'asc'),'recursive'=>0));
            return $list;
        }        
        
        public function get_list($actif=null){
            $conditions[] = $actif == null ? '1=1' : 'Etat.ACTIF='.$actif;
            $list = $this->Etat->find('all',array('fields'=>array('Etat.id','Etat.NOM'),'conditions'=>$conditions,'recursive'=>0));
            return $list;
        }    
        
        public function getbynom($nom){
            $this->Etat->recursive = 0;
            $obj = $this->Etat->findByNom($nom);
            return $obj;
        }         
}