<div class="equipes view">
<h2><?php  echo __('Equipe'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($equipe['Equipe']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Utilisateur Id'); ?></dt>
		<dd>
			<?php echo h($equipe['Equipe']['utilisateur_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Agent'); ?></dt>
		<dd>
			<?php echo h($equipe['Equipe']['agent']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($equipe['Equipe']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($equipe['Equipe']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Equipe'), array('action' => 'edit', $equipe['Equipe']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Equipe'), array('action' => 'delete', $equipe['Equipe']['id']), null, __('Are you sure you want to delete # %s?', $equipe['Equipe']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Equipes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Equipe'), array('action' => 'add')); ?> </li>
	</ul>
</div>
