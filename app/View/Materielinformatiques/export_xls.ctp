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
		<td><b>Export des matériels informatiques depuis le site OSACT<b></td>
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
			<td class="tableTd">Type</td>
                        <td class="tableTd">Section</td>
                        <td class="tableTd">Assistance</td>
                        <td class="tableTd">Etat</td>
                        <td class="tableTd">Wifi</td>
                        <td class="tableTd">VPN</td>
                        <td class="tableTd">Commentaire</td>
		</tr>		
		<?php foreach($rows as $row):
			echo '<tr>';
			echo '<td class="tableTdContent">'.$row['Materielinformatique']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Typemateriel']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Section']['NOM'].'</td>';                        
			echo '<td class="tableTdContent">'.$row['Assistance']['NOM'].'</td>';
			echo '<td class="tableTdContent">'.$row['Materielinformatique']['ETAT'].'</td>';
                        $wifi = $row['Materielinformatique']['WIFI']==1 ? 'Oui' : 'Non';
			echo '<td class="tableTdContent">'.$wifi.'</td>';
                        $vpn = $row['Materielinformatique']['VPN']==1 ? 'Oui' : 'Non';
			echo '<td class="tableTdContent">'.$vpn.'</td>';
			echo '<td class="tableTdContent">'.$row['Materielinformatique']['COMMENTAIRE'].'</td>';
                        echo '</tr>';
			endforeach;
		?>
</table>