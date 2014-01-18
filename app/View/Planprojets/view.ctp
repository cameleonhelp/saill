<div class="planprojets view">
<h2><?php echo __('Planprojet'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($planprojet['Planprojet']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Utilisateur'); ?></dt>
		<dd>
			<?php echo $this->Html->link($planprojet['Utilisateur']['id'], array('controller' => 'utilisateurs', 'action' => 'view', $planprojet['Utilisateur']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOM'); ?></dt>
		<dd>
			<?php echo h($planprojet['Planprojet']['NOM']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATEDEBUT'); ?></dt>
		<dd>
			<?php echo h($planprojet['Planprojet']['DATEDEBUT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ECHEANCE'); ?></dt>
		<dd>
			<?php echo h($planprojet['Planprojet']['ECHEANCE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('OPEN'); ?></dt>
		<dd>
			<?php echo h($planprojet['Planprojet']['OPEN']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('PUBLIC'); ?></dt>
		<dd>
			<?php echo h($planprojet['Planprojet']['PUBLIC']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($planprojet['Planprojet']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($planprojet['Planprojet']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Planprojet'), array('action' => 'edit', $planprojet['Planprojet']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Planprojet'), array('action' => 'delete', $planprojet['Planprojet']['id']), null, __('Are you sure you want to delete # %s?', $planprojet['Planprojet']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Planprojets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Planprojet'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Utilisateurs'), array('controller' => 'utilisateurs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Utilisateur'), array('controller' => 'utilisateurs', 'action' => 'add')); ?> </li>
	</ul>
</div>
