<br/>
<div class="utiliseoutils index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover tablemax">
        <thead>
	<tr>
			<th><?php echo 'Echéance'; ?></th>
			<th><?php echo 'Date de livraison'; ?></th>
                        <th><?php echo 'Date de validation'; ?></th>
                        <th width='70px'><?php echo 'Etat'; ?></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($Suivilivrables as $Suivilivrable): ?>
            <tr>
		<td><?php echo h($Suivilivrable['Suivilivrable']['ECHEANCE']); ?>&nbsp;</td>
                <td><?php echo h($Suivilivrable['Suivilivrable']['DATELIVRAISON']); ?>&nbsp;</td>
                <td><?php echo h($Suivilivrable['Suivilivrable']['DATEVALIDATION']); ?>&nbsp;</td>
                <td style='text-align:center;'><span class="glyphicons <?php echo etatLivrable(h($Suivilivrable['Suivilivrable']['ETAT'])); ?>" rel="tooltip" data-title="<?php echo h($Suivilivrable['Suivilivrable']['ETAT']); ?>"></span>&nbsp;</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
	</table>
    </div>