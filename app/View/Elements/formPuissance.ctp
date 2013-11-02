<div class="marginright20">
<?php echo $this->Form->create('Puissance',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2 required" for="PuissanceNOM">Nom : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('NOM',array('type'=>'text','placeholder'=>'Nom','class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom est obligatoire")); ?>
        </div>
    </div>    
    <div class="form-group">
        <label class="col-lg-2 required" for="PuissanceApplicationId">Application : </label>
        <div class="col-lg-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('application_id',$applications,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'application est obligatoire", 'selected' => $this->data['Puissance']['application_id'],'empty' => 'Choisir une application')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('application_id',$applications,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'application est obligatoire", 'empty' => 'Choisir une application')); ?>
            <?php } ?>        
        </div>        
    </div>
    <div class="block-panel-50-left">
    <div class="form-group">
        <label class="col-lg-4" for="PuissanceDATABASE">DataBase : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('DATABASE',array('class'=>'yesno')); ?>
            &nbsp;<label for="PuissanceDATABASE" class='labelAfter'></label>
        </div>
    </div>
    </div>
    <div class="block-panel-50-right">
    <div class="form-group">
        <label class="col-lg-4" for="PuissanceAPPLICATION">Application : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('APPLICATION',array('class'=>'yesno')); ?>
            &nbsp;<label for="PuissanceAPPLICATION" class='labelAfter'></label>
        </div>
    </div>   
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="PuissancePUISSANCE">Puissance : </label>      
        <div class="col-lg-5">
            <?php echo $this->Form->input('PUISSANCE',array('type'=>'text','placeholder'=>'Puissance','class'=>'form-control')); ?>
        </div>         
    </div> 
    <div class="form-group">
        <label class="col-lg-2" for="PuissanceCOMMENTAIRE">Commentaire : </label>       
        <div class="col-lg-10">
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