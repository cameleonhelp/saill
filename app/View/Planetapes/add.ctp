<div class="planetapes form">
<?php echo $this->Form->create('Planetape'); ?>
	<fieldset>
		<legend><?php echo __('Add Planetape'); ?></legend>
	<?php
		echo $this->Form->input('NOM');
		echo $this->Form->input('ORDRE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Planetapes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Plangantts'), array('controller' => 'plangantts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plangantt'), array('controller' => 'plangantts', 'action' => 'add')); ?> </li>
	</ul>
</div>
