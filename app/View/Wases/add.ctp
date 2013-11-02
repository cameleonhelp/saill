<div class="wases form">
<?php echo $this->Form->create('Wase'); ?>
	<fieldset>
		<legend><?php echo __('Add Wase'); ?></legend>
	<?php
		echo $this->Form->input('VERSION');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Wases'), array('action' => 'index')); ?></li>
	</ul>
</div>
