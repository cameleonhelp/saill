<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Rapports Controller
 *
 * @property Rapport $Rapport
 */
class RapportsController extends AppController {

    public $components = array('History','Common');
    
    public function logistique(){
        $this->set('title_for_layout','Etat de la logistique par sections');
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
            $sections = $this->requestAction('sections/getList');
            $this->set('sections',$sections);                 
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new NotAuthorizedException();
        endif;   
    }
    
    public function etatsaisie(){
        $this->set('title_for_layout','Etat de la saisie des agents');
        if (isAuthorized('activitesreelles', 'rapports')) :
            if ($this->request->is('post')):
                $request = $this->request->data;
                $results = $this->requestAction('activitesreelles/getActivitesReelles/'.$request['Rapport']['mois'].'/'.$request['Rapport']['annee']);  
                $this->set('results',$results);
                $resultvides = $this->requestAction('activitesreelles/saisieVide/'.$request['Rapport']['mois'].'/'.$request['Rapport']['annee']);  
                $this->set('resultvides',$resultvides);                
                $lastMonthDay = endWeek(date('Y-m-t', mktime(0, 0, 0, $request['Rapport']['mois'], '05', $request['Rapport']['annee'])));
                $firstMonthDay = startWeek($request['Rapport']['annee'].'-'.$request['Rapport']['mois'].'-01'); 
                $lastday = date('Y-m-t', mktime(0, 0, 0, $request['Rapport']['mois'], '05', $request['Rapport']['annee']));
                $firstday = date('Y-m-d', mktime(0, 0, 0, $request['Rapport']['mois'], '01', $request['Rapport']['annee']));
                $nbmax = nbopendays($firstMonthDay,$lastMonthDay);
                $nbdayopenforthismonth = nbopendays($firstday,$lastday);
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
            throw new NotAuthorizedException();
        endif; 
    }
      
    public function sendmailsaisie($id){
        $mailto = $this->Rapport->requestAction('utilisateurs/getutilisateurbyid/'.$id);
        $to=$mailto['Utilisateur']['MAIL'];
        $from = userAuth('MAIL');
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
        $this->set('title_for_layout','Facturations des prestataires');
        if (isAuthorized('activitesreelles', 'rapports')) :
            if ($this->request->is('post')):
                /** Calcul du rapport aprés submit **/
                    $societes = $this->request->data['Rapport']['societe'];
                    $start = '01/'.$this->request->data['Rapport']['mois'].'/'.$this->request->data['Rapport']['annee'];
                    $end = @date('t',$start).'/'.$this->request->data['Rapport']['mois'].'/'.$this->request->data['Rapport']['annee'];            
                    $rapportresult = $this->requestAction('facturations/forss2i', array('pass'=>array('societes'=>$societes,'start'=>CUSDate($start),'end'=>CUSDate($end),'indisponibilite'=>$this->request->data['Rapport']['indisponibilite'])));
                    $this->set('results',$rapportresult['result']);
                    $this->set('entrops',$rapportresult['trop']);
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
            $societes = $this->requestAction('societes/get_all_societe_id_name');
            $this->set('societes',$societes);
        else :
            $this->Session->setFlash(__('Action non autorisée, veuillez contacter l\'administrateur.',true),'flash_warning');
            throw new NotAuthorizedException();
        endif;  
    }
}

?>
