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
App::uses('HistoryComponent', 'Component');
App::uses('ConnectionManager', 'Model');
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
   // public $History1 = array();
    
    //public $navigation=array('controller'=>'','action'=>'','page'=>'','sort'=>'','direction'=>'','here'=>'');

    public $components = array(
        'Session','History','Cookie','RequestHandler',
        'Auth' => array(
            'logoutRedirect' => array('controller' => 'Utilisateurs','action' => 'login'),
            'loginRedirect' => array('controller' => 'pages','action' => 'display','home'),
            'loginAction' => array('controller' => 'Utilisateurs','action' => 'login'),
            'authError' => 'Cette action n\'est pas autorisé pour votre profil ?',
            'authenticate' => array('Form' => array('userModel' => 'Utilisateurs'),
            )
        )
    );
         
    public function beforeRender() { 
        /*if($this->params['action']=='index' || $this->params['action']=='home' || $this->params['action']=='rapportagent' || $this->params['controller']=='pages' || $this->params['controller']=='dashboard' || $this->params['controller']=='risques' || $this->params['controller']=='rapports'|| $this->params['action']=='rapport' || $this->params['action']=='last7days'):
            $url = $this->params->here;
            $sql = "UPDATE utilisateurs SET LASTURL='".$url."' WHERE utilisateurs.id=".userAuth('id');
            $db = ConnectionManager::getDataSource('default');
            $db->rawQuery($sql);
        endif;      */  
        parent::beforeRender();
    }
    
    public function beforeRedirect($url, $status = null, $exit = true) {
        parent::beforeRedirect($url, $status, $exit);
    }
        
    public function isajax(){
        return $this->request->isAjax();
    }

    public function beforeFilter() {
        $this->Auth->allow(array('login','logout','mailprogressstate')); 
        if ($this->isajax()) $this->layout=null;
    }    
    
    public function autoriser($profil,$model,$action){
        $this->Autorisationsrecursive = -1;
        $autorisation = $this->Autorisations->find('first',array('conditions'=>array('Autorisation.profil_id'=>$profil,'Autorisation.MODEL'=>$model),'fields'=>array('Autorisation.'.$action)));
        $this->set('autorisation',$autorisation);
    }  
}
