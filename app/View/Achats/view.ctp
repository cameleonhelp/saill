<div class="achats view">
<h2><?php  echo __('Achat'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($achat['Achat']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ACTIVITE ID'); ?></dt>
		<dd>
			<?php echo h($achat['Achat']['ACTIVITE_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('LIBELLEACHAT'); ?></dt>
		<dd>
			<?php echo h($achat['Achat']['LIBELLEACHAT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DATE'); ?></dt>
		<dd>
			<?php echo h($achat['Achat']['DATE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MONTANT'); ?></dt>
		<dd>
			<?php echo h($achat['Achat']['MONTANT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DESCRIPTION'); ?></dt>
		<dd>
			<?php echo h($achat['Achat']['DESCRIPTION']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($achat['Achat']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($achat['Achat']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Achat'), array('action' => 'edit', $achat['Achat']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Achat'), array('action' => 'delete', $achat['Achat']['id']), null, __('Are you sure you want to delete # %s?', $achat['Achat']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Achats'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Achat'), array('action' => 'add')); ?> </li>
	</ul>
</div>
