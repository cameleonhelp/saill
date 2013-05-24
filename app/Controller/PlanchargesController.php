<?php
App::uses('AppController', 'Controller');
/**
 * Plancharges Controller
 *
 * @property Plancharge $Plancharge
 */
class PlanchargesController extends AppController {
        public $components = array('History');
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
            //$this->Session->delete('history');
            if (isAuthorized('plancharges', 'index')) :
                $this->set('title_for_layout','Plans de charge'); 
                if ($annee==null || $annee=='<'){ $annee = new DateTime(); $annee = $annee->format('Y'); }
                switch ($annee){
                    case 'tous':
                        $newconditions[]="1=1";
                        $fannee = "de tous les plans de charge pour toutes les années";
                        break;
                    case null:
                    case '<':
                        $newconditions[]="Plancharge.ANNEE = '".$annee."'";
                        $fannee = "tous les plans de charge de ".$annee;
                        break;                         
                    default:
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
                $options = array('conditions' => array('Plancharge.' . $this->Plancharge->primaryKey => $id));
                $thisplancharge = $this->Plancharge->find('first', $options);
		if ($this->request->is('post') || $this->request->is('put')) {
                        $this->request->data['Plancharge']['ETP']=$thisplancharge['Plancharge']['ETP'];
                        $this->request->data['Plancharge']['CHARGES']=$thisplancharge['Plancharge']['CHARGES'];
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
				$this->History->goBack();;
			} else {
				$this->Session->setFlash(__('Plan de charge incorrect, veuillez corriger le plan de charge'),'default',array('class'=>'alert alert-error'));
			}
		} else {
			$this->request->data = $thisplancharge;
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

/**
 * rapport
 */        
        public function rapport() {
            $this->set('title_for_layout','Rapport des plans de charges');
            if (isAuthorized('plancharges', 'rapports')) :
                if ($this->request->is('post')):
                    foreach ($this->request->data['Plancharge']['id'] as &$value) {
                        @$planchargelist .= $value.',';
                    }  
                    $plancharges = 'Detailplancharge.plancharge_id IN ('.substr_replace(@$planchargelist ,"",-1).')';
                    foreach ($this->request->data['Plancharge']['domaine_id'] as &$value) {
                        @$domainelist .= $value.',';
                    }  
                    $domaines = 'Detailplancharge.domaine_id IN ('.substr_replace(@$domainelist ,"",-1).')';
                    $detailrapportresult = $this->Plancharge->Detailplancharge->find('all',array('fields'=>array('Plancharge.ANNEE', 'Domaine.NOM','Detailplancharge.activite_id','Activite.NOM','SUM(Detailplancharge.ETP) AS ETP','SUM(Detailplancharge.TOTAL) AS TOTAL'),'conditions'=>array($plancharges,$domaines),'order'=>array('Domaine.NOM'=>'asc'),'group'=>array('Plancharge.ANNEE', 'Domaine.NOM','Detailplancharge.activite_id'),'recursive'=>0));
                    $this->set('detailrapportresults',$detailrapportresult);
                    $chartchargeresults = $this->Plancharge->Detailplancharge->find('all',array('fields'=>array('Plancharge.ANNEE', 'Domaine.NOM','SUM(Detailplancharge.TOTAL) AS TOTAL'),'conditions'=>array($plancharges,$domaines),'order'=>array('Domaine.NOM'=>'asc'),'group'=>array('Plancharge.ANNEE', 'Domaine.NOM'),'recursive'=>0));
                    $this->set('chartchargeresults',$chartchargeresults);  
                    $chartetpresults = $this->Plancharge->Detailplancharge->find('all',array('fields'=>array('Plancharge.ANNEE', 'Domaine.NOM','SUM(Detailplancharge.ETP) AS ETP'),'conditions'=>array($plancharges,$domaines),'order'=>array('Domaine.NOM'=>'asc'),'group'=>array('Plancharge.ANNEE', 'Domaine.NOM'),'recursive'=>0));
                    $this->set('chartetpresults',$chartetpresults);                      
                    $rapportresult = $this->Plancharge->Detailplancharge->find('all',array('fields'=>array('Plancharge.ANNEE', 'Domaine.NOM','Detailplancharge.activite_id','Activite.NOM','SUM(Detailplancharge.ETP) AS ETP','SUM(Detailplancharge.TOTAL) AS TOTAL'),'conditions'=>array($plancharges,$domaines),'order'=>array('Domaine.NOM'=>'asc'),'group'=>array('Plancharge.ANNEE', 'Domaine.NOM'),'recursive'=>0));
                    $this->set('rapportresults',$rapportresult);
                    $this->Session->delete('rapportresults');  
                    $this->Session->delete('detailrapportresults');                      
                    $this->Session->write('rapportresults',$rapportresult);
                    $this->Session->write('detailrapportresults',$detailrapportresult);
                endif;
                $plancharge = $this->Plancharge->find('list',array('fields'=>array('id','NOM'),'order'=>array('Plancharge.NOM'=>'asc'),'recursive'=>-1));
                $this->set('plancharges',$plancharge);
                $domaines = $this->Plancharge->Detailplancharge->Domaine->find('list',array('fields'=>array('id','NOM'),'order'=>array('Domaine.NOM'),'recursive'=>-1));
                $this->set('domaines',$domaines);                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.'),'default',array('class'=>'alert alert-block'));
                throw new NotAuthorizedException();
            endif;               
	}    
        
	function export_doc() {
            if($this->Session->check('rapportresults') && $this->Session->check('detailrapportresults')):
                $data = $this->Session->read('rapportresults');
                $this->set('rowsrapport',$data);
                $data = $this->Session->read('detailrapportresults'); 
                $this->set('rowsdetail',$data);              
		$this->render('export_doc','export_doc');
            else:
                $this->Session->setFlash(__('Rapport impossible à éditer veuillez renouveler le calcul du rapport'),'default',array('class'=>'alert alert-error'));             
                $this->redirect(array('action'=>'rapport'));
            endif;
        }         
        
}
