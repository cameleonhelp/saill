<div class="historyactions form">
<?php echo $this->Form->create('Historyaction'); ?>
	<fieldset>
		<legend><?php echo __('Add Historyaction'); ?></legend>
	<?php
		echo $this->Form->input('ID');
		echo $this->Form->input('ACTION_ID');
		echo $this->Form->input('UTILISATEUR_ID');
		echo $this->Form->input('HISTORIQUE');
		echo $this->Form->input('STATUT');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Historyactions'), array('action' => 'index')); ?></li>
	</ul>
</div>
