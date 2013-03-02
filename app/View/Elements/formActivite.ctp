<?php echo $this->Form->create('Activite',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="ActiviteProjetId">Projet : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('projet_id',$projets,array('data-rule-required'=>'true','data-msg-required'=>"Le nom du projet est obligatoire", 'selected' => $this->data['Activite']['projet_id'],'empty' => 'Choisir un projet')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('projet_id',$projets,array('data-rule-required'=>'true','data-msg-required'=>"Le nom du projet est obligatoire", 'empty' => 'Choisir un projet')); ?>
            <?php } ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre  required" for="ActiviteNOM">Nom : </label>
        <div class="controls">
            <?php echo $this->Form->input('NOM',array('data-rule-required'=>'true','placeholder'=>'Nom de l\'activite','class'=>'span8','data-msg-required'=>"Le nom de l'activité est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ActiviteNUMEROGALLILIE">Réf. GALILEI : </label>
        <div class="controls">
            <?php echo $this->Form->input('NUMEROGALLILIE',array('placeholder'=>'Numéro du projet sous GALILEI','class'=>'span8','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
<div class="control-group">
        <label class="control-label sstitre" for="ActiviteDATEDEBUT">Début de l'activité : </label>
        <div class="controls">
            <div class="input-append date" data-date="<?php echo empty($this->data['Activite']['DATEDEBUT']) ? date('d/m/Y') : $this->data['Activite']['DATEDEBUT']; ?>" data-date-format="dd/mm/yyyy">
            <?php $today = date('d/m/Y'); ?>
            <?php echo $this->Form->input('DATEDEBUT',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
            <span class="add-on"><i class="glyphicon_calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ActiviteDATEFIN">Fin de l'activité : </label>
        <div class="controls">
            <div class="input-append date" data-date="<?php echo empty($this->data['Activite']['DATEFIN']) ? date('d/m/Y') : $this->data['Activite']['DATEFIN']; ?>" data-date-format="dd/mm/yyyy">
            <?php $today = date('d/m/Y'); ?>
            <?php echo $this->Form->input('DATEFIN',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
            <span class="add-on"><i class="glyphicon_calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ActiviteACTIVE">Actif : </label>
        <div class="controls">
            <?php echo $this->Form->input('ACTIVE',array('class'=>'yesno')); ?>
            &nbsp;<label class='labelAfter'></label>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ActiviteBUDJETRA">Budget initial : </label>
        <div class="controls">
            <?php echo $this->Form->input('BUDJETRA',array('placeholder'=>'Budget initial de la RA','class'=>'span8','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?> k€
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ActiviteBUDGETREVU">Dernier budget : </label>
        <div class="controls">
            <?php echo $this->Form->input('BUDGETREVU',array('placeholder'=>'Budget revue = Budget RA à l\'initialisation','class'=>'span8','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?> k€
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ActiviteDESCRIPTION">Commentaire : </label>
        <div class="controls">
            <?php echo $this->Form->input('DESCRIPTION',array('type'=>'textarea')); ?>
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