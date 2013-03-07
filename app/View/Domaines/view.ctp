<div class="domaines view">
<h2><?php  echo __('Domaine'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($domaine['Domaine']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($domaine['Domaine']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DESCRIPTION'); ?></dt>
		<dd>
			<?php echo h($domaine['Domaine']['DESCRIPTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($domaine['Domaine']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($domaine['Domaine']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Domaine'), array('action' => 'edit', $domaine['Domaine']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Domaine'), array('action' => 'delete', $domaine['Domaine']['id']), null, __('Are you sure you want to delete # %s?', $domaine['Domaine']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Domaines'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Domaine'), array('action' => 'add')); ?> </li>
	</ul>
</div>
