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
        $this->Session->delete('history');
        if ($this->request->is('post')) {
            $this->Contact->set($this->data);
            //send email using the Email component
            $email = new CakeEmail();
            //$email->config('gmail');
            $email->config('exchange');
            $email->emailFormat('html');
            $email->from($this->data['Contact']['EMAIL']);
            $email->to('jacques.levavasseur@sncf.fr');
            $email->subject('OSACT : ' . $this->data['Contact']['OBJET']);
            if ($email->send($this->data['Contact']['MESSAGE'])) {
                $this->Session->setFlash(__('Message envoyé avec succès'),'default',array('class'=>'alert alert-success'));
            } else {
                $this->Session->setFlash(__('Message <b>NON</b> envoyé'),'default',array('class'=>'alert alert-error'));
            }
            
        }
    }    
}

?>
