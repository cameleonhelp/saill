<div class="coutuos view">
<h2><?php echo __('Coutuo'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($coutuo['Coutuo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NOMUO'); ?></dt>
		<dd>
			<?php echo h($coutuo['Coutuo']['NOMUO']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MONTANT'); ?></dt>
		<dd>
			<?php echo h($coutuo['Coutuo']['MONTANT']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($coutuo['Coutuo']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($coutuo['Coutuo']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Coutuo'), array('action' => 'edit', $coutuo['Coutuo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Coutuo'), array('action' => 'delete', $coutuo['Coutuo']['id']), null, __('Are you sure you want to delete # %s?', $coutuo['Coutuo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Coutuos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Coutuo'), array('action' => 'add')); ?> </li>
	</ul>
</div>
