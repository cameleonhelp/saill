<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('AssoentiteutilisateursController', 'Controller');
App::uses('UtilisateursController', 'Controller');
App::uses('EquipesController', 'Controller');
App::uses('DomainesController', 'Controller');
App::uses('SectionsController', 'Controller');
App::uses('ActioncontributeursController', 'Controller');
App::uses('ActionslivrablesController', 'Controller');
App::uses('AssoprojetentitesController', 'Controller');
App::uses('ProjetsController', 'Controller');
App::uses('ActivitesController', 'Controller');
/**
 * Actions Controller
 *
 * @property Action $Action
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class ActionsController extends AppController {

    /**
     *Déclaration des variables public
     */
    public $paginate = array(
    'limit' => 25,
    'order' => array('Action.ECHEANCE' => 'asc','Action.PRIORITE'=>'asc'),
    );

    public $components = array('History','Common');

    /**
     * Méthode pour autoriser l'utilisation de mléthode sans autorisation
     */
    public function beforeFilter() {   
        $this->Auth->allow(array('get_all_actions_between','get_all_users_actions_between','set_close_all_actions','ajax_update'));
        parent::beforeFilter();
    }   

    /**
     * Méthode appellée avant de rendre la main
     */
    public function beforeRender() { 
        parent::beforeRender();
    }
        
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? 'Actions' : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }
        
    /**
     * Méthode permettant de fixer la visibilité de l'iutilisateur
     * 
     * @return string
     */
    public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:
            $Assoentiteutilisateurs = new AssoentiteutilisateursController(); 
            return $Assoentiteutilisateurs->json_get_all_users(userAuth('id'));  
        endif;
    }
    
    /**
     * Méthode permettant d'ajouter les conditions pour filtrer sur la priorité
     * 
     * @param string $id
     * @return array('condition'=>'','filter'=>'')
     */
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
    
    /**
     * Méthode permettant d'ajouter les condition pour filtrer sur l'état
     * 
     * @param string $id
     * @return array('condition'=>'','filter'=>'')
     */
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

    /**
     * Méthode permettant d'ajouter les condition pour filtrer sur l'émetteur
     * 
     * @param string $id
     * @param string $visibility
     * @return array('condition'=>'','filter'=>'')
     */    
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
                $ids = explode('-',$id);
                $strid = implode(',',$ids);
                $result['condition']="Action.utilisateur_id IN (".$strid.")";
                if(count($ids)>1):
                    $result['filter'] = "plusieurs émetteurs";
                else:
                    $nomlong = isset($nomlong['Utilisateur']['NOMLONG']) ? $nomlong['Utilisateur']['NOMLONG'] : $nomlong['NOMLONG'];
                    $result['filter'] = "pour émetteur ".$nomlong;
                endif;

                
                break;                      
        }     
        return $result;
    }
    
    /**
     * Méthode permettant d'ajouter les condition pour filtrer sur le responsable
     * 
     * @param string $id
     * @param string $visibility
     * @return array('condition'=>'','filter'=>'')
     */    
    public function get_action_responsable_filter($id,$visibility){
        $ObjUtilisateurs = new UtilisateursController();
        $ObjEquipes = new EquipesController();		        
        $result = array();
        $nomlong = '';
        if($id != 'tous' && $id != 'equipe'):
            $nomlong = $ObjUtilisateurs->get_nomlong($id);
        endif;
        $result['nomlong'] = $nomlong;
        if (areaIsVisible() || $id==userAuth('id')):
        switch ($id){
            case 'tous':   
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
                $monequipe = $ObjEquipes->myTeam(userAuth('id')).userAuth('id');
                $result['condition']="(Action.destinataire in (".$monequipe.") OR (CONTRIBUTEURS LIKE '%".userAuth('id').",%' OR CONTRIBUTEURS LIKE '%,".userAuth('id')."%' OR CONTRIBUTEURS = '".userAuth('id')."'))";
                $result['filter'] = "de mon équipe";
                break;                     
            case null :
                $result['condition']="(Action.destinataire='".userAuth('id')."' OR (CONTRIBUTEURS LIKE '%".userAuth('id').",%' OR CONTRIBUTEURS LIKE '%,".userAuth('id')."%' OR CONTRIBUTEURS = '".userAuth('id')."'))";
                $result['filter'] = "dont le responsable est ".$nomlong ;
                break;                      
            default :
                $result['condition']="(Action.destinataire='".$id."' OR (`CONTRIBUTEURS` LIKE '%".$id.",%' OR `CONTRIBUTEURS` LIKE '%,".$id."%' OR `CONTRIBUTEURS` = '".$id."'))";
                $result['filter'] = "dont le responsable est ".$nomlong ;
                break;                      
        }  
        else:
            $result['condition']="Action.destinataire='".userAuth('id')."' OR (`CONTRIBUTEURS` LIKE '%".userAuth('id').",%' OR `CONTRIBUTEURS` LIKE '%,".userAuth('id')."%' OR `CONTRIBUTEURS` = '".userAuth('id')."'))";
            $nomlong = $this->Action->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array("Utilisateur.id"=>userAuth('id'))));
            $result['filter'] = "dont le responsable est ".$nomlong['Utilisateur']['NOMLONG'];
        endif;  
        return $result;
    }
    
    /**
     * Méthode permettant de remonter l'utilisateur de l'action
     * 
     * @param int $id
     * @return utilisateur_id
     */    
    public function get_action_utilisateur_id($id){
        return $this->Action->find('first',array('conditions'=>array('Action.id'=>$id),'fields'=>array('utilisateur_id')));
    }
    
    /**
     * Méthode permettant de remonter la périodicité d'une action
     * 
     * @param int $id
     * @return Periodicites
     */    
    public function get_action_periodicity($id){
        return $this->Action->Periodicite->find('first',array('conditions'=>array('Periodicite.id'=>$id),'recursive'=>-1));
    }
    
    /**
     * Méthode permettant de remonter l'historique de l'action
     * 
     * @param int $id
     * @return Historyactions
     */    
    public function get_action_history($id){
        return $this->Action->Historyaction->find('all',array('conditions'=>array('Historyaction.action_id'=>$id),'order'=>array('Historyaction.id'=>'desc'),'recursive'=>-1));        
    }
    
    /**
     * Méthode permettant de remonter la liste des profils autorisés sur l'ajout, la mise à jour et la suppression des actions
     * 
     * @return string
     */     
    public function get_list_profil_autorised(){
        $profilin = "";
        $listeprofilsautorises = $this->Action->Utilisateur->Profil->Autorisation->find('all',array('conditions'=>array('Autorisation.MODEL'=>'actions','OR'=>array('Autorisation.ADD'=>1,'Autorisation.EDIT'=>1,'Autorisation.DELETE'=>1))));
        $profilin = '';
        foreach($listeprofilsautorises as $liste):
            $profilin .= $liste['Autorisation']['profil_id'].',';
        endforeach;  
        return substr_replace($profilin ,"",-1);
    }
    
    /**
     * Méthode permettant de remonter tous les responsables
     * 
     * @param string $profil
     * @param string $visibility
     * @return Utilisateurs
     */     
    public function get_all_responsables($profil,$visibility){
        $result = null;
        if($profil!= '' && $visibility!=''):
            $result = $this->Action->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id IN ('.$profil.')','Utilisateur.id IN ('.$visibility.')'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        elseif($profil!= ''):
            $result = $this->Action->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id IN ('.$profil.')'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        else:
            $result = $this->Action->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.profil_id >1','Utilisateur.profil_id =-2')),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        endif;
        return $result;
    }
    
    /**
     * Méthode permettant de remonter tous les responsables pour les selects
     * 
     * @param string $profil
     * @param string $visibility
     * @return Utilisateurs
     */         
    public function get_list_responsables($profil,$visibility){
        $result = null;
        if($profil!= '' && $visibility!=''):
            $result = $this->Action->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id IN ('.$profil.')','Utilisateur.id IN ('.$visibility.')'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        elseif($profil!= ''):
            $result = $this->Action->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id IN ('.$profil.')'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        else:
            $result = $this->Action->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.profil_id >1','Utilisateur.profil_id =-2')),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        endif;
        return $result;
    }    
    
    /**
     * Méthode permettant de mettre en session les données prévues pour l'export
     * 
     * @param array() $conditions
     */
    public function get_export($conditions){
        $export = $this->Action->find('all',array('conditions'=>$conditions,'order' => array('Action.ECHEANCE' => 'asc'),'recursive'=>0));
        $this->Session->delete('xls_export');
        $this->Session->write('xls_export',$export);    
    }   
    
    /**
     * Méthode permettant de remonter les actions pour la barre chronologique
     * 
     * @param array() $conditions
     * @return mise à jour de la variable de session actions_index
     */
    public function get_chronoline_action($conditions){
        $listeactions = $this->Action->find('all',array('conditions'=>$conditions,'recursive'=>-1));
        $this->Session->delete('actions_index');
        $this->Session->write('actions_index',$listeactions);        
    }

    /**
     * Méthode permettant de lister les actions
     * 
     * @param string $filtrePriorite
     * @param string $filtreEtat
     * @param string $filtreResponsable
     * @param string $filtreEmetteur
     * @throws UnauthorizedException
     * @return Actions
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
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif; 
    }

    /**
     * Méthode qui sauvegarde la périodicité 
     * 
     * @param string $periode Q : Quotidienne, H : Hebdomadaire, M: Mensuelle
     * @return int periodicite_id
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
     * Méthode calcul le nombre de périodicité à ajouter 
     * 
     * @param int $id de la périodicité
     * @param date $start
     * @return array de date
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
        
    /**
     * Méthode qui créé une nouvelle action
     */
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
                        $this->save_contributeur($this->Action->getInsertID(), $this->request->data['Action']['CONTRIBUTEURS']);
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
     * Méthode pour l'ajout d'une nouvelle action
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        if (isAuthorized('actions', 'add')) :
            $ObjUtilisateurs = new UtilisateursController();
            $ObjDomaines = new DomainesController();	
            $ObjSections = new SectionsController();
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
                                $this->save_contributeur($this->Action->getInsertID(), $this->request->data['Action']['CONTRIBUTEURS']);
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
            $domaines = $ObjDomaines->get_list();
            $nomlong = $ObjUtilisateurs->get_nomlong(userAuth('id'));
            $all_utilisateurs = $ObjUtilisateurs->get_list_actif();
            $list_sections = $ObjSections->getList();
            $contributeurs = array();
            $this->set(compact('types','etats','priorites','activitesagent','destinataires','domaines','nomlong','all_utilisateurs','list_sections','contributeurs')); 
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");      
        endif;                 
    }

    /**
     * Méthode enregistrant les contributeurs dans la table d'association
     * 
     * @param int $action_id
     * @param string $users_id
     */
    public function save_contributeur($action_id,$users_id){
        $ObjActioncontributeurs = new ActioncontributeursController();            
        $ObjActioncontributeurs->save($action_id,$users_id);
    }

    /**
     * Méthode de mise à jour de l'action
     * 
     * @param int $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */    
    public function edit($id = null) { 
        if (isAuthorized('actions', 'edit')) :
            $ObjUtilisateurs = new UtilisateursController(); 
            $ObjDomaines = new DomainesController();	
            $ObjSections = new SectionsController();
            $ObjActioncontributeurs = new ActioncontributeursController();      
            $ObjActionlivrables = new ActionslivrablesController();                
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
                            $this->save_contributeur($id, $this->request->data['Action']['CONTRIBUTEURS']);
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
                    $contributeurs_nom = $ObjUtilisateurs->get_nom($this->request->data['Action']['CONTRIBUTEURS']);
                    $this->set(compact('contributeurs','contributeurs_nom'));                        
            }
            $listuser = $this->get_visibility();  
            $etats = Configure::read('etatAction'); 
            $priorites = Configure::read('prioriteAction');
            $types = Configure::read('typeAction');
            $profil = $this->get_list_profil_autorised();
            $activitesagent = $this->findActiviteForUtilisateur(userAuth('id'));
            $destinataires = $this->get_list_responsables($profil, $listuser);
            $domaines = $ObjDomaines->get_list();
            $nomlong = $ObjUtilisateurs->get_nomlong(userAuth('id'));
            $all_utilisateurs = $ObjUtilisateurs->get_list_actif();
            $list_sections = $ObjSections->getList();
            $contributeurs = array();
            $nbcontrib = $ObjActioncontributeurs->count_contributeurs($id);
            $listcontrib = $ObjActioncontributeurs->str_contributeurs($id);
            $contributeurs_nom = $ObjUtilisateurs->get_nom($listcontrib);
            //spécifique edit
            /*$nbActivite = $this->ActiviteExists($id);
            $this->set('actionId',$id);
            $utilisateurId = $this->get_action_utilisateur_id($id);*/
            $periodicite = $this->get_action_periodicity($this->request->data['Action']['periodicite_id']);
            $addlivrables = $ObjActionlivrables->get_list_livrables();
            $histories = $this->get_action_history($id);
            $livrables = $this->findLivrable($id);
            //set all variables
            $this->set(compact('types','etats','priorites','activitesagent','destinataires','nbcontrib','domaines','nomlong','all_utilisateurs','list_sections','contributeurs','nbActivite','utilisateurId','livrables','periodicite','actionId','addlivrables','all_utilisateurs','list_sections','histories','contributeurs_nom'));                 
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");            
        endif;                 
    }

    /**
     * Méthode retournant si le profil de l'utilisateur permet la suppression ou si celui-ci est l'auteur de l'action
     * 
     * @param int $id de l'utilisateur
     * @return boolean
     */
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
     * Méthode permettant de supprimer l'action
     * 
     * @param int $id
     * @param boolean $msg
     * @return boolean
     * @throws NotFoundException
     * @throws UnauthorizedException
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
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");        
        endif;                 
    }
        
    /**
     * Méthode de recherche des actions
     * 
     * @param string $filtrePriorite
     * @param string $filtreEtat
     * @param string $filtreResponsable
     * @param string $filtreEmetteur
     * @param string $keywords
     * @throws UnauthorizedException
     * @return Actions
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
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }     

    /**
     * Trouve toutes les activités pour un utilisateur en fonction de cson cercle de visibilité
     * 
     * @param int $utilisateur_id
     * @return Activites
     */
    public function findActiviteForUtilisateur($utilisateur_id = null) {
        $ObjAssoprojetentites = new AssoprojetentitesController();	
        $listprojets = $ObjAssoprojetentites->json_get_all_projets($utilisateur_id);
        $this->Action->Activite->recursive = 0;
        $results = $this->Action->Activite->find('all',array('fields' => array('Activite.id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'conditions'=>array('Activite.projet_id>1','Activite.projet_id IN ('.$listprojets.')')));
        return $results;
    }        

    /**
     * Trouve toutes les activités actives
     * 
     * @return Activites
     */
    public function findActiviteActive() {
        $this->Action->Activite->recursive = 0;
        $results = $this->Action->Activite->find('all',array('fields' => array('Activite.id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'conditions'=>array('Activite.projet_id>1','Activite.ACTIVE' => 1)));
        return $results;
    } 

    /**
     * Trouve tous les livrables
     * 
     * @param int $id
     * @return Actionslivrables
     */
    public function findLivrable($id=null) {
        $this->Action->Actionslivrable->recursive = 0;
        return $this->Action->Actionslivrable->find('all',array('conditions'=>array('Actionslivrable.action_id'=>$id)));
    }   

    /**
     * Trouve les livrables non terminés pour la select
     * 
     * @return Livrables
     */
    public function findLivrableNonTermine() {
        $list = array();
        $sql = "SELECT livrables.id, livrables.NOM FROM livrables WHERE livrables.ETAT NOT IN ('validé','livré','refusé','annulé')";
        $results = $this->Action->query($sql);
        foreach ($results as $result) {
            $list[$result['livrables']['id']]=$result['livrables']['NOM'];
        }
        return $list;
    }           

    /**
     * Trouve la dernière modification faite sur l'action
     * 
     * @param int $id
     * @return Historyactions
     */
    public function getLastHistory($id){
        $history = $this->Action->Historyaction->find('first',array('conditions'=>array('Historyaction.action_id'=>$id),'order'=>array('Historyaction.id'=>'desc'),'recursive'=>-1));
        return $history;
    }

    public function deleteHistory($history){
        $this->Action->Historyaction->delete($history['Historyaction']['id']);             
    }

    /**
     * Sauvegarde de l'historique de l'action
     * 
     * @param int $id
     */
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

    /**
     * Obsolète était utilisé lorsque l'action était liée à une activité réelle cela portait à confusion entre activité réelle (facturation) et Action
     * @param type $id
     */
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
     * Rapport par agent des actions
     * 
     * @throws UnauthorizedException
     */
    public function rapport() {
        $this->set_title('Rapport des actions par agents');
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
            $listuser = $this->get_visibility();
            $profil = $this->get_list_profil_autorised();
            $destinataires = $this->get_list_responsables($profil, $listuser);
            $ObjDomaines = new DomainesController();                
            $domaines = $ObjDomaines->get_list();
            $this->set(compact('domaines','destinataires'));                
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif; 
    }     

    /**
     * Rapport par projets des actions
     * 
     * @throws UnauthorizedException
     * @return Actions
     */
    public function rapportprojet() {
        $this->set_title('Rapport des actions par projets');
        if (isAuthorized('actions', 'rapports')) :
            $ObjProjets = new ProjetsController();	
            $ObjAssoprojetentites = new AssoprojetentitesController();
            if ($this->request->is('post')):
                $options = $this->request->data['Action']['projets'];
                $activites = $ObjProjets->get_activities($options);
                $destinataire = 'Action.destinataire IN ('.$activites.')';
                $periode = 'Action.ECHEANCE BETWEEN "'.  startWeek(CUSDate($this->request->data['Action']['START'])).'" AND "'.  endWeek(CUSDate($this->request->data['Action']['END'])).'"';
                $chartresult = $this->Action->find('all',array('fields'=>array('MONTH(Action.ECHEANCE) AS MONTH', 'YEAR(Action.ECHEANCE) AS YEAR','Utilisateur.NOM','Action.destinataire','Utilisateur.PRENOM','COUNT(Action.id) AS NB','Action.STATUT'),'conditions'=>array($destinataire,$periode,'Action.CRA'=>1),'order'=>array('MONTH(Action.ECHEANCE)'=>'asc','YEAR(Action.ECHEANCE)'=>'asc'),'group'=>array('MONTH(Action.ECHEANCE)','YEAR(Action.ECHEANCE)'),'recursive'=>0));
                $this->set('chartresults',$chartresult);                    
                $detailrapportresult = $this->Action->find('all',array('fields'=>array('MONTH(Action.ECHEANCE) AS MONTH', 'YEAR(Action.ECHEANCE) AS YEAR','Action.destinataire','Action.NIVEAU','Action.STATUT','Action.OBJET','Domaine.NOM','Action.activite_id'),'conditions'=>array($destinataire,$periode,'Action.CRA'=>1),'order'=>array('MONTH(Action.ECHEANCE)'=>'asc','YEAR(Action.ECHEANCE)'=>'asc'),'recursive'=>1));
                $this->set('detailrapportresults',$detailrapportresult);
                $this->Session->delete('detailrapportresults');                      
                $this->Session->write('detailrapportresults',$detailrapportresult);                   
            endif;
            $listprojets = $ObjAssoprojetentites->json_get_all_projets(userAuth('id'));
            $projets = $ObjProjets->get_list_id_nom_projets($listprojets);
            $this->set('projets',$projets);                
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif; 
    }             

    /**
     * Rapport remontant les actions des 7 derniers jours
     * 
     * @throws UnauthorizedException
     */
    public function last7days() {
        $this->set_title('Rapport des actions modifiées sur les 7 derniers jours');
        if (isAuthorized('actions', 'rapports')) :
            $ObjDomaines = new DomainesController();
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
            $listuser = $this->get_visibility();
            $profil = $this->get_list_profil_autorised();
            $destinataires = $this->get_list_responsables($profil, $listuser);
            $domaines = $ObjDomaines->get_list();
            $this->set(compact('domaines','destinataires'));                  
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;             
    }

    /**
    * Méthode dupliquant l'action en gardant certaines informations
    *
    * @throws NotFoundException
    * @throws MethodNotAllowedException
    * @param int $id
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
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    } 

    /**
     * Méthode exportant au format Doc utilisée pour le rapport
     */
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
     * Méthode mettant à jour le statut (Workflow : A faire => En cours => Terminée => Livré => Annulée => A faire)
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

    /**
     * Méthode mettant à jour l'avancement
     */
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

    /**
     * Méthode mettant à jour la charge prévue
     */
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

    /**
     * Méthode qui modifie le champs CRA pour les actions sélectionnées (Action groupée)
     * 
     * @return string
     */
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
    }

    /**
     * 5 prochaines actions  utilisé sur la page d'accueil
     * 
     * @return Actions
     */
    public function homeListeActions(){
        $listactions = $this->Action->find('all',array('conditions'=>array('destinataire'=>userAuth('id'),'STATUT NOT IN("terminée","livré","annulée")'),'order'=>array('ECHEANCE'=>'ASC'),'limit' => 5,'recursive'=>-1));
        return $listactions;
    }   

    /**
     * Actions à faire utilisé sur la page d'accueil
     * 
     * @return Actions
     */    
    public function homeNBAFAIREActions(){
        $nbactions = $this->Action->find('all',array('fields'=>array('COUNT(id) AS NB','STATUT'),'conditions'=>array('destinataire'=>userAuth('id'),'STATUT'=>"à faire"),'group'=>'STATUT','recursive'=>-1));
        return $nbactions;
    }   
    
    /**
     * Actions en cours utilisé sur la page d'accueil
     * 
     * @return Actions
     */
    public function homeNBENCOURSActions(){
        $nbactions = $this->Action->find('all',array('fields'=>array('COUNT(id) AS NB','STATUT'),'conditions'=>array('destinataire'=>userAuth('id'),'STATUT'=>"en cours"),'group'=>'STATUT','recursive'=>-1));
        return $nbactions;
    }            

    /**
     * Actions en retard utilisé sur la page d'accueil
     * 
     * @return Actions
     */
    public function homeNBRETARDActions(){
        $nbactions = $this->Action->find('all',array('fields'=>array('COUNT(id) AS NB','STATUT','ECHEANCE'),'conditions'=>array('destinataire'=>userAuth('id'),'STATUT NOT IN("terminée","livré","annulée")',"ECHEANCE <"=>date('Y-m-d')),'group'=>'STATUT','recursive'=>-1));
        return $nbactions;
    }     

    /**
     * Envois un mail lors de la suppression de l'action
     * 
     * @param int $action
     */
    public function sendmailactiondelete($action){
        $valideurs = $this->Action->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$action['Action']['destinataire'])));
        $mailto = array();
        $mailto[]=$valideurs['Utilisateur']['MAIL'];
        $to=$mailto;
        $from = Configure::read('mailapp');
        $ObjUtilisateurs = new UtilisateursController();            
        $cc= $ObjUtilisateurs->get_mail($action['Action']['CONTRIBUTEURS']);
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

    /**
     * Envois de mail pour une action
     * 
     * @param int $action
     */
    public function sendmailactions($action){
        $valideurs = $this->Action->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$action['Action']['destinataire'])));
        $ObjUtilisateurs = new UtilisateursController();            
        $contributeurs = $ObjUtilisateurs->get_nom($action['Action']['CONTRIBUTEURS']);
        $mailto = array();
        $mailto[]=$valideurs['Utilisateur']['MAIL'];
        $to=$mailto;
        $cc=$ObjUtilisateurs->get_mail($action['Action']['CONTRIBUTEURS']);
        $cc = $cc != '' ? $cc : array();
        $from = Configure::read('mailapp');
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

    /**
     * Nofitier par mail les destinataires de l'actions (responsable et contributeurs)
     * 
     * @param int $id de l'action
     */
    public function notifier($id){
        $action = $this->Action->find('first',array('conditions'=>array('Action.id'=>$id),'recursive'=>0));
        $valideurs = $this->Action->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$action['Action']['destinataire'])));
        $ObjUtilisateurs = new UtilisateursController(); 
        $contributeurs = $ObjUtilisateurs->get_nom($action['Action']['CONTRIBUTEURS']);            
        $mailto = array();
        $mailto[]=$valideurs['Utilisateur']['MAIL'];
        $to=$mailto;
        $cc= $ObjUtilisateurs->get_mail($action['Action']['CONTRIBUTEURS']);
        $from = Configure::read('mailapp');
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

    /**
     * Méthode qui formatte les données pour la barre chronologique
     * 
     * @return array('start' => "",'end' => "",'durationEvent' => "",'title' => "",'id'=>"",'description'=>"")
     */
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

    /**
     * Méthode supprimant la préiodicité de cette action
     * 
     * @param int $action_id
     * @param boolean $loop
     */
    public function deleteThisPeriodicite($action_id,$loop=false){
        $this->Action->id = $action_id;
        $this->Action->saveField('periodicite_id',null);
        $this->Action->saveField('FREQUENCE','Q');
        $this->Session->setFlash(__('Périodicité supprimé pour cette action',true),'flash_success');
        if(!$loop) $this->History->goBack(1);

    }

    /**
     * Méthode qui supprime toute les périodicités identique à l'action
     * 
     * @param int $action_id
     */
    public function deleteAllPeriodicite($action_id){
        $periodicity_id = $this->Action->find('first',array('fields'=>array('Action.periodicite_id'),'conditions'=>array('Action.id'=>$action_id),'recursive'=>-1));
        $allids = $this->Action->find('all',array('fields'=>array('Action.id'),'conditions'=>array('Action.periodicite_id'=>$periodicity_id['Action']['periodicite_id']),'recursive'=>-1));
        foreach($allids as $id):
            $this->deleteThisPeriodicite($id['Action']['id'],true);
        endforeach;
        $this->Session->setFlash(__('Périodicité supprimée pour toutes les autres actions',true),'flash_success');
        $this->History->goBack(1);
    }     

    /**
     * Méthode supprimant toutes les actions sélectionnées (action groupée)
     * 
     * @return string
     */
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
    }

    /**
     * Méthode qui positionne le statut des toutes les actions ayant un avancement à 100% à Terminée (action groupée)
     * 
     * @return string
     */
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
    }

    /**
     * Méthode remontant le rapport des risque pour un domaine
     * 
     * @throws UnauthorizedException
     */
    public function risques(){
        $this->set_title('Etudes des risques par domaine');
        if (isAuthorized('actions', 'rapports')) :
            $ObjDomaines = new DomainesController();
            $ObjActivites = new ActivitesController();
            if ($this->request->is('post')):
                $domaine = $this->data['Action']['domaine_id'];
                $activites = $ObjActivites->find_str_id_cercle_activite(userAuth('id'));
                $rapportresult = $this->Action->find('all',array('fields'=>array('Action.domaine_id', 'COUNT(Action.id) AS NB','Action.NIVEAU'),'conditions'=>array('Action.activite_id IN ('.$activites.')','Action.domaine_id'=>$domaine,'Action.STATUT NOT IN ("terminée","livrée")','Action.NIVEAU >'=>0),'order'=>array('Action.NIVEAU'=>'asc'),'group'=>array('Action.NIVEAU'),'recursive'=>0));
                $this->set('rapportresults',$rapportresult);
                $chartresult = $this->Action->find('all',array('fields'=>array('Action.domaine_id', 'COUNT(Action.id) AS NB','Action.NIVEAU'),'conditions'=>array('Action.activite_id IN ('.$activites.')','Action.domaine_id'=>$domaine,'Action.STATUT NOT IN ("terminée","livrée")','Action.NIVEAU >'=>0),'group'=>array('Action.NIVEAU'),'recursive'=>0));
                $this->set('chartresults',$chartresult);                                      
            endif; 
            $domaines = $ObjDomaines->get_list();
            $this->set(compact('domaines'));                  
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;             
    }

    /**
     * Méthode qui renvois l'export
     */
    function export_xls() {
            $data = $this->Session->read('xls_export');
            //$this->Session->delete('xls_export');                
            $this->set('rows',$data);
            $this->render('export_xls','export_xls');
    }    

    /**
     * Méthode qui remonte les action concernant un utilisateur avant la date
     * 
     * @param date $end
     * @param int $utilisateur_id
     * @return Actions
     */
    public function get_all_actions_before_for_user($end,$utilisateur_id){
        set_time_limit(120);
        //actions non terminée avec echéance comprise entre < $end
        $conditions = array('Action.ECHEANCE <= "'.$end.'"','Action.utilisateur_id'=>$utilisateur_id,'OR'=>array('Action.STATUT'=>'à faire','Action.STATUT'=>'en cours'));
        $order = array('Action.ECHEANCE'=>'asc');
        return $this->Action->find('all',array('conditions'=>$conditions,'order'=>$order,'recursive'=>0));
    }

    /**
     * Méthode qui remonte les actions concernant le destinataire entre deux dates
     * 
     * @param date $today
     * @param date $end
     * @param int $utilisateur_id
     * @return Actions
     */
    public function get_all_actions_between_for_user($today,$end,$utilisateur_id){
        set_time_limit(120);
        //actions non terminée avec echéance comprise entre < $end
        $conditions = array('Action.ECHEANCE BETWEEN "'.$today.'" AND "'.$end.'"','Action.utilisateur_id'=>$utilisateur_id,'OR'=>array('Action.STATUT'=>'à faire','Action.STATUT'=>'en cours'));
        $order = array('Action.ECHEANCE'=>'asc');
        return $this->Action->find('all',array('conditions'=>$conditions,'order'=>$order,'recursive'=>0));
    }        

    /**
     * Méthode qui remonte les actions concernant le destinataire avant la date de fin
     * 
     * @param date $end
     * @return Actions
     */
    public function get_id_nomlg_users_actions_before($end){
        set_time_limit(120);
        //actions non terminée avec echéance comprise entre < $end
        $conditions = array('OR'=>array('Action.STATUT'=>'à faire','Destinataire.NOTIFYME'=>1,'Action.STATUT'=>'en cours'),'Action.ECHEANCE <= "'.$end.'"','Utilisateur.ACTIF'=>1);
        $order = array('Action.destinataire'=>'asc');
        $group = array('Action.destinataire');
        $fields = array('Action.destinataire','Destinataire.MAIL','CONCAT(Destinataire.PRENOM," ",Destinataire.NOM) as Destinataire__NOMLONG');
        return $this->Action->find('all',array('fields'=>$fields,'conditions'=>$conditions,'order'=>$order,'group'=>$group,'recursive'=>0));
    }

    /**
     * Méthode permettant de remonter des informations concernant le destinataire entre deux dates
     * 
     * @param date $today de début
     * @param date $end de fin
     * @return Actions
     */
    public function get_id_nomlg_users_actions_between($today,$end){
        set_time_limit(120);
        //actions non terminée avec echéance comprise entre < $end
        $conditions = array('OR'=>array('Action.STATUT'=>'à faire','Destinataire.NOTIFYME'=>1,'Action.STATUT'=>'en cours'),'Action.ECHEANCE BETWEEN "'.$today.'" AND "'.$end.'"','Utilisateur.ACTIF'=>1);
        $order = array('Action.destinataire'=>'asc');
        $group = array('Action.destinataire');
        $fields = array('Action.destinataire','Destinataire.MAIL','CONCAT(Destinataire.PRENOM," ",Destinataire.NOM) as Destinataire__NOMLONG');
        return $this->Action->find('all',array('fields'=>$fields,'conditions'=>$conditions,'order'=>$order,'group'=>$group,'recursive'=>0));
    }

    /**
     * Méthode permettant de cloturer une action en fonction de la valeu de l'avancement
     * 
     * @param int $avancement
     * @return boolean
     */
    public function set_close_all_actions($avancement){
        set_time_limit(120);
        //mise à jour du statut à terminée des actions non terminée avec avancement = $avancement
        $conditions = array('Action.AVANCEMENT '=>$avancement);
        $fields = array('Action.STATUT'=>"'terminée'");
        return $this->Action->updateAll($fields, $conditions);  
    }

    /**
     * Méthode de mise à jour depuis le tableau des actions d'un champs
     * 
     * @return boolean
     */
    public function ajax_update(){
        $this->autoRender = false;
        $this->Action->id = $_POST['pk'];
        $this->Action->saveField( $_POST['name'], trim($_POST['value']));
        return true;
    }        
}
