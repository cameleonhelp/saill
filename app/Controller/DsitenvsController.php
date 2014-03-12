<?php
App::uses('AppController', 'Controller');
/**
 * Dsitenvs Controller
 *
 * @property Dsitenv $Dsitenv
 * @property PaginatorComponent $Paginator
 */
class DsitenvsController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('order'=>array('Dsitenv.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($application_id=null,$actif=null) {
                $this->set('title_for_layout','Liste des environnements DSIT');
            if (isAuthorized('dsitenvs', 'index')) :
                $listentite = $this->requestAction('assoentiteutilisateurs/json_get_my_entite/'.userAuth('id'));
                $newconditions[]="Dsitenv.entite_id IN (".$listentite.')';                
                switch($application_id):
                    case null:
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter = 'toutes les applications';
                        break;
                    default:
                        $newconditions[]="Dsitenv.application_id=".$application_id;
                        $application = $this->requestAction('applications/getname/'.$application_id);
                        $strfilter = 'l\'application '.$application;
                        break;
                endswitch;
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Dsitenv.ACTIF=1";
                        $strfilter .= ' et actifs';
                        break;
                    case 0:
                        $newconditions[]="Dsitenv.ACTIF=0";
                        $strfilter .= ' et inactifs';
                        break;
                endswitch;                
                $this->set('strfilter',$strfilter);
                $applications = $this->requestAction('applications/get_list/1');
                $this->set(compact('applications'));    
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Dsitenv->recursive = 0;
		$this->set('dsitenvs', $this->paginate());
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
            $this->set('title_for_layout','Environnements DSIT');
            if ($this->request->is(array('post', 'put'))) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Dsitenv->validate = array();
                    $this->History->goBack(1);
                endif;
            else:             
                if (!$this->Dsitenv->exists($id)) {
                        throw new NotFoundException(__('Environnement incorrect'));
                }
                $options = array('conditions' => array('Dsitenv.' . $this->Dsitenv->primaryKey => $id),'recursive'=>0);
                $dsitenv = $this->Dsitenv->find('first', $options);
                $this->set(compact('dsitenv'));
                /**
                 * liste des environnements (expressionbesoins) en fonction de l'application_id et du nom
                 */
                $environnements = array();
                /**
                 * liste des biens en fonction de l'application_id et du nom
                 */    
                $biens = $this->requestAction('assobienlogiciels/get_for_dsitenv/'.$dsitenv['Dsitenv']['id'].'/'.$dsitenv['Dsitenv']['application_id']);
                $this->set(compact('biens'));
            endif;
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $this->set('title_for_layout','Environnements DSIT');
                if (isAuthorized('dsitenvs', 'add')) :
                    if ($this->request->is('post')) {
                        if (isset($this->params['data']['cancel'])) :
                            $this->Dsitenv->validate = array();
                            $this->History->goBack(1);
                        else:          
                            $this->request->data['Dsitenv']['entite_id']=userAuth('entite_id');
                            $this->Dsitenv->create();
                            if ($this->Dsitenv->save($this->request->data)) {
                                $this->Session->setFlash(__('Environnement sauvegardé',true),'flash_success');
				$this->History->goBack(1);
                            } else {
                                $this->Session->setFlash(__('Environnement incorrect, veuillez corriger l\'environnement',true),'flash_failure');
                            }
                        endif;
                    }
                    $entites = $this->Dsitenv->Entite->find('list');
                    $applications = $this->requestAction('applications/get_select');
                    $this->set(compact('entites', 'applications'));
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
                $this->set('title_for_layout','Environnements DSIT');
                if (isAuthorized('dsitenvs', 'edit')) :
                    if (!$this->Dsitenv->exists($id)) {
                            throw new NotFoundException(__('Environnement incorrect'));
                    }
                    if ($this->request->is(array('post', 'put'))) {
                        if (isset($this->params['data']['cancel'])) :
                            $this->Dsitenv->validate = array();
                            $this->History->goBack(1);
                        else:                           
                            if ($this->Dsitenv->save($this->request->data)) {
                                $this->Session->setFlash(__('Environnement sauvegardé',true),'flash_success');
				$this->History->goBack(1);
                            } else {
                                $this->Session->setFlash(__('Environnement incorrect, veuillez corriger l\'environnement',true),'flash_failure');
                            }
                        endif;
                    } else {
                            $options = array('conditions' => array('Dsitenv.' . $this->Dsitenv->primaryKey => $id));
                            $this->request->data = $this->Dsitenv->find('first', $options);
                    }
                    $entites = $this->Dsitenv->Entite->find('list');
                    $applications = $this->requestAction('applications/get_select');
                    $this->set(compact('entites', 'applications'));
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
                $this->set('title_for_layout','Environnements DSIT');
                if (isAuthorized('dsitenvs', 'delete')) :
                    $this->Dsitenv->id = $id;
                    if (!$this->Dsitenv->exists()) {
                            throw new NotFoundException(__('Environnement incorrect'));
                    }
                    $obj = $this->Dsitenv->find('first',array('conditions'=>array('Dsitenv.id'=>$id),'recursive'=>0));
                    if($obj['Dsitenv']['ACTIF']==1):
                        $newactif = 0;
                        if ($this->Dsitenv->saveField('ACTIF',$newactif)) {
                                $this->Session->setFlash(__('Environnement archivé',true),'flash_success');
                        } else {
                                $this->Session->setFlash(__('Environnement <b>NON</b> archivé',true),'flash_failure');
                        }
                    else :
                        if ($this->Dsitenv->delete()) {
                                $this->Session->setFlash(__('Environnement supprimé',true),'flash_success');
                        } else {
                                $this->Session->setFlash(__('Environnement <b>NON</b> supprimé',true),'flash_failure');
                        }                        
                    endif;
                    $this->History->goBack(1);
                else :
                    $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                    throw new NotAuthorizedException();
                endif;                    
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Dsitenv->id = $id;
                $obj = $this->Dsitenv->find('first',array('conditions'=>array('Dsitenv.id'=>$id),'recursive'=>0));
                $newactif = $obj['Dsitenv']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Dsitenv->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }  
        
        public function get_list_for_application($application_id){
            $conditions = array();
            $conditions[] = 'Dsitenv.application_id = '.$application_id;
            $conditions[] = 'Dsitenv.ACTIF = 1';
            $list = $this->Dsitenv->find('all',array('fields'=>array('Dsitenv.id','Dsitenv.NOM'),'conditions'=>$conditions,'order'=>array('Dsitenv.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }
        
        public function get_list(){
            $conditions = array();
            $conditions[] = 'Dsitenv.ACTIF = 1';
            $list = $this->Dsitenv->find('all',array('conditions'=>$conditions,'order'=>array('Dsitenv.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }        
        
        public function get_select_for_application($application_id){
            $conditions = array();
            $conditions[] = 'Dsitenv.application_id = '.$application_id;
            $conditions[] = 'Dsitenv.ACTIF = 1';
            $list = $this->Dsitenv->find('list',array('fields'=>array('Dsitenv.id','Dsitenv.NOM'),'conditions'=>$conditions,'order'=>array('Dsitenv.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }     
        
        public function json_get_select_for_application($application_id){
            $this->autoRender = false;
            $conditions = array();
            $conditions[] = 'Dsitenv.application_id = '.$application_id;
            $conditions[] = 'Dsitenv.ACTIF = 1';
            $list = $this->Dsitenv->find('list',array('fields'=>array('Dsitenv.NOM','Dsitenv.id'),'conditions'=>$conditions,'order'=>array('Dsitenv.NOM'=>'asc'),'recursive'=>0));
            return json_encode($list);
        }   
        
        public function search(){
            if (isAuthorized('dsitenvs', 'index')) :
                $keyword=isset($this->params->data['Dsitenv']['SEARCH']) ? $this->params->data['Dsitenv']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Dsitenv.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Dsitenv->recursive = 0;
                $this->set('dsitenvs', $this->paginate());    
                $applications = $this->requestAction('applications/get_list/1');
		$this->set(compact('applications'));                 
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }          
}
