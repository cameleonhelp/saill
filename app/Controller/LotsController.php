<?php
App::uses('AppController', 'Controller');
/**
 * Lots Controller
 *
 * @property Lot $Lot
 * @property PaginatorComponent $Paginator
 */
class LotsController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Lot.NOM'=>'asc'));
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
                return '1=1';
            elseif ($visibility!=''):
                return array('OR'=>array('Lot.entite_id IN ('.$visibility.')','Lot.entite_id IS NULL'));
            else:
                return array('OR'=>array('Lot.entite_id ='.userAuth('entite_id'),'Lot.entite_id IS NULL'));
            endif;
        }
        
        public function get_lot_actif_filter($id){
            $result = array();
            switch($id):
                case null:
                case 1:
                    $result['condition']="Lot.ACTIF=1";
                    $result['filter'] = 'actives';
                    break;
                case 0:
                    $result['condition']="Lot.ACTIF=0";
                    $result['filter'] = 'inactives';
                    break;
            endswitch;
            return $result;
        }
        
        public function get_lot_entite_filter($id,$visibility){
            $result = array();
            switch($id):
                case null:
                case 'tous':
                    if($visibility == null):
                        $result['condition']='1=1';
                    elseif ($visibility!=''):
                        $result['condition']=array('OR'=>array('Lot.entite_id IN ('.$visibility.')','Lot.entite_id IS NULL'));
                    else:
                        $result['condition']=array('OR'=>array('Lot.entite_id ='.userAuth('entite_id'),'Lot.entite_id IS NULL'));
                    endif;                      
                    $result['filter'] = ' de tous les cercles';
                    break;
                default:
                    $result['condition']='Lot.entite_id ='.$id;
                    $nom = $this->requestAction('entites/get_entite_nom/'.$id);
                    $result['filter'] = 'ayant pour entité '.$nom;
            endswitch;
            return $result;
        }  
/**
 * index method
 *
 * @return void
 */
	public function index($actif=null,$entite=null) {
            if (isAuthorized('lots', 'index')) :
                $visibility = $this->get_visibility();                
                $restriction= $this->get_restriction($visibility);
                $getactif = $this->get_lot_actif_filter($actif);
                $getentite = $this->get_lot_entite_filter($entite, $visibility);
                $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newcondition,'recursive'=>0));   
		$this->set('lots', $this->paginate());
                $cercles = $this->requestAction('entites/get_all');
                $this->set(compact('cercles'));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('lots', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Lot->validate = array();
                        $this->History->goBack(1);
                    else:                
                        $this->request->data['Lot']['entite_id']=userAuth('entite_id');
			$this->Lot->create();
			if ($this->Lot->save($this->request->data)) {
				$this->Session->setFlash(__('Lot sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Lot incorrect, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		endif;
                $cercles = $this->requestAction('entites/find_list_cercle');
                $this->set(compact('cercles'));
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
            if (isAuthorized('lots', 'edit')) :            
		if (!$this->Lot->exists($id)) {
			throw new NotFoundException(__('Lot incorrect'));
		}
                $versions = $this->requestAction('versions/get_version_for/'.$id."/1");
                $this->set('versions',$versions);
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Lot->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Lot->save($this->request->data)) {
				$this->Session->setFlash(__('Lot sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Lot incorrect, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
                    $options = array('conditions' => array('Lot.' . $this->Lot->primaryKey => $id));
                    $this->request->data = $this->Lot->find('first', $options);
                    $cercles = $this->requestAction('entites/find_list_cercle');
                    $this->set(compact('cercles'));
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
            if (isAuthorized('lots', 'delete')) : 
		$this->Lot->id = $id;
		if (!$this->Lot->exists()) {
			throw new NotFoundException(__('Lot incorrect'));
		}
		if ($this->Lot->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Lot supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Lot <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Lot->id = $id;
                $obj = $this->Lot->find('first',array('conditions'=>array('Lot.id'=>$id),'recursive'=>0));
                $newactif = $obj['Lot']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Lot->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search($actif=null,$entite=null,$keywords=null){
            if (isAuthorized('lot', 'index')) :
                if(isset($this->params->data['Lot']['SEARCH'])):
                    $keywords = $this->params->data['Lot']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords)); 
                    $visibility = $this->get_visibility();                
                    $restriction= $this->get_restriction($visibility);
                    $getactif = $this->get_lot_actif_filter($actif);
                    $getentite = $this->get_lot_entite_filter($entite, $visibility);
                    $this->set('strfilter',$getactif['filter'].$getentite['filter']);
                    $newcondition = array($restriction,$getactif['condition'],$getentite['condition']);
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Lot.NOM LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newcondition,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                    $this->set('lots', $this->paginate());    
                    $cercles = $this->requestAction('entites/get_all');
                    $this->set(compact('cercles'));                    
                else:
                    $this->redirect(array('action'=>'index',$actif,$entite));
                endif;   
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=1){
            $visibility = $this->get_visibility();                
            $conditions[]= $this->get_restriction($visibility);               
            $conditions[] = $actif == null ? '1=1' : 'Lot.ACTIF='.$actif;  
            $list = $this->Lot->find('list',array('fields'=>array('Lot.id','Lot.NOM'),'conditions'=>$conditions,'order'=>array('Lot.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }       
             
        public function get_list($actif=null){
            $visibility = $this->get_visibility();                
            $conditions[]= $this->get_restriction($visibility);               
            $conditions[] = $actif == null ? '1=1' : 'Lot.ACTIF='.$actif;  
            $list = $this->Lot->find('all',array('fields'=>array('Lot.id','Lot.NOM'),'conditions'=>$conditions,'order'=>array('Lot.NOM'=>'asc'),'recursive'=>0));
            return $list;
        } 
        
        public function getbynom($nom){
            $this->Lot->recursive = 0;
            $obj = $this->Lot->findByNom($nom);
            return $obj;
        }          
}