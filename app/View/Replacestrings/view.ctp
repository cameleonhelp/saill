<div class="replacestrings view">
<h2><?php  echo __('Replacestring'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($replacestring['Replacestring']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mailtemplate'); ?></dt>
		<dd>
			<?php echo $this->Html->link($replacestring['Mailtemplate']['id'], array('controller' => 'mailtemplates', 'action' => 'view', $replacestring['Mailtemplate']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('VARIABLE'); ?></dt>
		<dd>
			<?php echo h($replacestring['Replacestring']['VARIABLE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('REPLACEBY'); ?></dt>
		<dd>
			<?php echo h($replacestring['Replacestring']['REPLACEBY']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($replacestring['Replacestring']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($replacestring['Replacestring']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Replacestring'), array('action' => 'edit', $replacestring['Replacestring']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Replacestring'), array('action' => 'delete', $replacestring['Replacestring']['id']), null, __('Are you sure you want to delete # %s?', $replacestring['Replacestring']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Replacestrings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Replacestring'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mailtemplates'), array('controller' => 'mailtemplates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mailtemplate'), array('controller' => 'mailtemplates', 'action' => 'add')); ?> </li>
	</ul>
</div>
