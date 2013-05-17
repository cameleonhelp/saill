<div class="mailtemplates form">
<?php echo $this->Form->create('Mailtemplate'); ?>
	<fieldset>
		<legend><?php echo __('Edit Mailtemplate'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Mailtemplate.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Mailtemplate.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Mailtemplates'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Replacestrings'), array('controller' => 'replacestrings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Replacestring'), array('controller' => 'replacestrings', 'action' => 'add')); ?> </li>
	</ul>
</div>
