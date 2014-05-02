<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoprojetentites');
App::import('Controller', 'Projets');
/**
 * Activites Controller
 *
 * @property Activite $Activite
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class ActivitesController extends AppController {
        public $components = array('History','Common');
        public $paginate = array(
        'limit' => 25,
        'order' => array('Projet.NOM'=>'asc','Activite.NOM' => 'asc'),
        );
               
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Activités" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }           
        
    /**
     * Méthode permettant d'autoriser l'appel de certaines méthodes sans authentification
     */
    public function beforeFilter() {   
        $this->Auth->allow(array('json_all_activite'));
        parent::beforeFilter();
    }   

    /**
     * Méthode permettant de limiter la visibilité de l'utilisateur en fonction de son profil
     * 
     * @return string
     */
    public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:
            $ObjAssoprojetentites = new AssoprojetentitesController();                
            return $ObjAssoprojetentites->json_get_all_projets(userAuth('id'));
        endif;
    }

    /**
     * Méthode limitant les conditions de visibilité par projet
     * 
     * @param string $visibility
     * @return string
     */
    public function get_restriction($visibility){
        if($visibility == null): // && $visibility != ''):
            return '1=1';
        elseif ($visibility!=''):
            return array("Projet.id IN (".$visibility.')');
        /*else:
            return array();*/
        endif;
    }      

    /**
     * Méthode limitant la liste des activités en fonction de l'état
     * 
     * @param string $filtreEtat
     * @return array('condition'=>"",'filter'=>"")
     */
    public function get_activite_etat_filter($filtreEtat){
        $result = array();
        switch ($filtreEtat){
            case 'tous':
                $result['condition']="1=1";
                $result['filter'] = "toutes les activités";
                break;
            case 'actif':
            case null:                         
                $result['condition']="Activite.ACTIVE=1";
                $result['filter'] = "toutes les activités actives";
                break;  
            case 'inactif':
                $result['condition']="Activite.ACTIVE=0";
                $result['filter'] = "toutes les activités inactives";
                break;                                         
        }  
        return $result;
    }

    /**
     * Méthode limitant la liste des activités en fonction du filtre
     * 
     * @param string $filtre
     * @param string $visibility
     * @return array('condition'=>"",'filter'=>"")
     */
    public function get_activite_filtre_filter($filtre,$visibility){
        $result = array();
        //debug($filtre);exit();
        switch ($filtre){
            case 'tous':
            case null:  
                if($visibility == null) : // && $visibility != ''):
                    $result['condition'] = '1=1';
                elseif ($visibility!=''):
                    $result['condition'] = "Activite.projet_id IN (".$visibility.")";
                else:
                    $result['condition'] = 'Activite.projet_id IN (0)';
                endif;                    
                $result['filter'] = "tous les projets";
                break;
            case 'autres':
                if($visibility == null):
                    $result['condition'] = 'Activite.projet_id != 1';
                elseif ($visibility!=''):
                    $visibility = strlen ($visibility) == 1 ? '0' : substr_replace($visibility ,"",0,2);
                    $result['condition'] = "Activite.projet_id IN (".$visibility.")";
                else:
                    $result['condition'] = 'Activite.projet_id IN (0)';
                endif;                        
                $result['filter'] = "tous les projets autres que indisponibilité";
                break;                    
            default :
                $result['condition']="Projet.id='".$filtre."'";
                $projet = $this->Activite->Projet->find('first',array('fields'=>array('Projet.NOM'),'recusrsive'=>0,'conditions'=>array('Projet.id'=>$filtre)));
                $result['filter'] = "le projet ".$projet['Projet']['NOM'];
                break;                      
        }
        return $result;
    }

    /**
     * Méthode pour mettre en session les valeurs pour générer l'export
     * 
     * @param array $condition
     */
    public function get_export($condition){
        $this->Session->delete('xls_export');
        $export = $this->Activite->find('all',array('conditions'=>$condition,'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'recursive'=>0));
        $this->Session->write('xls_export',$export); 
    }

    /**
     * Méthode remontant l'historique du budget de l'activité
     * 
     * @param int $id
     * @return Historybudgets
     */
    public function get_history($id){
        return $this->Activite->Historybudget->find('all',array('conditions'=>array('activite_id'=>$id),'recursive'=>-1,'order'=>array('ANNEE'=>'desc','Historybudget.created'=>'desc')));
    }

    /**
     * Méthode pour lister les activités
     * 
     * @param string $filtreEtat
     * @param string $filtre
     * @throws UnauthorizedException
     * @return Activites
     */
    public function index($filtreEtat=null,$filtre=null) {
        $this->set_title();
        if (isAuthorized('activites', 'index')) :
            $listprojets = $this->get_visibility();
            $getfiltre = $this->get_activite_filtre_filter($filtre, $listprojets);
            $getetat = $this->get_activite_etat_filter($filtreEtat);
            $restriction = $this->get_restriction($listprojets);
            $this->set('fprojet',$getfiltre['filter']); 
            $this->set('fetat',$getetat['filter']); 
            $newconditions = array($getfiltre['condition'],$getetat['condition'],$restriction);
            $ObjProjets = new ProjetsController();
            $projets = $ObjProjets->find_all_cercle_projet(userAuth('id'));
            $this->set('projets',$projets);  
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));                
            $this->set('activites', $this->paginate());
            $this->get_export($newconditions);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");           
        endif;                
    }

    /**
     * Méthode pour ajouter une activité
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        $this->set_title();
        if (isAuthorized('activites', 'add')) :               
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Activite->validate = array();
                    $this->History->goBack(1);
                else:                    
                    $this->Activite->create();
                    if ($this->Activite->save($this->request->data)) {
                            $this->Session->setFlash(__('Activité sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Activité incorrecte, veuillez corriger l\'activité',true),'flash_failure');
                    }
               endif;
            endif;
            $ObjProjets = new ProjetsController();
            $projets = $ObjProjets->find_list_cercle_projet(userAuth('id'));
            $this->set('projets',$projets);                
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");    
        endif;                
    }

    /**
     * Méthode pour modifier une activité
     * 
     * @param int $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        $this->set_title();
        if (isAuthorized('activites', 'edit')) :             
            if (!$this->Activite->exists($id)) {
                    throw new NotFoundException(__('Activité incorrecte'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Activite->validate = array();
                    $this->History->goBack(1);
                else:                     
                    if ($this->Activite->save($this->request->data)) {
                            $this->Session->setFlash(__('Activité sauvegardée',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Activité incorrecte, veuillez corriger l\'activité',true),'flash_failure');
                    }
                endif;
            } else {                    
                $options = array('conditions' => array('Activite.' . $this->Activite->primaryKey => $id),'recursive'=>0);
                $this->request->data = $this->Activite->find('first', $options);
                $ObjProjets = new ProjetsController();                    
                $projets = $ObjProjets->find_list_cercle_projet(userAuth('id')); 
                $historybudgets = $this->get_history($id);
                $this->set(compact('historybudgets','projets'));                           
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");        
        endif;                
    }

    /**
     * Méthode pour supprimer une activité
     * 
     * @param int $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        $this->set_title();
        if (isAuthorized('activites', 'delete')) :
            $this->Activite->id = $id;
            if (!$this->Activite->exists()) {
                    throw new NotFoundException(__('Activité incorrecte'));
            }
            if ($this->Activite->delete()) {
                    $this->Session->setFlash(__('Activité supprimée',true),'flash_success');
                    $this->History->goBack(1);
            }
            $this->Session->setFlash(__('Activité <b>NON</b> supprimée',true),'flash_failure');
            $this->History->goBack(1);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");         
        endif;                
    }


    /**
     * Méthode pour la recherche d'activité
     * 
     * @param string $filtreEtat
     * @param string $filtre
     * @param string $keywords
     * @throws UnauthorizedException
     * @return Activites
     */
    public function search($filtreEtat=null,$filtre=null,$keywords=null) {
        $this->set_title();
        if (isAuthorized('activites', 'index')) :
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
                $listprojets = $this->get_visibility();
                $restriction = $this->get_restriction($listprojets);
                $getfiltre = $this->get_activite_filtre_filter($filtre, $listprojets);
                $getetat = $this->get_activite_etat_filter($filtreEtat);
                $this->set('fprojet',$getfiltre['filter']); 
                $this->set('fetat',$getetat['filter']);
                $ObjProjets = new ProjetsController();        
                $projets = $ObjProjets->find_all_cercle_projet(userAuth('id'));
                $this->set('projets',$projets);                      
                $newconditions = array($getfiltre['condition'],$getetat['condition'],$restriction);
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Activite.NOM LIKE '%".$value."%'","Projet.NOM LIKE '%".$value."%'","Activite.NUMEROGALLILIE LIKE '%".$value."%'","Activite.DESCRIPTION LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newconditions,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                
                $this->set('activites', $this->paginate());
                $this->get_export($conditions);                
            else:
                $this->redirect(array('action'=>'index',$filtreEtat,$filtre));
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");            
        endif;               
    }   

    /**
     * Méthode pour générer l'export à  partir des données de la variable de session xls_export
     */
    function export_xls() {
            $data = $this->Session->read('xls_export');
            $this->set('rows',$data);
            $this->render('export_xls','export_xls');
    }  

    /**
     * Méthode pour sauvegarder l'historisation du budget
     */
    public function savehistory(){
        $this->Session->write('test',$this->request->data['HistoryBudget'][0]['ANNEE']);
        exit();
    }

    /**
     * Méthode pour remonter l'identifiant d'une activité en fonction de son nom
     * 
     * @param string $nom
     * @return int
     */
    function getId($nom){
        $result = $this->Activite->find('first',array('fields'=>array('id'),'conditions'=>array('NOM'=>$nom),'recursive'=>-1));
        return $result;
        exit();
    }

    /**
     * Méthode pour modifiant le champs ACTIVE de toutes les activités d'un projet
     * 
     * @param int $projet_id
     * @param boolean $actif
     */
    public function set_actif($projet_id=null,$actif=0){
        $objs = $this->Activite->find('all',array('fields'=>array('Activite.id'),'conditions'=>array('Activite.projet_id'=>$projet_id),'recursive'=>0));
        foreach($objs as $obj):
            $this->set_this_actif($obj['Activite']['id'],intval($actif));
        endforeach;
    }    

    /**
     * Méthode modifiant le champs ACTIVE d'une activité
     * 
     * @param int $id
     * @param boolean $actif
     */
    public function set_this_actif($id=null,$actif=0){
        $this->Activite->id = $id;
        $this->Activite->saveField('ACTIVE', intval($actif));
    }      

    /**
     * Méthode remontant les activités sans les indisponibilités pour un utilisateur
     * 
     * @param int $utilisateur_id
     * @return Activites
     */
    public function find_all_cercle_activite($utilisateur_id){
        $listprojets = $this->get_visibility();
        $conditions[]= array('Activite.projet_id > 1');
        if($listprojets != ''):
            $conditions[]=array('Activite.projet_id IN ('.$listprojets.')');
        endif;
        $order[]=array('Projet.NOM'=>'asc');
        $order[]=array('Activite.NOM'=>'asc');
        $list = $this->Activite->find('all',array('order'=>$order,'conditions'=>$conditions,'recursive'=>1));
        return $list;
    }

    /**
     * Méthode remontant les activités avec les indisponibilités pour un utilisateur
     * 
     * @param int $utilisateur_id
     * @return Activites
     */    
    public function find_all_cercle_activite_and_indisponibility($utilisateur_id){
        $listprojets = $this->get_visibility();
        $conditions[]= array('Activite.projet_id > 0');
        if ($listprojets == null):
            $conditions[]="1=1";  
        elseif($listprojets != ''):
            $conditions[]=array('Activite.projet_id IN (1,'.$listprojets.')');
        else:                
            $conditions[]= array('Activite.projet_id = 1');
        endif;
        $order[]=array('Projet.NOM'=>'asc');
        $order[]=array('Activite.NOM'=>'asc');
        $list = $this->Activite->find('all',array('order'=>$order,'conditions'=>$conditions,'recursive'=>1));
        return $list;
    }        

    /**
     * Méthode remontant les activités avec les indisponibilités juste en se limitant à la visibilité
     * 
     * @param int $utilisateur_id
     * @return Activites
     */    
    public function get_all_activite(){
        $listprojets = $this->get_visibility();
        $conditions[]= array('Activite.projet_id > 0');
        if ($listprojets == null):
            $conditions[]="1=1";  
        elseif($listprojets != ''):
            $conditions[]=array('Activite.projet_id IN (1,'.$listprojets.')');     
        else:                
            $conditions[]= array('Activite.projet_id = 1');
        endif;
        $order[]=array('Projet.NOM'=>'asc');
        $order[]=array('Activite.NOM'=>'asc');
        $fields = array('Projet.NOM','Activite.NOM','Activite.id');
        $list = $this->Activite->find('all',array('order'=>$order,'conditions'=>$conditions,'recursive'=>1));
        return $list;
    }       

    /**
     * Méthode remontant les activités avec les indisponibilités pour un utilisateur
     * 
     * @param int $utilisateur_id
     * @return json d'une liste d'activites
     */    
    public function json_all_activite(){
        $this->autoRender = false;
        $listprojets = $this->get_visibility();
        $conditions[]= array('Activite.projet_id > 0');
        if ($listprojets == null):
            $conditions[]="1=1";
        elseif($listprojets != ''):
            $conditions[]=array('Activite.projet_id IN (1,'.$listprojets.')');  
        else:                
            $conditions[]= array('Activite.projet_id = 1');
        endif;
        $order=array('CONCAT(Projet.NOM," - ",Activite.NOM)'=>'asc');
        $fields = array('CONCAT(Projet.NOM," - ",Activite.NOM) AS ACTIVITE','Activite.id');
        $list = $this->Activite->find('all',array('fields'=>$fields,'order'=>$order,'conditions'=>$conditions,'recursive'=>0));
        $result=array();
        foreach($list as $obj):
            $result[$obj[0]['ACTIVITE']] = $obj['Activite']['id'];
        endforeach;
        return json_encode($result);
    }           

    /**
     * Méthode remontant les identifiants des activités sans les indisponibilités pour un utilisateur
     * 
     * @param int $utilisateur_id
     * @return string 
     */    
    public function find_str_id_cercle_activite($utilisateur_id){
        $ObjAssoprojetentites = new AssoprojetentitesController();	            
        $listprojets = $ObjAssoprojetentites->json_get_all_projets($utilisateur_id);
        if($listprojets != '0' && $listprojets != ''):
            $conditions = array();
            $conditions[]= array('Activite.projet_id>1');
            $conditions[]=array('Activite.projet_id IN ('.$listprojets.')');
            $objs = $this->Activite->find('all',array('conditions'=>$conditions,'recursive'=>1));
            $list = '';
            if(count($objs) > 0):
                foreach($objs as $obj):
                    $list .= $obj['Activite']['id'].",";
                endforeach;
                return substr_replace($list ,"",-1);
            else:
                return '0';
            endif;
        else:
            return '0';
        endif;           
    }        
}
