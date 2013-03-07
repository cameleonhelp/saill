<div class="societes view">
<h2><?php  echo __('Societe'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($societe['Societe']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($societe['Societe']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOMCONTACT'); ?></dt>
		<dd>
			<?php echo h($societe['Societe']['NOMCONTACT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TELEPHONE'); ?></dt>
		<dd>
			<?php echo h($societe['Societe']['TELEPHONE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MAIL'); ?></dt>
		<dd>
			<?php echo h($societe['Societe']['MAIL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($societe['Societe']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($societe['Societe']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Societe'), array('action' => 'edit', $societe['Societe']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Societe'), array('action' => 'delete', $societe['Societe']['id']), null, __('Are you sure you want to delete # %s?', $societe['Societe']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Societes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Societe'), array('action' => 'add')); ?> </li>
	</ul>
</div>
