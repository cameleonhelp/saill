<br/>
<div class="dotations index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover tablemax">
        <thead>
	<tr>
			<th><?php echo 'Poste informatique'; ?></th>
			<th><?php echo 'Périphérique'; ?></th>
                        <th><?php echo 'Remis'; ?></th>
                        <th><?php echo 'Restitué'; ?></th>
                    <?php if ($this->params->action != 'profil') : ?>                        
                        <th class="actions" width='30px' style="text-align:center;"><?php echo __('Actions'); ?></th>
                    <?php endif; ?>	
        </tr>
        </thead>
        <tbody>
	<?php foreach ($dotations as $dotation): ?>
	<tr>
		<td><?php echo h($dotation['Materielinformatique']['NOM']); ?>&nbsp;</td>
                <td><?php echo h($dotation['Typemateriel']['NOM']); ?>&nbsp;</td>
                <td width="100px" style="text-align:center;"><?php echo h($dotation['Dotation']['DATERECEPTION']); ?>&nbsp;</td>
                <td width="100px" style="text-align:center;"><?php echo h($dotation['Dotation']['DATEREMISE']); ?>&nbsp;</td>
		<?php if ($this->params->action != 'profil') : ?>
                <td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('dotations', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange"></span>', array('controller'=>'Dotations','action' => 'edit', $dotation['Dotation']['id'], $this->params->pass[0]),array('escape' => false)); ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('dotations', 'delete')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons bin notchange"></span>', array('controller'=>'Dotations','action' => 'delete', $dotation['Dotation']['id'], $this->params->pass[0]),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette dotation ?')); ?>                    
                    <?php endif; ?> 
		</td>
                <?php endif; ?>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
    </div>