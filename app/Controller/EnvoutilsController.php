<?php
App::uses('AppController', 'Controller');
/**
 * Envoutils Controller
 *
 * @property Envoutil $Envoutil
 * @property PaginatorComponent $Paginator
 */
class EnvoutilsController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Envoutil.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null,$os=null) {
            $this->set('title_for_layout','Outils (logicels, OS)');
            if (isAuthorized('envoutils', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Envoutil.ACTIF=1";
                        $strfilter = 'actifs';
                        break;
                    case 0:
                        $newconditions[]="Envoutil.ACTIF=0";
                        $strfilter = 'inactifs';
                        break;
                endswitch;
                switch($os):
                    case null:                    
                    case 3:
                        $newconditions[]="1=1";
                        $strfilter .= ' qui sont des OS ou des logiciels';
                        break; 
                    case 1:
                        $newconditions[]="Envoutil.OS=1";
                        $strfilter .= ' qui sont des OS';
                        break;
                    case 0:
                        $newconditions[]="Envoutil.OS=0";
                        $strfilter .= ' qui sont des logiciels';
                        break;
                endswitch;                
                $this->set('strfilter',$strfilter);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Envoutil->recursive = 0;
		$this->set('envoutils', $this->paginate());
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
                $this->set('title_for_layout','Outils (logicels, OS)');
		if (!$this->Envoutil->exists($id)) {
			throw new NotFoundException(__('Outils incorrect'));
		}
		$options = array('conditions' => array('Envoutil.' . $this->Envoutil->primaryKey => $id));
		$this->set('envoutil', $this->Envoutil->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','Outils (logicels, OS)');
            if (isAuthorized('envoutils', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Envoutil->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Envoutil->create();
			if ($this->Envoutil->save($this->request->data)) {
				$this->Session->setFlash(__('Outils sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Outils incorrect, veuillez corriger l\'application',true),'flash_failure');
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
            $this->set('title_for_layout','Outils (logicels, OS)');
            if (isAuthorized('envoutils', 'edit')) :            
		if (!$this->Envoutil->exists($id)) {
			throw new NotFoundException(__('Outils incorrect'));
		}
                $versions = $this->requestAction('envversions/get_version_for/'.$id."/1");
                $this->set('envversions',$versions);                
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Envoutil->validate = array();
                        $this->History->goBack(2);
                    else:                    
			if ($this->Envoutil->save($this->request->data)) {
				$this->Session->setFlash(__('Outils sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Outils incorrect, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Envoutil.' . $this->Envoutil->primaryKey => $id));
			$this->request->data = $this->Envoutil->find('first', $options);
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
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
            $this->set('title_for_layout','Outils (logicels, OS)');
            if (isAuthorized('envoutils', 'delete')) : 
		$this->Envoutil->id = $id;
		if (!$this->Envoutil->exists()) {
			throw new NotFoundException(__('Outils incorrect'));
		}
		if ($this->Envoutil->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Outils supprimé',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Outils <b>NON</b> supprimé',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Envoutil->id = $id;
                $obj = $this->Envoutil->find('first',array('conditions'=>array('Envoutil.id'=>$id),'recursive'=>0));
                $newactif = $obj['Envoutil']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Envoutil->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            $this->set('title_for_layout','Outils (logicels, OS)');
            if (isAuthorized('envoutils', 'index')) :
                $keyword=isset($this->params->data['Envoutil']['SEARCH']) ? $this->params->data['Envoutil']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Envoutil.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Envoutil->recursive = 0;
                $this->set('envoutils', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_list_os($actif=1){
            $list = $this->Envoutil->find('all',array('conditions'=>array('Envoutil.ACTIF'=>$actif,'Envoutil.OS'=>1),'recursive'=>0));
            return $list;
        }
        
        public function get_list($actif=null){
            $conditions[] = $actif=null ? "1=1" : 'Envoutil.ACTIF='.$actif;
            $list = $this->Envoutil->find('all',array('conditions'=>$conditions,'order'=>array('Envoutil.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }
        
        public function get_list_software($actif=1){
            $list = $this->Envoutil->find('all',array('conditions'=>array('Envoutil.ACTIF'=>$actif,'Envoutil.OS'=>0),'recursive'=>0));
            return $list;
        }  

        public function get_select($actif=null){
            $conditions[] = $actif=null ? "1=1" : 'Envoutil.ACTIF='.$actif;
            $list = $this->Envoutil->find('list',array('fields'=>array('Envoutil.id','Envoutil.NOM'),'conditions'=>$conditions,'order'=>array('Envoutil.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }
        
        public function get_select_os($actif=1){
            $list = $this->Envoutil->find('list',array('fields'=>array('Envoutil.id','Envoutil.NOM'),'conditions'=>array('Envoutil.ACTIF'=>$actif,'Envoutil.OS'=>1),'order'=>array('Envoutil.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }
        
        public function get_select_software($actif=1){
            $list = $this->Envoutil->find('list',array('fields'=>array('Envoutil.id','Envoutil.NOM'),'conditions'=>array('Envoutil.ACTIF'=>$actif,'Envoutil.OS'=>0),'order'=>array('Envoutil.NOM'=>'asc'),'recursive'=>0));
            return $list;
        }  

        public function getbynom($nom){
            $this->Envoutil->recursive = 0;
            $obj = $this->Envoutil->findByNom($nom);
            return $obj;
        }        
}
