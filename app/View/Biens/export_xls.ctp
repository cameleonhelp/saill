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
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Modèle"); ?></td>
                        <td class="tableTd">Site</td>
                        <td class="tableTd">Niveau</td>
                        <td class="tableTd">Armoire</td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Châssis/Px70"); ?></td>
			<td class="tableTd">Usage</td>
                        <td class="tableTd">PVU</td>
                        <td class="tableTd">Application</td>
                        <td class="tableTd">Type d'environnement</td>
                        <td class="tableTd">Lot</td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Coeur licence"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Coeur"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Mémoire (RAM)"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Coût"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Installé le"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Validé le"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Validé par"); ?></td>
                        <td class="tableTd">Actif</td>                        

		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdCourrier">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Bien']['NOM']).'</td>';
                        echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Modele']['NOM']).'</td>';
                        echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Localite']['NOM']).'</td>';
                        echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Chassis']['NIVEAU']).'</td>';
                        echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Chassis']['ARMOIRE']).'</td>';
                        echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Chassis']['NOM']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Usage']['NOM']).'</td>';
			echo '<td class="tableTdContent">'.convertDecimal($row['Bien']['PVU']).'</td>';                        
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Application']['NOM']).'</td>';
                        echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Type']['NOM']).'</td>'; 
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Lot']['NOM']).'</td>'; 
                        echo '<td class="tableTdContent">'.convertDecimal($row['Bien']['COEURLICENCE']).'</td>';
                        echo '<td class="tableTdContent">'.convertDecimal($row['Bien']['COEUR']).'</td>';
                        echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Bien']['RAM']).'</td>';
                        echo '<td class="tableTdContent">'. convertDecimal($row['Bien']['COUT']).' '.iconv("UTF-8", "ISO-8859-1//TRANSLIT", "€").'</td>';
                        $dateinstall = !empty($row['Bien']['DATEINSTALL']) ? $row['Bien']['DATEINSTALL'] : '';
                        echo '<td class="tableTdContent">'.$dateinstall.'</td>';
                        $datecheck = !empty($row['Bien']['DATECHECKINSTALL']) ? $row['Bien']['DATECHECKINSTALL'] : '';
			echo '<td class="tableTdContent">'.$datecheck.'</td>';
                        $checkby = !empty($row['Bien']['CHECKBY_NOM']) ? iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Bien']['CHECKBY_NOM']) : '';
                        echo '<td class="tableTdContent">'.$checkby.'</td>';
                        $actif = $row['Bien']['ACTIF']==true ? 'Oui' : 'Non';
			echo '<td class="tableTdContent">'.$actif.'</td>';                        
                        echo '</tr>';
                endforeach; ?>
</table>