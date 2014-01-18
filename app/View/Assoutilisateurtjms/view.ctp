<div class="assoutilisateurtjms view">
<h2><?php echo __('Assoutilisateurtjm'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($assoutilisateurtjm['Assoutilisateurtjm']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Utilisateur'); ?></dt>
		<dd>
			<?php echo $this->Html->link($assoutilisateurtjm['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $assoutilisateurtjm['Utilisateur']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tjmagent'); ?></dt>
		<dd>
			<?php echo $this->Html->link($assoutilisateurtjm['Tjmagent']['id'], array('controller' => 'tjmagents', 'action' => 'view', $assoutilisateurtjm['Tjmagent']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ANNEE'); ?></dt>
		<dd>
			<?php echo h($assoutilisateurtjm['Assoutilisateurtjm']['ANNEE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($assoutilisateurtjm['Assoutilisateurtjm']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($assoutilisateurtjm['Assoutilisateurtjm']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Assoutilisateurtjm'), array('action' => 'edit', $assoutilisateurtjm['Assoutilisateurtjm']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Assoutilisateurtjm'), array('action' => 'delete', $assoutilisateurtjm['Assoutilisateurtjm']['id']), null, __('Are you sure you want to delete # %s?', $assoutilisateurtjm['Assoutilisateurtjm']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Assoutilisateurtjms'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assoutilisateurtjm'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tjmagents'), array('controller' => 'tjmagents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tjmagent'), array('controller' => 'tjmagents', 'action' => 'add')); ?> </li>
	</ul>
</div>
