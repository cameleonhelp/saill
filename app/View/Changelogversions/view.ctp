<div class="changelogversions view">
<h2><?php echo __('Changelogversion'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($changelogversion['Changelogversion']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('VERSION'); ?></dt>
		<dd>
			<?php echo h($changelogversion['Changelogversion']['VERSION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ETAT'); ?></dt>
		<dd>
			<?php echo h($changelogversion['Changelogversion']['ETAT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($changelogversion['Changelogversion']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($changelogversion['Changelogversion']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Changelogversion'), array('action' => 'edit', $changelogversion['Changelogversion']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Changelogversion'), array('action' => 'delete', $changelogversion['Changelogversion']['id']), null, __('Are you sure you want to delete # %s?', $changelogversion['Changelogversion']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Changelogversions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Changelogversion'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Changelogdemandes'), array('controller' => 'changelogdemandes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Changelogdemande'), array('controller' => 'changelogdemandes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Changelogdemandes'); ?></h3>
	<?php if (!empty($changelogversion['Changelogdemande'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Changelogversion Id'); ?></th>
		<th><?php echo __('Utilisateur Id'); ?></th>
		<th><?php echo __('OPEN'); ?></th>
		<th><?php echo __('ETAT'); ?></th>
		<th><?php echo __('TYPE'); ?></th>
		<th><?php echo __('DEMANDE'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($changelogversion['Changelogdemande'] as $changelogdemande): ?>
		<tr>
			<td><?php echo $changelogdemande['id']; ?></td>
			<td><?php echo $changelogdemande['changelogversion_id']; ?></td>
			<td><?php echo $changelogdemande['utilisateur_id']; ?></td>
			<td><?php echo $changelogdemande['OPEN']; ?></td>
			<td><?php echo $changelogdemande['ETAT']; ?></td>
			<td><?php echo $changelogdemande['TYPE']; ?></td>
			<td><?php echo $changelogdemande['DEMANDE']; ?></td>
			<td><?php echo $changelogdemande['created']; ?></td>
			<td><?php echo $changelogdemande['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'changelogdemandes', 'action' => 'view', $changelogdemande['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'changelogdemandes', 'action' => 'edit', $changelogdemande['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'changelogdemandes', 'action' => 'delete', $changelogdemande['id']), null, __('Are you sure you want to delete # %s?', $changelogdemande['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Changelogdemande'), array('controller' => 'changelogdemandes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
