<?php
App::uses('AppController', 'Controller');
/**
 * Activites Controller
 *
 * @property Activite $Activite
 */
class ActivitesController extends AppController {
        public $components = array('History','Common');
        public $paginate = array(
        'limit' => 25,
        'order' => array('Projet.NOM'=>'asc','Activite.NOM' => 'asc'),
        );
        
        public function get_visibility(){
            if(userAuth('profil_id')==1):
                return null;
            else:
                return $this->requestAction('assoprojetentites/json_get_all_projets/'.userAuth('id'));
            endif;
        }
        
        public function get_restriction($visibility){
            if($visibility == null):
                return '1=1';
            elseif ($visibility!=''):
                return array("Projet.id IN (".$visibility.')');
            else:
                return '1=1';
            endif;
        }      
        
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
        
        public function get_activite_filtre_filter($filtre,$visibility){
            $result = array();
            switch ($filtre){
                case 'tous':
                case null:  
                    if($visibility == null):
                        $result['condition'] = '1=1';
                    elseif ($visibility!=''):
                        $result['condition'] = "Activite.projet_id IN (".$visibility.")";
                    else:
                        $result['condition'] = 'Activite.projet_id < 1';
                    endif;                    
                    $result['filter'] = "tous les projets";
                    break;
                case 'autres':
                    if($visibility == null):
                        $result['condition'] = '1=1';
                    elseif ($visibility!=''):
                        $visibility = strlen ($visibility) == 1 ? '0' : substr_replace($visibility ,"",0,2);
                        $result['condition'] = "Activite.projet_id IN (".$visibility.")";
                    else:
                        $result['condition'] = 'Activite.projet_id < 1';
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
        
        public function get_export($condition){
            $this->Session->delete('xls_export');
            $export = $this->Activite->find('all',array('conditions'=>$condition,'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'recursive'=>0));
            $this->Session->write('xls_export',$export); 
        }
        
        public function get_history($id){
            return $this->Activite->Historybudget->find('all',array('conditions'=>array('activite_id'=>$id),'recursive'=>-1,'order'=>array('ANNEE'=>'desc','Historybudget.created'=>'desc')));
        }
/**
 * index method
 *
 * @return void
 */
	public function index($filtreEtat=null,$filtre=null) {
            $this->set('title_for_layout','Activités');
            if (isAuthorized('activites', 'index')) :
                $listprojets = $this->get_visibility();
                $getfiltre = $this->get_activite_filtre_filter($filtre, $listprojets);
                $getetat = $this->get_activite_etat_filter($filtreEtat);
                $restriction = $this->get_restriction($listprojets);
                $this->set('fprojet',$getfiltre['filter']); 
                $this->set('fetat',$getetat['filter']); 
                $newconditions = array($getfiltre['condition'],$getetat['condition'],$restriction);
                $projets = $this->requestAction('projets/find_all_cercle_projet/'.userAuth('id'));
                $this->set('projets',$projets);  
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));                
		$this->set('activites', $this->paginate());
                $this->get_export($newconditions);
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
            $this->set('title_for_layout','Activités');
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
                $projets = $this->requestAction('projets/find_list_cercle_projet/'.userAuth('id'));
                $this->set('projets',$projets);                
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
            $this->set('title_for_layout','Activités');
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
                    $projets = $this->requestAction('projets/find_list_cercle_projet/'.userAuth('id')); 
                    $historybudgets = $this->get_history($id);
                    $this->set(compact('historybudgets','projets'));                           
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
            $this->set('title_for_layout','Activités');
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
                throw new NotAuthorizedException();         
            endif;                
	}
        
        
/**
 * search method
 *
 * @return void
 */
	public function search($filtreEtat=null,$filtre=null,$keywords=null) {
            $this->set('title_for_layout','Activités');
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
                    $projets = $this->requestAction('projets/find_all_cercle_projet/'.userAuth('id'));
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
        
        public function savehistory(){
            $this->Session->write('test',$this->request->data['HistoryBudget'][0]['ANNEE']);
            exit();
        }
        
        function getId($nom){
            $result = $this->Activite->find('first',array('fields'=>array('id'),'conditions'=>array('NOM'=>$nom),'recursive'=>-1));
            return $result;
            exit();
        }
        
        public function set_actif($projet_id=null,$actif=0){
            $objs = $this->Activite->find('all',array('fields'=>array('Activite.id'),'conditions'=>array('Activite.projet_id'=>$projet_id),'recursive'=>0));
            foreach($objs as $obj):
                $this->set_this_actif($obj['Activite']['id'],intval($actif));
            endforeach;
        }    
        
        public function set_this_actif($id=null,$actif=0){
            $this->Activite->id = $id;
            $this->Activite->saveField('ACTIVE', intval($actif));
        }      
        
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
        
        public function find_all_cercle_activite_and_indisponibility($utilisateur_id){
            $listprojets = $this->get_visibility();
            $conditions[]= array('Activite.projet_id > 0');
            if($listprojets != ''):
                $conditions[]=array('Activite.projet_id IN (1,'.$listprojets.')');
            elseif ($listprojets == null):
                $conditions[]="1=1";        
            else:                
                $conditions[]= array('Activite.projet_id = 1');
            endif;
            $order[]=array('Projet.NOM'=>'asc');
            $order[]=array('Activite.NOM'=>'asc');
            $list = $this->Activite->find('all',array('order'=>$order,'conditions'=>$conditions,'recursive'=>1));
            return $list;
        }        
        
        public function find_str_id_cercle_activite($utilisateur_id){
            $listprojets = $this->requestAction('assoprojetentites/json_get_all_projets/'.$utilisateur_id);
            if($listprojets != '0'):
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
