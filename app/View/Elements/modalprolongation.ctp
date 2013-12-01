<?php $modaltitle = "Prolongation jusqu'au"; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modalprolongation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content">
            <!-- contenu de la fenêtre modale //-->
            <?php echo $this->Form->create('Utilisateur',array('controller'=>'utilisateurs','action'=>'prolonger','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                <div class="form-group">
                    <label class="col-lg-4  required" for="UtilisateurFINMISSION">Date de fin de mission : </label>
                    <div class="col-lg-6" style="margin-left:15px;">
                        <div class="input-group">
                        <?php $today = new dateTime(); ?>
                        <?php $addyear = $today->format('m')<11 ? 1 : 2; ?>
                        <?php echo $this->Form->input('FINMISSION',array('type'=>'text','class'=>"form-control dateall",'placeholder'=>'ex.: '.$today->format('d/m/Y'),'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                        <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#UtilisateurFINMISSION"><span class="glyphicons circle_remove grey"></span></span>
                        <span class="input-group-addon addon-middle date-addon-default btn-addon" data-target="#UtilisateurFINMISSION" data-default="<?php echo "05/01/".(date('Y')+$addyear); ?>"><span class="glyphicons clock"></span></span>
                        <span class="input-group-addon date-addon-calendar btn-addon" data-target="#UtilisateurFINMISSION"><span class="glyphicons calendar"></span></span>
                        </div>                    
                    </div>
                </div> 
                <?php echo $this->Form->input('ids',array('type'=>'hidden')); ?> 
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodalprolongation">Annuler</button><button type="submit" class="btn btn-sm btn-default" id="savemodalprolongation">Enregistrer</button>
    </div>
    <?php echo $this->Form->end(); ?>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
  
    $(document).on('click','#closemodalprolongation',function(e){
        $('#modalprolongation').modal('toggle');
    });   
});
</script>