<div class="actioncontributeurs view">
<h2><?php echo __('Actioncontributeur'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($actioncontributeur['Actioncontributeur']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Utilisateur'); ?></dt>
		<dd>
			<?php echo $this->Html->link($actioncontributeur['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $actioncontributeur['Utilisateur']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Action'); ?></dt>
		<dd>
			<?php echo $this->Html->link($actioncontributeur['Action']['id'], array('controller' => 'actions', 'action' => 'view', $actioncontributeur['Action']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($actioncontributeur['Actioncontributeur']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($actioncontributeur['Actioncontributeur']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Actioncontributeur'), array('action' => 'edit', $actioncontributeur['Actioncontributeur']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Actioncontributeur'), array('action' => 'delete', $actioncontributeur['Actioncontributeur']['id']), null, __('Are you sure you want to delete # %s?', $actioncontributeur['Actioncontributeur']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Actioncontributeurs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Actioncontributeur'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Action'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
	</ul>
</div>
