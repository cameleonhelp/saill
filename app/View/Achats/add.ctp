<div class="achats form">
<?php echo $this->Form->create('Achat'); ?>
	<fieldset>
		<legend><?php echo __('Add Achat'); ?></legend>
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

		<li><?php echo $this->Html->link(__('List Achats'), array('action' => 'index')); ?></li>
	</ul>
</div>
