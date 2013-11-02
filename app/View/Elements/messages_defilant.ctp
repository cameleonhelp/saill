<?php 
$activeMessages = $this->requestAction('messages/activeMessage');
$messages="";
if (isset($activeMessages)):
    foreach ($activeMessages as $activeMessage) {
            $messages .=  "<li>".$activeMessage['Message']['LIBELLE']."</li>";            
    }
    echo $messages;
endif;
?>