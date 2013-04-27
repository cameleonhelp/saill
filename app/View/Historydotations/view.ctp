<div class="historydotations view">
<h2><?php  echo __('Historydotation'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($historydotation['Historydotation']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DOTATION ID'); ?></dt>
		<dd>
			<?php echo h($historydotation['Historydotation']['DOTATION_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('HISTORIQUE'); ?></dt>
		<dd>
			<?php echo h($historydotation['Historydotation']['HISTORIQUE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($historydotation['Historydotation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($historydotation['Historydotation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Historydotation'), array('action' => 'edit', $historydotation['Historydotation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Historydotation'), array('action' => 'delete', $historydotation['Historydotation']['id']), null, __('Are you sure you want to delete # %s?', $historydotation['Historydotation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Historydotations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Historydotation'), array('action' => 'add')); ?> </li>
	</ul>
</div>
