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
		<td><b>Export des actions depuis le site SAILL<b></td>
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
			<td class="tableTd">Domaine</td>
			<td class="tableTd">Emetteur</td>
                        <td class="tableTd">Destinataire</td>
                        <td class="tableTd">Objet</td>
                        <td class="tableTd">Résumé</td>
                        <td class="tableTd">Commentaire</td>
                        <td class="tableTd">Date de début</td>
                        <td class="tableTd">Echéance</td>
                        <td class="tableTd">Durée</td>
                        <td class="tableTd">Priorité</td>
                        <td class="tableTd">Statut</td>
                        <td class="tableTd">Avancement</td>                        

		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.$row['Domaine']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Utilisateur']['NOMLONG'].'</td>';
			echo '<td class="tableTdContent">'.$row['Action']['destinataire_nom'].'</td>';                        
			echo '<td class="tableTdContent">'.$row['Action']['OBJET'].'</td>';
                        echo '<td class="tableTdContent">'.$row['Action']['RESUME'].'</td>'; 
			echo '<td class="tableTdContent">'.$row['Action']['COMMENTAIRE'].'</td>'; 
                        echo '<td class="tableTdContent">'.$row['Action']['DEBUT'].'</td>';
                        echo '<td class="tableTdContent">'.$row['Action']['ECHEANCE'].'</td>';
                        echo '<td class="tableTdContent">'.($row['Action']['DUREEPREVUE']/8).' j</td>';
                        echo '<td class="tableTdContent">'.$row['Action']['PRIORITE'].'</td>';
                        echo '<td class="tableTdContent">'.$row['Action']['STATUT'].'</td>';
			echo '<td class="tableTdContent">'.$row['Action']['AVANCEMENT'].' %</td>';
                        echo '</tr>';
                endforeach; ?>
</table>