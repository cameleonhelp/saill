<div class="actionslivrables view">
<h2><?php  echo __('Actionslivrable'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($actionslivrable['Actionslivrable']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Livrables'); ?></dt>
		<dd>
			<?php echo $this->Html->link($actionslivrable['Livrables']['id'], array('controller' => 'livrables', 'action' => 'view', $actionslivrable['Livrables']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Actions'); ?></dt>
		<dd>
			<?php echo $this->Html->link($actionslivrable['Actions']['id'], array('controller' => 'actions', 'action' => 'view', $actionslivrable['Actions']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($actionslivrable['Actionslivrable']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($actionslivrable['Actionslivrable']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Actionslivrable'), array('action' => 'edit', $actionslivrable['Actionslivrable']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Actionslivrable'), array('action' => 'delete', $actionslivrable['Actionslivrable']['id']), null, __('Are you sure you want to delete # %s?', $actionslivrable['Actionslivrable']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Actionslivrables'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Actionslivrable'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Livrables'), array('controller' => 'livrables', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Livrables'), array('controller' => 'livrables', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Actions'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
	</ul>
</div>
