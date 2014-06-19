<?php
App::uses('AppController', 'Controller');
App::uses('AssoentiteutilisateursController', 'Controller');
App::uses('UsagesController', 'Controller');
App::uses('TypesController', 'Controller');
App::uses('ApplicationsController', 'Controller');
App::uses('DsitenvsController', 'Controller');
App::uses('EnvoutilsController', 'Controller');
App::uses('HistorybiensController', 'Controller');
App::uses('CpusesController', 'Controller');
App::uses('LotsController', 'Controller');
App::uses('ChassisController', 'Controller');
App::uses('ModelesController', 'Controller');
App::uses('LogicielsController', 'Controller');
App::uses('AssobienlogicielsController', 'Controller');
/**
 * Biens Controller
 *
 * @property Bien $Bien
 * @property PaginatorComponent $Paginator
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class BiensController extends AppController {

    /**
     * Components
     */
    public $paginate = array('limit' => 25,'order'=>array('Bien.DATEINSTALL'=>'desc'));
    public $components = array('History','Common');


    /**
     * limite la visibilité de l'utilisateur à ses entités
     * 
     * @return null
     */
    public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            return $ObjAssoentiteutilisateurs->json_get_my_entite(userAuth('id'));
        endif;
    }

    /**
     * limte la liste aux entités
     * 
     * @param string $visibility
     * @return string
     */
    public function get_restriction($visibility){
        if($visibility == null):
            return "1=1";
        elseif ($visibility !=""):
            return "Bien.entite_id IN (".$visibility.')';
        else:
            return "Bien.entite_id=".userAuth('entite_id');
        endif;
    }

    /**
     * filtre par application
     * 
     * @param int $application
     * @return string
     */
    public function get_bien_application_filter($application){
        $result = array();
        $ObjApplications = new ApplicationsController();	
        switch($application):
            case null:
            case 'tous':
                $listapp = $ObjApplications->get_str_list();
                $result['condition']="Bien.application_id IN (".$listapp.")";
                $result['filter'] = ', pour toutes les applications';
                break;
            default:
                $result['condition']="Bien.application_id=".$application;
                $nom = $this->Bien->Application->findById($application);
                $result['filter'] = ', pour l\'application '.$nom['Application']['NOM'];
                break;
        endswitch;     
        return $result;
    }

    /**
     * filtre sur l'état d'installation
     * 
     * @param int $installe
     * @return string
     */
    public function get_bien_install_filter($installe){
        $result = array();
        switch($installe):
            case null:
            case 'tous':
                $result['condition']="1=1";
                $result['filter']= '';
                break;                         
            case '1':
                $result['condition']="Bien.INSTALL=0";
                $result['filter']= ', non installés';
                break;
            case '0':
                $result['condition']="Bien.INSTALL=1";
                $result['filter']= ', installés';
                break;                   
        endswitch;
        return $result;
    }

    /**
     * filtre sur l'état de validité
     * 
     * @param int $valide
     * @return string
     */
    public function get_bien_valid_filter($valide){
        $result = array();
        switch($valide):
            case null:
            case 'tous':
                $result['condition']="1=1";
                $result['filter']= '';
                break;                          
            case '1':
                $result['condition']="Bien.CHECK=0";
                $result['filter']= ', non validés';
                break;
            case '0':
                $result['condition']="Bien.CHECK=1";
                $result['filter']= ', validés';
                break;                   
        endswitch;      
        return $result;
    }

    /**
     * filtre sur l'état actif 
     * 
     * @param int $actif
     * @return string
     */
    public function get_bien_actif_filter($actif){
        $result = array();
        switch($actif):
            case 'tous':
                $result['condition']="1=1";
                $result['filter']= '';
                break; 
            case null:                    
            case '0':
                $result['condition']="Bien.ACTIF=1";
                $result['filter']= ', actifs';
                break;
            case '1':
                $result['condition']="Bien.ACTIF=0";
                $result['filter']= ', inactifs';
                break;                   
        endswitch;
        return $result;
    }

    /**
     * filtre sur l'environnement du bien
     * 
     * @param int $type de l'environnement
     * @return string
     */
    public function get_bien_type_filter($type){
        $result = array();
        switch($type):
            case null:
            case 'tous':
                $result['condition']="1=1";
                $result['filter']= ', pour tous les environnements';
                break;
            default:
                $result['condition']="Bien.type_id=".$type;
                $nom = $this->Bien->Type->findById($type);
                $result['filter']= ', pour l\'environnement '.$nom['Type']['NOM'];
                break;
        endswitch;
        return $result;
    }

    /**
     * filtre sur l'usage
     * 
     * @param int $usage
     * @return string
     */
    public function get_bien_usage_filter($usage){
        $result = array();
        switch($usage):
            case null:
            case 'tous':
                $result['condition']="1=1";
                $result['filter']= ', pour tous les usages';
                break;
            default:
                $result['condition']="Bien.usage_id=".$usage;
                $nom = $this->Bien->Usage->findById($usage);
                $result['filter']= ', pour l\'usage '.$nom['Usage']['NOM'];
                break;
        endswitch; 
        return $result;
    }

    /**
     * met en variable de session l'export
     * 
     * @param array $conditions
     * @return array biens
     */
    public function get_export($conditions){
        $this->Session->delete('xls_export');
        $export = $this->Bien->find('all',array('conditions'=>$conditions,'order' => array('Bien.DATEINSTALL' => 'desc'),'recursive'=>0));
        $this->Session->write('xls_export',$export);
        return $export;
    }

    /**
     * liste des biens
     * 
     * @param string $aplication
     * @param string $installe
     * @param string $valide
     * @param string $actif
     * @param string $type
     * @param string $usage
     * @throws UnauthorizedException
     */
    public function index($aplication=null,$installe=null,$valide=null,$actif=null,$type=null,$usage=null) {
        if (isAuthorized('biens', 'index')) :
            $listentite = $this->get_visibility(); 
            $resttriction = $this->get_restriction($listentite);
            $getapplication = $this->get_bien_application_filter($aplication);
            $getinstall = $this->get_bien_install_filter($installe);
            $getvalid = $this->get_bien_valid_filter($valide);
            $getactif = $this->get_bien_actif_filter($actif);
            $gettype = $this->get_bien_type_filter($type);
            $getusage = $this->get_bien_usage_filter($usage);
            $strfilter = $getapplication['filter'].$getinstall['filter'].$getvalid['filter'].$getactif['filter'].$gettype['filter'].$getusage['filter'];
            $newconditions = array($resttriction,$getapplication['condition'],$getinstall['condition'],$getvalid['condition'],$getactif['condition'],$gettype['condition'],$getusage['condition']);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));
            $export = $this->get_export($newconditions);
            $ObjApplications = new ApplicationsController();
            $ObjTypes = new TypesController();
            $ObjUsages = new UsagesController();	
            $applications = $ObjApplications->get_list(1);
            $types = $ObjTypes->get_list(1);
            $usages = $ObjUsages->get_list(1);               
            $this->set(compact('strfilter','export','applications','types','usages'));
            $this->set('biens', $this->paginate());    
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }

    /**
     * Ajoute un bien
     * 
     * @throws UnauthorizedException
     */
    public function add() {            
        if (isAuthorized('biens', 'add')) :   
            $ObjApplications = new ApplicationsController();
            $ObjModeles = new ModelesController();
            $ObjChassis = new ChassisController();
            $ObjTypes = new TypesController();	
            $ObjUsages = new UsagesController();	
            $ObjLots = new LotsController();
            $ObjCpuses = new CpusesController();	
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Bien->validate = array();
                    $this->History->goBack(1);
                else:
                    $entite_id = $ObjApplications->get_entite_id($this->request->data['Bien']['application_id']);
                    $this->request->data['Bien']['entite_id']=$entite_id;
                    $this->Bien->create();
                    if ($this->Bien->save($this->request->data)) {
                            $this->Session->setFlash(__('Bien sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                        if (!$this->isUnique($this->request->data['Bien']['NOM'])):
                            $this->Session->setFlash(__('Le nom '.$this->request->data['Bien']['NOM'].' du bien doit être unique, ce nom existe déjà.',true),'flash_failure');
                        else:
                            $this->Session->setFlash(__('Bien incorrect, veuillez corriger le bien',true),'flash_failure');
                        endif;
                    }                        
                endif;
            endif;
            $modeles = $ObjModeles->get_select();
            $chassis = $ObjChassis->get_select();
            $types = $ObjTypes->get_select();
            $usages = $ObjUsages->get_select();
            $lots = $ObjLots->get_select();
            $applications = $ObjApplications->get_select();
            $cpuses = $ObjCpuses->get_select();
            $listbiens = array();
            $this->set(compact('modeles', 'chassis', 'types', 'usages', 'lots','applications','cpuses','listbiens'));
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                 
    }

    /**
     * test l'unicité du bien sur son nom
     * 
     * @param string $nom
     * @return boolean
     */
    public function isUnique($nom){
        $obj = $this->Bien->find('first',array('conditions'=>array('Bien.NOM'=>$nom)));
        if(count($obj) > 0) :
            return false;
        else:
            return true;
        endif;
    }

    /**
     * modification d'un bien
     * 
     * @param int $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        if (isAuthorized('biens', 'edit')) :              
            if (!$this->Bien->exists($id)) {
                    throw new NotFoundException(__('Bien incorrect'));
            }
            $ObjApplications = new ApplicationsController();
            $ObjLogiciels = new LogicielsController();
            $ObjAssobienlogiciels = new AssobienlogicielsController();	
            $ObjModeles = new ModelesController();	
            $ObjChassis = new ChassisController();
            $ObjTypes = new TypesController();	
            $ObjUsages = new UsagesController();
            $ObjLots = new LotsController();
            $ObjHistorybiens = new HistorybiensController();
            $ObjEnvoutils = new EnvoutilsController();
            $ObjDsitenvs = new DsitenvsController();	
            $ObjCpuses = new CpusesController();	
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Bien->validate = array();
                    $this->History->goBack(1);
                else:       
                    $entite_id = $ObjApplications->get_entite_id($this->request->data['Bien']['application_id']);
                    $this->request->data['Bien']['entite_id']=$entite_id;                        
                    if ($this->Bien->save($this->request->data)) {
                            $this->Session->setFlash(__('Bien sauvegardé',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                        if (!$this->isUnique($this->request->data['Bien']['NOM'])):
                            $this->Session->setFlash(__('Le nom '.$this->request->data['Bien']['NOM'].' du bien doit être unique, ce nom existe déjà.',true),'flash_failure');
                        else:
                            $this->Session->setFlash(__('Bien incorrect, veuillez corriger le bien',true),'flash_failure');
                        endif;
                    }
                endif;
            } else {
                $options = array('conditions' => array('Bien.' . $this->Bien->primaryKey => $id));
                $this->request->data = $this->Bien->find('first', $options);
                $bien =$this->request->data;
                $listlogiciels = $ObjLogiciels->get_select_compatible($bien['Bien']['lot_id'],$bien['Bien']['application_id']);
                $assobienlogiciels = $ObjAssobienlogiciels->get_outils_for_bien($id);
                $logiciels = $ObjAssobienlogiciels->get_list($id);
                $modeles = $ObjModeles->get_select();
                $chassis = $ObjChassis->get_select();
                $types = $ObjTypes->get_select();
                $usages = $ObjUsages->get_select();
                $lots = $ObjLots->get_select();
                $applications = $ObjApplications->get_select();
                $cpuses = $ObjCpuses->get_select();
                $histories = $ObjHistorybiens->get_list($id);
                $outils = $ObjEnvoutils->get_select(1);
                $versions=array();
                $all_dsitenvs = $ObjDsitenvs->get_list();

                $this->set(compact('modeles', 'chassis', 'types', 'usages', 'lots','applications','cpuses','histories','logiciels','listlogiciels','assobienlogiciels','outils','versions','all_dsitenvs'));                        
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                   
    }

    /**
     * suppression du bien
     * 
     * @param int $id
     * @param boolean $loop si la méthode est utilisée sur une boucle
     * @return boolean
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function delete($id = null,$loop = false) {
        if (isAuthorized('biens', 'delete')) : 
            $this->Bien->id = $id;
            if (!$this->Bien->exists()) {
                    throw new NotFoundException(__('Bien incorrect'));
            }
            $obj = $this->Bien->find('first',array('conditions'=>array('Bien.id'=>$id),'recursive'=>0));
            if($obj['Bien']['ACTIF']==1):
                $this->saveHistory($id);
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
                            if($loop) : return true; endif;
                        else:
                            $this->Session->setFlash(__('Bien activé',true),'flash_success');
                            if($loop) : return true; endif;
                        endif;
                } else {
                        $this->Session->setFlash(__('Bien <b>NON</b> supprimé',true),'flash_failure');
                        if($loop) : return false; endif;
                }
                if(!$loop) : $this->History->notmove();  
                else:
                    return true;
                endif;
            else:
                if($this->Bien->delete()):
                    $delete = "DELETE FROM assobienlogiciels WHERE bien_id = ".$id;
                    $this->Bien->Assobienlogiciel->query($delete);                        
                    $this->Session->setFlash(__('Bien supprimé',true),'flash_success');
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
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                  
    }

    /**
     * change de façon dynamique l'état actif du bien (Ajax)
     * 
     * @param int $id
     * @return boolean
     */
    public function ajax_actif($id=null){
            $this->autoRender = false;
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

    /**
     * change l'état et la date de l'installation (Ajax)
     * 
     * @param int $id
     * @return boolean
     */
    public function ajax_install($id=null){
            $this->autoRender = false;
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

    /**
     * change l'état de vérification du bien
     * 
     * @param int $id
     * @return boolean
     */
    public function ajax_check($id=null){
            $this->autoRender = false;
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
                $this->Session->setFlash(__('Pour faire la modification du statut validé le bien doit Ãªtre installé.',true),'flash_failure');
            endif;
            if ($id==null):
                exit();
            else:
                return $result;
            endif;
    }    
        
    /**
     * duplique que certaines informations d'un bien 
     * 
     * @param int $id du bien à dupliquer
     * @throws UnauthorizedException
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
                    $this->redirect(array('action'=>'edit',$this->Bien->getLastInsertID()));
            } else {
                    $this->Session->setFlash(__('Bien incorrect, veuillez corriger le bien',true),'flash_failure');
            }                
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;                
    }        

    /**
     * trouve la liste des biens pour les selects
     * 
     * @param boolean $actif
     * @return array
     */
    public function get_select($actif=null){
        $conditions[] = $actif == null ? '1=1' : 'Bien.ACTIF='.$actif;
        $list = $this->Bien->find('list',array('fields'=>array('Bien.id','Bien.NOM'),'conditions'=>$conditions,'order'=>array('Bien.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }    

    /**
     * sauvegarde de l'historique
     * 
     * @param int $bien_id
     * @throws UnauthorizedException
     */
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
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;
    }

    /**
     * recherche des biens
     * 
     * @param string $aplication
     * @param string $installe
     * @param string $valide
     * @param string $actif
     * @param string $type
     * @param string $usage
     * @param string $keywords
     * @throws UnauthorizedException
     */
    public function search($aplication=null,$installe=null,$valide=null,$actif=null,$type=null,$usage=null,$keywords=null){
        if (isAuthorized('biens', 'index')) :
            if(isset($this->params->data['Bien']['SEARCH'])):
                $keywords = $this->params->data['Bien']['SEARCH'];
            elseif (isset($keywords)):
                $keywords=$keywords;
            else:
                $keywords=''; 
            endif;
            $this->set('keywords',$keywords);
            if($keywords!= ''):
                $arkeywords = explode(' ',trim($keywords)); 
                $listentite = $this->get_visibility(); 
                $resttriction = $this->get_restriction($listentite);
                $getapplication = $this->get_bien_application_filter($aplication);
                $getinstall = $this->get_bien_install_filter($installe);
                $getvalid = $this->get_bien_valid_filter($valide);
                $getactif = $this->get_bien_actif_filter($actif);
                $gettype = $this->get_bien_type_filter($type);
                $getusage = $this->get_bien_usage_filter($usage);
                $strfilter = $getapplication['filter'].$getinstall['filter'].$getvalid['filter'].$getactif['filter'].$gettype['filter'].$getusage['filter'];
                $newconditions = array($resttriction,$getapplication['condition'],$getinstall['condition'],$getvalid['condition'],$getactif['condition'],$gettype['condition'],$getusage['condition']);
                foreach ($arkeywords as $key=>$value):
                    $ornewconditions[] = array('OR'=>array("Bien.NOM LIKE '%".strtoupper($value)."%'","Type.NOM LIKE '%".strtoupper($value)."%'","Modele.NOM LIKE '%".strtoupper($value)."%'","Lot.NOM LIKE '%".$value."%'","Chassis.NOM LIKE '%".strtoupper($value)."%'"));
                endforeach;
                $conditions = array($newconditions,'OR'=>$ornewconditions);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));    
                $export = $this->get_export($conditions);
                $ObjApplications = new ApplicationsController();	
                $ObjTypes = new TypesController();	
                $ObjUsages = new UsagesController();	
                $applications = $ObjApplications->get_list(1);
                $types = $ObjTypes->get_list(1);
                $usages = $ObjUsages->get_list(1);               
                $this->set(compact('strfilter','export','applications','types','usages'));
                $this->set('biens', $this->paginate());   
            else:
                $this->redirect(array('action'=>'index',$aplication,$installe,$valide,$actif,$type,$usage));
            endif;    
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;  
    }  

    /**
     * installe tout
     * 
     * @return string
     */
    public function installall(){
        $this->autoRender = false;
        $ids = explode('-', $this->request->data('id'));
        $i=count($ids)+2;
        if(count($ids)>0 && $ids[0]!=""):
            foreach($ids as $id):
            if($this->ajax_install($id)):
                $this->Session->setFlash(__('Modification du statut installé pris en compte pour tous les biens sélectionnés',true),'flash_success'); 
            else :
                $this->Session->setFlash(__('Modification du statut installé <b>NON</b> pris en compte pour tous les biens sélectionnés',true),'flash_failure');
            endif;
            endforeach;
            sleep($i);
        else :
            $this->Session->setFlash(__('Aucune action sélectionnée',true),'flash_failure');
        endif;
        return $this->request->data('id');
    }

    /**
     * vérifie tout
     * 
     * @return string
     */
    public function checkall(){
        $this->autoRender = false;
        $ids = explode('-', $this->request->data('id'));
        $i=count($ids)+2;
        if(count($ids)>0 && $ids[0]!=""):
            foreach($ids as $id):
            if($this->ajax_check($id)):
                $this->Session->setFlash(__('Modification du statut validé pris en compte pour tous les biens sélectionnés',true),'flash_success'); 
            else :
                $this->Session->setFlash(__('Modification du statut validé <b>NON</b> pris en compte pour tous les biens sélectionnés',true),'flash_failure');
            endif;
            endforeach;
            sleep($i);
        else :
            $this->Session->setFlash(__('Aucun bien sélectionné',true),'flash_failure');
        endif;
        return $this->request->data('id');
    }

    /**
     * supprime tout
     * 
     * @return string
     */
    public function deleteall(){
        $this->autoRender = false;
        $ids = explode('-', $this->request->data('id'));
        $i=count($ids)+2;
        if(count($ids)>0 && $ids[0]!=""):
            foreach($ids as $id):
                if($this->delete($id,true)):
                    $this->Session->setFlash(__('Modification du statut supprimé pris en compte pour tous les biens sélectionnés',true),'flash_success'); 
                else :
                    $this->Session->setFlash(__('Modification du statut supprimé <b>NON</b> pris en compte pour tous les biens sélectionnés',true),'flash_failure');
                endif;
            endforeach;
            sleep($i);
        else :
            $this->Session->setFlash(__('Aucun bien sélectionné',true),'flash_failure');
        endif;
        return $this->request->data('id');
    }   

    /**
     * liste des biens compatible pour le lot
     * 
     * @param int $lot_id
     * @param int $application_id
     * @return Biens
     */
    public function get_select_compatible($lot_id,$application_id){
        //retrait de la condition sur l'application ,'Bien.application_id'=>$application_id
        $list = $this->Bien->find('list',array('fields'=>array('Bien.id','Bien.NOM'),'conditions'=>array('Bien.lot_id'=>$lot_id),'order'=>array('Bien.NOM'=>'asc'),'recursive'=>0));
        return $list;
    }           
                 
    /**
     * fait l'export au format Excel
     */
    function export_xls() {      
        $this->autoRender = false;
        $data = $this->Session->read('xls_export');             
        $this->set('rows',$data);
        $this->render('export_xls','export_xls');
        //$this->render('export_excel','vide');
    }          

    /**
     * trouve un bien à partir de son nom
     * 
     * @param string $nom
     * @return Biens
     */
    public function getbynom($nom){
        $this->Bien->recursive = 0;
        $obj = $this->Bien->findByNom($nom);
        return $obj;
    }    

    /**
     * met à jour le PVU en fonction du CPU et de son PVU
     * 
     * @param int $id_cpu
     * @param int $pvu_cpu
     */
    public function ajax_update_cpu($id_cpu,$pvu_cpu){
            $this->autoRender = false;
            $biens = $this->Bien->find('all',array('condition'=>array('Bien.cpu_id'=>$id_cpu),'recursive'=>0));
            foreach($biens as $bien):
                $this->Bien->id = $bien['Bien']['id'];
                $newpvu = $bien['Bien']['COEURLICENCE']*$pvu_cpu;
                $this->Bien->saveField('PVU',$newpvu);
            endforeach;
    }
    
    /**
     * renvois les rapports sur Px70 et PVU
     */
    public function rapport(){
        $this->set_title("Rapport des Px70 et PVU");
        if ($this->request->is('post') || $this->request->is('put')) :
            $chassis = isset($this->request->data['Bien']['chassis_id']) && count($this->request->data['Bien']['chassis_id']) > 0 && is_array($this->request->data['Bien']['chassis_id']) ? implode(',',$this->request->data['Bien']['chassis_id']) : 0;
            $envoutils = isset($this->request->data['Bien']['envoutil_id']) && count($this->request->data['Bien']['envoutil_id']) > 0 && is_array($this->request->data['Bien']['envoutil_id'])? implode(',',$this->request->data['Bien']['envoutil_id']) : 0;
            $sqlpx70 = "SELECT chassis.NOM,SUM(biens.RAM) AS RAMUSED,SUM(biens.COEUR) AS CUSED,
                        SUM(biens.RAMINSTALLE) AS SRAMINSTALLE,SUM(biens.COEURINSTALLE) AS SCINSTALLE,  
                        SUM(biens.RAMACTIVE) AS SRAMACTIVE,SUM(biens.COEURACTIVE) AS SCACTIVE  
                        FROM biens
                        LEFT JOIN chassis ON biens.chassis_id = chassis.id
                        WHERE biens.chassis_id IN (".$chassis.")
                        GROUP BY biens.chassis_id;";
            $sqlpvu = "SELECT envoutils.NOM,lots.NOM,dsitenvs.NOM,biens.NOM,SUM(biens.PVU) as PVU,(envoutils.PVUMAX-SUM(biens.PVU)) AS SPVUMAX,applications.NOM
                       FROM envoutils
                       LEFT JOIN logiciels ON logiciels.envoutil_id = envoutils.id
                       LEFT JOIN lots ON lots.id = logiciels.lot_id
                       LEFT JOIN applications ON applications.id = logiciels.application_id
                       LEFT JOIN assobienlogiciels ON assobienlogiciels.logiciel_id = logiciels.id
                       LEFT JOIN dsitenvs ON dsitenvs.id = assobienlogiciels.dsitenv_id
                       LEFT JOIN biens ON biens.id = assobienlogiciels.bien_id 
                       WHERE envoutils.id IN (".$envoutils.")
                       AND biens.PVU IS NOT NULL
                       GROUP BY envoutils.NOM
                       ORDER BY envoutils.NOM ASC,lots.NOM ASC,dsitenvs.NOM ASC;";
            $resultpx70 = $this->Bien->query($sqlpx70);
            $resultpvu = $this->Bien->query($sqlpvu);
            $this->set(compact('resultpx70','resultpvu'));
        endif;
        $objChassis = new ChassisController();
        $chassis = $objChassis->get_select_for('P%70');
        $objEnvoutil = new EnvoutilsController();
        $envoutils = $objEnvoutil->get_select();
        $this->set(compact('chassis','envoutils'));
    }
}