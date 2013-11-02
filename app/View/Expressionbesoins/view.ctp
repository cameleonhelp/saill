<div class="expressionbesoins view">
<h2><?php echo __('Expressionbesoin'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($expressionbesoin['Expressionbesoin']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Application'); ?></dt>
		<dd>
			<?php echo $this->Html->link($expressionbesoin['Application']['id'], array('controller' => 'applications', 'action' => 'view', $expressionbesoin['Application']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Composant'); ?></dt>
		<dd>
			<?php echo $this->Html->link($expressionbesoin['Composant']['id'], array('controller' => 'composants', 'action' => 'view', $expressionbesoin['Composant']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Perimetre'); ?></dt>
		<dd>
			<?php echo $this->Html->link($expressionbesoin['Perimetre']['id'], array('controller' => 'perimetres', 'action' => 'view', $expressionbesoin['Perimetre']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lot'); ?></dt>
		<dd>
			<?php echo $this->Html->link($expressionbesoin['Lot']['id'], array('controller' => 'lots', 'action' => 'view', $expressionbesoin['Lot']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Etat'); ?></dt>
		<dd>
			<?php echo $this->Html->link($expressionbesoin['Etat']['id'], array('controller' => 'etats', 'action' => 'view', $expressionbesoin['Etat']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($expressionbesoin['Type']['id'], array('controller' => 'types', 'action' => 'view', $expressionbesoin['Type']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phase'); ?></dt>
		<dd>
			<?php echo $this->Html->link($expressionbesoin['Phase']['id'], array('controller' => 'phases', 'action' => 'view', $expressionbesoin['Phase']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Volumetrie'); ?></dt>
		<dd>
			<?php echo $this->Html->link($expressionbesoin['Volumetrie']['id'], array('controller' => 'volumetries', 'action' => 'view', $expressionbesoin['Volumetrie']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Puissance'); ?></dt>
		<dd>
			<?php echo $this->Html->link($expressionbesoin['Puissance']['id'], array('controller' => 'puissances', 'action' => 'view', $expressionbesoin['Puissance']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Architecture'); ?></dt>
		<dd>
			<?php echo $this->Html->link($expressionbesoin['Architecture']['id'], array('controller' => 'architectures', 'action' => 'view', $expressionbesoin['Architecture']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COMMENTAIRE'); ?></dt>
		<dd>
			<?php echo h($expressionbesoin['Expressionbesoin']['COMMENTAIRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('USAGE'); ?></dt>
		<dd>
			<?php echo h($expressionbesoin['Expressionbesoin']['USAGE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOMUSAGE'); ?></dt>
		<dd>
			<?php echo h($expressionbesoin['Expressionbesoin']['NOMUSAGE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATELIVRAISON'); ?></dt>
		<dd>
			<?php echo h($expressionbesoin['Expressionbesoin']['DATELIVRAISON']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATEFIN'); ?></dt>
		<dd>
			<?php echo h($expressionbesoin['Expressionbesoin']['DATEFIN']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('CONNECT'); ?></dt>
		<dd>
			<?php echo h($expressionbesoin['Expressionbesoin']['CONNECT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PVU'); ?></dt>
		<dd>
			<?php echo h($expressionbesoin['Expressionbesoin']['PVU']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COUTWPS'); ?></dt>
		<dd>
			<?php echo h($expressionbesoin['Expressionbesoin']['COUTWPS']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COUTWTX'); ?></dt>
		<dd>
			<?php echo h($expressionbesoin['Expressionbesoin']['COUTWTX']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($expressionbesoin['Expressionbesoin']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($expressionbesoin['Expressionbesoin']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Expressionbesoin'), array('action' => 'edit', $expressionbesoin['Expressionbesoin']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Expressionbesoin'), array('action' => 'delete', $expressionbesoin['Expressionbesoin']['id']), null, __('Are you sure you want to delete # %s?', $expressionbesoin['Expressionbesoin']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Expressionbesoins'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Expressionbesoin'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications'), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application'), array('controller' => 'applications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Composants'), array('controller' => 'composants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Composant'), array('controller' => 'composants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Perimetres'), array('controller' => 'perimetres', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Perimetre'), array('controller' => 'perimetres', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lots'), array('controller' => 'lots', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lot'), array('controller' => 'lots', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Etats'), array('controller' => 'etats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Etat'), array('controller' => 'etats', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Types'), array('controller' => 'types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type'), array('controller' => 'types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Phases'), array('controller' => 'phases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Phase'), array('controller' => 'phases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Volumetries'), array('controller' => 'volumetries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Volumetrie'), array('controller' => 'volumetries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Puissances'), array('controller' => 'puissances', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Puissance'), array('controller' => 'puissances', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Architectures'), array('controller' => 'architectures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Architecture'), array('controller' => 'architectures', 'action' => 'add')); ?> </li>
	</ul>
</div>
