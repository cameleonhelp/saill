<div class="linkshareds view">
<h2><?php  echo __('Linkshared'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($linkshared['Linkshared']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UTILISATEUR ID'); ?></dt>
		<dd>
			<?php echo h($linkshared['Linkshared']['UTILISATEUR_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($linkshared['Linkshared']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LINK'); ?></dt>
		<dd>
			<?php echo h($linkshared['Linkshared']['LINK']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($linkshared['Linkshared']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($linkshared['Linkshared']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Linkshared'), array('action' => 'edit', $linkshared['Linkshared']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Linkshared'), array('action' => 'delete', $linkshared['Linkshared']['id']), null, __('Are you sure you want to delete # %s?', $linkshared['Linkshared']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Linkshareds'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Linkshared'), array('action' => 'add')); ?> </li>
	</ul>
</div>
