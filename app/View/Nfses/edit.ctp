<div class="nfses form">
<?php echo $this->Form->create('Nfse'); ?>
	<fieldset>
		<legend><?php echo __('Edit Nfse'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('NB');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Nfse.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Nfse.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Nfses'), array('action' => 'index')); ?></li>
	</ul>
</div>
