<div class="historylogiciels index">
	<h2><?php echo __('Historylogiciels'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('logiciel_id'); ?></th>
			<th><?php echo $this->Paginator->sort('INSTALL'); ?></th>
			<th><?php echo $this->Paginator->sort('DATECHECKINSTALL'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($historylogiciels as $historylogiciel): ?>
	<tr>
		<td><?php echo h($historylogiciel['Historylogiciel']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($historylogiciel['Logiciel']['id'], array('controller' => 'logiciels', 'action' => 'view', $historylogiciel['Logiciel']['id'])); ?>
		</td>
		<td><?php echo h($historylogiciel['Historylogiciel']['INSTALL']); ?>&nbsp;</td>
		<td><?php echo h($historylogiciel['Historylogiciel']['DATECHECKINSTALL']); ?>&nbsp;</td>
		<td><?php echo h($historylogiciel['Historylogiciel']['created']); ?>&nbsp;</td>
		<td><?php echo h($historylogiciel['Historylogiciel']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $historylogiciel['Historylogiciel']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $historylogiciel['Historylogiciel']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $historylogiciel['Historylogiciel']['id']), null, __('Are you sure you want to delete # %s?', $historylogiciel['Historylogiciel']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Historylogiciel'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Logiciels'), array('controller' => 'logiciels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Logiciel'), array('controller' => 'logiciels', 'action' => 'add')); ?> </li>
	</ul>
</div>
