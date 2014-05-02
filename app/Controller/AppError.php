<?php
/**
 * Description of AppError
 *
 * version 3.0.1.001 le 25/04/2014 par Jacques LEVAVASSEUR
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
