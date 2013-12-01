<?php
App::uses('AppController', 'Controller');
App::uses('AppModel', 'Model');
App::import('Vendor', 'dump', array('file'=>'backup_restore.class.php'));
App::import('Vendor', 'filesfolder', array('file'=>'files_folders.class.php'));
/**
 * Parameters Controller
 *
 * @property Parameters $Parameter
 */
class ParametersController extends AppController {
        public $components = array('History','Common');
        
        var $uses = array('Parameter','Bien','Logiciel','Intergrationapplicative','Expressionbesoin','Assobienlogiciel');
               
/**
 * index method
 *
 * @return void
 */
	public function index() {
                $this->set('title_for_layout','Paramètres du site');
                $urlMinidoc = $this->get_minidocurl();
                $this->set('urlminidoc',$urlMinidoc);
                $contact = $this->get_contact();
                $this->set('contact',$contact);
                $version = $this->get_version();
                $this->set('version',$version);       
                $instance = $this->get_instance();
                $this->set('instance',$instance);  
                $annuaire = $this->get_gestionnaireannuaire();
                $this->set('annuaire',$annuaire);   
                $valoutil = $this->get_valideuroutil();
                $this->set('valoutil',$valoutil);    
                $destmailenv = $this->get_destmailenv();
                $this->set('destmailenv',$destmailenv); 
                $listoutil = $this->requestAction('outils/get_list_outil');
                $this->set('listoutil',$listoutil);
                $listgroup = $this->requestAction('dossierpartages/get_list_shared');
                $this->set('listgroup',$listgroup);                
                $templategroupe = $this->get_templategroupe();
                $this->set('templategroupe',$templategroupe);  
                $templateoutil = $this->get_templateoutil();
                $this->set('templateoutil',$templateoutil); 
                $developpeur = $this->get_developpeur();
                $this->set('developpeur',$developpeur);   
	}
        
	public function savebdd() {
                $this->set('title_for_layout','Sauvegarde du site');
                $database = $this->Parameter->getDataSource();
                $path = WWW_ROOT.DS.'files'.DS.'sql_backup';
                $obj = new backup_restore($database->config['host'], $database->config['database'], $database->config['login'], $database->config['password'], $path);
                $backup = $obj->backup();
                if($backup) :
                    $this->Session->setFlash(__('Base de données sauvegardée',true),'flash_success');
                    $this->redirect(array('action' => 'listebackup'));
                else:
                    $this->Session->setFlash(__('Base de données <b>NON</b> sauvegardée',true),'flash_failure');
                    $this->History->goBack(1);
                endif;
                exit();
	}  

	public function listebackup() {
            $this->set('title_for_layout','Sauvegardes du site');
            $files = new files_folder($this->params->base);
            $sqlfiles = $files->getSqlFiles();
            $this->set('files',$sqlfiles);
            //$this->History->goBack(1);
	}  
        
	public function restorebdd($file=null) {
            $this->set('title_for_layout','Restauration du site');
            $database = $this->Parameter->getDataSource();
            $nfile = new files_folder();
            if ($nfile->iswindows()):
                $sqlfile = str_replace("-", "\\", $file);
                $sqlfile = str_replace("¤", ":", $sqlfile);                
            else:
                $sqlfile = str_replace('-', '/', $file);                    
            endif;
            $path = WWW_ROOT.DS.'files'.DS.'sql_backup';
            $obj = new backup_restore($database->config['host'], $database->config['database'], $database->config['login'], $database->config['password'],$path);
            $backup = $obj->restore($sqlfile);
            if($backup) :
                $this->Session->setFlash(__('Base de données restaurée',true),'flash_success');
            else:
                $this->Session->setFlash(__('Base de données <b>NON</b> restaurée - '.$backup,true),'flash_failure');
            endif;
            $this->History->goBack(1); 
	}          
        
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
         * 
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
        
        public function get_version(){
            $version = $this->Parameter->find('first',array('conditions'=>array('nom'=>'version'),'recursive'=>-1));
            return $version;
        }

        public function get_memofacturation(){
            $memo = $this->Parameter->find('first',array('conditions'=>array('nom'=>'memofacturation'),'recursive'=>-1));
            return $memo;
        }
        
        public function get_minidocurl(){
            $version = $this->Parameter->find('first',array('conditions'=>array('nom'=>'urlminidoc'),'recursive'=>-1));
            return $version;
        } 
        
        public function get_contact(){
            $version = $this->Parameter->find('first',array('conditions'=>array('nom'=>'contact'),'recursive'=>-1));
            return $version;
        }   
        
        public function get_instance(){
            $version = $this->Parameter->find('first',array('conditions'=>array('nom'=>'instance'),'recursive'=>-1));
            return $version;
        }      
        
        public function get_gestionnaireannuaire(){
            $version = $this->Parameter->find('first',array('conditions'=>array('nom'=>'gestionnaireannuaire'),'recursive'=>-1));
            return $version;
        }      
        
        public function get_developpeur(){
            $version = $this->Parameter->find('first',array('conditions'=>array('nom'=>'developpeur'),'recursive'=>-1));
            return $version;
        }  
        
        public function get_gestionnaireenvironnement(){
            $version = $this->Parameter->find('first',array('conditions'=>array('nom'=>'destmailenv'),'recursive'=>-1));
            return $version; 
        }
        
        public function get_valideuroutil(){
            $version = $this->Parameter->find('first',array('conditions'=>array('nom'=>'valideuroutil'),'recursive'=>-1));
            return $version;
        }      
        public function get_destmailenv(){
            $version = $this->Parameter->find('first',array('conditions'=>array('nom'=>'destmailenv'),'recursive'=>-1));
            return $version;
        }     
        public function get_templategroupe(){
            $version = $this->Parameter->find('first',array('conditions'=>array('nom'=>'templategroupe'),'recursive'=>-1));
            return $version;
        }     
        public function get_templateoutil(){
            $version = $this->Parameter->find('first',array('conditions'=>array('nom'=>'templateoutil'),'recursive'=>-1));
            return $version;
        }             
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Parameter->exists($id)) {
			throw new NotFoundException(__('Invalid param'));
		}
		$options = array('conditions' => array('Param.' . $this->Parameter->primaryKey => $id));
		$this->set('param', $this->Parameter->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Parameter->create();
			if ($this->Parameter->save($this->request->data)) {
				$this->Session->setFlash(__('The param has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The param could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Parameter->exists($id)) {
			throw new NotFoundException(__('Invalid param'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Parameter->save($this->request->data)) {
				$this->Session->setFlash(__('The param has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The param could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Param.' . $this->Parameter->primaryKey => $id));
			$this->request->data = $this->Parameter->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Parameter->id = $id;
		if (!$this->Parameter->exists()) {
			throw new NotFoundException(__('Invalid param'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Parameter->delete()) {
			$this->Session->setFlash(__('Param deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Param was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
	public function importCsvData() {
            //$messages = null;       
            $this->set('title_for_layout','Importation en masse de données');
            if ($this->request->is('post') || $this->request->is('put')):
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
                            $this->Session->setFlash(__('Import <b>NON PRIS EN CHARGE</b> pour le modèle '.$this->data['Parameter']['table'],true),'flash_failure');
                    }
                    unlink(realpath($filename));
                else :
                    $this->Session->setFlash(__('Le fichier n\'est pas reconnu ou inexistant',true),'flash_failure');
                endif;
                //$this->History->notmove();
            endif;
            $models = $this->Parameter->findAllTables($this->Parameter);
            $this->set(compact('models'));  
	}        
        
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
                                        $obj = $row[$k] != '' ? $this->requestAction('modeles/getbynom',array('pass'=>array(trim(strtoupper($row[$k]))))) : null;
                                        $data['Bien']['modele_id']=(isset($obj['Modele']['id'])) ? $obj['Modele']['id'] : null;
                                        break;
                                    case 'CHASSIS':
                                    case strtoupper('chassis_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('chassis/getbynom',array('pass'=>array(trim(strtoupper($row[$k]))))) : null;
                                        $data['Bien']['chassis_id']=(isset($obj['Chassis']['id'])) ? $obj['Chassis']['id'] : null;
                                        break;
                                    case 'APPLICATION':
                                    case strtoupper('application_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('applications/getbynom',array('pass'=>array(trim(mb_strtoupper($row[$k],'UTF-8'))))) : null;
                                        $data['Bien']['application_id']=(isset($obj['Application']['id'])) ? $obj['Application']['id'] : null;                                               
                                        break;
                                    case 'ENVIRONNEMENT':
                                    case strtoupper('type_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('types/getbynom',array('pass'=>array(trim(mb_strtoupper($row[$k],'UTF-8'))))) : null;
                                        $data['Bien']['type_id']=(isset($obj['Type']['id'])) ? $obj['Type']['id'] : null;                                               
                                        break;
                                    case 'USAGE':
                                    case strtoupper('usage_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('usages/getbynom',array('pass'=>array(trim(mb_strtoupper($row[$k],'UTF-8'))))) : null;
                                        $data['Bien']['usage_id']=(isset($obj['Usage']['id'])) ? $obj['Usage']['id'] : null;                                              
                                        break;
                                    case 'LOT':
                                    case strtoupper('lot_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('lots/getbynom',array('pass'=>array(trim($row[$k])))) : null;
                                        $data['Bien']['lot_id']=(isset($obj['Lot']['id'])) ? $obj['Lot']['id'] : null;                                              
                                        break;  
                                    case 'CPU':
                                    case strtoupper('cpu_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('usages/getbynom/'.trim(strtoupper($row[$k]))) : null;
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
                                        $obj = $row[$k] != '' ? $this->requestAction('envoutils/getbynom',array('pass'=>array(trim(strtoupper($row[$k]))))) : null;
                                        $data['Logiciel']['envoutil_id']=(isset($obj['Envoutil']['id'])) ? $obj['Envoutil']['id'] : null;
                                        break;
                                    case 'APPLICATION':
                                    case strtoupper('application_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('applications/getbynom',array('pass'=>array(trim(mb_strtoupper($row[$k],'UTF-8'))))) : null;
                                        $data['Logiciel']['application_id']=(isset($obj['Application']['id'])) ? $obj['Application']['id'] : null;                                               
                                        break;
                                    case 'VERSION':
                                    case strtoupper('envversion_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('envversions/getbyversion',array('pass'=>array(trim(mb_strtoupper($row[$k],'UTF-8'))))) : null;
                                        $data['Logiciel']['envversion_id']=(isset($obj['Envversion']['id'])) ? $obj['Envversion']['id'] : null;                                               
                                        break;
                                    case 'TYPE ENVIRONNEMENT':
                                    case strtoupper('type_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('types/getbynom',array('pass'=>array(trim(mb_strtoupper($row[$k],'UTF-8'))))) : null;
                                        $data['Logiciel']['type_id']=(isset($obj['Type']['id'])) ? $obj['Type']['id'] : null;                                              
                                        break;
                                    case 'ENVIRONNEMENT':
                                        $data['Logiciel']['ENVIRONNEMENT']=trim($row[$k]);                                              
                                        break;  
                                    case 'SERVEUR':
                                    case strtoupper('bien_id'):
                                        $server = trim(strtoupper($row[$k]));
                                        $obj = $row[$k] != '' ? $this->requestAction('biens/getbynom',array('pass'=>array($server))) : null;
                                        $data['Assobienlogiciel']['bien_id']=(isset($obj['Bien']['id'])) ? $obj['Bien']['id'] : null;                                              
                                        break;                                    
                                    case 'LOT':
                                    case strtoupper('lot_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('lots/getbynom',array('pass'=>array(trim($row[$k])))) : null;
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
                                        $obj = $row[$k] != '' ? $this->requestAction('versions/getbynom',array('pass'=>array(trim(strtoupper($row[$k]))))) : null;
                                        $data['Intergrationapplicative']['version_id']=(isset($obj['Version']['id'])) ? $obj['Version']['id'] : null;
                                        break;
                                    case 'LOT':
                                    case strtoupper('lot_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('lots/getbynom',array('pass'=>array(trim(strtoupper($row[$k]))))) : null;
                                        $data['Intergrationapplicative']['lot_id']=(isset($obj['Lot']['id'])) ? $obj['Lot']['id'] : null;
                                        break;                                    
                                    case 'APPLICATION':
                                    case strtoupper('application_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('applications/getbynom',array('pass'=>array(trim(mb_strtoupper($row[$k],'UTF-8'))))) : null;
                                        $data['Intergrationapplicative']['application_id']=(isset($obj['Application']['id'])) ? $obj['Application']['id'] : null;                                               
                                        break;
                                    case 'DATE':
                                    case 'DATEINSTALL':
                                        $data['Intergrationapplicative']['DATEINSTALL']=  CUSDate(trim($row[$k]));  
                                        $data['Intergrationapplicative']['INSTALL']=1;
                                        break;                                    
                                    case 'ENVIRONNEMENT':
                                    case strtoupper('type_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('types/getbynom',array('pass'=>array(trim(mb_strtoupper($row[$k],'UTF-8'))))) : null;
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
                        $this->Parameter->requestAction('intergrationapplicatives/saveHistory/'.$lastid.'/false');
                        $return['messages'][] = __(sprintf('Ligne %d sauvegardée.',$i), true);
                    }
                }
            }
            fclose($handle);           
            return $return['errors'];
        }
        
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
                                        $obj = $row[$k] != '' ? $this->requestAction('composants/getbynom',array('pass'=>array(trim(strtoupper($row[$k]))))) : 0;
                                        $data['Expressionbesoin']['composant_id']=(isset($obj['Composant']['id'])) ? $obj['Composant']['id'] : null;
                                        break;  
                                    case 'PERIMETRE':
                                    case strtoupper('perimetre_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('perimetres/getbynom',array('pass'=>array(trim(strtoupper($row[$k]))))) : 0;
                                        $data['Expressionbesoin']['perimetre_id']=(isset($obj['Perimetre']['id'])) ? $obj['Perimetre']['id'] : null;
                                        break;   
                                    case 'LOT':
                                    case strtoupper('lot_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('lots/getbynom',array('pass'=>array(trim(strtoupper($row[$k]))))) : 0;
                                        $data['Expressionbesoin']['lot_id']=(isset($obj['Lot']['id'])) ? $obj['Lot']['id'] : null;
                                        break;  
                                    case 'ETAT':
                                    case strtoupper('etat_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('etats/getbynom',array('pass'=>array(trim($row[$k])))) : 0;
                                        $data['Expressionbesoin']['etat_id']=(isset($obj['Etat']['id'])) ? $obj['Etat']['id'] : null;
                                        break;   
                                    case 'PHASE':
                                    case strtoupper('phase_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('phases/getbynom',array('pass'=>array(trim(strtoupper($row[$k]))))) : null;
                                        $data['Expressionbesoin']['phase_id']=(isset($obj['Phase']['id'])) ? $obj['Phase']['id'] : null;
                                        break;    
                                    case 'VOLUMETRIE':
                                    case strtoupper('volumetrie_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('volumetries/getbynom',array('pass'=>array(trim(strtoupper($row[$k]))))) : null;
                                        $data['Expressionbesoin']['volumetrie_id']=(isset($obj['Volumetry']['id'])) ? $obj['Volumetry']['id'] : null;
                                        break;   
                                    case 'PUISSANCE':
                                    case strtoupper('puissance_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('puissances/getbynom',array('pass'=>array(trim(strtoupper($row[$k]))))) : null;
                                        $data['Expressionbesoin']['puissance_id']=(isset($obj['Puissance']['id'])) ? $obj['Puissance']['id'] : null;
                                        break;  
                                    case 'ARCHITECTURE':
                                    case strtoupper('architecture_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('architectures/getbynom',array('pass'=>array(trim(strtoupper($row[$k]))))) : null;
                                        $data['Expressionbesoin']['architecture_id']=(isset($obj['Architecture']['id'])) ? $obj['Architecture']['id'] : null;
                                        break;                                       
                                    case 'APPLICATION':
                                    case strtoupper('application_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('applications/getbynom',array('pass'=>array(trim(mb_strtoupper($row[$k],'UTF-8'))))) : 0;
                                        $data['Expressionbesoin']['application_id']=(isset($obj['Application']['id'])) ? $obj['Application']['id'] : null;                                               
                                        break;
                                    case strtoupper('type_id'):
                                        $obj = $row[$k] != '' ? $this->requestAction('types/getbynom',array('pass'=>array(trim(mb_strtoupper($row[$k],'UTF-8'))))) : null;
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
                        $this->Parameter->requestAction('expressionbesoins/saveHistory/'.$lastid.'/false');
                        $return['messages'][] = __(sprintf('Ligne %d sauvegardée.',$i), true);
                    }
                }
            }
            fclose($handle);           
            return $return['errors'];            
        }   
        
        public function setLog($message, $element = 'default', $params = array(), $key = 'flash') {
            $this->Session->write('Log.' . $key, compact('message', 'element', 'params'));
        }
        
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
        
        public function jsongetdatatabledescription($tablename){
            $this->autoRender = false;
            $sql = 'DESCRIBE '.$tablename;
            //$db = ConnectionManager::getDataSource('default');
            //$table = $db->rawQuery($sql);            
            $table = $this->Bien->query($sql);
            //debug($table);
            //exit();
            return json_encode($table);
        }
        
        public function openmaintenance() {
            $this->autoRender = false;
            $filename = WWW_ROOT.'maintenance.md';
            $fp = fopen($filename,"wb");
            fclose($fp);            
            $this->History->notmove();
	}
        
        public function closemaintenance() {
            $this->autoRender = false;
            $filename = WWW_ROOT.'maintenance.md';
            unlink(realpath($filename));
            $this->History->notmove();
	}        
}
