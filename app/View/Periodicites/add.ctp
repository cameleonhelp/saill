<div class="periodicites form">
<?php echo $this->Form->create('Periodicite'); ?>
	<fieldset>
		<legend><?php echo __('Add Periodicite'); ?></legend>
	<?php
		echo $this->Form->input('END');
		echo $this->Form->input('ALLDAYMONTH');
		echo $this->Form->input('REPEATALL');
		echo $this->Form->input('LU');
		echo $this->Form->input('MA');
		echo $this->Form->input('ME');
		echo $this->Form->input('JE');
		echo $this->Form->input('VE');
		echo $this->Form->input('SA');
		echo $this->Form->input('DI');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Periodicites'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Action'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
	</ul>
</div>
