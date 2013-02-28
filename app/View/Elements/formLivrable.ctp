<?php echo $this->Form->create('Livrable',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>

	<?php
		echo $this->Form->input('UTILISATEUR_ID');
		echo $this->Form->input('NOM');
		echo $this->Form->input('REFERENCE');
	?>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url('/livrables/index/week/tous')."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
            </div>
        </div>
    </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>
<?php if ($this->params['action']=='edit'){ ?>
<hr>
<button type="button" class='btn btn-inverse pull-right' onclick="location.href='<?php echo $this->Html->url('/suivilivrables/add/'.$this->data['Livrable']['id']); ?>';">Nouveau suivi</button>                    
<?php echo $this->element('tableSuiviLivrable'); ?>
<?php } ?>