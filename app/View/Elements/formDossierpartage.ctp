<div class="marginright20">
<?php echo $this->Form->create('Dossierpartage',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2 required" for="DossierpartageNOM">Nom : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('NOM',array('type'=>'text','class'=>'form-control','placeholder'=>'Nom du partage','data-rule-required'=>'true','data-msg-required'=>"Le nom du partage est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="form-group">
        <label class="col-lg-2 required" for="DossierpartageGROUPEAD">Nom du groupe: </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('GROUPEAD',array('type'=>'text','class'=>'form-control','placeholder'=>'Nom du groupe dans l\'AD','data-rule-required'=>'true','data-msg-required'=>"Le nom du groupe AD est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="form-group">
        <label class="col-lg-2" for="DossierpartageUtilisateurId">Gestionnaire: </label>
        <div class="col-lg-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('utilisateur_id',$gestionnaire,array('selected' => $this->data['Dossierpartage']['utilisateur_id'],'class'=>'form-control','empty' => 'Choisir un gestionnaire')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('utilisateur_id',$gestionnaire,array('class'=>'form-control','empty' => 'Choisir un gestionnaire')); ?>
            <?php } ?>            
        </div>
        </div>
        <div class="form-group">
        <label class="col-lg-2" for="DossierpartageDESCRIPTION">Description : </label>
        <div class="col-lg-10">
            <?php echo $this->Form->input('DESCRIPTION',array('type'=>'textarea','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
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