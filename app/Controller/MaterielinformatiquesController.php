<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'ping', array('file'=>'class.ping.php'));
/**
 * Materielinformatiques Controller
 *
 * @property Materielinformatique $Materielinformatique
 */
class MaterielinformatiquesController extends AppController {
        public $components = array('History','Common'); 
    public $paginate = array(
        'limit' => 25,
        'order' => array('Materielinformatique.NOM' => 'asc'),
        );

        public function get_visibility(){
            if(userAuth('profil_id')==1):
                return null;
            else:
                return $this->requestAction('assoentiteutilisateurs/find_all_section/'.userAuth('id'));
            endif;
        }
                
        public function get_materiel_etat_filter($id){
            $result = array();
            $id = $id==null ? 'En stock': $id;
            switch($id):
                case 'tous':  
                    $result['condition']="1=1";
                    $result['filter'] = "de tous les états";
                    break;
                default :
                    $result['condition']="Materielinformatique.ETAT='".$id."'";
                    $result['filter'] = "étant '".$id."'"; 
                    break;
            endswitch;
            return $result;
        }    
        
        public function get_materiel_type_filter($id){
            $result = array();
            switch($id):
                    case 'tous':
                    case null:    
                        $result['condition']="1=1";
                        $result['filter'] = "tous les types de matériel";
                        break;
                    default :
                        $result['condition']="Typemateriel.NOM='".$id."'";
                        $result['filter'] = "type de matériel '".$id."'";  
                    break;
            endswitch;
            return $result;
        }       
        
        public function get_materiel_section_filter($id,$visibility){
            $result = array();
            switch($id):
                case 'toutes':
                case null:    
                    if($visibility == null):
                        $result['condition']='1=1';
                    elseif ($visibility!=''):
                        if (userAuth('WIDEAREA')==0) :
                            $result['condition']='Section.id ='.userAuth('section_id');
                        else:
                            $result['condition']='Section.id IN ('.$visibility.')';
                        endif;
                    else:
                        $result['condition']='Section.id ='.userAuth('section_id');
                    endif;                     
                    $result['filter'] = "toutes les sections";
                    break;
                default :
                    $result['condition']="Section.id='".$id."'";
                    $nomsection = $this->Materielinformatique->Section->find('first',array('conditions'=>array('Section.id'=>$id),'recursive'=>-1));
                    $result['filter'] = "la section ".$nomsection['Section']['NOM'];   
                    break;
            endswitch;
            return $result;
        }      
               
        public function get_export($conditions){
            $this->Session->delete('xls_export');
            $export = $this->Materielinformatique->find('all',array('conditions'=>$conditions,'order' => array('Materielinformatique.NOM' => 'asc'),'recursive'=>0));
            $this->Session->write('xls_export',$export);   
        }
/**
 * index method
 *
 * @return void
 */
	public function index($filtreetat=null,$filtretype=null,$filtresection=null) {
            $this->set('title_for_layout','Postes informatique');
            if (isAuthorized('materielinformatiques', 'index')) :
                $visibility = $this->get_visibility();
                $getetat = $this->get_materiel_etat_filter($filtreetat);
                $gettype = $this->get_materiel_type_filter($filtretype);
                $getsection = $this->get_materiel_section_filter($filtresection, $visibility);
                $this->set('fetat',$getetat['filter']); 
                $this->set('ftype',$gettype['filter']); 
                $this->set('fsection',$getsection['filter']);                 
                $newconditions = array($getetat['condition'],$gettype['condition'],$getsection['condition']);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));                
		$this->set('materielinformatiques', $this->paginate());
                $this->get_export($newconditions);
                $etats = Configure::read('etatMaterielInformatique');
                $types = $this->requestAction('typemateriels/get_all_uc');
                $sections = $this->requestAction('sections/get_all/',array('pass'=>array($visibility)));
                $this->set(compact('etats','types','sections')); 
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
            $this->set('title_for_layout','Postes informatique');
            if (isAuthorized('materielinformatiques', 'add')) :
                if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Materielinformatique->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Materielinformatique->create();
			if ($this->Materielinformatique->save($this->request->data)) {
				$this->Session->setFlash(__('Postes informatique sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Postes informatique incorrect, veuillez corriger le poste informatique',true),'flash_failure');
			}
                    endif;
		endif;
                $visibility = $this->get_visibility();
                $peripherique = $this->requestAction('typemateriels/get_list_uc');
                $section = $this->requestAction('sections/get_list/',array('pass'=>array($visibility)));
                $etat = Configure::read('etatMaterielInformatique');
                $assistance = $this->requestAction('assistances/get_list');
                $this->set(compact('peripherique','section','etat','assistance'));                 
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
            $this->set('title_for_layout','Postes informatique');
            if (isAuthorized('materielinformatiques', 'edit')) :
                if (!$this->Materielinformatique->exists($id)) {
			throw new NotFoundException(__('Postes informatique incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Materielinformatique->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Materielinformatique->save($this->request->data)) {
                            if ($this->request->data['Materielinformatique']['ETAT']=='En stock'):
                                $dotations = $this->Materielinformatique->Dotation->find('all',array('conditions'=>array('Dotation.materielinformatiques_id'=>$id),'recursive'=>0));
                                foreach($dotations as $dotation):
                                    $this->Materielinformatique->requestAction('dotations/reception',array('pass'=>array($dotation['Dotation']['id'],$dotation['Dotation']['utilisateur_id'])));
                                endforeach;    
                            endif;
				$this->Session->setFlash(__('Postes informatique sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Postes informatique incorrect, veuillez corriger le poste informatique',true),'flash_failure');
			}
                    endif;
		} else {
                    $options = array('conditions' => array('Materielinformatique.' . $this->Materielinformatique->primaryKey => $id),'recursive'=>0);
                    $this->request->data = $this->Materielinformatique->find('first', $options);
                    $this->set('materielinformatique',$this->request->data);
                    $visibility = $this->get_visibility();
                    $peripherique = $this->requestAction('typemateriels/get_list_uc');
                    $section = $this->requestAction('sections/get_list/',array('pass'=>array($visibility)));
                    $etat = Configure::read('etatMaterielInformatique');
                    $assistance = $this->requestAction('assistances/get_list');
                    $this->set(compact('peripherique','section','etat','assistance'));                         
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
            $this->set('title_for_layout','Postes informatique');
            if (isAuthorized('materielinformatiques', 'delete')) :
                $this->Materielinformatique->id = $id;
		if (!$this->Materielinformatique->exists()) {
			throw new NotFoundException(__('Postes informatique incorrect'));
		}
		if ($this->Materielinformatique->delete()) {
			$this->Session->setFlash(__('Postes informatique supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Postes informatique <b>NON</b> supprimé',true),'flash_failure');
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
	public function search($filtreetat=null,$filtretype=null,$filtresection=null,$keywords=null) {
            $this->set('title_for_layout','Postes informatique');
            if (isAuthorized('materielinformatiques', 'index')) :
                if(isset($this->params->data['Materielinformatique']['SEARCH'])):
                    $keywords = $this->params->data['Materielinformatique']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords)); 
                    $visibility = $this->get_visibility();
                    $getetat = $this->get_materiel_etat_filter($filtreetat);
                    $gettype = $this->get_materiel_type_filter($filtretype);
                    $getsection = $this->get_materiel_section_filter($filtresection, $visibility);
                    $this->set('fetat',$getetat['filter']); 
                    $this->set('ftype',$gettype['filter']); 
                    $this->set('fsection',$getsection['filter']);                 
                    $newconditions = array($getetat['condition'],$gettype['condition'],$getsection['condition']);
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Materielinformatique.NOM LIKE '%".$value."%'","Materielinformatique.ETAT LIKE '%".$value."%'","Materielinformatique.COMMENTAIRE LIKE '%".$value."%'","Assistance.NOM LIKE '%".$value."%'","Section.NOM LIKE '%".$value."%'","Typemateriel.NOM LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newcondition,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                 
                    $this->set('materielinformatiques', $this->paginate());
                    $this->get_export($newconditions);
                    $etats = Configure::read('etatMaterielInformatique');
                    $types = $this->requestAction('typemateriels/get_all_uc');
                    $sections = $this->requestAction('sections/get_all/',array('pass'=>array($visibility)));
                    $this->set(compact('etats','types','sections'));                    
                else:
                    $this->redirect(array('action'=>'index',$actif,$entite));
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
                $this->Session->delete('xls_export');
		$this->set('rows',$data);
		$this->render('export_xls','export_xls');
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
            if (isAuthorized('materielinformatiques', 'duplicate')) :
		$this->Materielinformatique->id = $id;
                $record = $this->Materielinformatique->read();
                unset($record['Materielinformatique']['id']);
                $record['Materielinformatique']['NOM']='_nouveau nom_';
                $record['Materielinformatique']['ETAT']='En stock';
                unset($record['Materielinformatique']['created']);                
                unset($record['Materielinformatique']['modified']);
                $record['Materielinformatique']['created'] = date('Y-m-d');
                $record['Materielinformatique']['modified'] = date('Y-m-d');
                $this->Materielinformatique->create();
                if ($this->Materielinformatique->save($record)) {
                        $this->Session->setFlash(__('Poste informatique dupliqué',true),'flash_success');
                        $this->History->goBack(1);
                } 
		$this->Session->setFlash(__('Poste informatique <b>NON</b> dupliqué',true),'flash_failure');
		$this->History->goBack(1);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}     
        
        public function pinghost($host) {
            $this->autoRender = false;
            $ip = gethostbyname($host);
            if($ip != NULL):
                if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') :
                    exec("ping -n 2 " . $ip, $output, $result);
                else:
                    exec("ping -c 2 " . $ip, $output, $result);
                endif;
                if ($result == 0):
                  $retour = true;
                else :
                  $retour = false;
                endif; 
            else:
                $retour = false;  
                $result = false;
            endif;
            $poste['IP']=$ip;
            $poste['RETOUR']=$retour;
            $poste['HOST']=$host;
            $poste['LATENCE']=$result;
            $result = json_encode($poste);
            return $result;
        }
}
