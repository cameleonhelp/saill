<?php
App::uses('AppController', 'Controller');
/**
 * Livrables Controller
 *
 * @property Livrable $Livrable
 */
class LivrablesController extends AppController {
 
    public $paginate = array(
        'limit' => 15,
        'order' => array('Livrable.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index($filtreChrono=null,$filtreEtat=null,$filtregestionnaire=null) {
            //$this->Session->delete('history');
            if (isAuthorized('livrables', 'index')) :
                switch ($filtreChrono){
                    case 'toutes':
                    case null:  
                    case '<':    
                        $newconditions[]="1=1";
                        $fchronologie = "tous les livrables";
                        break;
                    case 'previousweek':
                        $date = new DateTime();
                        $today = startWeek($date->sub(new DateInterval('P1W')));
                        $previousWeek = endWeek($date);
                        $newconditions[]="Livrable.ECHEANCE BETWEEN '".$today."' AND '".$previousWeek."'";
                        $fchronologie = "tous les livrables de la semaine précédente (entre le ".CFRDate($today)." et le ".CFRDate($previousWeek).")";
                        break;  
                    case 'week':
                        $date = new DateTime();
                        $today = startWeek($date);
                        $previousWeek = endWeek($date);
                        $newconditions[]="Livrable.ECHEANCE BETWEEN '".$today."' AND '".$previousWeek."'";            
                        $fchronologie = "tous les livrables de la semaine en cours (entre le ".CFRDate($today)." et le ".CFRDate($previousWeek).")";
                        break;  
                    case 'nextweek':
                        $date = new DateTime();
                        $today = startWeek($date->add(new DateInterval('P1W')));
                        $previousWeek = endWeek($date);
                        $newconditions[]="Livrable.ECHEANCE BETWEEN '".$today."' AND '".$previousWeek."'";                       
                        $fchronologie = "tous les livrables de la semaine suivante (entre le ".CFRDate($today)." et le ".CFRDate($previousWeek).")";
                        break;  
                    case 'tolate':
                        $date = new DateTime();
                        $previousWeek = startWeek($date->sub(new DateInterval('P1W')));
                        $newconditions[]="Livrable.ECHEANCE < '".$previousWeek."' OR (Livrable.DATELIVRAISON = 0000-00-00 OR Livrable.DATELIVRAISON = NULL OR Livrable.DATELIVRAISON < ".$previousWeek.")";
                        $fchronologie = "tous les livrables avec une échéance ou une date de livraison avant le ".CFRDate($previousWeek);
                        break;  
                    case 'otherweek':
                        $date = new DateTime();
                        $previousWeek = endWeek($date->add(new DateInterval('P1W')));
                        $newconditions[]="Livrable.ECHEANCE >= '".$previousWeek."'";
                        $fchronologie = "tous les livrables avec une échéance après le ".CFRDate($previousWeek);
                        break;                     
                }
                $this->set('fchronologie',$fchronologie); 
                switch ($filtreEtat){
                    case 'tous':
                    case null:    
                        $newconditions[]="1=1";
                        $fetat = "sans condition sur les états";
                        break;                      
                    case 'todo':
                        $newconditions[]="Livrable.ETAT = 'à faire'";
                        $fetat = "dont l'état est 'à faire'";
                        break;  
                    case 'inmotion':
                        $newconditions[]="Livrable.ETAT = 'en cours'";
                        $fetat = "dont l'état est 'en cours'";
                        break;  
                    case 'delivered':
                        $newconditions[]="Livrable.ETAT = 'livré'";
                        $fetat = "dont l'état est 'livré'";
                        break;  
                    case 'validated':
                        $newconditions[]="Livrable.ETAT = 'validé'";
                        $fetat = "dont l'état est 'validé'";
                        break;  
                    case 'notvalidated':
                        $newconditions[]="Livrable.ETAT != 'validé'";
                        $fetat = "dont l'état est autre que 'validé'";
                        break;                      
                    }    
                $this->set('fetat',$fetat);  
                if (areaIsVisible() || $filtregestionnaire==userAuth('id')):
                switch ($filtregestionnaire){
                    case 'tous':   
                        $newconditions[]="1=1";
                        $fgestionnaire = "de tous les gestionnaires";
                        break;  
                    case null:   
                        $newconditions[]="Livrable.utilisateur_id = '".userAuth('id')."'";
                        $this->Livrable->Utilisateur->recursive = -1;
                        $nomlong = $this->Livrable->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array('Utilisateur.id'=> userAuth('id'))));
                        $fgestionnaire = "dont le gestionnaire est ".$nomlong['Utilisateur']['NOMLONG']; 
                        break;                     
                    default :
                        $newconditions[]="Livrable.utilisateur_id = '".$filtregestionnaire."'";
                        $this->Livrable->Utilisateur->recursive = -1;
                        $nomlong = $this->Livrable->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array('Utilisateur.id'=> $filtregestionnaire)));
                        $fgestionnaire = "dont le gestionnaire est ".$nomlong['Utilisateur']['NOMLONG'];                     
                    }  
                else:
                        $newconditions[]="Livrable.utilisateur_id = '".userAuth('id')."'";
                        $this->Livrable->Utilisateur->recursive = -1;
                        $nomlong = $this->Livrable->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array('Utilisateur.id'=> userAuth('id'))));
                        $fgestionnaire = "dont le gestionnaire est ".$nomlong['Utilisateur']['NOMLONG'];                
                endif;                     
                $this->set('fgestionnaire',$fgestionnaire); 
                $this->Livrable->Utilisateur->recursive = -1;
                $gestionnaires = $this->Livrable->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('gestionnaires',$gestionnaires);                
		$this->Livrable->recursive = 0;
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->set('livrables', $this->paginate());
                $this->Session->delete('xls_export');
                $export = $this->Livrable->find('all',array('conditions'=>$newconditions,'order' => array('Livrable.NOM' => 'asc')));
                $this->Session->write('xls_export',$export);                   
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
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
            if (isAuthorized('livrables', 'view')) :
		if (!$this->Livrable->exists($id)) {
			throw new NotFoundException(__('Livrable incorrect'));
		}
		$options = array('conditions' => array('Livrable.' . $this->Livrable->primaryKey => $id));
		$this->set('livrable', $this->Livrable->find('first', $options));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('livrables', 'add')) :
                $etats = Configure::read('etatLivrable');
                $this->set('etats',$etats);   
                $this->Livrable->Utilisateur->recursive = -1;
                $utilisateur = $this->Livrable->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('utilisateur',$utilisateur);
                $this->Livrable->Utilisateur->recursive = -1;
		$nomlong = $this->Livrable->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>  userAuth('id'))));
		$this->set('nomlong', $nomlong);                 
		if ($this->request->is('post')) :
			$this->Livrable->create();
			if ($this->Livrable->save($this->request->data)) {
				$this->Session->setFlash(__('Livrable sauvegardé'),'default',array('class'=>'alert alert-success'));
                                //enregistrer le suivilivrable
                                $thisLivrable = $this->Livrable->find('first',array('conditions'=>array('Livrable.id'=>$this->Livrable->getInsertID())));
                                $suiviliv['Suivilivrable']['livrable_id']=$thisLivrable['Livrable']['id'];
                                $suiviliv['Suivilivrable']['ECHEANCE']=$thisLivrable['Livrable']['ECHEANCE'];
                                $suiviliv['Suivilivrable']['ETAT']=$thisLivrable['Livrable']['ETAT'];
                                $suiviliv['Suivilivrable']['DATELIVRAISON']=$thisLivrable['Livrable']['DATELIVRAISON'];
                                $suiviliv['Suivilivrable']['DATEVALIDATION']=$thisLivrable['Livrable']['DATEVALIDATION'];
                                $this->Livrable->Suivilivrable->create();
                                $this->Livrable->Suivilivrable->save($suiviliv);
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Livrable incorrect, veuillez corriger le livrable'),'default',array('class'=>'alert alert-error'));
			}
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
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
            if (isAuthorized('livrables', 'edit')) :
                $etats = Configure::read('etatLivrable');
                $this->set('etats',$etats);      
                $this->Livrable->Utilisateur->recursive = -1;
                $utilisateur = $this->Livrable->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('utilisateur',$utilisateur);  
                $this->Livrable->Utilisateur->recursive = -1;
		$nomlong = $this->Livrable->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>  userAuth('id'))));
		$this->set('nomlong', $nomlong);     
                $this->Livrable->Suivilivrable->recursive = -1;
                $suivilivrables = $this->Livrable->Suivilivrable->find('all',array('conditions'=>array('Suivilivrable.livrable_id'=>$id),'order'=>array('Suivilivrable.created'=>'desc','Suivilivrable.id'=>'desc')));
                $this->set('Suivilivrables',$suivilivrables);                 
		if (!$this->Livrable->exists($id)) {
			throw new NotFoundException(__('Livrable incorrect'),'default',array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {                    
			if ($this->Livrable->save($this->request->data)) {
				$this->Session->setFlash(__('Livrable sauvegardé'),'default',array('class'=>'alert alert-success'));
                                //enregistrer le suivilivrable   
                                $thisLivrable = $this->Livrable->find('first',array('conditions'=>array('Livrable.id'=>$id)));
                                $suiviliv['Suivilivrable']['livrable_id']=$thisLivrable['Livrable']['id'];
                                $suiviliv['Suivilivrable']['ECHEANCE']=$thisLivrable['Livrable']['ECHEANCE'];
                                $suiviliv['Suivilivrable']['ETAT']=$thisLivrable['Livrable']['ETAT'];
                                $suiviliv['Suivilivrable']['DATELIVRAISON']=$thisLivrable['Livrable']['DATELIVRAISON'];
                                $suiviliv['Suivilivrable']['DATEVALIDATION']=$thisLivrable['Livrable']['DATEVALIDATION'];                                
                                $this->Livrable->Suivilivrable->create();
                                $this->Livrable->Suivilivrable->save($suiviliv);
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Livrable incorrect, veuillez corriger le livrable'),'default',array('class'=>'alert alert-error'));
			}
		} else {
                        $this->Livrable->recursive = 0;
			$options = array('conditions' => array('Livrable.' . $this->Livrable->primaryKey => $id));
			$this->request->data = $this->Livrable->find('first', $options);
		}
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
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
            if (isAuthorized('livrables', 'delete')) :
		$this->Livrable->id = $id;
		if (!$this->Livrable->exists()) {
			throw new NotFoundException(__('Livrable incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Livrable->delete()) {
			$this->Session->setFlash(__('Livrable supprimé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Livrable <b>NON</b> supprimé'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
            if (isAuthorized('livrables', 'index')) :
                $keyword=isset($this->params->data['Livrable']['SEARCH']) ? $this->params->data['Livrable']['SEARCH'] : '';  
                $newconditions = array('OR'=>array("Livrable.NOM LIKE '%".$keyword."%'","Livrable.REFERENCE LIKE '%".$keyword."%'","Utilisateur.NOM LIKE '%".$keyword."%'","Utilisateur.PRENOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions)); 
                $this->autoRender = false;
                $this->Livrable->recursive = 0;
                $this->set('livrables', $this->paginate());
                $this->Livrable->Utilisateur->recursive = -1;
                $gestionnaires = $this->Livrable->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('gestionnaires',$gestionnaires);                  
                $this->Session->delete('xls_export');               
                $this->Session->write('xls_export',$this->paginate());                
                $this->render('index'); 
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
        }       
        
/**
 * export_xls
 * 
 */       
	function export_xls() {
		$data = $this->Session->read('xls_export');
                $this->Session->delete('xls_export');                
		$this->set('rows',$data);
		$this->render('export_xls','export_xls');
	}     
        
/**
 * dupliquer method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function dupliquer($id = null) {
            if (isAuthorized('livrables', 'duplicate')) :
		$this->Livrable->id = $id;
                $record = $this->Livrable->read();
                unset($record['Livrable']['id']);
                $record['Livrable']['VERSION']=isset($record['Livrable']['VERSION']) && $record['Livrable']['VERSION']!='' ? $record['Livrable']['VERSION']+1 : 1;
                $record['Livrable']['ETAT']='à faire';
                unset($record['Livrable']['created']);                
                unset($record['Livrable']['modified']);
                unset($record['Suivilivrable']);
                $this->Livrable->create();
                if ($this->Livrable->save($record)) {
                        $this->Session->setFlash(__('Livrable dupliqué'),'default',array('class'=>'alert alert-success'));
                        $this->redirect($this->goToPostion());
                } 
		$this->Session->setFlash(__('Livrable <b>NON</b> dupliqué'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}          
}
