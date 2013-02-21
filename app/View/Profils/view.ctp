<div class="profils view">
<h2><?php  echo __('Profil'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($profil['Profil']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($profil['Profil']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COMMENTAIRE'); ?></dt>
		<dd>
			<?php echo h($profil['Profil']['COMMENTAIRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($profil['Profil']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($profil['Profil']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Profil'), array('action' => 'edit', $profil['Profil']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Profil'), array('action' => 'delete', $profil['Profil']['id']), null, __('Are you sure you want to delete # %s?', $profil['Profil']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Profils'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profil'), array('action' => 'add')); ?> </li>
	</ul>
</div>
