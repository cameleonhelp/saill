<?php

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
        if ($this->RequestHandler->isPost()) {
            $this->Contact->set($this->data);
            if ($this->Contact->validates()) {
                //send email using the Email component
                $this->Email->to = 'admin@example.com';  
                $this->Email->subject = 'Contact message from ' . $this->data['Contact']['name'];  
                $this->Email->from = $this->data['Contact']['email'];  

                $this->Email->send($this->data['Contact']['details']);
            }
        }
    }    
}

?>
