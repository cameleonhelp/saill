<div class="marginright20">
<?php echo $this->Form->create('Mw',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2 required" for="MwNOMDISABLED">Nom : </label>
        <div class="col-lg-5" style="margin-left:15px;">
            <div class="input-group">
            <?php $NOMValue = $this->params->action == 'edit' ? $mw['Mw']['NOM'] : ''; ?>
            <?php echo $this->Form->input('NOMDISABLED',array('type'=>'text','value'=>$NOMValue,'placeholder'=>'Nom du middleware','disabled'=>'disabled','class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom est obligatoire et doit être unique")); ?>
            <?php echo $this->Form->input('NOM',array('type'=>'hidden','value'=>$NOMValue)); ?>
            <span class="input-group-addon btn-addon" data-target="#MwNOMDISABLED"><span class="glyphicons pencil notchange"></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2 required" for="MwEnvoutilId">Logiciel : </label>
        <div class="col-lg-5">
            <?php if ($this->params->action == 'edit') { ?>
                <?php echo $this->Form->select('envoutil_id',$envoutils,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le logiciel est obligatoire", 'default' => $mw['Mw']['envoutil_id'],'empty' => 'Choisir un logiciel')); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('envoutil_id',$envoutils,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le logiciel est obligatoire", 'empty' => 'Choisir un logiciel')); ?>
            <?php } ?>        
        </div>        
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="MwPVU">PVU : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('PVU',array('type'=>'text','placeholder'=>'PVU','class'=>'form-control','value'=>isset($mw['Mw']['PVU']) ? $mw['Mw']['PVU'] : '')); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-2" for="Mw	COUTUNITAIRE">Coût unitaire : </label>
        <div class="row">        
        <div class="col-lg-3">
            <?php echo $this->Form->input('COUTUNITAIRE',array('type'=>'text','placeholder'=>'Coût unitaire en €','class'=>'form-control','value'=>isset($mw['Mw']['COUTUNITAIRE']) ? $mw['Mw']['COUTUNITAIRE'] : '')); ?>
        </div>
            <div> €</div>            
        </div>            
    </div>    
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden','value'=>$mw['Mw']['id'])); ?>     
<?php echo $this->Form->end(); ?>
</div>
<script>
$(document).ready(function () {
    $(document).on('change','#MwEnvoutilId',function(e){
        $('#MwNOMDISABLED').val($('#MwEnvoutilId option:selected').text());
        $('#MwNOM').val($('#MwEnvoutilId option:selected').text());
    });
    
    $(document).on('change','#MwNOMDISABLED',function(e){
        $('#MwNOM').val($('#MwNOMDISABLED').val());
    });
        
    $(document).on('click','.btn-addon',function(e){
        var target = $(this).attr('data-target');
        var prop = $(target).prop('disabled');
        $(target).attr('disabled',!prop);
    });
});
</script>