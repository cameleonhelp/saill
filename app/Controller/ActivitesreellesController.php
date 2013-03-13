<?php
App::uses('AppController', 'Controller');
/**
 * Activitesreelles Controller
 *
 * @property Activitesreelle $Activitesreelle
 */
class ActivitesreellesController extends AppController {

        public $paginate = array(
        'limit' => 15,
        'order' => array('Activitesreelle.DATE' => 'desc'),
        );
        
/**
 * index method
 *
 * @return void
 */
	public function index($id=null) {
                $this->set('title_for_layout','Feuilles de temps');
		$this->Activitesreelle->recursive = 0;
		$this->set('activitesreelles', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
                $this->set('title_for_layout','Feuilles de temps');            
		if (!$this->Activitesreelle->exists($id)) {
			throw new NotFoundException(__('Feuille de temps incorrecte'));
		}
		$options = array('conditions' => array('Activitesreelle.' . $this->Activitesreelle->primaryKey => $id));
		$this->set('activitesreelle', $this->Activitesreelle->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($utilisateur_id=null,$action_id=null) {
                $this->set('title_for_layout','Feuilles de temps');            
		if ($this->request->is('post')) {
                        if ($utilisateur_id!=null) $this->request->data['Activitesreelle']['utilisateur_id']=$utilisateur_id ;
                        $this->request->data['Activitesreelle']['action_id']=$action_id;
                        if ($this->ActiviteExists($this->request->data['Activitesreelle']['utilisateur_id'], $this->request->data['Activitesreelle']['DATE'], $this->request->data['Activitesreelle']['activite_id']) > 0){
                            $this->Session->setFlash(__('Feuille de temps existante'),'default',array('class'=>'alert alert-info'));
                            $this->redirect(array('action' => 'edit',$this->ActiviteExists($this->request->data['Activitesreelle']['utilisateur_id'], $this->request->data['Activitesreelle']['DATE'], $this->request->data['Activitesreelle']['activite_id'])));
                        }
			$this->Activitesreelle->create();
                        if ($this->Activitesreelle->save($this->request->data)) {
				$this->Session->setFlash(__('Feuille de temps créée'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'edit',$this->Activitesreelle->getLastInsertID()));
			} else {
				$this->Session->setFlash(__('Feuille de temps incorrecte, veuillez corriger la feuille de temps'),'default',array('class'=>'alert alert-error'));
			}
		}
                $condition=array("1=1");
                if ($action_id != null) {
                    $condition = ('Activite.projet_id > 1');
                }
                $activites = $this->Activitesreelle->Activite->find('list',array('fields'=>array('id','NOM'),'conditions'=>$condition));
		$this->set('activites', $activites);
		$utilisateurs = $this->Activitesreelle->Utilisateur->find('list',array('fields'=>array('id','NOMLONG'),'conditions'=>array('Utilisateur.ACTIF'=>1,'Utilisateur.id>1')));
		$this->set('utilisateurs', $utilisateurs);
                if ($action_id != null) {
                $action = $this->Activitesreelle->Action->find('first',array('conditions'=>array('Action.id'=>$action_id)));
                    $this->request->data['Activitesreelle']['utilisateur_id'] = $action['Action']['utilisateur_id'];
                    $this->request->data['Activitesreelle']['DATE'] = $action['Action']['DEBUT'];
                    $this->request->data['Activitesreelle']['activite_id'] = $action['Action']['activite_id'];
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
                $this->set('title_for_layout','Feuilles de temps');            
		if (!$this->Activitesreelle->exists($id)) {
			throw new NotFoundException(__('Feuille de temps incorrecte'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Activitesreelle->save($this->request->data)) {
				$this->Session->setFlash(__('Feuille de temps sauvegardée'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Feuille de temps incorrecte veuillez corriger la feuille de temps'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Activitesreelle.' . $this->Activitesreelle->primaryKey => $id));
			$this->request->data = $this->Activitesreelle->find('first', $options);
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
                $this->set('title_for_layout','Feuilles de temps');            
		$this->Activitesreelle->id = $id;
		if (!$this->Activitesreelle->exists()) {
			throw new NotFoundException(__('Feuille de temps incorrecte'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Activitesreelle->delete()) {
				$this->Session->setFlash(__('Feuille de temps supprimée'),'default',array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index'));
		}
				$this->Session->setFlash(__('Feuille de temps <b>NON</b> supprimée'),'default',array('class'=>'alert alert-error'));
		$this->redirect(array('action' => 'index'));
	}
        
/**
 * duplicate method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function duplicate($id = null) {
                $this->set('title_for_layout','Feuilles de temps');  
                $this->Activitesreelle->id = $id;
                $record = $this->Activitesreelle->read();
                $date = $record['Activitesreelle']['DATE'];
                unset($record['Activitesreelle']['id']);
                unset($record['Activitesreelle']['DATE']);
                unset($record['Activitesreelle']['created']);                
                unset($record['Activitesreelle']['modified']);
                $date = new DateTime($this->Activitesreelle->CUSDate($date));
                $date->add(new DateInterval('P7D'));                
                $record['Activitesreelle']['DATE'] = $date->format('d/m/Y');
                if ($this->ActiviteExists($record['Activitesreelle']['utilisateur_id'], $record['Activitesreelle']['DATE'], $record['Activitesreelle']['activite_id']) > 0){
                    $this->Session->setFlash(__('Feuille de temps existante'),'default',array('class'=>'alert alert-info'));
                    $this->redirect(array('action' => 'edit',$this->ActiviteExists($record['Activitesreelle']['utilisateur_id'], $record['Activitesreelle']['DATE'], $record['Activitesreelle']['activite_id'])));
                }                
                $this->Activitesreelle->create();
                if ($this->Activitesreelle->save($record)) {
                        $this->Session->setFlash(__('Feuille de temps dupliquée'),'default',array('class'=>'alert alert-success'));
                        $this->redirect(array('action' => 'edit',$this->Activitesreelle->getLastInsertID()));
                } 
		$this->Session->setFlash(__('Feuille de temps <b>NON</b> dupliqué'),'default',array('class'=>'alert alert-error'));            
	}        
        
/**
 * search method
 *
 * @return void
 */
	public function search() {
                $this->set('title_for_layout','feuilles de temps');
                $keyword=$this->params->data['Activitesreelle']['SEARCH']; 
                $newconditions = array('OR'=>array("Utilisateur.NOM LIKE '%".$keyword."%'","Utilisateur.PRENOM LIKE '%".$keyword."%'","Activite.NOM LIKE '%".$keyword."%'"));
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Listediffusion->recursive = 0;
                $this->set('activitesreelles', $this->paginate());              
                $this->render('index');
        }          
        
/**
 * ActiviteExists method
 * 
 * @param type $utilisateurId
 * @param type $date
 * @param type $activite
 * @return l'id de l'activité si elle existe
 */        
        public function ActiviteExists($utilisateurId, $date, $activite){
            $allActivite = $this->Activitesreelle->find('first',array('conditions'=>array('Activitesreelle.utilisateur_id'=>$utilisateurId,'Activitesreelle.activite_id'=>$activite,'Activitesreelle.DATE'=>$this->Activitesreelle->CUSDate($this->Activitesreelle->debutsem($date)))));
            return isset($allActivite['Activitesreelle']) ? $allActivite['Activitesreelle']['id'] : 0;
        }        
}
