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
            if (isAuthorized('achats', 'index')) : 
                switch ($filtre){
                    case 'toutes':
                    case null: 
                    case '<':    
                        $newconditions[]="1=1";
                        $factivite = "toutes les activités";
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
                $listeActivites = $this->Achat->find('all',array('fileds'=>array('Achat.activite_id'),'group'=>'Achat.activite_id','recursive'=>-1));
                $listein = '';
                foreach($listeActivites as $liste):
                    $listein .= $liste['Achat']['activite_id'].',';
                endforeach;
                $this->Achat->Activite->recursive = 0;
                $activites = $this->Achat->Activite->find('all',array('fields' => array('id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>"asc",'Activite.NOM'=>'asc'),'conditions'=>array('Activite.projet_id>1','Activite.id IN ('.substr_replace($listein ,"",-1).')')));
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
                $activites = $this->Achat->Activite->find('all',array('fields' => array('id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'conditions'=>'Activite.projet_id>1'));
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
                $activites = $this->Achat->Activite->find('all',array('fields' => array('id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'conditions'=>array('Activite.projet_id>1'),'recursive'=>0));
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
	public function search() {
            if (isAuthorized('achats', 'index')) : 
                $keyword=isset($this->params->data['Achat']['SEARCH']) ? $this->params->data['Achat']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Achat.DATE LIKE '%".$keyword."%'","Activite.NOM LIKE '%".$keyword."%'","Achat.LIBELLEACHAT LIKE '%".$keyword."%'","Achat.DESCRIPTION LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Achat->recursive = 0;
                $this->set('achats', $this->paginate());
                $this->Session->delete('xls_export');
                $export = $this->Achat->find('all',array('conditions'=>$newconditions));
                $this->Session->write('xls_export',$export);     
                $listeActivites = $this->Achat->find('all',array('fileds'=>array('Achat.activite_id'),'group'=>'Achat.activite_id','recursive'=>-1));
                $listein = '';
                foreach($listeActivites as $liste):
                    $listein .= $liste['Achat']['activite_id'].',';
                endforeach;
                $activites = $this->Achat->Activite->find('all',array('fields' => array('id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>"asc",'Activite.NOM'=>'asc'),'conditions'=>array('Activite.projet_id>1','Activite.id IN ('.substr_replace($listein ,"",-1).')')));
                $this->set('activites',$activites);   
                $this->render('index');
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
