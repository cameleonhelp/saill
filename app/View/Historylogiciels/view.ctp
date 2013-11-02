<div class="historylogiciels view">
<h2><?php echo __('Historylogiciel'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($historylogiciel['Historylogiciel']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Logiciel'); ?></dt>
		<dd>
			<?php echo $this->Html->link($historylogiciel['Logiciel']['id'], array('controller' => 'logiciels', 'action' => 'view', $historylogiciel['Logiciel']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('INSTALL'); ?></dt>
		<dd>
			<?php echo h($historylogiciel['Historylogiciel']['INSTALL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATECHECKINSTALL'); ?></dt>
		<dd>
			<?php echo h($historylogiciel['Historylogiciel']['DATECHECKINSTALL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($historylogiciel['Historylogiciel']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($historylogiciel['Historylogiciel']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Historylogiciel'), array('action' => 'edit', $historylogiciel['Historylogiciel']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Historylogiciel'), array('action' => 'delete', $historylogiciel['Historylogiciel']['id']), null, __('Are you sure you want to delete # %s?', $historylogiciel['Historylogiciel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Historylogiciels'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Historylogiciel'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Logiciels'), array('controller' => 'logiciels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Logiciel'), array('controller' => 'logiciels', 'action' => 'add')); ?> </li>
	</ul>
</div>
