<div class="plandecharges form">
<?php echo $this->Form->create('Plandecharge'); ?>
	<fieldset>
		<legend><?php echo __('Edit Plandecharge'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('utilisateur_id');
		echo $this->Form->input('domaine_id');
		echo $this->Form->input('activite_id');
		echo $this->Form->input('CHARGEPREVUE');
		echo $this->Form->input('PERIODE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Plandecharge.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Plandecharge.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Plandecharges'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Affectations'), array('controller' => 'affectations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Affectation'), array('controller' => 'affectations', 'action' => 'add')); ?> </li>
	</ul>
</div>
