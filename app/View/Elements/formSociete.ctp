<div class="marginright20">
<?php echo $this->Form->create('Societe',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2 required" for="SocieteNOM">Nom : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('NOM',array('data-rule-required'=>'true','class'=>'form-control','placeholder'=>'Nom du type de la société','data-msg-required'=>"Le nom de la société est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="form-group">
        <label class="col-lg-2" for="SocieteNOMCONTACT">Nom du contact : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('NOMCONTACT',array('class'=>'form-control','placeholder'=>'Nom du contact','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="form-group">
        <label class="col-lg-2" for="SocieteTELEPHONE">Téléphone : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('TELEPHONE',array('class'=>'form-control','placeholder'=>'Téléphone du contact','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="form-group">
        <label class="col-lg-2" for="SocieteMAIL">Email du contact : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('MAIL',array('class'=>'form-control','placeholder'=>'Email du contact','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
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