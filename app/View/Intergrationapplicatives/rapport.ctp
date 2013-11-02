<div class="marginright20">
<div class="actions form">
<?php echo $this->Form->create('Plancharge',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class='block-panel block-panel-50-left'>
        <div class="form-group">
            <label class="col-lg-4 required" for="PlanchargeApplicationId">Applications : </label>
            <div class="col-lg-offset-4">
                    <?php echo $this->Form->select('application_id',$applications,array('data-rule-required'=>'true','multiple'=>'true','size'=>"10",'class'=>"form-control multiselect size75",'data-msg-required'=>"L'application est obligatoire")); ?>               
                <br><?php echo $this->Form->input('SelectAllDomaine',array('type'=>'checkbox')); ?><label class="labelAfter" for="PlanchargeSelectAllDomaine">&nbsp;Tout sélectionner</label>            
            </div>            
        </div>  
    </div>
    <div class='block-panel block-panel-50-right'>
        <div class="form-group">
            <label class="col-lg-4 required" for="RapportMois">Mois :</label>
            <div class="col-lg-4">
                    <?php echo $this->Form->select('mois',$mois,array('default'=>date('m'),'class'=>"form-control",'empty'=>false)); ?>           
            </div>            
        </div>
        <div class="form-group">
            <label class="col-lg-4 required" for="RapportAnnee">Année : </label>
            <div class="col-lg-4">
                    <?php echo $this->Form->select('annee',$annee,array('default'=>date('Y'),'class'=>"form-control",'empty'=>false)); ?>           
            </div>            
        </div>
        <div class="form-group">
            <label class="col-lg-4" for="PlanchargeEnvironnementId">Environnements : </label>
            <div class="col-lg-4">
                    <?php echo $this->Form->select('environnement_id',$environnements,array('class'=>"form-control",'empty'=>'Tous')); ?>                          
            </div>            
        </div>         
        <div class="form-group">
            <label class="col-lg-4" for="PlanchargeLotId">Lots : </label>
            <div class="col-lg-4">
                    <?php echo $this->Form->select('lot_id',$lots,array('class'=>"form-control",'empty'=>'Tous')); ?>                          
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