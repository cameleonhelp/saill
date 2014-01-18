<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'ical', array('file'=>'class.iCalReader.php'));
App::uses('CakeEmail', 'Network/Email');
/**
 * Demandeabsences Controller
 *
 * @property Demandeabsence $Demandeabsence
 */
class DemandeabsencesController extends AppController {

/**
 * Components
 *
 * @var array
 */
        public $paginate = array(
        'limit' => 25,
        'order' => array('Demandeabsence.DATEDU' => 'asc','Demandeabsence.DATEAU'=>'asc'),
        );

	public $components = array('History','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($filtreDemandeur=null,$filtreReponse=null,$filtreDate=null) {  
            $this->set('title_for_layout','Suivi des absences');
            if (isAuthorized('demandeabsences', 'index')) :
                // application des filtres
                switch($filtreDemandeur):
                    case null:
                    case 'tous':
                        $monequipe = $this->requestAction('equipes/myTeam/'.userAuth('id')).userAuth('id');
                        $newconditions[] = 'Utilisateur.id IN ('.$monequipe.')';
                        $strfilter = ', pour toute mon équipe';
                        break;
                    default:
                        $newconditions[]="Demandeabsence.utilisateur_id=".$filtreDemandeur;
                        $nom = $this->Demandeabsence->Utilisateur->findById($filtreDemandeur);
                        $strfilter = ', pour '.$nom['Utilisateur']['NOMLONG'];
                        break;
                endswitch;
                switch($filtreReponse):
                    case null:
                    case '0':
                        $newconditions[]="Demandeabsence.REPONSE IS NULL";
                        $strfilter .= ', en attente';
                        break;                        
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter .= '';
                        break;  
                    case '1':
                        $newconditions[]="Demandeabsence.REPONSE='1'";
                        $strfilter .= ', validées';
                        break;                    
                    case '2':
                        $newconditions[]="Demandeabsence.REPONSE='2'";
                        $strfilter .= ', refusées';
                        break;  
                    case '3':
                        $newconditions[]="Demandeabsence.REPONSE='3'";
                        $strfilter .= ', supprimées';
                        break;                     
                endswitch;  
                switch($filtreDate):
                    case null:
                    case '2':
                        $today = new DateTime();
                        $newconditions[]="Demandeabsence.DATEDU >= '".$today->format('Y-m-d')."'";
                        $strfilter .= ', après aujourd\'hui (inclus)';
                        break;                          
                    case 'tous':
                        $newconditions[]="1=1";
                        $strfilter .= '';
                        break; 
                    case '1':
                        $today = new DateTime();
                        $newconditions[]="Demandeabsence.DATEDU < '".$today->format('Y-m-d')."'";
                        $strfilter .= ', avant aujourd\'hui';
                        break;                                        
                endswitch;                 
                $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
		$this->Demandeabsence->recursive = 0;
		$this->set('demandeabsences', $this->paginate());   
                $demandeurs = $this->requestAction('equipes/listMyTeam/'.userAuth('id'));
                $utilisateurs = $this->requestAction('equipes/getMyTeam/'.userAuth('id'));
                $this->set(compact('demandeurs','strfilter','utilisateurs'));  
            else :
                $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
                throw new NotAuthorizedException();                
            endif;
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Demandeabsence->exists($id)) {
			throw new NotFoundException(__('Invalid demandeabsence'));
		}
		$options = array('conditions' => array('Demandeabsence.' . $this->Demandeabsence->primaryKey => $id));
		$this->set('demandeabsence', $this->Demandeabsence->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            if (isAuthorized('demandeabsences', 'add')) :            
		if ($this->request->is('post')) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Demandeabsence->validate = array();
                    else:          
                        $today = new DateTime();
                        $this->request->data['Demandeabsence']['DATEDEMANDE'] = $today->format('y-m-d H:i:s');
			$this->Demandeabsence->create();
                    	if ($this->Demandeabsence->save($this->request->data)) {
                            //calcul du nombre de jour et insertion dans activitesreelles avec demandeabsence_id = getLastInsert()
                            $options = array('conditions' => array('Demandeabsence.' . $this->Demandeabsence->primaryKey => $this->Demandeabsence->getLastInsertID()));
                            $demandeabsence =  $this->Demandeabsence->find('first', $options);                               
                            //$demandeabsence = $this->Demandeabsence->read($this->Demandeabsence->getLastInsertID());
                            $this->insertConges($demandeabsence);
                            $this->sendmaildemandeabsences($demandeabsence);
                            $this->Session->setFlash(__('Demande d\'absences sauvegardée',true),'flash_success');
                        } else {
                            $this->Session->setFlash(__('Demande d\'absences <b>NON</b> sauvegardée',true),'flash_failure');
                        }
                    endif;
                    $this->History->goBack(1);
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
            if (isAuthorized('demandeabsences', 'add')) : 
                $id = $id == null ? $this->request->data['Demandeabsence']['id'] : $id;
		if (!$this->Demandeabsence->exists($id)) :
			throw new NotFoundException(__('Invalid demandeabsence'));
		endif;
		if ($this->request->is(array('post', 'put'))) :
                    if (isset($this->params['data']['cancel'])) :
                        $this->Demandeabsence->validate = array();
                    else:
                    	if ($this->Demandeabsence->save($this->request->data)) {
                            $this->Session->setFlash(__('Demande d\'absences sauvegardée',true),'flash_success');
                        } else {
                            $this->Session->setFlash(__('Demande d\'absences <b>NON</b> sauvegardée',true),'flash_failure');
                        }
                    endif;
                    $this->History->goBack(2);
		endif;
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
		$this->Demandeabsence->id = $id;
		if (!$this->Demandeabsence->exists()) {
			throw new NotFoundException(__('Invalid demandeabsence'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Demandeabsence->delete()) {
			$this->Session->setFlash(__('The demandeabsence has been deleted.'));
		} else {
			$this->Session->setFlash(__('The demandeabsence could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function json_get_info($id){
            $this->autoRender = false;
            $conditions[] = 'Demandeabsence.id='.$id;
            $return = $this->Demandeabsence->find('all',array('conditions'=>$conditions,'recursive'=>-1));
            $result = json_encode($return);
            return $result;
        }  
        
        public function valid(){
            $id = $this->request->data('id');
            $reponse = $this->request->data('etat');
            $this->Demandeabsence->id = $id;
            $record = $this->Demandeabsence->read();
            $today = new DateTime();
            $record['Demandeabsence']['REPONSE']= $reponse;
            $record['Demandeabsence']['DATEREPONSE']= $today->format('Y-m-d H:i:s');
            $record['Demandeabsence']['REPONSEBY']= userAuth('id');
            $record['Demandeabsence']['created']= $record['Demandeabsence']['created'];
            $record['Demandeabsence']['modified']= $today->format('Y-m-d H:i:s');
            if($this->Demandeabsence->save($record)):   
                //mise à jour des activitesreeelles avec demandeabsence_id = $id si reponse = 1 alors demandeabsence_id = null
                if($reponse == 1):
                    $this->requestAction('activitesreelles/setvalid/'.$id);
                endif;
                // dans le cas contraire suppression des activitésreelles
                if($reponse == 3 || $reponse == 2):
                    $sql = 'DELETE FROM activitesreelles WHERE demandeabsence_id = '.$id;
                    $this->Demandeabsence->query($sql);
                endif;
                $this->sendmailreponseabsences($record, $reponse);
                $this->Session->setFlash(__('Réponse de la demande d\'absences sauvegardée',true),'flash_success');
            else :
                $this->Session->setFlash(__('Réponse de la demande d\'absences <b>NON</b> sauvegardée',true),'flash_failure');
            endif;
            exit();
        }
        
        public function insertConges($demandeabsence){
            $id = $demandeabsence['Demandeabsence']['id'];
            $deb = new DateTime(CUSDate($demandeabsence['Demandeabsence']['DATEDU']).' 00:00:00'); 
            $fin = new DateTime(CUSDate($demandeabsence['Demandeabsence']['DATEAU']).' 00:00:00'); 
            $tdeb = $demandeabsence['Demandeabsence']['DATEDUTYPE'];
            $tfin = $demandeabsence['Demandeabsence']['DATEAUTYPE'];
            $event = array();
            $summary = 'C';
            $nb = 1;
            $delais = $this->delais($deb,$fin);
            $types = $this->type($tdeb,$tfin);
            $event = array('DSTART'=>$deb->format('Y-m-d'),'INDISPONIBILITE'=>$summary,'DELAIS'=>$delais,'TYPES'=>$types);            
            for($i=0;$i<$delais;$i++):
                $type = $i==$delais-1 ? $event['TYPES']['end'] : 1;
                if($i==0):
                    $nb = $event['TYPES']['dureestart'];
                    $type = $event['TYPES']['start'];
                else:
                    $nb = $i<$delais ? 1 : $event['TYPES']['dureeend'];
                    $type = $i<$delais ? 1 : $event['TYPES']['end'];
                endif;
                $days = array('1'=>'LU','2'=>'MA','3'=>'ME','4'=>'JE','5'=>'VE','6'=>'SA','7'=>'DI');
                //JLR :: on ne rajoute pas les jours fériés et les week end
                if($deb->format('N')<6 && !isFerie($deb)):
                    $activite_id =$this->requestAction('Activites/getId/'.$event['INDISPONIBILITE']);
                    $allindispos[] = array("id"=>CIntDate(startWeek($deb->format('Y-m-d'))),"DATE"=>startWeek($deb->format('Y-m-d')),'DELAIS'=>$delais,"DATEREEL"=>$deb->format('Y-m-d'),"DAY"=>$days[$deb->format('N')],"TYPE"=>$type,"ACTIVITE"=>$activite_id['Activite']['id'],'utilisateur_id'=>$demandeabsence['Demandeabsence']['utilisateur_id'],'DUREE'=>$nb);
                endif;
                $deb->add(new DateInterval('P1D'));
            endfor;
            debug($allindispos);
            //exit();
            // pour chaque ligne on insert en base à partir de la méthode icsImport de Activitesreelles
            aasort($allindispos, 'id');
            foreach($allindispos as $indispo):
                $this->requestAction('Activitesreelles/addDemandes/'.$indispo['utilisateur_id'].'/'.$indispo['ACTIVITE'].'/'.$indispo['DATE'].'/'.$indispo['DAY'].'/'.$indispo['TYPE'].'/'.$indispo['DUREE'].'/'.$id.'/'.$indispo['DATEREEL']);
            endforeach;
        }
        
        public function delais($debut,$fin){
            $start = explode('-',  $debut->format('Y-m-d'));
            $end = explode('-',$fin->format('Y-m-d'));
            $daystart = $start[0].$start[1].$start[2];
            $dayend = $end[0].$end[1].$end[2];

            switch ($dayend-$daystart){
                case 0:
                    return (int)1;
                    break;
                default:
                    $dstart = new DateTime($debut->format('Y-m-d 00:00:00')); 
                    $dend = new DateTime($fin->format('Y-m-d 24:00:00')); 
                    $diff = $dstart->diff($dend); 
                    return $diff->d;                    
            }            
        }
        
    public function type($tdebut,$tfin){
            $typeStart = $tdebut==8 ? 1 : 0;
            $typeEnd = $tfin==16 ? 1 : 0;
            $dureestart = ($tfin-$tdebut)<8 ? 0.5 : 1;
            $dureeend = ($tfin-$tdebut)<8 ? 0.5 : 1;
           
            return array('start'=>$typeStart,'dureestart'=>$dureestart,'end'=>$typeEnd,'dureeend'=>$dureeend);
    }  
    
        public function sendmaildemandeabsences($demande,$relance=false){
            $heuredeb = $demande['Demandeabsence']['DATEDUTYPE']=='8' ? '08:00' : '13:00'; 
            $heurefin = $demande['Demandeabsence']['DATEAUTYPE']=='16' ? '17:00' : '12:00';
            $valideurs = $this->Demandeabsence->Utilisateur->Equipe->find('all',array('conditions'=>array('Equipe.agent'=>userAuth('id'))));
            $mailto = array();
            foreach($valideurs as $valideur):
                $mailto[]=$valideur['Utilisateur']['MAIL'];
            endforeach;
            $mailto[]=userAuth('MAIL');
            $to=$mailto;
            $from = userAuth('MAIL');
            $objrelance = $relance ? '[RELANCE] ' : '';
            $subrelance = $relance ? '<p style="color:red">Message de relance car la demande ne semble pas être traitée</p>' : '';
            $motif = $demande['Demandeabsence']['MOTIF']!='' ? '<span style="color:blue;">'.$demande['Demandeabsence']['MOTIF'].'</span>' : 'sans motif particulier';       
            $objet = 'SAILL : '.$objrelance.'Demande d\'absences';
            $message = "Demande d'absences de la part de <b>".userAuth('NOMLONG')."</b> pour la période du ".CFRDate($demande['Demandeabsence']['DATEDU']).' à '.$heuredeb.' (inclus) jusqu\'au '.CFRDate($demande['Demandeabsence']['DATEAU']).' à '.$heurefin.' (inclus)'.
                    '<br><br>Motif : '.$motif.
                    '<br><p style="background-color:yellow;color:red;">Cette demande reste en attente de validation de votre part.'.$subrelance.'</p>';
            if($to!=''):
                try{
                $email = new CakeEmail();
                $email->config('smtp')
                        ->emailFormat('html')
                        ->from($from)
                        ->to($to)
                        ->subject($objet)
                        ->send($message);
                $this->sendmailconfirmation($demande, $relance);
                $this->Session->setFlash(__('Mail envoyé à votre (ou vos) valideur(s)',true),'flash_success');
                }
                catch(Exception $e){
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_warning');
                }  
            endif;
        }    
        
        public function sendmailconfirmation($demande,$relance=false){
            $heuredeb = $demande['Demandeabsence']['DATEDUTYPE']=='8' ? '08:00' : '13:00'; 
            $heurefin = $demande['Demandeabsence']['DATEAUTYPE']=='16' ? '17:00' : '12:00';
            $mailto[]=userAuth('MAIL');
            $to=$mailto;
            $from = 'saill.nepasrepondre@sncf.fr';
            $objrelance = $relance ? '[RELANCE] ' : '';
            $subrelance = $relance ? '<p style="color:red">Message de relance car la demande ne semble pas être traitée</p>' : '';
            $motif = $demande['Demandeabsence']['MOTIF']!='' ? '<span style="color:blue;">'.$demande['Demandeabsence']['MOTIF'].'</span>' : 'sans motif particulier';
            $objet = 'SAILL : '.$objrelance.'Confirmation d\'envois de votre demande d\'absences';
            $message = "Votre demande d'absences pour la période du ".CFRDate($demande['Demandeabsence']['DATEDU']).' à '.$heuredeb.' (inclus) jusqu\'au '.CFRDate($demande['Demandeabsence']['DATEAU']).' à '.$heurefin.' (inclus)'.
                    '<br><br>Motif : '.$motif.
                    '<br>a été transmise à votre (ou vos) valideur(s).'.$subrelance;
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
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail de confirmation - '.translateMailException($e->getMessage()),true),'flash_warning');
                }  
            endif;
        }          
       
        public function sendmailrelancedemande($id){
            $this->autoRender = false;
            $conditions[]= 'Demandeabsence.id='.$id;
            $demande = $this->Demandeabsence->find('first',array('conditions'=>$conditions,'recursive'=>0));
            $this->sendmaildemandeabsences($demande,true);
            $this->History->goback(1);
            
        }            
        
        public function sendmailreponseabsences($demande,$etat){
            $reponse = $etat == 1 ? '<b>VALIDEE</b>' : '<b style="color:red;">REFUSEE</b>';
            $heuredeb = $demande['Demandeabsence']['DATEDUTYPE']=='8' ? '08:00' : '13:00'; 
            $heurefin = $demande['Demandeabsence']['DATEAUTYPE']=='16' ? '17:00' : '12:00';
            $demandeur = $this->Demandeabsence->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$demande['Demandeabsence']['utilisateur_id'])));
            $valideurs = $this->Demandeabsence->Utilisateur->Equipe->find('all',array('conditions'=>array('Equipe.agent'=>userAuth('id'))));
            $mailto = array();
            foreach($valideurs as $valideur):
                $mailto[]=$valideur['Utilisateur']['MAIL'];
            endforeach;
            $mailto[]=$demandeur['Utilisateur']['MAIL'];
            $to=$mailto;
            $from = userAuth('MAIL');
            $objet = 'RE : SAILL : Demande d\'absences';
            $message = "Demande d'absences de la part de <b>".$demandeur['Utilisateur']['NOMLONG']."</b> pour la période du ".CFRDate($demande['Demandeabsence']['DATEDU']).' à '.$heuredeb.' (inclus) jusqu\'au '.CFRDate($demande['Demandeabsence']['DATEAU']).' à '.$heurefin.' (inclus)'.
                    '<br><br>Cette demande est : '.$reponse;
            if($to!='' && $etat!=3):
                try{
                $email = new CakeEmail();
                $email->config('smtp')
                        ->emailFormat('html')
                        ->from($from)
                        ->to($to)
                        ->subject($objet)
                        ->send($message);
                $this->Session->setFlash(__('Mail envoyé à tous les valideurs et au demandeur',true),'flash_success');
                }
                catch(Exception $e){
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_warning');
                }  
            endif;
        }           
}
