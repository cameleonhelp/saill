<STYLE type="text/css">
	.tableTd,.footer {
	   	border-width: 0.5pt; 
		border: solid; 
                background-color: #CCCCFF;
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
<table>
	<tr>
            <td colspan="5">Direction des Systèmes d'information et des Télécommunications<br>
Division Production Lyon - Assistance Samba<br>
Bal :assistance.samba@sncf.fr <br>
Tel : 04 78 65 44 44 / SNCF 54 44 44<br>
Fax : 04 78 65 50 71 / SNCF 54 50 71</td>
	</tr>
        <tr><td style="text-align:center;" colspan="5">Demande de Création de Compte et Boite aux Lettre "inter personnelle"<br>
                 Assistance Samba  ->  Demandeur  ->  Responsable habilité  ->  Demandeur  ->  Assistance Samba</td></tr>
        <tr><td colspan="5">CADRE RESERVE A ASSISTANCE SAMBA</td></tr>
	<tr>
		<td>N° Dossier Service Center:</td>
                <td class="tableTd">IM <?php echo date('Y'); ?>-</td>
                <td></td>
                <td>Date Demande:</td>
                <td class="tableTd"><?php echo date('d/m/Y'); ?></td>
	</tr>
        <tr><td colspan="5">A REMPLIR PAR LE DEMANDEUR puis à transmettre vers le responsable habilité</td></tr>
        <tr><td>Création de compte</td><td style="text-align:center;" class="tableTd">x</td><td></td><td>Création Boîte aux lettres</td><td style="text-align:center;" class="tableTd">x</td></tr>
        <tr><td>Nom</td><td class="tableTd"><?php echo $rows['Utilisateur']['NOM']; ?></td><td></td><td>Prénom</td><td class="tableTd"><?php echo $rows['Utilisateur']['PRENOM']; ?></td></tr>
        <tr><td>Batiment</td><td class="tableTd"><?php echo $rows['Site']['NOM']; ?></td><td></td><td></td><td></td></tr>
        <tr><td>Cercle</td><td class="tableTd"><?php echo $rows['Section']['NOM'] != "GROUPEMENT" ? $rows['Section']['NOM'] : "DSI-T/SO MAT GMAO-PANAM"; ?></td><td></td><td></td><td></td></tr>
        <tr><td>Naissance</td><td class="tableTd"><?php echo $rows['Utilisateur']['NAISSANCE']; ?></td><td></td><td></td><td></td></tr>
        <tr><td>Date de fin de mission</td><td class="tableTd"><?php echo $rows['Utilisateur']['FINMISSION']; ?></td><td></td><td></td><td></td></tr>
        <tr><td>Société</td><td class="tableTd"><?php echo $rows['Societe']['NOM']; ?></td><td></td><td></td><td></td></tr>
</table>