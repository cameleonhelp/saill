<div class="">
<?php echo $this->Form->create('Outil',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-2 required" for="OutilNOM">Nom : </label>
        <div class="col-md-5">
            <?php echo $this->Form->input('NOM',array('type'=>'text','class'=>'form-control','placeholder'=>'Nom de l\'outil','data-rule-required'=>'true','data-msg-required'=>"Le nom de l'outil est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
    <div class="form-group">
        <label class="col-md-2 required" for="OutilUtilisateurId">Gestionnaire : </label>
        <div class="col-md-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('utilisateur_id',$gestionnaire,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom du gestionnaire est obligatoire", 'selected' => $this->data['Outil']['utilisateur_id'],'empty' => 'Choisir un gestionnaire')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('utilisateur_id',$gestionnaire,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom du gestionnaire est obligatoire", 'empty' => 'Choisir un gestionnaire')); ?>
            <?php } ?>
        </div>
        </div>
    <div class="form-group">
        <label class="col-md-2" for="OutilVALIDATION">A faire valider : </label>
        <div class="col-md-5">
            <?php echo $this->Form->input('VALIDATION',array('type'=>'checkbox','class'=>'yesno','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            &nbsp;<label  for="OutilVALIDATION" class='labelAfter cursor'></label>
        </div>
        </div>
    <div class="form-group">
        <label class="col-md-2" for="OutilDESCRIPTION">Description : </label>
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