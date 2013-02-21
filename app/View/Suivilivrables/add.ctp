<div class="suivilivrables form">
<?php echo $this->Form->create('Suivilivrable'); ?>
	<fieldset>
		<legend><?php echo __('Add Suivilivrable'); ?></legend>
	<?php
		echo $this->Form->input('ID');
		echo $this->Form->input('LIVRABLE_ID');
		echo $this->Form->input('ECHEANCE');
		echo $this->Form->input('DATELIVRAISON');
		echo $this->Form->input('DATEVALIDATION');
		echo $this->Form->input('ETAT');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Suivilivrables'), array('action' => 'index')); ?></li>
	</ul>
</div>
