<div class="actioncontributeurs index">
	<h2><?php echo __('Actioncontributeurs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('utilisateur_id'); ?></th>
			<th><?php echo $this->Paginator->sort('action_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($actioncontributeurs as $actioncontributeur): ?>
	<tr>
		<td><?php echo h($actioncontributeur['Actioncontributeur']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($actioncontributeur['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $actioncontributeur['Utilisateur']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($actioncontributeur['Action']['id'], array('controller' => 'actions', 'action' => 'view', $actioncontributeur['Action']['id'])); ?>
		</td>
		<td><?php echo h($actioncontributeur['Actioncontributeur']['created']); ?>&nbsp;</td>
		<td><?php echo h($actioncontributeur['Actioncontributeur']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $actioncontributeur['Actioncontributeur']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $actioncontributeur['Actioncontributeur']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $actioncontributeur['Actioncontributeur']['id']), null, __('Are you sure you want to delete # %s?', $actioncontributeur['Actioncontributeur']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Actioncontributeur'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Action'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
	</ul>
</div>
