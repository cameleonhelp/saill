	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover tablemax">
	<tr>
                        <th><?php echo 'Nom'; ?></th>
                        <th><?php echo 'Usage'; ?></th>
                        <th><?php echo 'Coeur'; ?></th>
                        <th><?php echo 'Coeur logiciel'; ?></th>
                        <th><?php echo 'PVU'; ?></th>
                        <th><?php echo 'Mémoire'; ?></th>
                        <th><?php echo 'Modèle'; ?></th>
                        <th><?php echo 'Chassis'; ?></th>
	</tr>
	<?php foreach ($biens as $bien): ?>
	<tr>
            <td class="text-courrier"><?php echo $bien['Bien']['NOM']; ?></td>
            <td><?php echo $bien['Bien']['USAGE_NOM']; ?></td>
            <td><?php echo $bien['Bien']['COEUR']; ?></td>
            <td><?php echo $bien['Bien']['COEURLICENCE']; ?></td>
            <td><?php echo $bien['Bien']['PVU']; ?></td>
            <td><?php echo $bien['Bien']['RAM'].' Mo'; ?></td>
            <td><?php echo $bien['Bien']['MODELE_NOM']; ?></td>
            <td><?php echo $bien['Bien']['CHASSIS_NOM']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>