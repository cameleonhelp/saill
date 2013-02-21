<?php echo $this->Form->create('Materielautre',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="MaterielautreTypematerielId">Périphérique : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('typemateriel_id',$peripherique, array('data-rule-required'=>'true','selected' => $this->data['Materielautre']['typemateriel_id'],'empty'=>'Choisir un périphérique','class'=>'span8','data-msg-required'=>"Le nom du périphérique est obligatoire")); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('typemateriel_id',$peripherique, array('data-rule-required'=>'true','empty'=>'Choisir un périphérique','class'=>'span8','data-msg-required'=>"Le nom du périphérique est obligatoire")); ?>
            <?php } ?>            
         </div>
        </div>
        <div class="control-group">
        <label class="control-label sstitre" for="MaterielautreCOMMENTAIRE">Description : </label>
        <div class="controls">
            <?php echo $this->Form->input('COMMENTAIRE',array('type'=>'textarea',"readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container" style="margin-top:2px;text-align:center;">
                    <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url('/materielautres')."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
                </div>
            </div>
        </div> 
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>
