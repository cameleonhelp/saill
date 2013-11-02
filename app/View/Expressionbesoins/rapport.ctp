<div class="marginright20">
<div class="actions form">
<?php echo $this->Form->create('Plancharge',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class='block-panel block-panel-50-left'>
        <div class="form-group">
            <label class="col-lg-4 required" for="PlanchargeLotId">Lots : </label>
            <div class="col-lg-4">
                    <?php echo $this->Form->select('lot_id',$lots,array('data-rule-required'=>'true','data-msg-required'=>"Le lot est obligatoire",'class'=>"form-control",'empty'=>'Choisir un lot...')); ?>                          
            </div>            
        </div>    
    </div>
    <div class='block-panel block-panel-50-right'>
        <div class="form-group">
            <label class="col-lg-4 required" for="PlanchargeEtatId">Etat : </label>
            <div class="col-lg-4">
                    <?php echo $this->Form->select('etat_id',$etats,array('data-rule-required'=>'true','data-msg-required'=>"L'état est obligatoire",'class'=>"form-control",'empty'=>'Choisir un état...')); ?>                          
            </div>            
        </div>   
    </div>
    <div style="clear:both;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Calculer le rapport', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>   
      </div>
    </div>  
    </div> 
<?php echo $this->Form->end(); ?>     
</div>
<!-- rapport avec le graphique et le tableau -->
</div>
<script>

</script>