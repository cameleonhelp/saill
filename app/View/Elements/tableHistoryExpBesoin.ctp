<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped tablemax">
        <thead>
	<tr>
			<th><?php echo 'Etat'; ?></th>
                        <th><?php echo 'Date de livraison'; ?></th>
			<th><?php echo 'Date de fin'; ?></th>
			<th><?php echo 'Modifié par'; ?></th>                      
	</tr>
        </thead>
        <tbody>
	<?php foreach ($histories as $history): ?>
	<tr>
		<td style="text-align:center;"><?php echo h($history['Etat']['NOM']); ?></td>  
		<td style="text-align:center;"><?php echo h($history['Historyexpb']['DATELIVRAISON']); ?></td>   
                <td style="text-align:center;"><?php echo h($history['Historyexpb']['DATEFIN']); ?></td>
                <td style="text-align:center;"><?php echo h($history['Historyexpb']['MODIFYBY_NOM']); ?></td>
	</tr>
<?php endforeach; ?>
        </tbody>
</table>