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
        
    public function get_visibility(){
        //si l'utilisateur est administrateur il voit tout
        //dans les autres cas la visibilité est limitée aux utilisateur de ses cercles
        //qu'ils soient actif ou pas même les génériques
        if(userAuth('profil_id')==1):
            return null;
        else:
            return $this->requestAction('assoentiteutilisateurs/json_get_all_users/'. userAuth('id'));  
        endif;
    }
    
    public function get_action_priority_filter($id){
        $result = array();
        switch ($id){
            case 'tous':
            case null:  
                $result['condition']="1=1";
                $result['filter'] = "toutes les priorités";
                break;                  
            case '1':
                $result['condition']="Action.PRIORITE='normale'";
                $result['filter'] = "la priorité normale";
                break;                      
            case '2':
                $result['condition']="Action.PRIORITE='moyenne'";
                $result['filter'] = "la priorité moyenne";
                break;   
            case '3':
                $result['condition']="Action.PRIORITE='haute'";
                $result['filter'] = "la priorité haute";
                break;   
        }  
        return $result;
    }
    
    public function get_action_etat_filter($id){
        $result = array();
        switch ($id){
            case 'tous':    
                $result['condition']="1=1";
                $result['filter'] = "tous les états";
                break;                 
            case 'news':    
                $result['condition']="Action.NEW=1 AND Action.AVANCEMENT < 10 AND Action.STATUT <> 'terminée'";
                $result['filter'] = "nouvellement créées";
                break; 
            case '1':
                $result['condition']="Action.STATUT='à faire'";
                $result['filter'] = "l'état à faire";
                break;                      
            case '2':
                $result['condition']="Action.STATUT='en cours'";
                $result['filter'] = "l'état en cours";
                break;    
            case '3':
                $result['condition']="Action.STATUT='terminée'";
                $result['filter'] = "l'état terminée";
                break;    
            case '4':
                $result['condition']="Action.STATUT='livrée'";
                $result['filter'] = "l'état livrée";
                break;    
            case '5':
                $result['condition']="Action.STATUT='annulée'";
                $result['filter'] = "l'état annulée";
                break;                        
            case '6':
            case null :
                $result['condition']="(Action.STATUT ='à faire' OR Action.STATUT ='en cours')";
                $result['filter'] = "l'état à faire ou en cours";
                break;
            }  
            return $result;
    }
    
    public function get_action_emetteur_filter($id,$visibility){
        $result = array();
        $nomlong = $this->Action->Utilisateur->find('first',array('conditions'=>array("Utilisateur.id"=>$id),'recursive'=>-1));        
        $result['nomlonge'] = isset($nomlong['Utilisateur']['NOMLONG']) ? $nomlong['Utilisateur']['NOMLONG'] : "";
        switch ($id){                   
            case null :
            case 'tous':
                if($visibility == null):
                    $result['condition']='1=1';
                elseif ($visibility!=''):
                    $result['condition']="Action.utilisateur_id IN (".$visibility.")";
                else:
                    $result['condition']="Action.utilisateur_id =".userAuth('id');
                endif;                
                $result['filter'] = "tous les émetteurs " ;  
                break;
            default :
                $result['condition']="Action.utilisateur_id=".$id;
                $result['filter'] = "dont l'émetteur est ".isset($nomlong['Utilisateur']['NOMLONG']) ? $nomlong['Utilisateur']['NOMLONG'] : $nomlong['NOMLONG'] ;
                break;                      
        }     
        return $result;
    }
    
    public function get_action_responsable_filter($id,$visibility){
        $result = array();
        $nomlong = $this->Action->Utilisateur->recursive = 0;
        $nomlong = $this->Action->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array("Utilisateur.id"=>$id)));        
        $result['nomlong'] = isset($nomlong['Utilisateur']['NOMLONG']) ? $nomlong['Utilisateur']['NOMLONG'] : $nomlong['NOMLONG'];
        if (areaIsVisible() || $id==userAuth('id')):
        switch ($id){
            case 'tous':   
                //TODO : pose un problème pour le CONTRIBUTEURS
                //FIXME : Il faut probablement revoir la façon de sauvegarder les contributeurs
                if($visibility == null):
                    $result['condition']='1=1';
                elseif ($visibility!=''):
                    $result['condition']="Action.destinataire IN (".$visibility.")";
                else:
                    $result['condition']="Action.destinataire =".userAuth('id');
                endif;                          
                $result['filter'] = "de tous les agents";
                break; 
            case 'equipe':   
                //TODO : pose un problème pour le CONTRIBUTEURS
                $monequipe = $this->requestAction('equipes/myTeam/'.userAuth('id')).userAuth('id');
                $result['condition']="(Action.destinataire in (".$monequipe.") OR (CONTRIBUTEURS LIKE '%".userAuth('id').",%' OR CONTRIBUTEURS LIKE '%,".userAuth('id')."%' OR CONTRIBUTEURS = '".userAuth('id')."'))";
                $result['filter'] = "de mon équipe";
                break;                     
            case null :
                //TODO : pose un problème pour le CONTRIBUTEURS
                $result['condition']="(Action.destinataire='".userAuth('id')."' OR (CONTRIBUTEURS LIKE '%".userAuth('id').",%' OR CONTRIBUTEURS LIKE '%,".userAuth('id')."%' OR CONTRIBUTEURS = '".userAuth('id')."'))";
                $result['filter'] = "dont le responsable est ".isset($nomlong['Utilisateur']['NOMLONG']) ? $nomlong['Utilisateur']['NOMLONG'] : $nomlong['NOMLONG'] ;
                break;                      
            default :
                //TODO : pose un problème pour le CONTRIBUTEURS
                $result['condition']="(Action.destinataire='".$id."' OR (`CONTRIBUTEURS` LIKE '%".$id.",%' OR `CONTRIBUTEURS` LIKE '%,".$id."%' OR `CONTRIBUTEURS` = '".$id."'))";
                $result['filter'] = "dont le responsable est ".isset($nomlong['Utilisateur']['NOMLONG']) ? $nomlong['Utilisateur']['NOMLONG'] : $nomlong['NOMLONG'] ;
                break;                      
        }  
        else:
            //TODO : pose un problème pour le CONTRIBUTEURS
            $result['condition']="Action.destinataire='".userAuth('id')."' OR (`CONTRIBUTEURS` LIKE '%".userAuth('id').",%' OR `CONTRIBUTEURS` LIKE '%,".userAuth('id')."%' OR `CONTRIBUTEURS` = '".userAuth('id')."'))";
            $nomlong = $this->Action->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array("Utilisateur.id"=>userAuth('id'))));
            $result['filter'] = "dont le responsable est ".$nomlong['Utilisateur']['NOMLONG'];
        endif;  
        return $result;
    }
    
    public function get_action_utilisateur_id($id){
        return $this->Action->find('first',array('conditions'=>array('Action.id'=>$id),'fields'=>array('utilisateur_id')));
    }
    
    public function get_action_periodicity($id){
        return $this->Action->Periodicite->find('first',array('conditions'=>array('Periodicite.id'=>$id),'recursive'=>0));
    }
    
    public function get_action_history($id){
        return $this->Action->Historyaction->find('all',array('conditions'=>array('Historyaction.action_id'=>$id),'order'=>array('Historyaction.id'=>'desc'),'recursive'=>-1));        
    }
    
    public function get_list_profil_autorised(){
        $profilin = "";
        $listeprofilsautorises = $this->Action->Utilisateur->Profil->Autorisation->find('all',array('conditions'=>array('Autorisation.MODEL'=>'actions','OR'=>array('Autorisation.ADD'=>1,'Autorisation.EDIT'=>1,'Autorisation.DELETE'=>1))));
        $profilin = '';
        foreach($listeprofilsautorises as $liste):
            $profilin .= $liste['Autorisation']['profil_id'].',';
        endforeach;  
        return substr_replace($profilin ,"",-1);
    }
    
    public function get_all_responsables($profil,$visibility){
        $result = null;
        if($profil!= '' && $visibility!=''):
            $result = $this->Action->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id IN ('.$profil.')','Utilisateur.id IN ('.$visibility.')'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        elseif($profil!= ''):
            $result = $this->Action->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id IN ('.$profil.')'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        else:
            $result = $this->Action->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id >1'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        endif;
        return $result;
    }
    
    public function get_list_responsables($profil,$visibility){
        $result = null;
        if($profil!= '' && $visibility!=''):
            $result = $this->Action->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id IN ('.$profil.')','Utilisateur.id IN ('.$visibility.')'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        elseif($profil!= ''):
            $result = $this->Action->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id IN ('.$profil.')'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        else:
            $result = $this->Action->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id >1'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        endif;
        return $result;
    }    
    
    public function get_export($conditions){
        $export = $this->Action->find('all',array('conditions'=>$conditions,'order' => array('Action.ECHEANCE' => 'asc'),'recursive'=>0));
        $this->Session->delete('xls_export');
        $this->Session->write('xls_export',$export);    
    }   
    
    public function get_chronoline_action($conditions){
        $listeactions = $this->Action->find('all',array('conditions'=>$conditions,'recursive'=>0));
        $this->Session->delete('actions_index');
        $this->Session->write('actions_index',$listeactions);        
    }
/**
 * index method
 *
 * @return void
 */
	public function index($filtrePriorite=null,$filtreEtat=null,$filtreResponsable=null,$filtreEmetteur=null) {
            if (isAuthorized('actions', 'index')) :
                $listuser = $this->get_visibility();
                $getpriority = $this->get_action_priority_filter($filtrePriorite);
                $getetat = $this->get_action_etat_filter($filtreEtat);
                $getemetteur = $this->get_action_emetteur_filter($filtreEmetteur, $listuser);
                $getdestinataire = $this->get_action_responsable_filter($filtreResponsable, $listuser);
                $newconditions=array($getpriority['condition'],$getetat['condition'],$getemetteur['condition'],$getdestinataire['condition']);
                $this->set('fpriorite',$getpriority['filter']); 
                $this->set('fetat',$getetat['filter']);               
                $this->set('femetteur',$getemetteur['filter']);    
                $this->set('nomlonge',$getemetteur['nomlonge']); 
                $this->set('nomlong',$getdestinataire['nomlong']); 
                $this->set('fresponsable',$getdestinataire['filter']);
                $profils_autorised = $this->get_list_profil_autorised();
                $responsables = $this->get_all_responsables($profils_autorised, $listuser);
                $this->set('responsables',$responsables);                 
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));
                $this->set('actions', $this->paginate());
                $this->get_export($newconditions);
                $this->get_chronoline_action($newconditions);
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
                    if ($periodicite['Periodicite']['LU']) { $whichday[]=1; }
                    if ($periodicite['Periodicite']['MA']) { $whichday[]=2; }
                    if ($periodicite['Periodicite']['ME']) { $whichday[]=3; }
                    if ($periodicite['Periodicite']['JE']) { $whichday[]=4; }
                    if ($periodicite['Periodicite']['VE']) { $whichday[]=5; }
                    if ($periodicite['Periodicite']['SA']) { $whichday[]=6; }
                    if ($periodicite['Periodicite']['DI']) { $whichday[]=7; }
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
                            $days = $this->calculDaysFromPeriodicite($this->request->data['Action']['periodicite_id']);    //,$this->request->data['Action']['ECHEANCE']
                        else :
                            $days[] = CUSDate($this->request->data['Action']['ECHEANCE']);
                        endif;
                        $record = $this->request->data;
                        $success = false;
                        $i = 0;
                        foreach($days as $day):
                            $record['Action']['ECHEANCE'] = $day;
                            $start = new DateTime($day);
                            $start->sub(new DateInterval('P5D'));
                            $record['Action']['DEBUT'] = $i==0 ? $this->request->data['Action']['DEBUT']!='' ? $this->request->data['Action']['DEBUT'] : $start->format("Y-m-d")  : $start->format("Y-m-d");
                            $i = 1;
                            $record['Action']['STATUT'] = $record['Action']['STATUT']=='' ? 'à faire': $record['Action']['STATUT'];
                            unset($record['Action']['FREQUENCE']);
                            $record['Action']['FREQUENCE'] = isset($this->request->data['Action']['REPETITION']) ? $this->request->data['Action']['REPETITION'] : $this->request->data['Action']['FREQUENCE'];
                            $this->Action->create();
                            if ($this->Action->save($record)) {
                                    //FIXME : Il faut probablement revoir la façon de sauvegarder les contributeurs
                                    //FIXME : faut-il enregistrer à deux endroits 'RISQUE'
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
                $listuser = $this->get_visibility();  
                $etats = Configure::read('etatAction'); 
                $priorites = Configure::read('prioriteAction');
                $types = Configure::read('typeAction');
                $profil = $this->get_list_profil_autorised();
                $activitesagent = $this->findActiviteForUtilisateur(userAuth('id'));
                $destinataires = $this->get_list_responsables($profil, $listuser);
                $domaines = $this->requestAction('domaines/get_list');
                $nomlong = $this->requestAction('utilisateurs/get_nomlong',array('pass'=>array(userAuth('id'))));
                $all_utilisateurs = $this->requestAction(('utilisateurs/get_list_actif'));
                $list_sections = $this->Action->requestAction('sections/getList');
                $contributeurs = array();
                $this->set(compact('types','etats','priorites','activitesagent','destinataires','domaines','nomlong','all_utilisateurs','list_sections','contributeurs')); 
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
                        $contributeurs = explode(",",$this->request->data['Action']['CONTRIBUTEURS']);
                        $contributeurs_nom = $this->requestAction('utilisateurs/get_nom',array('pass'=>array($this->request->data['Action']['CONTRIBUTEURS'])));
                        $this->set(compact('contributeurs','contributeurs_nom'));                        
		}
                $listuser = $this->get_visibility();  
                $etats = Configure::read('etatAction'); 
                $priorites = Configure::read('prioriteAction');
                $types = Configure::read('typeAction');
                $profil = $this->get_list_profil_autorised();
                $activitesagent = $this->findActiviteForUtilisateur(userAuth('id'));
                $destinataires = $this->get_list_responsables($profil, $listuser);
                $domaines = $this->requestAction('domaines/get_list');
                $nomlong = $this->requestAction('utilisateurs/get_nomlong',array('pass'=>array(userAuth('id'))));
                $all_utilisateurs = $this->requestAction(('utilisateurs/get_list_actif'));
                $list_sections = $this->Action->requestAction('sections/getList');
                $contributeurs = array();
                //spécifique edit
                /*$nbActivite = $this->ActiviteExists($id);
                $this->set('actionId',$id);
                $utilisateurId = $this->get_action_utilisateur_id($id);*/
                $periodicite = $this->get_action_periodicity($this->request->data['Action']['periodicite_id']);
                $addlivrables = $this->requestAction('actionslivrables/get_list_livrables');
                $all_utilisateurs = $this->requestAction(('utilisateurs/get_list_actif'));      
                $list_sections = $this->Action->requestAction('sections/getList');
                $histories = $this->get_action_history($id);
                $livrables = $this->findLivrable($id);
                //set all variables
                $this->set(compact('types','etats','priorites','activitesagent','destinataires','domaines','nomlong','all_utilisateurs','list_sections','contributeurs','nbActivite','utilisateurId','livrables','periodicite','actionId','addlivrables','all_utilisateurs','list_sections','histories'));                 
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();            
            endif;                 
        }

        public function allow_delete($id){
            $result = false;
            if(userAuth('profil_id') == 1) 
            {$result = true; } 
            else if(userAuth('profil_id') == -2) 
            { $result = true; }            
            else if(userAuth('id') == $id) 
            { $result = true; }
            return $result;
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
                $action = $this->Action->find('first',array('conditions'=>array('Action.id'=>$id),'recursive'=>0));
                if($this->allow_delete($action['Action']['utilisateur_id'])):
                    if ($this->Action->delete()) {
                            if($msg) :
                                $this->sendmailactiondelete($action);
                                $this->Session->setFlash(__('Action supprimée',true),'flash_success');
                                $this->History->goBack(1);
                            else:
                                return true;
                            endif;
                    }
                    if($msg) :
                        $this->Session->setFlash(__('Action <b>NON</b> supprimée',true),'flash_failure');
                        $this->History->goBack(1);
                    else:
                        return true;
                    endif;
                else:
                    if($msg) :
                        $this->Session->setFlash(__('Action <b>NON</b> supprimée car vous n\'êtes pas l\'émetteur de cette action',true),'flash_failure');
                        $this->History->goBack(1);
                    else:
                        return true;
                    endif; 
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
	public function search($filtrePriorite=null,$filtreEtat=null,$filtreResponsable=null,$filtreEmetteur=null,$keywords=null) {
            if (isAuthorized('actions', 'index')) :       
                if(isset($this->params->data['Action']['SEARCH'])):
                    $keywords = $this->params->data['Action']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords));  
                    $listuser = $this->get_visibility();
                    $getpriority = $this->get_action_priority_filter($filtrePriorite);
                    $getetat = $this->get_action_etat_filter($filtreEtat);
                    $getemetteur = $this->get_action_emetteur_filter($filtreEmetteur, $listuser);
                    $getdestinataire = $this->get_action_responsable_filter($filtreResponsable, $listuser);
                    $newconditions=array($getpriority['condition'],$getetat['condition'],$getemetteur['condition'],$getdestinataire['condition']);
                    $this->set('fpriorite',$getpriority['filter']); 
                    $this->set('fetat',$getetat['filter']);               
                    $this->set('femetteur',$getemetteur['filter']);    
                    $this->set('nomlonge',$getemetteur['nomlonge']); 
                    $this->set('nomlong',$getdestinataire['nomlong']); 
                    $this->set('fresponsable',$getdestinataire['filter']);
                    $profils_autorised = $this->get_list_profil_autorised();
                    $responsables = $this->get_all_responsables($profils_autorised, $listuser);
                    $this->set('responsables',$responsables);                 
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Action.OBJET LIKE '%".$value."%'","Utilisateur.NOM LIKE '%".$value."%'","Utilisateur.PRENOM LIKE '%".$value."%'","Action.COMMENTAIRE LIKE '%".$value."%'","Activite.NOM LIKE '%".$value."%'","Domaine.NOM LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newconditions,'OR'=>$ornewconditions);
                    $this->get_export($conditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive' => 0));
                    $this->set('actions', $this->paginate());
                    $this->get_chronoline_action($conditions);
                else:
                    $this->redirect(array('action'=>'index',$filtrePriorite,$filtreEtat,$filtreResponsable,$filtreEmetteur));
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
        }     
        
        public function findActiviteForUtilisateur($utilisateur_id = null) {
            $listprojets = $this->requestAction('assoprojetentites/json_get_all_projets/'.$utilisateur_id);
            $this->Action->Activite->recursive = 0;
            $results = $this->Action->Activite->find('all',array('fields' => array('Activite.id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'conditions'=>array('Activite.projet_id>1','Activite.projet_id IN ('.$listprojets.')')));
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
            $this->set('title_for_layout','Rapport des actions par agents');
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
                $listuser = $this->requestAction('assoentiteutilisateurs/json_get_all_users/'. userAuth('id'));                  
                $destinataires = $this->Action->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.profil_id > 0','Utilisateur.id IN ('.$listuser.')'),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
                $this->set('destinataires',$destinataires);  
                $domaines = $this->Action->Domaine->find('list',array('fields'=>array('id','NOM'),'order'=>array('Domaine.NOM'),'recursive'=>-1));
                $this->set('domaines',$domaines);                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif; 
	}     

/**
 * rapport à partir des projets
 */        
        public function rapportprojet() {
            $this->set('title_for_layout','Rapport des actions par projets');
            if (isAuthorized('actions', 'rapports')) :
                if ($this->request->is('post')):
                    $options = array('pass' => array(implode(',',$this->request->data['Action']['projets'])));
                    $activites = $this->requestAction('projets/get_activities',$options);
                    $destinataire = 'Action.destinataire IN ('.$activites.')';
                    $periode = 'Action.ECHEANCE BETWEEN "'.  startWeek(CUSDate($this->request->data['Action']['START'])).'" AND "'.  endWeek(CUSDate($this->request->data['Action']['END'])).'"';
                    $chartresult = $this->Action->find('all',array('fields'=>array('MONTH(Action.ECHEANCE) AS MONTH', 'YEAR(Action.ECHEANCE) AS YEAR','Utilisateur.NOM','Action.destinataire','Utilisateur.PRENOM','COUNT(Action.id) AS NB','Action.STATUT'),'conditions'=>array($destinataire,$periode,'Action.CRA'=>1),'order'=>array('MONTH(Action.ECHEANCE)'=>'asc','YEAR(Action.ECHEANCE)'=>'asc'),'group'=>array('MONTH(Action.ECHEANCE)','YEAR(Action.ECHEANCE)'),'recursive'=>0));
                    $this->set('chartresults',$chartresult);                    
                    $detailrapportresult = $this->Action->find('all',array('fields'=>array('MONTH(Action.ECHEANCE) AS MONTH', 'YEAR(Action.ECHEANCE) AS YEAR','Action.destinataire','Action.NIVEAU','Action.STATUT','Action.OBJET','Domaine.NOM','Action.activite_id'),'conditions'=>array($destinataire,$periode,'Action.CRA'=>1),'order'=>array('MONTH(Action.ECHEANCE)'=>'asc','YEAR(Action.ECHEANCE)'=>'asc'),'recursive'=>1));
                    $this->set('detailrapportresults',$detailrapportresult);
                    $this->Session->delete('detailrapportresults');                      
                    $this->Session->write('detailrapportresults',$detailrapportresult);                   
                endif;
                $listprojets = $this->requestAction('assoprojetentites/json_get_all_projets/'.userAuth('id'));
                $projets = $this->Action->Activite->Projet->find('list',array('fields'=>array('id','NOM'),'conditions'=>array('Projet.ACTIF'=>1,'Projet.id IN ('.$listprojets.')'),'order'=>array('Projet.NOM'=>'asc'),'recursive'=>-1));
                $this->set('projets',$projets);                
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
                    $details = $this->Action->find('all',array('fields'=>array('Utilisateur.NOM','Utilisateur.PRENOM','Domaine.NOM','Action.destinataire','Action.NIVEAU','Action.OBJET','Action.COMMENTAIRE','Action.BILAN','Action.STATUT','Action.modified'),'conditions'=>array($destinataire,$domaine,$periode,'Action.STATUT NOT IN ("à faire","annulée")'),'order'=>array('Action.modified'=>'asc','Action.destinataire'=>'asc'),'recursive'=>0));
                    $this->set('details',$details);
                    $this->Session->delete('details');
                    $this->Session->write('details',$details);                
                endif;
                $listuser = $this->requestAction('assoentiteutilisateurs/json_get_all_users/'. userAuth('id'));                  
                $destinataires = $this->Action->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.profil_id > 0','Utilisateur.id IN ('.$listuser.')'),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
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
            $this->autoRender = false;
            $ids = explode('-', $this->request->data('all_ids'));
            if (count($ids)>1):
                $ids = explode('-', $this->request->data('all_ids'));
                if(count($ids)>0 && $ids[0]!=""):
                    foreach ($ids as $id) :
                        if ($this->Action->exists($id)) :
                            $this->Action->id = $id;
                            $cra = $this->Action->find('first',array('fields'=>array('CRA'),'conditions'=>array('Action.id'=>$id),'recursive'=>-1));
                            $boolcra = $cra['Action']['CRA']==1 ? 0 : 1;
                            if($this->Action->saveField('CRA', $boolcra)):     
                                $this->Session->setFlash(__('Information du CRA sauvegardée',true),'flash_success');
                            else :
                                $this->Session->setFlash(__('Information du CRA <b>NON</b> sauvegardée',true),'flash_failure');
                            endif; 
                        endif;
                    endforeach;
                    sleep(3);
                    echo $this->Session->setFlash(__('Mises à jour complétées',true),'flash_success');
                else:
                    echo $this->Session->setFlash(__('Aucune action sélectionnée',true),'flash_failure');
                endif;
            else:
                $this->Action->id = $this->request->data('all_ids');
                $id = $this->request->data('all_ids');
                $cra = $this->Action->find('first',array('fields'=>array('CRA'),'conditions'=>array('Action.id'=>$id),'recursive'=>-1));
                $boolcra = $cra['Action']['CRA']==1 ? 0 : 1;
                if($this->Action->saveField('CRA', $boolcra)):     
                    $this->Session->setFlash(__('Information du CRA sauvegardée',true),'flash_success');
                else :
                    $this->Session->setFlash(__('Information du CRA <b>NON</b> sauvegardée',true),'flash_failure');
                endif;                
            endif;
            return $this->request->data('all_ids');
            //exit();
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
        
        public function sendmailactiondelete($action){
            $valideurs = $this->Action->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$action['Action']['destinataire'])));
            $mailto = array();
            $mailto[]=$valideurs['Utilisateur']['MAIL'];
            $to=$mailto;
            $from = userAuth('MAIL');
            $cc=$this->requestAction('utilisateurs/get_mail',array('pass'=>array($action['Action']['CONTRIBUTEURS'])));
            $cc = $cc != '' ? $cc : array();            
            $objet = 'SAILL : Action n°'.' [A-'.  strYear($action['Action']['created']).'-'.$action['Action']['id'].'] supprimée';
            $message = "L'action ".$action['Action']['OBJET']." est supprimée.".
                    '<ul>
                    <li>Responsable :'.$valideurs['Utilisateur']['NOMLONG'].'</li>
                    <li>Contributeurs :'.$contributeurs.'</li>                        
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
                        ->cc($cc)
                        ->subject($objet)
                        ->send($message);
                }
                catch(Exception $e){
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_warning');
                }  
            endif;  
        }
        
        public function sendmailactions($action){
            $valideurs = $this->Action->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$action['Action']['destinataire'])));
            $contributeurs = $this->requestAction('utilisateurs/get_nom',array('pass'=>array($action['Action']['CONTRIBUTEURS'])));
            $mailto = array();
            $mailto[]=$valideurs['Utilisateur']['MAIL'];
            $to=$mailto;
            $cc=$this->requestAction('utilisateurs/get_mail',array('pass'=>array($action['Action']['CONTRIBUTEURS'])));
            $cc = $cc != '' ? $cc : array();
            $from = userAuth('MAIL');
            $objet = 'SAILL : Demande d\'action ['.$action['Action']['OBJET'].'] n°'.' [A-'.  strYear($action['Action']['created']).'-'.$action['Action']['id'].']';
            $message = "Merci de traiter l'action ".$action['Action']['OBJET'].
                    '<ul>
                    <li>Responsable :'.$valideurs['Utilisateur']['NOMLONG'].'</li>
                    <li>Contributeurs :'.$contributeurs.'</li>
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
                        ->cc($cc)
                        ->subject($objet)
                        ->send($message);
                }
                catch(Exception $e){
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_warning');
                }  
            endif;
        } 
        
        public function notifier($id){
            $action = $this->Action->find('first',array('conditions'=>array('Action.id'=>$id),'recursive'=>0));
            $valideurs = $this->Action->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$action['Action']['destinataire'])));
            $contributeurs = $this->requestAction('utilisateurs/get_nom',array('pass'=>array($action['Action']['CONTRIBUTEURS'])));            
            $mailto = array();
            $mailto[]=$valideurs['Utilisateur']['MAIL'];
            $to=$mailto;
            $cc=$this->requestAction('utilisateurs/get_mail',array('pass'=>array($action['Action']['CONTRIBUTEURS'])));
            $from = userAuth('MAIL');
            $objet = 'SAILL : Demande d\'action ['.$action['Action']['OBJET'].'] n°'.' [A-'.  strYear($action['Action']['created']).'-'.$action['Action']['id'].']';
            $message = "Merci de traiter l'action ".$action['Action']['OBJET'].
                    '<ul>
                    <li>Responsable :'.$valideurs['Utilisateur']['NOMLONG'].'</li>
                    <li>Contributeurs :'.$contributeurs.'</li>                        
                    <li>Echéance :'.$action['Action']['ECHEANCE'].'</li>
                    <li>Priorité :'.$action['Action']['PRIORITE'].'</li>
                    <li>Résumé :'.$action['Action']['RESUME'].'</li> 
                    <li>Commentaire :'.$action['Action']['COMMENTAIRE'].'</li>                      
                    </ul>';
            $cc = $cc != '' ? $cc : array();
            if($to!=''):
                try{
                $email = new CakeEmail();
                $email->config('smtp')
                        ->emailFormat('html')
                        ->from($from)
                        ->to($to)
                        ->cc($cc)
                        ->subject($objet)
                        ->send($message);
                $this->Session->setFlash(__('Mail envoyé aux destinataires (responsable et contributeurs)',true),'flash_success');
                }
                catch(Exception $e){
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_warning');
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
                if (isset($destinataire['Utilisateur'])):
                    $description = '['.$destinataire['Utilisateur']['NOMLONG'].'] - '.$data['Action']['OBJET'];
                else:
                    $description = '[destinataire inconnu] - '.$data['Action']['OBJET'];
                endif;
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
            $this->autoRender = false;
            $ids = explode('-', $this->request->data('all_ids'));
            if(count($ids)>0 && $ids[0]!=""):
                foreach($ids as $id):
                    if($this->delete($id,false)):
                        echo $this->Session->setFlash(__('Actions supprimées',true),'flash_success'); 
                    else :
                        echo $this->Session->setFlash(__('Actions <b>NON</b> supprimées',true),'flash_failure');
                    endif;
                endforeach;
                sleep(3);
                echo $this->Session->setFlash(__('Suppressions réalisées si vous en êtes l\'émetteur uniquement',true),'flash_success');
            else:
                echo $this->Session->setFlash(__('Aucune action sélectionnée',true),'flash_failure');
            endif;
            return $this->request->data('all_ids');
            //exit(); 
        }
        
        public function closeall(){
            $this->autoRender = false;
            $ids = explode('-', $this->request->data('all_ids'));
            if(count($ids)>0 && $ids[0]!=""):
                foreach($ids as $id):
                    if ($this->Action->exists($id)) {
                        $this->Action->id = $id;
                        $this->Action->saveField('NEW', 0);
                        $this->Action->saveField('STATUT', 'terminée');
                        if($this->Action->saveField('AVANCEMENT', '100')):
                            $this->saveHistory($id);  
                            echo $this->Session->setFlash(__('Actions cloturées',true),'flash_success'); 
                        else :
                            $this->Session->setFlash(__('Actions <b>NON</b> clotûrées correctement',true),'flash_failure');
                        endif;
                    }
                endforeach;
                sleep(3);
                echo $this->Session->setFlash(__('Mises à jour complétées',true),'flash_success');
            else:
                echo $this->Session->setFlash(__('Aucune action sélectionnée',true),'flash_failure');
            endif;
            return $this->request->data('all_ids');
            //exit();                       
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
