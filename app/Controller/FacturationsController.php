<?php
App::uses('AppController', 'Controller');
/**
 * Facturations Controller
 *
 * @property Facturation $Facturation
 */
class FacturationsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Facturation->recursive = 0;
		$this->set('facturations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Facturation->exists($id)) {
			throw new NotFoundException(__('Invalid facturation'));
		}
		$options = array('conditions' => array('Facturation.' . $this->Facturation->primaryKey => $id));
		$this->set('facturation', $this->Facturation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($userid=null,$reelid=null) {
		if ($this->request->is('post')) {
			$this->Facturation->create();
			if ($this->Facturation->save($this->request->data)) {
				$this->Session->setFlash(__('The facturation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The facturation could not be saved. Please, try again.'));
			}
		}
                /** select all activités avec la même date et le même utilisateuyr **/
                $date = $this->Facturation->Activitesreelle->find('first',array('fields'=>array('Activitesreelle.DATE'),'conditions'=>array('Activitesreelle.id'=>$reelid),'recursive'=>-1));
                $activites = $this->Facturation->Activitesreelle->Activite->find('all',array('fields'=>array('id','Activite.NOM','Projet.NOM'),'order'=>array('Projet.NOM'=>'asc','Activite.NOM'=>'asc'),'conditions'=>array('Activite.ACTIVE'=>1),'recursive'=>0));
		$this->set('activites', $activites);
                $activitesreelles = $this->Facturation->Activitesreelle->find('all',array('conditions'=>array('Activitesreelle.utilisateur_id'=>$userid,'Activitesreelle.DATE'=>  CUSDate($date['Activitesreelle']['DATE'])),'recursive'=>-1));
		$this->set('activitesreelles', $activitesreelles);
         }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Facturation->exists($id)) {
			throw new NotFoundException(__('Invalid facturation'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Facturation->save($this->request->data)) {
				$this->Session->setFlash(__('The facturation has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The facturation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Facturation.' . $this->Facturation->primaryKey => $id));
			$this->request->data = $this->Facturation->find('first', $options);
		}
		$utilisateurs = $this->Facturation->Utilisateur->find('list');
		$activites = $this->Facturation->Activite->find('list');
		$this->set(compact('utilisateurs', 'activites'));
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
		$this->Facturation->id = $id;
		if (!$this->Facturation->exists()) {
			throw new NotFoundException(__('Invalid facturation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Facturation->delete()) {
			$this->Session->setFlash(__('Facturation deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Facturation was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * search method
 *
 * @return void
 */
	public function search() {
            if (isAuthorized('facturations', 'index')) :
                $this->set('title_for_layout','feuilles de temps à facturer');
                $keyword=isset($this->params->data['Facturation']['SEARCH']) ? $this->params->data['Facturation']['SEARCH'] : ''; 
                $newconditions = array('OR'=>array("Facturation.VERSION LIKE '%".$keyword."%'","Activite.NOM LIKE '%".$keyword."%'"));
                $group = $this->Facturation->find('all',array('fields'=>array('Facturation.DATE','Facturation.utilisateur_id','Utilisateur.NOM','Utilisateur.PRENOM','COUNT(Facturation.DATE) AS NBACTIVITE'),'group'=>array('Facturation.DATE','Facturation.utilisateur_id'),'order'=>array('Facturation.utilisateur_id' => 'asc','Facturation.DATE' => 'desc'),'conditions'=>$newconditions));                    
                $this->set('groups',$group); 
                $utilisateurs = $this->Activitesreelle->Utilisateur->find('all',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'Utilisateur.GESTIONABSENCES'=>1),'order'=>array('Utilisateur.NOMLONG' => 'asc')));
                $this->set('utilisateurs',$utilisateurs);                  
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
                $this->autoRender = false;
                $this->Facturation->recursive = 0;
                $this->set('facturations', $this->paginate());              
                $this->render('index');
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();           
            endif;                
        }  
        
/**
 * getActivitiesForUserAndDate method
 * 
 * @param type $userid
 * @param type $date
 * @return array of activities
 */        
        public function getActivitiesForUserAndDate($userid=null,$date=null){
                $sql = 'SELECT * FROM activitesreelles AS Activitesreelle WHERE Activitesreelle.utilisateur_id = '.$userid.' AND Activitesreelle.DATE = "'.$date.'"';
                return $this->request->query($sql);
        }
}
