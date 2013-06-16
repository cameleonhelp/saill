<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'dump', array('file'=>'backup_restore.class.php'));
App::import('Vendor', 'filesfolder', array('file'=>'files_folders.class.php'));
/**
 * Parameters Controller
 *
 * @property Parameters $Parameter
 */
class ParametersController extends AppController {
        public $components = array('History');
               
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
	}
        
	public function savebdd() {
                $this->set('title_for_layout','Sauvegarde du site');
                $database = $this->Parameter->getDataSource();
                $path = WWW_ROOT.DS.'files'.DS.'sql_backup';
                $obj = new backup_restore($database->config['host'], $database->config['database'], $database->config['login'], $database->config['password'], $path);
                $backup = $obj->backup();
                if($backup) :
                    $this->Session->setFlash(__('Base de données sauvegardée'),'default',array('class'=>'alert alert-success'));
                    $this->redirect(array('action' => 'listebackup'));
                else:
                    $this->Session->setFlash(__('Base de données <b>NON</b> sauvegardée'),'default',array('class'=>'alert alert-error'));
                    $this->History->goBack();
                endif;
                exit();
	}  

	public function listebackup() {
            $this->set('title_for_layout','Sauvegardes du site');
            $files = new files_folder($this->params->base);
            $sqlfiles = $files->getSqlFiles();
            $this->set('files',$sqlfiles);
            //$this->History->goBack();
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
                $this->Session->setFlash(__('Base de données restaurée'),'default',array('class'=>'alert alert-success'));
            else:
                $this->Session->setFlash(__('Base de données <b>NON</b> restaurée - '.$backup),'default',array('class'=>'alert alert-error'));
            endif;
            $this->History->goBack(); 
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
               $this->Session->setFlash(__('Sauvegarde du site supprimée'),'default',array('class'=>'alert alert-success'));
            else  :
               $droits = $nfile->getdroits($sqlfile);
               $this->Session->setFlash(__('Sauvegarde <b>NON</b> supprimée '.$droits),'default',array('class'=>'alert alert-error')); 
            endif;
            $this->History->goBack();
        }

        /**
         * 
         */
        public function saveParam() {
            $id = $this->data['Parameter']['id'];
            $this->Parameter->id = $id;
            if ($this->Parameter->saveField('param', $this->data['Parameter']['param'])):
                $this->Session->setFlash(__('Paramètre mis à jour'),'default',array('class'=>'alert alert-success'));
            else:
                $this->Session->setFlash(__('Paramètre <b>NON</b> mis à jour'),'default',array('class'=>'alert alert-error')); 
            endif;
            $this->History->goBack();
	}
        
        
        public function get_version(){
            $version = $this->Parameter->find('first',array('conditions'=>array('nom'=>'version'),'recursive'=>-1));
            return $version;
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
        
        public function get_valideuroutil(){
            $version = $this->Parameter->find('first',array('conditions'=>array('nom'=>'valideuroutil'),'recursive'=>-1));
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
}
