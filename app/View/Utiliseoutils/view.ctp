<div class="utiliseoutils view">
<h2><?php  echo __('Utiliseoutil'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($utiliseoutil['Utiliseoutil']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('UTILISATEUR ID'); ?></dt>
		<dd>
			<?php echo h($utiliseoutil['Utiliseoutil']['UTILISATEUR_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OUTIL ID'); ?></dt>
		<dd>
			<?php echo h($utiliseoutil['Utiliseoutil']['OUTIL_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LISTEDIFFUSION ID'); ?></dt>
		<dd>
			<?php echo h($utiliseoutil['Utiliseoutil']['LISTEDIFFUSION_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DOSSIERPARTAGE ID'); ?></dt>
		<dd>
			<?php echo h($utiliseoutil['Utiliseoutil']['DOSSIERPARTAGE_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('STATUT'); ?></dt>
		<dd>
			<?php echo h($utiliseoutil['Utiliseoutil']['STATUT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TYPE'); ?></dt>
		<dd>
			<?php echo h($utiliseoutil['Utiliseoutil']['TYPE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($utiliseoutil['Utiliseoutil']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($utiliseoutil['Utiliseoutil']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Utiliseoutil'), array('action' => 'edit', $utiliseoutil['Utiliseoutil']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Utiliseoutil'), array('action' => 'delete', $utiliseoutil['Utiliseoutil']['id']), null, __('Are you sure you want to delete # %s?', $utiliseoutil['Utiliseoutil']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Utiliseoutils'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utiliseoutil'), array('action' => 'add')); ?> </li>
	</ul>
</div>
