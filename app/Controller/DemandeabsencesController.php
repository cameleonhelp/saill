<?php
App::uses('AppController', 'Controller');
App::uses('Vendor', 'ical', array('file'=>'class.iCalReader.php'));
App::uses('CakeEmail', 'Network/Email');
App::import('Controller', 'Equipes');
App::import('Controller', 'Activitesreelles');
App::import('Controller', 'Activites');
/**
 * Demandeabsences Controller
 *
 * @property Demandeabsence $Demandeabsence
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class DemandeabsencesController extends AppController {

    /**
     * varaibles utilisées au niveau du controller
     */
    public $paginate = array(
    'limit' => 25,
    'order' => array('Demandeabsence.DATEDU' => 'asc','Demandeabsence.DATEAU'=>'asc'),
    );
    public $components = array('History','Common');

    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Demandes d'absences" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }              

    /**
     * permet d'autoriser l'utilisation de certaines méthodes sans authentification
     */
    public function beforeFilter() {   
        $this->Auth->allow(array('json_get_info','valid'));
        parent::beforeFilter();
    }  

    /**
     * fixe le filtre sur le demandeur
     * 
     * @param int $id de l'utilisateur
     * @return string
     */
    public function get_demandeur_filter($id){
        $result = array();
        $ObjEquipes = new EquipesController();
        switch($id):
            case null:
            case 'tous':
                $monequipe = $ObjEquipes->myTeam(userAuth('id')).userAuth('id');
                $result['condition'] = 'Utilisateur.id IN ('.$monequipe.')';
                $result['filter'] = ', pour toute mon équipe';
                break;
            default:
                $result['condition']="Demandeabsence.utilisateur_id=".$id;
                $nom = $this->Demandeabsence->Utilisateur->findById($id);
                $result['filter'] = ', pour '.$nom['Utilisateur']['NOMLONG'];
                break;
        endswitch;
        return $result;
    }

    /**
     * filtre en fonction de la réponse
     * 
     * @param string $id
     * @return string
     */
    public function get_reponse_filter($id){
        $result = array();
        switch($id):
            case null:
            case '0':
                $result['condition']="Demandeabsence.REPONSE IS NULL";
                $result['filter'] = ', en attente';
                break;                        
            case 'tous':
                $result['condition']="1=1";
                $result['filter'] = '';
                break;  
            case '1':
                $result['condition']="Demandeabsence.REPONSE='1'";
                $result['filter'] = ', validées';
                break;                    
            case '2':
                $result['condition']="Demandeabsence.REPONSE='2'";
                $result['filter'] = ', refusées';
                break;  
            case '3':
                $result['condition']="Demandeabsence.REPONSE='3'";
                $result['filter'] = ', supprimées';
                break;                     
        endswitch; 
        return $result;
    }

    /**
     * filtre chronologique
     * 
     * @param int $date
     * @return string
     */
    public function get_date_filter($date){
        $result = array();
        switch($date):
            case null:
            case '2':
                $today = new DateTime();
                $result['condition']="Demandeabsence.DATEDU >= '".$today->format('Y-m-d')."'";
                $result['filter'] = ', après aujourd\'hui (inclus)';
                break;                          
            case 'tous':
                $result['condition']="1=1";
                $result['filter'] = '';
                break; 
            case '1':
                $today = new DateTime();
                $result['condition']="Demandeabsence.DATEDU < '".$today->format('Y-m-d')."'";
                $result['filter'] = ', avant aujourd\'hui';
                break;                                        
        endswitch; 
        return $result;
    }

    /**
     * liste les demandes d'absences
     * 
     * @param string $filtreDemandeur
     * @param string $filtreReponse
     * @param string $filtreDate
     * @throws UnauthorizedException
     */
    public function index($filtreDemandeur=null,$filtreReponse=null,$filtreDate=null) {  
        $this->set_title('Suivi des absences');
        if (isAuthorized('demandeabsences', 'index')) :
            $getdemandeur = $this->get_demandeur_filter($filtreDemandeur);
            $getreponse = $this->get_reponse_filter($filtreReponse);
            $getdate = $this->get_date_filter($filtreDate);
            $newconditions = array($getdemandeur['condition'],$getreponse['condition'],$getdate['condition']);
            $strfilter = $getdemandeur['filter'].$getreponse['filter'].$getdate['filter'];
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions));
            $this->Demandeabsence->recursive = 0;
            $this->set('demandeabsences', $this->paginate());
            $ObjEquipes = new EquipesController();
            $demandeurs = $ObjEquipes->listMyTeam(userAuth('id'));
            $utilisateurs = $ObjEquipes->getMyTeam(userAuth('id'));
            $this->set(compact('demandeurs','strfilter','utilisateurs'));  
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");                
        endif;
    }

    /**
     * Ajoute une demande d'absnece
     * 
     * @throws UnauthorizedException
     */
    public function add() {
        $this->autoRender  =false;
        if (isAuthorized('demandeabsences', 'add')) : 
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Demandeabsence->validate = array();
                else:          
                    $today = new DateTime();
                    $this->request->data['Demandeabsence']['DATEDEMANDE'] = $today->format('y-m-d H:i:s');              
                    if($this->request->data['Demandeabsence']['REPEAT']=='1'):
                        $datefin = CUSDate($this->request->data['Demandeabsence']['DATEFIN']);
                        $datedu = CUSDate($this->request->data['Demandeabsence']['DATEDU']);
                        $dateau = CUSDate($this->request->data['Demandeabsence']['DATEAU']);  
                        $datefin = new Datetime($datefin);
                        $datedu = new Datetime($datedu);
                        $dateau = new Datetime($dateau);
                        $newrecord[] = $this->request->data;
                        $i = 1;
                        while($datefin->diff($dateau)->format('%d')>6):
                            $newrecord[$i]['Demandeabsence']['utilisateur_id']=$newrecord[0]['Demandeabsence']['utilisateur_id'];
                            $datedu->add(new DateInterval('P7D'));
                            $newrecord[$i]['Demandeabsence']['DATEDU'] = $datedu->format("d/m/Y");                            
                            $newrecord[$i]['Demandeabsence']['DATEDUTYPE']=$newrecord[0]['Demandeabsence']['DATEDUTYPE'];
                            $dateau->add(new DateInterval('P7D'));
                            $newrecord[$i]['Demandeabsence']['DATEAU'] = $dateau->format("d/m/Y");                                
                            $newrecord[$i]['Demandeabsence']['DATEAUTYPE']=$newrecord[0]['Demandeabsence']['DATEAUTYPE'];
                            $newrecord[$i]['Demandeabsence']['REPEAT']=$newrecord[0]['Demandeabsence']['REPEAT'];
                            $newrecord[$i]['Demandeabsence']['DATEFIN']=$newrecord[0]['Demandeabsence']['DATEFIN'];
                            $newrecord[$i]['Demandeabsence']['MOTIF']=$newrecord[0]['Demandeabsence']['MOTIF'];
                            $newrecord[$i]['Demandeabsence']['DATEDEMANDE']=$newrecord[0]['Demandeabsence']['DATEDEMANDE'];
                            $i++;
                        endwhile;
                        foreach($newrecord as $record):
                            $this->Demandeabsence->create(); 
                            if ($this->Demandeabsence->save($record)) :
                                $this->insertConges($record);
                                $result[] = true;
                            else:
                                $result[] = false;
                            endif;                            
                        endforeach;
                        if(in_array(false,$result)):
                            $this->Session->setFlash(__('Au moins une demande d\'absences <b>N\'EST PAS</b> sauvegardée',true),'flash_failure');
                        else:
                            $nb = $i == 1 ? $i : $i + 1;
                            $this->Session->setFlash(__($nb.' demandes d\'absences sauvegardées',true),'flash_success');
                        endif;
                    else:
                        $this->Demandeabsence->create(); 
                        if ($this->Demandeabsence->save($this->request->data)) {
                            $options = array('conditions' => array('Demandeabsence.' . $this->Demandeabsence->primaryKey => $this->Demandeabsence->getLastInsertID()));
                            $demandeabsence =  $this->Demandeabsence->find('first', $options);                               
                            $this->insertConges($demandeabsence);
                            $this->sendmaildemandeabsences($demandeabsence);
                            $this->Session->setFlash(__('Demande d\'absences sauvegardée',true),'flash_success');
                        } else {
                            $this->Session->setFlash(__('Demande d\'absences <b>NON</b> sauvegardée',true),'flash_failure');
                        }
                    endif;
                endif;
                $this->History->goFirst();
            endif;
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");           
        endif;                    
    }

    /**
     * suppression des demandes d'absence
     * 
     * @param int $id
     * @return void
     * @throws NotFoundException
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

    /**
     * retourne des informations sur la demande d'absence
     * 
     * @param inr $id
     * @return Demandeabsence
     */
    public function json_get_info($id){
        $this->autoRender = false;
        $conditions[] = 'Demandeabsence.id='.$id;
        $return = $this->Demandeabsence->find('all',array('conditions'=>$conditions,'recursive'=>-1));
        $result = json_encode($return);
        return $result;
    }  

    /**
     * valide la demande d'absence
     */
    public function valid(){
        $id = $this->request->data('id');
        $reponse = $this->request->data('etat');
        $this->Demandeabsence->id = $id;
        $record = $this->Demandeabsence->read();
        if($this->Demandeabsence->exists()):
            $today = new DateTime();
            $record['Demandeabsence']['REPONSE']= $reponse;
            $record['Demandeabsence']['DATEREPONSE']= $today->format('Y-m-d H:i:s');
            $record['Demandeabsence']['REPONSEBY']= userAuth('id');
            $record['Demandeabsence']['created']= isset($record['Demandeabsence']['created']) ? $record['Demandeabsence']['created']:$today->format('Y-m-d H:i:s');
            $record['Demandeabsence']['modified']= $today->format('Y-m-d H:i:s');
            if($this->Demandeabsence->save($record)):  
                $ObjActivitesreelles = new ActivitesreellesController();
                if($reponse == 1):
                    $obj = $ObjActivitesreelles->findByDemandeabsenceId($id);
                    if(count($obj) > 0) :                    
                        $ObjActivitesreelles->setvalid($id);
                    endif;
                else:
                    $obj = $ObjActivitesreelles->findByDemandeabsenceId($id);
                    if(count($obj) > 0) :
                        $sql = 'DELETE FROM activitesreelles WHERE demandeabsence_id = '.$id;
                        $this->Demandeabsence->query($sql);
                    endif;
                endif;
                $this->sendmailreponseabsences($record, $reponse);
                $this->Session->setFlash(__('Réponse de la demande d\'absences sauvegardée',true),'flash_success');
            else :
                $this->Session->setFlash(__('Réponse de la demande d\'absences <b>NON</b> sauvegardée',true),'flash_failure');
            endif;
        endif;
        exit();
    }

    /**
     * crée une feuille de temps pour une demande et par jour
     * 
     * @param Demandeabsence $demandeabsence
     */
    public function insertConges($demandeabsence){
        if($demandeabsence != null && isset($demandeabsence['Demandeabsence']['id'])):
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
                elseif($i==$delais-1):
                    $nb = $event['TYPES']['dureeend'];
                    $type = $event['TYPES']['end'];  
                else:
                    $nb = $i<$delais ? 1 : $event['TYPES']['dureeend'];
                    $type = $i<$delais ? 1 : $event['TYPES']['end'];
                endif;
                $days = array('1'=>'LU','2'=>'MA','3'=>'ME','4'=>'JE','5'=>'VE','6'=>'SA','7'=>'DI');
                //JLR :: on ne rajoute pas les jours fériés et les week end
                if($deb->format('N')<6 && !isFerie($deb)):
                    $ObjActivites = new ActivitesController();	
                    $activite_id = $ObjActivites->getId($event['INDISPONIBILITE']);
                    $allindispos[] = array("id"=>CIntDate(startWeek($deb->format('Y-m-d'))),"DATE"=>startWeek($deb->format('Y-m-d')),'DELAIS'=>$delais,"DATEREEL"=>$deb->format('Y-m-d'),"DAY"=>$days[$deb->format('N')],"TYPE"=>$type,"ACTIVITE"=>$activite_id['Activite']['id'],'utilisateur_id'=>$demandeabsence['Demandeabsence']['utilisateur_id'],'DUREE'=>$nb);
                endif;
                $deb->add(new DateInterval('P1D'));
            endfor;
            aasort($allindispos, 'id');
            if (isset($allindispos)):
                foreach($allindispos as $indispo):
                    $ObjActivitesreelles = new ActivitesreellesController();
                    $ObjActivitesreelles->addDemandes($indispo['utilisateur_id'],$indispo['ACTIVITE'],$indispo['DATE'],$indispo['DAY'],$indispo['TYPE'],$indispo['DUREE'],$id,$indispo['DATEREEL']);
                endforeach;
            endif;
        endif;
    }

    /**
     * calcul le délais entre deux dates
     * 
     * @param date $debut
     * @param date $fin
     * @return int
     */
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

    /**
     * retourne un tableau des différents jours demandés
     * 
     * @param date $tdebut
     * @param date $tfin
     * @return array
     */
    public function type($tdebut,$tfin){
            $typeStart = $tdebut==8 ? 1 : 0;
            $typeEnd = $tfin==16 || ($tdebut ==12  && $tfin==12)  ? 1 : 0;
            $dureestart = ($tfin-$tdebut)<8 ? 0.5 : 1;
            $dureeend = ($tfin-$tdebut)<8 ? 0.5 : 1;
            return array('start'=>$typeStart,'dureestart'=>$dureestart,'end'=>$typeEnd,'dureeend'=>$dureeend);
    }  

    /**
     * envois de mail lors d'une demande
     * 
     * @param Demandeabsence $demande
     * @param boolean $relance
     */
    public function sendmaildemandeabsences($demande,$relance=false){
        $heuredeb = $demande['Demandeabsence']['DATEDUTYPE']=='8' ? '08:00' : '13:00'; 
        $heurefin = $demande['Demandeabsence']['DATEAUTYPE']=='16' ? '17:00' : '12:00';
        $valideurs = $this->Demandeabsence->Utilisateur->Equipe->find('all',array('conditions'=>array('Equipe.agent'=>userAuth('id'))));
        $mailto = array();
        foreach($valideurs as $valideur):
            $mailto[]=$valideur['Valideur']['utilisateurs']['MAIL'];
        endforeach;
        //$mailto[]=userAuth('MAIL');   plus besoin il y a la confirmation     
        $to=$mailto;
        $from = Configure::read('mailapp');
        $objrelance = $relance ? '[RELANCE] ' : '';
        $subrelance = $relance ? '<p style="color:red">Message de relance car la demande ne semble pas être traitée</p>' : '';
        $motif = $demande['Demandeabsence']['MOTIF']!='' ? '<span style="color:blue;">'.$demande['Demandeabsence']['MOTIF'].'</span>' : 'sans motif particulier';       
        $objet = 'SAILL : '.$objrelance.'Demande d\'absences pour '.userAuth('NOMLONG');
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

    /**
     * envois de mail de confirmation d'envois de la demande
     * 
     * @param Demandeabsence $demande
     * @param boolean $relance
     */
    public function sendmailconfirmation($demande,$relance=false){
        $heuredeb = $demande['Demandeabsence']['DATEDUTYPE']=='8' ? '08:00' : '13:00'; 
        $heurefin = $demande['Demandeabsence']['DATEAUTYPE']=='16' ? '17:00' : '12:00';
        $mailto[]=userAuth('MAIL');
        $to=$mailto;
        $from = Configure::read('mailapp');
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

    /**
     * envois de la relance d'une demande par mail (Ajax)
     * 
     * @param int $id de la dmande
     */
    public function sendmailrelancedemande($id){
        $this->autoRender = false;
        $conditions[]= 'Demandeabsence.id='.$id;
        $demande = $this->Demandeabsence->find('first',array('conditions'=>$conditions,'recursive'=>0));
        $this->sendmaildemandeabsences($demande,true);
        $this->History->goback(1);

    }            

    /**
     * envois la reponse à une demande
     * 
     * @param Demandeabsence $demande
     * @param int $etat
     */
    public function sendmailreponseabsences($demande,$etat){
        $reponse = $etat == 1 ? '<b>VALIDEE</b>' : '<b style="color:red;">REFUSEE</b>';
        $heuredeb = $demande['Demandeabsence']['DATEDUTYPE']=='8' ? '08:00' : '13:00'; 
        $heurefin = $demande['Demandeabsence']['DATEAUTYPE']=='16' ? '17:00' : '12:00';
        $demandeur = $this->Demandeabsence->Utilisateur->find('first',array('conditions'=>array('Utilisateur.id'=>$demande['Demandeabsence']['utilisateur_id'])));
        $valideurs = $this->Demandeabsence->Utilisateur->Equipe->find('all',array('conditions'=>array('Equipe.agent'=>userAuth('id'))));
        $mailto = array();
        foreach($valideurs as $valideur):
            if(isset($valideur['Utilisateur']['MAIL'])):
                $mailto[]=$valideur['Utilisateur']['MAIL'];
            endif;
        endforeach;
        $mailto[]=$demandeur['Utilisateur']['MAIL'];
        $to=$mailto;
        $from = Configure::read('mailapp');
        $objet = 'RE : SAILL : Demande d\'absences pour '.$demandeur['Utilisateur']['NOMLONG'];
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
