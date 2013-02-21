<div class="achats form">
<?php echo $this->Form->create('Achat'); ?>
	<fieldset>
		<legend><?php echo __('Edit Achat'); ?></legend>
	<?php
		echo $this->Form->input('ID');
		echo $this->Form->input('ACTIVITE_ID');
		echo $this->Form->input('LIBELLEACHAT');
		echo $this->Form->input('DATE');
		echo $this->Form->input('MONTANT');
		echo $this->Form->input('DESCRIPTION');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Achat.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Achat.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Achats'), array('action' => 'index')); ?></li>
	</ul>
</div>
