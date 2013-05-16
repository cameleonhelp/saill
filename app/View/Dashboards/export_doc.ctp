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
<p><b>Tableau de bord<b></p>
<br />
<p><b>Date :<b>
<?php $date=new DateTime(); 
$date->setTimezone(new DateTimeZone('Europe/Paris'));?>
<?php echo $date->format("d/m/Y H:i:s"); ?></p>
<br />
<p><em>Ici vous pouvez ajouter le graphe après l'avoir enregistrer au format "jpg"</em></p>
<br />
<p style="text-align: center;">Indicateurs</p><br>
<table  cellpadding="0" cellspacing="0">
	</tr>
		<tr id="titles">
                        <td class="tableTd" rowspan="2" style="vertical-align: middle;">Projet</td>
                        <td class="tableTd" rowspan="2" width="60px" style="vertical-align: middle;">TJM</td>
                        <td class="tableTd" colspan="2">Contrat</td>
                        <td class="tableTd" colspan="2">Facturation estimée</td>
                        <td class="tableTd" colspan="2">% Avancement</td>
                        <td class="tableTd" rowspan="2" style="vertical-align: middle;" width="70px">Reste à faire</td>
                        </tr>
                        <tr>
                        <td class="tableTd" width="70px">Budget (k€)</td>
                        <td class="tableTd" width="70px">Charge (j)</td>
                        <td class="tableTd" width="70px">Budget (k€)</td>
                        <td class="tableTd" width="70px">Charge (j)</td>            
                        <td class="tableTd" width="70px">Budget</td>
                        <td class="tableTd" width="70px">Charge</td>
		</tr>	
                <?php $fin = count($rowsrapport); ?>
		<?php foreach($rowsrapport as $row):
			echo '<tr>'; ?>
                        <td class="tableTdContent"><?php echo $row['CONTRAT']['NOM']; ?></td>
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row['CONTRAT']['TJM']; ?> €/j</td>
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row['CONTRAT']['BUDGET']; ?> k€</td>
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row['CONTRAT']['CHARGE']; ?> j</td>  
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row[0]['BUDGETFACTURE']; ?> k€</td>
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row['FACTURATION']['CHARGEFACTUREE']; ?> j</td> 
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row[0]['AVANCEMENTBUDGET']; ?> %</td>
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row[0]['AVANCEMENTCHARGE']; ?> %</td>       
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row[0]['RAF']; ?> j</td> 
                        <?php
                        echo '</tr>';
			endforeach;
		?>            
</table>
<br />
<table  cellpadding="0" cellspacing="0">
	</tr>
		<tr id="titles">
                        <td class="tableTd" rowspan="2" style="vertical-align: middle;">Projet</td>
                        <td class="tableTd" rowspan="2" width="60px" style="vertical-align: middle;">TJM</td>
                        <td class="tableTd" colspan="2">Contrat</td>
                        <td class="tableTd" colspan="2">Prévision</td>
                        <td class="tableTd" colspan="2">Consommation</td>
                        <td class="tableTd" colspan="2">Facturation estimée</td>
                        <td class="tableTd" colspan="2">% Avancement</td>
                        <td class="tableTd" rowspan="2" style="vertical-align: middle;">Ecart</td>
                        <td class="tableTd" colspan="2">Reste à</td>
                        </tr>
                        <tr>
                        <td class="tableTd" width="70px">Budget (k€)</td>
                        <td class="tableTd" width="70px">Charge (j)</td>
                        <td class="tableTd" width="70px">Budget (k€)</td>
                        <td class="tableTd" width="70px">Charge (j)</td>
                        <td class="tableTd" width="70px">Budget (k€)</td>
                        <td class="tableTd" width="70px">Charge (j)</td>
                        <td class="tableTd" width="70px">Budget (k€)</td>
                        <td class="tableTd" width="70px">Charge (j)</td>            
                        <td class="tableTd" width="70px">Budget</td>
                        <td class="tableTd" width="70px">Charge</td>
                        <td class="tableTd" width="70px">Consommer</td>            
                        <td class="tableTd" width="70px">Faire</td>
		</tr>	
                <?php $fin = count($rowsrapport); ?>
		<?php foreach($rowsrapport as $row):
			echo '<tr>'; ?>
                        <td class="tableTdContent"><?php echo $row['CONTRAT']['NOM']; ?></td>
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row['CONTRAT']['TJM']; ?> €/j</td>
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row['CONTRAT']['BUDGET']; ?> k€</td>
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row['CONTRAT']['CHARGE']; ?> j</td>
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row[0]['BUDGETPREVU']; ?> k€</td>
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row['PREVISION']['CHARGEPREVUE']; ?> j</td>                
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row[0]['BUDGETREEL']; ?> k€</td>
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row['CONSOMMATION']['CHARGEREELLE']; ?> j</td>   
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row[0]['BUDGETFACTURE']; ?> k€</td>
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row['FACTURATION']['CHARGEFACTUREE']; ?> j</td> 
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row[0]['AVANCEMENTBUDGET']; ?> %</td>
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row[0]['AVANCEMENTCHARGE']; ?> %</td>     
                        <td class="tableTdContent" style="text-align: center;"><?php echo $row[0]['ECART']; ?> j</td>   
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row[0]['RAC']; ?> j</td>   
                        <td class="tableTdContent" style="text-align: right;"><?php echo $row[0]['RAF']; ?> j</td>
                        <?php
                        echo '</tr>';
			endforeach;
		?>            
</table>