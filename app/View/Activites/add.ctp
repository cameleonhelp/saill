<div class="activites form">
<?php echo $this->Form->create('Activite'); ?>
	<fieldset>
		<legend><?php echo __('Add Activite'); ?></legend>
	<?php
		echo $this->Form->input('ID');
		echo $this->Form->input('PROJET_ID');
		echo $this->Form->input('NOM');
		echo $this->Form->input('DATEDEBUT');
		echo $this->Form->input('DATEFIN');
		echo $this->Form->input('NUMEROGALLILIE');
		echo $this->Form->input('NOMGALLILIE');
		echo $this->Form->input('DESCRIPTION');
		echo $this->Form->input('BUDJETRA');
		echo $this->Form->input('BUDGETREVU');
		echo $this->Form->input('ACTIVE');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Activites'), array('action' => 'index')); ?></li>
	</ul>
</div>
