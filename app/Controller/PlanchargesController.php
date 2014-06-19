<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('AssoprojetentitesController', 'Controller');
App::uses('ContratsController', 'Controller');
App::uses('DomainesController', 'Controller');
App::uses('UtilisateursController', 'Controller');
App::uses('DetailplanchargesController', 'Controller');
/**
 * Plancharges Controller
 *
 * @property Plancharge $Plancharge
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class PlanchargesController extends AppController {
    /**
     * variables globales utilisées au niveau du controller
     */
    public $components = array('History','Common');
    public $paginate = array(
    'limit' => 25,
    'order' => array('Plancharge.ANNEE' => 'asc','Contrat.NOM' => 'asc'),
    );
        
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Plans de charges" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }              

    /**
     * calcul le périmètre de visibilité de l'utilisateur
     * 
     * @return string
     */
    public function get_visibility(){
        if(userAuth('profil_id')==1):
            return null;
        else:
            $ObjAssoprojetentites = new AssoprojetentitesController();
            return $ObjAssoprojetentites->find_str_id_contrats(userAuth('id'));
        endif;
    }

    /**
     * filtre le périmètre de visibilité 
     * 
     * @param string $visibility
     */
    public function get_restriction($visibility){
        if($visibility == null):

        elseif($visibility!=''):

        endif;
    }

    /**
     * renvois le plan de charge à partir de son identifiant
     * 
     * @param string $id
     * @return array
     */
    public function get_plancharge($id){
        $condition[]="Plancharge.id=".$id;
        return $this->Plancharge->find('first',array('conditions'=>$condition,'recursive'=>0));
    }

    /**
     * filtre le plan de charge par année
     * 
     * @param string $annee
     * @return string
     */
    public function get_plancharge_chrono_filter($annee){
        $result = array();
        switch ($annee){
            case 'tous':
            case null:                        
                $result['condition']="1=1";
                $result['filter'] = "de tous les plans de charge pour toutes les années";
                break;                       
            default:
                $result['condition']="Plancharge.ANNEE = '".$annee."'";
                $result['filter'] = "tous les plans de charge de ".$annee;
                break;                                         
        }  
        return $result;
    }

    /**
     * filtre le plan de charge par contrat
     * 
     * @param string $contrat_id
     * @param string $visibility
     * @return string
     */
    public function get_plancharge_contrat_filter($contrat_id,$visibility){
        $result = array();
        switch ($contrat_id){
            case 'tous':
            case null:
                if($visibility==null):
                    $result['condition']="Plancharge.contrat_id > 1";
                elseif($visibility !=""):
                    $result['condition']="Plancharge.contrat_id IN (".$visibility.')';
                else :
                    $result['condition']="Plancharge.contrat_id > 1";
                endif;
                $result['filter'] = "de tous les contrats";
                break;
            default:
                $result['condition']="Plancharge.contrat_id = ".$contrat_id;
                $ObjContrats = new ContratsController();
                $contrat = $ObjContrats->get_nom($contrat_id);
                $result['filter'] = "du contrat :".$contrat;
                break;                                         
        }  
        return $result; 
    }

    /**
     * filtre les plans de charge par le statut visible
     * 
     * @param string $isvisible
     * @return string
     */
    public function get_plancharge_visible_filter($isvisible){
        $result = array();
        switch ($isvisible){
            case '1':
            case null:
                $result['condition']="Plancharge.VISIBLE=1";
                break;
            default:
                $result['condition']="1=1";
                break;                                         
        }  
        return $result; 
    }

    /**
     * renvois la liste des plans de charges en fonction de la visibilité
     * 
     * @return array
     */
    public function get_list_plancharge_visibility(){
        $visibility = $this->get_visibility();
        if ($visibility!= null) { $condition[] = 'Plancharge.contrat_id IN ('.$visibility.')'; }
        $condition[] = 'Plancharge.VISIBLE=1';
        $order = array('Plancharge.NOM'=>'asc');
        $fields = array('id','NOM');
        return $this->Plancharge->find('list',array('fields'=>$fields,'conditions'=>$condition,'order'=>$order,'recursive'=>-1));
    }

    /**
     * renvois les années des plans de charges existants
     * 
     * @return array
     */
    public function get_plancharge_all_annee(){
        return $this->Plancharge->find('all',array('fields'=>array('Plancharge.ANNEE'),'group'=>'Plancharge.ANNEE','recursive'=>-1));
    }

    /**
     * liste les plans de charges
     * 
     * @param string $annee
     * @param string $contrat_id
     * @param string $isvisible
     * @throws UnauthorizedException
     */
    public function index($annee=null,$contrat_id=null,$isvisible=null) {
        $this->set_title(); 
        if (isAuthorized('plancharges', 'index')) :
            $listcontrat = $this->get_visibility();
            $getchrono = $this->get_plancharge_chrono_filter($annee);
            $getcontrat = $this->get_plancharge_contrat_filter($contrat_id, $listcontrat);
            $getvisible = $this->get_plancharge_visible_filter($isvisible);
            $this->set('fannee',$getchrono['filter']);    
            $this->set('fprojet',$getcontrat['filter']); 
            $newconditions = array($getchrono['condition'],$getcontrat['condition'],$getvisible['condition']);
            $this->paginate = array_merge_recursive($this->paginate,array('conditions'=>$newconditions,'recursive'=>0));                   
            $this->set('plancharges', $this->paginate());
            $ObjContrats = new ContratsController();
            $contrats = $ObjContrats->get_all_no_absence();
            $addcontrats = $ObjContrats->get_list_no_absence();
            $annees = $this->get_plancharge_all_annee();
            $this->set(compact('annees','contrats','addcontrats'));             
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");            
        endif;                  
    }

    /**
     * ajoute un nouveau plan de charge
     * 
     * @throws UnauthorizedException
     */
    public function addnewpc() {
        $this->set_title();
        if (isAuthorized('plancharges', 'add')) :
            if ($this->request->is('post')) :
                if (isset($this->params['data']['cancel'])) :
                    $this->Plancharge->validate = array();
                    $this->History->goBack(1);
                else:    
                    $ObjAssoprojetentites = new AssoprojetentitesController();
                    $this->request->data['Plancharge']['entite_id'] = $ObjAssoprojetentites->find_first_entite_for_contrat($this->request->data['Plancharge']['contrat_id']);
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
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");            
        endif;                  
    }

    /**
     * met à jour le plan de charge (partie description "enveloppe")
     * 
     * @param string $id
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function edit($id = null) {
        $this->set_title();
        if (isAuthorized('plancharges', 'edit')) :
            $id = $id==null ? $this->request->data['Plancharge']['id'] : $id;
            if (!$this->Plancharge->exists($id)) {
                    throw new NotFoundException(__('Plan de charge incorrect'));
            }
            $options = array('conditions' => array('Plancharge.' . $this->Plancharge->primaryKey => $id));
            $thisplancharge = $this->Plancharge->find('first', $options);
            if ($this->request->is('post') || $this->request->is('put')) {
                if (isset($this->params['data']['cancel'])) :
                    $this->Plancharge->validate = array();
                    $this->History->goBack(2);
                else:                     
                    $this->request->data['Plancharge']['ETP']=$thisplancharge['Plancharge']['ETP'];
                    $this->request->data['Plancharge']['CHARGES']=$thisplancharge['Plancharge']['CHARGES'];
                    unset($this->request->data['Plancharge']['id']);
                    $this->Plancharge->create();
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
                            $this->History->goBack(2);
                    } else {
                            $this->Session->setFlash(__('Plan de charge incorrect, veuillez corriger le plan de charge',true),'flash_failure');
                    }
                endif;
            } else {
                    $this->request->data = $thisplancharge;
            }
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");            
        endif;                  
    }

    /**
     * supprime le plan de charge
     * 
     * @param string $id
     * @throws NotFoundException
     */
    public function delete($id = null) {
            $this->set_title();              
            $this->Plancharge->id = $id;
            if (!$this->Plancharge->exists()) {
                    throw new NotFoundException(__('Plan de charge incorrect'));
            }
            if ($this->Plancharge->delete()) {
                $conditions = array('plancharge_id'=>$id);
                $ObjDetailPlanCharge = new DetailplanchargesController();
                $ObjDetailPlanCharge->deleteAll($conditions);
                $this->Session->setFlash(__('Plan de charge supprimé',true),'flash_success');
                $this->History->goBack(1);
            }
            $this->Session->setFlash(__('Plan de charge <b>NON</b> supprimé',true),'flash_failure');
            $this->History->goBack(1);
    }

    /**
     * export en Excel
     * 
     * @param string $id
     */
    public function export_xls($id=null) {
            /** export au format excel du détail du plan de charge **/
            $data = $this->Plancharge->Detailplancharge->find('all',array('conditions'=>array('Detailplancharge.plancharge_id'=>$id),'recursive'=>0));
            $this->set('rows',$data);
            $this->render('export_xls','export_xls');
    }     

    /**
     * rapport sur les plans de charges
     * 
     * @throws UnauthorizedException
     */
    public function rapport() {
        $this->set_title('Rapport des plans de charges');
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
            $plancharges = $this->get_list_plancharge_visibility();
            $ObjDomaines = new DomainesController();
            $domaines = $ObjDomaines->get_list();
            $this->set(compact('domaines','plancharges'));                
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;               
    }    

    /**
     * rapport sur la répartition prévue pour un agent
     * 
     * @throws UnauthorizedException
     */
    public function rapportagent() {
        $this->set_title('Rapport du plan de charges pour un agent');
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
            $ObjUtilisateurs = new UtilisateursController();
            $utilisateurs = $ObjUtilisateurs->find_list_cercle_utilisateur(null,0,1);
            $this->set('utilisateurs',$utilisateurs);  
            $annees = $this->Plancharge->find('all',array('fields'=>array('Plancharge.ANNEE'),'conditions'=>array('Plancharge.VISIBLE'=>1),'group'=>'Plancharge.ANNEE','recursive'=>-1));
            foreach($annees as $annee):
                $val = $annee['Plancharge']['ANNEE'];
                $years[$val]=$val;
            endforeach;
            $this->set('annees',$years);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;               
    }         

    /**
     * export au format word
     */
    public function export_doc() {
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

    /**
     * mise à jour du staut visible d'un plan de charge
     * 
     * @param type $id
     */
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

    /**
     * envois par mail la prévision de charge à un agent
     */
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
        $from = Configure::read('mailapp');
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
                $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_warning');
            }  
        endif;
        $this->History->goBack(1);
    } 

    /**
     * permet d'autoriser l'utilisation de méthode sans authentification
     */
    public function beforeFilter() {   
        $this->Auth->allow(array('json_get_info','ajax_update'));
        parent::beforeFilter();
    }  

    /**
     * renvois les information du plan de charge
     * 
     * @param string $id
     * @return json
     */
    public function json_get_info($id){
        $this->autoRender = false;
        $conditions[] = 'Plancharge.id='.$id;
        $return = $this->Plancharge->find('all',array('conditions'=>$conditions,'recursive'=>-1));
        $result = json_encode($return);
        return $result;
    }        

    /**
     * mise à jour à partir du tableau de valeur (x-editable)
     * 
     * @return boolean
     */
    public function ajax_update(){
        $this->autoRender = false;
        $this->Plancharge->id = $_POST['pk'];
        $this->Plancharge->saveField( $_POST['name'], trim($_POST['value']));
        return true;
    }
}
