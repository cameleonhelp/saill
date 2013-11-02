<div class="historyexpbs view">
<h2><?php echo __('Historyexpb'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($historyexpb['Historyexpb']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expressionbesoins'); ?></dt>
		<dd>
			<?php echo $this->Html->link($historyexpb['Expressionbesoins']['id'], array('controller' => 'expressionbesoins', 'action' => 'view', $historyexpb['Expressionbesoins']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Etat'); ?></dt>
		<dd>
			<?php echo $this->Html->link($historyexpb['Etat']['id'], array('controller' => 'etats', 'action' => 'view', $historyexpb['Etat']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATEFIN'); ?></dt>
		<dd>
			<?php echo h($historyexpb['Historyexpb']['DATEFIN']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATELIVRAISON'); ?></dt>
		<dd>
			<?php echo h($historyexpb['Historyexpb']['DATELIVRAISON']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($historyexpb['Historyexpb']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($historyexpb['Historyexpb']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Historyexpb'), array('action' => 'edit', $historyexpb['Historyexpb']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Historyexpb'), array('action' => 'delete', $historyexpb['Historyexpb']['id']), null, __('Are you sure you want to delete # %s?', $historyexpb['Historyexpb']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Historyexpbs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Historyexpb'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Expressionbesoins'), array('controller' => 'expressionbesoins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Expressionbesoins'), array('controller' => 'expressionbesoins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Etats'), array('controller' => 'etats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Etat'), array('controller' => 'etats', 'action' => 'add')); ?> </li>
	</ul>
</div>
