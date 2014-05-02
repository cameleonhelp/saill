<?php
App::uses('Controller', 'Controller');
App::uses('HistoryComponent', 'Component');
App::uses('ConnectionManager', 'Model');
/**
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
 */
class AppController extends Controller {

    /**
     * Déclaration des components
     */
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
         
    /**
     * Méthode utilisée avant le retour sur la page
     */
    public function beforeRender() {  
        $url = "/".$this->params->url;
        $this->Session->write('Auth.redirect', $url);           
        parent::beforeRender();
    }
    
    /**
     * Méthode appelée avant la redirection de la page
     * 
     * @param type $url
     * @param type $status
     * @param boolean $exit
     */
    public function beforeRedirect($url, $status = null, $exit = true) {
        parent::beforeRedirect($url, $status, $exit);
    }
        
    /**
     * Méthode testant si on utilise de l'ajax
     * 
     * @return boolean
     */
    public function isajax(){
        return $this->request->isAjax();
    }

    /**
     * Méthode qui autorise l'utilisation des méthode sans autorisation particulière
     */
    public function beforeFilter() {
        $this->Auth->allow(array('login','logout','mailprogressstate')); 
        if ($this->isajax()) $this->layout=null;
    }    
    
    /**
     * Méthode qui test les autorisations en fonction du profil de l'utilisateur
     * 
     * @param int $profil
     * @param string $model
     * @param string $action
     */
    public function autoriser($profil,$model,$action){
        $this->Autorisationsrecursive = -1;
        $autorisation = $this->Autorisations->find('first',array('conditions'=>array('Autorisation.profil_id'=>$profil,'Autorisation.MODEL'=>$model),'fields'=>array('Autorisation.'.$action)));
        $this->set('autorisation',$autorisation);
    }  
}
