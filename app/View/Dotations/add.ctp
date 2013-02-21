<div class="dotations form">
<?php echo $this->Form->create('Dotation'); ?>
	<fieldset>
		<legend><?php echo __('Add Dotation'); ?></legend>
	<?php
		echo $this->Form->input('ID');
		echo $this->Form->input('MATERIELINFORMATIQUE_ID');
		echo $this->Form->input('MATERIELAUTRES_ID');
		echo $this->Form->input('UTILISATEUR_ID');
		echo $this->Form->input('DATERECEPTION');
		echo $this->Form->input('DATEREMISE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Dotations'), array('action' => 'index')); ?></li>
	</ul>
</div>
