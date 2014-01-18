<STYLE type="text/css">
	.tableTd,.footer {
	   	border-width: 0.5pt; 
		border: solid; 
                background-color: #cc0044;
                color: #EFEFEF;
	}
	.tableTdContent{
		border-width: 0.5pt; 
		border: solid;
	}
	#titles{
		font-weight: bolder;
	}
   
</STYLE>
<table>
	<tr>
		<td><b>Export des changements SAILL prévus<b></td>
	</tr>
	<tr>
		<td><b>Date:</b></td>
                <?php $date=new DateTime(); 
                $date->setTimezone(new DateTimeZone('Europe/Paris'));?>
		<td><?php echo $date->format("d/m/Y H:i:s"); ?></td>
	</tr>
	<tr>
		<td><b>Nombre de lignes:</b></td>
		<td style="text-align:left"><?php echo count($rows);?></td>
	</tr>
	<tr>
		<td></td>
	</tr>
		<tr id="titles">
			<td class="tableTd">Identifiant</td>
			<td class="tableTd">Version</td>
                        <td class="tableTd">Prévue le</td>
                        <td class="tableTd">Criticité</td>
                        <td class="tableTd">Etat</td>
                        <td class="tableTd">Type de demande</td>
                        <td class="tableTd">Changement demandé</td>                   
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'."C-".strYear($row['Changelogdemande']['created'])."-".$row['Changelogdemande']['id'].'</td>';
			echo '<td class="tableTdContent">'.$row['Changelogversion']['VERSION'].'</td>';
			echo '<td class="tableTdContent">'.$row['Changelogdemande']['DATEPREVUE'].'</td>';                        
			echo '<td class="tableTdContent">'.$changelogcriticites[$row['Changelogdemande']['CRITICITE']].'</td>';
                        echo '<td class="tableTdContent">'.$changelogetats[$row['Changelogdemande']['ETAT']].'</td>'; 
			echo '<td class="tableTdContent">'.$changelogtypes[$row['Changelogdemande']['TYPE']].'</td>'; 
                        echo '<td class="tableTdContent">'.$row['Changelogdemande']['DEMANDE'].'</td>';
                        echo '</tr>';
                endforeach; ?>
</table>