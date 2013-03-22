<br/>
<div class="dotations index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo 'Poste informatique'; ?></th>
			<th><?php echo 'Périphérique'; ?></th>
                        <th><?php echo 'Remis'; ?></th>
                        <th><?php echo 'Restitué'; ?></th>
                        <th class="actions" width='30px' style="text-align:center;"><?php echo __('Actions'); ?></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($dotations as $dotation): ?>
	<tr>
		<td><?php echo h($dotation['Materielinformatique']['NOM']); ?>&nbsp;</td>
                <td><?php echo h($dotation['Typemateriel']['NOM']); ?>&nbsp;</td>
                <td width="100px" style="text-align:center;"><?php echo h($dotation['Dotation']['DATERECEPTION']); ?>&nbsp;</td>
                <td width="100px" style="text-align:center;"><?php echo h($dotation['Dotation']['DATEREMISE']); ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('dotations', 'edit')) : ?>
                    <?php echo $this->Html->link('<i class="icon-pencil"></i>', array('controller'=>'Dotations','action' => 'edit', $dotation['Dotation']['id'], $this->params->pass[0]),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('dotations', 'delete')) : ?>
                    <?php echo $this->Html->link('<i class="icon-trash"></i>', array('controller'=>'Dotations','action' => 'delete', $dotation['Dotation']['id'], $this->params->pass[0]),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette dotation ?')); ?>                    
                    <?php endif; ?>
		</td>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
    </div>