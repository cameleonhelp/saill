<?php echo $this->Form->create('Dossierpartage',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="DossierpartageNOM">Nom : </label>
        <div class="controls">
            <?php echo $this->Form->input('NOM',array('type'=>'text','placeholder'=>'Nom du partage','data-rule-required'=>'true','data-msg-required'=>"Le nom du partage est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre  required" for="DossierpartageGROUPEAD">Nom du groupe: </label>
        <div class="controls">
            <?php echo $this->Form->input('GROUPEAD',array('type'=>'text','placeholder'=>'Nom du groupe dans l\'AD','data-rule-required'=>'true','data-msg-required'=>"Le nom du groupe AD est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="control-group">
        <label class="control-label sstitre" for="DossierpartageDESCRIPTION">Description : </label>
        <div class="controls">
            <?php echo $this->Form->input('DESCRIPTION',array('type'=>'textarea','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container" style="margin-top:2px;text-align:center;">
                    <?php $url = $this->Session->read('history'); ?>
                    <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url($url[1])."/<'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
                </div>
            </div>
        </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>
<?php echo $this->Form->end(); ?>