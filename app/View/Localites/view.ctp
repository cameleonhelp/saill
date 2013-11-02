<div class="localites view">
<h2><?php echo __('Localite'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($localite['Localite']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($localite['Localite']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($localite['Localite']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($localite['Localite']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Localite'), array('action' => 'edit', $localite['Localite']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Localite'), array('action' => 'delete', $localite['Localite']['id']), null, __('Are you sure you want to delete # %s?', $localite['Localite']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Localites'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Localite'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Chassis'), array('controller' => 'chassis', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Chassis'), array('controller' => 'chassis', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Chassis'); ?></h3>
	<?php if (!empty($localite['Chassis'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Localite Id'); ?></th>
		<th><?php echo __('NOM'); ?></th>
		<th><?php echo __('NIVEAU'); ?></th>
		<th><?php echo __('ARMOIRE'); ?></th>
		<th><?php echo __('PVU'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($localite['Chassis'] as $chassis): ?>
		<tr>
			<td><?php echo $chassis['id']; ?></td>
			<td><?php echo $chassis['localite_id']; ?></td>
			<td><?php echo $chassis['NOM']; ?></td>
			<td><?php echo $chassis['NIVEAU']; ?></td>
			<td><?php echo $chassis['ARMOIRE']; ?></td>
			<td><?php echo $chassis['PVU']; ?></td>
			<td><?php echo $chassis['created']; ?></td>
			<td><?php echo $chassis['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'chassis', 'action' => 'view', $chassis['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'chassis', 'action' => 'edit', $chassis['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'chassis', 'action' => 'delete', $chassis['id']), null, __('Are you sure you want to delete # %s?', $chassis['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Chassis'), array('controller' => 'chassis', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
