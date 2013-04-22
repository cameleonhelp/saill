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
		<td><b>Export du plan de charges depuis le site OSACT<b></td>
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
			<td class="tableTd">Utilisateur</td>
                        <td class="tableTd">Domaines</td>
			<td class="tableTd">Activité</td>
                        <td class="tableTd">Etp</td>
                        <td class="tableTd">Jan.</td>
                        <td class="tableTd">Fév.</td>
                        <td class="tableTd">Mars</td>
                        <td class="tableTd">Avril</td>
                        <td class="tableTd">Mai</td>
                        <td class="tableTd">Juin</td>
                        <td class="tableTd">Juil.</td>
                        <td class="tableTd">Aout</td>
                        <td class="tableTd">Sept</td>
                        <td class="tableTd">Oct.</td>
                        <td class="tableTd">Nov.</td>
                        <td class="tableTd">Déc</td>
                        <td class="tableTd">Total</td>                      
		</tr>	
                <?php $i=6; ?>
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.$row['Utilisateur']['NOMLONG'].'</td>';
			echo '<td class="tableTdContent">'.$row['Domaine']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Activite']['NOM'].'</td>';
                        echo '<td class="tableTdContent">'.$row['Detailplancharge']['ETP'].'</td>';
			echo '<td class="tableTdContent">'.$row['Detailplancharge']['JANVIER'].'</td>';
			echo '<td class="tableTdContent">'.$row['Detailplancharge']['FEVRIER'].'</td>';
			echo '<td class="tableTdContent">'.$row['Detailplancharge']['MARS'].'</td>';
			echo '<td class="tableTdContent">'.$row['Detailplancharge']['AVRIL'].'</td>';
			echo '<td class="tableTdContent">'.$row['Detailplancharge']['MAI'].'</td>';
			echo '<td class="tableTdContent">'.$row['Detailplancharge']['JUIN'].'</td>';
			echo '<td class="tableTdContent">'.$row['Detailplancharge']['JUILLET'].'</td>';
			echo '<td class="tableTdContent">'.$row['Detailplancharge']['AOUT'].'</td>';
			echo '<td class="tableTdContent">'.$row['Detailplancharge']['SEPTEMBRE'].'</td>';
			echo '<td class="tableTdContent">'.$row['Detailplancharge']['OCTOBRE'].'</td>';
			echo '<td class="tableTdContent">'.$row['Detailplancharge']['NOVEMBRE'].'</td>';
			echo '<td class="tableTdContent">'.$row['Detailplancharge']['DECEMBRE'].'</td>';
			echo '<td class="tableTdContent">=SOMME(E'.$i.':P'.$i.')</td>';                      
			echo '</tr>';
                        $i++;
			endforeach;
		?>
		<tr id="footer">
                        <?php $fin = count($rows) + 5; ?>
                        <td class="tableTd" colspan="3">Total</td>
                        <td class="tableTd">=SOUS.TOTAL(9;D6:D<?php echo $fin; ?>)</td>
                        <td class="tableTd">=SOUS.TOTAL(9;E6:E<?php echo $fin; ?>)</td>
                        <td class="tableTd">=SOUS.TOTAL(9;F6:F<?php echo $fin; ?>)</td>
                        <td class="tableTd">=SOUS.TOTAL(9;G6:G<?php echo $fin; ?>)</td>
                        <td class="tableTd">=SOUS.TOTAL(9;H6:H<?php echo $fin; ?>)</td>
                        <td class="tableTd">=SOUS.TOTAL(9;I6:I<?php echo $fin; ?>)</td>
                        <td class="tableTd">=SOUS.TOTAL(9;J6:J<?php echo $fin; ?>)</td>
                        <td class="tableTd">=SOUS.TOTAL(9;K6:K<?php echo $fin; ?>)</td>
                        <td class="tableTd">=SOUS.TOTAL(9;L6:L<?php echo $fin; ?>)</td>
                        <td class="tableTd">=SOUS.TOTAL(9;M6:M<?php echo $fin; ?>)</td>
                        <td class="tableTd">=SOUS.TOTAL(9;N6:N<?php echo $fin; ?>)</td>
                        <td class="tableTd">=SOUS.TOTAL(9;O6:O<?php echo $fin; ?>)</td>
                        <td class="tableTd">=SOUS.TOTAL(9;P6:P<?php echo $fin; ?>)</td>
                        <td class="tableTd">=SOUS.TOTAL(9;Q6:Q<?php echo $fin; ?>)</td>
		</tr>	                
</table>

