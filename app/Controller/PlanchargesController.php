<?php
App::uses('AppController', 'Controller');
/**
 * Plancharges Controller
 *
 * @property Plancharge $Plancharge
 */
class PlanchargesController extends AppController {

        public $paginate = array(
        'limit' => 15,
        //'threaded',
        'order' => array('Plancharge.ANNEE' => 'asc','Projet.NOM' => 'asc'),
        //'group'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id'),
        );
            
/**
 * index method
 *
 * @return void
 */
	public function index($annee=null,$projet_id=null) {
            if (isAuthorized('plancharges', 'index')) :
                $this->set('title_for_layout','Plans de charge'); 
                if ($annee==null){ $annee = new DateTime(); $annee = $annee->format('Y'); }
                switch ($annee){
                    case 'tous':
                        $newconditions[]="1=1";
                        $fannee = "de tous les plans de charge pour toutes les années";
                        break;
                    default:
                    case null:
                        $newconditions[]="Plancharge.ANNEE = '".$annee."'";
                        $fannee = "tous les plans de charge de ".$annee;
                        break;                                         
                }  
                $this->set('fannee',$fannee);    
                switch ($projet_id){
                    case 'tous':
                    case null:
                        $newconditions[]="1=1";
                        $fprojet = "de tous les projets";
                        break;
                    default:
                        $newconditions[]="Plancharge.projet_id = ".$projet_id;
                        $projet = $this->Plancharge->Projet->find('first',array('fields'=>array('Projet.NOM'),'conditions'=>array('Projet.id'=>$projet_id),'recursive'=>-1));
                        $fprojet = "du projet :".$projet['Projet']['NOM'];
                        break;                                         
                }  
                $this->set('fprojet',$fprojet);                  
		$this->Plancharge->recursive = 0;
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                   
		$this->set('plancharges', $this->paginate());
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
            if (isAuthorized('plancharges', 'add')) :
                $this->set('title_for_layout','Plan de charge');                  
		if ($this->request->is('post')) :
			$this->Plancharge->create();
			if ($this->Plancharge->save($this->request->data)) {
				$this->Session->setFlash(__('Plan de charge créée'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('controller'=>'detailplancharges','action' => 'index',$this->Plancharge->getLastInsertID()));
			} else {
				$this->Session->setFlash(__('Plan de charge incorrect, veuillez corriger le plan de charge'),'default',array('class'=>'alert alert-error'));
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
            if (isAuthorized('plancharges', 'edit')) :
                $this->set('title_for_layout','Plan de charge');                  
		if (!$this->Plancharge->exists($id)) {
			throw new NotFoundException(__('Plan de charge incorrect'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Plancharge->save($this->request->data)) {
				$this->Session->setFlash(__('Plan de charge mis à jour'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Plan de charge incorrect, veuillez corriger le plan de charge'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$options = array('conditions' => array('Plancharge.' . $this->Plancharge->primaryKey => $id));
			$this->request->data = $this->Plancharge->find('first', $options);
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
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
                $this->set('title_for_layout','Plan de charge');              
		$this->Plancharge->id = $id;
		if (!$this->Plancharge->exists()) {
			throw new NotFoundException(__('Plan de charge incorrect'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Plancharge->delete()) {
			$this->Session->setFlash(__('Plancharge deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Plancharge was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
