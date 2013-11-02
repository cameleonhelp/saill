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
	.tableTdCourrier{
		font-family: Courier New, Courier, Prestige, monospace !important;
		border-width: 0.5pt; 
		border: solid;                
	}        
	#titles{
		font-weight: bolder;
	}
   
</STYLE>
<table>
	<tr>
		<td><b>Export des biens depuis le site SAILL<b></td>
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
			<td class="tableTd">Usage</td>
                        <td class="tableTd">PVU</td>
                        <td class="tableTd">Application</td>
                        <td class="tableTd">Type d'environnement</td>
                        <td class="tableTd">Lot</td>
                        <td class="tableTd">Coeur licence</td>
                        <td class="tableTd">Coeur</td>
                        <td class="tableTd">Mémoire</td>
                        <td class="tableTd">Coût</td>
                        <td class="tableTd">Installé le</td>
                        <td class="tableTd">Validé le</td>
                        <td class="tableTd">Validé par</td>
                        <td class="tableTd">Actif</td>                        

		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdCourrier">'.$row['Bien']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Usage']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Bien']['PVU'].'</td>';                        
			echo '<td class="tableTdContent">'.$row['Application']['NOM'].'</td>';
                        echo '<td class="tableTdContent">'.$row['Type']['NOM'].'</td>'; 
			echo '<td class="tableTdContent">'.$row['Lot']['NOM'].'</td>'; 
                        echo '<td class="tableTdContent">'.$row['Bien']['COEURLICENCE'].'</td>';
                        echo '<td class="tableTdContent">'.$row['Bien']['COEUR'].'</td>';
                        echo '<td class="tableTdContent">'.$row['Bien']['RAM'].'</td>';
                        echo '<td class="tableTdContent">'.$row['Bien']['COUT'].' €</td>';
                        $dateinstall = !empty($row['Bien']['DATEINSTALL']) ? $row['Bien']['DATEINSTALL'] : '';
                        echo '<td class="tableTdContent">'.$dateinstall.'</td>';
                        $datecheck = !empty($row['Bien']['DATECHECKINSTALL']) ? $row['Bien']['DATECHECKINSTALL'] : '';
			echo '<td class="tableTdContent">'.$datecheck.'</td>';
                        $checkby = !empty($row['Bien']['CHECKBY_NOM']) ? $row['Bien']['CHECKBY_NOM'] : '';
                        echo '<td class="tableTdContent">'.$checkby.'</td>';
                        $actif = $row['Bien']['ACTIF']==true ? 'Oui' : 'Non';
			echo '<td class="tableTdContent">'.$actif.'</td>';                        
                        echo '</tr>';
                endforeach; ?>
</table>