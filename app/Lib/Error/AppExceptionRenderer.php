<?php
App::uses('ExceptionRenderer', 'Error');

class AppExceptionRenderer extends ExceptionRenderer {
    public function NotAuthorizedException($error) {
        echo "Vous n'êtes pas autorisé à utiliser cette fonctionnalité de l'outil";
    }
}
?>
