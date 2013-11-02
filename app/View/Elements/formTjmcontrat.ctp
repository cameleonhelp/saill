<div class="marginright20">
<?php echo $this->Form->create('Tjmcontrat',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2 required" for="TjmcontratTJM">Montant du TJM contrat : </label>
        <div class='row'>
        <div class="col-lg-2">
            <?php echo $this->Form->input('TJM',array('class'=>'form-control','data-rule-required'=>'true','placeholder'=>'Montant du TJM contrat','data-msg-required'=>"Le montant du TJM contrat est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        <div> €/j</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 required" for="TjmcontratANNEE">Année d'application : </label>
        <div class="col-lg-2">
            <?php echo $this->Form->input('ANNEE',array('class'=>'form-control year-only','type'=>'text','data-rule-required'=>'true','placeholder'=>'Année d\'application','data-msg-required'=>"Le nom de l'achat'année d'application est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
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