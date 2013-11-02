<div class="assobienlogiciels form">
<?php echo $this->Form->create('Assobienlogiciel'); ?>
	<fieldset>
		<legend><?php echo __('Edit Assobienlogiciel'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('bien_id');
		echo $this->Form->input('logiciel_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Assobienlogiciel.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Assobienlogiciel.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Assobienlogiciels'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Biens'), array('controller' => 'biens', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bien'), array('controller' => 'biens', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Logiciels'), array('controller' => 'logiciels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Logiciel'), array('controller' => 'logiciels', 'action' => 'add')); ?> </li>
	</ul>
</div>
