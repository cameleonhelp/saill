<div class="assocdcprojets form">
<?php echo $this->Form->create('Assocdcprojet'); ?>
	<fieldset>
		<legend><?php echo __('Edit Assocdcprojet'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('centrecout_id');
		echo $this->Form->input('projet_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Assocdcprojet.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Assocdcprojet.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Assocdcprojets'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Centrecouts'), array('controller' => 'centrecouts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Centrecout'), array('controller' => 'centrecouts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projets'), array('controller' => 'projets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Projet'), array('controller' => 'projets', 'action' => 'add')); ?> </li>
	</ul>
</div>
