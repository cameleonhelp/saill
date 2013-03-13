<div class="actionslivrables form">
<?php echo $this->Form->create('Actionslivrable'); ?>
	<fieldset>
		<legend><?php echo __('Add Actionslivrable'); ?></legend>
	<?php
		echo $this->Form->input('livrables_id');
		echo $this->Form->input('actions_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Actionslivrables'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Livrables'), array('controller' => 'livrables', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Livrables'), array('controller' => 'livrables', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Actions'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
	</ul>
</div>
