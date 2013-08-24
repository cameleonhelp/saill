<br/>
<div class="utiliseoutils index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo 'Outils'; ?></th>
			<th><?php echo 'Liste de diffusion'; ?></th>
                        <th><?php echo 'Partage'; ?></th>
                        <th width='70px'><?php echo 'Etat de la demande'; ?></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($utiliseoutils as $utiliseoutil): ?>
	<tr>
		<td><?php echo h($utiliseoutil['Outil']['NOM']); ?>&nbsp;</td>
                <td><?php echo h($utiliseoutil['Listediffusion']['NOM']); ?>&nbsp;</td>
                <td><?php echo h($utiliseoutil['Dossierpartage']['NOM']); ?>&nbsp;</td>
		<td style='text-align:center;'><span class="glyphicons <?php echo etatUtiliseOutilImage(h($utiliseoutil['Utiliseoutil']['STATUT'])); ?>" rel="tooltip" data-title="<?php echo h(h($utiliseoutil['Utiliseoutil']['STATUT'])); ?>"></span>&nbsp;</td>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
    </div>