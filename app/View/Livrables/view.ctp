<div class="livrables view">
<h2><?php  echo __('Livrable'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($livrable['Livrable']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UTILISATEUR ID'); ?></dt>
		<dd>
			<?php echo h($livrable['Livrable']['UTILISATEUR_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($livrable['Livrable']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('REFERENCE'); ?></dt>
		<dd>
			<?php echo h($livrable['Livrable']['REFERENCE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($livrable['Livrable']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($livrable['Livrable']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Livrable'), array('action' => 'edit', $livrable['Livrable']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Livrable'), array('action' => 'delete', $livrable['Livrable']['id']), null, __('Are you sure you want to delete # %s?', $livrable['Livrable']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Livrables'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Livrable'), array('action' => 'add')); ?> </li>
	</ul>
</div>
