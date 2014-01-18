<div class="assoprojetentites view">
<h2><?php echo __('Assoprojetentite'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($assoprojetentite['Assoprojetentite']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Entite'); ?></dt>
		<dd>
			<?php echo $this->Html->link($assoprojetentite['Entite']['id'], array('controller' => 'entites', 'action' => 'view', $assoprojetentite['Entite']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Projet'); ?></dt>
		<dd>
			<?php echo $this->Html->link($assoprojetentite['Projet']['id'], array('controller' => 'projets', 'action' => 'view', $assoprojetentite['Projet']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($assoprojetentite['Assoprojetentite']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($assoprojetentite['Assoprojetentite']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Assoprojetentite'), array('action' => 'edit', $assoprojetentite['Assoprojetentite']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Assoprojetentite'), array('action' => 'delete', $assoprojetentite['Assoprojetentite']['id']), null, __('Are you sure you want to delete # %s?', $assoprojetentite['Assoprojetentite']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Assoprojetentites'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assoprojetentite'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Entites'), array('controller' => 'entites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entite'), array('controller' => 'entites', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projets'), array('controller' => 'projets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Projet'), array('controller' => 'projets', 'action' => 'add')); ?> </li>
	</ul>
</div>
