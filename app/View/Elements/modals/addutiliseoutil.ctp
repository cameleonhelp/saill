<?php $modaltitle = "Ajouter une ouverture de droit"; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modaladdutiliseoutil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content">
            <!-- contenu de la fenêtre modale //-->
            <?php echo $this->Form->create('Utiliseoutil',array('action'=>'addto','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
            <?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden')); ?>     
            <div class="form-group">
                <label class="col-md-3" for="UtiliseoutilOutilId">Outil : </label>
                <div class="col-md-8">
                        <?php echo $this->Form->select('outil_id',$outils,array('class'=>'form-control','empty' => 'Choisir un outil')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3" for="UtiliseoutilListediffusionId">Liste de diffusion : </label>
                <div class="col-md-8">
                        <?php echo $this->Form->select('listediffusion_id',$listediffusions,array('class'=>'form-control','empty' => 'Choisir une liste de diffusion')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3" for="UtiliseoutilDossierpartageId">Partage réseau : </label>
                <div class="col-md-8">
                        <?php echo $this->Form->select('dossierpartage_id',$partages,array('class'=>'form-control','empty' => 'Choisir un partage réseau')); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3" for="UtiliseoutilSTATUT">Etat : </label>
                <div class="col-md-8">
                        <?php echo $this->Form->select('STATUT',$etats,array('class'=>'form-control','empty' => 'Choisir un état')); ?>
                </div>
            </div>
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodaladdutiliseoutil">Annuler</button><button type="submit" class="btn btn-sm btn-default showoverlay" id="savemodaladdutiliseoutil">Enregistrer</button>
    </div>
    <?php echo $this->Form->end(); ?> 
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
    $(document).on('click','#closemodaladdutiliseoutil',function(e){
        $('#modaladdutiliseoutil').modal('toggle');
    });  
    
    $('#modaladdutiliseoutil').on('hide.bs.modal', function (e) {
        $('#modaladdutiliseoutil #UtiliseoutilOutilId').find('option:not(:first)').remove();
        $('#modaladdutiliseoutil #UtiliseoutilListediffusionId').find('option:not(:first)').remove();
        $('#modaladdutiliseoutil #UtiliseoutilDossierpartageId').find('option:not(:first)').remove();     
    });      
});
</script>