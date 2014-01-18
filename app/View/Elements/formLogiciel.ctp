<div class="marginright20">
<?php echo $this->Form->create('Logiciel',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2 required" for="LogicielNOMDISABLED">Nom : </label>
        <div class="col-lg-5">
             <?php $value = $this->params->action == 'edit' ? $this->data['Logiciel']['NOM'] : ''; ?>
             <?php echo $this->Form->input('NOMDISABLED',array('type'=>'text','placeholder'=>'Nom de l\'outil et la version','readonly','class'=>'form-control','value'=>$value)); ?> 
             <?php echo $this->Form->input('NOM',array('type'=>'hidden','value'=>$value)); ?>
        </div>        
    </div>
    <div class="form-group">
        <label class="col-lg-2 required" for="LogicielEnvoutilId">Outil : </label>
        <div class="col-lg-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('envoutil_id',$outils,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'outil est obligatoire", 'selected' => $this->data['Logiciel']['envoutil_id'],'empty' => 'Choisir un outil')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('envoutil_id',$outils,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'outil est obligatoire", 'empty' => 'Choisir un outil')); ?>
            <?php } ?>        
        </div>        
    </div>
    <div class="form-group">
        <label class="col-lg-2 required" for="LogicielEnvversionId">Version : </label>
        <div class="col-lg-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('envversion_id',$versions,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"La version est obligatoire", 'selected' => $this->data['Logiciel']['envversion_id'],'empty' => 'Choisir une version')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('envversion_id',$versions,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"La version est obligatoire", 'empty' => 'Choisir une version')); ?>
            <?php } ?>        
        </div>        
    </div>    
    <div class="form-group">
        <label class="col-lg-2 required" for="LogicielApplicationId">Application : </label>
        <div class="col-lg-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo isset($this->data['Application']['NOM']) ? $this->data['Application']['NOM'] : ''; ?>
                <?php echo $this->Form->input('application_id',array('type'=>'hidden')); ?> 
            <?php } else { ?>
                <?php echo $this->Form->select('application_id',$applications,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'application est obligatoire", 'empty' => 'Choisir une application')); ?>
            <?php } ?>        
        </div>        
    </div>
    <!--<div class="form-group">
        <label class="col-lg-2 required" for="LogicielTypeId">Type d'environnement : </label>
        <div class="col-lg-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('type_id',$types,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le type d'environnement est obligatoire", 'selected' => $this->data['Logiciel']['type_id'],'empty' => 'Choisir un type d\'environnement')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('type_id',$types,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le type d'environnement est obligatoire", 'empty' => 'Choisir un type d\'environnement')); ?>
            <?php } ?>        
        </div>        
    </div>-->    
    <div class="form-group">
        <label class="col-lg-2 required" for="LogicielLotId">Lot : </label>
        <div class="col-lg-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo isset($this->data['Lot']['NOM']) ? $this->data['Lot']['NOM'] : ''; ?>
                <?php echo $this->Form->input('lot_id',array('type'=>'hidden')); ?> 
            <?php } else { ?>
                <?php echo $this->Form->select('lot_id',$lots,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le lot est obligatoire", 'empty' => 'Choisir un lot')); ?>
            <?php } ?>        
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
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#panel_apps" href="#panel_bien">
            Biens
            <span class="badge badge-default pull-right">Nb: <?php echo count($biens); ?></span>
          </a>
        </h3>
      </div>
      <div id="panel_bien" class="panel-collapse collapse in">
        <div class="panel-body">
          <?php if($this->data['Logiciel']['ACTIF']): ?> 
          <button type="button" class='btn btn-sm btn-default pull-right' style="margin-bottom:10px;" data-toggle="modal" data-target="#addModal">Ajouter à un bien existant</button> 
          <button type="button" class='btn btn-sm btn-default pull-right' style="margin-bottom:10px;margin-right: 10px;" data-toggle="modal" data-target="#updateModal">Migrer le logiciel de tous les biens</button>
          <?php endif; ?>
          <?php echo $this->element('tableBiens'); ?>
        </div>
      </div>
    </div>      
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
          <?php echo $this->element('tableHistoryLogiciel'); ?>
        </div>
      </div>
    </div>                    
    <?php endif; ?>    
</div>
<script>
$(document).ready(function () {
    $(document).on('change','#LogicielEnvoutilId',function(e){
        $('#LogicielNOM').val('');
        $('#LogicielNOMDISABLED').val('');
        var nom = $("#LogicielEnvoutilId option:selected").text();
        var id = $("#LogicielEnvoutilId option:selected").val();
        $("#LogicielEnvversionId").find('option:not(:first)').remove();
        if(id!=''){
            $.ajax({
                type: "POST",       
                url: "<?php echo $this->Html->url(array('controller'=>'envversions','action'=>'json_get_version_for')); ?>/"+id+"/1", 
                contentType: "application/json",
                success : function(response) {
                    var json = $.parseJSON(response);
                    if(json.length>0) {
                        var options = $("#LogicielEnvversionId");
                        $.each(json, function () {
                            var edition = "";
                            if (this['Envversion']['EDITION']!== '') {edition = " "+this['Envversion']['EDITION']; }
                            options.append($("<option />").val(this['Envversion']['id']).text(this['Envversion']['VERSION']+edition));
                        });
                    }
                },
                error :function(response, status,errorThrown) {
                    alert("Erreur! il se peut que votre session soit expirée\n\rActualiser la page et recommencer.");
                }
             });
            var version = $("#LogicielEnvversionId option:selected").text();         
            $('#LogicielNOM').val(nom+" "+version);
            $('#LogicielNOMDISABLED').val(nom+" "+version);         
         } else {
            $('#LogicielNOM').val('');
            $('#LogicielNOMDISABLED').val('');
         }
    });    
    
    $(document).on('change','#LogicielEnvversionId',function(e){
        var nom = $("#LogicielEnvoutilId option:selected").text();
        var version = $("#LogicielEnvversionId option:selected").text();
        $('#LogicielNOM').val(nom+" "+version);
        $('#LogicielNOMDISABLED').val(nom+" "+version);
    });      
});
</script>
<!--test modal //-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Ajout à un bien existant</h4>
      </div>
      <?php echo $this->Form->create('Assobienlogiciel',array('controller'=>'assobienlogiciels','action'=>'ajaxadd','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
      <div class="modal-body">
        <?php  echo $this->Form->input('logiciel_id',array('type'=>'hidden','value'=>$this->data['Logiciel']['id'])); ?>
        <div class="form-group">
              <label class="col-lg-4" for="AssobienlogicielLogicielId">Nom : </label>
              <div class="col-lg-7">
                  <?php echo $this->Form->select('bien_id',$listbiens,array('class'=>'form-control','empty' => 'Choisir un bien')); ?>                   
              </div>
        </div> 
        <div class="form-group">
            <label class="col-lg-4" for="AssobienlogicielENVDSIT">Nom environnement DSI-T : </label>      
            <div class="col-lg-7">
                <?php echo $this->Form->input('ENVDSIT',array('type'=>'text','placeholder'=>'Nom environnement DSI-T','class'=>'form-control')); ?>
            </div>         
        </div>  
        <div class="form-group">
            <label class="col-lg-4" for="AssobienlogicielINSTALL">Installé : </label>      
            <div class="col-lg-7">
                <?php echo $this->Form->input('INSTALL',array('class'=>'yesno')); ?>
                &nbsp;<label for="AssobienlogicielINSTALL" class='labelAfter'></label>
            </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Annuler</button>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
      <?php echo $this->Form->end(); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /test modal //-->
<!--test modal //-->
<?php if($this->params['action'] == 'edit'): ?>
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Ajout d'un logiciel existant</h4>
      </div>
      <?php echo $this->Form->create('Assobienlogiciel',array('controller'=>'assobienlogiciels','action'=>'ajaxupdate','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
      <div class="modal-body">
        <?php $list_id_biens= $this->requestAction('assobienlogiciels/get_id_for_outil/'.$this->data['Logiciel']['id']); ?>
        <?php  echo $this->Form->input('id',array('type'=>'hidden','value'=>$list_id_biens)); ?>
        <?php  echo $this->Form->input('old_logiciel_id',array('type'=>'hidden','value'=>$this->data['Logiciel']['id'])); ?>
        <div class="form-group">
              <label class="col-lg-4" for="AssobienlogicielLogicielId">Nom : </label>
              <div class="col-lg-7">
                  <?php echo $this->Form->select('logiciel_id',$listlogiciels,array('class'=>'form-control','empty' => 'Choisir un logiciel')); ?>                   
              </div>
        </div>  
        <!--<div class="form-group">
            <label class="col-lg-4" for="AssobienlogicielENVDSIT">Nom environnement DSI-T : </label>      
            <div class="col-lg-7">
                <?php echo $this->Form->input('ENVDSIT',array('type'=>'text','placeholder'=>'Nom environnement DSI-T','class'=>'form-control')); ?>
            </div>         
        </div>  
        <div class="form-group">
            <label class="col-lg-4" for="AssobienlogicielINSTALL">Installé : </label>      
            <div class="col-lg-7">
                <?php echo $this->Form->input('INSTALL',array('class'=>'yesno')); ?>
                &nbsp;<label for="AssobienlogicielINSTALL" class='labelAfter'></label>
            </div>
        </div> -->                   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Annuler</button>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
      <?php echo $this->Form->end(); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /test modal //-->
<?php endif; ?>