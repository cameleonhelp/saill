<table cellpadding="0" cellspacing="0" class="table table-hover table-bordered table-striped tablemax">
        <thead>
	<tr>
            <th><?php echo 'Historisé le'; ?></th>
			<th><?php echo 'Installé'; ?></th>
			<th><?php echo 'Date d\'installation'; ?></th>
			<th><?php echo 'Validé'; ?></th>
			<th><?php echo 'Date de validation'; ?></th>
			<th><?php echo 'Actif'; ?></th>
			<th><?php echo 'Date de modification actif'; ?></th>                        
			<th><?php echo 'Modifié par'; ?></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($histories as $history): ?>
	<tr>
            <td style="text-align:center;"><?php echo h($history['Historybien']['created']); ?></td>
                <?php $image = (isset($history['Historybien']['INSTALL']) && $history['Historybien']['INSTALL']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
		<td style="text-align:center;"><span class="glyphicons <?php echo $image; ?>"></span></td>
		<td style="text-align:center;"><?php echo h($history['Historybien']['DATEINSTALL']); ?></td>
                <?php $image = (isset($history['Historybien']['CHECK']) && $history['Historybien']['CHECK']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
		<td style="text-align:center;"><span class="glyphicons <?php echo $image; ?>"></span></td>
                <td style="text-align:center;"><?php echo h($history['Historybien']['DATECHECKINSTALL']); ?></td>
                <?php $image = (isset($history['Historybien']['ACTIF']) && $history['Historybien']['ACTIF']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
		<td style="text-align:center;"><span class="glyphicons <?php echo $image; ?>"></span></td>
                <td style="text-align:center;"><?php echo h($history['Historybien']['modified']); ?></td>
                <td style="text-align:center;"><?php echo h($history['Historybien']['MODIFYBY_NOM']); ?></td>
	</tr>
<?php endforeach; ?>
        </tbody>
</table>