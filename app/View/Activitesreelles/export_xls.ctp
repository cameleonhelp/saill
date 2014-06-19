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
		<td><b><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Export des facturations estimées à faire depuis le site SAILL"); ?><b></td>
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
			<td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Nom utilisateur"); ?></td>
			<td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Date"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Activité"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Total"); ?></td>
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Utilisateur']['NOMLONG']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Activitesreelle']['DATE']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Activitesreelle']['projet_NOM']).' - '.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Activite']['NOM']).'</td>';
			echo '<td class="tableTdContent">'.convertDecimal($row['Activitesreelle']['TOTAL']).'</td>';                        
                        echo '</tr>';
			endforeach;
		?>
		<tr id="footer">
			<td class="tableTd"></td>
                        <td class="tableTd" colspan="2">Total</td>
                        <?php $fin = count($rows) + 5; ?>
                        <td class="tableTd">=SOUS.TOTAL(9;D6:D<?php echo $fin; ?>)</td>
		</tr>                
</table>