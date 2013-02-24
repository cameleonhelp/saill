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
        'order' => array('Utiliseoutil.utilisateur_id' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index($filtreetat,$filtreutilisateur) {
		$this->set('title_for_layout','Ouvertures des droits');
                switch ($filtreetat){
                    case 'tous':
                        $newconditions[]="Utiliseoutil.STATUT !='Retour utilisateur'";
                        $fetat = "de tous les états sauf 'Retour utilisateur'";
                        break;
                    default :
                        $newconditions[]="Utiliseoutil.STATUT='".$filtreetat."'";
                        $fetat = "avec l'état ".$filtreetat;                        
                }    
                $this->set('fetat',$fetat);
                /*switch ($filtreutilisateur){
                    case 'tous':
                        $newconditions[]='Utilisateur.id !=1';
                        $futilisateur = "tous les utilisateurs";
                        break;
                    default :
                        $newconditions[]= "Utilisateur.id='".$filtreutilisateur."'";
                        $futilisateur = "le compte de  ".$filtreutilisateur;                        
                }    
                $this->set('futilisateur',$futilisateur);   */             
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->Utiliseoutil->recursive = 0;
		$this->set('utiliseoutils', $this->paginate());
                $etats = $this->Utiliseoutil->find('all',array('fields' => array('Utiliseoutil.STATUT'),'group'=>'Utiliseoutil.STATUT','order'=>array('Utiliseoutil.STATUT'=>'asc')));
                $this->set('etats',$etats);   
                /*$utilisateurs = $this->Utiliseoutil->find('all',array('fields' => array('Utilisateur.NOM','Utilisateur.PRENOM','Utilisateur.id'),'conditions'=>array('Utilisateur.id !='=>1),'group'=>"Utiliseoutil.utilisateur_id",'order'=>array('Utilisateur.NOM'=>'asc','Utilisateur.PRENOM'=>'asc')));
                $this->set('utilisateurs',$utilisateurs);  */                 
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->set('title_for_layout','Ouvertures des droits');
                if (!$this->Utiliseoutil->exists($id)) {
			throw new NotFoundException(__('Ouvertures des droits incorrecte'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Utiliseoutil.' . $this->Utiliseoutil->primaryKey => $id));
		$this->set('utiliseoutil', $this->Utiliseoutil->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->set('title_for_layout','Ouvertures des droits');
                $utilisateur = $this->Utiliseoutil->Utilisateur->find('list',array('fields' => array('id', 'NOMLONG')));
                $this->set('utilisateur',$utilisateur);  
                $outil = $this->Utiliseoutil->Outil->find('list',array('fields' => array('id', 'NOM')));
                $this->set('outil',$outil);  
                $listediffusion = $this->Utiliseoutil->Listediffusion->find('list',array('fields' => array('id', 'NOM')));
                $this->set('listediffusion',$listediffusion); 
                $dossierpartage  = $this->Utiliseoutil->Dossierpartage->find('list',array('fields' => array('id', 'NOM')));
                $this->set('dossierpartage',$dossierpartage );  
                $etat = Configure::read('etatOuvertureDroit');
                $this->set('etat',$etat);                 
                if ($this->request->is('post')) {
			$this->Utiliseoutil->create();
			if ($this->Utiliseoutil->save($this->request->data)) {
				$this->Session->setFlash(__('Ouvertures des droits sauvegardée'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index','tous','tous'));
			} else {
				$this->Session->setFlash(__('Ouvertures des droits incorrecte, veuillez corriger cette ouverture de droit'),true,array('class'=>'alert alert-error'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->set('title_for_layout','Ouvertures des droits');
                $utilisateur = $this->Utiliseoutil->Utilisateur->find('list',array('fields' => array('id', 'NOM')));
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
			throw new NotFoundException(__('Ouvertures des droits incorrecte'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Utiliseoutil->save($this->request->data)) {
				$this->Session->setFlash(__('Ouvertures des droits sauvegardée'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index','tous','tous'));
			} else {
				$this->Session->setFlash(__('Ouvertures des droits incorrecte, veuillez corriger cette ouverture de droit'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Utiliseoutil.' . $this->Utiliseoutil->primaryKey => $id));
			$this->request->data = $this->Utiliseoutil->find('first', $options);
                        $this->set('utiliseoutil', $this->Utiliseoutil->find('first', $options));
		}
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
		$this->set('title_for_layout','Ouvertures des droits');
                $this->Utiliseoutil->id = $id;
		if (!$this->Utiliseoutil->exists()) {
			throw new NotFoundException(__('Ouvertures des droits incorrecte'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Utiliseoutil->delete()) {
			$this->Session->setFlash(__('Ouvertures des droits supprimée'),true,array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index','tous','tous'));
		}
		$this->Session->setFlash(__('Ouvertures des droits <b>NON</b> supprimée'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index','tous','tous'));
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
			throw new NotFoundException(__('Ouvertures des droits incorrecte'),true,array('class'=>'alert alert-error'));
		}
                if ($this->Utiliseoutil->save($record)) { 
                    $this->Session->setFlash(__('Ouvertures des droits progression de l\'état'),true,array('class'=>'alert alert-success'));
                    $this->redirect(array('action' => 'index','tous','tous'));
                }
		$this->Session->setFlash(__('Ouvertures des droits <b>NON</b> progression de l\'état'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index','tous','tous'));
	}      
}
