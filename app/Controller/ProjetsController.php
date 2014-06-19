<?php
App::uses('AppController', 'Controller');
App::import('Controller','Assoprojetentites');
App::import('Controller','Contrats');
App::import('Controller','Entites');
App::import('Controller','Activites');
/**
 * Projets Controller
 *
 * @property Projet $Projet
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class ProjetsController extends AppController {
    /**
     * variables globale utilisées au niveau du controller
     */
    public $components = array('History','Common');
    public $paginate = array(
    'limit' => 25,
    'order' => array('Projet.NOM' => 'asc'),
    'conditions' => array('Projet.id >' => 1),
    );

    /**
     * calcul le périmètre de visibilité de l'utilisateur
     * 
     * @return string
     */
    public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:
            $ObjAssoprojetentites = new AssoprojetentitesController();
            return $ObjAssoprojetentites->find_str_id_contrats(userAuth('id'));
        endif;
    }

    /**
     * renvois la liste des projets d'un contrat
     * 
     * @param type $contrat
     * @return type
     */
    public function get_all_projets_for_contrat($contrat){
        $condition[]="Projet.contrat_id=".$contrat;
        return $this->Projet->find('all',array('conditions'=>$condition,'reursive'=>-1));
    }

    /**
     * renvois la liste des projets pour un contrat (chaine)
     * 
     * @param type $contrat
     * @return type
     */
    public function get_str_projets_for_contrat($contrat){
        $projets = $this->get_all_projets_for_contrat($contrat);
        $list = "";
        foreach ($projets as $projet):
            $list .= $projet['Projet']['id'].',';
        endforeach;
        return strlen($list) > 1 ? substr_replace($list ,"",-1) : '0';
    }

    /**
     * filtre le périmétre de visibilité
     * 
     * @return string
     */
    public function get_restriction(){
        if($visibility == null):
            return '1=1';
        elseif ($visibility!=''):
            return '1=1';
        else:
            return '1=1';
        endif;
    }     

    /**
     * filtre les projets par contrat
     * 
     * @param string $filtreContrat
     * @param string $visibility
     * @return string
     */
    public function get_projet_contrat_filter($filtreContrat,$visibility){
        $result =array();
        switch ($filtreContrat){
            case 'tous':
            case null:
                if($visibility == null):
                   $result['condition']='1=1';
                elseif ($visibility!=''):
                    $result['condition']="Projet.contrat_id IN (".$visibility.")";
                else:
                    $result['condition']='Projet.contrat_id < 1';
                endif;                    
                $result['filter'] = "tous les contrats";
                break;
            default :
                $result['condition']="Contrat.id='".$filtreContrat."'";
                $contrat = $this->Projet->Contrat->find('first',array('conditions'=>array('Contrat.id'=>$filtreContrat),'recursive'=>0));
                $result['filter'] = "le contrat ".$contrat['Contrat']['NOM'];
                break;                      
        }  
        return $result;
    }

    /**
     * filtre les projets par état
     * 
     * @param string $filtreEtat
     * @return string
     */
    public function get_projet_etat_filter($filtreEtat){
        $result = array();
        switch ($filtreEtat){
            case 'tous':
                $result['condition']="1=1";
                $result['filter'] = "tous les projets";
                break;
            case 'actif':
            case null:                        
                $result['condition']="Projet.ACTIF=1";
                $result['filter'] = "tous les projets actifs";
                break;  
            case 'inactif':
                $result['condition']="Projet.ACTIF=0";
                $result['filter'] = "tous les projets inactifs";
                break;                                         
        }  
        return $result;
    }      

    /**
     * Export Excel
     * 
     * @param array $condition
     */
    public function get_export($condition){
        $this->Session->delete('xls_export');
        $export = $this->Projet->find('all',array('conditions'=>$condition,'order' => array('Projet.NOM' => 'asc'),'recursive'=>0));
        $this->Session->write('xls_export',$export); 
    }

    /**
     * liste les projets
     * 
     * @param string $filtreEtat
     * @param string $filtreContrat
     * @throws UnauthorizedException
     */
    public function index($filtreEtat=null,$filtreContrat=null) {
        if (isAuthorized('projets', 'index')) :
            $listcontrats = $this->get_visibility();
            $getetat = $this->get_projet_etat_filter($filtreEtat);
            $getcontrat = $this->get_projet_contrat_filter($filtreContrat,$listcontrats);
            $this->set('fcontrat',$getetat['filter']);
            $this->set('fetat',$getcontrat['filter']); 
            $ObjContrats = new ContratsController();
            $contrats = $ObjContrats->get_all();
            $this->set(compact('contrats'));
            $newconditions = array($getetat['condition'],$getcontrat['condition']);              
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));                
            $this->set('projets', $this->paginate());
            $this->get_export($newconditions);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * Ajoute un projet
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        if (isAuthorized('projets', 'add')) :
           if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Projet->validate = array();
                    $this->History->goBack(1);
                else:                     
                    $this->Projet->create();
                    if ($this->Projet->save($this->request->data)) {
                            $lastid = $this->Projet->getLastInsertID();
                            $entite_id = isset($this->request->data['Projet']['entite_id']) ? $this->request->data['Projet']['entite_id'] : userAuth('entite_id');
                            $ObjAssoprojetentites = new AssoprojetentitesController();
                            $ObjAssoprojetentites->silent_save($entite_id,$lastid);
                            $this->Session->setFlash(__('Projet sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Projet incorrect, veuillez corriger le projet',true),'flash_failure');
                    }
                endif;
            endif;
            $listcontrats = $this->get_visibility();
            $ObjContrats = new ContratsController();
            $contrats = $ObjContrats->get_list();
            $ObjEntites = new EntitesController();
            $cercles = $ObjEntites->find_list_cercle();
            $type = Configure::read('typeProjet');
            $facturation = Configure::read('factureProjet');
            $this->set(Compact('contrats','cercles','type','facturation'));                
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * met à jour le projet
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        if (isAuthorized('projets', 'edit')) :                  
            if (!$this->Projet->exists($id)) {
                    throw new NotFoundException(__('Projet incorrect'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Projet->validate = array();
                    $this->History->goBack(1);
                else:                     
                    if ($this->Projet->save($this->request->data)) {
                            $this->Projet->id = $id;
                            $obj = $this->Projet->read('ACTIF');   
                            if($obj['Projet']['ACTIF']==false):
                                $this->set_actif($this->request->data['Projet']['contrat_id'], 0,$id);
                            endif;
                            $this->Session->setFlash(__('Projet sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Projet incorrect, veuillez corriger le projet',true),'flash_failure');
                    }
                endif;
            } else {
                $options = array('conditions' => array('Projet.' . $this->Projet->primaryKey => $id),'recursive'=>0);
                $this->request->data = $this->Projet->find('first', $options);
                $listcontrats = $this->get_visibility();
                $ObjContrats = new ContratsController();
                $contrats = $ObjContrats->get_list();
                $ObjEntites = new EntitesController();
                $cercles = $ObjEntites->find_list_cercle();
                $type = Configure::read('typeProjet');
                $facturation = Configure::read('factureProjet');
                $this->set(Compact('contrats','cercles','type','facturation'));                        
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * supprime le projet
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null) {
        if (isAuthorized('projets', 'delete')) :
            $this->Projet->id = $id;
            if (!$this->Projet->exists()) {
                    throw new NotFoundException(__('Projet incorrect'));
            }
            //$this->request->onlyAllow('post', 'delete');
            if ($this->Projet->delete()) {
                    $this->Session->setFlash(__('Projet supprimé',true),'flash_success');
                    $this->History->goBack(1);
            }
            $this->Session->setFlash(__('Projet <b>NON</b> supprimé',true),'flash_failure');
            $this->History->goBack(1);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }

    /**
     * recherche de projets
     * 
     * @param string $filtreEtat
     * @param string $filtreContrat
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($filtreEtat=null,$filtreContrat=null,$keywords=null) {
        if (isAuthorized('projets', 'index')) :
            if(isset($this->params->data['Projet']['SEARCH'])):
                $keywords = $this->params->data['Projet']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $arkeywords = explode(' ',trim($keywords)); 
                $listcontrats = $this->get_visibility();
                $getetat = $this->get_projet_etat_filter($filtreEtat);
                $getcontrat = $this->get_projet_contrat_filter($filtreContrat,$listcontrats);
                $this->set('fcontrat',$getetat['filter']);
                $this->set('fetat',$getcontrat['filter']); 
                $ObjContrats = new ContratsController();
                $contrats = $ObjContrats->get_all();
                $this->set(compact('contrats'));
                $newconditions = array($getetat['condition'],$getcontrat['condition']);              
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Projet.NOM LIKE '%".$value."%'","Contrat.NOM LIKE '%".$value."%'","Projet.NUMEROGALLILIE LIKE '%".$value."%'","Projet.COMMENTAIRE LIKE '%".$value."%'"));
                endforeach;
                $conditions = array($newconditions,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                
                $this->set('projets', $this->paginate());
                $this->get_export($conditions);                                          
            else:
                $this->redirect(array('action'=>'index',$filtreEtat,$filtreContrat));
            endif;   
            $keyword=isset($this->params->data['Projet']['SEARCH']) ? $this->params->data['Projet']['SEARCH'] : ''; 
            $newconditions = array('OR'=>array("Projet.NOM LIKE '%".$keyword."%'","Contrat.NOM LIKE '%".$keyword."%'","Projet.NUMEROGALLILIE LIKE '%".$keyword."%'","Projet.COMMENTAIRE LIKE '%".$keyword."%'"));
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
            $this->autoRender = false;
            $this->Projet->recursive = 0;
            $this->set('utilisateurs', $this->paginate());
            $this->Session->delete('xls_export');
            $export = $this->Projet->find('all',array('conditions'=>$newconditions));
            $this->Session->write('xls_export',$export);                
            $contrats = $this->Projet->Contrat->find('all',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Contrat.id>1','recursive'=>0));
            $this->set('contrats',$contrats);
            $this->render('index');
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }      

    /**
     * Export au format Excel
     */
    function export_xls() {
            $data = $this->Session->read('xls_export');
            $this->Session->delete('xls_export');                
            $this->set('rows',$data);
            $this->render('export_xls','export_xls');
    }    

    /**
     * renvois la liste des projets actifs pour les selects
     * 
     * @return array
     */
    public function get_select_actif(){
        $conditions[] = array('Projet.ACTIF'=>1);
        $list = $this->Projet->find('list',array('fields'=>array('Projet.id','Projet.NOM'),'conditions'=>$conditions,'order'=>array('Projet.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }     

    /**
     * renvois la liste de tous les projets
     * 
     * @return array
     */
    public function get_list_projet(){
        $conditions[] = "Projet.id=1";
        $list = $this->Projet->find('list',array('fields'=>array('id'),'conditions'=>$conditions,'recursive'=>0));
        return $list;
    }    

    /**
     * renvois la liste des projets pour les selects
     * 
     * @param string $str
     * @return array
     */
    public function get_list_id_nom_projets($str=null){
        $str = $str == null ? '0' : $str;
        $conditions[] = "Projet.id IN (".$str.")";
        $list = $this->Projet->find('list',array('fields'=>array('id','NOM'),'conditions'=>$conditions,'order'=>array('Projet.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }            

    /**
     * renvois la liste des projets actifs
     * 
     * @return array
     */
    public function get_list_actif(){
        $conditions[] = array('Projet.ACTIF'=>1);
        $list = $this->Projet->find('all',array('fields'=>array('Projet.id','Projet.NOM'),'conditions'=>$conditions,'order'=>array('Projet.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }     

    /**
     * modifie le statut actif en fonction du statut du contrat
     * 
     * @param string $contrat_id
     * @param string $actif
     * @param string $id
     */
    public function set_actif($contrat_id=null,$actif = 0,$id = null){ 
        if ($id != null):
            $projets = $this->Projet->find('all',array('fields'=>array('Projet.id'),'conditions'=>array('Projet.contrat_id'=>$contrat_id,'Projet.id'=>$id),'recursive'=>0));      
        else:
            $projets = $this->Projet->find('all',array('fields'=>array('Projet.id'),'conditions'=>array('Projet.contrat_id'=>$contrat_id),'recursive'=>0)); 
        endif;
        foreach($projets as $projet):
            $this->set_this_actif($projet['Projet']['id'],intval($actif));
            $ObjActivites = new ActivitesController();
            $ObjActivites->set_actif($projet['Projet']['id'],$actif);
        endforeach;
    }          

    /**
     * met à jour le statut actif
     * 
     * @param string $id
     * @param booelean $actif
     */
    public function set_this_actif($id=null,$actif=0){
        $this->Projet->id = $id;
        $this->Projet->saveField('ACTIF', intval($actif));
    }

    /**
     * renvois la liste des activités des projets
     * 
     * @param string $ids
     * @return boolean
     */
    public function get_activities($ids=null){
        if($ids!=null):
            $list = '';
            $list_ids = is_array($ids) ? implode(',',$ids) : $ids;
            $conditions[]='Projet.id IN ('.$list_ids.')';
            $activities = $this->Projet->Activite->find('all',array('fields'=>'Activite.id','conditions'=>$conditions,'recursive'=>1));
            foreach ($activities as $activite):
                $list .= $activite['Activite']['id'].',';
            endforeach;
            return substr_replace($list ,"",-1);
        else:
            return false;
        endif;
    }

    /**
     * renvois la liste des projets du périmètre de visibilité
     * 
     * @return string
     */
    public function get_visibility_projet(){
        if(userAuth('profil_id')==1):
            return null;
        else:
            $ObjAssoprojetentites = new AssoprojetentitesController();
            return $ObjAssoprojetentites->json_get_all_projets(userAuth('id'));
        endif;
    }

    /**
     * 
     * @param type $visibility
     * @return string
     */
    public function get_restriction_projet($visibility){
        if($visibility == null):
            return '1=1';
        elseif ($visibility!=''):
            return array('Projet.id IN ('.$visibility.')');
        else:
            return '1=1';
        endif;
    }

    /**
     * renvois tous les projets actifs d'un utilisateur
     * 
     * @param string $utilisateur_id
     * @return array
     */
    public function find_all_cercle_projet($utilisateur_id){
        $listprojets = $this->get_visibility_projet();
        if($listprojets == null):
            $conditions[]=array('Projet.ACTIF'=>1);
            $order[]=array('Projet.NOM'=>'asc');
            $list = $this->Projet->find('all',array('order'=>$order,'conditions'=>$conditions,'recursive'=>1));
            return $list;
        elseif($listprojets != ''):
            $conditions[]=$this->get_restriction_projet($listprojets);
            $order[]=array('Projet.NOM'=>'asc');
            $list = $this->Projet->find('all',array('order'=>$order,'conditions'=>$conditions,'recursive'=>1));
            return $list;
        else:
            return array();
        endif;
    }    

    /**
     * renvois la liste des projets d'un utilisateur
     * 
     * @param string $utilisateur_id
     * @return array
     */
    public function find_list_cercle_projet($utilisateur_id){
        $listprojets = $this->get_visibility_projet();
        $conditions[]=$this->get_restriction_projet($listprojets);
        $order[]=array('Projet.NOM'=>'asc');
        $fields = array('Projet.id','Projet.NOM');
        $list = $this->Projet->find('list',array('fields'=>$fields,'order'=>$order,'conditions'=>$conditions,'recursive'=>1));
        return $list;
    }

    /**
     * renvois la liste des projet d'un contrat
     * 
     * @param string $contrat_id
     * @return string
     */
    public function find_str_projet_for_contrat($contrat_id){
        $results = $this->Projet->find('all',array('conditions'=>array('Projet.contrat_id'=>$contrat_id),'order'=>array('Projet.id'=>'asc'),'recursive'=>0));
        if($results!='null'):
            foreach ($results as $result):
                $list .= $result['Projet']['id'].',';
            endforeach;
            return strlen($list) > 1 ? substr_replace($list ,"",-1) : '0';
        else:
            return '0';
        endif;  
    } 
    
    /**
     * création forcé du projet lors de l'import s'il n'existe pas
     * 
     * @return int
     */
    public function import_add_forced(){
        $projet_id = $this->exist($nom,$ref);
        if($projet_id != false):
            $tmp = array();
            $objSociete = new SocietesController();
            $tmp['Projet']['contrat_id']=0; //forcé pour être lié sur le même contrat qui sera créé manuellement
            $tmp['Projet']['NOM ']=''; //récupéré à partir de l'import
            $tmp['Projet']['ACTIF']=1;
            $tmp['Projet']['NUMEROGALLILIE']=''; //récupéré à partir de l'import
            $tmp['Projet']['created']=date('Y-m-d');
            $tmp['Projet']['modified']=date('Y-m-d');
            $this->Projet->create();
            $this->Projet->save($tmp);
            return $this->Projet->getLastInsertID();
        else:
            return $projet_id;
        endif;
    }
    
    /**
     * recherche un projet par son nom et son numéro Galilei
     * 
     * @param string $nom
     * @param string $ref
     * @return int ou false
     */
    public function exist($nom,$ref){
        $conditions = array('Projet.NOM'=>$nom,'Projet.NUMEROGALLILIE'=>$ref);
        $obj = $this->Projet->find('first',array('conditions'=>$conditions));
        $exist = count($obj) > 0 ? $obj['Projet']['id'] : false;
        return $exist;
    }
    
    public function idgetbynom($nom){
        $this->autoRender = false;
        $obj = $this->Projet->findByNOM($nom);
        return $obj['Projet']['id'];
    }
}
