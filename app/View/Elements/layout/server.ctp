<?php
    $srv = $this->requestAction('parameters/get_instance'); 
    if(strtoupper($srv['Parameter']['param'])=='DEV' || strtoupper($srv['Parameter']['param'])=='INT' || strtoupper($srv['Parameter']['param'])=='FORM') {
        echo '<div class="alert-box alert-devbox pull-right"  style="text-align:center !important;margin-top:10px;margin-bottom:10px;display:block">';
        echo __d('cake_dev', $srv['Parameter']['param']);
        echo '</div>';	
    }
    if(strtoupper($srv['Parameter']['param'])=='DEMO' || strtoupper($srv['Parameter']['param'])=='BAC') {
        echo '<div class="alert-box alert-demobox pull-right"  style="text-align:center !important;margin-top:10px;margin-bottom:10px;display:block">';
        echo __d('cake_dev', $srv['Parameter']['param']);
        echo '</div>';	
    }           
?>