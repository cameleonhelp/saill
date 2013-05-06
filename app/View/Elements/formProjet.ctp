<?php echo $this->Form->create('Projet',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="ProjetContratId">Contrat : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('contrat_id',$contrats,array('data-rule-required'=>'true','data-msg-required'=>"Le nom du contrat est obligatoire", 'selected' => $this->data['Projet']['contrat_id'],'empty' => 'Choisir un contrat')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('contrat_id',$contrats,array('data-rule-required'=>'true','data-msg-required'=>"Le nom du contrat est obligatoire", 'empty' => 'Choisir un contrat')); ?>
            <?php } ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre  required" for="ProjetNOM">Nom : </label>
        <div class="controls">
            <?php echo $this->Form->input('NOM',array('data-rule-required'=>'true','placeholder'=>'Nom du projet','class'=>'span8','data-msg-required'=>"Le nom du projet est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ProjetNUMEROGALLILIE">Réf. GALILEI : </label>
        <div class="controls">
            <?php echo $this->Form->input('NUMEROGALLILIE',array('placeholder'=>'Numéro du projet sous GALILEI','class'=>'span8','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
<div class="control-group">
        <label class="control-label sstitre" for="ProjetDEBUT">Début du projet : </label>
        <div class="controls">
            <div class="input-append date" data-date="<?php echo empty($this->data['Projet']['DEBUT']) ? date('d/m/Y') : $this->data['Projet']['DEBUT']; ?>" data-date-format="dd/mm/yyyy">
            <?php $today = date('d/m/Y'); ?>
            <?php echo $this->Form->input('DEBUT',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
            <span class="add-on"><i class="glyphicon_calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ProjetFIN">Fin du projet : </label>
        <div class="controls">
            <div class="input-append date" data-date="<?php echo empty($this->data['Projet']['FIN']) ? date('d/m/Y') : $this->data['Projet']['FIN']; ?>" data-date-format="dd/mm/yyyy">
            <?php $today = date('d/m/Y'); ?>
            <?php echo $this->Form->input('FIN',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
            <span class="add-on"><i class="glyphicon_calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ProjetACTIF">Actif : </label>
        <div class="controls">
            <?php echo $this->Form->input('ACTIF',array('class'=>'yesno')); ?>
            &nbsp;<label class='labelAfter'></label>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ProjetTYPE">Type : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('TYPE',$type,array('selected' => $this->data['Projet']['TYPE'],'empty' => 'Choisir un type de projet')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('TYPE',$type,array('empty' => 'Choisir un type de projet')); ?>
            <?php } ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ProjetFACTURATION">Facturation : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('FACTURATION',$facturation,array('selected' => $this->data['Projet']['FACTURATION'],'empty' => 'Choisir un type de facturation')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('FACTURATION',$facturation,array('empty' => 'Choisir un type de facturation')); ?>
            <?php } ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="ProjetCOMMENTAIRE">Commentaire : </label>
        <div class="controls">
            <?php echo $this->Form->input('COMMENTAIRE',array('type'=>'textarea')); ?>
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