<div class="facturations form">
<?php echo $this->Form->create('Facturation'); ?>
	<fieldset>
		<legend><?php echo __('Add Facturation'); ?></legend>
	<?php
		echo $this->Form->input('utilisateur_id');
		echo $this->Form->input('activite_id');
		echo $this->Form->input('DATE');
		echo $this->Form->input('LU');
		echo $this->Form->input('LU_TYPE');
		echo $this->Form->input('MA');
		echo $this->Form->input('MA_TYPE');
		echo $this->Form->input('ME');
		echo $this->Form->input('ME_TYPE');
		echo $this->Form->input('JE');
		echo $this->Form->input('JE_TYPE');
		echo $this->Form->input('VE');
		echo $this->Form->input('VE_TYPE');
		echo $this->Form->input('SA');
		echo $this->Form->input('SA_TYPE');
		echo $this->Form->input('DI');
		echo $this->Form->input('DI_TYPE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Facturations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Action'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
	</ul>
</div>
