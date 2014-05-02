<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped tablemax">
        <thead>
	<tr>
                        <th width="5px">&nbsp;</th>
			<th><?php echo 'Avancement'; ?></th>
			<th width='90px'><?php echo 'Date de début prévue'; ?></th>
			<th width='50px'><?php echo 'Charge prévue'; ?></th>
			<th width='90px'><?php echo 'Echéance'; ?></th>
			<th width='60px'><?php echo 'Statut'; ?></th>
			<th width='60px'><?php echo 'Priorité'; ?></th>
                        <th width='20px'></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($histories as $history): ?>
	<tr>
                <?php $tooltip = $history['Historyaction']['NIVEAU'] != null ? 'Risque identifié de niveau '.$history['Historyaction']['NIVEAU'].' / 5' : 'Aucun risque identifié' ; ?>
                <td style="background-color:<?php echo colorNiveauRisque($history['Historyaction']['NIVEAU']) ?>"><span class="cursor" rel='tooltip' data-title="<?php echo $tooltip; ?>">&nbsp;</span></td>
		<?php $style = styleBarre(h($history['Historyaction']['AVANCEMENT'])); ?>
                <td>
                    <div class="progress nomargin">
                      <div class="progress-bar progress-bar-<?php echo $style; ?>" style="width: <?php echo h($history['Historyaction']['AVANCEMENT']); ?>%;" rel="tooltip" title="Avancement à : <?php echo h($history['Historyaction']['AVANCEMENT']); ?>%"></div>
                    </div>                    
                </td>
		<td style="text-align:center;"><?php echo h($history['Historyaction']['DEBUT']); ?></td>
		<td style="text-align:center;"><?php echo h($history['Historyaction']['CHARGEPREVUE']); ?> h</td>
                <td style="text-align:center;"><?php echo h($history['Historyaction']['ECHEANCE']); ?></td>
		<td style="text-align:center;"><?php echo isset($history['Historyaction']['STATUT']) ? '<span class="glyphicons '.etatAction(h($history['Historyaction']['STATUT'])).'" rel="tooltip" data-title="'.etatTooltip(h($history['Historyaction']['STATUT'])).'"></span>' : '' ; ?></td>                
		<td style="text-align:center;"><?php echo h($history['Historyaction']['PRIORITE']); ?></td>
                <td><?php echo '<span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Historique de l\'action :</h3>" data-placement="left" data-content="<contenttitle>Commentaire: </contenttitle>'.h($history['Historyaction']['COMMENTAIRE']).'<br/><contenttitle>Crée le: </contenttitle>'.h($history['Historyaction']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($history['Historyaction']['modified']).'" data-trigger="click" style="cursor: pointer;"></span>'; ?></td>
	</tr>
<?php endforeach; ?>
        </tbody>
</table>