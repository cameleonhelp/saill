<?php
App::uses('AppModel', 'Model');
/**
 * isFerie 
 * 
 * @param type $date
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
        $tab_feries[] = date($an.'-m-d', $paques + 86400); // Paques
        $tab_feries[] = date($an.'-m-d', $paques + (86400*39)); // Ascension
        $tab_feries[] = date($an.'-m-d', $paques + (86400*50)); // Pentecote        
        
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
    
?>
