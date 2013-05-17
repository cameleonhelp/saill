<div class="mailtemplates view">
<h2><?php  echo __('Mailtemplate'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mailtemplate['Mailtemplate']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($mailtemplate['Mailtemplate']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OBJET'); ?></dt>
		<dd>
			<?php echo h($mailtemplate['Mailtemplate']['OBJET']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CORPS'); ?></dt>
		<dd>
			<?php echo h($mailtemplate['Mailtemplate']['CORPS']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DESTINATAIRE'); ?></dt>
		<dd>
			<?php echo h($mailtemplate['Mailtemplate']['DESTINATAIRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CORRESPONDANCE'); ?></dt>
		<dd>
			<?php echo h($mailtemplate['Mailtemplate']['CORRESPONDANCE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ENVOISAUTO'); ?></dt>
		<dd>
			<?php echo h($mailtemplate['Mailtemplate']['ENVOISAUTO']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($mailtemplate['Mailtemplate']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($mailtemplate['Mailtemplate']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mailtemplate'), array('action' => 'edit', $mailtemplate['Mailtemplate']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mailtemplate'), array('action' => 'delete', $mailtemplate['Mailtemplate']['id']), null, __('Are you sure you want to delete # %s?', $mailtemplate['Mailtemplate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mailtemplates'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mailtemplate'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Replacestrings'), array('controller' => 'replacestrings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Replacestring'), array('controller' => 'replacestrings', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Replacestrings'); ?></h3>
	<?php if (!empty($mailtemplate['Replacestring'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Mailtemplate Id'); ?></th>
		<th><?php echo __('VARIABLE'); ?></th>
		<th><?php echo __('REPLACEBY'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($mailtemplate['Replacestring'] as $replacestring): ?>
		<tr>
			<td><?php echo $replacestring['id']; ?></td>
			<td><?php echo $replacestring['mailtemplate_id']; ?></td>
			<td><?php echo $replacestring['VARIABLE']; ?></td>
			<td><?php echo $replacestring['REPLACEBY']; ?></td>
			<td><?php echo $replacestring['created']; ?></td>
			<td><?php echo $replacestring['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'replacestrings', 'action' => 'view', $replacestring['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'replacestrings', 'action' => 'edit', $replacestring['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'replacestrings', 'action' => 'delete', $replacestring['id']), null, __('Are you sure you want to delete # %s?', $replacestring['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Replacestring'), array('controller' => 'replacestrings', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
