<div class="actions form">
<?php echo $this->Form->create('Action'); ?>
	<fieldset>
		<legend><?php echo __('Add Action'); ?></legend>
	<?php
		echo $this->Form->input('ID');
		echo $this->Form->input('DOMAINE_ID');
		echo $this->Form->input('ACTIVITE_ID');
		echo $this->Form->input('UTILISATEUR_ID');
		echo $this->Form->input('DESTINATAIRE');
		echo $this->Form->input('LIVRABLE_ID');
		echo $this->Form->input('FACTURATION');
		echo $this->Form->input('OBJET');
		echo $this->Form->input('DESCRIPTION');
		echo $this->Form->input('AVANCEMENT');
		echo $this->Form->input('COMMENTAIRE');
		echo $this->Form->input('DEBUT');
		echo $this->Form->input('ECHEANCE');
		echo $this->Form->input('DEBUTREELLE');
		echo $this->Form->input('PERIODE');
		echo $this->Form->input('STATUT');
		echo $this->Form->input('HIERARCHIQUE');
		echo $this->Form->input('DUREEPREVUE');
		echo $this->Form->input('DUREEREELLE');
		echo $this->Form->input('PRIORITE');
		echo $this->Form->input('TYPE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Actions'), array('action' => 'index')); ?></li>
	</ul>
</div>
