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
		<td><b>Export pour la fiche mouvement des information de l'utilisateur <?php echo $rows['Utilisateur']['NOMLONG']; ?><b></td>
	</tr>
	<tr>
		<td><b>Date:</b></td>
                <?php $date=new DateTime(); 
                $date->setTimezone(new DateTimeZone('Europe/Paris'));?>
		<td><?php echo $date->format("d/m/Y H:i:s"); ?></td>
	</tr>
	<tr>
		<td></td>
	</tr>
		<tr id="titles">
			<td class="tableTd">Nom complet</td>
                        <td class="tableTd">Nom</td>
                        <td class="tableTd">Prénom</td>
			<td class="tableTd">Société</td>
                        <td class="tableTd">Section</td>
                        <td class="tableTd">Site</td>
                        <td class="tableTd">Identifiant</td>
                        <td class="tableTd">Assistance</td>
                        <td class="tableTd">Email</td>
                        <td class="tableTd">Téléphone</td>
                        <td class="tableTd">Fin de mission</td>   
                        <td class="tableTd">Eng. de confidentialité</td>  
                        <td class="tableTd">Date remise eng. conf.</td>  
                        <td class="tableTd">Commentaire</td>
		</tr>		
		<?php 
			echo '<tr>';
			echo '<td class="tableTdContent">'.$rows['Utilisateur']['NOMLONG'].'</td>';
                        echo '<td class="tableTdContent">'.$rows['Utilisateur']['NOM'].'</td>';
                        echo '<td class="tableTdContent">'.$rows['Utilisateur']['PRENOM'].'</td>';
			echo '<td class="tableTdContent">'.$rows['Societe']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$rows['Section']['NOM'].'</td>';                        
			echo '<td class="tableTdContent">'.$rows['Site']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$rows['Utilisateur']['username'].'</td>'; 
                        echo '<td class="tableTdContent">'.$rows['Assistance']['NOM'].'</td>';
                        echo '<td class="tableTdContent">'.$rows['Utilisateur']['MAIL'].'</td>';
                        echo '<td class="tableTdContent">'.$rows['Utilisateur']['TELEPHONE'].'</td>';
			echo '<td class="tableTdContent">'.$rows['Utilisateur']['FINMISSION'].'</td>';
                        echo '<td class="tableTdContent">'.tooltipconf($rows['Utilisateur']['ENGCONF']).'</td>';
			echo '<td class="tableTdContent">'.$rows['Utilisateur']['DATEENGCONF'].'</td>';
			echo '<td class="tableTdContent">'.$rows['Utilisateur']['COMMENTAIRE'].'</td>';
                        echo '</tr>';
                ?>
</table>