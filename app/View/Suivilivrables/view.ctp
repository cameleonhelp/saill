<div class="suivilivrables view">
<h2><?php  echo __('Suivilivrable'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($suivilivrable['Suivilivrable']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LIVRABLE ID'); ?></dt>
		<dd>
			<?php echo h($suivilivrable['Suivilivrable']['LIVRABLE_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ECHEANCE'); ?></dt>
		<dd>
			<?php echo h($suivilivrable['Suivilivrable']['ECHEANCE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATELIVRAISON'); ?></dt>
		<dd>
			<?php echo h($suivilivrable['Suivilivrable']['DATELIVRAISON']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATEVALIDATION'); ?></dt>
		<dd>
			<?php echo h($suivilivrable['Suivilivrable']['DATEVALIDATION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ETAT'); ?></dt>
		<dd>
			<?php echo h($suivilivrable['Suivilivrable']['ETAT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($suivilivrable['Suivilivrable']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($suivilivrable['Suivilivrable']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Suivilivrable'), array('action' => 'edit', $suivilivrable['Suivilivrable']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Suivilivrable'), array('action' => 'delete', $suivilivrable['Suivilivrable']['id']), null, __('Are you sure you want to delete # %s?', $suivilivrable['Suivilivrable']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Suivilivrables'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Suivilivrable'), array('action' => 'add')); ?> </li>
	</ul>
</div>
