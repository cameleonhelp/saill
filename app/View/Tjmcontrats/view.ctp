<div class="tjmcontrats view">
<h2><?php  echo __('Tjmcontrat'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($tjmcontrat['Tjmcontrat']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TJM'); ?></dt>
		<dd>
			<?php echo h($tjmcontrat['Tjmcontrat']['TJM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ANNEE'); ?></dt>
		<dd>
			<?php echo h($tjmcontrat['Tjmcontrat']['ANNEE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($tjmcontrat['Tjmcontrat']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($tjmcontrat['Tjmcontrat']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tjmcontrat'), array('action' => 'edit', $tjmcontrat['Tjmcontrat']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tjmcontrat'), array('action' => 'delete', $tjmcontrat['Tjmcontrat']['id']), null, __('Are you sure you want to delete # %s?', $tjmcontrat['Tjmcontrat']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tjmcontrats'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tjmcontrat'), array('action' => 'add')); ?> </li>
	</ul>
</div>
