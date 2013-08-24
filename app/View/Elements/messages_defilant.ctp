<?php 
$activeMessages = $this->requestAction('messages/activeMessage');
$messages="";
if (isset($activeMessages)):
    foreach ($activeMessages as $activeMessage) {
            $messages .=  "<li><span class='glyphicons hand_right white'></span>&nbsp;".$activeMessage['Message']['LIBELLE']."</li>";            
    }
    echo $messages;
endif;
?>