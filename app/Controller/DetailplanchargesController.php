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
            if (isAuthorized('plancharges', 'index')) :
                $this->set('title_for_layout','Plan de charge');             
		$this->Detailplancharge->recursive = 0;
		$this->set('detailplancharges', $this->paginate());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();            
            endif;  
        }

/**
 * add method
 *
 * @return void
 */
	public function add($id=null) {
            if (isAuthorized('plancharges', 'add')) :              
                        $plancharge = $this->Detailplancharge->Plancharge->find('first',array('conditions'=>array('Plancharge.id'=>$id),'recursive'=>-1));
                        $this->set('annee',$plancharge['Plancharge']['ANNEE']);
                        $this->set('title_for_layout','Plan de charge');  
                        $utilisateurs = array();
                        $dsit = array('-1'=>'Ressource DSI-T');
                        $reserve = array('-2'=>'Réserve');
                        $autreressource = array('-3'=> 'Ressource à prévoir');                
                        $utilisateursrequest = $this->Detailplancharge->Utilisateur->find('list',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.profil_id'=>-1)),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
                        $utilisateurs = $dsit+$reserve+$autreressource+$utilisateursrequest;
                        $this->set('utilisateurs',$utilisateurs);
                        $domaines = $this->Detailplancharge->Domaine->find('list',array('fields'=>array('Domaine.id','Domaine.NOM'),'order'=>array('Domaine.NOM'=>'asc')));
                        $this->set('domaines',$domaines);
                        $projets = $this->getAllProjetsForContrat($plancharge['Plancharge']['contrat_id']);
                        $activites = $this->Detailplancharge->Activite->find('all',array('fields'=>array('Activite.id','Projet.NOM','Activite.NOM'),'conditions'=>array('Activite.ACTIVE'=>1,'Activite.projet_id in ('.$projets.')'),'order'=>array('Activite.NOM'=>'asc'),'recursive'=>0));
                        $this->set('activites',$activites);    
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
            if (isAuthorized('plancharges', 'edit')) :                  
                        $this->set('title_for_layout','Plan de charge'); 
                        $plancharge = $this->Detailplancharge->Plancharge->find('first',array('conditions'=>array('Plancharge.id'=>$id),'recursive'=>-1));
                        $this->set('annee',$plancharge['Plancharge']['ANNEE']); 
                        $utilisateurs = array();
                        $dsit = array('-1'=>'Ressource DSI-T');
                        $reserve = array('-2'=>'Réserve');
                        $autreressource = array('-3'=> 'Ressource à prévoir');                
                        $utilisateursrequest = $this->Detailplancharge->Utilisateur->find('list',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.profil_id'=>-1)),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
                        $utilisateurs = $dsit+$reserve+$autreressource+$utilisateursrequest;
                        $this->set('utilisateurs',$utilisateurs);
                        $domaines = $this->Detailplancharge->Domaine->find('list',array('fields'=>array('Domaine.id','Domaine.NOM'),'order'=>array('Domaine.NOM'=>'asc')));
                        $this->set('domaines',$domaines);
                        $projets = $this->getAllProjetsForContrat($plancharge['Plancharge']['contrat_id']);
                        $activites = $this->Detailplancharge->Activite->find('all',array('fields'=>array('Activite.id','Projet.NOM','Activite.NOM'),'conditions'=>array('Activite.ACTIVE'=>1,'Activite.projet_id in ('.$projets.')'),'order'=>array('Activite.NOM'=>'asc'),'recursive'=>0));
                        $this->set('activites',$activites);                 
                        $newconditions = array('Detailplancharge.plancharge_id'=>$id);
                        $this->paginate = array('limit'=>$this->Detailplancharge->find('count'));    
                        $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));            
                        $this->Detailplancharge->recursive = 0;
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
        
/**
 * getAllProjetsForContrat method
 * 
 * @param type $id
 * @return array
 */        
        public function getAllProjetsForContrat($id=null){
            $result = '';
            $sql ="select id
                   from projets 
                   where projets.ACTIF = 1 AND projets.contrat_id = ".$id;
            $results = $this->Detailplancharge->query($sql);
            $countids = count($results);
            foreach($results as $projetid):
                $result .= $projetid['projets']['id'].",";
            endforeach;
            return substr($result, 0,-1);
        }       
}
