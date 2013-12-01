<?php $modaltitle = "Modifier la date prévue de livraison"; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modaleditchangelogversion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $this->Form->create('Changelogversion',array('controller'=>'changelogversions','action'=>'edit','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
        <div class="block-content">
            <!-- contenu de la fenêtre modale //-->
                    <div class="form-group">
                        <label class="col-lg-4" for="ChangelogversionDATE">Date prévue : </label>
                        <div  class="col-lg-5">
                          <div class="input-group" style="margin-left: 0px;">
                          <?php $today = new dateTime(); ?>
                          <?php echo $this->Form->input('DATE',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'class'=>"form-control dateall",'value'=>'')); ?>
                              <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ChangelogversionDATE"><span class="glyphicons circle_remove grey"></span></span>
                          <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ChangelogversionDATE"><span class="glyphicons calendar"></span></span>
                          </div>         
                        </div>
                    </div>              
                    <?php echo $this->Form->input('id',array('type'=>'hidden')); ?> 
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodaleditchangelogversion">Annuler</button><button type="submit" class="btn btn-sm btn-default" id="savemodaleditchangelogversion">Enregistrer</button>
    </div>
    <?php echo $this->Form->end(); ?>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
  
    $(document).on('click','#closemodaleditchangelogversion',function(e){

        $('#modaleditchangelogversion').modal('toggle');
    });
    
    $(document).on('click','#savemodaleditchangelogversion',function(e){

        $('#modaleditchangelogversion').modal('toggle');
    });    
});
</script>