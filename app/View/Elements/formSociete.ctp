<?php echo $this->Form->create('Societe',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="SocieteNOM">Nom : </label>
        <div class="controls">
            <?php echo $this->Form->input('NOM',array('data-rule-required'=>'true','placeholder'=>'Nom du type de la société','class'=>'span8','data-msg-required'=>"Le nom de la société est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="control-group">
        <label class="control-label sstitre" for="SocieteNOMCONTACT">Nom du contact : </label>
        <div class="controls">
            <?php echo $this->Form->input('NOMCONTACT',array('placeholder'=>'Nom du contact','class'=>'span8','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="control-group">
        <label class="control-label sstitre" for="SocieteTELEPHONE">Téléphone : </label>
        <div class="controls">
            <?php echo $this->Form->input('TELEPHONE',array('placeholder'=>'Téléphone du contact','class'=>'span8','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="control-group">
        <label class="control-label sstitre" for="SocieteMAIL">Email du contact : </label>
        <div class="controls">
            <?php echo $this->Form->input('MAIL',array('placeholder'=>'Email du contact','class'=>'span8','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container" style="margin-top:2px;text-align:center;">
                    <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url('/societes')."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
                </div>
            </div>
        </div> 
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>