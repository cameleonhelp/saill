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
<p><b>Rapport sur les actions<b></p>
<br />
<p><b>Date :<b>
<?php $date=new DateTime(); 
$date->setTimezone(new DateTimeZone('Europe/Paris'));?>
<?php echo $date->format("d/m/Y H:i:s"); ?></p>
<br />
<p><em>Ici vous pouvez ajouter le graphe après l'avoir enregistrer au format "jpg"</em></p>
<br />
<p style="text-align: center;">Nombre d'actions par mois, par destinataire et par état</p><br>
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
                        <td class="tableTdContent"><?php echo strMonth($row[0]['MONTH']).' '.$row[0]['YEAR']; ?></td>
                        <td class="tableTdContent"><?php echo $row['Utilisateur']['NOM'].' '.$row['Utilisateur']['PRENOM']; ?></td>
                        <td class="tableTdContent" style="text-align:center"><?php echo $row[0]['NB']; ?></td>
                        <td class="tableTdContent" style="text-align:center"><?php echo ucfirst_utf8($row['Action']['STATUT']); ?></td> 
                        <?php
                        echo '</tr>';
			endforeach;
		?>            
</table>
<br />
<p style="text-align: center;">Détail des actions par mois</p><br>
<table  cellpadding="0" cellspacing="0">
	</tr>
		<tr id="titles">
			<td class="tableTd">Période</td>
                        <td class="tableTd">Domaine</td>
			<td class="tableTd">Action</td>
                        <td class="tableTd">Etat</td>
		</tr>	
		<?php foreach($rowsdetail as $row):
			echo '<tr>'; ?>
                        <td class="tableTdContent"><?php echo strMonth($row[0]['MONTH']).' '.$row[0]['YEAR']; ?></td>
                        <td class="tableTdContent"><?php echo $row['Domaine']['NOM']; ?></td>
                        <td class="tableTdContent"><?php echo $row['Action']['OBJET']; ?></td>
                        <td class="tableTdContent" style="text-align:center"><?php echo ucfirst_utf8($row['Action']['STATUT']); ?></td> 
                        <?php
                        echo '</tr>';
			endforeach;
		?>            
</table>