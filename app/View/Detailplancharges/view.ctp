<div class="detailplancharges view">
<h2><?php  echo __('Detailplancharge'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Plancharge'); ?></dt>
		<dd>
			<?php echo $this->Html->link($detailplancharge['Plancharge']['id'], array('controller' => 'plancharges', 'action' => 'view', $detailplancharge['Plancharge']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Utilisateur'); ?></dt>
		<dd>
			<?php echo $this->Html->link($detailplancharge['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $detailplancharge['Utilisateur']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CAPCITY'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['CAPCITY']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Domaine'); ?></dt>
		<dd>
			<?php echo $this->Html->link($detailplancharge['Domaine']['id'], array('controller' => 'domaines', 'action' => 'view', $detailplancharge['Domaine']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activite'); ?></dt>
		<dd>
			<?php echo $this->Html->link($detailplancharge['Activite']['id'], array('controller' => 'activites', 'action' => 'view', $detailplancharge['Activite']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CHARGEPREVUE'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['CHARGEPREVUE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CHARGEREELLEE'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['CHARGEREELLEE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PERIODE'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['PERIODE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Detailplancharge'), array('action' => 'edit', $detailplancharge['Detailplancharge']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Detailplancharge'), array('action' => 'delete', $detailplancharge['Detailplancharge']['id']), null, __('Are you sure you want to delete # %s?', $detailplancharge['Detailplancharge']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Detailplancharges'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detailplancharge'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Plancharges'), array('controller' => 'plancharges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plancharge'), array('controller' => 'plancharges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Domaines'), array('controller' => 'domaines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Domaine'), array('controller' => 'domaines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Activites'), array('controller' => 'activites', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activite'), array('controller' => 'activites', 'action' => 'add')); ?> </li>
	</ul>
</div>
