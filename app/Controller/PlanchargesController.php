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
        'order' => array('Plancharge.ANNEE' => 'asc','Contrat.NOM' => 'asc'),
        //'group'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id'),
        );
            
/**
 * index method
 *
 * @return void
 */
	public function index($annee=null,$contrat_id=null) {
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
                switch ($contrat_id){
                    case 'tous':
                    case null:
                        $newconditions[]="1=1";
                        $fprojet = "de tous les contrats";
                        break;
                    default:
                        $newconditions[]="Plancharge.contrat_id = ".$contrat_id;
                        $contrat = $this->Plancharge->Contrat->find('first',array('fields'=>array('Contrat.NOM'),'conditions'=>array('Contrat.id'=>$contrat_id),'recursive'=>-1));
                        $fprojet = "du contrat :".$contrat['Contrat']['NOM'];
                        break;                                         
                }  
                $this->set('fprojet',$fprojet);                  
		$this->Plancharge->recursive = 0;
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));                   
		$this->set('plancharges', $this->paginate());
                $annees = $this->Plancharge->find('all',array('fields'=>array('Plancharge.ANNEE'),'group'=>'Plancharge.ANNEE','recursive'=>-1));
                $this->set('annees',$annees);
                $contrats = $this->Plancharge->find('all',array('fields'=>array('Plancharge.contrat_id','Contrat.NOM'),'group'=>'Contrat.NOM','recursive'=>0));
                $this->set('contrats',$contrats);                  
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
				$this->Session->setFlash(__('Plan de charge créé'),'default',array('class'=>'alert alert-success'));
				$this->redirect(array('controller'=>'detailplancharges','action' => 'add',$this->Plancharge->getLastInsertID()));
			} else {
				$this->Session->setFlash(__('Plan de charge incorrect, veuillez corriger le plan de charge'),'default',array('class'=>'alert alert-error'));
			}
		endif;
                $contrats = $this->Plancharge->Contrat->find('list',array('fields'=>array('Contrat.id','Contrat.NOM'),'conditions'=>array('Contrat.ACTIF'=>1,'Contrat.id>1'),'order'=>'Contrat.NOM'));
                $this->set('contrats',$contrats);
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
                                $lastIdInsert = $this->Plancharge->getLastInsertID();
                                $detailplancharges = $this->Plancharge->Detailplancharge->find('all',array('conditions'=>array('Detailplancharge.plancharge_id'=>$id)));
                                foreach($detailplancharges as $detailplancharge):
                                    $record = $detailplancharge;
                                    unset($record['Detailplancharge']['id']);
                                    unset($record['Detailplancharge']['created']);                
                                    unset($record['Detailplancharge']['modified']);  
                                    $record['Detailplancharge']['plancharge_id'] = $lastIdInsert;
                                    $this->Plancharge->Detailplancharge->create();
                                    $this->Plancharge->Detailplancharge->save($record);
                                endforeach;
				$this->Session->setFlash(__('Nouvelle version du plan de charge créée'),'default',array('class'=>'alert alert-success'));                                
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
        
/**
 * export_xls
 * 
 */       
	function export_xls($id=null) {
                /** export au format excel du détail du plan de charge **/
                $data = $this->Plancharge->Detailplancharge->find('all',array('conditions'=>array('Detailplancharge.plancharge_id'=>$id),'recursive'=>0));
		$this->set('rows',$data);
		$this->render('export_xls','export_xls');
        }     
                
}
