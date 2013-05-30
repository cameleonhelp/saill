<?php
    $srv = $this->requestAction('parameters/get_instance'); 
    if(strtoupper($srv['Parameter']['param'])=='DEV') {
        echo '<div class="alert-devbox"  style="text-align:center !important;width:135px;margin-left:-22px;margin-top:10px;margin-bottom:-2px;">';
        echo __d('cake_dev', 'DEVELOPPEMENT');
        echo '</div>';	
    }
    if(strtoupper($srv['Parameter']['param'])=='DEMO') {
        echo '<div class="alert-devbox"  style="text-align:center !important;width:135px;margin-left:-22px;margin-top:10px;margin-bottom:-2px;">';
        echo __d('cake_dev', 'DEMONSTRATION');
        echo '</div>';	
    }   
    if(strtoupper($srv['Parameter']['param'])=='200') {
        echo '<div class="alert-devbox"  style="text-align:center !important;width:135px;margin-left:-22px;margin-top:10px;margin-bottom:-2px;">';
        //$version = $this->requestAction('Parameters/get_version');
        echo __d('cake_dev', 'DEVELOPPEMENT');
        echo '</div>';	
    }         
?>