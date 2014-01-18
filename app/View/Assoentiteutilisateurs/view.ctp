<div class="assoentiteutilisateurs view">
<h2><?php echo __('Assoentiteutilisateur'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($assoentiteutilisateur['Assoentiteutilisateur']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Entite'); ?></dt>
		<dd>
			<?php echo $this->Html->link($assoentiteutilisateur['Entite']['id'], array('controller' => 'entites', 'action' => 'view', $assoentiteutilisateur['Entite']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Utilisateur'); ?></dt>
		<dd>
			<?php echo $this->Html->link($assoentiteutilisateur['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $assoentiteutilisateur['Utilisateur']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($assoentiteutilisateur['Assoentiteutilisateur']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($assoentiteutilisateur['Assoentiteutilisateur']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Assoentiteutilisateur'), array('action' => 'edit', $assoentiteutilisateur['Assoentiteutilisateur']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Assoentiteutilisateur'), array('action' => 'delete', $assoentiteutilisateur['Assoentiteutilisateur']['id']), null, __('Are you sure you want to delete # %s?', $assoentiteutilisateur['Assoentiteutilisateur']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Assoentiteutilisateurs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assoentiteutilisateur'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Entites'), array('controller' => 'entites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entite'), array('controller' => 'entites', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
	</ul>
</div>
