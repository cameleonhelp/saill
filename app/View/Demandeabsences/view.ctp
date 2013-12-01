<div class="demandeabsences view">
<h2><?php echo __('Demandeabsence'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($demandeabsence['Demandeabsence']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Utilisateur'); ?></dt>
		<dd>
			<?php echo $this->Html->link($demandeabsence['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $demandeabsence['Utilisateur']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATEDU'); ?></dt>
		<dd>
			<?php echo h($demandeabsence['Demandeabsence']['DATEDU']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATEDUTYPE'); ?></dt>
		<dd>
			<?php echo h($demandeabsence['Demandeabsence']['DATEDUTYPE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATEAU'); ?></dt>
		<dd>
			<?php echo h($demandeabsence['Demandeabsence']['DATEAU']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATEAUTYPE'); ?></dt>
		<dd>
			<?php echo h($demandeabsence['Demandeabsence']['DATEAUTYPE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATEDEMANDE'); ?></dt>
		<dd>
			<?php echo h($demandeabsence['Demandeabsence']['DATEDEMANDE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATEREPONSE'); ?></dt>
		<dd>
			<?php echo h($demandeabsence['Demandeabsence']['DATEREPONSE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('REPONSE'); ?></dt>
		<dd>
			<?php echo h($demandeabsence['Demandeabsence']['REPONSE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('REPONSEBY'); ?></dt>
		<dd>
			<?php echo h($demandeabsence['Demandeabsence']['REPONSEBY']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($demandeabsence['Demandeabsence']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($demandeabsence['Demandeabsence']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Demandeabsence'), array('action' => 'edit', $demandeabsence['Demandeabsence']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Demandeabsence'), array('action' => 'delete', $demandeabsence['Demandeabsence']['id']), null, __('Are you sure you want to delete # %s?', $demandeabsence['Demandeabsence']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Demandeabsences'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Demandeabsence'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
	</ul>
</div>
