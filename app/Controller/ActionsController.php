<?php
App::uses('AppController', 'Controller');
/**
 * Actions Controller
 *
 * @property Action $Action
 */
class ActionsController extends AppController {

        public $paginate = array(
        'limit' => 15,
        'order' => array('Action.ECHEANCE' => 'asc','Action.PRIORITE'=>'asc'),
        );
        
/**
 * index method
 *
 * @return void
 */
	public function index($filtrePriorite=null,$filtreEtat=null,$filtreResponsable=null) {
            if (isAuthorized('actions', 'index')) :
                switch ($filtrePriorite){
                    case 'tous':
                    case null:    
                        $newconditions[]="1=1";
                        $fpriorite = "toutes les priorités";
                        break;                  
                    case '1':
                        $newconditions[]="Action.PRIORITE='normale'";
                        $fpriorite = "la priorité normale";
                        break;                      
                    case '2':
                        $newconditions[]="Action.PRIORITE='moyenne'";
                        $fpriorite = "la priorité moyenne";
                        break;   
                    case '3':
                        $newconditions[]="Action.PRIORITE='haute'";
                        $fpriorite = "la priorité haute";
                        break;   
                    }  
                $this->set('fpriorite',$fpriorite); 
                switch ($filtreEtat){
                    case 'tous':    
                        $newconditions[]="1=1";
                        $fetat = "tous les états";
                        break;                 
                    case '1':
                        $newconditions[]="Action.STATUT='à faire'";
                        $fetat = "l'état à faire";
                        break;                      
                    case '2':
                        $newconditions[]="Action.STATUT='en cours'";
                        $fetat = "l'état en cours";
                        break;    
                    case '3':
                        $newconditions[]="Action.STATUT='terminée'";
                        $fetat = "l'état terminée";
                        break;    
                    case '4':
                        $newconditions[]="Action.STATUT='livrée'";
                        $fetat = "l'état livrée";
                        break;    
                    case '5':
                        $newconditions[]="Action.STATUT='annulée'";
                        $fetat = "l'état annulée";
                        break;                        
                    case '6':
                    case null :
                        $newconditions[]="(Action.STATUT ='à faire' OR Action.STATUT ='en cours')";
                        $fetat = "l'état à faire ou en cours";
                        break;
                    }  
                $this->set('fetat',$fetat); 
                switch ($filtreResponsable){
                    case 'tous':
                    case null:    
                        $newconditions[]="1=1";
                        $fresponsable = "de tous les agents";
                        break;                    
                    default :
                        $newconditions[]="Action.destinataire='".$filtreResponsable."'";
                        $nomlong = $this->Action->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array("Utilisateur.id"=>$filtreResponsable)));
                        $fresponsable = "dont le responsable est ".$nomlong['Utilisateur']['NOMLONG'];
                        break;                      
                }  
                $this->set('fresponsable',$fresponsable); 
                $responsables = $this->Action->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('responsables',$responsables);                 
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
		$this->Action->recursive = 0;
                $this->set('actions', $this->paginate());
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
            if (isAuthorized('actions', 'view')) :
		if (!$this->Action->exists($id)) {
			throw new NotFoundException(__('Action incorrecte'));
		}
		$options = array('conditions' => array('Action.' . $this->Action->primaryKey => $id));
		$this->set('action', $this->Action->find('first', $options));
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
            if (isAuthorized('actions', 'add')) :
		if ($this->request->is('post')) {
			$this->Action->create();
			if ($this->Action->save($this->request->data)) {
                                $this->saveHistory($this->Action->getInsertID()); 
                                //$this->initActiviteReelle($this->Action->getInsertID());
				$this->Session->setFlash(__('Action sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Action incorrecte, veuillez corriger l\'action'),'default',array('class'=>'alert alert-error'));
			}
		}
                $etats = Configure::read('etatAction');
                $this->set('etats',$etats); 
                $priorites = Configure::read('prioriteAction');
                $this->set('priorites',$priorites); 
                $types = Configure::read('typeAction');
                $this->set('types',$types);    
                $destinataires = $this->Action->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('destinataires',$destinataires); 
                $activitesagent = $this->findActiviteForUtilisateur(2);
                $this->set('activitesagent',$activitesagent); 
                $activites = $this->findActiviteActive();
                $this->set('activites',$activites);    
                $livrablesNonClos = $this->findLivrableNonTermine();
                $this->set('livrablesNonClos',$livrablesNonClos);
                $domaines = $this->Action->Domaine->find('list',array('fields'=>array('id','NOM')));
                $this->set('domaines',$domaines); 
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
            if (isAuthorized('actions', 'edit')) :
                if (!$this->Action->exists($id)) {
			throw new NotFoundException(__('Action incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Action->save($this->request->data)) {
                                $this->saveHistory($id);                                
				$this->Session->setFlash(__('Action sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Action incorrecte, veuilelz corriger l\'action'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Action.' . $this->Action->primaryKey => $id));
			$this->request->data = $this->Action->find('first', $options);
		}
                $nbActivite = $this->ActiviteExists($id);
                $this->set('nbActivite',$nbActivite);
                $this->set('actionId',$id);
                if ($nbActivite < 2)  {
                    $activite = $this->Action->Activitesreelle->find('first',array('conditions'=>array('Activitesreelle.action_id'=>$id),'fields'=>array('id')));
                    $this->set('activiteId',$activite);                    
                }
                $utilisateurId = $this->Action->find('first',array('conditions'=>array('Action.id'=>$id),'fields'=>array('utilisateur_id')));
                $this->set('utilisateurId', $utilisateurId);
                $etats = Configure::read('etatAction');
                $this->set('etats',$etats); 
                $priorites = Configure::read('prioriteAction');
                $this->set('priorites',$priorites); 
                $types = Configure::read('typeAction');
                $this->set('types',$types);    
                $destinataires = $this->Action->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('destinataires',$destinataires); 
                $activitesagent = $this->findActiviteForUtilisateur(2);
                $this->set('activitesagent',$activitesagent);   
                $domaines = $this->Action->Domaine->find('list',array('fields'=>array('id','NOM')));
                $this->set('domaines',$domaines); 
                $histories = $this->Action->Historyaction->find('all',array('conditions'=>array('Historyaction.action_id'=>$id),'order'=>array('Historyaction.id'=>'desc')));
                $this->set('histories',$histories);
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
            if (isAuthorized('actions', 'delete')) :
		$this->Action->id = $id;
		if (!$this->Action->exists()) {
			throw new NotFoundException(__('Action incorrecte'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Action->delete()) {
			$this->Session->setFlash(__('Action supprimée'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Action <b>NON</b> supprimée'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('actions', 'index')) :
                $keyword=$this->params->data['Action']['SEARCH']; 
                $newconditions = array('OR'=>array("Action.OBJET LIKE '%".$keyword."%'","Utilisateur.NOM LIKE '%".$keyword."%'","Utilisateur.PRENOM LIKE '%".$keyword."%'","Action.COMMENTAIRE LIKE '%".$keyword."%'","Activite.NOM LIKE '%".$keyword."%'","Domaine.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Action->recursive = 0;
                $this->set('actions', $this->paginate());
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                 
        }     
        
        public function findActiviteForUtilisateur($utilisateur_id = null) {
            $list = array();
            $sql = "SELECT affectations.activite_id, activites.NOM FROM affectations LEFT JOIN activites ON ( activites.id = affectations.activite_id ) WHERE utilisateur_id = ".$utilisateur_id;
            $results = $this->Action->query($sql);
            foreach ($results as $result) {
                $list[$result['affectations']['activite_id']]=$result['activites']['NOM'];
            }
            return $list;
        }        

        public function findActiviteActive() {
            $list = array();
            $sql = "SELECT activites.id, activites.NOM FROM activites WHERE activites.ACTIVE = 1";
            $results = $this->Action->query($sql);
            foreach ($results as $result) {
                $list[$result['activites']['id']]=$result['activites']['NOM'];
            }
            return $list;
        } 
        
        public function findLivrableNonTermine() {
            $list = array();
            $sql = "SELECT livrables.id, livrables.NOM FROM livrables WHERE livrables.ETAT NOT IN ('validé','livré','refusé','annulé')";
            $results = $this->Action->query($sql);
            foreach ($results as $result) {
                $list[$result['livrables']['id']]=$result['livrables']['NOM'];
            }
            return $list;
        }   
        
        public function saveHistory($id){
            $thisAction = $this->Action->find('first',array('conditions'=>array('Action.id'=>$id)));
            $history['Historyaction']['action_id']=$thisAction['Action']['id'];
            $history['Historyaction']['AVANCEMENT']=$thisAction['Action']['AVANCEMENT'];
            $history['Historyaction']['DEBUT']=$thisAction['Action']['DEBUT'];
            $history['Historyaction']['ECHEANCE']=$thisAction['Action']['ECHEANCE'];
            $history['Historyaction']['CHARGEPREVUE']=$thisAction['Action']['DUREEPREVUE'];
            $history['Historyaction']['PRIORITE']=$thisAction['Action']['PRIORITE'];
            $history['Historyaction']['STATUT']=$thisAction['Action']['STATUT'];
            $history['Historyaction']['COMMENTAIRE']='Le '.date('d/m/Y').' par '.userAuth('NOMLONG').'<br>'.$thisAction['Action']['COMMENTAIRE'];
            $this->Action->Historyaction->create();
            $this->Action->Historyaction->save($history);            
        }
        
        public function initActiviteReelle($id){
            $action = $this->Action->find('first',array('conditions'=>array('Action.id'=>$id)));
            $realActivity['Activitesreelle']['action_id']=$action['Action']['id'];
            $realActivity['Activitesreelle']['activite_id']=$action['Action']['activite_id'];
            $realActivity['Activitesreelle']['utilisateur_id']=$action['Action']['utilisateur_id'];
            $realActivity['Activitesreelle']['DATE']=$action['Action']['DEBUT'];
            $realActivity['Activitesreelle']['LU']=0;     
            $realActivity['Activitesreelle']['LU_TYPE']=0;              
            $realActivity['Activitesreelle']['MA']=0;     
            $realActivity['Activitesreelle']['MA_TYPE']=0;
            $realActivity['Activitesreelle']['ME']=0;     
            $realActivity['Activitesreelle']['ME_TYPE']=0;
            $realActivity['Activitesreelle']['JE']=0;     
            $realActivity['Activitesreelle']['JE_TYPE']=0;
            $realActivity['Activitesreelle']['VE']=0;     
            $realActivity['Activitesreelle']['VE_TYPE']=0;
            $realActivity['Activitesreelle']['SA']=0;     
            $realActivity['Activitesreelle']['SA_TYPE']=0;
            $realActivity['Activitesreelle']['DI']=0;     
            $realActivity['Activitesreelle']['DI_TYPE']=0;
            $this->Action->Activitesreelle->create();
            $this->Action->Activitesreelle->save($realActivity);
        }
        
        public function ActiviteExists($id){
            $allActivite = $this->Action->Activitesreelle->find('all',array('conditions'=>array('Activitesreelle.action_id'=>$id)));
            return count($allActivite);
        }
}
