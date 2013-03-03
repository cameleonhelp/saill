<?php
App::uses('AppController', 'Controller');
/**
 * Utilisateurs Controller
 *
 * @property Utilisateur $Utilisateur
 */
class UtilisateursController extends AppController {
 
    public $paginate = array(
        'limit' => 15,
        'order' => array('Utilisateur.NOM' => 'asc','Utilisateur.PRENOM' => 'asc'),
        'conditions'=>array('Utilisateur.id > '=> 1),
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index($filtreUtilisateur,$filtreSection) {
                switch ($filtreUtilisateur){
                    case 'tous':
                        $newconditions[]="1=1";
                        $futilisateur = "tous les utilisateurs";
                        break;
                    case 'actif':
                        $newconditions[]="Utilisateur.ACTIF=1";
                        $futilisateur = "tous les utilisateurs actifs";
                        break;  
                    case 'inactif':
                        $newconditions[]="Utilisateur.ACTIF=0";
                        $futilisateur = "tous les utilisateurs inactifs";
                        break;  
                    case 'incomplet':
                        $newconditions[]="Utilisateur.ACTIF=1 AND (Utilisateur.section_id IS NULL OR Utilisateur.profil_id IS NULL OR Utilisateur.assistance_id IS NULL OR Utilisateur.site_id IS NULL OR Utilisateur.username='' OR Utilisateur.MAIL='')";
                        $futilisateur = "tous les utilisateurs actifs et incomplets";
                        break;  
                    case 'aprolonger':
                        $newconditions[]="Utilisateur.ACTIF=1 AND Utilisateur.FINMISSION IS NOT NULL AND Utilisateur.FINMISSION < DATE_ADD(CURDATE(), INTERVAL 1 MONTH)";
                        $futilisateur = "tous les utilisateurs actifs, dont la date de fin de mission est proche de son terme";
                        break;                      
                }
                switch ($filtreSection){
                    case 'allsections':
                        $newconditions[]="1=1";
                        $fsection = "toutes les sections";
                        break;
                    default :
                        $newconditions[]="Section.NOM='".$filtreSection."'";
                        $fsection = "la section ".$filtreSection;                        
                }    
                
                $this->set('fsection',$fsection);
                $this->set('futilisateur',$futilisateur);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
		$this->Utilisateur->recursive = 0;
		$this->set('utilisateurs', $this->paginate());
                $sections = $this->Utilisateur->Section->find('all',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc')));
                $this->set('sections',$sections);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Utilisateur->exists($id)) {
			throw new NotFoundException(__('Utilisateur incorrect'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Utilisateur.' . $this->Utilisateur->primaryKey => $id));
		$this->set('utilisateur', $this->Utilisateur->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $societe = $this->Utilisateur->Societe->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('societe',$societe);
                if ($this->request->is('post')) {
			$this->Utilisateur->create();
			if ($this->Utilisateur->save($this->request->data)) {
                                $history['Historyutilisateur']['utilisateur_id']=$this->Utilisateur->id;
                                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - Utilisateur créé";
                                $this->Utilisateur->Historyutilisateur->save($history);                              
				$this->Session->setFlash(__('Utilisateur sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Utilisateur incorrect, veuillez corriger l\'utilisateur'),true,array('class'=>'alert alert-error'));
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
                $societe = $this->Utilisateur->Societe->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('societe',$societe);
                $section = $this->Utilisateur->Section->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('section',$section);
                $hierarchique = $this->Utilisateur->Utilisateur->find('list',array('fields' => array('id', 'NOMLONG'),'order'=>array('NOMLONG'=>'asc'),'conditions'=>array('HIERARCHIQUE'=>1)));
                $this->set('hierarchique',$hierarchique);
                $profil = $this->Utilisateur->Profil->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('profil',$profil);
                $assistance = $this->Utilisateur->Assistance->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('assistance',$assistance);                
                $site = $this->Utilisateur->Site->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('site',$site);
                $domaine = $this->Utilisateur->Domaine->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('domaine',$domaine);
                $tjmagent = $this->Utilisateur->Tjmagent->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('tjmagent',$tjmagent);  
                $outil = $this->Utilisateur->Outil->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('outil',$outil);  
                $listediffusion = $this->Utilisateur->Listediffusion->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('listediffusion',$listediffusion);
                $dossierpartage = $this->Utilisateur->Dossierpartage->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('dossierpartage',$dossierpartage);
                $activite = $this->Utilisateur->Activite->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('activite',$activite);
                $workcapacite = Configure::read('workCapacity');
                $this->set('workcapacite',$workcapacite);
                $affectations = $this->Utilisateur->Affectation->find('all',array('fields'=>array('id','activite_id','Activite.NOM'),'conditions'=>array('Affectation.utilisateur_id'=>$id)));
                $this->set('affectations',$affectations);
                $dotations = $this->Utilisateur->Dotation->find('all',array('conditions'=>array('Dotation.utilisateur_id'=>$id)));
                $this->set('dotations',$dotations);
                $utiliseoutils = $this->Utilisateur->Utiliseoutil->find('all',array('fields'=>array('id','outil_id','Outil.NOM','listediffusion_id','Listediffusion.NOM','dossierpartage_id','Dossierpartage.NOM','Utiliseoutil.STATUT'),'conditions'=>array('Utiliseoutil.utilisateur_id'=>$id)));
                $this->set('utiliseoutils',$utiliseoutils);
                if (!$this->Utilisateur->exists($id)) {
			throw new NotFoundException(__('Utilisateur incorrect'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {

			if ($this->Utilisateur->save($this->request->data)) {
                        $history['Historyutilisateur']['utilisateur_id']=$this->Utilisateur->id;
                        $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - Utilisateur mis à jour";
                        $this->Utilisateur->Historyutilisateur->save($history);                            
				$this->Session->setFlash(__('Utilisateur sauvegardé'),true,array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Utilisateur incorrect, veuillez corriger l\'utilisateur'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Utilisateur.' . $this->Utilisateur->primaryKey => $id));
			$this->request->data = $this->Utilisateur->find('first', $options);
                        $this->set('utilisateur', $this->Utilisateur->find('first', $options));
                        $options = array('conditions' => array('Historyutilisateur.utilisateur_id' => $id),'order'=>array('Historyutilisateur.created'=> 'desc','Historyutilisateur.HISTORIQUE'=>'desc'));
                        $historyutilisateurs = $this->Utilisateur->Historyutilisateur->find('all',$options);
                        $this->set('historyutilisateurs',$historyutilisateurs);
                        $options = array('conditions' => array('Utiliseoutil.utilisateur_id' => $id));
                        $utiliseoutils = $this->Utilisateur->Utiliseoutil->find('all',$options);
                        $this->set('utiliseoutils',$utiliseoutils);
                        $compteurs = $this->Utilisateur->Utiliseoutil->query("SELECT count(outil_id) AS nboutil, count(listediffusion_id) AS nbliste, count(dossierpartage_id) AS nbpartage FROM utiliseoutils WHERE utilisateur_id =".$id);
                        $this->set('compteurs',$compteurs);
                        $nbDotation = $this->Utilisateur->Dotation->query("SELECT count(id) AS nbDotation FROM dotations WHERE utilisateur_id =".$id);
                        $this->set('nbDotation',$nbDotation);   
                        $nbAffectation = $this->Utilisateur->Affectation->query("SELECT count(id) AS nbAffectation FROM affectations WHERE utilisateur_id =".$id);
                        $this->set('nbAffectation',$nbAffectation);                          
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
		$this->Utilisateur->id = $id;
		if (!$this->Utilisateur->exists()) {
			throw new NotFoundException(__('Utilisateur incorrect'),true,array('class'=>'alert alert-error'));
		}
                $record = $this->Utilisateur->read();
                unset($record['Utilisateur']['ACTIF']); 
                unset($record['Utilisateur']['created']);
                unset($record['Utilisateur']['modified']);
                $record['Utilisateur']['ACTIF']=0; 
                $record['Utilisateur']['created'] = $this->Utilisateur->read('created');
                $record['Utilisateur']['modified'] = date('Y-m-d');                
                if ($this->Utilisateur->save($record)) {
                        $history['Historyutilisateur']['utilisateur_id']=$this->Utilisateur->id;
                        $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - utilisateur supprimé";
                        $this->Utilisateur->Historyutilisateur->save($history);
			$this->Session->setFlash(__('Utilisateur supprimé'),true,array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Utilisateur <b>NON</b> supprimé'),true,array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
	}
        
/**
 * profil method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function profil($id = null) {
                $this->set('title_for_layout',"Mon profils");
                if ($id != null){
                    if (!$this->Utilisateur->exists($id)) {
                            throw new NotFoundException(__('Utilisateur incorrect'),true,array('class'=>'alert alert-error'));
                    }
                $options = array('conditions' => array('Utilisateur.' . $this->Utilisateur->primaryKey => $id));
                $this->set('utilisateur', $this->Utilisateur->find('first', $options));    
                } else {
                    throw new NotFoundException(__('Utilisateur non renseigné'),true,array('class'=>'alert alert-error'));
                }
        }  
        
/**
 * logout method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param none
 * @return void
 */
	public function logout() {
            $this->set('title_for_layout',"Déconnexion");
        }  
        
/**
 * dupliquer method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function dupliquer($id = null) {
		$this->Utilisateur->id = $id;
                $record = $this->Utilisateur->read();
                $NOMLONG = $record['Utilisateur']['NOMLONG'];
                unset($record['Utilisateur']['id']);
                unset($record['Utilisateur']['password']); 
                unset($record['Utilisateur']['utilisateur_id']); 
                unset($record['Utilisateur']['tjmagent_id']); 
                unset($record['Utilisateur']['dotation_id']);
                unset($record['Utilisateur']['username']);
                unset($record['Utilisateur']['ACTIF']); 
                unset($record['Utilisateur']['DATEDEBUTACTIF']); 
                unset($record['Utilisateur']['NAISSANCE']);
                unset($record['Utilisateur']['NOM']);
                unset($record['Utilisateur']['PRENOM']);
                unset($record['Utilisateur']['MAIL']);  
                unset($record['Utilisateur']['TELEPHONE']);
                unset($record['Utilisateur']['CONGE']);
                unset($record['Utilisateur']['RQ']);
                unset($record['Utilisateur']['VT']);                
                unset($record['Utilisateur']['COMMENTAIRE']);
                unset($record['Utilisateur']['created']);                
                unset($record['Utilisateur']['modified']);
                $this->Utilisateur->create();
                if ($this->Utilisateur->save($record)) {
                        $history['Historyutilisateur']['utilisateur_id']=$this->Utilisateur->id;
                        $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - Utilisateur dupliqué à partir de ".$NOMLONG;
                        $this->Utilisateur->Historyutilisateur->save($history);
                        $this->Session->setFlash(__('Utilisateur dupliqué'),true,array('class'=>'alert alert-success'));
                        $this->redirect($this->goToPostion());
                } 
		$this->Session->setFlash(__('Utilisateur <b>NON</b> dupliqué'),true,array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
	}   
    
/**
 * initpassword method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function initpassword($id = null) {
		$this->Utilisateur->id = $id;
                $record = $this->Utilisateur->read();
                unset($record['Utilisateur']['password']); 
                unset($record['Utilisateur']['created']);
                unset($record['Utilisateur']['modified']);
                $record['Utilisateur']['password']='OSACT'; 
                $record['Utilisateur']['created'] = $this->Utilisateur->read('created');
                $record['Utilisateur']['modified'] = date('Y-m-d');                
                if ($this->Utilisateur->save($record)) {
                        $history['Historyutilisateur']['utilisateur_id']=$this->Utilisateur->id;
                        $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - mot de passe initialisé";
                        $this->Utilisateur->Historyutilisateur->save($history);
                        $this->Session->setFlash(__('Mot de passe de l\'utilisateur initialisé'),true,array('class'=>'alert alert-success'));
                        $this->redirect($this->goToPostion());
                } 
		$this->Session->setFlash(__('Mot de passe de l\'utilisateur <b>NON</b> initialisé'),true,array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
	} 
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $keyword=$this->params->data['Utilisateur']['SEARCH']; 
                $newconditions = array('OR'=>array("Utilisateur.NOM LIKE '%".$keyword."%'","Utilisateur.PRENOM LIKE '%".$keyword."%'","Utilisateur.COMMENTAIRE LIKE '%".$keyword."%'","Utilisateur.TELEPHONE LIKE '%".$keyword."%'","Utilisateur.WORKCAPACITY LIKE '%".$keyword."%'","Profil.NOM LIKE '%".$keyword."%'","Societe.NOM LIKE '%".$keyword."%'","Assistance.NOM LIKE '%".$keyword."%'","Section.NOM LIKE '%".$keyword."%'","Tjmagent.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Utilisateur->recursive = 0;
                $this->set('utilisateurs', $this->paginate());
                $sections = $this->Utilisateur->Section->find('all',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc')));
                $this->set('sections',$sections);
                $this->render('index');
        }         
}
