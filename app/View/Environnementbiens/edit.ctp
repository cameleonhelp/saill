<div class="environnementbiens form">
<?php echo $this->Form->create('Environnementbien'); ?>
	<fieldset>
		<legend><?php echo __('Edit Environnementbien'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('expressionbesoin_id');
		echo $this->Form->input('bien_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Environnementbien.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Environnementbien.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Environnementbiens'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Expressionbesoins'), array('controller' => 'expressionbesoins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Expressionbesoin'), array('controller' => 'expressionbesoins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Biens'), array('controller' => 'biens', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bien'), array('controller' => 'biens', 'action' => 'add')); ?> </li>
	</ul>
</div>
