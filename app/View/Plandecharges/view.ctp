<div class="plandecharges view">
<h2><?php  echo __('Plandecharge'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($plandecharge['Plandecharge']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Utilisateur Id'); ?></dt>
		<dd>
			<?php echo h($plandecharge['Plandecharge']['utilisateur_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Domaine Id'); ?></dt>
		<dd>
			<?php echo h($plandecharge['Plandecharge']['domaine_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activite Id'); ?></dt>
		<dd>
			<?php echo h($plandecharge['Plandecharge']['activite_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CHARGEPREVUE'); ?></dt>
		<dd>
			<?php echo h($plandecharge['Plandecharge']['CHARGEPREVUE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PERIODE'); ?></dt>
		<dd>
			<?php echo h($plandecharge['Plandecharge']['PERIODE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($plandecharge['Plandecharge']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($plandecharge['Plandecharge']['modified']); ?>
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
