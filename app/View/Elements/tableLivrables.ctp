<br/>
<div class="livrables index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo 'Nom'; ?></th>
			<th><?php echo 'Réf. MINIDOC'; ?></th>
                        <th><?php echo 'Version'; ?></th>
                        <th width='40px'><?php echo 'Etat'; ?></th>
			<th width="90px"><?php echo 'Echéance'; ?></th>
			<th width="90px"><?php echo 'Date de livraison'; ?></th> 
                        <th width="20px"></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($livrables as $livrable): ?>
	<tr>
		<td><?php echo h($livrable['Livrable']['NOM']); ?>&nbsp;</td>
                <td><?php echo h(isset($livrable['Livrable']['REFERENCE']) ? $livrable['Livrable']['REFERENCE'] : ''); ?>&nbsp;</td>
                <td><?php echo h(isset($livrable['Livrable']['VERSION']))? $livrable['Livrable']['VERSION'] : ''; ?>&nbsp;</td>
                <td style="text-align: center;"><?php echo isset($livrable['Livrable']['ETAT']) ? '<span class="glyphicons '.etatLivrable(h($livrable['Livrable']['ETAT'])).'" rel="tooltip" data-title="'.h($livrable['Livrable']['ETAT']).'"></span>' : '' ; ?></td>
		<td style="text-align: center;"><?php echo h(isset($livrable['Livrable']['ECHEANCE']) ? $livrable['Livrable']['ECHEANCE'] : ''); ?>&nbsp;</td>
		<td style="text-align: center;"><?php echo h(isset($livrable['Livrable']['DATELIVRAISON']) ? $livrable['Livrable']['DATELIVRAISON'] : ''); ?>&nbsp;</td>
                <td>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'delete')) : ?>
                <?php echo $this->Html->link('<sapn class="glyphicons bin"></span>', array('controller'=>'Actionslivrables','action' => 'delete', $livrable['Actionslivrable']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette association ?')); ?>                    
                <?php endif; ?>	
                </td>
        </tr>
<?php endforeach; ?>
        </tbody>
	</table>
    </div>
