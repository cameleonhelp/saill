<?php
App::uses('AppController', 'Controller');
/**
 * Modeles Controller
 *
 * @property Modele $Modele
 * @property PaginatorComponent $Paginator
 */
class ModelesController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Modele.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null) {
            $this->set('title_for_layout','Modèles');
            if (isAuthorized('modeles', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Modele.ACTIF=1";
                        $strfilter = 'actifs';
                        break;
                    case 0:
                        $newconditions[]="Modele.ACTIF=0";
                        $strfilter = 'inactifs';
                        break;
                endswitch;
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Modele->recursive = 0;
		$this->set('modeles', $this->paginate());
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
                $this->set('title_for_layout','Modèles');
		if (!$this->Modele->exists($id)) {
			throw new NotFoundException(__('Modèle incorrect'));
		}
		$options = array('conditions' => array('Modeles.' . $this->Modele->primaryKey => $id));
		$this->set('modele', $this->Modele->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','Modèles');
            if (isAuthorized('modeles', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Modele->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Modele->create();
			if ($this->Modele->save($this->request->data)) {
				$this->Session->setFlash(__('Modèle sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Modèle incorrect, veuillez corriger l\'application',true),'flash_failure');
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
            $this->set('title_for_layout','Modèles');
            if (isAuthorized('modeles', 'edit')) :            
		if (!$this->Modele->exists($id)) {
			throw new NotFoundException(__('Modèle incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Modele->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Modele->save($this->request->data)) {
				$this->Session->setFlash(__('Modèle sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Modèle incorrect, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Modele.' . $this->Modele->primaryKey => $id));
			$this->request->data = $this->Modele->find('first', $options);
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
            $this->set('title_for_layout','Modèles');
            if (isAuthorized('modeles', 'delete')) : 
		$this->Modele->id = $id;
		if (!$this->Modele->exists()) {
			throw new NotFoundException(__('Modèle incorrect'));
		}
		if ($this->Modele->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Modèle supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modèle <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Modele->id = $id;
                $obj = $this->Modele->find('first',array('conditions'=>array('Modele.id'=>$id),'recursive'=>0));
                $newactif = $obj['Modele']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Modele->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            $this->set('title_for_layout','Modèles');
            if (isAuthorized('modeles', 'index')) :
                $keyword=isset($this->params->data['Modele']['SEARCH']) ? $this->params->data['Modele']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Modele.NOM LIKE '%".$keyword."%'","Modele.NBU LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Modele->recursive = 0;
                $this->set('modeles', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=1){
            $list = $this->Modele->find('list',array('fields'=>array('Modele.id','Modele.NOM'),'conditions'=>array('Modele.ACTIF'=>$actif),'order'=>array('Modele.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }     
        
        public function getbynom($nom){
            $this->Modele->recursive = 0;
            $obj = $this->Modele->findByNom($nom);
            return $obj;
        }
}
