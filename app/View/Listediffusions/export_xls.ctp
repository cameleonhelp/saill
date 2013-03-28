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
		<td><b>Export des listes de diffusion depuis le site OSACT<b></td>
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
			<td class="tableTd">Gestionnaire</td>
                        <td class="tableTd">Commentaire</td>
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.$row['Listediffusion']['NOM'].'</td>';
                        $utilisateur = !is_null($row['Utilisateur']['NOMLONG']) ? $row['Utilisateur']['NOMLONG'] : '';
			echo '<td class="tableTdContent">'.$utilisateur.'</td>';
			echo '<td class="tableTdContent">'.$row['Listediffusion']['DESCRIPTION'].'</td>';                        
			echo '</tr>';
			endforeach;
		?>
</table>