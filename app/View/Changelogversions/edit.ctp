<div class="changelogversions form">
<?php echo $this->Form->create('Changelogversion'); ?>
	<fieldset>
		<legend><?php echo __('Edit Changelogversion'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('VERSION');
		echo $this->Form->input('ETAT');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Changelogversion.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Changelogversion.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Changelogversions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Changelogdemandes'), array('controller' => 'changelogdemandes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Changelogdemande'), array('controller' => 'changelogdemandes', 'action' => 'add')); ?> </li>
	</ul>
</div>
