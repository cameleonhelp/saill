<div class="dotations view">
<h2><?php  echo __('Dotation'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($dotation['Dotation']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MATERIELINFORMATIQUE ID'); ?></dt>
		<dd>
			<?php echo h($dotation['Dotation']['MATERIELINFORMATIQUE_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MATERIELAUTRES ID'); ?></dt>
		<dd>
			<?php echo h($dotation['Dotation']['MATERIELAUTRES_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UTILISATEUR ID'); ?></dt>
		<dd>
			<?php echo h($dotation['Dotation']['UTILISATEUR_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATERECEPTION'); ?></dt>
		<dd>
			<?php echo h($dotation['Dotation']['DATERECEPTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATEREMISE'); ?></dt>
		<dd>
			<?php echo h($dotation['Dotation']['DATEREMISE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($dotation['Dotation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($dotation['Dotation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Dotation'), array('action' => 'edit', $dotation['Dotation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Dotation'), array('action' => 'delete', $dotation['Dotation']['id']), null, __('Are you sure you want to delete # %s?', $dotation['Dotation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Dotations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dotation'), array('action' => 'add')); ?> </li>
	</ul>
</div>
