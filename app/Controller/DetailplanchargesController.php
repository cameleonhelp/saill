<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
App::import('Controller', 'Plancharges');
App::import('Controller', 'Projets');
App::import('Controller', 'Domaines');
/**
 * Detailplancharges Controller
 *
 * @property Detailplancharge $Detailplancharge
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class DetailplanchargesController extends AppController {
        public $components = array('History','Common');
        
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Plan de charges" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }              

    /**
     * liste le détail d'un plan de charge
     * 
     * @param string $id
     * @throws UnauthorizedException
     */
    public function index($id=null) {
        $this->set_title();
        if (isAuthorized('plancharges', 'index')) :             
            $this->Detailplancharge->recursive = 0;
            $this->set('detailplancharges', $this->paginate());
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");            
        endif;  
    }

    /**
     * retourne le périmétre de visibilité de l'utilisateur
     * 
     * @param type $id
     * @return null
     */
    public function get_visibility($id){
        if(userAuth('profil_id')==1):
            return null;
        else:
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            return $ObjAssoentiteutilisateurs->json_get_all_users_entite($id);
        endif;
    }

    /**
     * list les ressource qui sont affichées dans le détail du plan de charge
     * 
     * @param type $visibility
     * @return type
     */
    public function get_list_plancharge_ressources($visibility){
        $result = array();
        $dsit = array('-1'=>'Ressource DSI-T');
        $reserve = array('-2'=>'Réserve');
        $autreressource = array('-3'=> 'Ressource à prévoir');  
        if($visibility==null):
            $conditions = array('OR'=>array('Utilisateur.profil_id >0','Utilisateur.profil_id =-2','Utilisateur.profil_id =-1'),'Utilisateur.ACTIF'=>1);
        elseif($visibility !=''):
            $conditions = array('OR'=>array('Utilisateur.id IN ('.$visibility.')','Utilisateur.profil_id =-1'));
        else:
            $result = array('OR'=>array('Utilisateur.entite_id'=>userAuth('entite_id'),'Utilisateur.profil_id =-1'));
        endif;
        $result = $this->Detailplancharge->Utilisateur->find('list',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>$conditions,'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
        return $dsit+$reserve+$autreressource+$result;
    }

    /**
     * retourne le plan de charge
     * 
     * @param string $id
     * @return array
     */
    public function get_plancharge($id){
        $ObjPlancharges = new PlanchargesController();
        return $ObjPlancharges->get_plancharge($id);
    }

    /**
     * retourne les activités liées au contrat sur lequel porte le plan de charge
     * 
     * @param string $contrat
     * @return array
     */
    public function get_all_plancharge_projet_acvtivite($contrat){
        $ObjProjets = new ProjetsController();	
        $projets = $ObjProjets->get_str_projets_for_contrat($contrat);
        return $this->Detailplancharge->Activite->find('all',array('fields'=>array('Activite.id','Projet.NOM','Activite.NOM'),'conditions'=>array('Activite.ACTIVE'=>1,'Activite.projet_id in ('.$projets.')'),'order'=>array('Projet.NOM'=>"asc",'Activite.NOM'=>'asc'),'recursive'=>0));
    }
        
    /**
     * ajout au plan de charge
     * 
     * @param string $id
     * @throws UnauthorizedException
     */
    public function add($id=null) {
        $this->set_title();
        if (isAuthorized('plancharges', 'add')) :       
            $plancharge = $this->get_plancharge($id);
            $visibility = $this->get_visibility($plancharge['Plancharge']['id']);
            $this->set('annee',$plancharge['Plancharge']['ANNEE']);
            $utilisateurs = $this->get_list_plancharge_ressources($visibility);
            $ObjDomaines = new DomainesController();
            $domaines = $ObjDomaines->get_list();
            $activites = $this->get_all_plancharge_projet_acvtivite($plancharge['Plancharge']['contrat_id']);
            $this->set(compact('utilisateurs','domaines','activites'));
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");            
        endif;  
    }

    /**
     * sauvegarde les différentes lignes
     */
    public function save(){
            $this->set_title();            
            if ($this->request->is('post') || $this->request->is('put')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Detailplancharge->validate = array();
                    $this->redirect(array('controller'=>'plancharges','action' => 'index'));
                else:    
                    $detailplancharges = $this->request->data['Detailplancharge'];
                    if(isset($this->request->data['Detailplancharge'][0]['TODELETE'])):
                    /** recherche si lignes à supprimer **/
                    $ids = $this->request->data['Detailplancharge'][0]['TODELETE'];
                    $idarr = explode(',',$ids);
                    foreach($idarr as $id):
                        if($id != '') :
                            $this->Detailplancharge->id = $id;
                            $this->Detailplancharge->delete();
                        endif;
                    endforeach;
                    endif;
                    foreach($detailplancharges as $detailplancharge): 
                        if (is_array($detailplancharge) && (isset($detailplancharge['utilisateur_id']) && $detailplancharge['utilisateur_id']!='')):
                        $this->Detailplancharge->create();
                        if ($this->Detailplancharge->save($detailplancharge)) :
                                $this->Session->setFlash(__('Plan de charge sauvegardé',true),'flash_success');	
                        else :
                                $this->Session->setFlash(__('Plan de charge incorrect, veuillez corriger le plan de charge',true),'flash_failure');
                        endif;
                        endif;
                    endforeach;
                    /** sauvegarde de l'etp du plan de charge et du total de charge **/
                    $this->Detailplancharge->Plancharge->id = $detailplancharges[0]['plancharge_id'];
                    $this->Detailplancharge->Plancharge->saveField('ETP', $detailplancharges[0]['TOTALETP']);
                    $this->Detailplancharge->Plancharge->saveField('CHARGES', $detailplancharges[0]['TOTALCHARGE']);  
                endif;
            endif; 
            $this->redirect(array('controller'=>'plancharges','action' => 'index'));              
    }

    /**
     * modification du plan de charge
     * 
     * @param string $id
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        $this->set_title();
        if (isAuthorized('plancharges', 'edit')) :                  
            $plancharge = $this->get_plancharge($id);
            $visibility = $this->get_visibility($plancharge['Plancharge']['id']);
            $this->set('annee',$plancharge['Plancharge']['ANNEE']);
            $utilisateurs = $this->get_list_plancharge_ressources($visibility);
            $ObjDomaines = new DomainesController();
            $domaines = $ObjDomaines->get_list();
            $activites = $this->get_all_plancharge_projet_acvtivite($plancharge['Plancharge']['contrat_id']);
            $this->set(compact('utilisateurs','domaines','activites'));                 
            $newconditions = array('Detailplancharge.plancharge_id'=>$id);
            $this->paginate = array('limit'=>$this->Detailplancharge->find('count'));    
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));            
            $this->set('detailplancharges', $this->paginate());
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");            
        endif;                   
    }

    /**
     * supprime la ligne
     * 
     * @param string $id
     */
    public function delete($id = null) {
        $this->Detailplancharge->id = $id;
        $this->Detailplancharge->delete();
    }  
    
    /**
     * Supprime le détail en fonction d'un critère
     * 
     * @param mixed $conditions
     * @param type $cascade
     * @param type $callbacks
     */
    public function deleteAll(mixed $conditions, $cascade = true, $callbacks = false){
        $this->Detailplancharge->deleteAll($conditions, $cascade, $callbacks);
    }
}
