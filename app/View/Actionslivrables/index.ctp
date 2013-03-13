<div class="actionslivrables index">
	<h2><?php echo __('Actionslivrables'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('livrables_id'); ?></th>
			<th><?php echo $this->Paginator->sort('actions_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($actionslivrables as $actionslivrable): ?>
	<tr>
		<td><?php echo h($actionslivrable['Actionslivrable']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($actionslivrable['Livrables']['id'], array('controller' => 'livrables', 'action' => 'view', $actionslivrable['Livrables']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($actionslivrable['Actions']['id'], array('controller' => 'actions', 'action' => 'view', $actionslivrable['Actions']['id'])); ?>
		</td>
		<td><?php echo h($actionslivrable['Actionslivrable']['created']); ?>&nbsp;</td>
		<td><?php echo h($actionslivrable['Actionslivrable']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $actionslivrable['Actionslivrable']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $actionslivrable['Actionslivrable']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $actionslivrable['Actionslivrable']['id']), null, __('Are you sure you want to delete # %s?', $actionslivrable['Actionslivrable']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Actionslivrable'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Livrables'), array('controller' => 'livrables', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Livrables'), array('controller' => 'livrables', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Actions'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
	</ul>
</div>
