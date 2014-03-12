<div class="assocdcprojets form">
<?php echo $this->Form->create('Assocdcprojet'); ?>
	<fieldset>
		<legend><?php echo __('Add Assocdcprojet'); ?></legend>
	<?php
		echo $this->Form->input('centrecout_id');
		echo $this->Form->input('projet_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Assocdcprojets'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Centrecouts'), array('controller' => 'centrecouts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Centrecout'), array('controller' => 'centrecouts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projets'), array('controller' => 'projets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Projet'), array('controller' => 'projets', 'action' => 'add')); ?> </li>
	</ul>
</div>
