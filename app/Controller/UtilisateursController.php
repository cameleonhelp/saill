<?php
App::uses('AppController', 'Controller','Authentification');
App::uses('CakeEmail', 'Network/Email');
App::uses('AssoentiteutilisateursController', 'Controller');
App::uses('ParametersController', 'Controller');
App::uses('SectionsController', 'Controller');
App::uses('UtiliseoutilsController', 'Controller');
App::uses('AffectationsController', 'Controller');
App::uses('DotationsController', 'Controller');
App::uses('HistoryutilisateursController', 'Controller');
App::uses('DomainesController', 'Controller');
App::uses('TjmagentsController', 'Controller');
App::uses('SitesController', 'Controller');
App::uses('AssistancesController', 'Controller');
App::uses('ProfilsController', 'Controller');
App::uses('SocietesController', 'Controller');
App::uses('EntitesController', 'Controller');
/**
 * Utilisateurs Controller
 *
 * @property Utilisateur $Utilisateur
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class UtilisateursController extends AppController {
    public $components = array('History','Common'); 
    
    var $name = 'Utilisateurs';
    
    public $paginate = array(
        'limit' => 25,
        'order' => array('Utilisateur.NOM' => 'asc','Utilisateur.PRENOM' => 'asc'),
        'conditions'=>array('Utilisateur.id > '=> 1),
        );

    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Utilisateurs" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }     
    
    public function beforeRender() {
        parent::beforeRender();
    }
    
    public function beforeFilter() {
        /** DEBUT : cookie remember me **/
        $this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
        $this->Cookie->httpOnly = true;   
        $this->Auth->allow(array('login','logout','initmypassword'));
        parent::beforeFilter();
    }    
    
    
    public function get_visibility(){
        //si l'utilisateur est administrateur il voit tout
        //dans les autres cas la visibilité est limitée aux utilisateur de ses cercles
        //qu'ils soient actif ou pas même les génériques
        if(userAuth('profil_id')==1):
            return null;
        else:
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            return $ObjAssoentiteutilisateurs->json_get_all_users(userAuth('id'));
        endif;
    }
    
    public function get_utilisateur_etat_filter($id,$visibility) {
        $result = array();
        switch ($id){
            case 'tous': 
                if($visibility == null):
                    $result['condition']="1=1";
                elseif ($visibility!=''):
                    $result['condition']="Utilisateur.id IN (".$visibility.')';
                else:
                    $result['condition']="Utilisateur.entite_id =".userAuth('entite_id');
                endif;
                $result['filter']= "tous les utilisateurs";
                break;
            case 'actif':    
            case null: 
                if($visibility == null):
                    $result['condition']="Utilisateur.ACTIF=1 AND (Utilisateur.profil_id > 0 OR Utilisateur.profil_id=-2)";
                elseif ($visibility!=''):
                    $result['condition']="Utilisateur.id IN (".$visibility.") AND Utilisateur.ACTIF=1 AND (Utilisateur.profil_id > 0 OR Utilisateur.profil_id=-2)";
                else:
                    $result['condition']="Utilisateur.entite_id =".userAuth('entite_id')." AND Utilisateur.ACTIF=1 AND (Utilisateur.profil_id > 0 OR Utilisateur.profil_id=-2)";
                endif;                
                $result['filter'] = "tous les utilisateurs actifs";
                break;  
            case 'inactif':
                if($visibility == null):
                    $result['condition']="Utilisateur.ACTIF=0 AND (Utilisateur.profil_id > 0 OR Utilisateur.profil_id=-2)";
                elseif ($visibility!=''):
                    $result['condition']="Utilisateur.id IN (".$visibility.") AND Utilisateur.ACTIF=0 AND (Utilisateur.profil_id > 0 OR Utilisateur.profil_id=-2)";
                else:
                    $result['condition']="Utilisateur.entite_id =".userAuth('entite_id')." AND Utilisateur.ACTIF=0 AND (Utilisateur.profil_id > 0 OR Utilisateur.profil_id=-2)";
                endif;                 
                $result['filter'] = "tous les utilisateurs inactifs";
                break;  
            case 'incomplet':
                if($visibility == null):
                    $result['condition']="Utilisateur.ACTIF=1 AND (Utilisateur.profil_id IS NULL OR Utilisateur.profil_id!=-1) AND (Utilisateur.section_id = 0 OR Utilisateur.assistance_id IS NULL OR Utilisateur.site_id IS NULL OR Utilisateur.username='' OR Utilisateur.username IS NULL OR Utilisateur.MAIL='' OR Utilisateur.MAIL IS NULL)";
                elseif ($visibility!=''):
                    $result['condition']="Utilisateur.ACTIF=1 AND (Utilisateur.profil_id IS NULL OR Utilisateur.profil_id!=-1) AND (Utilisateur.section_id = 0 OR Utilisateur.assistance_id IS NULL OR Utilisateur.site_id IS NULL OR Utilisateur.username='' OR Utilisateur.username IS NULL OR Utilisateur.MAIL='' OR Utilisateur.MAIL IS NULL AND Utilisateur.id IN (".$visibility.'))';
                else:
                    $result['condition']="Utilisateur.entite_id =".userAuth('entite_id')." AND Utilisateur.ACTIF=1 AND (Utilisateur.profil_id IS NULL OR Utilisateur.profil_id!=-1) AND (Utilisateur.section_id = 0 OR Utilisateur.assistance_id IS NULL OR Utilisateur.site_id IS NULL OR Utilisateur.username='' OR Utilisateur.username IS NULL OR Utilisateur.MAIL='' OR Utilisateur.MAIL IS NULL)";
                endif;                 
                $result['filter'] = "tous les utilisateurs actifs et incomplets";
                break;  
            case 'aprolonger':
                if($visibility == null):
                    $result['condition']="Utilisateur.ACTIF=1 AND (Utilisateur.profil_id > 0 OR Utilisateur.profil_id=-2) AND Utilisateur.FINMISSION IS NOT NULL AND Utilisateur.FINMISSION < DATE_ADD(CURDATE(), INTERVAL 1 MONTH";
                elseif ($visibility!=''):
                    $result['condition']="Utilisateur.ACTIF=1 AND (Utilisateur.profil_id > 0 OR Utilisateur.profil_id=-2) AND Utilisateur.FINMISSION IS NOT NULL AND Utilisateur.FINMISSION < DATE_ADD(CURDATE(), INTERVAL 1 MONTH AND Utilisateur.id IN (".$visibility.')';
                else:
                    $result['condition']="Utilisateur.entite_id =".userAuth('entite_id')." AND Utilisateur.ACTIF=1 AND (Utilisateur.profil_id > 0 OR Utilisateur.profil_id=-2) AND Utilisateur.FINMISSION IS NOT NULL AND Utilisateur.FINMISSION < DATE_ADD(CURDATE(), INTERVAL 1 MONTH";
                endif;                 
                $result['filter'] = "tous les utilisateurs actifs, dont la date de fin de mission est proche de son terme";
                break;  
            case 'nouveau':
                if($visibility == null):
                    $result['condition']="Utilisateur.NEW = 1 AND Utilisateur.ACTIF = 1";
                elseif ($visibility!=''):
                    $result['condition']="Utilisateur.NEW = 1 AND Utilisateur.ACTIF = 1 AND Utilisateur.id IN (".$visibility.')';
                else:
                    $result['condition']="Utilisateur.entite_id =".userAuth('entite_id')." AND Utilisateur.NEW = 1 AND Utilisateur.ACTIF = 1";
                endif;                      
                $result['filter'] = "tous les nouveaux utilisateurs dont le compte est en cours de création";
                break;                     
        }
        return $result;
    }
    
    public function get_section_filter($id,$etat=null) {
        $result = array('condition'=>"1=1",'filter'=>"toutes les sections");
        $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();  
        if($etat != 'nouveau' && $etat!='incomplet'):
        switch ($id){
            case 'allsections':
            case null:  
                //TODO : test si filtre état = incomplet ou nouveau
                $sections = $ObjAssoentiteutilisateurs->find_all_section(userAuth('id'));
                $result['condition'] = "Utilisateur.section_id IN (0,".$sections.")";                 
                $result['filter'] = "toutes les sections";
                break;
            default :
                $result['condition']="Section.id='".$id."'";
                $this->Utilisateur->Section->recursive = -1;
                $section = $this->Utilisateur->Section->find('first',array('conditions'=>array('Section.id'=>$id)));
                $result['filter'] = "la section ".$section['Section']['NOM'];                        
        }  
        endif;
        return $result;
    }
    
    public function get_societe_filter($id) {
        $result = array();
        switch ($id){
            case 'tous':
            case null:    
                $result['condition']="1=1";
                $result['filter'] = "pour toutes les sociétés";
                break;
            case '1' :
                $result['condition']="Societe.id = 1";
                $result['filter'] = " dont la societe est SNCF";  
                break;
            case '0' :
                $result['condition']="Societe.id > 1";
                $result['filter'] = " dont la societe est autre que SNCF";  
                break;            
        }   
        return $result; 
    }
    
    public function get_alpha_filter($id) {
        $result = array();
        if (isset($id) && $id!='tous'){
            $alphabet=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
            $result['condition']="Utilisateur.NOM LIKE '".$alphabet[$id]."%'";
            $result['filter'] = ", dont le nom commence par ".$alphabet[$id];
        }
        else
        {
            $result['condition']="1=1";
            $result['filter'] = "";  
        }
        return $result;
    }    
    
    public function get_export($conditions){
        $this->Session->delete('xls_export');
        $conditions = array_merge($conditions,array('Utilisateur.id > '=> 1));
        $this->Utilisateur->recursive = 0;
        $export = $this->Utilisateur->find('all',array('conditions'=>$conditions,'order' => array('Utilisateur.NOM' => 'asc','Utilisateur.PRENOM' => 'asc')));
        $this->Session->write('xls_export',$export);      
    }
    
    public function get_list_hierarchique(){
        $condition = array('Utilisateur.id >'=>1,"Utilisateur.HIERARCHIQUE = 1");
        return $this->Utilisateur->Utilisateur->find('list',array('fields' => array('id', 'NOMLONG'),'conditions'=>$condition,'recursive'=>0));
    }
    
    public function get_list_my_hierarchie($visibility){
        if($visibility == null):
            $condition = "Utilisateur.HIERARCHIQUE = 1";
        elseif ($visibility!=''):
            $condition = "Utilisateur.entite_id =".userAuth('entite_id')." AND Utilisateur.HIERARCHIQUE = 1";
        else:
            $condition = "Utilisateur.id IN (".userAuth('entite_id').") AND Utilisateur.HIERARCHIQUE = 1";
        endif;         
        return $this->Utilisateur->Utilisateur->find('list',array('fields' => array('id', 'NOMLONG'),'order'=>array('NOMLONG'=>'asc'),'conditions'=>$condition,'recursive'=>0));
    }
    
    public function get_all_my_hierarchie($visibility){
        if($visibility == null):
            $condition = "Utilisateur.HIERARCHIQUE = 1";
        elseif ($visibility!=''):
            $condition = "Utilisateur.entite_id =".userAuth('entite_id')." AND Utilisateur.HIERARCHIQUE = 1";
        else:
            $condition = "Utilisateur.id IN (".userAuth('entite_id').") AND Utilisateur.HIERARCHIQUE = 1";
        endif;         
        return $this->Utilisateur->Utilisateur->find('all',array('order'=>array('NOMLONG'=>'asc'),'conditions'=>$condition,'recursive'=>0));
    }  
    
    public function get_str_section_utilisateurs(){
        $list = "";
        $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();        
        $sections = $ObjAssoentiteutilisateurs->find_all_section(userAuth('id'));
        $conditions[]="Utilisateur.section_id IN (".$sections.')';
        $order = array("Utilisateur.section_id"=>'asc');
        $group = "Utilisateur.section_id";
        $fields = array("Utilisateur.section_id");
        $users = $this->Utilisateur->find('all',array('fields'=>$fields,'conditions'=>$conditions,'order'=>$order,'group'=>$group,'recursive'=>-1));
        foreach ($users as $result):
            $list .= $result['Utilisateur']['section_id'].',';
        endforeach;
        return strlen($list) > 1 ? substr_replace($list ,"",-1) : '0';
    }    
/**
 * index method
 *
 * @return void
 */
	public function index($filtreUtilisateur=null,$filtreSection=null,$filtresociete=null,$filtreAlpha=null) {
            if (isAuthorized('utilisateurs', 'index')) :
                $listusers = $this->get_visibility();
                $getusers = $this->get_utilisateur_etat_filter($filtreUtilisateur, $listusers);
                $getsection = $this->get_section_filter($filtreSection,$filtreUtilisateur);
                $getsociete = $this->get_societe_filter($filtresociete);
                $getalpha = $this->get_alpha_filter($filtreAlpha);
                $newconditions=array($getusers['condition'],$getsection['condition'],$getsociete['condition'],$getalpha['condition']);
                $this->set('fsociete',$getsociete['filter']);
                $this->set('fsection',$getsection['filter']);
                $this->set('futilisateur',$getusers['filter']);
                $this->set('falpha',$getalpha['filter']);
                if (userAuth('WIDEAREA')==0) {
                    $newconditions[]="Utilisateur.section_id=".userAuth('section_id');
                }
                $ObjSections = new SectionsController();                
                $sections = $ObjSections->get_all($listusers);
                $this->set('sections',$sections);                
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
		$this->Utilisateur->recursive = 0;
		$this->set('utilisateurs', $this->paginate());
                $this->get_export($newconditions);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('utilisateurs', 'add')) :
                $this->Utilisateur->Societe->recursive = -1;
                $societe = $this->Utilisateur->Societe->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                $ObjEntites = new EntitesController();    
                $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();                
                $cercles = $ObjEntites->find_list_cercle();
                $this->set(compact('societe','cercles'));
                if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Utilisateur->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Utilisateur->create();
                        $this->request->data['Utilisateur']['NEW']=1;
			if ($this->Utilisateur->save($this->request->data)) {
                                $lastid = $this->Utilisateur->getLastInsertID();
                                $utilisateur = $this->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$lastid),'recursive'=>0));
                                if($utilisateur['Utilisateur']['profil_id']>0 || $utilisateur['Utilisateur']['profil_id']==-2):
                                    $this->sendmailnewutilisateur($utilisateur);
                                endif;
                                $this->addnewaction($lastid);
                                $entite_id = $this->request->data['Utilisateur']['entite_id'];
                                $ObjAssoentiteutilisateurs->silent_save($entite_id,$lastid);
                                $this->save_history($lastid, "Utilisateur créé");                           
				$this->Session->setFlash(__('Utilisateur sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Utilisateur incorrect, veuillez corriger l\'utilisateur',true),'flash_failure');
			}
                    endif;
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
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
                set_time_limit(60);
                $ObjEntites = new EntitesController();
                $ObjSocietes = new SocietesController();    
                $ObjSections = new SectionsController();
                $ObjProfils = new ProfilsController();   
                $ObjAssistances = new AssistancesController();
                $ObjSites = new SitesController();   
                $ObjTjmagents = new TjmagentsController();  
                $ObjDomaines = new DomainesController();  
                $ObjUtiliseoutils = new UtiliseoutilsController();		
                $ObjHistoryutilisateurs = new HistoryutilisateursController();	
                $ObjDotations = new DotationsController();	
                $ObjAffectations = new AffectationsController();                
                if (!$this->Utilisateur->exists($id)) {
			throw new NotFoundException(__('Utilisateur incorrect',true),'flash_failure');
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Utilisateur->validate = array();
                        $this->History->goBack(1);
                    else:                     
                        $this->Utilisateur->id = $id;
                        $this->request->data['Utilisateur']['NEW']=0;
                        if ($this->Utilisateur->save($this->request->data)) {  
                            $this->delete_dependance($id);
                            $this->save_history($id,'Modification du compte utilisateur');
                            $this->Session->setFlash(__('Utilisateur sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
			} else {
                            $this->Session->setFlash(__('Utilisateur incorrect, veuillez corriger l\'utilisateur',true),'flash_failure');
			}
                    endif;
		} else {
                        //pour les dropdownlists de la form
                        $listusers = $this->get_visibility();
                        $societe = $ObjSocietes->get_list();
                        $cercles = $ObjEntites->find_list_cercle();
                        $section = $ObjSections->get_list($listusers);
                        $hierarchique = $this->get_list_my_hierarchie($listusers);
                        $profil = $ObjProfils->get_list();
                        $assistance = $ObjAssistances->get_list();
                        $site = $ObjSites->get_list();
                        $domaine = $ObjDomaines->get_list();
                        $tjmagent = $ObjTjmagents->get_current_list();
                        $workcapacite = Configure::read('workCapacity');
                        $this->set(compact('societe','cercles','section','hierarchique','profil','assistance','site','domaine','tjmagent','workcapacite'));
                        //pour charger les informations de fenetres modales chargement en json à l'ouverture donc ici passage d'un array vide
                        $matinformatique = array(); 
                        $matautre = array(); 
                        $activites = array(); 
                        $utilisateurs = array();
                        $outils = array();
                        $listediffusions = array();
                        $partages = array();
                        $etats = $ObjUtiliseoutils->get_list_utiliseoutil_etat();
                        $this->set(compact('matautre','matinformatique','activites','utilisateurs','outils','listediffusions','partages','etats'));
                        //pour charger les tableaux sur ce qui est associé à l'agent 
                        $historyutilisateurs = $ObjHistoryutilisateurs->get_all($id);
                        $utiliseoutils = $ObjUtiliseoutils->get_all($id);
                        $dotations = $ObjDotations->get_all($id);
                        $affectations = $ObjAffectations->get_all($id);
                        $compteurs = $ObjUtiliseoutils->get_compteur($id);
                        $nbDotation = $ObjDotations->get_compteur($id);
                        $nbAffectation = $ObjAffectations->get_compteur($id);
                        $tabconges = $this->calculConge($id);
                        $tabRQ = $this->calculRQ($id);
                        $tabVT = $this->calculVT($id);
                        $this->set(compact('affectations','dotations','utiliseoutils','historyutilisateurs','compteurs','tabconges','tabRQ','tabVT','nbDotation','nbAffectation'));
                        //pour ce qui est de l'utilisateur lui même
                        $options = array('conditions' => array('Utilisateur.id' => $id));
			$this->request->data = $this->Utilisateur->find('first', $options);
                        $this->set('utilisateur', $this->Utilisateur->find('first', $options));                         
                }
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                
	}
        
        public function save_history($id,$msg=null){
            $msg = $msg == null ? '<b style="color:red;">ACTION INDETERMINEE</b>' : $msg;
            $history['Historyutilisateur']['utilisateur_id'] = $id;
            $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - ".$msg.' par '.userAuth('NOMLONG');
            $this->Utilisateur->Historyutilisateur->create();
            $this->Utilisateur->Historyutilisateur->save($history);               
        }
        
        public function delete_dependance($id){
            $this->Utilisateur->id = $id;
            $user = $this->Utilisateur->read('ACTIF');
            if($user['Utilisateur']['ACTIF']==false):
                $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();                
                $ObjAssoentiteutilisateurs->delete_for_user($id);
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
                $utilisateur = $this->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$id),'recursive'=>-1));
                if(h($utilisateur['Utilisateur']['ACTIF'])==1):
                    if ($this->Utilisateur->saveField('ACTIF',0)) :
                            $this->Utilisateur->saveField('modified',date('Y-m-d'));
                            $this->save_history($id,'Désactivation du compte utilisateur');
                            $this->Session->setFlash(__('Utilisateur désactivé',true),'flash_success');
                            $this->History->goBack(1);
                    endif;
                    $this->Utilisateur->delete($id);
                    $this->Session->setFlash(__('Utilisateur <b>NON</b> désactivé',true),'flash_failure');
                    $this->History->goBack(1);                    
                 else:
                    $this->Utilisateur->delete($id);
                    $this->Session->setFlash(__('Utilisateur supprimé',true),'flash_success');
                    $this->History->goBack(1);
                 endif;
		$this->Session->setFlash(__('Utilisateur <b>NON</b> supprimé',true),'flash_failure');
		$this->History->goBack(1);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
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
            $this->set_title('Mon profil');
            if (!$this->Utilisateur->exists($id)) {
                    throw new NotFoundException(__('Utilisateur incorrect',true),'flash_failure');
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->Utilisateur->id = $id;
                if (!empty($this->request->data['Utilisateur']['password_confirm']))$this->request->data['Utilisateur']['password'] = $this->request->data['Utilisateur']['password_confirm'];
                if ($this->Utilisateur->save($this->request->data)) {
                        $this->save_history($id,'Modification de mon profil');                         
                        $this->Session->setFlash(__('Profil utilisateur sauvegardé',true),'flash_success');
                        $this->History->goBack(1);
                    } else {
                        $this->Session->setFlash(__('Profil utilisateur incorrect, veuillez corriger l\'utilisateur',true),'flash_failure');
                    }
            } else {
                        $this->Utilisateur->Societe->recursive = -1;
                        $societe = $this->Utilisateur->Societe->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                        $this->set('societe',$societe);
                        $this->Utilisateur->Section->recursive = -1;
                        $section = $this->Utilisateur->Section->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                        $this->set('section',$section);
                        $this->Utilisateur->Utilisateur->recursive = -1;
                        $this->Utilisateur->Profil->recursive = -1;
                        $profil = $this->Utilisateur->Profil->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                        $this->set('profil',$profil);
                        $this->Utilisateur->Assistance->recursive = -1;
                        $assistance = $this->Utilisateur->Assistance->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                        $this->set('assistance',$assistance);    
                        $this->Utilisateur->Site->recursive = -1;
                        $site = $this->Utilisateur->Site->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                        $this->set('site',$site);
                        $this->Utilisateur->Domaine->recursive = -1;
                        $domaine = $this->Utilisateur->Domaine->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                        $this->set('domaine',$domaine);
                        $this->Utilisateur->Tjmagent->recursive = -1;
                        $tjmagent = $this->Utilisateur->Tjmagent->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                        $this->set('tjmagent',$tjmagent); 
                        $this->Utilisateur->Outil->recursive = -1;
                        $outil = $this->Utilisateur->Outil->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                        $this->set('outil',$outil);  
                        $this->Utilisateur->Listediffusion->recursive = -1;
                        $listediffusion = $this->Utilisateur->Listediffusion->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                        $this->set('listediffusion',$listediffusion);
                        $this->Utilisateur->Dossierpartage->recursive = -1;
                        $dossierpartage = $this->Utilisateur->Dossierpartage->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                        $this->set('dossierpartage',$dossierpartage);
                        $this->Utilisateur->Activite->recursive = -1;
                        $activite = $this->Utilisateur->Activite->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc')));
                        $this->set('activite',$activite); 
                        $workcapacite = Configure::read('workCapacity');
                        $this->set('workcapacite',$workcapacite);
                        $this->Utilisateur->Affectation->recursive = 0;
                        $affectations = $this->Utilisateur->Affectation->find('all',array('fields'=>array('id','activite_id','Activite.NOM','Affectation.REPARTITION','Activite.DESCRIPTION'),'conditions'=>array('Affectation.utilisateur_id'=>$id)));
                        $this->set('affectations',$affectations);
                        $this->Utilisateur->Dotation->recursive = 0;
                        $dotations = $this->Utilisateur->Dotation->find('all',array('conditions'=>array('Dotation.utilisateur_id'=>$id)));
                        $this->set('dotations',$dotations);
                        $utiliseoutils = $this->Utilisateur->Utiliseoutil->find('all',array('fields'=>array('id','outil_id','Outil.NOM','listediffusion_id','Listediffusion.NOM','dossierpartage_id','Dossierpartage.NOM','Utiliseoutil.STATUT'),'conditions'=>array('Utiliseoutil.utilisateur_id'=>$id),'recursive'=>0));
                        $this->set('utiliseoutils',$utiliseoutils);
                        $this->Utilisateur->recursive = 1;
                        $options = array('conditions' => array('Utilisateur.' . $this->Utilisateur->primaryKey => $id));
			$this->request->data = $this->Utilisateur->find('first', $options);
                        $this->set('utilisateur', $this->Utilisateur->find('first', $options));
                        $hierarchique = $this->Utilisateur->find('first',array('fields' => array('id', 'NOMLONG'),'order'=>array('NOMLONG'=>'asc'),'conditions'=>array('Utilisateur.HIERARCHIQUE'=>1,'Utilisateur.id'=>$this->request->data['Utilisateur']['utilisateur_id'])));
                        $this->set('hierarchique',$hierarchique);                        
                        $this->Utilisateur->Historyutilisateur->recursive = -1;
                        $options = array('conditions' => array('Historyutilisateur.utilisateur_id' => $id),'order'=>array('Historyutilisateur.created'=> 'desc','Historyutilisateur.HISTORIQUE'=>'desc'));
                        $historyutilisateurs = $this->Utilisateur->Historyutilisateur->find('all',$options);
                        $this->set('historyutilisateurs',$historyutilisateurs);
                        $compteurs = $this->Utilisateur->Utiliseoutil->query("SELECT count(outil_id) AS nboutil, count(listediffusion_id) AS nbliste, count(dossierpartage_id) AS nbpartage FROM utiliseoutils WHERE utilisateur_id =".$id);
                        $this->set('compteurs',$compteurs);
                        $nbDotation = $this->Utilisateur->Dotation->query("SELECT count(id) AS nbDotation FROM dotations WHERE utilisateur_id =".$id);
                        $this->set('nbDotation',$nbDotation);   
                        $nbAffectation = $this->Utilisateur->Affectation->query("SELECT count(id) AS nbAffectation FROM affectations WHERE utilisateur_id =".$id);
                        $this->set('nbAffectation',$nbAffectation); 
                        $tabconges = $this->calculConge($id);
                        $this->set('tabconges',$tabconges);
                        $tabRQ = $this->calculRQ($id);
                        $this->set('tabRQ',$tabRQ);
                        $tabVT = $this->calculVT($id);
                        $this->set('tabVT',$tabVT); 
                        $agents = $this->Utilisateur->Equipe->find('all',array('conditions'=>array('Equipe.utilisateur_id'=>$id),'recursive'=>-1));
                        $this->set('agents',$agents);
                        $this->set('nbagents',count($agents));
                        $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
                        $listusers = $ObjAssoentiteutilisateurs->json_get_all_users(userAuth('id'));                        
                        $utilisateurs = $this->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.profil_id >'=>0,'Utilisateur.profil_id'=>-2),'Utilisateur.id IN ('.$listusers.')'),'order'=>array('NOMLONG'=>'asc'),'recursive'=>-1));
                        $this->set('utilisateurs',$utilisateurs);                        
                    }             
        }
   
    /**
     * Méthode pour tester la connexion a LDAP
     * 
     * @param string $username
     * @param string $password
     * @return boolean
     */    
    public function ldap_login($username,$password){
        $this->autoRender = false;
        $result = false;
        $ldap = Configure::read('ldap');

        $ldapServer = $ldap['host'].":".$ldap['port'];
        $dn = $ldap['prefix'].$username.$ldap['domaine'];

        $conn=ldap_connect($ldapServer);

        if ($conn==true) :
            if (ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, $ldap['version'])):
                ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);
                if (@ldap_bind($conn,$dn,$password)) :
                    $result = true;
                    ldap_unbind($conn);
                else:
                    $this->Session->setFlash(__('Erreur d\'identification sur le serveur LDAP : Login ou mot de passe incorrect',true),'flash_failure');
                endif;
            else:
                $this->Session->setFlash(__('Impossible de se connecter au serveur LDAP avec le protocole V3',true),'flash_failure');
            endif;
        else:
            $this->Session->setFlash(__('Impossible de se connecter au serveur LDAP',true),'flash_failure');
        endif;
        ldap_close($conn);
        return $result;
    }
    
    /**
     * Login method
     * 
     * @param none
     * @return void
     */        
        public function login() {
          if(userAuth('id')!=''):
                $this->redirect(array('controller'=>'pages', 'action'=>'home'));
          else:
            $this->Session->delete('history');
            $this->set_title("Connexion");
            if ($this->request->is('post')) {
                if($this->Auth->request->data['Utilisateur']['username']=="0000000A"):
                    $password=Security::hash($this->Auth->request->data['Utilisateur']['password'],'md5',false);
                    $username = $this->Auth->request->data['Utilisateur']['username'];
                    if (count($this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$username))))>0){
                        if (count($this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$username,'Utilisateur.password'=>$password))))>0) {
                            $utilisateur = $this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$username,'Utilisateur.password'=>$password)));
                            $autorisations = $this->Utilisateur->Profil->Autorisation->find('all',array('conditions'=>array('Autorisation.profil_id'=>$utilisateur['Utilisateur']['profil_id'])));
                            $this->Session->renew();
                            $this->Session->write(AUTHORIZED,$autorisations);
                            $this->Session->write('userMenu', $utilisateur['Utilisateur']['MENU']);
                            /** cookie pour remember me **/
                            if ($this->Auth->request->data['Utilisateur']['remember_me'] == 1) {
                                // remove "remember me checkbox"
                                unset($this->Auth->request->data['Utilisateur']['remember_me']);
                                // hash the user's password
                                $cookie = array();
                                $cookie['username'] = $this->Auth->request->data['Utilisateur']['username'];
                                $cookie['password'] = $this->Auth->request->data['Utilisateur']['username']=="0000000A" ? $this->Auth->request->data['Utilisateur']['password'] : "ldap";
                                // write the cookie
                                $this->Cookie->write('remember_me_cookie', $cookie, true, '2 weeks');
                            }
                            $this->Auth->login($utilisateur['Utilisateur']);
                                $auth_redirect = $this->Session->read("Auth.redirect");
                                if(isset($auth_redirect) && $auth_redirect != "") {
                                    $this->redirect($auth_redirect);
                                } else { 
                                    $this->redirect(array('controller'=>'pages','action'=>'home'));
                                }        
                        } else {
                            $this->Session->setFlash(__('Mot de passe invalide, réessayer',true),'flash_failure');
                        }                    
                    } else {
                        $this->Session->setFlash(__('Login inexistant ou compte invalide, contacter l\'administrateur',true),'flash_failure');
                    }                    
                else:
                    if($this->ldap_login($this->Auth->request->data['Utilisateur']['username'], $this->Auth->request->data['Utilisateur']['password'])):
                        $username = $this->Auth->request->data['Utilisateur']['username'];
                        if (count($this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$username))))>0){
                            //if (count($this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$username,'Utilisateur.password'=>$password))))>0) {
                                $utilisateur = $this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$username))); //,'Utilisateur.password'=>$password)));
                                $autorisations = $this->Utilisateur->Profil->Autorisation->find('all',array('conditions'=>array('Autorisation.profil_id'=>$utilisateur['Utilisateur']['profil_id'])));
                                $this->Session->renew();
                                $this->Session->write(AUTHORIZED,$autorisations);
                                $this->Session->write('userMenu', $utilisateur['Utilisateur']['MENU']);
                                /** cookie pour remember me **/
                                if ($this->Auth->request->data['Utilisateur']['remember_me'] == 1) {
                                    unset($this->Auth->request->data['Utilisateur']['remember_me']);
                                    $cookie = array();
                                    $cookie['username'] = $this->Auth->request->data['Utilisateur']['username'];
                                    $cookie['password'] = $this->Auth->request->data['Utilisateur']['username']=="0000000A" ? $this->Auth->request->data['Utilisateur']['password'] : "ldap";
                                    $this->Cookie->write('remember_me_cookie', $cookie, true, '2 weeks');
                                }
                                $this->Auth->login($utilisateur['Utilisateur']);
                                $auth_redirect = $this->Session->read("Auth.redirect");
                                if(isset($auth_redirect) && $auth_redirect != "") {
                                    $this->redirect($auth_redirect);
                                } else { 
                                    $this->redirect(array('controller'=>'pages','action'=>'home'));
                                }                     
                        } else {
                            $this->Session->setFlash(__('Login inexistant ou compte invalide, contacter l\'administrateur',true),'flash_failure');
                            $this->redirect(array('controller'=>'pages','action'=>'home'));
                        }
                    else:
                        $this->redirect(array('controller'=>'pages','action'=>'home'));
                    endif;
                endif;
            }
            /** si login pas posté **/
            /** on lit le cookie et si c'est bon on se connecte **/
            if (empty($this->data)) {
                $cookie = $this->Cookie->read('remember_me_cookie');
                if (!is_null($cookie)) {
                    $utilisateur = array();
                    $utilisateur['username'] = $cookie['username'];
                    $utilisateur['password'] = $utilisateur['username'] == "0000000A" ? Security::hash($cookie['password'],'md5',false) : "ldap";
                    if($utilisateur['password']=='ldap'):
                        if (count($this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$utilisateur['username']))))>0){
                            $utilisateur = $this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$utilisateur['username'],'Utilisateur.password'=>$utilisateur['password'])));
                            $autorisations = $this->Utilisateur->Profil->Autorisation->find('all',array('conditions'=>array('Autorisation.profil_id'=>$utilisateur['Utilisateur']['profil_id'])));
                            $this->Session->renew();
                            $this->Session->write(AUTHORIZED,$autorisations);
                            if ($this->Auth->login($utilisateur['Utilisateur'])) {
                                //  Clear auth message, just in case we use it.  
                                $auth_redirect = $this->Session->read("Auth.redirect");
                                if(isset($auth_redirect) && $auth_redirect != "") {
                                    $this->redirect($auth_redirect);
                                } else { 
                                    $this->redirect(array('controller'=>'pages','action'=>'home'));
                                }                                                               
                            } else { // Delete invalid Cookie
                                $this->Cookie->delete('remember_me_cookie');
                            }                  
                        } else {
                        $this->Session->renew();
                        $this->Cookie->delete('remember_me_cookie');
                        $this->Session->setFlash(__('Cookie : Login inexistant ou compte invalide, contacter l\'administrateur',true),'flash_failure');
                        }
                    else:
                        if (count($this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$utilisateur['username']))))>0){
                            if (count($this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$utilisateur['username'],'Utilisateur.password'=>$utilisateur['password']))))>0) {
                                $utilisateur = $this->Utilisateur->find('first', array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.username'=>$utilisateur['username'],'Utilisateur.password'=>$utilisateur['password'])));
                                $autorisations = $this->Utilisateur->Profil->Autorisation->find('all',array('conditions'=>array('Autorisation.profil_id'=>$utilisateur['Utilisateur']['profil_id'])));
                                $this->Session->renew();
                                $this->Session->write(AUTHORIZED,$autorisations);
                                if ($this->Auth->login($utilisateur['Utilisateur'])) {
                                    //  Clear auth message, just in case we use it.                  
                                $auth_redirect = $this->Session->read("Auth.redirect");
                                if(isset($auth_redirect) && $auth_redirect != "") {
                                    $this->redirect($auth_redirect);
                                } else { 
                                    $this->redirect(array('controller'=>'pages','action'=>'home'));
                                }        
                                } else { // Delete invalid Cookie
                                    $this->Cookie->delete('remember_me_cookie');
                                }
                            } else {
                            $this->Session->renew();
                            $this->Cookie->delete('remember_me_cookie');
                            $this->Session->setFlash(__('Cookie : Mot de passe invalide, réessayer',true),'flash_failure');
                            }                    
                        } else {
                        $this->Session->renew();
                        $this->Cookie->delete('remember_me_cookie');
                        $this->Session->setFlash(__('Cookie : Login inexistant ou compte invalide, contacter l\'administrateur',true),'flash_failure');
                        } 
                    endif;
                }
            }
            endif;
        }
      
/**
 * logout method
 *
 * @param none
 * @return void
 */
	public function logout() {
            $this->autoRender = false;
            $this->Session->delete('history');
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
                $record['Utilisateur']['NAISSANCE']='00/00/0000';
                unset($record['Utilisateur']['NOM']);
                $record['Utilisateur']['NOM']='Inconnu';
                unset($record['Utilisateur']['PRENOM']);
                $record['Utilisateur']['PRENOM']='Inconnu';
                unset($record['Utilisateur']['MAIL']);  
                unset($record['Utilisateur']['TELEPHONE']);
                unset($record['Utilisateur']['CONGE']);
                unset($record['Utilisateur']['RQ']);
                unset($record['Utilisateur']['tjmagent_id']);
                unset($record['Utilisateur']['ACTIF']);
                unset($record['Utilisateur']['VT']);                
                unset($record['Utilisateur']['WORKCAPACITY']);
                unset($record['Utilisateur']['HIERARCHIQUE']);
                unset($record['Utilisateur']['GESTIONABSENCES']);
                unset($record['Utilisateur']['WIDEAREA']);
                unset($record['Utilisateur']['COMMENTAIRE']);
                unset($record['Utilisateur']['NOMLONG']);
                $record['Utilisateur']['COMMENTAIRE']='';
                unset($record['Utilisateur']['created']);                
                unset($record['Utilisateur']['modified']);
                $record['Utilisateur']['societe_id']= isset($record['Utilisateur']['societe_id']) ? $record['Utilisateur']['societe_id'] : '';
                if(isset($record['Utilisateur']['profil_id'])){
                    $record['Utilisateur']['profil_id']=$record['Utilisateur']['profil_id'];  
                } else {
                    unset($record['Utilisateur']['profil_id']);
                }
                if (isset($record['Utilisateur']['assistance_id'])){
                    $record['Utilisateur']['assistance_id']=$record['Utilisateur']['assistance_id'];
                } else {
                    unset($record['Utilisateur']['assistance_id']);
                }
                if (isset($record['Utilisateur']['section_id'])) {
                    $record['Utilisateur']['section_id']=$record['Utilisateur']['section_id'];
                } else {
                    unset($record['Utilisateur']['section_id']);
                }
                if (isset($record['Utilisateur']['site_id'])) {
                    $record['Utilisateur']['site_id']=$record['Utilisateur']['site_id'];
                } else {
                    unset($record['Utilisateur']['site_id']);
                }
                if (isset($record['Utilisateur']['domaine_id'])) {
                    $record['Utilisateur']['domaine_id']=$record['Utilisateur']['domaine_id'];
                } else {
                    unset($record['Utilisateur']['domaine_id']);
                }                
                if (isset($record['Utilisateur']['FINMISSION'])){
                    $record['Utilisateur']['FINMISSION']=$record['Utilisateur']['FINMISSION'];
                } else {
                    unset($record['Utilisateur']['FINMISSION']);
                }
                $this->Utilisateur->create();
                if ($this->Utilisateur->save($record)) {
                        $lastid = $this->Utilisateur->id;
                        $this->addnewaction($lastid);
                        $this->save_history($lastid,'Création du compte à partir d\'une duplication');
                        $ObjUtiliseoutils = new UtiliseoutilsController();
                        $ObjUtiliseoutils->duplicate_from_user($id,$lastid);
                        $this->Session->setFlash(__('Utilisateur dupliqué',true),'flash_success');
                        $this->redirect(array('action'=>'edit',$lastid));
                } 
		$this->Session->setFlash(__('Utilisateur <b>NON</b> dupliqué',true),'flash_failure');
		$this->History->goBack(1);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
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
                $record['Utilisateur']['password']='SAILL'; 
                $record['Utilisateur']['created'] = $this->Utilisateur->read('created');
                $record['Utilisateur']['modified'] = date('Y-m-d');                
                if ($this->Utilisateur->save($record)) {
                        $this->save_history($id,'Initialisation du mot de passe de '.$record['Utilisateur']['NOMLONG']);
                        $this->Session->setFlash(__('Mot de passe de l\'utilisateur initialisé',true),'flash_success');
                        $this->History->goBack(1);
                } 
		$this->Session->setFlash(__('Mot de passe de l\'utilisateur <b>NON</b> initialisé',true),'flash_failure');
		$this->History->goBack(1);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                
	} 

/**
 * initmypassword method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function initmypassword() {
            if ($this->request->is('post')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Utilisateur->validate = array();
                        $this->redirect(array('controller' => 'pages', 'action' => 'display'));
                    else:                 
                        $username = $this->data['Utilisateur']['usernamelost'];
                        $utilisateur = $this->Utilisateur->find('first',array('conditions'=>array('Utilisateur.username'=>$username),'recursive'=>0));
                        $this->Utilisateur->id = $utilisateur['Utilisateur']['id'];
                        $password = generateRandomPassword();            
                        if ($this->Utilisateur->saveField("password",$password)) {
                                $sendmail = $this->sendmailpassword($utilisateur,$password);
                                $this->save_history($utilisateur['Utilisateur']['id'],'Initialisation du mot de passe de '.$username.' avec un mot de passe autogénéré.');
                                $this->Session->setFlash(__('Mot de passe envoyé à votre adresse mail, si vous ne recevez pas l\'email contacter l\'administrateur',true),'flash_success');
                                $this->History->goBack(1);
                        } 
                        $this->Session->setFlash(__('Mot de passe <b>NON</b> initialisé',true),'flash_failure');
                        $this->History->goBack(1); 
                    endif;
            }
	} 
        
	public function initadminpassword() {
            if (isAuthorized('utilisateurs', 'initpassword')) :
		$this->Utilisateur->id = 1;
                $record = $this->Utilisateur->read();
                unset($record['Utilisateur']['password']); 
                unset($record['Utilisateur']['created']);
                unset($record['Utilisateur']['modified']);
                $record['Utilisateur']['password']='@DMIN'; 
                $record['Utilisateur']['created'] = $this->Utilisateur->read('created');
                $record['Utilisateur']['modified'] = date('Y-m-d');                
                if ($this->Utilisateur->save($record)) {
                        $this->save_history(1,'<b style="color:red;">Initialisation du mot de passe administrateur</b>');
                        $this->Session->setFlash(__('Mot de passe de l\'administrateur initialisé',true),'flash_success');
                        $this->History->goBack(1);
                } 
		$this->Session->setFlash(__('Mot de passe de l\'administrateur <b>NON</b> initialisé',true),'flash_failure');
		$this->History->goBack(1);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                
	}         
        
/**
 * search method
 *
 * @return void
 */
	public function search($filtreUtilisateur=null,$filtreSection=null,$filtresociete=null,$filtreAlpha=null,$keywords=null) {
            if (isAuthorized('utilisateurs', 'index')) :
                if(isset($this->params->data['Utilisateur']['SEARCH'])):
                    $keywords = $this->params->data['Utilisateur']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords)); 
                    $listusers = $this->get_visibility();
                    $getusers = $this->get_utilisateur_etat_filter($filtreUtilisateur, $listusers);
                    $getsection = $this->get_section_filter($filtreSection);
                    $getsociete = $this->get_societe_filter($filtresociete);
                    $getalpha = $this->get_alpha_filter($filtreAlpha);
                    $newconditions=array($getusers['condition'],$getsection['condition'],$getsociete['condition'],$getalpha['condition']);
                    $this->set('fsociete',$getsociete['filter']);
                    $this->set('fsection',$getsection['filter']);
                    $this->set('futilisateur',$getusers['filter']);
                    $this->set('falpha',$getalpha['filter']);
                    if (userAuth('WIDEAREA')==0) {
                        $newconditions[]="Utilisateur.section_id=".userAuth('section_id');
                    }
                    $ObjSections = new SectionsController();                    
                    $sections = $ObjSections->get_all($listusers);
                    $this->set('sections',$sections);  
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Utilisateur.username LIKE '%".$value."%'","Utilisateur.NOM LIKE '%".$value."%'","Utilisateur.PRENOM LIKE '%".$value."%'","Utilisateur.COMMENTAIRE LIKE '%".$value."%'","Utilisateur.TELEPHONE LIKE '%".$value."%'","Utilisateur.WORKCAPACITY LIKE '%".$value."%'","Profil.NOM LIKE '%".$value."%'","Societe.NOM LIKE '%".$value."%'","Assistance.NOM LIKE '%".$value."%'","Section.NOM LIKE '%".$value."%'","Tjmagent.NOM LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newconditions,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));
                    $this->set('utilisateurs', $this->paginate());
                    $this->get_export($conditions);                               
                else:
                    $this->redirect(array('action'=>'index',$filtreUtilisateur,$filtreSection,$filtresociete,$filtreAlpha));
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                
        }    
        
/**
 * export_xls
 * 
 */       
	function export_xls() {
                $engagementconfs = Configure::read('engagementConf');
                $this->set('engagementconfs',$engagementconfs);
		$data = $this->Session->read('xls_export');
                //$this->Session->delete('xls_export');                
		$this->set('rows',$data);
		$this->render('export_xls','export_xls');
	}   
        
/**
 * calculConge
 * 
 * @param type $id
 * @return array
 */        
        public function calculConge($id){
            $indispos = array();
            // array du genre 'type','mois','nb'
            $sql ="select DATE_FORMAT(DATE,'%m') as MOIS,activite_id,SUM(TOTAL) as TOTAL
                   from activitesreelles 
                   where activitesreelles.utilisateur_id = ".$id."
                   and activitesreelles.activite_id = 1
                   and DATE_FORMAT(DATE,'%Y') = DATE_FORMAT(NOW(),'%Y')
                   group by MOIS,activite_id";
            $results = $this->Utilisateur->query($sql);
            foreach($results as $result):
                $indispos[$result[0]['MOIS']]=$result[0]['TOTAL'];
            endforeach;
            for($i=1;$i<13;$i++){
                $mois = $i < 10 ? '0'.$i : (String)$i;
                if (!array_key_exists($mois, $indispos)) {
                    $indispos[$mois]='0';
                }
            }
            return $indispos;
        }
        
/**
 * calculRQ
 * 
 * @param type $id
 * @return array
 */        
        public function calculRQ($id){
            $indispos = array();
            // array du genre 'type','mois','nb'
            $sql ="select DATE_FORMAT(DATE,'%m') as MOIS,activite_id,SUM(TOTAL) as TOTAL
                   from activitesreelles 
                   where activitesreelles.utilisateur_id = ".$id."
                   and activitesreelles.activite_id = 2
                   and DATE_FORMAT(DATE,'%Y') = DATE_FORMAT(NOW(),'%Y')                   
                   group by MOIS,activite_id";
            $results = $this->Utilisateur->query($sql);
            foreach($results as $result):
                $indispos[$result[0]['MOIS']]=$result[0]['TOTAL'];
            endforeach;
            for($i=1;$i<13;$i++){
                $mois = $i < 10 ? '0'.$i : (String)$i;
                if (!array_key_exists($mois, $indispos)) {
                    $indispos[$mois]='0';
                }
            }
            return $indispos;
        }
        
/**
 * calculVT
 * 
 * @param type $id
 * @return array
 */        
        public function calculVT($id){
            $indispos = array();
            // array du genre 'type','mois','nb'
            $sql ="select DATE_FORMAT(DATE,'%m') as MOIS,activite_id,SUM(TOTAL) as TOTAL
                   from activitesreelles 
                   where activitesreelles.utilisateur_id = ".$id."
                   and activitesreelles.activite_id = 3
                   and DATE_FORMAT(DATE,'%Y') = DATE_FORMAT(NOW(),'%Y')                   
                   group by MOIS,activite_id";
            $results = $this->Utilisateur->query($sql);
            foreach($results as $result):
                $indispos[$result[0]['MOIS']]=$result[0]['TOTAL'];
            endforeach;
            for($i=1;$i<13;$i++){
                $mois = $i < 10 ? '0'.$i : (String)$i;
                if (!array_key_exists($mois, $indispos)) {
                    $indispos[$mois]='0';
                }
            }
            return $indispos;
        }    
        
        public function prolonger(){
            $this->autoRender = false;
            $ids = explode('-', $this->request->data['Utilisateur']['ids']);
            if(count($ids)>0 && $ids[0]!="" && $this->request->data['Utilisateur']['FINMISSION'] != ''):
                foreach($ids as $id):
                    $this->Utilisateur->create();
                    $this->Utilisateur->id = $id;
                    $date = $this->request->data['Utilisateur']['FINMISSION'];
                    $this->Utilisateur->saveField('FINMISSION', $date);
                    $utilisateur = $this->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$id),'recursive'=>0));
                    $this->sendmailprolongation($utilisateur);
                    $this->save_history($id,'Prolongation du compte au '.$date);
                endforeach;
                sleep(3);
                echo $this->Session->setFlash(__('Comptes prolongés',true),'flash_success');
            else:
                echo $this->Session->setFlash(__('Aucun utilisateur sélectionné ou date de fin de mission non renseignée',true),'flash_failure');
            endif;
            return $this->request->data('all_ids');
        }
        
        public function desactiver(){
            $this->autoRender = false;
            $ids = explode('-', $this->request->data('all_ids'));
            if(count($ids)>0 && $ids[0]!=""):
                foreach($ids as $id):
                    $this->Utilisateur->id = $id;
                    $old_etat = $this->Utilisateur->find('first',array('fields'=>array('Utilisateur.ACTIF'),'conditions'=>array('Utilisateur.id'=>$id),'recursive'=>-1));
                    $etat = $old_etat['Utilisateur']['ACTIF'] == 0 ? 1 : 0;
                    $this->Utilisateur->saveField('ACTIF', $etat);
                    $history['Historyutilisateur']['utilisateur_id']=$id;
                    $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - état changé par ".userAuth('NOMLONG');
                    $this->Utilisateur->Historyutilisateur->save($history);
                endforeach;
                sleep(3);
                echo $this->Session->setFlash(__('Comptes désactivés',true),'flash_success');
            else:
                echo $this->Session->setFlash(__('Aucun utilisateur sélectionné',true),'flash_failure');
            endif;
            return $this->request->data('all_ids');
        }      
        
        public function addnewaction($id){
            $date = new DateTime();
            $record['Action']['utilisateur_id']=  userAuth('id');
            $record['Action']['destinataire']=  userAuth('id');
            $record['Action']['domaine_id']=  4;
            $record['Action']['activite_id']=  21;
            $record['Action']['OBJET']=  'Création d\'un nouvel utilisateur';
            $record['Action']['AVANCEMENT']=  0;
            $record['Action']['COMMENTAIRE']=  '<a href="'.FULL_BASE_URL.$this->params->base.'/utilisateurs/edit/'.$id.'">Lien vers le nouvel utilisateur</a>';
            $record['Action']['DEBUT']=  $date->format('d/m/Y');            
            $record['Action']['ECHEANCE']=  $date->add(new DateInterval('P5D'))->format('d/m/Y');
            $record['Action']['STATUT']=  'à faire';
            $record['Action']['DUREEPREVUE']=  2;
            $record['Action']['PRIORITE']=  'haute';
            $this->Utilisateur->Action->create();
            $this->Utilisateur->Action->save($record);
        }
        
        public function saveAdmPassword(){
              $this->Utilisateur->id = 1;
              if ($this->Utilisateur->saveField('password', $this->data['Utilisateur']['password_new'])):
                  $this->Session->setFlash(__('Mot de passe administrateur mis à jour',true),'flash_success');
              else:
                  $this->Session->setFlash(__('Mot de passe administrateur <b>NON</b> mis à jour',true),'flash_failure'); 
              endif;
              $this->History->goBack(1);
        }
        
        public function sendmailnewutilisateur($utilisateur){
            $ObjParameters = new ParametersController();
            $mailtoGestannuaire = $ObjParameters->get_gestionnaireannuaire();
            $mailto[] = $mailtoGestannuaire['Parameter']['param'];
            $i = date('m') > 10 ? 2 : 1;
            $finmission = $utilisateur['Utilisateur']['FINMISSION'] = '' ? "05/01".(date('Y')+$i) : $utilisateur['Utilisateur']['FINMISSION'];
            $to=$mailto;
            $from = Configure::read('mailapp');
            $objet = "SAILL : Ajout d'un nouvel utilisateur [".$utilisateur['Utilisateur']['NOM'].' '.$utilisateur['Utilisateur']['PRENOM'].']';
            $message = "Merci de traiter cette demande concernant l'arrivée de ".$utilisateur['Utilisateur']['NOM'].' '.$utilisateur['Utilisateur']['PRENOM'].
                    '<ul>
                    <li>Date de naissance :'.$utilisateur['Utilisateur']['NAISSANCE'].'</li>
                    <li>Société :'.$utilisateur['Societe']['NOM'].'</li>
                    <li>Fin de mission :'.$finmission.'</li>
                    <li>Commentaire :'.$utilisateur['Utilisateur']['COMMENTAIRE'].'</li>                      
                    </ul>';
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
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_warning');
                }  
            endif;
        }       
        
        public function sendmailgestannuaire($id){
            $utilisateur = $this->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$id),'recursive'=>0));
            $ObjSections = new SectionsController(); 
            $mailtoGestannuaire = $ObjSections->get_gestionnaire_annuaire($utilisateur['Utilisateur']['section_id']);
            $mailto = explode(';',$mailtoGestannuaire);
            $i = date('m') > 10 ? 2 : 1;
            $finmission = $utilisateur['Utilisateur']['FINMISSION'] = '' ? "05/01".(date('Y')+$i) : $utilisateur['Utilisateur']['FINMISSION'];
            $to=$mailto;
            $from = Configure::read('mailapp');
            $objet = "SAILL : Ajout d'un nouvel utilisateur [".$utilisateur['Utilisateur']['NOM'].' '.$utilisateur['Utilisateur']['PRENOM'].']';
            $message = "Merci de traiter cette demande concernant l'arrivée de ".$utilisateur['Utilisateur']['NOM'].' '.$utilisateur['Utilisateur']['PRENOM'].
                    '<ul>
                    <li>Date de naissance :'.$utilisateur['Utilisateur']['NAISSANCE'].'</li>
                    <li>Société :'.$utilisateur['Societe']['NOM'].'</li>
                    <li>Fin de mission :'.$finmission.'</li>
                    <li>Commentaire :'.$utilisateur['Utilisateur']['COMMENTAIRE'].'</li>                      
                    </ul>';
            if($to!=''):
                try{
                $email = new CakeEmail();
                $email->config('smtp')
                        ->emailFormat('html')
                        ->from($from)
                        ->to($to)
                        ->subject($objet)
                        ->send($message);
                $this->Session->setFlash(__('Mail envoyé avec succès',true),'flash_success');
                }
                catch(Exception $e){
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_warning');
                }  
            endif;
            $this->History->goBack(1);
        }

        public function sendmailpassword($utilisateur,$password){
            $from =  Configure::read('mailapp');
            $to=$utilisateur['Utilisateur']['MAIL'];
            $objet = "SAILL : Demande de nouveaux identifiants pour [".$utilisateur['Utilisateur']['NOM']." ".$utilisateur['Utilisateur']['PRENOM']."]";
            $message = "Bonjour<br>comme demandé voici le nouvel identifiant pour ".$utilisateur['Utilisateur']['NOM']." ".$utilisateur['Utilisateur']['PRENOM'].
                    "<ul>
                    <li>Nouveau mot de passe à utiliser est : <b>".$password."</b></li>    
                    <li>Votre login est inchangé</li>
                    <li>Nous vous recommandons de changer ce mot de passe à votre prochaine connexion.</li>
                    </ul>";
            if($to!=''):
                try{
                $email = new CakeEmail();
                $email->config('smtp')
                        ->emailFormat('both')
                        ->from($from)
                        ->to($to)
                        ->subject($objet)
                        ->send($message);
                $this->Session->setFlash(__('Mail avec le mot de passe envoyé avec succès',true),'flash_success');
                }
                catch(Exception $e){
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_warning');
                }  
            endif;
        }
        
        public function sendmailprolongation($utilisateur){
            $ObjParameters = new ParametersController();
            $mailtoGestannuaire = $ObjParameters->get_gestionnaireannuaire();
            $mailto[] = $mailtoGestannuaire['Parameter']['param'];
            $to=$mailto;
            $from = Configure::read('mailapp');
            $objet = "SAILL : Prolongation d'un utilisateur [".$utilisateur['Utilisateur']['NOM'].' '.$utilisateur['Utilisateur']['PRENOM'].']';
            $message = "Merci de traiter cette demande concernant la prolongation de ".$utilisateur['Utilisateur']['NOM'].' '.$utilisateur['Utilisateur']['PRENOM'].
                    '<ul>
                    <li>Date de naissance :'.$utilisateur['Utilisateur']['NAISSANCE'].'</li>
                    <li>Société :'.$utilisateur['Societe']['NOM'].'</li>
                    <li>Fin de mission :'.$utilisateur['Utilisateur']['FINMISSION'].'</li>
                    <li>Commentaire :'.$utilisateur['Utilisateur']['COMMENTAIRE'].'</li>                      
                    </ul>';
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
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_warning');
                }  
            endif;
        }  
        
        public function infoutilisateur($id){
            $this->autoRender = false;
            $id = isset($id) ? $id : $this->request->data('id');
            $utilisateur = $this->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$id),'recursive'=>0));
            $user["ETP"] = $utilisateur['Utilisateur']['WORKCAPACITY']/100;
            $user["TJM"] = $utilisateur['Tjmagent']['TARIFTTC']==null ? '' : $utilisateur['Tjmagent']['TARIFTTC'];
            $result = json_encode($user);
            return $result;
        }
        
        public function getutilisateurbyid($id){
            $utilisateur = $this->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$id),'recursive'=>0));
            return $utilisateur;
        }
            
        public function changeetat(){
            $id = $this->request->data('id');
            $etat = $this->request->data('etat');
            $this->Utilisateur->id = $id;
            $this->Utilisateur->saveField("ACTIF",$etat);
            if($etat==0):
                $this->delete_dependance($id);
                //$this->Utilisateur->saveField("GESTIONABSENCES",0);
                $this->Utilisateur->saveField("NEW",0);
                $this->Utilisateur->saveField("FINMISSION",date('Y-m-d'));
                $this->Utilisateur->saveField("ENGCONF",null);
                $this->Utilisateur->saveField("DATEENGCONF",null);
            else :
                $i = date('m') > 10 ? 2 : 1;
                $annee = date('Y')+$i;
                $this->Utilisateur->saveField("FINMISSION",$annee.'-1-5');
            endif;
            $history['Historyutilisateur']['utilisateur_id']=$id;
            $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - état changé par ".userAuth('NOMLONG');
            $this->Utilisateur->Historyutilisateur->save($history);
            exit();
        }     
        
        public function insociete(){
            $societes = $this->params->params['pass'];
            foreach ($societes as &$value) {
                @$societelist .= $value.',';
            }  
            $societe = substr_replace(@$societelist ,"",-1);  
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            $result = $ObjAssoentiteutilisateurs->get_all_utilisateur_for_societe($societe);
            return $result;
        }
        
        public function getmenuvisible(){
            $utilisateur=$this->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>  userAuth('id')),'recursive'=>-1));
            return $utilisateur['Utilisateur']['MENU']==1 ? true : false;
        }
        
        public function setmenuvisible(){
            $this->Utilisateur->id = userAuth('id');  
            $utilisateur=$this->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>  userAuth('id')),'recursive'=>-1));
            $value = $utilisateur['Utilisateur']['MENU']==1 ? 0 : 1;
            $this->Utilisateur->saveField('MENU', $value);
            $this->Session->write('userMenu', $value);
            exit();
        }
        
	public function progressengconf($id = null,$loop=false) {
                $newetat = '';
                $newmsg = '';
                $id = $id==null ? $this->request->data('id') : $id;
                $valideur = null;
                $this->Utilisateur->id = $id;
                $record = $this->Utilisateur->read();
                $engagementconfs = Configure::read('engagementConf');                 
                switch ($record['Utilisateur']['ENGCONF']) {
                    case NULL:
                    case '0':
                       $newetat = 1;
                        $newmsg = "remis à ".$engagementconfs[$newetat];
                       break;
                    case '1':
                       $newetat = 2;  
                        $newmsg = "remis à ".$engagementconfs[$newetat];
                       break;                
                    case '2':
                       $newetat = 3;
                        $newmsg = "remis à ".$engagementconfs[$newetat];
                       break;          
                    case '3':
                       $newetat = 0;
                        $newmsg = "non remis ";
                       break;
                }
                $record['Utilisateur']['ENGCONF'] = $newetat;
                $record['Utilisateur']['DATEENGCONF'] = date('Y-m-d');
                $record['Utilisateur']['created'] = $this->Utilisateur->read('created');
                $record['Utilisateur']['modified'] = date('Y-m-d');
		if (!$this->Utilisateur->exists()) {
			throw new NotFoundException(__('Utilisateur incorrect'));
		}
                if ($this->Utilisateur->save($record)) { 
                    $history['Historyutilisateur']['utilisateur_id']=$id;
                    $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - Engagement de confidentialité ".$newmsg.' par '.userAuth('NOMLONG');
                    $this->Utilisateur->Historyutilisateur->save($history);   
                    if(!$loop):
                        $this->Session->setFlash(__('Engagement de confidentialité mis à jour',true),'flash_success');
                        exit();
                    endif;
                }
                if(!$loop):
                    $this->Session->setFlash(__('Engagement de confidentialité <b>NON</b> mis à jour',true),'flash_failure');
                    exit(); 
                endif;
	}   
        
        public function changeallconf(){
            $this->autoRender = false;
            $ids = explode('-', $this->request->data('all_ids'));
            if(count($ids)>0 && $ids[0]!=""):
                foreach($ids as $id):
                    $this->progressengconf($id, true);
                endforeach;
                sleep(3);
                echo $this->Session->setFlash(__('Engagements de confidentialité mis à jour',true),'flash_success');
            else:
                echo $this->Session->setFlash(__('Aucun utilisateur sélectionné',true),'flash_failure');
            endif;
            return $this->request->data('all_ids');
        }
        
	function export_fm($id) {
            $this->Utilisateur->recursive = 0;
            $options = array('conditions' => array('Utilisateur.' . $this->Utilisateur->primaryKey => $id));           
            $data = $this->Utilisateur->find('first', $options);              
            $this->set('rows',$data);
            $this->render('export_fm','export_xls');
	}   
        
        public function get_select_actif($admin =false,$generique = false){
            $conditions = array();
            $conditions[] = array('Utilisateur.ACTIF'=>1);
            if (!$admin) : $conditions[] = array('Utilisateur.id > 1'); endif;
            if (!$generique) : $conditions[] = array('OR'=>array('Utilisateur.profil_id > 0','Utilisateur.profil_id'=>-2)); endif;
            $list = $this->Utilisateur->find('list',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>$conditions,'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>0));
            return $list;
        }        
        
        public function get_list_actif($admin =false,$generique = false){
            $visibility = $this->get_visibility();
            if ($admin) : $visibility = "1,".$visibility; endif;
            $conditions = array();
            $conditions[] = array('Utilisateur.ACTIF'=>1);
            if($visibility == null):
                $conditions[] = "1 = 1";
            elseif ($visibility!=''):
                $conditions[] = "Utilisateur.id IN (".$visibility.")";
            else:
                $conditions[] = "Utilisateur.id IN (".userAuth('entite_id').")";
            endif; 
            if (!$generique) : $conditions[] = array('OR'=>array('Utilisateur.profil_id > 0','Utilisateur.profil_id'=>-2)); endif;
            $list = $this->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.section_id','Utilisateur.NOMLONG'),'conditions'=>$conditions,'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>0));
            return $list;
        }   
        
        public function get_list_all_actif($generique = true){
            $conditions = array();
            if ($generique == false) : $conditions[] = array('OR'=>array('Utilisateur.profil_id > 0','Utilisateur.profil_id'=>-2)); endif;            
            $conditions[] = array('Utilisateur.ACTIF'=>1);
            $conditions[] = array('Utilisateur.id > 1');
            $list = $this->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.section_id','Utilisateur.NOMLONG'),'conditions'=>$conditions,'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>0));
            return $list;
        }         
        
        public function get_mail($list){
            if($list != ''):
                $values = array();
                $utilisateurs = $this->Utilisateur->find('all',array('fields'=>array('Utilisateur.MAIL'),'conditions'=>array('Utilisateur.id IN ('.$list.')'),'recursive'=>0));
                foreach($utilisateurs as $obj):
                    $values[] = $obj['Utilisateur']['MAIL'];
                endforeach;
                return $values;
            else:
                return array();
            endif;
        }
        
        public function get_nom($list){
            if($list != ''):
                $values = array();
                $utilisateurs = $this->Utilisateur->find('all',array('fields'=>array('Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id IN ('.$list.')'),'recursive'=>0));
                foreach($utilisateurs as $obj):
                    $values[] = $obj['Utilisateur']['NOMLONG'];
                endforeach;
                return implode(';',$values);
            else:
                return 'Aucun contributeur';
            endif;                
        }     
        
        public function get_nomlong($id){
            $this->Utilisateur->id = $id;
            $obj = $this->Utilisateur->read('NOMLONG');
            return $obj['Utilisateur']['NOMLONG'];
        }
        
        public function ajax_save_password(){
            $this->autoRender = false;
            $msg  = $this->Session->setFlash(__('Mot de passe <b>NON</b> sauvegardé',true),'flash_failure');
            $this->Utilisateur->id = userAuth('id');
            if ($this->Utilisateur->saveField('password', $this->request->data('password'))):
                 $this->save_history(userAuth('id'), 'Modification du mot de passe');
                 $utilisateur = $this->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>userAuth('id'))));
                 refreshSession($utilisateur['Utilisateur']);
                 $msg = $this->Session->setFlash(__('Nouveau mot de passe sauvegardé',true),'flash_success');                          
            endif;
            $msg;
            return 'true';
        }
        
        public function find_all_cercle_utilisateur($utilisateur_id,$generique=0,$absences=0){
            $pass = isset($this->params->params['pass']) ? $this->params->params['pass'] : null;
            $utilisateur_id = isset($pass[0]) ? $pass[0] : $utilisateur_id;
            $generique =  isset($pass[1]) ? $pass[1] : $generique;
            $absences = isset($pass[2]) ? $pass[2] : $absences;
            $list = $this->get_visibility();
            $conditions = array(); 
            if($list == null):
                $conditions[]="Utilisateur.id > 1 AND Utilisateur.ACTIF = 1";
            else:
                $conditions[] = 'Utilisateur.id IN ('.$list.')';
            endif;
            if((int)$generique == 0 && (int)$absences == 1): $link = "AND"; else: $link = "OR"; endif;
            if ((int)$generique == 0) : $orconditions[] = array('OR'=>array('Utilisateur.profil_id > 0','Utilisateur.profil_id'=>-2)); else: $orconditions[] = array('Utilisateur.profil_id = -1'); endif;                 
            if ((int)$absences == 1) : $orconditions[] = array('Utilisateur.GESTIONABSENCES'=>1); endif;  
            $conditions = array($conditions,$link=>$orconditions);
            $order[]=array('Utilisateur.NOM'=>'asc','Utilisateur.PRENOM'=>'asc');
            $list = $this->Utilisateur->find('all',array('order'=>$order,'conditions'=>$conditions,'recursive'=>0));
            return $list;
        }    
        
        public function find_list_cercle_utilisateur($utilisateur_id=null,$generique=0,$absences=0){
//            $pass = isset($this->params) ? $this->params->params['pass'] : array(); 
//            $utilisateur_id = isset($pass[0]) ? $pass[0] : $utilisateur_id;
//            $generique =  isset($pass[1]) ? $pass[1] : $generique;
//            $absences = isset($pass[2]) ? $pass[2] : $absences;            
            $list = $this->get_visibility();
            $conditions = array(); 
            if($list == null):
                $conditions[]="Utilisateur.id > 1 AND Utilisateur.ACTIF = 1";
            else:
                $conditions[] = 'Utilisateur.id IN ('.$list.')';
            endif;
            if((int)$generique == 0 && (int)$absences == 1): $link = "AND"; else: $link = "OR"; endif;
            if ((int)$generique == 0) : $orconditions[] = array('OR'=>array('Utilisateur.profil_id > 0','Utilisateur.profil_id'=>-2)); else: $orconditions[] = array('Utilisateur.profil_id = -1'); endif;                 
            if ((int)$absences == 1) : $orconditions[] = array('Utilisateur.GESTIONABSENCES'=>1); endif;  
            $conditions = array($conditions,$link=>$orconditions);
            $order[]=array('Utilisateur.NOM'=>'asc','Utilisateur.PRENOM'=>'asc');
            $fields = array('Utilisateur.id','Utilisateur.NOMLONG');
            $list = $this->Utilisateur->find('list',array('fields'=>$fields,'order'=>$order,'conditions'=>$conditions,'recursive'=>0));
            return $list;          
        }   
        
        public function find_str_cercle_utilisateur($utilisateur_id,$generique=0,$absences=0){
            $pass = $this->params->params['pass'];
            $utilisateur_id = isset($pass[0]) ? $pass[0] : $utilisateur_id;
            $generique =  isset($pass[1]) ? $pass[1] : $generique;
            $absences = isset($pass[2]) ? $pass[2] : $absences;
            $list = $this->get_visibility();
            $conditions = array(); 
            if($list == null):
                $conditions[]="Utilisateur.id > 1 AND Utilisateur.ACTIF = 1";
            else:
                $conditions[] = 'Utilisateur.id IN ('.$list.')';
            endif;
            if((int)$generique == 0 && (int)$absences == 1): $link = "AND"; else: $link = "OR"; endif;
            if ((int)$generique == 0) : $orconditions[] = array('OR'=>array('Utilisateur.profil_id > 0','Utilisateur.profil_id'=>-2)); else: $orconditions[] = array('Utilisateur.profil_id = -1'); endif;                 
            if ((int)$absences == 1) : $orconditions[] = array('Utilisateur.GESTIONABSENCES'=>1); endif;  
            $conditions = array($conditions,$link=>$orconditions);
            $order[]=array('Utilisateur.NOM'=>'asc','Utilisateur.PRENOM'=>'asc');
            $results = $this->Utilisateur->find('all',array('order'=>$order,'conditions'=>$conditions,'recursive'=>1));
            foreach ($results as $result):
                    $list .= $result['Utilisateur']['id'].',';
            endforeach;
            return strlen($list) > 1 ? substr_replace($list ,"",-1) : '0';
        }  
        
        public function ajax_autoend(){
            $this->autoRender = false;
            $today = new DateTime();
            $today->format('Y-m-d');  
            $users = $this->Utilisateur->find('all',array('conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.FINMISSION < "'.date("Y-m-d").'"'),'recursive'=>-1));           
            foreach ($users as $user):
                $finmission = new DateTime($user['Utilisateur']['FINMISSION']);
                $diff = $today->format('m') - $finmission->format('m'); 
                $this->Utilisateur->id = $user['Utilisateur']['id'];
                if($diff>=1 && $user['Utilisateur']['ACTIF']==0):
                    $this->Utilisateur->saveField('GESTIONABSENCES', 0);  
                endif;
                $this->Utilisateur->saveField('ACTIF', 0);
                $this->Utilisateur->saveField('FINMISSION', $today);
            endforeach;
            return count($users);
        }  
        
        public function get_users_gestionnaireabsences($actif=1){
            set_time_limit(120);
            $fields = array('Utilisateur.id','Utilisateur.PRENOM','Utilisateur.NOM','Utilisateur.MAIL');
            $conditions = array('Utilisateur.GESTIONABSENCES'=>$actif,'Utilisateur.ACTIF'=>1,'Utilisateur.NOTIFYME'=>1);
            return $this->Utilisateur->find('all',array('fields'=>$fields,'conditions'=>$conditions,'recursive'=>-1)); 
        }
        
        public function get_str_users_gestionnaireabsences($actif=1){
            $users = $this->get_users_gestionnaireabsences($actif);
            $list = "";
            foreach($users as $user):
                $list .=$user['Utilisateur']['id'].',';
            endforeach;
            return strlen($list) > 1 ? substr_replace($list ,"",-1) : '0';
        }
}