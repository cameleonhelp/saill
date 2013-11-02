<div class="cpuses view">
<h2><?php echo __('Cpus'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cpus['Cpus']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($cpus['Cpus']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PVU'); ?></dt>
		<dd>
			<?php echo h($cpus['Cpus']['PVU']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($cpus['Cpus']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($cpus['Cpus']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cpus'), array('action' => 'edit', $cpus['Cpus']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cpus'), array('action' => 'delete', $cpus['Cpus']['id']), null, __('Are you sure you want to delete # %s?', $cpus['Cpus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Cpuses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cpus'), array('action' => 'add')); ?> </li>
	</ul>
</div>
