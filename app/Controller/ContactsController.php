<?php
App::uses('CakeEmail', 'Network/Email');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContactsController
 *
 * @author JLR
 */
class ContactsController extends AppController {
    public $components = array('History','Common');
/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            if (isset($this->params['data']['cancel'])) :
                $this->History->goBack(1);
            else:            
                $this->Contact->set($this->data);
                $mailto = $this->requestAction('parameters/get_contact');
                $mailto = explode(';',$mailto['Parameter']['param']);
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
