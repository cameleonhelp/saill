<?php
App::uses('AppController', 'Controller');
/**
 * Activites Controller
 *
 * @property Activite $Activite
 */
class ActivitesController extends AppController {

        public $paginate = array(
        'limit' => 15,
        'order' => array('Projet.NOM'=>'asc','Activite.NOM' => 'asc'),
        //'conditions' => array('Activite.projet_id >' => 1),
        //'group'=>array('Activite.projet_id'),
        );
/**
 * index method
 *
 * @return void
 */
	public function index($filtreEtat,$filtre) {
                switch ($filtre){
                    case 'tous':
                        $newconditions[]="1=1";
                        $fprojet = "tous les projets";
                        break;
                    case 'autres':
                        $newconditions[]="Activite.projet_id > 1";
                        $fprojet = "tous les projets autre que indisponibilité";
                        break;                    
                    default :
                        $newconditions[]="Projet.NOM='".$filtre."'";
                        $fprojet = "le projet ".$filtre;
                        break;                      
                }  
                $this->set('fprojet',$fprojet); 
                switch ($filtreEtat){
                    case 'tous':
                        $newconditions[]="1=1";
                        $fetat = "toutes les activités";
                        break;
                    case 'actif':
                        $newconditions[]="Projet.ACTIF=1";
                        $fetat = "toutes les activités actives";
                        break;  
                    case 'inactif':
                        $newconditions[]="Projet.ACTIF=0";
                        $fetat = "toutes les activités inactives";
                        break;                                         
                }    
                $this->set('fetat',$fetat);                 
                $projets = $this->Activite->Projet->find('all',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc')));
                $this->set('projets',$projets);  
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                
		$this->Activite->recursive = 0;
		$this->set('activites', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Activite->exists($id)) {
			throw new NotFoundException(__('Activité incorrecte'),true,array('class'=>'alert alert-error'));
		}
		$options = array('conditions' => array('Activite.' . $this->Activite->primaryKey => $id));
		$this->set('activite', $this->Activite->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
                $projets = $this->Activite->Projet->find('list',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc')));
                $this->set('projets',$projets);               
		if ($this->request->is('post')) {
			$this->Activite->create();
			if ($this->Activite->save($this->request->data)) {
				$this->Session->setFlash(__('Activité sauvegardée'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index','tous'));
			} else {
				$this->Session->setFlash(__('Activité incorrecte, veuillez corriger l\'activité'),true,array('class'=>'alert alert-error'));
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
                $projets = $this->Activite->Projet->find('list',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc')));
                $this->set('projets',$projets);               
		if (!$this->Activite->exists($id)) {
			throw new NotFoundException(__('Activité incorrecte'),true,array('class'=>'alert alert-error'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Activite->save($this->request->data)) {
				$this->Session->setFlash(__('Activité sauvegardée'),true,array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index','tous'));
			} else {
				$this->Session->setFlash(__('Activité incorrecte, veuillez corriger l\'activité'),true,array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Activite.' . $this->Activite->primaryKey => $id));
			$this->request->data = $this->Activite->find('first', $options);
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
		$this->Activite->id = $id;
		if (!$this->Activite->exists()) {
			throw new NotFoundException(__('Activité incorrecte'),true,array('class'=>'alert alert-error'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Activite->delete()) {
			$this->Session->setFlash(__('Activité supprimée'),true,array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index','tous'));
		}
		$this->Session->setFlash(__('Activité <b>NON</b> supprimée'),true,array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index','tous'));
	}
        
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $keyword=$this->params->data['Activite']['SEARCH']; 
                $newconditions = array('OR'=>array("Activite.NOM LIKE '%".$keyword."%'","Projet.NOM LIKE '%".$keyword."%'","Activite.NUMEROGALLILIE LIKE '%".$keyword."%'","Activite.DESCRIPTION LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Activite->recursive = 0;
                $this->set('activites', $this->paginate());
                $projets = $this->Activite->Projet->find('all',array('fields' => array('NOM'),'group'=>'NOM','order'=>array('NOM'=>'asc'),'conditions'=>'Projet.id>1'));
                $this->set('projets',$projets);  
                $this->render('/activites/index');
        }          
}
