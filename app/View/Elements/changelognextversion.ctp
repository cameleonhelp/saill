<div class="bs-callout bs-callout-info">
<?php
    if (isset($nextversion[0])):
        $version = 'la v. '.$nextversion[0]['Changelogversion']['VERSION'].', elle  ';
        $date = "devrait être disponible le ".$nextversion[0]['Changelogversion']['DATEPREVUE'];   
    else:
        $version = '';
        $date = "non planifiée à ce jour";
    endif;
?>
<h4><small>Information</small></h4>
    La disponibilité de la prochaine version est <?php echo $version; ?><?php echo $date; ?>.
</div>  