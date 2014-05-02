<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Controller', 'Assoentiteutilisateurs');
App::import('Controller', 'Utilisateurs');
App::import('Controller', 'Outils');
App::import('Controller', 'Listediffusions');
App::import('Controller', 'Dossierpartages');
App::import('Controller', 'Entites');
App::import('Controller', 'Sections');
/**
 * Utiliseoutils Controller
 *
 * @property Utiliseoutil $Utiliseoutil
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class UtiliseoutilsController extends AppController {
        public $components = array('History','Common'); 
        
        public $paginate = array(
            'limit' => 25,
            'order' => array('Utiliseoutil.id' => 'desc'),
            );
        
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Ouvertures de droits" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }         
        
        public function beforeFilter() {   
            $this->Auth->allow(array('mailprogressstate','index','search','json_all_listes','json_all_outils','json_all_partages','json_all_user','get_all_outil'));
            parent::beforeFilter();
        }   
        
        public function duplicatefrom(){
            $this->autoRender = false;
            $origine = $this->request->data['Utiliseoutil']['ORIGINE'];
            $destinataire = $this->request->data['Utiliseoutil']['utilisateur_id'];
            $ObjUtilisateurs = new UtilisateursController();
            $nomlong = $ObjUtilisateurs->get_nomlong($origine);
            $conditions[]='Utiliseoutil.utilisateur_id = '.$origine;
            $all_droits = $this->Utiliseoutil->find('all',array('conditions'=>$conditions,'recursive'=>-1));
            foreach ($all_droits as $droit):
                $type = isset($droit['Utiliseoutil']['TYPE']) ? $droit['Utiliseoutil']['TYPE'] : null;
                $droit_id = null;
                if (isset($droit['Utiliseoutil']['outil_id']) && $droit['Utiliseoutil']['outil_id'] !=null) :
                    $droit_id = $droit['Utiliseoutil']['outil_id'];
                    $type = 'outil';
                elseif (isset($droit['Utiliseoutil']['listediffusion_id']) && $droit['Utiliseoutil']['listediffusion_id'] !=null) :
                    $droit_id = $droit['Utiliseoutil']['listediffusion_id'];
                    $type = 'list';
                elseif (isset($droit['Utiliseoutil']['dossierpartage_id']) && $droit['Utiliseoutil']['dossierpartage_id'] !=null) :
                    $droit_id = $droit['Utiliseoutil']['dossierpartage_id'];
                    $type = 'group';
                endif;
                $this->save_new($destinataire, $droit_id, $type,1);
            endforeach;
            $this->Session->setFlash(__(count($all_droits).' overtures des droits dupliquées depuis l\'utilisateur '.$nomlong,true),'flash_success');
            $this->History->notmove();
        }
        
        public function dupliquer(){
            $this->autoRender = false;
            $origine = $this->request->data['Utiliseoutil']['ORIGINE'];
            $destinataire = $this->request->data['Utiliseoutil']['utilisateur_id'];
            $ObjUtilisateurs = new UtilisateursController();
            $nomlong = $ObjUtilisateurs->get_nomlong($origine);
            $conditions[]='Utiliseoutil.utilisateur_id = '.$origine;
            $all_droits = $this->Utiliseoutil->find('all',array('conditions'=>$conditions,'recursive'=>-1));
            foreach ($all_droits as $droit):
                $type = isset($droit['Utiliseoutil']['TYPE']) ? $droit['Utiliseoutil']['TYPE'] : null;
                $droit_id = null;
                if (isset($droit['Utiliseoutil']['outil_id']) && $droit['Utiliseoutil']['outil_id'] !=null) :
                    $droit_id = $droit['Utiliseoutil']['outil_id'];
                    $type = 'outil';
                elseif (isset($droit['Utiliseoutil']['listediffusion_id']) && $droit['Utiliseoutil']['listediffusion_id'] !=null) :
                    $droit_id = $droit['Utiliseoutil']['listediffusion_id'];
                    $type = 'list';
                elseif (isset($droit['Utiliseoutil']['dossierpartage_id']) && $droit['Utiliseoutil']['dossierpartage_id'] !=null) :
                    $droit_id = $droit['Utiliseoutil']['dossierpartage_id'];
                    $type = 'group';
                endif;
                $this->save_new($destinataire, $droit_id, $type,1);
            endforeach;
            $this->Session->setFlash(__(count($all_droits).' overtures des droits dupliquées depuis l\'utilisateur '.$nomlong,true),'flash_success');
            $this->History->goBack(1);
        }
        
        public function save_history($utilisateur_id,$msg=null){
            $msg = $msg==null ? "<b style='color:red;'>ACTION INDETERMINEE LORS DE L'AJOUT OU LA MODIFICATION D'UN DROIT</b>" : $msg;
            $history['Historyutilisateur']['utilisateur_id']=$utilisateur_id;
            $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - ".$msg.' par '.userAuth('NOMLONG');
            $this->Utiliseoutil->Utilisateur->Historyutilisateur->save($history);
        }
        
        public function get_visibility(){
            if(userAuth('profil_id')==1):
                return null;
            else:
                $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
                return $ObjAssoentiteutilisateurs->json_get_all_users_actif_nogenerique(userAuth('id'));
            endif;
        }
        
        public function get_restriction(){
            if (userAuth('WIDEAREA')==0) :
                return "Utilisateur.section_id=".userAuth('section_id');
            else:
                return "1=1";
            endif;
        }
        
        public function get_utiliseoutil_etat_filter($id){
            $result = array();
            switch ($id){
                case 'complet':
                    $result['condition']="1=1";
                    $result['filter'] = "de tous les états";
                    break;                       
                case 'tous':    
                case null:    
                    $result['condition'] = "Utiliseoutil.STATUT not in ('Retour utilisateur','Supprimée')";
                    $result['filter'] = "de tous les états sauf 'Retour utilisateur'";
                    break;
                default :
                    $result['condition'] = "Utiliseoutil.STATUT='".$id."'";
                    $result['filter'] = "avec l'état ".$id;                        
            }    
            return $result;
        }
        
        public function get_utiliseoutil_utilisateur_filter($id,$visibility){
            $result = array();
            switch ($id){
                case 'tous':
                case null:   
                    if($visibility == null):
                        $result['condition']='1=1';
                    elseif ($visibility!=''):
                        $result['condition']="Utiliseoutil.utilisateur_id IN (".$visibility.")";
                    else:
                        $result['condition']="Utiliseoutil.utilisateur_id =".userAuth('id');
                    endif;                      
                    $result['filter'] = "de tous les utilisateurs";
                    break;                      
                default :
                    $result['condition']="Utiliseoutil.utilisateur_id = '".$id."'";
                    $ObjUtilisateurs = new UtilisateursController();
                    $nomlong = $ObjUtilisateurs->get_nomlong($id);
                    $result['filter'] = "de ".$nomlong;                     
            }
            return $result;
        }
        
        public function get_utiliseoutil_outil_filter($id){
            $result = array();
            switch ($id){
                case 'tous':
                case null:    
                    $result['condition']="1=1";
                    $result['filter'] = " pour tous les outils";
                    break;                      
                default :
                    $outil = explode('_',$id);
                    if ($outil[0]=='O'):
                        $result['condition']="Utiliseoutil.outil_id = '".$outil[1]."'";
                        $nomlong = $this->Utiliseoutil->Outil->find('first',array('fields'=>array('NOM'),'conditions'=>array('id'=> $outil[1]),'recursive'=>-1));
                        $result['filter'] = " pour ".$nomlong['Outil']['NOM']; 
                    endif;
                    if ($outil[0]=='L'):
                        $result['condition']="Utiliseoutil.listediffusion_id = '".$outil[1]."'";
                        $nomlong = $this->Utiliseoutil->Listediffusion->find('first',array('fields'=>array('NOM'),'conditions'=>array('id'=> $outil[1]),'recursive'=>-1));
                        $result['filter'] = " pour ".$nomlong['Listediffusion']['NOM']; 
                    endif;
                    if ($outil[0]=='P'):
                        $result['condition']="Utiliseoutil.dossierpartage_id = '".$outil[1]."'";
                        $nomlong = $this->Utiliseoutil->Dossierpartage->find('first',array('fields'=>array('NOM'),'conditions'=>array('id'=> $outil[1]),'recursive'=>-1));
                        $result['filter'] = " pour ".$nomlong['Dossierpartage']['NOM']; 
                    endif;                        
            }       
            return $result;
        }    
        
        public function get_new_etat($old_etat,$valideur=null){
            $result['newetat']='';
            $result['valideur']='';
            $ObjSections = new SectionsController();
            switch ($old_etat) {
                case 'Demandé':
                   $result['newetat'] = 'Pris en compte';
                   break;
                case 'Pris en compte':
                   $result['newetat'] = 'En validation';
                   $result['valideur'] = $valideur!=null ? $ObjSections->get_valideur($valideur): '';                     
                   break;                
                case 'En validation':
                   $result['newetat'] = 'Validé';
                   break;          
                case 'Validé':
                   $result['newetat'] = 'Demande transférée';
                   break;
                case 'Demande transférée':
                   $result['newetat'] = 'Demande traitée';
                   break;                
                case 'Demande traitée':
                   $result['newetat'] = 'Retour utilisateur';
                   break;
                case 'Retour utilisateur':
                   $result['newetat'] = 'A supprimer';
                   break;                
                case 'A supprimer':
                   $result['newetat'] = 'Supprimée';
                   break;          
                case 'Supprimée':
                   $result['newetat'] = 'Demandé';
                   break; 
            }
            return $result;
        }
        
        public function get_list_utiliseoutil_etat(){
            $etat = Configure::read('etatOuvertureDroit');
            return $etat; 
        }
        
        public function get_all_utiliseoutil_etat(){
            $etats = Configure::read('etatOuvertureDroit');
            $alletat = array();
            $i=0;
            foreach($etats as $key=>$value):
                $alletat[$i]['Utiliseoutil']['id']=$key;
                $alletat[$i]['Utiliseoutil']['STATUT']=$value;
                $i++;
            endforeach;
            return $alletat; 
        }  
        
        public function get_all_utiliseoutil_utilisateur($visibility,$restriction){
            if($visibility == null):
                $conditions =array('1=1');
            elseif ($visibility!=''):
                $conditions = array('Utilisateur.id > 1','Utilisateur.profil_id > 0','Utilisateur.id IN ('.$visibility.')');
            else:
                $conditions =array('Utilisateur.id > 1','Utilisateur.profil_id > 0','Utilisateur.id ='.userAuth('id'));
            endif;                      
            $conditions = array_merge_recursive($conditions,array($restriction));
            $utilisateurs = $this->Utiliseoutil->find('all',array('conditions'=>$conditions,'order'=>array('Utilisateur.NOMLONG'=>'asc'),'group'=>'Utilisateur.id','recursive'=>0));
            return $utilisateurs;
        }

        public function get_list_utiliseoutil_utilisateur($visibility,$restriction){
            if($visibility == null):
                $conditions =array('1=1');
            elseif ($visibility!=''):
                $conditions = array('Utilisateur.id IN ('.$visibility.')','Utilisateur.id > 1','Utilisateur.profil_id != -1');
            else:
                $conditions =array('Utilisateur.id ='.userAuth('id'),'Utilisateur.id > 1','Utilisateur.profil_id != -1');
            endif;                      
            $conditions = array_merge_recursive($conditions,array($restriction));
            $utilisateurs = $this->Utiliseoutil->Utilisateur->find('list',array('fields' => array('id','NOMLONG'),'conditions'=>$conditions,'order'=>array('Utilisateur.NOMLONG'=>'asc'),'group'=>'Utilisateur.id','recursive'=>-1));
            return $utilisateurs;
        }       
        
        public function json_all_user(){
            $this->autoRender = false;
            $visibility = $this->get_visibility();
            $restriction = $this->get_restriction();
            if($visibility == null):
                $conditions =array('1=1');
            elseif ($visibility!=''):
                $conditions = array('Utilisateur.id IN ('.$visibility.')','Utilisateur.id > 1','Utilisateur.profil_id != -1');
            else:
                $conditions =array('Utilisateur.id ='.userAuth('id'),'Utilisateur.id > 1','Utilisateur.profil_id != -1');
            endif;                      
            $conditions = array_merge_recursive($conditions,array($restriction));
            $utilisateurs = $this->Utiliseoutil->Utilisateur->find('all',array('fields' => array('NOMLONG','id'),'conditions'=>$conditions,'order'=>array('Utilisateur.NOMLONG'=>'asc'),'group'=>'Utilisateur.id','recursive'=>-1));
            $result = array();
            foreach($utilisateurs as $user):
                $result[$user['Utilisateur']['NOMLONG']]=$user['Utilisateur']['id'];
            endforeach;
            return json_encode($result);
        } 
        
        public function json_all_outils(){
            $this->autoRender = false;
            $result = array();
            $ObjOutils = new OutilsController();
            $outils = $ObjOutils->get_all_outil();
            foreach($outils as $obj):
                $result[$obj['Outil']['NOM']]=$obj['Outil']['id'];
            endforeach;
            return json_encode($result);
        }
        
        public function json_all_listes(){
            $this->autoRender = false;
            $result = array();
            $ObjListediffusions = new ListediffusionsController();
            $listes = $ObjListediffusions->get_all();
            foreach($listes as $obj):
                $result[$obj['Listediffusion']['NOM']]=$obj['Listediffusion']['id'];
            endforeach;            
            return json_encode($result);
        }
        
        public function json_all_partages(){
            $this->autoRender = false;
            $result = array();
            $ObjDossierpartages = new DossierpartagesController();
            $dossiers = $ObjDossierpartages->get_all();
            foreach($dossiers as $obj):
                $result[$obj['Dossierpartage']['NOM']]=$obj['Dossierpartage']['id'];
            endforeach;  
            return json_encode($result);
        }
        
        public function addto(){
            $this->autoRender = false;
            $this->request->data['Utiliseoutil']['created'] = date('Y-m-d');
            $this->request->data['Utiliseoutil']['modified'] = date('Y-m-d');
            $this->Utiliseoutil->create();
            if($this->Utiliseoutil->save($this->request->data)):
                $this->Session->setFlash(__('Ouverture de droit sauvegardée',true),'flash_success');
            else:
                $this->Session->setFlash(__('Ouverture de droit incorrecte, veuillez corriger l\'ouverture de droit',true),'flash_failure');
            endif;
            $this->History->goback(0);
        }
        
        public function get_nom_outil($data){
            $nomoutil = "inconnu";
            $outil_id = isset($data['Utiliseoutil']['outil_id']) ? $data['Utiliseoutil']['outil_id'] : '';
            $listediffusion_id = isset($data['Utiliseoutil']['listediffusion_id']) ? $data['Utiliseoutil']['listediffusion_id'] : '';
            $dossierpartage_id = isset($data['Utiliseoutil']['dossierpartage_id']) ? $data['Utiliseoutil']['dossierpartage_id'] : '';
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
            return $nomoutil;
        }
/**
 * index method
 *
 * @return void
 */
        public function index($filtreetat=null,$utilisateur_id=null,$filtreoutil=null) {
            $this->set_title();
            $listusers = $this->get_visibility() ;
            $restriction=$this->get_restriction();
            $getetat = $this->get_utiliseoutil_etat_filter($filtreetat);
            $getutilisateur = $this->get_utiliseoutil_utilisateur_filter($utilisateur_id,$listusers);
            $getoutil = $this->get_utiliseoutil_outil_filter($filtreoutil);
            $this->set('fetat',$getetat['filter']);   
            $this->set('futilisateur',$getutilisateur['filter']); 
            $this->set('foutil',$getoutil['filter']);
            $newconditions=array($getetat['condition'],$getutilisateur['condition'],$getoutil['condition'],$restriction);
            $etats = $this->get_all_utiliseoutil_etat();
            $ObjOutils = new OutilsController();
            $ObjListediffusions = new ListediffusionsController();
            $ObjDossierpartages = new DossierpartagesController();
            $outils = $ObjOutils->get_all_outil();
            $listes = $ObjListediffusions->get_all();
            $partages = $ObjDossierpartages->get_all();
            $utilisateurs = $this->get_all_utiliseoutil_utilisateur($listusers, $getetat['condition'], $restriction);
            $this->set(compact('etats','outils','listes','partages','utilisateurs'));              
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));
            $this->set('utiliseoutils', $this->paginate());               
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id = null) {
            $this->set_title();
            if (isAuthorized('utiliseoutils', 'add')) :           
                if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Utiliseoutil->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Utiliseoutil->create();
			if ($this->Utiliseoutil->save($this->request->data)) {
                                $nomoutil = $this->get_nom_outil($this->request->data);     
                                $utiliseoutil = $this->Utiliseoutil->find('first',array('conditions'=>array('Utiliseoutil.id'=>$this->Utiliseoutil->getLastInsertID())));
                                $this->sendmailutiliseoutil($utiliseoutil);
                                $this->addnewaction($this->Utiliseoutil->getLastInsertID(),$nomoutil);
                                $this->save_history($this->request->data['Utiliseoutil']['utilisateur_id'], "ajout d'une ouverture de droit");                        
				$this->Session->setFlash(__('Ouvertures des droits sauvegardée',true),'flash_success');
                                $this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Ouvertures des droits incorrecte, veuillez corriger cette ouverture de droit',true),'flash_failure');
			}
                    endif;
		endif;
                $listusers = $this->get_visibility();
                $restriction = $this->get_restriction();
                $utilisateur = $this->get_list_utiliseoutil_utilisateur($listusers, $restriction);
                $etat = $this->get_list_utiliseoutil_etat();
                $ObjOutils = new OutilsController();
                $ObjListediffusions = new ListediffusionsController();
                $ObjDossierpartages = new DossierpartagesController();
                $outil = $ObjOutils->get_list_outil();
                $listediffusion = $ObjListediffusions->get_list();
                $dossierpartage = $ObjDossierpartages->get_list();
                $this->set(compact('etat','outil','listediffusion','dossierpartage','utilisateur'));                 
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                
	}
        
        public function save_new($utilisateur_id,$droit_id,$type,$duplique=0){
            set_time_limit(60);
            $record['Utiliseoutil']['utilisateur_id']=$utilisateur_id;
            $outil_id = $type=='outil' ? $droit_id : '';
            $group_id = $type=='group' ? $droit_id : '';
            $list_id = $type=='list' ? $droit_id : '';
            $record['Utiliseoutil']['outil_id']= $outil_id;
            $record['Utiliseoutil']['dossierpartage_id']= $group_id;
            $record['Utiliseoutil']['listediffusion_id']= $list_id;
            $record['Utiliseoutil']['STATUT']= "Demandé";
            $record['Utiliseoutil']['created']= date('Y-m-d');
            $record['Utiliseoutil']['modified']= date('Y-m-d');
            $this->Utiliseoutil->create();
            if ($this->Utiliseoutil->save($record)) {
                $utiliseoutil = $this->Utiliseoutil->find('first',array('conditions'=>array('Utiliseoutil.id'=>$this->Utiliseoutil->getLastInsertID())));
                $this->sendmailutiliseoutil($utiliseoutil);
                $msg = $duplique==0 ? "ajout d'une ouverture de droit" : "duplication d'une ourverture de droit";
                $this->save_history($utilisateur_id, $msg);                        
                $this->Session->setFlash(__('Ouvertures des droits sauvegardée',true),'flash_success');               
            } else {
                $this->Session->setFlash(__('Ouvertures des droits incorrecte, veuillez corriger cette ouverture de droit',true),'flash_failure');
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
            $this->set_title();
            if (isAuthorized('utiliseoutils', 'edit')) :
                if (!$this->Utiliseoutil->exists($id)) {
			throw new NotFoundException(__('Ouvertures des droits incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Utiliseoutil->validate = array();
                        $this->History->goBack(1);
                    else:                     
                        //$this->autoprogressState($id);
                        if ($this->Utiliseoutil->save($this->request->data)) {
                                $nomoutil = $this->get_nom_outil($this->request->data);     
                                $utiliseoutil = $this->Utiliseoutil->find('first',array('conditions'=>array('Utiliseoutil.id'=>$id),'recursive'=>0));
                                $newetat = $utiliseoutil['Utiliseoutil']['STATUT'];
                                if($newetat=='Demande transférée' || $newetat=='A supprimer' || $newetat = 'En validation'):
                                    $this->sendmailutiliseoutil($utiliseoutil);  
                                endif;
                                $this->addnewaction($id,$nomoutil);
                                $this->save_history($this->request->data['Utiliseoutil']['utilisateur_id'], "Modification d'une ouverture de droit");                          
				$this->Session->setFlash(__('Ouvertures des droits sauvegardée',true),'flash_success');
                                $this->History->goBack(1);
                        }  
                    endif;                   
		} else {
                    $options = array('conditions' => array('Utiliseoutil.' . $this->Utiliseoutil->primaryKey => $id),'recursive'=>0);
                    $this->request->data = $this->Utiliseoutil->find('first', $options);
                    $this->set('utiliseoutil', $this->Utiliseoutil->find('first', $options));
                    $listusers = $this->get_visibility();
                    $restriction = $this->get_restriction();
                    $utilisateur = $this->get_list_utiliseoutil_utilisateur($listusers, $restriction);
                    $etat = $this->get_list_utiliseoutil_etat();
                    $ObjOutils = new OutilsController();
                    $ObjListediffusions = new ListediffusionsController();
                    $ObjDossierpartages = new DossierpartagesController();
                    $outil = $ObjOutils->get_list_outil();
                    $listediffusion = $ObjListediffusions->get_list();
                    $dossierpartage = $ObjDossierpartages->get_list();
                    $this->set(compact('etat','outil','listediffusion','dossierpartage','utilisateur'));                           
		}
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
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
	public function delete($id = null,$msg=0) {
            if (isAuthorized('utiliseoutils', 'delete')) :
		$this->set_title();
                $this->Utiliseoutil->id = $id;
                $userid = $this->Utiliseoutil->read();
		if (!$this->Utiliseoutil->exists()) {
			throw new NotFoundException(__('Ouvertures des droits incorrecte'));
		}
		if ($this->Utiliseoutil->delete()) {
                        $history['Historyutilisateur']['utilisateur_id']=$userid['Utiliseoutil']['utilisateur_id'];
                        $history['Historyutilisateur']['HISTORIQUE']=date('H:i:s')." - suppression d'une ouverture de droit".' par '.userAuth('NOMLONG');
                        $this->Utiliseoutil->Utilisateur->Historyutilisateur->save($history); 
                        if($msg==0):
                            $this->Session->setFlash(__('Ouvertures des droits supprimée',true),'flash_success');
                            $this->History->goBack(1);
                        else:
                            return true;
                        endif;
		}
                if($msg==0):
                    $this->Session->setFlash(__('Ouvertures des droits <b>NON</b> supprimée',true),'flash_failure');
                    $this->History->goBack(1);
                else:
                    return false;
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
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
            $this->set_title();
            if (isAuthorized('utiliseoutils', 'update')) :
                $newetat = '';
                $id = $id==null ? $this->request->data('id') : $id;
                $this->Utiliseoutil->id = $id;
                $record = $this->Utiliseoutil->read();
                if($record['Outil']['VALIDATION']==0 && $record['Utiliseoutil']['STATUT']=='Pris en compte') $record['Utiliseoutil']['STATUT']='Validé';
                $getnewetat = $this->get_new_etat($record['Utiliseoutil']['STATUT'], $record['Utilisateur']['section_id']);
                $record['Utiliseoutil']['STATUT'] = $getnewetat['newetat'];
                $record['Utiliseoutil']['created'] = $this->Utiliseoutil->read('created');
                $record['Utiliseoutil']['modified'] = date('Y-m-d');
		if (!$this->Utiliseoutil->exists()) {
			throw new NotFoundException(__('Ouvertures des droits incorrecte'));
		}
                if ($this->Utiliseoutil->save($record)) { 
                    $utiliseoutil = $this->Utiliseoutil->find('first',array('conditions'=>array('Utiliseoutil.id'=>$id)));
                    if($newetat=='Demande transférée' || $newetat=='A supprimer' || $newetat = 'En validation'):
                        $this->sendmailutiliseoutil($utiliseoutil,$getnewetat['valideur']);  
                    endif;
                    $this->save_history($record['Utiliseoutil']['utilisateur_id'], "changement d'état d'une ouverture de droit");                    
                    $this->Session->setFlash(__('Ouvertures des droits progression de l\'état',true),'flash_success');
                    exit();
                }
		$this->Session->setFlash(__('Ouvertures des droits <b>NON</b> progression de l\'état',true),'flash_failure');
		exit();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                
	}    
        
	public function autoprogressState($id = null) {
                $newetat = '';
                $this->Utiliseoutil->id = $id;
                $record = $this->Utiliseoutil->read();
                $valideur = null;
                if($record['Outil']['VALIDATION']==0 && $record['Utiliseoutil']['STATUT']=='Pris en compte') $record['Utiliseoutil']['STATUT']='Validé';
                $getnewetat = $this->get_new_etat($record['Utiliseoutil']['STATUT'], $record['Utilisateur']['section_id']);
                $record['Utiliseoutil']['STATUT'] = $getnewetat['newetat'];
                $record['Utiliseoutil']['created'] = $this->Utiliseoutil->read('created');
                $record['Utiliseoutil']['modified'] = date('Y-m-d');
                if ($this->Utiliseoutil->save($record)) { 
                    $utiliseoutil = $this->Utiliseoutil->find('first',array('conditions'=>array('Utiliseoutil.id'=>$id),'recursive'=>0));
                    if($newetat=='Demande transférée' || $newetat=='A supprimer' || $newetat = 'En validation'):
                        $this->sendmailutiliseoutil($utiliseoutil,$getnewetat['valideur']);  
                    endif;                    
                    $this->save_history($record['Utiliseoutil']['utilisateur_id'], "changement d'état d'une ouverture de droit");                   
                }              
	}  
    
	public function mailprogressstate($id,$userid) {
                $newetat = '';
                $this->Utiliseoutil->id = $id;
                $record = $this->Utiliseoutil->read();
                $valideur = null;
                if(isset($record) && $record['Outil']['VALIDATION']==0 && $record['Utiliseoutil']['STATUT']=='Pris en compte') $record['Utiliseoutil']['STATUT']='Validé';
                $getnewetat = $this->get_new_etat($record['Utiliseoutil']['STATUT'], $record['Utilisateur']['section_id']);
                $record['Utiliseoutil']['STATUT'] = $getnewetat['newetat'];
                $record['Utiliseoutil']['created'] = $this->Utiliseoutil->read('created');
                $record['Utiliseoutil']['modified'] = date('Y-m-d');
                if ($this->Utiliseoutil->save($record)) { 
                    $utiliseoutil = $this->Utiliseoutil->find('first',array('conditions'=>array('Utiliseoutil.id'=>$id),'recursive'=>0));   
                    $utilisateur = $this->Utiliseoutil->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$userid),'recursive'=>-1));
                    $this->save_history($record['Utiliseoutil']['utilisateur_id'], "changement d'état d'une ouverture de droit");                     
                }    
                if(userAuth('id')!=""): 
                    $this->redirect(array('action'=>"index",'tous','tous'));
                endif;
	}          
        
/**
 * search method
 *
 * @return void
 */
	public function search($filtreetat=null,$utilisateur_id=null,$filtreoutil=null,$keywords=null) {
            $this->set_title();
            if(isset($this->params->data['Utiliseoutil']['SEARCH'])):
                $keywords = $this->params->data['Utiliseoutil']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $arkeywords = explode(' ',trim($keywords));             
                $listusers = $this->get_visibility() ;
                $restriction=$this->get_restriction();
                $getetat = $this->get_utiliseoutil_etat_filter($filtreetat);
                $getutilisateur = $this->get_utiliseoutil_utilisateur_filter($utilisateur_id,$listusers);
                $getoutil = $this->get_utiliseoutil_outil_filter($filtreoutil);
                $this->set('fetat',$getetat['filter']);   
                $this->set('futilisateur',$getutilisateur['filter']); 
                $this->set('foutil',$getoutil['filter']);
                $newconditions=array($getetat['condition'],$getutilisateur['condition'],$getoutil['condition'],$restriction);
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Utiliseoutil.STATUT LIKE '%".$value."%'","Utiliseoutil.TYPE LIKE '%".$value."%'","(CONCAT(Utilisateur.NOM, ' ', Utilisateur.PRENOM)) LIKE '%".$value."%'","Outil.NOM LIKE '%".$value."%'","Dossierpartage.NOM LIKE '%".$value."%'","Listediffusion.NOM LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newconditions,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                
                $etats = $this->get_all_utiliseoutil_etat();
                $ObjOutils = new OutilsController();
                $ObjListediffusions = new ListediffusionsController();
                $ObjDossierpartages = new DossierpartagesController();
                $outils = $ObjOutils->get_all_outil();
                $listes = $ObjListediffusions->get_all();
                $partages = $ObjDossierpartages->get_all();
                $utilisateurs = $this->get_all_utiliseoutil_utilisateur($listusers, $getetat['condition'], $restriction);
                $this->set(compact('etats','outils','listes','partages','utilisateurs'));              
                $this->set('utiliseoutils', $this->paginate());   
            else:
                $this->redirect(array('action'=>'index',$filtreetat,$utilisateur_id,$filtreoutil));
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
            $this->autoRender = false;
            $ids = explode('-', $this->request->data('all_ids'));
            if(count($ids)>0 && $ids[0]!=""):
                foreach($ids as $id):
                    $this->autoprogressState($id);
                endforeach;
                sleep(3);
                echo $this->Session->setFlash(__('Mises à jour complétées',true),'flash_success');
            else:
                echo $this->Session->setFlash(__('Aucune ouverture de droit sélectionnée',true),'flash_failure');
            endif;
            return json_encode($ids);
        }
        
        public function alldelete($ids=null){
            $this->autoRender = false;
            $ids = explode('-', $this->request->data('all_ids'));
            if(count($ids)>0 && $ids[0]!=""):
                $result = array();
                foreach($ids as $id):
                    $result[] = $this->delete($id,1);
                endforeach;
                sleep(3);
                if(in_array(false,$result)):
                    echo $this->Session->setFlash(__('Au moins une ouvertures de droits <b>N\'EST PAS</b> supprimée',true),'flash_failure');
                else:
                    echo $this->Session->setFlash(__('Ouvertures de droits supprimées',true),'flash_success');
                endif;
            else:
                echo $this->Session->setFlash(__('Aucune ouverture de droit sélectionnée',true),'flash_failure');
            endif;
            return json_encode($ids);
        }
        
        public function sendmailutiliseoutil($utiliseoutil,$valideur=null){
            $utilisateur = $this->Utiliseoutil->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$utiliseoutil['Utiliseoutil']['utilisateur_id']),'recursive'=>0));            
            $to = '';
            if(!empty($utiliseoutil['Utiliseoutil']['outil_id']) && $utiliseoutil['Utiliseoutil']['outil_id']!=null):
                $outil = $this->Utiliseoutil->Outil->find('first',array('conditions'=>array('Outil.id'=>$utiliseoutil['Utiliseoutil']['outil_id']),'recursive'=>0));
                $nom = $outil['Outil']['NOM'];
                $gestionnaire = $outil['Outil']['utilisateur_id'];
                if($utiliseoutil['Utiliseoutil']['STATUT']=='Demande transférée'):
                    $to = $outil['Utilisateur']['MAIL'];
                elseif($utiliseoutil['Utiliseoutil']['STATUT']=='Demandé'):
                    $ObjEntites = new EntitesController();
                    $mailto = $ObjEntites->get_contact();
                    $to = explode(';',$mailto);          
                endif;
            endif;
            if(!empty($utiliseoutil['Utiliseoutil']['listediffusion_id']) && $utiliseoutil['Utiliseoutil']['listediffusion_id']!=null):
                $listediffusion = $this->Utiliseoutil->Listediffusion->find('first',array('conditions'=>array('Listediffusion.id'=>$utiliseoutil['Utiliseoutil']['listediffusion_id'])));
                $nom = $listediffusion['Listediffusion']['NOM'];
                $gestionnaire = $listediffusion['Listediffusion']['utilisateur_id'];                
                $ObjEntites = new EntitesController();
                $mailto = $ObjEntites->get_contact();
                $to = explode(';',$mailto);     
            endif;
            if(!empty($utiliseoutil['Utiliseoutil']['dossierpartage_id']) && $utiliseoutil['Utiliseoutil']['dossierpartage_id']!=null):
                $dossierpartage = $this->Utiliseoutil->Dossierpartage->find('first',array('conditions'=>array('Dossierpartage.id'=>$utiliseoutil['Utiliseoutil']['dossierpartage_id'])));
                $nom = $dossierpartage['Dossierpartage']['NOM'].' groupe : '.$dossierpartage['Dossierpartage']['GROUPEAD'];
                $gestionnaire = $dossierpartage['Dossierpartage']['utilisateur_id'];                 
                $ObjEntites = new EntitesController();
                $mailto = $ObjEntites->get_contact();
                $to = explode(';',$mailto);             
            endif;              
            $domaine = isset($utiliseoutil['Utilisateur']['domaine_id']) ? $this->Utiliseoutil->Utilisateur->Domaine->find('first',array('conditions'=>array('Domaine.id'=>$utiliseoutil['Utilisateur']['domaine_id']),'recursive'=>-1)) : null;
            $section = isset($utiliseoutil['Utilisateur']['section_id']) ? $this->Utiliseoutil->Utilisateur->Section->find('first',array('conditions'=>array('Section.id'=>$utiliseoutil['Utilisateur']['section_id']),'recursive'=>-1)): null;
            $site = isset($utiliseoutil['Utilisateur']['site_id']) ? $this->Utiliseoutil->Utilisateur->Site->find('first',array('conditions'=>array('Site.id'=>$utiliseoutil['Utilisateur']['site_id']),'recursive'=>-1)) : null;
            $from = Configure::read('mailapp');
            $email = isset($utiliseoutil['Utilisateur']['MAIL']) ? $utiliseoutil['Utilisateur']['MAIL'] : "Demandez un complément d'information à l'émetteur de cette demande";
            $domaine = isset($domaine['Domaine']['NOM']) ? $domaine['Domaine']['NOM'] : "Demandez un complément d'information à l'émetteur de cette demande";
            $objet = 'SAILL : Demande de création de compte ou d\'ouverture de droit pour ['.$nom.']';
            $url = $gestionnaire != '' ? FULL_BASE_URL.$this->params->base.'/utiliseoutils/mailprogressstate/'.$utiliseoutil['Utiliseoutil']['id']."/".$gestionnaire : '';
            $etat = $utiliseoutil['Utiliseoutil']['STATUT'];
            if(isset($valideur) && $valideur!=null): 
                $to = explode(";",$valideur); 
                $objet = "SAILL : Demande de validation pour ".$nom;
                $message = "Demande de validation pour : ";
                $url = '';
            endif;
            $groupcaliber = "";
            if(isset($section['Section']['NOM'])):
                switch(strtolower($section['Section']['NOM'])){
                    case 'groupement':
                        $groupcaliber = "<ul><li>[ ] OSMOSE - Intégrateur</li><li>[ ] PANAM - Intégrateur</li><li>[ ] OSMOSE - Négociateur</li></ul>";
                        break;
                    case 'moa':
                        $groupcaliber = "<ul><li>[ ] OSMOSE - MOA SI</li><li>[ ] PANAM - MOA SI</li><li>[ ] OSMOSE Existant (devt) - MOE</li></ul>";
                        break;
                    default:
                        $groupcaliber = "<ul><li>[ ] OSMOSE - MOE</li><li>[ ] PANAM - MOE</li><li>[ ] OSMOSE Existant (devt) - MOA</li></ul>";
                        break;                    
                }
            endif;
            $section = isset($section['Section']['NOM']) ? $section['Section']['NOM'] : 'Inconnue';
            $site = isset($site['Site']['NOM']) ? $site['Site']['NOM'] : 'Inconnu';
            $message = "Demande de création de compte ou d'ouverture de droit pour : ";
            $message = $message."<ul>
                    <li>Outil :".$nom."</li>
                    <li>Etat :".$etat."</li>
                    <li>Agent :".$utilisateur['Utilisateur']['NOMLONG']."</li>
                    <li>Identifiant :".$utilisateur['Utilisateur']['username']."</li>
                    <li>Email :".$email."</li>
                    <li>Domaine :".$domaine."</li>
                    <li>Section :".$section."</li>
                    <li>Localisation :".$site."</li>   
                    <li>Groupe Caliber :".$groupcaliber."</li>  
                    </ul><br>Merci de cliquer sur le lien ci-dessous, pour mettre à jour l\'avancement de la demande.<br>".$url;            
            $statuts = array('Demandé','En validation','A supprimer','Demande transférée');
            if($to!='' && in_array($utiliseoutil['Utiliseoutil']['STATUT'],$statuts)):
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
        
        public function sendmailrelance($utiliseoutil_id){
            $utiliseoutil = $this->Utiliseoutil->find('first', array('conditions'=>array('Utiliseoutil.id'=>$utiliseoutil_id),'recursive'=>0));
            if(!empty($utiliseoutil['Utiliseoutil']['outil_id']) && $utiliseoutil['Utiliseoutil']['outil_id']!=null):
                $outil = $this->Utiliseoutil->Outil->find('first',array('conditions'=>array('Outil.id'=>$utiliseoutil['Utiliseoutil']['outil_id']),'recursive'=>0));
                $nom = $outil['Outil']['NOM'];
                $gestionnaire = $outil['Outil']['utilisateur_id'];
                if($utiliseoutil['Utiliseoutil']['STATUT']=='Demande transférée'):
                    $to = $outil['Utilisateur']['MAIL'];
                elseif($utiliseoutil['Utiliseoutil']['STATUT']=='Demandé'):
                    $ObjEntites = new EntitesController();
                    $mailto = $ObjEntites->get_contact();
                    $to = explode(';',$mailto);         
                endif;
            endif;
            if(!empty($utiliseoutil['Utiliseoutil']['listediffusion_id']) && $utiliseoutil['Utiliseoutil']['listediffusion_id']!=null):
                $listediffusion = $this->Utiliseoutil->Listediffusion->find('first',array('conditions'=>array('Listediffusion.id'=>$utiliseoutil['Utiliseoutil']['listediffusion_id'])));
                $nom = $listediffusion['Listediffusion']['NOM'];
                $gestionnaire = $listediffusion['Listediffusion']['utilisateur_id'];                
                $ObjEntites = new EntitesController();
                $mailto = $ObjEntites->get_contact();
                $to = explode(';',$mailto);     
            endif;
            if(!empty($utiliseoutil['Utiliseoutil']['dossierpartage_id']) && $utiliseoutil['Utiliseoutil']['dossierpartage_id']!=null):
                $dossierpartage = $this->Utiliseoutil->Dossierpartage->find('first',array('conditions'=>array('Dossierpartage.id'=>$utiliseoutil['Utiliseoutil']['dossierpartage_id'])));
                $nom = $dossierpartage['Dossierpartage']['NOM'].' groupe : '.$dossierpartage['Dossierpartage']['GROUPEAD'];
                $gestionnaire = $dossierpartage['Dossierpartage']['utilisateur_id'];                 
                $ObjEntites = new EntitesController();
                $mailto = $ObjEntites->get_contact();
                $to = explode(';',$mailto);               
            endif;     
            $domaine = $this->Utiliseoutil->Utilisateur->Domaine->find('first',array('conditions'=>array('Domaine.id'=>$utiliseoutil['Utilisateur']['domaine_id']),'recursive'=>-1));
            $section = $this->Utiliseoutil->Utilisateur->Section->find('first',array('conditions'=>array('Section.id'=>$utiliseoutil['Utilisateur']['section_id']),'recursive'=>-1));
            $site = $this->Utiliseoutil->Utilisateur->Site->find('first',array('conditions'=>array('Site.id'=>$utiliseoutil['Utilisateur']['site_id']),'recursive'=>-1));
            $from = Configure::read('mailapp');
            $email = isset($utiliseoutil['Utilisateur']['MAIL']) ? $utiliseoutil['Utilisateur']['MAIL'] : "Demandez un complément d'information à l'émetteur de cette demande";
            $domaine = isset($domaine['Domaine']['NOM']) ? $domaine['Domaine']['NOM'] : "Demandez un complément d'information à l'émetteur de cette demande";
            $objet = 'SAILL : //!\ URGENT RELANCE : Demande d\'intervention pour ['.$nom.']';
            $message = "URGENT RELANCE : Demande d'intervention pour : ";
            $url = FULL_BASE_URL.$this->params->base.'/utiliseoutils/mailprogressstate/'.$utiliseoutil['Utiliseoutil']['id']."/".$gestionnaire;
            $etat = $utiliseoutil['Utiliseoutil']['STATUT'];
            $message .= $message.'<ul>
                    <li>Outil :'.$nom.'</li>
                    <li>Etat :'.$etat.'</li>
                    <li>Agent :'.$utiliseoutil['Utilisateur']['NOMLONG'].'</li>
                    <li>Identifiant :'.$utiliseoutil['Utilisateur']['username'].'</li>
                    <li>Email :'.$email.'</li>
                    <li>Domaine :'.$domaine.'</li>
                    <li>Section :'.$section['Section']['NOM'].'</li>
                    <li>Localisation :'.$site['Site']['NOM'].'</li>   
                    <li>Groupe Caliber :</li>  
                    </ul><br>Merci de cliquer sur le lien ci-dessous, pour mettre à jour l\'avancement de la demande.<br>'.$url;
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
            $this->History->notmove();
        }      
        
        public function add_template(){
            $this->autoRender = false;
            $utilisateur_id = $this->request->data['Utiliseoutil']['utilisateur_id'];
            $ObjEntites = new EntitesController();             
            $outils = $ObjEntites->get_templateoutils(userAuth('entite_id'));
            $outils = explode(',',$outils);
            $groups = $ObjEntites->get_templategroup(userAuth('entite_id'));
            $groups = explode(',',$groups);
            foreach($outils as $outil):
                $this->save_new($utilisateur_id, $outil, 'outil');
            endforeach;
            foreach($groups as $group):
                $this->save_new($utilisateur_id, $group, 'group');
            endforeach;            
            $this->History->goBack(1);
        }
        
        public function ajax_addtemplate($id){
            $this->autoRender = false;
            $utilisateur_id = $id;
            $ObjEntites = new EntitesController();             
            $outils = $ObjEntites->get_templateoutils(userAuth('entite_id'));
            $outils = $outils!='' ? explode(',',$outils) : array();
            $groups = $ObjEntites->get_templategroup(userAuth('entite_id'));
            $groups = $groups!='' ? explode(',',$groups) : array();
            foreach($outils as $outil):
                $this->save_new($utilisateur_id, $outil, 'outil');
            endforeach;
            foreach($groups as $group):
                $this->save_new($utilisateur_id, $group, 'group');
            endforeach;            
            $this->History->goBack(1);
        }
               
        public function get_list($id){
            $options = array('Utiliseoutil.utilisateur_id' => $id);
            return $this->Utiliseoutil->find('list',array('fields' => array('id','outil_id','Outil.NOM','listediffusion_id','Listediffusion.NOM','dossierpartage_id','Dossierpartage.NOM'),'conditions' =>$options,'order'=>array('Outil.NOM'=>'asc','Listediffusion.NOM'=>'asc','Dossierpartage.NOM'=>'asc'),'recursive'=>0));
        }
        
        public function get_all($id){
            $options =array('Utiliseoutil.utilisateur_id' => $id);
            return $this->Utiliseoutil->find('all',array('order'=>array('Outil.NOM'=>'asc','Listediffusion.NOM'=>'asc','Dossierpartage.NOM'=>'asc'),'conditions' =>$options,'recursive'=>0));
        }   
        
        public function get_compteur($id){
            $options =array('Utiliseoutil.utilisateur_id' => $id);
            return $this->Utiliseoutil->find('first',array('fields'=>array('count(outil_id) AS nboutil', 'count(listediffusion_id) AS nbliste', 'count(dossierpartage_id) AS nbpartage'),'conditions' =>$options,'recursive'=>0));
        }
}
