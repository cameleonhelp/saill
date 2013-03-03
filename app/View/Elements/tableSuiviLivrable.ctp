 <?php
 /**
 * etatMaterielInformatiqueImage method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $etat
 * @return string class
 */  
        function etatLivrable($etat) {
            $class = '';
            switch ($etat){
                 case 'A Faire':
                    $class = 'icon-edit icon-red';
                    break;
                 case 'En cours':
                    $class = 'icon-edit';
                    break;                
                 case 'Livré':
                    $class = 'icon-share';
                    break;          
                 case 'Validé':
                    $class = 'icon-check icon-green';
                    break;               
            }
            return $class;
        } 
?>    
<br/><br/>
<div class="utiliseoutils index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo 'Echéance'; ?></th>
			<th><?php echo 'Date de livraison'; ?></th>
                        <th><?php echo 'Date de validation'; ?></th>
                        <th width='70px'><?php echo 'Etat'; ?></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($this->data['Suivilivrable'] as $Suivilivrable): ?>
            <tr>
		<td><?php echo h($Suivilivrable['ECHEANCE']); ?>&nbsp;</td>
                <td><?php echo h($Suivilivrable['DATELIVRAISON']); ?>&nbsp;</td>
                <td><?php echo h($Suivilivrable['DATEVALIDATION']); ?>&nbsp;</td>
                <td style='text-align:center;'><i class="<?php echo etatLivrable(h($Suivilivrable['ETAT'])); ?>" rel="tooltip" data-title="<?php echo h($Suivilivrable['ETAT']); ?>"></i>&nbsp;</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
	</table>
    </div>