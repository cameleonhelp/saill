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
            $root = strpos(ROOT,'/')!==false ? explode('/',ROOT) : explode('\\',ROOT);
            $last = count($root)-1;            
            if(count($this->History)==0){$this->History[] = str_replace('\\','/',FULL_BASE_URL.DS.$root[$last].DS.$url);} else{array_unshift($this->History, str_replace('\\','/',FULL_BASE_URL.DS.$root[$last].DS.$url));}
            $this->Session->write('history',$this->History);  
        }
    }
    
    public function lastUrl(){
        $this->History = $this->Session->read('history');
        if (count($this->Session->read('history')) > 0){
            $lastUrl = $this->History[0];
            $this->Session->write('history',$this->History); 
            array_shift($this->History);
        } else {
            $lastUrl = array();
        }        
        return $lastUrl;
    }    
    
    public function resetHistory(){
        $this->Session->delete('history');
    }
    
    public function getHistory(){
        return $this->Session->read('history');        
    }
    
    public function goToPostion($pos = 0){
        $url = $this->getHistory();
        $max = count($url)-1;
        $pos = ($pos > $max) ? $max : $pos;
        return $url[$pos];
    }
    
    public function afterFilter() {
        $this->addUrl();       
        parent::afterFilter();
    }
               
    public function beforeRender() {
        if($this->params['action']=='index') $this->resetHistory();
        parent::beforeRender();
    }
    
}
