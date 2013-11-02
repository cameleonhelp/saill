<div class="marginright20">
<?php echo $this->Form->create('Chassis',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2 required" for="ChassisNOM">Nom : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('NOM',array('type'=>'text','placeholder'=>'Nom du chassis','data-rule-required'=>'true','class'=>'form-control','data-msg-required'=>"Le nom du chassis est obligatoire")); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 required" for="ChassisLocaliteId">Localisation : </label>
        <div class="col-lg-4">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('localite_id',$localites,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"La localisation est obligatoire", 'selected' => $this->data['Chassis']['localite_id'],'empty' => 'Choisir une localisation')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('localite_id',$localites,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"La localisation est obligatoire", 'empty' => 'Choisir une localisation')); ?>
            <?php } ?>
        </div>
    </div> 
    <div class="form-group">
        <label class="col-lg-2 required" for="ChassisNIVEAU">Niveau : </label>
        <div class="col-lg-2">
            <?php echo $this->Form->input('NIVEAU',array('type'=>'text','placeholder'=>'Niveau','data-rule-required'=>'true','class'=>'form-control','data-msg-required'=>"Le niveau est obligatoire")); ?>
        </div>
    </div>       
    <div class="form-group">
        <label class="col-lg-2" for="ChassisARMOIRE">Armoire : </label>
        <div class="col-lg-4">
            <?php echo $this->Form->input('ARMOIRE',array('type'=>'text','placeholder'=>'Armoire','class'=>'form-control')); ?>
        </div>
    </div>  
    <div class="form-group">
        <label class="col-lg-2" for="ChassisPVU">PVU : </label>
        <div class="col-lg-4">
            <?php echo $this->Form->input('PVU',array('type'=>'text','placeholder'=>'PVU','class'=>'form-control')); ?>
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