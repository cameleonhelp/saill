<div class="versions view">
<h2><?php echo __('Version'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($version['Version']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($version['Version']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lot'); ?></dt>
		<dd>
			<?php echo $this->Html->link($version['Lot']['id'], array('controller' => 'lots', 'action' => 'view', $version['Lot']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($version['Version']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($version['Version']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Version'), array('action' => 'edit', $version['Version']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Version'), array('action' => 'delete', $version['Version']['id']), null, __('Are you sure you want to delete # %s?', $version['Version']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Versions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lots'), array('controller' => 'lots', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lot'), array('controller' => 'lots', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Intergrationapplicatives'), array('controller' => 'intergrationapplicatives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Intergrationapplicative'), array('controller' => 'intergrationapplicatives', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Intergrationapplicatives'); ?></h3>
	<?php if (!empty($version['Intergrationapplicative'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Application Id'); ?></th>
		<th><?php echo __('Type Id'); ?></th>
		<th><?php echo __('Version Id'); ?></th>
		<th><?php echo __('DATE'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($version['Intergrationapplicative'] as $intergrationapplicative): ?>
		<tr>
			<td><?php echo $intergrationapplicative['id']; ?></td>
			<td><?php echo $intergrationapplicative['application_id']; ?></td>
			<td><?php echo $intergrationapplicative['type_id']; ?></td>
			<td><?php echo $intergrationapplicative['version_id']; ?></td>
			<td><?php echo $intergrationapplicative['DATE']; ?></td>
			<td><?php echo $intergrationapplicative['modified']; ?></td>
			<td><?php echo $intergrationapplicative['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'intergrationapplicatives', 'action' => 'view', $intergrationapplicative['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'intergrationapplicatives', 'action' => 'edit', $intergrationapplicative['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'intergrationapplicatives', 'action' => 'delete', $intergrationapplicative['id']), null, __('Are you sure you want to delete # %s?', $intergrationapplicative['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Intergrationapplicative'), array('controller' => 'intergrationapplicatives', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
