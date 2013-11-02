<div class="coutuos index">
	<h2><?php echo __('Coutuos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('NOMUO'); ?></th>
			<th><?php echo $this->Paginator->sort('MONTANT'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($coutuos as $coutuo): ?>
	<tr>
		<td><?php echo h($coutuo['Coutuo']['id']); ?>&nbsp;</td>
		<td><?php echo h($coutuo['Coutuo']['NOMUO']); ?>&nbsp;</td>
		<td><?php echo h($coutuo['Coutuo']['MONTANT']); ?>&nbsp;</td>
		<td><?php echo h($coutuo['Coutuo']['created']); ?>&nbsp;</td>
		<td><?php echo h($coutuo['Coutuo']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $coutuo['Coutuo']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $coutuo['Coutuo']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $coutuo['Coutuo']['id']), null, __('Are you sure you want to delete # %s?', $coutuo['Coutuo']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Coutuo'), array('action' => 'add')); ?></li>
	</ul>
</div>
