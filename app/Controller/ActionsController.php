<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Actions Controller
 *
 * @property Action $Action
 */
class ActionsController extends AppController {

        public $paginate = array(
        'limit' => 25,
        'order' => array('Action.ECHEANCE' => 'asc','Action.PRIORITE'=>'asc'),
        );

	public $components = array('History','Common');
        
        public function beforeRender() {             
            parent::beforeRender();
        }
/**
 * index method
 *
 * @return void
 */
	public function index($filtrePriorite=null,$filtreEtat=null,$filtreResponsable=null) {
            //$this->Session->delete('history');
            if (isAuthorized('actions', 'index')) :
                switch ($filtrePriorite){
                    case 'tous':
                    case null:  
                    case '<': 
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
                    case 'news':    
                        $newconditions[]="Action.NEW=1";
                        $fetat = "nouvellement créées";
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
                        $newconditions[]="1=1";
                        $fresponsable = "de tous les agents";
                        break; 
                    case 'equipe':   
                        $monequipe = $this->requestAction('equipes/myTeam/'.userAuth('id')).userAuth('id');
                        $newconditions[]="Action.destinataire in (".$monequipe.") AND Utilisateur.GESTIONABSENCES=1";
                        $fresponsable = "de mon équipe";
                        break;                     
                    case null :
                        $newconditions[]="Action.destinataire='".userAuth('id')."'AND Utilisateur.GESTIONABSENCES=1";
                        $nomlong = $this->Action->Utilisateur->recursive = -1;
                        $nomlong = $this->Action->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array("Utilisateur.id"=>userAuth('id'))));
                        $fresponsable = "dont le responsable est ".isset($nomlong['Utilisateur']['NOMLONG']) ? $nomlong['Utilisateur']['NOMLONG'] : $nomlong['NOMLONG'] ;
                        $this->set('nomlong',isset($nomlong['Utilisateur']['NOMLONG']) ? $nomlong['Utilisateur']['NOMLONG'] : $nomlong['NOMLONG']);
                        break;                      
                    default :
                        $newconditions[]="Action.destinataire='".$filtreResponsable."'AND Utilisateur.GESTIONABSENCES=1";
                        $nomlong = $this->Action->Utilisateur->recursive = -1;
                        $nomlong = $this->Action->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array("Utilisateur.id"=>$filtreResponsable)));
                        $fresponsable = "dont le responsable est ".isset($nomlong['Utilisateur']['NOMLONG']) ? $nomlong['Utilisateur']['NOMLONG'] : $nomlong['NOMLONG'] ;
                        $this->set('nomlong',isset($nomlong['Utilisateur']['NOMLONG']) ? $nomlong['Utilisateur']['NOMLONG'] : $nomlong['NOMLONG']);
                        break;                      
                }  
                else:
                    $newconditions[]="Action.destinataire='".userAuth('id')."'";
                    $nomlong = $this->Action->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array("Utilisateur.id"=>userAuth('id'))));
                    $fresponsable = "dont le responsable est ".$nomlong['Utilisateur']['NOMLONG'];
                endif;
                $this->set('fresponsable',$fresponsable); 
                $listeprofilsautorises = $this->Action->Utilisateur->Profil->Autorisation->find('all',array('conditions'=>array('Autorisation.MODEL'=>'actions','OR'=>array('Autorisation.ADD'=>1,'Autorisation.EDIT'=>1,'Autorisation.DELETE'=>1))));
                $profilin = '';
                foreach($listeprofilsautorises as $liste):
                    $profilin .= $liste['Autorisation']['profil_id'].',';
                endforeach;                
                $responsables = $this->Action->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id IN ('.substr_replace($profilin ,"",-1).')'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('responsables',$responsables);                 
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
		$this->Action->recursive = 0;
                $listeactions = $this->Action->find('all',array('conditions'=>$newconditions,'recursive'=>0));
                $this->Session->delete('actions_index');
                $this->Session->write('actions_index',$listeactions);
                $export = $this->Action->find('all',array('conditions'=>$newconditions,'order' => array('Action.ECHEANCE' => 'asc'),'recursive'=>0));
                $this->Session->delete('xls_export');
                $this->Session->write('xls_export',$export);                 
                $this->set('actions', $this->paginate());
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
            if (isAuthorized('actions', 'view')) :
		if (!$this->Action->exists($id)) {
			throw new NotFoundException(__('Action incorrecte'));
		}
		$options = array('conditions' => array('Action.' . $this->Action->primaryKey => $id));
		$this->set('action', $this->Action->find('first', $options));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();            
            endif;                
	}

/**
 * savePeriodicite
 * 
 * @return void
 */        
        public function savePeriodicite($periode){
            $lastperiode = null;
            $repeatdays_periodicite[] = '';
            if ($periode!='Q'):
                if(empty($this->request->data['Action']['periodicite_id'])) :
                    $periodicite = array();
                else:
                    $this->Action->Periodicite->id = $this->request->data['Action']['periodicite_id'];
                    $periodicite = $this->Action->Periodicite->read();
                    $periodicite['Periodicite']['created']=$this->Action->Periodicite->read('created');
                endif;
                $end_periodicite = $periode == 'H' ? $this->request->data['Action']['REPETITIONHLAST'] : $this->request->data['Action']['REPETITIONMLAST'];
                $periodicite['Periodicite']['END']= CUSDate($end_periodicite);
                $alldays_periodicite =$periode == 'H' ? $this->request->data['Action']['REPETITIONHWEEK'] : $this->request->data['Action']['REPETITIONMMONTH'];
                $periodicite['Periodicite']['REPEATALL']=$alldays_periodicite;
                $repeatinmonth_periodicite =$periode == 'H' ? null : $this->request->data['Action']['REPETITIONMDAY'];
                $periodicite['Periodicite']['ALLDAYMONTH']=$repeatinmonth_periodicite;
                $repeatdays_periodicite = $periode == 'H' ? $this->request->data['Action']['REPETITIONHDAY'] : array();
                $repeatdays_periodicite = is_array($repeatdays_periodicite) ? $repeatdays_periodicite : array();
                $periodicite['Periodicite']['LU']=isset($repeatdays_periodicite) && in_array('1', $repeatdays_periodicite) ? 1 : 0;
                $periodicite['Periodicite']['MA']=isset($repeatdays_periodicite) && in_array('2', $repeatdays_periodicite) ? 1 : 0;
                $periodicite['Periodicite']['ME']=isset($repeatdays_periodicite) && in_array('3', $repeatdays_periodicite) ? 1 : 0;
                $periodicite['Periodicite']['JE']=isset($repeatdays_periodicite) && in_array('4', $repeatdays_periodicite) ? 1 : 0;
                $periodicite['Periodicite']['VE']=isset($repeatdays_periodicite) && in_array('5', $repeatdays_periodicite) ? 1 : 0;
                $periodicite['Periodicite']['SA']=isset($repeatdays_periodicite) && in_array('6', $repeatdays_periodicite) ? 1 : 0;
                $periodicite['Periodicite']['DI']=isset($repeatdays_periodicite) && in_array('7', $repeatdays_periodicite) ? 1 : 0;
                $periodicite['Periodicite']['PERIODE']=$periode;
                if(empty($this->request->data['Action']['periodicite_id'])) : $this->Action->Periodicite->create(); endif;
                $this->Action->Periodicite->save($periodicite);
                if(empty($this->request->data['Action']['periodicite_id'])) :
                    $lastperiode = $this->Action->Periodicite->getInsertID();
                else:
                    $lastperiode = $this->Action->Periodicite->id;
                endif;
            endif;
            return $lastperiode;
        }
        
/**
 * calculeDaysFromPeriodicite
 * 
 * @param periodicite_id
 * @return array of date (echeance and start)
 */        
        public function calculDaysFromPeriodicite($id,$start=null){
            $periodicite = $this->Action->Periodicite->find('first',array('conditions'=>array('Periodicite.id'=>$id),'recursive'=>-1));
            $start = !empty($periodicite['Periodicite']['ALLDAYMONTH']) ?  $periodicite['Periodicite']['ALLDAYMONTH'].date('/m/Y') :  $start!=null ? $start : date('d/m/Y');
            $start = new DateTime(CUSDate($start));            
            $days = array();
            if(!empty($periodicite)):
                if ($periodicite['Periodicite']['PERIODE']=='H'):
                    $days[] = $start->format('Y-m-d');
                    $sofar = 7*$periodicite['Periodicite']['REPEATALL'];
                    $interval = new DateInterval("P".$sofar."D"); 
                    $end = new DateTime(CUSDate($periodicite['Periodicite']['END']));
                    $period = new DatePeriod($start,$interval,$end);
                    $whichday = array();
                    if ($periodicite['Periodicite']['LU']) $whichday[]=1;
                    if ($periodicite['Periodicite']['MA']) $whichday[]=2;
                    if ($periodicite['Periodicite']['ME']) $whichday[]=3;
                    if ($periodicite['Periodicite']['JE']) $whichday[]=4;
                    if ($periodicite['Periodicite']['VE']) $whichday[]=5;
                    if ($periodicite['Periodicite']['SA']) $whichday[]=6;
                    if ($periodicite['Periodicite']['DI']) $whichday[]=7;
                    foreach($period as $dt){
                      for ($i=1; $i<8; $i++):
                        $dt->add(new DateInterval('P1D'));
                        if(in_array($dt->format("N"),$whichday)):
                          $days[] = $dt->format("Y-m-d");
                        endif;
                      endfor;
                    }                     
                else:
                    $interval = new DateInterval("P".$periodicite['Periodicite']['REPEATALL']."M"); 
                    $end = new DateTime(CUSDate($periodicite['Periodicite']['END']));
                    $period = new DatePeriod($start,$interval,$end);
                    foreach($period as $dt){
                      $days[] = $dt->format("Y-m-".$periodicite['Periodicite']['ALLDAYMONTH']);
                    }                    
                endif;
            endif;
            return $days;
        }
        
        public function createNewAction(){
            $this->request->data['Action']['periodicite_id'] = $this->savePeriodicite($this->request->data['Action']['REPETITION']);
            $days = $this->calculDaysFromPeriodicite($this->request->data['Action']['periodicite_id'],$this->request->data['Action']['ECHEANCE']);
            $record = $this->request->data;
            debug($days);
            foreach($days as $day):
                if($day != $this->request->data['Action']['ECHEANCE']):
                    $record['Action']['ECHEANCE'] = $day;
                    unset($record['Action']['id']);
                    $start = new DateTime($day);
                    $start->sub(new DateInterval('P5D'));
                    $record['Action']['STATUT'] = 'à faire';
                    $record['Action']['AVANCEMENT'] = 0;
                    $record['Action']['NEW'] = 1;
                    $record['Action']['DEBUT'] = $start->format("Y-m-d");
                    $record['Action']['FREQUENCE'] = $this->request->data['Action']['REPETITION'];
                    //debug($record);
                    //exit();
                    $this->Action->create();
                    if ($this->Action->save($record)) {
                            $this->saveHistory($this->Action->getInsertID()); 
                            $this->Session->setFlash(__('Action sauvegardée',true),'flash_success');
                            $this->sendmailactions($this->Action->find('first',array('conditions'=>array('Action.id'=>$this->Action->getInsertID()))));
                    } else {
                            $this->Session->setFlash(__('Action incorrecte, veuillez corriger l\'action',true),'flash_failure');
                    }
                endif;
            endforeach;            
        }
/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('actions', 'add')) :
		if ($this->request->is('post')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Action->validate = array();
                        $this->History->goBack(1);
                    else:                    
                        /** Avant la création de l'action on doit créer une périodicité **/
                        $this->request->data['Action']['periodicite_id'] = $this->savePeriodicite($this->request->data['Action']['REPETITION']);
                        if ($this->request->data['Action']['REPETITION']!='Q'):
                            $days = $this->calculDaysFromPeriodicite($this->request->data['Action']['periodicite_id'],$this->request->data['Action']['ECHEANCE']);
                        else :
                            $days[] = CUSDate($this->request->data['Action']['ECHEANCE']);
                        endif;
                        $record = $this->request->data;
                        $success = false;
                        foreach($days as $day):
                            $record['Action']['ECHEANCE'] = $day;
                            $start = new DateTime($day);
                            $start->sub(new DateInterval('P5D'));
                            $record['Action']['DEBUT'] = $start->format("Y-m-d");
                            $record['Action']['STATUT'] = $record['Action']['STATUT']=='' ? 'à faire': $record['Action']['STATUT'];
                            unset($record['Action']['FREQUENCE']);
                            $record['Action']['FREQUENCE'] = isset($this->request->data['Action']['REPETITION']) ? $this->request->data['Action']['REPETITION'] : $this->request->data['Action']['FREQUENCE'];
                            $this->Action->create();
                            if ($this->Action->save($record)) {
                                    $this->saveHistory($this->Action->getInsertID()); 
                                    $this->Session->setFlash(__('Action sauvegardée',true),'flash_success');
                                    $this->sendmailactions($this->Action->find('first',array('conditions'=>array('Action.id'=>$this->Action->getInsertID()))));
                                    $success = true;
                            } else {
                                    $this->Session->setFlash(__('Action incorrecte, veuillez corriger l\'action',true),'flash_failure');
                                    $success = false;
                            }
                        endforeach;
                        if($success) $this->History->goBack(1);
                    endif;
		}
                $etats = Configure::read('etatAction');
                $this->set('etats',$etats); 
                $priorites = Configure::read('prioriteAction');
                $this->set('priorites',$priorites); 
                $types = Configure::read('typeAction');
                $this->set('types',$types); 
                $nomlong = $this->Action->Utilisateur->recursive = -1;
                $listeprofilsautorises = $this->Action->Utilisateur->Profil->Autorisation->find('all',array('conditions'=>array('Autorisation.MODEL'=>'actions','OR'=>array('Autorisation.ADD'=>1,'Autorisation.EDIT'=>1,'Autorisation.DELETE'=>1))));
                $profilin = '';
                foreach($listeprofilsautorises as $liste):
                    $profilin .= $liste['Autorisation']['profil_id'].',';
                endforeach;
                $destinataires = $this->Action->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id IN ('.substr_replace($profilin ,"",-1).')'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
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
            if (isAuthorized('actions', 'edit')) :
                if (!$this->Action->exists($id)) {
			throw new NotFoundException(__('Action incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) { 
                    if (isset($this->params['data']['cancel'])) :
                        $this->Action->validate = array();
                        $this->History->goBack(1);
                    else:                    
                        $oldPeriode = $this->request->data['Action']['FREQUENCE'];
                        $newPeriode = $this->request->data['Action']['REPETITION'];
                        $this->request->data['Action']['NEW']=0;
                        /** Mise à jour du champs FREQUENCE des autres actions non terminée **/
                        if($oldPeriode!=$newPeriode):
                            if($this->request->data['Action']['periodicite_id']!=''):
                                $actions = $this->Action->find('all',array('conditions'=>array('Action.periodicite_id'=>$this->request->data['Action']['periodicite_id'],'Action.STATUT'=>'à faire'),'recursive=>0'));
                                foreach($actions as $action):
                                    $this->Action->delete($action['Action']['id'],false);
                                endforeach;
                            endif;
                            $this->createNewAction();
                        else:
                            /** Avant la création de l'action on doit mettre à jour ou créer la périodicité **/
                            $this->request->data['Action']['periodicite_id'] = $this->savePeriodicite($this->request->data['Action']['REPETITION']);  
                        endif;
                        $this->request->data['Action']['FREQUENCE'] = $this->request->data['Action']['REPETITION'];                        
			if ($this->Action->save($this->request->data)) {
                                $this->saveHistory($id);                                
				$this->Session->setFlash(__('Action sauvegardée',true),'flash_success');
                                //$this->sendmailactions($this->Action->find('first',array('conditions'=>array('Action.id'=>$id))));                                
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Action incorrecte, veuilelz corriger l\'action',true),'flash_failure');
			}
                    endif;
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
                $listeprofilsautorises = $this->Action->Utilisateur->Profil->Autorisation->find('all',array('conditions'=>array('Autorisation.MODEL'=>'actions','OR'=>array('Autorisation.ADD'=>1,'Autorisation.EDIT'=>1,'Autorisation.DELETE'=>1))));
                $profilin = '';
                foreach($listeprofilsautorises as $liste):
                    $profilin .= $liste['Autorisation']['profil_id'].',';
                endforeach;
                $destinataires = $this->Action->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id IN ('.substr_replace($profilin ,"",-1).')'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
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
                $periodicite = $this->Action->Periodicite->find('first',array('conditions'=>array('Periodicite.id'=>$this->request->data['Action']['periodicite_id']),'recursive'=>0));
                $this->set('periodicite',$periodicite);
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
	public function delete($id = null,$msg=true) {
            if (isAuthorized('actions', 'delete')) :
		$this->Action->id = $id;
		if (!$this->Action->exists()) {
			throw new NotFoundException(__('Action incorrecte'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Action->delete()) {
			if($msg) :
                            $this->Session->setFlash(__('Action supprimée',true),'flash_success');
                            $this->History->goBack(1);
                        endif;
		}
		if($msg) :
                    $this->Session->setFlash(__('Action <b>NON</b> supprimée',true),'flash_failure');
                    $this->History->goBack(1);
                endif;
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
            if (isAuthorized('actions', 'index')) :
                $keyword=isset($this->params->data['Action']['SEARCH']) ? $this->params->data['Action']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Action.OBJET LIKE '%".$keyword."%'","Utilisateur.NOM LIKE '%".$keyword."%'","Utilisateur.PRENOM LIKE '%".$keyword."%'","Action.COMMENTAIRE LIKE '%".$keyword."%'","Activite.NOM LIKE '%".$keyword."%'","Domaine.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Action->recursive = 0;
                $this->set('actions', $this->paginate());
                $this->Action->Utilisateur->recursive = -1;
                $responsables = $this->Action->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.profil_id > 0'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('responsables',$responsables);                   
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
            $this->Action->Actionslivrable->recursive = 0;
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
        
        public function getLastHistory($id){
            $history = $this->Action->Historyaction->find('first',array('conditions'=>array('Historyaction.action_id'=>$id),'order'=>array('Historyaction.id'=>'desc'),'recursive'=>-1));
            return $history;
        }
        
        public function deleteHistory($history){
            $this->Action->Historyaction->delete($history['Historyaction']['id']);             
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
            $history['Historyaction']['NIVEAU']=$thisAction['Action']['NIVEAU'];
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
        
/**
 * rapport
 */        
        public function rapport() {
            $this->set('title_for_layout','Rapport des actions');
            if (isAuthorized('actions', 'rapports')) :
                if ($this->request->is('post')):
                    foreach ($this->request->data['Action']['destinataire'] as &$value) {
                        @$destinatairelist .= $value.',';
                    }  
                    $destinataire = 'Action.destinataire IN ('.substr_replace($destinatairelist ,"",-1).')';
                    foreach ($this->request->data['Action']['domaine_id'] as &$value) {
                        @$projetlist .= $value.',';
                    }  
                    $domaine = 'Action.domaine_id IN ('.substr_replace($projetlist ,"",-1).')';
                    $periode = 'Action.ECHEANCE BETWEEN "'.  startWeek(CUSDate($this->request->data['Action']['START'])).'" AND "'.  endWeek(CUSDate($this->request->data['Action']['END'])).'"';
                    $rapportresult = $this->Action->find('all',array('fields'=>array('MONTH(Action.ECHEANCE) AS MONTH', 'YEAR(Action.ECHEANCE) AS YEAR','Utilisateur.NOM','Action.destinataire','Utilisateur.PRENOM','COUNT(Action.id) AS NB','Action.STATUT'),'conditions'=>array($destinataire,$domaine,$periode),'order'=>array('MONTH(Action.ECHEANCE)'=>'asc','YEAR(Action.ECHEANCE)'=>'asc'),'group'=>array('Action.destinataire','MONTH(Action.ECHEANCE)','YEAR(Action.ECHEANCE)','Action.STATUT'),'recursive'=>0));
                    $this->set('rapportresults',$rapportresult);
                    $chartresult = $this->Action->find('all',array('fields'=>array('MONTH(Action.ECHEANCE) AS MONTH', 'YEAR(Action.ECHEANCE) AS YEAR','Utilisateur.NOM','Action.destinataire','Utilisateur.PRENOM','COUNT(Action.id) AS NB','Action.STATUT'),'conditions'=>array($destinataire,$domaine,$periode,'Action.CRA'=>1),'order'=>array('MONTH(Action.ECHEANCE)'=>'asc','YEAR(Action.ECHEANCE)'=>'asc'),'group'=>array('MONTH(Action.ECHEANCE)','YEAR(Action.ECHEANCE)'),'recursive'=>0));
                    $this->set('chartresults',$chartresult);                    
                    $detailrapportresult = $this->Action->find('all',array('fields'=>array('MONTH(Action.ECHEANCE) AS MONTH', 'YEAR(Action.ECHEANCE) AS YEAR','Action.destinataire','Action.NIVEAU','Action.STATUT','Action.OBJET','Domaine.NOM'),'conditions'=>array($destinataire,$domaine,$periode,'Action.CRA'=>1),'order'=>array('MONTH(Action.ECHEANCE)'=>'asc','YEAR(Action.ECHEANCE)'=>'asc'),'recursive'=>0));
                    $this->set('detailrapportresults',$detailrapportresult);
                    $this->Session->delete('rapportresults');  
                    $this->Session->delete('detailrapportresults');                      
                    $this->Session->write('rapportresults',$rapportresult);
                    $this->Session->write('detailrapportresults',$detailrapportresult);
                    if ($this->request->data['Action']['RepartitionUtilisateur']==1):
                        $repartitions = $this->Action->find('all',array('fields'=>array('MONTH(Action.ECHEANCE) AS MONTH', 'YEAR(Action.ECHEANCE) AS YEAR','Action.destinataire','Utilisateur.NOM','Utilisateur.PRENOM','Domaine.NOM', 'COUNT(Action.id) AS NB','Action.STATUT'),'conditions'=>array($destinataire,$domaine,$periode),'order'=>array('MONTH(Action.ECHEANCE)'=>'asc','YEAR(Action.ECHEANCE)'=>'asc','Action.destinataire'=>'asc'),'group'=>array('Action.destinataire','MONTH(Action.ECHEANCE)','YEAR(Action.ECHEANCE)','Action.STATUT','Action.domaine_id'),'recursive'=>0));
                        $this->set('repartitions',$repartitions);
                        $this->Session->delete('repartitionresults');
                        $this->Session->write('repartitionresults',$repartitions);
                    endif;    
                    if ($this->request->data['Action']['Rapportdetail']==1):
                        $details = $this->Action->find('all',array('fields'=>array('MONTH(Action.ECHEANCE) AS MONTH', 'YEAR(Action.ECHEANCE) AS YEAR','Utilisateur.NOM','Utilisateur.PRENOM','Domaine.NOM','Action.NIVEAU','Action.destinataire','Action.OBJET','Action.COMMENTAIRE','Action.STATUT'),'conditions'=>array($destinataire,$domaine,$periode),'order'=>array('MONTH(Action.ECHEANCE)'=>'asc','YEAR(Action.ECHEANCE)'=>'asc','Action.destinataire'=>'asc'),'recursive'=>0));
                        $this->set('details',$details);
                        $this->Session->delete('details');
                        $this->Session->write('details',$details);
                    endif;                      
                endif;
                $profils = $this->Action->Utilisateur->Profil->Autorisation->find('all',array('fields'=>array('Autorisation.profil_id'),'conditions'=>array('Autorisation.MODEL'=>'actions','Autorisation.RAPPORTS'=>1),'recursive'=>0));
                $profilin = '';
                foreach($profils as $profil):
                    $profilin .= $profil['Autorisation']['profil_id'].',';
                endforeach;
                $destinataires = $this->Action->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id IN ('.substr_replace($profilin ,"",-1).')'),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
                $this->set('destinataires',$destinataires);  
                $domaines = $this->Action->Domaine->find('list',array('fields'=>array('id','NOM'),'order'=>array('Domaine.NOM'),'recursive'=>-1));
                $this->set('domaines',$domaines);                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif; 
	}     
           
        public function last7days() {
            $this->set('title_for_layout','Rapport des actions modifiées sur les 7 derniers jours');
            if (isAuthorized('actions', 'rapports')) :
                if ($this->request->is('post')):
                    foreach ($this->request->data['Action']['destinataire'] as &$value) {
                        @$destinatairelist .= $value.',';
                    }  
                    $destinataire = 'Action.destinataire IN ('.substr_replace($destinatairelist ,"",-1).')';
                    foreach ($this->request->data['Action']['domaine_id'] as &$value) {
                        @$projetlist .= $value.',';
                    }  
                    $domaine = 'Action.domaine_id IN ('.substr_replace($projetlist ,"",-1).')';
                    $today = new DateTime();
                    $daylastweek = $today->sub(new DateInterval('P7D'));
                    $periode = 'Action.modified BETWEEN "'.  startWeek($daylastweek->format('Y-m-d')).'" AND "'.  endWeek($daylastweek->format('Y-m-d')).'"';
                    $details = $this->Action->find('all',array('fields'=>array('Utilisateur.NOM','Utilisateur.PRENOM','Domaine.NOM','Action.destinataire','Action.NIVEAU','Action.OBJET','Action.COMMENTAIRE','Action.STATUT','Action.modified'),'conditions'=>array($destinataire,$domaine,$periode),'order'=>array('Action.modified'=>'asc','Action.destinataire'=>'asc'),'recursive'=>0));
                    $this->set('details',$details);
                    $this->Session->delete('details');
                    $this->Session->write('details',$details);                
                endif;
                $destinataires = $this->Action->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.profil_id > 0'),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
                $this->set('destinataires',$destinataires);  
                $domaines = $this->Action->Domaine->find('list',array('fields'=>array('id','NOM'),'order'=>array('Domaine.NOM'),'recursive'=>-1));
                $this->set('domaines',$domaines);                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;             
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
            if (isAuthorized('actions', 'duplicate')) :
		$this->Action->id = $id;
                $record = $this->Action->read();
                unset($record['Action']['id']);
                $record['Action']['AVANCEMENT']=0;
                $record['Action']['destinataire']=  userAuth('id');
                $record['Action']['DEBUT']=date('d/m/Y');
                $record['Action']['STATUT']='à faire';
                $record['Action']['NEW']=1;
                unset($record['Action']['COMMENTAIRE']);
                unset($record['Action']['created']);                
                unset($record['Action']['modified']);
                unset($record['Historyaction']);
                unset($record['Actionslivrable']);
                $this->Action->create();
                if ($this->Action->save($record)) {
                        $this->Session->setFlash(__('Action dupliquée',true),'flash_success');
                        $this->History->goBack(1);
                } 
		$this->Session->setFlash(__('Action <b>NON</b> dupliquée',true),'flash_failure');
		$this->History->goBack(1);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	} 
        
	function export_doc() {
            if($this->Session->check('rapportresults') && $this->Session->check('detailrapportresults')):
                $data = $this->Session->read('rapportresults');
                $this->set('rowsrapport',$data);
                $data = $this->Session->read('detailrapportresults'); 
                $this->set('rowsdetail',$data);              
		$this->render('export_doc','export_doc');
            else:
                $this->Session->setFlash(__('Rapport impossible à éditer veuillez renouveler le calcul du rapport',true),'flash_failure');             
                $this->redirect(array('action'=>'rapport'));
            endif;
        }       

/**
 * progressstatut method
 * 
 * @param type $id
 */
        public function progressstatut(){
                $newetat = '';
                $id = $this->request->data('id');
                $this->Action->id = $id;
                $record = $this->Action->read();
                switch (strtolower($record['Action']['STATUT'])) {
                    case 'à faire':
                       $newetat = 'en cours';
                       $avancement = '10';
                       break;
                    case 'en cours':
                       $newetat = 'terminée';
                       $echeance = date('Y-m-d');
                       $avancement = '100';
                       break;                
                    case 'terminée':
                       $newetat = 'livré';
                       $avancement = '100';
                       $record['Action']['ECHEANCE'] =  date('Y-m-d');
                       break;          
                    case 'livré':
                       $newetat = 'annulée';
                       $avancement = '0';
                       $record['Action']['ECHEANCE'] = date('Y-m-d');
                       break;
                    case 'annulée':
                       $newetat = 'à faire';
                       $avancement = '0';
                       break;                
                }
                $record['Action']['STATUT'] = $newetat;
                $record['Action']['AVANCEMENT'] = $avancement;
                $record['Action']['created'] = $this->Action->read('created');
                $record['Action']['modified'] = date('Y-m-d');
                $record['Action']['NEW'] = 0;
                $this->Action->save($record);
                $this->saveHistory($id); 
                exit();
        }        
        
        public function progressavancement(){
            $id = $this->request->data('id');
            $avancement = $this->request->data('avancement');
            $this->Action->id = $id;
            $record = $this->Action->read();
            $record['Action']['STATUT'] = $avancement==100 ? 'terminée' : $avancement==0 ? 'à faire' : $avancement==10 ? 'en cours' : $record['Action']['STATUT'];
            $record['Action']['AVANCEMENT'] = $avancement;
            $record['Action']['NEW'] = 0;
            $record['Action']['ECHEANCE'] = $avancement==100 ? date('Y-m-d') : $record['Action']['ECHEANCE'];
            $record['Action']['created'] = $this->Action->read('created');
            $record['Action']['modified'] = date('Y-m-d');
            $history = $this->getLastHistory($id);
            if ($avancement > $history['Historyaction']['AVANCEMENT'] && $avancement > 0):
                $this->deleteHistory($history);
            endif;
            $this->saveHistory($id); 
            $this->Action->save($record);
            exit();
        }
        
        public function progressduree(){
            $id = $this->request->data('id');
            $duree = $this->request->data('duree');
            $this->Action->id = $id;
            $history = $this->getLastHistory($id);
            if ($duree > $history['Historyaction']['CHARGEPREVUE']):
                $this->deleteHistory($history);
            endif;
            $this->saveHistory($id); 
            $this->Action->saveField('DUREEPREVUE',$duree);
            $this->Action->saveField('NEW',0);
            exit();
        }        
        
        public function incra(){
            if($this->request->data('id')!==''):
                $id = $this->request->data('id');
                $this->Action->id = $id;
                $cra = $this->Action->find('first',array('fields'=>array('CRA'),'conditions'=>array('Action.id'=>$id),'recursive'=>-1));
                if($this->Action->saveField('CRA', !$cra['Action']['CRA'])):     
                    $this->Session->setFlash(__('Information du CRA sauvegardée',true),'flash_success');
                else :
                    $this->Session->setFlash(__('Information du CRA <b>NON</b> sauvegardée',true),'flash_failure');
                endif;
            else :
                $this->Session->setFlash(__('Aucune action sélectionnée',true),'flash_failure');
            endif;
            exit();
        }
        
        
        public function homeListeActions(){
            $listactions = $this->Action->find('all',array('conditions'=>array('destinataire'=>userAuth('id'),'STATUT NOT IN("terminée","livré","annulée")'),'order'=>array('ECHEANCE'=>'ASC'),'limit' => 5,'recursive'=>-1));
            return $listactions;
        }   
        
        public function homeNBAFAIREActions(){
            $nbactions = $this->Action->find('all',array('fields'=>array('COUNT(id) AS NB','STATUT'),'conditions'=>array('destinataire'=>userAuth('id'),'STATUT'=>"à faire"),'group'=>'STATUT','recursive'=>-1));
            return $nbactions;
        }    
        
        public function homeNBENCOURSActions(){
            $nbactions = $this->Action->find('all',array('fields'=>array('COUNT(id) AS NB','STATUT'),'conditions'=>array('destinataire'=>userAuth('id'),'STATUT'=>"en cours"),'group'=>'STATUT','recursive'=>-1));
            return $nbactions;
        }            
        
        public function homeNBRETARDActions(){
            $nbactions = $this->Action->find('all',array('fields'=>array('COUNT(id) AS NB','STATUT','ECHEANCE'),'conditions'=>array('destinataire'=>userAuth('id'),'STATUT NOT IN("terminée","livré","annulée")',"ECHEANCE <"=>date('Y-m-d')),'group'=>'STATUT','recursive'=>-1));
            return $nbactions;
        }     
        
        public function sendmailactions($action){
            $valideurs = $this->Action->Utilisateur->find('all',array('conditions'=>array('Utilisateur.id'=>$action['Action']['destinataire'])));
            $mailto = array();
            foreach($valideurs as $valideur):
                $mailto[]=$valideur['Utilisateur']['MAIL'];
            endforeach;
            $to=$mailto;
            $from = userAuth('MAIL');
            $objet = 'SAILL : Demande d\'action ['.$action['Action']['OBJET'].']';
            $message = "Merci de traiter l'action ".$action['Action']['OBJET'].
                    '<ul>
                    <li>Echéance :'.$action['Action']['ECHEANCE'].'</li>
                    <li>Priorité :'.$action['Action']['PRIORITE'].'</li>
                    <li>Résumé :'.$action['Action']['RESUME'].'</li> 
                    <li>Commentaire :'.$action['Action']['COMMENTAIRE'].'</li>                      
                    </ul>';
            if($to!=''):
                try{
                $email = new CakeEmail();
                $email->config('smtp')
                        ->emailFormat('html')
                        ->from($from)
                        ->to($to)
                        ->subject($objet)
                        ->send($message);
                }
                catch(Exception $e){
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_failure');
                }  
            endif;
        } 
        
        public function notifier($id){
            $action = $this->Action->find('first',array('conditions'=>array('Action.id'=>$id),'recursive'=>0));
            $valideurs = $this->Action->Utilisateur->find('all',array('conditions'=>array('Utilisateur.id'=>$action['Action']['destinataire'])));
            $mailto = array();
            foreach($valideurs as $valideur):
                $mailto[]=$valideur['Utilisateur']['MAIL'];
            endforeach;
            $to=$mailto;
            $from = userAuth('MAIL');
            $objet = 'SAILL : Demande d\'action ['.$action['Action']['OBJET'].']';
            $message = "Merci de traiter l'action ".$action['Action']['OBJET'].
                    '<ul>
                    <li>Echéance :'.$action['Action']['ECHEANCE'].'</li>
                    <li>Priorité :'.$action['Action']['PRIORITE'].'</li>
                    <li>Résumé :'.$action['Action']['RESUME'].'</li> 
                    <li>Commentaire :'.$action['Action']['COMMENTAIRE'].'</li>                      
                    </ul>';
            if($to!=''):
                try{
                $email = new CakeEmail();
                $email->config('smtp')
                        ->emailFormat('html')
                        ->from($from)
                        ->to($to)
                        ->subject($objet)
                        ->send($message);
                $this->Session->setFlash(__('Mail envoyé à '.$action['Utilisateur']['NOMLONG'],true),'flash_success');
                }
                catch(Exception $e){
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_failure');
                }  
            endif;
            $this->History->notmove();
        }         
        
        public function timelineData(){
            $datas = $this->Session->read('actions_index');
            $eventAtts = array();
            foreach($datas as $data):
                $destinataire = $this->Action->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$data['Action']['destinataire']),'recursive'=>-1));
                $date =  CDateTimeline($data['Action']['DEBUT']);
                $resume = $data['Action']['RESUME'];
                $phpmakedate = $date;
                $description = '['.$destinataire['Utilisateur']['NOMLONG'].'] - '.$data['Action']['OBJET'];
                if($data['Action']['DUREEPREVUE'] > 0){
                    $phpenddate = CDateTimeline($data['Action']['ECHEANCE']);
                    $durationEvent = false;
                } else {
                    $phpmakeenddate = CDateTimeline($data['Action']['ECHEANCE']);
                    $phpenddate = $phpmakeenddate;
                    $durationEvent = true;
                }
                $eventAtts[] = array (
                    'start' => $phpmakedate,
                    'end' => $phpenddate,
                    'durationEvent' => $durationEvent,
                    'title' => $description,
                    'id'=>$data['Action']['destinataire'],
                    'description'=>"Résumé :<br>".$resume."<hr>Echéance le : ".$data['Action']['ECHEANCE']."<br>Charge : ".($data['Action']['DUREEPREVUE']/8)." jour(s)<br>Etat : ".$data['Action']['STATUT']."<br>Avancement : ".$data['Action']['AVANCEMENT']." %"
                );
            endforeach;
            
            return $eventAtts;
        }
        
        public function deleteThisPeriodicite($action_id,$loop=false){
            $this->Action->id = $action_id;
            $this->Action->saveField('periodicite_id',null);
            $this->Action->saveField('FREQUENCE','Q');
            $this->Session->setFlash(__('Périodicité supprimé pour cette action',true),'flash_success');
            if(!$loop) $this->History->goBack(1);
            
        }
        
        public function deleteAllPeriodicite($action_id){
            $periodicity_id = $this->Action->find('first',array('fields'=>array('Action.periodicite_id'),'conditions'=>array('Action.id'=>$action_id),'recursive'=>-1));
            $allids = $this->Action->find('all',array('fields'=>array('Action.id'),'conditions'=>array('Action.periodicite_id'=>$periodicity_id['Action']['periodicite_id']),'recursive'=>-1));
            foreach($allids as $id):
                $this->deleteThisPeriodicite($id['Action']['id'],true);
            endforeach;
            $this->Session->setFlash(__('Périodicité supprimée pour toutes les autres actions',true),'flash_success');
            $this->History->goBack(1);
        }     
               
        public function deleteall(){
            if($this->request->data('id')!==''):
                $id = $this->request->data('id');
                $this->Action->id = $id;
                if($this->Action->delete()):
                    echo $this->Session->setFlash(__('Actions supprimées',true),'flash_success'); 
                else :
                    $this->Session->setFlash(__('Actions <b>NON</b> supprimées',true),'flash_failure');
                endif;
            else :
                $this->Session->setFlash(__('Aucune action sélectionnée',true),'flash_failure');
            endif;
        }
        
        public function closeall(){
            if($this->request->data('id')!==''):
                $id = $this->request->data('id');
                $this->Action->id = $id;
                $cra = $this->Action->find('first',array('fields'=>array('CRA'),'conditions'=>array('Action.id'=>$id),'recursive'=>-1));
                $this->Action->saveField('AVANCEMENT', '100');
                $this->Action->saveField('STATUT', 'terminée');
                if($this->Action->saveField('NEW', '0')):
                    $this->saveHistory($id);  
                    echo $this->Session->setFlash(__('Actions cloturées',true),'flash_success'); 
                else :
                    $this->Session->setFlash(__('Actions <b>NON</b> clotûrées correctement',true),'flash_failure');
                endif;
            else :
                $this->Session->setFlash(__('Aucune action sélectionnée',true),'flash_failure');
            endif;
            exit();           
        }
        
        public function risques(){
            $this->set('title_for_layout','Etudes des risques par domaine');
            if (isAuthorized('actions', 'rapports')) :
                if ($this->request->is('post')):
                    $domaine = $this->data['Action']['domaine_id'];
                    $rapportresult = $this->Action->find('all',array('fields'=>array('Action.domaine_id', 'COUNT(Action.id) AS NB','Action.NIVEAU'),'conditions'=>array('Action.domaine_id'=>$domaine,'Action.STATUT NOT IN ("terminée","livrée")','Action.NIVEAU >'=>0),'order'=>array('Action.NIVEAU'=>'asc'),'group'=>array('Action.NIVEAU'),'recursive'=>0));
                    $this->set('rapportresults',$rapportresult);
                    $chartresult = $this->Action->find('all',array('fields'=>array('Action.domaine_id', 'COUNT(Action.id) AS NB','Action.NIVEAU'),'conditions'=>array('Action.domaine_id'=>$domaine,'Action.STATUT NOT IN ("terminée","livrée")','Action.NIVEAU >'=>0),'group'=>array('Action.NIVEAU'),'recursive'=>0));
                    $this->set('chartresults',$chartresult);                                      
                endif; 
                $domaines = $this->Action->Domaine->find('list',array('fields'=>array('id','NOM'),'order'=>array('Domaine.NOM'),'recursive'=>-1));
                $this->set('domaines',$domaines);                
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
                //$this->Session->delete('xls_export');                
		$this->set('rows',$data);
		$this->render('export_xls','export_xls');
	}          
}
