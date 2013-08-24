<?php echo $this->Form->create('Tjmcontrat',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="TjmcontratTJM">Montant du TJM contrat : </label>
        <div class="controls">
            <?php echo $this->Form->input('TJM',array('data-rule-required'=>'true','placeholder'=>'Montant du TJM contrat','data-msg-required'=>"Le montant du TJM contrat est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?> €/j
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre  required" for="TjmcontratANNEE">Année d'application : </label>
        <div class="controls">
            <?php echo $this->Form->input('ANNEE',array('type'=>'text','data-rule-required'=>'true','placeholder'=>'Année d\'application','data-msg-required'=>"Le nom de l'achat'année d'application est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn showoverlay','onclick'=>"location.href='".goPrev()."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
            </div>
        </div>
    </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>