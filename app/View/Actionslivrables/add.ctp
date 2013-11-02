<div class="marginright20">
<div class="actionslivrables form">
<?php echo $this->Form->create('Actionslivrable',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2 required" for="ActionslivrableLivrableId">Livrable : </label>
        <div class="col-lg-10">  
            <?php echo $this->Form->select('livrable_id',$livrables,array('default' => userAuth('id'),'class'=>'form-control multiselect','empty' => 'Choisir un livrable','data-rule-required'=>'true','data-msg-required'=>"Le livrable est obligatoire",'multiple'=>'true','size'=>"10")); ?>
        </div>
    </div>	
    <?php echo $this->Form->input('action_id',array('type'=>'hidden','value'=>$this->params->pass[0])); ?>
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>     
<?php echo $this->Form->end(); ?>
</div>
</div>