<?php
App::uses('AppController', 'Controller');
/**
 * Biens Controller
 *
 * @property Bien $Bien
 * @property PaginatorComponent $Paginator
 */
class BiensController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Bien.DATEINSTALL'=>'desc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($aplication=null,$installe=null,$valide=null,$actif=null,$type=null,$usage=null) {
            if (isAuthorized('biens', 'index')) :
                switch($aplication):
                    case null:
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter = ', pour toutes les applications';
                        break;
                    default:
                        $newconditions[]="Bien.application_id=".$aplication;
                        $nom = $this->Bien->Application->findById($aplication);
                        $strfilter = ', pour l\'application '.$nom['Application']['NOM'];
                        break;
                endswitch;
                switch($installe):
                    case null:
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter .= '';
                        break;                         
                    case '1':
                        $newconditions[]="Bien.INSTALL=0";
                        $strfilter .= ', non installés';
                        break;
                    case '0':
                        $newconditions[]="Bien.INSTALL=1";
                        $strfilter .= ', installés';
                        break;                   
                endswitch;     
                switch($valide):
                    case null:
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter .= '';
                        break;                          
                    case '1':
                        $newconditions[]="Bien.CHECK=0";
                        $strfilter .= ', non validés';
                        break;
                    case '0':
                        $newconditions[]="Bien.CHECK=1";
                        $strfilter .= ', validés';
                        break;                   
                endswitch;   
                switch($actif):
                    case null:
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter .= '';
                        break;                          
                    case '0':
                        $newconditions[]="Bien.ACTIF=1";
                        $strfilter .= ', actifs';
                        break;
                    case '1':
                        $newconditions[]="Bien.ACTIF=0";
                        $strfilter .= ', inactifs';
                        break;                   
                endswitch;                 
                switch($type):
                    case null:
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter .= ', pour tous les environnements';
                        break;
                    default:
                        $newconditions[]="Bien.type_id=".$type;
                        $nom = $this->Bien->Type->findById($type);
                        $strfilter .= ', pour l\'environnement '.$nom['Type']['NOM'];
                        break;
                endswitch;   
                switch($usage):
                    case null:
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter .= ', pour tous les usages';
                        break;
                    default:
                        $newconditions[]="Bien.usage_id=".$usage;
                        $nom = $this->Bien->Usage->findById($usage);
                        $strfilter .= ', pour l\'usage '.$nom['Usage']['NOM'];
                        break;
                endswitch;                 
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
		$this->Bien->recursive = 0;
                $export = $this->Bien->find('all',array('conditions'=>$newconditions,'order' => array('Bien.DATEINSTALL' => 'desc'),'recursive'=>0));
                $this->Session->delete('xls_export');
                $this->Session->write('xls_export',$export);                 
		$this->set('biens', $this->paginate());
                $applications = $this->requestAction('applications/get_list/1');
                $types = $this->requestAction('types/get_list/1');
                $usages = $this->requestAction('usages/get_list/1');
		$this->set(compact('applications','types','usages'));    
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
		if (!$this->Bien->exists($id)) {
			throw new NotFoundException(__('Invalid bien'));
		}
		$options = array('conditions' => array('Bien.' . $this->Bien->primaryKey => $id));
		$this->set('bien', $this->Bien->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {            
            if (isAuthorized('biens', 'add')) :        
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Bien->validate = array();
                        $this->History->goBack(1);
                    else:
			$this->Bien->create();
			if ($this->Bien->save($this->request->data)) {
				$this->Session->setFlash(__('Bien sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Bien incorrect, veuillez corriger le bien',true),'flash_failure');
			}                        
                    endif;
		endif;
		$modeles = $this->requestAction('modeles/get_select');
		$chassis = $this->requestAction('chassis/get_select');
		$types = $this->requestAction('types/get_select');
		$usages = $this->requestAction('usages/get_select');
		$lots = $this->requestAction('lots/get_select');
                $applications = $this->requestAction('applications/get_select');
                $cpuses = $this->requestAction('cpuses/get_select');
		$this->set(compact('modeles', 'chassis', 'types', 'usages', 'lots','applications','cpuses'));
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
            if (isAuthorized('biens', 'edit')) :              
		if (!$this->Bien->exists($id)) {
			throw new NotFoundException(__('Bien incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Bien->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Bien->save($this->request->data)) {
				$this->Session->setFlash(__('Bien sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Bien incorrect, veuillez corriger le bien',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Bien.' . $this->Bien->primaryKey => $id));
			$this->request->data = $this->Bien->find('first', $options);
		}
                $this->Bien->id = $id;
                $bien = $this->Bien->read();
                $listlogiciels = $this->requestAction('logiciels/get_select_compatible/'.$bien['Bien']['lot_id'].'/'.$bien['Bien']['application_id']);
                $assobienlogiciels = $this->requestAction('assobienlogiciels/get_outils_for_bien/'.$id);
                $logiciels = $this->requestAction('assobienlogiciels/get_list/'.$id);
		$modeles = $this->requestAction('modeles/get_select');
		$chassis = $this->requestAction('chassis/get_select');
		$types = $this->requestAction('types/get_select');
		$usages = $this->requestAction('usages/get_select');
		$lots = $this->requestAction('lots/get_select');
                $applications = $this->requestAction('applications/get_select');
                $cpuses = $this->requestAction('cpuses/get_select');
                $histories = $this->requestAction('historybiens/get_list/'.$id);
                $outils = $this->requestAction('envoutils/get_select/1');
                $versions=array();
		$this->set(compact('modeles', 'chassis', 'types', 'usages', 'lots','applications','cpuses','histories','logiciels','listlogiciels','assobienlogiciels','outils','versions'));
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
            if (isAuthorized('biens', 'delete')) : 
		$this->Bien->id = $id;
		if (!$this->Bien->exists()) {
			throw new NotFoundException(__('Bien incorrect'));
		}
                $this->saveHistory($id);
                $obj = $this->Bien->find('first',array('conditions'=>array('Bien.id'=>$id),'recursive'=>0));
                $newactif = $obj['Bien']['ACTIF'] == 1 ? 0 : 1;
                if($newactif == 0):
                    $this->Bien->saveField('INSTALL',0);
                    $this->Bien->saveField('DATEINSTALL',NULL);
                    $this->Bien->saveField('CHECK',0);
                    $this->Bien->saveField('CHECKBY',  NULL); 
                    $this->Bien->saveField('DATECHECKINSTALL',NULL);
                endif;
		if ($this->Bien->saveField('ACTIF',$newactif)) {
                        if ($newactif==0):
                            $delete = "DELETE FROM assobienlogiciels WHERE bien_id = ".$id;
                            $this->Bien->Assobienlogiciel->query($delete);   
                            $this->Session->setFlash(__('Bien supprimé',true),'flash_success');
                        else:
                            $this->Session->setFlash(__('Bien activé',true),'flash_success');
                        endif;
		} else {
			$this->Session->setFlash(__('Bien <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        
        public function ajax_actif($id=null){
                $newid = $id == null ? $this->request->data('id') : $id;
                $result = false;                
                $this->Bien->id = $newid;
                $obj = $this->Bien->find('first',array('conditions'=>array('Bien.id'=>$newid),'recursive'=>0));
                $newactif = $obj['Bien']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Bien->saveField('ACTIF',$newactif)) {
                        $this->saveHistory($newid);                    
                        if ($newactif==0):
                            $delete = "DELETE FROM assobienlogiciels WHERE bien_id = ".$newid;
                            $this->Bien->Assobienlogiciel->query($delete);                            
                        endif;
			if ($id==null):
                            $this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
                        else:
                            $result = true;
                        endif;
		} else {
			if ($id==null):
                           $this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
                        else:
                            $result = false;
                        endif;                        
		}
		if ($id==null):
                    exit();
                else:
                    return $result;
                endif;
        }   
        
        public function ajax_install($id=null){
                $newid = $id == null ? $this->request->data('id') : $id;
                $result = false;                
                $this->Bien->id = $newid;
                $obj = $this->Bien->find('first',array('conditions'=>array('Bien.id'=>$newid),'recursive'=>0));
                $newactif = $obj['Bien']['INSTALL'] == 1 ? 0 : 1;
                $date = $newactif == 0 ? null : date('Y-m-d H:i:s');
		if ($this->Bien->saveField('INSTALL',$newactif) && $this->Bien->saveField('DATEINSTALL',$date)) {
                        if($newactif==0):
                            $this->Bien->saveField('CHECK',0);
                            $this->Bien->saveField('DATECHECKINSTALL',null);
                        endif;
                        $this->saveHistory($newid);
			if ($id==null):
                            $this->Session->setFlash(__('Statut d\'installation pris en compte',true),'flash_success');
                        else:
                            $result = true;
                        endif;
		} else {
			if ($id==null):
                           $this->Session->setFlash(__('Statut d\'installation <b>NON</b> pris en compte',true),'flash_failure');
                        else:
                            $result = false;
                        endif;                    
		}
		if ($id==null):
                    exit();
                else:
                    return $result;
                endif;
        }  
        
        public function ajax_check($id=null){
                $newid = $id == null ? $this->request->data('id') : $id;
                $result = false;
                $this->Bien->id = $newid;
                $obj = $this->Bien->find('first',array('conditions'=>array('Bien.id'=>$newid),'recursive'=>0));
                if($obj['Bien']['INSTALL'] == 1):
                $newactif = $obj['Bien']['CHECK'] == 1 ? 0 : 1;
                $date = $newactif == 0 ? null : date('Y-m-d');
                $user = $newactif == 0 ? null : userAuth('id');
		if ($this->Bien->saveField('CHECK',$newactif) && $this->Bien->saveField('CHECKBY',  $user) && $this->Bien->saveField('DATECHECKINSTALL',$date)) {
                        $this->saveHistory($newid);
			if ($id==null):
                            $this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
                        else:
                            $result = true;
                        endif;
		} else {
			if ($id==null):
                            $this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
                        else:
                            $result = false;
                        endif;
		}
                else :
                    $this->Session->setFlash(__('Pour faire la modification du statut validé le bien doit être installé.',true),'flash_failure');
                endif;
		if ($id==null):
                    exit();
                else:
                    return $result;
                endif;
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
            if (isAuthorized('biens', 'duplicate')) :
		$this->Bien->id = $id;
                $record = $this->Bien->read();
                unset($record['Bien']['id']);
                unset($record['Bien']['NOM']);
                $record['Bien']['NOM']='_NOUVEAU_';
                unset($record['Bien']['application_id']);  
                $record['Bien']['application_id']=0;
                unset($record['Bien']['CHECK']);
                unset($record['Bien']['CHECKBY']);
                unset($record['Bien']['DATECHECKINSTALL']);
                unset($record['Bien']['INSTALL']);
                unset($record['Bien']['DATEINSTALL']);
                unset($record['Bien']['ACTIF']);
                unset($record['Bien']['created']);                
                unset($record['Bien']['modified']);
                $this->Bien->create();
                if ($this->Bien->save($record)) {
                        $this->Session->setFlash(__('Bien dupliqué',true),'flash_success');
                } else {
                        $this->Session->setFlash(__('Bien incorrect, veuillez corriger le bien',true),'flash_failure');
                }
                $this->History->notmove();                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}        
        
        public function get_select($actif=null){
            $conditions[] = $actif == null ? '1=1' : 'Bien.ACTIF='.$actif;
            $list = $this->Bien->find('list',array('fields'=>array('Bien.id','Bien.NOM'),'conditions'=>$conditions,'recursive'=>0));
            return $list;
        }    
        
        public function saveHistory($bien_id=null){
            if($bien_id!=null && userAuth('id')!=null):
                $this->Bien->id = $bien_id;
                $bien = $this->Bien->find('first',array('conditions'=>array('Bien.id'=>$bien_id),'recursive'=>0)); 
                $record['Historybien']['biens_id']=$bien_id;
                $record['Historybien']['INSTALL']=$bien['Bien']['INSTALL'];
                $record['Historybien']['DATEINSTALL']=$bien['Bien']['DATEINSTALL'];
                $record['Historybien']['CHECK']=$bien['Bien']['CHECK'];
                $record['Historybien']['DATECHECKINSTALL']=$bien['Bien']['DATECHECKINSTALL'];
                $record['Historybien']['ACTIF']=$bien['Bien']['ACTIF'];
                $record['Historybien']['MODIFIEDBY']= userAuth('id'); 
                $record['Historybien']['created']=date('Y-m-d H:i:s');
                $record['Historybien']['modified']=date('Y-m-d H:i:s');
                $this->Bien->Historybien->create();
                if ($this->Bien->Historybien->save($record)) {
                        $this->Session->setFlash(__('Bien historisé',true),'flash_success');
                } else {
                        $this->Session->setFlash(__('Historisation du bien incorrecte, veuillez corriger le bien',true),'flash_failure');
                }
            else:
                $this->Session->setFlash(__('Historisation impossible le bien est incorect.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;
        }
        
        public function search(){
            if (isAuthorized('biens', 'index')) :
                $keyword=isset($this->params->data['Bien']['SEARCH']) ? $this->params->data['Bien']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Bien.NOM LIKE '%".strtoupper($keyword)."%'","Modele.NOM LIKE '%".strtoupper($keyword)."%'","Lot.NOM LIKE '%".$keyword."%'","Chassis.NOM LIKE '%".strtoupper($keyword)."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Bien->recursive = 0;
                $this->set('biens', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }  
        
        public function installall(){
            $ids = explode('-', $this->request->data('id'));
            if(count($ids)>0 && $ids[0]!=""):
                foreach($ids as $id):
                if($this->ajax_install($id)):
                    $this->Session->setFlash(__('Modification du statut installé pris en compte pour tous les biens sélectionnés',true),'flash_success'); 
                else :
                    $this->Session->setFlash(__('Modification du statut installé <b>NON</b> pris en compte pour tous les biens sélectionnés',true),'flash_failure');
                endif;
                endforeach;
                sleep(3);
            else :
                $this->Session->setFlash(__('Aucune action sélectionnée',true),'flash_failure');
            endif;
        }
        
        public function checkall(){
            $ids = explode('-', $this->request->data('id'));
            if(count($ids)>0 && $ids[0]!=""):
                foreach($ids as $id):
                if($this->ajax_check($id)):
                    $this->Session->setFlash(__('Modification du statut validé pris en compte pour tous les biens sélectionnés',true),'flash_success'); 
                else :
                    $this->Session->setFlash(__('Modification du statut validé <b>NON</b> pris en compte pour tous les biens sélectionnés',true),'flash_failure');
                endif;
                endforeach;
                sleep(3);
            else :
                $this->Session->setFlash(__('Aucun bien sélectionné',true),'flash_failure');
            endif;
        }
        
        public function deleteall(){
            $ids = explode('-', $this->request->data('id'));
            if(count($ids)>0 && $ids[0]!=""):
                foreach($ids as $id):
                    if($this->ajax_actif($id)):
                        $this->Session->setFlash(__('Modification du statut supprimé pris en compte pour tous les biens sélectionnés',true),'flash_success'); 
                    else :
                        $this->Session->setFlash(__('Modification du statut supprimé <b>NON</b> pris en compte pour tous les biens sélectionnés',true),'flash_failure');
                    endif;
                endforeach;
                sleep(3);
            else :
                $this->Session->setFlash(__('Aucun bien sélectionné',true),'flash_failure');
            endif;
        }   
        
        public function get_select_compatible($lot_id,$application_id){
            $list = $this->Bien->find('list',array('fields'=>array('Bien.id','Bien.NOM'),'conditions'=>array('Bien.lot_id'=>$lot_id,'Bien.application_id'=>$application_id),'recursive'=>0));
            return $list;
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
        
        public function getbynom($nom){
            $this->Bien->recursive = 0;
            $obj = $this->Bien->findByNom($nom);
            return $obj;
        }        
}
