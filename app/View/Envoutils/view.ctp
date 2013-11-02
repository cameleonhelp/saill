<div class="envoutils view">
<h2><?php echo __('Envoutil'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($envoutil['Envoutil']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($envoutil['Envoutil']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($envoutil['Envoutil']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($envoutil['Envoutil']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Envoutil'), array('action' => 'edit', $envoutil['Envoutil']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Envoutil'), array('action' => 'delete', $envoutil['Envoutil']['id']), null, __('Are you sure you want to delete # %s?', $envoutil['Envoutil']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Envoutils'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Envoutil'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Envversions'), array('controller' => 'envversions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Envversion'), array('controller' => 'envversions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mws'), array('controller' => 'mws', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mw'), array('controller' => 'mws', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Envversions'); ?></h3>
	<?php if (!empty($envoutil['Envversion'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Envoutil Id'); ?></th>
		<th><?php echo __('VERSION'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($envoutil['Envversion'] as $envversion): ?>
		<tr>
			<td><?php echo $envversion['id']; ?></td>
			<td><?php echo $envversion['envoutil_id']; ?></td>
			<td><?php echo $envversion['VERSION']; ?></td>
			<td><?php echo $envversion['created']; ?></td>
			<td><?php echo $envversion['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'envversions', 'action' => 'view', $envversion['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'envversions', 'action' => 'edit', $envversion['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'envversions', 'action' => 'delete', $envversion['id']), null, __('Are you sure you want to delete # %s?', $envversion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Envversion'), array('controller' => 'envversions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Mws'); ?></h3>
	<?php if (!empty($envoutil['Mw'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Envoutil Id'); ?></th>
		<th><?php echo __('PVU'); ?></th>
		<th><?php echo __('COUTUNITAIRE'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($envoutil['Mw'] as $mw): ?>
		<tr>
			<td><?php echo $mw['id']; ?></td>
			<td><?php echo $mw['envoutil_id']; ?></td>
			<td><?php echo $mw['PVU']; ?></td>
			<td><?php echo $mw['COUTUNITAIRE']; ?></td>
			<td><?php echo $mw['created']; ?></td>
			<td><?php echo $mw['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'mws', 'action' => 'view', $mw['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'mws', 'action' => 'edit', $mw['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'mws', 'action' => 'delete', $mw['id']), null, __('Are you sure you want to delete # %s?', $mw['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Mw'), array('controller' => 'mws', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
