<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('ActionsController', 'Controller');
App::uses('UtilisateursController', 'Controller');
App::uses('ActivitesreellesController', 'Controller');
/**
 * Webservices Controller
 *
 * @property Webservice $Webservice
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class WebservicesController extends AppController {
    public $components = array('History','Common');  
    
    public $cr = "<br>";
    
    public $header = "<span style='color:red;'>MERCI DE NE PAS REPONDRE A CE MAIL.</span><br>";
    
    public $signature = "<br>Cordialement,<br><span style='color:red;'>MERCI DE NE PAS REPONDRE A CE MAIL.</span><br>Mail envoyé automatiquement depuis SAILL";
    
    public function beforeFilter() {   
        $this->Auth->allow(array('notify_actions_echues','notify_actions_a_venir','close_for_maintenance','notifysaisie','notifyrappelsaisie','closeaction','open_after_maintenance','clean_calendars'));
        parent::beforeFilter();
    }       

    /**
     * Méthode renvoyant les mails aux personnes dont les actions dont l'échéance est dans $delais jours ou moins
     * Fréquence d'utilisation : tous les jours
     * Répétition : 1 fois
     * 
     * @param int $delais : default 0
     * @return boolean
     */
    public function notify_actions_echues($delais=0) {
        $this->autoRender = false;
        $Actions = new ActionsController();     
        $today = new DateTime();
        $interval = new DateInterval('P'.$delais.'D');
        $lastday = $today->add($interval);
        $all_users_actions = $Actions->get_id_nomlg_users_actions_before($lastday->format('Y-m-d'));
        foreach ($all_users_actions as $obj):
            //TODO : ajouter le champs CONTRIBUTEURS et sfaire une boucle pour envoyer un mail aux contributeurs
            $actions = $Actions->get_all_actions_before_for_user($lastday->format('Y-m-d'),$obj['Action']['destinataire']);
            if(count($actions) > 0):
                $mail = $this->rappelActionsEchues($obj['Destinataire']['NOMLONG'], $actions);
                $libelle = count($actions) > 1 ? " actions devraient" :" action devrait";            
                $objet = "RAPPEL : ".count($actions).$libelle." être terminée depuis au moins ".$delais." jours";
                $priorite = "haute";
                $this->sendmailhtml($obj['Destinataire']['MAIL'], $objet, $mail, $priorite);
            endif;
        endforeach;
        return json_encode($all_users_actions); //json_encode(true);
    }
    
    /**
     * Méthode renvoyant les mails aux personnes dont les actions dont l'échéance est dans $delais jours ou moins
     * Fréquence d'utilisation : tous les jours
     * Répétition : 1 fois
     * 
     * @param int $delais : default 0
     * @return json
     */
    public function notify_actions_a_venir($delais=0) {
        $this->autoRender = false;
        $Actions = new ActionsController();     
        $today = new DateTime();
        $now = $today->format('Y-m-d');
        $interval = new DateInterval('P'.$delais.'D');
        $lastday = $today->add($interval);
        $all_users_actions = $Actions->get_id_nomlg_users_actions_between($now,$lastday->format('Y-m-d'));
        foreach ($all_users_actions as $obj):
            //TODO : ajouter le champs CONTRIBUTEURS et faire une boucle pour envoyer un mail aux contributeurs
            $actions = $Actions->get_all_actions_between_for_user($now,$lastday->format('Y-m-d'),$obj['Action']['destinataire']);
            if(count($actions) > 0):
                $mail = $this->rappelActionsAVenir($obj['Destinataire']['NOMLONG'], $actions);
                $libelle = count($actions) > 1 ? " actions devraient" :" action devrait";            
                $objet = "RAPPEL : ".count($actions).$libelle." être terminée dans les ".$delais." jours à venir";
                $priorite = "haute";
                $this->sendmailhtml($obj['Destinataire']['MAIL'], $objet, $mail, $priorite);
            endif;
        endforeach;
        return json_encode($all_users_actions); //json_encode(true);
    }
    
    /**
     * Méthode permettant de mettre le statut des actions avec un avancement de 100% à terminée
     * Fréquence d'utilisation : tous les 7 jours
     * Répétition : 1 fois
     * 
     * @return json boolean
     */
    public function closeaction(){
        $this->autoRender = false;
        $Actions = new ActionsController(); 
        $all_actions = $Actions->set_close_all_actions(100);
        return json_encode($all_actions);
    }
    
    /**
     * Méthode renvoyant les mails aux personnes dont la saisie est incomplète ou à faire pour le mois de $mois
     * Fréquence d'utilisation : 1er jour ouvré aprés le 15 du mois
     * Répétition : 1 fois
     * 
     * @param date $date : default null dans ce cas la date sera le lundi de la semaine suivante
     * @param int $mois : default null dans ce cas le mois sera calulé au mois courant
     * @return json
     */
    public function notifysaisie($date=null,$mois=null) {
        //TODO mettre des valeur par défaut pour une utilisation automatique
        $today = new DateTime();
        $date = $date == null ? $today->format("Y-m-d") : $date;
        $date = nextMonday($date);
        $mois = $mois == null ? $today->format("m") : $mois;
        $this->autoRender = false;
        $Utilisateurs = new UtilisateursController(); 
        $all_users = $Utilisateurs->get_users_gestionnaireabsences();
        foreach ($all_users as $user):
            $utilisateur = $user['Utilisateur']['PRENOM']." ".$user['Utilisateur']['NOM'];
            $dtori = date('Y-'.$mois.'-d');
            $zmois = $mois < 10 ? "0".$mois : $mois;
            $periode = startWeek($dtori,true). " au ".endWeek(date("Y-".$mois."-t"),true);
            $message = $this->mailSaisie($utilisateur, $date, $mois, $periode);
            $d = isvoyelle(strMonth($mois)) ? "d'" : "de ";
            $objet = "URGENT : Saisie d'activité pour le mois ".$d.strMonth($mois);
            $this->sendmailhtml($user['Utilisateur']['MAIL'], $objet, $message, 'haute');
        endforeach; 
        return json_encode($all_users);
    }
    
    /**
     * Méthode envoyant un mail pour aviser de la saisie à faire pour le $date
     * Fréquence d'utilisation : tous les jours à partir du 20 du mois et pendant 7 jours
     * Répétition : 1 fois
     * 
     * @param int $mois en integer sera convertit en string
     * @param date $date date au format us (YYY-MM-DD)
     * @return json
     */
    public function notifyrappelsaisie($date=null,$mois=null) {
        $this->autoRender = false;
        $today = new DateTime();
        $date = $date == null ? $today->format("Y-m-d") : $date;
        $date = nextMonday($date);        
        $mois = $mois == null ? $today->format("m") : $mois;
        if($date!=null && $mois!= null):
            $Activitesreelles = new ActivitesreellesController(); 
            $Utilisateurs = new UtilisateursController(); 
            $all_users = $Utilisateurs->get_users_gestionnaireabsences();
            $str_users = $Utilisateurs->get_str_users_gestionnaireabsences();
            $all_activites = $Activitesreelles->getActivitesReelles($mois, date('Y'));
            $firstdate = new DateTime(date('Y-'.$mois.'-1'));
            $d = isvoyelle(strMonth($mois)) ? "d'" : "de ";
            $nbouvre = getOpenDays(startWeek($firstdate->format("Y-m-d")),endWeek(date("Y-".$mois."-t")));
            $activites = array();
            foreach ($all_users as $user):
                $utilisateur = $user['Utilisateur']['PRENOM']." ".$user['Utilisateur']['NOM'];
                $mailuser = $user['Utilisateur']['MAIL'];
                foreach ($all_activites as $activite):
                    if($user['Utilisateur']['id']==$activite['SAISIE']['USERID']):
                        if($activite['SAISIE']['VEROUILLE']!=round($nbouvre/5)):
                            if($activite['SAISIE']['TOTAL']<$nbouvre):
                                $objet = 0;
                                $mailobj = "URGENT : Saisie d'activite du mois ".$d.strMonth($mois)." à faire";
                            elseif($activite['SAISIE']['TOTAL']>=$nbouvre): 
                                $objet = 2;    
                                $mailobj = "URGENT : Saisie d'activite du mois ".$d.strMonth($mois)." à valider";
                            endif;
                        else:
                            if($activite['SAISIE']['TOTAL']<$nbouvre):
                                $objet = 1;
                                $mailobj = "URGENT : Saisie d'activite du mois ".$d.strMonth($mois)." à compléter";
                            endif;
                        endif;
                    endif;
                endforeach;
                $mail = $this->rappelSaisie($utilisateur,$objet,$mois);
                $this->sendmailhtml($mailuser, $mailobj, $mail, "haute");
            endforeach;  
            return json_encode($all_activites);
        else:
            $this->log("[notifyrappelsaisie] : Rappel de saisie impossible manque les paramètres date et mois");
        endif;
    }    
    
    /**
     * Méthode constituant le mail de rappel à envoyer pour les actions proche de l'échéance à l'utilisateur
     * 
     * @param string $utilisateur : NOMLONG seulement
     * @param array $actions : liste des objets complets
     * @return string
     */
    public function rappelActionsAVenir($utilisateur,$actions){
        $msg = $this->header;
        $msg .= "Bonjour ".h($utilisateur).$this->cr.$this->cr;
        $msg .= count($actions) > 1 ? "voici la liste des ".count($actions)." actions prochent de la date d'échéance :" : "voici la liste de l'action proche de la date d'échéance :" ;
        $msg .= "<ul>";
        foreach ($actions as $value) {
            $msg .= '<li>'.'A-'.strYear($value['Action']['created']).'-'.$value['Action']['id']."<ul><li>Objet : ".h($value['Action']['OBJET'])."</li><li>Avancement : ".$value['Action']['AVANCEMENT']."%</li><li>Echéance le : ".$value['Action']['ECHEANCE'].'</li></ul></li>';
        }
        $msg .= "</ul>";
        $msg .= "Si l'action est terminée mettre le statut de l'action à terminer.".$this->cr;
        $msg .= $this->signature;
        return $msg;
    }
    
    /**
     * Méthode constituant le mail de rappel à envoyer pour les actions proche de l'échéance à l'utilisateur
     * 
     * @param string $utilisateur : NOMLONG seulement
     * @param array $actions : liste des objets complets
     * @return string
     */
    public function rappelActionsEchues($utilisateur,$actions){
        $msg = $this->header;
        $msg .= "Bonjour ".h($utilisateur).$this->cr.$this->cr;
        $msg .= count($actions) > 1 ? "voici la liste des ".count($actions)." actions dont la date d'échéance est dépassée :" : "voici la liste de l'action dont la date d'échéance est dépassée :" ;
        $msg .= "<ul>";
        foreach ($actions as $value) {
            $msg .= '<li>'.'A-'.strYear($value['Action']['created']).'-'.$value['Action']['id']."<ul><li>Objet : ".h($value['Action']['OBJET'])."</li><li>Avancement : ".$value['Action']['AVANCEMENT']."%</li><li>Echéance le : ".$value['Action']['ECHEANCE'].'</li></ul></li>';
        }
        $msg .= "</ul>";
        $msg .= "Si l'action est terminée mettre le statut de l'action à terminer.".$this->cr;
        $msg .= $this->signature;
        return $msg;
    }    
    
    /**
     * Méthode constituant le mail de rappel à envoyer pour la saisie incomplète ou inexistante
     * 
     * @param string $utilisateur : NOMLONG seulement
     * @param int $objet : 1 : à compléter ou 0 : à faire ou 2 : à valider
     * @param int $mois : mois pour lequel il faut envoyer les rappel
     * @return string
     */
    public function rappelSaisie($utilisateur,$objet,$mois){
        $d = isvoyelle(strMonth($mois)) ? "d'" : "de ";
        switch ($objet):
            case 0:
                $strobjet = 'à faire';
                break;
            case 1:
                $strobjet = 'à compléter';
                break;            
            case 2:
                $strobjet = 'à valider';
                break;            
        endswitch;
        $msg = $this->header;
        $msg .= "Bonjour ".h($utilisateur).$this->cr.$this->cr;
        $msg .= "votre saisie du mois ".$d.strMonth($mois)." étant ".$strobjet.".".$this->cr;
        $msg .= "Merci de prendre quelques instant pour finaliser votre saisie au plus vite.".$this->cr.$this->cr;
        $msg .= $this->signature;
        return $msg;
    }
       
    /**
     * Méthode constituant le mail à envoyer pour aviser de la date de saisie de l'activité
     * 
     * @param string $utilisateur : NOMLONG seulement
     * @param date $date : date limite
     * @param int $mois : mois de saisie
     * @param string $periode : période du dd/mm/YYYY au dd/mm/YYYY
     * @return string
     */
    public function mailSaisie($utilisateur,$date,$mois,$periode){
        $strdate = new DateTime(CUSDate($date));
        $d = isvoyelle(strMonth($mois)) ? "d'" : "de ";
        $msg = $this->header;
        $msg .= "Bonjour ".h($utilisateur).$this->cr.$this->cr;
        $msg .= "Merci de bien vouloir faire votre saisie d'activité pour le mois ".$d.strMonth($mois).$this->cr."Date limite de saisie le : ".strDay($strdate->format("N"))." ".$strdate->format("d/m/Y")." dernier délais.";
        $msg .= $this->cr.'Période de saisie du : '.$periode.$this->cr."Si la première semaine est déjà soumise à facturation, commencez votre saisie la semaine suivante.".$this->cr.$this->cr;
        $msg .= $this->signature;
        return $msg;
    }
    
    /**
     * Méthode d'envois de mail
     * 
     * @param string $utilisateur : mail du destinataire
     * @param string $objet : objet du mail
     * @param string $mail : message formaté en html à envoyer
     * @param string $priorité : défaut normal sinon mettre autre chose
     * @return log error on catch
     */
    public function sendmailhtml($utilisateur,$objet,$mail,$priorite='normal'){
        $from = Configure::read('mailapp');
        $email = new CakeEmail();
        if($priorite != 'normal') : $email->setHeaders(array('X-Priority'=>1)); endif;
        try{
            $email->config('smtp')
                  ->emailFormat('html')
                  ->from($from)
                  ->to($utilisateur)
                  ->subject($objet)
                  ->send($mail);
        }
        catch(Exception $e){
            $this->log('Echec de l\'envois du mail - '.translateMailException($e->getMessage()));
        }  
    }
    
    /**
     * Méthode permettant la réouverture du site après maintenance
     * 
     * @return boolean
     */
    public function open_after_maintenance(){
        $this->autoRender = false;
        $filename = WWW_ROOT.'maintenance.md';
        return json_encode(unlink(realpath($filename)));
    }
    
    /**
     * Méthode permettant la fermeture du site pour maintenance
     * 
     * @return true
     */
    public function close_for_maintenance(){
        $this->autoRender = false;
        $filename = WWW_ROOT.'maintenance.md';
        $fp = fopen($filename,"wb");
        fclose($fp);                   
        return json_encode(true);
    }  
    
    /**
     * Méthode permettant de supprimer tous les fichiers calendrier générés
     * 
     * @return true
     */
    public function clean_calendars(){
        $this->autoRender = false;
        $dir = './files/calendars/';
        $files = listFolder($dir);
        foreach ($files as $file):
            unlink(realpath(str_replace('..','.',$file['url'])));
        endforeach;
        return json_encode(true);
    }
}
