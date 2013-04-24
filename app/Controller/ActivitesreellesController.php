<?php
App::uses('AppController', 'Controller');
/**
 * Activitesreelles Controller
 *
 * @property Activitesreelle $Activitesreelle
 */
class ActivitesreellesController extends AppController {

        public $paginate = array(
        //'limit' => 9999,
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
            $this->Session->delete('history');
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
                $group = $this->Activitesreelle->find('all',array('fields'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id','Utilisateur.username','Utilisateur.NOM','Utilisateur.PRENOM','COUNT(Activitesreelle.DATE) AS NBACTIVITE'),'group'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id'),'order'=>array('Activitesreelle.utilisateur_id' => 'asc','Activitesreelle.DATE' => 'desc' ),'conditions'=>$newconditions));
                $this->set('groups',$group);
                $this->paginate = array('limit'=>$this->Activitesreelle->find('count'));
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
                $group = $this->Activitesreelle->find('all',array('fields'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id','Utilisateur.username','Utilisateur.NOM','Utilisateur.PRENOM','COUNT(Activitesreelle.DATE) AS NBACTIVITE'),'group'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id'),'order'=>array('Activitesreelle.utilisateur_id' => 'asc','Activitesreelle.DATE' => 'desc' ),'conditions'=>$newconditions));
                $this->set('groups',$group);                
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                 
		$this->Activitesreelle->recursive = 0;
                $activitesreeelles = $this->Activitesreelle->find('all',$this->paginate);
		$this->set('activitesreelles', $activitesreeelles);
                $this->Activitesreelle->recursive = 0;
                $export = $this->Activitesreelle->find('all',array('conditions'=>$newconditions,'order' => array('Activitesreelle.DATE' => 'asc')));
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
	public function add($utilisateur_id=null,$date=null,$action_id=null) {
            if (isAuthorized('activitesreelles', 'add')) :
                $this->set('title_for_layout','Feuilles de temps');            
		if ($this->request->is('post')) {
                $activitesreelles = $this->request->data['Activitesreelle'];  
                foreach($activitesreelles as $activitesreelle):
                    if (is_array($activitesreelle) && $activitesreelle['activite_id'] != ''):
                        $this->Activitesreelle->create();
                        if ($this->Activitesreelle->save($activitesreelle)):
                            $this->Session->setFlash(__('La feuille de temps est sauvegardée'),'default',array('class'=>'alert alert-success'));
                        else :
                            $this->Session->setFlash(__('La feuille de temps est incorrecte, veuillez corriger la feuille de temps'),'default',array('class'=>'alert alert-error'));
                        endif;   
                    endif;
                endforeach; 
                $this->redirect($this->goToPostion(2)); 
                }
                $this->Activitesreelle->Activite->recursive = 0;
                $activites = $this->Activitesreelle->Activite->find('all',array('fields'=>array('id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc')));
		$this->set('activites', $activites);               
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
 * newactivite method
 * 
 * liste des utilisateurs pour ensuite renvoyer vers la méthode add
 */        
        public function newactivite(){
            if (isAuthorized('activitesreelles', 'add')) :
                $this->set('title_for_layout','Feuilles de temps');            
		if ($this->request->is('post')) {
                    $this->redirect(array('action' => 'add',$this->data['Activitesreelle']['utilisateur_id'],  CUSDate($this->data['Activitesreelle']['DATE'])));
		}
                $this->Activitesreelle->Utilisateur->recursive = -1;
		$utilisateurs = $this->Activitesreelle->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.id>1','Utilisateur.GESTIONABSENCES'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
		$this->set('utilisateurs', $utilisateurs);
                $this->Activitesreelle->Utilisateur->recursive = -1;             
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
                    $activitesreelles = $this->request->data['Activitesreelle'];  
                    foreach($activitesreelles as $activitesreelle):
                        if (is_array($activitesreelle) && $activitesreelle['activite_id'] != ''):
                            $this->Activitesreelle->create();
                            if ($this->Activitesreelle->save($activitesreelle)):
                                $this->Session->setFlash(__('La feuille de temps est sauvegardée'),'default',array('class'=>'alert alert-success'));
                                
                            else :
                                $this->Session->setFlash(__('La feuille de temps est incorrecte, veuillez corriger la feuille de temps'),'default',array('class'=>'alert alert-error'));
                            endif;   
                        endif;
                    endforeach; 
                    $this->redirect($this->goToPostion(2)); 
		} else {
                    $date = $this->Activitesreelle->find('first',array('fields'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id'),'conditions'=>array('Activitesreelle.id'=>$id),'recursive'=>-1));
                    $activitesreelles = $this->Activitesreelle->find('all',array('conditions'=>array('Activitesreelle.utilisateur_id'=>$date['Activitesreelle']['utilisateur_id'],'Activitesreelle.DATE'=>CUSDate($date['Activitesreelle']['DATE'])),'recursive'=>-1));
                    $this->set('activitesreelles', $activitesreelles);
                    $activites = $this->Activitesreelle->Activite->find('all',array('fields'=>array('id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc')));
                    $this->set('activites', $activites);
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
                    $this->redirect($this->goToPostion());
		}
                $this->Session->setFlash(__('Feuille de temps <b>NON</b> supprimée'),'default',array('class'=>'alert alert-error'));
                $this->redirect($this->goToPostion());
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
        
/**
 * rapport
 */        
        public function rapport() {
               $this->set('title_for_layout','Rapport des activités réelles');
	} 
        
        public function facturer(){
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
                    $this->Activitesreelle->Facturation->create();
                    if($this->Activitesreelle->Facturation->save($newFacturation)){
                        $lastInsert = $this->Activitesreelle->Facturation->getLastInsertID();
                        $this->Activitesreelle->id = $id;
                        $this->Activitesreelle->saveField('facturation_id', $lastInsert);
                    }
                endforeach;
                echo $this->Session->setFlash(__('Feuilles de temps facturées'),'default',array('class'=>'alert alert-success'));
            else:
                echo $this->Session->setFlash(__('Aucune feuilles de temps sélectionnées'),'default',array('class'=>'alert alert-error'));
            endif;
            exit();
            //$this->redirect($this->goToPostion());
        }
        
        public function rejeter(){
            $ids = explode ('-', $this->request->data('all_ids'));
            if(count($ids)>0 && $ids[0]!=""):            
                foreach($ids as $id):
                    $this->Activitesreelle->id = $id;
                    $this->Activitesreelle->saveField('VEROUILLE', 1);                    
                endforeach;
                echo $this->Session->setFlash(__('Feuilles de temps rejetées'),'default',array('class'=>'alert alert-success'));
            else:
                echo $this->Session->setFlash(__('Aucune feuilles de temps sélectionnées'),'default',array('class'=>'alert alert-error'));                
            endif;
            exit();
            //$this->redirect($this->goToPostion());
        }  
        
        public function deverouiller($id){
            $this->Activitesreelle->id = $id;
            $this->Activitesreelle->saveField('VEROUILLE', 1);        
            $this->Activitesreelle->saveField('facturation_id', null);            
            echo $this->Session->setFlash(__('Feuille de temps déverouillée'),'default',array('class'=>'alert alert-success'));
            $this->redirect($this->goToPostion());
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
