<div class="historylogiciels form">
<?php echo $this->Form->create('Historylogiciel'); ?>
	<fieldset>
		<legend><?php echo __('Add Historylogiciel'); ?></legend>
	<?php
		echo $this->Form->input('logiciel_id');
		echo $this->Form->input('INSTALL');
		echo $this->Form->input('DATECHECKINSTALL');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Historylogiciels'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Logiciels'), array('controller' => 'logiciels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Logiciel'), array('controller' => 'logiciels', 'action' => 'add')); ?> </li>
	</ul>
</div>
