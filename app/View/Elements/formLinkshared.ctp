<?php echo $this->Form->create('Linkshared',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="LinksharedNOM">Nom du lien : </label>
        <div class="controls">
            <?php echo $this->Form->input('NOM',array('type'=>'text','placeholder'=>'Nom du lien','data-rule-required'=>'true','data-msg-required'=>"Le nom du domaine est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="control-group">
        <label class="control-label sstitre required" for="LinksharedLINK">Lien : </label>
        <div class="controls">
            <?php echo $this->Form->input('LINK',array('type'=>'text','class'=>'span20','placeholder'=>'Url du site','data-rule-required'=>'true','data-msg-required'=>"Le nom du domaine'url du site est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container" style="margin-top:2px;text-align:center;">
                    <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url('/linkshareds')."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
                </div>
            </div>
        </div>
<?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>1)); ?>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>
<?php echo $this->Form->end(); ?>
