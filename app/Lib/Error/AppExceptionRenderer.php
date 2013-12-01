<?php
App::uses('ExceptionRenderer', 'Error');

class AppExceptionRenderer extends ExceptionRenderer {
    public function NotAuthorizedException($error=null) {
        $this->set('title_for_layout','Erreur d\'autorisation');
        echo "Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil";
        exit();
    }
}
?>
