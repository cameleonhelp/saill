<div class="historyexpbs form">
<?php echo $this->Form->create('Historyexpb'); ?>
	<fieldset>
		<legend><?php echo __('Add Historyexpb'); ?></legend>
	<?php
		echo $this->Form->input('expressionbesoins_id');
		echo $this->Form->input('etat_id');
		echo $this->Form->input('DATEFIN');
		echo $this->Form->input('DATELIVRAISON');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Historyexpbs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Expressionbesoins'), array('controller' => 'expressionbesoins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Expressionbesoins'), array('controller' => 'expressionbesoins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Etats'), array('controller' => 'etats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Etat'), array('controller' => 'etats', 'action' => 'add')); ?> </li>
	</ul>
</div>
