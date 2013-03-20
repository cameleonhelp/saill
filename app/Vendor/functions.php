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

/**
 * listFolder
 * 
 * @param type $folder
 * @return array
 */    
    function listFolder($folder){
        $result = array();
        $dirname = $folder;
        $urlname = '.'.$dirname;
        $dir = @opendir($dirname); 
        while($file = @readdir($dir)) {  
            if($file != '.' && $file != '..'  && $file != 'Thumbs.db' && !is_dir($dirname.$file) && $file !='@eaDir') {
                 $nom = str_replace('_',' ', $file);
                 $fileList = array('nom'=>$nom,'ext'=>ext($file),'url'=>$urlname.$file);
                 array_push($result,$fileList);
            }
        } 
        @closedir($dir);
        asort($result);
        return $result;
    }

/**
 * ext
 * 
 * @param type $fichier
 * @return string
 */    
    function ext($fichier)
       {
       // icone par defaut si l'extention n'a pas d'icone
       $extention = "";   

       // recupere extention sur le nom de fichier
       $tab_fichier = explode(".",$fichier);   
       $extention = $tab_fichier[count($tab_fichier)-1];
       return $extention;
    } 
    
/**
 * listIndispo
 * 
 * @param type $folder
 * @return array
 */    
    function listIndispo($indispos){
        $result = array();
        foreach($indispos as $indispo) {  
            $day = CUSDate($indispo['Activitesreelle']['DATE']);
            if ($indispo['Activitesreelle']['LU'] > 0) :
                $date = new DateTime($day);
                $periodeLU = $indispo['Activitesreelle']['LU_TYPE'];                 
                $newIndispo = array('utilisateur_id'=>$indispo['Activitesreelle']['utilisateur_id'],'DATE'=>$date->format('Y-m-d'),'PERIODE'=>$periodeLU,'NB'=>$indispo['Activitesreelle']['LU']);
                array_push($result,$newIndispo);
            endif;
            if ($indispo['Activitesreelle']['MA'] > 0) :
                $date = new DateTime($day);
                $date->add(new DateInterval('P1D'));
                $periodeMA = $indispo['Activitesreelle']['MA_TYPE'];                
                $newIndispo = array('utilisateur_id'=>$indispo['Activitesreelle']['utilisateur_id'],'DATE'=>$date->format('Y-m-d'),'PERIODE'=>$periodeMA,'NB'=>$indispo['Activitesreelle']['MA']);
                array_push($result,$newIndispo);
            endif;
            if ($indispo['Activitesreelle']['ME'] > 0) :
                $date = new DateTime($day);
                $date->add(new DateInterval('P2D'));
                $periodeME = $indispo['Activitesreelle']['ME_TYPE'];                
                $newIndispo = array('utilisateur_id'=>$indispo['Activitesreelle']['utilisateur_id'],'DATE'=>$date->format('Y-m-d'),'PERIODE'=>$periodeME,'NB'=>$indispo['Activitesreelle']['ME']);
                array_push($result,$newIndispo);
            endif;
            if ($indispo['Activitesreelle']['JE'] > 0) :
                $date = new DateTime($day);
                $date->add(new DateInterval('P3D'));
                $periodeJE = $indispo['Activitesreelle']['JE_TYPE'];                             
                $newIndispo = array('utilisateur_id'=>$indispo['Activitesreelle']['utilisateur_id'],'DATE'=>$date->format('Y-m-d'),'PERIODE'=>$periodeJE,'NB'=>$indispo['Activitesreelle']['JE']);
                array_push($result,$newIndispo);
            endif;
            if ($indispo['Activitesreelle']['VE'] > 0) :
                $date = new DateTime($day);
                $date->add(new DateInterval('P4D'));
                $periodeVE = $indispo['Activitesreelle']['VE_TYPE'];                
                $newIndispo = array('utilisateur_id'=>$indispo['Activitesreelle']['utilisateur_id'],'DATE'=>$date->format('Y-m-d'),'PERIODE'=>$periodeVE,'NB'=>$indispo['Activitesreelle']['VE']);
                array_push($result,$newIndispo);
            endif;            
            if ($indispo['Activitesreelle']['SA'] > 0) :
                $date = new DateTime($day);
                $date->add(new DateInterval('P5D'));
                $periodeSA = $indispo['Activitesreelle']['SA_TYPE'];                          
                $newIndispo = array('utilisateur_id'=>$indispo['Activitesreelle']['utilisateur_id'],'DATE'=>$date->format('Y-m-d'),'PERIODE'=>$periodeSA,'NB'=>$indispo['Activitesreelle']['SA']);
                array_push($result,$newIndispo);
            endif;
            if ($indispo['Activitesreelle']['DI'] > 0) :
                $date = new DateTime($day);
                $date->add(new DateInterval('P6D'));
                $periodeDI = $indispo['Activitesreelle']['DI_TYPE'];                
                $newIndispo = array('utilisateur_id'=>$indispo['Activitesreelle']['utilisateur_id'],'DATE'=>$date->format('Y-m-d'),'PERIODE'=>$periodeDI,'NB'=>$indispo['Activitesreelle']['DI']);
                array_push($result,$newIndispo);
            endif;            
        } 
        //asort($result);
        return $result;
    }    
    
/**
 * is_exist_in_array
 * 
 * @param type $value
 * @param type $array
 * @return boolean
 */    
    function is_date_utilisateur_in_array($date,$utilisateur_id,$arrays){
        $result = false;
        foreach ($arrays as $array):
            if ($utilisateur_id==$array['utilisateur_id']):
                if ($date==$array['DATE']):
                    $result = true;
                    break;
                else:
                    $result = false;
                endif;
            else :
                $result = false;
            endif;
        endforeach;
        return $result;
    }
    
/**
 * nb_periode
 * 
 * @param type $date
 * @param type $utilisateur
 * @param type $array
 * @return array
 */    
    function nb_periode($date,$utilisateur_id,$arrays){
        $result = array('nb'=>'','periode'=>'');
        foreach ($arrays as $array):
            if ($utilisateur_id==$array['utilisateur_id']):
                if ($date==$array['DATE']):
                    $result = array('nb'=>$array['NB'],'periode'=>$array['PERIODE']);
                    break;
                else:
                    $result = array('nb'=>'','periode'=>'');
                endif;
            else :
                $result = array('nb'=>'','periode'=>'');
            endif;
        endforeach;
        return $result;
    }
?>
