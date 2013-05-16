<?php
    $srv = '200'; 
    if($srv=='DEV') {
        echo '<div class="alert-devbox"  style="text-align:center !important;width:135px;margin-left:-22px;margin-top:10px;margin-bottom:-2px;">';
        echo __d('cake_dev', 'DEVELOPPEMENT');
        echo '</div>';	
    }
    if($srv=='DEMO') {
        echo '<div class="alert-devbox"  style="text-align:center !important;width:135px;margin-left:-22px;margin-top:10px;margin-bottom:-2px;">';
        echo __d('cake_dev', 'DEMONSTRATION');
        echo '</div>';	
    }   
    if($srv=='200') {
        echo '<div class="alert-devbox"  style="text-align:center !important;width:135px;margin-left:-22px;margin-top:10px;margin-bottom:-2px;">';
        echo __d('cake_dev', 'DEV V2.0.0');
        echo '</div>';	
    }         
?>