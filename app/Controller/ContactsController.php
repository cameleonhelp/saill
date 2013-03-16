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

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->Contact->set($this->data);
            //send email using the Email component
            $email = new CakeEmail();
            $email->config('gmail');
            $email->emailFormat('html');
            $email->from($this->data['Contact']['email']);
            $email->to('j.levavasseur@gmail.com');
            $email->subject('OSACT : ' . $this->data['Contact']['objet']);
            if ($email->send($this->data['Contact']['message'])) {
                $this->Session->setFlash(__('Message envoyé avec succès'),'default',array('class'=>'alert alert-success'));
            } else {
                $this->Session->setFlash(__('Message <b>NON</b> envoyé'),'default',array('class'=>'alert alert-error'));
            }
            
        }
    }    
}

?>
