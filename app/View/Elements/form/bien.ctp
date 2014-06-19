<div class="">
<?php echo $this->Form->create('Bien',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-md-2 required" for="BienNOM">Nom : </label>
        <div class="col-md-5">
            <?php echo $this->Form->input('NOM',array('type'=>'text','placeholder'=>'Nom','class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom est obligatoire")); ?>
        </div>
    </div>    
    <div class="form-group">
        <label class="col-md-2 required" for="BienApplicationId">Application : </label>
        <div class="col-md-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('application_id',$applications,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'application est obligatoire", 'selected' => $this->data['Bien']['application_id'],'empty' => 'Choisir une application')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('application_id',$applications,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'application est obligatoire", 'empty' => 'Choisir une application')); ?>
            <?php } ?>        
        </div>        
    </div>
    <div class="form-group">
        <label class="col-md-2 required" for="BienModeleId">Modèle : </label>
        <div class="col-md-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('modele_id',$modeles,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le modèle est obligatoire", 'selected' => $this->data['Bien']['modele_id'],'empty' => 'Choisir un modèle')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('modele_id',$modeles,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le modèle est obligatoire", 'empty' => 'Choisir un modèle')); ?>
            <?php } ?>        
        </div>        
    </div>    
    <div class="form-group">
        <label class="col-md-2 required" for="BienChassisId">Chassis : </label>
        <div class="col-md-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('chassis_id',$chassis,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le chassis est obligatoire", 'selected' => $this->data['Bien']['chassis_id'],'empty' => 'Choisir un chassis')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('chassis_id',$chassis,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le chassis est obligatoire", 'empty' => 'Choisir un chassis')); ?>
            <?php } ?>        
        </div>        
    </div>    
    <div class="form-group">
        <label class="col-md-2 required" for="BienTypeId">Environnement : </label>
        <div class="col-md-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('type_id',$types,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'environnement est obligatoire", 'selected' => $this->data['Bien']['type_id'],'empty' => 'Choisir un environnement')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('type_id',$types,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'environnement est obligatoire", 'empty' => 'Choisir un environnement')); ?>
            <?php } ?>        
        </div>        
    </div>  
    <div class="form-group">
        <label class="col-md-2" for="BienUsageId">Usage : </label>
        <div class="col-md-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('usage_id',$usages,array('class'=>'form-control','selected' => $this->data['Bien']['usage_id'],'empty' => 'Choisir un usage')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('usage_id',$usages,array('class'=>'form-control','empty' => 'Choisir un usage')); ?>
            <?php } ?>        
        </div>        
    </div>    
    <div class="form-group">
        <label class="col-md-2" for="BienLotId">Lot : </label>
        <div class="col-md-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('lot_id',$lots,array('class'=>'form-control','selected' => $this->data['Bien']['lot_id'],'empty' => 'Choisir un lot')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('lot_id',$lots,array('class'=>'form-control','empty' => 'Choisir un lot')); ?>
            <?php } ?>        
        </div>        
    </div>    
    <div class="form-group">
        <label class="col-md-2" for="BienCpuId">CPU : </label>
        <div class="col-md-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('cpu_id',$cpuses,array('class'=>'form-control','selected' => $this->data['Bien']['cpu_id'],'empty' => 'Choisir un CPU')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('cpu_id',$cpuses,array('class'=>'form-control','empty' => 'Choisir un CPU')); ?>
            <?php } ?>        
        </div>        
    </div>      
    <div class="form-group">
        <label class="col-md-2" for="BienCOEUR">Coeur : </label>      
        <div class="col-md-3">
            <?php echo $this->Form->input('COEUR',array('type'=>'text','placeholder'=>'Coeur','class'=>'form-control')); ?>
        </div>         
    </div>  
    <div class="form-group">
        <label class="col-md-2" for="BienCOEURLICENCE">Coeur licence : </label>      
        <div class="col-md-3">
            <?php echo $this->Form->input('COEURLICENCE',array('type'=>'text','placeholder'=>'Coeur licence','class'=>'form-control')); ?>
        </div>         
    </div>       
    <div class="block-panel-33-left">
    <div class="form-group">
        <label class="col-md-6" for="BienPVU1">PVU : </label>      
        <div class="col-md-3">
            <?php echo $this->Form->input('PVU1',array('type'=>'text','placeholder'=>'PVU','class'=>'form-control','value'=>isset($this->data['Bien']['PVU']) ? $this->data['Bien']['PVU'] : '')); ?>
            <?php echo $this->Form->input('PVU',array('type'=>'hidden','placeholder'=>'PVU','class'=>'form-control')); ?>
        </div>         
    </div>         
    </div>
    <div class="block-panel-33-middle">
    <div class="form-group">
        <label class="col-md-4" for="BienRAM">RAM : </label>      
        <div class="col-md-3">
            <?php echo $this->Form->input('RAM',array('type'=>'text','placeholder'=>'RAM','class'=>'form-control')); ?>
        </div>         
    </div>         
    </div>
    <div class="block-panel-33-right">
    <div class="form-group">
        <label class="col-md-4" for="BienCOUT">COUT : </label>      
        <div class="col-md-5">
            <?php echo $this->Form->input('COUT',array('type'=>'text','placeholder'=>'Coût en €','class'=>'form-control')); ?>
        </div>         
    </div>               
    </div>
    <?php $hiden = $this->params->action == 'add'  ? 'style="display:none;"' : ''; ?>
    <?php $hiden = $this->params->action == 'edit' && $this->request->data['Bien']['modele_id']==9 ? '' : 'style="display:none;"'; ?>
    <div class="row clearfix for770" <?php echo $hiden; ?>>
        <div class="col-md-6 column">
            <div class="form-group">
                <label class="col-md-4" for="BienCOEURINSTALLE">Coeur installé: </label>      
                <div class="col-md-5">
                    <?php echo $this->Form->input('COEURINSTALLE',array('type'=>'text','placeholder'=>'Coeur installé','class'=>'form-control')); ?>
                </div>         
            </div>  
            <div class="form-group">
                <label class="col-md-4" for="BienCOEURACTIVE">Coeur activé: </label>      
                <div class="col-md-5">
                    <?php echo $this->Form->input('COEURACTIVE',array('type'=>'text','placeholder'=>'Coeur activé','class'=>'form-control')); ?>
                </div>         
            </div>  
        </div>
        <div class="col-md-6 column">
            <div class="form-group">
                <label class="col-md-4" for="BienRAMINSTALLE">RAM installée: </label>      
                <div class="col-md-5">
                    <?php echo $this->Form->input('RAMINSTALLE',array('type'=>'text','placeholder'=>'Mémoire installée','class'=>'form-control')); ?>
                </div>         
            </div>  
            <div class="form-group">
                <label class="col-md-4" for="BienRAMACTIVE">RAM activée: </label>      
                <div class="col-md-5">
                    <?php echo $this->Form->input('RAMACTIVE',array('type'=>'text','placeholder'=>'Mémoire activée','class'=>'form-control')); ?>
                </div>         
            </div>  
        </div>        
    </div>    
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit','formnovalidate' => true)); ?>                
      </div>
    </div>  
    </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>     
<?php echo $this->Form->end(); ?>
    <?php if ($this->params->action == 'edit') : ?>
        <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#panel_apps" href="#panel_logiciel">
            Logiciels
            <span class="badge badge-default pull-right">Nb: <?php echo count($assobienlogiciels); ?></span>
          </a>
        </h3>
      </div>
      <div id="panel_logiciel" class="panel-collapse collapse in">
        <div class="panel-body">
          <?php if($this->data['Bien']['ACTIF']): ?>
          <button type="button" class='btn btn-sm btn-default pull-right' style="margin-bottom:10px;" data-toggle="modal" data-target="#addModal">Ajouter un logiciel existant</button>                    
          <button type="button" class='btn btn-sm btn-default pull-right' style="margin-bottom:10px;margin-right: 10px;" data-toggle="modal" data-target="#addnewModal">Ajouter un nouveau logiciel</button>
          <?php endif; ?>
          <?php echo $this->element('tableLogiciels'); ?>
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
          <?php echo $this->element('tableHistoryBien'); ?>
        </div>
      </div>
    </div>    
    <?php endif; ?>    
</div>
<!--test modal //-->
<div class="modal fade" id="addnewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Ajout d'un nouveau logiciel</h4>
      </div>
      <?php echo $this->Form->create('Logiciel',array('controller'=>'logiciels','action'=>'ajaxadd','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
      <div class="modal-body">
        <?php  echo $this->Form->input('bien_id',array('type'=>'hidden','value'=>$this->data['Bien']['id'])); ?>
        <?php // echo $this->Form->input('application_id',array('type'=>'hidden','value'=>$this->data['Bien']['application_id'])); ?>
        <?php // echo $this->Form->input('lot_id',array('type'=>'hidden','value'=>$this->data['Bien']['lot_id'])); ?>
        <div class="form-group">
              <label class="col-md-4" for="LogicielApplicationId">Application : </label>
              <div class="col-md-7">
                  <?php echo $this->Form->select('application_id',$applications,array('class'=>'form-control','empty'=>false,'default' => $this->data['Bien']['application_id'])); ?>                   
              </div>
        </div>   
        <div class="form-group">
              <label class="col-md-4" for="LogicielLotId">Lot : </label>
              <div class="col-md-7">
                  <?php echo $this->Form->select('lot_id',$lots,array('class'=>'form-control','empty'=>false,'default' => $this->data['Bien']['lot_id'])); ?>                   
              </div>
        </div>   
        <div class="form-group">
            <label class="col-md-4 required" for="LogicielNOMDISABLED">Nom : </label>
            <div class="col-md-7">
                 <?php $value =  ''; ?>
                 <?php echo $this->Form->input('NOMDISABLED',array('type'=>'text','placeholder'=>'Nom de l\'outil et la version','readonly','class'=>'form-control','value'=>$value)); ?> 
                 <?php echo $this->Form->input('NOM',array('type'=>'hidden','value'=>$value)); ?>
            </div>        
        </div>
        <div class="form-group">
            <label class="col-md-4 required" for="LogicielEnvoutilId">Outil : </label>
            <div class="col-md-7">
                    <?php echo $this->Form->select('envoutil_id',$outils,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'outil est obligatoire", 'empty' => 'Choisir un outil')); ?>       
            </div>        
        </div>
        <div class="form-group">
            <label class="col-md-4 required" for="LogicielEnvversionId">Version : </label>
            <div class="col-md-7">
                    <?php echo $this->Form->select('envversion_id',$versions,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"La version est obligatoire", 'empty' => 'Choisir une version')); ?>       
            </div>        
        </div>  
          <hr>
        <!--<div class="form-group">
              <label class="col-md-4" for="LogicielENVDSIT">Nom environnement DSI-T : </label>      
              <div class="col-md-7">
                  <?php echo $this->Form->input('ENVDSIT',array('type'=>'text','placeholder'=>'Nom environnement DSI-T','class'=>'form-control')); ?>
              </div>         
        </div>    -->  
        <div class="form-group">
            <label class="col-md-4" for="LogicielINSTALL">Installé : </label>      
            <div class="col-md-7">
                <?php echo $this->Form->input('INSTALL',array('type'=>'checkbox','class'=>'yesno')); ?>
                &nbsp;<label for="LogicielINSTALL" class='labelAfter'></label>
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
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Ajout d'un logiciel existant</h4>
      </div>
      <?php echo $this->Form->create('Assobienlogiciel',array('controller'=>'assobienlogiciels','action'=>'ajaxadd','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
      <div class="modal-body">
        <?php  echo $this->Form->input('bien_id',array('type'=>'hidden','value'=>$this->data['Bien']['id'])); ?>
        <div class="form-group">
              <label class="col-md-4" for="AssobienlogicielApplicationId">Application : </label>
              <div class="col-md-7">
                  <?php echo $this->Form->input('application_id',array('type'=>'hidden','value'=>$this->data['Bien']['application_id'])); ?>
                  <?php echo $this->Form->select('application_id',$applications,array('class'=>'form-control','id'=>'SelectApplicationId','empty'=>false,'default' => $this->data['Bien']['application_id'])); ?>                   
              </div>
        </div>     
        <div class="form-group">
              <label class="col-md-4" for="LogicielLotId">Lot : </label>
              <div class="col-md-7">
                  <?php echo $this->Form->input('lot_id',array('type'=>'hidden','value'=>$this->data['Bien']['lot_id'])); ?>
                  <?php echo $this->Form->select('lot_id',$lots,array('class'=>'form-control','id'=>'SelectLotId','empty'=>false,'default' => $this->data['Bien']['lot_id'])); ?>                   
              </div>
        </div>             
        <div class="form-group">
              <label class="col-md-4" for="AssobienlogicielLogicielId">Nom : </label>
              <div class="col-md-7">
                  <?php echo $this->Form->select('logiciel_id',$listlogiciels,array('class'=>'form-control','empty' => 'Choisir un logiciel')); ?>                   
              </div>
        </div>  
        <!--<div class="form-group">
            <label class="col-md-4" for="AssobienlogicielENVDSIT">Nom environnement DSI-T : </label>      
            <div class="col-md-7">
                <?php echo $this->Form->input('ENVDSIT',array('type'=>'text','placeholder'=>'Nom environnement DSI-T','class'=>'form-control')); ?>
            </div>         
        </div>  -->
        <div class="form-group">
            <label class="col-md-4" for="AssobienlogicielINSTALL">Installé : </label>      
            <div class="col-md-7">
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
                alert("Erreur! Impossible de mettre à jour les informations\n\rActualiser la page et recommencer.");
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
    
    if($('#BienPVU').val() != ''){
        $('#BienPVU1').prop('disabled',true);
    } else {
          $('#BienPVU1').prop('disabled',false).addClass('has-error');
    }    
    
    $(document).on('change','#BienCpuId',function(e){
        var id = $("#BienCpuId option:selected").val();
        if(id != ''){
            $.ajax({
                type: "POST",       
                url: "<?php echo $this->Html->url(array('controller'=>'cpuses','action'=>'json_get_info')); ?>/"+id+"/1", 
                contentType: "application/json",
                success : function(response) {
                    var json = $.parseJSON(response);
                    if (json[0]['Cpus']['PVU'] != '' && ($('#BienCOEURLICENCE').val() != '' && $('#BienCOEURLICENCE').val() != '0')){
                        $('#BienPVU1').prop('disabled',false).removeClass('has-error').val(json[0]['Cpus']['PVU']*$('#BienCOEURLICENCE').val()).prop('disabled',true);
                        $('#BienPVU').val(json[0]['Cpus']['PVU']*$('#BienCOEURLICENCE').val());
                    }
                    else
                    {
                        $('#BienPVU1').prop('disabled',false).val('').addClass('has-error');
                        $('#BienPVU').val('');
                    }
                },
                error :function(response, status,errorThrown) {
                    alert("Erreur! Impossible de mettre à jour les informations\n\rActualiser la page et recommencer.");
                }
             });               
         } else {
               $('#BienPVU1').prop('disabled',false).val('').addClass('has-error');
         }
    });    
    
    $(document).on('change','#BienCOEURLICENCE',function(e){
        var id = $("#BienCpuId option:selected").val();
        if($('#BienCOEURLICENCE').val() != '' && $('#BienCOEURLICENCE').val() != '0'){
            $.ajax({
                type: "POST",       
                url: "<?php echo $this->Html->url(array('controller'=>'cpuses','action'=>'json_get_info')); ?>/"+id+"/1", 
                contentType: "application/json",
                success : function(response) {
                    var json = $.parseJSON(response);
                    if (json[0]['Cpus']['PVU'] != ''){
                        $('#BienPVU1').prop('disabled',false).removeClass('has-error').val(json[0]['Cpus']['PVU']*$('#BienCOEURLICENCE').val()).prop('disabled',true);
                        $('#BienPVU').val(json[0]['Cpus']['PVU']*$('#BienCOEURLICENCE').val());
                    }
                    else
                    {
                        $('#BienPVU1').prop('disabled',false).val('').addClass('has-error');
                        $('#BienPVU').val('');
                    }
                },
                error :function(response, status,errorThrown) {
                    alert("Erreur! Impossible de mettre à jour les informations\n\rActualiser la page et recommencer.");
                }
             });               
         } else {
               $('#BienPVU1').prop('disabled',false).val('').addClass('has-error');
         }
    });
      
    $(document).on('change','#addModal #SelectApplicationId',function(e){
        var nom = $("#addModal #SelectApplicationId option:selected").text();
        var id = $("#addModal #SelectApplicationId option:selected").val();
        $("#addModal #AssobienlogicielApplicationId").val(id);
        var lotid = $("#addModal #AssobienlogicielLotId").val();
        if(lotid != '') {
            $("#addModal #AssobienlogicielLogicielId").find('option:not(:first)').remove();
            if(id!=''){
            $.ajax({
                type: "POST",       
                url: "<?php echo $this->Html->url(array('controller'=>'logiciels','action'=>'json_get_select_compatible')); ?>/"+ lotid +"/"+id, 
                contentType: "application/json",
                success : function(response) {
                    var json = $.parseJSON(response);
                    var options = $("#addModal #AssobienlogicielLogicielId");
                    $.each(json, function (index, value) {
                        if(index != undefined) {
                            options.append($("<option />").val(value).text(index));
                        }
                    });                       
                },
                error :function(response, status,errorThrown) {
                    alert("Erreur! Impossible de mettre à jour les informations\n\rActualiser la page et recommencer.");
                }
             }); 
           }
       }
    });    
    
    $(document).on('change','#addModal #SelectLotId',function(e){
        var nom = $("#addModal #SelectLotId option:selected").text();
        var id = $("#addModal #SelectLotId option:selected").val();
        $("#addModal #AssobienlogicielLotId").val(id);
        var appid = $("#addModal #AssobienlogicielApplicationId").val();
        if(appid != '') {
            $("#addModal #AssobienlogicielLogicielId").find('option:not(:first)').remove();
            if(id!=''){
            $.ajax({
                type: "POST",       
                url: "<?php echo $this->Html->url(array('controller'=>'logiciels','action'=>'json_get_select_compatible')); ?>/"+ id +"/"+appid, 
                contentType: "application/json",
                success : function(response) {
                    var json = $.parseJSON(response);
                    var options = $("#addModal #AssobienlogicielLogicielId");
                    $.each(json, function (index, value) {
                        if(index != undefined) {
                            options.append($("<option />").val(value).text(index));
                        }
                    });                       
                },
                error :function(response, status,errorThrown) {
                    alert("Erreur! Impossible de mettre à jour les informations\n\rActualiser la page et recommencer.");
                }
             }); 
           }
       }
    }); 
    
    $(document).on('change','#BienModeleId',function(e){
        var value = $("#BienModeleId option:selected").val();
        if(value == 9){
            $(".for770").show();
        } else {
            $(".for770").hide();
        }
    });    
});
</script>