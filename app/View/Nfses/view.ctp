<div class="nfses view">
<h2><?php echo __('Nfse'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($nfse['Nfse']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('NB'); ?></dt>
		<dd>
			<?php echo h($nfse['Nfse']['NB']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($nfse['Nfse']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($nfse['Nfse']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Nfse'), array('action' => 'edit', $nfse['Nfse']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Nfse'), array('action' => 'delete', $nfse['Nfse']['id']), null, __('Are you sure you want to delete # %s?', $nfse['Nfse']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Nfses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Nfse'), array('action' => 'add')); ?> </li>
	</ul>
</div>
