<div class="applications view">
<h2><?php echo __('Application'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($application['Application']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($application['Application']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($application['Application']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($application['Application']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Application'), array('action' => 'edit', $application['Application']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Application'), array('action' => 'delete', $application['Application']['id']), null, __('Are you sure you want to delete # %s?', $application['Application']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Expressionbesoins'), array('controller' => 'expressionbesoins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Expressionbesoin'), array('controller' => 'expressionbesoins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Intergrationapplicatives'), array('controller' => 'intergrationapplicatives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Intergrationapplicative'), array('controller' => 'intergrationapplicatives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Logiciels'), array('controller' => 'logiciels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Logiciel'), array('controller' => 'logiciels', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Expressionbesoins'); ?></h3>
	<?php if (!empty($application['Expressionbesoin'])): ?>
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
	<?php foreach ($application['Expressionbesoin'] as $expressionbesoin): ?>
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
	<h3><?php echo __('Related Intergrationapplicatives'); ?></h3>
	<?php if (!empty($application['Intergrationapplicative'])): ?>
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
	<?php foreach ($application['Intergrationapplicative'] as $intergrationapplicative): ?>
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
<div class="related">
	<h3><?php echo __('Related Logiciels'); ?></h3>
	<?php if (!empty($application['Logiciel'])): ?>
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
	<?php foreach ($application['Logiciel'] as $logiciel): ?>
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
