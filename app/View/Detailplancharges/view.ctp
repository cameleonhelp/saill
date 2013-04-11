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
		<dt><?php echo __('ETP'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['ETP']); ?>
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
		<dt><?php echo __('JANVIER'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['JANVIER']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('FEVRIER'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['FEVRIER']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MARS'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['MARS']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('AVRIL'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['AVRIL']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MAI'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['MAI']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('JUIN'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['JUIN']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('JUILLET'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['JUILLET']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('AOUT'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['AOUT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('SEPTEMBRE'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['SEPTEMBRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OCTOBRE'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['OCTOBRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOVEMBRE'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['NOVEMBRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DECEMBRE'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['DECEMBRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TOTAL'); ?></dt>
		<dd>
			<?php echo h($detailplancharge['Detailplancharge']['TOTAL']); ?>
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
