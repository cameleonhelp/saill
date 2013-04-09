<div class="detailplancharges index">
	<h2><?php echo __('Detailplancharges'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('plancharge_id'); ?></th>
			<th><?php echo $this->Paginator->sort('utilisateur_id'); ?></th>
			<th><?php echo $this->Paginator->sort('CAPCITY'); ?></th>
			<th><?php echo $this->Paginator->sort('domaine_id'); ?></th>
			<th><?php echo $this->Paginator->sort('activite_id'); ?></th>
			<th><?php echo $this->Paginator->sort('CHARGEPREVUE'); ?></th>
			<th><?php echo $this->Paginator->sort('CHARGEREELLEE'); ?></th>
			<th><?php echo $this->Paginator->sort('PERIODE'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($detailplancharges as $detailplancharge): ?>
	<tr>
		<td><?php echo h($detailplancharge['Detailplancharge']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($detailplancharge['Plancharge']['id'], array('controller' => 'plancharges', 'action' => 'view', $detailplancharge['Plancharge']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($detailplancharge['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $detailplancharge['Utilisateur']['id'])); ?>
		</td>
		<td><?php echo h($detailplancharge['Detailplancharge']['CAPCITY']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($detailplancharge['Domaine']['id'], array('controller' => 'domaines', 'action' => 'view', $detailplancharge['Domaine']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($detailplancharge['Activite']['id'], array('controller' => 'activites', 'action' => 'view', $detailplancharge['Activite']['id'])); ?>
		</td>
		<td><?php echo h($detailplancharge['Detailplancharge']['CHARGEPREVUE']); ?>&nbsp;</td>
		<td><?php echo h($detailplancharge['Detailplancharge']['CHARGEREELLEE']); ?>&nbsp;</td>
		<td><?php echo h($detailplancharge['Detailplancharge']['PERIODE']); ?>&nbsp;</td>
		<td><?php echo h($detailplancharge['Detailplancharge']['created']); ?>&nbsp;</td>
		<td><?php echo h($detailplancharge['Detailplancharge']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $detailplancharge['Detailplancharge']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $detailplancharge['Detailplancharge']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $detailplancharge['Detailplancharge']['id']), null, __('Are you sure you want to delete # %s?', $detailplancharge['Detailplancharge']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Detailplancharge'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Plancharges'), array('controller' => 'plancharges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plancharge'), array('controller' => 'plancharges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Domaines'), array('controller' => 'domaines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Domaine'), array('controller' => 'domaines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Activites'), array('controller' => 'activites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activite'), array('controller' => 'activites', 'action' => 'add')); ?> </li>
	</ul>
</div>
