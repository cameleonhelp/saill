<?php
/**
 * Description of AppError
 *
 * version 3.0.1.002 le 28/05/2014 par Jacques LEVAVASSEUR
 */
class AppError extends ErrorHandler {
    function error404($params) {
        // redirect to homepage
        $this->Session->setFlash(__('<b>Erreur 404/b> : page inexistante',true),'flash_failure');
        $this->controller->redirect(array('controller' => 'pages','action' => 'display','home'));
    }
    
    function missing_controller($params) {
        // redirect to homepage
        $this->Session->setFlash(__('<b>Erreur 404/b> : controller inexistant',true),'flash_failure');
        $this->controller->redirect(array('controller' => 'pages','action' => 'display','home'));
    }    
}
