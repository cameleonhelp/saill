<?php $modaltitle = "Modifier l'affectation"; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modaleditaffectation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content">
            <!-- contenu de la fenêtre modale //-->
            <?php echo $this->Form->create('Affectation',array('action'=>'editto','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
            <?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden')); ?>    
            <?php echo $this->Form->input('id',array('type'=>'hidden')); ?>    
            <div class="form-group">
                    <label class="col-md-3 control-label" for="AffectationActiviteId">Activité : </label>
                    <div class="col-md-8">
                        <select name="data[Affectation][activite_id]" id="AffectationActiviteId" class="form-control"> 
                            <option value="">Choisir une activité</option>
                            <?php foreach ($activites as $activite) : ?>
                                <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?> data-subtext=" <?php echo $activite['Projet']['NOM']; ?>"><?php echo $activite['Activite']['NOM']; ?></option>
                            <?php endforeach; ?>
                        </select> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="AffectationREPARTITION">Clé de répartition : </label>
                    <div class="row">
                        <div class="col-md-4"><?php echo $this->Form->input('REPARTITION',array('step' => '5','class'=>'form-control')); ?></div>
                        <div> %</div>
                    </div>
                </div>

            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodaleditaffectation">Annuler</button><button type="submit" class="btn btn-sm btn-default showoverlay" id="savemodaleditaffectation">Enregistrer</button>
    </div>
    <?php echo $this->Form->end(); ?> 
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
  
    $(document).on('click','#closemodaleditaffectation',function(e){
        $('#modaleditaffectation').modal('toggle');
    });        
});
</script>