<div class="">
<?php echo $this->Form->create('Message',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-2 required" for="MessageLIBELLE">Message : </label>
        <div class="col-md-10">
            <?php echo $this->Form->input('LIBELLE',array('type'=>'textarea','data-rule-required'=>'true','data-msg-required'=>"Le message est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="form-group">
            <label class="col-md-2" for="MessageEntiteId">Cercle de visibilité prioritaire : </label>
            <div class="col-md-3">
                <?php if ($this->params->action == 'edit') { ?>
                    <?php echo $this->Form->select('entite_id',$cercles,array('class'=>'form-control','selected' => $this->data['Message']['entite_id'],'empty' => 'Choisir un cercle de visibilité ou visible par tous')); ?>
                <?php } else { ?>
                    <?php $entite_id = is_null(userAuth('entite_id')) ? '' : userAuth('entite_id'); ?>
                    <?php echo $this->Form->select('entite_id',$cercles,array('class'=>'form-control','selected' => $entite_id, 'default' => $entite_id, 'empty' => 'Choisir un cercle de visibilité ou visible par tous')); ?>
                <?php } ?>
            </div>
        </div>      
        <div class="form-group">
        <label class="col-md-2" for="MessageDATELIMITE">Date de fin du message : </label>
        <div class="col-md-2">
            <div class="input-group" style="margin-left: 0px;">
            <?php $today = new dateTime(); ?>
            <?php echo $this->Form->input('DATELIMITE',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'class'=>"form-control dateall",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#MessageDATELIMITE"><span class="glyphicons circle_remove grey"></span></span>
            <span class="input-group-addon date-addon-calendar btn-addon" data-target="#MessageDATELIMITE"><span class="glyphicons calendar"></span></span>
            </div>  
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