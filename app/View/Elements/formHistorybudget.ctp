<div class="marginright20">
<?php echo $this->Form->create('Historybudget',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2  required" for="HistorybudgetANNE">Année : </label>
        <div class="col-lg-4">
            <?php echo $this->Form->input('ANNEE',array('class'=>'form-control','type'=>'text','data-rule-required'=>'true','placeholder'=>'Année du budget','data-msg-required'=>"L'année du budget est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2  required" for="HistorybudgetPREVU">Budget initial : </label>
        <div class="row">
            <div class="col-lg-2">
            <?php echo $this->Form->input('PREVU',array('data-rule-required'=>'true','placeholder'=>'Budget initial','class'=>'budgetinit form-control','data-msg-required'=>"Le budget initial est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            </div>
            <div> k€</div>             
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="HistorybudgetREVU">Budget revu : </label>
        <div class="row">
            <div class="col-lg-2">
            <?php echo $this->Form->input('REVU',array('placeholder'=>'Budget revu = budget initial avant révision','class'=>'budgetrevu form-control','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            </div>
            <div> k€</div>                 
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="HistorybudgetACTIF">Budget actif : </label>
        <div class="col-lg-4">
            <?php echo $this->Form->input('ACTIF',array('class'=>'yesno','type'=>'checkbox')); ?>
            &nbsp;<label for="HistorybudgetACTIF" class='labelAfter'></label>
        </div>
    </div> 
    
    <?php if($this->params->action=='edit') {echo $this->Form->input('activite_id',array('type'=>'hidden'));}?>
    <?php if($this->params->action=='add') {echo $this->Form->input('activite_id',array('type'=>'hidden','value'=>$this->params->pass[0]));}?>
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>
<?php echo $this->Form->end(); ?>
</div>
<script>
$(document).ready(function(){
   $(document).on('change','.budgetinit',function(e){
        e.preventDefault;
        $('.budgetrevu').val($(this).val());
    });    
});
</script>