<div class="periodicites index">
	<h2><?php echo __('Periodicites'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('END'); ?></th>
			<th><?php echo $this->Paginator->sort('ALLDAYMONTH'); ?></th>
			<th><?php echo $this->Paginator->sort('REPEATALL'); ?></th>
			<th><?php echo $this->Paginator->sort('LU'); ?></th>
			<th><?php echo $this->Paginator->sort('MA'); ?></th>
			<th><?php echo $this->Paginator->sort('ME'); ?></th>
			<th><?php echo $this->Paginator->sort('JE'); ?></th>
			<th><?php echo $this->Paginator->sort('VE'); ?></th>
			<th><?php echo $this->Paginator->sort('SA'); ?></th>
			<th><?php echo $this->Paginator->sort('DI'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($periodicites as $periodicite): ?>
	<tr>
		<td><?php echo h($periodicite['Periodicite']['id']); ?>&nbsp;</td>
		<td><?php echo h($periodicite['Periodicite']['END']); ?>&nbsp;</td>
		<td><?php echo h($periodicite['Periodicite']['ALLDAYMONTH']); ?>&nbsp;</td>
		<td><?php echo h($periodicite['Periodicite']['REPEATALL']); ?>&nbsp;</td>
		<td><?php echo h($periodicite['Periodicite']['LU']); ?>&nbsp;</td>
		<td><?php echo h($periodicite['Periodicite']['MA']); ?>&nbsp;</td>
		<td><?php echo h($periodicite['Periodicite']['ME']); ?>&nbsp;</td>
		<td><?php echo h($periodicite['Periodicite']['JE']); ?>&nbsp;</td>
		<td><?php echo h($periodicite['Periodicite']['VE']); ?>&nbsp;</td>
		<td><?php echo h($periodicite['Periodicite']['SA']); ?>&nbsp;</td>
		<td><?php echo h($periodicite['Periodicite']['DI']); ?>&nbsp;</td>
		<td><?php echo h($periodicite['Periodicite']['created']); ?>&nbsp;</td>
		<td><?php echo h($periodicite['Periodicite']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $periodicite['Periodicite']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $periodicite['Periodicite']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $periodicite['Periodicite']['id']), null, __('Are you sure you want to delete # %s?', $periodicite['Periodicite']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Periodicite'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Action'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
	</ul>
</div>
