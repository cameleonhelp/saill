<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('AssoentiteutilisateursController', 'Controller');
App::uses('UtilisateursController', 'Controller');
App::uses('ActivitesController', 'Controller');
App::uses('DomainesController', 'Controller');
App::uses('EquipesController', 'Controller');
App::uses('EntitesController', 'Controller');
App::uses('ProjetsController', 'Controller');
App::uses('AssoprojetentitesController', 'Controller');
/**
 * Activitesreelles Controller
 *
 * @property Activitesreelle $Activitesreelle
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class ActivitesreellesController extends AppController {
    
    /**
     * Déclaration des varaibles public
     */
    public $components = array('History','Common');    
    public $paginate = array(
        'order' => array('Utilisateur.NOM' => 'asc','Activitesreelle.DATE' => 'desc'),
        );
       
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? 'Feuilles de temps' : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }
    /**
     * Méthode permettant ici d'autoriser une méthode pour tous les utilisateurs
     */
    public function beforeFilter() {   
        $this->Auth->allow(array('deleteline'));
        parent::beforeFilter();
    }   
        
    /**
     * Méthode permettant de connaitre la limite de visibilité de l'utilisateur
     * Si profil administrateur aucune limite
     * Si autre que administrateur aleur on se limite aux utilisateurs de ses cercles
     * 
     * @return null ou string 
     */
    public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            return $ObjAssoentiteutilisateurs->json_get_all_users(userAuth('id'));
        endif;            
    }
      
    /**
     * Méthode pour supprimer la limite sur le paginate en fixant la nouvelle limite au max
     */
    public function get_no_limit(){
        $this->paginate = array('limit'=>$this->Activitesreelle->find('count'));
    }
        
    /**
     * Méthode permettant de constituer le filtre sur l'état des activités réelles
     * 
     * @param string $id
     * @return array('condition'=>'','filter'=>'') 
     */
    public function get_activitesreelle_etat_filter($id){
        $result = array();
        switch ($id){
            case 'tous':
                $result['condition'] = "1=1";
                $result['filter'] = "toutes les feuilles de temps";
                break;
            case 'actif':  
            case null:
                $result['condition'] = "Activitesreelle.VEROUILLE = 1";
                $result['filter'] = "toutes les feuilles de temps actives";
                break;                    
            case 'facture':
                $result['condition'] = "Activitesreelle.VEROUILLE = 0";
                $result['filter'] = "toutes les feuilles de temps facturées";
                break;                      
        }  
        return $result;
    }
    
    /**
     * Méthode permettant de constituer le filtre sur les activités réelles d'un utilisateur ou tous
     * 
     * @param string $id
     * @return array('condition'=>'','filter'=>'') 
     */    
    public function get_activitesreelle_utilisateur_filter($id,$visibility){
        $result = array();            
        if (areaIsVisible() || (isset($utilisateur) && $utilisateur==userAuth('id'))):
        $id = $id == null ? $this->params->action=='afacturer' ? 'tous' : userAuth('id') : $id;
        switch ($id){
            case 'tous':
                if($visibility == null):
                    $result['condition']='1=1';
                elseif ($visibility!=''):
                    $result['condition']="Activitesreelle.utilisateur_id IN (".$visibility.")";
                else:
                    $result['condition']="Activitesreelle.utilisateur_id =".userAuth('id');
                endif;                     
                $result['filter'] = "tous les utilisateurs";
                break;                   
            default:
                $result['condition'] = "Activitesreelle.utilisateur_id = ".$id;
                $utilisateur = $this->Activitesreelle->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>$id),'recursive'=>-1));
                $result['filter'] = $utilisateur['Utilisateur']['NOMLONG'];
                break;                      
        }  
        else:
            $result['condition'] = "Activitesreelle.utilisateur_id = ".userAuth('id');
            $utilisateur = $this->Activitesreelle->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>userAuth('id')),'recursive'=>-1));
            $result['filter'] = $utilisateur['Utilisateur']['NOMLONG'];                 
        endif; 
        return $result;            
    }
        
    /**
     * Méthode permettant de constituer le filtre sur les activités réelles pour un mois et une année
     * 
     * @param string $mois
     * @param string $annee
     * @return array('condition'=>'','filter'=>'') 
     */      
    public function get_activitesreelle_chrono_filter($mois,$annee){
        $result = array();
        $mois = $mois==null ? date('m') : $mois;
        $annee = $annee==null ? date('Y') : $annee;
        switch ($mois){
            case 'tous':
            //case null:
                $datedebut = $annee."-01-01";
                $datefin = $annee."-12-31";
                $result['condition']="Activitesreelle.DATE BETWEEN '".$datedebut."' AND '".$datefin."'";
                $result['filter'] = "pour l'année ".$annee;
                break;
            default:
                $dernierjour = date('t', mktime(0, 0, 0, $mois, 5, $annee));
                $debut = $annee."-".$mois."-01";
                $datedebut = startWeek($debut);
                $datefin = $annee."-".$mois."-".$dernierjour;
                $result['condition']="Activitesreelle.DATE BETWEEN '".$datedebut."' AND '".$datefin."'";
                $moiscal = array('01'=>"janvier",'02'=>"février",'03'=>"mars",'04'=>"avril",'05'=>"mai",'06'=>"juin",'07'=>"juillet",'08'=>"août",'09'=>"septembre",'10'=>"octobre",'11'=>"novembre",'12'=>"décembre",);
                $result['filter'] = "pour le mois de ".$moiscal[$mois]." ".$annee;
                break;                      
        }  
       return $result;             
    }
            
    /**
     * Méthode permettant de constituer le filtre sur les activités réelles étant des indisponibilités
     * 
     * @param string $id
     * @return array('condition'=>'','filter'=>'') 
     */       
    public function get_activitesreelle_indisponibilite_filter($id){
        $result = array();
        $id = $id==null ? 0 : $id;
        switch ($id){
            case '1':
                $result['condition']="Activite.projet_id!=1";
                break;
            default:
                $result['condition']="1=1";
                break;                      
        } 
        return $result;
    }
        
    /**
     * Méthode pour remonter les " denrières années qui seront visibles dans le menu
     * 
     * @return Activitesreelles
     */
    public function get_all_activitesreelle_annee(){
        $thisyear = new DateTime();
        return $this->Activitesreelle->find('all',array('fields'=>array('YEAR(Activitesreelle.DATE) AS ANNEE'),'group'=>array('YEAR(Activitesreelle.DATE)'),'conditions'=>array('YEAR(Activitesreelle.DATE) != '=>$thisyear->format('Y')),'order'=>array('YEAR(Activitesreelle.DATE)' => 'desc'),'limit'=>3));
    }
        
    /**
     * Méthode remontant tous les utilisateurs en fonction de la visibilité de l'utilisateur
     * 
     * @param date $datedebut
     * @param date $datefin
     * @param string $visibility
     * @return Utilisateurs
     */
    public function get_all_utilisateurs($datedebut,$datefin,$visibility){
        if($visibility == null):
            return $this->Activitesreelle->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG','Utilisateur.username','Utilisateur.NOM','Utilisateur.PRENOM','Utilisateur.DATEDEBUTACTIF','Utilisateur.FINMISSION'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.GESTIONABSENCES'=>1,'OR'=>array('Utilisateur.profil_id > 0','Utilisateur.profil_id = -2'),'OR' => array('AND'=>array('OR'=>array('Utilisateur.DATEDEBUTACTIF < "'.$datefin.'"','Utilisateur.DATEDEBUTACTIF IS NULL'),'Utilisateur.FINMISSION > "'.$datedebut.'"'),'Utilisateur.FINMISSION IS NULL')),'order'=>array('Utilisateur.NOMLONG' => 'asc')));
        elseif ($visibility!=''):
            return $this->Activitesreelle->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG','Utilisateur.username','Utilisateur.NOM','Utilisateur.PRENOM','Utilisateur.DATEDEBUTACTIF','Utilisateur.FINMISSION'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.id  IN ('.$visibility.')','Utilisateur.GESTIONABSENCES'=>1,'OR'=>array('Utilisateur.profil_id > 0','Utilisateur.profil_id = -2'),'OR' => array('AND'=>array('OR'=>array('Utilisateur.DATEDEBUTACTIF < "'.$datefin.'"','Utilisateur.DATEDEBUTACTIF IS NULL'),'Utilisateur.FINMISSION > "'.$datedebut.'"'),'Utilisateur.FINMISSION IS NULL')),'order'=>array('Utilisateur.NOMLONG' => 'asc')));
        else:
            return $this->Activitesreelle->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG','Utilisateur.username','Utilisateur.NOM','Utilisateur.PRENOM','Utilisateur.DATEDEBUTACTIF','Utilisateur.FINMISSION'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.id'=>userAuth('id'),'Utilisateur.GESTIONABSENCES'=>1,'OR'=>array('Utilisateur.profil_id > 0','Utilisateur.profil_id = -2'),'OR' => array('AND'=>array('OR'=>array('Utilisateur.DATEDEBUTACTIF < "'.$datefin.'"','Utilisateur.DATEDEBUTACTIF IS NULL'),'Utilisateur.FINMISSION > "'.$datedebut.'"'),'Utilisateur.FINMISSION IS NULL')),'order'=>array('Utilisateur.NOMLONG' => 'asc')));
        endif;  
    }
    
    /**
     * Méthode pour lister les utilisateurs pouvant faire la saisie d'activité
     * 
     * @param string $visibility
     * @return Utilisateurs
     */
    public function get_all_utilisateurs_for_saisie($visibility){
        if($visibility == null):
            return $this->Activitesreelle->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG','Utilisateur.username','Utilisateur.NOM','Utilisateur.PRENOM','Utilisateur.DATEDEBUTACTIF','Utilisateur.FINMISSION'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.GESTIONABSENCES'=>1,'OR'=>array('Utilisateur.profil_id > 0','Utilisateur.profil_id = -2')),'order'=>array('Utilisateur.id' => 'asc')));
        elseif ($visibility!=''):
            return $this->Activitesreelle->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG','Utilisateur.username','Utilisateur.NOM','Utilisateur.PRENOM','Utilisateur.DATEDEBUTACTIF','Utilisateur.FINMISSION'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.id  IN ('.$visibility.')','Utilisateur.GESTIONABSENCES'=>1,'OR'=>array('Utilisateur.profil_id > 0','Utilisateur.profil_id = -2')),'order'=>array('Utilisateur.id' => 'asc')));
        else:
            return $this->Activitesreelle->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG','Utilisateur.username','Utilisateur.NOM','Utilisateur.PRENOM','Utilisateur.DATEDEBUTACTIF','Utilisateur.FINMISSION'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.id'=>userAuth('id'),'Utilisateur.GESTIONABSENCES'=>1,'OR'=>array('Utilisateur.profil_id > 0','Utilisateur.profil_id = -2')),'order'=>array('Utilisateur.id' => 'asc')));
        endif;  
    }        
       
    /**
     * Méthode pour lister les activités réelles regroupées par date et utilisateur
     * 
     * @param array $conditions
     * @return array
     */
    public function get_activitesreelle_groupby_date_user($conditions){
        return $this->Activitesreelle->find('all',array('fields'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id','Utilisateur.username','Utilisateur.NOM','Utilisateur.PRENOM','COUNT(Activitesreelle.DATE) AS NBACTIVITE'),'group'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id'),'order'=>array('CONCAT(Utilisateur.NOM," ",Utilisateur.PRENOM)' => 'asc','Activitesreelle.DATE' => 'desc' ),'conditions'=>$conditions,'recursive'=>0));
    }
        
    /**
     * Méthode pour compléter le filtre sur l'état des activités réelles
     * 
     * @param string $id
     * @return array('condition'=>'','filter'=>'') 
     */
    public function get_activitesreelle_etat_a_facturer_filter($id){
        $result = array();
        switch ($id){                  
            case 'facture':
            case 'tous':                    
            case null:
                $result['condition']="Activitesreelle.VEROUILLE = 0";
                $result['filter'] = "toutes les feuilles de temps à facturer";
                break;   

        }  
        return $result;
    } 
        
    /**
     * Méthode qui permet de mettre en session les données à exporter
     * 
     * @param array $conditions
     */
    public function get_export($conditions){
        $export = $this->Activitesreelle->find('all',array('conditions'=>$conditions,'order' => array('Activitesreelle.DATE' => 'asc'),'recursive' => 0));
        $this->Session->delete('xls_export');
        $this->Session->write('xls_export',$export);             
    }
        
    /**
     * Méthode pour lister toutes les activités réelles sur la même date que l'activité réelle passée en paramétre
     * 
     * @param int $id
     * @return Activitesreelle
     */
    public function get_activitesreelle_all_for_date($id){
        $date = $this->Activitesreelle->find('first',array('fields'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id'),'conditions'=>array('Activitesreelle.id'=>$id),'recursive'=>0));
        return $this->Activitesreelle->find('all',array('conditions'=>array('Activitesreelle.utilisateur_id'=>$date['Activitesreelle']['utilisateur_id'],'Activitesreelle.DATE'=>CUSDate($date['Activitesreelle']['DATE'])),'recursive'=>0));            
    }
     
    /**
     * Méthode fixant des données pour l'activité réelle passée en paramétre
     * 
     * @param int $id
     */
    public function set_request_data_activitesreelle($id){
        if ($id != null) :
            $action = $this->Activitesreelle->Action->find('first',array('conditions'=>array('Action.id'=>$id),'recursive'=>-1));
            $this->request->data['Activitesreelle']['utilisateur_id'] = $action['Action']['utilisateur_id'];
            $this->request->data['Activitesreelle']['DATE'] = $action['Action']['DEBUT'];
            $this->request->data['Activitesreelle']['activite_id'] = $action['Action']['activite_id'];  
        endif;
    }
    
    /**
     * Méthode listant les activités réelles
     * 
     * @param string $etat
     * @param string $utilisateur
     * @param string $mois
     * @param string $annee
     * @param string $indisponibilite
     * @throws UnauthorizedException
     * @return Activitesreelles
     */
    public function index($etat=null,$utilisateur=null,$mois=null,$annee=null,$indisponibilite=null) {
        $this->set_title();
        if (isAuthorized('activitesreelles', 'index')) :
            $listusers = $this->get_visibility();                
            $getetat = $this->get_activitesreelle_etat_filter($etat);
            $getutilisateur = $this->get_activitesreelle_utilisateur_filter($utilisateur,$listusers);
            $getchrono = $this->get_activitesreelle_chrono_filter($mois, $annee);
            $getindispo = $this->get_activitesreelle_indisponibilite_filter($indisponibilite);
            $this->set('fetat',$getetat['filter']);                 
            $this->set('futilisateur',$getutilisateur['filter']);
            $this->set('fperiode',$getchrono['filter']);
            $newconditions=array($getetat['condition'],$getutilisateur['condition'],$getchrono['condition'],$getindispo['condition']);
            $ObjUtilisateurs = new UtilisateursController();
            $utilisateurs = $ObjUtilisateurs->find_all_cercle_utilisateur(userAuth('id'),'1','1');
            $icsutilisateurs = $ObjUtilisateurs->find_list_cercle_utilisateur(userAuth('id'),'0','1');
            $newftutilisateurs = $ObjUtilisateurs->find_list_cercle_utilisateur(userAuth('id'),'1','1');
            $annees = $this->get_all_activitesreelle_annee();  
            $groups = $this->get_activitesreelle_groupby_date_user($newconditions);
            $this->set(compact('utilisateurs','icsutilisateurs','annees','groups','newftutilisateurs'));
            $this->get_no_limit();
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'order' => array('Utilisateur.NOM' => 'asc','Activitesreelle.DATE' => 'desc'),'recursive'=>0));                 
            $activitesreeelles = $this->Activitesreelle->find('all',$this->paginate);
            $this->set('activitesreelles', $activitesreeelles);             
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");            
        endif;                
    }

    /**
    * Méthode listant les activités réelles à facturer
    *
    * @throws NotFoundException
    * @param string $etat
    * @param string $utilisateur
    * @param int $mois
    * @param int $annee 
    * @return Activitesreelles
    */
    public function afacturer($etat=null,$utilisateur=null,$mois=null,$annee=null) {
        $this->set_title().' à facturer';
        if (isAuthorized('activitesreelles', 'index')) :         
            $listusers = $this->get_visibility();
            $getetat = $this->get_activitesreelle_etat_a_facturer_filter($etat) ;
            $getutilisateur = $this->get_activitesreelle_utilisateur_filter($utilisateur,$listusers);
            $getchrono = $this->get_activitesreelle_chrono_filter($mois, $annee);
            $this->set('fetat',$getetat['filter']);                 
            $this->set('futilisateur',$getutilisateur['filter']);
            $this->set('fperiode',$getchrono['filter']);
            $newconditions=array("Activitesreelle.facturation_id IS NULL",$getetat['condition'],$getutilisateur['condition'],$getchrono['condition']);  
            $ObjUtilisateurs = new UtilisateursController();
            $utilisateurs = $ObjUtilisateurs->find_all_cercle_utilisateur(userAuth('id'),'1','1');
            $icsutilisateurs = $ObjUtilisateurs->find_list_cercle_utilisateur(userAuth('id'),'0','1');
            $newftutilisateurs = $ObjUtilisateurs->find_list_cercle_utilisateur(userAuth('id'),'1','1');
            $annees = $this->get_all_activitesreelle_annee();  
            $groups = $this->get_activitesreelle_groupby_date_user($newconditions);
            $this->set(compact('utilisateurs','icsutilisateurs','annees','groups','newftutilisateurs'));
            $this->get_no_limit();
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'order' => array('Utilisateur.NOM' => 'asc','Activitesreelle.DATE' => 'desc'),'recursive'=>0));                 
            $activitesreeelles = $this->Activitesreelle->find('all',$this->paginate);
            $this->set('activitesreelles', $activitesreeelles);    
            $this->get_export($newconditions);                    
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");            
        endif;                
    }

    /**
     * Méthode pour ajouter une activité réelle
     * 
     * @param string $utilisateur_id
     * @param date $date
     * @param string $action_id
     * @throws UnauthorizedException
     * @return void
     */
    public function add($utilisateur_id=null,$date=null,$action_id=null) {
        $this->set_title();
        if (isAuthorized('activitesreelles', 'add')) :          
            if ($this->request->is('post')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Activitesreelle->validate = array();
                    $this->History->goFirst();
                else:                    
                    $activitesreelles = $this->request->data['Activitesreelle'];  
                    foreach($activitesreelles as $activitesreelle):
                        if (is_array($activitesreelle) && $activitesreelle['activite_id'] != '' && $this->isUnique($activitesreelle['utilisateur_id'], $activitesreelle['activite_id'], $activitesreelle['domaine_id'],$date)):
                            $this->Activitesreelle->create();
                            if ($this->Activitesreelle->save($activitesreelle)):
                                $this->Session->setFlash(__('La feuille de temps est sauvegardée',true),'flash_success');
                                $projet = $this->Activitesreelle->Activite->find('first',array('fields'=>array('projet_id'),'conditions'=>array('id'=>$activitesreelle['activite_id']),'recursive'=>-1));
                                if ($projet['Activite']['projet_id']==1):
                                        $this->sendmailabsences($activitesreelle);
                                endif;
                            else :
                                $this->Session->setFlash(__('La feuille de temps est incorrecte, veuillez corriger la feuille de temps',true),'flash_failure');
                            endif;   
                        endif;
                    endforeach; 
                    $this->History->goFirst();
                endif;
            }
            $ObjUtilisateurs = new UtilisateursController();
            $ObjDomaines = new DomainesController();
            $ObjActivites = new ActivitesController();
            $utilisateur = $ObjUtilisateurs->find_all_cercle_utilisateur(userAuth('id'),'1','1');
            $activites = $ObjActivites->find_all_cercle_activite_and_indisponibility(userAuth('id'));
            $domaines = $ObjDomaines->get_list();
            $this->set(compact('utilisateur','activites','domaines'));
            $this->set_request_data_activitesreelle($action_id);      

        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");            
        endif;                
    }

    /**
     * Méthode qui permet de vérifier que la feuille de temps n'existe pas ou si elle existe vers quoi rediriger l'utilisateur
     */        
    public function newactivite(){
        $this->set_title();
        if (isAuthorized('activitesreelles', 'add')) :
            if ($this->request->is('post')) {
                $idft = $this->Activitesreelle->find('first',array('fields'=>array('Activitesreelle.id','Activitesreelle.VEROUILLE'),'conditions'=>array('Activitesreelle.utilisateur_id'=>$this->data['Activitesreelle']['utilisateur_id'],'Activitesreelle.DATE'=>startWeek(CUSDate($this->data['Activitesreelle']['DATE']))),'recursive'=>-1));
                if(!isset($idft['Activitesreelle']['id'])):
                    if($this->isExistAtDate($this->data['Activitesreelle']['utilisateur_id'], CUSDate($this->data['Activitesreelle']['DATE']))):
                        $id = $this->get_id_for_user_date($this->data['Activitesreelle']['utilisateur_id'], CUSDate($this->data['Activitesreelle']['DATE']));
                        $this->redirect(array('action'=>'edit',$id));
                    else:                        
                        $this->redirect(array('action' => 'add',$this->data['Activitesreelle']['utilisateur_id'],  CUSDate($this->data['Activitesreelle']['DATE'])));
                    endif;
                else :
                    if($idft['Activitesreelle']['VEROUILLE']==1):
                        $this->redirect(array('action' => 'edit',$idft['Activitesreelle']['id']));
                    else:
                        $this->Session->setFlash(__('La feuille de temps existe déjà et elle est soumise pour facturation, contacter l\'administrateur via le formulaire de contact pour lui demander de déverouiller cette feuille de temps.',true),'flash_warning');
                        $this->History->goFirst();
                    endif;
                endif;
            }
            $ObjUtilisateurs = new UtilisateursController();
            $utilisateur = $ObjUtilisateurs->find_all_cercle_utilisateur(userAuth('id'),'1','1');
            $this->set('utilisateur', $utilisateur);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");            
        endif;                           
    }
    
    /**
     * Méthode pour mettre à jour une activité réelle
     * 
     * @param int $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @return void
     */
    public function edit($id = null) {
        $this->set_title();
        if (isAuthorized('activitesreelles', 'edit')) :          
            if (!$this->Activitesreelle->exists($id)) {
                    throw new NotFoundException(__('Feuille de temps incorrecte'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Activitesreelle->validate = array();
                    $this->History->goFirst();
                else:                    
                    $activitesreelles = $this->request->data['Activitesreelle'];  
                    foreach($activitesreelles as $activitesreelle):
                        if (is_array($activitesreelle) && isset($activitesreelle['id']) && $activitesreelle['activite_id'] != '' && $this->isUnique($activitesreelle['utilisateur_id'], $activitesreelle['activite_id'], $activitesreelle['domaine_id'],$activitesreelle['DATE'])):
                            //$this->Activitesreelle->create();
                            if ($this->Activitesreelle->save($activitesreelle)):
                                $this->Session->setFlash(__('La feuille de temps est sauvegardée',true),'flash_success');
                                $projet = $this->Activitesreelle->Activite->find('first',array('fields'=>array('projet_id'),'conditions'=>array('id'=>$activitesreelle['activite_id']),'recursive'=>-1));
                                if ($projet['Activite']['projet_id']==1):
                                    $this->sendmailabsences($activitesreelle);
                                endif;
                            else :
                                $this->Session->setFlash(__('La feuille de temps est incorrecte, veuillez corriger la feuille de temps',true),'flash_failure');
                            endif; 
                        elseif (is_array($activitesreelle) && !isset($activitesreelle['id']) && $activitesreelle['activite_id'] != ''):
                            $this->Activitesreelle->create();
                            if ($this->Activitesreelle->save($activitesreelle)):
                                $this->Session->setFlash(__('La feuille de temps est sauvegardée',true),'flash_success');

                            else :
                                $this->Session->setFlash(__('La feuille de temps est incorrecte, veuillez corriger la feuille de temps',true),'flash_failure');
                            endif; 
                        endif;
                    endforeach; 
                    $this->History->goBack(2); 
               endif;
            } else {
            $ObjUtilisateurs = new UtilisateursController();
            $ObjDomaines = new DomainesController();
            $ObjActivites = new ActivitesController();
            $utilisateur = $ObjUtilisateurs->find_all_cercle_utilisateur(userAuth('id'),'1','1');
            $activites = $ObjActivites->find_all_cercle_activite_and_indisponibility(userAuth('id'));
            $domaines = $ObjDomaines->get_list();
            $activitesreelles = $this->get_activitesreelle_all_for_date($id);
            $this->set(compact('utilisateur','activites','domaines','activitesreelles'));                    
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");       
        endif;                
    }

    /**
     * Méthode supprimant une ligne renvoie vers la méthode delete
     * 
     * @param int $id
     * @return boolean => toujours true
     */    
    public function deleteline($id){
        $this->autoRender = fasle;
        $this->Activitesreelle->delete($id);
        return true;
    }
    
    /**
     * Méthode pour supprimer une activité réelle
     * 
     * @param int $id
     * @param boolean $loop
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @return void
     */
    public function delete($id = null,$loop = null) {
        $this->set_title();
        $loop = $loop==null ? false : $loop;
        if (isAuthorized('activitesreelles', 'delete')) :            
            $this->Activitesreelle->id = $id;
            if (!$this->Activitesreelle->exists()) {
                    throw new NotFoundException(__('Feuille de temps incorrecte'));
            }
            $activitesreelles = $this->Activitesreelle->find('first',array('conditions'=>array('Activitesreelle.id'=>$id)));
            if ($activitesreelles['Activitesreelle']['VEROUILLE']==1):
                if ($this->Activitesreelle->delete()) {
                    if(!$loop):
                    $this->Session->setFlash(__('Feuille de temps supprimée',true),'flash_success');
                    $this->History->goBack(1);
                    endif;
                }
            endif;
            if(!$loop):
            $this->Session->setFlash(__('Feuille de temps <b>NON</b> supprimée',true),'flash_failure');
            $this->History->goBack(1);
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");        
        endif;                
    }
        
    /**
     * Méthode retournant un objet avec une activité à zéro pour les jours fériés
     * 
     * @param date $date
     * @param array $record
     * @return array
     */
    public function clean_holydays($date,$record){
        $dateori = new DateTime(startWeek(CUSDate($date)));
        unset($record['Activitesreelle']['id']);
        unset($record['Activitesreelle']['DATE']);
        unset($record['Activitesreelle']['created']);                
        unset($record['Activitesreelle']['modified']);
        unset($record['Activitesreelle']['VEROUILLE']); 
        $record['Activitesreelle']['DATE'] = $dateori;
        $record['Activitesreelle']['VEROUILLE'] = '1';
        $tmpdate = new DateTime(startWeek(CUSDate($date)));
        for($i=0;$i<7; $i++):
            if(isFerie($tmpdate)):
                if($i==0): unset($record['Activitesreelle']['LU']); $record['Activitesreelle']['LU']=0; unset($record['Activitesreelle']['LU_TYPE']); $record['Activitesreelle']['LU_TYPE']=1; endif;
                if($i==1): unset($record['Activitesreelle']['MA']); $record['Activitesreelle']['MA']=0; unset($record['Activitesreelle']['MA_TYPE']); $record['Activitesreelle']['MA_TYPE']=1; endif;
                if($i==2): unset($record['Activitesreelle']['ME']); $record['Activitesreelle']['ME']=0; unset($record['Activitesreelle']['ME_TYPE']); $record['Activitesreelle']['ME_TYPE']=1; endif;
                if($i==3): unset($record['Activitesreelle']['JE']); $record['Activitesreelle']['JE']=0; unset($record['Activitesreelle']['JE_TYPE']); $record['Activitesreelle']['JE_TYPE']=1; endif;
                if($i==4): unset($record['Activitesreelle']['VE']); $record['Activitesreelle']['VE']=0; unset($record['Activitesreelle']['VE_TYPE']); $record['Activitesreelle']['VE_TYPE']=1; endif;
                if($i==5): unset($record['Activitesreelle']['SA']); $record['Activitesreelle']['SA']=0; unset($record['Activitesreelle']['SA_TYPE']); $record['Activitesreelle']['SA_TYPE']=1; endif;
                if($i==6): unset($record['Activitesreelle']['DI']); $record['Activitesreelle']['DI']=0; unset($record['Activitesreelle']['DI_TYPE']); $record['Activitesreelle']['DI_TYPE']=1; endif;
            endif;
            $tmpdate->add(new DateInterval('P1D'));
            unset($record['Activitesreelle']['TOTAL']); 
            $record['Activitesreelle']['TOTAL'] = $record['Activitesreelle']['LU'] + $record['Activitesreelle']['MA'] + $record['Activitesreelle']['ME'] + $record['Activitesreelle']['JE']+ $record['Activitesreelle']['VE'] + $record['Activitesreelle']['SA'] + $record['Activitesreelle']['DI'];
        endfor;
        return $record;
    }
        
    /**
     * Méthode pour dupliquer une activité réelle
     * 
     * !!! Dépréciée et remplacée par la méthode autoduplicate
     * 
     * @param int $id
     * @param date $date
     * @throws UnauthorizedException
     * @return void
     */
    public function duplicate($id = null,$date=null) {
        $this->set_title();
        if (isAuthorized('activitesreelles', 'duplicate')) :
            $this->Activitesreelle->id = $id;
            $record = $this->Activitesreelle->read();
            $this->Activitesreelle->id = $id;
            $record = $this->Activitesreelle->read();
            if($date==null):
                $date = $record['Activitesreelle']['DATE'];
                $date = new DateTime($this->Activitesreelle->CUSDate($date));
                $date->add(new DateInterval('P7D'));   
            else:
                $date = !is_object($date) ? new DateTime($date) : $date;
            endif;
            $record = $this->clean_holydays($date->format('d/m/Y'),$record);     
            if ($this->ActiviteExists($record['Activitesreelle']['utilisateur_id'], $record['Activitesreelle']['DATE'], $record['Activitesreelle']['activite_id'],$record['Activitesreelle']['domaine_id']) > 0){
                $this->Session->setFlash(__('Feuille de temps existante'),'default',array('class'=>'alert alert-info'));
                $this->redirect(array('action' => 'edit',$this->ActiviteExists($record['Activitesreelle']['utilisateur_id'], $record['Activitesreelle']['DATE'], $record['Activitesreelle']['activite_id'],$record['Activitesreelle']['domaine_id'])));
            }                
            $this->Activitesreelle->create();
            if ($this->Activitesreelle->save($record)) {
                $this->Session->setFlash(__('Feuille de temps dupliquée',true),'flash_success');
                $lastid = $this->Activitesreelle->getLastInsertID();
                $projet = $this->Activitesreelle->Activite->find('first',array('fields'=>array('projet_id'),'conditions'=>array('id'=>$lastid),'recursive'=>-1));
                if ($projet['Activite']['projet_id']==1):
                        $this->sendmailabsences($record);
                endif;                        
                    $this->redirect(array('action' => 'edit',$this->Activitesreelle->getLastInsertID()));
            } 
            $this->Session->setFlash(__('Feuille de temps <b>NON</b> dupliqué',true),'flash_failure');    
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }  
        
    /**
     * Méthode pour dupliquer une activité réelle
     * 
     * @param int $id
     * @param date $dateori
     * @throws UnauthorizedException
     * @return void
     */
    public function autoduplicate($id = null,$dateori=null) {
        $this->set_title();;
        $this->autoRender = false;
        if (isAuthorized('activitesreelles', 'update')) :
            $this->Activitesreelle->id = $id;
            $initrecord = $this->Activitesreelle->read();
            $conditions = array('Activitesreelle.utilisateur_id'=>$initrecord['Activitesreelle']['utilisateur_id'],'Activitesreelle.DATE'=>CUSDate($initrecord['Activitesreelle']['DATE']));
            $records = $this->Activitesreelle->find('all',array('conditions'=>$conditions,'recursive'=>0));
            foreach($records as $record):
                $this->Activitesreelle->id = $record['Activitesreelle']['id'];
                $record = $this->Activitesreelle->read();
                if($dateori==null):
                    $date = $record['Activitesreelle']['DATE'];
                    $date = new DateTime(CUSDate($date));
                    $date->add(new DateInterval('P7D')); 
                else:
                    $date = !is_object($dateori) ? new DateTime($dateori) : $dateori;
                endif;
                $record = $this->clean_holydays($date->format('d/m/Y'),$record);                  
                if ($this->ActiviteExists($record['Activitesreelle']['utilisateur_id'], $record['Activitesreelle']['DATE'], $record['Activitesreelle']['activite_id'], $record['Activitesreelle']['domaine_id']) > 0){
                    $this->Session->setFlash(__('Feuille de temps existante'),'default',array('class'=>'alert alert-info'));
                } else {              
                    $this->Activitesreelle->create();
                    if ($this->Activitesreelle->save($record)) {
                        $this->Session->setFlash(__('Feuille de temps dupliquée',true),'flash_success');
                        $lastid = $this->Activitesreelle->getLastInsertID();
                        $projet = $this->Activitesreelle->Activite->find('first',array('fields'=>array('projet_id'),'conditions'=>array('id'=>$lastid),'recursive'=>-1));
                        if (isset($projet['Activite']['projet_id']) && $projet['Activite']['projet_id']==1):
                                $this->sendmailabsences($record);
                        endif;                        
                    }
                }
            endforeach;
            if(count($records)==0):
                $this->Session->setFlash(__('Feuille de temps <b>NON</b> dupliquée',true),'flash_failure');
            else:
                $this->Session->setFlash(__('Feuilles de temps dupliquées et/ou existantes',true),'flash_success');  
            endif;
            $this->History->goBack(1);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");        
        endif;                
    }   

    /**
     * Méthode pour mettre à jour la facturation la feuille de temps devient facturation
     * 
     * @param int $id
     * @param boolean $loop
     * @throws UnauthorizedException
     */
    public function updatefacturation($id = null,$loop=false) {
        $this->set_title();
        if (isAuthorized('activitesreelles', 'update')) : 
            $this->Activitesreelle->id = $id;
            $record = $this->Activitesreelle->read();
            //TODO : [JLR] à voir s'il faut ajouter un test sur facturation_id != null
            if ($record['Activitesreelle']['VEROUILLE']==1):
                unset($record['Activitesreelle']['created']);                
                unset($record['Activitesreelle']['modified']);
                $record['Activitesreelle']['created'] = $this->Activitesreelle->read('created');
                $record['Activitesreelle']['modified'] = date('Y-m-d');                 
                $record['Activitesreelle']['VEROUILLE'] = 0;
                $record['Activitesreelle']['demandeabsence_id'] = null;
                $record['Activitesreelle']['facturation_id'] = null;                
                $this->Activitesreelle->create();
                if ($this->Activitesreelle->save($record)) {
                    if(!$loop):
                    $this->Session->setFlash(__('Feuille de temps mise à jour pour facturation',true),'flash_success');
                    endif;
                } else {
                if(!$loop):
                $this->Session->setFlash(__('Feuille de temps <b>NON</b> mise à jour pour facturation',true),'flash_failure'); 
                endif;  
                }
            endif;
            if(!$loop):
            $this->History->goBack(1);
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");           
        endif;                
    }   

    /**
     * Méthode qui met à jour une activité réelle pour permettre une modification suite à une erreur
     * 
     * @param int $id
     * @throws UnauthorizedException
     */
    public function errorfacturation($id = null) {
        $this->set_title();
        if (isAuthorized('activitesreelles', 'update')) : 
            $this->Activitesreelle->id = $id;
            $record = $this->Activitesreelle->read();
            unset($record['Activitesreelle']['created']);                
            unset($record['Activitesreelle']['modified']);
            $record['Activitesreelle']['created'] = $this->Activitesreelle->read('created');
            $record['Activitesreelle']['modified'] = date('Y-m-d');                 
            $record['Activitesreelle']['VEROUILLE'] = 1;
            $this->Activitesreelle->create();
            if ($this->Activitesreelle->save($record)) {
                $this->Session->setFlash(__('Feuille de temps mise à jour pour facturation',true),'flash_success');
                $this->History->notmove();
            } 
            $this->Session->setFlash(__('Feuille de temps <b>NON</b> mise à jour pour facturation',true),'flash_failure'); 
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");           
        endif;                
    }          

    /**
     * Méthode qui déverouille et qui en plus envois un mail
     * 
     * @param int $id
     * @param boolean $postback
     * @throws UnauthorizedException
     */
    public function senddeverouiller($id = null,$postback = true) {
        $this->set_title();
        if (isAuthorized('activitesreelles', 'update')) :  
            $this->Activitesreelle->id = $id;
            $record = $this->Activitesreelle->read();
            unset($record['Activitesreelle']['created']);                
            unset($record['Activitesreelle']['modified']);
            $record['Activitesreelle']['created'] = $this->Activitesreelle->read('created');
            $record['Activitesreelle']['modified'] = date('Y-m-d');                 
            $record['Activitesreelle']['VEROUILLE'] = 1;
            $this->Activitesreelle->create();
            if ($this->Activitesreelle->save($record)) {
                $this->Session->setFlash(__('Feuille de temps mise à jour pour facturation',true),'flash_success');                   
                $utilisateur = $this->Activitesreelle->Utilisateur->find('first', array('conditions'=>array('Utilisateur.id'=>$record['Activitesreelle']['utilisateur_id']),'recursive'=>0));  
                $from = Configure::read('mailapp');
                $to=$utilisateur['Utilisateur']['MAIL'];
                $objet = 'SAILL : //!\ URGENT : Saisie d\'activité refusée';
                $message = "URGENT : Bonjour ".$utilisateur['Utilisateur']['NOMLONG'].',';
                $message .= $message.'<br>
                        Votre saisie ne semble pas correcte.<br>
                        Elle est donc refusée et remise à votre disposition pour modification, aprés modification vous devrez de nouveau la soumettre pour facturation.<br><br>
                        N\'oubliez pas que vous pouvez saisir par anticipation votre activité et la valider juste avant la date limite.<br>
                        Merci de votre intervention.';
                if($to!=''):
                    try{
                    $email = new CakeEmail();
                    $email->setHeaders(array('X-Priority'=>1));
                    $email->config('smtp')
                            ->emailFormat('html')
                            ->from($from)
                            ->to($to)
                            ->subject($objet)
                            ->send($message);
                    }
                    catch(Exception $e){
                        $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_warning');
                    }  
                endif;                    
                if($postback) : $this->History->goBack(1); endif;
            } 
            $this->Session->setFlash(__('Feuille de temps <b>NON</b> mise à jour pour facturation',true),'flash_failure'); 
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");           
        endif;                
    }  
        
    /**
     * Méthode de recherche de feuille de temps
     * 
     * @param string $etat
     * @param string $utilisateur
     * @param string $mois
     * @param string $annee
     * @param string $indisponibilite
     * @param string $keywords
     * @throws UnauthorizedException
     * @return Activitesreelles
     */
    public function search($etat=null,$utilisateur=null,$mois=null,$annee=null,$indisponibilite=null,$keywords=null) {
        $this->set_title();  
        if (isAuthorized('activitesreelles', 'index')) :  
            if(isset($this->params->data['Activitesreelle']['SEARCH'])):
                $keywords = $this->params->data['Activitesreelle']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $arkeywords = explode(' ',trim($keywords));  
                $listusers = $this->get_visibility();                
                $getetat = $this->get_activitesreelle_etat_filter($etat);
                $getutilisateur = $this->get_activitesreelle_utilisateur_filter($utilisateur,$listusers);
                $getchrono = $this->get_activitesreelle_chrono_filter($mois, $annee);
                $getindispo = $this->get_activitesreelle_indisponibilite_filter($indisponibilite);
                $this->set('fetat',$getetat['filter']);                 
                $this->set('futilisateur',$getutilisateur['filter']);
                $this->set('fperiode',$getchrono['filter']);
                $newconditions=array($getetat['condition'],$getutilisateur['condition'],$getchrono['condition'],$getindispo['condition']);
                $ObjUtilisateurs = new UtilisateursController();
                $utilisateurs = $ObjUtilisateurs->find_all_cercle_utilisateur(userAuth('id'),'1','1');
                $icsutilisateurs = $ObjUtilisateurs->find_list_cercle_utilisateur(userAuth('id'),'0','1');
                $newftutilisateurs = $ObjUtilisateurs->find_list_cercle_utilisateur(userAuth('id'),'1','1');
                $annees = $this->get_all_activitesreelle_annee();  
                $this->get_no_limit();            
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Activite.NOM LIKE '%".$value."%'","Utilisateur.NOM LIKE '%".$value."%'","Utilisateur.PRENOM LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newconditions,'OR'=>$ornewconditions);
                $groups = $this->get_activitesreelle_groupby_date_user($conditions);
                $this->set(compact('utilisateurs','icsutilisateurs','annees','groups','newftutilisateurs'));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'order' => array('Utilisateur.NOM' => 'asc','Activitesreelle.DATE' => 'desc'),'recursive'=>0));                                    
                //$activitesreeelles = $this->Activitesreelle->find('all',$this->paginate);
                $this->set('activitesreelles', $this->paginate());    
           else:
               $this->redirect(array('action'=>'index',$etat,$utilisateur,$mois,$annee,$indisponibilite));
           endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");           
        endif;                
    }          

    /**
     * Méthode qui test si l'activité réelle existe déjà en base pour un utilisateur, une date, une activité et un domaine précis
     * 
     * @param int $utilisateurId
     * @param date $date
     * @param int $activite
     * @param int $domaine
     * @return int
     */
    public function ActiviteExists($utilisateurId, $date, $activite,$domaine){
        $this->Activitesreelle->recursive = 0;
        $allActivite = $this->Activitesreelle->find('first',array('conditions'=>array('Activitesreelle.utilisateur_id'=>$utilisateurId,'Activitesreelle.activite_id'=>$activite,'Activitesreelle.domaine_id'=>$domaine,'Activitesreelle.DATE'=>$this->Activitesreelle->CUSDate($this->Activitesreelle->debutsem($date)))));
        return isset($allActivite['Activitesreelle']) ? $allActivite['Activitesreelle']['id'] : 0;
    }   

    /**
     * Méthode utilisée pour remonter les indisponibilités et l'afficher dans le calendrier
     */
    public function Absences(){
        $this->set_title('Calendrier des absences');
        $mon_cercle = userAuth('entite_id')!=null ? userAuth('entite_id') : '0';
        $pass = isset($this->request->data['Activitesreelle']['pass']) ? $this->request->data['Activitesreelle']['pass'] : $mon_cercle;
        $this->Session->delete('history');
        $date = isset($this->request->data['Activitesreelle']['month']) ? $this->request->data['Activitesreelle']['month'] : date('Y-m-d');
        $annee = date('Y',strtotime($date));
        $mois = date('m',strtotime($date));
        $datedebut = $annee."-".$mois."-01";
        $dernierjour = date('t', mktime(0, 0, 0, $mois, 5, $annee));
        $datedebut = absstartWeek(new DateTime($datedebut));            
        $datefin = $annee."-".$mois."-".$dernierjour;
        $listuser = $this->get_visibility();
        switch($pass):
                case null:
                case 0:
                    $utilisateurs = $this->get_all_utilisateurs($datedebut,$datefin,$listuser);
                    if($listuser == null):
                        $condition = " AND Activitesreelle.DATE BETWEEN '".$datedebut."' AND '".$datefin."'";
                    elseif ($listuser!=''):
                        $condition = " AND Activitesreelle.utilisateur_id IN (".$listuser.") AND Activitesreelle.DATE BETWEEN '".$datedebut."' AND '".$datefin."'";
                    else:
                        $condition = " AND Activitesreelle.utilisateur_id =".userAuth('id')." AND Activitesreelle.DATE BETWEEN '".$datedebut."' AND '".$datefin."'";
                    endif;                          
                    $viewabsences = "SELECT 
                                    Activitesreelle.DATE,
                                    Activitesreelle.LU, Activitesreelle.MA, Activitesreelle.ME,  Activitesreelle.JE, Activitesreelle.VE, Activitesreelle.SA, Activitesreelle.DI,
                                    Activitesreelle.LU_TYPE, Activitesreelle.MA_TYPE, Activitesreelle.ME_TYPE,  Activitesreelle.JE_TYPE, Activitesreelle.VE_TYPE, Activitesreelle.SA_TYPE, Activitesreelle.DI_TYPE,
                                    Activitesreelle.utilisateur_id,Activitesreelle.demandeabsence_id
                                    FROM activitesreelles AS Activitesreelle 
                                    LEFT JOIN activites AS Activite ON (Activitesreelle.activite_id = Activite.id) 
                                    WHERE Activite.projet_id = 1 ".$condition." ORDER BY Activitesreelle.DATE ASC;";
                    break;
                case -1:
                   $ObjEquipes = new EquipesController();
                   $monequipe = $ObjEquipes->myTeam(userAuth('id')).userAuth('id');
                   $utilisateurs = $this->get_all_utilisateurs($datedebut,$datefin,$monequipe);
                   $viewabsences = "SELECT 
                                    Activitesreelle.DATE,
                                    Activitesreelle.LU, Activitesreelle.MA, Activitesreelle.ME,  Activitesreelle.JE, Activitesreelle.VE, Activitesreelle.SA, Activitesreelle.DI,
                                    Activitesreelle.LU_TYPE, Activitesreelle.MA_TYPE, Activitesreelle.ME_TYPE,  Activitesreelle.JE_TYPE, Activitesreelle.VE_TYPE, Activitesreelle.SA_TYPE, Activitesreelle.DI_TYPE,
                                    Activitesreelle.utilisateur_id,Activitesreelle.demandeabsence_id
                                    FROM activitesreelles AS Activitesreelle 
                                    LEFT JOIN activites AS Activite ON (Activitesreelle.activite_id = Activite.id)
                                    WHERE Activite.projet_id = 1 
                                    AND Activitesreelle.utilisateur_id IN (".$monequipe.") AND Activitesreelle.DATE BETWEEN '".$datedebut."' AND '".$datefin."'
                                    ORDER BY Activitesreelle.DATE ASC;";
                    break;
                default:
                    $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
                    $mylistuser = $ObjAssoentiteutilisateurs->json_get_all_users_entite($pass);
                    $utilisateurs = $this->get_all_utilisateurs($datedebut,$datefin,$mylistuser);
                    $viewabsences = "SELECT 
                                    Activitesreelle.DATE,
                                    Activitesreelle.LU, Activitesreelle.MA, Activitesreelle.ME,  Activitesreelle.JE, Activitesreelle.VE, Activitesreelle.SA, Activitesreelle.DI,
                                    Activitesreelle.LU_TYPE, Activitesreelle.MA_TYPE, Activitesreelle.ME_TYPE,  Activitesreelle.JE_TYPE, Activitesreelle.VE_TYPE, Activitesreelle.SA_TYPE, Activitesreelle.DI_TYPE,
                                    Activitesreelle.utilisateur_id,Activitesreelle.demandeabsence_id
                                    FROM activitesreelles AS Activitesreelle 
                                    LEFT JOIN activites AS Activite ON (Activitesreelle.activite_id = Activite.id)
                                    WHERE Activite.projet_id = 1 
                                    AND Activitesreelle.utilisateur_id IN (".$mylistuser.") AND Activitesreelle.DATE BETWEEN '".$datedebut."' AND '".$datefin."'
                                    ORDER BY Activitesreelle.DATE ASC;";
                    break;
        endswitch;
        $indisponibilites = $this->Activitesreelle->query($viewabsences);
        $ObjEntites = new EntitesController();
        $cercles = $ObjEntites->find_all_cercle_not_empty(userAuth('id'));
        $this->set(compact('indisponibilites','utilisateurs','cercles'));
    }

    /**
     * Méthode listant les responsable des activités réelle
     * 
     * @param string $visibility
     * @return Utilisateurs
     */   
    public function get_list_responsables($visibility){
        $result = null;
        if($visibility == null):
            $result = $this->Activitesreelle->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.profil_id >1','Utilisateur.profil_id =-2')),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        elseif($visibility!=''):
            $result = $this->Activitesreelle->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.ACTIF'=>1,'Utilisateur.id IN ('.$visibility.')'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        else:
            $result = $this->Activitesreelle->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.profil_id >1','Utilisateur.profil_id =-2')),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        endif;
        return $result;
    }    

    /**
     * Méthode remontant le rapport sur les activités réelles
     * 
     * @throws UnauthorizedException
     */
    public function rapport() {
       $this->set_title('Rapport des activités réelles');
        if (isAuthorized('activitesreelles', 'rapports')) :
            if ($this->request->is('post')):
                foreach ($this->request->data['Activitesreelle']['utilisateur_id'] as &$value) {
                    @$destinatairelist .= $value.',';
                }  
                $destinataire = 'Activitesreelle.utilisateur_id IN ('.substr_replace($destinatairelist ,"",-1).')';
                foreach ($this->request->data['Activitesreelle']['projet_id'] as &$value) {
                    @$projetlist .= $value.',';
                }  
                $domaine = 'Activite.projet_id IN ('.substr_replace($projetlist ,"",-1).')';
                $periode = 'Activitesreelle.DATE BETWEEN "'. startWeek(CUSDate($this->request->data['Activitesreelle']['START'])).'" AND "'.  endWeek(CUSDate($this->request->data['Activitesreelle']['END'])).'"';
                $rapportresult = $this->Activitesreelle->find('all',array('fields'=>array('MONTH(Activitesreelle.DATE) AS MONTH', 'YEAR(Activitesreelle.DATE) AS YEAR','Activite.projet_id','SUM(Activitesreelle.TOTAL) AS NB'),'conditions'=>array($destinataire,$domaine,$periode),'order'=>array('MONTH(Activitesreelle.DATE)'=>'asc','YEAR(Activitesreelle.DATE)'=>'asc'),'group'=>array('Activite.projet_id'),'recursive'=>0));
                $this->set('rapportresults',$rapportresult); //'Activite.projet_id>1',
                $activitefirstweek = $this->Activitesreelle->find('all',array('fields'=>array('Activite.id','Activite.projet_id','Activitesreelle.domaine_id', 'SUM(Activitesreelle.LU) AS LU', 'SUM(Activitesreelle.MA) AS MA', 'SUM(Activitesreelle.ME) AS ME', 'SUM(Activitesreelle.JE) AS JE', 'SUM(Activitesreelle.VE) AS VE', 'SUM(Activitesreelle.SA) AS SA', 'SUM(Activitesreelle.DI) AS DI','Activitesreelle.DATE AS DATE'),'conditions'=>array($destinataire,$domaine,'Activitesreelle.DATE'=>startWeek(CUSDate($this->request->data['Activitesreelle']['START']))),'group'=>array('Activite.projet_id','Activite.id','Activitesreelle.domaine_id'),'recursive'=>0));  
                $activitelastweek = $this->Activitesreelle->find('all',array('fields'=>array('Activite.id','Activite.projet_id','Activitesreelle.domaine_id', 'SUM(Activitesreelle.LU) AS LU', 'SUM(Activitesreelle.MA) AS MA', 'SUM(Activitesreelle.ME) AS ME', 'SUM(Activitesreelle.JE) AS JE', 'SUM(Activitesreelle.VE) AS VE', 'SUM(Activitesreelle.SA) AS SA', 'SUM(Activitesreelle.DI) AS DI','Activitesreelle.DATE AS DATE'),'conditions'=>array($destinataire,$domaine,'Activitesreelle.DATE'=>startWeek(CUSDate($this->request->data['Activitesreelle']['END']))),'group'=>array('Activite.projet_id','Activite.id','Activitesreelle.domaine_id'),'recursive'=>0));  
                $entrop = array_merge($this->getEntropFirst($activitefirstweek),$this->getEntropLast($activitelastweek));
                $byprojet = $this->array_sum_merge_by_projet($entrop);
                $byprojetdomaine = $this->array_sum_merge_by_projet_domaine($entrop);
                $byprojetactivite = $this->array_sum_merge_by_projet_activite($entrop);
                $this->set('byprojet',$byprojet); 
                $this->set('byprojetdomaine',$byprojetdomaine);
                $this->set('byprojetactivite',$byprojetactivite);
                $chartresult = $this->Activitesreelle->find('all',array('fields'=>array('Activite.projet_id','SUM(Activitesreelle.TOTAL) AS NB'),'conditions'=>array($destinataire,$domaine,$periode),'order'=>array('Activite.projet_id'=>'asc'),'group'=>array('Activite.projet_id'),'recursive'=>0));
                $this->set('chartresults',$chartresult);                    
                $detailrapportresult = $this->Activitesreelle->find('all',array('fields'=>array('MONTH(Activitesreelle.DATE) AS MONTH', 'YEAR(Activitesreelle.DATE) AS YEAR','Activite.NOM','Activite.id','Activite.projet_id','SUM(Activitesreelle.TOTAL) AS NB'),'conditions'=>array($destinataire,$domaine,$periode),'order'=>array('MONTH(Activitesreelle.DATE)'=>'asc','YEAR(Activitesreelle.DATE)'=>'asc'),'group'=>array('Activite.projet_id','Activite.NOM'),'recursive'=>0));
                $this->set('detailrapportresults',$detailrapportresult);
                $rapportdomainesresult = $this->Activitesreelle->find('all',array('fields'=>array('MONTH(Activitesreelle.DATE) AS MONTH', 'YEAR(Activitesreelle.DATE) AS YEAR','Activite.projet_id','Activitesreelle.domaine_id','SUM(Activitesreelle.TOTAL) AS NB','Domaine.NOM'),'conditions'=>array($destinataire,$domaine,$periode),'order'=>array('MONTH(Activitesreelle.DATE)'=>'asc','YEAR(Activitesreelle.DATE)'=>'asc'),'group'=>array('Activite.projet_id','Activitesreelle.domaine_id'),'recursive'=>0));
                $this->set('rapportdomainesresults',$rapportdomainesresult);                    
                $this->Session->delete('rapportresults');  
                $this->Session->delete('detailrapportresults');     
                $this->Session->delete('rapportdomainesresults');                      
                $this->Session->write('rapportdomainesresults',$rapportdomainesresult);                    
                $this->Session->write('rapportresults',$rapportresult);
                $this->Session->write('detailrapportresults',$detailrapportresult);
            endif;
            $alldestinataire = array('tous'=>'Tous les responsables');
            $listeagentsavecsaisie = $this->Activitesreelle->find('all',array('fields'=>array('Activitesreelle.utilisateur_id'),'group'=>'Activitesreelle.utilisateur_id','order'=>array('Activitesreelle.utilisateur_id'=>'asc'),'recursive'=>0));
            $listein = '';
            foreach($listeagentsavecsaisie as $agent):
                $listein .= $agent['Activitesreelle']['utilisateur_id'].',';
            endforeach;
            $listuser = $this->get_visibility();
            $destinataires = $this->get_list_responsables($listuser);  
            $ObjAssoprojetentites = new AssoprojetentitesController();	
            $ObjProjets = new ProjetsController();	
            $listprojets = $ObjAssoprojetentites->json_get_all_projets(userAuth('id'));
            $domaines = $ObjProjets->get_list_id_nom_projets($listprojets);   
            $this->set(compact('destinataires','domaines')); 
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    } 

    /**
     * Méthode qui retourne les saisies en trop pour la première semaine retire les jours du mois précédent 
     * 
     * @param type $activitefirstweek
     * @return array
     */
    public function getEntropFirst($activitefirstweek=null){
        $enmoins1 = array();
        $i=0;
        foreach($activitefirstweek as $firstweek):
            $datetime1 = new DateTime(CUSDate($firstweek['Activitesreelle']['DATE']));
            $datetime2 = new DateTime(CUSDate($this->request->data['Activitesreelle']['START']));
            $interval = $datetime2->diff($datetime1); 
            $entropfirst = $interval->format('%a');
            switch ($entropfirst):
                case 1:
                    $enmoins1[$i]['date']=$datetime1;
                    $enmoins1[$i]['mois']=$datetime1->format('m');                        
                    $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                    $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];
                    $enmoins1[$i]['domaine_id']=$firstweek['Activitesreelle']['domaine_id'];
                    $enmoins1[$i]['aretirer']=$firstweek[0]['LU'];  
                    $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Activitesreelle']['domaine_id'];                       
                    break;
                case 2:
                    $enmoins1[$i]['date']=$datetime1;
                    $enmoins1[$i]['mois']=$datetime1->format('m');                        
                    $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                    $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];
                    $enmoins1[$i]['domaine_id']=$firstweek['Activitesreelle']['domaine_id'];
                    $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA'];
                    $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Activitesreelle']['domaine_id'];                        
                    break;
                case 3:
                    $enmoins1[$i]['date']=$datetime1;
                    $enmoins1[$i]['mois']=$datetime1->format('m');                        
                    $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                    $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];
                    $enmoins1[$i]['domaine_id']=$firstweek['Activitesreelle']['domaine_id'];                        
                    $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA']+$firstweek[0]['ME'];
                    $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Activitesreelle']['domaine_id'];                        
                    break;
                case 4:
                    $enmoins1[$i]['date']=$datetime1;
                    $enmoins1[$i]['mois']=$datetime1->format('m');                        
                    $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                    $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];                        
                    $enmoins1[$i]['domaine_id']=$firstweek['Activitesreelle']['domaine_id'];                       
                    $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA']+$firstweek[0]['ME']+$firstweek[0]['JE'];
                    $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Activitesreelle']['domaine_id'];                         
                    break;
                case 5:
                    $enmoins1[$i]['date']=$datetime1;
                    $enmoins1[$i]['mois']=$datetime1->format('m');                        
                    $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                    $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];                        
                    $enmoins1[$i]['domaine_id']=$firstweek['Activitesreelle']['domaine_id'];                        
                    $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA']+$firstweek[0]['ME']+$firstweek[0]['JE']+$firstweek[0]['VE'];
                    $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Activitesreelle']['domaine_id'];                         
                    break;
                case 6:
                    $enmoins1[$i]['date']=$datetime1;
                    $enmoins1[$i]['mois']=$datetime1->format('m');
                    $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                    $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];                        
                    $enmoins1[$i]['domaine_id']=$firstweek['Activitesreelle']['domaine_id'];                        
                    $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA']+$firstweek[0]['ME']+$firstweek[0]['JE']+$firstweek[0]['VE']+$firstweek[0]['SA'];
                    $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Activitesreelle']['domaine_id'];                       
                    break;
            endswitch;
            $i++;
        endforeach;                           
        return $enmoins1;
    }

    /**
     * Méthode qui retourne les saisies en trop pour la dernière semaine retire les jours du mois suivant 
     * 
     * @param type $activitefirstweek
     * @return array
     */    
    public function getEntropLast($activitelastweek=null){
        $enmoins2 = array();
        $i=0;            
        foreach($activitelastweek as $lastweek):
            $datetime1 = new DateTime(CUSDate($lastweek['Activitesreelle']['DATE']));
            $datetime2 = new DateTime(CUSDate($this->request->data['Activitesreelle']['END']));
            $interval = $datetime1->diff($datetime2); 
            $entropfirst = $interval->format('%a');
            switch ($entropfirst):
                case 1:
                    $enmoins2[$i]['date']=$datetime1;
                    $enmoins2[$i]['mois']=$datetime1->format('m');                        
                    $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                    $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                    $enmoins2[$i]['domaine_id']=$lastweek['Activitesreelle']['domaine_id'];                        
                    $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA']+$lastweek[0]['VE']+$lastweek[0]['JE']+$lastweek[0]['ME'];
                    $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Activitesreelle']['domaine_id'];                      
                    break;
                case 2:
                    $enmoins2[$i]['date']=$datetime1;
                    $enmoins2[$i]['mois']=$datetime1->format('m');                        
                    $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                    $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                    $enmoins2[$i]['domaine_id']=$lastweek['Activitesreelle']['domaine_id'];                           
                    $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA']+$lastweek[0]['VE']+$lastweek[0]['JE'];
                    $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Activitesreelle']['domaine_id'];                         
                    break;
                case 3:
                    $enmoins2[$i]['date']=$datetime1;
                    $enmoins2[$i]['mois']=$datetime1->format('m');                        
                    $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                    $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                    $enmoins2[$i]['domaine_id']=$lastweek['Activitesreelle']['domaine_id'];                           
                    $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA']+$lastweek[0]['VE'];
                    $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Activitesreelle']['domaine_id'];                          
                    break;
                case 0:
                    $enmoins2[$i]['date']=$datetime1;
                    $enmoins2[$i]['mois']=$datetime1->format('m');                        
                    $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                    $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                    $enmoins2[$i]['domaine_id']=$lastweek['Activitesreelle']['domaine_id'];                           
                    $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA']+$lastweek[0]['VE']+$lastweek[0]['JE']+$lastweek[0]['ME']+$lastweek[0]['MA'];
                    $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Activitesreelle']['domaine_id'];                         
                    break;
                case 5:
                    $enmoins2[$i]['date']=$datetime1;
                    $enmoins2[$i]['mois']=$datetime1->format('m');                        
                    $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                    $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                    $enmoins2[$i]['domaine_id']=$lastweek['Activitesreelle']['domaine_id'];                           
                    $enmoins2[$i]['aretirer']=$lastweek[0]['DI'];
                    $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Activitesreelle']['domaine_id'];                         
                    break;
                case 4:
                    $enmoins2[$i]['date']=$datetime1;
                    $enmoins2[$i]['mois']=$datetime1->format('m');                        
                    $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                    $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                    $enmoins2[$i]['domaine_id']=$lastweek['Activitesreelle']['domaine_id'];                           
                    $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA'];
                    $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Activitesreelle']['domaine_id'];                        
                    break;
            endswitch;
            $i++;
        endforeach;                         
        return $enmoins2;
    }

    /**
     * Méthode pour sommer toutes les données sur la clé projet-activite-domaine
     * 
     * @param array $array
     * @return array
     */
    public function array_sum_merge($array){
        $sortedArray = array();
        $assignedValues = array();
        foreach ($array as $arrayItem)
        {
            $ukey = $arrayItem['projet_id'].$arrayItem['activite_id'].$arrayItem['domaine_id'];
            if (!isset($sortedArray[$ukey])){
                $sortedArray[$ukey] = array();
            }
            $sortedArray[$ukey][] = $arrayItem['aretirer'];
            if (!isset($assignedValues[$ukey])){
                $assignedValues[$ukey] = array(
                    'projet_id' => $arrayItem['projet_id'],
                    'activite_id' => $arrayItem['activite_id'],
                    'domaine_id' => $arrayItem['domaine_id'],
                    'mois' => $arrayItem['mois'],
                    'date' => $arrayItem['date']
                );
            }
        }
        $result = array();
        $i=0;
        foreach ($sortedArray as $ukey => $arrayItem)
        {
           $sum = array_sum($arrayItem);

           $result[$i] = $assignedValues[$ukey];
           $result[$i]['sum'] =$sum;
           $i++;
        }    
        return $result;
    }

    /**
     * Méthode pour additionner les données du même projet
     * 
     * @param array $array
     * @return array
     */
    public function array_sum_merge_by_projet($array){
        $sortedArray = array();
        $assignedValues = array();
        foreach ($array as $arrayItem)
        {
            $ukey = $arrayItem['projet_id'];
            if (!isset($sortedArray[$ukey])){
                $sortedArray[$ukey] = array();
            }
            $sortedArray[$ukey][] = $arrayItem['aretirer'];
            if (!isset($assignedValues[$ukey])){
                $assignedValues[$ukey] = array(
                    'projet_id' => $arrayItem['projet_id'],
                    'mois' => $arrayItem['mois'],
                    'date' => $arrayItem['date']
                );
            }
        }
        $result = array();
        $i=0;
        foreach ($sortedArray as $ukey => $arrayItem)
        {
           $sum = array_sum($arrayItem);

           $result[$i] = $assignedValues[$ukey];
           $result[$i]['sum'] =$sum;
           $i++;
        }    
        return $result;
    }        

    /**
     * Méthode pour additionner les données par projet et domaine
     * 
     * @param array $array
     * @return array
     */
    public function array_sum_merge_by_projet_domaine($array){
        $sortedArray = array();
        $assignedValues = array();
        foreach ($array as $arrayItem)
        {
            $ukey = $arrayItem['projet_id'].$arrayItem['domaine_id'];
            if (!isset($sortedArray[$ukey])){
                $sortedArray[$ukey] = array();
            }
            $sortedArray[$ukey][] = $arrayItem['aretirer'];
            if (!isset($assignedValues[$ukey])){
                $assignedValues[$ukey] = array(
                    'projet_id' => $arrayItem['projet_id'],
                    'domaine_id' => $arrayItem['domaine_id'],
                    'mois' => $arrayItem['mois'],
                    'date' => $arrayItem['date']
                );
            }
        }
        $result = array();
        $i=0;
        foreach ($sortedArray as $ukey => $arrayItem)
        {
           $sum = array_sum($arrayItem);

           $result[$i] = $assignedValues[$ukey];
           $result[$i]['sum'] =$sum;
           $i++;
        }    
        return $result;
    } 

    /**
     * Méthode pour additionner les données par projet activité
     * 
     * @param array $array
     * @return array
     */
    public function array_sum_merge_by_projet_activite($array){
        $sortedArray = array();
        $assignedValues = array();
        foreach ($array as $arrayItem)
        {
            $ukey = $arrayItem['projet_id'].$arrayItem['activite_id'];
            if (!isset($sortedArray[$ukey])){
                $sortedArray[$ukey] = array();
            }
            $sortedArray[$ukey][] = $arrayItem['aretirer'];
            if (!isset($assignedValues[$ukey])){
                $assignedValues[$ukey] = array(
                    'projet_id' => $arrayItem['projet_id'],
                    'activite_id' => $arrayItem['activite_id'],
                    'mois' => $arrayItem['mois'],
                    'date' => $arrayItem['date']
                );
            }
        }
        $result = array();
        $i=0;
        foreach ($sortedArray as $ukey => $arrayItem)
        {
           $sum = array_sum($arrayItem);

           $result[$i] = $assignedValues[$ukey];
           $result[$i]['sum'] =$sum;
           $i++;
        }    
        return $result;
    } 

    /**
     * Méthode pour exporter les données du rapport au format Word
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
     * Méthode faisant la facturation de plusieurs feuille de temps (activités groupées)
     * 
     * @return string
     */
    public function facturer(){
        $this->autoRender = false;
        $ids = explode('-', $this->request->data('all_ids'));
        if(count($ids)>0 && $ids[0]!=""):
            foreach($ids as $id):
                $newFacturation = array();
                $record = $this->Activitesreelle->find('first',array('conditions'=>array('Activitesreelle.id'=>$id)));                  
                $newFacturation['Facturation']['activitesreelle_id']=$id;
                $newFacturation['Facturation']['utilisateur_id']=$record['Activitesreelle']['utilisateur_id'];
                $newFacturation['Facturation']['activite_id']=$record['Activitesreelle']['activite_id'];
                $newFacturation['Facturation']['VERSION']=0;                    
                $newFacturation['Facturation']['NUMEROFTGALILEI']="0000000000";
                $newFacturation['Facturation']['DATE']=$record['Activitesreelle']['DATE'];
                $newFacturation['Facturation']['LU']=$record['Activitesreelle']['LU'];
                $newFacturation['Facturation']['MA']=$record['Activitesreelle']['MA'];
                $newFacturation['Facturation']['ME']=$record['Activitesreelle']['ME'];
                $newFacturation['Facturation']['JE']=$record['Activitesreelle']['JE'];
                $newFacturation['Facturation']['VE']=$record['Activitesreelle']['VE'];
                $newFacturation['Facturation']['SA']=$record['Activitesreelle']['SA'];
                $newFacturation['Facturation']['DI']=$record['Activitesreelle']['DI'];
                $newFacturation['Facturation']['TOTAL']=$record['Activitesreelle']['TOTAL'];
                $newFacturation['Facturation']['FRAIS']=$record['Activitesreelle']['FRAIS'];
                $this->Activitesreelle->Facturation->create();
                if($this->Activitesreelle->Facturation->save($newFacturation)){
                    $lastInsert = $this->Activitesreelle->Facturation->getLastInsertID();
                    $this->Activitesreelle->id = $id;
                    $this->Activitesreelle->saveField('facturation_id', $lastInsert);
                }
            endforeach;
            echo $this->Session->setFlash(__('Feuilles de temps facturées',true),'flash_success');
        else:
            echo $this->Session->setFlash(__('Aucune feuilles de temps sélectionnées',true),'flash_failure');
        endif;
        return $this->request->data('all_ids');
    }

    /**
     * Méthode pour rejeter en masse des feuilles de temps soumises pour facturation
     * 
     * @return string
     */
    public function rejeter(){
        $this->autoRender = false;
        $ids = explode ('-', $this->request->data('all_ids'));
        if(count($ids)>0 && $ids[0]!=""):            
            foreach($ids as $id):
                $this->Activitesreelle->id = $id;
                $this->Activitesreelle->saveField('VEROUILLE', 1);                    
            endforeach;
            echo $this->Session->setFlash(__('Feuilles de temps rejetées',true),'flash_success');
        else:
            echo $this->Session->setFlash(__('Aucune feuilles de temps sélectionnées',true),'flash_failure');                
        endif;
        return $this->request->data('all_ids');
    }  

    /**
     * Méthode pour rejeter en masse des feuilles de temps soumises pour facturation avec envois de mail
     * 
     * @return string
     */    
    public function sendrejeter(){
        $this->autoRender = false;
        $ids = explode ('-', $this->request->data('all_ids'));
        if(count($ids)>0 && $ids[0]!=""):            
            foreach($ids as $id):
                $this->senddeverouiller($id,false);                  
            endforeach;
            echo $this->Session->setFlash(__('Feuilles de temps rejetées',true),'flash_success');
        else:
            echo $this->Session->setFlash(__('Aucune feuilles de temps sélectionnées',true),'flash_failure');                
        endif;
        return $this->request->data('all_ids');
    }          

    /**
     * Méthode pour déverouiller une activités réelles
     * 
     * @param int $id
     */
    public function deverouiller($id){
        //TODO récupérer l'ensemble des id ayant le même utilisateur, version, date
        $tmp = $this->Activitesreelle->Facturation->find('first',array('conditions'=>array('Facturation.activitesreelle_id'=>$id),'recursive'=>0));
        $objs = $this->Activitesreelle->Facturation->find('all',array('conditions'=>array('Facturation.utilisateur_id'=>$tmp['Facturation']['utilisateur_id'],'Facturation.DATE'=>  CUSDate($tmp['Facturation']['DATE']),'Facturation.VERSION'=>$tmp['Facturation']['VERSION']),'recursive'=>0));
        foreach($objs as $obj):
            $this->Activitesreelle->id = $obj['Activitesreelle']['id'];
            $this->Activitesreelle->saveField('VEROUILLE', 1);        
            $this->Activitesreelle->saveField('facturation_id', null);   
            //$facturation = $this->Activitesreelle->Facturation->find('first',array('conditions'=>array('Facturation.activitesreelle_id'=>$obj['Activitesreelle']['id'],'Facturation.VISIBLE'=>0),'recursive'=>-1));
            $this->Activitesreelle->Facturation->id = $obj['Facturation']['id'];
            $this->Activitesreelle->Facturation->saveField('VISIBLE', 1);
        endforeach;
        echo $this->Session->setFlash(__('Feuille de temps déverouillée',true),'flash_success');
        $this->History->goBack(1);
    } 

    /**
     * Méthode pour générer l'export au format Excel
     */
    function export_xls() {
            $data = $this->Session->read('xls_export');
            $this->Session->delete('xls_export');                
            $this->set('rows',$data);
            $this->render('export_xls','export_xls');
    }    

    /**
     * Méthode pour remonter la saisie d'un utilisateur sur le mois courant affiché sur la page d'accueil
     * 
     * @return Activitesreelles
     */
    public function homeNBActivitesReelles(){
        $lastMonthDay = date('Y-m-').date('t');
        $nbactions = $this->Activitesreelle->find('all',array('fields'=>array('SUM(TOTAL) AS TOTAL','DATE','VEROUILLE','id'),'conditions'=>array('utilisateur_id'=>userAuth('id'),"DATE BETWEEN '".date('Y-m-01')."' AND '".$lastMonthDay."'"),'group'=>'DATE','recursive'=>-1));
        return $nbactions;
    }    

    /**
     * Méthode testant l'unicité d'une feuille de temps ayant le même utilisateur,activité,domaine et date
     * 
     * @param int $utilisateur_id
     * @param int $activite_id
     * @param int $domaine_id
     * @param date $date
     * @return boolean
     */
    public function isUnique($utilisateur_id,$activite_id,$domaine_id,$date){
        $result = $this->Activitesreelle->find('count',array('conditions'=>array('Activitesreelle.utilisateur_id'=>$utilisateur_id,'Activitesreelle.activite_id'=>$activite_id,'Activitesreelle.domaine_id'=>$domaine_id,'Activitesreelle.DATE'=>$date)));
        return $result > 0 ? false : true;
    }

    /**
     * Méthode vérifiant si une activité réelle existe pour un utilisateur à une date
     * 
     * @param int $utilisateur_id
     * @param date $date
     * @return boolean
     */
    public function isExistAtDate($utilisateur_id,$date){
        $result = $this->Activitesreelle->find('all',array('conditions'=>array('Activitesreelle.utilisateur_id'=>$utilisateur_id,'Activitesreelle.DATE'=>$date),'recursive'=>-1));
        return count($result)>0 ? $result : false;
    }

    /**
     * Méthode retournant la première activité réelle pour un utiloisateur et une date
     * 
     * @param int $utilisateur_id
     * @param date $date
     * @return Activitesreelles
     */
    public function get_id_for_user_date($utilisateur_id, $date){
        $result = $this->Activitesreelle->find('first',array('conditions'=>array('Activitesreelle.utilisateur_id'=>$utilisateur_id,'Activitesreelle.DATE'=>$date),'recursive'=>-1));
        return $result['Activitesreelle']['id'];
    }

    /**
     * Méthode vérifiant qu'un activité réelle existe pour un utilisateur, une activité et une date
     * 
     * @param int $utilisateur_id
     * @param int $activite_id
     * @param date $date
     * @return boolean
     */
    public function isExist($utilisateur_id,$activite_id,$date){
        $result = $this->Activitesreelle->find('all',array('conditions'=>array('Activitesreelle.utilisateur_id'=>$utilisateur_id,'Activitesreelle.activite_id'=>$activite_id,'Activitesreelle.DATE'=>$date),'recursive'=>-1));
        return count($result)>0 ? $result : false;
    }

    /**
     * Méthode pour soumettre en masse les activités sélectionnées (action groupée)
     * 
     * @return string
     */
    public function soumettre(){
        $this->autoRender = false;
        $ids = explode('-', $this->request->data('all_ids'));
        if(count($ids)>0 && $ids[0]!=""):
            foreach($ids as $id):
                $this->updatefacturation($id,true);
            endforeach; 
            sleep(3);
            echo $this->Session->setFlash(__('Feuilles de temps soumises',true),'flash_success');
        else:
            echo $this->Session->setFlash(__('Aucune feuilles de temps sélectionnées',true),'flash_failure');                
        endif;
        return $this->request->data('all_ids');
    }

    /**
     * Méthode pour supprimer en masse des activités réelles (action groupée)
     * 
     * @return string
     */
    public function deleteall(){
        $this->autoRender = false;
        $ids = explode('-', $this->request->data('all_ids'));
        if(count($ids)>0 && $ids[0]!=""):
            foreach($ids as $id):
                $this->delete($id,true);
            endforeach;  
            echo $this->Session->setFlash(__('Lignes de la feuilles de temps supprimées',true),'flash_success');
        else:
            echo $this->Session->setFlash(__('Aucune ligne de la feuille de temps sélectionnée',true),'flash_failure');                
        endif;
        return $this->request->data('all_ids');
    }     

    /**
     * Méthode pour importer et créer des activités réelles depuis un fichier ICS du portail RH des absences
     * 
     * @param int $utilisateur_id
     * @param int $activite_id
     * @param date $date
     * @param string $day
     * @param boolean $type
     * @param int $duree
     * @param int $id_demande
     * @param date $datereelle
     */
    public function icsImport($utilisateur_id,$activite_id,$date,$day,$type=null,$duree=null,$id_demande=null,$datereelle=null){
        $datetime = !is_object($date) ? new DateTime($date) : $date;
        if($datereelle != null):
            $datereelle = new DateTime($datereelle);
        else:
        switch($day):
            case 'LU':
                $datereelle = $datetime;
                break;
            case 'MA':
                $datereelle = $datetime->add(new DateInterval('P1D'));
                break;
            case 'ME':
                $datereelle = $datetime->add(new DateInterval('P2D'));
                break;
            case 'JE':
                $datereelle = $datetime->add(new DateInterval('P3D'));
                break;
            case 'VE':
                $datereelle = $datetime->add(new DateInterval('P4D'));
                break;
            case 'SA':
                $datereelle = $datetime->add(new DateInterval('P5D'));
                break;
            case 'DI':
                $datereelle = $datetime->add(new DateInterval('P6D'));
                break;                
        endswitch;
        endif;
        $type = $type==null ? 1 : isFerie($datereelle) ? 1 :$type;
        $duree = $duree==null ? 0 : isFerie($datereelle) ? 0 : $duree;           
        $activitesreelle = $this->isExist($utilisateur_id, $activite_id, $date);
        $record['Activitesreelle']['TOTAL']=0;
        $record['Activitesreelle']['utilisateur_id'] = $utilisateur_id;
        $record['Activitesreelle']['activite_id'] = $activite_id;
        $record['Activitesreelle']['DATE'] = CFRDate($date);
        $record['Activitesreelle']['demandeabsence_id'] = $id_demande;
        $record['Activitesreelle']['created'] = date('Y-m-d'); 
        $record['Activitesreelle']['modified'] = date('Y-m-d'); 
        if ($activitesreelle!=false):
            $this->Activitesreelle->id=$activitesreelle[0]['Activitesreelle']['id'];
            $record['Activitesreelle']['TOTAL']= isset ($activitesreelle[0]['Activitesreelle']['TOTAL']) && $activitesreelle[0]['Activitesreelle']['TOTAL'] != null ? $activitesreelle[0]['Activitesreelle']['TOTAL'] : 0;
            $record['Activitesreelle']['created'] = $activitesreelle[0]['Activitesreelle']['created'];
        else:
            $this->Activitesreelle->create();
        endif;
        switch($day):
            case 'LU':
                $record['Activitesreelle']['LU']=$duree;
                $record['Activitesreelle']['LU_TYPE']=$type;
                $this->Activitesreelle->save($record);
                break;
            case 'MA':
                $record['Activitesreelle']['MA']=$duree;
                $record['Activitesreelle']['MA_TYPE']=$type;
                $this->Activitesreelle->save($record);
                break;
            case 'ME':                
                $record['Activitesreelle']['ME']=$duree;
                $record['Activitesreelle']['ME_TYPE']=$type;
                $this->Activitesreelle->save($record);
                break;
            case 'JE':
                $record['Activitesreelle']['JE']=$duree;
                $record['Activitesreelle']['JE_TYPE']=$type;
                $this->Activitesreelle->save($record);
                break;
            case 'VE':
                $record['Activitesreelle']['VE']=$duree;
                $record['Activitesreelle']['VE_TYPE']=$type;
                $this->Activitesreelle->save($record);
                break;           
        endswitch;
        $total = $this->Activitesreelle->find('first',array('fields'=>array('(LU+MA+ME+JE+VE) AS TOTAL','DATE','VEROUILLE'),'conditions'=>array('Activitesreelle.utilisateur_id'=>$utilisateur_id,'Activitesreelle.activite_id'=>$activite_id,'Activitesreelle.DATE'=>$date),'recursive'=>-1));
        $record['Activitesreelle']['TOTAL'] = !isset($total[0]['TOTAL']) || $total[0]['TOTAL']==null ? 0 : $total[0]['TOTAL'];
        $this->Activitesreelle->save($record);
    }

    /**
     * Méthode qui ajoute une feuille de temps suite à une demande d'absence de prestataire
     * 
     * @param int $utilisateur_id
     * @param int $activite_id
     * @param date $date
     * @param string $day
     * @param boolean $type
     * @param int $duree
     * @param int $id_demande
     * @param date $datereelle
     */
    public function addDemandes($utilisateur_id,$activite_id,$date,$day,$type=null,$duree=null,$id_demande=null,$datereelle=null){
        $datetime = new DateTime($date);
        if($datereelle != null):
            $datereelle = new DateTime($datereelle);
        else:
        switch($day):
            case 'LU':
                $datereelle = $datetime;
                break;
            case 'MA':
                $datereelle = $datetime->add('P1D');
                break;
            case 'ME':
                $datereelle = $datetime->add('P2D');
                break;
            case 'JE':
                $datereelle = $datetime->add('P3D');
                break;
            case 'VE':
                $datereelle = $datetime->add('P4D');
                break;
            case 'SA':
                $datereelle = $datetime->add('P5D');
                break;
            case 'DI':
                $datereelle = $datetime->add('P6D');
                break;                
        endswitch;
        endif;
        $type = $type==null ? 1 : isFerie($datereelle) ? 1 :$type;
        $duree = $duree==null ? 0 : isFerie($datereelle) ? 0 : $duree;           
        $record['Activitesreelle']['TOTAL']=0;
        $record['Activitesreelle']['utilisateur_id'] = $utilisateur_id;
        $record['Activitesreelle']['activite_id'] = $activite_id;
        $record['Activitesreelle']['DATE'] = CFRDate($date);
        $record['Activitesreelle']['demandeabsence_id'] = $id_demande;
        $record['Activitesreelle']['created'] = date('Y-m-d'); 
        $record['Activitesreelle']['modified'] = date('Y-m-d'); 
        $this->Activitesreelle->create();
        switch($day):
            case 'LU':
                $record['Activitesreelle']['LU']=$duree;
                $record['Activitesreelle']['LU_TYPE']=$type;
                $this->Activitesreelle->save($record);
                break;
            case 'MA':
                $record['Activitesreelle']['MA']=$duree;
                $record['Activitesreelle']['MA_TYPE']=$type;
                $this->Activitesreelle->save($record);
                break;
            case 'ME':                
                $record['Activitesreelle']['ME']=$duree;
                $record['Activitesreelle']['ME_TYPE']=$type;
                $this->Activitesreelle->save($record);
                break;
            case 'JE':
                $record['Activitesreelle']['JE']=$duree;
                $record['Activitesreelle']['JE_TYPE']=$type;
                $this->Activitesreelle->save($record);
                break;
            case 'VE':
                $record['Activitesreelle']['VE']=$duree;
                $record['Activitesreelle']['VE_TYPE']=$type;
                $this->Activitesreelle->save($record);
                break;            
        endswitch;
        $total = $this->Activitesreelle->find('first',array('fields'=>array('(LU+MA+ME+JE+VE) AS TOTAL','DATE','VEROUILLE'),'conditions'=>array('Activitesreelle.utilisateur_id'=>$utilisateur_id,'Activitesreelle.activite_id'=>$activite_id,'Activitesreelle.DATE'=>$date),'recursive'=>-1));
        $record['Activitesreelle']['TOTAL'] = !isset($total[0]['TOTAL']) || $total[0]['TOTAL']==null ? 0 : $total[0]['TOTAL'];
        $this->Activitesreelle->save($record);
    }        

    /**
     * Méthode qui envois un mail si l'activité réelle est une indisponibilité pour cela l'agent doit être dans une équipe au minimum
     * 
     * @param Activitesreelle $activitesreelle
     */
    public function sendmailabsences($activitesreelle){
        $activite = $this->Activitesreelle->Activite->find('first',array('conditions'=>array('Activite.id'=>$activitesreelle['activite_id'])));
        $valideurs = $this->Activitesreelle->Utilisateur->Equipe->find('all',array('conditions'=>array('Equipe.agent'=>userAuth('id'))));
        $mailto = array();
        foreach($valideurs as $valideur):
            $mailto[]=isset($valideur['Utilisateur']['MAIL']) ? $valideur['Utilisateur']['MAIL'] : '';
        endforeach;
        $to=$mailto;
        $from = Configure::read('mailapp');
        $objet = 'SAILL : Demande d\'absences ['.$activite['Activite']['NOM'].']';
        $message = "Demande d'absences pour la semaine débutant le ".CFRDate($activitesreelle['DATE']).
                '<ul>
                <li>LU :'.$activitesreelle['LU'].'</li>
                <li>MA :'.$activitesreelle['MA'].'</li>
                <li>ME :'.$activitesreelle['ME'].'</li>
                <li>JE :'.$activitesreelle['JE'].'</li>
                <li>VE :'.$activitesreelle['VE'].'</li>
                <li>SA :'.$activitesreelle['SA'].'</li>
                <li>DI :'.$activitesreelle['DI'].'</li>                        
                </ul>';
        if(count($to)>0 && $to[0]!=''):
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
                $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_warning');
            }  
        endif;
    }

    /**
     * Méthode limitant les activité réelles pour un certains nombres d'utilisateurs
     * 
     * @return string
     */
    public function get_visibility_user_activity(){
        $list = '';
        if(userAuth('profil_id')==1):
            return '';
        else:
            $visibility = $this->get_visibility();
            $users = $this->get_all_utilisateurs_for_saisie($visibility);
            foreach($users as $user):
                $list .= $user['Utilisateur']['id'].',';
            endforeach;
            $list = strlen($list) > 1 ? substr_replace($list ,"",-1) : '0';
            return " AND activitesreelles.utilisateur_id IN (".$list.") ";
        endif;
    }

    /**
     * Méthode remontant la saisie d'activités réelles pour un mois et une année 
     * 
     * @param int $mois
     * @param int $annee
     * @return array de l'activité sur un mois/année
     */
    public function getActivitesReelles($mois,$annee){
        $visibility = $this->get_visibility_user_activity();

        $lastMonthDay = endWeek($annee.'-'.($mois+1).'-01'); //.date('t'));
        $firstMonthDay = startWeek($annee.'-'.$mois.'-01');
        $sql = "CREATE VIEW SAISIE AS
                SELECT SUM(activitesreelles.TOTAL) AS TOTAL,CONCAT(utilisateurs.NOM,' ',utilisateurs.PRENOM) AS NOMLONG,utilisateurs.id AS USERID, SUM(activitesreelles.VEROUILLE) AS VEROUILLE
                FROM activitesreelles
                LEFT JOIN utilisateurs ON activitesreelles.utilisateur_id = utilisateurs.id
                WHERE activitesreelles.DATE BETWEEN '".$firstMonthDay."' AND '".$lastMonthDay."'
                AND (utilisateurs.profil_id > 0 OR utilisateurs.profil_id = -2)".$visibility."
                GROUP BY activitesreelles.utilisateur_id
                ORDER BY CONCAT(utilisateurs.NOM,' ',utilisateurs.PRENOM) ASC";
        $select = "SELECT * FROM SAISIE"; 
        $this->Activitesreelle->query("DROP VIEW IF EXISTS SAISIE;");
        $this->Activitesreelle->query($sql);
        $nbsaisie = $this->Activitesreelle->query($select);
        $this->Activitesreelle->query("DROP VIEW IF EXISTS SAISIE;");
        return $nbsaisie;
    }       

    /**
     * Méthode qui remonte la liste des utilisateur n'ayant fait aucune saisie pour un mois-année
     * 
     * @param int $mois
     * @param int $annee
     * @return array
     */
    public function saisieVide($mois,$annee){
        $ObjUtilisateurs = new UtilisateursController();
        $utilisateurs = $ObjUtilisateurs->find_all_cercle_utilisateur(userAuth('id'),'0','1');

        $allIdUsers = array();
        foreach($utilisateurs as $utilisateur):
            $allIdUsers[] = $utilisateur['Utilisateur']['id'];
        endforeach;

        $utilisateurAvecSaisie = $this->getActivitesReelles($mois, $annee);
        $userWithWork = array();
        foreach($utilisateurAvecSaisie as $utilisateur):
            $userWithWork[] = $utilisateur['SAISIE']['USERID'];
        endforeach;            
        $result = implode(",",array_diff($allIdUsers, $userWithWork));
        if($result != ''):
            return $this->Activitesreelle->Utilisateur->find('all',array('conditions'=>array('Utilisateur.id in ('.$result.')'),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
        else:
            return array();
        endif;
    }

    /**
     * Méthode qui envois un mail de relance à un utilisateur
     * 
     * @param int $utilisateur_id
     */
    public function sendmailrelance($utilisateur_id){
        $utilisateur = $this->Activitesreelle->Utilisateur->find('first', array('conditions'=>array('Utilisateur.id'=>$utilisateur_id),'recursive'=>0));  
        $from = Configure::read('mailapp');
        $to=$utilisateur['Utilisateur']['MAIL'];
        $email = $utilisateur['Utilisateur']['MAIL'];
        $objet = 'SAILL : //!\ URGENT RELANCE : Saisie d\'activité';
        $message = "URGENT RELANCE :<br><br>Bonjour ".$utilisateur['Utilisateur']['NOMLONG'].',';
        $message .= '<br><br>
                Votre saisie ne semble pas avoir été faites dans l\'outil.<br>
                Merci de prendre quelques minutes de votre temps pour faire cette saisie sur le mois.<br><br>
                N\'oubliez pas que vous pouvez saisir par anticipation votre activité et la valider juste avant la date limite.<br>
                Merci de votre compréhension.';
        if($to!=''):
            try{
            $email = new CakeEmail();
            $email->setHeaders(array('X-Priority'=>1));
            $email->config('smtp')
                    ->emailFormat('html')
                    ->from($from)
                    ->to($to)
                    ->subject($objet)
                    ->send($message);
            }
            catch(Exception $e){
                $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_warning');
            }  
        endif;
        $this->History->goBack(1);
    }    

    /**
     * Méthode validant la demande pour que celle-ci apparaisse en gris dans le calendrier
     * 
     * @param int $demande_id
     */
    public function setvalid($demande_id){
        $activitesreelles = $this->Activitesreelle->find('all',array('conditions'=>array('Activitesreelle.demandeabsence_id'=>$demande_id),'recursive'=>0));
        foreach ($activitesreelles as $obj):
            $this->Activitesreelle->id = $obj['Activitesreelle']['id'];
            $this->Activitesreelle->saveField('demandeabsence_id', NULL);
        endforeach;
    }

    /**
     * Méthode permettant de retourner la saisie d'un agent pour un mois donné
     * 
     * @param $utilisateur_id
     * @param $mois au format numérique
     */
    public function get_my_saisie($utilisateur_id,$mois){
        $lastMonthDay = endWeek(date('Y-'.($mois+1).'-01')); //.date('t'));
        //debug($lastMonthDay); exit();
        $firstMonthDay = startWeek(date('Y-'.$mois.'-01'));
        $sql = "CREATE VIEW SAISIE AS
                SELECT SUM(activitesreelles.TOTAL) AS TOTAL,utilisateurs.id AS USERID
                FROM activitesreelles
                LEFT JOIN utilisateurs ON activitesreelles.utilisateur_id = utilisateurs.id
                WHERE activitesreelles.DATE BETWEEN '".$firstMonthDay."' AND '".$lastMonthDay."'
                AND utilisateurs.id =".$utilisateur_id;
        $select = "SELECT * FROM SAISIE"; 
        $this->Activitesreelle->query("DROP VIEW IF EXISTS SAISIE;");
        $this->Activitesreelle->query($sql);
        $nbsaisie = $this->Activitesreelle->query($select);
        $this->Activitesreelle->query("DROP VIEW IF EXISTS SAISIE;");
        return $nbsaisie;
    }

    /**
     * Méthode qui empeche d'avoir un message d'erreur sur l'appel de la méthode et reste sur la page courante lors du téléchargement de la capture d'écran du calendrier
     */
    public function files() {
        $this->autoRender = false;
        $this->History->goback(0);
    }        
    
    /**
     * Méthode pour mettre à jour la facturation des feuilles de temps de la mêm semaine
     * 
     * @param int $id
     * @param boolean $loop
     * @throws UnauthorizedException
     */
    public function updatefacturationallweek($id = null,$loop=false) { 
        $this->autoRender = false;
        $objects = $this->get_activitesreelle_all_for_date($id);
        foreach ($objects as $activitesreelle):
            $this->updatefacturation($activitesreelle['Activitesreelle']['id'],true);
        endforeach;
        $this->Session->setFlash(__('Feuilles de temps soumises pour facturation',true),'flash_success');
        $this->History->goback(1);
    }   
}
