<div class="marginright20">
<?php echo $this->Form->create('Section',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2 required" for="SectionNOM">Nom : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('NOM',array('data-rule-required'=>'true','class'=>'form-control','placeholder'=>'Nom de la section','data-msg-required'=>"Le nom de la section est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="form-group">
        <label class="col-lg-2" for="SectionUtilisateurId">Responsable : </label>
        <div class="col-lg-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('utilisateur_id',$responsable,array('class'=>'form-control','selected' => $this->data['Section']['utilisateur_id'] != NULL ? $this->data['Section']['utilisateur_id']: '','empty'=>'Choisir un responsable')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('utilisateur_id',$responsable,array('class'=>'form-control','selected' => '','empty'=>'Choisir un responsable')); ?>
            <?php } ?>
        </div>
        </div>
        <div class="form-group">
        <label class="col-lg-2" for="SectionDESCRIPTION">Description : </label>
        <div class="col-lg-10">
            <?php echo $this->Form->input('DESCRIPTION',array('type'=>'textarea',"readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
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