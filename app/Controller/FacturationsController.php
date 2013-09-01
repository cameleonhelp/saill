<?php
App::uses('AppController', 'Controller');
/**
 * Facturations Controller
 *
 * @property Facturation $Facturation
 */
class FacturationsController extends AppController {
        public $components = array('History');
    public $paginate = array(
        //'limit'=>9999
    );
/**
 * index method
 *
 * @return void
 */
	public function index($utilisateur=null,$mois=null,$visible=null,$indisponibilite=null,$annee=null) {
            //$this->Session->delete('history');
            $utilisateur = $utilisateur==null ? userAuth('id'):$utilisateur;
            $mois = $mois==null ? date('m') : $mois;
            $visible = $visible==null ? 1 :$visible;
            $indisponibilite = $indisponibilite==null ? 0 : $indisponibilite;
            $annee = $annee==null ? date('Y') : $annee;
            if (isAuthorized('facturations', 'index')) :            
                if (areaIsVisible() || $utilisateur==userAuth('id')):
                switch ($utilisateur){
                    case 'tous':
                    case '<':    
                    case null:
                        $newconditions[]="1=1";
                        $futilisateur = "tous les utilisateurs";
                        break;
                    default:
                        $newconditions[]="Facturation.utilisateur_id = ".$utilisateur;
                        $this->Facturation->Utilisateur->recursive = -1;
                        $utilisateur = $this->Facturation->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>$utilisateur)));
                        $futilisateur = $utilisateur['Utilisateur']['NOMLONG'];
                        break;                      
                }  
                else:
                    $newconditions[]="Facturation.utilisateur_id = ".userAuth('id');
                    $this->Facturation->Utilisateur->recursive = -1;
                    $utilisateur = $this->Facturation->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>userAuth('id'))));
                    $futilisateur = $utilisateur['Utilisateur']['NOMLONG'];                 
                endif;                
                $this->set('futilisateur',$futilisateur);
                switch ($mois){
                    case 'tous':
                    case null:
                        $newconditions[]="1=1";
                        $fperiode = "";
                        break;
                    default:
                        $dernierjour = date('t', mktime(0, 0, 0, $mois, 5, $annee));
                        $debut = $annee."-".$mois."-01";
                        $datedebut = startWeek($debut);
                        $datefin = $annee."-".$mois."-".$dernierjour;
                        $newconditions[]="Facturation.DATE BETWEEN '".$datedebut."' AND '".$datefin."'";
                        $moiscal = array('01'=>"janvier",'02'=>"février",'03'=>"mars",'04'=>"avril",'05'=>"mai",'06'=>"juin",'07'=>"juillet",'08'=>"août",'09'=>"septembre",'10'=>"octobre",'11'=>"novembre",'12'=>"décembre",);
                        $fperiode = "pour le mois de ".$moiscal[$mois]." ".$annee;
                        break;                      
                } 
                $this->set('fperiode',$fperiode);                
                $this->set('title_for_layout','Feuilles de temps facturées');
                switch ($visible){
                    case '1':
                        $newconditions[]="Facturation.VISIBLE=0";
                        break;
                    default:
                        $newconditions[]="1=1";
                        break;                      
                }  
                switch ($indisponibilite){
                    case '1':
                        $newconditions[]="Activite.projet_id!=1";
                        break;
                    default:
                        $newconditions[]="1=1";
                        break;                      
                }                  
                $this->Facturation->Utilisateur->recursive = -1;
                $utilisateurs = $this->Facturation->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.profil_id'=>-1)),'order'=>array('Utilisateur.NOMLONG' => 'asc')));
                $this->set('utilisateurs',$utilisateurs);
                $this->Facturation->recursive = 1;
                $group = $this->Facturation->find('all',array('fields'=>array('Facturation.VERSION','Facturation.DATE','Facturation.utilisateur_id','Facturation.NUMEROFTGALILEI','Utilisateur.NOM','Utilisateur.PRENOM','COUNT(Facturation.DATE) AS NBACTIVITE'),'group'=>array('Facturation.DATE','Facturation.utilisateur_id','Facturation.VERSION'),'order'=>array('Facturation.utilisateur_id' => 'asc','Facturation.DATE' => 'desc' ),'conditions'=>$newconditions));
                $this->set('groups',$group);
                $annee = $this->Facturation->find('all',array('fields'=>array('YEAR(Facturation.DATE) AS ANNEE'),'group'=>array('YEAR(Facturation.DATE)'),'order'=>array('YEAR(Facturation.DATE)' => 'asc')));
                $this->set('annees',$annee);                
                $this->paginate = array('limit'=>$this->Facturation->find('count'));                
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                 
		$this->Facturation->recursive = 0;
                $facturations = $this->Facturation->find('all',$this->paginate);
		$this->set('facturations', $facturations);
                $this->Facturation->recursive = 0;
                $export = $this->Facturation->find('all',array('conditions'=>$newconditions,'order' => array('Facturation.DATE' => 'asc')));
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
		if (!$this->Facturation->exists($id)) {
			throw new NotFoundException(__('Invalid facturation'));
		}
		$options = array('conditions' => array('Facturation.' . $this->Facturation->primaryKey => $id));
		$this->set('facturation', $this->Facturation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($userid=null,$reelid=null) {
                /** select all activités avec la même date et le même utilisateuyr **/
                $date = $this->Facturation->Activitesreelle->find('first',array('fields'=>array('Activitesreelle.DATE'),'conditions'=>array('Activitesreelle.id'=>$reelid),'recursive'=>-1));
                $activites = $this->Facturation->Activitesreelle->Activite->find('all',array('fields'=>array('id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'conditions'=>array('Activite.ACTIVE'=>1),'recursive'=>0));
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
                $activites = $this->Facturation->Activite->find('all',array('fields'=>array('id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'conditions'=>array('Activite.ACTIVE'=>1),'recursive'=>0));
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
	public function search() {
            if (isAuthorized('facturations', 'index')) :
                $this->set('title_for_layout','feuilles de temps à facturer');
                $keyword=isset($this->params->data['Facturation']['SEARCH']) ? $this->params->data['Facturation']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Facturation.VERSION = '".$keyword."'","Activite.NOM LIKE '%".$keyword."%'"));
                $utilisateurs = $this->Facturation->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.profil_id'=>-1)),'order'=>array('Utilisateur.NOMLONG' => 'asc')));
                $this->set('utilisateurs',$utilisateurs);                  
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Facturation->recursive = 0;
                $group = $this->Facturation->find('all',array('fields'=>array('Facturation.DATE','Facturation.utilisateur_id','Utilisateur.NOM','Utilisateur.PRENOM','COUNT(Facturation.DATE) AS NBACTIVITE'),'group'=>array('Facturation.DATE','Facturation.utilisateur_id'),'order'=>array('Facturation.utilisateur_id' => 'asc','Facturation.DATE' => 'desc'),'conditions'=>$newconditions));                    
                $this->set('groups',$group); 
                $this->set('facturations', $this->paginate());              
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();           
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
                $facturations = $this->request->data['Facturation'];
                unset($facturations['¤']);
                foreach($facturations as $facturation):
                    if (is_array($facturation)):
                        $this->Facturation->create();
                        if ($this->Facturation->save($facturation)) {
                            if (!isset($facturation['new'])):
                                $lastId = $this->Facturation->getLastInsertID();
                                $this->Facturation->Activitesreelle->id = $facturation['activitesreelle_id'];
                                $this->Facturation->Activitesreelle->saveField('facturation_id', $lastId);
                           endif;
                            if (isset($facturation['VERSION']) && $facturation['VERSION'] > 0):
                                $version = $facturation['VERSION']-1;
                                $oldFacturationId = $this->getOldFacturationId($facturation['utilisateur_id'], CUSDate($facturation['DATE']), $facturation['activite_id'], $version);
                                $this->Facturation->id = $oldFacturationId;
                                $this->Facturation->saveField('VISIBLE', 1);
                            endif;
                            $this->Session->setFlash(__('La facturation est sauvegardée'),'default',array('class'=>'alert alert-success'));
                        } else {
                            $this->Session->setFlash(__('La facturation est incorrecte, veuillez corriger la facturation'),'default',array('class'=>'alert alert-error'));
                        }                  
                    endif;
                endforeach;
                $this->History->goBack(1);
            }            
        }
        
        public function getOldFacturationId($utilisateur_id,$date,$activite_id,$version){
            $oldId = $this->Facturation->find('first',array('fields'=>array('Facturation.id'),'conditions'=>array('Facturation.utilisateur_id'=>$utilisateur_id,'Facturation.DATE'=>$date,'Facturation.activite_id'=>$activite_id,'Facturation.VERSION'=>$version),'recursive'=>-1));
            return $oldId['Facturation']['id'];
        }
        
/**
 * rapport
 */        
        public function rapport() {
            $this->set('title_for_layout','Rapport des facturations estimées');
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
                    //debug($byprojet);
                    //debug($byprojetactiviteutilisateur);
                    //debug($byprojetactivite);
                    //exit();
                    /*fin de la suppression des jours en trop*/
                    
                    $rapportresult = $this->Facturation->find('all',array('fields'=>array('MONTH(Facturation.DATE) AS MONTH', 'YEAR(Facturation.DATE) AS YEAR','Activite.projet_id','SUM(Facturation.TOTAL) AS NB'),'conditions'=>array($destinataire,$domaine,$periode,'Facturation.VISIBLE'=>0),'order'=>array('MONTH(Facturation.DATE)'=>'asc','YEAR(Facturation.DATE)'=>'asc'),'group'=>array('Activite.projet_id','MONTH(Facturation.DATE)','YEAR(Facturation.DATE)'),'recursive'=>0));
                    $this->set('rapportresults',$rapportresult);
                    $chartresult = $this->Facturation->find('all',array('fields'=>array('Activite.projet_id','SUM(Facturation.TOTAL) AS NB'),'conditions'=>array($destinataire,$domaine,$periode,'Facturation.VISIBLE'=>0),'order'=>array('Activite.projet_id'=>'asc'),'group'=>array('Activite.projet_id'),'recursive'=>0));
                    $this->set('chartresults',$chartresult);                    
                    $detailrapportresult = $this->Facturation->find('all',array('fields'=>array('MONTH(Facturation.DATE) AS MONTH', 'YEAR(Facturation.DATE) AS YEAR','Activite.id','Activite.NOM','Activite.projet_id','SUM(Facturation.TOTAL) AS NB'),'conditions'=>array($destinataire,$domaine,$periode,'Facturation.VISIBLE'=>0),'order'=>array('MONTH(Facturation.DATE)'=>'asc','YEAR(Facturation.DATE)'=>'asc'),'group'=>array('Activite.projet_id','Activite.NOM','MONTH(Facturation.DATE)','YEAR(Facturation.DATE)'),'recursive'=>0));
                    $this->set('detailrapportresults',$detailrapportresult);
                    $this->Session->delete('rapportresults');  
                    $this->Session->delete('detailrapportresults');                      
                    $this->Session->write('rapportresults',$rapportresult);
                    $this->Session->write('detailrapportresults',$detailrapportresult);
                    if ($this->request->data['Facturation']['RepartitionUtilisateur']==1):
                        $repartitions = $this->Facturation->find('all',array('fields'=>array('MONTH(Facturation.DATE) AS MONTH', 'YEAR(Facturation.DATE) AS YEAR','Utilisateur.id','Utilisateur.NOM','Utilisateur.PRENOM','Activite.projet_id','Activite.id','Activite.NOM','SUM(Facturation.TOTAL) AS NB'),'conditions'=>array($destinataire,$domaine,$periode,'Facturation.VISIBLE'=>0),'order'=>array('MONTH(Facturation.DATE)'=>'asc','YEAR(Facturation.DATE)'=>'asc','Facturation.utilisateur_id'=>'asc'),'group'=>array('Facturation.utilisateur_id','Activite.NOM','MONTH(Facturation.DATE)','YEAR(Facturation.DATE)'),'recursive'=>0));
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
                $destinataires = $this->Facturation->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id IN ('.substr_replace($listein ,"",-1).')'),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
                $this->set('destinataires',$destinataires);  
                $domaines = $this->Facturation->Activite->Projet->find('list',array('fields'=>array('id','NOM'),'order'=>array('Projet.NOM'),'recursive'=>-1));
                $this->set('domaines',$domaines);                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
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
                $this->Session->setFlash(__('Rapport impossible à éditer veuillez renouveler le calcul du rapport'),'default',array('class'=>'alert alert-error'));             
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
        
        public function forss2i(){
            $options = $this->params->params['pass'];
            $societes = $options['societes'];
            $utilisateurs = $this->requestAction('utilisateurs/insociete', array('pass'=>$societes));
            foreach($utilisateurs as $utilisateur):
                @$listutilisateurs .= $utilisateur['Utilisateur']['id'].',';
            endforeach;
            $destinataire = 'Facturation.utilisateur_id IN ('.substr_replace($listutilisateurs ,"",-1).')';
            $start = $options['start'];
            $end = $options['end'];
            $activitefirstweek = $this->Facturation->find('all',array('fields'=>array('Activite.id','Activite.projet_id','Facturation.utilisateur_id', 'SUM(Facturation.LU) AS LU', 'SUM(Facturation.MA) AS MA', 'SUM(Facturation.ME) AS ME', 'SUM(Facturation.JE) AS JE', 'SUM(Facturation.VE) AS VE', 'SUM(Facturation.SA) AS SA', 'SUM(Facturation.DI) AS DI','Facturation.DATE AS DATE'),'conditions'=>array($destinataire,'Facturation.VISIBLE'=>0,'Facturation.DATE'=>startWeek(CUSDate($start))),'group'=>array('Activite.projet_id','Activite.id','Facturation.utilisateur_id'),'recursive'=>0));  
            $activitelastweek = $this->Facturation->find('all',array('fields'=>array('Activite.id','Activite.projet_id','Facturation.utilisateur_id', 'SUM(Facturation.LU) AS LU', 'SUM(Facturation.MA) AS MA', 'SUM(Facturation.ME) AS ME', 'SUM(Facturation.JE) AS JE', 'SUM(Facturation.VE) AS VE', 'SUM(Facturation.SA) AS SA', 'SUM(Facturation.DI) AS DI','Facturation.DATE AS DATE'),'conditions'=>array($destinataire,'Facturation.VISIBLE'=>0,'Facturation.DATE'=>startWeek(CUSDate($end))),'group'=>array('Activite.projet_id','Activite.id','Facturation.utilisateur_id'),'recursive'=>0));  
            $entrop = array_merge($this->getEntropFirstSS2I($activitefirstweek),$this->getEntropLastSS2I($activitelastweek));
            $byprojetactiviteutilisateur = $this->array_sum_merge($entrop);
            $periode = 'Facturation.DATE BETWEEN "'. startWeek($start).'" AND "'.endWeek($end).'"';
            $indisponibilite = $options['indisponibilite'] ? '1=1': 'Activite.projet_id > 1';
            $result = $this->Facturation->find('all',array('fields'=>array('MONTH(Facturation.DATE) AS MONTH', 'YEAR(Facturation.DATE) AS YEAR','Utilisateur.id','Utilisateur.NOM','Utilisateur.PRENOM','Activite.projet_id','Utilisateur.societe_id','Activite.id','Activite.NOM','SUM(Facturation.TOTAL) AS NB'),'conditions'=>array($destinataire,$periode,$indisponibilite,'Facturation.VISIBLE'=>0),'order'=>array('Utilisateur.NOM'=>'asc','Utilisateur.PRENOM'=>'asc','Facturation.utilisateur_id'=>'asc'),'group'=>array('Facturation.utilisateur_id','Activite.NOM','MONTH(Facturation.DATE)','YEAR(Facturation.DATE)'),'recursive'=>0));
            return array('trop'=>$byprojetactiviteutilisateur,'result'=>$result);
        }
        
        public function getEntropFirstSS2I($activitefirstweek=null){
            $enmoins1 = array();
            $i=0;
            foreach($activitefirstweek as $firstweek):
                $annee = date('Y');
                $datetime1 = new DateTime(CUSDate($firstweek['Facturation']['DATE']));
                $datetime2 = new DateTime($annee.'-'.$this->request->data['Rapport']['mois'].'-01');
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
        
        public function getEntropLastSS2I($activitelastweek=null){
            $enmoins2 = array();
            $i=0;            
            foreach($activitelastweek as $lastweek):
                $annee = date('Y');
                $dayone = new DateTime($annee.'-'.$this->request->data['Rapport']['mois'].'-01');
                $lastday = $dayone->format('t');
                $datetime1 = new DateTime(CUSDate($lastweek['Facturation']['DATE']));
                $datetime2 = new DateTime($annee.'-'.$this->request->data['Rapport']['mois'].'-'.$lastday);
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