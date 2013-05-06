<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $History = array();

    public $navigation=array('controller'=>'','action'=>'','page'=>'','sort'=>'','direction'=>'','here'=>'');
    
    public function addUrl(){
        if (strpos($this->params->url,'activeMessage')===false && !$this->isajax()){
            $this->History = $this->Session->read('history');
            $navigation['controller']=$this->params['controller'];
            $navigation['action']=$this->params['action'];
            $navigation['page']=isset($this->params['named']['page']) ? $this->params['named']['page']: null;
            $navigation['sort']=isset($this->params['named']['sort']) ? $this->params['named']['sort']: null;
            $navigation['direction']=isset($this->params['named']['direction']) ? $this->params['named']['direction'] : null;
            $navigation['here']=str_replace('\\','/',FULL_BASE_URL).str_replace('/%3C','',$this->params->here);
            
            $nottoadd = array('search','allupdate');
            if (in_array($this->params['action'],$nottoadd)):
                $navigation['here'] = str_replace($this->params['action'],'index',$navigation['here']);
                $navigation['action']='index';
            endif;
                       
            if(count($this->History)==0) :
                $this->History[] = $navigation;
            else :
                if (!$this->isUrlEqual($navigation)) :
                    array_unshift($this->History, $navigation);
                else :
                    $this->History[0]=$navigation;
                endif;
            endif;
            $this->Session->delete('history');
            $this->Session->write('history',$this->History);  
        }
    } 
    
    public function resetHistory(){
        $this->Session->delete('history');
    }
    
    public function removeUrl($nb=null){
        if(!$this->isajax()):
            $nb = $nb==null ? 1 : $nb;
            $this->History = $this->Session->read('history');
            if(count($this->History)>1):
                for ($i=0;$i<$nb;$i++):
                    @array_shift($this->History);
                endfor;
            endif;
            $this->Session->write('history',$this->History);
        endif;
    }
    
    public function goToBack(){
        $result = false;
        if (strpos($this->params->url,'activeMessage')===false):
              $result = (substr($this->params->url, -4, 4)=="/%3C");
        endif;
        return $result;
    }
    
    public function compareController(){
        $history = $this->getHistory();
        
        $result = strtolower($history[0]['controller'])==strtolower($this->params->controller) ? true : false ;
        return $result;
    }

    public function isUrlEqual($newurl){
        $history = $this->getHistory();
        $samecontroller = ($history[0]['controller']==$newurl['controller']);
        $sameaction = ($history[0]['action']==$newurl['action']);
        $samepage = ($history[0]['page']==$newurl['page']);
        $samesort = ($history[0]['sort']==$newurl['sort']);
        $samedirection = ($history[0]['direction']==$newurl['direction']);
        
        $result = ($samecontroller && $sameaction && $samepage && $samesort && $samedirection);
        return $result;
    }
    
    public function getHistory(){
        return $this->Session->read('history');        
    }
    
    public function goToPostion($pos = null){
        $url = $this->getHistory();
        $max = count($url)-1;
        $pos = $pos==null ? 0 : $pos;
        $pos = ($pos > $max) ? $max : ($pos <= 0) ? 0 : $pos;
        if ($pos > 1) { $this->removeUrl($pos); }
        return $url[$pos]['here'].'/<';
    }
                  
    public function beforeRender() {
        if($this->params['action']=='index' && !$this->compareController()){
            $this->Session->delete('history');
        }            
        if(($this->params['action']!='export_xls' || $this->params['action']!='export_doc') && !$this->goToBack()) :
            $this->addUrl();    
        elseif(($this->params['action']!='export_xls' || $this->params['action']!='export_doc') && $this->goToBack()) :
            $this->removeUrl();
        endif;
        parent::beforeRender();
    }
    
    public $components = array(
        'Session','Cookie','RequestHandler',
        'Auth' => array(
            'logoutRedirect' => array('controller' => 'Utilisateurs','action' => 'login'),
            'loginRedirect' => array('controller' => 'pages','action' => 'display','home'),
            'loginAction' => array('controller' => 'Utilisateurs','action' => 'login'),
            'authError' => 'Cette action n\'est pas autorisé pour votre profil ?',
            'authenticate' => array('Form' => array('userModel' => 'Utilisateurs')
            )
        )
    );
    
    public function isajax(){
        return $this->request->isAjax();
    }

    public function beforeFilter() {
        $this->Auth->allow(array('login','logout')); 
        if ($this->isajax()) $this->layout=null;
    }    
    
    public function autoriser($profil,$model,$action){
        $this->Autorisationsrecursive = -1;
        $autorisation = $this->Autorisations->find('first',array('conditions'=>array('Autorisation.profil_id'=>$profil,'Autorisation.MODEL'=>$model),'fields'=>array('Autorisation.'.$action)));
        $this->set('autorisation',$autorisation);
    }
    
}
