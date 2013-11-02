<div class="logiciels view">
<h2><?php echo __('Logiciel'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($logiciel['Logiciel']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bien'); ?></dt>
		<dd>
			<?php echo $this->Html->link($logiciel['Bien']['id'], array('controller' => 'biens', 'action' => 'view', $logiciel['Bien']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Outil'); ?></dt>
		<dd>
			<?php echo $this->Html->link($logiciel['Outil']['id'], array('controller' => 'outils', 'action' => 'view', $logiciel['Outil']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($logiciel['Application']['id'], array('controller' => 'applications', 'action' => 'view', $logiciel['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($logiciel['Type']['id'], array('controller' => 'types', 'action' => 'view', $logiciel['Type']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lot'); ?></dt>
		<dd>
			<?php echo $this->Html->link($logiciel['Lot']['id'], array('controller' => 'lots', 'action' => 'view', $logiciel['Lot']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ENVIRONNEMENT'); ?></dt>
		<dd>
			<?php echo h($logiciel['Logiciel']['ENVIRONNEMENT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('INSTALL'); ?></dt>
		<dd>
			<?php echo h($logiciel['Logiciel']['INSTALL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATECHECKINSTALL'); ?></dt>
		<dd>
			<?php echo h($logiciel['Logiciel']['DATECHECKINSTALL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($logiciel['Logiciel']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($logiciel['Logiciel']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Logiciel'), array('action' => 'edit', $logiciel['Logiciel']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Logiciel'), array('action' => 'delete', $logiciel['Logiciel']['id']), null, __('Are you sure you want to delete # %s?', $logiciel['Logiciel']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Logiciels'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Logiciel'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Biens'), array('controller' => 'biens', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bien'), array('controller' => 'biens', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Outils'), array('controller' => 'outils', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Outil'), array('controller' => 'outils', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lots'), array('controller' => 'lots', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lot'), array('controller' => 'lots', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Historylogiciels'), array('controller' => 'historylogiciels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Historylogiciel'), array('controller' => 'historylogiciels', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Historylogiciels'); ?></h3>
	<?php if (!empty($logiciel['Historylogiciel'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Logiciel Id'); ?></th>
		<th><?php echo __('INSTALL'); ?></th>
		<th><?php echo __('DATECHECKINSTALL'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($logiciel['Historylogiciel'] as $historylogiciel): ?>
		<tr>
			<td><?php echo $historylogiciel['id']; ?></td>
			<td><?php echo $historylogiciel['logiciel_id']; ?></td>
			<td><?php echo $historylogiciel['INSTALL']; ?></td>
			<td><?php echo $historylogiciel['DATECHECKINSTALL']; ?></td>
			<td><?php echo $historylogiciel['created']; ?></td>
			<td><?php echo $historylogiciel['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'historylogiciels', 'action' => 'view', $historylogiciel['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'historylogiciels', 'action' => 'edit', $historylogiciel['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'historylogiciels', 'action' => 'delete', $historylogiciel['id']), null, __('Are you sure you want to delete # %s?', $historylogiciel['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Historylogiciel'), array('controller' => 'historylogiciels', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
