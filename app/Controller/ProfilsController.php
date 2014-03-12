<?php
App::uses('AppController', 'Controller');
/**
 * Profils Controller
 *
 * @property Profil $Profil
 */
class ProfilsController extends AppController {
        public $components = array('History','Common');
    public $paginate = array(
        'limit' => 25,
        'order' => array('Profil.NOM' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
            //$this->Session->delete('history');
            if (isAuthorized('profils', 'index')) :
		$this->Profil->recursive = 0;
		$this->set('profils', $this->paginate());
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
            if (isAuthorized('profils', 'add')) :
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Profil->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Profil->create();
			if ($this->Profil->save($this->request->data)) {
				$this->Session->setFlash(__('Profil sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Profil incorrect, veuillez corriger le profil',true),'flash_failure');
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
            if (isAuthorized('profils', 'edit')) :
		if (!$this->Profil->exists($id)) {
			throw new NotFoundException(__('Profil incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->params['data']['cancel'])) :
                        $this->Profil->validate = array();
                        $this->History->goBack(1);
                    else:                     
			if ($this->Profil->save($this->request->data)) {
				$this->Session->setFlash(__('Profil sauvegardé',true),'flash_success');
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Profil incorrect, veuillez corriger le profil',true),'flash_failure');
			}
                    endif;
		} else {
			$options = array('conditions' => array('Profil.' . $this->Profil->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Profil->find('first', $options);
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
            if (isAuthorized('profils', 'delete')) :
		$this->Profil->id = $id;
		if (!$this->Profil->exists()) {
			throw new NotFoundException(__('Profil incorrect'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->Profil->delete()) {
                        $autorisations = $this->Profil->Autorisation->find('all',array('conditions'=>array('Autorisation.profil_id'=>$id)));
                        foreach($autorisations as $autorisation):
                            $this->Profil->Autorisation->id=$autorisation['Autorisation']['id'];
                            $this->Profil->Autorisation->delete();
                        endforeach;                    
			$this->Session->setFlash(__('Profil supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Profil NON supprimé',true),'flash_failure');
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
	public function search($keywords=null) {
            if (isAuthorized('profils', 'index')) :
                if(isset($this->params->data['Profil']['SEARCH'])):
                    $keywords = $this->params->data['Profil']['SEARCH'];
                elseif (isset($keywords)):
                    $keywords=$keywords;
                else:
                    $keywords=''; 
                endif;
                $this->set('keywords',$keywords);
                if($keywords!= ''):
                    $arkeywords = explode(' ',trim($keywords));  
                    $newconditions = array();
                    foreach ($arkeywords as $key=>$value):
                        $ornewconditions[] = array('OR'=>array("Profil.NOM LIKE '%".$value."%'","Profil.COMMENTAIRE LIKE '%".$value."%'"));
                    endforeach;
                    $conditions = array($newconditions,'OR'=>$ornewconditions);
                    $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$conditions));
                    $this->Profil->recursive = 0;
                    $this->set('profils', $this->paginate());
                else:
                    $this->redirect(array('action'=>'index'));
                endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
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
            if (isAuthorized('profils', 'duplicate')) :
		$this->Profil->id = $id;
                $record = $this->Profil->read();
                unset($record['Profil']['id']);
                $record['Profil']['COMMENTAIRE']='Autorisations dupliquée à partir du profil '.$record['Profil']['NOM'];
                $record['Profil']['NOM']='_'.$record['Profil']['NOM'].'(1)_';
                unset($record['Profil']['created']);                
                unset($record['Profil']['modified']);
                $this->Profil->create();
                if ($this->Profil->save($record)) {
                        $autorisations = $this->Profil->Autorisation->find('all',array('conditions'=>array('Autorisation.profil_id'=>$id)));
                        foreach($autorisations as $autorisation):
                            unset($autorisation['Autorisation']['id']);
                            $autorisation['Autorisation']['profil_id']= $this->Profil->getLastInsertID();
                            unset($autorisation['Autorisation']['created']);
                            unset($autorisation['Autorisation']['modified']);
                            $this->Profil->Autorisation->create();
                            $this->Profil->Autorisation->save($autorisation);
                        endforeach;
                        $this->Session->setFlash(__('Profil dupliqué',true),'flash_success');
                        $this->History->goBack(1);
                } 
		$this->Session->setFlash(__('Profil <b>NON</b> dupliqué',true),'flash_failure');
		$this->History->goBack(1);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;                
	}          
        
        public function get_list(){
            return $this->Profil->find('list',array('fields' => array('id', 'NOM'),'order'=>array('NOM'=>'asc'),'recursive'=>0));
        }
        
        public function get_all(){
            return $this->Profil->find('all',array('order'=>array('NOM'=>'asc'),'recursive'=>0));
        }        
}
