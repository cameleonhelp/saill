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
		<td><b>Export des facturations estimées depuis le site SAILL<b></td>
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
			<td class="tableTd">Nom utilisateur</td>
			<td class="tableTd">Date</td>
                        <td class="tableTd">Réf. GALILEI</td>
                        <td class="tableTd">Version</td>
                        <td class="tableTd">Activité</td>
                        <td class="tableTd">Total</td>
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.$row['Utilisateur']['NOMLONG'].'</td>';
			echo '<td class="tableTdContent">'.$row['Facturation']['DATE'].'</td>';
			echo '<td class="tableTdContent">'.$row['Facturation']['NUMEROFTGALILEI'].'</td>';                        
			echo '<td class="tableTdContent">'.$row['Facturation']['VERSION'].'</td>';
			echo '<td class="tableTdContent">'.$row['Facturation']['projet_NOM'].' - '.$row['Activite']['NOM'].'</td>';
                        $total = str_replace('.', ',', $row['Facturation']['TOTAL']);
			echo '<td class="tableTdContent">'.$total.'</td>';
                        echo '</tr>';
			endforeach;
		?>
		<tr id="footer">
			<td class="tableTd"></td>
			<td class="tableTd"></td>
                        <td class="tableTd"></td>
                        <td class="tableTd" colspan="2">Total</td>
                        <?php $fin = count($rows) + 5; ?>
                        <td class="tableTd">=SOUS.TOTAL(9;F6:F<?php echo $fin; ?>)</td>
		</tr>	            
           
</table>