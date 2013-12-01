<?php $modaltitle = "Ajouter une version de SAILL"; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modaladdchangelogversion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <?php echo $this->Form->create('Changelogversion',array('controller'=>'changelogversions','action'=>'add','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
        <div class="block-content repetitionH">
            <!-- contenu de la fenêtre modale //-->
                    <div class="form-group">
                          <label class="col-lg-4" for="ChangelogversionVERSION">Nom : </label>
                          <div class="col-lg-7">  
                            <?php echo $this->Form->input('VERSION',array('type'=>'text','placeholder'=> "1.0.0.001","class"=>"changelogversion form-control")); ?>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-lg-4" for="ChangelogversionDATEPREVUE">Date prévue : </label>
                        <div  class="col-lg-5">
                          <div class="input-group" style="margin-left: 0px;">
                          <?php $today = new dateTime(); ?>
                          <?php echo $this->Form->input('DATEPREVUE',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'class'=>"form-control dateall",'value'=>'')); ?>
                          <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ChangelogversionDATEPREVUE"><span class="glyphicons calendar"></span></span>
                          </div>         
                        </div>
                    </div>              
                    <?php echo $this->Form->input('ETAT',array('type'=>'hidden','value'=> 0)); ?> 
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodaladdchangelogversion">Annuler</button><button type="submit" class="btn btn-sm btn-default" id="savemodaladdchangelogversion">Enregistrer</button>
    </div>
    <?php echo $this->Form->end(); ?>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
  
    $(document).on('click','#closemodaladdchangelogversion',function(e){

        $('#modaladdchangelogversion').modal('toggle');
    });
    
    $(document).on('click','#savemodaladdchangelogversion',function(e){

        $('#modaladdchangelogversion').modal('toggle');
    });    
});
</script>