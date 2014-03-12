<div class="">
<?php echo $this->Form->create('Envversion',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-2 required" for="EnvversionNOM">Nom : </label>
        <div class="col-md-5">
            <?php echo $this->Form->input('NOM',array('type'=>'text','placeholder'=>'Nom','class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom est obligatoire")); ?>
        </div>
    </div>    
    <div class="form-group">
        <label class="col-md-2 required" for="EnvversionEnvoutilId">Envversion : </label>
        <div class="col-md-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('envoutil_id',$envoutils,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"La version est obligatoire", 'selected' => $this->data['Envversion']['envoutil_id'],'empty' => 'Choisir une version')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('envoutil_id',$envoutils,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"La version est obligatoire", 'empty' => 'Choisir une version')); ?>
            <?php } ?>        
        </div>        
    </div>
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>     
<?php echo $this->Form->end(); ?>
</div>
