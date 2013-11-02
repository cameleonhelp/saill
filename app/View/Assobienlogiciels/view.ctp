<div class="assobienlogiciels view">
<h2><?php echo __('Assobienlogiciel'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($assobienlogiciel['Assobienlogiciel']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bien'); ?></dt>
		<dd>
			<?php echo $this->Html->link($assobienlogiciel['Bien']['id'], array('controller' => 'biens', 'action' => 'view', $assobienlogiciel['Bien']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Logiciel'); ?></dt>
		<dd>
			<?php echo $this->Html->link($assobienlogiciel['Logiciel']['id'], array('controller' => 'logiciels', 'action' => 'view', $assobienlogiciel['Logiciel']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($assobienlogiciel['Assobienlogiciel']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($assobienlogiciel['Assobienlogiciel']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Assobienlogiciel'), array('action' => 'edit', $assobienlogiciel['Assobienlogiciel']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Assobienlogiciel'), array('action' => 'delete', $assobienlogiciel['Assobienlogiciel']['id']), null, __('Are you sure you want to delete # %s?', $assobienlogiciel['Assobienlogiciel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Assobienlogiciels'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assobienlogiciel'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Biens'), array('controller' => 'biens', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bien'), array('controller' => 'biens', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Logiciels'), array('controller' => 'logiciels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Logiciel'), array('controller' => 'logiciels', 'action' => 'add')); ?> </li>
	</ul>
</div>
