<div class="couts form">
<?php echo $this->Form->create('Cout'); ?>
	<fieldset>
		<legend><?php echo __('Add Cout'); ?></legend>
	<?php
		echo $this->Form->input('NOM');
		echo $this->Form->input('MONTANT');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Couts'), array('action' => 'index')); ?></li>
	</ul>
</div>
