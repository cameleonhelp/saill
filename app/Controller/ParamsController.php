<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'dump', array('file'=>'backup_restore.class.php'));
/**
 * Params Controller
 *
 * @property Param $Param
 */
class ParamsController extends AppController {
        public $components = array('History');
               
/**
 * index method
 *
 * @return void
 */
	public function index() {
                $this->set('title_for_layout','Paramètres du site');
                $urlMinidoc = $this->Param->find('first',array('conditions'=>array('nom'=>'urlminidoc'),'recursive'=>-1));
                $this->set('urlminidoc',$urlMinidoc);
                $contact = $this->Param->find('first',array('conditions'=>array('nom'=>'contact'),'recursive'=>-1));
                $this->set('contact',$contact);
                $version = $this->Param->find('first',array('conditions'=>array('nom'=>'version'),'recursive'=>-1));
                $this->set('version',$version);                
	}
        
	public function savebdd() {
                $this->set('title_for_layout','Sauvegarde du site');
                $database = $this->Param->getDataSource();
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
                //$this->History->goBack();
	}  
        
	public function restorebdd() {
                $this->set('title_for_layout','Restauration du site');
                $database = $this->Param->getDataSource();
                $path = WWW_ROOT.DS.'files'.DS.'sql_backup';
                $file = $this->data->file;
                $obj = new backup_restore($database->config['host'], $database->config['database'], $database->config['login'], $database->config['password'], $path);
                $backup = $obj->restore($file);
                if($backup) :
                    $this->Session->setFlash(__('Base de données restaurée'),'default',array('class'=>'alert alert-success'));
                    $this->redirect(array('action' => 'listebackup'));
                else:
                    $this->Session->setFlash(__('Base de données <b>NON</b> restaurée '.$backup),'default',array('class'=>'alert alert-error'));
                    $this->History->goBack();
                endif;
                exit();
	}          
        
        public function deletebackup($sqlfile=null){
        if($sqlfile!=null):
            $path = WWW_ROOT.DS.'files'.DS.'sql_backup';
            $fileurl = realpath($path).DS.$sqlfile;
            if(file_exists($fileurl)):
               unlink($fileurl);
               $this->Session->setFlash(__('Sauvegarde du site supprimée'),'default',array('class'=>'alert alert-success'));
            else  :
               $this->Session->setFlash(__('Sauvegarde <b>INCONNUE NON</b> supprimée'),'default',array('class'=>'alert alert-error')); 
            endif;
        else :
            $this->Session->setFlash(__('Sauvegarde <b>INEXISTANTE</b>'),'default',array('class'=>'alert alert-error'));
        endif;
        $this->History->goBack();   
        }

        /**
         * 
         */
        public function saveParam() {
              $id = $this->data['Param']['id'];
              $this->Param->id = $id;
              if ($this->Param->saveField('param', $this->data['Param']['param'])):
                  $this->Session->setFlash(__('Paramètre mis à jour'),'default',array('class'=>'alert alert-success'));
              else:
                  $this->Session->setFlash(__('Paramètre <b>NON</b> mis à jour'),'default',array('class'=>'alert alert-error')); 
              endif;
              $this->History->goBack();
	}
        
        
        public function get_version(){
            $version = $this->Param->find('first',array('conditions'=>array('nom'=>'version'),'recursive'=>-1));
            return $version;
        }
        
        public function get_minidocurl(){
            $version = $this->Param->find('first',array('conditions'=>array('nom'=>'urlminidoc'),'recursive'=>-1));
            return $version;
        } 
        
        public function get_contact(){
            $version = $this->Param->find('first',array('conditions'=>array('nom'=>'contact'),'recursive'=>-1));
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
		if (!$this->Param->exists($id)) {
			throw new NotFoundException(__('Invalid param'));
		}
		$options = array('conditions' => array('Param.' . $this->Param->primaryKey => $id));
		$this->set('param', $this->Param->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Param->create();
			if ($this->Param->save($this->request->data)) {
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
		if (!$this->Param->exists($id)) {
			throw new NotFoundException(__('Invalid param'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Param->save($this->request->data)) {
				$this->Session->setFlash(__('The param has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The param could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Param.' . $this->Param->primaryKey => $id));
			$this->request->data = $this->Param->find('first', $options);
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
		$this->Param->id = $id;
		if (!$this->Param->exists()) {
			throw new NotFoundException(__('Invalid param'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Param->delete()) {
			$this->Session->setFlash(__('Param deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Param was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
