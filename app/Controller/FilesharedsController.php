<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'ical', array('file'=>'class.iCalReader.php'));
/**
 * Description of FilesharedsController
 *
 * @author JLR
 */
class FilesharedsController extends AppController {

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
            $this->Session->setFlash(__('Fichier partagé'),'default',array('class'=>'alert alert-success'));
        else :
            $this->Session->setFlash(__('Fichier <b>NON</b> reconnu <b>NON</b> partagé'),'default',array('class'=>'alert alert-error'));
        endif;
        $this->redirect(array('controller'=>'pages','action'=>'home'));
    }
    
    public function deletefile($name=null){
        if($name!=null):
            //$name = str_replace('+', '/', $name);
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
               $this->Session->setFlash(__('Fichier supprimé'),'default',array('class'=>'alert alert-success'));
            else  :
               $this->Session->setFlash(__('Fichier <b>INCONNU NON</b> supprimé'),'default',array('class'=>'alert alert-error')); 
            endif;
        else :
            $this->Session->setFlash(__('Fichier <b>INEXISTANT NON</b> supprimé'),'default',array('class'=>'alert alert-error'));
        endif;
        $this->redirect(array('controller'=>'pages','action'=>'home'));        
    }
    
    public function deleteicsfile($name=null){
        if($name!=null):
            $fileurl = realpath($name);           
            if(file_exists($fileurl)):
               unlink($fileurl);
            endif;
        endif;      
    }
    
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
            $this->inserticstodb($file);    
            $this->deleteicsfile($file);
            $this->Session->setFlash(__('Fichier pris en compte mais non intégré pour le moment fonctionnalité en cours de développement.'),'default',array('class'=>'alert alert-error'));
        else :
            $this->Session->setFlash(__('Fichier <b>NON</b> reconnu'),'default',array('class'=>'alert alert-error'));
        endif;
        $this->redirect(array('controller'=>'activitesreelles','action'=>'index','tous',userAuth('id'),date('m')));        
    }
    
    public function inserticstodb($file=null){
        $ical = new ical($file);
        $events = $ical->events($file);
        //debug($events[12]);
        foreach($events as $event):
            $myevent[]= array('DTSTART'=>$ical->iCalDateUS($event['DTSTART']),'DTEND'=>$ical->iCalDateUS($event['DTEND']),'SUMMARY'=>$event['SUMMARY']);
        endforeach;
        //debug($myevent);
        //exit();
    }
}

?>
