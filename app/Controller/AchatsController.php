<?php
App::uses('AppController', 'Controller');
/**
 * Achats Controller
 *
 * @property Achat $Achat
 */
class AchatsController extends AppController {
  
        public $paginate = array(
        'limit' => 15,
        'order' => array('Achat.DATE' => 'desc','Achat.LIBELLEACHAT' => 'asc'),
        );
/**
 * index method
 *
 * @return void
 */
	public function index($filtre=null) {
                switch ($filtre){
                    case 'toutes':
                    case null:    
                        $newconditions[]="1=1";
                        $factivite = "toutes les activités";
                        break;                 
                    default :
                        $newconditions[]="Activite.id='".$filtre."'";
                        $activite = $this->Achat->Activite->find('first',array('fields'=>array('NOM'),'conditions'=>array('Activite.id'=>$filtre)));
                        $factivite = "l'activité ".$activite['Activite']['NOM'];
                        break;                      
                }  
                $this->set('factivite',$factivite);            
		$this->Achat->recursive = 0;
		$this->set('achats', $this->paginate());
                $activites = $this->Achat->Activite->find('all',array('fields' => array('id','NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Activite.projet_id>1'));
                $this->set('activites',$activites);                  
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Achat->exists($id)) {
			throw new NotFoundException(__('Achat incorrect'));
		}
		$options = array('conditions' => array('Achat.' . $this->Achat->primaryKey => $id));
		$this->set('achat', $this->Achat->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $activites = $this->Achat->Activite->find('list',array('fields' => array('id','NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Activite.projet_id>1'));
                $this->set('activites',$activites);  
		if ($this->request->is('post')) {
			$this->Achat->create();
			if ($this->Achat->save($this->request->data)) {
				$this->Session->setFlash(__('Achat sauvegardé'),'default',array('class'=>'alert alert-success'));
                                $this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Achat incorrect, veuillez corriger l\'achat'),'default',array('class'=>'alert alert-error'));
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
                $activites = $this->Achat->Activite->find('list',array('fields' => array('id','NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Activite.projet_id>1'));
                $this->set('activites',$activites);              
		if (!$this->Achat->exists($id)) {
			throw new NotFoundException(__('Achat incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Achat->save($this->request->data)) {
				$this->Session->setFlash(__('Achat sauvegardé'),'default',array('class'=>'alert alert-success'));
                                $this->redirect($this->goToPostion(1));
			} else {
				$this->Session->setFlash(__('Achat incorrect, veuillez corriger l\'achat'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Achat.' . $this->Achat->primaryKey => $id));
			$this->request->data = $this->Achat->find('first', $options);
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
		$this->Achat->id = $id;
		if (!$this->Achat->exists()) {
			throw new NotFoundException(__('Achat incorrect'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Achat->delete()) {
			$this->Session->setFlash(__('Achat supprimé'),'default',array('class'=>'alert alert-success'));
                        $this->redirect($this->goToPostion());
		}
		$this->Session->setFlash(__('Achat <b>NON</b> supprimé'),'default',array('class'=>'alert alert-error'));
                $this->redirect($this->goToPostion());
	}
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $keyword=$this->params->data['Achat']['SEARCH']; 
                $newconditions = array('OR'=>array("Activite.NOM LIKE '%".$keyword."%'","Achat.LIBELLEACHAT LIKE '%".$keyword."%'","Achat.DESCRIPTION LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Achat->recursive = 0;
                $this->set('achats', $this->paginate());
                $activites = $this->Achat->Activite->find('all',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Activite.projet_id>1'));
                $this->set('activites',$activites);  
                $this->render('index');
        }    
       
}
