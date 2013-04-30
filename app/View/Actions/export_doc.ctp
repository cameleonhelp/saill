<STYLE type="text/css">
	.tableTd,.footer {
	   	border-width: 0.5pt; 
		border: solid; 
                background-color: #EAEAEA;
                color: #000000;
	}
	.tableTdContent{
		border-width: 0.5pt; 
		border: solid;
	}
	#titles{
		font-weight: bolder;
	}
   
</STYLE>
<p><b>Rapport sur les actions<b></p>
<br />
<p><b>Date :<b>
<?php $date=new DateTime(); 
$date->setTimezone(new DateTimeZone('Europe/Paris'));?>
<?php echo $date->format("d/m/Y H:i:s"); ?></p>
<br />
<p style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Nombre d'actions par mois, par destinataire et par état</p><br>
<table  cellpadding="0" cellspacing="0">
	</tr>
		<tr id="titles">
			<td class="tableTd">Période</td>
			<td class="tableTd">Responsable</td>
                        <td class="tableTd">Nombre</td>
                        <td class="tableTd">Etat</td>
		</tr>	
                <?php $fin = count($rowsrapport); ?>
		<?php foreach($rowsrapport as $row):
			echo '<tr>'; ?>
                        <td><?php echo strMonth($row[0]['MONTH']).' '.$row[0]['YEAR']; ?></td>
                        <td><?php echo $row['Utilisateur']['NOM'].' '.$row['Utilisateur']['PRENOM']; ?></td>
                        <td style="text-align:center"><?php echo $row[0]['NB']; ?></td>
                        <td style="text-align:center"><?php echo ucfirst_utf8($row['Action']['STATUT']); ?></td> 
                        <?php
                        echo '</tr>';
			endforeach;
		?>            
</table>
<br />
<p style="font-family:'Lucida Grande', 'Lucida Sans Unicode', Verdana, Arial, Helvetica, sans-serif;font-size:16px;color:#274b6d;fill:#274b6d;text-align: center;" text-anchor="middle" class="highcharts-title" zIndex="4">Détail des actions par mois</p><br>
<table  cellpadding="0" cellspacing="0">
	</tr>
		<tr id="titles">
			<td class="tableTd">Période</td>
			<td class="tableTd">Action</td>
                        <td class="tableTd">Etat</td>
		</tr>	
		<?php foreach($rowsdetail as $row):
			echo '<tr>'; ?>
                        <td><?php echo strMonth($row[0]['MONTH']).' '.$row[0]['YEAR']; ?></td>
                        <td><?php echo $row['Action']['OBJET']; ?></td>
                        <td style="text-align:center"><?php echo ucfirst_utf8($row['Action']['STATUT']); ?></td> 
                        <?php
                        echo '</tr>';
			endforeach;
		?>            
</table>