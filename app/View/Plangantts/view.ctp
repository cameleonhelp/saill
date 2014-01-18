<div class="plangantts view">
<h2><?php echo __('Plangantt'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($plangantt['Plangantt']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Planetape'); ?></dt>
		<dd>
			<?php echo $this->Html->link($plangantt['Planetape']['id'], array('controller' => 'planetapes', 'action' => 'view', $plangantt['Planetape']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Planprojets'); ?></dt>
		<dd>
			<?php echo $this->Html->link($plangantt['Planprojets']['id'], array('controller' => 'planprojets', 'action' => 'view', $plangantt['Planprojets']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Utilisateurs'); ?></dt>
		<dd>
			<?php echo $this->Html->link($plangantt['Utilisateurs']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $plangantt['Utilisateurs']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($plangantt['Plangantt']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATEDEBUT'); ?></dt>
		<dd>
			<?php echo h($plangantt['Plangantt']['DATEDEBUT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATEFIN'); ?></dt>
		<dd>
			<?php echo h($plangantt['Plangantt']['DATEFIN']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CHARGE'); ?></dt>
		<dd>
			<?php echo h($plangantt['Plangantt']['CHARGE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CAPACITE'); ?></dt>
		<dd>
			<?php echo h($plangantt['Plangantt']['CAPACITE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ETAT'); ?></dt>
		<dd>
			<?php echo h($plangantt['Plangantt']['ETAT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('AVANCEMENT'); ?></dt>
		<dd>
			<?php echo h($plangantt['Plangantt']['AVANCEMENT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($plangantt['Plangantt']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($plangantt['Plangantt']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Plangantt'), array('action' => 'edit', $plangantt['Plangantt']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Plangantt'), array('action' => 'delete', $plangantt['Plangantt']['id']), null, __('Are you sure you want to delete # %s?', $plangantt['Plangantt']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Plangantts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plangantt'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Planetapes'), array('controller' => 'planetapes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Planetape'), array('controller' => 'planetapes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Planprojets'), array('controller' => 'planprojets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Planprojets'), array('controller' => 'planprojets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
	</ul>
</div>
