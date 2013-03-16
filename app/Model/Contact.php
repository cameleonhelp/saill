<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contact
 *
 * @author JLR
 */
class Contact extends AppModel {
    var $useTable = false;
    var $_schema = array(
        'objet'		=>array('type'=>'string', 'length'=>100), 
        'email'		=>array('type'=>'string', 'length'=>255), 
        'message'	=>array('type'=>'text')
    );
}

?>
