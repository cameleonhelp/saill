<div class="historybudgets index">
	<h2><?php echo __('Historybudgets'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('activite_id'); ?></th>
			<th><?php echo $this->Paginator->sort('ANNEE'); ?></th>
			<th><?php echo $this->Paginator->sort('PREVU'); ?></th>
			<th><?php echo $this->Paginator->sort('REVU'); ?></th>
			<th><?php echo $this->Paginator->sort('ACTIF'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($historybudgets as $historybudget): ?>
	<tr>
		<td><?php echo h($historybudget['Historybudget']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($historybudget['Activite']['id'], array('controller' => 'activites', 'action' => 'view', $historybudget['Activite']['id'])); ?>
		</td>
		<td><?php echo h($historybudget['Historybudget']['ANNEE']); ?>&nbsp;</td>
		<td><?php echo h($historybudget['Historybudget']['PREVU']); ?>&nbsp;</td>
		<td><?php echo h($historybudget['Historybudget']['REVU']); ?>&nbsp;</td>
		<td><?php echo h($historybudget['Historybudget']['ACTIF']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $historybudget['Historybudget']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $historybudget['Historybudget']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $historybudget['Historybudget']['id']), null, __('Are you sure you want to delete # %s?', $historybudget['Historybudget']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Historybudget'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Activites'), array('controller' => 'activites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activite'), array('controller' => 'activites', 'action' => 'add')); ?> </li>
	</ul>
</div>
