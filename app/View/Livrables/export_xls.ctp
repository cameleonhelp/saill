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
		<td><b><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Export des livrables depuis le site SAILL"); ?><b></td>
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
			<td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Nom"); ?></td>
			<td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Gestionnaire"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Réf. MINIDOC"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Echéance"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Livraison prévue"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Validation prévue"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Etat"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Commentaire"); ?></td>
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Livrable']['NOM']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Utilisateur']['NOMLONG']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Livrable']['REFERENCE']).'</td>';                        
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Livrable']['ECHEANCE']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Livrable']['DATELIVRAISON']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Livrable']['DATEVALIDATION']).'</td>'; 
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Livrable']['ETAT']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Livrable']['COMMENTAIRE']).'</td>';
                        echo '</tr>';
			endforeach;
		?>
</table>