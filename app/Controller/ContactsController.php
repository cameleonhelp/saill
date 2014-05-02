<?php
App::uses('CakeEmail', 'Network/Email');
App::import('Controller', 'Entites');
/**
 * Description of ContactsController
 * @version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
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
 * add method
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
