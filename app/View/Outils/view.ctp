<div class="outils view">
<h2><?php  echo __('Outil'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($outil['Outil']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UTILISATEUR ID'); ?></dt>
		<dd>
			<?php echo h($outil['Outil']['UTILISATEUR_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($outil['Outil']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DESCRIPTION'); ?></dt>
		<dd>
			<?php echo h($outil['Outil']['DESCRIPTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('VALIDATION'); ?></dt>
		<dd>
			<?php echo h($outil['Outil']['VALIDATION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($outil['Outil']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($outil['Outil']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Outil'), array('action' => 'edit', $outil['Outil']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Outil'), array('action' => 'delete', $outil['Outil']['id']), null, __('Are you sure you want to delete # %s?', $outil['Outil']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Outils'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outil'), array('action' => 'add')); ?> </li>
	</ul>
</div>
