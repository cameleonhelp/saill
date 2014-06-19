<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('EntitesController', 'Controller');
/**
 * Description of ContactsController
 * @version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class ContactsController extends AppController {
    public $components = array('History','Common');
    
    /**
     * Méthode permettant de fixer le titre de la page
     * 
     * @param string $title
     * @return string
     */
    public function set_title($title = null){
        $title = $title==null ? "Contacter votre administrateur" : $title;
        return $this->set('title_for_layout',$title); //$this->fetch($title);
    }      
    
    /**
     * Méthode permettant ici d'autoriser une méthode pour tous les utilisateurs
     */
    public function beforeFilter() {   
        $this->Auth->allow(array('add'));
        parent::beforeFilter();
    }   
    
    /**
     * envois d'un mail au contact désigné dans le centre de visibilité
     *
     * @return void
     */
    public function add() {
        $this->set_title();
        if ($this->request->is('post')) {
            if (isset($this->params['data']['cancel'])) :
                $this->History->goBack(1);
            else:            
                $this->Contact->set($this->data);
                $ObjEntites = new EntitesController();
                $mailto = $ObjEntites->get_contact(userAuth('entite_id'));
                $mailto = explode(';',$mailto);
                $from = Configure::read('mailapp');
                //send email using the Email component
                try{
                $email = new CakeEmail();
                $email->config('smtp')
                        ->emailFormat('html')
                        ->from($this->data['Contact']['EMAIL'])
                        ->to($mailto)
                        ->subject('SAILL : ' . $this->data['Contact']['OBJET']);
                if ($email->send("<b>De :</b> ".$this->data['Contact']['EMAIL']."<br><br><b>Message :</b><br><br>".$this->data['Contact']['MESSAGE'])) {
                    $this->Session->setFlash(__('Message envoyé avec succès',true),'flash_success');
                } else {
                    $this->Session->setFlash(__('Message <b>NON</b> envoyé',true),'flash_failure');
                }
                } catch(Exception $e){
                    $this->Session->setFlash(__('Erreur lors de l\'envois du mail - '.translateMailException($e->getMessage()),true),'flash_failure');
                }
               $this->redirect(array('action'=>'add'));
           endif;
        }
    }    

}

?>
