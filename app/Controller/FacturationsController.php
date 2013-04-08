<?php
App::uses('AppController', 'Controller');
/**
 * Facturations Controller
 *
 * @property Facturation $Facturation
 */
class FacturationsController extends AppController {
    
/**
 * index method
 *
 * @return void
 */
	public function index($utilisateur=null,$mois=null) {
            if (isAuthorized('activitesreelles', 'index')) :            
                if (areaIsVisible() || $utilisateur==userAuth('id')):
                switch ($utilisateur){
                    case 'tous':
                    case null:
                        $newconditions[]="1=1";
                        $futilisateur = "tous les utilisateurs";
                        break;
                    default:
                        $newconditions[]="Activitesreelle.utilisateur_id = ".$utilisateur;
                        $this->Facturation->Utilisateur->recursive = -1;
                        $utilisateur = $this->Facturation->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>$utilisateur,'Utilisateur.GESTIONABSENCES'=>1)));
                        $futilisateur = $utilisateur['Utilisateur']['NOMLONG'];
                        break;                      
                }  
                else:
                    $newconditions[]="Activitesreelle.utilisateur_id = ".userAuth('id');
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
                        $datedebut = $annee."-".$mois."-01";
                        $datefin = $annee."-".$mois."-".$dernierjour;
                        $newconditions[]="Activitesreelle.DATE BETWEEN '".$datedebut."' AND '".$datefin."'";
                        $moiscal = array('01'=>"janvier",'02'=>"février",'03'=>"mars",'04'=>"avril",'05'=>"mai",'06'=>"juin",'07'=>"juillet",'08'=>"août",'09'=>"septembre",'10'=>"octobre",'11'=>"novembre",'12'=>"décembre",);
                        $fperiode = "pour le mois de ".$moiscal[$mois];
                        break;                      
                }  
                $this->set('fperiode',$fperiode);                
                $this->set('title_for_layout','Feuilles de temps facturées');
                $this->Facturation->Utilisateur->recursive = -1;
                $utilisateurs = $this->Facturation->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.GESTIONABSENCES'=>1),'order'=>array('Utilisateur.NOMLONG' => 'asc')));
                $this->set('utilisateurs',$utilisateurs);
                $this->Facturation->recursive = 1;
                $group = $this->Facturation->find('all',array('fields'=>array('Facturation.VERSION','Facturation.DATE','Facturation.utilisateur_id','Facturation.NUMEROFTGALILEI','Utilisateur.NOM','Utilisateur.PRENOM','COUNT(Facturation.DATE) AS NBACTIVITE'),'group'=>array('Facturation.DATE','Facturation.utilisateur_id','VERSION'),'order'=>array('Facturation.utilisateur_id' => 'asc','Facturation.DATE' => 'desc' ),'conditions'=>$newconditions));
                $this->set('groups',$group);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                 
		$this->Facturation->recursive = 0;
                $facturations = $this->Facturation->find('all',$this->paginate);
		$this->set('facturations', $facturations);
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
                $activitesreelles = $this->Facturation->Activitesreelle->find('all',array('conditions'=>array('Activitesreelle.utilisateur_id'=>$userid,'Activitesreelle.DATE'=>CUSDate($date['Activitesreelle']['DATE']),'Activitesreelle.VEROUILLE'=>0),'recursive'=>-1));
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
                $newconditions = array('OR'=>array("Facturation.VERSION LIKE '%".$keyword."%'","Activite.NOM LIKE '%".$keyword."%'"));
                $group = $this->Facturation->find('all',array('fields'=>array('Facturation.DATE','Facturation.utilisateur_id','Utilisateur.NOM','Utilisateur.PRENOM','COUNT(Facturation.DATE) AS NBACTIVITE'),'group'=>array('Facturation.DATE','Facturation.utilisateur_id'),'order'=>array('Facturation.utilisateur_id' => 'asc','Facturation.DATE' => 'desc'),'conditions'=>$newconditions));                    
                $this->set('groups',$group); 
                $utilisateurs = $this->Activitesreelle->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.GESTIONABSENCES'=>1),'order'=>array('Utilisateur.NOMLONG' => 'asc')));
                $this->set('utilisateurs',$utilisateurs);                  
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Facturation->recursive = 0;
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
                $sql = 'SELECT * FROM activitesreelles AS Activitesreelle WHERE Activitesreelle.utilisateur_id = '.$userid.' AND Activitesreelle.DATE = "'.$date.'"';
                return $this->request->query($sql);
        }
        
        public function save(){
            if ($this->request->is('post')) {
                $facturations = $this->request->data['Facturation'];
                foreach($facturations as $facturation):
                    if (is_array($facturation) && $facturation['activite_id']!=''):
                        $this->Facturation->create();
                        if ($this->Facturation->save($facturation)) {
                            if (isset($facturation['activitesreelle_id']) && $facturation['activitesreelle_id'] != ''):
                                $lastId = $this->Facturation->getLastInsertID();
                                $this->Facturation->Activitesreelle->id = $facturation['activitesreelle_id'];
                                $this->Facturation->Activitesreelle->saveField('facturation_id', $lastId);
                            endif;
                            $this->Session->setFlash(__('La facturation est sauvegardée'),'default',array('class'=>'alert alert-success'));
                        } else {
                            $this->Session->setFlash(__('La facturation est incorrecte, veuillez corriger la facturation'),'default',array('class'=>'alert alert-success'));
                        }                  
                    endif;
                endforeach;
                $this->redirect($this->goToPostion(1));
            }            
        }
}
