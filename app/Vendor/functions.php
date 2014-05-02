<?php
App::uses('AppModel', 'Model', 'Autorisation', 'Activite');
App::uses('ConnectionManager', 'Model');

function get_page_mod_time() { 
    $incls = get_included_files(); 
    $incls = array_filter($incls, "is_file"); 
    $mod_times = array_map('filemtime', $incls); 
    $mod_time = max($mod_times); 

    return date("d/m/Y H:i:s",$mod_time); 
} 

/**
 * isFerie 
 * 
 * @param type $date au format 'Y-m-d'
 * @return boolean
 */
    function isFerie($date){
        date_default_timezone_set('Europe/Paris');
        $date = !is_object($date) ? new DateTime($date) : $date;
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
        
        $i = 1;
        $j = 39;
        $k = 50;       
        $tab_feries[] = date($an.'-m-d', $paques + (86400*$i)); // Paques
        $tab_feries[] = date($an.'-m-d', $paques + (86400*$j)); // Ascension
        $tab_feries[] = date($an.'-m-d', $paques + (86400*$k)); // Pentecote        
        
        return in_array($date->format('Y-m-d'),$tab_feries);
    }

 /**
 * CDateTimeline
 * 
 * @param type $frdate
 * @return date au format Y-m-d
 */
    function CDateTimeline($frdate){
    $result = $frdate;
    if(strstr($frdate, '/')==!false):
    $day = explode('/',$frdate);
    $result = $day[2].",".($day[1]-1).",".$day[0];
    endif;
    return $result;
    }
    
/**
 * CUSDate
 * 
 * @param type $frdate
 * @return date au format Y-m-d
 */
    function CUSDate($frdate){
    $result = $frdate;
    if(strstr($frdate, '/')==!false):
    $day = explode('/',$frdate);
    $result = $day[2]."-".$day[1]."-".$day[0];
    endif;
    return $result;
    }
    
    function CUSDatetime($frdate){
    $result = $frdate;
    if(strstr($frdate, '/')==!false):
        $frdate = explode(' ',$frdate);
        $date = explode('/',$frdate[0]);
        if(count($frdate) > 1):
            $time = explode(':',$frdate[1]);
        else : 
            $time = array();
        endif;
        if(count($time) > 0) :
            $result = date('Y-m-d H:i:s', mktime($time[0], $time[1], $time[2], $date[1], $date[0], $date[2]));
        else :
            $result = date('Y-m-d H:i:s', mktime('0', '0', '0', $date[1], $date[0], $date[2]));
        endif;
    endif;
    return $result;
    }    
    
    function CUSDatetimeToFRDate($day){
    $result = $day;
    if(strstr($day, '/')===false):
        $day = explode(' ',$day);
        $date = explode('-',$day[0]);
        if(count($date) > 1):
            $time = explode(':',$day[1]);
        else : 
            $time = array();
        endif;
        if(count($time) > 0) :
            $result = date('d/m/Y', mktime($time[0], $time[1], $time[2], $date[1], $date[2], $date[0]));
        else :
            $result = date('d/m/Y', mktime('0', '0', '0', $date[1], $date[2], $date[0]));
        endif;
    endif;
    return $result;
    }  
    
/**
 * CIntDateDeb
 * 
 * @param type $frdate
 * @return date au format Y-m-d
 */
    function CIntDateDeb($frdate=null){
    if($frdate!=null && $frdate!='00/00/0000'):
        $day = explode('/',$frdate);
        $result = (int)($day[2].$day[1].$day[0]);
    else :
        $result = (int)'0';
    endif;
    return $result;
}
/**
 * CIntDateFin
 * 
 * @param type $frdate
 * @return date au format Y-m-d
 */
    function CIntDateFin($frdate=null){
    if($frdate!=null && $frdate!='00/00/0000'):
        $day = explode('/',$frdate);
        $result = (int)($day[2].$day[1].$day[0]);
    else :
        $result = (int)'99999999';
    endif;
    return $result;
}
/**
 * CIntDate
 * 
 * @param type $frdate
 * @return date au format Y-m-d
 */
    function CIntDate($frdate=null){
    if(strstr($frdate, '/')==!false):
        if($frdate!=null && $frdate!='00/00/0000'):
            $day = explode('/',$frdate);
            $result = (int)($day[2].$day[1].$day[0]);
        else :
            $result = (int)'00000000';
        endif;
    elseif(strstr($frdate, '-')==!false):
        if($frdate!=null && $frdate!='0000-00-00'):
            $day = explode('-',$frdate);
            $result = (int)($day[0].$day[1].$day[2]);
        else :
            $result = (int)'00000000';
        endif;        
    endif;
    return $result;
}
/**
 * CFRDate
 * 
 * @param type $frdate
 * @return date au format Y-m-d
 */
    function CFRDate($usdate){
    $result = $usdate;
    if(strstr($usdate, '-')==!false):
    $day = explode('-',$usdate);
    $result = $day[2]."/".$day[1]."/".$day[0];
    endif;
    return $result;
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
    function startWeek($date,$fr=false) {
        $date = new DateTime($date);
        $num_day = $date->format('N') == 1 ? '' : 'P'.($date->format('N')-1).'D';
        if($num_day!=''):
            $interval = new DateInterval($num_day);
            $date->format('Y-m-d');
            $date->sub($interval);
        endif;        
        $format = $fr ? "d/m/Y" : "Y-m-d";
        return $date->format($format);
    }  

/**
 * endWeek
 * 
 * @param type $year
 * @param type $month
 * @param type $day
 * @return dateTime
 */    
    function endWeek($date,$fr=false) {
        $date = new DateTime($date);
        $num_day = 7-$date->format('N');
        $interval = new DateInterval('P'.$num_day.'D');
        $date->add($interval);
        $format = $fr ? "d/m/Y" : "Y-m-d";
        return $date->format($format);
    }  

/**
 * startWeek
 * 
 * @param type $year
 * @param type $month
 * @param type $day
 * @return dateTime
 */    
    function absstartWeek($date) {
        $num_day = $date->format('N')-1;
        $interval = date_interval_create_from_date_string($num_day.' days');
        $date->format('Y-m-d');
        $date->sub($interval);
        return $date->format('Y-m-d');
    }  

/**
 * endWeek
 * 
 * @param type $year
 * @param type $month
 * @param type $day
 * @return dateTime
 */    
    function absendWeek($date) {
        $num_day = 7-$date->format('N');
        $interval = date_interval_create_from_date_string($num_day.' days');
        $date->add($interval);
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
            if($file != 'empty' && $file != '.' && $file != '..'  && $file != 'Thumbs.db' && !is_dir($dirname.$file) && $file !='@eaDir') {
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
                $tmp = $indispo['Activitesreelle']['demandeabsence_id']!=null ? true : false;
                $newIndispo = array('utilisateur_id'=>$indispo['Activitesreelle']['utilisateur_id'],'DATE'=>$date->format('Y-m-d'),'PERIODE'=>$periodeLU,'NB'=>$indispo['Activitesreelle']['LU'],'TMP'=>$tmp);
                array_push($result,$newIndispo);
            endif;
            if ($indispo['Activitesreelle']['MA'] > 0) :
                $date = new DateTime($day);
                $date->add(new DateInterval('P1D'));
                $periodeMA = $indispo['Activitesreelle']['MA_TYPE'];   
                $tmp = $indispo['Activitesreelle']['demandeabsence_id']!=null ? true : false;
                $newIndispo = array('utilisateur_id'=>$indispo['Activitesreelle']['utilisateur_id'],'DATE'=>$date->format('Y-m-d'),'PERIODE'=>$periodeMA,'NB'=>$indispo['Activitesreelle']['MA'],'TMP'=>$tmp);
                array_push($result,$newIndispo);
            endif;
            if ($indispo['Activitesreelle']['ME'] > 0) :
                $date = new DateTime($day);
                $date->add(new DateInterval('P2D'));
                $periodeME = $indispo['Activitesreelle']['ME_TYPE']; 
                $tmp = $indispo['Activitesreelle']['demandeabsence_id']!=null ? true : false;
                $newIndispo = array('utilisateur_id'=>$indispo['Activitesreelle']['utilisateur_id'],'DATE'=>$date->format('Y-m-d'),'PERIODE'=>$periodeME,'NB'=>$indispo['Activitesreelle']['ME'],'TMP'=>$tmp);
                array_push($result,$newIndispo);
            endif;
            if ($indispo['Activitesreelle']['JE'] > 0) :
                $date = new DateTime($day);
                $date->add(new DateInterval('P3D'));
                $periodeJE = $indispo['Activitesreelle']['JE_TYPE']; 
                $tmp = $indispo['Activitesreelle']['demandeabsence_id']!=null ? true : false;
                $newIndispo = array('utilisateur_id'=>$indispo['Activitesreelle']['utilisateur_id'],'DATE'=>$date->format('Y-m-d'),'PERIODE'=>$periodeJE,'NB'=>$indispo['Activitesreelle']['JE'],'TMP'=>$tmp);
                array_push($result,$newIndispo);
            endif;
            if ($indispo['Activitesreelle']['VE'] > 0) :
                $date = new DateTime($day);
                $date->add(new DateInterval('P4D'));
                $periodeVE = $indispo['Activitesreelle']['VE_TYPE']; 
                $tmp = $indispo['Activitesreelle']['demandeabsence_id']!=null ? true : false;
                $newIndispo = array('utilisateur_id'=>$indispo['Activitesreelle']['utilisateur_id'],'DATE'=>$date->format('Y-m-d'),'PERIODE'=>$periodeVE,'NB'=>$indispo['Activitesreelle']['VE'],'TMP'=>$tmp);
                array_push($result,$newIndispo);
            endif;            
            if ($indispo['Activitesreelle']['SA'] > 0) :
                $date = new DateTime($day);
                $date->add(new DateInterval('P5D'));
                $periodeSA = $indispo['Activitesreelle']['SA_TYPE'];  
                $tmp = $indispo['Activitesreelle']['demandeabsence_id']!=null ? true : false;
                $newIndispo = array('utilisateur_id'=>$indispo['Activitesreelle']['utilisateur_id'],'DATE'=>$date->format('Y-m-d'),'PERIODE'=>$periodeSA,'NB'=>$indispo['Activitesreelle']['SA'],'TMP'=>$tmp);
                array_push($result,$newIndispo);
            endif;
            if ($indispo['Activitesreelle']['DI'] > 0) :
                $date = new DateTime($day);
                $date->add(new DateInterval('P6D'));
                $periodeDI = $indispo['Activitesreelle']['DI_TYPE'];  
                $tmp = $indispo['Activitesreelle']['demandeabsence_id']!=null ? true : false;
                $newIndispo = array('utilisateur_id'=>$indispo['Activitesreelle']['utilisateur_id'],'DATE'=>$date->format('Y-m-d'),'PERIODE'=>$periodeDI,'NB'=>$indispo['Activitesreelle']['DI'],'TMP'=>$tmp);
                array_push($result,$newIndispo);
            endif;            
        } 
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
                    $result = array('nb'=>$array['NB'],'periode'=>$array['PERIODE'],'tmp'=>$array['TMP']);
                    break;
                else:
                    $result = array('nb'=>'','periode'=>'','tmp'=>false);
                endif;
            else :
                $result = array('nb'=>'','periode'=>'','tmp'=>false);
            endif;
        endforeach;
        return $result;
    }
    
/**
 * userAuth
 * 
 * @param type $key
 * @return Variable de session user
 */    
    function userAuth($key = null){
        $check = SessionComponent::check('Auth.User');
        if($check){
            $user = SessionComponent::read('Auth.User');
            if ($key === null) {
                return $user;
            } else {
                return $user[$key];
            }
        }
        /*else {
            SessionComponent::setFlash(__('Votre session est expirée veuillez rafraîchir la page.<br />Vos données ont été prises en compte, si toutefois cela n\'était pas le cas, veuillez contacter l\'administrateur.',true),'flash_failure');
        }*/ 
    }
    
    function refreshSession($user){
        SessionComponent::delete('Auth.User');
        sleep(1);
        SessionComponent::write('Auth.User',$user);
    }
        
    function isAuthorized($model,$action){
        $autorisations = SessionComponent::read(AUTHORIZED);
        $result = false;
        if (isset($autorisations)) :
            foreach ($autorisations as $autorisation):
                if($model == $autorisation['Autorisation']['MODEL']):
                    switch (strtolower($action)):
                        case 'index':
                            $result = $autorisation['Autorisation']['INDEX'];
                            break;
                        case 'add':
                            $result = $autorisation['Autorisation']['ADD'];
                            break;
                        case 'edit':
                            $result = $autorisation['Autorisation']['EDIT'];
                            break;
                        case 'view':
                            $result = $autorisation['Autorisation']['VIEW'];
                            break;
                        case 'delete':
                            $result = $autorisation['Autorisation']['DELETE'];
                            break;
                        case 'duplicate':
                            $result = $autorisation['Autorisation']['DUPLICATE'];
                            break;
                        case 'initpassword':
                            $result = $autorisation['Autorisation']['INITPASSWORD'];
                            break;
                        case 'absences':
                            $result = $autorisation['Autorisation']['ABSENCES'];
                            break;
                        case 'rapports':
                            $result = $autorisation['Autorisation']['RAPPORTS'];
                            break;
                        case 'update':
                            $result = $autorisation['Autorisation']['UPDATE'];
                            break;    
                        case 'myprofil':
                            $result = $autorisation['Autorisation']['MYPROFIL'];
                            break;  
                        case 'masse':
                            $result = $autorisation['Autorisation']['MASSE'];
                            break;                          
                        default:
                            $result = false;
                            break;                    
                    endswitch;
                endif;           
            endforeach;
        else:
            Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
        endif;
        return $result;
    }
    
/**
* etatLivrable method
*
* @throws NotFoundException
* @throws MethodNotAllowedException
* @param string $etat
* @return string class
*/  
        function etatLivrable($etat) {
            $class = '';
            switch ($etat){
                 case 'à faire':
                    $class = 'edit red';
                    break;
                 case 'en cours':
                    $class = 'edit';
                    break;                
                 case 'livré':
                    $class = 'truck green'; //'share';
                    break;          
                 case 'validé':
                    $class = 'check green';
                    break;  
                 case 'refusé':
                    $class = 'unshare red';
                    break;          
                 case 'annulé':
                    $class = 'remove_2 red';
                    break;                 
            }
            return $class;
        } 
        
/**
* etatMaterielInformatiqueImage method
*
* @throws NotFoundException
* @throws MethodNotAllowedException
* @param string $etat
* @return string class
*/  
       function etatMaterielInformatiqueImage($etat) {
           $class = '';
           switch ($etat){
                case 'En stock':
                   $class = 'inbox';
                   break;
                case 'En dotation':
                   $class = 'lock';
                   break;                
                case 'En réparation':
                   $class = 'wrench';
                   break;          
                case 'Au rebut':
                   $class = 'bin grey';
                   break;
                case 'Non localisé':
                   $class = 'google_maps red';
                   break; 
                case 'En prêt':
                   $class = 'bell green';                    
           }
           return $class;
       }
       
/**
* etatMaterielInformatiqueImage method
*
* @throws NotFoundException
* @throws MethodNotAllowedException
* @param string $etat
* @return string class
*/  
       function etatUtiliseOutilImage($etat) {
           $class = '';
           switch ($etat){
                case 'Demandé':
                   $class = 'envelope';
                   break;
                case 'Pris en compte':
                   $class = 'flag';
                   break;                
                case 'En validation':
                   $class = 'bookmark grey';
                   break;          
                case 'Validé':
                   $class = 'bookmark green';
                   break;
                case 'Demande transférée':
                   $class = 'share';
                   break;                
                case 'Demande traitée':
                   $class = 'ok_2';
                   break;
                case 'Retour utilisateur':
                   $class = 'ok_2 green';
                   break;                
                case 'A supprimer':
                   $class = 'remove';
                   break;          
                case 'Supprimée':
                   $class = 'remove red';
                   break; 
           }
           return $class;
       }  
       
function styleBarre($avancement){
    $result = '';
    switch ($avancement){
        case '10':
        case '20':
        case '30':            
            $result = 'danger';
            break;
        case '40':
        case '50':           
        case '60':
            $result = 'warning';
            break;
        case '70':
        case '80':
        case '90':
            $result = 'info';
            break;
        case '100':
            $result = 'success';
            break; 
        default:
            $result = 'default';
    }
    return $result;
}

function styleBarreInd($avancement){
    $result = '';
    switch (1){
        case $avancement >= 0 && $avancement < 31:           
            $result = 'info';
            break;
        case $avancement >= 31 && $avancement < 61:
            $result = 'warning';
            break;
        case $avancement >= 61 && $avancement < 100:
            $result = 'danger';
            break;
        case $avancement == 100:
            $result = 'success';
            break; 
        default:
            $result = 'danger progress-bar-striped';
    }
    return $result;
}

    function etatAction($etat) {
        $class = '';
        switch ($etat){
             case 'à faire':
                $class = 'tag red';
                break;
             case 'en cours':
                $class = 'tag';
                break;                
             case 'livrée':
             case 'livré':
                $class = 'inbox green';
                break;          
             case 'terminée':
                $class = 'tag green';
                break;         
             case 'annulée':
                $class = 'remove_2 red';
                break;                 
        }
        return $class;
    } 
    
    function etatTooltip($etat) {
        $tooltip = '';
        switch ($etat){
             case 'à faire':
                $tooltip = 'À faire';
                break;
             case 'en cours':
                $tooltip = 'En cours';
                break;                
             case 'livrée':
                $tooltip = 'Livrée';
                break;          
             case 'terminée':
                $tooltip = 'Terminée';
                break;         
             case 'annulée':
                $tooltip = 'Annulée';
                break;                 
        }
        return $tooltip;
    } 
    
    function areaIsVisible() {
        $utilisateur = userAuth();
        $result = false;
        if (($utilisateur['profil_id'] < 6) || ($utilisateur['WIDEAREA']==1)) { $result = true; }
        return $result;
    }
    
    function nbJoursOuvres($date){
	$nbopendays = 0;
	$annee = $date->format('Y');
	$mois = $date->format('m');
	$debutmois = $date->format('Y-m-01');
	$finmois = $date->format('Y-m-t');
	$nbdays = $date->format('t')+1;
	for ($i=1; $i<$nbdays;$i++){
		$d = $i < 10 ? '0'.$i : $i;
		$day = $annee.'-'.$mois.'-'.$d;
		$currentdate = new DateTime($day);
		if (isFerie($currentdate)===false && ($currentdate->format('N'))<6) {
				$nbopendays++;
		}
	}
        /* On supprime les vacances 6 semaines de 5 jours*/
        switch ($mois){
            case '02' :
                $nbopendays -= 5;
                break;
            case '04' :
                $nbopendays -= 5;
                break;  
            case '07' :
                $nbopendays -= 5;
                break;  
            case '08' :
                $nbopendays -= 10;
                break;  
            case '12' :
                $nbopendays -= 5;
                break;           
        }
        return $nbopendays;
    }
    
    function nbopendays($debutmois,$finmois){
	$nbopendays = 0;
	$debutmois = new DateTime($debutmois);
	$finmois = new DateTime($finmois);
        $diff = $debutmois->diff($finmois); 
        $nbdays = $diff->days ; 
	for ($i=0; $i<=$nbdays;$i++){
		$currentdate = $i > 0 ? $debutmois->add(new DateInterval('P1D')) : $debutmois;
		if (isFerie($currentdate)===false && ($currentdate->format('N'))<6) {
                    $nbopendays++;
		}
	}
        return $nbopendays;
    }    
    
    function nbJoursOuvresWeek($date){
	$nbopendays = 0;
	$startweek = $date;
        $diff = 6; ; 
	for ($i=0; $i<=$diff;$i++){
		$currentdate = $i > 0 ? $startweek->add(new DateInterval('P1D')) : $startweek;
		if (isFerie($startweek)===false && ($startweek->format('N'))<6) {
                    $nbopendays++;
		}
	}
        return $nbopendays;
    }       
/**
 * enretard method
 * 
 * @param type $date
 * @return boolean
 */    
    function enretard($date,$etat=null){
        $date = $date== null ? date('d/m/Y') : $date;
        $result = false;
        if ($etat == null || $etat == 'à faire' || $etat == 'en cours'):
            $today = intval(date('Ymd'));
            $date = explode("/",$date);
            $d = intval($date[2].$date[1].$date[0]);
            $result = ($d - $today) < 0 ? true: false;         
        endif;
        return $result;
    }
    
/**
 * enretard method
 * 
 * @param type $date
 * @return boolean
 */    
    function utiliseoutilEnretard($date){
        $result = false;
        $today = intval(date('Ymd'));
        $d = explode('/',$date);
        $ndate = new DateTime($d[2].'-'.$d[1].'-'.$d[0]);
        $ndate->add(new DateInterval('P7D'));
        $datelimite = $ndate->format('Ymd');         
        $datelimite = intval($datelimite);

        $result = ($datelimite - $today) < 0 ? true: false;         
        return $result;
    }
    
/**
 * enretard method
 * 
 * @param type $date
 * @return boolean
 */    
    function livrableenretard($echeance,$livraison=null,$etat=null){
        $result = false;
        $echeance = explode("/",$echeance);
        $d = intval($echeance[2].$echeance[1].$echeance[0]);
        if ($livraison!=null):
            $livraison = explode("/",$livraison);
            $dl = intval($livraison[2].$livraison[1].$livraison[0]);  
            $result = ($d - $dl) < 0 ? true: false;
        endif;
        if (($etat == null || $etat == 'à faire' || $etat == 'en cours') && !$result):
            $today = intval(date('Ymd'));            
            $result = ($d - $today) < 0 ? true: false;        
        endif;
        return $result;
    }    
    
/*
 * is_date method
 * 
 * @param type date 
 * @return boolean
 */    
    function is_date($date){
        $result = false;
        if (strpos($date, "/")!==false || strpos($date, "-")!==false) $result = true;
        return $result;
    }
    
    function strMonth($month){
        $moisentier = array(1=>'Janvier',2=>'Février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',7=>'Juillet',8=>'Août',9=>'Septembre',10=>'Octobre',11=>'Novembre',12=>'Décembre');
        return $moisentier[(int)$month];
    }
    
    function strDay($day){
        $string = array(1=>'Lundi',2=>'Mardi',3=>'Mercredi',4=>'Jeudi',5=>'Vendredi',6=>'Samedi',7=>'Dimanche');
        return $string[(int)$day];
    }    
    
    function strYear($date){
        if (strpos($date, "/")!==false) $date = CUSDatetime($date);
        $date = !is_object($date) ? new DateTime($date) : $date;
        $an = $date->format('Y');
        return $an;
    }    
    
    function ucfirst_utf8($stri){ 
        if($stri!='' && $stri{0}>="\xc3") 
            return (($stri{1}>="\xa0")? 
            ($stri{0}.chr(ord($stri{1})-32)): 
            ($stri{0}.$stri{1})).substr($stri,2); 
        else return ucfirst($stri); 
    }   
    
    function returnTo($pos=null){
        $url = $_SESSION['history'];
        $max = count($url)-1;
        $pos = $pos==null ? 0 : $pos;
        $pos = ($pos > $max) ? $max : ($pos <= 0) ? 0 : $pos;
        removeTo($pos);
        return $url[$pos]['here'];
    } 
    
    function removeTo($nb=null){
            $nb = $nb==null ? 1 : $nb;
            $History = $_SESSION['history'];
            if(count($History)>1):
                for ($i=0;$i<$nb;$i++):
                    @array_shift($History);
                endfor;
            endif;
            unset($_SESSION['history']);
            $_SESSION['history']=$History;
    }    
    
    function getallmonday($mois=null,$annee=null){
        $mois = $mois==null ? date('m'):$mois;
        $annee = $annee==null ? date('Y'):$annee;
        $nbdays = date('t',mktime(0, 0, 0, $mois, 1,$annee))+1;
        for ($i=1;$i<$nbdays;$i++):
            if(date('N',mktime(0, 0, 0, $mois, $i,$annee))==1):
                $mondays[]=date('d/m/Y',mktime(0, 0, 0, $mois, $i,$annee));
            endif;
        endfor;
        return $mondays;
    }
    
    function CHours2Days($hours){
        return ($hours/8);
    }
    
    function goPrev(){
        $result = false;
        if(SessionComponent::check('User.history')):
            $history = SessionComponent::read('User.history');
            $pos = count($history)-2 < 0 ? 0 : count($history)-2; 
            $result = $history[$pos];
        endif;
        return $result;
        exit();
    }
    
    function sort_arr_of_obj($array, $sortby, $direction='asc') {

        $sortedArr = array();
        $tmp_Array = array();

        foreach($array as $k => $v) {
            $tmp_Array[] = @strtolower($v->$sortby);
        }

        if($direction=='asc'){
            asort($tmp_Array);
        }else{
            arsort($tmp_Array);
        }

        foreach($tmp_Array as $k=>$tmp){
            $sortedArr[] = $array[$k];
        }

        return $sortedArr;
    }  
    
    function aasort (&$array, $key) {
        $sorter=array();
        $ret=array();
        if(count($array)>0):
            reset($array);
            foreach ($array as $ii => $va) {
                $sorter[$ii]=$va[$key];
            }
            asort($sorter);
            foreach ($sorter as $ii => $va) {
                $ret[$ii]=$array[$ii];
            }
            $array=$ret;
        else:
            $array=null;
        endif;
    }  
    
    function aarsort (&$array, $key) {
        $sorter=array();
        $ret=array();
        if(count($array)>0):
            reset($array);
            foreach ($array as $ii => $va) {
                $sorter[$ii]=$va[$key];
            }
            arsort($sorter);
            foreach ($sorter as $ii => $va) {
                $ret[$ii]=$array[$ii];
            }
            $array=$ret;
        else:
            $array=null;
        endif;            
    }   
    
    function translateMailException($message){
     $msg = explode(":",$message);
     switch ($msg[0]) {
         case "Connection refused":
             return 'Connexion refusée au serveur SMTP, contacter l\'administrateur';
             break;
         case 'Invalid email':
             return 'Email incorrect, vérifiez votre émail ou l\'email du destinataire : '.$msg[1];
             break;
         case 'Connection timed out':
             return "Délai de connexion dépassé, contacter l'administrateur";
             break;         
         default:
             return "Erreur inconnue lors de l'envois du mail, contacter l'administrateur en indiquant l'erreur : ".$message;
             break;
     }
     
     function addDay($date,$nbday){
         $d = explode('/',$date);
         $ndate = new DateTime($d[2].'-'.$d[1].'-'.$d[0]);
         $ndate->add(new DateInterval('P'.$nbday.'D'));
         return $ndate->format('d/m/Y');
     }
     
    }
    
/**
 * DateInMonth
 * return boolean
 * true : date in the month
 * false : date is not in the month
 */    
    function dateInMonth($date,$month){
        $m = explode('/', $date);
        return $m[1] != $month;
    }
    
/**
 * generateRandomPassword
 * @return string a random password with ASCII char (including symbols)
 */    
    function generateRandomPassword() {
      //Initialize the random password
      $password = '';

      //Initialize a random desired length
      $desired_length = rand(12, 15);

      for($length = 0; $length < $desired_length; $length++) {
        //Append a random ASCII character (including symbols)
        $password .= chr(rand(32, 126));
      }

      return $password;
    }   
    
    function colorNiveauRisque($niveau) {
        $color = '';
        switch ($niveau){
             case NULL:
                $color = 'none';
                break;
             case '0':
                $color = '#F5F5F5';
                break;                
             case '1':
                $color = '#CCDC00';
                break;          
             case '2':
                $color = '#7AB800';
                break;         
             case '3':
                $color = '#FFB612';
                break;   
             case '4':
                $color = '#A1006B';
                break;   
             case '5':
                $color = '#6E267B';
                break;               
        }
        return $color;
    } 
    
    function niveauToString($niveau){
        $str = '';
        switch ($niveau){
             case '0':
                $str = 'Improbable';
                break;                
             case '1':
                $str = 'Très faible';
                break;          
             case '2':
                $str = 'Faible';
                break;         
             case '3':
                $str = 'Moyen';
                break;   
             case '4':
                $str = 'Fort';
                break;   
             case '5':
                $str = 'Très fort';
                break;               
        }
        return $str;
    }
     
/**
 * Get random color hex value
 *
 * @param  int $id identifiant for user
 * @param  int $max_r Maximum value for the red color
 * @param  int $max_g Maximum value for the green color
 * @param  int $max_b Maximum value for the blue color
 * @return string
 */
function getIdColorHex($id, $max_r = 255, $max_g = 255, $max_b = 255)
{
    $key = 0.123456789;
    $min = $key * $id;
    $min = 100;
    // ensure that values are in the range between 0 and 255
    $max_r = max($min, min($max_r, 255));
    $max_g = max($min, min($max_g, 255));
    $max_b = max($min, min($max_b, 255));
   
    // generate and return the random color
    return str_pad(dechex($max_r), 2, '0', STR_PAD_LEFT) .
           str_pad(dechex($max_g), 2, '0', STR_PAD_LEFT) .
           str_pad(dechex($max_b), 2, '0', STR_PAD_LEFT);
}

function filtre_is_actif($values=null,$default){
    $return = $values != null ? true : false;
    if(is_array($values) && is_array($default)):
        $implodevalues = implode('', $values);
        $implodedefault = implode('', $default);
        $return = $implodevalues != $implodedefault ? true : false;
    endif;
    if(!is_array($values) && !is_array($default)):
        $return = $values != $default ? true : false;
    endif;
    return $return == true ? ' filtreactif' : '';
}

function subfiltre_is_actif($values=null,$default){
    $return = $values == null ? true : false;
    if(is_array($values) && is_array($default)):
        $implodevalues = implode('', $values);
        $implodedefault = implode('', $default);
        $return = $implodevalues == $implodedefault ? true : false;
    endif;    
    if(!is_array($values) && !is_array($default)):
        $return = $values == $default ? true : false;
    endif;
    return $return == true ? ' subfilteractif' : '';
}

function subfiltre_btn_is_actif($values=null,$default){
    $return = $values == null ? true : false; 
    $return = (string)$values === (string)$default ? true : false;
    return $return == true ? ' subfilteractif' : '';
}

function filtre_btn_is_actif($values=null,$default){
    $return = $values != null ? true : false;
    $return = (string)$values === (string)$default ? false : true;
    return $return == true ? ' filtreactif' : '';
}

function classActive($class){
      return $class == 'active_head' ? 'in' : '';
}

function classChevron($class){
      return $class == 'active_head' ? 'chevron-down' : 'chevron-right grey';
}

function CReponse($reponse){
    switch ($reponse) {
        case null:
            return 'En attente';
            break;
        case '1':
            return 'Validée';
            break;
        case '2':
            return 'Refusée';
            break; 
        case '3':
            return 'Supprimée';
            break;        
    }
}

function array_uniquecolumn($arr,$arrsearch,$key)
{
    $newArray = array();

    foreach($arr as $value) {
        $newArray[] = $value[$arrsearch];
    }
    return (simple_array_unique($newArray,$key));
}

function simple_array_unique($array,$key){
    $result = array();
    foreach ($array as $value):
        $result[]=$value[$key];
    endforeach;
    return array_unique($result);
}

function narray_diff( $ary_1, $ary_2 ) {
  // compare the value of 2 array
  // get differences that in ary_1 but not in ary_2
  // get difference that in ary_2 but not in ary_1
  // return the unique difference between value of 2 array
  $diff = array();

  // get differences that in ary_1 but not in ary_2
  foreach ( $ary_1 as $v1 ) {
    $flag = 0;
    foreach ( $ary_2 as $v2 ) {
      $flag |= ( $v1 == $v2 );
      if ( $flag ) break;
    }
    if ( !$flag ) array_push( $diff, $v1 );
  }

  // get difference that in ary_2 but not in ary_1
  foreach ( $ary_2 as $v2 ) {
    $flag = 0;
    foreach ( $ary_1 as $v1 ) {
      $flag |= ( $v1 == $v2 );
      if ( $flag ) break;
    }
    if ( !$flag && !in_array( $v2, $diff ) ) array_push( $diff, $v2 );
  }

  return $diff;
}

function glyphconf($etat){
    switch ($etat) {
        case '0':
            return 'inbox';
            break;
        case '1':
            return 'message_out';
            break;
        case '2':
            return 'inbox_in';
            break; 
        case '3':
            return 'certificate';
            break;  
        default:
            return 'inbox grey';
    }
}


function tooltipconf($etat){
    switch ($etat) {
        case '0':
            return 'Non remis';
            break;
        case '1':
            return 'Remis à l\'agent';
            break;
        case '2':
            return 'Remis au responsable SNCF';
            break; 
        case '3':
            return 'Remis à Sécurité et Risque SO';
            break;  
        default:
            return 'Non remis';
    }
}

function get_pass_value($pass){
    $value = 0;
    switch($pass):
        case 'tous':
            $value = 0;
            break;
        case '1':
            $value = 0;
            break;
        case '0';
            $value = 1;
            break;
    endswitch;
    return $value;
}

function get_pass_check($pass){
    $value = 0;
    switch($pass):
        case 'tous':
            $value = 'unchecked';
            break;
        case '1':
            $value = 'unchecked';
            break;
        case '0';
            $value = 'check';
            break;
    endswitch;
    return $value;
}

/**
 * Méthode qui test si la première lettre est une voyelle
 * 
 * @param string $string
 * @return boolean
 */
function isvoyelle($string){
    $voyelles = array("a","e","i","o","u","y");
    return in_array(substr(strtolower($string),0,1),$voyelles);
}

/**
 * Méthode qui donne le nombre de jours ouvrés entre deux dates
 * 
 * @param date $datedeb
 * @param date $datefin
 * @return int
 */
function getOpenDays($datedeb,$datefin){
    $nb_jours=0;
    $dated=explode('-',$datedeb);
    $datef=explode('-',$datefin);
    $timestampcurr=mktime(0,0,0,$dated[1],$dated[2],$dated[0]);
    $timestampf=mktime(0,0,0,$datef[1],$datef[2],$datef[0]);
    while($timestampcurr<$timestampf){
        if((date('w',$timestampcurr)!=0)&&(date('w',$timestampcurr)!=6) && !isFerie(date('Y-m-d',$timestampcurr))){
          $nb_jours++;
        }
        $timestampcurr=mktime(0,0,0,date('m',$timestampcurr),(date('d',$timestampcurr)+1)   ,date('Y',$timestampcurr));
    }
    return $nb_jours;
}

/**
 * Méthode qui renvois la date du lundi suivant
 * 
 * @param date $date
 * @return date au format us
 */
function nextMonday($date){
    $d = explode('-',$date);
    return date("Y-m-d",strtotime('next Monday',  mktime('0', '0', '0', $d[1], $d[2], $d[0])));
}

/**
 * Méthode qui retourn la date du lundi précédent
 * 
 * @param date $date
 * @return date au format us
 */
function previousMonday($date){
    $d = explode('-',$date);
    return date("Y-m-d",strtotime('previous Monday',  mktime('0', '0', '0', $d[1], $d[2], $d[0])));
}

/**
 * Méthode pour formatter le nombre de bytes en fonction de la valeur
 * 
 * @param int $bytes
 * @param string $unit
 * @param int $decimals
 * @return string
 */
function byteFormat($bytes, $unit = "", $decimals = 2) {
      $units = array('bytes' => 0, 'Ko' => 1, 'Mo' => 2, 'Go' => 3, 'To' => 4, 
                      'Po' => 5, 'Eo' => 6, 'Zo' => 7, 'Yo' => 8);

      $value = 0;
      if ($bytes > 0) {
              // Generate automatic prefix by bytes 
              // If wrong prefix given
              if (!array_key_exists($unit, $units)) {
                      $pow = floor(log($bytes)/log(1024));
                      $unit = array_search($pow, $units);
              }

              // Calculate byte value by prefix
              $value = ($bytes/pow(1024,floor($units[$unit])));
      }

      // If decimals is not numeric or decimals is less than 0 
      // then set default value
      if (!is_numeric($decimals) || $decimals < 0) {
              $decimals = 2;
      }

      // Format output
      return sprintf('%.' . $decimals . 'f '.$unit, $value);
}