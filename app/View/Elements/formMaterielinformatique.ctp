<?php echo $this->Form->create('Materielinformatique',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="MaterielinformatiqueNOM">Nom : </label>
        <div class="controls">
            <?php echo $this->Form->input('NOM',array('data-rule-required'=>'true','placeholder'=>'Nom du poste informatique','class'=>'span8','data-msg-required'=>"Le nom du poste informatique est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre  required" for="MaterielinformatiqueTypematerielId">Périphérique : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->input('typemateriel_id',array('type'=>'hidden','value'=>$this->data['Materielinformatique']['typemateriel_id'])); ?>
                <?php echo h($materielinformatique['Typemateriel']['NOM']); ?> 
            <?php } else { ?>
                <?php echo $this->Form->select('typemateriel_id',$peripherique, array('data-rule-required'=>'true','empty'=>'Choisir un périphérique','class'=>'span8','data-msg-required'=>"Le nom du périphérique est obligatoire")); ?>
            <?php } ?>            
         </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre  required" for="MaterielinformatiqueSectionId">Section : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('section_id',$section, array('data-rule-required'=>'true','selected' => $this->data['Materielinformatique']['section_id'],'empty'=>'Choisir une section','class'=>'span8','data-msg-required'=>"La section est obligatoire")); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('section_id',$section, array('data-rule-required'=>'true','empty'=>'Choisir une section','class'=>'span8','data-msg-required'=>"La section est obligatoire")); ?>
            <?php } ?>            
         </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre  required" for="MaterielinformatiqueAssistanceId">Assistance : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('assistance_id',$assistance, array('data-rule-required'=>'true','selected' => $this->data['Materielinformatique']['assistance_id'],'empty'=>'Choisir une asssistance','class'=>'span8','data-msg-required'=>"L'assistance est obligatoire")); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('assistance_id',$assistance, array('data-rule-required'=>'true','empty'=>'Choisir une assistance','class'=>'span8','data-msg-required'=>"L'assistance est obligatoire")); ?>
            <?php } ?>            
         </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre" for="MaterielinformatiqueWIFI">Wifi : </label>
        <div class="controls">
            <?php echo $this->Form->input('WIFI',array('class'=>'yesno')); ?>
            &nbsp;<label class='labelAfter'></label>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre" for="MaterielinformatiqueVPN">Accès distant : </label>
        <div class="controls">
            <?php echo $this->Form->input('VPN',array('class'=>'yesno')); ?>
            &nbsp;<label class='labelAfter'></label>
        </div>
        </div>
    <div class="control-group">
        <label class="control-label sstitre  required" for="MaterielinformatiqueEtat">Etat : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('ETAT',$etat, array('selected' => $this->data['Materielinformatique']['ETAT'],'empty'=>'Choisir un état','data-rule-required'=>'true','data-msg-required'=>"L'état est obligatoire")); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('ETAT',$etat, array('empty'=>'Choisir un état','data-rule-required'=>'true','data-msg-required'=>"L'état est obligatoire")); ?>
            <?php } ?>  
        </div>
        </div>
        <div class="control-group">
        <label class="control-label sstitre" for="MaterielinformatiqueCOMMENTAIRE">Description : </label>
        <div class="controls">
            <?php echo $this->Form->input('COMMENTAIRE',array('type'=>'textarea',"readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container" style="margin-top:2px;text-align:center;">
                    <?php $url = $this->Session->read('history'); $index = count($url) > 1 ? 1 : 0; ?>
                    <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url($url[$index])."/<'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
                </div>
            </div>
        </div> 
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>
