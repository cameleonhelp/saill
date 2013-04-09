<div class="detailplancharges form">
<?php echo $this->Form->create('Detailplancharge'); ?>
	<fieldset>
		<legend><?php echo __('Edit Detailplancharge'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('plancharge_id');
		echo $this->Form->input('utilisateur_id');
		echo $this->Form->input('CAPCITY');
		echo $this->Form->input('domaine_id');
		echo $this->Form->input('activite_id');
		echo $this->Form->input('CHARGEPREVUE');
		echo $this->Form->input('CHARGEREELLEE');
		echo $this->Form->input('PERIODE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Detailplancharge.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Detailplancharge.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Detailplancharges'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Plancharges'), array('controller' => 'plancharges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plancharge'), array('controller' => 'plancharges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Domaines'), array('controller' => 'domaines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Domaine'), array('controller' => 'domaines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Activites'), array('controller' => 'activites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activite'), array('controller' => 'activites', 'action' => 'add')); ?> </li>
	</ul>
</div>
