<div class="assoprojetentites form">
<?php echo $this->Form->create('Assoprojetentite'); ?>
	<fieldset>
		<legend><?php echo __('Edit Assoprojetentite'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('entite_id');
		echo $this->Form->input('projet_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Assoprojetentite.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Assoprojetentite.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Assoprojetentites'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Entites'), array('controller' => 'entites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entite'), array('controller' => 'entites', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projets'), array('controller' => 'projets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Projet'), array('controller' => 'projets', 'action' => 'add')); ?> </li>
	</ul>
</div>
