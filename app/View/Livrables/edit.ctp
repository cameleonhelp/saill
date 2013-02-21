<div class="livrables form">
<?php echo $this->Form->create('Livrable'); ?>
	<fieldset>
		<legend><?php echo __('Edit Livrable'); ?></legend>
	<?php
		echo $this->Form->input('ID');
		echo $this->Form->input('UTILISATEUR_ID');
		echo $this->Form->input('NOM');
		echo $this->Form->input('REFERENCE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Livrable.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Livrable.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Livrables'), array('action' => 'index')); ?></li>
	</ul>
</div>
