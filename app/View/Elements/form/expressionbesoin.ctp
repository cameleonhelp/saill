<div class="">
<?php echo $this->Form->create('Expressionbesoin',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class='block-panel-50-left'>
    <div class="form-group">
        <label class="col-md-4 required" for="ExpressionbesoinApplicationId">Application : </label>
        <div class="col-md-8">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('application_id',$applications,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'application est obligatoire", 'selected' => $this->data['Expressionbesoin']['application_id'],'empty' => 'Choisir une application')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('application_id',$applications,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'application est obligatoire", 'empty' => 'Choisir une application')); ?>
            <?php } ?>        
        </div>        
    </div>  
    <div class="form-group">
        <label class="col-md-4 required" for="ExpressionbesoinPerimetreId">Périmètre : </label>
        <div class="col-md-8">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('perimetre_id',$perimetres,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le périmètre est obligatoire", 'selected' => $this->data['Expressionbesoin']['perimetre_id'],'empty' => 'Choisir un périmètre')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('perimetre_id',$perimetres,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le périmètre est obligatoire", 'empty' => 'Choisir un périmètre')); ?>
            <?php } ?>        
        </div>        
    </div>
    <div class="form-group">
        <label class="col-md-4 required" for="ExpressionbesoinEtatId">Etat : </label>
        <div class="col-md-8">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('etat_id',$etats,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'état est obligatoire", 'selected' => $this->data['Expressionbesoin']['etat_id'],'empty' => 'Choisir un état')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('etat_id',$etats,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'état est obligatoire", 'empty' => 'Choisir un état')); ?>
            <?php } ?>        
        </div>        
    </div>
    <div class="form-group">
        <label class="col-md-4" for="ExpressionbesoinDsitenvId">Environnement DSI-T: </label>
        <div class="col-md-8">
                <?php echo $this->Form->select('dsitenv_id',$dsitenvs,array('class'=>'form-control','empty' => 'Choisir un environnement DSI-T','default'=>isset($this->data['Expressionbesoin']['dsitenv_id'])? $this->data['Expressionbesoin']['dsitenv_id'] : '')); ?>     
        </div>        
    </div>        
    <div class="form-group">
        <label class="col-md-4" for="ExpressionbesoinPhaseId">Phase : </label>
        <div class="col-md-8">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('phase_id',$phases,array('class'=>'form-control','selected' => $this->data['Expressionbesoin']['phase_id'],'empty' => 'Choisir une phase')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('phase_id',$phases,array('class'=>'form-control','empty' => 'Choisir une phase')); ?>
            <?php } ?>        
        </div>        
    </div>
    <div class="form-group">
        <label class="col-md-4" for="ExpressionbesoinPuissanceId">Puissance : </label>
        <div class="col-md-8">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('puissance_id',$puissances,array('class'=>'form-control','selected' => $this->data['Expressionbesoin']['puissance_id'],'empty' => 'Choisir une puissance')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('puissance_id',$puissances,array('class'=>'form-control','empty' => 'Choisir une puissance')); ?>
            <?php } ?>        
        </div>        
    </div>        
    <div class="form-group">
        <label class="col-md-4" for="ExpressionbesoinUSAGE">Usage : </label>      
        <div class="col-md-8">
            <?php echo $this->Form->input('USAGE',array('type'=>'text','placeholder'=>'Usage','class'=>'form-control')); ?>
        </div>         
    </div>  
    <div class="form-group">
        <label class="col-md-4" for="ExpressionbesoinPVU">PVU : </label>      
        <div class="col-md-8">
            <?php echo $this->Form->input('PVU',array('type'=>'text','placeholder'=>'PVU','class'=>'form-control')); ?>
        </div>         
    </div>   
    <div class="form-group">
        <label class="col-md-4" for="ExpressionbesoinDATELIVRAISON">Date de livraison : </label>
          <div class="col-md-6" style="margin-left:15px;">
              <div class="input-group">
              <?php $today = new dateTime(); ?>
              <?php echo $this->Form->input('DATELIVRAISON',array('type'=>'text','class'=>"form-control dateall",'placeholder'=>'ex.: '.$today->format('d/m/Y'),'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
              <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ExpressionbesoinDATELIVRAISON"><span class="glyphicons circle_remove grey"></span></span>
              <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ExpressionbesoinDATELIVRAISON"><span class="glyphicons calendar"></span></span>
              </div>                    
          </div>
    </div>         
    </div>
    <div class='block-panel-50-right'>
    <div class="form-group">
        <label class="col-md-4 required" for="ExpressionbesoinComposantId">Composant : </label>
        <div class="col-md-8">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('composant_id',$composants,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le composant est obligatoire", 'selected' => $this->data['Expressionbesoin']['composant_id'],'empty' => 'Choisir un composant')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('composant_id',$composants,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le composant est obligatoire", 'empty' => 'Choisir un composant')); ?>
            <?php } ?>        
        </div>        
    </div> 
    <div class="form-group">
        <label class="col-md-4 required" for="ExpressionbesoinLotId">Lot : </label>
        <div class="col-md-8">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('lot_id',$lots,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le lot est obligatoire", 'selected' => $this->data['Expressionbesoin']['lot_id'],'empty' => 'Choisir un lot')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('lot_id',$lots,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le lot est obligatoire", 'empty' => 'Choisir un lot')); ?>
            <?php } ?>        
        </div>        
    </div>
    <div class="form-group" style="height: 32px;">         
    </div>
    <div class="form-group">
        <label class="col-md-4" for="ExpressionbesoinTypeId">Type d'environnement : </label>
        <div class="col-md-8">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('type_id',$types,array('class'=>'form-control','selected' => $this->data['Expressionbesoin']['type_id'],'empty' => 'Choisir un type d\'environnement')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('type_id',$types,array('class'=>'form-control','empty' => 'Choisir un type d\'environnement')); ?>
            <?php } ?>        
        </div>        
    </div>
    <div class="form-group">
        <label class="col-md-4" for="ExpressionbesoinVolumetrieId">Volumétrie : </label>
        <div class="col-md-8">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('volumetrie_id',$volumetries,array('class'=>'form-control','selected' => $this->data['Expressionbesoin']['volumetrie_id'],'empty' => 'Choisir une volumétrie')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('volumetrie_id',$volumetries,array('class'=>'form-control','empty' => 'Choisir une volumétrie')); ?>
            <?php } ?>        
        </div>        
    </div>
    <div class="form-group">
        <label class="col-md-4" for="ExpressionbesoinArchitectureId">Architecture : </label>
        <div class="col-md-8">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('architecture_id',$architectures,array('class'=>'form-control','selected' => $this->data['Expressionbesoin']['architecture_id'],'empty' => 'Choisir une architecture')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('architecture_id',$architectures,array('class'=>'form-control','empty' => 'Choisir une architecture')); ?>
            <?php } ?>        
        </div>        
    </div>        
    <div class="form-group">
        <label class="col-md-4" for="ExpressionbesoinNOMUSAGE">Nom d'usage : </label>      
        <div class="col-md-8">
            <?php echo $this->Form->input('NOMUSAGE',array('type'=>'text','placeholder'=>'Nom d\'usage','class'=>'form-control')); ?>
        </div>         
    </div>  
    <div class="form-group">
        <label class="col-md-4" for="ExpressionbesoinCONNECT">Connecté : </label>
        <div class="col-md-5">
            <?php echo $this->Form->input('CONNECT',array('class'=>'yesno')); ?>
            &nbsp;<label for="ExpressionbesoinCONNECT" class='labelAfter'></label>
        </div>
    </div>  
    <div class="form-group">
        <label class="col-md-4" for="ExpressionbesoinDATEFIN">Date de fin : </label>
          <div class="col-md-6" style="margin-left:15px;">
              <div class="input-group">
              <?php $today = new dateTime(); ?>
              <?php echo $this->Form->input('DATEFIN',array('type'=>'text','class'=>"form-control dateall",'placeholder'=>'ex.: '.$today->format('d/m/Y'),'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
              <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ExpressionbesoinDATEFIN"><span class="glyphicons circle_remove grey"></span></span>
              <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ExpressionbesoinDATEFIN"><span class="glyphicons calendar"></span></span>
              </div>                    
          </div>
    </div>
    </div>  
    <div  style="clear:both;">
    <div class="form-group">
        <label class="col-md-2" for="ExpressionbesoinCOMMENTAIRE">Commentaire : </label>       
        <div class="col-md-10">
            <?php echo $this->Form->input('COMMENTAIRE',array('class'=>'form-control')); ?>
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
          <?php echo $this->element('tableHistoryExpBesoin'); ?>
        </div>
      </div>
    </div> 
    <?php endif; ?>
</div>
<script>
$(document).ready(function () {
    $(document).on('change','#ExpressionbesoinApplicationId',function(e){
        var nom = $("#ExpressionbesoinApplicationId option:selected").text();
        var id = $("#ExpressionbesoinApplicationId option:selected").val();
        $("#ExpressionbesoinDsitenvId").find('option:not(:first)').remove();
        $.ajax({
            type: "POST",       
            url: "<?php echo $this->Html->url(array('controller'=>'dsitenvs','action'=>'json_get_select_for_application')); ?>/"+id, 
            contentType: "application/json",
            success : function(response) {
                var json = $.parseJSON(response);
                console.log(json);
                var options = $("#ExpressionbesoinDsitenvId");
                $.each(json, function (index,value) {
                    options.append($("<option />").val(value).text(index));
                });
            },
            error :function(response, status,errorThrown) {
                alert("Erreur! Impossible de mettre à jour les informations\n\rActualiser la page et recommencer.");
            }
         });       
    });       
});
</script>