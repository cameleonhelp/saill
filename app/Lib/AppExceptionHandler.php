<?php
class AppExceptionHandler {
    public static function handle($error) {
        echo 'Erreur ' . $error->getMessage();
    }
}
?>
