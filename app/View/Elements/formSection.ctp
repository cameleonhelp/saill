<?php echo $this->Form->create('Section',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="SectionNOM">Nom : </label>
        <div class="controls">
            <?php echo $this->Form->input('NOM',array('data-rule-required'=>'true','placeholder'=>'Nom de la section','class'=>'span8','data-msg-required'=>"Le nom de la section est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="control-group">
        <label class="control-label sstitre" for="SectionUtilisateurId">Responsable : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('utilisateur_id',$responsable,array('selected' => $this->data['Section']['utilisateur_id'] != NULL ? $this->data['Section']['utilisateur_id']: '','empty'=>'Choisir un responsable')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('utilisateur_id',$responsable,array('selected' => '','empty'=>'Choisir un responsable')); ?>
            <?php } ?>
        </div>
        </div>
        <div class="control-group">
        <label class="control-label sstitre" for="SectionDESCRIPTION">Description : </label>
        <div class="controls">
            <?php echo $this->Form->input('DESCRIPTION',array('type'=>'textarea',"readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container" style="margin-top:2px;text-align:center;">
                    <?php $url = $this->Session->read('history'); $index = count($url) > 1 ? 1 : 0; ?>
                    <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url($url[$index]['here'])."/<'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
                </div>
            </div>
        </div> 
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>