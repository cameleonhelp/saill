<div class="entites index">
	<h2><?php echo __('Entites'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('admin_id'); ?></th>
			<th><?php echo $this->Paginator->sort('NOM'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('MAILVALIDEUR'); ?></th>
			<th><?php echo $this->Paginator->sort('MAILGESTANNUAIRE'); ?></th>
			<th><?php echo $this->Paginator->sort('MAILGESTENV'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($entites as $entite): ?>
	<tr>
		<td><?php echo h($entite['Entite']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($entite['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $entite['Utilisateur']['id'])); ?>
		</td>
		<td><?php echo h($entite['Entite']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($entite['Entite']['created']); ?>&nbsp;</td>
		<td><?php echo h($entite['Entite']['modified']); ?>&nbsp;</td>
		<td><?php echo h($entite['Entite']['MAILVALIDEUR']); ?>&nbsp;</td>
		<td><?php echo h($entite['Entite']['MAILGESTANNUAIRE']); ?>&nbsp;</td>
		<td><?php echo h($entite['Entite']['MAILGESTENV']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $entite['Entite']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $entite['Entite']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $entite['Entite']['id']), null, __('Are you sure you want to delete # %s?', $entite['Entite']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Entite'), array('action' => 'add')); ?></li>
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
