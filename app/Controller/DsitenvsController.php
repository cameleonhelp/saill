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
        public $paginate = array('order'=>array('Dsitenv.NOM'=>'asc'),'limit'=>25);
	public $components = array('History','Common');

        public function get_visibility(){
            if(userAuth('profil_id')==1):
                return null;
            else:
                return $this->requestAction('assoentiteutilisateurs/json_get_my_entite/'.userAuth('id'));
            endif;
        }
        
        public function get_restriction($visibility){
            if($visibility == null):
                return "1=1";
            elseif ($visibility !=""):
                return "Dsitenv.entite_id IN (".$visibility.')';
            else:
                return "Dsitenv.entite_id=".userAuth('entite_id');
            endif;
        }   
        
        public function get_envdsit_application_filter($application){
            $result = array();
            switch($application):
                case null:
                case 'tous':
                    $listapp = $this->requestAction('applications/get_str_list');
                    $result['condition']="Dsitenv.application_id IN (".$listapp.")";
                    $result['filter'] = 'toutes les applications';
                    break;
                default:
                    $result['condition']="Dsitenv.application_id=".$application;
                    $nom = $this->requestAction('applications/getname/'.$application);
                    $result['filter'] = 'l\'application '.$nom;
                    break;
            endswitch;
            return $result;
        }
        
        public function get_envdsit_actif_filter($actif){
            $result = array();
            switch($actif):
                case null:
                case 1:
                    $result['condition']="Dsitenv.ACTIF=1";
                    $result['filter']= ' et actifs';
                    break;
                case 0:
                    $result['condition']="Dsitenv.ACTIF=0";
                    $result['filter']= ' et inactifs';
                    break;
            endswitch; 
            return $result;
        }
        
        public function set_title(){
            $this->set('title_for_layout','Environnements DSIT');
        }
/**
 * index method
 *
 * @return void
 */
	public function index($application=null,$actif=null) {
            $this->set_title();
            if (isAuthorized('dsitenvs', 'index')) :
                $listentite = $this->get_visibility();
                $restriction = $this->get_restriction($listentite);                
                $getapplication = $this->get_envdsit_application_filter($application);
                $getactif = $this->get_envdsit_actif_filter($actif);
                $strfilter = $getapplication['filter'].$getactif['filter'];
                $newconditions = array($restriction,$getapplication['condition'],$getactif['condition']);
                $applications = $this->requestAction('applications/get_list/1');
                $this->set(compact('applications','strfilter'));    
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));                
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
            $this->set_title();
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
                $this->set_title();
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
                $this->set_title();
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
            $this->set_title();
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
        
        public function search($application=null,$actif=null,$keywords=null){
            $this->set_title();
            if (isAuthorized('dsitenvs', 'index')) :
                if(isset($this->params->data['Dsitenv']['SEARCH'])):
                    $keywords = $this->params->data['Dsitenv']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords));                 
                    $listentite = $this->get_visibility();
                    $restriction = $this->get_restriction($listentite);                
                    $getapplication = $this->get_envdsit_application_filter($application);
                    $getactif = $this->get_envdsit_actif_filter($actif);
                    $strfilter = $getapplication['filter'].$getactif['filter'];
                    $newconditions = array($restriction,$getapplication['condition'],$getactif['condition']);
                    $applications = $this->requestAction('applications/get_list/1');
                    $this->set(compact('applications','strfilter')); 
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Dsitenv.NOM LIKE '%".$value."%'","Application.NOM LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newconditions,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0)); 
                    $this->set('dsitenvs', $this->paginate());
                else:
                    $this->redirect(array('action'=>'index',$aplication,$actif));
                endif; 
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }          
}
