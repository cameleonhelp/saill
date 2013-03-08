<div class="activitesreelles index">
	<h2><?php echo __('Activitesreelles'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('utilisateur_id'); ?></th>
			<th><?php echo $this->Paginator->sort('action_id'); ?></th>
			<th><?php echo $this->Paginator->sort('DATE'); ?></th>
			<th><?php echo $this->Paginator->sort('CHARGE'); ?></th>
			<th><?php echo $this->Paginator->sort('TYPE'); ?></th>
			<th><?php echo $this->Paginator->sort('PERIODE'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($activitesreelles as $activitesreelle): ?>
	<tr>
		<td><?php echo h($activitesreelle['Activitesreelle']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($activitesreelle['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $activitesreelle['Utilisateur']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($activitesreelle['Action']['id'], array('controller' => 'actions', 'action' => 'view', $activitesreelle['Action']['id'])); ?>
		</td>
		<td><?php echo h($activitesreelle['Activitesreelle']['DATE']); ?>&nbsp;</td>
		<td><?php echo h($activitesreelle['Activitesreelle']['CHARGE']); ?>&nbsp;</td>
		<td><?php echo h($activitesreelle['Activitesreelle']['TYPE']); ?>&nbsp;</td>
		<td><?php echo h($activitesreelle['Activitesreelle']['PERIODE']); ?>&nbsp;</td>
		<td><?php echo h($activitesreelle['Activitesreelle']['created']); ?>&nbsp;</td>
		<td><?php echo h($activitesreelle['Activitesreelle']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $activitesreelle['Activitesreelle']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $activitesreelle['Activitesreelle']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $activitesreelle['Activitesreelle']['id']), null, __('Are you sure you want to delete # %s?', $activitesreelle['Activitesreelle']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Activitesreelle'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Action'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
	</ul>
</div>
