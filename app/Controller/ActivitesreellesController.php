<?php
App::uses('AppController', 'Controller');
/**
 * Activitesreelles Controller
 *
 * @property Activitesreelle $Activitesreelle
 */
class ActivitesreellesController extends AppController {

        public $paginate = array(
        //'limit' => 15,
        //'threaded',
        'order' => array('Activitesreelle.utilisateur_id' => 'asc','Activitesreelle.DATE' => 'desc'),
        //'group'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id'),
        );
        
/**
 * index method
 *
 * @return void
 */
	public function index($etat=null,$utilisateur=null,$mois=null) {
            if (isAuthorized('activitesreelles', 'index')) :
                switch ($etat){
                    case 'tous':
                        $newconditions[]="1=1";
                        $fetat = "toutes les feuilles de temps";
                        break;
                    case 'actif':
                    case null:
                        $newconditions[]="Activitesreelle.VEROUILLE = 1";
                        $fetat = "toutes les feuilles de temps actives";
                        break;                    
                    case 'facture':
                        $newconditions[]="Activitesreelle.VEROUILLE = 0";
                        $fetat = "toutes les feuilles de temps facturées";
                        break;                      
                }  
                $this->set('fetat',$fetat); 
                if (areaIsVisible() || $utilisateur==userAuth('id')):
                switch ($utilisateur){
                    case 'tous':
                    case null:
                        $newconditions[]="1=1";
                        $futilisateur = "tous les utilisateurs";
                        break;
                    default:
                        $newconditions[]="Activitesreelle.utilisateur_id = ".$utilisateur;
                        $this->Activitesreelle->Utilisateur->recursive = -1;
                        $utilisateur = $this->Activitesreelle->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>$utilisateur,'Utilisateur.GESTIONABSENCES'=>1)));
                        $futilisateur = $utilisateur['Utilisateur']['NOMLONG'];
                        break;                      
                }  
                else:
                    $newconditions[]="Activitesreelle.utilisateur_id = ".userAuth('id');
                    $this->Activitesreelle->Utilisateur->recursive = -1;
                    $utilisateur = $this->Activitesreelle->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>userAuth('id'))));
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
                $this->set('title_for_layout','Feuilles de temps');
                $this->Activitesreelle->Utilisateur->recursive = -1;
                $utilisateurs = $this->Activitesreelle->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.GESTIONABSENCES'=>1),'order'=>array('Utilisateur.NOMLONG' => 'asc')));
                $this->set('utilisateurs',$utilisateurs);
                $this->Activitesreelle->recursive = 1;
                $group = $this->Activitesreelle->find('all',array('fields'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id','Utilisateur.NOM','Utilisateur.PRENOM','COUNT(Activitesreelle.DATE) AS NBACTIVITE'),'group'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id'),'order'=>array('Activitesreelle.utilisateur_id' => 'asc','Activitesreelle.DATE' => 'desc' ),'conditions'=>$newconditions));
                $this->set('groups',$group);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                 
		$this->Activitesreelle->recursive = 0;
                $activitesreeelles = $this->Activitesreelle->find('all',$this->paginate);
		$this->set('activitesreelles', $activitesreeelles);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();            
            endif;                
	}

 /**
 * afacturer method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function afacturer($etat=null,$utilisateur=null,$mois=null) {
            if (isAuthorized('activitesreelles', 'index')) :
                $newconditions[]="Activitesreelle.facturation_id IS NULL";                
                switch ($etat){
                    case 'tous':
                        $newconditions[]="1=1";
                        $fetat = "toutes les feuilles de temps";
                        break;
                    case 'actif':
                        $newconditions[]="Activitesreelle.VEROUILLE = 1";
                        $fetat = "toutes les feuilles de temps actives";
                        break;                    
                    case 'facture':
                    case null:
                        $newconditions[]="Activitesreelle.VEROUILLE = 0";
                        $fetat = "toutes les feuilles de temps facturées";
                        break;                      
                }  
                $this->set('fetat',$fetat); 
                if (areaIsVisible() || $utilisateur==userAuth('id')):
                switch ($utilisateur){
                    case 'tous':
                    case null:
                        $newconditions[]="1=1";
                        $futilisateur = "tous les utilisateurs";
                        break;
                    default:
                        $newconditions[]="Activitesreelle.utilisateur_id = ".$utilisateur;
                        $this->Activitesreelle->Utilisateur->recursive = -1;
                        $utilisateur = $this->Activitesreelle->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>$utilisateur,'Utilisateur.GESTIONABSENCES'=>1)));
                        $futilisateur = $utilisateur['Utilisateur']['NOMLONG'];
                        break;                      
                }  
                else:
                    $newconditions[]="Activitesreelle.utilisateur_id = ".userAuth('id');
                    $this->Activitesreelle->Utilisateur->recursive = -1;
                    $utilisateur = $this->Activitesreelle->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>userAuth('id'))));
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
                $this->set('title_for_layout','Feuilles de temps à facturer');
                $this->Activitesreelle->Utilisateur->recursive = -1;
                $utilisateurs = $this->Activitesreelle->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.GESTIONABSENCES'=>1),'order'=>array('Utilisateur.NOMLONG' => 'asc')));
                $this->set('utilisateurs',$utilisateurs);
                $this->Activitesreelle->recursive = 1;
                $group = $this->Activitesreelle->find('all',array('fields'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id','Utilisateur.NOM','Utilisateur.PRENOM','COUNT(Activitesreelle.DATE) AS NBACTIVITE'),'group'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id'),'order'=>array('Activitesreelle.utilisateur_id' => 'asc','Activitesreelle.DATE' => 'desc' ),'conditions'=>$newconditions));
                $this->set('groups',$group);                
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                 
		$this->Activitesreelle->recursive = 0;
                $activitesreeelles = $this->Activitesreelle->find('all',$this->paginate);
		$this->set('activitesreelles', $activitesreeelles);
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
            if (isAuthorized('activitesreelles', 'view')) :
                $this->set('title_for_layout','Feuilles de temps');            
		if (!$this->Activitesreelle->exists($id)) {
			throw new NotFoundException(__('Feuille de temps incorrecte'));
		}
		$options = array('conditions' => array('Activitesreelle.' . $this->Activitesreelle->primaryKey => $id));
		$this->set('activitesreelle', $this->Activitesreelle->find('first', $options));
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
	public function add($utilisateur_id=null,$action_id=null) {
            if (isAuthorized('activitesreelles', 'add')) :
                $this->set('title_for_layout','Feuilles de temps');            
		if ($this->request->is('post')) {
                        if ($utilisateur_id!=null) $this->request->data['Activitesreelle']['utilisateur_id']=$utilisateur_id ;
                        $this->request->data['Activitesreelle']['action_id']=$action_id;
                        if ($this->ActiviteExists($this->request->data['Activitesreelle']['utilisateur_id'], $this->request->data['Activitesreelle']['DATE'], $this->request->data['Activitesreelle']['activite_id']) > 0){
                            $this->Session->setFlash(__('Feuille de temps existante'),'default',array('class'=>'alert alert-info'));
                            $this->redirect(array('action' => 'edit',$this->ActiviteExists($this->request->data['Activitesreelle']['utilisateur_id'], $this->request->data['Activitesreelle']['DATE'], $this->request->data['Activitesreelle']['activite_id'])));
                        }
			$this->Activitesreelle->create();
                        if ($this->Activitesreelle->save($this->request->data)) {
				$this->Session->setFlash(__('Feuille de temps créée'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'edit',$this->Activitesreelle->getLastInsertID()));
			} else {
				$this->Session->setFlash(__('Feuille de temps incorrecte, veuillez corriger la feuille de temps'),'default',array('class'=>'alert alert-error'));
			}
		}
                $condition=array("1=1");
                if ($action_id != null) {
                    $condition = ('Activite.projet_id > 1');
                }
                $this->Activitesreelle->Activite->recursive = 0;
                $activites = $this->Activitesreelle->Activite->find('all',array('fields'=>array('id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'conditions'=>$condition));
		$this->set('activites', $activites);
                $this->Activitesreelle->Utilisateur->recursive = -1;
		$utilisateurs = $this->Activitesreelle->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.id>1','Utilisateur.GESTIONABSENCES'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
		$this->set('utilisateurs', $utilisateurs);
                $this->Activitesreelle->Utilisateur->recursive = -1;
		$nomlong = $this->Activitesreelle->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>  userAuth('id'))));
		$this->set('nomlong', $nomlong);                
                if ($action_id != null) :
                $this->Activitesreelle->Action->recursive = -1;
                $action = $this->Activitesreelle->Action->find('first',array('conditions'=>array('Action.id'=>$action_id)));
                    $this->request->data['Activitesreelle']['utilisateur_id'] = $action['Action']['utilisateur_id'];
                    $this->request->data['Activitesreelle']['DATE'] = $action['Action']['DEBUT'];
                    $this->request->data['Activitesreelle']['activite_id'] = $action['Action']['activite_id'];
                endif;
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
            if (isAuthorized('activitesreelles', 'edit')) :
                $this->set('title_for_layout','Feuilles de temps');            
		if (!$this->Activitesreelle->exists($id)) {
			throw new NotFoundException(__('Feuille de temps incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Activitesreelle->save($this->request->data)) {
				$this->Session->setFlash(__('Feuille de temps sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Feuille de temps incorrecte veuillez corriger la feuille de temps'),'default',array('class'=>'alert alert-error'));
			}
		} else {
                        $this->Activitesreelle->recursive = 0;
			$options = array('conditions' => array('Activitesreelle.' . $this->Activitesreelle->primaryKey => $id));
			$this->request->data = $this->Activitesreelle->find('first', $options);
		}
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
            if (isAuthorized('activitesreelles', 'delete')) :
                $this->set('title_for_layout','Feuilles de temps');            
		$this->Activitesreelle->id = $id;
		if (!$this->Activitesreelle->exists()) {
			throw new NotFoundException(__('Feuille de temps incorrecte'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Activitesreelle->delete()) {
				$this->Session->setFlash(__('Feuille de temps supprimée'),'default',array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index'));
		}
				$this->Session->setFlash(__('Feuille de temps <b>NON</b> supprimée'),'default',array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();        
            endif;                
	}
        
/**
 * duplicate method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function duplicate($id = null) {
            if (isAuthorized('activitesreelles', 'duplicate')) :
                $this->set('title_for_layout','Feuilles de temps');  
                $this->Activitesreelle->id = $id;
                $record = $this->Activitesreelle->read();
                $date = $record['Activitesreelle']['DATE'];
                unset($record['Activitesreelle']['id']);
                unset($record['Activitesreelle']['DATE']);
                unset($record['Activitesreelle']['created']);                
                unset($record['Activitesreelle']['modified']);
                $date = new DateTime($this->Activitesreelle->CUSDate($date));
                $date->add(new DateInterval('P7D'));                
                $record['Activitesreelle']['DATE'] = $date->format('d/m/Y');
                if ($this->ActiviteExists($record['Activitesreelle']['utilisateur_id'], $record['Activitesreelle']['DATE'], $record['Activitesreelle']['activite_id']) > 0){
                    $this->Session->setFlash(__('Feuille de temps existante'),'default',array('class'=>'alert alert-info'));
                    $this->redirect(array('action' => 'edit',$this->ActiviteExists($record['Activitesreelle']['utilisateur_id'], $record['Activitesreelle']['DATE'], $record['Activitesreelle']['activite_id'])));
                }                
                $this->Activitesreelle->create();
                if ($this->Activitesreelle->save($record)) {
                        $this->Session->setFlash(__('Feuille de temps dupliquée'),'default',array('class'=>'alert alert-success'));
                        $this->redirect(array('action' => 'edit',$this->Activitesreelle->getLastInsertID()));
                } 
		$this->Session->setFlash(__('Feuille de temps <b>NON</b> dupliqué'),'default',array('class'=>'alert alert-error'));    
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}  
        
/**
 * autoduplicate method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function autoduplicate($id = null) {
            if (isAuthorized('activitesreelles', 'update')) :
                $this->set('title_for_layout','Feuilles de temps');  
                $this->Activitesreelle->id = $id;
                $record = $this->Activitesreelle->read();
                $date = $record['Activitesreelle']['DATE'];
                unset($record['Activitesreelle']['id']);
                unset($record['Activitesreelle']['DATE']);
                unset($record['Activitesreelle']['created']);                
                unset($record['Activitesreelle']['modified']);
                $date = new DateTime($this->Activitesreelle->CUSDate($date));
                $date->add(new DateInterval('P7D'));                
                $record['Activitesreelle']['DATE'] = $date->format('d/m/Y');
                if ($this->ActiviteExists($record['Activitesreelle']['utilisateur_id'], $record['Activitesreelle']['DATE'], $record['Activitesreelle']['activite_id']) > 0){
                    $this->Session->setFlash(__('Feuille de temps existante'),'default',array('class'=>'alert alert-info'));
                    $this->redirect($this->goToPostion());
                }                
                $this->Activitesreelle->create();
                if ($this->Activitesreelle->save($record)) {
                    $this->Session->setFlash(__('Feuille de temps dupliquée'),'default',array('class'=>'alert alert-success'));
                    $this->redirect($this->goToPostion());
                } 
		$this->Session->setFlash(__('Feuille de temps <b>NON</b> dupliqué'),'default',array('class'=>'alert alert-error'));  
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();        
            endif;                
	}   
        
/**
 * updatefacturation method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function updatefacturation($id = null) {
            if (isAuthorized('activitesreelles', 'update')) :
                $this->set('title_for_layout','Feuilles de temps');  
                $this->Activitesreelle->id = $id;
                $record = $this->Activitesreelle->read();
                unset($record['Activitesreelle']['created']);                
                unset($record['Activitesreelle']['modified']);
                $record['Activitesreelle']['created'] = $this->Activitesreelle->read('created');
                $record['Activitesreelle']['modified'] = date('Y-m-d');                 
                $record['Activitesreelle']['VEROUILLE'] = 0;
                $record['Activitesreelle']['facturation_id'] = null;                
                $this->Activitesreelle->create();
                if ($this->Activitesreelle->save($record)) {
                    $this->Session->setFlash(__('Feuille de temps mise à jour pour facturation'),'default',array('class'=>'alert alert-success'));
                    $this->redirect($this->goToPostion());
                } 
		$this->Session->setFlash(__('Feuille de temps <b>NON</b> mise à jour pour facturation'),'default',array('class'=>'alert alert-error')); 
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();           
            endif;                
	}   
        
/**
 * errorfacturation method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function errorfacturation($id = null) {
            if (isAuthorized('activitesreelles', 'update')) :
                $this->set('title_for_layout','Feuilles de temps');  
                $this->Activitesreelle->id = $id;
                $record = $this->Activitesreelle->read();
                unset($record['Activitesreelle']['created']);                
                unset($record['Activitesreelle']['modified']);
                $record['Activitesreelle']['created'] = $this->Activitesreelle->read('created');
                $record['Activitesreelle']['modified'] = date('Y-m-d');                 
                $record['Activitesreelle']['VEROUILLE'] = 1;
                $this->Activitesreelle->create();
                if ($this->Activitesreelle->save($record)) {
                    $this->Session->setFlash(__('Feuille de temps mise à jour pour facturation'),'default',array('class'=>'alert alert-success'));
                    $this->redirect($this->goToPostion());
                } 
		$this->Session->setFlash(__('Feuille de temps <b>NON</b> mise à jour pour facturation'),'default',array('class'=>'alert alert-error')); 
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
            if (isAuthorized('activitesreelles', 'index')) :
                $this->set('title_for_layout','feuilles de temps');
                $keyword=isset($this->params->data['Activitesreelle']['SEARCH']) ? $this->params->data['Activitesreelle']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Activite.NOM LIKE '%".$keyword."%'"));
                $this->Activitesreelle->recursive = 0;
                $group = $this->Activitesreelle->find('all',array('fields'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id','Utilisateur.NOM','Utilisateur.PRENOM','COUNT(Activitesreelle.DATE) AS NBACTIVITE'),'group'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id'),'order'=>array('Activitesreelle.utilisateur_id' => 'asc','Activitesreelle.DATE' => 'desc'),'conditions'=>$newconditions));
                $this->set('groups',$group); 
                $utilisateurs = $this->Activitesreelle->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.GESTIONABSENCES'=>1),'order'=>array('Utilisateur.NOMLONG' => 'asc')));
                $this->set('utilisateurs',$utilisateurs);                
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Activitesreelle->recursive = 0;
                $activitesreeelles = $this->Activitesreelle->find('all',$this->paginate);
		$this->set('activitesreelles', $activitesreeelles);             
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();           
            endif;                
        }          
        
/**
 * ActiviteExists method
 * 
 * @param type $utilisateurId
 * @param type $date
 * @param type $activite
 * @return l'id de l'activité si elle existe
 */        
        public function ActiviteExists($utilisateurId, $date, $activite){
            $this->Activitesreelle->recursive = 0;
            $allActivite = $this->Activitesreelle->find('first',array('conditions'=>array('Activitesreelle.utilisateur_id'=>$utilisateurId,'Activitesreelle.activite_id'=>$activite,'Activitesreelle.DATE'=>$this->Activitesreelle->CUSDate($this->Activitesreelle->debutsem($date)))));
            return isset($allActivite['Activitesreelle']) ? $allActivite['Activitesreelle']['id'] : 0;
        }   
        
        public function Absences(){
            $this->Activitesreelle->Utilisateur->recursive = -1;
            $utilisateurs = $this->Activitesreelle->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG','Utilisateur.username','Utilisateur.NOM','Utilisateur.PRENOM'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.GESTIONABSENCES'=>1),'order'=>array('Utilisateur.NOMLONG' => 'asc')));
            $this->set('utilisateurs',$utilisateurs);  
            $date = isset($this->request->data['Activitesreelle']['month']) ? $this->request->data['Activitesreelle']['month'] : date('Y-m-d');
            $annee = date('Y',strtotime($date));
            $mois = date('m',strtotime($date));
            $dernierjour = date('t', mktime(0, 0, 0, $mois, 5, $annee));
            $datedebut = $annee."-".$mois."-01";
            $datedebut = startWeek(new DateTime($datedebut));            
            $datefin = $annee."-".$mois."-".$dernierjour;
            $this->Activitesreelle->recursive = 0;
            $indisponibilites = $this->Activitesreelle->find('all',array('conditions'=>array('Activite.projet_id'=>1,"Activitesreelle.DATE BETWEEN '".$datedebut."' AND '".$datefin."'")));
            $this->set('indisponibilites',$indisponibilites);
        }
}
