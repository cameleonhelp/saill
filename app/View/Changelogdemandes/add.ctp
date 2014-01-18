<div class="marginright20">
    <?php echo $this->element('changelogsubmenu'); ?>
    <div class="changelogdemandes form">      
<?php echo $this->Form->create('Changelogdemande',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
        Expliquez en quelques lignes votre demande de changement (évolution ou anomalies) :
	<?php
		echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>  userAuth('id')));
                echo $this->Form->input('changelogversion_id',array('type'=>'hidden','value'=> -1));
		echo $this->Form->input('OPEN',array('type'=>'hidden','value'=> 1));
		echo $this->Form->input('ETAT',array('type'=>'hidden','value'=> 0)); //,$changelogetats,array('class'=>'form-control','default' => 0,'empty'=>false,'disabled'=>'disabled'));
		echo $this->Form->input('TYPE',array('type'=>'hidden','value'=> 0)); //,$changelogtypes,array('class'=>'form-control','default' => 0,'empty'=>false));
                echo $this->Form->input('CRITICITE',array('type'=>'hidden','value'=> 1)); //,$changelogcriticites,array('class'=>'form-control','default' => 1,'empty'=>false));
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
</div>
