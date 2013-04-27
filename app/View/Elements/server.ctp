<?php
    $srv = 'DEV'; 
    if($srv=='DEV') {
        echo '<div class="alert-devbox"  style="text-align:center !important;width:135px;margin-left:-22px;margin-top:10px;margin-bottom:-2px;">';
        echo __d('cake_dev', 'DEVELOPPEMENT');
        echo '</div>';	
    }
?>