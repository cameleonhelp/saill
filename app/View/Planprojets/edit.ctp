<div class="planprojets form">
<?php echo $this->Form->create('Planprojet'); ?>
	<fieldset>
		<legend><?php echo __('Edit Planprojet'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('utilisateur_id');
		echo $this->Form->input('NOM');
		echo $this->Form->input('DATEDEBUT');
		echo $this->Form->input('ECHEANCE');
		echo $this->Form->input('OPEN');
		echo $this->Form->input('PUBLIC');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Planprojet.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Planprojet.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Planprojets'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
	</ul>
</div>
