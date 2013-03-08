<div class="activitesreelles view">
<h2><?php  echo __('Activitesreelle'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($activitesreelle['Activitesreelle']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Utilisateur'); ?></dt>
		<dd>
			<?php echo $this->Html->link($activitesreelle['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $activitesreelle['Utilisateur']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Action'); ?></dt>
		<dd>
			<?php echo $this->Html->link($activitesreelle['Action']['id'], array('controller' => 'actions', 'action' => 'view', $activitesreelle['Action']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATE'); ?></dt>
		<dd>
			<?php echo h($activitesreelle['Activitesreelle']['DATE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CHARGE'); ?></dt>
		<dd>
			<?php echo h($activitesreelle['Activitesreelle']['CHARGE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TYPE'); ?></dt>
		<dd>
			<?php echo h($activitesreelle['Activitesreelle']['TYPE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PERIODE'); ?></dt>
		<dd>
			<?php echo h($activitesreelle['Activitesreelle']['PERIODE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($activitesreelle['Activitesreelle']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($activitesreelle['Activitesreelle']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Activitesreelle'), array('action' => 'edit', $activitesreelle['Activitesreelle']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Activitesreelle'), array('action' => 'delete', $activitesreelle['Activitesreelle']['id']), null, __('Are you sure you want to delete # %s?', $activitesreelle['Activitesreelle']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Activitesreelles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activitesreelle'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Action'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
	</ul>
</div>
