<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Plancharges Controller
 *
 * @property Plancharge $Plancharge
 */
class PlanchargesController extends AppController {
        public $components = array('History','Common');
        public $paginate = array(
        'limit' => 25,
        //'threaded',
        'order' => array('Plancharge.ANNEE' => 'asc','Contrat.NOM' => 'asc'),
        //'group'=>array('Activitesreelle.DATE','Activitesreelle.utilisateur_id'),
        );
            
/**
 * index method
 *
 * @return void
 */
	public function index($annee=null,$contrat_id=null,$isvisble=null) {
            //$this->Session->delete('history');
            if (isAuthorized('plancharges', 'index')) :
                $this->set('title_for_layout','Plans de charge'); 
                switch ($annee){
                    case 'tous':
                    case null:                        
                        $newconditions[]="1=1";
                        $fannee = "de tous les plans de charge pour toutes les années";
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
                switch ($isvisble){
                    case '1':
                    case null:
                        $newconditions[]="Plancharge.VISIBLE=1";
                        break;
                    default:
                        $newconditions[]="1=1";
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
                $addcontrats = $this->Plancharge->Contrat->find('list',array('fields'=>array('Contrat.id','Contrat.NOM'),'conditions'=>array('Contrat.ACTIF'=>1,'Contrat.id>1'),'order'=>'Contrat.NOM'));
                $this->set('addcontrats',$addcontrats);                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();            
            endif;                  
	}

/**
 * add method
 *
 * @return void
 */
	public function addnewpc() {
            if (isAuthorized('plancharges', 'add')) :
                $this->set('title_for_layout','Plan de charge');                  
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Plancharge->validate = array();
                        $this->History->goBack(1);
                    else:                     
			$this->Plancharge->create();
			if ($this->Plancharge->save($this->request->data)) {
				$this->Session->setFlash(__('Plan de charge créé',true),'flash_success');
				$this->redirect(array('controller'=>'detailplancharges','action' => 'add',$this->Plancharge->getLastInsertID()));
			} else {
				$this->Session->setFlash(__('Plan de charge incorrect, veuillez corriger le plan de charge',true),'flash_failure');
                                $this->History->notmove();
			}
                    endif;
		endif;
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
                    if (isset($this->params['data']['cancel'])) :
                        $this->Plancharge->validate = array();
                        $this->History->goBack(1);
                    else:                     
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
				$this->Session->setFlash(__('Nouvelle version du plan de charge créée',true),'flash_success');                                
				$this->History->goBack(1);
			} else {
				$this->Session->setFlash(__('Plan de charge incorrect, veuillez corriger le plan de charge',true),'flash_failure');
			}
                    endif;
		} else {
			$this->request->data = $thisplancharge;
		}
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
			$this->Session->setFlash(__('Plan de charge supprimé',true),'flash_success');
			$this->History->goBack(1);
		}
		$this->Session->setFlash(__('Plan de charge <b>NON</b> supprimé',true),'flash_failure');
		$this->History->goBack(1);
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
                $plancharge = $this->Plancharge->find('list',array('fields'=>array('id','NOM'),'conditions'=>array('Plancharge.VISIBLE'=>1),'order'=>array('Plancharge.NOM'=>'asc'),'recursive'=>-1));
                $this->set('plancharges',$plancharge);
                $domaines = $this->Plancharge->Detailplancharge->Domaine->find('list',array('fields'=>array('id','NOM'),'order'=>array('Domaine.NOM'),'recursive'=>-1));
                $this->set('domaines',$domaines);                
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();
            endif;               
	}    

        public function rapportagent() {
            $this->set('title_for_layout','Rapport du plan de charges pour un agent');
            if (isAuthorized('plancharges', 'rapports')) :
                if ($this->request->is('post')):
                    $id = $this->request->data['Plancharge']['utilisateur_id'];
                    $annee = $this->request->data['Plancharge']['ANNEE'];
                    $sql = "SELECT detailplancharges.ETP,detailplancharges.TOTAL,detailplancharges.TJM,detailplancharges.COUT,domaines.NOM,activites.NOM,projets.NOM,detailplancharges.utilisateur_id FROM detailplancharges
                            left join plancharges on plancharges.id = plancharge_id
                            left join domaines on domaines.id = domaine_id
                            left join activites on activites.id = activite_id
                            left join projets on projets.id = activites.projet_id
                            WHERE plancharges.ANNEE = ".$annee
                            ." AND plancharges.VISIBLE = 1 AND utilisateur_id = ".$id;
                    $rapportresult = $this->Plancharge->query($sql);
                    $this->set('rapportresults',$rapportresult);
                    $this->Session->delete('mail');
                    $this->Session->write('mail',$rapportresult);
                endif;
                $utilisateurs = $this->Plancharge->Detailplancharge->Utilisateur->find('list',array('fields'=>array('Utilisateur.id','Utilisateur.NOMLONG'),'conditions'=>array('Utilisateur.id > 1','Utilisateur.ACTIF'=>1,'OR'=>array('Utilisateur.GESTIONABSENCES'=>1,'Utilisateur.profil_id'=>-1)),'order'=>array('Utilisateur.NOMLONG'=>'asc'),'recursive'=>-1));
                $this->set('utilisateurs',$utilisateurs);  
                $annees = $this->Plancharge->find('all',array('fields'=>array('Plancharge.ANNEE'),'conditions'=>array('Plancharge.VISIBLE'=>1),'group'=>'Plancharge.ANNEE','recursive'=>-1));
                foreach($annees as $annee):
                    $val = $annee['Plancharge']['ANNEE'];
                    $years[$val]=$val;
                endforeach;
                $this->set('annees',$years);
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
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
                $this->Session->setFlash(__('Rapport impossible à éditer veuillez renouveler le calcul du rapport',true),'flash_failure');             
                $this->redirect(array('action'=>'rapport'));
            endif;
        }         
        
        public function isvisible($id){
            $this->Plancharge->id = $id;
            $plancharge = $this->Plancharge->find('first',array('fields'=>array('VISIBLE'),'conditions'=>array('Plancharge.id'=>$id),'recursive'=>-1));
            $newvalue = $plancharge['Plancharge']['VISIBLE']==0 ? 1 : 0;
            if($this->Plancharge->saveField('VISIBLE', $newvalue)):
                $this->Session->setFlash(__('Plan de charge mis à jour',true),'flash_success');
                exit();
            endif;
            $this->Session->setFlash(__('Echec de la mise à jour du plan de charge',true),'flash_failure');
            exit();
        }
        
        public function sendmail(){
            $plancharges = $this->Session->read('mail');
            $valideurs = $this->Plancharge->Detailplancharge->Utilisateur->find('all',array('conditions'=>array('Utilisateur.id'=>$plancharges[0]['detailplancharges']['utilisateur_id'])));
            $mailto = array();
            foreach($valideurs as $valideur):
                $mailto[]=$valideur['Utilisateur']['MAIL'];
            endforeach;
            $liste = '';
            foreach($plancharges as $plancharge):
                $liste .= '<li>'.$plancharge['projets']['NOM'].' - '.$plancharge['activites']['NOM'].' - '.$plancharge['domaines']['NOM'].' : '.$plancharge['detailplancharges']['TOTAL'].' jours</li>';                     
            endforeach;
            $to=$mailto;
            $from = userAuth('MAIL');
            $objet = 'SAILL : Votre plan de répartition des charges';
            $message = "Bonjour,<br>Voici comment doit se répartir votre saisie sur l'année : ".
                    '<ul>'.$liste.'</ul>';
            if($to!=''):
                try{
                $email = new CakeEmail();
                $email->config('smtp')
                        ->emailFormat('html')
                        ->from($from)
                        ->to($to)
                        ->subject($objet)
                        ->send($message);
                }
                catch(Exception $e){
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_failure');
                }  
            endif;
            $this->History->goBack(1);
        } 
}
