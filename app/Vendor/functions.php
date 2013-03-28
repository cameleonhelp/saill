<?php
App::uses('AppModel', 'Model', 'Autorisation');
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
 * endWeek
 * 
 * @param type $year
 * @param type $month
 * @param type $day
 * @return dateTime
 */    
    function endWeek($date) {
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
    
/**
 * userAuth
 * 
 * @param type $key
 * @return Variable de session user
 */    
    function userAuth($key = null){
        $user = SessionComponent::read('Auth.User');
        if ($key === null) {
            return $user;
        } else {
            return $user[$key];
        }
        
    }
    
    @define(AUTHORIZED, 'Auth.Profil');
    
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
                        default:
                            $result = false;
                            break;                    
                    endswitch;
                endif;           
            endforeach;
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
                    $class = 'icon-edit icon-red';
                    break;
                 case 'en cours':
                    $class = 'icon-edit';
                    break;                
                 case 'livré':
                    $class = 'icon-share';
                    break;          
                 case 'validé':
                    $class = 'icon-check icon-green';
                    break;  
                 case 'refusé':
                    $class = 'icon-share icon-red';
                    break;          
                 case 'annulé':
                    $class = 'icon-remove icon-red';
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
                   $class = 'icon-inbox';
                   break;
                case 'En dotation':
                   $class = 'icon-lock';
                   break;                
                case 'En réparation':
                   $class = 'icon-wrench';
                   break;          
                case 'Au rebut':
                   $class = 'icon-trash icon-grey';
                   break;
                case 'Non localisé':
                   $class = 'icon-map-marker icon-red';
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
       function etatUtiliseOutilImage($etat) {
           $class = '';
           switch ($etat){
                case 'Demandé':
                   $class = 'icon-envelope';
                   break;
                case 'Pris en compte':
                   $class = 'icon-flag';
                   break;                
                case 'En validation':
                   $class = 'icon-bookmark icon-grey';
                   break;          
                case 'Validé':
                   $class = 'icon-bookmark icon-green';
                   break;
                case 'Demande transférée':
                   $class = 'icon-share-alt';
                   break;                
                case 'Demande traitée':
                   $class = 'icon-ok';
                   break;
                case 'Retour utilisateur':
                   $class = 'icon-ok icon-green';
                   break;                
                case 'A supprimer':
                   $class = 'icon-remove';
                   break;          
                case 'Supprimée':
                   $class = 'icon-remove icon-red';
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
    }
    return $result;
}

    function etatAction($etat) {
        $class = '';
        switch ($etat){
             case 'à faire':
                $class = 'icon-tag icon-red';
                break;
             case 'en cours':
                $class = 'icon-tag';
                break;                
             case 'livrée':
                $class = 'icon-inbox icon-green';
                break;          
             case 'terminée':
                $class = 'icon-tag icon-green';
                break;         
             case 'annulée':
                $class = 'icon-remove icon-red';
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
?>
