<div class="dossierpartages view">
<h2><?php  echo __('Dossierpartage'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($dossierpartage['Dossierpartage']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($dossierpartage['Dossierpartage']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('GROUPEAD'); ?></dt>
		<dd>
			<?php echo h($dossierpartage['Dossierpartage']['GROUPEAD']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DESCRIPTION'); ?></dt>
		<dd>
			<?php echo h($dossierpartage['Dossierpartage']['DESCRIPTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($dossierpartage['Dossierpartage']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($dossierpartage['Dossierpartage']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Dossierpartage'), array('action' => 'edit', $dossierpartage['Dossierpartage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Dossierpartage'), array('action' => 'delete', $dossierpartage['Dossierpartage']['id']), null, __('Are you sure you want to delete # %s?', $dossierpartage['Dossierpartage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Dossierpartages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dossierpartage'), array('action' => 'add')); ?> </li>
	</ul>
</div>
