<?php
App::uses('AppController', 'Controller');
/**
 * Achats Controller
 *
 * @property Achat $Achat
 */
class AchatsController extends AppController {
        public $components = array('History','Common');  
        public $paginate = array(
        'limit' => 25,
        'order' => array('Achat.DATE' => 'desc','Achat.LIBELLEACHAT' => 'asc'),
        );
        
        public function get_visibility(){
            if(userAuth('profil_id')==1):
                return null;
            else:
                return $this->requestAction('activites/find_str_id_cercle_activite/'.userAuth('id'));
            endif;
        }
        
        public function get_restriction($visibility){
            if($visibility == null):
                return '1=1';
            elseif ($visibility!=''):
                return '1=1';
            else:
                return '1=1';
            endif;
        }
        
        public function get_achat_filtre_filter($filtre,$visibility){
            $result = array();
            switch ($filtre){
                case 'toutes':
                case null: 
                    if($visibility == null):
                        $result['condition']="Activite.projet_id > 1";
                    elseif ($visibility!=''):
                        $result['condition']="Activite.id IN (".$visibility.')';
                    else:
                        $result['condition']="Activite.projet_id > 1";
                    endif;                    
                    $result['filter'] = "toutes les activités";
                    break;                 
                default :
                    $result['condition']="Activite.id='".$filtre."'";
                    $activite = $this->Achat->Activite->find('first',array('fields'=>array('Activite.NOM'),'conditions'=>array('Activite.id'=>$filtre)));
                    $result['filter'] = "l'activité ".$activite['Activite']['NOM'];
                    break;                      
            }              
            return $result;
        }
        
        public function get_export($condition){
            $this->Session->delete('xls_export');
            $export = $this->Achat->find('all',array('conditions'=>$condition,'order'=>array('Achat.DATE'=>'desc'),'recursive'=>0));
            $this->Session->write('xls_export',$export);  
        }
        
/**
 * index method
 *
 * @return void
 */
	public function index($filtre=null) {
            if (isAuthorized('achats', 'index')) : 
                $listactivite = $this->get_visibility();
                $getfiltre = $this->get_achat_filtre_filter($filtre, $listactivite);
                $this->set('factivite',$getfiltre['filter']);  
                $newconditions = array($getfiltre['condition']);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));
		$this->set('achats', $this->paginate());
                $this->get_export($newconditions);
                $activites = $this->requestAction('activites/find_all_cercle_activite/'.userAuth('id'));
                $this->set('activites',$activites); 
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
            if (isAuthorized('achats', 'add')) : 
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Achat->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Achat->create();
			if ($this->Achat->save($this->request->data)) {
				$this->Session->setFlash(__('Achat sauvegardé',true),'flash_success');
                                $this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Achat incorrect, veuillez corriger l\'achat',true),'flash_failure');
			}
                    endif;
                 endif;
                $activites = $this->requestAction('activites/find_all_cercle_activite/'.userAuth('id'));
                $this->set('activites',$activites);                    
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
            if (isAuthorized('achats', 'edit')) :               
		if (!$this->Achat->exists($id)) {
			throw new NotFoundException(__('Achat incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Achat->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Achat->save($this->request->data)) {
				$this->Session->setFlash(__('Achat sauvegardé',true),'flash_success');
                                $this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Achat incorrect, veuillez corriger l\'achat',true),'flash_failure');
			}
                    endif;
		} else {
                    $options = array('conditions' => array('Achat.' . $this->Achat->primaryKey => $id),'recursive'=>0);
                    $this->request->data = $this->Achat->find('first', $options);
                    $activites = $this->requestAction('activites/find_all_cercle_activite/'.userAuth('id'));
                    $this->set('activites',$activites);                          
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
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
            if (isAuthorized('achats', 'delete')) : 
		$this->Achat->id = $id;
		if (!$this->Achat->exists()) {
			throw new NotFoundException(__('Achat incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Achat->delete()) {
			$this->Session->setFlash(__('Achat supprimé',true),'flash_success');
                        $this->History->goBack(1);
		}
		$this->Session->setFlash(__('Achat <b>NON</b> supprimé',true),'flash_failure');
                $this->History->goBack(1);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search($filtre=null,$keywords=null) {
            if (isAuthorized('achats', 'index')) : 
                if(isset($this->params->data['Achat']['SEARCH'])):
                    $keywords = $this->params->data['Achat']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords));        
                    $listactivite = $this->get_visibility();
                    $getfiltre = $this->get_achat_filtre_filter($filtre, $listactivite);
                    $this->set('factivite',$getfiltre['filter']);  
                    $newconditions = array($getfiltre['condition']);
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Achat.DATE LIKE '%".$value."%'","Activite.NOM LIKE '%".$value."%'","Achat.LIBELLEACHAT LIKE '%".$value."%'","Achat.DESCRIPTION LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newconditions,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                    
                    $this->set('achats', $this->paginate());
                    $this->get_export($conditions);
                    $activites = $this->requestAction('activites/find_all_cercle_activite/'.userAuth('id'));
                    $this->set('activites',$activites);  
                else:
                    $this->redirect(array('action'=>'index',$filtre));
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
        }    
       
/**
 * export_xls
 * 
 */       
	function export_xls() {
		$data = $this->Session->read('xls_export');
		$this->set('rows',$data);
		$this->render('export_xls','export_xls');
	}        
}
