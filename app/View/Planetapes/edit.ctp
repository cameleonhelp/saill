<div class="planetapes form">
<?php echo $this->Form->create('Planetape'); ?>
	<fieldset>
		<legend><?php echo __('Edit Planetape'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('NOM');
		echo $this->Form->input('ORDRE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Planetape.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Planetape.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Planetapes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Plangantts'), array('controller' => 'plangantts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plangantt'), array('controller' => 'plangantts', 'action' => 'add')); ?> </li>
	</ul>
</div>
