<div class="historybudgets view">
<h2><?php  echo __('Historybudget'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($historybudget['Historybudget']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activite'); ?></dt>
		<dd>
			<?php echo $this->Html->link($historybudget['Activite']['id'], array('controller' => 'activites', 'action' => 'view', $historybudget['Activite']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ANNEE'); ?></dt>
		<dd>
			<?php echo h($historybudget['Historybudget']['ANNEE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PREVU'); ?></dt>
		<dd>
			<?php echo h($historybudget['Historybudget']['PREVU']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('REVU'); ?></dt>
		<dd>
			<?php echo h($historybudget['Historybudget']['REVU']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ACTIF'); ?></dt>
		<dd>
			<?php echo h($historybudget['Historybudget']['ACTIF']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Historybudget'), array('action' => 'edit', $historybudget['Historybudget']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Historybudget'), array('action' => 'delete', $historybudget['Historybudget']['id']), null, __('Are you sure you want to delete # %s?', $historybudget['Historybudget']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Historybudgets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Historybudget'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Activites'), array('controller' => 'activites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activite'), array('controller' => 'activites', 'action' => 'add')); ?> </li>
	</ul>
</div>
