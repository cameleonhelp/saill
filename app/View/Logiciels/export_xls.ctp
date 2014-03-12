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
		<td><b>Export des logiciels depuis le site SAILL<b></td>
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
			<td class="tableTd">Outil</td>
                        <td class="tableTd">Version</td>
                        <td class="tableTd">Edition</td>
                        <td class="tableTd">OS</td>
                        <td class="tableTd">Application</td>
                        <td class="tableTd">Lot</td>  
                        <td class="tableTd">Bien</td>
                        <td class="tableTd">Type d'environnement</td>
                        <td class="tableTd">Env. DSI-T</td>
                        <td class="tableTd">Coeur</td>
                        <td class="tableTd">Coeur licence</td>
                        <td class="tableTd">PVU</td>
                        <td class="tableTd">RAM</td>
                        <td class="tableTd">Coût</td>
                        <td class="tableTd">Usage</td>
                        <td class="tableTd">CPU</td>
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.$row['logiciels']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['envoutils']['logiciel'].'</td>';
                        echo '<td class="tableTdContent">'.$row['envversions']['VERSION'].'</td>';
                        echo '<td class="tableTdContent">'.$row['envversions']['EDITION'].'</td>';
                        $os = $row['envoutils']['OS']==true ? 'Oui' : 'Non';
                        echo '<td class="tableTdContent">'.$os.'</td>';
			echo '<td class="tableTdContent">'.$row['applications']['application'].'</td>';                        
			echo '<td class="tableTdContent">'.$row['lots']['lot'].'</td>';
                        echo '<td class="tableTdCourrier">'.$row['biens']['bien'].'</td>';
                        echo '<td class="tableTdContent">'.$row['types']['type'].'</td>';
                        $listenv = isset($row['assobienlogiciels']['dsitenv_nom']) ? $row['assobienlogiciels']['dsitenv_nom'] : '';
                        echo '<td class="tableTdCourrier">'.$listenv.'</td>';
                        echo '<td class="tableTdCourrier">'.convertDecimal($row['biens']['COEUR']).'</td>';
                        echo '<td class="tableTdCourrier">'.convertDecimal($row['biens']['COEURLICENCE']).'</td>';
                        echo '<td class="tableTdCourrier">'.convertDecimal($row['biens']['PVU']).'</td>';
                        echo '<td class="tableTdCourrier">'.$row['biens']['RAM'].'</td>';
                        echo '<td class="tableTdCourrier">'.$row['biens']['COUT'].'</td>';
                        echo '<td class="tableTdCourrier">'.$row['usages']['usages'].'</td>';
                        echo '<td class="tableTdCourrier">'.$row['cpuses']['cpu'].'</td>';
                        echo '</tr>';
                endforeach; ?>
</table>

<?php function convertDecimal($value){
        return str_replace(".", ",", $value);
       }
?>