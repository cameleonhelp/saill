<div class="facturations form">
<?php echo $this->Form->create('Facturation'); ?>
	<fieldset>
		<legend><?php echo __('Edit Facturation'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('utilisateur_id');
		echo $this->Form->input('action_id');
		echo $this->Form->input('DATE');
		echo $this->Form->input('CHARGE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Facturation.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Facturation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Facturations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Action'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
	</ul>
</div>
