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
<?php $results = $rows['result']; $entrops = $rows['trop']; ?>
<table>
	<tr>
		<td><b>Export des actions depuis le site SAILL<b></td>
	</tr>
	<tr>
		<td><b>Date:</b></td>
                <?php $date=new DateTime(); 
                $date->setTimezone(new DateTimeZone('Europe/Paris'));?>
		<td><?php echo $date->format("d/m/Y H:i:s"); ?></td>
	</tr>
	<tr>
		<td><b>Nombre de lignes:</b></td>
		<td style="text-align:left"><?php echo count($results);?></td>
	</tr>
	<tr>
		<td></td>
                <td></td>
                <td></td>
                <td class="tableTd" colspan="5" style="text-align:center;">Centre de coût</td> 
	</tr>
		<tr id="titles">
                    <td class="tableTd">Société</td>
                    <td class="tableTd">Identifiant</td>
                    <td class="tableTd">Agents</td>
                    <td class="tableTd">Projet Centre de Coût</td>
                    <td class="tableTd">Libellé Projet Centre de Coût</td>
                    <td class="tableTd">Activité Centre de Coût</td>
                    <td class="tableTd">Régul en nbr de jrs</td>                  
                    <td class="tableTd">Jours</td>
                    <td class="tableTd">Code projet</td>
                    <td class="tableTd">Projet</td>
                    <td class="tableTd">Code activité</td>
                    <td class="tableTd">Activité</td>                       
		</tr>		
                <?php foreach($results as $result): ?>
                    <?php $mois = $result[0]['MONTH'] < 10 ? '0'.$result[0]['MONTH'] : $result[0]['MONTH']; ?>
                    <?php 
                            $nbaction = $result[0]['NB'];
                            foreach($entrops as $item):
                                if($result['Activite']['projet_id']==$item['projet_id'] && $result['Activite']['id']==$item['activite_id'] && $result['Utilisateur']['id']==$item['utilisateur_id'] && $mois==$item['mois']):
                                    $nbaction -= $item['sum'];
                                    $nbaction = number_format($nbaction, 1);
                                endif;
                            endforeach;
                        ?>   
                    <?php if($nbaction != '0.0' && ($result[0]['FRAIS']!='' || $result[0]['FRAIS']!='0.0')): ?>                 
			<?php echo '<tr>'; ?>
                            <td class="tableTdContent"><?php echo $result['Utilisateur']['societe_NOM']; ?></td>
                            <td class="tableTdContent"><?php echo $result['Utilisateur']['username']; ?></td>
                            <td class="tableTdContent"><?php echo $result['Utilisateur']['NOM'].' '.$result['Utilisateur']['PRENOM']; ?></td>
                            <td class="tableTdContent"><?php echo $result['Facturation']['cdc_CODEPROJET']; ?></td>
                            <td class="tableTdContent"><?php echo $result['Facturation']['cdc_NOM']; ?></td>
                            <td class="tableTdContent"><?php echo $result['Facturation']['cdc_CODEACTIVITE']; ?></td>
                            <td class="tableTdContent"><?php echo ''; ?></td>
                            <td class="tableTdContent" style="text-align:right;"><?php echo convertDecimal($nbaction); ?></td>
                            <td class="tableTdContent"><?php echo $result['Facturation']['projet_GALILEI']; ?></td>
                            <td class="tableTdContent"><?php echo $result['Facturation']['projet_NOM']; ?></td>
                            <td class="tableTdContent"><?php echo $result['Activite']['NUMEROGALLILIE']; ?></td>
                            <td class="tableTdContent"><?php echo $result['Activite']['NOM']; ?></td>
                        <?php echo '</tr>';
                   endif;
                endforeach; ?>
</table>