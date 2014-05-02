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
            <?php echo $this->Form->create('Materielinformatique',array('action'=>'assignto','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
            <div class="form-group">
                <label class="col-md-3" for="MaterielinformatiqueUtilisateurId">Utilisateur : </label>
                <div class="col-md-8">
                        <?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
                        <?php echo $this->Form->select('utilisateur_id',$utilisateurs,array('class'=>'form-control','empty' => 'Choisir un utilisateur')); ?>
                </div>
            </div>
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
    
    $(document).on('click','.user_add',function(e){
        var idmat = $(this).attr('data-idmat');
        var iduser = $(this).attr('data-iduser');
        $('#modalassign #MaterielinformatiqueId').val(idmat);
        $('#modalassign #MaterielinformatiqueUtilisateurId option[value="'+iduser+'"]').attr('selected', 'selected');
    });
 
});
</script>