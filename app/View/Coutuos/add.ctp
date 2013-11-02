<div class="coutuos form">
<?php echo $this->Form->create('Coutuo'); ?>
	<fieldset>
		<legend><?php echo __('Add Coutuo'); ?></legend>
	<?php
		echo $this->Form->input('NOMUO');
		echo $this->Form->input('MONTANT');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Coutuos'), array('action' => 'index')); ?></li>
	</ul>
</div>
