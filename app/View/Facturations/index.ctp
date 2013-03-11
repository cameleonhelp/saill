<div class="facturations index">
	<h2><?php echo __('Facturations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('utilisateur_id'); ?></th>
			<th><?php echo $this->Paginator->sort('activite_id'); ?></th>
			<th><?php echo $this->Paginator->sort('DATE'); ?></th>
			<th><?php echo $this->Paginator->sort('LU'); ?></th>
			<th><?php echo $this->Paginator->sort('LU_TYPE'); ?></th>
			<th><?php echo $this->Paginator->sort('MA'); ?></th>
			<th><?php echo $this->Paginator->sort('MA_TYPE'); ?></th>
			<th><?php echo $this->Paginator->sort('ME'); ?></th>
			<th><?php echo $this->Paginator->sort('ME_TYPE'); ?></th>
			<th><?php echo $this->Paginator->sort('JE'); ?></th>
			<th><?php echo $this->Paginator->sort('JE_TYPE'); ?></th>
			<th><?php echo $this->Paginator->sort('VE'); ?></th>
			<th><?php echo $this->Paginator->sort('VE_TYPE'); ?></th>
			<th><?php echo $this->Paginator->sort('SA'); ?></th>
			<th><?php echo $this->Paginator->sort('SA_TYPE'); ?></th>
			<th><?php echo $this->Paginator->sort('DI'); ?></th>
			<th><?php echo $this->Paginator->sort('DI_TYPE'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($facturations as $facturation): ?>
	<tr>
		<td><?php echo h($facturation['Facturation']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($facturation['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $facturation['Utilisateur']['id'])); ?>
		</td>
		<td><?php echo h($facturation['Facturation']['activite_id']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['DATE']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['LU']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['LU_TYPE']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['MA']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['MA_TYPE']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['ME']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['ME_TYPE']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['JE']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['JE_TYPE']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['VE']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['VE_TYPE']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['SA']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['SA_TYPE']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['DI']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['DI_TYPE']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['created']); ?>&nbsp;</td>
		<td><?php echo h($facturation['Facturation']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $facturation['Facturation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $facturation['Facturation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $facturation['Facturation']['id']), null, __('Are you sure you want to delete # %s?', $facturation['Facturation']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Facturation'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Action'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
	</ul>
</div>
