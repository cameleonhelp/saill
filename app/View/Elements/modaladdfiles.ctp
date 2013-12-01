<?php $modaltitle = "Ajout de fichier"; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modaladdfiles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content repetitionH">
            <!-- contenu de la fenêtre modale //-->
            <?php echo $this->Form->create('Fileshared',array('action'=>'shared','id'=>'formValidate','class'=>'form-horizontal','type' => 'file','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                <div class="form-group">   
                    <label class="col-lg-4 control-label" for="FilesharedFile">Fichiers à partager : </label>
                    <div class="col-lg-offset-4">
                        <?php echo $this->Form->input('file', array('type' => 'file','size'=>"40",'class'=>'pull-left margintop5')); ?><label for="FilesharedFile" class="pull-left margintop7 italic"><?php echo 'taille max de '.ini_get('upload_max_filesize'); ?></label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-4 control-label" for="FilesharedWith">Avec : </label>
                    <div class="inline_labels margintop5">
                        <?php $options = array('all' => ' Tous ', 'adm' => ' Administrateurs');
                        $attributes = array('legend' => false,'value'=>'all','class'=>'margintop5');
                        ?>
                        <?php echo $this->Form->radio('with', $options, $attributes); ?>
                    </div>
                </div>          
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodaladdfiles">Annuler</button><button type="submit" class="btn btn-sm btn-default" id="savemodaladdfiles">Enregistrer</button>
    </div>
    <?php echo $this->Form->end(); ?>          
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
  
    $(document).on('click','#closemodaladdfiles',function(e){

        $('#modaladdfiles').modal('toggle');
    });
    
    /*$(document).on('click','#savemodaladdfiles',function(e){

        $('#modaladdfiles').modal('toggle');
    });   */ 
});
</script>