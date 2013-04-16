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
		<td><b>Export des utilisateurs depuis le site OSACT<b></td>
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
			<td class="tableTd">Nom</td>
			<td class="tableTd">Société</td>
                        <td class="tableTd">Section</td>
                        <td class="tableTd">Site</td>
                        <td class="tableTd">Identifiant</td>
                        <td class="tableTd">Fin de mission</td>
                        <td class="tableTd">Commentaire</td>
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.$row['Utilisateur']['NOMLONG'].'</td>';
			echo '<td class="tableTdContent">'.$row['Societe']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Section']['NOM'].'</td>';                        
			echo '<td class="tableTdContent">'.$row['Site']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Utilisateur']['username'].'</td>'; 
			echo '<td class="tableTdContent">'.$row['Utilisateur']['FINMISSION'].'</td>';
			echo '<td class="tableTdContent">'.$row['Utilisateur']['COMMENTAIRE'].'</td>';
                        echo '</tr>';
			endforeach;
		?>
</table>