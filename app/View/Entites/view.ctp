<div class="entites view">
<h2><?php echo __('Entite'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($entite['Entite']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Utilisateur'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entite['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $entite['Utilisateur']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($entite['Entite']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($entite['Entite']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($entite['Entite']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MAILVALIDEUR'); ?></dt>
		<dd>
			<?php echo h($entite['Entite']['MAILVALIDEUR']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MAILGESTANNUAIRE'); ?></dt>
		<dd>
			<?php echo h($entite['Entite']['MAILGESTANNUAIRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MAILGESTENV'); ?></dt>
		<dd>
			<?php echo h($entite['Entite']['MAILGESTENV']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Entite'), array('action' => 'edit', $entite['Entite']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Entite'), array('action' => 'delete', $entite['Entite']['id']), null, __('Are you sure you want to delete # %s?', $entite['Entite']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Entites'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entite'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Biens'), array('controller' => 'biens', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bien'), array('controller' => 'biens', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contrats'), array('controller' => 'contrats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contrat'), array('controller' => 'contrats', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Domaines'), array('controller' => 'domaines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Domaine'), array('controller' => 'domaines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Dossierpartages'), array('controller' => 'dossierpartages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dossierpartage'), array('controller' => 'dossierpartages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Expressionbesoins'), array('controller' => 'expressionbesoins', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Expressionbesoin'), array('controller' => 'expressionbesoins', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Intergrationapplicatives'), array('controller' => 'intergrationapplicatives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Intergrationapplicative'), array('controller' => 'intergrationapplicatives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Listediffusions'), array('controller' => 'listediffusions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Listediffusion'), array('controller' => 'listediffusions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Logiciels'), array('controller' => 'logiciels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Logiciel'), array('controller' => 'logiciels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lots'), array('controller' => 'lots', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lot'), array('controller' => 'lots', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Messages'), array('controller' => 'messages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Plancharges'), array('controller' => 'plancharges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plancharge'), array('controller' => 'plancharges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sections'), array('controller' => 'sections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Section'), array('controller' => 'sections', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Applications'); ?></h3>
	<?php if (!empty($entite['Application'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Entite Id'); ?></th>
		<th><?php echo __('NOM'); ?></th>
		<th><?php echo __('ACTIF'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entite['Application'] as $application): ?>
		<tr>
			<td><?php echo $application['id']; ?></td>
			<td><?php echo $application['entite_id']; ?></td>
			<td><?php echo $application['NOM']; ?></td>
			<td><?php echo $application['ACTIF']; ?></td>
			<td><?php echo $application['created']; ?></td>
			<td><?php echo $application['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'applications', 'action' => 'view', $application['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'applications', 'action' => 'edit', $application['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'applications', 'action' => 'delete', $application['id']), null, __('Are you sure you want to delete # %s?', $application['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Biens'); ?></h3>
	<?php if (!empty($entite['Bien'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Entite Id'); ?></th>
		<th><?php echo __('Modele Id'); ?></th>
		<th><?php echo __('Chassis Id'); ?></th>
		<th><?php echo __('Type Id'); ?></th>
		<th><?php echo __('Application Id'); ?></th>
		<th><?php echo __('Usage Id'); ?></th>
		<th><?php echo __('Lot Id'); ?></th>
		<th><?php echo __('Cpu Id'); ?></th>
		<th><?php echo __('NOM'); ?></th>
		<th><?php echo __('COEUR'); ?></th>
		<th><?php echo __('COEURLICENCE'); ?></th>
		<th><?php echo __('PVU'); ?></th>
		<th><?php echo __('RAM'); ?></th>
		<th><?php echo __('COUT'); ?></th>
		<th><?php echo __('CHECK'); ?></th>
		<th><?php echo __('CHECKBY'); ?></th>
		<th><?php echo __('DATECHECKINSTALL'); ?></th>
		<th><?php echo __('INSTALL'); ?></th>
		<th><?php echo __('DATEINSTALL'); ?></th>
		<th><?php echo __('ACTIF'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entite['Bien'] as $bien): ?>
		<tr>
			<td><?php echo $bien['id']; ?></td>
			<td><?php echo $bien['entite_id']; ?></td>
			<td><?php echo $bien['modele_id']; ?></td>
			<td><?php echo $bien['chassis_id']; ?></td>
			<td><?php echo $bien['type_id']; ?></td>
			<td><?php echo $bien['application_id']; ?></td>
			<td><?php echo $bien['usage_id']; ?></td>
			<td><?php echo $bien['lot_id']; ?></td>
			<td><?php echo $bien['cpu_id']; ?></td>
			<td><?php echo $bien['NOM']; ?></td>
			<td><?php echo $bien['COEUR']; ?></td>
			<td><?php echo $bien['COEURLICENCE']; ?></td>
			<td><?php echo $bien['PVU']; ?></td>
			<td><?php echo $bien['RAM']; ?></td>
			<td><?php echo $bien['COUT']; ?></td>
			<td><?php echo $bien['CHECK']; ?></td>
			<td><?php echo $bien['CHECKBY']; ?></td>
			<td><?php echo $bien['DATECHECKINSTALL']; ?></td>
			<td><?php echo $bien['INSTALL']; ?></td>
			<td><?php echo $bien['DATEINSTALL']; ?></td>
			<td><?php echo $bien['ACTIF']; ?></td>
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
	<h3><?php echo __('Related Contrats'); ?></h3>
	<?php if (!empty($entite['Contrat'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Entite Id'); ?></th>
		<th><?php echo __('Tjmcontrat Id'); ?></th>
		<th><?php echo __('NOM'); ?></th>
		<th><?php echo __('ANNEEDEBUT'); ?></th>
		<th><?php echo __('ANNEEFIN'); ?></th>
		<th><?php echo __('MONTANT'); ?></th>
		<th><?php echo __('ACTIF'); ?></th>
		<th><?php echo __('DESCRIPTION'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entite['Contrat'] as $contrat): ?>
		<tr>
			<td><?php echo $contrat['id']; ?></td>
			<td><?php echo $contrat['entite_id']; ?></td>
			<td><?php echo $contrat['tjmcontrat_id']; ?></td>
			<td><?php echo $contrat['NOM']; ?></td>
			<td><?php echo $contrat['ANNEEDEBUT']; ?></td>
			<td><?php echo $contrat['ANNEEFIN']; ?></td>
			<td><?php echo $contrat['MONTANT']; ?></td>
			<td><?php echo $contrat['ACTIF']; ?></td>
			<td><?php echo $contrat['DESCRIPTION']; ?></td>
			<td><?php echo $contrat['created']; ?></td>
			<td><?php echo $contrat['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'contrats', 'action' => 'view', $contrat['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'contrats', 'action' => 'edit', $contrat['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'contrats', 'action' => 'delete', $contrat['id']), null, __('Are you sure you want to delete # %s?', $contrat['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Contrat'), array('controller' => 'contrats', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Domaines'); ?></h3>
	<?php if (!empty($entite['Domaine'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Entite Id'); ?></th>
		<th><?php echo __('NOM'); ?></th>
		<th><?php echo __('DESCRIPTION'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entite['Domaine'] as $domaine): ?>
		<tr>
			<td><?php echo $domaine['id']; ?></td>
			<td><?php echo $domaine['entite_id']; ?></td>
			<td><?php echo $domaine['NOM']; ?></td>
			<td><?php echo $domaine['DESCRIPTION']; ?></td>
			<td><?php echo $domaine['created']; ?></td>
			<td><?php echo $domaine['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'domaines', 'action' => 'view', $domaine['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'domaines', 'action' => 'edit', $domaine['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'domaines', 'action' => 'delete', $domaine['id']), null, __('Are you sure you want to delete # %s?', $domaine['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Domaine'), array('controller' => 'domaines', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Dossierpartages'); ?></h3>
	<?php if (!empty($entite['Dossierpartage'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Entite Id'); ?></th>
		<th><?php echo __('Utilisateur Id'); ?></th>
		<th><?php echo __('NOM'); ?></th>
		<th><?php echo __('GROUPEAD'); ?></th>
		<th><?php echo __('DESCRIPTION'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entite['Dossierpartage'] as $dossierpartage): ?>
		<tr>
			<td><?php echo $dossierpartage['id']; ?></td>
			<td><?php echo $dossierpartage['entite_id']; ?></td>
			<td><?php echo $dossierpartage['utilisateur_id']; ?></td>
			<td><?php echo $dossierpartage['NOM']; ?></td>
			<td><?php echo $dossierpartage['GROUPEAD']; ?></td>
			<td><?php echo $dossierpartage['DESCRIPTION']; ?></td>
			<td><?php echo $dossierpartage['created']; ?></td>
			<td><?php echo $dossierpartage['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'dossierpartages', 'action' => 'view', $dossierpartage['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'dossierpartages', 'action' => 'edit', $dossierpartage['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'dossierpartages', 'action' => 'delete', $dossierpartage['id']), null, __('Are you sure you want to delete # %s?', $dossierpartage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Dossierpartage'), array('controller' => 'dossierpartages', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Expressionbesoins'); ?></h3>
	<?php if (!empty($entite['Expressionbesoin'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Entite Id'); ?></th>
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
		<th><?php echo __('ENVIRONNEMENT'); ?></th>
		<th><?php echo __('COMMENTAIRE'); ?></th>
		<th><?php echo __('USAGE'); ?></th>
		<th><?php echo __('NOMUSAGE'); ?></th>
		<th><?php echo __('DATELIVRAISON'); ?></th>
		<th><?php echo __('DATEFIN'); ?></th>
		<th><?php echo __('CONNECT'); ?></th>
		<th><?php echo __('PVU'); ?></th>
		<th><?php echo __('ACTIF'); ?></th>
		<th><?php echo __('URL'); ?></th>
		<th><?php echo __('URLLOGIN'); ?></th>
		<th><?php echo __('URLPASSWORD'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entite['Expressionbesoin'] as $expressionbesoin): ?>
		<tr>
			<td><?php echo $expressionbesoin['id']; ?></td>
			<td><?php echo $expressionbesoin['entite_id']; ?></td>
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
			<td><?php echo $expressionbesoin['ENVIRONNEMENT']; ?></td>
			<td><?php echo $expressionbesoin['COMMENTAIRE']; ?></td>
			<td><?php echo $expressionbesoin['USAGE']; ?></td>
			<td><?php echo $expressionbesoin['NOMUSAGE']; ?></td>
			<td><?php echo $expressionbesoin['DATELIVRAISON']; ?></td>
			<td><?php echo $expressionbesoin['DATEFIN']; ?></td>
			<td><?php echo $expressionbesoin['CONNECT']; ?></td>
			<td><?php echo $expressionbesoin['PVU']; ?></td>
			<td><?php echo $expressionbesoin['ACTIF']; ?></td>
			<td><?php echo $expressionbesoin['URL']; ?></td>
			<td><?php echo $expressionbesoin['URLLOGIN']; ?></td>
			<td><?php echo $expressionbesoin['URLPASSWORD']; ?></td>
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
	<?php if (!empty($entite['Intergrationapplicative'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Entite Id'); ?></th>
		<th><?php echo __('Application Id'); ?></th>
		<th><?php echo __('Type Id'); ?></th>
		<th><?php echo __('Lot Id'); ?></th>
		<th><?php echo __('Version Id'); ?></th>
		<th><?php echo __('ACTIF'); ?></th>
		<th><?php echo __('INSTALL'); ?></th>
		<th><?php echo __('DATEINSTALL'); ?></th>
		<th><?php echo __('CHECK'); ?></th>
		<th><?php echo __('DATECHECK'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entite['Intergrationapplicative'] as $intergrationapplicative): ?>
		<tr>
			<td><?php echo $intergrationapplicative['id']; ?></td>
			<td><?php echo $intergrationapplicative['entite_id']; ?></td>
			<td><?php echo $intergrationapplicative['application_id']; ?></td>
			<td><?php echo $intergrationapplicative['type_id']; ?></td>
			<td><?php echo $intergrationapplicative['lot_id']; ?></td>
			<td><?php echo $intergrationapplicative['version_id']; ?></td>
			<td><?php echo $intergrationapplicative['ACTIF']; ?></td>
			<td><?php echo $intergrationapplicative['INSTALL']; ?></td>
			<td><?php echo $intergrationapplicative['DATEINSTALL']; ?></td>
			<td><?php echo $intergrationapplicative['CHECK']; ?></td>
			<td><?php echo $intergrationapplicative['DATECHECK']; ?></td>
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
	<h3><?php echo __('Related Listediffusions'); ?></h3>
	<?php if (!empty($entite['Listediffusion'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Entite Id'); ?></th>
		<th><?php echo __('Utilisateur Id'); ?></th>
		<th><?php echo __('NOM'); ?></th>
		<th><?php echo __('DESCRIPTION'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entite['Listediffusion'] as $listediffusion): ?>
		<tr>
			<td><?php echo $listediffusion['id']; ?></td>
			<td><?php echo $listediffusion['entite_id']; ?></td>
			<td><?php echo $listediffusion['utilisateur_id']; ?></td>
			<td><?php echo $listediffusion['NOM']; ?></td>
			<td><?php echo $listediffusion['DESCRIPTION']; ?></td>
			<td><?php echo $listediffusion['created']; ?></td>
			<td><?php echo $listediffusion['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'listediffusions', 'action' => 'view', $listediffusion['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'listediffusions', 'action' => 'edit', $listediffusion['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'listediffusions', 'action' => 'delete', $listediffusion['id']), null, __('Are you sure you want to delete # %s?', $listediffusion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Listediffusion'), array('controller' => 'listediffusions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Logiciels'); ?></h3>
	<?php if (!empty($entite['Logiciel'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Entite Id'); ?></th>
		<th><?php echo __('Envoutil Id'); ?></th>
		<th><?php echo __('Envversion Id'); ?></th>
		<th><?php echo __('Application Id'); ?></th>
		<th><?php echo __('Lot Id'); ?></th>
		<th><?php echo __('NOM'); ?></th>
		<th><?php echo __('ACTIF'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entite['Logiciel'] as $logiciel): ?>
		<tr>
			<td><?php echo $logiciel['id']; ?></td>
			<td><?php echo $logiciel['entite_id']; ?></td>
			<td><?php echo $logiciel['envoutil_id']; ?></td>
			<td><?php echo $logiciel['envversion_id']; ?></td>
			<td><?php echo $logiciel['application_id']; ?></td>
			<td><?php echo $logiciel['lot_id']; ?></td>
			<td><?php echo $logiciel['NOM']; ?></td>
			<td><?php echo $logiciel['ACTIF']; ?></td>
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
	<h3><?php echo __('Related Lots'); ?></h3>
	<?php if (!empty($entite['Lot'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Entite Id'); ?></th>
		<th><?php echo __('NOM'); ?></th>
		<th><?php echo __('ACTIF'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entite['Lot'] as $lot): ?>
		<tr>
			<td><?php echo $lot['id']; ?></td>
			<td><?php echo $lot['entite_id']; ?></td>
			<td><?php echo $lot['NOM']; ?></td>
			<td><?php echo $lot['ACTIF']; ?></td>
			<td><?php echo $lot['created']; ?></td>
			<td><?php echo $lot['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'lots', 'action' => 'view', $lot['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'lots', 'action' => 'edit', $lot['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'lots', 'action' => 'delete', $lot['id']), null, __('Are you sure you want to delete # %s?', $lot['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Lot'), array('controller' => 'lots', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Messages'); ?></h3>
	<?php if (!empty($entite['Message'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Entite Id'); ?></th>
		<th><?php echo __('LIBELLE'); ?></th>
		<th><?php echo __('DATELIMITE'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entite['Message'] as $message): ?>
		<tr>
			<td><?php echo $message['id']; ?></td>
			<td><?php echo $message['entite_id']; ?></td>
			<td><?php echo $message['LIBELLE']; ?></td>
			<td><?php echo $message['DATELIMITE']; ?></td>
			<td><?php echo $message['created']; ?></td>
			<td><?php echo $message['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'messages', 'action' => 'view', $message['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'messages', 'action' => 'edit', $message['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'messages', 'action' => 'delete', $message['id']), null, __('Are you sure you want to delete # %s?', $message['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Plancharges'); ?></h3>
	<?php if (!empty($entite['Plancharge'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Entite Id'); ?></th>
		<th><?php echo __('Contrat Id'); ?></th>
		<th><?php echo __('NOM'); ?></th>
		<th><?php echo __('ANNEE'); ?></th>
		<th><?php echo __('ETP'); ?></th>
		<th><?php echo __('CHARGES'); ?></th>
		<th><?php echo __('TJM'); ?></th>
		<th><?php echo __('VERSION'); ?></th>
		<th><?php echo __('VISIBLE'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entite['Plancharge'] as $plancharge): ?>
		<tr>
			<td><?php echo $plancharge['id']; ?></td>
			<td><?php echo $plancharge['entite_id']; ?></td>
			<td><?php echo $plancharge['contrat_id']; ?></td>
			<td><?php echo $plancharge['NOM']; ?></td>
			<td><?php echo $plancharge['ANNEE']; ?></td>
			<td><?php echo $plancharge['ETP']; ?></td>
			<td><?php echo $plancharge['CHARGES']; ?></td>
			<td><?php echo $plancharge['TJM']; ?></td>
			<td><?php echo $plancharge['VERSION']; ?></td>
			<td><?php echo $plancharge['VISIBLE']; ?></td>
			<td><?php echo $plancharge['created']; ?></td>
			<td><?php echo $plancharge['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'plancharges', 'action' => 'view', $plancharge['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'plancharges', 'action' => 'edit', $plancharge['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'plancharges', 'action' => 'delete', $plancharge['id']), null, __('Are you sure you want to delete # %s?', $plancharge['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Plancharge'), array('controller' => 'plancharges', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Sections'); ?></h3>
	<?php if (!empty($entite['Section'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Entite Id'); ?></th>
		<th><?php echo __('Utilisateur Id'); ?></th>
		<th><?php echo __('NOM'); ?></th>
		<th><?php echo __('DESCRIPTION'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entite['Section'] as $section): ?>
		<tr>
			<td><?php echo $section['id']; ?></td>
			<td><?php echo $section['entite_id']; ?></td>
			<td><?php echo $section['utilisateur_id']; ?></td>
			<td><?php echo $section['NOM']; ?></td>
			<td><?php echo $section['DESCRIPTION']; ?></td>
			<td><?php echo $section['created']; ?></td>
			<td><?php echo $section['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sections', 'action' => 'view', $section['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sections', 'action' => 'edit', $section['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sections', 'action' => 'delete', $section['id']), null, __('Are you sure you want to delete # %s?', $section['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Section'), array('controller' => 'sections', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Types'); ?></h3>
	<?php if (!empty($entite['Type'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Entite Id'); ?></th>
		<th><?php echo __('NOM'); ?></th>
		<th><?php echo __('ACTIF'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entite['Type'] as $type): ?>
		<tr>
			<td><?php echo $type['id']; ?></td>
			<td><?php echo $type['entite_id']; ?></td>
			<td><?php echo $type['NOM']; ?></td>
			<td><?php echo $type['ACTIF']; ?></td>
			<td><?php echo $type['created']; ?></td>
			<td><?php echo $type['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'types', 'action' => 'view', $type['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'types', 'action' => 'edit', $type['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'types', 'action' => 'delete', $type['id']), null, __('Are you sure you want to delete # %s?', $type['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Utilisateurs'); ?></h3>
	<?php if (!empty($entite['Utilisateur'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Profil Id'); ?></th>
		<th><?php echo __('Societe Id'); ?></th>
		<th><?php echo __('Entite Id'); ?></th>
		<th><?php echo __('Assistance Id'); ?></th>
		<th><?php echo __('Section Id'); ?></th>
		<th><?php echo __('Utilisateur Id'); ?></th>
		<th><?php echo __('Domaine Id'); ?></th>
		<th><?php echo __('Site Id'); ?></th>
		<th><?php echo __('Tjmagent Id'); ?></th>
		<th><?php echo __('Dotation Id'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('ACTIF'); ?></th>
		<th><?php echo __('DATEDEBUTACTIF'); ?></th>
		<th><?php echo __('NAISSANCE'); ?></th>
		<th><?php echo __('NOM'); ?></th>
		<th><?php echo __('PRENOM'); ?></th>
		<th><?php echo __('COMMENTAIRE'); ?></th>
		<th><?php echo __('FINMISSION'); ?></th>
		<th><?php echo __('MAIL'); ?></th>
		<th><?php echo __('TELEPHONE'); ?></th>
		<th><?php echo __('WORKCAPACITY'); ?></th>
		<th><?php echo __('CONGE'); ?></th>
		<th><?php echo __('RQ'); ?></th>
		<th><?php echo __('VT'); ?></th>
		<th><?php echo __('HIERARCHIQUE'); ?></th>
		<th><?php echo __('GESTIONABSENCES'); ?></th>
		<th><?php echo __('WIDEAREA'); ?></th>
		<th><?php echo __('MENU'); ?></th>
		<th><?php echo __('NEW'); ?></th>
		<th><?php echo __('INCOMPLET'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entite['Utilisateur'] as $utilisateur): ?>
		<tr>
			<td><?php echo $utilisateur['id']; ?></td>
			<td><?php echo $utilisateur['profil_id']; ?></td>
			<td><?php echo $utilisateur['societe_id']; ?></td>
			<td><?php echo $utilisateur['entite_id']; ?></td>
			<td><?php echo $utilisateur['assistance_id']; ?></td>
			<td><?php echo $utilisateur['section_id']; ?></td>
			<td><?php echo $utilisateur['utilisateur_id']; ?></td>
			<td><?php echo $utilisateur['domaine_id']; ?></td>
			<td><?php echo $utilisateur['site_id']; ?></td>
			<td><?php echo $utilisateur['tjmagent_id']; ?></td>
			<td><?php echo $utilisateur['dotation_id']; ?></td>
			<td><?php echo $utilisateur['password']; ?></td>
			<td><?php echo $utilisateur['username']; ?></td>
			<td><?php echo $utilisateur['ACTIF']; ?></td>
			<td><?php echo $utilisateur['DATEDEBUTACTIF']; ?></td>
			<td><?php echo $utilisateur['NAISSANCE']; ?></td>
			<td><?php echo $utilisateur['NOM']; ?></td>
			<td><?php echo $utilisateur['PRENOM']; ?></td>
			<td><?php echo $utilisateur['COMMENTAIRE']; ?></td>
			<td><?php echo $utilisateur['FINMISSION']; ?></td>
			<td><?php echo $utilisateur['MAIL']; ?></td>
			<td><?php echo $utilisateur['TELEPHONE']; ?></td>
			<td><?php echo $utilisateur['WORKCAPACITY']; ?></td>
			<td><?php echo $utilisateur['CONGE']; ?></td>
			<td><?php echo $utilisateur['RQ']; ?></td>
			<td><?php echo $utilisateur['VT']; ?></td>
			<td><?php echo $utilisateur['HIERARCHIQUE']; ?></td>
			<td><?php echo $utilisateur['GESTIONABSENCES']; ?></td>
			<td><?php echo $utilisateur['WIDEAREA']; ?></td>
			<td><?php echo $utilisateur['MENU']; ?></td>
			<td><?php echo $utilisateur['NEW']; ?></td>
			<td><?php echo $utilisateur['INCOMPLET']; ?></td>
			<td><?php echo $utilisateur['created']; ?></td>
			<td><?php echo $utilisateur['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'utilisateurs', 'action' => 'view', $utilisateur['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'utilisateurs', 'action' => 'edit', $utilisateur['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'utilisateurs', 'action' => 'delete', $utilisateur['id']), null, __('Are you sure you want to delete # %s?', $utilisateur['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
