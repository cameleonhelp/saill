<div class="">
<?php echo $this->Form->create('Contrat',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-2 required" for="ContratNOM">Nom : </label>
        <div class="col-md-5">
            <?php echo $this->Form->input('NOM',array('class'=>'form-control','type'=>'text','placeholder'=>'Nom du contrat','data-rule-required'=>'true','data-msg-required'=>"Le nom du contrat est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
    <div class="form-group">
        <label class="col-md-2" for="ContratTjmcontratId">TJM Moyen : </label>
        <div class="col-md-3">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('tjmcontrat_id',$tjmcontrats,array('class'=>'form-control','selected' => $this->data['Contrat']['tjmcontrat_id'],'empty' => 'Choisir un tjm moyen')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('tjmcontrat_id',$tjmcontrats,array('class'=>'form-control','empty' => 'Choisir un tjm moyen')); ?>
            <?php } ?>
        </div>
        </div>
    <div class="form-group">
        <label class="col-md-2 required" for="ContratANNEEDEBUT">Début (année) : </label>
        <div class="col-md-3">
            <?php echo $this->Form->input('ANNEEDEBUT',array('class'=>'form-control year-only','type'=>'text','placeholder'=>'Année de début du contrat','data-rule-required'=>'true','data-msg-required'=>"Le nom'année de début du contrat est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
    <div class="form-group">
        <label class="col-md-2" for="ContratANNEEFIN">Fin (année) : </label>
        <div class="col-md-3">
            <?php echo $this->Form->input('ANNEEFIN',array('class'=>'form-control year-only','type'=>'text','placeholder'=>'Année de fin du contrat','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
    <!--<div class="form-group">
        <label class="col-md-2" for="ContratMONTANT">Montant (k€) : </label>
        <div class="col-md-5">
            <?php echo $this->Form->input('MONTANT',array('type'=>'text','placeholder'=>'Montant en k€ du contrat','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>//-->
    <div class="form-group">
        <label class="col-md-2" for="ContratACTIF">Actif : </label>
        <div class="col-md-5">
            <?php echo $this->Form->input('ACTIF',array('type'=>'checkbox','class'=>'yesno','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            &nbsp;<label class='labelAfter'></label>
        </div>
        </div>
    <div class="form-group">
        <label class="col-md-2" for="ContratDESCRIPTION">Commentaire : </label>
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