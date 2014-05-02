<?php $modaltitle = "Dupliquer les doits de ..."; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modalduplicatefrom" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content">
            <!-- contenu de la fenêtre modale //-->
            <?php echo $this->Form->create('Utiliseoutil',array('action'=>'duplicatefrom','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
            <?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden')); ?>     
                <div class="form-group">
                    <label class="col-md-3" for="UtiliseoutilORIGINE">Utilisateur : </label>
                    <div class="col-md-8">
                            <?php echo $this->Form->select('ORIGINE',$utilisateurs,array('class'=>'form-control','empty' => 'Choisir un utilisateur')); ?>
                    </div>
                </div>
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodalduplicatefrom">Annuler</button><button type="submit" class="btn btn-sm btn-default showoverlay" id="savemodalduplicatefrom">Enregistrer</button>
    </div>
    <?php echo $this->Form->end(); ?> 
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
    $(document).on('click','#closemodalduplicatefrom',function(e){
        $('#modalduplicatefrom').modal('toggle');
    }); 
    
    $('#modalduplicatefrom').on('hide.bs.modal', function (e) {
        $('#modalduplicatefrom #UtiliseoutilORIGINE').find('option:not(:first)').remove();
    });      
});
</script>