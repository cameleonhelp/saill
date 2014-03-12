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
        //'conditions' => array('Activite.projet_id >' => 1),
        //'group'=>array('Activite.projet_id'),
        );
/**
 * index method
 *
 * @return void
 */
	public function index($filtreEtat=null,$filtre=null) {
            //$this->Session->delete('history');
            $listprojets = $this->requestAction('assoprojetentites/json_get_all_projets/'.userAuth('id'));
            if (isAuthorized('activites', 'index')) :
                switch ($filtre){
                    case 'tous':
                    case null:    
                        $newconditions[]="Activite.projet_id IN (".$listprojets.")";
                        $fprojet = "tous les projets";
                        break;
                    case 'autres':
                        $listprojets = strlen ($listprojets) == 1 ? '0' : substr_replace($listprojets ,"",0,2);
                        $newconditions[]="Activite.projet_id IN (".$listprojets.")";
                        $fprojet = "tous les projets autres que indisponibilité";
                        break;                    
                    default :
                        $newconditions[]="Projet.id='".$filtre."'";
                        $projet = $this->Activite->Projet->find('first',array('fields'=>array('Projet.NOM'),'recusrsive'=>0,'conditions'=>array('Projet.id'=>$filtre)));
                        $fprojet = "le projet ".$projet['Projet']['NOM'];
                        break;                      
                }  
                $this->set('fprojet',$fprojet); 
                switch ($filtreEtat){
                    case 'tous':
                    case '<':   
                        $newconditions[]="1=1";
                        $fetat = "toutes les activités";
                        break;
                    case 'actif':
                    case null:                         
                        $newconditions[]="Activite.ACTIVE=1";
                        $fetat = "toutes les activités actives";
                        break;  
                    case 'inactif':
                        $newconditions[]="Activite.ACTIVE=0";
                        $fetat = "toutes les activités inactives";
                        break;                                         
                }    
                $this->set('fetat',$fetat); 
                $projets = $this->requestAction('projets/find_all_cercle_projet/'.userAuth('id'));
                $this->set('projets',$projets);  
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Activite->recursive = 0;
		$this->set('activites', $this->paginate());
                $this->Session->delete('xls_export');
                $export = $this->Activite->find('all',array('conditions'=>$newconditions,'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'recursive'=>0));
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
            if (isAuthorized('activites', 'view')) :
		if (!$this->Activite->exists($id)) {
			throw new NotFoundException(__('Activité incorrecte'));
		}
		$options = array('conditions' => array('Activite.' . $this->Activite->primaryKey => $id),'recursive'=>-1);
		$this->set('activite', $this->Activite->find('first', $options));
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
            if (isAuthorized('activites', 'add')) :
                $projets = $this->requestAction('projets/find_list_cercle_projet/'.userAuth('id'));
                $this->set('projets',$projets);               
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
            if (isAuthorized('activites', 'edit')) :
                $projets = $this->requestAction('projets/find_list_cercle_projet/'.userAuth('id'));
                $this->set('projets',$projets);  
                $historybudgets = $this->Activite->Historybudget->find('all',array('conditions'=>array('activite_id'=>$id),'recursive'=>-1,'order'=>array('ANNEE'=>'desc','Historybudget.created'=>'desc')));
                $this->set('historybudgets', $historybudgets);                
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
            if (isAuthorized('activites', 'delete')) :
		$this->Activite->id = $id;
		if (!$this->Activite->exists()) {
			throw new NotFoundException(__('Activité incorrecte'));
		}
		//$this->request->onlyAllow('post', 'delete');
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
	public function search() {
            if (isAuthorized('activites', 'index')) :
                $keyword=isset($this->params->data['Activite']['SEARCH']) ? $this->params->data['Activite']['SEARCH'] : '';
                $listprojets = $this->requestAction('assoprojetentites/json_get_all_projets/'.userAuth('id'));
                $newconditions[] = array();
                $newconditions[] = array("Projet.id IN (".$listprojets.')');
                $newconditions[] = array('OR'=>array("Activite.NOM LIKE '%".$keyword."%'","Projet.NOM LIKE '%".$keyword."%'","Activite.NUMEROGALLILIE LIKE '%".$keyword."%'","Activite.DESCRIPTION LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Activite->recursive = 0;
                $this->set('activites', $this->paginate());
                $this->Session->delete('xls_export');
                $export = $this->Activite->find('all',array('conditions'=>$newconditions,'recursive'=>0));
                $this->Session->write('xls_export',$export);               
                $listeprojets = $this->Activite->find('all',array('fileds'=>'Activite.projet_id','group'=>'Activite.projet_id','recursive'=>-1));
                $listein = '';
                foreach($listeprojets as $liste):
                    $listein .= $liste['Activite']['projet_id'].',';
                endforeach;
                $projets = $this->Activite->Projet->find('all',array('fields' => array('id','NOM'),'conditions'=>array('Projet.id IN ('.substr_replace($listein ,"",-1).')'),'group'=>'NOM','order'=>array('NOM'=>'asc')));
                $this->set('projets',$projets);   
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
            $listprojets = $this->requestAction('assoprojetentites/json_get_all_projets/'.$utilisateur_id);
            $conditions = array();
            $conditions[]= array('Activite.projet_id>1');
            $conditions[]=array('Activite.projet_id IN ('.$listprojets.')');
            $order = array();
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
