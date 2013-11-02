<div class="historyexpbs index">
	<h2><?php echo __('Historyexpbs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('expressionbesoins_id'); ?></th>
			<th><?php echo $this->Paginator->sort('etat_id'); ?></th>
			<th><?php echo $this->Paginator->sort('DATEFIN'); ?></th>
			<th><?php echo $this->Paginator->sort('DATELIVRAISON'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($historyexpbs as $historyexpb): ?>
	<tr>
		<td><?php echo h($historyexpb['Historyexpb']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($historyexpb['Expressionbesoins']['id'], array('controller' => 'expressionbesoins', 'action' => 'view', $historyexpb['Expressionbesoins']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($historyexpb['Etat']['id'], array('controller' => 'etats', 'action' => 'view', $historyexpb['Etat']['id'])); ?>
		</td>
		<td><?php echo h($historyexpb['Historyexpb']['DATEFIN']); ?>&nbsp;</td>
		<td><?php echo h($historyexpb['Historyexpb']['DATELIVRAISON']); ?>&nbsp;</td>
		<td><?php echo h($historyexpb['Historyexpb']['created']); ?>&nbsp;</td>
		<td><?php echo h($historyexpb['Historyexpb']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $historyexpb['Historyexpb']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $historyexpb['Historyexpb']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $historyexpb['Historyexpb']['id']), null, __('Are you sure you want to delete # %s?', $historyexpb['Historyexpb']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Historyexpb'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Expressionbesoins'), array('controller' => 'expressionbesoins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Expressionbesoins'), array('controller' => 'expressionbesoins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Etats'), array('controller' => 'etats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Etat'), array('controller' => 'etats', 'action' => 'add')); ?> </li>
	</ul>
</div>
