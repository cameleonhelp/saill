<STYLE type="text/css">
	.tableTd {
	   	border-width: 0.5pt; 
		border: solid; 
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
		<td><b>Export des projets depuis le site OSACT<b></td>
	</tr>
	<tr>
		<td><b>Date:</b></td>
		<td><?php echo date("d/m/Y H:i:s"); ?></td>
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
			<td class="tableTd">Contrat</td>
                        <td class="tableTd">N° GALILEI</td>
                        <td class="tableTd">Etat</td>
                        <td class="tableTd">Type</td>
                        <td class="tableTd">Facturation</td>
                        <td class="tableTd">Commentaire</td>
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.$row['Projet']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Contrat']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Projet']['NUMEROGALILEI'].'</td>';                        
			echo '<td class="tableTdContent">'.$row['Projet']['ETAT'].'</td>';
			echo '<td class="tableTdContent">'.$row['Projet']['TYPE'].'</td>'; 
			echo '<td class="tableTdContent">'.$row['Projet']['FACTURATION'].'</td>';
			echo '<td class="tableTdContent">'.$row['Projet']['COMMENTAIRE'].'</td>';
                        echo '</tr>';
			endforeach;
		?>
</table>