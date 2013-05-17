<STYLE type="text/css">
        p, table th, table td {
            font-family: 'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;
            font-size:16pt;
            color:#274b6d;
        }
	.tableTd,.footer {
	   	border-width: 0.5pt; 
		border: solid; 
                background-color: #EAEAEA;
                color: #000000;
                padding: 5pt;
                text-align: center;
	}
	.tableTdContent{
		border-width: 0.5pt; 
		border: solid;
                padding: 5pt;                
	}
	#titles{
		font-weight: bolder;
	}
   
</STYLE>
<p><b>Rapport sur les plans de charge<b></p>
<br />
<p><b>Date :<b>
<?php $date=new DateTime(); 
$date->setTimezone(new DateTimeZone('Europe/Paris'));?>
<?php echo $date->format("d/m/Y H:i:s"); ?></p>
<br />
<p><em>Ici vous pouvez ajouter le graphe après l'avoir enregistrer au format "jpg"</em></p>
<br />
<p style="text-align: center;">Répartition des plans de charge par domaines</p><br>
<table  cellpadding="0" cellspacing="0">
	</tr>
		<tr id="titles">
			<td class="tableTd">Année</td>
			<td class="tableTd">Domaine</td>
                        <td class="tableTd">ETP</td>
                        <td class="tableTd">Charges prévues</td>
		</tr>	
                <?php $fin = count($rowsrapport); ?>
		<?php foreach($rowsrapport as $row):
			echo '<tr>'; ?>
                        <td class="tableTdContent"><?php echo $row['Plancharge']['ANNEE']; ?></td>
                        <td class="tableTdContent"><?php echo $row['Domaine']['NOM']; ?></td>
                        <td class="tableTdContent" style="text-align:center"><?php echo $row[0]['ETP']; ?></td>
                        <td class="tableTdContent" style="text-align:center"><?php echo $row[0]['TOTAL']; ?></td> 
                        <?php
                        echo '</tr>';
			endforeach;
		?>            
</table>
<br />
<p style="text-align: center;">Détail de la répartition des plans de charge</p><br>
<table  cellpadding="0" cellspacing="0">
	</tr>
		<tr id="titles">
			<td class="tableTd">Année</td>
                        <td class="tableTd">Domaine</td>
			<td class="tableTd">Projet/Activité</td>
                        <td class="tableTd">ETP</td>
                        <td class="tableTd">Charges prévues</td>
		</tr>	
		<?php foreach($rowsdetail as $row):
			echo '<tr>'; ?>
                        <td class="tableTdContent"><?php echo $row['Plancharge']['ANNEE']; ?></td>
                        <td class="tableTdContent"><?php echo $row['Domaine']['NOM']; ?></td>
                        <td class="tableTdContent"><?php echo $row['Detailplancharge']['projet_NOM'].' - '.$row['Activite']['NOM']; ?></td>
                        <td class="tableTdContent" style="text-align:center"><?php echo $row[0]['ETP']; ?></td>
                        <td class="tableTdContent" style="text-align:center"><?php echo $row[0]['TOTAL']; ?></td> 
                        <?php
                        echo '</tr>';
			endforeach;
		?>            
</table>