<div class="modeles view">
<h2><?php echo __('Modele'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($modele['Modele']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($modele['Modele']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NBU'); ?></dt>
		<dd>
			<?php echo h($modele['Modele']['NBU']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($modele['Modele']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($modele['Modele']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Modele'), array('action' => 'edit', $modele['Modele']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Modele'), array('action' => 'delete', $modele['Modele']['id']), null, __('Are you sure you want to delete # %s?', $modele['Modele']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Modeles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modele'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Biens'), array('controller' => 'biens', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bien'), array('controller' => 'biens', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Biens'); ?></h3>
	<?php if (!empty($modele['Bien'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Modele Id'); ?></th>
		<th><?php echo __('Chassis Id'); ?></th>
		<th><?php echo __('Type Id'); ?></th>
		<th><?php echo __('Usage Id'); ?></th>
		<th><?php echo __('Lot Id'); ?></th>
		<th><?php echo __('NOM'); ?></th>
		<th><?php echo __('COEUR'); ?></th>
		<th><?php echo __('COEURSOFT'); ?></th>
		<th><?php echo __('RAM'); ?></th>
		<th><?php echo __('COUT'); ?></th>
		<th><?php echo __('CHECK'); ?></th>
		<th><?php echo __('CHECKBY'); ?></th>
		<th><?php echo __('INSTALL'); ?></th>
		<th><?php echo __('DATECHECKINSTALL'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($modele['Bien'] as $bien): ?>
		<tr>
			<td><?php echo $bien['id']; ?></td>
			<td><?php echo $bien['modele_id']; ?></td>
			<td><?php echo $bien['chassis_id']; ?></td>
			<td><?php echo $bien['type_id']; ?></td>
			<td><?php echo $bien['usage_id']; ?></td>
			<td><?php echo $bien['lot_id']; ?></td>
			<td><?php echo $bien['NOM']; ?></td>
			<td><?php echo $bien['COEUR']; ?></td>
			<td><?php echo $bien['COEURSOFT']; ?></td>
			<td><?php echo $bien['RAM']; ?></td>
			<td><?php echo $bien['COUT']; ?></td>
			<td><?php echo $bien['CHECK']; ?></td>
			<td><?php echo $bien['CHECKBY']; ?></td>
			<td><?php echo $bien['INSTALL']; ?></td>
			<td><?php echo $bien['DATECHECKINSTALL']; ?></td>
			<td><?php echo $bien['created']; ?></td>
			<td><?php echo $bien['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'biens', 'action' => 'view', $bien['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'biens', 'action' => 'edit', $bien['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'biens', 'action' => 'delete', $bien['id']), null, __('Are you sure you want to delete # %s?', $bien['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Bien'), array('controller' => 'biens', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
