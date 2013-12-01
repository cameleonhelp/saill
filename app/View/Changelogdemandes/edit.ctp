<div class="marginright20">
    <?php echo $this->element('changelogsubmenu'); ?>
    <div class="changelogdemandes form">      
<?php echo $this->Form->create('Changelogdemande',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
        Expliquez en quelques lignes votre demande de changement (évolution ou anomalies) :
	<?php
                echo $this->Form->input('id',array('type'=>'hidden'));
		echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>  userAuth('id')));
		echo $this->Form->input('DEMANDE');
	?>
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>   
<?php echo $this->Form->end(); ?>
    </div>
    <?php //Ajouter toutes les réponses de cette demandes// ?>
    <?php if(!isset($reponses)): ?>
    <h6>Voici les réponses apportées à cette demande :</h6>
    <?php echo $this->element('tablereponses'); ?>   
    <?php endif; ?>
</div>
