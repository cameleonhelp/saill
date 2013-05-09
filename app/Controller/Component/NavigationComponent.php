<?php
App::uses('Component', 'Controller');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NavigationComponent
 *
 * @author JLR
 */
class NavigationComponent extends Component {

    public $History = array();

    public $navigation=array('controller'=>'','action'=>'','page'=>'','sort'=>'','direction'=>'','pass'=>'','here'=>'');
    
    public function currentNavigation(){
            $navigation['controller']=$this->params['controller'];
            $navigation['action']=$this->params['action'];
            $navigation['page']=isset($this->params['named']['page']) ? $this->params['named']['page']: null;
            $navigation['sort']=isset($this->params['named']['sort']) ? $this->params['named']['sort']: null;
            $navigation['direction']=isset($this->params['named']['direction']) ? $this->params['named']['direction'] : null;
            $navigation['pass']=isset($this->params->pass) ? $this->params->pass : null;
            $completeURL = in_array($this->params['action'], explode('/',$this->params->here)) ? $this->params->here : $this->params->here.'/'.$this->params['action'];
            $navigation['here']=str_replace('\\','/',FULL_BASE_URL).str_replace('/%3C','',$completeURL); 
            return $navigation;
    }
    
    public function ajouterUrl() {
        if (strpos($this->params->url,'activeMessage')===false && !$this->isajax() && !$this->isException()){
            $this->History = $this->Session->read('history');
            
            $currentNav = $this->currentNavigation();
            
            $nottoadd = array('search','allupdate','export_xls','export_doc','addIndisponibilite');
            if (in_array($this->params['action'],$nottoadd)):
                $currentNav['here'] = $this->History[count($this->History)-1]['here'];
                $currentNav['action']='index';
            endif;
                       
            if(count($this->History)==0) :
                $this->History[] = $currentNav;
            else :
                if (!$this->isUrlEqual($currentNav)) :
                    array_unshift($this->History, $currentNav);
                else :
                    $this->History[0]=$currentNav;
                endif;
            endif;
            $this->Session->delete('history');
            $this->Session->write('history',$this->History);  
        }
    }
       
}

?>
