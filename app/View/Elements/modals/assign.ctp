<?php $modaltitle = "Affecter le matériel à ..."; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modalassign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content">
            <!-- contenu de la fenêtre modale //-->
       
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodalassign">Annuler</button><button type="submit" class="btn btn-sm btn-default" id="savemodalassign">Enregistrer</button>
    </div>
    <?php echo $this->Form->end(); ?>          
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
    $(document).on('click','#closemodalassign',function(e){
        $('#modalassign').modal('hide');
    });
});
</script>