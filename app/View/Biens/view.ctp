<div class="biens view">
<h2><?php echo __('Bien'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($bien['Bien']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modele'); ?></dt>
		<dd>
			<?php echo $this->Html->link($bien['Modele']['id'], array('controller' => 'modeles', 'action' => 'view', $bien['Modele']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Chassis'); ?></dt>
		<dd>
			<?php echo $this->Html->link($bien['Chassis']['id'], array('controller' => 'chassis', 'action' => 'view', $bien['Chassis']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($bien['Type']['id'], array('controller' => 'types', 'action' => 'view', $bien['Type']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usage'); ?></dt>
		<dd>
			<?php echo $this->Html->link($bien['Usage']['id'], array('controller' => 'usages', 'action' => 'view', $bien['Usage']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lot'); ?></dt>
		<dd>
			<?php echo $this->Html->link($bien['Lot']['id'], array('controller' => 'lots', 'action' => 'view', $bien['Lot']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($bien['Bien']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COEUR'); ?></dt>
		<dd>
			<?php echo h($bien['Bien']['COEUR']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COEURSOFT'); ?></dt>
		<dd>
			<?php echo h($bien['Bien']['COEURSOFT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('RAM'); ?></dt>
		<dd>
			<?php echo h($bien['Bien']['RAM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COUT'); ?></dt>
		<dd>
			<?php echo h($bien['Bien']['COUT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CHECK'); ?></dt>
		<dd>
			<?php echo h($bien['Bien']['CHECK']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CHECKBY'); ?></dt>
		<dd>
			<?php echo h($bien['Bien']['CHECKBY']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('INSTALL'); ?></dt>
		<dd>
			<?php echo h($bien['Bien']['INSTALL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATECHECKINSTALL'); ?></dt>
		<dd>
			<?php echo h($bien['Bien']['DATECHECKINSTALL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($bien['Bien']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($bien['Bien']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Bien'), array('action' => 'edit', $bien['Bien']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Bien'), array('action' => 'delete', $bien['Bien']['id']), null, __('Are you sure you want to delete # %s?', $bien['Bien']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Biens'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bien'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Modeles'), array('controller' => 'modeles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modele'), array('controller' => 'modeles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Chassis'), array('controller' => 'chassis', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Chassis'), array('controller' => 'chassis', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usages'), array('controller' => 'usages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usage'), array('controller' => 'usages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lots'), array('controller' => 'lots', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lot'), array('controller' => 'lots', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Logiciels'), array('controller' => 'logiciels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Logiciel'), array('controller' => 'logiciels', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Logiciels'); ?></h3>
	<?php if (!empty($bien['Logiciel'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Bien Id'); ?></th>
		<th><?php echo __('Outil Id'); ?></th>
		<th><?php echo __('Application Id'); ?></th>
		<th><?php echo __('Type Id'); ?></th>
		<th><?php echo __('Lot Id'); ?></th>
		<th><?php echo __('ENVIRONNEMENT'); ?></th>
		<th><?php echo __('INSTALL'); ?></th>
		<th><?php echo __('DATECHECKINSTALL'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($bien['Logiciel'] as $logiciel): ?>
		<tr>
			<td><?php echo $logiciel['id']; ?></td>
			<td><?php echo $logiciel['bien_id']; ?></td>
			<td><?php echo $logiciel['outil_id']; ?></td>
			<td><?php echo $logiciel['application_id']; ?></td>
			<td><?php echo $logiciel['type_id']; ?></td>
			<td><?php echo $logiciel['lot_id']; ?></td>
			<td><?php echo $logiciel['ENVIRONNEMENT']; ?></td>
			<td><?php echo $logiciel['INSTALL']; ?></td>
			<td><?php echo $logiciel['DATECHECKINSTALL']; ?></td>
			<td><?php echo $logiciel['modified']; ?></td>
			<td><?php echo $logiciel['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'logiciels', 'action' => 'view', $logiciel['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'logiciels', 'action' => 'edit', $logiciel['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'logiciels', 'action' => 'delete', $logiciel['id']), null, __('Are you sure you want to delete # %s?', $logiciel['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Logiciel'), array('controller' => 'logiciels', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
