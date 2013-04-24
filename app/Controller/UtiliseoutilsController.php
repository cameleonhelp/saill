<?php
App::uses('AppController', 'Controller');
/**
 * Utiliseoutils Controller
 *
 * @property Utiliseoutil $Utiliseoutil
 */
class UtiliseoutilsController extends AppController {
 
    public $paginate = array(
        'limit' => 15,
        'order' => array('Utiliseoutil.created' => 'desc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index($filtreetat=null,$utilisateur_id=null) {
            $this->Session->delete('history');
            if (isAuthorized('utiliseoutils', 'index')) :
		$this->set('title_for_layout','Ouvertures des droits');
                switch ($filtreetat){
                    case 'tous':
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
                if (userAuth('WIDEAREA')==0) {$newconditions[]="Utilisateur.section_id=".userAuth('section_id');}
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->Utiliseoutil->recursive = 0;
		$this->set('utiliseoutils', $this->paginate());
                $conditions = array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1);
                if (userAuth('WIDEAREA')==0) {$restriction[]="Utilisateur.section_id=".userAuth('section_id'); $conditions = array_merge_recursive($conditions,$restriction);}
                $this->Utiliseoutil->Utilisateur->recursive = -1;
                $utilisateurs = $this->Utiliseoutil->Utilisateur->find('all',array('fields' => array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>$conditions,'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('utilisateurs',$utilisateurs);   
                $this->Utiliseoutil->recursive = -1;
                $etats = $this->Utiliseoutil->find('all',array('fields' => array('Utiliseoutil.STATUT'),'group'=>'Utiliseoutil.STATUT','order'=>array('Utiliseoutil.STATUT'=>'asc')));
                $this->set('etats',$etats); 
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
                    $utilisateur = $this->Utiliseoutil->Utilisateur->find('list',array('fields' => array('id', 'NOMLONG'),'order'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1)));
                } else {
                    $this->Utiliseoutil->Utilisateur->recursive = -1;
                    $utilisateur = $this->Utiliseoutil->Utilisateur->find('list',array('fields' => array('id','NOMLONG'),'order'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>$id,'Utilisateur.ACTIF'=>1)));
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
                                $this->addnewaction($this->Utiliseoutil->getLastInsertID());
                                $history['Historyutilisateur']['utilisateur_id']=$this->request->data['Utiliseoutil']['utilisateur_id'];
                                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - ajout d'une ouverture de droit".' par '.userAuth('NOMLONG');
                                $this->Utiliseoutil->Utilisateur->Historyutilisateur->save($history);                            
				$this->Session->setFlash(__('Ouvertures des droits sauvegardée'),'default',array('class'=>'alert alert-success'));
                                if($id==null){
                                    $this->redirect($this->goToPostion(1));
                                } else {
                                    $this->redirect($this->goToPostion(2));
                                }
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
                $utilisateur = $this->Utiliseoutil->Utilisateur->find('list',array('fields' => array('id', 'NOM'),'conditions'=>array('Utilisateur.id'=>$id,'Utilisateur.ACTIF'=>1)));
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
			if ($this->Utiliseoutil->save($this->request->data)) {
                                $history['Historyutilisateur']['utilisateur_id']=$this->request->data['Utiliseoutil']['utilisateur_id'];
                                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - mise à jour d'une ouverture de droit".' par '.userAuth('NOMLONG');
                                $this->Utiliseoutil->Utilisateur->Historyutilisateur->save($history);                               
				$this->Session->setFlash(__('Ouvertures des droits sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Ouvertures des droits incorrecte, veuillez corriger cette ouverture de droit'),'default',array('class'=>'alert alert-error'));
			}
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
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Ouvertures des droits <b>NON</b> supprimée'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
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
	public function progressState($id = null) {
            if (isAuthorized('utiliseoutils', 'update')) :
		$this->set('title_for_layout','Ouvertures des droits');
                $newetat = '';
                $this->Utiliseoutil->id = $id;
                $record = $this->Utiliseoutil->read();
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
		if (!$this->Utiliseoutil->exists()) {
			throw new NotFoundException(__('Ouvertures des droits incorrecte'));
		}
                if ($this->Utiliseoutil->save($record)) { 
                    $history['Historyutilisateur']['utilisateur_id']=$record['Utiliseoutil']['utilisateur_id'];
                    $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - changement d'état d'une ouverture de droit".' par '.userAuth('NOMLONG');
                    $this->Utiliseoutil->Utilisateur->Historyutilisateur->save($history);                     
                    $this->Session->setFlash(__('Ouvertures des droits progression de l\'état'),'default',array('class'=>'alert alert-success'));
                    $this->redirect($this->goToPostion());
                }
		$this->Session->setFlash(__('Ouvertures des droits <b>NON</b> progression de l\'état'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
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
                $utilisateurs = $this->Utiliseoutil->Utilisateur->find('all',array('fields' => array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1),'order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('utilisateurs',$utilisateurs); 
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
        }         

        public function addnewaction($id){
            $date = new DateTime();
            $record['Action']['utilisateur_id']=  userAuth('id');
            $record['Action']['destinataire']=  userAuth('id');
            $record['Action']['domaine_id']=  4;
            $record['Action']['activite_id']=  21;
            $record['Action']['OBJET']=  'Création d\'une nouvelle demande d\'ouverture de droit';
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
        
}
