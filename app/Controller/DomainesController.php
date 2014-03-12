<?php
App::uses('AppController', 'Controller');
/**
 * Domaines Controller
 *
 * @property Domaine $Domaine
 */
class DomainesController extends AppController {
        public $components = array('History','Common');
        public $paginate = array(
        'limit' => 25,
        'order' => array('Domaine.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
        
        public function get_visibilty(){
            if(userAuth('profil_id')==1):
                return "1=1";
            else:
                return array('OR'=>array('Domaine.entite_id IS NULL','Domaine.entite_id'=>userAuth('entite_id')));
            endif;
        }        
        
        public function get_cercles(){
            if(userAuth('profil_id')==1):
                return $this->requestAction('entites/find_list_all_actif_cercle');
            else:
                return $this->requestAction('entites/find_list_cercle');
            endif;
        }        
            
/**
 * index method
 *
 * @return void
 */
	public function index() {
            //$this->Session->delete('history');
            if (isAuthorized('domaines', 'index')) :
                $newconditions[]= $this->get_visibilty();
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));  
		$this->set('domaines', $this->paginate());
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('domaines', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Domaine->validate = array();
                        $this->History->goBack(1);
                    else:                    
			$this->Domaine->create();
			if ($this->Domaine->save($this->request->data)) {
				$this->Session->setFlash(__('Domaine sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Domaine incorrect, veuillez corriger le domaine',true),'flash_failure');
			}
                    endif;
		endif;
                $cercles = $this->get_cercles();
                $this->set(compact('cercles'));
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
            if (isAuthorized('domaines', 'edit')) :
		if (!$this->Domaine->exists($id)) {
			throw new NotFoundException(__('Domaine incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Domaine->validate = array();
                        $this->History->goBack(1);
                    else:                    
			if ($this->Domaine->save($this->request->data)) {
				$this->Session->setFlash(__('Domaine sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Domaine incorrect, veuillez corriger le domaine',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Domaine.' . $this->Domaine->primaryKey => $id));
			$this->request->data = $this->Domaine->find('first', $options);
                        $cercles = $this->get_cercles();
                        $this->set(compact('cercles'));                        
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
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
            if (isAuthorized('domaines', 'delete')) :
		$this->Domaine->id = $id;
		if (!$this->Domaine->exists()) {
			throw new NotFoundException(__('Domaine incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Domaine->delete()) {
			$this->Session->setFlash(__('Domaine supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Domaine NON supprimé',true),'flash_failure');
		$this->History->goBack(1);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
            if (isAuthorized('domaines', 'index')) :
                if(isset($this->params->data['Domaine']['SEARCH'])):
                    $keywords = $this->params->data['Domaine']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords)); 
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Domaine.NOM LIKE '%".$value."%'","Domaine.DESCRIPTION LIKE '%".$value."%'"));
                    endforeach;
                    $newconditions[]= $this->get_visibilty();                  
                    $conditions = array($newconditions,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));                
                    $this->set('domaines', $this->paginate());               
                else:
                    $this->redirect(array('action'=>'index'));
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        }    
        
        public function get_list(){
            return $this->Domaine->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc'),'recursive'=>0));
        }
        
        public function get_all(){
            return $this->Domaine->find('all',array('order'=>array('NOM'=>'asc'),'recursive'=>0));
        }           
}
