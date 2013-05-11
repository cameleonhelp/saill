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
		<td><b>Export des activités depuis le site SAILL<b></td>
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
			<td class="tableTd">Projet</td>
			<td class="tableTd">Activité</td>
                        <td class="tableTd">N° GALILEI</td>
                        <td class="tableTd">Début</td>
                        <td class="tableTd">Fin</td>
                        <td class="tableTd">Etat</td>
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.$row['Projet']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Activite']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Activite']['NUMEROGALLILIE'].'</td>';
			echo '<td class="tableTdContent">'.$row['Activite']['DATEDEBUT'].'</td>';
			echo '<td class="tableTdContent">'.$row['Activite']['DATEFIN'].'</td>';
                        $etat = $row['Activite']['ACTIVE']==1 ? 'Active' : "Inactive";
			echo '<td class="tableTdContent">'.$etat.'</td>';                        
			echo '</tr>';
			endforeach;
		?>
</table>

