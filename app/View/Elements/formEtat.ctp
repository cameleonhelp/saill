<div class="marginright20">
<?php echo $this->Form->create('Etat',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2 required" for="EtatNOM">Nom : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('NOM',array('type'=>'text','placeholder'=>'Nom de l\'état','data-rule-required'=>'true','class'=>'form-control','data-msg-required'=>"Le nom de l'état est obligatoire")); ?>
        </div>
    </div>      
    <div class="form-group">
        <label class="col-lg-2" for="EtatORDER">Ordre : </label>
        <div class="col-lg-2">
            <?php echo $this->Form->input('ORDER',array('type'=>'text','placeholder'=>'Ordre d\'affichage','class'=>'form-control',)); ?>
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