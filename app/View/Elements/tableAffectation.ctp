<br/>
<div class="affectations index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
        <thead>
	<tr>
			<th><?php echo 'Activités'; ?></th>
			<th class="actions" width='40px'><?php echo __('Actions'); ?></th>
	</tr>
        </thead>
        <tbody>
	<?php foreach ($affectations as $affectation): ?>
	<tr>
		<td><?php echo h($affectation['Activite']['NOM']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $affectation['Affectation']['id']),array('escape' => false)); ?>&nbsp;
			<?php echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $affectation['Affectation']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette affectation ?')); ?>                    
		</td>
	</tr>
<?php endforeach; ?>
        </tbody>
	</table>
    </div>

