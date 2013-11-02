<div class="historyintegrations view">
<h2><?php echo __('Historyintegration'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($historyintegration['Historyintegration']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Intergrationapplicative'); ?></dt>
		<dd>
			<?php echo $this->Html->link($historyintegration['Intergrationapplicative']['id'], array('controller' => 'intergrationapplicatives', 'action' => 'view', $historyintegration['Intergrationapplicative']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATE'); ?></dt>
		<dd>
			<?php echo h($historyintegration['Historyintegration']['DATE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifiedby'); ?></dt>
		<dd>
			<?php echo h($historyintegration['Historyintegration']['modifiedby']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($historyintegration['Historyintegration']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($historyintegration['Historyintegration']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Historyintegration'), array('action' => 'edit', $historyintegration['Historyintegration']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Historyintegration'), array('action' => 'delete', $historyintegration['Historyintegration']['id']), null, __('Are you sure you want to delete # %s?', $historyintegration['Historyintegration']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Historyintegrations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Historyintegration'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Intergrationapplicatives'), array('controller' => 'intergrationapplicatives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Intergrationapplicative'), array('controller' => 'intergrationapplicatives', 'action' => 'add')); ?> </li>
	</ul>
</div>
