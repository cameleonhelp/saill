<div class="historydotations index">
	<h2><?php echo __('Historydotations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('ID'); ?></th>
			<th><?php echo $this->Paginator->sort('DOTATION_ID'); ?></th>
			<th><?php echo $this->Paginator->sort('HISTORIQUE'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($historydotations as $historydotation): ?>
	<tr>
		<td><?php echo h($historydotation['Historydotation']['ID']); ?>&nbsp;</td>
		<td><?php echo h($historydotation['Historydotation']['DOTATION_ID']); ?>&nbsp;</td>
		<td><?php echo h($historydotation['Historydotation']['HISTORIQUE']); ?>&nbsp;</td>
		<td><?php echo h($historydotation['Historydotation']['created']); ?>&nbsp;</td>
		<td><?php echo h($historydotation['Historydotation']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $historydotation['Historydotation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $historydotation['Historydotation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $historydotation['Historydotation']['id']), null, __('Are you sure you want to delete # %s?', $historydotation['Historydotation']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Historydotation'), array('action' => 'add')); ?></li>
	</ul>
</div>
