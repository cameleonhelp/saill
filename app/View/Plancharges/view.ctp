<div class="plancharges view">
<h2><?php  echo __('Plancharge'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($plancharge['Plancharge']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Projet Id'); ?></dt>
		<dd>
			<?php echo h($plancharge['Plancharge']['projet_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($plancharge['Plancharge']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ANNEE'); ?></dt>
		<dd>
			<?php echo h($plancharge['Plancharge']['ANNEE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ETP'); ?></dt>
		<dd>
			<?php echo h($plancharge['Plancharge']['ETP']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CHARGES'); ?></dt>
		<dd>
			<?php echo h($plancharge['Plancharge']['CHARGES']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TJM'); ?></dt>
		<dd>
			<?php echo h($plancharge['Plancharge']['TJM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('VERSION'); ?></dt>
		<dd>
			<?php echo h($plancharge['Plancharge']['VERSION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($plancharge['Plancharge']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($plancharge['Plancharge']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Plancharge'), array('action' => 'edit', $plancharge['Plancharge']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Plancharge'), array('action' => 'delete', $plancharge['Plancharge']['id']), null, __('Are you sure you want to delete # %s?', $plancharge['Plancharge']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Plancharges'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plancharge'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Detailplancharges'), array('controller' => 'detailplancharges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detailplancharge'), array('controller' => 'detailplancharges', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Detailplancharges'); ?></h3>
	<?php if (!empty($plancharge['Detailplancharge'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Plancharge Id'); ?></th>
		<th><?php echo __('Utilisateur Id'); ?></th>
		<th><?php echo __('CAPCITY'); ?></th>
		<th><?php echo __('Domaine Id'); ?></th>
		<th><?php echo __('Activite Id'); ?></th>
		<th><?php echo __('CHARGEPREVUE'); ?></th>
		<th><?php echo __('CHARGEREELLEE'); ?></th>
		<th><?php echo __('PERIODE'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($plancharge['Detailplancharge'] as $detailplancharge): ?>
		<tr>
			<td><?php echo $detailplancharge['id']; ?></td>
			<td><?php echo $detailplancharge['plancharge_id']; ?></td>
			<td><?php echo $detailplancharge['utilisateur_id']; ?></td>
			<td><?php echo $detailplancharge['CAPCITY']; ?></td>
			<td><?php echo $detailplancharge['domaine_id']; ?></td>
			<td><?php echo $detailplancharge['activite_id']; ?></td>
			<td><?php echo $detailplancharge['CHARGEPREVUE']; ?></td>
			<td><?php echo $detailplancharge['CHARGEREELLEE']; ?></td>
			<td><?php echo $detailplancharge['PERIODE']; ?></td>
			<td><?php echo $detailplancharge['created']; ?></td>
			<td><?php echo $detailplancharge['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'detailplancharges', 'action' => 'view', $detailplancharge['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'detailplancharges', 'action' => 'edit', $detailplancharge['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'detailplancharges', 'action' => 'delete', $detailplancharge['id']), null, __('Are you sure you want to delete # %s?', $detailplancharge['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Detailplancharge'), array('controller' => 'detailplancharges', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
