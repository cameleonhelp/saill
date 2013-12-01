<div class="demandeabsences form">
<?php echo $this->Form->create('Demandeabsence'); ?>
	<fieldset>
		<legend><?php echo __('Add Demandeabsence'); ?></legend>
	<?php
		echo $this->Form->input('utilisateur_id');
		echo $this->Form->input('DATEDU',array('type'=>'text','class'=>'dateweek'));
                $options=array('8'=>'08:00','12'=>'12:00');
		echo $this->Form->select('DATEDUTYPE',$options,array('default'=>'8','empty'=>false));
		echo $this->Form->input('DATEAU',array('type'=>'text','class'=>'dateweek'));
                $options=array('12'=>'12:00','16'=>'17:00');
		echo $this->Form->select('DATEAUTYPE',$options,array('default'=>'16','empty'=>false));
		echo $this->Form->input('DATEDEMANDE',array('type'=>'text','class'=>'dateweek'));
		echo $this->Form->input('DATEREPONSE',array('type'=>'text','class'=>'dateweek'));
                $options=array(''=>'En attente','1'=>'Validée','2'=>'Refusée','3'=>"Supprimée");
		echo $this->Form->select('REPONSE',$options,array('empty'=>'En attente'));
		echo $this->Form->input('REPONSEBY');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>