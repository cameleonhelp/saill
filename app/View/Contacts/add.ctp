<div class="">
<?php echo $this->Form->create('Contact',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-2 required" for="ContactEMAIL">Votre email : </label>
        <div class="col-md-10">
            <?php $value = userAuth('MAIL')!='' ? userAuth('MAIL'): ""; ?>
            <?php echo $this->Form->input('EMAIL',array('data-rule-required'=>'true','data-rule-email'=>'true','data-msg-email'=>'Le format de votre email n\'est pas correct','placeholder'=>'Votre adresse email','class'=>' form-control','data-msg-required'=>"Votre email est obligatoire",'value'=>$value,'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 required" for="ContactOBJET">Objet du message : </label>
        <div class="col-md-10">
            <?php echo $this->Form->input('OBJET',array('data-rule-required'=>'true','placeholder'=>'Objet du message','class'=>' form-control','data-msg-required'=>"l'objet du message est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 required" for="ContactMESSAGE">Message : </label>
        <div class="col-md-10">
            <?php echo $this->Form->input('MESSAGE',array('data-rule-required'=>'true','data-msg-required'=>"Le message est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Envoyer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
        </div>
    </div>
<?php echo $this->Form->end(); ?>
</div>
