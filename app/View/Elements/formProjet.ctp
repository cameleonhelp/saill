<div class="marginright20">
<?php echo $this->Form->create('Projet',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2 required" for="ProjetContratId">Contrat : </label>
        <div class="col-lg-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('contrat_id',$contrats,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom du contrat est obligatoire", 'selected' => $this->data['Projet']['contrat_id'],'empty' => 'Choisir un contrat')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('contrat_id',$contrats,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom du contrat est obligatoire", 'empty' => 'Choisir un contrat')); ?>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 required" for="ProjetNOM">Nom : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('NOM',array('class'=>'form-control','data-rule-required'=>'true','placeholder'=>'Nom du projet','data-msg-required'=>"Le nom du projet est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="ProjetNUMEROGALLILIE">Réf. GALILEI : </label>
        <div class="col-lg-5">
            <div class="input-group" style="margin-left: 0px;">
            <?php echo $this->Form->input('NUMEROGALLILIE',array('class'=>'form-control projet-galilei','placeholder'=>'Numéro du projet sous GALILEI','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ProjetNUMEROGALLILIE"><span class="glyphicons circle_remove grey"></span></span>
            </div>
        </div>
    </div>
<div class="form-group">
        <label class="col-lg-2" for="ProjetDEBUT">Début du projet : </label>
        <div class="col-lg-3">
            <div class="input-group" style="margin-left: 0px;">
            <?php $today = new dateTime(); ?>
            <?php echo $this->Form->input('DEBUT',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'class'=>"form-control dateall",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ProjetDEBUT"><span class="glyphicons circle_remove grey"></span></span>
            <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ProjetDEBUT"><span class="glyphicons calendar"></span></span>
            </div> 
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="ProjetFIN">Fin du projet : </label>
        <div class="col-lg-3">
            <div class="input-group" style="margin-left: 0px;">
            <?php $today = new dateTime(); ?>
            <?php echo $this->Form->input('FIN',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'class'=>"form-control dateall",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ProjetFIN"><span class="glyphicons circle_remove grey"></span></span>
            <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ProjetFIN"><span class="glyphicons calendar"></span></span>
            </div>             
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="ProjetACTIF">Actif : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('ACTIF',array('class'=>'yesno')); ?>
            &nbsp;<label class='labelAfter'></label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="ProjetTYPE">Type : </label>
        <div class="col-lg-3">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('TYPE',$type,array('class'=>'form-control','selected' => $this->data['Projet']['TYPE'],'empty' => 'Choisir un type de projet')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('TYPE',$type,array('class'=>'form-control','empty' => 'Choisir un type de projet')); ?>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="ProjetFACTURATION">Facturation : </label>
        <div class="col-lg-3">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('FACTURATION',$facturation,array('class'=>'form-control','selected' => $this->data['Projet']['FACTURATION'],'empty' => 'Choisir un type de facturation')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('FACTURATION',$facturation,array('class'=>'form-control','empty' => 'Choisir un type de facturation')); ?>
            <?php } ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="ProjetCOMMENTAIRE">Commentaire : </label>
        <div class="col-lg-10">
            <?php echo $this->Form->input('COMMENTAIRE',array('type'=>'textarea')); ?>
        </div>
    </div>
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>
</div>