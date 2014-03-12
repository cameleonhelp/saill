<div class="">
<?php echo $this->Form->create('Volumetry',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-2 required" for="VolumetryNOM">Nom : </label>
        <div class="col-md-5">
            <?php echo $this->Form->input('NOM',array('type'=>'text','placeholder'=>'Nom de la volumétrie','data-rule-required'=>'true','class'=>'form-control','data-msg-required'=>"Le nom de la volumétrie est obligatoire")); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2" for="VolumetryVALEUR">Valeur : </label>
        <div class="col-md-5">
            <?php echo $this->Form->input('VALEUR',array('type'=>'text','placeholder'=>'Valeur','class'=>'form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2" for="VolumetryEntiteId">Cercle de visibilité : </label>
        <div class="col-md-3">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('entite_id',$cercles,array('class'=>'form-control','selected' => $this->data['Volumetry']['entite_id'],'empty' => 'Choisir un cercle de visibilité ou visible par tous')); ?>
            <?php } else { ?>
                <?php $entite_id = is_null(userAuth('entite_id')) ? '' : userAuth('entite_id'); ?>
                <?php echo $this->Form->select('entite_id',$cercles,array('class'=>'form-control','selected' => $entite_id, 'default' => $entite_id, 'empty' => 'Choisir un cercle de visibilité ou visible par tous')); ?>
            <?php } ?>
        </div>
    </div>       
    <div class="form-group">
        <label class="col-md-2" for="VolumetryCOMMENTAIRE">Commentaire : </label>
        <div class="col-md-10">
            <?php echo $this->Form->input('COMMENTAIRE',array('class'=>'form-control')); ?>
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