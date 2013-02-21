<div class="contrats form">
<?php echo $this->Form->create('Contrat'); ?>
	<fieldset>
		<legend><?php echo __('Add Contrat'); ?></legend>
	<?php
		echo $this->Form->input('ID');
		echo $this->Form->input('TJMCONTRAT_ID');
		echo $this->Form->input('NOM');
		echo $this->Form->input('ANNEEDEBUT');
		echo $this->Form->input('ANNEEFIN');
		echo $this->Form->input('MONTANT');
		echo $this->Form->input('ACTIF');
		echo $this->Form->input('DESCRIPTION');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Contrats'), array('action' => 'index')); ?></li>
	</ul>
</div>
