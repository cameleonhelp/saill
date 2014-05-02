	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover tablemax tableviewbien">
	<thead><tr>
                        <th><?php echo 'Nom'; ?></th>
                        <th><?php echo 'Usage'; ?></th>
                        <th><?php echo 'Coeur'; ?></th>
                        <th><?php echo 'Coeur logiciel'; ?></th>
                        <th><?php echo 'PVU'; ?></th>
                        <th><?php echo 'Mémoire'; ?></th>
                        <th><?php echo 'Modèle'; ?></th>
                        <th><?php echo 'Chassis'; ?></th>
	</tr></thead>
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
<script>
$(document).ready(function (){ 
    //tri sur le tableau 
    $('.tableviewbien').tablesorter({
        widthFixed : true,
        widgets: ["zebra","filter"],
        widgetOptions : {
            filter_columnFilters : true,
            filter_hideFilters : true,
            filter_ignoreCase : true,
            filter_liveSearch : true,
            filter_saveFilters : true,
            filter_useParsedData : true,
            filter_startsWith : false,
            zebra : [ "normal-row", "alt-row" ]
        }
    });
});
</script>