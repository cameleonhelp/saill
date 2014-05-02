<div class="">
<?php echo $this->Form->create('Intergrationapplicative',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-2 required" for="IntergrationapplicativeApplicationId">Application : </label>
        <div class="col-md-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('application_id',$applications,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'application est obligatoire", 'selected' => $this->data['Intergrationapplicative']['application_id'],'empty' => 'Choisir une application')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('application_id',$applications,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'application est obligatoire", 'empty' => 'Choisir une application')); ?>
            <?php } ?>        
        </div>        
    </div>
    <div class="form-group">
        <label class="col-md-2 required" for="IntergrationapplicativeTypeId">Type d'environnement : </label>
        <div class="col-md-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('type_id',$types,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le type d'environnement est obligatoire", 'selected' => $this->data['Intergrationapplicative']['type_id'],'empty' => 'Choisir un type d\'environnement')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('type_id',$types,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le type d'environnement est obligatoire", 'empty' => 'Choisir un type d\'environnement')); ?>
            <?php } ?>        
        </div>        
    </div>
    <div class="form-group">
        <label class="col-md-2 required" for="IntergrationapplicativeLotId">Lot : </label>
        <div class="col-md-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('lot_id',$lots,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le lot est obligatoire", 'selected' => $this->data['Intergrationapplicative']['lot_id'],'empty' => 'Choisir un lot')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('lot_id',$lots,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le lot est obligatoire", 'empty' => 'Choisir un lot')); ?>
            <?php } ?>        
        </div>        
    </div>    
    <div class="form-group">
        <label class="col-md-2 required" for="IntergrationapplicativeVersionId">Version : </label>
        <div class="col-md-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('version_id',$versions,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"La version est obligatoire", 'selected' => $this->data['Intergrationapplicative']['version_id'],'empty' => 'Choisir une version')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('version_id',$versions,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"La version est obligatoire", 'empty' => 'Choisir une version')); ?>
            <?php } ?>        
        </div>        
    </div> 
    <div class="form-group">
        <label class="col-md-2" for="IntergrationapplicativeDATEINSTALL">Date d'installation : </label>
          <div class="col-md-3" style="margin-left:15px;">
              <div class="input-group">
              <?php $today = new dateTime(); ?>
              <?php echo $this->Form->input('DATEINSTALL',array('type'=>'text','class'=>"form-control dateall",'placeholder'=>'ex.: '.$today->format('d/m/Y'),'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
              <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#IntergrationapplicativeDATEINSTALL"><span class="glyphicons circle_remove grey"></span></span>
              <span class="input-group-addon addon-middle date-addon-default btn-addon" data-target="#IntergrationapplicativeDATEINSTALL" data-default="<?php echo date('d/m/Y'); ?>"><span class="glyphicons clock"></span></span>
              <span class="input-group-addon date-addon-calendar btn-addon" data-target="#IntergrationapplicativeDATEINSTALL"><span class="glyphicons calendar"></span></span>
              </div>                    
          </div>
    </div>     
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>     
<?php echo $this->Form->end(); ?>
    <?php if ($this->params->action == 'edit') : ?> 
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#panel_apps" href="#panel_historique">
            Historique
          </a>
        </h3>
      </div>
      <div id="panel_historique" class="panel-collapse collapse">
        <div class="panel-body">
          <?php echo $this->element('tableHistoryIntegration'); ?>
        </div>
      </div>
    </div>    
    <?php endif; ?> 
</div>    
<script>
$(document).ready(function () {
    $(document).on('change','#IntergrationapplicativeLotId',function(e){
        //var nom = $("#IntergrationapplicativeLotId option:selected").text();
        var id = $("#IntergrationapplicativeLotId option:selected").val();
        $("#IntergrationapplicativeVersionId").find('option:not(:first)').remove();
        if(id!=''){
            $.ajax({
                type: "POST",       
                url: "<?php echo $this->Html->url(array('controller'=>'versions','action'=>'json_get_version_for')); ?>/"+id+"/1", 
                contentType: "application/json",
                success : function(response) {
                    var json = $.parseJSON(response);
                    if(json.length>0) {
                        var options = $("#IntergrationapplicativeVersionId");
                        $.each(json, function () {
                            options.append($("<option />").val(this['Version']['id']).text(this['Version']['NOM']));
                        });
                    }
                },
                error :function(response, status,errorThrown) {
                    alert("Erreur! Impossible de mettre à jour les informations\n\rActualiser la page et recommencer.");
                }
             });                
         }
    });         
});
</script>