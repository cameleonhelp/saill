<div class="plandecharges index">
	<h2><?php echo __('Plandecharges'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('utilisateur_id'); ?></th>
			<th><?php echo $this->Paginator->sort('domaine_id'); ?></th>
			<th><?php echo $this->Paginator->sort('activite_id'); ?></th>
			<th><?php echo $this->Paginator->sort('CHARGEPREVUE'); ?></th>
			<th><?php echo $this->Paginator->sort('PERIODE'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($plandecharges as $plandecharge): ?>
	<tr>
		<td><?php echo h($plandecharge['Plandecharge']['id']); ?>&nbsp;</td>
		<td><?php echo h($plandecharge['Plandecharge']['utilisateur_id']); ?>&nbsp;</td>
		<td><?php echo h($plandecharge['Plandecharge']['domaine_id']); ?>&nbsp;</td>
		<td><?php echo h($plandecharge['Plandecharge']['activite_id']); ?>&nbsp;</td>
		<td><?php echo h($plandecharge['Plandecharge']['CHARGEPREVUE']); ?>&nbsp;</td>
		<td><?php echo h($plandecharge['Plandecharge']['PERIODE']); ?>&nbsp;</td>
		<td><?php echo h($plandecharge['Plandecharge']['created']); ?>&nbsp;</td>
		<td><?php echo h($plandecharge['Plandecharge']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $plandecharge['Plandecharge']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $plandecharge['Plandecharge']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $plandecharge['Plandecharge']['id']), null, __('Are you sure you want to delete # %s?', $plandecharge['Plandecharge']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Plandecharge'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Affectations'), array('controller' => 'affectations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Affectation'), array('controller' => 'affectations', 'action' => 'add')); ?> </li>
	</ul>
</div>
