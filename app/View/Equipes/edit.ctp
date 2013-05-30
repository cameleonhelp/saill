<div class="equipes form">
<?php echo $this->Form->create('Equipe'); ?>
	<fieldset>
		<legend><?php echo __('Edit Equipe'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('utilisateur_id');
		echo $this->Form->input('agent');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Equipe.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Equipe.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Equipes'), array('action' => 'index')); ?></li>
	</ul>
</div>
