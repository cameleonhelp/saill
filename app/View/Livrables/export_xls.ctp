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
		<td><b>Export des livrables depuis le site OSACT<b></td>
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
			<td class="tableTd">Gestionnaire</td>
                        <td class="tableTd">Réf. MINIDOC</td>
                        <td class="tableTd">Echéance</td>
                        <td class="tableTd">Livraison prévue</td>
                        <td class="tableTd">Validation prévue</td>
                        <td class="tableTd">Etat</td>
                        <td class="tableTd">Commentaire</td>
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.$row['Livrable']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Utilisateur']['NOMLONG'].'</td>';
			echo '<td class="tableTdContent">'.$row['Livrable']['REFERENCE'].'</td>';                        
			echo '<td class="tableTdContent">'.$row['Livrable']['ECHEANCE'].'</td>';
			echo '<td class="tableTdContent">'.$row['Livrable']['DATELIVRAISON'].'</td>';
			echo '<td class="tableTdContent">'.$row['Livrable']['DATEVALIDATION'].'</td>'; 
			echo '<td class="tableTdContent">'.$row['Livrable']['ETAT'].'</td>';
			echo '<td class="tableTdContent">'.$row['Livrable']['COMMENTAIRE'].'</td>';
                        echo '</tr>';
			endforeach;
		?>
</table>