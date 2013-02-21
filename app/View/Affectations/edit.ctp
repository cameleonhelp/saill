<div class="affectations form">
<?php echo $this->Form->create('Affectation'); ?>
	<fieldset>
		<legend><?php echo __('Edit Affectation'); ?></legend>
	<?php
		echo $this->Form->input('ID');
		echo $this->Form->input('UTILISATEUR_ID');
		echo $this->Form->input('ACTIVITE_ID');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Affectation.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Affectation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Affectations'), array('action' => 'index')); ?></li>
	</ul>
</div>
