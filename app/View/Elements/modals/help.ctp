<?php $modaltitle = "Aide"; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modalhelp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#BCE8F1;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content">
            <!-- contenu de la fenêtre modale //-->
            <?php echo $helpcontent; ?>              
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer" style="background-color:#BCE8F1;">
      <button type="button" class="btn btn-sm btn-default" id="closemodalhelp">Ok</button>
    </div>
    <?php echo $this->Form->end(); ?> 
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
  
    $(document).on('click','#closemodalhelp',function(e){
        $('#modalhelp').modal('toggle');
    });    
});
</script>