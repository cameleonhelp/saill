<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
App::import('Controller', 'Utilisateurs');
App::import('Controller', 'Activites');
App::import('Controller', 'Assoprojetentites');
App::import('Controller', 'Projets');
/**
 * Facturations Controller
 *
 * @property Facturation $Facturation
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class FacturationsController extends AppController {
        public $components = array('History','Common');
    public $paginate = array(
    );
    
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Feuilles de temps (estimation de facturation)" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }          
    
    public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            return $ObjAssoentiteutilisateurs->json_get_all_users(userAuth('id'));
        endif;
    }
    
    public function get_restriction($visibility){
        
    }
    
    public function get_facturation_utilisateur_filter($utilisateur,$visibility){
        $result = array();
        $ObjUtilisateurs = new UtilisateursController();
        if (areaIsVisible() || $utilisateur==userAuth('id')):
        switch ($utilisateur){
            case 'tous':    
            case null:
                if($visibility == null):
                    $result['condition']="1=1";
                elseif ($visibility!=''):
                    $result['condition']="Facturation.utilisateur_id IN (".$visibility.")";
                else:
                    $result['condition']="Facturation.utilisateur_id =".userAuth('id');
                endif;                
                $result['filter'] = "tous les utilisateurs";
                break;
            default:
                $result['condition']="Facturation.utilisateur_id = ".$utilisateur;
                $utilisateur = $ObjUtilisateurs->get_nomlong($utilisateur);
                $result['filter'] = $utilisateur;
                break;                      
        }  
        else:
            $result['condition']="Facturation.utilisateur_id = ".userAuth('id');
            $utilisateur =  $ObjUtilisateurs->get_nomlong(userAuth('id')); 
            $result['filter'] = $utilisateur;                 
        endif;  
        return $result;
    }
    
    public function get_facturation_chrono_filter($mois,$annee){
        $result = array();
        $mois = $mois==null ? date('m') : $mois;
        $annee = $annee==null ? date('Y') : $annee;        
        switch ($mois){
            case 'tous':
                $result['condition']="1=1";
                $result['filter'] = "";
                break;
            default:
                $dernierjour = date('t', mktime(0, 0, 0, $mois, 5, $annee));
                $debut = $annee."-".$mois."-01";
                $datedebut = startWeek($debut);
                $datefin = $annee."-".$mois."-".$dernierjour;
                $result['condition']="Facturation.DATE BETWEEN '".$datedebut."' AND '".$datefin."'";
                $moiscal = array('01'=>"janvier",'02'=>"février",'03'=>"mars",'04'=>"avril",'05'=>"mai",'06'=>"juin",'07'=>"juillet",'08'=>"août",'09'=>"septembre",'10'=>"octobre",'11'=>"novembre",'12'=>"décembre",);
                $result['filter'] = "pour le mois de ".$moiscal[$mois]." ".$annee;
                break;                      
        } 
        return $result;
    }
    
    public function get_facturation_visible_filter($visible){
        $result = array();
        switch ($visible){
            case '1':
                $result['condition']="Facturation.VISIBLE=0";
                break;              
            default:
                $result['condition']="1=1";
                break;                      
        }  
        return $result;
    }
    
    public function get_facturation_indisponibilite_filter($indisponibilite){
        $result = array();
        switch ($indisponibilite){
            case '1':
                $result['condition']="Activite.projet_id!=1";
                break;             
            default:
                $result['condition']="1=1";
                break;                      
        }  
        return $result;
    }
    
    public function get_all_facturation_group($condition){
        $fields = array('Facturation.VERSION','Facturation.DATE','Facturation.utilisateur_id','Facturation.NUMEROFTGALILEI','Utilisateur.NOM','Utilisateur.PRENOM','COUNT(Facturation.DATE) AS NBACTIVITE');
        $group = array('Facturation.DATE','Facturation.utilisateur_id','Facturation.VERSION');
        $order = array('CONCAT(Utilisateur.NOM," ",Utilisateur.PRENOM)' => 'asc','Facturation.DATE' => 'desc' );
        return $this->Facturation->find('all',array('fields'=>$fields,'group'=>$group,'order'=>$order,'conditions'=>$condition,'recursive'=>1));
    }
    
    public function get_all_facturation_annee(){
        $thisyear = new DateTime();
        return $this->Facturation->find('all',array('fields'=>array('YEAR(Facturation.DATE) AS ANNEE'),'conditions'=>array('YEAR(Facturation.DATE) > 0','YEAR(Facturation.DATE) != '=>$thisyear->format('Y')),'group'=>array('YEAR(Facturation.DATE)'),'order'=>array('YEAR(Facturation.DATE)' => 'asc')));
    }    
    
    public function get_export($condition){
        $this->Session->delete('xls_export');
        $export = $this->Facturation->find('all',array('conditions'=>$condition,'order' => array('Facturation.DATE' => 'asc'),'recursive'=>0));
        $this->Session->write('xls_export',$export); 
    }
    

/**
 * index method
 *
 * @return void
 */
	public function index($utilisateur=null,$mois=null,$visible=null,$indisponibilite=null,$annee=null) {
            $this->set_title();
            if (isAuthorized('facturations', 'index')) :     
                $utilisateur = $utilisateur==null ? 'tous':$utilisateur;
                $mois = $mois==null ? date('m') : $mois;
                $visible = $visible==null ? 1 :$visible;
                $indisponibilite = $indisponibilite==null ? 0 : $indisponibilite;
                $annee = $annee==null ? date('Y') : $annee;
                $listusers = $this->get_visibility();
                $getutilisateur = $this->get_facturation_utilisateur_filter($utilisateur, $listusers);
                $getchrono = $this->get_facturation_chrono_filter($mois, $annee);
                $getvisible = $this->get_facturation_visible_filter($visible);
                $getindisponibilite = $this->get_facturation_indisponibilite_filter($indisponibilite);
                $this->set('futilisateur',$getutilisateur['filter']);
                $this->set('fperiode',$getchrono['filter']);  
                $newconditions = array($getutilisateur['condition'],$getchrono['condition'],$getvisible['condition'],$getindisponibilite['condition']);
                $ObjUtilisateurs = new UtilisateursController();
                $utilisateurs = $ObjUtilisateurs->find_all_cercle_utilisateur(userAuth('id'),'1','1');
                $groups = $this->get_all_facturation_group($newconditions);
                $annees = $this->get_all_facturation_annee();
                $this->set(compact('utilisateurs','groups','annees'));
                $this->paginate = array('limit'=>$this->Facturation->find('count'));                
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));                 
		$this->set('facturations', $this->paginate());
                $this->get_export($newconditions);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");            
            endif;                
	}

/**
 * add method
 *
 * @return void
 */
	public function add($userid=null,$reelid=null) {
                $date = $this->Facturation->Activitesreelle->find('first',array('fields'=>array('Activitesreelle.DATE'),'conditions'=>array('Activitesreelle.id'=>$reelid),'recursive'=>-1));
                $ObjActivites = new ActivitesController();
                $activites = $ObjActivites->find_all_cercle_activite_and_indisponibility(userAuth('id'));
		$this->set('activites', $activites);
                $facturation = $this->Facturation->find('first',array('conditions'=>array('Facturation.utilisateur_id'=>$userid,'Facturation.activitesreelle_id'=>$reelid),'recursive'=>-1));
                $activitesreelles = $this->Facturation->Activitesreelle->find('all',array('conditions'=>array('Activitesreelle.utilisateur_id'=>$userid,'Activitesreelle.DATE'=>CUSDate($date['Activitesreelle']['DATE']),'Activitesreelle.VEROUILLE'=>0,'Activitesreelle.facturation_id'=>null),'recursive'=>-1));
		if (isset($facturation['Facturation'])):
                $activitesreelles[0]['Facturation']['NUMEROFTGALILEI']=$facturation['Facturation']['NUMEROFTGALILEI'];
                $activitesreelles[0]['Facturation']['VERSION']=$facturation['Facturation']['VERSION'];
                endif;
                $this->set('activitesreelles', $activitesreelles);
         }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null,$userid=null) {
            $date = $this->Facturation->find('first',array('fields'=>array('Facturation.DATE'),'conditions'=>array('Facturation.id'=>$id),'recursive'=>-1));
            $version = $this->Facturation->find('first',array('fields'=>array('Facturation.VERSION'),'conditions'=>array('Facturation.id'=>$id),'recursive'=>-1));
            $ObjActivites = new ActivitesController();
            $activites = $ObjActivites->find_all_cercle_activite(userAuth('id'));
            $this->set('activites', $activites);
            $activitesreelles = $this->Facturation->find('all',array('conditions'=>array('Facturation.utilisateur_id'=>$userid,'Facturation.DATE'=>CUSDate($date['Facturation']['DATE']),'Facturation.VERSION'=>$version['Facturation']['VERSION']),'recursive'=>-1));
            $this->set('activitesreelles', $activitesreelles);
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
            $this->set_title();
            $this->Facturation->id = $id;
            if (!$this->Facturation->exists()) {
                    throw new NotFoundException(__('Invalid facturation'));
            }
            $this->request->onlyAllow('post', 'delete');
            if ($this->Facturation->delete()) {
                    $this->Session->setFlash(__('Facturation deleted'));
                    $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Facturation was not deleted'));
            $this->redirect(array('action' => 'index'));
	}

/**
 * search method
 *
 * @return void
 */
	public function search($utilisateur=null,$mois=null,$visible=null,$indisponibilite=null,$annee=null,$keywords=null) {
            $this->set_title();
            if (isAuthorized('facturations', 'index')) :
                if(isset($this->params->data['Facturation']['SEARCH'])):
                    $keywords = $this->params->data['Facturation']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords)); 
                    $utilisateur = $utilisateur==null ? userAuth('id'):$utilisateur;
                    $mois = $mois==null ? date('m') : $mois;
                    $visible = $visible==null ? 1 :$visible;
                    $indisponibilite = $indisponibilite==null ? 0 : $indisponibilite;
                    $annee = $annee==null ? date('Y') : $annee;
                    $listusers = $this->get_visibility();
                    $getutilisateur = $this->get_facturation_utilisateur_filter($utilisateur, $listusers);
                    $getchrono = $this->get_facturation_chrono_filter($mois, $annee);
                    $getvisible = $this->get_facturation_visible_filter($visible);
                    $getindisponibilite = $this->get_facturation_indisponibilite_filter($indisponibilite);
                    $this->set('futilisateur',$getutilisateur['filter']);
                    $this->set('fperiode',$getchrono['filter']);  
                    $newconditions = array($getutilisateur['condition'],$getchrono['condition'],$getvisible['condition'],$getindisponibilite['condition']);
                    $ObjUtilisateurs = new UtilisateursController();
                    $utilisateurs = $ObjUtilisateurs->find_all_cercle_utilisateur(userAuth('id'),'1','1');
                    $groups = $this->get_all_facturation_group($newconditions);
                    $annees = $this->get_all_facturation_annee();
                    $this->set(compact('utilisateurs','groups','annees'));
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Facturation.VERSION = '".$value."'","Activite.NOM LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newcondition,'OR'=>$ornewconditions);
                    $this->paginate = array('limit'=>$this->Facturation->find('count'));
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                
                    $this->set('facturations', $this->paginate());
                    $this->get_export($conditions);
                else:
                    $this->redirect(array('action'=>'index',$utilisateur,$mois,$visible,$indisponibilite,$annee));
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");           
            endif;                
        }  
        
/**
 * getActivitiesForUserAndDate method
 * 
 * @param type $userid
 * @param type $date
 * @return array of activities
 */        
        public function getActivitiesForUserAndDate($userid=null,$date=null){
                $sql = 'SELECT * FROM activitesreelles AS Facturation WHERE Facturation.utilisateur_id = '.$userid.' AND Facturation.DATE = "'.$date.'"';
                return $this->request->query($sql);
        }
        
        public function save(){
            if ($this->request->is('post')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Facturation->validate = array();
                        $this->History->goBack(2);
                    else:                
                        $facturations = $this->request->data['Facturation'];
                        unset($facturations['¤']);                     
                        foreach($facturations as $facturation):
                            if (is_array($facturation)):
                                $this->Facturation->create();
                                if ($this->Facturation->save($facturation)) {
                                    if (!isset($facturation['new']) && isset($facturation['activitesreelle_id'])):
                                        $lastId = $this->Facturation->getLastInsertID();
                                        $this->Facturation->Activitesreelle->id = $facturation['activitesreelle_id'];
                                        $this->Facturation->Activitesreelle->saveField('facturation_id', $lastId);
                                   endif;
                                    if (isset($facturation['VERSION']) && intval($facturation['VERSION']) > 0):
                                        $version = intval($facturation['VERSION'])-1;
                                        $oldFacturationId = $this->getOldFacturationId($facturation['utilisateur_id'], CUSDate($facturation['DATE']), $facturation['activite_id'], $version);
                                        $this->Facturation->id = $oldFacturationId;                                         
                                        $this->Facturation->saveField('VISIBLE', 1);
                                    endif;
                                    $this->Session->setFlash(__('La facturation est sauvegardée',true),'flash_success');
                                } else {
                                    $this->Session->setFlash(__('La facturation est incorrecte, veuillez corriger la facturation',true),'flash_failure');
                                }                  
                            endif;
                        endforeach;
                        $this->History->goBack(1);
                endif;
            }            
        }
        
        public function getOldFacturationId($utilisateur_id,$date,$activite_id,$version){
            $oldId = $this->Facturation->find('first',array('fields'=>array('Facturation.id'),'conditions'=>array('Facturation.utilisateur_id'=>$utilisateur_id,'Facturation.DATE'=>$date,'Facturation.activite_id'=>$activite_id,'Facturation.VERSION'=>$version),'recursive'=>-1));
            return $oldId['Facturation']['id'];
        }
        
    public function get_list_responsables($visibility){
        $result = null;
        if($visibility == null):
            $result = $this->Facturation->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.profil_id >1','Utilisateur.profil_id =-2')),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        elseif($visibility!=''):
            $result = $this->Facturation->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.ACTIF'=>1,'Utilisateur.id IN ('.$visibility.')'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        else:
            $result = $this->Facturation->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.profil_id >1','Utilisateur.profil_id =-2')),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
        endif;
        return $result;
    }   
        
/**
 * rapport
 */        
        public function rapport() {
            "Rapport des ".strtolower($this->set_title());
            if (isAuthorized('facturations', 'rapports')) :
                if ($this->request->is('post')):
                    foreach ($this->request->data['Facturation']['utilisateur_id'] as &$value) {
                        @$destinatairelist .= $value.',';
                    }  
                    $destinataire = 'Facturation.utilisateur_id IN ('.substr_replace($destinatairelist ,"",-1).')';
                    foreach ($this->request->data['Facturation']['projet_id'] as &$value) {
                        @$projetlist .= $value.',';
                    }  
                    $domaine = 'Activite.projet_id IN ('.substr_replace($projetlist ,"",-1).')';
                    $periode = 'Facturation.DATE BETWEEN "'. startWeek(CUSDate($this->request->data['Facturation']['START'])).'" AND "'.endWeek(CUSDate($this->request->data['Facturation']['END'])).'"';
                    /** BUG supprime sur le mois en cours même activité **/
                    /*pour supprimer les jours en trop*/
                    $activitefirstweek = $this->Facturation->find('all',array('fields'=>array('Activite.id','Activite.projet_id','Facturation.utilisateur_id', 'SUM(Facturation.LU) AS LU', 'SUM(Facturation.MA) AS MA', 'SUM(Facturation.ME) AS ME', 'SUM(Facturation.JE) AS JE', 'SUM(Facturation.VE) AS VE', 'SUM(Facturation.SA) AS SA', 'SUM(Facturation.DI) AS DI','Facturation.DATE AS DATE'),'conditions'=>array($destinataire,$domaine,'Facturation.VISIBLE'=>0,'Facturation.DATE'=>startWeek(CUSDate($this->request->data['Facturation']['START']))),'group'=>array('Activite.projet_id','Activite.id','Facturation.utilisateur_id'),'recursive'=>0));  
                    $activitelastweek = $this->Facturation->find('all',array('fields'=>array('Activite.id','Activite.projet_id','Facturation.utilisateur_id', 'SUM(Facturation.LU) AS LU', 'SUM(Facturation.MA) AS MA', 'SUM(Facturation.ME) AS ME', 'SUM(Facturation.JE) AS JE', 'SUM(Facturation.VE) AS VE', 'SUM(Facturation.SA) AS SA', 'SUM(Facturation.DI) AS DI','Facturation.DATE AS DATE'),'conditions'=>array($destinataire,$domaine,'Facturation.VISIBLE'=>0,'Facturation.DATE'=>startWeek(CUSDate($this->request->data['Facturation']['END']))),'group'=>array('Activite.projet_id','Activite.id','Facturation.utilisateur_id'),'recursive'=>0));  
                    $entrop = array_merge($this->getEntropFirst($activitefirstweek),$this->getEntropLast($activitelastweek));
                    $byprojet = $this->array_sum_merge_by_projet($entrop);
                    $byprojetactiviteutilisateur = $this->array_sum_merge($entrop);
                    $byprojetactivite = $this->array_sum_merge_by_projet_activite($entrop);
                    $this->set('byprojet',$byprojet); 
                    $this->set('byprojetactiviteutilisateur',$byprojetactiviteutilisateur);
                    $this->set('byprojetactivite',$byprojetactivite);                   
                    $rapportresult = $this->Facturation->find('all',array('fields'=>array('MONTH(Facturation.DATE) AS MONTH', 'YEAR(Facturation.DATE) AS YEAR','Activite.projet_id','SUM(Facturation.TOTAL) AS NB'),'conditions'=>array($destinataire,$domaine,$periode,'Facturation.VISIBLE'=>0),'order'=>array('MONTH(Facturation.DATE)'=>'asc','YEAR(Facturation.DATE)'=>'asc'),'group'=>array('Activite.projet_id'),'recursive'=>0));
                    $this->set('rapportresults',$rapportresult);
                    $chartresult = $this->Facturation->find('all',array('fields'=>array('Activite.projet_id','SUM(Facturation.TOTAL) AS NB'),'conditions'=>array($destinataire,$domaine,$periode,'Facturation.VISIBLE'=>0),'order'=>array('Activite.projet_id'=>'asc'),'group'=>array('Activite.projet_id'),'recursive'=>0));
                    $this->set('chartresults',$chartresult);                    
                    $detailrapportresult = $this->Facturation->find('all',array('fields'=>array('MONTH(Facturation.DATE) AS MONTH', 'YEAR(Facturation.DATE) AS YEAR','Activite.id','Activite.NOM','Activite.projet_id','SUM(Facturation.TOTAL) AS NB'),'conditions'=>array($destinataire,$domaine,$periode,'Facturation.VISIBLE'=>0),'order'=>array('MONTH(Facturation.DATE)'=>'asc','YEAR(Facturation.DATE)'=>'asc'),'group'=>array('Activite.projet_id','Activite.NOM'),'recursive'=>0));
                    $this->set('detailrapportresults',$detailrapportresult);
                    $this->Session->delete('rapportresults');  
                    $this->Session->delete('detailrapportresults');                      
                    $this->Session->write('rapportresults',$rapportresult);
                    $this->Session->write('detailrapportresults',$detailrapportresult);
                    if ($this->request->data['Facturation']['RepartitionUtilisateur']==1):
                        $repartitions = $this->Facturation->find('all',array('fields'=>array('MONTH(Facturation.DATE) AS MONTH', 'YEAR(Facturation.DATE) AS YEAR','Utilisateur.id','Utilisateur.NOM','Utilisateur.PRENOM','Activite.projet_id','Activite.id','Activite.NOM','SUM(Facturation.TOTAL) AS NB'),'conditions'=>array($destinataire,$domaine,$periode,'Facturation.VISIBLE'=>0),'order'=>array('MONTH(Facturation.DATE)'=>'asc','YEAR(Facturation.DATE)'=>'asc','Facturation.utilisateur_id'=>'asc'),'group'=>array('Facturation.utilisateur_id','Activite.NOM'),'recursive'=>0));
                        $this->set('repartitions',$repartitions);
                        $this->Session->delete('repartitionresults');
                        $this->Session->write('repartitionresults',$repartitions);
                    endif;
                endif;
                $listeagentsavecsaisie = $this->Facturation->find('all',array('fields'=>array('Facturation.utilisateur_id'),'group'=>'Facturation.utilisateur_id','order'=>array('Facturation.utilisateur_id'=>'asc'),'recursive'=>0));
                $listein = '';
                foreach($listeagentsavecsaisie as $agent):
                    $listein .= $agent['Facturation']['utilisateur_id'].',';
                endforeach;
                $listuser = $this->get_visibility();
                $destinataires = $this->get_list_responsables($listuser); 
                $ObjAssoprojetentites = new AssoprojetentitesController();
                $listprojets = $ObjAssoprojetentites->json_get_all_projets(userAuth('id'));
                $ObjProjets = new ProjetsController();
                $domaines = $ObjProjets->get_list_id_nom_projets($listprojets);   
                $this->set(compact('destinataires','domaines'));                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;             
	}   

        
        public function getEntropFirst($activitefirstweek=null){
            $enmoins1 = array();
            $i=0;
            foreach($activitefirstweek as $firstweek):
                $datetime1 = new DateTime(CUSDate($firstweek['Facturation']['DATE']));
                $datetime2 = new DateTime(CUSDate($this->request->data['Facturation']['START']));
                $interval = $datetime2->diff($datetime1); 
                $entropfirst = $interval->format('%a');
                switch ($entropfirst):
                    case 1:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU'];  
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                       
                        break;
                    case 2:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');                     
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA'];
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                        
                        break;
                    case 3:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');                       
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];                        
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA']+$firstweek[0]['ME'];
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                        
                        break;
                    case 4:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');              
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];                        
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];                       
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA']+$firstweek[0]['ME']+$firstweek[0]['JE'];
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                         
                        break;
                    case 5:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');                  
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];                        
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];                        
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA']+$firstweek[0]['ME']+$firstweek[0]['JE']+$firstweek[0]['VE'];
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                         
                        break;
                    case 6:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');                       
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];                        
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];                        
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA']+$firstweek[0]['ME']+$firstweek[0]['JE']+$firstweek[0]['VE']+$firstweek[0]['SA'];
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                       
                        break;
                endswitch;
                $i++;
            endforeach;                           
            return $enmoins1;
        }
        
        public function getEntropLast($activitelastweek=null){
            $enmoins2 = array();
            $i=0;            
            foreach($activitelastweek as $lastweek):
                $datetime1 = new DateTime(CUSDate($lastweek['Facturation']['DATE']));
                $datetime2 = new DateTime(CUSDate($this->request->data['Facturation']['END']));
                $interval = $datetime1->diff($datetime2); 
                $entropfirst = $interval->format('%a');
                switch ($entropfirst):
                    case 1:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                        
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA']+$lastweek[0]['VE']+$lastweek[0]['JE']+$lastweek[0]['ME'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                      
                        break;
                    case 2:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                           
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA']+$lastweek[0]['VE']+$lastweek[0]['JE'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                         
                        break;
                    case 3:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                           
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA']+$lastweek[0]['VE'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                          
                        break;
                    case 0:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                           
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA']+$lastweek[0]['VE']+$lastweek[0]['JE']+$lastweek[0]['ME']+$lastweek[0]['MA'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                         
                        break;
                    case 5:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                           
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                         
                        break;
                    case 4:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                           
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                        
                        break;
                endswitch;
                $i++;
            endforeach;                         
            return $enmoins2;
        }

        public function array_sum_merge($array){
            $sortedArray = array();
            $assignedValues = array();
            foreach ($array as $arrayItem)
            {
                $ukey = $arrayItem['projet_id'].$arrayItem['activite_id'].$arrayItem['utilisateur_id'];
                if (!isset($sortedArray[$ukey])){
                    $sortedArray[$ukey] = array();
                }
                $sortedArray[$ukey][] = $arrayItem['aretirer'];
                if (!isset($assignedValues[$ukey])){
                    $assignedValues[$ukey] = array(
                        'projet_id' => $arrayItem['projet_id'],
                        'activite_id' => $arrayItem['activite_id'],
                        'utilisateur_id' => $arrayItem['utilisateur_id'],
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
        
	function export_doc() {
            if($this->Session->check('rapportresults') && $this->Session->check('detailrapportresults')):
                $data = $this->Session->read('rapportresults');
                $this->set('rowsrapport',$data);
                $data = $this->Session->read('detailrapportresults'); 
                $this->set('rowsdetail',$data);  
                $data = $this->Session->read('repartitionresults'); 
                $this->set('rowsrepartition',$data);                
		$this->render('export_doc','export_doc');
            else:
                $this->Session->setFlash(__('Rapport impossible à éditer veuillez renouveler le calcul du rapport',true),'flash_failure');             
                $this->redirect(array('action'=>'rapport'));
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
        
        public function forss2i($options=null){
            $options = $options==null ? $this->params->params['pass'] : $options;
            $societes = $options['societes'];
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            $utilisateurs = $ObjAssoentiteutilisateurs->json_get_all_users_and_generique(userAuth('id'),$societes);
            if($utilisateurs != '' && $utilisateurs != '0'):
                $destinataire = 'Facturation.utilisateur_id IN ('.$utilisateurs.')';
                $start = $options['start'];
                $end = $options['end'];
                $periode = 'Facturation.DATE BETWEEN "'. startWeek($start).'" AND "'.endWeek($end).'"';
                $activitefirstweek = $this->Facturation->find('all',array('fields'=>array('Activite.id','Activite.projet_id','Facturation.utilisateur_id', 'SUM(Facturation.LU) AS LU', 'SUM(Facturation.MA) AS MA', 'SUM(Facturation.ME) AS ME', 'SUM(Facturation.JE) AS JE', 'SUM(Facturation.VE) AS VE', 'SUM(Facturation.SA) AS SA', 'SUM(Facturation.DI) AS DI','Facturation.DATE AS DATE'),'conditions'=>array($destinataire,'Facturation.VISIBLE'=>0,'Facturation.DATE'=>startWeek(CUSDate($start))),'group'=>array('Activite.projet_id','Activite.id','Facturation.utilisateur_id'),'recursive'=>0));  
                $activitelastweek = $this->Facturation->find('all',array('fields'=>array('Activite.id','Activite.projet_id','Facturation.utilisateur_id', 'SUM(Facturation.LU) AS LU', 'SUM(Facturation.MA) AS MA', 'SUM(Facturation.ME) AS ME', 'SUM(Facturation.JE) AS JE', 'SUM(Facturation.VE) AS VE', 'SUM(Facturation.SA) AS SA', 'SUM(Facturation.DI) AS DI','Facturation.DATE AS DATE'),'conditions'=>array($destinataire,'Facturation.VISIBLE'=>0,'Facturation.DATE'=>startWeek(CUSDate($end))),'group'=>array('Activite.projet_id','Activite.id','Facturation.utilisateur_id'),'recursive'=>0));  
                $entrop = array_merge($this->getEntropFirstSS2I($activitefirstweek,$options['mois']),$this->getEntropLastSS2I($activitelastweek,$options['mois']));
                $byprojetactiviteutilisateur = $this->array_sum_merge($entrop);
                $indisponibilite = $options['indisponibilite'] ? '1=1': 'Activite.projet_id > 1';
                $result = $this->Facturation->find('all',array('fields'=>array('MONTH(Facturation.DATE) AS MONTH', 'YEAR(Facturation.DATE) AS YEAR','SUM(Facturation.FRAIS) AS FRAIS','Utilisateur.id','Utilisateur.NOM','Utilisateur.PRENOM','Activite.projet_id','Utilisateur.societe_id','Activite.id','Activite.NOM','Activite.NUMEROGALLILIE','SUM(Facturation.TOTAL) AS NB'),'conditions'=>array($destinataire,$periode,$indisponibilite,'Facturation.VISIBLE'=>0),'order'=>array('Utilisateur.NOM'=>'asc','Utilisateur.PRENOM'=>'asc','Facturation.utilisateur_id'=>'asc'),'group'=>array('Facturation.utilisateur_id','Activite.projet_id','Activite.NOM'),'recursive'=>0));            
                return array('trop'=>$byprojetactiviteutilisateur,'result'=>$result);
            endif;
        }
        
        public function forsncf($options=null){
            $options = $options==null ? $this->params->params['pass'] : $options;
            $societes = $options['societes'];
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            $utilisateurs = $ObjAssoentiteutilisateurs->json_get_all_users_nogenerique(userAuth('id'),$societes);
            if($utilisateurs != '' && $utilisateurs != '0'):
                $destinataire = 'Facturation.utilisateur_id IN ('.$utilisateurs.')';
                $start = $options['start'];
                $end = $options['end'];
                $periode = 'Facturation.DATE BETWEEN "'. startWeek($start).'" AND "'.endWeek($end).'"';
                $activitefirstweek = $this->Facturation->find('all',array('fields'=>array('Activite.id','Activite.projet_id','Facturation.utilisateur_id', 'SUM(Facturation.LU) AS LU', 'SUM(Facturation.MA) AS MA', 'SUM(Facturation.ME) AS ME', 'SUM(Facturation.JE) AS JE', 'SUM(Facturation.VE) AS VE', 'SUM(Facturation.SA) AS SA', 'SUM(Facturation.DI) AS DI','Facturation.DATE AS DATE'),'conditions'=>array($destinataire,'Facturation.VISIBLE'=>0,'Facturation.DATE'=>startWeek(CUSDate($start))),'group'=>array('Activite.projet_id','Activite.id','Facturation.utilisateur_id'),'recursive'=>0));  
                $activitelastweek = $this->Facturation->find('all',array('fields'=>array('Activite.id','Activite.projet_id','Facturation.utilisateur_id', 'SUM(Facturation.LU) AS LU', 'SUM(Facturation.MA) AS MA', 'SUM(Facturation.ME) AS ME', 'SUM(Facturation.JE) AS JE', 'SUM(Facturation.VE) AS VE', 'SUM(Facturation.SA) AS SA', 'SUM(Facturation.DI) AS DI','Facturation.DATE AS DATE'),'conditions'=>array($destinataire,'Facturation.VISIBLE'=>0,'Facturation.DATE'=>startWeek(CUSDate($end))),'group'=>array('Activite.projet_id','Activite.id','Facturation.utilisateur_id'),'recursive'=>0));  
                $entrop = array_merge($this->getEntropFirstSNCF($activitefirstweek,$start),$this->getEntropLastSNCF($activitelastweek,$start,$end));
                $byprojetactiviteutilisateur = $this->array_sum_merge($entrop);
                $result = $this->Facturation->find('all',array('fields'=>array('MONTH(Facturation.DATE) AS MONTH', 'YEAR(Facturation.DATE) AS YEAR','Activite.id','Activite.NOM','Activite.projet_id','SUM(Facturation.TOTAL) AS NB','Utilisateur.id','Utilisateur.username','Utilisateur.NOM','Utilisateur.PRENOM','Activite.projet_id','Utilisateur.societe_id','Activite.NUMEROGALLILIE'),'conditions'=>array($destinataire,$periode,'Facturation.VISIBLE'=>0),'order'=>array('Utilisateur.NOM'=>'asc','Utilisateur.PRENOM'=>'asc','Facturation.utilisateur_id'=>'asc'),'group'=>array('Facturation.utilisateur_id','Activite.projet_id','Activite.NOM'),'recursive'=>0));
                return array('trop'=>$byprojetactiviteutilisateur,'result'=>$result);        
            endif;
        }
        
        public function getEntropFirstSS2I($activitefirstweek=null,$mois=null){
            $enmoins1 = array();
            $i=0;
            foreach($activitefirstweek as $firstweek):
                $annee = date('Y');
                $mois = $mois!= null ? $mois : $this->request->data['Rapport']['mois'];
                $datetime1 = new DateTime(CUSDate($firstweek['Facturation']['DATE']));
                $datetime2 = new DateTime($annee.'-'.$mois.'-01');
                $interval = $datetime2->diff($datetime1); 
                $entropfirst = $interval->format('%a');
                switch ($entropfirst):
                    case 1:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU'];  
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                       
                        break;
                    case 2:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');                     
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA'];
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                        
                        break;
                    case 3:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');                       
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];                        
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA']+$firstweek[0]['ME'];
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                        
                        break;
                    case 4:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');              
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];                        
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];                       
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA']+$firstweek[0]['ME']+$firstweek[0]['JE'];
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                         
                        break;
                    case 5:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');                  
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];                        
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];                        
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA']+$firstweek[0]['ME']+$firstweek[0]['JE']+$firstweek[0]['VE'];
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                         
                        break;
                    case 6:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');                       
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];                        
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];                        
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA']+$firstweek[0]['ME']+$firstweek[0]['JE']+$firstweek[0]['VE']+$firstweek[0]['SA'];
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                       
                        break;
                endswitch;
                $i++;
            endforeach;                           
            return $enmoins1;
        }
        
        public function getEntropLastSNCF($activitelastweek=null,$du=null,$au=null){
            $enmoins2 = array();
            $i=0;            
            foreach($activitelastweek as $lastweek):
                $annee = date('Y');
                $du = $du!=null ? $du : $this->request->data['Rapport']['DU'];
                $au = $au!=null ? $au : $this->request->data['Rapport']['AU'];
                $dayone = new DateTime(CUSDate($du));
                $lastday = $dayone->format('t');
                $datetime1 = new DateTime(startWeek(CUSDate($au)));
                $datetime2 = new DateTime(CUSDate($au));
                $interval = $datetime1->diff($datetime2); 
                $entropfirst = $interval->format('%a');
                switch ($entropfirst):
                    case 1:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                        
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA']+$lastweek[0]['VE']+$lastweek[0]['JE']+$lastweek[0]['ME'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                      
                        break;
                    case 2:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                           
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA']+$lastweek[0]['VE']+$lastweek[0]['JE'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                         
                        break;
                    case 3:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                           
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA']+$lastweek[0]['VE'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                          
                        break;
                    case 0:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                           
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA']+$lastweek[0]['VE']+$lastweek[0]['JE']+$lastweek[0]['ME']+$lastweek[0]['MA'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                         
                        break;
                    case 5:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                           
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                         
                        break;
                    case 4:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                           
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                        
                        break;
                endswitch;
                $i++;
            endforeach;                         
            return $enmoins2;
        }       
        
        public function getEntropFirstSNCF($activitefirstweek=null,$du=null){
            $enmoins1 = array();
            $i=0;
            foreach($activitefirstweek as $firstweek):
                $annee = date('Y');
                $du = $du!=null ? $du : $this->request->data['Rapport']['DU'];
                $datetime1 = new DateTime(CUSDate($firstweek['Facturation']['DATE']));
                $datetime2 = new DateTime(CUSDate($du));
                $interval = $datetime2->diff($datetime1); 
                $entropfirst = $interval->format('%a');
                switch ($entropfirst):
                    case 1:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU'];  
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                       
                        break;
                    case 2:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');                     
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA'];
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                        
                        break;
                    case 3:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');                       
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];                        
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA']+$firstweek[0]['ME'];
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                        
                        break;
                    case 4:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');              
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];                        
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];                       
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA']+$firstweek[0]['ME']+$firstweek[0]['JE'];
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                         
                        break;
                    case 5:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');                  
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];                        
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];                        
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA']+$firstweek[0]['ME']+$firstweek[0]['JE']+$firstweek[0]['VE'];
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                         
                        break;
                    case 6:
                        $enmoins1[$i]['date']=$datetime1;
                        $enmoins1[$i]['mois']=$datetime1->format('m');                       
                        $enmoins1[$i]['projet_id']=$firstweek['Activite']['projet_id'];
                        $enmoins1[$i]['activite_id']=$firstweek['Activite']['id'];                        
                        $enmoins1[$i]['utilisateur_id']=$firstweek['Facturation']['utilisateur_id'];                        
                        $enmoins1[$i]['aretirer']=$firstweek[0]['LU']+$firstweek[0]['MA']+$firstweek[0]['ME']+$firstweek[0]['JE']+$firstweek[0]['VE']+$firstweek[0]['SA'];
                        $enmoins1[$i]['key']=$firstweek['Activite']['projet_id'].$firstweek['Activite']['id'].$firstweek['Facturation']['utilisateur_id'];                       
                        break;
                endswitch;
                $i++;
            endforeach;                           
            return $enmoins1;
        }
        
        public function getEntropLastSS2I($activitelastweek=null,$mois=null){
            $enmoins2 = array();
            $i=0;            
            foreach($activitelastweek as $lastweek):
                $annee = date('Y');
                $mois = $mois!= null ? $mois : $this->request->data['Rapport']['mois'];
                $dayone = new DateTime($annee.'-'.$mois.'-01');
                $lastday = $dayone->format('t');
                $datetime1 = new DateTime(startWeek($annee.'-'.$mois.'-'.$lastday)); //CUSDate($lastweek['Facturation']['DATE'])
                $datetime2 = new DateTime($annee.'-'.$mois.'-'.$lastday);
                $interval = $datetime1->diff($datetime2); 
                $entropfirst = $interval->format('%a');
                switch ($entropfirst):
                    case 1:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                        
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA']+$lastweek[0]['VE']+$lastweek[0]['JE']+$lastweek[0]['ME'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                      
                        break;
                    case 2:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                           
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA']+$lastweek[0]['VE']+$lastweek[0]['JE'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                         
                        break;
                    case 3:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                           
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA']+$lastweek[0]['VE'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                          
                        break;
                    case 0:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                           
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA']+$lastweek[0]['VE']+$lastweek[0]['JE']+$lastweek[0]['ME']+$lastweek[0]['MA'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                         
                        break;
                    case 5:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                           
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                         
                        break;
                    case 4:
                        $enmoins2[$i]['date']=$datetime1;
                        $enmoins2[$i]['mois']=$datetime1->format('m');
                        $enmoins2[$i]['projet_id']=$lastweek['Activite']['projet_id'];
                        $enmoins2[$i]['activite_id']=$lastweek['Activite']['id'];                        
                        $enmoins2[$i]['utilisateur_id']=$lastweek['Facturation']['utilisateur_id'];                           
                        $enmoins2[$i]['aretirer']=$lastweek[0]['DI']+$lastweek[0]['SA'];
                        $enmoins2[$i]['key']=$lastweek['Activite']['projet_id'].$lastweek['Activite']['id'].$lastweek['Facturation']['utilisateur_id'];                        
                        break;
                endswitch;
                $i++;
            endforeach;                         
            return $enmoins2;
        }    
        
        public function array_sum_merge_SS2I($array){
            $sortedArray = array();
            $assignedValues = array();
            foreach ($array as $arrayItem)
            {
                $ukey = $arrayItem['projet_id'].$arrayItem['activite_id'].$arrayItem['utilisateur_id'];
                if (!isset($sortedArray[$ukey])){
                    $sortedArray[$ukey] = array();
                }
                $sortedArray[$ukey][] = $arrayItem['aretirer'];
                if (!isset($assignedValues[$ukey])){
                    $assignedValues[$ukey] = array(
                        'projet_id' => $arrayItem['projet_id'],
                        'activite_id' => $arrayItem['activite_id'],
                        'utilisateur_id' => $arrayItem['utilisateur_id'],
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
}        