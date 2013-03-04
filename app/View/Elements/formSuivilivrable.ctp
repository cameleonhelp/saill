<?php echo $this->Form->create('Suivilivrable',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre" for="SuivilivrableECHEANCE">Echéance de livraison : </label>
        <div class="controls">
            <div class="input-append date" data-date="<?php echo empty($this->data['Suivilivrable']['ECHEANCE']) ? date('d/m/Y') : $this->data['Suivilivrable']['ECHEANCE']; ?>" data-date-format="dd/mm/yyyy">
            <?php $today = date('d/m/Y'); ?>
            <?php echo $this->Form->input('ECHEANCE',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
            <span class="add-on"><i class="glyphicon_calendar"></i></span>
            </div>
        </div>
    </div>   
    <div class="control-group">
        <label class="control-label sstitre" for="SuivilivrableDATELIVRAISON">Date de livraison : </label>
        <div class="controls">
            <div class="input-append date" data-date="<?php echo empty($this->data['Suivilivrable']['DATELIVRAISON']) ? date('d/m/Y') : $this->data['Suivilivrable']['DATELIVRAISON']; ?>" data-date-format="dd/mm/yyyy">
            <?php $today = date('d/m/Y'); ?>
            <?php echo $this->Form->input('DATELIVRAISON',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
            <span class="add-on"><i class="glyphicon_calendar"></i></span>
            </div>
        </div>
    </div>   
    <div class="control-group">
        <label class="control-label sstitre" for="SuivilivrableDATEVALIDATION">Date de validation : </label>
        <div class="controls">
            <div class="input-append date" data-date="<?php echo empty($this->data['Suivilivrable']['DATEVALIDATION']) ? date('d/m/Y') : $this->data['Suivilivrable']['DATEVALIDATION']; ?>" data-date-format="dd/mm/yyyy">
            <?php $today = date('d/m/Y'); ?>
            <?php echo $this->Form->input('DATEVALIDATION',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
            <span class="add-on"><i class="glyphicon_calendar"></i></span>
            </div>
        </div>
    </div>   	
    <div class="control-group">
        <label class="control-label sstitre" for="SuivilivrableETAT">Poste informatique : </label>
        <div class="controls">
                <?php echo $this->Form->select('ETAT',$etats,array('selected' => '','empty' => 'Choisir un état')); ?>
        </div>
    </div>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php $url = $this->Session->read('history'); ?>
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url($url[1])."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
            </div>
        </div>
    </div> 
<?php $livrableId = $this->params->action == 'edit' ? $this->params->pass[1] : $this->params->pass[0]; ?>    
<?php echo $this->Form->input('livrable_id',array('type'=>'hidden','value'=>$livrableId)); ?>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>
<?php echo $this->Form->end(); ?>