<div class="environnementbiens view">
<h2><?php echo __('Environnementbien'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($environnementbien['Environnementbien']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expressionbesoin'); ?></dt>
		<dd>
			<?php echo $this->Html->link($environnementbien['Expressionbesoin']['id'], array('controller' => 'expressionbesoins', 'action' => 'view', $environnementbien['Expressionbesoin']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bien'); ?></dt>
		<dd>
			<?php echo $this->Html->link($environnementbien['Bien']['id'], array('controller' => 'biens', 'action' => 'view', $environnementbien['Bien']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($environnementbien['Environnementbien']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($environnementbien['Environnementbien']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Environnementbien'), array('action' => 'edit', $environnementbien['Environnementbien']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Environnementbien'), array('action' => 'delete', $environnementbien['Environnementbien']['id']), null, __('Are you sure you want to delete # %s?', $environnementbien['Environnementbien']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Environnementbiens'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Environnementbien'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Expressionbesoins'), array('controller' => 'expressionbesoins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Expressionbesoin'), array('controller' => 'expressionbesoins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Biens'), array('controller' => 'biens', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bien'), array('controller' => 'biens', 'action' => 'add')); ?> </li>
	</ul>
</div>
