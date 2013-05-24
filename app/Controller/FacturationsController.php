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
	public function index($utilisateur=null,$mois=null,$visible=null,$indisponibilite=null) {
            //$this->Session->delete('history');
            $utilisateur = $utilisateur==null ? userAuth('id'):$utilisateur;
            $mois = $mois==null ? date('m') : $mois;
            $visible = $visible==null ? 1 :$visible;
            $indisponibilite = $indisponibilite==null ? 0 : $indisponibilite;
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
                        $annee = date('Y');
                        $dernierjour = date('t', mktime(0, 0, 0, $mois, 5, $annee));
                        $debut = $annee."-".$mois."-01";
                        $datedebut = startWeek($debut);
                        $datefin = $annee."-".$mois."-".$dernierjour;
                        $newconditions[]="Facturation.DATE BETWEEN '".$datedebut."' AND '".$datefin."'";
                        $moiscal = array('01'=>"janvier",'02'=>"février",'03'=>"mars",'04'=>"avril",'05'=>"mai",'06'=>"juin",'07'=>"juillet",'08'=>"août",'09'=>"septembre",'10'=>"octobre",'11'=>"novembre",'12'=>"décembre",);
                        $fperiode = "pour le mois de ".$moiscal[$mois];
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
                foreach($facturations as $facturation):
                    if (is_array($facturation) && $facturation['activite_id']!=''):
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
                    $rapportresult = $this->Facturation->find('all',array('fields'=>array('MONTH(Facturation.DATE) AS MONTH', 'YEAR(Facturation.DATE) AS YEAR','Activite.projet_id','SUM(Facturation.TOTAL) AS NB'),'conditions'=>array($destinataire,$domaine,$periode,'Facturation.VISIBLE'=>0),'order'=>array('MONTH(Facturation.DATE)'=>'asc','YEAR(Facturation.DATE)'=>'asc'),'group'=>array('Activite.projet_id','MONTH(Facturation.DATE)','YEAR(Facturation.DATE)'),'recursive'=>0));
                    $this->set('rapportresults',$rapportresult);
                    $chartresult = $this->Facturation->find('all',array('fields'=>array('Activite.projet_id','SUM(Facturation.TOTAL) AS NB'),'conditions'=>array($destinataire,$domaine,$periode,'Facturation.VISIBLE'=>0),'order'=>array('Activite.projet_id'=>'asc'),'group'=>array('Activite.projet_id'),'recursive'=>0));
                    $this->set('chartresults',$chartresult);                    
                    $detailrapportresult = $this->Facturation->find('all',array('fields'=>array('MONTH(Facturation.DATE) AS MONTH', 'YEAR(Facturation.DATE) AS YEAR','Activite.NOM','Activite.projet_id','SUM(Facturation.TOTAL) AS NB'),'conditions'=>array($destinataire,$domaine,$periode,'Facturation.VISIBLE'=>0),'order'=>array('MONTH(Facturation.DATE)'=>'asc','YEAR(Facturation.DATE)'=>'asc'),'group'=>array('Activite.projet_id','Activite.NOM','MONTH(Facturation.DATE)','YEAR(Facturation.DATE)'),'recursive'=>0));
                    $this->set('detailrapportresults',$detailrapportresult);
                    $this->Session->delete('rapportresults');  
                    $this->Session->delete('detailrapportresults');                      
                    $this->Session->write('rapportresults',$rapportresult);
                    $this->Session->write('detailrapportresults',$detailrapportresult);
                    if ($this->request->data['Facturation']['RepartitionUtilisateur']==1):
                        $repartitions = $this->Facturation->find('all',array('fields'=>array('MONTH(Facturation.DATE) AS MONTH', 'YEAR(Facturation.DATE) AS YEAR','Utilisateur.NOM','Utilisateur.PRENOM','Activite.projet_id','Activite.NOM','SUM(Facturation.TOTAL) AS NB'),'conditions'=>array($destinataire,$domaine,$periode,'Facturation.VISIBLE'=>0),'order'=>array('MONTH(Facturation.DATE)'=>'asc','YEAR(Facturation.DATE)'=>'asc','Facturation.utilisateur_id'=>'asc'),'group'=>array('Facturation.utilisateur_id','Activite.NOM','MONTH(Facturation.DATE)','YEAR(Facturation.DATE)'),'recursive'=>0));
                        $this->set('repartitions',$repartitions);
                        $this->Session->delete('repartitionresults');
                        $this->Session->write('repartitionresults',$repartitions);
                    endif;
                endif;
                $destinataires = $this->Facturation->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.profil_id'=>-1)),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
                $this->set('destinataires',$destinataires);  
                $domaines = $this->Facturation->Activite->Projet->find('list',array('fields'=>array('id','NOM'),'order'=>array('Projet.NOM'),'recursive'=>-1));
                $this->set('domaines',$domaines);                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;             
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
}