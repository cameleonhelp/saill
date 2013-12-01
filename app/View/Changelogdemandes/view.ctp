<div class="changelogdemandes view">
<h2><?php echo __('Changelogdemande'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($changelogdemande['Changelogdemande']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Changelogversion'); ?></dt>
		<dd>
			<?php echo $this->Html->link($changelogdemande['Changelogversion']['id'], array('controller' => 'changelogversions', 'action' => 'view', $changelogdemande['Changelogversion']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Utilisateur'); ?></dt>
		<dd>
			<?php echo $this->Html->link($changelogdemande['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $changelogdemande['Utilisateur']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OPEN'); ?></dt>
		<dd>
			<?php echo h($changelogdemande['Changelogdemande']['OPEN']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ETAT'); ?></dt>
		<dd>
			<?php echo h($changelogdemande['Changelogdemande']['ETAT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TYPE'); ?></dt>
		<dd>
			<?php echo h($changelogdemande['Changelogdemande']['TYPE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DEMANDE'); ?></dt>
		<dd>
			<?php echo h($changelogdemande['Changelogdemande']['DEMANDE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($changelogdemande['Changelogdemande']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($changelogdemande['Changelogdemande']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Changelogdemande'), array('action' => 'edit', $changelogdemande['Changelogdemande']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Changelogdemande'), array('action' => 'delete', $changelogdemande['Changelogdemande']['id']), null, __('Are you sure you want to delete # %s?', $changelogdemande['Changelogdemande']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Changelogdemandes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Changelogdemande'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Changelogversions'), array('controller' => 'changelogversions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Changelogversion'), array('controller' => 'changelogversions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Changelogreponses'), array('controller' => 'changelogreponses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Changelogreponse'), array('controller' => 'changelogreponses', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Changelogreponses'); ?></h3>
	<?php if (!empty($changelogdemande['Changelogreponse'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Changelogdemande Id'); ?></th>
		<th><?php echo __('Utilisateur Id'); ?></th>
		<th><?php echo __('REPONSE'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($changelogdemande['Changelogreponse'] as $changelogreponse): ?>
		<tr>
			<td><?php echo $changelogreponse['id']; ?></td>
			<td><?php echo $changelogreponse['changelogdemande_id']; ?></td>
			<td><?php echo $changelogreponse['utilisateur_id']; ?></td>
			<td><?php echo $changelogreponse['REPONSE']; ?></td>
			<td><?php echo $changelogreponse['created']; ?></td>
			<td><?php echo $changelogreponse['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'changelogreponses', 'action' => 'view', $changelogreponse['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'changelogreponses', 'action' => 'edit', $changelogreponse['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'changelogreponses', 'action' => 'delete', $changelogreponse['id']), null, __('Are you sure you want to delete # %s?', $changelogreponse['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Changelogreponse'), array('controller' => 'changelogreponses', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
