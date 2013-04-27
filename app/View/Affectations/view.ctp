<div class="affectations view">
<h2><?php  echo __('Affectation'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($affectation['Affectation']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UTILISATEUR ID'); ?></dt>
		<dd>
			<?php echo h($affectation['Affectation']['UTILISATEUR_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ACTIVITE ID'); ?></dt>
		<dd>
			<?php echo h($affectation['Affectation']['ACTIVITE_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($affectation['Affectation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($affectation['Affectation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Affectation'), array('action' => 'edit', $affectation['Affectation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Affectation'), array('action' => 'delete', $affectation['Affectation']['id']), null, __('Are you sure you want to delete # %s?', $affectation['Affectation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Affectations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Affectation'), array('action' => 'add')); ?> </li>
	</ul>
</div>
