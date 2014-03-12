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
        
/**
 * index method
 *
 * @return void
 */
	public function index($filtre=null) {
            //$this->Session->delete('history');
            $listactivite = $this->requestAction('activites/find_str_id_cercle_activite/'.userAuth('id'));
            if (isAuthorized('achats', 'index')) : 
                switch ($filtre){
                    case 'toutes':
                    case null: 
                    case '<':   
                        if (count($listactivite)>0):
                        $newconditions[]="Activite.id IN (".$listactivite.')';
                        $factivite = "toutes les activités";
                        endif;
                        break;                 
                    default :
                        $newconditions[]="Activite.id='".$filtre."'";
                        $activite = $this->Achat->Activite->find('first',array('fields'=>array('Activite.NOM'),'conditions'=>array('Activite.id'=>$filtre)));
                        $factivite = "l'activité ".$activite['Activite']['NOM'];
                        break;                      
                }  
                $this->set('factivite',$factivite);            
		$this->Achat->recursive = 0;
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
		$this->set('achats', $this->paginate());
                $this->Session->delete('xls_export');
                $export = $this->Achat->find('all',array('conditions'=>$newconditions,'order'=>array('Achat.DATE'=>'desc')));
                $this->Session->write('xls_export',$export); 
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
                $activites = $this->requestAction('activites/find_all_cercle_activite/'.userAuth('id'));
                $this->set('activites',$activites);   
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
                $activites = $this->requestAction('activites/find_all_cercle_activite/'.userAuth('id'));
                $this->set('activites',$activites);                
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
                    $listactivite = $this->requestAction('activites/find_str_id_cercle_activite/'.userAuth('id'));
                    switch ($filtre){
                        case 'toutes':
                        case null: 
                        case '<':   
                            if (count($listactivite)>0):
                            $newconditions[]="Activite.id IN (".$listactivite.')';
                            $factivite = "toutes les activités";
                            endif;
                            break;                 
                        default :
                            $newconditions[]="Activite.id='".$filtre."'";
                            $activite = $this->Achat->Activite->find('first',array('fields'=>array('Activite.NOM'),'conditions'=>array('Activite.id'=>$filtre)));
                            $factivite = "l'activité ".$activite['Activite']['NOM'];
                            break;                      
                    }  
                    $this->set('factivite',$factivite);            
                    $activites = $this->requestAction('activites/find_all_cercle_activite/'.userAuth('id'));
                    $this->set('activites',$activites); 
                    $newconditions[] = array("Activite.id IN (".$listactivite.')');
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Achat.DATE LIKE '%".$value."%'","Activite.NOM LIKE '%".$value."%'","Achat.LIBELLEACHAT LIKE '%".$value."%'","Achat.DESCRIPTION LIKE '%".$value."%'"));
                    endforeach;
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                    $conditions = array($newconditions,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions));                    
                    $this->Achat->recursive = 0;
                    $this->set('achats', $this->paginate());
                    $this->Session->delete('xls_export');
                    $export = $this->Achat->find('all',array('conditions'=>$newconditions));
                    $this->Session->write('xls_export',$export);     
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
        
    public function returnTo($pos=null){
        
    }        
             
}
