<div class="assoentiteutilisateurs index">
	<h2><?php echo __('Assoentiteutilisateurs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('entite_id'); ?></th>
			<th><?php echo $this->Paginator->sort('utilisateur_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($assoentiteutilisateurs as $assoentiteutilisateur): ?>
	<tr>
		<td><?php echo h($assoentiteutilisateur['Assoentiteutilisateur']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($assoentiteutilisateur['Entite']['id'], array('controller' => 'entites', 'action' => 'view', $assoentiteutilisateur['Entite']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($assoentiteutilisateur['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $assoentiteutilisateur['Utilisateur']['id'])); ?>
		</td>
		<td><?php echo h($assoentiteutilisateur['Assoentiteutilisateur']['created']); ?>&nbsp;</td>
		<td><?php echo h($assoentiteutilisateur['Assoentiteutilisateur']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $assoentiteutilisateur['Assoentiteutilisateur']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $assoentiteutilisateur['Assoentiteutilisateur']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $assoentiteutilisateur['Assoentiteutilisateur']['id']), null, __('Are you sure you want to delete # %s?', $assoentiteutilisateur['Assoentiteutilisateur']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Assoentiteutilisateur'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Entites'), array('controller' => 'entites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entite'), array('controller' => 'entites', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
	</ul>
</div>
