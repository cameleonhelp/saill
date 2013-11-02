<?php
App::uses('AppController', 'Controller');
/**
 * Composants Controller
 *
 * @property Composant $Composant
 * @property PaginatorComponent $Paginator
 */
class ComposantsController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Composant.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null) {
            if (isAuthorized('composants', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Composant.ACTIF=1";
                        $strfilter = 'actifs';
                        break;
                    case 0:
                        $newconditions[]="Composant.ACTIF=0";
                        $strfilter = 'inactifs';
                        break;
                endswitch;
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Composant->recursive = 0;
		$this->set('composants', $this->paginate());
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
		if (!$this->Composant->exists($id)) {
			throw new NotFoundException(__('Composant incorrect'));
		}
		$options = array('conditions' => array('Composant.' . $this->Composant->primaryKey => $id));
		$this->set('composant', $this->Composant->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('composants', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Composant->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Composant->create();
			if ($this->Composant->save($this->request->data)) {
				$this->Session->setFlash(__('Composant sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Composant incorrect, veuillez corriger le composant',true),'flash_failure');
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
            if (isAuthorized('composants', 'edit')) :
		if (!$this->Composant->exists($id)) {
			throw new NotFoundException(__('Composant incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Composant->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Composant->save($this->request->data)) {
				$this->Session->setFlash(__('Composant sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Composant incorrect, veuillez corriger le composant',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Composant.' . $this->Composant->primaryKey => $id));
			$this->request->data = $this->Composant->find('first', $options);
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
            if (isAuthorized('composants', 'delete')) :
		$this->Composant->id = $id;
		if (!$this->Composant->exists()) {
			throw new NotFoundException(__('Composant incorrect'));
		}
		if ($this->Composant->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Composant supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Composant <b>NON</b> supprimé',true),'flash_failure');
		}
		return $this->redirect(array('action' => 'index'));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
	}
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Composant->id = $id;
                $composant = $this->Composant->find('first',array('conditions'=>array('Composant.id'=>$id),'recursive'=>0));
                $newactif = $composant['Composant']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Composant->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            if (isAuthorized('composants', 'index')) :
                $keyword=isset($this->params->data['Composant']['SEARCH']) ? $this->params->data['Composant']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Composant.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Composant->recursive = 0;
                $this->set('composants', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }   
        
        public function get_select($actif=1){
            $list = $this->Composant->find('list',array('fields'=>array('Composant.id','Composant.NOM'),'conditions'=>array('Composant.ACTIF'=>$actif),'recursive'=>0));
            return $list;
        }  
        
        public function get_list($actif=null){
            $conditions[] = $actif == null ? '1=1' : 'Composant.ACTIF='.$actif;
            $list = $this->Composant->find('all',array('fields'=>array('Composant.id','Composant.NOM'),'conditions'=>$conditions,'recursive'=>0));
            return $list;
        }  
        
        public function getbynom($nom){
            $this->Composant->recursive = 0;
            $obj = $this->Composant->findByNom($nom);
            return $obj;
        }         
}
