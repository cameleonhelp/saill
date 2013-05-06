<?php echo $this->Form->create('Dotation',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre" for="DotationMaterielinformatiquesId">Poste informatique : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->input('materielinformatiques_id',array('type'=>'hidden','value'=>$this->data['Dotation']['materielinformatiques_id'])); ?>
                <?php echo h($dotation['Materielinformatique']['NOM']); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('materielinformatiques_id',$matinformatique,array('selected' => '','empty' => 'Choisir un poste informatique')); ?>
            <?php } ?>
        </div>
    <?php if (userAuth('profil_id')<6) : ?>
    </div> ou
    <div class="control-group">
        <label class="control-label sstitre" for="DotationTypematerielId">Périphérique : </label>
        <div class="controls">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->input('typemateriel_id',array('type'=>'hidden','value'=>$this->data['Dotation']['typemateriel_id'])); ?>
                <?php echo h($dotation['Typemateriel']['NOM']); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('typemateriel_id',$matautre,array('selected' => '','empty' => 'Choisir un périphérique')); ?>
            <?php } ?>
        </div>
    <?php endif; ?>
    </div> 
    <div class="control-group">
        <label class="control-label sstitre" for="DotationDATERECEPTION">Date de remise du matériel : </label>
        <div class="controls">
            <div class="input-append date" data-date="<?php echo empty($this->data['Dotation']['DATERECEPTION']) ? date('d/m/Y') : $this->data['Dotation']['DATERECEPTION']; ?>" data-date-format="dd/mm/yyyy">
            <?php $today = date('d/m/Y'); ?>
            <?php echo $this->Form->input('DATERECEPTION',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
            <span class="add-on"><i class="glyphicon_calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="DotationDATEREMISE">Date de retour du matériel : </label>
        <div class="controls">
            <div class="input-append date" data-date="<?php echo empty($this->data['Dotation']['DATEREMISE']) ? date('d/m/Y') : $this->data['Dotation']['DATEREMISE']; ?>" data-date-format="dd/mm/yyyy">
            <?php $today = date('d/m/Y'); ?>
            <?php echo $this->Form->input('DATEREMISE',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
            <span class="add-on"><i class="glyphicon_calendar"></i></span>
            </div>
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
<?php $utilisateurId = $this->params->action == 'edit' ? $this->params->pass[1] : $this->params->pass[0]; ?>    
<?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>$utilisateurId)); ?>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>
<?php echo $this->Form->end(); ?>