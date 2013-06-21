<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Utiliseoutils Controller
 *
 * @property Utiliseoutil $Utiliseoutil
 */
class UtiliseoutilsController extends AppController {
        public $components = array('History'); 
    public $paginate = array(
        'limit' => 15,
        'order' => array('Utiliseoutil.created' => 'desc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
    public function beforeFilter() {   
        $this->Auth->allow(array('mailupdate'));
        parent::beforeFilter();
    }   
        
/**
 * index method
 *
 * @return void
 */
	public function index($filtreetat=null,$utilisateur_id=null,$filtreoutil=null) {
            //$this->Session->delete('history');
            if (isAuthorized('utiliseoutils', 'index')) :
		$this->set('title_for_layout','Ouvertures des droits');
                switch ($filtreetat){
                    case 'tous':
                    case '<':     
                    case null:    
                        $newconditions[]="Utiliseoutil.STATUT !='Retour utilisateur'";
                        $fetat = "de tous les états sauf 'Retour utilisateur'";
                        break;
                    default :
                        $newconditions[]="Utiliseoutil.STATUT='".$filtreetat."'";
                        $fetat = "avec l'état ".$filtreetat;                        
                }    
                $this->set('fetat',$fetat);   
                switch ($utilisateur_id){
                    case 'tous':
                    case null:    
                        $newconditions[]="1=1";
                        $futilisateur = "de tous les utilisateurs";
                        break;                      
                    default :
                        $newconditions[]="Utiliseoutil.utilisateur_id = '".$utilisateur_id."'";
                        $this->Utiliseoutil->Utilisateur->recursive = -1;
                        $nomlong = $this->Utiliseoutil->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array('Utilisateur.id'=> $utilisateur_id)));
                        $futilisateur = "de ".$nomlong['Utilisateur']['NOMLONG'];                     
                    }                     
                $this->set('futilisateur',$futilisateur);  
                switch ($filtreoutil){
                    case 'tous':
                    case null:    
                        $newconditions[]="1=1";
                        $foutil = " pour tous les outils";
                        break;                      
                    default :
                        $outil = explode('_',$filtreoutil);
                        if ($outil[0]=='O'):
                            $newconditions[]="Utiliseoutil.outil_id = '".$outil[1]."'";
                            $nomlong = $this->Utiliseoutil->Outil->find('first',array('fields'=>array('NOM'),'conditions'=>array('id'=> $outil[1]),'recursive'=>-1));
                            $foutil = " pour ".$nomlong['Outil']['NOM']; 
                        endif;
                        if ($outil[0]=='L'):
                            $newconditions[]="Utiliseoutil.listediffusion_id = '".$outil[1]."'";
                            $nomlong = $this->Utiliseoutil->Listediffusion->find('first',array('fields'=>array('NOM'),'conditions'=>array('id'=> $outil[1]),'recursive'=>-1));
                            $foutil = " pour ".$nomlong['Listediffusion']['NOM']; 
                        endif;
                        if ($outil[0]=='P'):
                            $newconditions[]="Utiliseoutil.dossierpartage_id = '".$outil[1]."'";
                            $nomlong = $this->Utiliseoutil->Dossierpartage->find('first',array('fields'=>array('NOM'),'conditions'=>array('id'=> $outil[1]),'recursive'=>-1));
                            $foutil = " pour ".$nomlong['Dossierpartage']['NOM']; 
                        endif;                        
                }                     
                $this->set('foutil',$foutil);                  
                if (userAuth('WIDEAREA')==0) {$newconditions[]="Utilisateur.section_id=".userAuth('section_id');}
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->Utiliseoutil->recursive = 0;
		$this->set('utiliseoutils', $this->paginate());
                $conditions = array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id > 0');
                if (userAuth('WIDEAREA')==0) {$restriction[]="Utilisateur.section_id=".userAuth('section_id'); $conditions = array_merge_recursive($conditions,$restriction);}
                $this->Utiliseoutil->Utilisateur->recursive = -1;
                $utilisateurs = $this->Utiliseoutil->Utilisateur->find('all',array('fields' => array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>$conditions,'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('utilisateurs',$utilisateurs);   
                $this->Utiliseoutil->recursive = -1;
                $etats = $this->Utiliseoutil->find('all',array('fields' => array('Utiliseoutil.STATUT'),'group'=>'Utiliseoutil.STATUT','order'=>array('Utiliseoutil.STATUT'=>'asc')));
                $this->set('etats',$etats); 
                $outils = $this->Utiliseoutil->Outil->find('all',array('fields' => array('Outil.id','Outil.NOM'),'order'=>array('Outil.NOM'=>'asc')));
                $liste = $this->Utiliseoutil->Listediffusion->find('all',array('fields' => array('Listediffusion.id','Listediffusion.NOM'),'order'=>array('Listediffusion.NOM'=>'asc')));
                $partage = $this->Utiliseoutil->Dossierpartage->find('all',array('fields' => array('Dossierpartage.id','Dossierpartage.NOM'),'order'=>array('Dossierpartage.NOM'=>'asc')));
                $this->set('outils',$outils);    
                $this->set('listes',$liste);  
                $this->set('partages',$partage);  
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
            if (isAuthorized('utiliseoutils', 'view')) :
		$this->set('title_for_layout','Ouvertures des droits');
                if (!$this->Utiliseoutil->exists($id)) {
			throw new NotFoundException(__('Ouvertures des droits incorrecte'));
		}
		$options = array('conditions' => array('Utiliseoutil.' . $this->Utiliseoutil->primaryKey => $id));
		$this->set('utiliseoutil', $this->Utiliseoutil->find('first', $options));
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
	public function add($id = null) {
            if (isAuthorized('utiliseoutils', 'add')) :
		$this->set('title_for_layout','Ouvertures des droits');
                if($id==null){
                    $this->Utiliseoutil->Utilisateur->recursive = -1;
                    $utilisateur = $this->Utiliseoutil->Utilisateur->find('list',array('fields' => array('id', 'NOMLONG'),'order'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id > 0')));
                } else {
                    $this->Utiliseoutil->Utilisateur->recursive = -1;
                    $utilisateur = $this->Utiliseoutil->Utilisateur->find('list',array('fields' => array('id','NOMLONG'),'order'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>$id,'Utilisateur.ACTIF'=>1,'Utilisateur.profil_id > 0')));
                }
                $this->set('utilisateur',$utilisateur);
                $this->Utiliseoutil->Outil->recursive = -1;
                $outil = $this->Utiliseoutil->Outil->find('list',array('fields' => array('id', 'NOM')));
                $this->set('outil',$outil);  
                $this->Utiliseoutil->Listediffusion->recursive = -1;
                $listediffusion = $this->Utiliseoutil->Listediffusion->find('list',array('fields' => array('id', 'NOM')));
                $this->set('listediffusion',$listediffusion); 
                $this->Utiliseoutil->Dossierpartage->recursive = -1;
                $dossierpartage  = $this->Utiliseoutil->Dossierpartage->find('list',array('fields' => array('id', 'NOM')));
                $this->set('dossierpartage',$dossierpartage );  
                $etat = Configure::read('etatOuvertureDroit');
                $this->set('etat',$etat);                 
                if ($this->request->is('post')) :
			$this->Utiliseoutil->create();
			if ($this->Utiliseoutil->save($this->request->data)) {
                                $nomoutil = "inconnu";
                                $outil_id = isset($this->request->data['Utiliseoutil']['outil_id']) ? $this->request->data['Utiliseoutil']['outil_id'] : '';
                                $listediffusion_id = isset($this->request->data['Utiliseoutil']['listediffusion_id']) ? $this->request->data['Utiliseoutil']['listediffusion_id'] : '';
                                $dossierpartage_id = isset($this->request->data['Utiliseoutil']['dossierpartage_id']) ? $this->request->data['Utiliseoutil']['dossierpartage_id'] : '';
                                if ($outil_id!='') :
                                    $outils = $this->Utiliseoutil->Outil->find('first',array('fields'=>array('NOM'),'conditions'=>array('Outil.id'=>$outil_id),'recursive'=>-1));
                                    $nomoutil = $outils['Outil']['NOM'];
                                endif;
                                if ($listediffusion_id!='') :
                                    $outils = $this->Utiliseoutil->Listediffusion->find('first',array('fields'=>array('NOM'),'conditions'=>array('Listediffusion.id'=>$listediffusion_id),'recursive'=>-1));
                                    $nomoutil = $outils['Listediffusion']['NOM'];
                                endif;
                                if ($dossierpartage_id!='') :
                                    $outils = $this->Utiliseoutil->Dossierpartage->find('first',array('fields'=>array('NOM'),'conditions'=>array('Dossierpartage.id'=>$dossierpartage_id),'recursive'=>-1));
                                    $nomoutil = $outils['Dossierpartage']['NOM'];
                                endif;      
                                $utiliseoutil = $this->Utiliseoutil->find('first',array('conditions'=>array('Utiliseoutil.id'=>$this->Utiliseoutil->getLastInsertID())));
                                $this->sendmailutiliseoutil($utiliseoutil);
                                $this->addnewaction($this->Utiliseoutil->getLastInsertID(),$nomoutil);
                                $history['Historyutilisateur']['utilisateur_id']=$this->request->data['Utiliseoutil']['utilisateur_id'];
                                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - ajout d'une ouverture de droit".' par '.userAuth('NOMLONG');
                                $this->Utiliseoutil->Utilisateur->Historyutilisateur->save($history);                            
				$this->Session->setFlash(__('Ouvertures des droits sauvegardée'),'default',array('class'=>'alert alert-success'));
                                $this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Ouvertures des droits incorrecte, veuillez corriger cette ouverture de droit'),'default',array('class'=>'alert alert-error'));
			}
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
            if (isAuthorized('utiliseoutils', 'edit')) :
		$this->set('title_for_layout','Ouvertures des droits');
                $this->Utiliseoutil->Utilisateur->recursive = -1;
                $utilisateur = $this->Utiliseoutil->Utilisateur->find('list',array('fields' => array('id', 'NOM'),'conditions'=>array('Utilisateur.id'=>$id,'Utilisateur.ACTIF'=>1,'Utilisateur.profil_id > 0')));
                $this->set('utilisateur',$utilisateur);  
                $this->Utiliseoutil->Outil->recursive = -1;
                $outil = $this->Utiliseoutil->Outil->find('list',array('fields' => array('id', 'NOM')));
                $this->set('outil',$outil);  
                $this->Utiliseoutil->Listediffusion->recursive = -1;
                $listediffusion = $this->Utiliseoutil->Listediffusion->find('list',array('fields' => array('id', 'NOM')));
                $this->set('listediffusion',$listediffusion); 
                $this->Utiliseoutil->Dossierpartage->recursive = -1;
                $dossierpartage  = $this->Utiliseoutil->Dossierpartage->find('list',array('fields' => array('id', 'NOM')));
                $this->set('dossierpartage',$dossierpartage );  
                $etat = Configure::read('etatOuvertureDroit');
                $this->set('etat',$etat);    
                if (!$this->Utiliseoutil->exists($id)) {
			throw new NotFoundException(__('Ouvertures des droits incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                        $this->autoprogressState($id);
                        $this->History->goBack(1);
		} else {
			$options = array('conditions' => array('Utiliseoutil.' . $this->Utiliseoutil->primaryKey => $id));
			$this->request->data = $this->Utiliseoutil->find('first', $options);
                        $this->set('utiliseoutil', $this->Utiliseoutil->find('first', $options));
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
            if (isAuthorized('utiliseoutils', 'delete')) :
		$this->set('title_for_layout','Ouvertures des droits');
                $this->Utiliseoutil->id = $id;
                $userid = $this->Utiliseoutil->read();
		if (!$this->Utiliseoutil->exists()) {
			throw new NotFoundException(__('Ouvertures des droits incorrecte'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Utiliseoutil->delete()) {
                        $history['Historyutilisateur']['utilisateur_id']=$userid['Utiliseoutil']['utilisateur_id'];
                        $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - suppression d'une ouverture de droit".' par '.userAuth('NOMLONG');
                        $this->Utiliseoutil->Utilisateur->Historyutilisateur->save($history);                         
			$this->Session->setFlash(__('Ouvertures des droits supprimée'),'default',array('class'=>'alert alert-success'));
			$this->History->goBack();
		}
		$this->Session->setFlash(__('Ouvertures des droits <b>NON</b> supprimée'),'default',array('class'=>'alert alert-error'));
		$this->History->goBack();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}
        
  /**
 * progressState method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function progressstate($id = null) {
            if (isAuthorized('utiliseoutils', 'update')) :
		$this->set('title_for_layout','Ouvertures des droits');
                $newetat = '';
                $id = $id==null ? $this->request->data('id') : $id;
                $valideur = null;
                $this->Utiliseoutil->id = $id;
                $record = $this->Utiliseoutil->read();
                if($record['Outil']['VALIDATION']==0 && $record['Utiliseoutil']['STATUT']=='Pris en compte') $record['Utiliseoutil']['STATUT']='Validé';
                switch ($record['Utiliseoutil']['STATUT']) {
                    case 'Demandé':
                       $newetat = 'Pris en compte';
                       break;
                    case 'Pris en compte':
                       $newetat = 'En validation';
                       $valideur = $this->requestAction('parameters/get_valideuroutil');
                       $valideur = $valideur['Parameter']['param'];                        
                       break;                
                    case 'En validation':
                       $newetat = 'Validé';
                       break;          
                    case 'Validé':
                       $newetat = 'Demande transférée';
                       break;
                    case 'Demande transférée':
                       $newetat = 'Demande traitée';
                       break;                
                    case 'Demande traitée':
                       $newetat = 'Retour utilisateur';
                       break;
                    case 'Retour utilisateur':
                       $newetat = 'A supprimer';
                       break;                
                    case 'A supprimer':
                       $newetat = 'Supprimée';
                       break;          
                    case 'Supprimée':
                       $newetat = 'Demandé';
                       break; 
                }
                $record['Utiliseoutil']['STATUT'] = $newetat;
                $record['Utiliseoutil']['created'] = $this->Utiliseoutil->read('created');
                $record['Utiliseoutil']['modified'] = date('Y-m-d');
		if (!$this->Utiliseoutil->exists()) {
			throw new NotFoundException(__('Ouvertures des droits incorrecte'));
		}
                if ($this->Utiliseoutil->save($record)) { 
                    $utiliseoutil = $this->Utiliseoutil->find('first',array('conditions'=>array('Utiliseoutil.id'=>$id)));
                    $this->sendmailutiliseoutil($utiliseoutil,$valideur);                       
                    $history['Historyutilisateur']['utilisateur_id']=$record['Utiliseoutil']['utilisateur_id'];
                    $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - changement d'état d'une ouverture de droit".' par '.userAuth('NOMLONG');
                    $this->Utiliseoutil->Utilisateur->Historyutilisateur->save($history);                     
                    $this->Session->setFlash(__('Ouvertures des droits progression de l\'état'),'default',array('class'=>'alert alert-success'));
                    exit();
                }
		$this->Session->setFlash(__('Ouvertures des droits <b>NON</b> progression de l\'état'),'default',array('class'=>'alert alert-error'));
		exit();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}    
        
	public function autoprogressState($id = null) {
                $newetat = '';
                $this->Utiliseoutil->id = $id;
                $record = $this->Utiliseoutil->read();
                $valideur = null;
                if($record['Outil']['VALIDATION']==0 && $record['Utiliseoutil']['STATUT']=='Pris en compte') $record['Utiliseoutil']['STATUT']='Validé';
                switch ($record['Utiliseoutil']['STATUT']) {
                    case 'Demandé':
                       $newetat = 'Pris en compte';
                       break;
                    case 'Pris en compte':
                       $newetat = 'En validation';
                       $valideur = $this->requestAction('parameters/get_valideuroutil');
                       $valideur = $valideur['Parameter']['param'];
                       break;                
                    case 'En validation':
                       $newetat = 'Validé';
                       break;          
                    case 'Validé':
                       $newetat = 'Demande transférée';
                       break;
                    case 'Demande transférée':
                       $newetat = 'Demande traitée';
                       break;                
                    case 'Demande traitée':
                       $newetat = 'Retour utilisateur';
                       break;
                    case 'Retour utilisateur':
                       $newetat = 'A supprimer';
                       break;                
                    case 'A supprimer':
                       $newetat = 'Supprimée';
                       break;          
                    case 'Supprimée':
                       $newetat = 'Demandé';
                       break; 
                }
                $record['Utiliseoutil']['STATUT'] = $newetat;
                $record['Utiliseoutil']['created'] = $this->Utiliseoutil->read('created');
                $record['Utiliseoutil']['modified'] = date('Y-m-d');
                if ($this->Utiliseoutil->save($record)) { 
                    $utiliseoutil = $this->Utiliseoutil->find('first',array('conditions'=>array('Utiliseoutil.id'=>$id),'recursive'=>0));
                    $this->sendmailutiliseoutil($utiliseoutil,$valideur);                    
                    $history['Historyutilisateur']['utilisateur_id']=$record['Utiliseoutil']['utilisateur_id'];
                    $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - changement d'état d'une ouverture de droit".' par '.userAuth('NOMLONG');
                    $this->Utiliseoutil->Utilisateur->Historyutilisateur->save($history);                     
                }              
	}  
    
	public function mailprogressstate($id,$userid) {
                $newetat = '';
                $this->Utiliseoutil->id = $id;
                $record = $this->Utiliseoutil->read();
                $valideur = null;
                if($record['Outil']['VALIDATION']==0 && $record['Utiliseoutil']['STATUT']=='Pris en compte') $record['Utiliseoutil']['STATUT']='Validé';
                switch ($record['Utiliseoutil']['STATUT']) {
                    case 'Demandé':
                       $newetat = 'Pris en compte';
                       break;
                    case 'Pris en compte':
                       $newetat = 'En validation';
                       break;                
                    case 'En validation':
                       $newetat = 'Validé';
                       break;          
                    case 'Validé':
                       $newetat = 'Demande transférée';
                       break;
                    case 'Demande transférée':
                       $newetat = 'Demande traitée';
                       break;                
                    case 'Demande traitée':
                       $newetat = 'Retour utilisateur';
                       break;
                    case 'Retour utilisateur':
                       $newetat = 'A supprimer';
                       break;                
                    case 'A supprimer':
                       $newetat = 'Supprimée';
                       break;          
                    case 'Supprimée':
                       $newetat = 'Demandé';
                       break; 
                }
                $record['Utiliseoutil']['STATUT'] = $newetat;
                $record['Utiliseoutil']['created'] = $this->Utiliseoutil->read('created');
                $record['Utiliseoutil']['modified'] = date('Y-m-d');
                if ($this->Utiliseoutil->save($record)) { 
                    $utiliseoutil = $this->Utiliseoutil->find('first',array('conditions'=>array('Utiliseoutil.id'=>$id),'recursive'=>0));   
                    $utilisateur = $this->Utiliseoutil->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$userid),'recursive'=>-1));
                    $history['Historyutilisateur']['utilisateur_id']=$record['Utiliseoutil']['utilisateur_id'];
                    $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - changement d'état d'une ouverture de droit".' par '.$utilisateur['Utilisateur']['NOMLONG'];
                    $this->Utiliseoutil->Utilisateur->Historyutilisateur->save($history);                     
                }              
	}          
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
            if (isAuthorized('utiliseoutils', 'index')) :
                $this->set('title_for_layout','Ouvertures des droits');
                $keyword=isset($this->params->data['Utiliseoutil']['SEARCH']) ? $this->params->data['Utiliseoutil']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Utiliseoutil.STATUT LIKE '%".$keyword."%'","Utiliseoutil.TYPE LIKE '%".$keyword."%'","(CONCAT(Utilisateur.NOM, ' ', Utilisateur.PRENOM)) LIKE '%".$keyword."%'","Outil.NOM LIKE '%".$keyword."%'","Dossierpartage.NOM LIKE '%".$keyword."%'","Listediffusion.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Utiliseoutil->recursive = 0;
                $this->set('utiliseoutils', $this->paginate());
                $etats = $this->Utiliseoutil->find('all',array('fields' => array('Utiliseoutil.STATUT'),'group'=>'Utiliseoutil.STATUT','order'=>array('Utiliseoutil.STATUT'=>'asc')));
                $this->set('etats',$etats);  
                $this->Utiliseoutil->Utilisateur->recursive = -1;
                $utilisateurs = $this->Utiliseoutil->Utilisateur->find('all',array('fields' => array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.profil_id > 0'),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('utilisateurs',$utilisateurs); 
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
        }         

        public function addnewaction($id,$outil){
            $date = new DateTime();
            $record['Action']['utilisateur_id']=  userAuth('id');
            $record['Action']['destinataire']=  userAuth('id');
            $record['Action']['domaine_id']=  4;
            $record['Action']['activite_id']=  21;
            $record['Action']['OBJET']=  'Création d\'une nouvelle demande d\'ouverture de droit : '.$outil;
            $record['Action']['AVANCEMENT']=  0;
            $record['Action']['COMMENTAIRE']=  '<a href="'.FULL_BASE_URL.$this->params->base.'/utiliseoutils/edit/'.$id.'">Lien vers la nouvelle demande d\'ouverture de droit</a>';
            $record['Action']['DEBUT']=  $date->format('d/m/Y');            
            $record['Action']['ECHEANCE']=  $date->add(new DateInterval('P5D'))->format('d/m/Y');
            $record['Action']['STATUT']=  'à faire';
            $record['Action']['DUREEPREVUE']=  2;
            $record['Action']['PRIORITE']=  'haute';
            $this->Utiliseoutil->Utilisateur->Action->create();
            $this->Utiliseoutil->Utilisateur->Action->save($record);
        }  
        
        public function allupdate($ids=null){
            $ids = explode('-', $this->request->data('all_ids'));
            if(count($ids)>0 && $ids[0]!=""):
                foreach($ids as $id):
                    $this->autoprogressState($id);
                endforeach;
                echo $this->Session->setFlash(__('Mises à jour complétées'),'default',array('class'=>'alert alert-success'));
            else:
                echo $this->Session->setFlash(__('Aucune ouverture de droit sélectionnée'),'default',array('class'=>'alert alert-error'));
            endif;
            exit();
        }
        
        public function sendmailutiliseoutil($utiliseoutil,$valideur){
            if(!empty($utiliseoutil['Utiliseoutil']['outil_id']) && $utiliseoutil['Utiliseoutil']['outil_id']!=null):
                $outil = $this->Utiliseoutil->Outil->find('first',array('conditions'=>array('Outil.id'=>$utiliseoutil['Utiliseoutil']['outil_id']),'recursive'=>0));
                $nom = $outil['Outil']['NOM'];
                $gestionnaire = $outil['Outil']['utilisateur_id'];
                if($utiliseoutil['Utiliseoutil']['STATUT']=='Demande transférée'):
                    $to = $outil['Utilisateur']['MAIL'];
                elseif($utiliseoutil['Utiliseoutil']['STATUT']=='Demandé'):
                    $mailto = $this->requestAction('parameters/get_contact');
                    $to = explode(';',$mailto['Parameter']['param']);          
                endif;
            endif;
            if(!empty($utiliseoutil['Utiliseoutil']['listediffusion_id']) && $utiliseoutil['Utiliseoutil']['listediffusion_id']!=null):
                $listediffusion = $this->Utiliseoutil->Listediffusion->find('first',array('conditions'=>array('Listediffusion.id'=>$utiliseoutil['Utiliseoutil']['listediffusion_id'])));
                $nom = $listediffusion['Listediffusion']['NOM'];
                $gestionnaire = $listediffusion['Listediffusion']['utilisateur_id'];                
                $mailto = $this->requestAction('parameters/get_contact');
                $to = explode(';',$mailto['Parameter']['param']);      
            endif;
            if(!empty($utiliseoutil['Utiliseoutil']['dossierpartage_id']) && $utiliseoutil['Utiliseoutil']['dossierpartage_id']!=null):
                $dossierpartage = $this->Utiliseoutil->Dossierpartage->find('first',array('conditions'=>array('Dossierpartage.id'=>$utiliseoutil['Utiliseoutil']['dossierpartage_id'])));
                $nom = $dossierpartage['Dossierpartage']['NOM'];
                $gestionnaire = $dossierpartage['Dossierpartage']['utilisateur_id'];                 
                $mailto = $this->requestAction('parameters/get_contact');
                $to = explode(';',$mailto['Parameter']['param']);               
            endif;     
            $domaine = $this->Utiliseoutil->Utilisateur->Domaine->find('first',array('conditions'=>array('Domaine.id'=>$utiliseoutil['Utilisateur']['domaine_id']),'recursive'=>-1));
            $section = $this->Utiliseoutil->Utilisateur->Section->find('first',array('conditions'=>array('Section.id'=>$utiliseoutil['Utilisateur']['section_id']),'recursive'=>-1));
            $site = $this->Utiliseoutil->Utilisateur->Site->find('first',array('conditions'=>array('Site.id'=>$utiliseoutil['Utilisateur']['site_id']),'recursive'=>-1));
            $from = userAuth('MAIL');
            $email = isset($utiliseoutil['Utilisateur']['MAIL']) ? $utiliseoutil['Utilisateur']['MAIL'] : "Demandez un complément d'information à l'émetteur de cette demande";
            $domaine = isset($domaine['Domaine']['NOM']) ? $domaine['Domaine']['NOM'] : "Demandez un complément d'information à l'émetteur de cette demande";
            $objet = 'SAILL : Demande d\'ouverture de droit ['.$nom.']';
            $message = "Demande d'ouverture de droit pour : ";
            $url = FULL_BASE_URL.$this->params->base.'/mailprogressstate/'.$utiliseoutil['Utiliseoutil']['id']."/".$gestionnaire;
            if($valideur!=null): 
                $to = $valideur; 
                $objet = "SAILL : Demande de validation pour ".$nom;
                $message = "Demande de validation de droit pour : ";
                $url = '';
            endif;
            $message .= $message.'<ul>
                    <li>Outil :'.$nom.'</li>
                    <li>Agent :'.$utiliseoutil['Utilisateur']['NOMLONG'].'</li>
                    <li>Identifiant :'.$utiliseoutil['Utilisateur']['username'].'</li>
                    <li>Email :'.$email.'</li>
                    <li>Projet :'.$domaine.'</li>
                    <li>Section :'.$section['Section']['NOM'].'</li>
                    <li>Localisation :'.$site['Site']['NOM'].'</li>                        
                    </ul><br>'.$url;
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
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage())),'default',array('class'=>'alert alert-error'));
                }  
            endif;
        }        
}
