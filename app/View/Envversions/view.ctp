<div class="envversions view">
<h2><?php echo __('Envversion'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($envversion['Envversion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Envoutil'); ?></dt>
		<dd>
			<?php echo $this->Html->link($envversion['Envoutil']['id'], array('controller' => 'envoutils', 'action' => 'view', $envversion['Envoutil']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('VERSION'); ?></dt>
		<dd>
			<?php echo h($envversion['Envversion']['VERSION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($envversion['Envversion']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($envversion['Envversion']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Envversion'), array('action' => 'edit', $envversion['Envversion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Envversion'), array('action' => 'delete', $envversion['Envversion']['id']), null, __('Are you sure you want to delete # %s?', $envversion['Envversion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Envversions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Envversion'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Envoutils'), array('controller' => 'envoutils', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Envoutil'), array('controller' => 'envoutils', 'action' => 'add')); ?> </li>
	</ul>
</div>
