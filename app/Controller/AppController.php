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

    public function addUrl(){
        if (strpos($this->params->url,'activeMessage')===false){
            $this->History = $this->Session->read('history');
            $url = ucfirst($this->params->url);
            $pos = @strpos('/index/', $url);   
            $nottoadd = array('search','allupdate');
            $url = in_array($this->params['action'],$nottoadd)  ? str_replace($this->params['action'],'index',$url) : $url;
            $exist = in_array('index',explode('/',$url));
            $url = ($this->params['action']=='index' && !$exist) ? $url.'/index' : $url;
            $root = strpos(ROOT,'/')!==false ? explode('/',ROOT) : explode('\\',ROOT);
            $last = count($root)-1;            
            if(count($this->History)==0) :
                $this->History[] = str_replace('\\','/',FULL_BASE_URL.DS.$root[$last].DS.$url);
            else :
                $newurl = str_replace('\\','/',FULL_BASE_URL.DS.$root[$last].DS.$url);
                if (!$this->isUrlEqual($newurl)) :
                    array_unshift($this->History, $newurl);
                else :
                    $this->History[0]=$newurl;
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
        $nb = $nb==null ? 1 : $nb;
        $this->History = $this->Session->read('history');
        if(count($this->History)>1):
            for ($i=0;$i<$nb;$i++):
                @array_shift($this->History);
            endfor;
        endif;
        $this->Session->write('history',$this->History);
    }
    
    public function goToBack(){
        $result = false;
        if (strpos($this->params->url,'activeMessage')===false):
            if(isset($this->params->pass[0])):
                $nbPass = count($this->params->pass)>0 ? count($this->params->pass)-1 : 0;
                $lastPass = $this->params->pass[$nbPass];
                $result = $lastPass=="<" ? true : false;
            endif;
        endif;
        return $result;
    }
    
    public function compareController(){
        $result = false;
        $history = $this->getHistory();
        $start = count($this->getHistory())> 1 ? count($this->getHistory())-1 : 0;
        $url2 = explode('/',$history[$start]);
        if (isset($url2[4])):
            $result = strtolower($url2[4])==strtolower($this->params->controller) ? true : false ;
        endif;
        return $result;
    }

    public function isUrlEqual($newurl){
        $history = $this->getHistory();
        $url2 = explode('/',$history[0]);
        $newurl2 = explode('/',$newurl);
        $samecontroller = strtolower((string)$url2[4])===strtolower((string)$newurl2[4]);
        $sameaction = strtolower((string)$url2[5])===strtolower((string)$newurl2[5]);
        $result = $samecontroller && $sameaction;
        return $result;
    }
    
    public function getHistory(){
        return $this->Session->read('history');        
    }
    
    public function goToPostion($pos = null){
        $url = $this->getHistory();
        $max = count($url)-1;
        $pos = $pos==null ? $max-1 : $pos;
        $pos = ($pos > $max) ? $max-1 : ($pos <= 0) ? 0 : $pos;
        if ($pos > 1) { $this->removeUrl($pos); }
        return $url[$pos].'/<';
    }
    
    public function afterFilter() {

        parent::afterFilter();
    }
               
    public function beforeRender() {
        if($this->params['action']=='index' && !$this->compareController()){
            $this->Session->delete('history');
        }            
        //if($this->params['action']=='export_xls') $this->resetHistory();
        if($this->params['action']!='export_xls' && !$this->goToBack()) :
            $this->addUrl();     
        elseif($this->params['action']!='export_xls' && $this->goToBack()) :
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

    public function beforeFilter() {
        $this->Auth->allow(array('login','logout')); 
        if ($this->request->isAjax()) $this->layout=null;
    }    
    
    public function autoriser($profil,$model,$action){
        $this->Autorisationsrecursive = -1;
        $autorisation = $this->Autorisations->find('first',array('conditions'=>array('Autorisation.profil_id'=>$profil,'Autorisation.MODEL'=>$model),'fields'=>array('Autorisation.'.$action)));
        $this->set('autorisation',$autorisation);
    }
    
}
