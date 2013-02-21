<div class="projets form">
<?php echo $this->Form->create('Projet'); ?>
	<fieldset>
		<legend><?php echo __('Edit Projet'); ?></legend>
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Projet.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Projet.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Projets'), array('action' => 'index')); ?></li>
	</ul>
</div>
