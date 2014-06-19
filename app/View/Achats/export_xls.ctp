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
		<td><b>Export des achats depuis le site SAILL<b></td>
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
			<td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'Activité'); ?></td>
			<td class="tableTd">Achats</td>
                        <td class="tableTd"><?php echoiconv("UTF-8", "ISO-8859-1//TRANSLIT", "Date d'achat"); ?></td>
                        <td class="tableTd">Montant en euros</td>
                        <td class="tableTd">Commentaire</td>
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Activite']['NOM']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Achat']['LIBELLEACHAT']).'</td>';
                        echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Achat']['DATE']).'</td>';
                        echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Achat']['MONTANT']).'</td>';
                        echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Achat']['DESCRIPTION']).'</td>';
			echo '</tr>';
			endforeach;
		?>
</table>

