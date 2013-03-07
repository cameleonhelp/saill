<div class="autorisations view">
<h2><?php  echo __('Autorisation'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($autorisation['Autorisation']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PROFIL ID'); ?></dt>
		<dd>
			<?php echo h($autorisation['Autorisation']['PROFIL_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MODEL'); ?></dt>
		<dd>
			<?php echo h($autorisation['Autorisation']['MODEL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('INDEX'); ?></dt>
		<dd>
			<?php echo h($autorisation['Autorisation']['INDEX']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ADD'); ?></dt>
		<dd>
			<?php echo h($autorisation['Autorisation']['ADD']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('EDIT'); ?></dt>
		<dd>
			<?php echo h($autorisation['Autorisation']['EDIT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('VIEW'); ?></dt>
		<dd>
			<?php echo h($autorisation['Autorisation']['VIEW']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DELETE'); ?></dt>
		<dd>
			<?php echo h($autorisation['Autorisation']['DELETE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DUPLICATE'); ?></dt>
		<dd>
			<?php echo h($autorisation['Autorisation']['DUPLICATE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('INITPASSWORD'); ?></dt>
		<dd>
			<?php echo h($autorisation['Autorisation']['INITPASSWORD']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($autorisation['Autorisation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($autorisation['Autorisation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Autorisation'), array('action' => 'edit', $autorisation['Autorisation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Autorisation'), array('action' => 'delete', $autorisation['Autorisation']['id']), null, __('Are you sure you want to delete # %s?', $autorisation['Autorisation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Autorisations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Autorisation'), array('action' => 'add')); ?> </li>
	</ul>
</div>
