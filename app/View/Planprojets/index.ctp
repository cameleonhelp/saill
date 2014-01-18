<div class="planprojets index">
	<h2><?php echo __('Planprojets'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('utilisateur_id'); ?></th>
			<th><?php echo $this->Paginator->sort('NOM'); ?></th>
			<th><?php echo $this->Paginator->sort('DATEDEBUT'); ?></th>
			<th><?php echo $this->Paginator->sort('ECHEANCE'); ?></th>
			<th><?php echo $this->Paginator->sort('OPEN'); ?></th>
			<th><?php echo $this->Paginator->sort('PUBLIC'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($planprojets as $planprojet): ?>
	<tr>
		<td><?php echo h($planprojet['Planprojet']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($planprojet['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $planprojet['Utilisateur']['id'])); ?>
		</td>
		<td><?php echo h($planprojet['Planprojet']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($planprojet['Planprojet']['DATEDEBUT']); ?>&nbsp;</td>
		<td><?php echo h($planprojet['Planprojet']['ECHEANCE']); ?>&nbsp;</td>
		<td><?php echo h($planprojet['Planprojet']['OPEN']); ?>&nbsp;</td>
		<td><?php echo h($planprojet['Planprojet']['PUBLIC']); ?>&nbsp;</td>
		<td><?php echo h($planprojet['Planprojet']['created']); ?>&nbsp;</td>
		<td><?php echo h($planprojet['Planprojet']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $planprojet['Planprojet']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $planprojet['Planprojet']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $planprojet['Planprojet']['id']), null, __('Are you sure you want to delete # %s?', $planprojet['Planprojet']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Planprojet'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
	</ul>
</div>
