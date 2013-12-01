<?php $modaltitle = "Ajout d'un nouveau budget"; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modalnewbudget" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content">
            <!-- contenu de la fenêtre modale //-->
            <?php echo $this->Form->create('Historybudget',array('controller'=>'historybudgets','action'=>'add','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                <div class="form-group">
                    <label class="col-lg-4  required" for="HistorybudgetANNE">Année : </label>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('ANNEE',array('class'=>'form-control','type'=>'text','data-rule-required'=>'true','placeholder'=>'Année du budget','data-msg-required'=>"L'année du budget est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4  required" for="HistorybudgetPREVU">Budget initial : </label>
                    <div class="row">
                        <div class="col-lg-4">
                        <?php echo $this->Form->input('PREVU',array('data-rule-required'=>'true','placeholder'=>'Budget initial','class'=>'budgetinit form-control','data-msg-required'=>"Le budget initial est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                        </div>
                        <div> k€</div>             
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4" for="HistorybudgetREVU">Budget revu : </label>
                    <div class="row">
                        <div class="col-lg-4">
                        <?php echo $this->Form->input('REVU',array('placeholder'=>'Budget revu = budget initial avant révision','class'=>'budgetrevu form-control','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                        </div>
                        <div> k€</div>                 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4" for="HistorybudgetACTIF">Budget actif : </label>
                    <div class="col-lg-4">
                        <?php echo $this->Form->input('ACTIF',array('class'=>'yesno','type'=>'checkbox')); ?>
                        &nbsp;<label for="HistorybudgetACTIF" class='labelAfter'></label>
                    </div>
                </div>    
                <?php echo $this->Form->input('activite_id',array('type'=>'hidden','value'=>$this->params->pass[0])); ?> 
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodalnewbudget" name="cancel">Annuler</button><button type="submit" class="btn btn-sm btn-default" id="savemodalnewbudget">Enregistrer</button>
    </div>
    <?php echo $this->Form->end(); ?>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
   $(document).on('click','#closemodalnewbudget',function(e){
         /*$('#HistorybudgetId').val('');
        //$('#closemodalnewbudget').find('#HistorybudgetId').remove();
        //$('.form-horizontal').remove('#HistorybudgetId');
        $('#HistorybudgetActiviteId').val('');
        $('#HistorybudgetANNEE').val('');
        $('#HistorybudgetPREVU').val('');
        $('#HistorybudgetREVU').val('');*/ 
        $('#modalnewbudget').modal('toggle');
    });  
});
</script>