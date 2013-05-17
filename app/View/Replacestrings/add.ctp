<div class="replacestrings form">
<?php echo $this->Form->create('Replacestring'); ?>
	<fieldset>
		<legend><?php echo __('Add Replacestring'); ?></legend>
	<?php
		echo $this->Form->input('mailtemplate_id');
		echo $this->Form->input('VARIABLE');
		echo $this->Form->input('REPLACEBY');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Replacestrings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Mailtemplates'), array('controller' => 'mailtemplates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mailtemplate'), array('controller' => 'mailtemplates', 'action' => 'add')); ?> </li>
	</ul>
</div>
