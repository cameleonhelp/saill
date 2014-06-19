<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
App::import('Controller', 'Utilisateurs');
App::import('Controller', 'Equipes');
/**
 * Livrables Controller
 *
 * @property Livrable $Livrable
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class LivrablesController extends AppController {
    /**
     * Variables globales utilisées au niveau du controller
     */
    public $components = array('History','Common'); 
    public $paginate = array(
        'limit' => 25,
        'order' => array('Livrable.NOM' => 'asc'),
        );
    
    /**
     * récupère le périmètre de visibilité de l'utilisateur
     * 
     * @return null
     */
    public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            return $ObjAssoentiteutilisateurs->json_get_all_users(userAuth('id'));  
        endif;
    }
    
    /**
     * limite la liste des livrables en fonction de la chronologie
     * 
     * @param string $id
     * @return string
     */
    public function get_livrable_chrono_filter($id){
        $result = array();
        switch ($id){
            case 'toutes':
            case null:  
            case '<':    
                $result['condition']="1=1";
                $result['filter'] = "tous les livrables";
                break;
            case 'previousweek':
                $date = new DateTime();
                $today = absstartWeek($date->sub(new DateInterval('P1W')));
                $previousWeek = absendWeek($date);
                $result['condition']="Livrable.ECHEANCE BETWEEN '".$today."' AND '".$previousWeek."'";
                $result['filter'] = "tous les livrables de la semaine précédente (entre le ".CFRDate($today)." et le ".CFRDate($previousWeek).")";
                break;  
            case 'week':
                $date = new DateTime();
                $today = absstartWeek($date);
                $previousWeek = absendWeek($date);
                $result['condition']="Livrable.ECHEANCE BETWEEN '".$today."' AND '".$previousWeek."'";            
                $result['filter'] = "tous les livrables de la semaine en cours (entre le ".CFRDate($today)." et le ".CFRDate($previousWeek).")";
                break;  
            case 'nextweek':
                $date = new DateTime();
                $today = absstartWeek($date->add(new DateInterval('P1W')));
                $previousWeek = absendWeek($date);
                $result['condition']="Livrable.ECHEANCE BETWEEN '".$today."' AND '".$previousWeek."'";                       
                $result['filter'] = "tous les livrables de la semaine suivante (entre le ".CFRDate($today)." et le ".CFRDate($previousWeek).")";
                break;  
            case 'tolate':
                $date = new DateTime();
                $previousWeek = absstartWeek($date->sub(new DateInterval('P1W')));
                $result['condition']="Livrable.ECHEANCE < '".$previousWeek."' OR (Livrable.DATELIVRAISON = 0000-00-00 OR Livrable.DATELIVRAISON = NULL OR Livrable.DATELIVRAISON < ".$previousWeek.")";
                $result['filter'] = "tous les livrables avec une échéance ou une date de livraison avant le ".CFRDate($previousWeek);
                break;  
            case 'otherweek':
                $date = new DateTime();
                $previousWeek = absendWeek($date->add(new DateInterval('P1W')));
                $result['condition']="Livrable.ECHEANCE >= '".$previousWeek."'";
                $result['filter'] = "tous les livrables avec une échéance après le ".CFRDate($previousWeek);
                break;                     
        }
        return $result;
    }
    
    /**
     * filtre la liste des livrable en fonction del'état
     * 
     * @param string $id
     * @return string
     */
    public function get_livrable_etat_filter($id){
        $result = array();
        switch ($id){
            case 'tous':
            case null:    
                $result['condition']="1=1";
                $result['filter'] = "sans condition sur les états";
                break;                      
            case 'todo':
                $result['condition']="Livrable.ETAT = 'à faire'";
                $result['filter'] = "dont l'état est 'à faire'";
                break;  
            case 'inmotion':
                $result['condition']="Livrable.ETAT = 'en cours'";
                $result['filter'] = "dont l'état est 'en cours'";
                break;  
            case 'delivered':
                $result['condition']="Livrable.ETAT = 'livré'";
                $result['filter'] = "dont l'état est 'livré'";
                break;  
            case 'validated':
                $result['condition']="Livrable.ETAT = 'validé'";
                $result['filter'] = "dont l'état est 'validé'";
                break;  
            case 'notvalidated':
                $result['condition']="Livrable.ETAT != 'validé'";
                $result['filter'] = "dont l'état est autre que 'validé'";
                break;                      
            }  
            return $result;
    }
    
    /**
     * filtre la liste des livrables en fonction du gestionnaire
     * 
     * @param string $id
     * @param string $visibility
     * @return string
     */
    public function get_livrable_gestionnaire_filter($id,$visibility){
        $result = array();
        $ObjEquipes = new EquipesController();
        if (areaIsVisible() || $id==userAuth('id')):
        switch ($id){
            case 'tous':   
                if($visibility == null):
                    $result['condition']='1=1';
                elseif ($visibility!=''):
                    $result['condition']="Livrable.utilisateur_id IN (".$visibility.")";
                else:
                    $result['condition']="Livrable.utilisateur_id =".userAuth('id');
                endif; 
                $result['filter'] = "de tous les gestionnaires";
                break;  
            case 'equipe':   
                $monequipe = $ObjEquipes->myTeam(userAuth('id')).userAuth('id');
                $result['condition']="Livrable.utilisateur_id in (".$monequipe.")";
                $result['filter'] = "de mon équipe";
                break;                      
            case null:   
                $result['condition']="Livrable.utilisateur_id = '".userAuth('id')."'";
                $this->Livrable->Utilisateur->recursive = -1;
                $nomlong = $this->Livrable->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array('Utilisateur.id'=> userAuth('id'))));
                $result['filter'] = "dont le gestionnaire est ".$nomlong['Utilisateur']['NOMLONG']; 
                break;                     
            default :
                $result['condition']="Livrable.utilisateur_id = '".$id."'";
                $this->Livrable->Utilisateur->recursive = -1;
                $nomlong = $this->Livrable->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array('Utilisateur.id'=> $id)));
                $result['filter'] = "dont le gestionnaire est ".$nomlong['Utilisateur']['NOMLONG'];                     
            }  
        else:
                $result['condition']="Livrable.utilisateur_id = '".userAuth('id')."'";
                $this->Livrable->Utilisateur->recursive = -1;
                $nomlong = $this->Livrable->Utilisateur->find('first',array('fields'=>array('NOMLONG'),'conditions'=>array('Utilisateur.id'=> userAuth('id'))));
                $result['filter'] = "dont le gestionnaire est ".$nomlong['Utilisateur']['NOMLONG'];                
        endif;   
        return $result;
    }
    
    /**
     * retourne la liste des gestionnaires
     * 
     * @param string $visibility
     * @return string
     */
    public function get_all_gestionnaire($visibility){
        if($visibility == null):
            return $this->Livrable->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.profil_id >1','Utilisateur.profil_id =-2')),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
        elseif ($visibility!=''):
            return $this->Livrable->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id IN ('.$visibility.')','Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.profil_id >1','Utilisateur.profil_id =-2')),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
        else:
            return $this->Livrable->Utilisateur->find('all',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id'=>  userAuth('id'),'Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.profil_id >1','Utilisateur.profil_id =-2')),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
        endif; 
    }
    
    /**
     * retourne la liste des gestionnaires
     * 
     * @param string $visibility
     * @return string
     */
    public function get_list_gestionnaire($visibility){
        if($visibility == null):
            return $this->Livrable->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.profil_id >1','Utilisateur.profil_id =-2')),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
        elseif ($visibility!=''):
            return $this->Livrable->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id IN ('.$visibility.')','Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.profil_id >1','Utilisateur.profil_id =-2')),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
        else:
            return $this->Livrable->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.id'=>  userAuth('id'),'Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.profil_id >1','Utilisateur.profil_id =-2')),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
        endif; 
    }
    
    /**
     * met en variable de session les données pour l'export
     * 
     * @param array $conditions
     */
    public function get_export($conditions){
        $this->Session->delete('xls_export');
        $export = $this->Livrable->find('all',array('conditions'=>$conditions,'order' => array('Livrable.NOM' => 'asc')));
        $this->Session->write('xls_export',$export);        
    }
    
    /**
     * renvois le suivi des livrables
     * 
     * @param string $id
     * @return string
     */
    public function get_all_suivi_livrable($id){
        return $this->Livrable->Suivilivrable->find('all',array('conditions'=>array('Suivilivrable.livrable_id'=>$id),'recursive'=>-1,'order'=>array('Suivilivrable.created'=>'desc','Suivilivrable.id'=>'desc')));
    }

    /**
     * renvois la liste des livrables
     * 
     * @param string $filtreChrono
     * @param string $filtreEtat
     * @param string $filtregestionnaire
     * @throws UnauthorizedException
     */
    public function index($filtreChrono=null,$filtreEtat=null,$filtregestionnaire=null) {  
        if (isAuthorized('livrables', 'index')) :
            $listusers = $this->get_visibility(); 
            $getchrono = $this->get_livrable_chrono_filter($filtreChrono);
            $getgestionnaire = $this->get_livrable_gestionnaire_filter($filtregestionnaire, $listusers);
            $getetat = $this->get_livrable_etat_filter($filtreEtat);
            $this->set('fchronologie',$getchrono['filter']);  
            $this->set('fetat',$getetat['filter']);                    
            $this->set('fgestionnaire',$getgestionnaire['filter']); 
            $newconditions = array($getchrono['condition'],$getetat['condition'],$getgestionnaire['condition']);
            $gestionnaires = $this->get_all_gestionnaire($listusers);
            $this->set(compact('gestionnaires'));                
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));                
            $this->set('livrables', $this->paginate());
            $this->get_export($newconditions);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * ajoute un livrable
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        if (isAuthorized('livrables', 'add')) :               
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Livrable->validate = array();
                    $this->History->goBack(1);
                else:                    
                    $this->Livrable->create();
                    if ($this->Livrable->save($this->request->data)) {
                            $this->Session->setFlash(__('Livrable sauvegardé',true),'flash_success');
                            $this->set_suivi_livrable($this->Livrable->getInsertID());
                            $action_id = $this->addnewaction($this->Livrable->getInsertID());
                            $this->redirect(array('controller'=>'actions','action'=>'edit',$action_id));
                    } else {
                            $this->Session->setFlash(__('Livrable incorrect, veuillez corriger le livrable',true),'flash_failure');
                    }
                endif;
            endif;                
            $etats = Configure::read('etatLivrable');
            $listusers = $this->get_visibility();
            $utilisateur = $this->get_list_gestionnaire($listusers);
            $ObjUtilisateurs = new UtilisateursController();
            $nomlong = $ObjUtilisateurs->get_nomlong(userAuth('id'));
            $this->set(compact('utilisateur','nomlong','etats'));
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * ajoute un suivi de livrable (historique)
     * 
     * @param string $id
     */
    public function set_suivi_livrable($id){
        $thisLivrable = $this->Livrable->find('first',array('conditions'=>array('Livrable.id'=>$id)));
        $suiviliv['Suivilivrable']['livrable_id']=$thisLivrable['Livrable']['id'];
        $suiviliv['Suivilivrable']['ECHEANCE']=$thisLivrable['Livrable']['ECHEANCE'];
        $suiviliv['Suivilivrable']['ETAT']=$thisLivrable['Livrable']['ETAT'];
        $suiviliv['Suivilivrable']['DATELIVRAISON']=$thisLivrable['Livrable']['DATELIVRAISON'];
        $suiviliv['Suivilivrable']['DATEVALIDATION']=$thisLivrable['Livrable']['DATEVALIDATION'];
        $this->Livrable->Suivilivrable->create();
        $this->Livrable->Suivilivrable->save($suiviliv);
    }

    /**
     * met à jour le livrable
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        if (isAuthorized('livrables', 'edit')) :               
            if (!$this->Livrable->exists($id)) {
                    throw new NotFoundException(__('Livrable incorrect',true),'flash_failure');
            }
            if ($this->request->is('post') || $this->request->is('put')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Livrable->validate = array();
                    $this->History->goBack(1);
                else:                    
                    if ($this->Livrable->save($this->request->data)) {
                            $this->Session->setFlash(__('Livrable sauvegardé',true),'flash_success');
                            $this->set_suivi_livrable($id);
                            $this->History->goFirst();
                    } else {
                            $this->Session->setFlash(__('Livrable incorrect, veuillez corriger le livrable',true),'flash_failure');
                    }
                endif;
            else :
                    $options = array('conditions' => array('Livrable.' . $this->Livrable->primaryKey => $id),'recursive'=>0);
                    $this->request->data = $this->Livrable->find('first', $options);
                    $etats = Configure::read('etatLivrable');
                    $listusers = $this->get_visibility();
                    $Suivilivrables = $this->get_all_suivi_livrable($id);
                    $utilisateur = $this->get_list_gestionnaire($listusers);
                    $ObjUtilisateurs = new UtilisateursController();
                    $nomlong = $ObjUtilisateurs->get_nomlong(userAuth('id'));
                    $this->set(compact('utilisateur','nomlong','etats','Suivilivrables'));                          
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * supprime le livrable
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        if (isAuthorized('livrables', 'delete')) :
            $this->Livrable->id = $id;
            if (!$this->Livrable->exists()) {
                    throw new NotFoundException(__('Livrable incorrect'));
            }
            //$this->request->onlyAllow('post', 'delete');
            if ($this->Livrable->delete()) {
                    $this->Session->setFlash(__('Livrable supprimé',true),'flash_success');
                    $this->History->goBack(1);
            }
            $this->Session->setFlash(__('Livrable <b>NON</b> supprimé',true),'flash_failure');
            $this->History->goBack(1);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * recherche de livrables
     * 
     * @param string $filtreChrono
     * @param string $filtreEtat
     * @param string $filtregestionnaire
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($filtreChrono=null,$filtreEtat=null,$filtregestionnaire=null,$keywords=null) {
        if (isAuthorized('livrables', 'index')) :
            if(isset($this->params->data['Activitesreelle']['SEARCH'])):
                $keywords = $this->params->data['Activitesreelle']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''): 
                $arkeywords = explode(' ',trim($keywords));     
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Livrable.NOM LIKE '%".$value."%'","Livrable.REFERENCE LIKE '%".$value."%'","Utilisateur.NOM LIKE '%".$value."%'","Utilisateur.PRENOM LIKE '%".$value."%'"));
                endforeach;
                $listusers = $this->get_visibility(); 
                $getchrono = $this->get_livrable_chrono_filter($filtreChrono);
                $getgestionnaire = $this->get_livrable_gestionnaire_filter($filtregestionnaire, $listusers);
                $getetat = $this->get_livrable_etat_filter($filtreEtat);
                $this->set('fchronologie',$getchrono['filter']);  
                $this->set('fetat',$getetat['filter']);                    
                $this->set('fgestionnaire',$getgestionnaire['filter']); 
                $newconditions = array($getchrono['condition'],$getetat['condition'],$getgestionnaire['condition']);
                $gestionnaires = $this->get_all_gestionnaire($listusers);
                $this->set(compact('gestionnaires'));                                
                $conditions = array($newconditions,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));          
                $this->set('livrables', $this->paginate());
                $this->get_export($conditions);                   
           else:
               $this->redirect(array('action'=>'index',$filtreChrono,$filtreEtat,$filtregestionnaire));
           endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }       

    /**
     * export au format Excel
     */
    function export_xls() {
            $data = $this->Session->read('xls_export');
            $this->Session->delete('xls_export');                
            $this->set('rows',$data);
            $this->render('export_xls','export_xls');
    }     

    /**
     * duplique le livrable
     * 
     * @param string $id
     * @throws UnauthorizedException
     */
    public function dupliquer($id = null) {
        if (isAuthorized('livrables', 'duplicate')) :
            $this->Livrable->id = $id;
            $record = $this->Livrable->read();
            unset($record['Livrable']['id']);
            $record['Livrable']['VERSION']=isset($record['Livrable']['VERSION']) && $record['Livrable']['VERSION']!='' ? $record['Livrable']['VERSION']+1 : 1;
            $record['Livrable']['ETAT']='à faire';
            unset($record['Livrable']['created']);                
            unset($record['Livrable']['modified']);
            unset($record['Suivilivrable']);
            $this->Livrable->create();
            if ($this->Livrable->save($record)) {
                    $this->Session->setFlash(__('Livrable dupliqué',true),'flash_success');
                    $this->History->goFirst();
            } 
            $this->Session->setFlash(__('Livrable <b>NON</b> dupliqué',true),'flash_failure');
            $this->History->goFirst();
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }  

    /**
     * statistique sur les livrables pour la page d'accueil
     * 
     * @return array
     */
    public function homeListeLivrables(){
        $listactions = $this->Livrable->find('all',array('conditions'=>array('utilisateur_id'=>userAuth('id'),'ETAT IN ("à faire","en cours","refusé")'),'order'=>array('ECHEANCE'=>'ASC'),'limit' => 5,'recursive'=>-1));
        return $listactions;
    }   

    /**
     * statistique sur les livrables pour la page d'accueil
     * 
     * @return array
     */
    public function homeNBAFAIRELivrables(){
        $nbactions = $this->Livrable->find('all',array('fields'=>array('COUNT(id) AS NB','ETAT'),'conditions'=>array('utilisateur_id'=>userAuth('id'),'ETAT'=>"à faire"),'group'=>'ETAT','recursive'=>-1));
        return $nbactions;
    }    

    /**
     * statistique sur les livrables pour la page d'accueil
     * 
     * @return array
     */
    public function homeNBENCOURSLivrables(){
        $nbactions = $this->Livrable->find('all',array('fields'=>array('COUNT(id) AS NB','ETAT'),'conditions'=>array('utilisateur_id'=>userAuth('id'),'ETAT'=>"en cours"),'group'=>'ETAT','recursive'=>-1));
        return $nbactions;
    }            

    /**
     * statistique sur les livrables pour la page d'accueil
     * 
     * @return array
     */
    public function homeNBRETARDLivrables(){
        $nbactions = $this->Livrable->find('all',array('fields'=>array('COUNT(id) AS NB','ETAT','ECHEANCE'),'conditions'=>array('utilisateur_id'=>userAuth('id'),'ETAT  IN ("à faire","en cours","refusé")',"ECHEANCE <"=>date('Y-m-d')),'group'=>'ETAT','recursive'=>-1));
        return $nbactions;
    }  

    /**
     * ajout d'une action pour le livrable
     * 
     * @param string $id
     * @return string
     */
    public function addnewaction($id){
        $date = new DateTime();
        $record['Action']['utilisateur_id']=  userAuth('id');
        $record['Action']['destinataire']=  userAuth('id');
        $record['Action']['domaine_id']=  7;
        $record['Action']['activite_id']=  16;
        $record['Action']['OBJET']=  'Création d\'un nouveau livrable';
        $record['Action']['AVANCEMENT']=  0;
        $record['Action']['COMMENTAIRE']=  '';
        $record['Action']['DEBUT']=  $date->format('d/m/Y');            
        $record['Action']['ECHEANCE']=  $date->add(new DateInterval('P5D'))->format('d/m/Y');
        $record['Action']['STATUT']=  'à faire';
        $record['Action']['DUREEPREVUE']=  0;
        $record['Action']['PRIORITE']=  'haute';
        $this->Livrable->Actionslivrable->Action->create();
        $this->Livrable->Actionslivrable->Action->save($record);
        $action_id = $this->Livrable->Actionslivrable->Action->getLastInsertID();
        $livrable['Actionslivrable']['livrable_id'] = $id;
        $livrable['Actionslivrable']['action_id'] = $action_id;
        $this->Livrable->Actionslivrable->create();
        $this->Livrable->Actionslivrable->save($livrable);            
        return $action_id;
    }          
}
