<div class="mailtemplates index">
	<h2><?php echo __('Mailtemplates'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('NOM'); ?></th>
			<th><?php echo $this->Paginator->sort('OBJET'); ?></th>
			<th><?php echo $this->Paginator->sort('CORPS'); ?></th>
			<th><?php echo $this->Paginator->sort('DESTINATAIRE'); ?></th>
			<th><?php echo $this->Paginator->sort('CORRESPONDANCE'); ?></th>
			<th><?php echo $this->Paginator->sort('ENVOISAUTO'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($mailtemplates as $mailtemplate): ?>
	<tr>
		<td><?php echo h($mailtemplate['Mailtemplate']['id']); ?>&nbsp;</td>
		<td><?php echo h($mailtemplate['Mailtemplate']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($mailtemplate['Mailtemplate']['OBJET']); ?>&nbsp;</td>
		<td><?php echo h($mailtemplate['Mailtemplate']['CORPS']); ?>&nbsp;</td>
		<td><?php echo h($mailtemplate['Mailtemplate']['DESTINATAIRE']); ?>&nbsp;</td>
		<td><?php echo h($mailtemplate['Mailtemplate']['CORRESPONDANCE']); ?>&nbsp;</td>
		<td><?php echo h($mailtemplate['Mailtemplate']['ENVOISAUTO']); ?>&nbsp;</td>
		<td><?php echo h($mailtemplate['Mailtemplate']['created']); ?>&nbsp;</td>
		<td><?php echo h($mailtemplate['Mailtemplate']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $mailtemplate['Mailtemplate']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $mailtemplate['Mailtemplate']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mailtemplate['Mailtemplate']['id']), null, __('Are you sure you want to delete # %s?', $mailtemplate['Mailtemplate']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Mailtemplate'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Replacestrings'), array('controller' => 'replacestrings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Replacestring'), array('controller' => 'replacestrings', 'action' => 'add')); ?> </li>
	</ul>
</div>
