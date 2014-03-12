<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 */
class MessagesController extends AppController {
        public $components = array('History','Common');
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }  
    
    public $paginate = array(
        'limit' => 25,
        'order' => array('Message.id' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
    public function get_visibilty(){
        if(userAuth('profil_id')==1):
            return "1=1";
        else:
            return array('OR'=>array('Message.entite_id IS NULL','Message.entite_id'=>userAuth('entite_id')));
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
            if (isAuthorized('messages', 'index')) :
                $newconditions[]= $this->get_visibilty();
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));    
		$this->set('messages', $this->paginate());
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
            if (isAuthorized('messages', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Message->validate = array();
                        $this->History->goFirst();
                    else:                     
			$this->Message->create();
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('Message sauvegardé',true),'flash_success');
				$this->History->goFirst();
			} else {
				$this->Session->setFlash(__('Message incorrect, veuillez corriger le message.',true),'flash_failure');
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
            if (isAuthorized('messages', 'edit')) :
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Message incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Message->validate = array();
                        $this->History->goFirst();
                    else:                     
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('Message sauvegardé',true),'flash_success');
				$this->History->goFirst();
			} else {
				$this->Session->setFlash(__('Message incorrect, veuillez corriger le message.',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Message->find('first', $options);
		}
                $cercles = $this->get_cercles();
                $this->set(compact('cercles'));                
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
            if (isAuthorized('messages', 'delete')) :
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Message incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Message->delete()) {
			$this->Session->setFlash(__('Message supprimé',true),'flash_success');
			$this->History->goFirst();
		}
		$this->Session->setFlash(__('Message NON supprimé.',true),'flash_failure');
		$this->History->goFirst();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}

/**
 * activeMessage method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return les messages actifs
 */        
        public function activeMessage() {
            $today = date('Y-m-d');
            if(isset($this->params['requested'])) { //s’il s’agit de l’appel pour l’élément
                $activeMessages = $this->Message->find('all',array('conditions' => array("OR" => array('Message.DATELIMITE IS NULL','Message.DATELIMITE >=' =>'0000-00-00','Message.DATELIMITE >=' => $today),"OR" => array('Message.entite_id IS NULL','Message.entite_id' => 0,'Message.entite_id' => userAuth('entite_id'))),'order'=>array('Message.id asc'),'recursive'=>-1));
                return $activeMessages;
            }
            return null;
        }
        
        public function listMessages(){
            $today = date('Y-m-d');
            $messages="";
            $activeMessages = $this->Message->find('all',array('fields'=>array('Message.LIBELLE'),'conditions' => array("OR" => array('Message.DATELIMITE' => NULL,'Message.DATELIMITE >=' => $today),"OR" => array('Message.entite_id IS NULL','Message.entite_id' => '','Message.entite_id' => userAuth('entite_id'))),'order'=>array('Message.id asc'),'recursive'=>-1));
            foreach ($activeMessages as $activeMessage) {
                    $messages .=  '"'.str_replace('"', "'", $activeMessage['Message']['LIBELLE']).'",';            
            }   
            $messages= substr($messages,0,strlen($messages)-1);
            return $messages;
        }
/**
 * search method
 *
 * @return void
 */
	public function search($keywords=null) {
            if (isAuthorized('messages', 'index')) :
                if(isset($this->params->data['Message']['SEARCH'])):
                    $keywords = $this->params->data['Message']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords));                  
                    $newconditions[]= $this->get_visibilty();
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array("Message.LIBELLE LIKE '%".$value."%'");
                    endforeach;
                    $conditions = array($newconditions,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions,'recursive'=>0));
                    $this->set('messages', $this->paginate());
                else:
                    $this->redirect(array('action'=>'index'));
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
        }        
}
