<div class="environnementbiens index">
	<h2><?php echo __('Environnementbiens'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('expressionbesoin_id'); ?></th>
			<th><?php echo $this->Paginator->sort('bien_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($environnementbiens as $environnementbien): ?>
	<tr>
		<td><?php echo h($environnementbien['Environnementbien']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($environnementbien['Expressionbesoin']['id'], array('controller' => 'expressionbesoins', 'action' => 'view', $environnementbien['Expressionbesoin']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($environnementbien['Bien']['id'], array('controller' => 'biens', 'action' => 'view', $environnementbien['Bien']['id'])); ?>
		</td>
		<td><?php echo h($environnementbien['Environnementbien']['created']); ?>&nbsp;</td>
		<td><?php echo h($environnementbien['Environnementbien']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $environnementbien['Environnementbien']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $environnementbien['Environnementbien']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $environnementbien['Environnementbien']['id']), null, __('Are you sure you want to delete # %s?', $environnementbien['Environnementbien']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Environnementbien'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Expressionbesoins'), array('controller' => 'expressionbesoins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Expressionbesoin'), array('controller' => 'expressionbesoins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Biens'), array('controller' => 'biens', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bien'), array('controller' => 'biens', 'action' => 'add')); ?> </li>
	</ul>
</div>
