<?php echo $this->Form->create('Contact',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="ContactEMAIL">Votre email : </label>
        <div class="controls">
            <?php $value = userAuth('MAIL')!='' ? userAuth('MAIL'): ""; ?>
            <?php echo $this->Form->input('EMAIL',array('data-rule-required'=>'true','data-rule-email'=>'true','data-msg-email'=>'Le format de votre email n\'est pas correct','placeholder'=>'Votre adresse email','class'=>'span12','data-msg-required'=>"Votre email est obligatoire",'value'=>$value,'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre  required" for="ContactOBJET">Objet du message : </label>
        <div class="controls">
            <?php echo $this->Form->input('OBJET',array('data-rule-required'=>'true','placeholder'=>'Objet du message','class'=>'span25','data-msg-required'=>"l'objet du message est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre  required" for="ContactMESSAGE">Message : </label>
        <div class="controls">
            <?php echo $this->Form->input('MESSAGE',array('data-rule-required'=>'true','data-msg-required'=>"Le message est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php $url = $this->Session->read('history'); ?>
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url($url[0])."'")); ?>&nbsp;<?php echo $this->Form->button('Envoyer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
            </div>
        </div>
    </div>  
<?php echo $this->Form->end(); ?>
