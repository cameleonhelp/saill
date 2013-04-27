<div class="historyactions view">
<h2><?php  echo __('Historyaction'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Action'); ?></dt>
		<dd>
			<?php echo $this->Html->link($historyaction['Action']['id'], array('controller' => 'actions', 'action' => 'view', $historyaction['Action']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('AVANCEMENT'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['AVANCEMENT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DEBUT'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['DEBUT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DEBUTREELLE'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['DEBUTREELLE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ECHEANCE'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['ECHEANCE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CHARGEPREVUE'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['CHARGEPREVUE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CHARGEREELLE'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['CHARGEREELLE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PRIORITE'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['PRIORITE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('STATUT'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['STATUT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COMMENTAIRE'); ?></dt>
		<dd>
			<?php echo h($historyaction['Historyaction']['COMMENTAIRE']); ?>
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
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Action'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
	</ul>
</div>
