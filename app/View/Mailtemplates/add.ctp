<div class="mailtemplates form">
<?php echo $this->Form->create('Mailtemplate'); ?>
	<fieldset>
		<legend><?php echo __('Add Mailtemplate'); ?></legend>
	<?php
		echo $this->Form->input('NOM');
		echo $this->Form->input('OBJET');
		echo $this->Form->input('CORPS');
		echo $this->Form->input('DESTINATAIRE');
		echo $this->Form->input('CORRESPONDANCE');
		echo $this->Form->input('ENVOISAUTO');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Mailtemplates'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Replacestrings'), array('controller' => 'replacestrings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Replacestring'), array('controller' => 'replacestrings', 'action' => 'add')); ?> </li>
	</ul>
</div>
