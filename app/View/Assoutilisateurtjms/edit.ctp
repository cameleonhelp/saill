<div class="assoutilisateurtjms form">
<?php echo $this->Form->create('Assoutilisateurtjm'); ?>
	<fieldset>
		<legend><?php echo __('Edit Assoutilisateurtjm'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('utilisateur_id');
		echo $this->Form->input('tjmagent_id');
		echo $this->Form->input('ANNEE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Assoutilisateurtjm.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Assoutilisateurtjm.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Assoutilisateurtjms'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tjmagents'), array('controller' => 'tjmagents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tjmagent'), array('controller' => 'tjmagents', 'action' => 'add')); ?> </li>
	</ul>
</div>
