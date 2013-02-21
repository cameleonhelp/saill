<div class="historyactions index">
	<h2><?php echo __('Historyactions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('ID'); ?></th>
			<th><?php echo $this->Paginator->sort('ACTION_ID'); ?></th>
			<th><?php echo $this->Paginator->sort('UTILISATEUR_ID'); ?></th>
			<th><?php echo $this->Paginator->sort('HISTORIQUE'); ?></th>
			<th><?php echo $this->Paginator->sort('STATUT'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($historyactions as $historyaction): ?>
	<tr>
		<td><?php echo h($historyaction['Historyaction']['ID']); ?>&nbsp;</td>
		<td><?php echo h($historyaction['Historyaction']['ACTION_ID']); ?>&nbsp;</td>
		<td><?php echo h($historyaction['Historyaction']['UTILISATEUR_ID']); ?>&nbsp;</td>
		<td><?php echo h($historyaction['Historyaction']['HISTORIQUE']); ?>&nbsp;</td>
		<td><?php echo h($historyaction['Historyaction']['STATUT']); ?>&nbsp;</td>
		<td><?php echo h($historyaction['Historyaction']['created']); ?>&nbsp;</td>
		<td><?php echo h($historyaction['Historyaction']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $historyaction['Historyaction']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $historyaction['Historyaction']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $historyaction['Historyaction']['id']), null, __('Are you sure you want to delete # %s?', $historyaction['Historyaction']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Historyaction'), array('action' => 'add')); ?></li>
	</ul>
</div>
