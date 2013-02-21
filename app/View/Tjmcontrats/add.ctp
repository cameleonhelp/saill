<div class="tjmcontrats form">
<?php echo $this->Form->create('Tjmcontrat'); ?>
	<fieldset>
		<legend><?php echo __('Add Tjmcontrat'); ?></legend>
	<?php
		echo $this->Form->input('ID');
		echo $this->Form->input('TJM');
		echo $this->Form->input('ANNEE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tjmcontrats'), array('action' => 'index')); ?></li>
	</ul>
</div>
