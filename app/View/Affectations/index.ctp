<div class="affectations index">
	<h2><?php echo __('Affectations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('ID'); ?></th>
			<th><?php echo $this->Paginator->sort('UTILISATEUR_ID'); ?></th>
			<th><?php echo $this->Paginator->sort('ACTIVITE_ID'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($affectations as $affectation): ?>
	<tr>
		<td><?php echo h($affectation['Affectation']['ID']); ?>&nbsp;</td>
		<td><?php echo h($affectation['Affectation']['UTILISATEUR_ID']); ?>&nbsp;</td>
		<td><?php echo h($affectation['Affectation']['ACTIVITE_ID']); ?>&nbsp;</td>
		<td><?php echo h($affectation['Affectation']['created']); ?>&nbsp;</td>
		<td><?php echo h($affectation['Affectation']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $affectation['Affectation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $affectation['Affectation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $affectation['Affectation']['id']), null, __('Are you sure you want to delete # %s?', $affectation['Affectation']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Affectation'), array('action' => 'add')); ?></li>
	</ul>
</div>
