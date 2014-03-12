<?php
App::uses('AppController', 'Controller');
/**
 * Centrecouts Controller
 *
 * @property Centrecout $Centrecout
 * @property PaginatorComponent $Paginator
 */
class CentrecoutsController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $components = array('History','Common');    
        public $paginate = array(
        'order' => array('Centrecout.NOM' => 'asc'),
        );

/**
 * index method
 *
 * @return void
 */
	public function index($departement=null) {
            $this->set('title_for_layout','Centres de coûts');
            if (isAuthorized('centrecouts', 'index')) :   
                switch ($departement) {
                    case 'tous':
                    case null:  
                        $newconditions[]="1=1";
                        $fpriorite = "tous les cercles";
                        break;  
                    default:
                        $nomdepartement = $this->Centrecout->find('first',array('conditions'=>array('Centrecout.id'=>$departement),'recursive'=>0));
                        $newconditions[]="Centrecout.NOMDEPARTEMENT='".$nomdepartement['Centrecout']['NOMDEPARTEMENT']."'";
                        $fpriorite = "de l'entité ".$nomdepartement['Centrecout']['NOMDEPARTEMENT'];                        
                        break;
                }
                $this->Centrecout->recursive = 0;
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->set('centrecouts', $this->paginate());
                $all_projets = $this->requestAction('projets/get_list_actif');
                $departements = $this->find_list_nomdepartement();
                $this->set(compact('all_projets','departements','fpriorite'));
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
		if (!$this->Centrecout->exists($id)) {
			throw new NotFoundException(__('Invalid centrecout'));
		}
		$options = array('conditions' => array('Centrecout.' . $this->Centrecout->primaryKey => $id));
		$this->set('centrecout', $this->Centrecout->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','Centres de coûts');
            if (isAuthorized('centrecouts', 'add')) :             
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Activitesreelle->validate = array();
                        $this->History->goBack(2);
                    else:                      
			$this->Centrecout->create();
			if ($this->Centrecout->save($this->request->data)) {
				$this->Session->setFlash(__('Centre de coût sauvegardé',true),'flash_success');
				$this->History->goBack(1); 
			} else {
				$this->Session->setFlash(__('Centre de coût incorrect, veuillez corriger le centre de coût',true),'flash_failure');
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
            $this->set('title_for_layout','Centres de coûts');
            if (isAuthorized('centrecouts', 'edit')) :             
		if (!$this->Centrecout->exists($id)) {
			throw new NotFoundException(__('Invalid centrecout'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Activitesreelle->validate = array();
                        $this->History->goBack(2);
                    else:                      
			if ($this->Centrecout->save($this->request->data)) {
				$this->Session->setFlash(__('Centre de coût sauvegardé',true),'flash_success');
				$this->History->goBack(1); 
			} else {
				$this->Session->setFlash(__('Centre de coût incorrect, veuillez corriger le centre de coût',true),'flash_failure');
			}
                   endif;
		} else {
			$options = array('conditions' => array('Centrecout.' . $this->Centrecout->primaryKey => $id));
			$this->request->data = $this->Centrecout->find('first', $options);
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
            $this->set('title_for_layout','Centres de coûts');
            if (isAuthorized('centrecouts', 'delete')) :             
		$this->Centrecout->id = $id;
		if (!$this->Centrecout->exists()) {
			throw new NotFoundException(__('Invalid centrecout'));
		}
		if ($this->Centrecout->delete()) {
			$this->Session->setFlash(__('Centre de coût supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Centre de coût <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->goBack(1); 
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
	public function search() {
            if (isAuthorized('centrecouts', 'index')) :
                $departements = $this->find_list_nomdepartement();
                $this->set(compact('departements'));
                $keyword=isset($this->params->data['Centrecout']['SEARCH']) ? $this->params->data['Centrecout']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Centrecout.NOM LIKE '%".$keyword."%'","Centrecout.NOMDEPARTEMENT LIKE '%".$keyword."%'","Centrecout.CODEDEPARTEMENT LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Centrecout->recursive = 0;
                $this->set('centrecouts', $this->paginate());
                $this->Session->delete('xls_export');
                $export = $this->Centrecout->find('all',array('conditions'=>$newconditions));
                $this->Session->write('xls_export',$export);                
                $all_projets = $this->requestAction('projets/get_list_actif');
                $this->set(compact('all_projets'));
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        }    
        
        public function find_list_nomdepartement(){
            $results = $this->Centrecout->find('all',array('fields'=>array('Centrecout.id','Centrecout.NOMDEPARTEMENT'),'group'=>array('Centrecout.NOMDEPARTEMENT'),'order'=>array('Centrecout.NOMDEPARTEMENT'=>'asc'),'recursive'=>0));
            return $results;
        }
}
