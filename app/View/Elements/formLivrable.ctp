<?php echo $this->Form->create('Livrable',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre required" for="LivrableUtilisateurId">Gestionnaire du livrable : </label>
        <div class="controls">        
            <?php echo $this->Form->select('utilisateur_id',$utilisateur,array('data-rule-required'=>'true','data-msg-required'=>'Le nom du gestionnaire est obligatoire','empty' => 'Choisir un gestionnaire')); ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre  required" for="LivrableNOM">Nom du livrable: </label>
        <div class="controls">
            <?php echo $this->Form->input('NOM',array('data-rule-required'=>'true','placeholder'=>'Nom de livrable','class'=>'span10','data-msg-required'=>'Le nom de livrable est obligatoire','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="LivrableREFERENCE">Référence MINIDOC  : </label>
        <div class="controls">
            <?php echo $this->Form->input('REFERENCE',array('placeholder'=>'Référence MINIDOC','class'=>'span6','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre required" for="LivrableECHEANCE">Echéance de livraison : </label>
        <div class="controls">
            <div class="input-append date" data-date="<?php echo empty($this->data['Livrable']['ECHEANCE']) ? date('d/m/Y') : $this->data['Livrable']['ECHEANCE']; ?>" data-date-format="dd/mm/yyyy">
            <?php $today = date('d/m/Y'); ?>
            <?php echo $this->Form->input('ECHEANCE',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true','data-rule-required'=>'true','data-msg-required'=>'La date d\'échéance est obligatoire','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
            <span class="add-on"><i class="glyphicon_calendar"></i></span>
            </div>
        </div>
    </div>   
    <div class="control-group">
        <label class="control-label sstitre required" for="LivrableDATELIVRAISON">Date de livraison : </label>
        <div class="controls">
            <div class="input-append date" data-date="<?php echo empty($this->data['Livrable']['DATELIVRAISON']) ? date('d/m/Y') : $this->data['Livrable']['DATELIVRAISON']; ?>" data-date-format="dd/mm/yyyy">
            <?php $today = date('d/m/Y'); ?>
            <?php echo $this->Form->input('DATELIVRAISON',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true','data-rule-required'=>'true','data-msg-required'=>'La date de livraison est obligatoire','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
            <span class="add-on"><i class="glyphicon_calendar"></i></span>
            </div>
        </div>
    </div>   
    <div class="control-group">
        <label class="control-label sstitre required" for="LivrableDATEVALIDATION">Date de validation : </label>
        <div class="controls">
            <div class="input-append date" data-date="<?php echo empty($this->data['Livrable']['DATEVALIDATION']) ? date('d/m/Y') : $this->data['Livrable']['DATEVALIDATION']; ?>" data-date-format="dd/mm/yyyy">
            <?php $today = date('d/m/Y'); ?>
            <?php echo $this->Form->input('DATEVALIDATION',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true','data-rule-required'=>'true','data-msg-required'=>'La date de validation est obligatoire','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
            <span class="add-on"><i class="glyphicon_calendar"></i></span>
            </div>
        </div>
    </div>   	
    <div class="control-group">
        <label class="control-label sstitre required" for="LivrableETAT">Etat du livrable : </label>
        <div class="controls">
                <?php echo $this->Form->select('ETAT',$etats,array('selected' => '','empty' => 'Choisir un état')); ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="LivrableCOMMENTAIRE">Commentaire : </label>
        <div class="controls">
            <?php echo $this->Form->input('COMMENTAIRE',array('type'=>'textarea','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php $url = $this->Session->read('history'); ?>
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url($url[0])."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
            </div>
        </div>
    </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>
<?php if ($this->params['action']=='edit'){ ?>
<hr>
<label class="sstitre">Historique du suivi du livrable :</label>      
<?php echo $this->element('tableSuiviLivrable'); ?>
<?php } ?>