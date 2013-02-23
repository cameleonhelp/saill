<?php echo $this->Form->create('Outil',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="OutilNOM">Nom : </label>
        <div class="controls">
            <?php echo $this->Form->input('NOM',array('type'=>'text','placeholder'=>'Nom de l\'outil','data-rule-required'=>'true','data-msg-required'=>"Le nom de l'outil est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre required" for="OutilUtilisateurId">Gestionnaire : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('utilisateur_id',$gestionnaire,array('data-rule-required'=>'true','data-msg-required'=>"Le nom du gestionnaire est obligatoire", 'selected' => $this->data['Outil']['utilisateur_id'],'empty' => 'Choisir un gestionnaire')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('utilisateur_id',$gestionnaire,array('data-rule-required'=>'true','data-msg-required'=>"Le nom du gestionnaire est obligatoire", 'empty' => 'Choisir un gestionnaire')); ?>
            <?php } ?>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre" for="OutilVALIDATION">A faire valider : </label>
        <div class="controls">
            <?php echo $this->Form->input('VALIDATION',array('type'=>'checkbox','class'=>'yesno','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            &nbsp;<label class='labelAfter'></label>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre" for="OutilDESCRIPTION">Description : </label>
        <div class="controls">
            <?php echo $this->Form->input('DESCRIPTION',array('type'=>'textarea','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container" style="margin-top:2px;text-align:center;">
                    <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url('/outils')."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
                </div>
            </div>
        </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>
<?php echo $this->Form->end(); ?>