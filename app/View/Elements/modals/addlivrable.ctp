<?php $modaltitle = "Ajouter des livrables"; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modaladdlivrable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content repetitionH">
            <!-- contenu de la fenêtre modale //-->
            <?php echo $this->Form->create('Actionslivrable',array('controller'=>"actionlivrables",'action'=>'add','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                <div class="form-group">
                    <label class="col-md-2" for="ActionslivrableLivrableId">Livrable : </label>
                    <div class="col-md-10">  
                        <?php echo $this->Form->select('livrable_id',$addlivrables,array('class'=>'form-control multiselect','multiple'=>'true','size'=>"10")); ?>
                    </div>
                </div>	
                <?php echo $this->Form->input('action_id',array('type'=>'hidden')); ?>             
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodaladdlivrable">Annuler</button><button type="submit" class="btn btn-sm btn-default" id="savemodaladdlivrable">Enregistrer</button>
    </div>
    <?php echo $this->Form->end(); ?> 
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
  
    $(document).on('click','#closemodaladdlivrable',function(e){
        $('#modaladdlivrable').modal('toggle');
    });    
});
</script>