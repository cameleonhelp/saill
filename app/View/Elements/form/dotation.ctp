<div class="">
<?php echo $this->Form->create('Dotation',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-4" for="DotationMaterielinformatiquesId">Poste informatique : </label>
        <div class="col-md-4">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->input('materielinformatiques_id',array('type'=>'hidden','value'=>$this->data['Dotation']['materielinformatiques_id'])); ?>
                <?php echo h($dotation['Materielinformatique']['NOM']); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('materielinformatiques_id',$matinformatique,array('selected' => '','class'=>'form-control','empty' => 'Choisir un poste informatique')); ?>
            <?php } ?>
        </div>
    <?php if (userAuth('profil_id')<6) : ?>
    </div>
    <div class="form-group">
        <label class="col-md-4" for="DotationTypematerielId">ou Périphérique : </label>
        <div class="col-md-4">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->input('typemateriel_id',array('type'=>'hidden','value'=>$this->data['Dotation']['typemateriel_id'])); ?>
                <?php echo h($dotation['Typemateriel']['NOM']); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('typemateriel_id',$matautre,array('selected' => '','class'=>'form-control','empty' => 'Choisir un périphérique')); ?>
            <?php } ?>
        </div>
    <?php endif; ?>
    </div> 
    <div class="form-group">
        <label class="col-md-4" for="DotationDATERECEPTION">Date de remise du matériel : </label>
        <div class="col-md-3" style="margin-left:14px;">
            <div class="input-group">
            <?php $today = new dateTime(); ?>
            <?php echo $this->Form->input('DATERECEPTION',array('type'=>'text','class'=>"form-control dateall",'placeholder'=>'ex.: '.$today->format('d/m/Y'),'required'=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#DotationDATERECEPTION"><span class="glyphicons circle_remove grey"></span></span>
            <span class="input-group-addon date-addon-calendar btn-addon" data-target="#DotationDATERECEPTION"><span class="glyphicons calendar"></span></span>
            </div>              
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4" for="DotationDATEREMISE">Date de retour du matériel : </label>
        <div class="col-md-3" style="margin-left:14px;">
            <div class="input-group">
            <?php $today = new dateTime(); ?>
            <?php echo $this->Form->input('DATEREMISE',array('type'=>'text','class'=>"form-control dateall",'placeholder'=>'ex.: '.$today->format('d/m/Y'),'required'=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#DotationDATEREMISE"><span class="glyphicons circle_remove grey"></span></span>
            <span class="input-group-addon date-addon-calendar btn-addon" data-target="#DotationDATEREMISE"><span class="glyphicons calendar"></span></span>
            </div>                
        </div>
    </div>    
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>  
<?php $utilisateurId = $this->params->action == 'edit' ? $this->params->pass[1] : $this->params->pass[0]; ?>    
<?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>$utilisateurId)); ?>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>
<?php echo $this->Form->end(); ?>
</div>