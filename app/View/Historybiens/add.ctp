<div class="historybiens form">
<?php echo $this->Form->create('Historybien'); ?>
	<fieldset>
		<legend><?php echo __('Add Historybien'); ?></legend>
	<?php
		echo $this->Form->input('biens_id');
		echo $this->Form->input('INSTALL');
		echo $this->Form->input('DATECHECKINSTALL');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Historybiens'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Biens'), array('controller' => 'biens', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Biens'), array('controller' => 'biens', 'action' => 'add')); ?> </li>
	</ul>
</div>
