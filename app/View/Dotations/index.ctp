<div class="dotations index">
	<h2><?php echo __('Dotations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('ID'); ?></th>
			<th><?php echo $this->Paginator->sort('MATERIELINFORMATIQUE_ID'); ?></th>
			<th><?php echo $this->Paginator->sort('MATERIELAUTRES_ID'); ?></th>
			<th><?php echo $this->Paginator->sort('UTILISATEUR_ID'); ?></th>
			<th><?php echo $this->Paginator->sort('DATERECEPTION'); ?></th>
			<th><?php echo $this->Paginator->sort('DATEREMISE'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($dotations as $dotation): ?>
	<tr>
		<td><?php echo h($dotation['Dotation']['ID']); ?>&nbsp;</td>
		<td><?php echo h($dotation['Dotation']['MATERIELINFORMATIQUE_ID']); ?>&nbsp;</td>
		<td><?php echo h($dotation['Dotation']['MATERIELAUTRES_ID']); ?>&nbsp;</td>
		<td><?php echo h($dotation['Dotation']['UTILISATEUR_ID']); ?>&nbsp;</td>
		<td><?php echo h($dotation['Dotation']['DATERECEPTION']); ?>&nbsp;</td>
		<td><?php echo h($dotation['Dotation']['DATEREMISE']); ?>&nbsp;</td>
		<td><?php echo h($dotation['Dotation']['created']); ?>&nbsp;</td>
		<td><?php echo h($dotation['Dotation']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $dotation['Dotation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $dotation['Dotation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $dotation['Dotation']['id']), null, __('Are you sure you want to delete # %s?', $dotation['Dotation']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Dotation'), array('action' => 'add')); ?></li>
	</ul>
</div>
