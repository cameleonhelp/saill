<br/>
<div class="dotations index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo 'Dotations'; ?></th>
			<th class="actions" width='40px'><?php echo __('Actions'); ?></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($dotations as $dotation): ?>
	<tr>
		<td><?php echo h($dotation['Dotation']['NOM']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $dotation['Dotation']['id']),array('escape' => false)); ?>&nbsp;
			<?php echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $dotation['Dotation']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette dotation ?')); ?>                    
		</td>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
    </div>