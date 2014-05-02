<br/>
<div class="historyUtilisateur index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover tablemax tablehistorique">
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
                <td><?php echo $historyutilisateur['Historyutilisateur']['HISTORIQUE']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
</div>
<script>
$(document).ready(function (){ 
    //tri sur le tableau 
    $('.tablehistorique').tablesorter({
        headers:{
            0:{filter:false},
        },
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