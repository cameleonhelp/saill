<div class="tjmagents form">
<?php echo $this->Form->create('Tjmagent'); ?>
	<fieldset>
		<legend><?php echo __('Add Tjmagent'); ?></legend>
	<?php
		echo $this->Form->input('ID');
		echo $this->Form->input('NOM');
		echo $this->Form->input('TARIFHT');
		echo $this->Form->input('TARIFTTC');
		echo $this->Form->input('ANNEE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tjmagents'), array('action' => 'index')); ?></li>
	</ul>
</div>
