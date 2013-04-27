<br/>
<div class="historyUtilisateur index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th width='85px'><?php echo 'Date'; ?></th>
                        <th><?php echo 'Historique'; ?></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($historyutilisateurs as $historyutilisateur): ?>
	<tr>
		<td style="text-align:center;"><?php echo h($historyutilisateur['Historyutilisateur']['created']); ?>&nbsp;</td>
                <td><?php echo h($historyutilisateur['Historyutilisateur']['HISTORIQUE']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
    </div>