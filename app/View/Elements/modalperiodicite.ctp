<!--modal hebdomadaire//-->
<div class="modal fade" id="HebdoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Périodicité hebdomadaire</h4>
      </div>
      <div class="modal-body">
        <div class="block-content repetitionH">
        <div class="form-group">
            <label class="col-lg-2" for="ActionREPETITIONHWEEK">Toutes les : </label>
            <div class="col-lg-9  form-inline">
                <?php
                   echo $this->Form->input('REPETITIONHWEEK', array('maxlength'=>'2','class' => 'form-control text-right','style'=>'width:45px;','value'=>isset($periodicite['Periodicite']['REPEATALL']) ? $periodicite['Periodicite']['REPEATALL'] : '1','min'=>"1", 'step'=>"1",'max'=>'3'));             
                ?>&nbsp;semaine(s)
            </div> 
        </div>
        <div class="form-group">
            <label class="col-lg-2" for="ActionREPETITIONHDAY<?php echo date('N'); ?>">Jour : </label>
            <div class="col-lg-9">
                <?php 
                $options = array('1' => 'Lundi', '2' => 'Mardi', '3' => 'Mercredi','4' => 'Jeudi', '5' => 'Vendredi', '6' => 'Samedi','7' => 'Dimanche');
                $selected = array();
                if (isset($periodicite['Periodicite']['LU']) && $periodicite['Periodicite']['LU']) $selected[] = 1;
                if (isset($periodicite['Periodicite']['MA']) && $periodicite['Periodicite']['MA']) $selected[] = 2;
                if (isset($periodicite['Periodicite']['ME']) && $periodicite['Periodicite']['ME']) $selected[] = 3;
                if (isset($periodicite['Periodicite']['JE']) && $periodicite['Periodicite']['JE']) $selected[] = 4;
                if (isset($periodicite['Periodicite']['VE']) && $periodicite['Periodicite']['VE']) $selected[] = 5;
                if (isset($periodicite['Periodicite']['SA']) && $periodicite['Periodicite']['SA']) $selected[] = 6;
                if (isset($periodicite['Periodicite']['DI']) && $periodicite['Periodicite']['DI']) $selected[] = 7;
                echo $this->Form->select('REPETITIONHDAY', $options, array('multiple' => 'checkbox','class'=> 'checkboxes_inline','value'=> $selected));
                ?>                   
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2" for="ActionREPETITIONHLAST">Fin le : </label>
            <div class="col-lg-5">
                <div class="input-group" style="margin-left: 0px;">
                <?php $today = new dateTime(); ?>
                <?php echo $this->Form->input('REPETITIONHLAST',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'value'=>isset($periodicite['Periodicite']['END']) ? $periodicite['Periodicite']['END'] : '','class'=>"form-control dateall",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ActionREPETITIONHLAST"><span class="glyphicons circle_remove grey"></span></span>
                <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ActionREPETITIONHLAST"><span class="glyphicons calendar"></span></span>
                </div>                     
            </div>
        </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closeHPeriodicite">Annuler</button><button type="button" class="btn btn-sm btn-default" id="saveHPeriodicite">Enregistrer</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal hebdomadaire//--> 

<!--modal mensuelle//-->
<div class="modal fade" id="MoisModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Périodicité mensuelle</h4>
      </div>
      <div class="modal-body">
        <div class="block-content repetitionM">
        <div class="form-group">
            <label class="col-lg-2" for="ActionREPETITIONMMONTH">Tous les : </label>
            <div class="col-lg-9  form-inline">
                <?php
                   echo $this->Form->input('REPETITIONMMONTH', array('maxlength'=>'2','class' => 'form-control text-right','style'=>'width:45px;','value'=>isset($periodicite['Periodicite']['REPEATALL']) ? $periodicite['Periodicite']['REPEATALL'] : '1','min'=>"1", 'step'=>"1",'max'=>'12'));             
                ?>&nbsp;mois
            </div>
        </div>
        <div class="form-group">  
            <label class="col-lg-2" for="ActionREPETITIONMDAY">Le : </label>
            <div class="col-lg-9  form-inline">
                <?php
                   echo $this->Form->input('REPETITIONMDAY', array('maxlength'=>'2','class' => 'form-control text-right','style'=>'width:45px;','value'=>isset($periodicite['Periodicite']['ALLDAYMONTH']) ? $periodicite['Periodicite']['ALLDAYMONTH'] : date('d'),'min'=>"1", 'step'=>"1",'max'=>'31'));                          
                ?>  
            </div>
        </div>
        <div class="form-group">                 
            <label class="col-lg-2" for="ActionREPETITIONMLAST">Fin le : </label>
            <div class="col-lg-5"> 
                <div class="input-group" style="margin-left: 0px;">
                <?php $today = new dateTime(); ?>
                <?php echo $this->Form->input('REPETITIONMLAST',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'value'=>isset($periodicite['Periodicite']['END']) ? $periodicite['Periodicite']['END'] : '','class'=>"form-control dateall",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ActionREPETITIONMLAST"><span class="glyphicons circle_remove grey"></span></span>
                <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ActionREPETITIONMLAST"><span class="glyphicons calendar"></span></span>
                </div>                      
            </div>
            </div>                
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-default" id="closeMPeriodicite">Annuler</button><button type="button" class="btn btn-sm btn-default" id="saveMPeriodicite">Enregistrer</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal mensuelle//--> 
<script>
$(document).ready(function () {
  
    $(document).on('click','#closeMPeriodicite',function(e){
        var periode = $('#ActionFREQUENCE').val();
        switch(periode){
            case 'Q':
                $('#ActionREPETITIONQ').prop('checked', true);
                $('[for=ActionREPETITIONH]').removeClass('active');
                $('[for=ActionREPETITIONM]').removeClass('active');
                $('[for=ActionREPETITIONQ]').addClass('active');
                break;
            case 'H':
                $('#ActionREPETITIONH').prop('checked', true);
                $('[for=ActionREPETITIONQ]').removeClass('active');
                $('[for=ActionREPETITIONM]').removeClass('active');
                $('[for=ActionREPETITIONH]').addClass('active');
                break;
            case 'M':
                $('#ActionREPETITIONM').prop('checked', true);
                $('[for=ActionREPETITIONQ]').removeClass('active');
                $('[for=ActionREPETITIONH]').removeClass('active');                
                $('[for=ActionREPETITIONM]').addClass('active');
                break;
        }
        $('#MoisModal').modal('toggle');
    });
    
    $(document).on('click','#closeHPeriodicite',function(e){
        var periode = $('#ActionFREQUENCE').val();       
        switch(periode){
            case 'Q':
                $('#ActionREPETITIONQ').prop('checked', true);
                $('[for=ActionREPETITIONH]').removeClass('active');
                $('[for=ActionREPETITIONM]').removeClass('active');
                $('[for=ActionREPETITIONQ]').addClass('active');
                break;
            case 'H':
                $('#ActionREPETITIONH').prop('checked', true);
                $('[for=ActionREPETITIONQ]').removeClass('active');
                $('[for=ActionREPETITIONM]').removeClass('active');
                $('[for=ActionREPETITIONH]').addClass('active');
                break;
            case 'M':
                $('#ActionREPETITIONM').prop('checked', true);
                $('[for=ActionREPETITIONQ]').removeClass('active');
                $('[for=ActionREPETITIONH]').removeClass('active');                
                $('[for=ActionREPETITIONM]').addClass('active');
                break;
        }        
        $('#HebdoModal').modal('toggle');
    });   
    
    $(document).on('click','#saveMPeriodicite',function(e){
        //sauvegarde en ajax
        $('#ActionREPETITION').val('M');
        $('#MoisModal').modal('toggle');
    });
    
    $(document).on('click','#saveHPeriodicite',function(e){
        //sauvegarde en ajax
        $('#ActionREPETITION').val('H');
        $('#HebdoModal').modal('toggle');
    });       
});
</script>