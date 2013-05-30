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
    public $components = array('History');
/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->Contact->set($this->data);
            $mailto = $this->requestAction('parameters/get_contact');
            $mailto = explode(';',$mailto['Parameter']['param']);
            //send email using the Email component
            $email = new CakeEmail();
            $email->config('smtp')
                    ->emailFormat('html')
                    ->from($this->data['Contact']['EMAIL'])
                    ->to($mailto)
                    ->subject('SAILL : ' . $this->data['Contact']['OBJET']);
            if ($email->send("<b>De :</b> ".$this->data['Contact']['EMAIL']."<br><br><b>Message :</b><br><br>".$this->data['Contact']['MESSAGE'])) {
                $this->Session->setFlash(__('Message envoyé avec succès'),'default',array('class'=>'alert alert-success'));
            } else {
                $this->Session->setFlash(__('Message <b>NON</b> envoyé'),'default',array('class'=>'alert alert-error'));
            }
           $this->redirect(array('action'=>'add'));
        }
    }    
}

?>
