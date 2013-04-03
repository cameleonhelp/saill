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
                if (areaIsVisible() || $filtreResponsable==userAuth('id')):
                switch ($filtreResponsable){
                    case 'tous':
                    case null:    
                        $newconditions[]="1=1";
                        $fresponsable = "de tous les agents";
                        break;                    
                    default :
                        $newconditions[]="Action.destinataire='".$filtreResponsable."'AND Utilisateur.GESTIONABSENCES=1";
                        $nomlong = $this->Action->Utilisateur->recursive = -1;
                        $nomlong = $this->Action->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array("Utilisateur.id"=>$filtreResponsable)));
                        $fresponsable = "dont le responsable est ".isset($nomlong['Utilisateur']['NOMLONG']) ? $nomlong['Utilisateur']['NOMLONG'] : $nomlong['NOMLONG'] ;
                        $this->set('nomlong',$filtreResponsable);
                        break;                      
                }  
                else:
                    $newconditions[]="Action.destinataire='".userAuth('id')."'";
                    $nomlong = $this->Action->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array("Utilisateur.id"=>userAuth('id'))));
                    $fresponsable = "dont le responsable est ".$nomlong['Utilisateur']['NOMLONG'];
                endif;
                $this->set('fresponsable',$fresponsable); 
                $responsables = $this->Action->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.GESTIONABSENCES'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
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
                $nomlong = $this->Action->Utilisateur->recursive = -1;
                $destinataires = $this->Action->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.GESTIONABSENCES'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('destinataires',$destinataires); 
                $activitesagent = $this->findActiviteForUtilisateur(userAuth('id'));
                $this->set('activitesagent',$activitesagent);    
                $this->Action->Domaine->recursive = -1;
                $domaines = $this->Action->Domaine->find('list',array('fields'=>array('id','NOM'),'order'=>array('Domaine.NOM')));
                $this->set('domaines',$domaines); 
                $this->Action->Utilisateur->recursive = -1;
		$nomlong = $this->Action->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>  userAuth('id'))));
		$this->set('nomlong', $nomlong);                 
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
                    $this->Action->Activitesreelle->recursive = -1;
                    $activite = $this->Action->Activitesreelle->find('first',array('conditions'=>array('Activitesreelle.action_id'=>$id),'fields'=>array('id')));
                    $this->set('activiteId',$activite);                    
                }
                $this->Action->recursive = -1;
                $utilisateurId = $this->Action->find('first',array('conditions'=>array('Action.id'=>$id),'fields'=>array('utilisateur_id')));
                $this->set('utilisateurId', $utilisateurId);
                $etats = Configure::read('etatAction');
                $this->set('etats',$etats); 
                $priorites = Configure::read('prioriteAction');
                $this->set('priorites',$priorites); 
                $types = Configure::read('typeAction');
                $this->set('types',$types);    
                $this->Action->Utilisateur->recursive = -1;
                $destinataires = $this->Action->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.GESTIONABSENCES'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('destinataires',$destinataires); 
                $activitesagent = $this->findActiviteForUtilisateur(userAuth('id'));
                $this->set('activitesagent',$activitesagent);  
                $livrables = $this->findLivrable($id);
                $this->set('livrables',$livrables);
                $this->Action->Domaine->recursive = -1;
                $domaines = $this->Action->Domaine->find('list',array('fields'=>array('id','NOM'),'order'=>array('Domaine.NOM')));
                $this->set('domaines',$domaines);
                $this->Action->Historyaction->recursive = -1;
                $histories = $this->Action->Historyaction->find('all',array('conditions'=>array('Historyaction.action_id'=>$id),'order'=>array('Historyaction.id'=>'desc')));
                $this->set('histories',$histories);
                $this->Action->Utilisateur->recursive = -1;
		$nomlong = $this->Action->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>  userAuth('id'))));
		$this->set('nomlong', $nomlong);                 
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
		//$this->request->onlyAllow('post', 'delete');
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
                $keyword=isset($this->params->data['Action']['SEARCH']) ? $this->params->data['Action']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Action.OBJET LIKE '%".$keyword."%'","Utilisateur.NOM LIKE '%".$keyword."%'","Utilisateur.PRENOM LIKE '%".$keyword."%'","Action.COMMENTAIRE LIKE '%".$keyword."%'","Activite.NOM LIKE '%".$keyword."%'","Domaine.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Action->recursive = 0;
                $this->set('actions', $this->paginate());
                $this->Action->Utilisateur->recursive = -1;
                $responsables = $this->Action->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.GESTIONABSENCES'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('responsables',$responsables);                   
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                 
        }     
        
        public function findActiviteForUtilisateur($utilisateur_id = null) {
            $this->Action->Activite->recursive = 0;
            $results = $this->Action->Activite->find('all',array('fields' => array('Activite.id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'conditions'=>array('Activite.projet_id>1')));
            return $results;
        }        

        public function findActiviteActive() {
            $this->Action->Activite->recursive = 0;
            $results = $this->Action->Activite->find('all',array('fields' => array('Activite.id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'conditions'=>array('Activite.projet_id>1','Activite.ACTIVE' => 1)));
            return $results;
        } 
        
        public function findLivrable($id=null) {
            $this->Action->Actionslivrable->recursive = -1;
            return $this->Action->Actionslivrable->find('all',array('conditions'=>array('Actionslivrable.action_id'=>$id)));
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
            $this->Action->Activitesreelle->recursive = -1;
            $allActivite = $this->Action->Activitesreelle->find('all',array('conditions'=>array('Activitesreelle.action_id'=>$id)));
            return count($allActivite);
        }
}
