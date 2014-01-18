<div class="planetapes view">
<h2><?php echo __('Planetape'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($planetape['Planetape']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($planetape['Planetape']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ORDRE'); ?></dt>
		<dd>
			<?php echo h($planetape['Planetape']['ORDRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($planetape['Planetape']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($planetape['Planetape']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Planetape'), array('action' => 'edit', $planetape['Planetape']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Planetape'), array('action' => 'delete', $planetape['Planetape']['id']), null, __('Are you sure you want to delete # %s?', $planetape['Planetape']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Planetapes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Planetape'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Plangantts'), array('controller' => 'plangantts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plangantt'), array('controller' => 'plangantts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Plangantts'); ?></h3>
	<?php if (!empty($planetape['Plangantt'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Planetape Id'); ?></th>
		<th><?php echo __('Planprojets Id'); ?></th>
		<th><?php echo __('Utilisateurs Id'); ?></th>
		<th><?php echo __('NOM'); ?></th>
		<th><?php echo __('DATEDEBUT'); ?></th>
		<th><?php echo __('DATEFIN'); ?></th>
		<th><?php echo __('CHARGE'); ?></th>
		<th><?php echo __('CAPACITE'); ?></th>
		<th><?php echo __('ETAT'); ?></th>
		<th><?php echo __('AVANCEMENT'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($planetape['Plangantt'] as $plangantt): ?>
		<tr>
			<td><?php echo $plangantt['id']; ?></td>
			<td><?php echo $plangantt['planetape_id']; ?></td>
			<td><?php echo $plangantt['planprojets_id']; ?></td>
			<td><?php echo $plangantt['utilisateurs_id']; ?></td>
			<td><?php echo $plangantt['NOM']; ?></td>
			<td><?php echo $plangantt['DATEDEBUT']; ?></td>
			<td><?php echo $plangantt['DATEFIN']; ?></td>
			<td><?php echo $plangantt['CHARGE']; ?></td>
			<td><?php echo $plangantt['CAPACITE']; ?></td>
			<td><?php echo $plangantt['ETAT']; ?></td>
			<td><?php echo $plangantt['AVANCEMENT']; ?></td>
			<td><?php echo $plangantt['created']; ?></td>
			<td><?php echo $plangantt['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'plangantts', 'action' => 'view', $plangantt['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'plangantts', 'action' => 'edit', $plangantt['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'plangantts', 'action' => 'delete', $plangantt['id']), null, __('Are you sure you want to delete # %s?', $plangantt['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Plangantt'), array('controller' => 'plangantts', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
