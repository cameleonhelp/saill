<div class="historyactions form">
<?php echo $this->Form->create('Historyaction'); ?>
	<fieldset>
		<legend><?php echo __('Add Historyaction'); ?></legend>
	<?php
		echo $this->Form->input('action_id');
		echo $this->Form->input('AVANCEMENT');
		echo $this->Form->input('DEBUT');
		echo $this->Form->input('DEBUTREELLE');
		echo $this->Form->input('ECHEANCE');
		echo $this->Form->input('CHARGEPREVUE');
		echo $this->Form->input('CHARGEREELLE');
		echo $this->Form->input('PRIORITE');
		echo $this->Form->input('STATUT');
		echo $this->Form->input('COMMENTAIRE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Historyactions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Action'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
	</ul>
</div>
