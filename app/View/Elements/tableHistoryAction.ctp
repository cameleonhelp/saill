<?php
function styleBarre($avancement){
    $result = '';
    switch ($avancement){
        case '10':
        case '20':
        case '30':            
            $result = 'danger';
            break;
        case '40':
        case '50':           
        case '60':
            $result = 'warning';
            break;
        case '70':
        case '80':
        case '90':
            $result = 'info';
            break;
        case '100':
            $result = 'success';
            break;        
    }
    return $result;
}

    function etatAction($etat) {
        $class = '';
        switch ($etat){
             case 'à faire':
                $class = 'icon-tag icon-red';
                break;
             case 'en cours':
                $class = 'icon-tag';
                break;                
             case 'livrée':
                $class = 'icon-inbox icon-green';
                break;          
             case 'terminée':
                $class = 'icon-tag icon-green';
                break;         
             case 'annulée':
                $class = 'icon-remove icon-red';
                break;                 
        }
        return $class;
    } 
    
    function etatTooltip($etat) {
        $tooltip = '';
        switch ($etat){
             case 'à faire':
                $tooltip = 'À faire';
                break;
             case 'en cours':
                $tooltip = 'En cours';
                break;                
             case 'livrée':
                $tooltip = 'Livrée';
                break;          
             case 'terminée':
                $tooltip = 'Terminée';
                break;         
             case 'annulée':
                $tooltip = 'Annulée';
                break;                 
        }
        return $tooltip;
    }     
?>
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo 'Avancement'; ?></th>
			<th width='90px'><?php echo 'Date de début prévue'; ?></th>
			<th width='50px'><?php echo 'Charge prévue'; ?></th>
			<th width='90px'><?php echo 'Echéance'; ?></th>
			<th width='90px'><?php echo 'Date de début réelle'; ?></th>
			<th width='50px'><?php echo 'Charge réelle'; ?></th>
			<th width='60px'><?php echo 'Statut'; ?></th>
			<th><?php echo 'Priorité'; ?></th>
                        <th width='20px'></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($histories as $history): ?>
	<tr>
		<?php $style = styleBarre(h($history['Historyaction']['AVANCEMENT'])); ?>
                <td><div class="progress progress-<?php echo $style; ?>" style="margin-bottom:-10px;">
                <div class="bar " style="width:<?php echo h($history['Historyaction']['AVANCEMENT']); ?>%;" rel="tooltip" title="Avancement à : <?php echo h($history['Historyaction']['AVANCEMENT']); ?>%"></div></div></td>
		<td style="text-align:center;"><?php echo h($history['Historyaction']['DEBUT']); ?>&nbsp;</td>
		<td style="text-align:center;"><?php echo h($history['Historyaction']['CHARGEPREVUE']); ?> h</td>
                <td style="text-align:center;"><?php echo h($history['Historyaction']['ECHEANCE']); ?>&nbsp;</td>
		<td style="text-align:center;"><?php echo h($history['Historyaction']['DEBUTREELLE']); ?></td>
		<td style="text-align:center;"><?php echo h($history['Historyaction']['CHARGEREELLE']); ?> h</td>
		<td style="text-align:center;"><?php echo isset($history['Historyaction']['STATUT']) ? '<i class="'.etatAction(h($history['Historyaction']['STATUT'])).'" rel="tooltip" data-title="'.etatTooltip(h($history['Historyaction']['STATUT'])).'"></i>' : '' ; ?>&nbsp;</td>                
		<td style="text-align:center;"><?php echo h($history['Historyaction']['PRIORITE']); ?>&nbsp;</td>
                <td><?php echo '<i class="icon-eye-open" rel="popover" data-title="<h3>Historique de l\'action :</h3>" data-content="<contenttitle>Commentaire: </contenttitle>'.h($history['Historyaction']['COMMENTAIRE']).'<br/><contenttitle>Crée le: </contenttitle>'.h($history['Historyaction']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($history['Historyaction']['modified']).'" data-trigger="click" style="cursor: pointer;"></i>'; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
        </tbody>
</table>