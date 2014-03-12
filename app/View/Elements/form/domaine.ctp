<div class="">
<?php echo $this->Form->create('Domaine',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-2 required" for="DomaineNOM">Nom : </label>
        <div class="col-md-5">
            <?php echo $this->Form->input('NOM',array('type'=>'text','placeholder'=>'Nom du domaine','class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom du domaine est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2" for="DomaineEntiteId">Cercle de visibilité prioritaire : </label>
        <div class="col-md-3">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('entite_id',$cercles,array('class'=>'form-control','selected' => $this->data['Domaine']['entite_id'],'empty' => 'Choisir un cercle de visibilité')); ?>
            <?php } else { ?>
                <?php $entite_id = is_null(userAuth('entite_id')) ? '' : userAuth('entite_id'); ?>
                <?php echo $this->Form->select('entite_id',$cercles,array('class'=>'form-control','selected' => $entite_id, 'default' => $entite_id, 'empty' => 'Choisir un cercle de visibilité')); ?>
            <?php } ?>
        </div>
    </div>      
    <div class="form-group">
        <label class="col-md-2" for="DomaineDESCRIPTION">Description : </label>
        <div class="col-md-10">
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