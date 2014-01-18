<div class="assoentiteutilisateurs form">
<?php echo $this->Form->create('Assoentiteutilisateur'); ?>
	<fieldset>
		<legend><?php echo __('Edit Assoentiteutilisateur'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('entite_id');
		echo $this->Form->input('utilisateur_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Assoentiteutilisateur.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Assoentiteutilisateur.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Assoentiteutilisateurs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Entites'), array('controller' => 'entites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entite'), array('controller' => 'entites', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
	</ul>
</div>
