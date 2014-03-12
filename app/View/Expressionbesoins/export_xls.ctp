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
			<td class="tableTd">Application</td>
			<td class="tableTd">Composant</td>
                        <td class="tableTd">Périmètre</td>
                        <td class="tableTd">Type d'environnement</td>
                        <td class="tableTd">Type environnement DSI-T</td>
                        <td class="tableTd">Phase</td>
                        <td class="tableTd">Usage</td>
                        <td class="tableTd">Nom d'usage</td>
                        <td class="tableTd">Lot</td>
                        <td class="tableTd">Etat</td>
                        <td class="tableTd">Date de livraison</td>
                        <td class="tableTd">Date de fin</td>                        
                        <td class="tableTd">Volumétrie</td> 
                        <td class="tableTd">Puissance</td> 
                        <td class="tableTd">Architecture</td> 
                        <td class="tableTd">PVU</td> 
                        <td class="tableTd">Connecté</td> 
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.$row['Application']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Composant']['NOM'].'</td>';
                        echo '<td class="tableTdContent">'.$row['Perimetre']['NOM'].'</td>';
                        echo '<td class="tableTdContent">'.$row['Type']['NOM'].'</td>';
                        echo '<td class="tableTdContent">'.$row['Expressionbesoin']['dsitenv_nom'].'</td>';
                        echo '<td class="tableTdContent">'.$row['Phase']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Expressionbesoin']['USAGE'].'</td>';                        
			echo '<td class="tableTdContent">'.$row['Expressionbesoin']['NOMUSAGE'].'</td>';
                        echo '<td class="tableTdContent">'.$row['Lot']['NOM'].'</td>'; 
			echo '<td class="tableTdContent">'.$row['Etat']['NOM'].'</td>'; 
                        echo '<td class="tableTdContent">'.$row['Expressionbesoin']['DATELIVRAISON'].'</td>';
                        echo '<td class="tableTdContent">'.$row['Expressionbesoin']['DATEFIN'].'</td>';
                        echo '<td class="tableTdContent">'.($row['Volumetrie']['NOM']).'</td>';
                        echo '<td class="tableTdContent">'.$row['Puissance']['NOM'].'</td>';
                        echo '<td class="tableTdContent">'.$row['Architecture']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Expressionbesoin']['PVU'].'</td>';
                        $connect = $row['Expressionbesoin']['CONNECT']==true ? 'Oui' : 'Non';
                        echo '<td class="tableTdContent">'.$connect.'</td>';
                        echo '</tr>';
                endforeach; ?>
</table>