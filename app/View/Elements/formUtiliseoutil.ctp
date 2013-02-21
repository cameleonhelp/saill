<?php echo $this->Form->create('Utiliseoutil',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre required" for="UtiliseoutilUtilisateurId">Utilisateur : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('utilisateur_id',$utilisateur,array('data-rule-required'=>'true','data-msg-required'=>'Le nom de l\'utilisateur est obligatoire','selected' => $this->data['Outil']['utilisateur_id'],'empty' => 'Choisir un utilisateur')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('utilisateur_id',$utilisateur,array('data-rule-required'=>'true','data-msg-required'=>'Le nom de l\'utilisateur est obligatoire','empty' => 'Choisir un utilisateur')); ?>
            <?php } ?>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre" for="UtiliseoutilOutilId">Outil : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('outil_id',$outil,array('selected' => $this->data['Utiliseoutil']['outil_id'],'empty' => 'Choisir un outil')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('outil_id',$outil,array('empty' => 'Choisir un outil')); ?>
            <?php } ?>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre" for="UtiliseoutilListediffusionId">Liste de diffusion : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('listediffusion_id',$listediffusion,array('selected' => $this->data['Utiliseoutil']['listediffusion_id'],'empty' => 'Choisir une liste de diffusion')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('listediffusion_id',$listediffusion,array('empty' => 'Choisir une liste de diffusion')); ?>
            <?php } ?>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre" for="UtiliseoutilDossierpartageId">Partage réseau : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('dossierpartage_id',$dossierpartage,array('selected' => $this->data['Utiliseoutil']['dossierpartage_id'],'empty' => 'Choisir un partage réseau')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('dossierpartage_id',$dossierpartage,array('empty' => 'Choisir un partage réseau')); ?>
            <?php } ?>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre required" for="UtiliseoutilSTATUT">Etat : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('STATUT',$etat,array('data-rule-required'=>'true','data-msg-required'=>'L\'état est obligatoire','selected' => $this->data['Utiliseoutil']['STATUT'],'empty' => 'Choisir un état')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('STATUT',$etat,array('data-rule-required'=>'true','data-msg-required'=>'L\'état est obligatoire','empty' => 'Choisir un état')); ?>
            <?php } ?>
        </div>
        </div>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container" style="margin-top:2px;text-align:center;">
                    <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url('/utiliseoutils')."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
                </div>
            </div>
        </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>
<?php echo $this->Form->end(); ?>