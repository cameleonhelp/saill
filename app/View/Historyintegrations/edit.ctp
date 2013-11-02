<div class="historyintegrations form">
<?php echo $this->Form->create('Historyintegration'); ?>
	<fieldset>
		<legend><?php echo __('Edit Historyintegration'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('intergrationapplicative_id');
		echo $this->Form->input('DATE');
		echo $this->Form->input('modifiedby');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Historyintegration.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Historyintegration.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Historyintegrations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Intergrationapplicatives'), array('controller' => 'intergrationapplicatives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Intergrationapplicative'), array('controller' => 'intergrationapplicatives', 'action' => 'add')); ?> </li>
	</ul>
</div>
