<div class="puissances view">
<h2><?php echo __('Puissance'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($puissance['Puissance']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($puissance['Puissance']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COMMENTAIRE'); ?></dt>
		<dd>
			<?php echo h($puissance['Puissance']['COMMENTAIRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('BDGMAO'); ?></dt>
		<dd>
			<?php echo h($puissance['Puissance']['BDGMAO']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('APPGMAO'); ?></dt>
		<dd>
			<?php echo h($puissance['Puissance']['APPGMAO']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ORCHESTRAL'); ?></dt>
		<dd>
			<?php echo h($puissance['Puissance']['ORCHESTRAL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('SGRM'); ?></dt>
		<dd>
			<?php echo h($puissance['Puissance']['SGRM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($puissance['Puissance']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($puissance['Puissance']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Puissance'), array('action' => 'edit', $puissance['Puissance']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Puissance'), array('action' => 'delete', $puissance['Puissance']['id']), null, __('Are you sure you want to delete # %s?', $puissance['Puissance']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Puissances'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Puissance'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Expressionbesoins'), array('controller' => 'expressionbesoins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Expressionbesoin'), array('controller' => 'expressionbesoins', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Expressionbesoins'); ?></h3>
	<?php if (!empty($puissance['Expressionbesoin'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Application Id'); ?></th>
		<th><?php echo __('Composant Id'); ?></th>
		<th><?php echo __('Perimetre Id'); ?></th>
		<th><?php echo __('Lot Id'); ?></th>
		<th><?php echo __('Etat Id'); ?></th>
		<th><?php echo __('Type Id'); ?></th>
		<th><?php echo __('Phase Id'); ?></th>
		<th><?php echo __('Volumetrie Id'); ?></th>
		<th><?php echo __('Puissance Id'); ?></th>
		<th><?php echo __('Architecture Id'); ?></th>
		<th><?php echo __('COMMENTAIRE'); ?></th>
		<th><?php echo __('USAGE'); ?></th>
		<th><?php echo __('NOMUSAGE'); ?></th>
		<th><?php echo __('DATELIVRAISON'); ?></th>
		<th><?php echo __('DATEFIN'); ?></th>
		<th><?php echo __('CONNECT'); ?></th>
		<th><?php echo __('PVU'); ?></th>
		<th><?php echo __('COUTWPS'); ?></th>
		<th><?php echo __('COUTWTX'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($puissance['Expressionbesoin'] as $expressionbesoin): ?>
		<tr>
			<td><?php echo $expressionbesoin['id']; ?></td>
			<td><?php echo $expressionbesoin['application_id']; ?></td>
			<td><?php echo $expressionbesoin['composant_id']; ?></td>
			<td><?php echo $expressionbesoin['perimetre_id']; ?></td>
			<td><?php echo $expressionbesoin['lot_id']; ?></td>
			<td><?php echo $expressionbesoin['etat_id']; ?></td>
			<td><?php echo $expressionbesoin['type_id']; ?></td>
			<td><?php echo $expressionbesoin['phase_id']; ?></td>
			<td><?php echo $expressionbesoin['volumetrie_id']; ?></td>
			<td><?php echo $expressionbesoin['puissance_id']; ?></td>
			<td><?php echo $expressionbesoin['architecture_id']; ?></td>
			<td><?php echo $expressionbesoin['COMMENTAIRE']; ?></td>
			<td><?php echo $expressionbesoin['USAGE']; ?></td>
			<td><?php echo $expressionbesoin['NOMUSAGE']; ?></td>
			<td><?php echo $expressionbesoin['DATELIVRAISON']; ?></td>
			<td><?php echo $expressionbesoin['DATEFIN']; ?></td>
			<td><?php echo $expressionbesoin['CONNECT']; ?></td>
			<td><?php echo $expressionbesoin['PVU']; ?></td>
			<td><?php echo $expressionbesoin['COUTWPS']; ?></td>
			<td><?php echo $expressionbesoin['COUTWTX']; ?></td>
			<td><?php echo $expressionbesoin['created']; ?></td>
			<td><?php echo $expressionbesoin['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'expressionbesoins', 'action' => 'view', $expressionbesoin['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'expressionbesoins', 'action' => 'edit', $expressionbesoin['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'expressionbesoins', 'action' => 'delete', $expressionbesoin['id']), null, __('Are you sure you want to delete # %s?', $expressionbesoin['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Expressionbesoin'), array('controller' => 'expressionbesoins', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
