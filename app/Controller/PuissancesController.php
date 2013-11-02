<?php
App::uses('AppController', 'Controller');
/**
 * Puissances Controller
 *
 * @property Puissance $Puissance
 * @property PaginatorComponent $Paginator
 */
class PuissancesController extends AppController {
/**
 * Components
 *
 * @var array
 */
        public $paginate = array('limit' => 25,'order'=>array('Puissance.NOM'=>'asc'));
	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($actif=null,$application=null,$isDB=null,$isApp=null) {
            $this->set('title_for_layout','Puissances');
            if (isAuthorized('puissances', 'index')) :
                switch($actif):
                    case null:
                    case 1:
                        $newconditions[]="Puissance.ACTIF=1";
                        $strfilter = 'actives';
                        break;
                    case 0:
                        $newconditions[]="Puissance.ACTIF=0";
                        $strfilter = 'inactives';
                        break;
                endswitch;
                switch($application):
                    case null:
                    case 'all' :
                        $newconditions[]="1=1";
                        $strfilter .= ' pour tous les applications';
                        break;
                    default:
                        $newconditions[]="Puissance.application_id=".$application;
                        $this->Puissance->Application->id = $application;
                        $nom = $this->Puissance->Application->read('NOM');
                        $strfilter .= ' pour '.$nom['Application']['NOM'];
                        break;
                endswitch;  
                switch($isDB):
                    case null:
                    case 0:
                        $newconditionsOR[]="Puissance.DATABASE=1";
                        $strfilterplus = ' qui sont des bases de données';
                        break;
                    case 1 :
                        $newconditionsOR[]="Puissance.DATABASE=0";
                        $strfilterplus = '';
                        break;                    
                endswitch;  
                switch($isApp):
                    case null:
                    case 0:
                        $newconditionsOR[]="Puissance.APPLICATION=1";
                        $strfilterplus .= $strfilterplus=='' ? ' qui sont des applications' : ' et/ou des applications';
                        break;
                    case 1:
                        $newconditionsOR[]="Puissance.APPLICATION=0";
                        $strfilterplus .= '';
                        break;                    
                endswitch;     
                $OR = array('OR'=>$newconditionsOR);
                $newconditions = array_merge($newconditions,$OR);
                $this->set('strfilter',$strfilter.$strfilterplus);
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Puissance->recursive = 0;
		$this->set('puissances', $this->paginate());
                $applications = $this->requestAction('applications/get_list/1');
                $this->set('applications', $applications);                
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
                $this->set('title_for_layout','Puissances');
		if (!$this->Puissance->exists($id)) {
			throw new NotFoundException(__('Puissances incorrecte'));
		}
		$options = array('conditions' => array('Puissance.' . $this->Puissance->primaryKey => $id));
		$this->set('puissance', $this->Puissance->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $this->set('title_for_layout','Puissances');
            if (isAuthorized('puissances', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Puissance->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Puissance->create();
			if ($this->Puissance->save($this->request->data)) {
				$this->Session->setFlash(__('Puissance sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Puissance incorrecte, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		endif;
                $applications = $this->requestAction('applications/get_select/1/1');
                $this->set('applications', $applications);                
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
            $this->set('title_for_layout','Puissances');
            if (isAuthorized('puissances', 'edit')) :            
		if (!$this->Puissance->exists($id)) {
			throw new NotFoundException(__('Puissances incorrecte'));
		}
                $applications = $this->requestAction('applications/get_select/1/1');
                $this->set('applications', $applications);                
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Puissance->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Puissance->save($this->request->data)) {
				$this->Session->setFlash(__('Puissance sauvegardée',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Puissance incorrecte, veuillez corriger l\'application',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Puissance.' . $this->Puissance->primaryKey => $id));
			$this->request->data = $this->Puissance->find('first', $options);
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
            $this->set('title_for_layout','Puissances');
            if (isAuthorized('puissances', 'delete')) : 
		$this->Puissance->id = $id;
		if (!$this->Puissance->exists()) {
			throw new NotFoundException(__('Puissances incorrecte'));
		}
		if ($this->Puissance->saveField('ACTIF',0)) {
			$this->Session->setFlash(__('Puissance supprimée',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Puissance <b>NON</b> supprimée',true),'flash_failure');
		}
		$this->History->notmove();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                  
	}
        
        
        public function ajax_actif(){
                $id = $this->request->data('id');
                $this->Puissance->id = $id;
                $obj = $this->Puissance->find('first',array('conditions'=>array('Puissance.id'=>$id),'recursive'=>0));
                $newactif = $obj['Puissance']['ACTIF'] == 1 ? 0 : 1;
		if ($this->Puissance->saveField('ACTIF',$newactif)) {
			$this->Session->setFlash(__('Modification du statut actif pris en compte',true),'flash_success');
		} else {
			$this->Session->setFlash(__('Modification du statut actif <b>NON</b> pris en compte',true),'flash_failure');
		}
		exit();
        }
        
        public function search(){
            $this->set('title_for_layout','Puissances');
            if (isAuthorized('puissances', 'index')) :
                $keyword=isset($this->params->data['Puissance']['SEARCH']) ? $this->params->data['Puissance']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Puissance.NOM LIKE '%".$keyword."%'","Puissance.PUISSANCE LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Puissance->recursive = 0;
                $this->set('puissances', $this->paginate());                  
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;  
        }
        
        public function get_select($actif=1){
            $list = $this->Puissance->find('list',array('fields'=>array('Puissance.id','Puissance.NOM'),'conditions'=>array('Puissance.ACTIF'=>$actif),'recursive'=>0));
            return $list;
        }    
        
        public function get_list($actif=null){
            $conditions[] = $actif == null ? '1=1' : 'Puissance.ACTIF='.$actif;
            $list = $this->Puissance->find('all',array('fields'=>array('Puissance.id','Puissance.NOM'),'conditions'=>$conditions,'recursive'=>0));
            return $list;
        }     
        
        public function getbynom($nom){
            $this->Puissance->recursive = 0;
            $obj = $this->Puissance->findByNom($nom);
            return $obj;
        }         
}