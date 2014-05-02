<?php $modaltitle = "Ajouter une dotation de matériel"; ?>
<!--modal hebdomadaire//-->
<div class="modal fade" id="modaladddotation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content">
            <!-- contenu de la fenêtre modale //-->
            <?php echo $this->Form->create('Dotation',array('action'=>'addto','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                 <div class="form-group">
                    <label class="col-md-3" for="DotationMaterielinformatiquesId">Poste informatique : </label>
                    <div class="col-md-8">
                            <?php echo $this->Form->select('materielinformatiques_id',$matinformatique,array('selected' => '','class'=>'form-control','empty' => 'Choisir un poste informatique')); ?>
                    </div>
                </div>
                <?php if (userAuth('profil_id')<6) : ?>
                <div class="form-group">
                    <label class="col-md-3" for="DotationTypematerielId">ou Périphérique : </label>
                    <div class="col-md-8">
                            <?php echo $this->Form->select('typemateriel_id',$matautre,array('selected' => '','class'=>'form-control','empty' => 'Choisir un périphérique')); ?>
                    </div>
                </div>
                <?php endif; ?>  
                <div class="form-group">
                    <label class="col-md-3" for="DotationDATERECEPTION">Date de remise du matériel : </label>
                    <div class="col-md-8" style="margin-left:14px;">
                        <div class="input-group">
                        <?php $today = new dateTime(); ?>
                        <?php echo $this->Form->input('DATERECEPTION',array('type'=>'text','class'=>"form-control dateall",'placeholder'=>'ex.: '.$today->format('d/m/Y'),'required'=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                        <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#DotationDATERECEPTION"><span class="glyphicons circle_remove grey"></span></span>
                        <span class="input-group-addon date-addon-calendar btn-addon" data-target="#DotationDATERECEPTION"><span class="glyphicons calendar"></span></span>
                        </div>              
                    </div>
                </div>   
                <div class="form-group">
                    <?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden')); ?>
                    <label class="col-md-3" for="DotationDATEREMISE">Date de retour du matériel : </label>
                    <div class="col-md-8" style="margin-left:14px;">
                        <div class="input-group">
                        <?php $today = new dateTime(); ?>
                        <?php echo $this->Form->input('DATEREMISE',array('type'=>'text','class'=>"form-control dateall",'placeholder'=>'ex.: '.$today->format('d/m/Y'),'required'=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                        <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#DotationDATEREMISE"><span class="glyphicons circle_remove grey"></span></span>
                        <span class="input-group-addon date-addon-calendar btn-addon" data-target="#DotationDATEREMISE"><span class="glyphicons calendar"></span></span>
                        </div>                
                    </div>
                </div> 
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodaladddotation">Annuler</button><button type="submit" class="btn btn-sm btn-default showoverlay" id="savemodaladddotation">Enregistrer</button>
    </div>
    <?php echo $this->Form->end(); ?> 
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 
<script>
$(document).ready(function () {
  
    $(document).on('click','#closemodaladddotation',function(e){
        $('#modaladddotation').modal('toggle');
    }); 
    
    $(document).on('click','.adddotation',function(e){
        var userid = $(this).attr('data-userid');
        $('#modaladddotation #DotationUtilisateurId').val(userid);
    }); 
    
});
</script>