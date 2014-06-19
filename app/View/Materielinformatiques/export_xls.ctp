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
		<td><b><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Export des matériels informatiques depuis le site SAILL"); ?><b></td>
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
			<td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Type"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Section"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Assistance"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Etat"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Wifi"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "VPN"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Commentaire"); ?></td>
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Materielinformatique']['NOM']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Typemateriel']['NOM']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Section']['NOM']).'</td>';                        
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Assistance']['NOM']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Materielinformatique']['ETAT']).'</td>';
                        $wifi = $row['Materielinformatique']['WIFI']==1 ? 'Oui' : 'Non';
			echo '<td class="tableTdContent">'.$wifi.'</td>';
                        $vpn = $row['Materielinformatique']['VPN']==1 ? 'Oui' : 'Non';
			echo '<td class="tableTdContent">'.$vpn.'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row['Materielinformatique']['COMMENTAIRE']).'</td>';
                        echo '</tr>';
			endforeach;
		?>
</table>