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
		<td><b>Export des intégrations applicatives depuis le site SAILL<b></td>
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
			<td class="tableTd">Type d'environnement</td>
                        <td class="tableTd">Lot</td>
                        <td class="tableTd">Version</td>
                        <td class="tableTd">Date d'installation</td>
                        <td class="tableTd">Date de validation</td>
                        <td class="tableTd">Actif</td>                       
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.$row['Application']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Type']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Lot']['NOM'].'</td>';                        
			echo '<td class="tableTdContent">'.$row['Version']['NOM'].'</td>';
                        echo '<td class="tableTdContent">'.$row['Intergrationapplicative']['DATEINSTALL'].'</td>'; 
			echo '<td class="tableTdContent">'.$row['Intergrationapplicative']['DATECHECK'].'</td>';
                        $actif = $row['Intergrationapplicative']['ACTIF'] == true ? 'Oui' : 'Non';
                        echo '<td class="tableTdContent">'.$actif.'</td>';
                        echo '</tr>';
                endforeach; ?>
</table>