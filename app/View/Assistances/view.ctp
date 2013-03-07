<div class="assistances view">
<h2><?php  echo __('Assistance'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($assistance['Assistance']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($assistance['Assistance']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DESCRIPTION'); ?></dt>
		<dd>
			<?php echo h($assistance['Assistance']['DESCRIPTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($assistance['Assistance']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($assistance['Assistance']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Assistance'), array('action' => 'edit', $assistance['Assistance']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Assistance'), array('action' => 'delete', $assistance['Assistance']['id']), null, __('Are you sure you want to delete # %s?', $assistance['Assistance']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Assistances'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assistance'), array('action' => 'add')); ?> </li>
	</ul>
</div>
