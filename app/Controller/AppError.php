<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppError
 *
 * @author 6404901Z
 */
class AppError extends ErrorHandler {
    function error404($params) {
        // redirect to homepage
        $this->controller->redirect(array('controller' => 'pages','action' => 'display','home'));
    }
    
    function missing_controller($params) {
        // redirect to homepage
        $this->controller->redirect(array('controller' => 'pages','action' => 'display','home'));
    }    
}
