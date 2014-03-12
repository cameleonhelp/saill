<?php
App::uses('AppController', 'Controller');
/**
 * Projets Controller
 *
 * @property Projet $Projet
 */
class ProjetsController extends AppController {
        public $components = array('History','Common');
        public $paginate = array(
        'limit' => 25,
        'order' => array('Projet.NOM' => 'asc'),
        'conditions' => array('Projet.id >' => 1),
        //'group'=>array('Projet.contrat_id'),
        );
/**
 * index method
 *
 * @return void
 */
	public function index($filtreEtat=null,$filtreContrat=null) {
            //$this->Session->delete('history');
            $listcontrats = $this->requestAction('assoprojetentites/find_str_id_contrats/'.userAuth('id'));
            if (isAuthorized('projets', 'index')) :
                switch ($filtreContrat){
                    case 'tous':
                    case null:
                        $newconditions[]="Projet.contrat_id IN (".$listcontrats.")";
                        $fcontrat = "tous les contrats";
                        break;
                    default :
                        $newconditions[]="Contrat.id='".$filtreContrat."'";
                        $contrat = $this->Projet->Contrat->find('first',array('conditions'=>array('Contrat.id'=>$filtreContrat),'recursive'=>0));
                        $fcontrat = "le contrat ".$contrat['Contrat']['NOM'];
                        break;                      
                }  
                $this->set('fcontrat',$fcontrat);
                switch ($filtreEtat){
                    case 'tous':
                        $newconditions[]="1=1";
                        $fetat = "tous les projets";
                        break;
                    case 'actif':
                    case null:                        
                        $newconditions[]="Projet.ACTIF=1";
                        $fetat = "tous les projets actifs";
                        break;  
                    case 'inactif':
                        $newconditions[]="Projet.ACTIF=0";
                        $fetat = "tous les projets inactifs";
                        break;                                         
                }    
                $this->set('fetat',$fetat); 
                $contrats = $this->Projet->Contrat->find('all',array('fields' => array('Contrat.id','NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Contrat.id IN ('.$listcontrats.')','recursive'=>-1));
                $this->set('contrats',$contrats);                
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Projet->recursive = 0;
		$this->set('projets', $this->paginate());
                $this->Session->delete('xls_export');
                $export = $this->Projet->find('all',array('conditions'=>$newconditions,'order' => array('Projet.NOM' => 'asc'),'recursive'=>0));
                $this->Session->write('xls_export',$export);                   
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
            if (isAuthorized('projets', 'view')) :
		if (!$this->Projet->exists($id)) {
			throw new NotFoundException(__('Projet incorrect'));
		}
		$options = array('conditions' => array('Projet.' . $this->Projet->primaryKey => $id));
		$this->set('projet', $this->Projet->find('first', $options));
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
	public function add() {
            if (isAuthorized('projets', 'add')) :
                $listcontrats = $this->requestAction('assoprojetentites/find_str_id_contrats/'.userAuth('id'));
                $contrats = $this->Projet->Contrat->find('list',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Contrat.id IN ('.$listcontrats.')','recursive'=>-1));
                $cercles = userAuth('profil_id')== 0 ? $this->requestAction('entites/find_list_all_actif_cercle') : $this->requestAction('entites/find_list_cercle');
                $this->set(Compact('contrats','cercles'));
                $typeProjet = Configure::read('typeProjet');
                $this->set('type',$typeProjet);
                $factureProjet = Configure::read('factureProjet');
                $this->set('facturation',$factureProjet);                
                if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Projet->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Projet->create();
			if ($this->Projet->save($this->request->data)) {
                                //TODO ajouter une méthode pour faire l'association à la création
                                $lastid = $this->Projet->getLastInsertID();
                                $entite_id = $this->request->data['Projet']['entite_id'];
                                $this->requestAction('assoprojetentites/silent_save/'.$entite_id."/".$lastid);
				$this->Session->setFlash(__('Projet sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Projet incorrect, veuillez corriger le projet',true),'flash_failure');
			}
                    endif;
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
            if (isAuthorized('projets', 'edit')) :
                $listcontrats = $this->requestAction('assoprojetentites/find_str_id_contrats/'.userAuth('id'));
                $contrats = $this->Projet->Contrat->find('list',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Contrat.id IN ('.$listcontrats.')','recursive'=>-1));
                $cercles = userAuth('profil_id')== 0 ? $this->requestAction('entites/find_list_all_actif_cercle') : $this->requestAction('entites/find_list_cercle');
                $this->set(Compact('contrats','cercles'));  
                $typeProjet = Configure::read('typeProjet');
                $this->set('type',$typeProjet);
                $factureProjet = Configure::read('factureProjet');
                $this->set('facturation',$factureProjet);                   
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
		}
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
                throw new NotAuthorizedException();
            endif;                
	}
        
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
            if (isAuthorized('projets', 'index')) :
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
                throw new NotAuthorizedException();
            endif;                
        }      
        
/**
 * export_xls
 * 
 */       
	function export_xls() {
		$data = $this->Session->read('xls_export');
                $this->Session->delete('xls_export');                
		$this->set('rows',$data);
		$this->render('export_xls','export_xls');
	}    
        
        public function get_select_actif(){
            $conditions[] = array('Projet.ACTIF'=>1);
            $list = $this->Projet->find('list',array('fields'=>array('Projet.id','Projet.NOM'),'conditions'=>$conditions,'order'=>array('Projet.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }     
        
        public function get_list_projet(){
            $conditions[] = "Projet.id=1";
            $list = $this->Projet->find('list',array('fields'=>array('id'),'conditions'=>$conditions,'recursive'=>0));
            return $list;
        }    
        
        public function get_list_actif(){
            $conditions[] = array('Projet.ACTIF'=>1);
            $list = $this->Projet->find('all',array('fields'=>array('Projet.id','Projet.NOM'),'conditions'=>$conditions,'order'=>array('Projet.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }     
        
        public function set_actif($contrat_id=null,$actif = 0,$id = null){ 
            if ($id != null):
                $projets = $this->Projet->find('all',array('fields'=>array('Projet.id'),'conditions'=>array('Projet.contrat_id'=>$contrat_id,'Projet.id'=>$id),'recursive'=>0));      
            else:
                $projets = $this->Projet->find('all',array('fields'=>array('Projet.id'),'conditions'=>array('Projet.contrat_id'=>$contrat_id),'recursive'=>0)); 
            endif;
            foreach($projets as $projet):
                $this->set_this_actif($projet['Projet']['id'],intval($actif));
                $this->Projet->requestAction('activites/set_actif/'.$projet['Projet']['id'].'/'.$actif);
            endforeach;
        }          
        
        public function set_this_actif($id=null,$actif=0){
            $this->Projet->id = $id;
            $this->Projet->saveField('ACTIF', intval($actif));
        }
        
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
        
        public function find_all_cercle_projet($utilisateur_id){
            $listprojets = $this->requestAction('assoprojetentites/json_get_all_projets/'.$utilisateur_id);
            $conditions = array();
            $conditions[]=array('Projet.id IN ('.$listprojets.')');
            $order = array();
            $order[]=array('Projet.NOM'=>'asc');
            $list = $this->Projet->find('all',array('order'=>$order,'conditions'=>$conditions,'recursive'=>1));
            return $list;
        }    
        
        public function find_list_cercle_projet($utilisateur_id){
            $listprojets = $this->requestAction('assoprojetentites/json_get_all_projets/'.$utilisateur_id);
            $conditions = array();
            $conditions[]=array('Projet.id IN ('.$listprojets.')');
            $order = array();
            $order[]=array('Projet.NOM'=>'asc');
            $fields = array('Projet.id','Projet.NOM');
            $list = $this->Projet->find('list',array('fields'=>$fields,'order'=>$order,'conditions'=>$conditions,'recursive'=>1));
            return $list;
        }
        
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
}
