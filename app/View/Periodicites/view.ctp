<div class="periodicites view">
<h2><?php echo __('Periodicite'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($periodicite['Periodicite']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('END'); ?></dt>
		<dd>
			<?php echo h($periodicite['Periodicite']['END']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ALLDAYMONTH'); ?></dt>
		<dd>
			<?php echo h($periodicite['Periodicite']['ALLDAYMONTH']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('REPEATALL'); ?></dt>
		<dd>
			<?php echo h($periodicite['Periodicite']['REPEATALL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LU'); ?></dt>
		<dd>
			<?php echo h($periodicite['Periodicite']['LU']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MA'); ?></dt>
		<dd>
			<?php echo h($periodicite['Periodicite']['MA']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ME'); ?></dt>
		<dd>
			<?php echo h($periodicite['Periodicite']['ME']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('JE'); ?></dt>
		<dd>
			<?php echo h($periodicite['Periodicite']['JE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('VE'); ?></dt>
		<dd>
			<?php echo h($periodicite['Periodicite']['VE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('SA'); ?></dt>
		<dd>
			<?php echo h($periodicite['Periodicite']['SA']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DI'); ?></dt>
		<dd>
			<?php echo h($periodicite['Periodicite']['DI']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($periodicite['Periodicite']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($periodicite['Periodicite']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Periodicite'), array('action' => 'edit', $periodicite['Periodicite']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Periodicite'), array('action' => 'delete', $periodicite['Periodicite']['id']), null, __('Are you sure you want to delete # %s?', $periodicite['Periodicite']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Periodicites'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Periodicite'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Actions'), array('controller' => 'actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Action'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Actions'); ?></h3>
	<?php if (!empty($periodicite['Action'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Utilisateur Id'); ?></th>
		<th><?php echo __('Destinataire'); ?></th>
		<th><?php echo __('Domaine Id'); ?></th>
		<th><?php echo __('Activite Id'); ?></th>
		<th><?php echo __('Periodicite Id'); ?></th>
		<th><?php echo __('OBJET'); ?></th>
		<th><?php echo __('AVANCEMENT'); ?></th>
		<th><?php echo __('COMMENTAIRE'); ?></th>
		<th><?php echo __('ECHEANCE'); ?></th>
		<th><?php echo __('DEBUT'); ?></th>
		<th><?php echo __('STATUT'); ?></th>
		<th><?php echo __('DUREEPREVUE'); ?></th>
		<th><?php echo __('PRIORITE'); ?></th>
		<th><?php echo __('CRA'); ?></th>
		<th><?php echo __('NEW'); ?></th>
		<th><?php echo __('FREQUENCE'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($periodicite['Action'] as $action): ?>
		<tr>
			<td><?php echo $action['id']; ?></td>
			<td><?php echo $action['utilisateur_id']; ?></td>
			<td><?php echo $action['destinataire']; ?></td>
			<td><?php echo $action['domaine_id']; ?></td>
			<td><?php echo $action['activite_id']; ?></td>
			<td><?php echo $action['periodicite_id']; ?></td>
			<td><?php echo $action['OBJET']; ?></td>
			<td><?php echo $action['AVANCEMENT']; ?></td>
			<td><?php echo $action['COMMENTAIRE']; ?></td>
			<td><?php echo $action['ECHEANCE']; ?></td>
			<td><?php echo $action['DEBUT']; ?></td>
			<td><?php echo $action['STATUT']; ?></td>
			<td><?php echo $action['DUREEPREVUE']; ?></td>
			<td><?php echo $action['PRIORITE']; ?></td>
			<td><?php echo $action['CRA']; ?></td>
			<td><?php echo $action['NEW']; ?></td>
			<td><?php echo $action['FREQUENCE']; ?></td>
			<td><?php echo $action['created']; ?></td>
			<td><?php echo $action['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'actions', 'action' => 'view', $action['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'actions', 'action' => 'edit', $action['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'actions', 'action' => 'delete', $action['id']), null, __('Are you sure you want to delete # %s?', $action['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Action'), array('controller' => 'actions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
