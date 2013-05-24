<?php
App::uses('AppController', 'Controller');
/**
 * Profils Controller
 *
 * @property Profil $Profil
 */
class ProfilsController extends AppController {
        public $components = array('History');
    public $paginate = array(
        'limit' => 15,
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
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
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
           if (isAuthorized('profils', 'view')) :
		if (!$this->Profil->exists($id)) {
			throw new NotFoundException(__('Profil incorrect'));
		}
		$options = array('conditions' => array('Profil.' . $this->Profil->primaryKey => $id),'recursive'=>0);
		$this->set('profil', $this->Profil->find('first', $options));
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
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
			$this->Profil->create();
			if ($this->Profil->save($this->request->data)) {
				$this->Session->setFlash(__('Profil sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Profil incorrect, veuillez corriger le profil'),'default',array('class'=>'alert alert-error'));
			}
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
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
			if ($this->Profil->save($this->request->data)) {
				$this->Session->setFlash(__('Profil sauvegardé'),'default',array('class'=>'alert alert-success'));
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Profil incorrect, veuillez corriger le profil'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Profil.' . $this->Profil->primaryKey => $id),'recursive'=>0);
			$this->request->data = $this->Profil->find('first', $options);
		}
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
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
			$this->Session->setFlash(__('Profil supprimé'),'default',array('class'=>'alert alert-success'));
			$this->History->goBack();
		}
		$this->Session->setFlash(__('Profil NON supprimé'),'default',array('class'=>'alert alert-error'));
		$this->History->goBack();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
            if (isAuthorized('profils', 'index')) :
                $keyword=isset($this->params->data['Profil']['SEARCH']) ? $this->params->data['Profil']['SEARCH'] : '';  
                $newconditions = array('OR'=>array("Profil.NOM LIKE '%".$keyword."%'","Profil.COMMENTAIRE LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                //$this->set('messages',$this->Message->search($this->data['Message']['MessageSEARCH'])); 
                $this->autoRender = false;
                $this->Profil->recursive = 0;
                $this->set('profils', $this->paginate());
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
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
                        $this->Session->setFlash(__('Profil dupliqué'),'default',array('class'=>'alert alert-success'));
                        $this->History->goBack();
                } 
		$this->Session->setFlash(__('Profil <b>NON</b> dupliqué'),'default',array('class'=>'alert alert-error'));
		$this->History->goBack();
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;                
	}           
}
