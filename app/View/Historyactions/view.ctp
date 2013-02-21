<div class="historyactions view">
<h2><?php  echo __('Historyaction'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ACTION ID'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['ACTION_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UTILISATEUR ID'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['UTILISATEUR_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('HISTORIQUE'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['HISTORIQUE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('STATUT'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['STATUT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Historyaction'), array('action' => 'edit', $historyaction['Historyaction']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Historyaction'), array('action' => 'delete', $historyaction['Historyaction']['id']), null, __('Are you sure you want to delete # %s?', $historyaction['Historyaction']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Historyactions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Historyaction'), array('action' => 'add')); ?> </li>
	</ul>
</div>
