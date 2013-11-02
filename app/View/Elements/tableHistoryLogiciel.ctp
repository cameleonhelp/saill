<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped tablemax">
        <thead>
	<tr>
			<th><?php echo 'Installé'; ?></th>
                        <th><?php echo 'Date d\'installation'; ?></th>
                        <th><?php echo 'Bien'; ?></th>                        
			<th><?php echo 'Modifié par'; ?></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($histories as $history): ?>
	<tr>
                <?php $image = (isset($history['Historylogiciel']['INSTALL']) && $history['Historylogiciel']['INSTALL']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
		<td style="text-align:center;"><span class="glyphicons <?php echo $image; ?>"></span></td>            
		<td style="text-align:center;"><?php echo h($history['Historylogiciel']['DATEINSTALL']); ?></td>
                <td class="text-courrier"><?php echo h($history['Historylogiciel']['BIEN_NOM']); ?></td>
                <td><?php echo h($history['Historylogiciel']['MODIFYBY_NOM']); ?></td>
	</tr>
<?php endforeach; ?>
        </tbody>
</table>