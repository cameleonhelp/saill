<div class="typemateriels view">
<h2><?php  echo __('Typemateriel'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($typemateriel['Typemateriel']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($typemateriel['Typemateriel']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DESCRIPTION'); ?></dt>
		<dd>
			<?php echo h($typemateriel['Typemateriel']['DESCRIPTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($typemateriel['Typemateriel']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($typemateriel['Typemateriel']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Typemateriel'), array('action' => 'edit', $typemateriel['Typemateriel']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Typemateriel'), array('action' => 'delete', $typemateriel['Typemateriel']['id']), null, __('Are you sure you want to delete # %s?', $typemateriel['Typemateriel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Typemateriels'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Typemateriel'), array('action' => 'add')); ?> </li>
	</ul>
</div>
