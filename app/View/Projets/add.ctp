<div class="projets form">
<?php echo $this->Form->create('Projet'); ?>
	<fieldset>
		<legend><?php echo __('Add Projet'); ?></legend>
	<?php
		echo $this->Form->input('ID');
		echo $this->Form->input('CONTRAT_ID');
		echo $this->Form->input('NOM');
		echo $this->Form->input('DEBUT');
		echo $this->Form->input('FIN');
		echo $this->Form->input('COMMENTAIRE');
		echo $this->Form->input('ACTIF');
		echo $this->Form->input('TYPE');
		echo $this->Form->input('FACTURATION');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Projets'), array('action' => 'index')); ?></li>
	</ul>
</div>
