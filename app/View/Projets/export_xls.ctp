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
		<td><b>Export des projets depuis le site SAILL<b></td>
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
			<td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Contrat"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "N° GALILEI"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Etat"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Type"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Facturation estimée"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Commentaire"); ?></td>
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Projet']['NOM']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Contrat']['NOM']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Projet']['NUMEROGALLILIE']).'</td>';   
                        $etat = $row['Projet']['ACTIF']==1 ? 'Actif' : 'Inactif';
			echo '<td class="tableTdContent">'.$etat.'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Projet']['TYPE']).'</td>'; 
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Projet']['FACTURATION']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Projet']['COMMENTAIRE']).'</td>';
                        echo '</tr>';
			endforeach;
		?>
</table>