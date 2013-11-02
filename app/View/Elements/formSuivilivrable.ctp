<?php echo $this->Form->create('Suivilivrable',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-4 control-label" for="SuivilivrableECHEANCE">Echéance de livraison : </label>
        <div class="col-lg-offset-4 form-control">
            <div class="input-append date" data-date="<?php echo empty($this->data['Suivilivrable']['ECHEANCE']) ? date('d/m/Y') : $this->data['Suivilivrable']['ECHEANCE']; ?>" data-date-format="dd/mm/yyyy">
            <?php $today = date('d/m/Y'); ?>
            <?php echo $this->Form->input('ECHEANCE',array('type'=>'text','placeholder'=>'ex.: '.$today,"readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><span class="glyphicons remove grey"></span></button>
            <span class="add-on"><span class="glyphicons calendar"></span></span>
            </div>
        </div>
    </div>   
    <div class="form-group">
        <label class="col-lg-4 control-label" for="SuivilivrableDATELIVRAISON">Date de livraison : </label>
        <div class="col-lg-offset-4 form-control">
            <div class="input-append date" data-date="<?php echo empty($this->data['Suivilivrable']['DATELIVRAISON']) ? date('d/m/Y') : $this->data['Suivilivrable']['DATELIVRAISON']; ?>" data-date-format="dd/mm/yyyy">
            <?php $today = date('d/m/Y'); ?>
            <?php echo $this->Form->input('DATELIVRAISON',array('type'=>'text','placeholder'=>'ex.: '.$today,"readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><span class="glyphicons remove grey"></span></button>
            <span class="add-on"><span class="glyphicons calendar"></span></span>
            </div>
        </div>
    </div>   
    <div class="form-group">
        <label class="col-lg-4 control-label" for="SuivilivrableDATEVALIDATION">Date de validation : </label>
        <div class="col-lg-offset-4 form-control">
            <div class="input-append date" data-date="<?php echo empty($this->data['Suivilivrable']['DATEVALIDATION']) ? date('d/m/Y') : $this->data['Suivilivrable']['DATEVALIDATION']; ?>" data-date-format="dd/mm/yyyy">
            <?php $today = date('d/m/Y'); ?>
            <?php echo $this->Form->input('DATEVALIDATION',array('type'=>'text','placeholder'=>'ex.: '.$today,"readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><span class="glyphicons remove grey"></span></button>
            <span class="add-on"><span class="glyphicons calendar"></span></span>
            </div>
        </div>
    </div>   	
    <div class="form-group">
        <label class="col-lg-4 control-label" for="SuivilivrableETAT">Poste informatique : </label>
        <div class="col-lg-offset-4 form-control">
                <?php echo $this->Form->select('ETAT',$etats,array('selected' => '','empty' => 'Choisir un état')); ?>
        </div>
    </div>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn btn-sm showoverlay','onclick'=>"location.href='".goPrev()."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
            </div>
        </div>
    </div> 
<?php $livrableId = $this->params->action == 'edit' ? $this->params->pass[1] : $this->params->pass[0]; ?>    
<?php echo $this->Form->input('livrable_id',array('type'=>'hidden','value'=>$livrableId)); ?>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>
<?php echo $this->Form->end(); ?>