<div class="">
<?php echo $this->Form->create('Dsitenv',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-2 required" for="DsitenvNOM">Nom : </label>
        <div class="col-md-10">
            <?php echo $this->Form->input('NOM',array('type'=>'text','data-rule-required'=>'true','class'=>'form-control','data-msg-required'=>"Le nom de l'environnement est obligatoire")); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 required" for="DsitenvApplicationId">Application: </label>
        <div  class="col-md-6">
            <?php $selected = isset($this->data['Dsitenv']['application_id']) ? $this->data['Dsitenv']['application_id'] : ''; ?>
                <?php echo $this->Form->select('application_id',$applications,array('data-rule-required'=>'true','class'=>'form-control','data-msg-required'=>"Le nom de l'application est obligatoire", 'selected' => $selected,'empty' => 'Choisir une application')); ?>
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