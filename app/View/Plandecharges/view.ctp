<div class="plandecharges view">
<h2><?php  echo __('Plandecharge'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($plandecharge['Plandecharge']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Affectation'); ?></dt>
		<dd>
			<?php echo $this->Html->link($plandecharge['Affectation']['id'], array('controller' => 'affectations', 'action' => 'view', $plandecharge['Affectation']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CHARGE'); ?></dt>
		<dd>
			<?php echo h($plandecharge['Plandecharge']['CHARGE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATE'); ?></dt>
		<dd>
			<?php echo h($plandecharge['Plandecharge']['DATE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($plandecharge['Plandecharge']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modeified'); ?></dt>
		<dd>
			<?php echo h($plandecharge['Plandecharge']['modeified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Plandecharge'), array('action' => 'edit', $plandecharge['Plandecharge']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Plandecharge'), array('action' => 'delete', $plandecharge['Plandecharge']['id']), null, __('Are you sure you want to delete # %s?', $plandecharge['Plandecharge']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Plandecharges'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plandecharge'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Affectations'), array('controller' => 'affectations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Affectation'), array('controller' => 'affectations', 'action' => 'add')); ?> </li>
	</ul>
</div>
