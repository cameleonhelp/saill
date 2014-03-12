<div class="">
<?php echo $this->Form->create('Centrecout',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-2 required" for="CentrecoutNOM">Libellé : </label>
        <div class="col-md-10">
            <?php echo $this->Form->input('NOM',array('class'=>'form-control','data-rule-required'=>'true','placeholder'=>'Libéllé du centre de coût','data-msg-required'=>"Le nom du centre de coût est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 required" for="CentrecoutNOMDEPARTEMENT">Cercle : </label>
        <div class="col-md-10">
            <?php echo $this->Form->input('NOMDEPARTEMENT',array('class'=>'form-control','data-rule-required'=>'true','placeholder'=>'Cercle du centre de coût','data-msg-required'=>"Le nom de l\'cercle est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 required" for="CentrecoutCODEDEPARTEMENT">Département : </label>
        <div class="col-md-10">
            <?php echo $this->Form->input('CODEDEPARTEMENT',array('class'=>'form-control','data-rule-required'=>'true','placeholder'=>'N° département du centre de coût','data-msg-required'=>"Le nom du département est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 required" for="CentrecoutCODEPROJET">Code projet : </label>
        <div class="col-md-10">
            <?php echo $this->Form->input('CODEPROJET',array('class'=>'form-control','data-rule-required'=>'true','placeholder'=>'Code projet du centre de coût','data-msg-required'=>"Le code de projet est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 required" for="CentrecoutCODEACTIVITE">Code activité : </label>
        <div class="col-md-10">
            <?php echo $this->Form->input('CODEACTIVITE',array('class'=>'form-control','data-rule-required'=>'true','placeholder'=>'Code activité du centre de coût','data-msg-required'=>"Le code activité est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>    
    <div class="form-group">
        <label class="col-md-2" for="CentrecoutSNCF">Pour les agents SNCF : </label>
        <div class="col-md-4">
                <?php echo $this->Form->input('SNCF',array('type'=>'checkbox','class'=>'yesno')); ?>
                &nbsp;<label class='labelAfter' for="CentrecoutSNCF"></label> 
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