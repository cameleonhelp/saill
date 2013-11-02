<div class="historyintegrations index">
	<h2><?php echo __('Historyintegrations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('intergrationapplicative_id'); ?></th>
			<th><?php echo $this->Paginator->sort('DATE'); ?></th>
			<th><?php echo $this->Paginator->sort('modifiedby'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($historyintegrations as $historyintegration): ?>
	<tr>
		<td><?php echo h($historyintegration['Historyintegration']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($historyintegration['Intergrationapplicative']['id'], array('controller' => 'intergrationapplicatives', 'action' => 'view', $historyintegration['Intergrationapplicative']['id'])); ?>
		</td>
		<td><?php echo h($historyintegration['Historyintegration']['DATE']); ?>&nbsp;</td>
		<td><?php echo h($historyintegration['Historyintegration']['modifiedby']); ?>&nbsp;</td>
		<td><?php echo h($historyintegration['Historyintegration']['created']); ?>&nbsp;</td>
		<td><?php echo h($historyintegration['Historyintegration']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $historyintegration['Historyintegration']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $historyintegration['Historyintegration']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $historyintegration['Historyintegration']['id']), null, __('Are you sure you want to delete # %s?', $historyintegration['Historyintegration']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Historyintegration'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Intergrationapplicatives'), array('controller' => 'intergrationapplicatives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Intergrationapplicative'), array('controller' => 'intergrationapplicatives', 'action' => 'add')); ?> </li>
	</ul>
</div>
