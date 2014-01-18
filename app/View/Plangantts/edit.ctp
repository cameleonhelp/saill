<div class="plangantts form">
<?php echo $this->Form->create('Plangantt'); ?>
	<fieldset>
		<legend><?php echo __('Edit Plangantt'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('planetape_id');
		echo $this->Form->input('planprojets_id');
		echo $this->Form->input('utilisateurs_id');
		echo $this->Form->input('NOM');
		echo $this->Form->input('DATEDEBUT');
		echo $this->Form->input('DATEFIN');
		echo $this->Form->input('CHARGE');
		echo $this->Form->input('CAPACITE');
		echo $this->Form->input('ETAT');
		echo $this->Form->input('AVANCEMENT');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Plangantt.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Plangantt.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Plangantts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Planetapes'), array('controller' => 'planetapes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Planetape'), array('controller' => 'planetapes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Planprojets'), array('controller' => 'planprojets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Planprojets'), array('controller' => 'planprojets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
	</ul>
</div>
