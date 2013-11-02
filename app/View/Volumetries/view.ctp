<div class="volumetries view">
<h2><?php echo __('Volumetry'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($volumetry['Volumetry']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($volumetry['Volumetry']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('VALEUR'); ?></dt>
		<dd>
			<?php echo h($volumetry['Volumetry']['VALEUR']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COMMENTAIRE'); ?></dt>
		<dd>
			<?php echo h($volumetry['Volumetry']['COMMENTAIRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($volumetry['Volumetry']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($volumetry['Volumetry']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Volumetry'), array('action' => 'edit', $volumetry['Volumetry']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Volumetry'), array('action' => 'delete', $volumetry['Volumetry']['id']), null, __('Are you sure you want to delete # %s?', $volumetry['Volumetry']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Volumetries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Volumetry'), array('action' => 'add')); ?> </li>
	</ul>
</div>
