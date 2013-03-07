<div class="historydotations form">
<?php echo $this->Form->create('Historydotation'); ?>
	<fieldset>
		<legend><?php echo __('Edit Historydotation'); ?></legend>
	<?php
		echo $this->Form->input('ID');
		echo $this->Form->input('DOTATION_ID');
		echo $this->Form->input('HISTORIQUE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Historydotation.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Historydotation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Historydotations'), array('action' => 'index')); ?></li>
	</ul>
</div>
