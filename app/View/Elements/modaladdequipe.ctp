<?php $modaltitle = "Ajouter un agent à mon équipe"; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modaladdequipe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content repetitionH">
            <!-- contenu de la fenêtre modale //-->
            <?php echo $this->Form->create('Equipe',array('controller'=>"equipes",'action'=>'add','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                <div class="form-group">
                    <label class="col-lg-4 required" for="EquipeAgent">Agent à ajouter : </label>
                    <div class="col-lg-8">  	
                        <?php echo $this->Form->select('agents',$utilisateurs,array('data-rule-required'=>'true','multiple'=>'true','class'=>"form-control multiselect size75",'data-msg-required'=>'Le nom de l\'agent est obligatoire','size'=>"10")); ?>
                    </div>
                </div>
                <?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>  userAuth('id'))); ?>              
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodaladdequipe">Annuler</button><button type="submit" class="btn btn-sm btn-default" id="savemodaladdequipe">Enregistrer</button>
    </div>
    <?php echo $this->Form->end(); ?> 
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
  
    $(document).on('click','#closemodaladdequipe',function(e){
        $('#modaladdequipe').modal('toggle');
    });    
});
</script>