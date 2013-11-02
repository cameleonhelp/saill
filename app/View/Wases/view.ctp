<div class="wases view">
<h2><?php echo __('Wase'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($wase['Wase']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('VERSION'); ?></dt>
		<dd>
			<?php echo h($wase['Wase']['VERSION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($wase['Wase']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($wase['Wase']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Wase'), array('action' => 'edit', $wase['Wase']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Wase'), array('action' => 'delete', $wase['Wase']['id']), null, __('Are you sure you want to delete # %s?', $wase['Wase']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Wases'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Wase'), array('action' => 'add')); ?> </li>
	</ul>
</div>
