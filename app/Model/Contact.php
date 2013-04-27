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
        'OBJET'		=>array('type'=>'string', 'length'=>255), 
        'EMAIL'		=>array('type'=>'string', 'length'=>255), 
        'MESSAGE'	=>array('type'=>'text')
    );
}

?>
