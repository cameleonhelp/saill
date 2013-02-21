<div class="contrats view">
<h2><?php  echo __('Contrat'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($contrat['Contrat']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TJMCONTRAT ID'); ?></dt>
		<dd>
			<?php echo h($contrat['Contrat']['TJMCONTRAT_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($contrat['Contrat']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ANNEEDEBUT'); ?></dt>
		<dd>
			<?php echo h($contrat['Contrat']['ANNEEDEBUT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ANNEEFIN'); ?></dt>
		<dd>
			<?php echo h($contrat['Contrat']['ANNEEFIN']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MONTANT'); ?></dt>
		<dd>
			<?php echo h($contrat['Contrat']['MONTANT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ACTIF'); ?></dt>
		<dd>
			<?php echo h($contrat['Contrat']['ACTIF']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DESCRIPTION'); ?></dt>
		<dd>
			<?php echo h($contrat['Contrat']['DESCRIPTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($contrat['Contrat']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($contrat['Contrat']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contrat'), array('action' => 'edit', $contrat['Contrat']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Contrat'), array('action' => 'delete', $contrat['Contrat']['id']), null, __('Are you sure you want to delete # %s?', $contrat['Contrat']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contrats'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contrat'), array('action' => 'add')); ?> </li>
	</ul>
</div>
