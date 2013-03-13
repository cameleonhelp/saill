<div class="actionslivrables form">
<?php echo $this->Form->create('Actionslivrable'); ?>
	<fieldset>
		<legend><?php echo __('Edit Actionslivrable'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('livrables_id');
		echo $this->Form->input('actions_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Actionslivrable.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Actionslivrable.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Actionslivrables'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Livrables'), array('controller' => 'livrables', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Livrables'), array('controller' => 'livrables', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Actions'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
	</ul>
</div>
