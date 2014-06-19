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
		<td><b>Export des activités depuis le site SAILL<b></td>
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
			<td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Projet"); ?></td>
			<td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Activité"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "N° GALILEI"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Début"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Fin"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Etat"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Budget initial"); ?></td>
                        <td class="tableTd"><?php echo iconv("UTF-8", "ISO-8859-1//TRANSLIT", "Budget revu"); ?></td>                        
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Projet']['NOM']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Activite']['NOM']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Activite']['NUMEROGALLILIE']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Activite']['DATEDEBUT']).'</td>';
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Activite']['DATEFIN']).'</td>';
                        $etat = $row['Activite']['ACTIVE']==1 ? 'Active' : "Inactive";
			echo '<td class="tableTdContent">'.iconv("UTF-8", "ISO-8859-1//TRANSLIT", $etat).'</td>'; 
                        $budget = isset($row['Activite']['BUDJETRA']) ? $row['Activite']['BUDJETRA'] : '0';
                        echo '<td class="tableTdContent">'.  convertDecimal($budget).iconv("UTF-8", "ISO-8859-1//TRANSLIT", ' k€').'</td>';
                        $revu = isset($row['Activite']['BUDGETREVU']) ? $row['Activite']['BUDGETREVU'] : '0';
                        echo '<td class="tableTdContent">'.convertDecimal($revu).iconv("UTF-8", "ISO-8859-1//TRANSLIT", ' k€').'</td>';                      
			echo '</tr>';
                endforeach; ?>
</table>

