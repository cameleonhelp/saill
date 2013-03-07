<div class="suivilivrables index">
	<h2><?php echo __('Suivilivrables'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('ID'); ?></th>
			<th><?php echo $this->Paginator->sort('LIVRABLE_ID'); ?></th>
			<th><?php echo $this->Paginator->sort('ECHEANCE'); ?></th>
			<th><?php echo $this->Paginator->sort('DATELIVRAISON'); ?></th>
			<th><?php echo $this->Paginator->sort('DATEVALIDATION'); ?></th>
			<th><?php echo $this->Paginator->sort('ETAT'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($suivilivrables as $suivilivrable): ?>
	<tr>
		<td><?php echo h($suivilivrable['Suivilivrable']['ID']); ?>&nbsp;</td>
		<td><?php echo h($suivilivrable['Suivilivrable']['LIVRABLE_ID']); ?>&nbsp;</td>
		<td><?php echo h($suivilivrable['Suivilivrable']['ECHEANCE']); ?>&nbsp;</td>
		<td><?php echo h($suivilivrable['Suivilivrable']['DATELIVRAISON']); ?>&nbsp;</td>
		<td><?php echo h($suivilivrable['Suivilivrable']['DATEVALIDATION']); ?>&nbsp;</td>
		<td><?php echo h($suivilivrable['Suivilivrable']['ETAT']); ?>&nbsp;</td>
		<td><?php echo h($suivilivrable['Suivilivrable']['created']); ?>&nbsp;</td>
		<td><?php echo h($suivilivrable['Suivilivrable']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $suivilivrable['Suivilivrable']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $suivilivrable['Suivilivrable']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $suivilivrable['Suivilivrable']['id']), null, __('Are you sure you want to delete # %s?', $suivilivrable['Suivilivrable']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Suivilivrable'), array('action' => 'add')); ?></li>
	</ul>
</div>
