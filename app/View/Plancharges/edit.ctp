<div class="plancharges form">
<?php echo $this->Form->create('Plancharge'); ?>
	<fieldset>
		<legend><?php echo __('Edit Plancharge'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('projet_id');
		echo $this->Form->input('NOM');
		echo $this->Form->input('ANNEE');
		echo $this->Form->input('ETP');
		echo $this->Form->input('CHARGES');
		echo $this->Form->input('TJM');
		echo $this->Form->input('VERSION');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Plancharge.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Plancharge.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Plancharges'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Detailplancharges'), array('controller' => 'detailplancharges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detailplancharge'), array('controller' => 'detailplancharges', 'action' => 'add')); ?> </li>
	</ul>
</div>
