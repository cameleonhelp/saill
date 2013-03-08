<div class="facturations view">
<h2><?php  echo __('Facturation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Utilisateur'); ?></dt>
		<dd>
			<?php echo $this->Html->link($facturation['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $facturation['Utilisateur']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Action'); ?></dt>
		<dd>
			<?php echo $this->Html->link($facturation['Action']['id'], array('controller' => 'actions', 'action' => 'view', $facturation['Action']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATE'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['DATE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CHARGE'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['CHARGE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Facturation'), array('action' => 'edit', $facturation['Facturation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Facturation'), array('action' => 'delete', $facturation['Facturation']['id']), null, __('Are you sure you want to delete # %s?', $facturation['Facturation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Facturations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Facturation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Action'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
	</ul>
</div>
