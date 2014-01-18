<?php
App::uses('AppController', 'Controller');
/**
 * Intergrationapplicatives Controller
 *
 * @property Intergrationapplicative $Intergrationapplicative
 * @property PaginatorComponent $Paginator
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
 * index method
 *
 * @return void
 */
	public function index($aplication=null,$installe=null,$valide=null,$actif=null,$type=null,$version = null) {
            $this->set('title_for_layout','Intégration applicative');
            if (isAuthorized('intergrationapplicatives', 'index')) :
                switch($aplication):
                    case null:
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter = ', pour toutes les applications';
                        break;
                    default:
                        $newconditions[]="Intergrationapplicative.application_id=".$aplication;
                        $nom = $this->Intergrationapplicative->Application->findById($aplication);
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
                        $newconditions[]="Intergrationapplicative.INSTALL=0";
                        $strfilter .= ', non installés';
                        break;
                    case '0':
                        $newconditions[]="Intergrationapplicative.INSTALL=1";
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
                        $newconditions[]="Intergrationapplicative.CHECK=0";
                        $strfilter .= ', non validés';
                        break;
                    case '0':
                        $newconditions[]="Intergrationapplicative.CHECK=1";
                        $strfilter .= ', validés';
                        break;                   
                endswitch;   
                switch($actif):
                    case null:
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter .= '';
                        break;                          
                    case '1':
                        $newconditions[]="Intergrationapplicative.ACTIF=1";
                        $strfilter .= ', actifs';
                        break;
                    case '0':
                        $newconditions[]="Intergrationapplicative.ACTIF=0";
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
                        $newconditions[]="Intergrationapplicative.type_id=".$type;
                        $this->Intergrationapplicative->Type->recursive = -1;
                        $nom = $this->Intergrationapplicative->Type->findById($type);
                        $strfilter .= ', pour l\'environnement '.$nom['Type']['NOM'];
                        break;
                endswitch;    
                switch($version):
                    case null:
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter = ', pour toutes les versions';
                        break;
                    default:
                        $newconditions[]="Intergrationapplicative.version_id=".$version;
                        $nom = $this->Intergrationapplicative->Version->findById($version);
                        $strfilter = ', pour la version '.$nom['Version']['NOM'];
                        break;
                endswitch;                
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Intergrationapplicative->recursive = 0;
                $export = $this->Intergrationapplicative->find('all',array('conditions'=>$newconditions,'order' => array('Intergrationapplicative.DATEINSTALL' => 'desc'),'recursive'=>0));
                $this->Session->delete('xls_export');
                $this->Session->write('xls_export',$export);                 
		$this->set('intergrationapplicatives', $this->paginate());
                $applications = $this->requestAction('applications/get_list/1');
                $etats = $this->requestAction('etats/get_list/1');
                $types = $this->requestAction('types/get_list/1');
                $versions = $this->requestAction('versions/get_list/1');
		$this->set(compact('applications','etats','types','versions'));  
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
            $this->set('title_for_layout','Intégration applicative');            
		if (!$this->Intergrationapplicative->exists($id)) {
			throw new NotFoundException(__('Invalid intergrationapplicative'));
		}
		$options = array('conditions' => array('Intergrationapplicative.' . $this->Intergrationapplicative->primaryKey => $id));
		$this->set('intergrationapplicative', $this->Intergrationapplicative->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','Intégration applicative');            
             if (isAuthorized('intergrationapplicatives', 'add')) :  
		if ($this->request->is('post')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Intergrationapplicative->validate = array();
                        $this->History->goBack(1);
                    else:                    
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
		$applications = $this->requestAction('applications/get_select');
		$types = $this->requestAction('types/get_select');
                $lots = $this->requestAction('lots/get_select');
		$versions = array();
		$this->set(compact('applications', 'types','lots', 'versions'));
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
            $this->set('title_for_layout','Intégration applicative');            
             if (isAuthorized('intergrationapplicatives', 'edit')) :             
		if (!$this->Intergrationapplicative->exists($id)) {
			throw new NotFoundException(__('Intégration incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Intergrationapplicative->validate = array();
                        $this->History->goBack(1);
                    else:  
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
		$applications = $this->requestAction('applications/get_select');
		$types = $this->requestAction('types/get_select');
                $lots = $this->requestAction('lots/get_select');
		$versions = $this->requestAction('versions/get_select');
                $histories = $this->requestAction('historyintegrations/get_list/'.$id);
		$this->set(compact('applications', 'types','lots', 'versions','histories'));
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
	public function delete($id = null,$loop = false) {
            $this->set('title_for_layout','Intégration applicative');            
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
                throw new NotAuthorizedException();
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
            $this->set('title_for_layout','Intégration applicative');            
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
                throw new NotAuthorizedException();
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
                throw new NotAuthorizedException();
            endif;
        }
        
        public function search(){
            if (isAuthorized('intergrationapplicatives', 'index')) :
                $keyword=isset($this->params->data['Intergrationapplicative']['SEARCH']) ? $this->params->data['Intergrationapplicative']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Application.NOM LIKE '%".$keyword."%'","Type.NOM LIKE '%".$keyword."%'","Lot.NOM LIKE '%".$keyword."%'","Version.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Intergrationapplicative->recursive = 0;
                $this->set('intergrationapplicatives', $this->paginate());  
                $applications = $this->requestAction('applications/get_list/1');
                $etats = $this->requestAction('etats/get_list/1');
                $types = $this->requestAction('types/get_list/1');
		$this->set(compact('applications','etats','types'));                 
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }  
        
        public function installall($id){
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
            exit();            
        }
        
        public function checkall($id){
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
            exit();              
        }
        
        public function deleteall($id){
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
            exit();             
        }     
        
        public function rapport(){
             if (isAuthorized('intergrationapplicatives', 'rapports')) :            
                $this->set('title_for_layout','Rapport intégration applicatives');
                $mois = array('01'=>'Janvier','02'=>'Février','03'=>'Mars','04'=>'Avril','05'=>'Mai','06'=>'Juin','07'=>'Juillet','08'=>'Août','09'=>'Septembre','10'=>'Octobre','11'=>'Novembre','12'=>'Décembre');
                $fiveyearago = date('Y')-5;
                for($i=0;$i<6;$i++):
                    $year = $fiveyearago + $i;
                    $annee[$year]=$year;
                endfor;
		$applications = $this->requestAction('applications/get_select');
		$environnements = $this->requestAction('types/get_select');
                $lots = $this->requestAction('lots/get_select');
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
                    $selectlot = $this->data['Intergrationapplicative']['lot_id']=='' || $this->data['Intergrationapplicative']['lot_id']=='4' ? ' AND lot_id != 3' : ' AND (lot_id = '.$this->data['Intergrationapplicative']['lot_id'].' AND lot_id != 3)';
                    $selecttype = $this->data['Intergrationapplicative']['environnement_id']=='' || $this->data['Intergrationapplicative']['environnement_id']=='16' ? '' : ' AND type_id = '.$this->data['Intergrationapplicative']['environnement_id'];
                    $sql = "select count(intergrationapplicatives.id) as NB,MONTH(DATEINSTALL) as MOIS, lots.NOM as LOT,applications.NOM as APPLICATION, types.`NOM` AS TYPE
                            from intergrationapplicatives
                            LEFT JOIN lots on intergrationapplicatives.lot_id = lots.id
                            LEFT JOIN applications on intergrationapplicatives.application_id = applications.id
                            LEFT JOIN types on intergrationapplicatives.type_id = types.id
                            WHERE MONTH(DATEINSTALL) = ".$mois.
                            " AND YEAR(DATEINSTALL) = ".$annee." ".$selectapplications.$selectlot.$selecttype.
                            " group by lot_id, application_id, type_id
                            order by lot_id asc, application_id asc, type_id asc;";
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
                    $charthistosql = "select count(intergrationapplicatives.id) as NB,lots.NOM as LOT,MONTH(DATEINSTALL) as MOIS
                            from intergrationapplicatives
                            LEFT JOIN lots on intergrationapplicatives.lot_id = lots.id
                            WHERE YEAR(DATEINSTALL) = ".$annee." ".$selectapplications.$selectlot.$selecttype.
                            " group by MONTH(DATEINSTALL),lot_id
                            order by MONTH(DATEINSTALL) asc,lot_id asc;";
                    $charthistoresults = $this->Intergrationapplicative->query($charthistosql);
                    $this->set('charthistoresults',$charthistoresults);                     
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                     
        }  
        
        public function export_xls() {
		$data = $this->Session->read('xls_export');             
		$this->set('rows',$data);
		$this->render('export_xls','export_xls');
	}            
}
