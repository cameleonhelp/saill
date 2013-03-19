<?php
App::uses('AppModel', 'Model');
/**
 * isFerie 
 * 
 * @param type $date au format 'Y-m-d'
 * @return boolean
 */
    function isFerie($date){
        $an = $date->format('Y');
        $tab_feries[] = $an.'-01-01'; // Jour de l'an
        $tab_feries[] = $an.'-05-01'; // Fête du travail
        $tab_feries[] = $an.'-05-08'; // Victoire 1945
        $tab_feries[] = $an.'-07-14'; // Fete nationale
        $tab_feries[] = $an.'-08-15'; // Assomption
        $tab_feries[] = $an.'-11-01'; // Toussaint
        $tab_feries[] = $an.'-11-11'; // Armistice 1918
        $tab_feries[] = $an.'-12-25'; // Noël
        // Récupération de paques. Permet ensuite d'obtenir le jour de l'ascension et celui de la pentecôte
        $paques = easter_date($an);
        // le coefficient n'est aps identique s'il s'agit d'un serveur sous Windows ou sous Unix
        $i = substr($_SERVER['DOCUMENT_ROOT'], 0, 1) == '/' ? 1 : 2;
        $j = substr($_SERVER['DOCUMENT_ROOT'], 0, 1) == '/' ? 39 : 40;
        $k = substr($_SERVER['DOCUMENT_ROOT'], 0, 1) == '/' ? 50 : 51;       
        $tab_feries[] = date($an.'-m-d', $paques + (86400*$i)); // Paques
        $tab_feries[] = date($an.'-m-d', $paques + (86400*$j)); // Ascension
        $tab_feries[] = date($an.'-m-d', $paques + (86400*$k)); // Pentecote        
        
        return in_array($date->format('Y-m-d'),$tab_feries);
    }

/**
 * CUSDate
 * 
 * @param type $frdate
 * @return date au format Y-m-d
 */
    function CUSDate($frdate){
    $day = explode('/',$frdate);
    return $day[2]."-".$day[1]."-".$day[0];
    }
    
/**
 * CFRDate
 * 
 * @param type $frdate
 * @return date au format Y-m-d
 */
    function CFRDate($usdate){
    $day = explode('-',$usdate);
    return $day[2]."/".$day[1]."/".$day[0];
    }
    
/**
 * dateIsEqual
 * 
 * @param type $date1
 * @param type $date2
 * @return boolean
 */    
    function dateIsEqual($date1,$date2){
        $d1 = explode("/",$date1);
        $n1 = $d1[2].$d1[1].$d1[0];
        $d2 = explode("/",$date2);
        $n2 = $d2[2].$d2[1].$d2[0];
        return $n1==$n2 ? true: false;
    }    
    
/**
 * debutsem
 * 
 * @param type $year
 * @param type $month
 * @param type $day
 * @return date de début de semaine au format fr
 */    
    function debutsem($year,$month,$day) {
        $num_day      = date('w', mktime(0,0,0,$month,$day,$year));
        $premier_jour = mktime(0,0,0, $month,$day-(!$num_day?7:$num_day)+1,$year);
        $datedeb      = date('d/m/Y', $premier_jour);
        return $datedeb;
    }

/**
 * finsem
 * 
 * @param type $year
 * @param type $month
 * @param type $day
 * @return date de fin de semaine au format fr
 */    
    function finsem($year,$month,$day) {
        $num_day      = date('w', mktime(0,0,0,$month,$day,$year));
        $dernier_jour = mktime(0,0,0, $month,7-(!$num_day?7:$num_day)+$day,$year);
        $datedeb      = date('d/m/Y', $dernier_jour);
        return $datedeb;
    }

/**
 * joursemaine
 * 
 * @param type $usdate
 * @return le numéro du jour (la date)
 */    
    function joursemaine($usdate){
        $jour = date('d', $usdate);
        return $jour;
    }
    
/**
 * startWeek
 * 
 * @param type $year
 * @param type $month
 * @param type $day
 * @return dateTime
 */    
    function startWeek($date) {
        $num_day = $date->format('N')-1;
        $interval = date_interval_create_from_date_string($num_day.' days');
        $date->sub($interval);
        return $date->format('Y-m-d');
    }    
?>
