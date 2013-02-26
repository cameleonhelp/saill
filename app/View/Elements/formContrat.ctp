<?php echo $this->Form->create('Contrat',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="ContratNOM">Nom : </label>
        <div class="controls">
            <?php echo $this->Form->input('NOM',array('type'=>'text','placeholder'=>'Nom du contrat','data-rule-required'=>'true','data-msg-required'=>"Le nom du contrat est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ContratTjmcontratId">TJM Moyen : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('tjmcontrat_id',$tjmcontrats,array('selected' => $this->data['Contrat']['tjmcontrat_id'],'empty' => 'Choisir un tjm moyen')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('tjmcontrat_id',$tjmcontrats,array('empty' => 'Choisir un tjm moyen')); ?>
            <?php } ?>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre  required" for="ContratANNEEDEBUT">Début (année) : </label>
        <div class="controls">
            <?php echo $this->Form->input('ANNEEDEBUT',array('type'=>'text','placeholder'=>'Année de début du contrat','data-rule-required'=>'true','data-msg-required'=>"Le nom'année de début du contrat est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ContratANNEEFIN">Fin (année) : </label>
        <div class="controls">
            <?php echo $this->Form->input('ANNEEFIN',array('type'=>'text','placeholder'=>'Année de fin du contrat','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ContratMONTANT">Montant (k€) : </label>
        <div class="controls">
            <?php echo $this->Form->input('MONTANT',array('type'=>'text','placeholder'=>'Montant en k€ du contrat','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ContratACTIF">Actif : </label>
        <div class="controls">
            <?php echo $this->Form->input('ACTIF',array('type'=>'checkbox','class'=>'yesno','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            &nbsp;<label class='labelAfter'></label>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ContratDESCRIPTION">Commentaire : </label>
        <div class="controls">
            <?php echo $this->Form->input('DESCRIPTION',array('type'=>'textarea','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container" style="margin-top:2px;text-align:center;">
                    <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url('/contrats')."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
                </div>
            </div>
        </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>
<?php echo $this->Form->end(); ?>