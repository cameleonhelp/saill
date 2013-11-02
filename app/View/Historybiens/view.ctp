<div class="historybiens view">
<h2><?php echo __('Historybien'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($historybien['Historybien']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Biens'); ?></dt>
		<dd>
			<?php echo $this->Html->link($historybien['Biens']['id'], array('controller' => 'biens', 'action' => 'view', $historybien['Biens']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('INSTALL'); ?></dt>
		<dd>
			<?php echo h($historybien['Historybien']['INSTALL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATECHECKINSTALL'); ?></dt>
		<dd>
			<?php echo h($historybien['Historybien']['DATECHECKINSTALL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($historybien['Historybien']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($historybien['Historybien']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Historybien'), array('action' => 'edit', $historybien['Historybien']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Historybien'), array('action' => 'delete', $historybien['Historybien']['id']), null, __('Are you sure you want to delete # %s?', $historybien['Historybien']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Historybiens'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Historybien'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Biens'), array('controller' => 'biens', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Biens'), array('controller' => 'biens', 'action' => 'add')); ?> </li>
	</ul>
</div>
