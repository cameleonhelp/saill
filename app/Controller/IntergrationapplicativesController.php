<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Assoentiteutilisateurs');
App::import('Controller', 'Applications');
App::import('Controller', 'Etats');
App::import('Controller', 'Types');
App::import('Controller', 'Versions');
App::import('Controller', 'Lots');
App::import('Controller', 'Historyintegrations');
/**
 * Intergrationapplicatives Controller
 *
 * @property Intergrationapplicative $Intergrationapplicative
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class IntergrationapplicativesController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Intergrationapplicative.DATEINSTALL'=>'desc'));
	public $components = array('History','Common');

    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Intégration applicative" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }              
        
        public function get_visibility(){
            if(userAuth('profil_id')==1):
                return null;
            else:
                $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
                return $ObjAssoentiteutilisateurs->json_get_my_entite(userAuth('id'));
            endif;
        }
        
        public function get_restriction($visibility){
            if($visibility == null):
                return "1=1";
            elseif ($visibility !=""):
                return "Intergrationapplicative.entite_id IN (".$visibility.')';
            else:
                return "Intergrationapplicative.entite_id=".userAuth('entite_id');
            endif;
        }
        
        public function get_integration_application_filter($aplication){
            $result = array();
            switch($aplication):
                case null:
                case 'tous':
                    $ObjApplications = new ApplicationsController();
                    $listapp = $ObjApplications->get_str_list();
                    $result['condition']="Intergrationapplicative.application_id IN (".$listapp.")";
                    $result['filter'] = ', pour toutes les applications';
                    break;
                default:
                    $result['condition']="Intergrationapplicative.application_id=".$aplication;
                    $nom = $this->Intergrationapplicative->Application->findById($aplication);
                    $result['filter'] = ', pour l\'application '.$nom['Application']['NOM'];
                    break;
            endswitch;
            return $result;
        }
        
        public function get_integration_install_filter($installe){
            $result = array();
            switch($installe):
                case null:
                case 'tous':
                    $result['condition']="1=1";
                    $result['filter'] = '';
                    break;                         
                case '1':
                    $result['condition']="Intergrationapplicative.INSTALL=0";
                    $result['filter'] = ', non installés';
                    break;
                case '0':
                    $result['condition']="Intergrationapplicative.INSTALL=1";
                    $result['filter']= ', installés';
                    break;                   
            endswitch;     
            return $result;
        }
        
        public function get_integration_valid_filter($valide){
            $result = array();
            switch($valide):
                case null:
                case 'tous':
                    $result['condition']="1=1";
                    $result['filter']= '';
                    break;                          
                case '1':
                    $result['condition']="Intergrationapplicative.CHECK=0";
                    $result['filter']= ', non validés';
                    break;
                case '0':
                    $result['condition']="Intergrationapplicative.CHECK=1";
                    $result['filter']= ', validés';
                    break;                   
            endswitch;
            return $result;
        }
        
        public function get_integration_actif_filter($actif){
            $result = array();
            switch($actif):
                case null:
                case 'tous':
                    $result['condition']="1=1";
                    $result['filter']= '';
                    break;                          
                case '1':
                    $result['condition']="Intergrationapplicative.ACTIF=1";
                    $result['filter']= ', actifs';
                    break;
                case '0':
                    $result['condition']="Intergrationapplicative.ACTIF=0";
                    $result['filter']= ', inactifs';
                    break;                   
            endswitch; 
            return $result;
        }
        
        public function get_integration_type_filter($type){
            $result = array();
            switch($type):
                case null:
                case 'tous':
                    $result['condition']="1=1";
                    $result['filter']= ', pour tous les environnements';
                    break;
                default:
                    $result['condition']="Intergrationapplicative.type_id=".$type;
                    $nom = $this->Intergrationapplicative->Type->findById($type);
                    $result['filter']= ', pour l\'environnement '.$nom['Type']['NOM'];
                    break;
            endswitch; 
            return $result;
        }
        
        public function get_integration_version_filter($version){
            $result = array();
            switch($version):
                case null:
                case 'tous':
                    $result['condition']="1=1";
                    $result['filter'] = ', pour toutes les versions';
                    break;
                default:
                    $result['condition']="Intergrationapplicative.version_id=".$version;
                    $nom = $this->Intergrationapplicative->Version->findById($version);
                    $result['filter']= ', pour la version '.$nom['Version']['NOM'];
                    break;
            endswitch; 
            return $result;
        }
        
        public function get_export($condition){
            $this->Session->delete('xls_export');            
            $export = $this->Intergrationapplicative->find('all',array('conditions'=>$condition,'order' => array('Intergrationapplicative.DATEINSTALL' => 'desc'),'recursive'=>0));
            $this->Session->write('xls_export',$export);    
        }
/**
 * index method
 *
 * @return void
 */
	public function index($aplication=null,$installe=null,$valide=null,$actif=null,$type=null,$version = null) {
            $this->set_title();
            if (isAuthorized('intergrationapplicatives', 'index')) :
                $listentite = $this->get_visibility();
                $restriction = $this->get_restriction($listentite);               
                $getapplication = $this->get_integration_application_filter($aplication);
                $getinstall = $this->get_integration_install_filter($installe);
                $getvalid = $this->get_integration_valid_filter($valide);
                $getactif = $this->get_integration_actif_filter($actif);
                $gettype = $this->get_integration_type_filter($type);
                $getversion = $this->get_integration_version_filter($version);
                $strfilter = $getapplication['filter'].$getinstall['filter'].$getvalid['filter'].$getactif['filter'].$gettype['filter'].$getversion['filter'];
                $newconditions = array($restriction,$getapplication['condition'],$getinstall['condition'],$getvalid['condition'],$getactif['condition'],$gettype['condition'],$getversion['condition']);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));                             
		$this->set('intergrationapplicatives', $this->paginate());
                $this->get_export($newconditions);
                $ObjApplications = new ApplicationsController();
                $ObjEtats = new EtatsController();
                $ObjTypes = new TypesController();
                $ObjVersions = new VersionsController();
                $applications = $ObjApplications->get_list(1);
                $etats = $ObjEtats->get_list(1);
                $types = $ObjTypes->get_list(1);
                $versions = $ObjVersions->get_list(1);
		$this->set(compact('strfilter','applications','etats','types','versions'));  
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                 
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set_title();            
             if (isAuthorized('intergrationapplicatives', 'add')) :  
		$ObjApplications = new ApplicationsController();
                if ($this->request->is('post')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Intergrationapplicative->validate = array();
                        $this->History->goBack(1);
                    else:     
                        $entite_id = $ObjApplications->get_entite_id($this->request->data['Intergrationapplicative']['application_id']);
                        $this->request->data['Intergrationapplicative']['entite_id']=$entite_id;
			$this->Intergrationapplicative->create();
                        if($this->request->data['Intergrationapplicative']['DATEINSTALL'] != ''):
                            $this->request->data['Intergrationapplicative']['INSTALL'] = 1;
                        else:
                            $this->request->data['Intergrationapplicative']['INSTALL'] = 0;
                        endif;
			if ($this->Intergrationapplicative->save($this->request->data)) {
				$this->Session->setFlash(__('Intégration sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Intégration incorrecte, veuillez corriger l\'intégration',true),'flash_failure');
			}
                    endif;
		}
		$applications = $ObjApplications->get_select();
                $ObjTypes = new TypesController();
                $ObjLots = new LotsController();
		$types = $ObjTypes->get_select();
                $lots = $ObjLots->get_select();
		$versions = array();
		$this->set(compact('applications', 'types','lots', 'versions'));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
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
            $this->set_title();            
             if (isAuthorized('intergrationapplicatives', 'edit')) : 
                $ObjApplications = new ApplicationsController();
		if (!$this->Intergrationapplicative->exists($id)) {
			throw new NotFoundException(__('Intégration incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Intergrationapplicative->validate = array();
                        $this->History->goBack(1);
                    else:  
                        $entite_id = $ObjApplications->get_entite_id($this->request->data['Intergrationapplicative']['application_id']);
                        $this->request->data['Intergrationapplicative']['entite_id']=$entite_id;                        
                        if($this->request->data['Intergrationapplicative']['DATEINSTALL'] != ''):
                            $this->request->data['Intergrationapplicative']['INSTALL'] = 1;
                        else:
                            $this->request->data['Intergrationapplicative']['INSTALL'] = 0;
                        endif;                        
			if ($this->Intergrationapplicative->save($this->request->data)) {
				$this->Session->setFlash(__('Intégration modifiée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Intégration incorrecte, veuillez corriger l\'intégration',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Intergrationapplicative.' . $this->Intergrationapplicative->primaryKey => $id));
			$this->request->data = $this->Intergrationapplicative->find('first', $options);
		}
		$applications = $ObjApplications->get_select();
                $ObjTypes = new TypesController();
                $ObjVersions = new VersionsController();
                $ObjLots = new LotsController();
                $ObjHistoryintegrations = new HistoryintegrationsController();
		$types = $ObjTypes->get_select();
                $lots = $ObjLots->get_select();
		$versions = $ObjVersions->get_select();
                $histories = $ObjHistoryintegrations->get_list($id);
		$this->set(compact('applications', 'types','lots', 'versions','histories'));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                 
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$loop = false) {
            $this->set_title();            
            if (isAuthorized('intergrationapplicatives', 'delete')) : 
		$this->Intergrationapplicative->id = $id;
		if (!$this->Intergrationapplicative->exists()) {
			throw new NotFoundException(__('Intégration incorrect'));
		}
                $obj = $this->Intergrationapplicative->find('first',array('conditions'=>array('Intergrationapplicative.id'=>$id),'recursive'=>0));
                if($obj['Intergrationapplicative']['ACTIF']==1):
                    $this->saveHistory($id);
                    $newactif = $obj['Intergrationapplicative']['ACTIF'] == 1 ? 0 : 1;
                    if($newactif == 0):
                        $this->Intergrationapplicative->saveField('INSTALL',0);
                        $this->Intergrationapplicative->saveField('DATEINSTALL',NULL);
                        $this->Intergrationapplicative->saveField('CHECK',0);
                        $this->Intergrationapplicative->saveField('DATECHECK',NULL);
                    endif;
                    if ($this->Intergrationapplicative->saveField('ACTIF',$newactif)) {
                            if ($newactif==0): 
                                $this->Session->setFlash(__('Intégration supprimée',true),'flash_success');
                                if($loop) : return true; endif;
                            else:
                                $this->Session->setFlash(__('Intégration activée',true),'flash_success');
                                if($loop) : return true; endif;
                            endif;
                    } else {
                            $this->Session->setFlash(__('Intégration <b>NON</b> supprimée',true),'flash_failure');
                            if($loop) : return false; endif;
                    }
                    if(!$loop) : $this->History->notmove();  
                    else:
                        return true;
                    endif;
                else:
                    if($this->Intergrationapplicative->delete()):                       
                        $this->Session->setFlash(__('Intégration supprimée',true),'flash_success');
                        if(!$loop) : $this->History->goBack(1); 
                        else:
                            return true;
                        endif;
                    else:
                        $this->Session->setFlash(__('Intégration <b>NON</b> supprimée',true),'flash_failure');
                        if($loop) : return false; endif;
                    endif;
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                  
	}
        
        
        public function ajax_actif($id=null){
                $newid = $id == null ? $this->request->data('id') : $id;
                $result = false;                
                $this->Intergrationapplicative->id = $newid;
                $obj = $this->Intergrationapplicative->find('first',array('conditions'=>array('Intergrationapplicative.id'=>$newid),'recursive'=>0));
                $newactif = $obj['Intergrationapplicative']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Intergrationapplicative->saveField('ACTIF',$newactif)) {
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
		if ($id==null):
                    exit();
                else:
                    return $result;
                endif;
        }   
        
        public function ajax_install($id=null){
                $newid = $id == null ? $this->request->data('id') : $id;
                $result = false;    
                $error = false;
                $this->Intergrationapplicative->id = $newid;
                $obj = $this->Intergrationapplicative->find('first',array('conditions'=>array('Intergrationapplicative.id'=>$newid),'recursive'=>0));
                $newactif = $obj['Intergrationapplicative']['INSTALL'] == 1 ? 0 : 1;
                $date = $newactif == 0 ? null : date('Y-m-d H:i:s');
                if($newactif == 0):
                    if (!$this->Intergrationapplicative->saveField('CHECK',$newactif) || !$this->Intergrationapplicative->saveField('DATECHECK',$date)):
                        $error = true;
                    endif;
                endif;
		if ($this->Intergrationapplicative->saveField('INSTALL',$newactif) && $this->Intergrationapplicative->saveField('DATEINSTALL',$date) && !$error) {
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
                $this->Intergrationapplicative->id = $newid;
                $obj = $this->Intergrationapplicative->find('first',array('conditions'=>array('Intergrationapplicative.id'=>$newid),'recursive'=>0));
                if($obj['Intergrationapplicative']['INSTALL'] == 1):
                    $newactif = $obj['Intergrationapplicative']['CHECK'] == 1 ? 0 : 1;
                    $date = $newactif == 0 ? null : date('Y-m-d');
                    $user = $newactif == 0 ? null : userAuth('id');
                    if ($this->Intergrationapplicative->saveField('CHECK',$newactif) && $this->Intergrationapplicative->saveField('DATECHECK',$date)) {
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
                    $this->Session->setFlash(__('Pour faire la modification du statut validé, l\'intégration doit être installée.',true),'flash_failure');
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
            $this->set_title();            
            if (isAuthorized('intergrationapplicatives', 'duplicate')) :
		$this->Intergrationapplicative->id = $id;
                $record = $this->Intergrationapplicative->read();
                unset($record['Intergrationapplicative']['id']);
                unset($record['Intergrationapplicative']['application_id']);  
                $record['Intergrationapplicative']['application_id']=0;
                unset($record['Intergrationapplicative']['CHECK']);
                unset($record['Intergrationapplicative']['DATECHECK']);
                unset($record['Intergrationapplicative']['INSTALL']);
                unset($record['Intergrationapplicative']['DATEINSTALL']);
                unset($record['Intergrationapplicative']['ACTIF']);
                unset($record['Intergrationapplicative']['created']);                
                unset($record['Intergrationapplicative']['modified']);
                $this->Intergrationapplicative->create();
                if ($this->Intergrationapplicative->save($record)) {
                        $this->Session->setFlash(__('Intégration dupliquée',true),'flash_success');
                        $this->redirect(array('action'=>'edit',$this->Intergrationapplicative->getLastInsertID()));
                } else {
                        $this->Session->setFlash(__('Intégration incorrecte, veuillez corriger l\'Intégration',true),'flash_failure');
                }                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                
	}           
        
        public function saveHistory($id=null,$msg=null){
            if($id!=null && userAuth('id')!=null):
                $msg = $msg==null ? true : false;
                $obj = $this->Intergrationapplicative->findById($id); 
                $record['Historyintegration']['intergrationapplicative_id']=$id;
                $record['Historyintegration']['INSTALL']=$obj['Intergrationapplicative']['INSTALL'];
                $record['Historyintegration']['DATEINSTALL']=$obj['Intergrationapplicative']['DATEINSTALL'];
                $record['Historyintegration']['CHECK']=$obj['Intergrationapplicative']['CHECK'];
                $record['Historyintegration']['DATECHECK']=$obj['Intergrationapplicative']['DATECHECK'];
                $record['Historyintegration']['ACTIF']=$obj['Intergrationapplicative']['ACTIF'];
                $record['Historyintegration']['MODIFIEDBY']= userAuth('id'); 
                $record['Historyintegration']['created']=date('Y-m-d H:i:s');
                $record['Historyintegration']['modified']=date('Y-m-d H:i:s');
                $this->Intergrationapplicative->Historyintegration->create();
                if ($this->Intergrationapplicative->Historyintegration->save($record)) {
                        if ($msg) : $this->Session->setFlash(__('Intégration historisée',true),'flash_success'); endif;
                } else {
                        if ($msg) : $this->Session->setFlash(__('Historisation du l\'intégration incorrecte, veuillez corriger l\'intégration',true),'flash_failure'); endif;
                }
            else:
                $this->Session->setFlash(__('Historisation impossible l\'intégration est incorect.',true),'flash_warning'); 
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;
        }
        
        public function search($aplication=null,$installe=null,$valide=null,$actif=null,$type=null,$version = null,$keywords=null){
            $this->set_title();
            if (isAuthorized('intergrationapplicatives', 'index')) :
                if(isset($this->params->data['Intergrationapplicative']['SEARCH'])):
                    $keywords = $this->params->data['Intergrationapplicative']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords)); 
                    $listentite = $this->get_visibility();
                    $restriction = $this->get_restriction($listentite);               
                    $getapplication = $this->get_integration_application_filter($aplication);
                    $getinstall = $this->get_integration_install_filter($installe);
                    $getvalid = $this->get_integration_valid_filter($valide);
                    $getactif = $this->get_integration_actif_filter($actif);
                    $gettype = $this->get_integration_type_filter($type);
                    $getversion = $this->get_integration_version_filter($version);
                    $strfilter = $getapplication['filter'].$getinstall['filter'].$getvalid['filter'].$getactif['filter'].$gettype['filter'].$getversion['filter'];
                    $newconditions = array($restriction,$getapplication['condition'],$getinstall['condition'],$getvalid['condition'],$getactif['condition'],$gettype['condition'],$getversion['condition']);
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Application.NOM LIKE '%".$value."%'","Type.NOM LIKE '%".$value."%'","Lot.NOM LIKE '%".$value."%'","Version.NOM LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newconditions,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0)); 
                    $this->set('intergrationapplicatives', $this->paginate());
                    $this->get_export($conditions);
                    $ObjApplications = new ApplicationsController();
                    $ObjEtats = new EtatsController();
                    $ObjTypes = new TypesController();
                    $ObjVersions = new VersionsController();
                    $applications = $ObjApplications->get_list(1);
                    $etats = $ObjEtats->get_list(1);
                    $types = $ObjTypes->get_list(1);
                    $versions = $ObjVersions->get_list(1);
                    $this->set(compact('strfilter','applications','etats','types','versions'));                   
                else:
                    $this->redirect(array('action'=>'index',$aplication,$installe,$valide,$actif,$type,$version));
                endif; 
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;  
        }  
        
        public function installall($id){
            $this->autoRender = false;
            $ids = explode('-', $this->request->data('all_ids'));
            if(count($ids)>0 && $ids[0]!=""):
                foreach($ids as $id):
                    if($this->ajax_install($id)):
                        echo $this->Session->setFlash(__('Modification du statut installé pris en compte pour toutes les Intégration sélectionnées',true),'flash_success'); 
                    else :
                        $this->Session->setFlash(__('Modification du statut installé <b>NON</b> pris en compte pour toutes les Intégration sélectionnées',true),'flash_failure');
                    endif;
                endforeach;
                sleep(3);
                echo $this->Session->setFlash(__('Mises à jour du statut installé complétées',true),'flash_success');
            else :
                $this->Session->setFlash(__('Aucune Intégration sélectionnée',true),'flash_failure');
            endif;
            return $this->request->data('all_ids');           
        }
        
        public function checkall($id){
            $this->autoRender = false;
            $ids = explode('-', $this->request->data('all_ids'));
            if(count($ids)>0 && $ids[0]!=""):
                foreach($ids as $id):
                    if($this->ajax_check($id)):
                        echo $this->Session->setFlash(__('Modification du statut validé pris en compte pour tous les intergrationapplicatives sélectionnés',true),'flash_success'); 
                    else :
                        $this->Session->setFlash(__('Modification du statut validé <b>NON</b> pris en compte pour tous les intergrationapplicatives sélectionnés',true),'flash_failure');
                    endif;
                endforeach;
                sleep(3);
                echo $this->Session->setFlash(__('Mises à jour du statut validé complétées',true),'flash_success');
            else :
                $this->Session->setFlash(__('Aucune Intégration sélectionnée',true),'flash_failure');
            endif;
            return $this->request->data('all_ids');                     
        }
        
        public function deleteall($id){
            $this->autoRender = false;
            $ids = explode('-', $this->request->data('all_ids'));
            if(count($ids)>0 && $ids[0]!=""):
                foreach($ids as $id):
                    if($this->delete($id,true)):
                        echo $this->Session->setFlash(__('Modification du statut supprimé pris en compte pour toutes les Intégration sélectionnées',true),'flash_success'); 
                    else :
                        $this->Session->setFlash(__('Modification du statut supprimé <b>NON</b> pris en compte pour toutes les Intégration sélectionnées',true),'flash_failure');
                    endif;
                endforeach;
                sleep(3);
                echo $this->Session->setFlash(__('Mises à jour du statut supprimé complétées',true),'flash_success');
            else :
                $this->Session->setFlash(__('Aucune Intégration sélectionnée',true),'flash_failure');
            endif;
            return $this->request->data('all_ids');             
        }     
        
        public function rapport(){
             if (isAuthorized('intergrationapplicatives', 'rapports')) :            
                $this->set_title();
                $mois = array('01'=>'Janvier','02'=>'Février','03'=>'Mars','04'=>'Avril','05'=>'Mai','06'=>'Juin','07'=>'Juillet','08'=>'Août','09'=>'Septembre','10'=>'Octobre','11'=>'Novembre','12'=>'Décembre');
                $fiveyearago = date('Y')-5;
                for($i=0;$i<6;$i++):
                    $year = $fiveyearago + $i;
                    $annee[$year]=$year;
                endfor;
                $ObjApplications = new ApplicationsController();
                $ObjTypes = new TypesController();
                $ObjLots = new LotsController();
		$applications = $ObjApplications->get_select();
		$environnements = $ObjTypes->get_select();
                $lots = $ObjLots->get_select();
                $this->set(compact('applications', 'mois', 'annee','lots','environnements'));
                if ($this->request->is('post')):
                    $mois = $this->data['Intergrationapplicative']['mois'];
                    $annee = $this->data['Intergrationapplicative']['annee'];
                    $thisapplications = $this->data['Intergrationapplicative']['application_id'];
                    $listapplications = '';
                    foreach($thisapplications as $key => $value):
                        $listapplications.=$value.',';
                    endforeach;
                    $selectapplications = ' AND application_id in ('.substr_replace($listapplications ,"",-1).')';
                    $selectlot = $this->data['Intergrationapplicative']['lot_id']=='' || $this->data['Intergrationapplicative']['lot_id']=='4' ? ' AND intergrationapplicatives.lot_id != 3' : ' AND (intergrationapplicatives.lot_id = '.$this->data['Intergrationapplicative']['lot_id'].' AND intergrationapplicatives.lot_id != 3)';
                    $selecttype = $this->data['Intergrationapplicative']['environnement_id']=='' || $this->data['Intergrationapplicative']['environnement_id']=='16' ? '' : ' AND type_id = '.$this->data['Intergrationapplicative']['environnement_id'];
                    $sql = "select count(intergrationapplicatives.id) as NB,MONTH(DATEINSTALL) as MOIS, lots.NOM as LOT,applications.NOM as APPLICATION, types.`NOM` AS TYPE,intergrationapplicatives.DATEINSTALL AS DATEINSTALL,versions.NOM AS VERSION
                            from intergrationapplicatives
                            LEFT JOIN lots on intergrationapplicatives.lot_id = lots.id
                            LEFT JOIN versions on intergrationapplicatives.version_id = versions.id
                            LEFT JOIN applications on intergrationapplicatives.application_id = applications.id
                            LEFT JOIN types on intergrationapplicatives.type_id = types.id
                            WHERE MONTH(DATEINSTALL) = ".$mois.
                            " AND YEAR(DATEINSTALL) = ".$annee." ".$selectapplications.$selectlot.$selecttype.
                            " group by lots.NOM, versions.NOM, applications.NOM, types.NOM, intergrationapplicatives.DATEINSTALL
                            order by lots.NOM asc, versions.NOM asc, applications.NOM asc, types.NOM asc;";
                    $results = $this->Intergrationapplicative->query($sql);
                    $this->set('results',$results);
                    $chartsql = "select count(intergrationapplicatives.id) as NB,lots.NOM as LOT,applications.NOM as APPLICATION
                            from intergrationapplicatives
                            LEFT JOIN lots on intergrationapplicatives.lot_id = lots.id
                            LEFT JOIN applications on intergrationapplicatives.application_id = applications.id
                            WHERE MONTH(DATEINSTALL) = ".$mois.
                            " AND YEAR(DATEINSTALL) = ".$annee." ".$selectapplications.$selectlot.$selecttype.
                            " group by lot_id, application_id
                            order by lot_id asc, application_id asc;";
                    $chartresults = $this->Intergrationapplicative->query($chartsql);
                    /**
                     * retravailler le résultat pour mettre des zéro si plusieurs lots et applications différentes
                     */
                    $appresultsql= "select applications.NOM
                            from intergrationapplicatives
                            LEFT JOIN applications on intergrationapplicatives.application_id = applications.id
                            WHERE MONTH(DATEINSTALL) = ".$mois.
                            " AND YEAR(DATEINSTALL) = ".$annee." ".$selectapplications.$selectlot.$selecttype.
                            " group by  application_id
                            order by application_id asc;";
                    $appresult = $this->Intergrationapplicative->query($appresultsql);
                    $lotresultsql= "select lots.NOM
                            from intergrationapplicatives
                            LEFT JOIN lots on intergrationapplicatives.lot_id = lots.id
                            LEFT JOIN applications on intergrationapplicatives.application_id = applications.id
                            WHERE MONTH(DATEINSTALL) = ".$mois.
                            " AND YEAR(DATEINSTALL) = ".$annee." ".$selectapplications.$selectlot.$selecttype.
                            " group by lot_id
                            order by lot_id asc;";
                    $lotresult = $this->Intergrationapplicative->query($lotresultsql);                    
                    if(count($lotresult)>1):
                        $i = 0;
                        $array = array();
                        foreach($chartresults as $result):
                                $array[]=array($result['lots']['LOT'],$result['applications']['APPLICATION']);
                        endforeach;
                        foreach($lotresult as $lot):
                            foreach($appresult as $app):
                                $completearray[]=array($lot['lots']['NOM'],$app['applications']['NOM']);
                            endforeach;
                            $i++;
                        endforeach;
                    $diff = narray_diff ($array,$completearray);
                    foreach($diff as $result):
                        $add[]=array(array('NB' => '0'),'lots' => array('LOT' => $result[0]),'applications' => array('APPLICATION' => $result[1]));
                    endforeach;
                    if(isset($add) && is_array($add)):
                    $chartresults = array_merge($chartresults,$add);
                    else:
                        $chartresults = $chartresults;
                    endif;
                    endif;
                    $this->set('chartresults',$chartresults);   
                    $charthistosql = "select MIN(YEAR(DATEINSTALL)) as MINANNEE, count(intergrationapplicatives.id) as NB,lots.NOM as LOT,MONTH(DATEINSTALL) AS MOIS,CONCAT(IF(MONTH(DATEINSTALL)<10,CONCAT('0',MONTH(DATEINSTALL)),MONTH(DATEINSTALL)),'/',YEAR(DATEINSTALL)) as MOISANNEE
                            from intergrationapplicatives
                            LEFT JOIN lots on intergrationapplicatives.lot_id = lots.id
                            WHERE YEAR(DATEINSTALL) < ".($annee+1)." ".$selectapplications.$selectlot.$selecttype.
                            " group by CONCAT(YEAR(DATEINSTALL),IF(MONTH(DATEINSTALL)<10,CONCAT('0',MONTH(DATEINSTALL)),MONTH(DATEINSTALL))),lot_id
                            order by CONCAT(YEAR(DATEINSTALL),IF(MONTH(DATEINSTALL)<10,CONCAT('0',MONTH(DATEINSTALL)),MONTH(DATEINSTALL))) asc,lot_id asc;";
                    $charthistoresults = $this->Intergrationapplicative->query($charthistosql);
                    $this->set('charthistoresults',$charthistoresults);                     
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
            endif;                     
        } 
        
        public function export_xls() {
		$data = $this->Session->read('xls_export');             
		$this->set('rows',$data);
		$this->render('export_xls','export_xls');
	}            
}
