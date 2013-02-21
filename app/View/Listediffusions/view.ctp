<div class="listediffusions view">
<h2><?php  echo __('Listediffusion'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($listediffusion['Listediffusion']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UTILISATEUR ID'); ?></dt>
		<dd>
			<?php echo h($listediffusion['Listediffusion']['UTILISATEUR_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($listediffusion['Listediffusion']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DESCRIPTION'); ?></dt>
		<dd>
			<?php echo h($listediffusion['Listediffusion']['DESCRIPTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($listediffusion['Listediffusion']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($listediffusion['Listediffusion']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Listediffusion'), array('action' => 'edit', $listediffusion['Listediffusion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Listediffusion'), array('action' => 'delete', $listediffusion['Listediffusion']['id']), null, __('Are you sure you want to delete # %s?', $listediffusion['Listediffusion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Listediffusions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Listediffusion'), array('action' => 'add')); ?> </li>
	</ul>
</div>
