<div class="facturations view">
<h2><?php  echo __('Facturation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Utilisateur'); ?></dt>
		<dd>
			<?php echo $this->Html->link($facturation['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $facturation['Utilisateur']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activite'); ?></dt>
		<dd>
			<?php echo $this->Html->link($facturation['Activite']['id'], array('controller' => 'activites', 'action' => 'view', $facturation['Activite']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activitesreelle Id'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['activitesreelle_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATE'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['DATE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('VERSION'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['VERSION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LU'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['LU']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MA'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['MA']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ME'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['ME']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('JE'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['JE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('VE'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['VE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('SA'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['SA']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DI'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['DI']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NUMEROFTGALILEI'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['NUMEROFTGALILEI']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($facturation['Facturation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Facturation'), array('action' => 'edit', $facturation['Facturation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Facturation'), array('action' => 'delete', $facturation['Facturation']['id']), null, __('Are you sure you want to delete # %s?', $facturation['Facturation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Facturations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Facturation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Activites'), array('controller' => 'activites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activite'), array('controller' => 'activites', 'action' => 'add')); ?> </li>
	</ul>
</div>
