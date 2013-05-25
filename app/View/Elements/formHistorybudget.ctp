<?php echo $this->Form->create('Historybudget',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre  required" for="HistorybudgetANNE">Année : </label>
        <div class="controls">
            <?php echo $this->Form->input('ANNEE',array('type'=>'text','data-rule-required'=>'true','placeholder'=>'Année du budget','class'=>'span3','data-msg-required'=>"L'année du budget est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre  required" for="HistorybudgetPREVU">Budget initial : </label>
        <div class="controls">
            <?php echo $this->Form->input('PREVU',array('data-rule-required'=>'true','placeholder'=>'Budget initial','class'=>'span5 budgetinit','data-msg-required'=>"Le budget initial est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>&nbsp;k€
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="HistorybudgetREVU">Budget revu : </label>
        <div class="controls">
            <?php echo $this->Form->input('REVU',array('placeholder'=>'Budget revu = budget initial avant révision','class'=>'span5 budgetrevu','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>&nbsp;k€
        </div>
    </div>
    <div class="control-group">
        <label class="control-label sstitre" for="HistorybudgetACTIF">Budget actif : </label>
        <div class="controls">
            <?php echo $this->Form->input('ACTIF',array('type'=>'checkbox')); ?>
        </div>
    </div> 
    
    <?php if($this->params->action=='edit') {echo $this->Form->input('activite_id',array('type'=>'hidden'));}?>
    <?php if($this->params->action=='add') {echo $this->Form->input('activite_id',array('type'=>'hidden','value'=>$this->params->pass[0]));}?>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".goPrev()."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
            </div>
        </div>
    </div>  
<?php echo $this->Form->end(); ?>
<script>
$(document).ready(function(){
   $(document).on('change','.budgetinit',function(e){
        e.preventDefault;
        $('.budgetrevu').val($(this).val());
    });    
});
</script>