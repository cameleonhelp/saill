<div class="mws view">
<h2><?php echo __('Mw'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mw['Mw']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Envoutil'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mw['Envoutil']['id'], array('controller' => 'envoutils', 'action' => 'view', $mw['Envoutil']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PVU'); ?></dt>
		<dd>
			<?php echo h($mw['Mw']['PVU']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COUTUNITAIRE'); ?></dt>
		<dd>
			<?php echo h($mw['Mw']['COUTUNITAIRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($mw['Mw']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($mw['Mw']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mw'), array('action' => 'edit', $mw['Mw']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mw'), array('action' => 'delete', $mw['Mw']['id']), null, __('Are you sure you want to delete # %s?', $mw['Mw']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mws'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mw'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Envoutils'), array('controller' => 'envoutils', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Envoutil'), array('controller' => 'envoutils', 'action' => 'add')); ?> </li>
	</ul>
</div>
