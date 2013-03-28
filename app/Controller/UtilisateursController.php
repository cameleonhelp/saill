<?php
App::uses('AppController', 'Controller','Authentification');
/**
 * Utilisateurs Controller
 *
 * @property Utilisateur $Utilisateur
 */
class UtilisateursController extends AppController {
 
    var $name = 'Utilisateurs';
    public $paginate = array(
        'limit' => 15,
        'order' => array('Utilisateur.NOM' => 'asc','Utilisateur.PRENOM' => 'asc'),
        'conditions'=>array('Utilisateur.id > '=> 1),
        );

    public function beforeFilter() {
        /** DEBUT : cookie remember me **/
        $this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
        $this->Cookie->httpOnly = true;   
        $this->Auth->allow(array('login','logout'));
        parent::beforeFilter();
    }    
/**
 * index method
 *
 * @return void
 */
	public function index($filtreUtilisateur=null,$filtreSection=null) {
            if (isAuthorized('utilisateurs', 'index')) :
                switch ($filtreUtilisateur){
                    case 'tous':
                    case null:    
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
                    case null:    
                        $newconditions[]="1=1";
                        $fsection = "toutes les sections";
                        break;
                    default :
                        $newconditions[]="Section.id='".$filtreSection."'";
                        $section = $this->Utilisateur->Section->find('first',array('conditions'=>array('Section.id'=>$filtreSection)));
                        $fsection = "la section ".$section['Section']['NOM'];                        
                }    
                
                $this->set('fsection',$fsection);
                $this->set('futilisateur',$futilisateur);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
		$this->Utilisateur->recursive = 0;
		$this->set('utilisateurs', $this->paginate());
                $this->Session->delete('xls_export');
                $newconditions = array_merge($newconditions,array('Utilisateur.id > '=> 1));
                $export = $this->Utilisateur->find('all',array('conditions'=>$newconditions,'order' => array('Utilisateur.NOM' => 'asc','Utilisateur.PRENOM' => 'asc')));
                $this->Session->write('xls_export',$export);                  
                $sections = $this->Utilisateur->Section->find('all',array('fields' => array('id','NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc')));
                $this->set('sections',$sections);
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
            if (isAuthorized('utilisateurs', 'view')) :
		if (!$this->Utilisateur->exists($id)) {
			throw new NotFoundException(__('Utilisateur incorrect'));
		}
		$options = array('conditions' => array('Utilisateur.' . $this->Utilisateur->primaryKey => $id));
		$this->set('utilisateur', $this->Utilisateur->find('first', $options));
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
	public function add() {
            if (isAuthorized('utilisateurs', 'add')) :
                $societe = $this->Utilisateur->Societe->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $this->set('societe',$societe);
                if ($this->request->is('post')) :
			$this->Utilisateur->create();
			if ($this->Utilisateur->save($this->request->data)) {
                                $history['Historyutilisateur']['utilisateur_id']=$this->Utilisateur->id;
                                $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - Utilisateur créé".' par '.userAuth('NOMLONG');
                                $this->Utilisateur->Historyutilisateur->save($history);                              
				$this->Session->setFlash(__('Utilisateur sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Utilisateur incorrect, veuillez corriger l\'utilisateur'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('utilisateurs', 'edit')) :
                if (!$this->Utilisateur->exists($id)) {
			throw new NotFoundException(__('Utilisateur incorrect'),'default',array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    $this->Utilisateur->id = $id;
                    if ($this->Utilisateur->save($this->request->data)) {
                        $history['Historyutilisateur']['utilisateur_id']=$this->Utilisateur->id;
                        $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - Utilisateur mis à jour".' par '.userAuth('NOMLONG');
                        $this->Utilisateur->Historyutilisateur->save($history);                            
				$this->Session->setFlash(__('Utilisateur sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Utilisateur incorrect, veuillez corriger l\'utilisateur'),'default',array('class'=>'alert alert-error'));
			}
		} else {
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
                        $affectations = $this->Utilisateur->Affectation->find('all',array('fields'=>array('id','activite_id','Activite.NOM','Affectation.REPARTITION','Activite.DESCRIPTION'),'conditions'=>array('Affectation.utilisateur_id'=>$id)));
                        $this->set('affectations',$affectations);
                        $dotations = $this->Utilisateur->Dotation->find('all',array('conditions'=>array('Dotation.utilisateur_id'=>$id)));
                        $this->set('dotations',$dotations);
                        $utiliseoutils = $this->Utilisateur->Utiliseoutil->find('all',array('fields'=>array('id','outil_id','Outil.NOM','listediffusion_id','Listediffusion.NOM','dossierpartage_id','Dossierpartage.NOM','Utiliseoutil.STATUT'),'conditions'=>array('Utiliseoutil.utilisateur_id'=>$id)));
                        $this->set('utiliseoutils',$utiliseoutils);
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
            if (isAuthorized('utilisateurs', 'delete')) :
		$this->Utilisateur->id = $id;
		if (!$this->Utilisateur->exists()) {
			throw new NotFoundException(__('Utilisateur incorrect'));
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
                        $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - utilisateur supprimé".' par '.userAuth('NOMLONG');
                        $this->Utilisateur->Historyutilisateur->save($history);
			$this->Session->setFlash(__('Utilisateur supprimé'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Utilisateur <b>NON</b> supprimé'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}
        
/**
 * profil method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function profil($id=null) {
            if (!$this->Utilisateur->exists($id)) {
                    throw new NotFoundException(__('Utilisateur incorrect'),'default',array('class'=>'alert alert-error'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->Utilisateur->id = $id;
                if (!empty($this->request->data['Utilisateur']['password_confirm']))$this->request->data['Utilisateur']['password'] = $this->request->data['Utilisateur']['password_confirm'];
                if ($this->Utilisateur->save($this->request->data)) {
                    $history['Historyutilisateur']['utilisateur_id']=$this->Utilisateur->id;
                    $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - Utilisateur mis à jour".' par '.userAuth('NOMLONG');
                    $this->Utilisateur->Historyutilisateur->save($history);                            
                            $this->Session->setFlash(__('Utilisateur sauvegardé'),'default',array('class'=>'alert alert-success'));
                            $this->redirect($this->goToPostion(1));
                    } else {
                            $this->Session->setFlash(__('Utilisateur incorrect, veuillez corriger l\'utilisateur'),'default',array('class'=>'alert alert-error'));
                    }
            } else {
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
                    $affectations = $this->Utilisateur->Affectation->find('all',array('fields'=>array('id','activite_id','Activite.NOM','Affectation.REPARTITION','Activite.DESCRIPTION'),'conditions'=>array('Affectation.utilisateur_id'=>$id)));
                    $this->set('affectations',$affectations);
                    $dotations = $this->Utilisateur->Dotation->find('all',array('conditions'=>array('Dotation.utilisateur_id'=>$id)));
                    $this->set('dotations',$dotations);
                    $utiliseoutils = $this->Utilisateur->Utiliseoutil->find('all',array('fields'=>array('id','outil_id','Outil.NOM','listediffusion_id','Listediffusion.NOM','dossierpartage_id','Dossierpartage.NOM','Utiliseoutil.STATUT'),'conditions'=>array('Utiliseoutil.utilisateur_id'=>$id)));
                    $this->set('utiliseoutils',$utiliseoutils);
                    $options = array('conditions' => array('Utilisateur.' . $this->Utilisateur->primaryKey => $id));
                    $this->request->data = $this->Utilisateur->find('first', $options);
                    $this->set('utilisateur', $this->Utilisateur->find('first', $options));
                    $options = array('conditions' => array('Historyutilisateur.utilisateur_id' => $id),'limit'=>10,'order'=>array('Historyutilisateur.created'=> 'desc','Historyutilisateur.HISTORIQUE'=>'desc'));
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
                    $currentUser = $this->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$id)));
                    $hierarchique = $this->Utilisateur->find('first',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id'=>$currentUser['Utilisateur']['utilisateur_id'])));
                    $this->set('hierarchique',$hierarchique);
            }             
        }
   
/**
 * Login method
 * 
 * @param none
 * @return void
 */        
        public function login() {
            $this->set('title_for_layout',"Connexion");
            if ($this->request->is('post')) {
                $password=Security::hash($this->Auth->request->data['Utilisateur']['password'],'md5',false);
                $username = $this->Auth->request->data['Utilisateur']['username'];
                if (count($this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$username))))>0){
                    if (count($this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$username,'Utilisateur.password'=>$password))))>0) {
                        $utilisateur = $this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$username,'Utilisateur.password'=>$password)));
                        $autorisations = $this->Utilisateur->Profil->Autorisation->find('all',array('conditions'=>array('Autorisation.profil_id'=>$utilisateur['Utilisateur']['profil_id'])));
                        $this->Session->renew();
                        $this->Session->write(AUTHORIZED,$autorisations);
                        /** cookie pour remember me **/
                        if ($this->Auth->request->data['Utilisateur']['remember_me'] == 1) {
                            // remove "remember me checkbox"
                            unset($this->Auth->request->data['Utilisateur']['remember_me']);
                            // hash the user's password
                            $cookie = array();
                            $cookie['username'] = $this->Auth->request->data['Utilisateur']['username'];
                            $cookie['password'] = $this->Auth->request->data['Utilisateur']['password'];
                            // write the cookie
                            $this->Cookie->write('remember_me_cookie', $cookie, true, '2 weeks');
                        }
                        $this->Auth->login($utilisateur['Utilisateur']);
                        $this->redirect($this->Auth->redirect());
                    } else {
                        $this->Session->setFlash(__('Mot de passe invalide, réessayer'),'default',array('class'=>'alert alert-error'));
                    }                    
                } else {
                    $this->Session->setFlash(__('Login inexistant ou compte invalide, contacter l\'administrateur'),'default',array('class'=>'alert alert-error'));
                }
            }
            /** si login pas posté **/
            /** on lit le cookie et si c'est bon on se connecte **/
            if (empty($this->data)) {
                $cookie = $this->Cookie->read('remember_me_cookie');
                if (!is_null($cookie)) {
                    $utilisateur = array();
                    $utilisateur['username'] = $cookie['username'];
                    $utilisateur['password'] = Security::hash($cookie['password'],'md5',false);
                    if (count($this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$utilisateur['username']))))>0){
                        if (count($this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$utilisateur['username'],'Utilisateur.password'=>$utilisateur['password']))))>0) {
                            $utilisateur = $this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$utilisateur['username'],'Utilisateur.password'=>$utilisateur['password'])));
                            $autorisations = $this->Utilisateur->Profil->Autorisation->find('all',array('conditions'=>array('Autorisation.profil_id'=>$utilisateur['Utilisateur']['profil_id'])));
                            $this->Session->renew();
                            $this->Session->write(AUTHORIZED,$autorisations);
                            if ($this->Auth->login($utilisateur['Utilisateur'])) {
                                //  Clear auth message, just in case we use it.
                                $this->redirect($this->Auth->redirect());
                            } else { // Delete invalid Cookie
                                $this->Cookie->delete('remember_me_cookie');
                            }
                        } else {
                        $this->Session->renew();
                        $this->Cookie->delete('remember_me_cookie');
                        $this->Session->setFlash(__('Cookie : Mot de passe invalide, réessayer'),'default',array('class'=>'alert alert-error'));
                        }                    
                    } else {
                    $this->Session->renew();
                    $this->Cookie->delete('remember_me_cookie');
                    $this->Session->setFlash(__('Cookie : Login inexistant ou compte invalide, contacter l\'administrateur'),'default',array('class'=>'alert alert-error'));
                    }
                }
            }
        }
      
/**
 * logout method
 *
 * @param none
 * @return void
 */
	public function logout() {
            $this->set('title_for_layout',"Connexion");
            $this->Cookie->delete('remember_me_cookie');
            $this->Session->delete('Auth.User');
            $this->redirect($this->Auth->logout());
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
            if (isAuthorized('utilisateurs', 'duplicate')) :
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
                        $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - Utilisateur dupliqué à partir de ".$NOMLONG.' par '.userAuth('NOMLONG');
                        $this->Utilisateur->Historyutilisateur->save($history);
                        $this->Session->setFlash(__('Utilisateur dupliqué'),'default',array('class'=>'alert alert-success'));
                        $this->redirect($this->goToPostion());
                } 
		$this->Session->setFlash(__('Utilisateur <b>NON</b> dupliqué'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
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
            if (isAuthorized('utilisateurs', 'initpassword')) :
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
                        $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - mot de passe initialisé".' par '.userAuth('NOMLONG');
                        $this->Utilisateur->Historyutilisateur->save($history);
                        $this->Session->setFlash(__('Mot de passe de l\'utilisateur initialisé'),'default',array('class'=>'alert alert-success'));
                        $this->redirect($this->goToPostion());
                } 
		$this->Session->setFlash(__('Mot de passe de l\'utilisateur <b>NON</b> initialisé'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('utilisateurs', 'index')) :
                $keyword=isset($this->params->data['Utilisateur']['SEARCH'])? $this->params->data['Utilisateur']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Utilisateur.username LIKE '%".$keyword."%'","Utilisateur.NOM LIKE '%".$keyword."%'","Utilisateur.PRENOM LIKE '%".$keyword."%'","Utilisateur.COMMENTAIRE LIKE '%".$keyword."%'","Utilisateur.TELEPHONE LIKE '%".$keyword."%'","Utilisateur.WORKCAPACITY LIKE '%".$keyword."%'","Profil.NOM LIKE '%".$keyword."%'","Societe.NOM LIKE '%".$keyword."%'","Assistance.NOM LIKE '%".$keyword."%'","Section.NOM LIKE '%".$keyword."%'","Tjmagent.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Utilisateur->recursive = 0;
                $this->set('utilisateurs', $this->paginate());
                $this->Session->delete('xls_export');
                $newconditions = array_merge($newconditions,array('Utilisateur.id>1'));
                $export = $this->Utilisateur->find('all',array('Utilisateur.id > '=> 1));
                $this->Session->write('xls_export',$export);                                 
                $sections = $this->Utilisateur->Section->find('all',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc')));
                $this->set('sections',$sections);
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
        }    
        
/**
 * export_xls
 * 
 */       
	function export_xls() {
		$data = $this->Session->read('xls_export');
		$this->set('rows',$data);
		$this->render('export_xls','export_xls');
	}         
}
