<?php $modaltitle = "Demande d'absence"; ?>
<!--modal demande absences//-->
<div class="modal fade" id="modaldemandeabsences" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $modaltitle; ?></h4>
      </div>
      <div class="modal-body">
        <div class="block-content">
            <!-- contenu de la fenêtre modale //-->
            <?php echo $this->Form->create('Demandeabsence',array('action'=>'add','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                <div class="form-group">
                    <label class="col-md-4 required" for="DemandeabsenceUtilisateurId">Demandeur : </label>
                    <div class="col-md-8">
                        <?php echo $this->Form->select('utilisateur_id',$demandeurs,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom du demandeur est obligatoire",'empty'=>'Choisir un demandeur','default'=> userAuth('id'))); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4  required" for="DemandeabsenceDATEDU">Du (inclus) : </label>
                    <div class="row">
                        <div class="col-md-4">
                          <div class="input-group" style="margin-left: 0px;">
                          <?php $today = new dateTime(); ?>
                          <?php echo $this->Form->input('DATEDU',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'data-rule-required'=>'true','value'=>$today->format('d/m/Y'),'class'=>"form-control dateweek",'data-msg-required'=>"La date de début est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                          <span class="input-group-addon date-addon-calendar btn-addon" data-target="#DemandeabsenceDATEDU"><span class="glyphicons calendar"></span></span>
                          </div>                            
                        </div>
                        <div><div class="col-md-3"><?php
                        $options=array('8'=>'08:00','12'=>'13:00');
                        echo $this->Form->select('DATEDUTYPE',$options,array('default'=>'8','empty'=>false,'class'=>'form-control col-md-2'));
                        ?></div></div>             
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4  required" for="DemandeabsenceDATEAU">Au (inclus) : </label>
                    <div class="row">
                        <div class="col-md-4">
                          <div class="input-group" style="margin-left: 0px;">
                          <?php $today = new dateTime(); ?>
                          <?php echo $this->Form->input('DATEAU',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'data-rule-required'=>'true','value'=>$today->format('d/m/Y'),'class'=>"form-control dateweek",'data-msg-required'=>"La date de de limite est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                          <span class="input-group-addon date-addon-calendar btn-addon" data-target="#DemandeabsenceDATEAU"><span class="glyphicons calendar"></span></span>
                          </div>                              
                        </div>
                        <div><div class="col-md-3"><?php
                        $options=array('12'=>'12:00','16'=>'17:00');
                        echo $this->Form->select('DATEAUTYPE',$options,array('default'=>'16','empty'=>false,'class'=>'form-control col-md-2'));
                        ?></div></div>             
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4  required" for="DemandeabsenceREPEAT">Répétition hebdomadaire : </label>
                    <div class="col-md-8">
                        <?php echo $this->Form->input('REPEAT',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class='labelAfter' for="DemandeabsenceREPEAT"></label>                         
                    </div>
                </div>   
                <div class="form-group">
                    <label class="col-md-4  required" for="DemandeabsenceDATEFIN">Fin  : </label>
                    <div class="row">
                        <div class="col-md-4">
                          <div class="input-group" style="margin-left: 0px;">
                          <?php $today = new dateTime(); ?>
                          <?php echo $this->Form->input('DATEFIN',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'data-rule-required'=>'true','class'=>"form-control dateweek",'disabled'=>'disabled','data-msg-required'=>"La date de fin est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                          <span class="input-group-addon date-addon-calendar btn-addon" id="btndatefin" data-target="#DemandeabsenceDATEFIN" disabled><span class="glyphicons calendar"></span></span>
                          </div>                              
                        </div>           
                    </div>
                </div>            
                <div class="form-group" style="margin-bottom: -15px;">
                    <label class="col-md-4" for="DemandeabsenceMOTIF">Motif : </label>
                    <div class="col-md-8">
                        <?php echo $this->Form->input('MOTIF',array('class'=>'form-control mceNoEditor','type'=>'textarea',"style"=>"min-height:150px;")); ?>
                    </div>
                </div>            
            <!-- fin du contenu de la fenêtre modale //-->
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closemodaldemandeabsences" name="cancel">Annuler</button>
      <button type="submit" class="btn btn-sm btn-default" id="savemodaldemandeabsences">Enregistrer</button>
    </div>
    <?php echo $this->Form->end(); ?>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal  demande absences//--> 
<script>
$(document).ready(function () {
    $(document).on('click','#closemodaldemandeabsences',function(e){         
        $('#modaldemandeabsences').modal('toggle');
    }); 
    
    $(document).on('hidden.bs.modal','#modaldemandeabsences',function(e){
        var startdate = $('#DemandeabsenceDATEDU').val();
        $('#DemandeabsenceDATEAU').val(startdate);        
        $('#DemandeabsenceDATEAU').parents('.input-group').removeClass('has-error');
        $('#DemandeabsenceDATEDU').parents('.input-group').removeClass('has-error');
        $('#savemodaldemandeabsences').removeClass('disabled')          
    });     
    
    $(document).on('click','#DemandeabsenceREPEAT',function(e){
        if($('#DemandeabsenceREPEAT').prop('checked')){
            $('#DemandeabsenceREPEAT').val(1);
            $('#DemandeabsenceDATEFIN').removeAttr('disabled');
            $('#DemandeabsenceDATEFIN').val($('#DemandeabsenceDATEAU').val());
            $('#btndatefin').removeAttr('disabled');
        }else{
            $('#DemandeabsenceREPEAT').val(0);
            $('#DemandeabsenceDATEFIN').attr('disabled',true);
            $('#DemandeabsenceDATEFIN').val('');
            $('#btndatefin').attr('disabled',true);
        }
    });
    
    $(document).on('change','#DemandeabsenceDATEAU',function(e){
        var startdate = $('#DemandeabsenceDATEDU').val();
        var enddate = $('#DemandeabsenceDATEAU').val();
        var intstart = startdate.split('/');
        var intend = enddate.split('/');
        intstart = intstart[2]+intstart[1]+intstart[0];
        intend = intend[2]+intend[1]+intend[0];
        if(parseInt(intstart) > parseInt(intend)){
            $('#DemandeabsenceDATEAU').parents('.input-group').addClass('has-error');
            $('#DemandeabsenceDATEDU').parents('.input-group').addClass('has-error');
            $('#savemodaldemandeabsences').addClass('disabled')
        }
        else {
            $('#DemandeabsenceDATEAU').parents('.input-group').removeClass('has-error');
            $('#DemandeabsenceDATEDU').parents('.input-group').removeClass('has-error');
            $('#savemodaldemandeabsences').removeClass('disabled')       
        }
    }); 
    
    $(document).on('change','#DemandeabsenceDATEDU',function(e){
        var startdate = $('#DemandeabsenceDATEDU').val();
        $('#DemandeabsenceDATEAU').val(startdate);
    });     
});
</script>