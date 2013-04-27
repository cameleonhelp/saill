<div class="historyutilisateurs view">
<h2><?php  echo __('Historyutilisateur'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($historyutilisateur['Historyutilisateur']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UTILISATEUR ID'); ?></dt>
		<dd>
			<?php echo h($historyutilisateur['Historyutilisateur']['UTILISATEUR_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('HISTORIQUE'); ?></dt>
		<dd>
			<?php echo h($historyutilisateur['Historyutilisateur']['HISTORIQUE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($historyutilisateur['Historyutilisateur']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($historyutilisateur['Historyutilisateur']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Historyutilisateur'), array('action' => 'edit', $historyutilisateur['Historyutilisateur']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Historyutilisateur'), array('action' => 'delete', $historyutilisateur['Historyutilisateur']['id']), null, __('Are you sure you want to delete # %s?', $historyutilisateur['Historyutilisateur']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Historyutilisateurs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Historyutilisateur'), array('action' => 'add')); ?> </li>
	</ul>
</div>
