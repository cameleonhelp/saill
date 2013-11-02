<div class="intergrationapplicatives view">
<h2><?php echo __('Intergrationapplicative'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($intergrationapplicative['Intergrationapplicative']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($intergrationapplicative['Application']['id'], array('controller' => 'applications', 'action' => 'view', $intergrationapplicative['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($intergrationapplicative['Type']['id'], array('controller' => 'types', 'action' => 'view', $intergrationapplicative['Type']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Version'); ?></dt>
		<dd>
			<?php echo $this->Html->link($intergrationapplicative['Version']['id'], array('controller' => 'versions', 'action' => 'view', $intergrationapplicative['Version']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATE'); ?></dt>
		<dd>
			<?php echo h($intergrationapplicative['Intergrationapplicative']['DATE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($intergrationapplicative['Intergrationapplicative']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($intergrationapplicative['Intergrationapplicative']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Intergrationapplicative'), array('action' => 'edit', $intergrationapplicative['Intergrationapplicative']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Intergrationapplicative'), array('action' => 'delete', $intergrationapplicative['Intergrationapplicative']['id']), null, __('Are you sure you want to delete # %s?', $intergrationapplicative['Intergrationapplicative']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Intergrationapplicatives'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Intergrationapplicative'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Versions'), array('controller' => 'versions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version'), array('controller' => 'versions', 'action' => 'add')); ?> </li>
	</ul>
</div>
