<?php $modaltitle = ""; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modalduplicateplancharge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content repetitionH">
            <!-- contenu de la fenêtre modale //-->
            
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodalduplicateplancharge">Annuler</button><button type="button" class="btn btn-sm btn-default" id="savemodalduplicateplancharge">Enregistrer</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
  
    $(document).on('click','#closemodalduplicateplancharge',function(e){

        $('#MoisModal').modal('toggle');
    });
    
    $(document).on('click','#savemodalduplicateplancharge',function(e){

        $('#MoisModal').modal('toggle');
    });    
});
</script>