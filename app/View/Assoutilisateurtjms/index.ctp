<div class="assoutilisateurtjms index">
	<h2><?php echo __('Assoutilisateurtjms'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('utilisateur_id'); ?></th>
			<th><?php echo $this->Paginator->sort('tjmagent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('ANNEE'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($assoutilisateurtjms as $assoutilisateurtjm): ?>
	<tr>
		<td><?php echo h($assoutilisateurtjm['Assoutilisateurtjm']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($assoutilisateurtjm['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $assoutilisateurtjm['Utilisateur']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($assoutilisateurtjm['Tjmagent']['id'], array('controller' => 'tjmagents', 'action' => 'view', $assoutilisateurtjm['Tjmagent']['id'])); ?>
		</td>
		<td><?php echo h($assoutilisateurtjm['Assoutilisateurtjm']['ANNEE']); ?>&nbsp;</td>
		<td><?php echo h($assoutilisateurtjm['Assoutilisateurtjm']['created']); ?>&nbsp;</td>
		<td><?php echo h($assoutilisateurtjm['Assoutilisateurtjm']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $assoutilisateurtjm['Assoutilisateurtjm']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $assoutilisateurtjm['Assoutilisateurtjm']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $assoutilisateurtjm['Assoutilisateurtjm']['id']), null, __('Are you sure you want to delete # %s?', $assoutilisateurtjm['Assoutilisateurtjm']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Assoutilisateurtjm'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tjmagents'), array('controller' => 'tjmagents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tjmagent'), array('controller' => 'tjmagents', 'action' => 'add')); ?> </li>
	</ul>
</div>
