<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'ICal', array('file'=>'class.iCalReader.php'));
App::uses('ActivitesController', 'Controller');
App::uses('ActivitesreellesController', 'Controller');

/**
 * Description of FilesharedsController
 *
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class FilesharedsController extends AppController {
    /**
     * variables globales utilisées au niveau du controller
     */
    public $components = array('History','Common');
    
    /**
     * upload d'un fichier
     */
    public function shared(){
        $file = isset($this->data['Fileshared']['file']['name']) ? $this->data['Fileshared']['file']['name'] : '';
        $file_type = strrchr($file,'.');
        if($this->data['Fileshared']['file']['tmp_name']!='' && in_array($file_type, array('.doc','.docx','.pdf','.ppt','.xls','.pptx','.xlsx'))):
            $path = $this->data['Fileshared']['with']=="all" ? 'all' : 'admin';
            $completpath = WWW_ROOT.DS.'files'.DS.$path;
            if(file_exists($completpath) && is_dir($completpath)):
               move_uploaded_file($this->data['Fileshared']['file']['tmp_name'],$completpath.DS.$this->data['Fileshared']['file']['name']);  
            elseif(mkdir($completpath,0777)) :
             move_uploaded_file($this->data['Fileshared']['file']['tmp_name'],$completpath.DS.$this->data['Fileshared']['file']['name']);  
            endif;
            $this->Session->setFlash(__('Fichier partagé',true),'flash_success');
        else :
            $this->Session->setFlash(__('Fichier <b>NON</b> reconnu <b>NON</b> partagé',true),'flash_failure');
        endif;
        $this->redirect(array('controller'=>'pages','action'=>'home'));
    }
    
    /**
     * suppression du fichier
     * 
     * @param string $name
     */
    public function deletefile($name=null){
        if($name!=null):
            $name = str_replace('..','.',$name);
            $name = explode('+',$name);
            $path =  '';
            for($i=0;$i<count($name)-1;$i++):
                if ($path == ''):
                    $path = $name[$i];
                else :
                    $path .= DS.$name[$i]; 
                endif;
            endfor;
            $fileurl = realpath($path).DS.$name[count($name)-1];
            if(file_exists($fileurl)):
               unlink($fileurl);
               $this->Session->setFlash(__('Fichier supprimé',true),'flash_success');
            else  :
               $this->Session->setFlash(__('Fichier <b>INCONNU NON</b> supprimé',true),'flash_failure'); 
            endif;
        else :
            $this->Session->setFlash(__('Fichier <b>INEXISTANT NON</b> supprimé',true),'flash_failure');
        endif;
        $this->redirect(array('controller'=>'pages','action'=>'home'));        
    }
    
    /**
     * suppression du fichier ics pour ne pas garder de trace et surcharger le serveur
     * 
     * @param string $name
     */
    public function deleteicsfile($name=null){
        if($name!=null):
            $fileurl = realpath($name);           
            if(file_exists($fileurl)):
               unlink($fileurl);
            endif;
        endif;      
    }
    
    /**
     * parse le fichier ICS pour mettre les indisponibilités en feuille de temps
     */
    public function parseICS(){
        $file = isset($this->data['Fileshared']['file']['name']) ? $this->data['Fileshared']['file']['name'] : '';
        $file_type = strrchr($file,'.');

        if($this->data['Fileshared']['file']['tmp_name']!='' && $file_type=='.ics'):
            $path = 'icsfiles';
            $completpath = WWW_ROOT.'files'.DS.$path;
            if(file_exists($completpath) && is_dir($completpath)):
                move_uploaded_file($this->data['Fileshared']['file']['tmp_name'],$completpath.DS.userAuth('id').'_'.$this->data['Fileshared']['file']['name']);  
            elseif(mkdir($completpath,0777)) :
                move_uploaded_file($this->data['Fileshared']['file']['tmp_name'],$completpath.DS.userAuth('id').'_'.$this->data['Fileshared']['file']['name']);  
            endif;                
            $file = $completpath.DS.userAuth('id').'_'.$this->data['Fileshared']['file']['name'];
            $this->inserticstodb($file,$this->data['Fileshared']['utilisateur_id']);    
            $this->deleteicsfile($file);
            $this->Session->setFlash(__('Fichier pris en compte et intégré dans l\'outil.',true),'flash_success');
        else :
            $this->Session->setFlash(__('Fichier <b>NON</b> reconnu',true),'flash_failure');
        endif;
        $this->redirect(array('controller'=>'activitesreelles','action'=>'index','tous',userAuth('id'),date('m')));        
    }
    
    /**
     * insertion en base des indisponibilités trouvées dans le fichier ICS
     * 
     * @param string $file
     * @param int $utilisateur_id
     */
    public function inserticstodb($file=null,$utilisateur_id){
        $ical = new ICal($file);
        $events = $ical->events($file);
        //pour chaque evenement on recupére la date de départ, le type d'indisponibilité, le nombre de jours et en cas de congé si matin(0) ou aprés midi(1)
        foreach($events as $event):
            $summary = substr($event['SUMMARY'],0,1) !='C' ? substr($event['SUMMARY'],0,2) : substr($event['SUMMARY'],0,1);
            $delais = $ical->iCalDelais($event['DTSTART'],$event['DTEND']);
            $types = $ical->iCalType($event['DTSTART'],$event['DTEND'],$event['SUMMARY']);
            $myevents[]= array('DSTART'=>$ical->iCalDateUSOnly($event['DTSTART']),'INDISPONIBILITE'=>$summary,'DELAIS'=>$delais,'TYPES'=>$types);
        endforeach;
        //on structure un tableau pour chaque jour d'indisponibilité avec la date de début de semaine, l'activité, l'utilisateur, le jour et le type
        foreach ($myevents as $event):
            $date = new DateTime($event['DSTART']. '00:00:00');
            for($i=0;$i<$event['DELAIS'];$i++):
                $type = $i==0 ? $event['TYPES']['start'] : $i==$event['DELAIS']-1 ? $event['TYPES']['end'] : 1;
                $nb = 1;
                $nb = $i==0 ? $event['TYPES']['dureestart'] : $i==$event['DELAIS']-1 ? $event['TYPES']['dureeend'] : 1;
                $days = array('1'=>'LU','2'=>'MA','3'=>'ME','4'=>'JE','5'=>'VE','6'=>'SA','7'=>'DI');
                //JLR :: on ne rajoute pas les jours fériés et les week end
                if($date->format('N')<6 && !isFerie($date)):
                    $ObjActivites = new ActivitesController();
                    $activite_id = $ObjActivites->getId($event['INDISPONIBILITE']);
                    if(count($activite_id)>0):
                        $allindispos[] = array("id"=>CIntDate(startWeek($date->format('Y-m-d'))),"DATE"=>startWeek($date->format('Y-m-d')),"DAY"=>$days[$date->format('N')],"TYPE"=>$type,"ACTIVITE"=>$activite_id['Activite']['id'],'utilisateur_id'=>$utilisateur_id,'DUREE'=>$nb);
                    endif;
                endif;
                $date->add(new DateInterval('P1D'));
            endfor;
        endforeach;
        // pour chaque ligne on insert en base à partir de la méthode icsImport de Activitesreelles
        aasort($allindispos, 'id');
        $ObjActivitereelles = new ActivitesreellesController();
        foreach($allindispos as $indispo):
            $ObjActivitereelles->icsImport($indispo['utilisateur_id'],$indispo['ACTIVITE'],$indispo['DATE'],$indispo['DAY'],$indispo['TYPE'],$indispo['DUREE']);
        endforeach;
    }
    
}

?>
