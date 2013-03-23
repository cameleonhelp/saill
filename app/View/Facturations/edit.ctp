<div class="facturations form">
<?php echo $this->Form->create('Facturation'); ?>
	<fieldset>
		<legend><?php echo __('Edit Facturation'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('utilisateur_id');
		echo $this->Form->input('activite_id');
		echo $this->Form->input('activitesreelle_id');
		echo $this->Form->input('DATE');
		echo $this->Form->input('VERSION');
		echo $this->Form->input('LU');
		echo $this->Form->input('MA');
		echo $this->Form->input('ME');
		echo $this->Form->input('JE');
		echo $this->Form->input('VE');
		echo $this->Form->input('SA');
		echo $this->Form->input('DI');
		echo $this->Form->input('NUMEROFTGALILEI');
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
		<li><?php echo $this->Html->link(__('List Activites'), array('controller' => 'activites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activite'), array('controller' => 'activites', 'action' => 'add')); ?> </li>
	</ul>
</div>
