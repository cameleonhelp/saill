<div class="materielautres view">
<h2><?php  echo __('Materielautre'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($materielautre['Materielautre']['ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('TYPEMATERIEL ID'); ?></dt>
		<dd>
			<?php echo h($materielautre['Materielautre']['TYPEMATERIEL_ID']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COMMENTAIRE'); ?></dt>
		<dd>
			<?php echo h($materielautre['Materielautre']['COMMENTAIRE']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($materielautre['Materielautre']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($materielautre['Materielautre']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Materielautre'), array('action' => 'edit', $materielautre['Materielautre']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Materielautre'), array('action' => 'delete', $materielautre['Materielautre']['id']), null, __('Are you sure you want to delete # %s?', $materielautre['Materielautre']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Materielautres'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Materielautre'), array('action' => 'add')); ?> </li>
	</ul>
</div>
