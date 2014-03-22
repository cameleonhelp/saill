<?php
App::uses('AppController', 'Controller');
/**
 * Detailplancharges Controller
 *
 * @property Detailplancharge $Detailplancharge
 */
class DetailplanchargesController extends AppController {
        public $components = array('History','Common');
/**
 * index method
 *
 * @return void
 */
	public function index($id=null) {
            $this->set('title_for_layout','Plan de charge');
            if (isAuthorized('plancharges', 'index')) :             
		$this->Detailplancharge->recursive = 0;
		$this->set('detailplancharges', $this->paginate());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();            
            endif;  
        }
        
        public function get_visibility($id){
            if(userAuth('profil_id')==1):
                return null;
            else:
                return $this->requestAction('assoentiteutilisateurs/json_get_all_users_entite/'.$id);
            endif;
        }
        
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
        
        public function get_plancharge($id){
            return $this->requestAction('plancharges/get_plancharge/'.$id);
        }

        public function get_all_plancharge_projet_acvtivite($contrat){
            $projets = $this->requestAction('projets/get_str_projets_for_contrat/'.$contrat);
            return $this->Detailplancharge->Activite->find('all',array('fields'=>array('Activite.id','Projet.NOM','Activite.NOM'),'conditions'=>array('Activite.ACTIVE'=>1,'Activite.projet_id in ('.$projets.')'),'order'=>array('Projet.NOM'=>"asc",'Activite.NOM'=>'asc'),'recursive'=>0));
        }
        
        
        
/**
 * add method
 *
 * @return void
 */
	public function add($id=null) {
            $this->set('title_for_layout','Plan de charge');
            if (isAuthorized('plancharges', 'add')) :       
                $plancharge = $this->get_plancharge($id);
                $visibility = $this->get_visibility($plancharge['Plancharge']['id']);
                $this->set('annee',$plancharge['Plancharge']['ANNEE']);
                $utilisateurs = $this->get_list_plancharge_ressources($visibility);
                $domaines = $this->requestAction('domaines/get_list');
                $activites = $this->get_all_plancharge_projet_acvtivite($plancharge['Plancharge']['contrat_id']);
                $this->set(compact('utilisateurs','domaines','activites'));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();            
            endif;  
        }
        
        public function save(){
                $this->set('title_for_layout','Plan de charge');            
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
                            if (is_array($detailplancharge) && $detailplancharge['utilisateur_id']!=''):
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
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
            $this->set('title_for_layout','Plan de charge');
            if (isAuthorized('plancharges', 'edit')) :                  
                $plancharge = $this->get_plancharge($id);
                $visibility = $this->get_visibility($plancharge['Plancharge']['id']);
                $this->set('annee',$plancharge['Plancharge']['ANNEE']);
                $utilisateurs = $this->get_list_plancharge_ressources($visibility);
                $domaines = $this->requestAction('domaines/get_list');
                $activites = $this->get_all_plancharge_projet_acvtivite($plancharge['Plancharge']['contrat_id']);
                $this->set(compact('utilisateurs','domaines','activites'));                 
                $newconditions = array('Detailplancharge.plancharge_id'=>$id);
                $this->paginate = array('limit'=>$this->Detailplancharge->find('count'));    
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));            
                $this->set('detailplancharges', $this->paginate());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();            
            endif;                   
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
            $this->Detailplancharge->id = $id;
            $this->Detailplancharge->delete();
	}        
}
