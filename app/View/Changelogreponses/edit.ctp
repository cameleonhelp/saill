<div class="changelogreponses form">
<?php echo $this->Form->create('Changelogreponse'); ?>
	<fieldset>
		<legend><?php echo __('Edit Changelogreponse'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('changelogdemande_id');
		echo $this->Form->input('utilisateur_id');
		echo $this->Form->input('REPONSE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Changelogreponse.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Changelogreponse.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Changelogreponses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Changelogdemandes'), array('controller' => 'changelogdemandes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Changelogdemande'), array('controller' => 'changelogdemandes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
	</ul>
</div>
