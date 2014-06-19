<?php
App::uses('AppController', 'Controller');
/**
 * Actionslivrables Controller
 *
 * @property Actionslivrable $Actionslivrable
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class ActionslivrablesController extends AppController {
        public $components = array('History','Common');
                
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Association d'un livrable à une action" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }        
        
    /**
     * Méthode permettant d'autoriser certaines méthodes sans authentification
     */
    public function beforeFilter() {   
        //$this->Auth->allow(array('json_get_this'));
        parent::beforeFilter();
    }   
    
/**
 * index method
 *
 * @return void
 */
//	public function index() {
//		$this->Actionslivrable->recursive = 0;
//		$this->set('actionslivrables', $this->paginate());
//	}

    /**
     * Méthode pour ajouter un livrable à une action
     * 
     * @param int $id
     */
    public function add($id=null) {
            $this->set_title();
            if ($this->request->is('post')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Actionslivrable->validate = array();
                    $this->History->goBack(1);
                else:                    
                    foreach ($this->request->data['Actionslivrable']['livrable_id'] as $value) {
                            $record['Actionslivrable']['livrable_id'] = $value;
                            $record['Actionslivrable']['action_id'] = $this->request->data['Actionslivrable']['action_id'];
                            $record['Actionslivrable']['created'] = date('Y-m-d');
                            $record['Actionslivrable']['modified'] = date('Y-m-d');
                            $this->Actionslivrable->create();
                            $return=false;
                            if ($this->Actionslivrable->save($record)): $return=true; endif;
                    }  
                    if ($return) {
                            $this->Session->setFlash(__('Livrables ajoutés à l\'action',true),'flash_success');
                            $this->History->goBack(1);
                    } else {
                            $this->Session->setFlash(__('Livrables <b>NON</b> ajoutés à l\'action',true),'flash_failure');
                    }
                endif;
            }
            $livrables = $this->Actionslivrable->Livrable->find('list',array('fields'=>array('Livrable.id','Livrable.NOM'),'order'=>array('Livrable.NOM'=>'asc'))); //,'conditions'=>array('Actionslivrable.action_id'=>$id)
            $this->set(compact('livrables'));
    }

        public function get_list_livrables(){
            $livrables = $this->Actionslivrable->Livrable->find('list',array('fields'=>array('Livrable.id','Livrable.NOM'),'order'=>array('Livrable.NOM'=>'asc'))); //,'conditions'=>array('Actionslivrable.action_id'=>$id)
            return $livrables;            
        }
        
    /**
     * Méthode pour mettre à jour une association existante 
     * 
     * !Pas certain qu'elle soit utilisée!
     * 
     * @param int $id
     * @throws NotFoundException
     */
    public function edit($id = null) {
            $this->set_title();
            if (!$this->Actionslivrable->exists($id)) {
                    throw new NotFoundException(__('Association incorrecte'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Actionslivrable->validate = array();
                    $this->History->goBack(1);
                else:                    
                    if ($this->Actionslivrable->save($this->request->data)) {
                            $this->Session->setFlash(__('The actionslivrable has been saved'));
                            $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The actionslivrable could not be saved. Please, try again.'));
                    }
                endif;
            } else {
                    $options = array('conditions' => array('Actionslivrable.' . $this->Actionslivrable->primaryKey => $id));
                    $this->request->data = $this->Actionslivrable->find('first', $options);
            }
            $livrables = $this->Actionslivrable->Livrable->find('list',array('fields'=>array('Livrable.id','Livrable.NOM'),'order'=>array('Livrable.NOM'=>'asc'))); //,'conditions'=>array('Actionslivrable.action_id'=>$id)
            $actions = $this->Actionslivrable->Action->find('list',array('fields'=>array('Action.id','Action.OBJET'),'order'=>array('Action.OBJET'=>'asc'))); //,'conditions'=>array('Actionslivrable.action_id'=>$id)
            $this->set(compact('livrables', 'actions'));
    }

    /**
     * Méthode qui supprime l'association action livrable
     * 
     * @param int $id
     * @throws NotFoundException
     */
    public function delete($id = null) {
            $this->set_title();
            $this->Actionslivrable->id = $id;
            if (!$this->Actionslivrable->exists()) {
                    throw new NotFoundException(__('Association incorrecte'));
            }
            if ($this->Actionslivrable->delete()) {
                    $this->Session->setFlash(__('Association supprimée',true),'flash_success');
                    $this->History->goBack(1);
            }
            $this->Session->setFlash(__('Association <b>NON</b> supprimée',true),'flash_failure');
            $this->History->goBack(1);
    }
}
