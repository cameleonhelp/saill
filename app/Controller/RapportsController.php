<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('AssoentiteutilisateursController', 'Controller');
App::uses('SectionsController', 'Controller');
App::uses('ActivitesreellesController', 'Controller');
App::uses('UtilisateursController', 'Controller');
App::uses('FacturationsController', 'Controller');
App::uses('SocietesController', 'Controller');
/**
 * Rapports Controller
 *
 * @property Rapport $Rapport
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class RapportsController extends AppController {

    public $components = array('History','Common');
    
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Rapport" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }          
    
    public function logistique(){
        $this->set_title('Etat de la logistique par sections');
        if (isAuthorized('actions', 'rapports')) :
            if ($this->request->is('post')):
                $section = $this->request->data;
                $sqlAgent = "SELECT COUNT(utilisateurs.id) AS NBAGENT, sections.NOM, sites.NOM
                            FROM utilisateurs 
                            LEFT JOIN  sections ON sections.id = utilisateurs.section_id
                            LEFT JOIN  sites ON sites.id = utilisateurs.site_id
                            WHERE ACTIF = 1
                            AND sections.NOM IS NOT NULL
                            AND utilisateurs.section_id = ".$section['Rapport']['section_id']."
                            GROUP BY site_id;";
                $sqlMateriel = "SELECT COUNT(materielinformatiques.id) AS NBPC, sections.NOM,ETAT,typemateriels.`NOM`
                                FROM materielinformatiques 
                                LEFT JOIN  sections ON sections.id = materielinformatiques.section_id
                                LEFT JOIN  typemateriels ON typemateriels.id = materielinformatiques.typemateriel_id
                                WHERE sections.NOM IS NOT NULL
                                AND materielinformatiques.section_id = ".$section['Rapport']['section_id']."
                                GROUP BY typemateriel_id,ETAT;";
                $agents = $this->Rapport->query($sqlAgent);
                $this->set('agents',$agents);  
                $materiels = $this->Rapport->query($sqlMateriel);
                $this->set('materiels',$materiels);                 
            endif;
            $ObjAssoentiteutilisateurs = new AssoentiteutilisateursController();
            $visibility = $ObjAssoentiteutilisateurs->find_all_section(userAuth('id'));
            $ObjSections = new SectionsController();	
            $sections = $ObjSections->get_list($visibility);
            $this->set('sections',$sections);                 
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;   
    }
    
    public function etatsaisie(){
        $this->set_title('Etat de la saisie des agents');
        if (isAuthorized('activitesreelles', 'rapports')) :
            $ObjActivitereelles = new ActivitesreellesController();	
            if ($this->request->is('post')):
                $request = $this->request->data;
                $results = $ObjActivitereelles->getActivitesReelles($request['Rapport']['mois'],$request['Rapport']['annee']);  
                $this->set('results',$results);
                $resultvides = $ObjActivitereelles->saisieVide($request['Rapport']['mois'],$request['Rapport']['annee']);  
                $this->set('resultvides',$resultvides);                
                $lastMonthDay = endWeek(date('Y-m-t', mktime(0, 0, 0, $request['Rapport']['mois'], '05', $request['Rapport']['annee'])));
                $firstMonthDay = startWeek($request['Rapport']['annee'].'-'.$request['Rapport']['mois'].'-01'); 
                $lastday = date('Y-m-t', mktime(0, 0, 0, $request['Rapport']['mois'], '05', $request['Rapport']['annee']));
                $firstday = startWeek(date('Y-m-d', mktime(0, 0, 0, $request['Rapport']['mois'], '01', $request['Rapport']['annee'])));
                $lastweek = endWeek($lastday);
                $nbmax = date("t",mktime(0, 0, 0, $request['Rapport']['mois'], '01', $request['Rapport']['annee']));//nbopendays($firstMonthDay,$lastMonthDay);
                $nbdayopenforthismonth = nbopendays($firstday,$lastweek);
                $this->set(compact('firstday','lastweek'));
                $this->set('nbmaxopen',$nbmax);
                $this->set('nbopenday',$nbdayopenforthismonth);
            endif;
            $mois = array('01'=>'Janvier','02'=>'Février','03'=>'Mars','04'=>'Avril','05'=>'Mai','06'=>'Juin','07'=>'Juillet','08'=>'Août','09'=>'Septembre','10'=>'Octobre','11'=>'Novembre','12'=>'Décembre');
            $this->set('mois',$mois);
            $fiveyearago = date('Y')-5;
            for($i=0;$i<6;$i++):
                $year = $fiveyearago + $i;
                $annee[$year]=$year;
            endfor;
            $this->set('annee',$annee);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif; 
    }
      
    public function sendmailsaisie($id){
        $ObjUtilisateurs = new UtilisateursController();
        $mailto = $ObjUtilisateurs->getutilisateurbyid($id);
        $to=$mailto['Utilisateur']['MAIL'];
        $from = Configure::read('mailapp');
        $objet = 'SAILL : Saisie d\'activité incomplète ou non validée.';
        $message = "Bonjour<br><br>merci de compléter ou de valider votre saisie d'activité du mois dans SAILL.";
        if($to!=''):
            try{
            $email = new CakeEmail();
            $email->config('smtp')
                    ->emailFormat('html')
                    ->from($from)
                    ->to($to)
                    ->subject($objet)
                    ->send($message);
            $this->Session->setFlash(__('Un mail est envoyé à '.$mailto['Utilisateur']['NOMLONG'],true),'flash_success');
            }

            catch(Exception $e){
                $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_warning');
            }  
        endif;
        $this->History->goBack(1);
    }     
    
    public function ss2i(){
        $this->set_title('Facturations des prestataires');
        if (isAuthorized('activitesreelles', 'rapports')) :
            if ($this->request->is('post')):
                /** Calcul du rapport aprés submit **/
                    $societes = $this->request->data['Rapport']['societe'];
                    $start = '01/'.$this->request->data['Rapport']['mois'].'/'.$this->request->data['Rapport']['annee'];
                    $end = @date('t',$start).'/'.$this->request->data['Rapport']['mois'].'/'.$this->request->data['Rapport']['annee']; 
                    $ObjFacturations = new FacturationsController();
                    $rapportresult = $ObjFacturations->forss2i(array('societes'=>$societes,'start'=>CUSDate($start),'end'=>CUSDate($end),'indisponibilite'=>$this->request->data['Rapport']['indisponibilite'],'mois'=>$this->request->data['Rapport']['mois']));
                    $this->set('results',$rapportresult['result']);
                    $this->set('entrops',$rapportresult['trop']);
                    $this->Session->delete('xls_export');
                    $this->Session->write('xls_export',$rapportresult); 
            endif;
            /** Au chargement de la page **/
            $mois = array('01'=>'Janvier','02'=>'Février','03'=>'Mars','04'=>'Avril','05'=>'Mai','06'=>'Juin','07'=>'Juillet','08'=>'Août','09'=>'Septembre','10'=>'Octobre','11'=>'Novembre','12'=>'Décembre');
            $this->set('mois',$mois);
            $fiveyearago = date('Y')-5;
            for($i=0;$i<6;$i++):
                $year = $fiveyearago + $i;
                $annee[$year]=$year;
            endfor;
            $this->set('annee',$annee);
            $ObjSocietes = new SocietesController();
            $societes = $ObjSocietes->get_all_societe_id_name();
            $this->set('societes',$societes);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;  
    }
    
    public function factscnf(){
        $this->set_title('Facturations des agents SNCF');
        if (isAuthorized('activitesreelles', 'rapports')) :
            if ($this->request->is('post')):
                $societes = array('1');
                $start = $this->request->data['Rapport']['DU'];
                $end = $this->request->data['Rapport']['AU']; 
                $ObjFacturations = new FacturationsController();
                $rapportresult = $ObjFacturations->forsncf(array('societes'=>$societes,'start'=>CUSDate($start),'end'=>CUSDate($end),'indisponibilite'=>$this->request->data['Rapport']['indisponibilite']));
                $this->set('results',$rapportresult['result']);
                $this->set('entrops',$rapportresult['trop']);
                $this->Session->delete('xls_export');
                $this->Session->write('xls_export',$rapportresult);                     
            endif;
            /** Au chargement de la page **/
            $mois = array('01'=>'Janvier','02'=>'Février','03'=>'Mars','04'=>'Avril','05'=>'Mai','06'=>'Juin','07'=>'Juillet','08'=>'Août','09'=>'Septembre','10'=>'Octobre','11'=>'Novembre','12'=>'Décembre');
            $this->set('mois',$mois);
            $fiveyearago = date('Y')-5;
            for($i=0;$i<6;$i++):
                $year = $fiveyearago + $i;
                $annee[$year]=$year;
            endfor;
            $this->set('annee',$annee);            
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new UnauthorizedException("Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil");
        endif;  
    }
    
    public function xls_sncf(){
            $data = $this->Session->read('xls_export');
            //$this->Session->delete('xls_export');                
            $this->set('rows',$data);
            $this->render('export_sncf','export_xls');
    }
    
    public function xls_ss2i(){
            $data = $this->Session->read('xls_export');
            //$this->Session->delete('xls_export');                
            $this->set('rows',$data);
            $this->render('export_ss2i','export_xls');
    }    
}

?>
