<div class="marginright20">
<?php echo $this->Form->create('Materielinformatique',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2  required" for="MaterielinformatiqueNOM">Nom : </label>
        <div class="col-lg-3">
            <?php echo $this->Form->input('NOM',array('class'=>'form-control','data-rule-required'=>'true','placeholder'=>'Nom du poste informatique','data-msg-required'=>"Le nom du poste informatique est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
    <div class="form-group">
        <label class="col-lg-2  required" for="MaterielinformatiqueTypematerielId">Périphérique : </label>
        <div class="col-lg-3">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->input('typemateriel_id',array('type'=>'hidden','value'=>$this->data['Materielinformatique']['typemateriel_id'])); ?>
                <?php echo h($materielinformatique['Typemateriel']['NOM']); ?> 
            <?php } else { ?>
                <?php echo $this->Form->select('typemateriel_id',$peripherique, array('class'=>'form-control','data-rule-required'=>'true','empty'=>'Choisir un périphérique','data-msg-required'=>"Le nom du périphérique est obligatoire")); ?>
            <?php } ?>            
         </div>
        </div>
    <div class="form-group">
        <label class="col-lg-2  required" for="MaterielinformatiqueSectionId">Section : </label>
        <div class="col-lg-3">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('section_id',$section, array('class'=>'form-control','data-rule-required'=>'true','selected' => $this->data['Materielinformatique']['section_id'],'empty'=>'Choisir une section','data-msg-required'=>"La section est obligatoire")); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('section_id',$section, array('class'=>'form-control','data-rule-required'=>'true','empty'=>'Choisir une section','data-msg-required'=>"La section est obligatoire")); ?>
            <?php } ?>            
         </div>
        </div>
    <div class="form-group">
        <label class="col-lg-2  required" for="MaterielinformatiqueAssistanceId">Assistance : </label>
        <div class="col-lg-3">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('assistance_id',$assistance, array('class'=>'form-control','data-rule-required'=>'true','selected' => $this->data['Materielinformatique']['assistance_id'],'empty'=>'Choisir une asssistance','data-msg-required'=>"L'assistance est obligatoire")); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('assistance_id',$assistance, array('class'=>'form-control','data-rule-required'=>'true','empty'=>'Choisir une assistance','data-msg-required'=>"L'assistance est obligatoire")); ?>
            <?php } ?>            
         </div>
        </div>
    <div class="form-group">
        <label class="col-lg-2" for="MaterielinformatiqueWIFI">Wifi : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('WIFI',array('class'=>'yesno')); ?>
            &nbsp;<label  for="MaterielinformatiqueWIFI" class='labelAfter'></label>
        </div>
        </div>
    <div class="form-group">
        <label class="col-lg-2" for="MaterielinformatiqueVPN">Accès distant : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('VPN',array('class'=>'yesno')); ?>
            &nbsp;<label for="MaterielinformatiqueVPN" class='labelAfter'></label>
        </div>
        </div>
    <div class="form-group">
        <label class="col-lg-2  required" for="MaterielinformatiqueEtat">Etat : </label>
        <div class="col-lg-3">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('ETAT',$etat, array('class'=>'form-control','selected' => $this->data['Materielinformatique']['ETAT'],'empty'=>'Choisir un état','data-rule-required'=>'true','data-msg-required'=>"L'état est obligatoire")); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('ETAT',$etat, array('class'=>'form-control','empty'=>'Choisir un état','data-rule-required'=>'true','data-msg-required'=>"L'état est obligatoire")); ?>
            <?php } ?>  
        </div>
        </div>
        <div class="form-group">
        <label class="col-lg-2" for="MaterielinformatiqueCOMMENTAIRE">Description : </label>
        <div class="col-lg-10">
            <?php echo $this->Form->input('COMMENTAIRE',array('type'=>'textarea',"readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
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