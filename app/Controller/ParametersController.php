<?php
App::uses('AppController', 'Controller');
App::uses('AppModel', 'Model');
App::import('Controller', 'Outils');
App::import('Controller', 'Dossierpartages');
App::import('Controller', 'Modeles');
App::import('Controller', 'Chassis');
App::import('Controller', 'Applications');
App::import('Controller', 'Types');
App::import('Controller', 'Usages');
App::import('Controller', 'Lots');
App::import('Controller', 'Envoutils');
App::import('Controller', 'Biens');
App::import('Controller', 'Versions');
App::import('Controller', 'Intergrationapplicatives');
App::import('Controller', 'Composants');
App::import('Controller', 'Perimetres');
App::import('Controller', 'Etats');
App::import('Controller', 'Phases');
App::import('Controller', 'Volumetries');
App::import('Controller', 'Puissances');
App::import('Controller', 'Architectures');
App::import('Controller', 'Expressionbesoins');
App::import('Vendor', 'dump', array('file'=>'backup_restore.class.php'));
App::import('Vendor', 'filesfolder', array('file'=>'files_folders.class.php'));
/**
 * Parameters Controller
 *
 * @property Parameters $Parameter
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class ParametersController extends AppController {
    public $components = array('History','Common');

    var $uses = array('Parameter','Bien','Logiciel','Intergrationapplicative','Expressionbesoin','Assobienlogiciel');
                       
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Paramètrage du site" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }              
        
    /**
     * Permet de d'autoriser l'accès à des méthodes sans authentification
     */
    public function beforeFilter() {   
        $this->Auth->allow(array('jsongetdatatabledescription','phpinfo'));
        parent::beforeFilter();
    }  

    /**
     * permet d'avoir les information du serveur et des composants
     */
    public function phpinfo(){
        $this->autoRender = false;
        echo phpinfo();
    }
    
    /**
     * liste des paramètres
     */
    public function index() {
            $this->set_title();
            $urlMinidoc = $this->get_minidocurl();
            $this->set('urlminidoc',$urlMinidoc);    
            $instance = $this->get_instance();
            $this->set('instance',$instance);                
            $developpeur = $this->get_developpeur();
            $this->set('developpeur',$developpeur);  
    }
    
    /**
     * page affichant les journaux 
     */
    public function logfiles(){
        $this->set_title('Journaux du site');
        $logs = $this->listlogs();
        $this->set(compact('logs'));
    }
        
    /**
     * Sauvegarde la base de données
     */
    public function savebdd() {
            $this->set_title('Sauvegarde du site');
            $database = $this->Parameter->getDataSource();
            $path = WWW_ROOT.DS.'files'.DS.'sql_backup';
            $obj = new backup_restore($database->config['host'], $database->config['database'], $database->config['login'], $database->config['password'], $path);
            $backup = $obj->backup();
            if($backup) :
                if($this->zipfile(array($backup),$backup.'.zip')):
                    $this->Session->setFlash(__('Base de données sauvegardée',true),'flash_success');
                endif;
                $this->redirect(array('action' => 'listebackup'));
            else:
                $this->Session->setFlash(__('Base de données <b>NON</b> sauvegardée',true),'flash_failure');
                $this->History->goBack(1);
            endif;
            exit();
    }  

    /**
     * liste les fichiers présents dans le dossier de stockage des sauvegardes
     */
    public function listebackup() {
        $this->set_title('Sauvegardes du site');
        $dirsqlbackup = './files/sql_backup';
        $arr_files = array();
        $files = new DirectoryIterator($dirsqlbackup);
        foreach ($files as $file):
            if(!$file->isDot() && $file->getFilename()!= 'empty' && $file->getFilename()!= '@eaDir'):
                $arr_files[$file->getFilename()]=array("ext"=>pathinfo($file->getFilename(), PATHINFO_EXTENSION),"name"=>$file->getFilename(),'url'=>'.'.$dirsqlbackup.'/'.$file->getFilename(),'size'=>byteFormat($file->getSize()),'time'=>date('d/m/Y H:i:s',$file->getATime()));
            endif;
        endforeach;
        $this->set('files',$arr_files);
    }  

    /**
     * Restaure une sauvegarde après l'avoir dézippé et supprime le fichier dézippé du serveur si nécessaire
     * 
     * @param string $file du fichier
     */
    public function restorebdd($file=null) {
        $this->set_title('Restauration du site');
        $database = $this->Parameter->getDataSource();
        $zip = true;
        $nfile = new files_folder();
        $filename = explode('-',$file);
        $max = count($filename)-1;
        $ext = substr($filename[$max],-3);
        if($ext=='zip'):
            if($zip = $this->unzipfile($filename[$max])):
                $file = substr($file,0,-4);
            endif;
        endif;
        if($zip):
            if ($nfile->iswindows()):
                $sqlfile = str_replace("-", "\\", $file);
                $sqlfile = str_replace("¤", ":", $sqlfile);                
            else:
                $sqlfile = str_replace('-', '/', $file);                    
            endif;
            $path = WWW_ROOT.'files'.DS.'sql_backup/';
            $obj = new backup_restore($database->config['host'], $database->config['database'], $database->config['login'], $database->config['password'],$path);
            $backup = $obj->restore($sqlfile);
            if($backup) :
                $this->Session->setFlash(__('Base de données restaurée',true),'flash_success');
                if($ext=='zip'): unlink($path.substr($filename[$max],0,-4)); endif;
            else:
                $this->Session->setFlash(__('Base de données <b>NON</b> restaurée - '.$backup,true),'flash_failure');
            endif;
        endif;
        $this->History->goBack(1); 
    }          

    /**
     * Supprime une sauvegarde du serveur
     * 
     * @param string $file
     */
    public function deletebackup($file=null){
        $nfile = new files_folder();
        if ($nfile->iswindows()):
            $sqlfile = str_replace("-", "\\", $file);
            $sqlfile = str_replace("¤", ":", $sqlfile);                
        else:
            $sqlfile = str_replace('-', '/', $file);                    
        endif;
        if($nfile->deletefile($sqlfile)):
           $this->Session->setFlash(__('Sauvegarde du site supprimée',true),'flash_success');
        else  :
           $droits = $nfile->getdroits($sqlfile);
           $this->Session->setFlash(__('Sauvegarde <b>NON</b> supprimée '.$droits,true),'flash_failure'); 
        endif;
        $this->History->goBack(1);
    }

    /**
     * Enregistre un parametre de façon générale
     */
    public function saveParam() {
        $id = $this->data['Parameter']['id'];
        $params = $this->data['Parameter']['param'];
        if (is_array($params)):
            foreach($params as $key):
                $param .= $key.',';
            endforeach;
            $param = substr_replace($param ,"",-1);
        else:
            $param = $params;
        endif;
        if($id !=''):
        $this->Parameter->id = $id;
        if ($this->Parameter->saveField('param', $param)):
            $this->Session->setFlash(__('Paramètre mis à jour',true),'flash_success');
        else:
            $this->Session->setFlash(__('Paramètre <b>NON</b> mis à jour',true),'flash_failure'); 
        endif;
        else:
            $this->Session->setFlash(__('Paramètre <b>INEXISTANT</b> ou impossible à trouver',true),'flash_failure');
        endif;
        $this->History->goBack(1);
    }

    /**
     * Enregistre le memo sur la facturation
     */
    public function ajaxSaveParam() {
        $id = $this->request->data('id');
        $this->Parameter->id = $id;
        if ($this->Parameter->saveField('param', $this->request->data('memo'))):
            $this->Session->setFlash(__('Paramètre mis à jour',true),'flash_success');
        else:
            $this->Session->setFlash(__('Paramètre <b>NON</b> mis à jour',true),'flash_failure'); 
        endif;
        $this->History->goBack(1);
    }        

    /**
     * retourne l'url de Minidoc GED DSIT
     * 
     * @return Parameters
     */    
    public function get_minidocurl(){
        $version = $this->Parameter->find('first',array('conditions'=>array('nom'=>'urlminidoc'),'recursive'=>-1));
        return $version;
    } 

    /**
     * retourne l'instance du serveur (DEV,DEMO,...
     * 
     * @return Parameters
     */    
    public function get_instance(){
        $version = $this->Parameter->find('first',array('conditions'=>array('nom'=>'instance'),'recursive'=>-1));
        return $version;
    }      

    /**
     * retourne l'email du developpeur
     * 
     * @return Parameters
     */
    public function get_developpeur(){
        $version = $this->Parameter->find('first',array('conditions'=>array('nom'=>'developpeur'),'recursive'=>-1));
        return $version;
    }  

    /**
     * Permet l'importation en masse de donénes à partir de fichier CSV avec une entête
     */
    public function importCsvData() {
        //$messages = null;       
        $this->set_title('Importation en masse de données');
        if ($this->request->is('post') || $this->request->is('put')):
            if (isset($this->params['data']['cancel'])) :
                $this->Site->validate = array();
                $this->History->goBack(1);
            else:                 
                //en fonction du model retourné on fait une fonction d'import CSV avec retour des messages que l'on affichera en log uniquement sur les erreurs
                $file = isset($this->data['Parameter']['file']['name']) ? $this->data['Parameter']['file']['name'] : '';
                $file_type = strrchr($file,'.'); 
                $completpath = WWW_ROOT.'files/upload/';
                if($this->data['Parameter']['file']['tmp_name']!='' && $file_type == '.csv'):
                    $filename = $completpath.$this->data['Parameter']['file']['name'];
                    move_uploaded_file($this->data['Parameter']['file']['tmp_name'],$filename);                              
                    switch ($this->data['Parameter']['table']) {
                        case 'biens':
                            $messages = $this->importbiens($filename);
                            $this->setLog($messages,'flash_log');
                            break;
                        case 'logiciels':
                            $messages = $this->importlogiciels($filename);
                            $this->setLog($messages,'flash_log');                            
                            break;
                        case 'intergrationapplicatives':
                            $messages = $this->importintergrationapplicatives($filename);
                            $this->setLog($messages,'flash_log');                            
                            break;
                        case 'expressionbesoins':
                            $messages = $this->importexpressionbesoins($filename);
                            $this->setLog($messages,'flash_log');                            
                            break; 
                        default:
                            $messages = $this->importcsv($filename,$this->data['Parameter']['table']);
                            $this->setLog($messages,'flash_log');                                
                            //$this->Session->setFlash(__('Import <b>NON PRIS EN CHARGE</b> pour le modèle '.$this->data['Parameter']['table'],true),'flash_failure');
                    }
                    unlink(realpath($filename));
                else :
                    $this->Session->setFlash(__('Le fichier n\'est pas reconnu ou inexistant',true),'flash_failure');
                endif;
            endif;
            //$this->History->notmove();
        endif;
        $models = $this->Parameter->findAllTables($this->Parameter);
        $this->set(compact('models'));  
    }        

    /**
     * import des biens à partir de lancien fichier existant sur OSMOSE
     * 
     * @param string $filename
     * @return array messages et erreurs
     */
    public function importbiens($filename){
        $handle = fopen($filename, "r");
        $header = fgetcsv($handle);
        $header= explode(';',$header[0]);
        $return = array(
                'messages' => array(),
                'errors' => array(),
        );
        while (($row = fgetcsv($handle)) !== FALSE) {
            @$i++;
            $data = array();
            $data['Bien']['entite_id']=userAuth('entite_id');
            $row= explode(';',$row[0]);
            $error = false;
            foreach ($header as $k=>$head) {
                    if (strpos($head,'.')!==false) {
                            $h = explode('.',$head);
                            $data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
                    } else {
                            switch(strtoupper($head)):
                                case 'MODELE':
                                case strtoupper('modele_id'):
                                    $ObjModeles = new ModelesController();
                                    $obj = $row[$k] != '' ? $ObjModeles->getbynom(trim(strtoupper($row[$k]))) : null;
                                    $data['Bien']['modele_id']=(isset($obj['Modele']['id'])) ? $obj['Modele']['id'] : null;
                                    break;
                                case 'CHASSIS':
                                case strtoupper('chassis_id'):
                                    $ObjChassis = new ChassisController();
                                    $obj = $row[$k] != '' ? $ObjChassis->getbynom(trim(strtoupper($row[$k]))) : null;
                                    $data['Bien']['chassis_id']=(isset($obj['Chassis']['id'])) ? $obj['Chassis']['id'] : null;
                                    break;
                                case 'APPLICATION':
                                case strtoupper('application_id'):
                                    $ObjApplications = new ApplicationsController();
                                    $obj = $row[$k] != '' ? $ObjApplications->getbynom(trim(mb_strtoupper($row[$k],'UTF-8'))) : null;
                                    $data['Bien']['application_id']=(isset($obj['Application']['id'])) ? $obj['Application']['id'] : null;                                               
                                    break;
                                case 'ENVIRONNEMENT':
                                case strtoupper('type_id'):
                                    $ObjTypes = new TypesController();
                                    $obj = $row[$k] != '' ? $ObjTypes->getbynom(trim(mb_strtoupper($row[$k],'UTF-8'))) : null;
                                    $data['Bien']['type_id']=(isset($obj['Type']['id'])) ? $obj['Type']['id'] : null;                                               
                                    break;
                                case 'USAGE':
                                case strtoupper('usage_id'):
                                    $ObjUsages = new UsagesController();
                                    $obj = $row[$k] != '' ? $ObjUsages->getbynom(trim(mb_strtoupper($row[$k],'UTF-8'))) : null;
                                    $data['Bien']['usage_id']=(isset($obj['Usage']['id'])) ? $obj['Usage']['id'] : null;                                              
                                    break;
                                case 'LOT':
                                case strtoupper('lot_id'):
                                    $ObjLots = new LotsController();
                                    $obj = $row[$k] != '' ? $ObjLots->getbynom(trim($row[$k])) : null;
                                    $data['Bien']['lot_id']=(isset($obj['Lot']['id'])) ? $obj['Lot']['id'] : null;                                              
                                    break;  
                                case 'CPU':
                                case strtoupper('cpu_id'):
                                    $ObjUsages = new UsagesController();
                                    $obj = $row[$k] != '' ? $ObjUsages->getbynom(trim(strtoupper($row[$k]))) : null;
                                    $data['Bien']['cpu_id']=(isset($obj['Cpus']['id'])) ? $obj['Cpus']['id'] : null;                                              
                                    break;  
                                case 'COEUR SOFTWARE':
                                    $data['Bien']['COEURLICENCE']=trim($row[$k]);                                              
                                    break;
                                case 'BIEN':
                                    $data['Bien']['NOM']=trim($row[$k]);                                              
                                    break;                                    
                                default:
                                    $data['Bien'][strtoupper($head)]=(isset($row[$k])) ? trim($row[$k]) : '';
                            endswitch;
                    }
            }	
            $id = isset($data['Bien']['id']) ? $data['Bien']['id'] : false;
            if ($id) {
                    $this->Bien->id = $id;
            } else {
                    $this->Bien->create();
            }
            $this->Bien->set($data);
            if (!$this->Bien->validates()) {
                    $error = true;
                    $return['errors'][] = __(sprintf('Ligne %d non valide, données incorrectes (%s).',$i,implode("  |  ",$row)), true);
            } else {
                if (!$error && !$this->Bien->save($data)) {
                        $return['errors'][] = __(sprintf('Ligne %d impossible à sauvegarder.',$i), true);
                } else {
                    $return['messages'][] = __(sprintf('Ligne %d sauvegardée.',$i), true);
                }
            }
        }
        fclose($handle);           
        return $return['errors'];
    }

    /**
     * import des logiciels à partir de l'ancien fichier existant sur OSMOSE
     * 
     * @param string $filename
     * @return array messages et erreurs
     */
    public function importlogiciels($filename){
        $handle = fopen($filename, "r");
        $header = fgetcsv($handle);
        $header= explode(';',$header[0]);
        $return = array(
                'messages' => array(),
                'errors' => array(),
        );
        while (($row = fgetcsv($handle)) !== FALSE) {
            @$i++;
            $data = array();
            $data['Logiciel']['entite_id']=userAuth('entite_id');
            $row= explode(';',$row[0]);
            $error = false;
            $server = '<b>inconnu ou manquant</b>';
            foreach ($header as $k=>$head) {
                    if (strpos($head,'.')!==false) {
                            $h = explode('.',$head);
                            $data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
                    } else {
                            switch(strtoupper($head)):
                                case 'OUTIL':
                                case strtoupper('envoutil_id'):
                                    $ObjEnvoutils = new EnvoutilsController();
                                    $obj = $row[$k] != '' ? $ObjEnvoutils->getbynom(trim(strtoupper($row[$k]))) : null;
                                    $data['Logiciel']['envoutil_id']=(isset($obj['Envoutil']['id'])) ? $obj['Envoutil']['id'] : null;
                                    break;
                                case 'APPLICATION':
                                case strtoupper('application_id'):
                                    $ObjApplications = new ApplicationsController();
                                    $obj = $row[$k] != '' ? $ObjApplications->getbynom(trim(mb_strtoupper($row[$k],'UTF-8'))) : null;
                                    $data['Logiciel']['application_id']=(isset($obj['Application']['id'])) ? $obj['Application']['id'] : null;                                               
                                    break;
                                case 'VERSION':
                                case strtoupper('envversion_id'):
                                    $ObjEnvversions = new EnvversionsController();
                                    $obj = $row[$k] != '' ? $ObjEnvversions->getbyversion(trim(mb_strtoupper($row[$k],'UTF-8'))) : null;
                                    $data['Logiciel']['envversion_id']=(isset($obj['Envversion']['id'])) ? $obj['Envversion']['id'] : null;                                               
                                    break;
                                case 'TYPE ENVIRONNEMENT':
                                case strtoupper('type_id'):
                                    $ObjTypes = new TypesController();
                                    $obj = $row[$k] != '' ? $ObjTypes->getbynom(trim(mb_strtoupper($row[$k],'UTF-8'))) : null;
                                    $data['Logiciel']['type_id']=(isset($obj['Type']['id'])) ? $obj['Type']['id'] : null;                                              
                                    break;
                                case 'ENVIRONNEMENT':
                                    $data['Logiciel']['ENVIRONNEMENT']=trim($row[$k]);                                              
                                    break;  
                                case 'SERVEUR':
                                case strtoupper('bien_id'):
                                    $server = trim(strtoupper($row[$k]));
                                    $ObjBiens = new BiensController();	
                                    $obj = $row[$k] != '' ? $ObjBiens->getbynom($server) : null;
                                    $data['Assobienlogiciel']['bien_id']=(isset($obj['Bien']['id'])) ? $obj['Bien']['id'] : null;                                              
                                    break;                                    
                                case 'LOT':
                                case strtoupper('lot_id'):
                                    $ObjLots = new LotsController();	
                                    $obj = $row[$k] != '' ? $ObjLots->getbynom(trim($row[$k])) : null;
                                    $data['Logiciel']['lot_id']=(isset($obj['Lot']['id'])) ? $obj['Lot']['id'] : null;                                              
                                    break;  
                                case 'LOGICIEL':
                                    $data['Logiciel']['NOM']=trim($row[$k]);                                              
                                    break;                                    
                                default:
                                    $data['Logiciel'][strtoupper($head)]=(isset($row[$k])) ? trim($row[$k]) : '';
                            endswitch;
                    }
            }	
            $id = isset($data['Logiciel']['id']) ? $data['Logiciel']['id'] : false;
            if ($id) {
                    $this->Logiciel->id = $id;
            } else {
                    $this->Logiciel->create();
            }
            $this->Logiciel->set($data);
            if (!$this->Logiciel->validates()) {
                    $error = true;
                    $return['errors'][] = __(sprintf('Ligne %d non valide, données incorrectes (%s).',$i,implode("  |  ",$row)), true);
            } else {
                if (!$error && !$this->Logiciel->save($data)) {
                        $return['errors'][] = __(sprintf('Ligne %d impossible à sauvegarder.',$i), true);
                } else {
                    $record['Assobienlogiciel']['logiciel_id'] = $this->Logiciel->getLastInsertID();
                    $record['Assobienlogiciel']['bien_id'] = $data['Assobienlogiciel']['bien_id'];
                    $record['Assobienlogiciel']['ENVDSIT'] = $data['Logiciel']['ENVIRONNEMENT'];
                    $this->Assobienlogiciel->create();
                    if (!$this->Assobienlogiciel->save($record)):
                        $return['errors'][] = __(sprintf('Association sur la ligne %d impossible avec le bien %s.',$i,$server), true);
                    else :
                          $return['messages'][] = __(sprintf('Ligne %d sauvegardée.',$i), true);  
                    endif;
                }
            }
        }
        fclose($handle);           
        return $return['errors'];  
    }

    /**
     * import de l'intégration applicative à partir de l'ancien fichier existant sur OSMOSE
     * 
     * @param string $filename
     * @return array de messages et d'erreurs
     */
    public function importintergrationapplicatives($filename){
        $handle = fopen($filename, "r");
        $header = fgetcsv($handle);
        $header= explode(';',$header[0]);
        $return = array(
                'messages' => array(),
                'errors' => array(),
        );
        while (($row = fgetcsv($handle)) !== FALSE) {
            @$i++;
            $data = array();
            $data['Intergrationapplicative']['entite_id']=userAuth('entite_id');
            $row= explode(';',$row[0]);
            $error = false;
            foreach ($header as $k=>$head) {
                    if (strpos($head,'.')!==false) {
                            $h = explode('.',$head);
                            $data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
                    } else {
                            switch(strtoupper($head)):
                                case 'VERSION':
                                case strtoupper('version_id'):
                                    $ObjVersions = new VersionsController();
                                    $obj = $row[$k] != '' ? $ObjVersions->getbynom(trim(strtoupper($row[$k]))) : null;
                                    $data['Intergrationapplicative']['version_id']=(isset($obj['Version']['id'])) ? $obj['Version']['id'] : null;
                                    break;
                                case 'LOT':
                                case strtoupper('lot_id'):
                                    $ObjLots = new LotsController();
                                    $obj = $row[$k] != '' ? $ObjLots->getbynom(trim(strtoupper($row[$k]))) : null;
                                    $data['Intergrationapplicative']['lot_id']=(isset($obj['Lot']['id'])) ? $obj['Lot']['id'] : null;
                                    break;                                    
                                case 'APPLICATION':
                                case strtoupper('application_id'):
                                    $ObjApplications = new ApplicationsController();
                                    $obj = $row[$k] != '' ? $ObjApplications->getbynom(trim(mb_strtoupper($row[$k],'UTF-8'))) : null;
                                    $data['Intergrationapplicative']['application_id']=(isset($obj['Application']['id'])) ? $obj['Application']['id'] : null;                                               
                                    break;
                                case 'DATE':
                                case 'DATEINSTALL':
                                    $data['Intergrationapplicative']['DATEINSTALL']=  CUSDate(trim($row[$k]));  
                                    $data['Intergrationapplicative']['INSTALL']=1;
                                    break;                                    
                                case 'ENVIRONNEMENT':
                                case strtoupper('type_id'):
                                    $ObjTypes = new TypesController();
                                    $obj = $row[$k] != '' ? $ObjTypes->getbynom(trim(mb_strtoupper($row[$k],'UTF-8'))) : null;
                                    $data['Intergrationapplicative']['type_id']=(isset($obj['Type']['id'])) ? $obj['Type']['id'] : null;                                               
                                    break;                                   
                                default:
                                    $data['Intergrationapplicative'][strtoupper($head)]=(isset($row[$k])) ? trim($row[$k]) : '';
                            endswitch;
                    }
            }	
            $id = isset($data['Intergrationapplicative']['id']) ? $data['Intergrationapplicative']['id'] : false;
            if ($id) {
                    $this->Intergrationapplicative->id = $id;
            } else {
                    $this->Intergrationapplicative->create();
            }
            $this->Intergrationapplicative->set($data);
            if (!$this->Intergrationapplicative->validates()) {
                    $error = true;
                    $return['errors'][] = __(sprintf('Ligne %d non valide, données incorrectes (%s).',$i,implode("  |  ",$row)), true);
            } else {
                if (!$error && !$this->Intergrationapplicative->save($data)) {
                        $return['errors'][] = __(sprintf('Ligne %d impossible à sauvegarder.',$i), true);
                } else {
                    $lastid = $this->Intergrationapplicative->getLastInsertID();
                    $ObjIntergrationapplicatives = new IntergrationapplicativesController();
                    $ObjIntergrationapplicatives->saveHistory($lastid,false);
                    $return['messages'][] = __(sprintf('Ligne %d sauvegardée.',$i), true);
                }
            }
        }
        fclose($handle);           
        return $return['errors'];
    }

    /**
     * Import des expression de besoin à partir de l'ancien fichier existant au niveau de OSMOSE
     * 
     * @param string $filename
     * @return array de messages et d'erreurs
     */
    public function importexpressionbesoins($filename){
        $handle = fopen($filename, "r");
        $header = fgetcsv($handle);
        $header= explode(';',$header[0]);
        $return = array(
                'messages' => array(),
                'errors' => array(),
        );
        while (($row = fgetcsv($handle)) !== FALSE) {
            @$i++;
            $data = array();
            $data['Expressionbesoin']['entite_id']=userAuth('entite_id');
            $row= explode(';',$row[0]);
            $error = false;
            foreach ($header as $k=>$head) {
                    if (strpos($head,'.')!==false) {
                            $h = explode('.',$head);
                            $data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
                    } else {
                            switch(strtoupper($head)):
                                case 'COMPOSANT':
                                case strtoupper('composant_id'):
                                    $ObjComposants = new ComposantsController();
                                    $obj = $row[$k] != '' ? $ObjComposants->getbynom(trim(strtoupper($row[$k]))) : 0;
                                    $data['Expressionbesoin']['composant_id']=(isset($obj['Composant']['id'])) ? $obj['Composant']['id'] : null;
                                    break;  
                                case 'PERIMETRE':
                                case strtoupper('perimetre_id'):
                                    $ObjPerimetres = new PerimetresController();
                                    $obj = $row[$k] != '' ? $ObjPerimetres->getbynom(trim(strtoupper($row[$k]))) : 0;
                                    $data['Expressionbesoin']['perimetre_id']=(isset($obj['Perimetre']['id'])) ? $obj['Perimetre']['id'] : null;
                                    break;   
                                case 'LOT':
                                case strtoupper('lot_id'):
                                    $ObjLots = new LotsController();
                                    $obj = $row[$k] != '' ? $ObjLots->getbynom(trim(strtoupper($row[$k]))) : 0;
                                    $data['Expressionbesoin']['lot_id']=(isset($obj['Lot']['id'])) ? $obj['Lot']['id'] : null;
                                    break;  
                                case 'ETAT':
                                case strtoupper('etat_id'):
                                    $ObjEtats = new EtatsController();
                                    $obj = $row[$k] != '' ? $ObjEtats->getbynom(trim($row[$k])) : 0;
                                    $data['Expressionbesoin']['etat_id']=(isset($obj['Etat']['id'])) ? $obj['Etat']['id'] : null;
                                    break;   
                                case 'PHASE':
                                case strtoupper('phase_id'):
                                    $ObjPhases = new PhasesController();
                                    $obj = $row[$k] != '' ? $ObjPhases->getbynom(trim(strtoupper($row[$k]))) : null;
                                    $data['Expressionbesoin']['phase_id']=(isset($obj['Phase']['id'])) ? $obj['Phase']['id'] : null;
                                    break;    
                                case 'VOLUMETRIE':
                                case strtoupper('volumetrie_id'):
                                    $ObjVolumetries = new VolumetriesController();
                                    $obj = $row[$k] != '' ? $ObjVolumetries->getbynom(trim(strtoupper($row[$k]))) : null;
                                    $data['Expressionbesoin']['volumetrie_id']=(isset($obj['Volumetry']['id'])) ? $obj['Volumetry']['id'] : null;
                                    break;   
                                case 'PUISSANCE':
                                case strtoupper('puissance_id'):
                                    $ObjPuissances = new PuissancesController();
                                    $obj = $row[$k] != '' ? $ObjPuissances->getbynom(trim(strtoupper($row[$k]))) : null;
                                    $data['Expressionbesoin']['puissance_id']=(isset($obj['Puissance']['id'])) ? $obj['Puissance']['id'] : null;
                                    break;  
                                case 'ARCHITECTURE':
                                case strtoupper('architecture_id'):
                                    $ObjArchitectures = new ArchitecturesController();
                                    $obj = $row[$k] != '' ? $ObjArchitectures->getbynom(trim(strtoupper($row[$k]))) : null;
                                    $data['Expressionbesoin']['architecture_id']=(isset($obj['Architecture']['id'])) ? $obj['Architecture']['id'] : null;
                                    break;                                       
                                case 'APPLICATION':
                                case strtoupper('application_id'):
                                    $ObjApplications = new ApplicationsController();
                                    $obj = $row[$k] != '' ? $ObjApplications->getbynom(trim(mb_strtoupper($row[$k],'UTF-8'))) : 0;
                                    $data['Expressionbesoin']['application_id']=(isset($obj['Application']['id'])) ? $obj['Application']['id'] : null;                                               
                                    break;
                                case strtoupper('type_id'):
                                    $ObjTypes = new TypesController();
                                    $obj = $row[$k] != '' ? $ObjTypes->getbynom(trim(mb_strtoupper($row[$k],'UTF-8'))) : null;
                                    $data['Expressionbesoin']['type_id']=(isset($obj['Type']['id'])) ? $obj['Type']['id'] : null;                                               
                                    break;    
                                case 'DATELIVRAISON ':
                                    $data['Expressionbesoin']['DATELIVRAISON ']=  CUSDate(trim($row[$k]));                                               
                                    break;                                     
                                default:
                                    $data['Expressionbesoin'][strtoupper($head)]=(isset($row[$k])) ? trim($row[$k]) : '';
                            endswitch;
                    }
            }	
            $id = isset($data['Expressionbesoin']['id']) ? $data['Expressionbesoin']['id'] : false;
            if ($id) {
                    $this->Expressionbesoin->id = $id;
            } else {
                    $this->Expressionbesoin->create();
            }
            $this->Expressionbesoin->set($data);
            if (!$this->Expressionbesoin->validates()) {
                    $error = true;
                    $return['errors'][] = __(sprintf('Ligne %d non valide, données incorrectes (%s).',$i,implode("  |  ",$row)), true);
            } else {
                if (!$error && !$this->Expressionbesoin->save($data)) {
                        $return['errors'][] = __(sprintf('Ligne %d impossible à sauvegarder.',$i), true);
                } else {
                    $lastid = $this->Expressionbesoin->getLastInsertID();
                    $ObjExpressionbesoins = new ExpressionbesoinsController();
                    $ObjExpressionbesoins->saveHistory($lastid,false);
                    $return['messages'][] = __(sprintf('Ligne %d sauvegardée.',$i), true);
                }
            }
        }
        fclose($handle);           
        return $return['errors'];            
    }   

    /**
     * Permet l'import de fichier CSV en s'appuyant sur la ligne d'entête
     * 
     * @param string $filename
     * @param string $controller
     * @return array de messages et d'erreurs
     */
    public function importcsv($filename,$controller){
        $handle = fopen($filename, "r");
        $header = fgetcsv($handle);
        $header= explode(';',$header[0]);
        $return = array(
                'messages' => array(),
                'errors' => array(),
        );
        $table = $this->tableheader($controller);
        $controller = substr(ucfirst($controller), 0, -1);
        $control = ClassRegistry::init($controller); 
        //tester le header avec les champs obligatoires
        //comparaison de deux tableaux
        if(count(array_intersect($table, $header)) == count($table)):
        while (($row = fgetcsv($handle)) !== FALSE) {
            @$i++;
            $data = array();
            $data[$controller]['entite_id']=userAuth('entite_id');
            $row= explode(';',$row[0]);
            $error = false;
            foreach ($header as $k=>$head) {
                    if (strpos($head,'.')!==false) {
                            $h = explode('.',$head);
                            $data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
                    } else {
                            $data[$controller][strtoupper($head)]=(isset($row[$k])) ? trim($row[$k]) : '';
                    }
            }	
            $id = isset($data[$controller]['id']) ? $data[$controller]['id'] : false;
            if ($id) {
                    $control->id = $id;
            } else {
                    $control->create();
            }
            $control->set($data);
            if (!$control->validates()) {
                    $error = true;
                    $return['errors'][] = __(sprintf('Ligne %d non valide, données incorrectes (%s).',$i,implode("  |  ",$row)), true);
            } else {
                if (!$error && !$control->save($data)) {
                        $return['errors'][] = __(sprintf('Ligne %d impossible à sauvegarder.',$i), true);
                } else {
                    $return['messages'][] = __(sprintf('Ligne %d sauvegardée.',$i), true);
                }
            }
        }
        else:
            $return['errors'][] = __(sprintf('Les champs obligatoires ne correspondent pas à ceux attendus'), true);
        endif;
        fclose($handle);           
        return $return['errors'];
    }

    /**
     * ajoute une information au journal de log
     * 
     * @param string $message
     * @param string $element
     * @param string $params
     * @param string $key
     */
    public function setLog($message, $element = 'default', $params = array(), $key = 'flash') {
        $this->Session->write('Log.' . $key, compact('message', 'element', 'params'));
    }

    /**
     * chargé avant de rendre la main
     */
    public function beforeRender() {
        $key = 'flash';
        $attrs = array();
        $out = false;

        if ($this->Session->check('Log.' . $key)) {
                $flash = $this->Session->read('Log.' . $key);
                $message = $flash['message'];
                unset($flash['message']);

                if (!empty($attrs)) {
                        $flash = array_merge($flash, $attrs);
                }

                if ($flash['element'] === 'default') {
                        $class = 'message';
                        if (!empty($flash['params']['class'])) {
                                $class = $flash['params']['class'];
                        }
                        $out = '<div id="' . $key . 'Log" class="' . $class . '">' . $message . '</div>';
                } elseif (!$flash['element']) {
                        $out = $message;
                } else {
                        $options = array();
                        if (isset($flash['params']['plugin'])) {
                                $options['plugin'] = $flash['params']['plugin'];
                        }
                        $tmpVars = $flash['params'];
                        $tmpVars['message'] = $message;
                        $out = $tmpVars;
                }
                $this->Session->delete('Log.' . $key);
        }
        $this->set('messages',$out);            
        parent::beforeRender();
    }

    /**
     * donne la description de la table
     * 
     * @param string $tablename
     * @return json
     */
    public function jsongetdatatabledescription($tablename){
        $this->autoRender = false;
        $sql = 'DESCRIBE '.$tablename;           
        $table = $this->Bien->query($sql);
        return json_encode($table);
    }

    /**
     * fermeture du site pour maintenance
     */
    public function openmaintenance() {
        $this->autoRender = false;
        $filename = WWW_ROOT.'maintenance.md';
        $fp = fopen($filename,"wb");
        fclose($fp);            
        $this->History->notmove();
    }

    /**
     * ouverture du site aprés maintenance
     */
    public function closemaintenance() {
        $this->autoRender = false;
        $filename = WWW_ROOT.'maintenance.md';
        unlink(realpath($filename));
        $this->History->notmove();
    }   

    /**
     * retourne la liste des colonnes de la table
     * 
     * @param string $table
     * @return array
     */
    public function tableheader($table){
        $sql = 'DESCRIBE '.$table;           
        $table = $this->Bien->query($sql); 
        foreach($table as $column):
            if($column['COLUMNS']['Null']=='NO'):
                $result[] = $column['COLUMNS']['Field'];
            endif;
        endforeach;
        $result = array_slice($result,1,-2);           
        return $result;
    }
    
    /**
     * Méthode pour compresser le fichier de sauvegarde
     * 
     * @param array $files
     * @param string $zip_name
     * @return boolean
     */
    public function zipfile($files,$zip_name){
        $this->autoRender = false;
        $result = true;
        $path = './files/sql_backup/';
        $zip = new ZipArchive();
        if($zip->open($path.$zip_name, ZIPARCHIVE::CREATE)!==true){
          $this->Session->setFlash(__('Impossible de compresser les fichiers',true),'flash_failure');
          $result = false;
        } else {
//            sleep(5);
            foreach($files as $file){
                $filename = $path.$file;
                $zip->addFile($filename,$file);
            }

            $zip->close(); 
//            sleep(5);
            foreach($files as $file){
                $filename = $path.$file;
                unlink(realpath($filename));
            }
        }
        return $result;
    }
    
    /**
     * méthode pour dézipper le fichier de sauvegarde
     * 
     * @param string $file
     * @return boolean
     */
    public function unzipfile($file){
        $this->autoRender = false;
        $path = './files/sql_backup/';

        $zip = new ZipArchive;
        $res = $zip->open($path.$file);
        if ($res === TRUE) {
          $zip->extractTo($path);
          $zip->close();
          //unlink(realpath($file));
          return true;
        } else {
          $this->Session->setFlash(__('Impossible d\'extraire de le fichier '.$file,true),'flash_failure');
          return false;
        }        
    }
    
    /**
     * liste le dossier de logs
     * 
     * @return array des fichiers de log
     */
    public function listlogs(){
        $dir = '../tmp/logs/';
        $arr_files = array();
        $files = new DirectoryIterator($dir);
        foreach ($files as $file):
            if(!$file->isDot() && $file->getFilename()!= 'empty' && $file->getFilename()!= '@eaDir'):
                $arr_files[$file->getFilename()]=array("ext"=>pathinfo($file->getFilename(), PATHINFO_EXTENSION),"name"=>$file->getFilename(),'url'=>$dir.'/'.$file->getFilename(),'size'=>byteFormat($file->getSize()),'time'=>date('d/m/Y H:i:s',$file->getATime()));
            endif;
        endforeach;
        return $arr_files;
    }  
    
    /**
     * supprime tous les fichiers du dossier de log
     */
    public function cleanlogfolder(){
        $this->autoRender = false;
        $dir = '../tmp/logs/';
        $arr_files = array();
        $files = new DirectoryIterator($dir);
        foreach ($files as $file):
            if(!$file->isDot() && $file->getFilename()!= 'empty' && $file->getFilename()!= '@eaDir'):
                unlink(realpath($dir.$file->getFilename()));
            endif;
        endforeach;  
        $this->Session->setFlash(__('Le dossier des logs est vidé.',true),'flash_success');
        $this->History->goBack(0);
    }
    
    /**
     * suppresion du fichier
     * 
     * @param type $file
     */
    public function delfile($file){
        $this->autoRender = false;
        $file = str_replace('-','/',$file);
        if(file_exists($file)):
            unlink(realpath($file));
            $this->Session->setFlash(__('Fichier supprimé du serveur.',true),'flash_success');
        else:
            $this->Session->setFlash(__('Fichier inexistant sur le serveur.',true),'flash_failure');
        endif;
        $this->History->goBack(0);        
    }
}
