<?php
App::uses('AppController', 'Controller');
/**
 * Logiciels Controller
 *
 * @property Logiciel $Logiciel
 * @property PaginatorComponent $Paginator
 */
class LogicielsController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Logiciel.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($aplication=null,$installe=null,$actif=null,$type=null,$outil=null) {
            if (isAuthorized('logiciels', 'index')) : 
                $listentite = $this->requestAction('assoentiteutilisateurs/json_get_my_entite/'.userAuth('id'));
                $newconditions[]="Logiciel.entite_id IN (".$listentite.')';                  
                $conditionexport = array();
                $sql ='';
                switch($aplication):
                    case null:
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter = ', pour toutes les applications';
                        break;
                    default:
                        $conditionexport[] = "logiciels.application_id=".$aplication;
                        $newconditions[]="Logiciel.application_id=".$aplication;
                        $nom = $this->Logiciel->Application->findById($aplication);
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
                        $conditionexport[] = "logiciels.INSTALL=0";
                        $newconditions[]="Logiciel.INSTALL=0";
                        $strfilter .= ', non installés';
                        break;
                    case '0':
                        $conditionexport[] = "logiciels.INSTALL=1";
                        $newconditions[]="Logiciel.INSTALL=1";
                        $strfilter .= ', installés';
                        break;                   
                endswitch;    
                switch($actif):
                    case null:
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter .= '';
                        break;                          
                    case '1':
                        $conditionexport[] = "logiciels.ACTIF=1";
                        $newconditions[]="Logiciel.ACTIF=1";
                        $strfilter .= ', actifs';
                        break;
                    case '0':
                        $conditionexport[] = "logiciels.ACTIF=0";
                        $newconditions[]="Logiciel.ACTIF=0";
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
                        $conditionexport[] = "logiciels.type_id=".$type;
                        $newconditions[]="Logiciel.type_id=".$type;
                        $nom = $this->Logiciel->Type->findById($type);
                        $strfilter .= ', pour l\'environnement '.$nom['Type']['NOM'];
                        break;
                endswitch;       
                switch($outil):
                    case null:
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter .= ', pour tous les outils';
                        break;
                    default:
                        $conditionexport[] = "logiciels.envoutil_id=".$outil;
                        $newconditions[]="Logiciel.envoutil_id=".$outil;
                        $nom = $this->Logiciel->Envoutil->findById($outil);
                        $strfilter .= ', pour l\'outil '.$nom['Envoutil']['NOM'];
                        break;
                endswitch;    
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Logiciel->recursive = 0;
		$this->set('logiciels', $this->paginate());
                $strconditionexport = count($conditionexport) > 0 ? 'WHERE '.implode(' AND ', $conditionexport) : '';
                $sql = 'SELECT logiciels.NOM,
                        envoutils.NOM as logiciel,
                        envoutils.OS,
                        envversions.VERSION,
                        envversions.EDITION,
                        biens.NOM as bien,
                        lots.NOM as lot,
                        applications.NOM as application,
                        usages.NOM as usages,
                        cpuses.NOM as cpu,
                        biens.COEUR,
                        biens.COEURLICENCE,
                        biens.PVU,
                        biens.RAM,
                        biens.COUT,
                        types.NOM as type,
                        assobienlogiciels.dsitenv_id,
                        logiciels.ACTIF
                        FROM logiciels
                        LEFT JOIN assobienlogiciels ON logiciels.id = assobienlogiciels.logiciel_id                        
                        LEFT JOIN envoutils ON logiciels.envoutil_id = envoutils.id
                        LEFT JOIN envversions ON logiciels.envversion_id = envversions.id
                        LEFT JOIN lots ON logiciels.lot_id = lots.id
                        LEFT JOIN applications ON logiciels.application_id = applications.id
                        LEFT JOIN biens ON biens.id = assobienlogiciels.bien_id
                        LEFT JOIN usages ON usages.id = biens.usage_id
                        LEFT JOIN cpuses ON cpuses.id = biens.cpu_id
                        LEFT JOIN types ON types.id = biens.type_id
                        '.$strconditionexport.';';
                $export = $this->Logiciel->query($sql);
                $xls_export = array();
                foreach($export as $obj):
                    $nomenv = $this->getNomEnvDsit($obj['assobienlogiciels']['dsitenv_id']);
                    if($nomenv != '') : $obj = array_merge($obj,array('assobienlogiciels' => array('dsitenv_nom' => $nomenv))); endif;
                    $xls_export[]=$obj;
                endforeach;
                $this->Session->delete('xls_export');
                $this->Session->write('xls_export',$xls_export);                
                $applications = $this->requestAction('applications/get_list/1');
                $types = $this->requestAction('types/get_list/1');
                $outils = $this->requestAction('envoutils/get_list/1');
                $this->set(compact('applications','types','outils','strconditionexport','xls_export'));   
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}

        public function getNomEnvDsit($ids){
            $list='';            
            if($ids!=null):
            $listid = explode(',',$ids);
            foreach($listid as $id):
                $sql = "SELECT dsitenvs.NOM FROM dsitenvs WHERE dsitenvs.id = ".$id;
                $obj = $this->Logiciel->query($sql);
                if(isset($obj[0]['dsitenvs']['NOM'])):
                    $list .= $obj[0]['dsitenvs']['NOM'].',';
                endif;
            endforeach;
            endif;
            $list = $list != '' ? rtrim($list,',') : '';
            return $list;
        }          
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Logiciel->exists($id)) {
			throw new NotFoundException(__('Invalid logiciel'));
		}
		$options = array('conditions' => array('Logiciel.' . $this->Logiciel->primaryKey => $id));
		$this->set('logiciel', $this->Logiciel->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('logiciels', 'add')) :        
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Logiciel->validate = array();
                        $this->History->goBack(1);
                    else:            
                        $this->request->data['Logiciel']['entite_id']=userAuth('entite_id');
			$this->Logiciel->create();
                        if(!$this->isExist($this->request->data['Logiciel']['envoutil_id'], $this->request->data['Logiciel']['envversion_id'], $this->request->data['Logiciel']['application_id'], $this->request->data['Logiciel']['lot_id'])){
                            if ($this->Logiciel->save($this->request->data)) {
                                    $this->Session->setFlash(__('Logiciel sauvegardé',true),'flash_success');
                                    $this->History->goFirst();
                            } else {
                                    $this->Session->setFlash(__('Logiciel incorrect, veuillez corriger le logiciel',true),'flash_failure');
                            }
                        } else {
                            $this->Session->setFlash(__('Logiciel existant avec ce nom, version, application et lot, veuillez corriger le logiciel',true),'flash_failure');
                        }
                    endif;
		endif;
		$outils = $this->requestAction('envoutils/get_select/1');
                $versions=array();
		$applications = $this->requestAction('applications/get_select/1');
		$types = $this->requestAction('types/get_select/1');
		$lots = $this->requestAction('lots/get_select/1');
		$this->set(compact('versions','outils', 'applications', 'types', 'lots'));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}

        /**
         * isExist method
         * Test si un logiciel avec entite_id,envoutil_id,envversion_id,application_id,lot_id exist en base
         * 
         * @param type $entite_id
         * @return boolean
         */
        public function isExist($envoutil_id,$envversion_id,$application_id,$lot_id,$entite_id=null){
            $bExist = false;
            $conditions[]='Logiciel.envoutil_id='.$envoutil_id; 
            $conditions[]='Logiciel.envversion_id='.$envversion_id;
            $conditions[]='Logiciel.application_id='.$application_id;
            $conditions[]='Logiciel.lot_id='.$lot_id;
            if ($entite_id!= null): $conditions[]='Logiciel.entite_id='.$entite_id; endif;
            $logiciel = $this->Logiciel->find('first',array('conditions'=>$conditions,'recursive'=>0));
            $bExist = count($logiciel)>0 ? true : false;
            return $bExist;
        }
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
            if (isAuthorized('logiciels', 'add')) :             
		if (!$this->Logiciel->exists($id)) {
			throw new NotFoundException(__('Invalid logiciel'));
		}
		if ($this->request->is(array('post', 'put'))) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Logiciel->validate = array();
                        $this->History->goBack(1);
                    else:     
                        if(!$this->isExist($this->request->data['Logiciel']['envoutil_id'], $this->request->data['Logiciel']['envversion_id'], $this->request->data['Logiciel']['application_id'], $this->request->data['Logiciel']['lot_id'])){
                            if ($this->Logiciel->save($this->request->data)) {
                                    $this->Session->setFlash(__('Logiciel sauvegardé',true),'flash_success');
                                    $this->History->goBack(1);
                            } else {
                                    $this->Session->setFlash(__('Logiciel incorrect, veuillez corriger le logiciel',true),'flash_failure');
                            }
                        } else {
                            $this->Session->setFlash(__('Logiciel existant avec ce nom, version, application et lot, veuillez corriger le logiciel',true),'flash_failure');
                            $this->History->goBack(1);
                        }
                    endif;
		} else {
                        $this->Logiciel->recursive = 0;
			$options = array('conditions' => array('Logiciel.' . $this->Logiciel->primaryKey => $id));
			$this->request->data = $this->Logiciel->find('first', $options);
		}
                $this->Logiciel->id = $id;
                $logiciel = $this->Logiciel->read();
		$outils = $this->requestAction('envoutils/get_select/1');
                $envoutil = $this->Logiciel->read('envoutil_id', $id);
                $versions=$this->requestAction('envversions/get_select_version_for/'.$envoutil['Logiciel']['envoutil_id'].'/1');
		$applications = $this->requestAction('applications/get_select/1');
		$types = $this->requestAction('types/get_select/1');
		$lots = $this->requestAction('lots/get_select/1');
                $biens = $this->requestAction('assobienlogiciels/get_biens_for_outil/'.$id);
                $listlogiciels = $this->requestAction('logiciels/get_select_compatible/'.$logiciel['Logiciel']['lot_id'].'/'.$logiciel['Logiciel']['application_id']);
                $listbiens = $this->requestAction('biens/get_select_compatible/'.$logiciel['Logiciel']['lot_id'].'/'.$logiciel['Logiciel']['application_id']);
                $histories = $this->requestAction('historylogiciels/get_list_for_logiciel/'.$id);
                $all_dsitenvs = $this->requestAction('dsitenvs/get_list');
		$this->set(compact('versions','outils', 'applications', 'types', 'lots','envoutil','biens','listbiens','histories','listlogiciels','all_dsitenvs'));
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
	public function delete($id = null, $loop = false) {
           if (isAuthorized('logiciels', 'delete')) :             
		$this->Logiciel->id = $id;
		if (!$this->Logiciel->exists()) {
			throw new NotFoundException(__('Invalid logiciel'));
		}
                $obj = $this->Logiciel->find('first',array('conditions'=>array('Logiciel.id'=>$id),'recursive'=>0));
                if($obj['Logiciel']['ACTIF']==1):
                    $newactif = $obj['Logiciel']['ACTIF'] == 1 ? 0 : 1;
                    if ($this->Logiciel->saveField('ACTIF',$newactif)) {
                        //$this->saveHistory($id);
                        if ($newactif==0):
                            $delete = "DELETE FROM assobienlogiciels WHERE logiciel_id = ".$id;
                            $this->Logiciel->Assobienlogiciel->query($delete);   
                            $this->Session->setFlash(__('Logiciel supprimé',true),'flash_success');
                            if($loop) : return true; endif;
                        else:
                            $this->Session->setFlash(__('Logiciel activé',true),'flash_success');
                            if($loop) : return true; endif;
                        endif;
                    } else {
                            $this->Session->setFlash(__('Logiciel <b>NON</b> supprimé',true),'flash_failure');
                            if($loop) : return false; endif;
                    }
                    if(!$loop) : $this->History->notmove();  
                    else:
                        return true;
                    endif;
                else:
                    if($this->Logiciel->delete()):
                        $delete = "DELETE FROM assobienlogiciels WHERE logiciel_id = ".$id;
                        $this->Logiciel->Assobienlogiciel->query($delete);   
                        $this->Session->setFlash(__('Logiciel supprimé',true),'flash_success');
                        if(!$loop) : $this->History->goBack(1); 
                        else:
                            return true;
                        endif;
                    else:
                        $this->Session->setFlash(__('Bien <b>NON</b> supprimé',true),'flash_failure');
                        if($loop) : return false; endif;
                    endif;
                endif;                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        public function ajax_actif($id=null){
                $newid = $id == null ? $this->request->data('id') : $id;
                $result = false;                
                $this->Logiciel->id = $newid;
                //$this->saveHistory($id);
                $obj = $this->Logiciel->find('first',array('conditions'=>array('Logiciel.id'=>$newid),'recursive'=>0));
                $newactif = $obj['Logiciel']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Logiciel->saveField('ACTIF',$newactif)) {
                        //$this->saveHistory($newid);
                        if ($newactif==0):
                            $delete = "DELETE FROM assobienlogiciels WHERE logiciel_id = ".$newid;
                            $this->Logiciel->Assobienlogiciel->query($delete);   
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
                //$this->saveHistory($id);
                $this->Logiciel->id = $id;
                $obj = $this->Logiciel->find('first',array('conditions'=>array('Logiciel.id'=>$newid),'recursive'=>0));
                $newactif = $obj['Logiciel']['INSTALL'] == 1 ? 0 : 1;
                $date = $newactif == 0 ? null : date('Y-m-d H:i:s');
		if ($this->Logiciel->saveField('INSTALL',$newactif) && $this->Logiciel->saveField('DATEINSTALL',$date)) {
                        //$this->saveHistory($newid);
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
               
/**
 * dupliquer method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function dupliquer($id = null) {
            if (isAuthorized('logiciels', 'duplicate')) :
		$this->Logiciel->id = $id;
                $record = $this->Logiciel->read();
                unset($record['Logiciel']['id']);
                unset($record['Logiciel']['application_id']);  
                $record['Logiciel']['application_id']=0;
                unset($record['Logiciel']['DATECHECKINSTALL']);
                unset($record['Logiciel']['INSTALL']);
                $record['Logiciel']['ACTIF']=1;
                unset($record['Logiciel']['created']);                
                unset($record['Logiciel']['modified']);
                $this->Logiciel->create();
                if ($this->Logiciel->save($record)) {
                        $this->Session->setFlash(__('Logiciel dupliqué',true),'flash_success');
                        $this->redirect(array('action'=>'edit',$this->Logiciel->getLastInsertID()));
                } else {
                        $this->Session->setFlash(__('Logiciel incorrect, veuillez corriger le logiciel',true),'flash_failure');
                }              
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}        
        
        public function get_select($actif=null){
            $conditions[] = $actif == null ? '1=1' : 'Logiciel.ACTIF='.$actif;
            $list = $this->Logiciel->find('list',array('fields'=>array('Logiciel.id','Logiciel.NOM'),'conditions'=>$conditions,'order'=>array('Logiciel.NOM'=>'asc'),'group'=>array('Logiciel.NOM'),'recursive'=>0));
            return $list;
        }    
        
        public function get_info($id){
            $conditions[] = 'Logiciel.id='.$id;
            $list = $this->Logiciel->find('first',array('conditions'=>$conditions,'recursive'=>0));
            return $list;
        }   
        
        public function get_id_exist($envoutil_id,$envversion_id,$application_id,$lot_id,$entite_id=null){
            $conditions[]='Logiciel.envoutil_id='.$envoutil_id; 
            $conditions[]='Logiciel.envversion_id='.$envversion_id;
            $conditions[]='Logiciel.application_id='.$application_id;
            $conditions[]='Logiciel.lot_id='.$lot_id;
            if ($entite_id!= null): $conditions[]='Logiciel.entite_id='.$entite_id; endif;
            $logiciel = $this->Logiciel->find('first',array('conditions'=>$conditions,'recursive'=>0));
            return $logiciel['Logiciel']['id'];
        }          
        
        public function saveHistory($logiciel_id=null){
            /**
             * Pas d'historisation celle-ci se fait sur l'association logiciel bien
             */
            if($logiciel_id != null  && userAuth('id')!=null):
                $this->Logiciel->id = $logiciel_id;
                $logiciel = $this->Logiciel->find('first',array('conditions'=>array('Logiciel.id'=>$logiciel_id),'recursive'=>0)); 
                $record['Historylogiciel']['logiciels_id']=$logiciel_id;
                $record['Historylogiciel']['INSTALL']=$logiciel['Logiciel']['INSTALL'];
                $record['Historylogiciel']['DATEINSTALL']=$logiciel['Logiciel']['DATEINSTALL'];
                $record['Historylogiciel']['CHECK']=$logiciel['Logiciel']['CHECK'];
                $record['Historylogiciel']['DATECHECKINSTALL']=$logiciel['Logiciel']['DATECHECKINSTALL'];
                $record['Historylogiciel']['ACTIF']=$logiciel['Logiciel']['ACTIF'];
                $record['Historylogiciel']['modifiedby']=  userAuth('id'); 
                $record['Historylogiciel']['created']=date('Y-m-d H:i:s');
                $record['Historylogiciel']['modified']=date('Y-m-d H:i:s');
                $this->Logiciel->Historylogiciel->create();
                if ($this->Logiciel->Historylogiciel->save($record)) {
                        $this->Session->setFlash(__('Logiciel historisé',true),'flash_success');
                } else {
                        $this->Session->setFlash(__('Historisation du logiciel incorrecte, veuillez corriger le logiciel',true),'flash_failure');
                }
            else:
                $this->Session->setFlash(__('Historisation impossible le logiciel est incorect.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;
        }
        
        public function search(){
            if (isAuthorized('logiciels', 'index')) :
                $keyword=isset($this->params->data['Logiciel']['SEARCH']) ? $this->params->data['Logiciel']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Logiciel.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Logiciel->recursive = 0;
                $this->set('logiciels', $this->paginate());  
                $applications = $this->requestAction('applications/get_list/1');
                $types = $this->requestAction('types/get_list/1');
                $outils = $this->requestAction('envoutils/get_list/1');
                $this->set(compact('applications','types','outils'));                 
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }  
        
        public function installall($id){
            if($this->request->data('id')!==''):
                if($this->ajax_install($id)):
                    $this->Session->setFlash(__('Modification du statut installé pris en compte pour tous les logiciels sélectionnés',true),'flash_success'); 
                else :
                    $this->Session->setFlash(__('Modification du statut installé <b>NON</b> pris en compte pour tous les logiciels sélectionnés',true),'flash_failure');
                endif;
            else :
                $this->Session->setFlash(__('Aucun logiciel sélectionné',true),'flash_failure');
            endif;
        }
               
        public function deleteall(){
            $ids = explode('-', $this->request->data('all_ids'));
            if(count($ids)>0 && $ids[0]!=""):
                foreach($ids as $id):
                    if($this->delete($id,true)):
                        $this->Session->setFlash(__('Modification du statut supprimé pris en compte pour tous les logiciels sélectionnés',true),'flash_success'); 
                    else :
                        $this->Session->setFlash(__('Modification du statut supprimé <b>NON</b> pris en compte pour tous les logiciels sélectionnés',true),'flash_failure');
                    endif;
                endforeach;
                sleep(3);
                echo $this->Session->setFlash(__('Mises à jour du statut supprimé complétés',true),'flash_success');
            else :
                $this->Session->setFlash(__('Aucun logiciel sélectionné',true),'flash_failure');
            endif;
            exit();
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
        
        public function get_select_compatible($lot_id,$application_id){
            $list = $this->Logiciel->find('list',array('fields'=>array('Logiciel.id','Logiciel.NOM'),'conditions'=>array('Logiciel.lot_id'=>$lot_id,'Logiciel.application_id'=>$application_id),'order'=>array('Logiciel.NOM'=>'asc'),'group'=>array('Logiciel.NOM'),'recursive'=>0));
            return $list;
        }   
        
        public function json_get_select_compatible($lot_id,$application_id){
            $this->autoRender = false;
            $list = $this->Logiciel->find('list',array('fields'=>array('Logiciel.NOM','Logiciel.id'),'conditions'=>array('Logiciel.lot_id'=>$lot_id,'Logiciel.application_id'=>$application_id),'order'=>array('Logiciel.NOM'=>'asc'),'group'=>array('Logiciel.NOM'),'recursive'=>0));
            return json_encode($list);
        }
        
	public function ajaxadd() {
            $this->autoRender = false;
            if (isAuthorized('logiciels', 'add')) :
		if ($this->request->is('post')) :
                    if(!$this->isExist($this->request->data['Logiciel']['envoutil_id'], $this->request->data['Logiciel']['envversion_id'], $this->request->data['Logiciel']['application_id'], $this->request->data['Logiciel']['lot_id'])){
			$this->Logiciel->create();
			if ($this->Logiciel->save($this->request->data)) {
                                $record['Assobienlogiciel']['bien_id']=$this->request->data['Logiciel']['bien_id'];
                                $record['Assobienlogiciel']['logiciel_id']=$this->Logiciel->getLastInsertID();
                                $record['Assobienlogiciel']['ENVDSIT']=$this->request->data['Logiciel']['ENVDSIT'];
                                $record['Assobienlogiciel']['INSTALL']=$this->request->data['Logiciel']['INSTALL'];
                                if($this->request->data['Logiciel']['INSTALL']==1){
                                    $record['Assobienlogiciel']['DATEINSTALL'] = date('Y-m-d H:i:s');
                                } else {
                                    $record['Assobienlogiciel']['DATEINSTALL'] = null;
                                }                                
                                $this->Logiciel->Assobienlogiciel->create();
                                $this->Logiciel->Assobienlogiciel->save($record);
				$this->Session->setFlash(__('Logiciel sauvegardé',true),'flash_success');
                        } else {
				$this->Session->setFlash(__('Logiciel incorrect, veuillez corriger le logiciel',true),'flash_failure');
			}
			$this->History->goBack(0); 
                    } else {
                        $this->Session->setFlash(__('Logiciel existant avec ce nom, version, application et lot, veuillez corriger le logiciel',true),'flash_failure');
                        $this->History->goBack(0);
                    }
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                 
	}    
        
        public function importCSV(){            
            $file = isset($this->data['Logiciel']['file']['name']) ? $this->data['Logiciel']['file']['name'] : '';
            $file_type = strrchr($file,'.');
            $completpath = WWW_ROOT.'files/upload/';
            if($this->data['Logiciel']['file']['tmp_name']!='' && $file_type=='.csv'):
                $filename = $completpath.$this->data['Logiciel']['file']['name'];
                move_uploaded_file($this->data['Logiciel']['file']['tmp_name'],$filename);               
                $messages = $this->Logiciel->importCSV($this->data['Logiciel']['file']['name']);
                $allmsg = "Importation prise en compte, résultat ci-dessous :<ul>";
                foreach($messages as $message):
                    $x = 0;
                    foreach ($message as $msg):                    
                    $thismsg = !empty($msg) ? $msg : '';
                    $x++;
                    $allmsg .= "<li>".$thismsg."</li>";
                    endforeach;
                endforeach;
                $allmsg .= "</ul>";
                $this->Session->setFlash(__($allmsg,true),'flash_success');
            else :
                $this->Session->setFlash(__('Fichier <b>NON</b> reconnu',true),'flash_failure');
            endif;            
            $this->History->goBack(0);
        }
        
        public function erase($id){
            $this->autoRender = false;
            $this->Logiciel->id = $id;
            $this->Logiciel->delete();
        }
}