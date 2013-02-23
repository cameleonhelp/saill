<br/>
<div class="historyUtilisateur index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th width='85px'><?php echo 'Date'; ?></th>
			<th><?php echo 'Utilisateur'; ?></th>
                        <th><?php echo 'Historique'; ?></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($utiliseoutils as $utiliseoutil): ?>
	<tr>
		<td style="text-align:center;"><?php echo h($utiliseoutil['Outil']['NOM']); ?>&nbsp;</td>
                <td><?php echo h($utiliseoutil['Listediffusion']['NOM']); ?>&nbsp;</td>
                <td><?php echo h($utiliseoutil['Dossierpartage']['NOM']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
    </div>