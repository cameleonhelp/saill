<div class="lots view">
<h2><?php echo __('Lot'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($lot['Lot']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($lot['Lot']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($lot['Lot']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($lot['Lot']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Lot'), array('action' => 'edit', $lot['Lot']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Lot'), array('action' => 'delete', $lot['Lot']['id']), null, __('Are you sure you want to delete # %s?', $lot['Lot']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Lots'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lot'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Biens'), array('controller' => 'biens', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bien'), array('controller' => 'biens', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Expressionbesoins'), array('controller' => 'expressionbesoins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Expressionbesoin'), array('controller' => 'expressionbesoins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Logiciels'), array('controller' => 'logiciels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Logiciel'), array('controller' => 'logiciels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Versions'), array('controller' => 'versions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Version'), array('controller' => 'versions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Biens'); ?></h3>
	<?php if (!empty($lot['Bien'])): ?>
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
	<?php foreach ($lot['Bien'] as $bien): ?>
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
<div class="related">
	<h3><?php echo __('Related Expressionbesoins'); ?></h3>
	<?php if (!empty($lot['Expressionbesoin'])): ?>
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
	<?php foreach ($lot['Expressionbesoin'] as $expressionbesoin): ?>
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
<div class="related">
	<h3><?php echo __('Related Logiciels'); ?></h3>
	<?php if (!empty($lot['Logiciel'])): ?>
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
	<?php foreach ($lot['Logiciel'] as $logiciel): ?>
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
<div class="related">
	<h3><?php echo __('Related Versions'); ?></h3>
	<?php if (!empty($lot['Version'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('NOM'); ?></th>
		<th><?php echo __('Lot Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($lot['Version'] as $version): ?>
		<tr>
			<td><?php echo $version['id']; ?></td>
			<td><?php echo $version['NOM']; ?></td>
			<td><?php echo $version['lot_id']; ?></td>
			<td><?php echo $version['created']; ?></td>
			<td><?php echo $version['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'versions', 'action' => 'view', $version['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'versions', 'action' => 'edit', $version['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'versions', 'action' => 'delete', $version['id']), null, __('Are you sure you want to delete # %s?', $version['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Version'), array('controller' => 'versions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
