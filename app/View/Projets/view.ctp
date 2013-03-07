<div class="projets view">
<h2><?php  echo __('Projet'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($projet['Projet']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CONTRAT ID'); ?></dt>
		<dd>
			<?php echo h($projet['Projet']['CONTRAT_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($projet['Projet']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DEBUT'); ?></dt>
		<dd>
			<?php echo h($projet['Projet']['DEBUT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FIN'); ?></dt>
		<dd>
			<?php echo h($projet['Projet']['FIN']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COMMENTAIRE'); ?></dt>
		<dd>
			<?php echo h($projet['Projet']['COMMENTAIRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ACTIF'); ?></dt>
		<dd>
			<?php echo h($projet['Projet']['ACTIF']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TYPE'); ?></dt>
		<dd>
			<?php echo h($projet['Projet']['TYPE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FACTURATION'); ?></dt>
		<dd>
			<?php echo h($projet['Projet']['FACTURATION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($projet['Projet']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($projet['Projet']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Projet'), array('action' => 'edit', $projet['Projet']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Projet'), array('action' => 'delete', $projet['Projet']['id']), null, __('Are you sure you want to delete # %s?', $projet['Projet']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Projets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Projet'), array('action' => 'add')); ?> </li>
	</ul>
</div>
