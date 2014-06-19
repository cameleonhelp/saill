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
		<td><b>Export des utilisateurs depuis le site SAILL<b></td>
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
			<td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Société"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Section"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Site"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Identifiant"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Assistance"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Email"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Téléphone"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Fin de mission"); ?></td>   
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Eng. de confidentialité"); ?></td>  
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Date remise eng. conf."); ?></td>  
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Commentaire"); ?></td>
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Utilisateur']['NOMLONG']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Societe']['NOM']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Section']['NOM']).'</td>';                        
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Site']['NOM']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Utilisateur']['username']).'</td>'; 
                        echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Assistance']['NOM']).'</td>';
                        echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Utilisateur']['MAIL']).'</td>';
                        echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Utilisateur']['TELEPHONE']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Utilisateur']['FINMISSION']).'</td>';
                        echo '<td class="tableTdContent">'.tooltipconf(iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Utilisateur']['ENGCONF'])).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Utilisateur']['DATEENGCONF']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Utilisateur']['COMMENTAIRE']).'</td>';
                        echo '</tr>';
                endforeach; ?>
</table>