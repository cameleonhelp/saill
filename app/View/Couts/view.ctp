<div class="couts view">
<h2><?php echo __('Cout'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cout['Cout']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($cout['Cout']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MONTANT'); ?></dt>
		<dd>
			<?php echo h($cout['Cout']['MONTANT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($cout['Cout']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($cout['Cout']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cout'), array('action' => 'edit', $cout['Cout']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cout'), array('action' => 'delete', $cout['Cout']['id']), null, __('Are you sure you want to delete # %s?', $cout['Cout']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Couts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cout'), array('action' => 'add')); ?> </li>
	</ul>
</div>
