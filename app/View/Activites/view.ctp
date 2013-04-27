<div class="activites view">
<h2><?php  echo __('Activite'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($activite['Activite']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PROJET ID'); ?></dt>
		<dd>
			<?php echo h($activite['Activite']['PROJET_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($activite['Activite']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATEDEBUT'); ?></dt>
		<dd>
			<?php echo h($activite['Activite']['DATEDEBUT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATEFIN'); ?></dt>
		<dd>
			<?php echo h($activite['Activite']['DATEFIN']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NUMEROGALLILIE'); ?></dt>
		<dd>
			<?php echo h($activite['Activite']['NUMEROGALLILIE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOMGALLILIE'); ?></dt>
		<dd>
			<?php echo h($activite['Activite']['NOMGALLILIE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DESCRIPTION'); ?></dt>
		<dd>
			<?php echo h($activite['Activite']['DESCRIPTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('BUDJETRA'); ?></dt>
		<dd>
			<?php echo h($activite['Activite']['BUDJETRA']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('BUDGETREVU'); ?></dt>
		<dd>
			<?php echo h($activite['Activite']['BUDGETREVU']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ACTIVE'); ?></dt>
		<dd>
			<?php echo h($activite['Activite']['ACTIVE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($activite['Activite']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($activite['Activite']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Activite'), array('action' => 'edit', $activite['Activite']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Activite'), array('action' => 'delete', $activite['Activite']['id']), null, __('Are you sure you want to delete # %s?', $activite['Activite']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Activites'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activite'), array('action' => 'add')); ?> </li>
	</ul>
</div>
