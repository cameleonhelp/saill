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
                        $futilisateur = "de tous les gestionnaires";
                        break;                      
                    default :
                        $newconditions[]="Livrable.utilisateur_id = '".$utilisateur_id."'";
                        $nomlong = $this->Livrable->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array('Utilisateur.id'=> $utilisateur_id)));
                        $futilisateur = "dont le gestionnaire est ".$nomlong['Utilisateur']['NOMLONG'];                     
                    }                     
                $this->set('futilisateur',$futilisateur);                 
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->Utiliseoutil->recursive = 0;
		$this->set('utiliseoutils', $this->paginate());
                $utilisateurs = $this->Utiliseoutil->find('all',array('fields' => array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>'Utilisateur.id > 1','order'=>array('Utilisateur.NOMLONG'=>'asc')));
                $this->set('utilisateurs',$utilisateurs);                 
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
                    $utilisateur = $this->Utiliseoutil->Utilisateur->find('list',array('fields' => array('id', 'NOMLONG'),'order'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1')));
                } else {
                    $utilisateur = $this->Utiliseoutil->Utilisateur->find('list',array('fields' => array('id','NOMLONG'),'order'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>$id)));
                }
                $this->set('utilisateur',$utilisateur);  
                $outil = $this->Utiliseoutil->Outil->find('list',array('fields' => array('id', 'NOM')));
                $this->set('outil',$outil);  
                $listediffusion = $this->Utiliseoutil->Listediffusion->find('list',array('fields' => array('id', 'NOM')));
                $this->set('listediffusion',$listediffusion); 
                $dossierpartage  = $this->Utiliseoutil->Dossierpartage->find('list',array('fields' => array('id', 'NOM')));
                $this->set('dossierpartage',$dossierpartage );  
                $etat = Configure::read('etatOuvertureDroit');
                $this->set('etat',$etat);                 
                if ($this->request->is('post')) :
			$this->Utiliseoutil->create();
			if ($this->Utiliseoutil->save($this->request->data)) {
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
                $utilisateur = $this->Utiliseoutil->Utilisateur->find('list',array('fields' => array('id', 'NOM'),'conditions'=>array('Utilisateur.id'=>$id)));
                $this->set('utilisateur',$utilisateur);  
                $outil = $this->Utiliseoutil->Outil->find('list',array('fields' => array('id', 'NOM')));
                $this->set('outil',$outil);  
                $listediffusion = $this->Utiliseoutil->Listediffusion->find('list',array('fields' => array('id', 'NOM')));
                $this->set('listediffusion',$listediffusion); 
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
		$this->request->onlyAllow('post', 'delete');
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
                $keyword=$this->params->data['Utiliseoutil']['SEARCH']; 
                //$newconditions = array('OR'=>array("Message.LIBELLE LIKE '%$keyword%'","ModelName.name LIKE '%$keyword%'", "ModelName.email LIKE '%$keyword%'")  );
                $newconditions = array('OR'=>array("Utiliseoutil.STATUT LIKE '%".$keyword."%'","Utiliseoutil.TYPE LIKE '%".$keyword."%'","(CONCAT(Utilisateur.NOM, ' ', Utilisateur.PRENOM)) LIKE '%".$keyword."%'","Outil.NOM LIKE '%".$keyword."%'","Dossierpartage.NOM LIKE '%".$keyword."%'","Listediffusion.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                //$this->set('messages',$this->Message->search($this->data['Message']['MessageSEARCH'])); 
                $this->autoRender = false;
                $this->Utiliseoutil->recursive = 0;
                $this->set('utiliseoutils', $this->paginate());
                $etats = $this->Utiliseoutil->find('all',array('fields' => array('Utiliseoutil.STATUT'),'group'=>'Utiliseoutil.STATUT','order'=>array('Utiliseoutil.STATUT'=>'asc')));
                $this->set('etats',$etats);                
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
        }         
}
