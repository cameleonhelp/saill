<?php
App::uses('AppController', 'Controller');
/**
 * Autorisations Controller
 *
 * @property Autorisation $Autorisation
 */
class AutorisationsController extends AppController {
 
    public $paginate = array(
        'limit' => 15,
        'order' => array('Autorisation.profil_id' => 'asc','Autorisation.MODEL' => 'asc'),
        /*'order' => array(
            'Post.title' => 'asc' /*/
        );
    
 /**
 * index method
 *
 * @return void
 */
	public function index($filtreautorisation=null) {
                switch ($filtreautorisation){
                    case 'tous':
                    case null:    
                        $newconditions[]="1=1";
                        $fprofil = "tous les profils";
                        break;
                    default :
                        $newconditions[]="Profil.NOM='".$filtreautorisation."'";
                        $fprofil = "le profil ".$filtreautorisation;                        
                }    
                $this->set('fprofil',$fprofil); 
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
		$this->Autorisation->recursive = 0;
		$this->set('autorisations', $this->paginate());
                $profils = $this->Autorisation->find('all',array('fields' => array('Profil.NOM'),'group'=>'Profil.NOM','order'=>array('Profil.NOM'=>'asc')));
                $this->set('profils',$profils);                
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Autorisation->exists($id)) {
			throw new NotFoundException(__('Autorisation incorrecte'));
		}
		$options = array('conditions' => array('Autorisation.' . $this->Autorisation->primaryKey => $id));
		$this->set('autorisation', $this->Autorisation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $models = $this->Autorisation->findAllTables($this->Autorisation);
                $this->set('models',$models);
                $profil = $this->Autorisation->Profil->find('list',array('fields' => array('id', 'NOM')));
                $this->set('profil',$profil);
		if ($this->request->is('post')) {
			$this->Autorisation->create();
			if ($this->Autorisation->save($this->request->data)) {
				$this->Session->setFlash(__('Autorisation sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Autorisation incorrecte, veuillez corriger l\'autorisation'),'default',array('class'=>'alert alert-error'));
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
                $models = $this->Autorisation->findAllTables($this->Autorisation);
                $this->set('models',$models);            
                $profil = $this->Autorisation->Profil->find('list',array('fields' => array('id', 'NOM')));
                $this->set('profil',$profil);                
		if (!$this->Autorisation->exists($id)) {
			throw new NotFoundException(__('Autorisation incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Autorisation->save($this->request->data)) {
				$this->Session->setFlash(__('Autorisation sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Autorisation incorrecte, veuillez corriger l\'autorisation'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Autorisation.' . $this->Autorisation->primaryKey => $id));
			$this->request->data = $this->Autorisation->find('first', $options);
                        $this->set('autorisation', $this->Autorisation->find('first', $options));
		}
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
		$this->Autorisation->id = $id;
		if (!$this->Autorisation->exists()) {
			throw new NotFoundException(__('Autorisation incorrecte'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Autorisation->delete()) {
			$this->Session->setFlash(__('Autorisation supprimée'),'default',array('class'=>'alert alert-success'));
			$this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Autorisation NON supprimée'),'default',array('class'=>'alert alert-error'));
		$this->redirect($this->goToPostion());
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $keyword=$this->params->data['Autorisation']['SEARCH']; 
                //$newconditions = array('OR'=>array("Message.LIBELLE LIKE '%$keyword%'","ModelName.name LIKE '%$keyword%'", "ModelName.email LIKE '%$keyword%'")  );
                $newconditions = array('OR'=>array("Profil.NOM LIKE '%".$keyword."%'","Autorisation.MODEL LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                //$this->set('messages',$this->Message->search($this->data['Message']['MessageSEARCH'])); 
                $this->autoRender = false;
                $this->Autorisation->recursive = 0;
                $this->set('autorisations', $this->paginate());
                $profils = $this->Autorisation->find('all',array('fields' => array('Profil.NOM'),'group'=>'Profil.NOM','order'=>array('Profil.NOM'=>'asc')));
                $this->set('profils',$profils);                 
                $this->render('index');
        }          
}
