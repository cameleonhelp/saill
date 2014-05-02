<div class="">
    <?php 
    /**
     * Savoir sur quelle date porte la facturation
     */
    if ($this->params->action == 'add' ) $date = isset($activitesreelles[0]['Activitesreelle']['DATE']) ? $activitesreelles[0]['Activitesreelle']['DATE'] : date('d/m/Y');
    if ($this->params->action == 'edit' ) $date = isset($activitesreelles[0]['Facturation']['DATE']) ? $activitesreelles[0]['Facturation']['DATE'] : date('d/m/Y');
    $d = explode('/',$date);
    $day = $d[0];
    $mois = $d[1];
    $annee = $d[2];
    $debutsemaine = debutsem($annee,$mois,$day);
    $finsemaine = finsem($annee, $mois, $day);
?>
<?php echo $this->Form->create('Facturation',array('id'=>'formValidate','class'=>'form-horizontal','action'=>'save','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?> 
<table cellpadding="0" cellspacing="0" class="table table-bordered tablemax" id="FacturationTable">
    <thead>
    <tr>
        <th class="text-center" colspan="10">Facturation de l'activité pour la semaine du <span id="ActionreelleDebut" class="clearboth"><?php echo $debutsemaine; ?></span> au <span id="ActionreelleFin" class="clearboth"><?php echo $finsemaine; ?></span></th>
    </tr>
    <tr>
        <th rowspan="2" width="30px"><label class="col-md-4 control-label required">Activité</label></th>
        <?php $date = new DateTime(CUSDate($debutsemaine)); $LU = $date->format('d'); ?> 
        <?php $classLU = isFerie($date) ? 'class="ferie"' : ''; ?>
        <th <?php echo $classLU; ?> width='70px'>Lu.</th>
        <?php $date->add(new DateInterval('P1D')); $MA = $date->format('d'); ?> 
        <?php $classMA = isFerie($date) ? 'class="ferie"' : ''; ?>
        <th <?php echo $classMA; ?> width='70px'>Ma.</th>
        <?php $date->add(new DateInterval('P1D')); $ME = $date->format('d'); ?>
        <?php $classME = isFerie($date) ? 'class="ferie"' : ''; ?>
        <th <?php echo $classME; ?> width='70px'>Me.</th>
        <?php $date->add(new DateInterval('P1D')); $JE = $date->format('d'); ?> 
        <?php $classJE = isFerie($date) ? 'class="ferie"' : ''; ?>
        <th <?php echo $classJE; ?> width='70px'>Je.</th>
        <?php $date->add(new DateInterval('P1D')); $VE = $date->format('d'); ?> 
        <?php $classVE = isFerie($date) ? 'class="ferie"' : ''; ?>        
        <th <?php echo $classVE; ?> width='70px'>Ve.</th>
        <?php $date->add(new DateInterval('P1D')); $SA = $date->format('d'); ?> 
        <?php $classSA = isFerie($date) ? ' ferie' : ''; ?>        
        <th class='week <?php echo $classSA; ?>' width='70px'>Sa.</th>
        <?php $date->add(new DateInterval('P1D')); $DI = $date->format('d'); ?> 
        <?php $classDI = isFerie($date) ? ' ferie' : ''; ?>        
        <th class='week <?php echo $classDI; ?>' width='70px'>Di.</th>
        <th rowspan="2" width='70px'>Total</th>
        <th rowspan="2" width='70px'>Frais</th>
    </tr>
    <tr>
        <!--calculer les jours fériés pour mettre le style week sur les jours fériés //-->
        <th <?php echo $classLU; ?>><?php echo $LU; ?></th>
        <th <?php echo $classMA; ?>><?php echo $MA; ?></th>
        <th <?php echo $classME; ?>><?php echo $ME; ?></th>
        <th <?php echo $classJE; ?>><?php echo $JE; ?></th>
        <th <?php echo $classVE; ?>><?php echo $VE; ?></th>
        <th class='week <?php echo $classSA; ?>'><?php echo $SA; ?></th>
        <th class='week <?php echo $classDI; ?>'><?php echo $DI; ?>  </th>
    </tr> 
    </thead>
    <tbody> 
    <?php $i=1; ?>
    <?php
    /**
     * S'il existe déjà des facturation pour cette période on les affiche => si EDIT sinon affichage d'une seule ligne
     */
    ?>
    <?php foreach($activitesreelles as $activitesreelle): ?>        
    <tr>
        <td><div class="row form-inline"><div class="col-md-8">
            <select name="data[Facturation][<?php echo $i; ?>][activite_id]" data-rule-required="true" data-msg-required="Le nom de l'activité est obligatoire" id="Facturation<?php echo $i; ?>ActiviteId" class='form-control'> 
                <option value="">Choisir une activité</option>
                <?php foreach ($activites as $activite) : ?>
                <?php $selected = ''; ?>
                <?php if ($this->params->action == 'edit') $selected = $activite['Activite']['id']==$activitesreelle['Facturation']['activite_id'] ? 'selected="selected"' :''; ?>
                <?php if ($this->params->action == 'add') $selected = $activite['Activite']['id']==$activitesreelle['Activitesreelle']['activite_id'] ? 'selected="selected"' :''; ?>
                    <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?>><?php echo $activite['Projet']['NOM']; ?> - <?php echo $activite['Activite']['NOM']; ?></option>
                <?php endforeach; ?>
            </select></div><div style="margin-right:13px;margin-top:4px;">&nbsp;<span class="glyphicons bin cursor pull-right" id="deleteRow"></span></div></div>  
        </td>
        <?php if ($this->params->action == 'add') $lu_value = $activitesreelle['Activitesreelle']['LU']; ?>
        <?php if ($this->params->action == 'edit') $lu_value = $activitesreelle['Facturation']['LU']; ?>
        <td <?php echo $classLU; ?> width='15px' style="text-align: center;"><div class="form-inline"><?php echo $this->Form->input('Facturation.'.$i.'.LU',array('style'=>"width:45px",'class'=>'form-control text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du lundi",'value'=>$lu_value)); ?> j</div></td>
        <?php if ($this->params->action == 'add') $ma_value = $activitesreelle['Activitesreelle']['MA']; ?>
        <?php if ($this->params->action == 'edit') $ma_value = $activitesreelle['Facturation']['MA']; ?>
        <td <?php echo $classMA; ?> width='15px' style="text-align: center;"><div class="form-inline"><?php echo $this->Form->input('Facturation.'.$i.'.MA',array('style'=>"width:45px",'class'=>'form-control text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mardi",'value'=>$ma_value)); ?> j</div></td>
        <?php if ($this->params->action == 'add') $me_value = $activitesreelle['Activitesreelle']['ME']; ?>
        <?php if ($this->params->action == 'edit') $me_value = $activitesreelle['Facturation']['ME']; ?>
        <td <?php echo $classME; ?> width='15px' style="text-align: center;"><div class="form-inline"><?php echo $this->Form->input('Facturation.'.$i.'.ME',array('style'=>"width:45px",'class'=>'form-control text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mercredi",'value'=>$me_value)); ?> j</div></td>
        <?php if ($this->params->action == 'add') $je_value = $activitesreelle['Activitesreelle']['JE']; ?>
        <?php if ($this->params->action == 'edit') $je_value = $activitesreelle['Facturation']['JE']; ?>
        <td <?php echo $classJE; ?> width='15px' style="text-align: center;"><div class="form-inline"><?php echo $this->Form->input('Facturation.'.$i.'.JE',array('style'=>"width:45px",'class'=>'form-control text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du du jeudi",'value'=>$je_value)); ?> j</div></td>
        <?php if ($this->params->action == 'add') $ve_value = $activitesreelle['Activitesreelle']['VE']; ?>
        <?php if ($this->params->action == 'edit') $ve_value = $activitesreelle['Facturation']['VE']; ?>
        <td <?php echo $classVE; ?> width='15px' style="text-align: center;"><div class="form-inline"><?php echo $this->Form->input('Facturation.'.$i.'.VE',array('style'=>"width:45px",'class'=>'form-control text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du vendredi",'value'=>$ve_value)); ?> j</div></td>
        <?php if ($this->params->action == 'add') $sa_value = $activitesreelle['Activitesreelle']['SA']; ?>
        <?php if ($this->params->action == 'edit') $sa_value = $activitesreelle['Facturation']['SA']; ?>
        <td class='week <?php echo $classSA; ?>' width='15px' style="text-align: center;"><div class="form-inline"><?php echo $this->Form->input('Facturation.'.$i.'.SA',array('style'=>"width:45px",'class'=>'form-control text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du samedi",'value'=>$sa_value)); ?> j</div></td>
        <?php if ($this->params->action == 'add') $di_value = $activitesreelle['Activitesreelle']['DI']; ?>
        <?php if ($this->params->action == 'edit') $di_value = $activitesreelle['Facturation']['DI']; ?>
        <td class='week <?php echo $classDI; ?>' width='15px' style="text-align: center;"><div class="form-inline"><?php echo $this->Form->input('Facturation.'.$i.'.DI',array('style'=>"width:45px",'class'=>'form-control text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du dimanche",'value'=>$di_value)); ?> j</div></td>
        <?php if ($this->params->action == 'add') $total_value = $activitesreelle['Activitesreelle']['TOTAL']; ?>
        <?php if ($this->params->action == 'edit') $total_value = $activitesreelle['Facturation']['TOTAL']; ?>
        <?php $total_value = str_replace(',','.',$total_value); ?>
        <td width='15px' style="text-align: center;"><div class="form-inline">
        <?php echo $this->Form->input('Facturation.'.$i.'.TOTAL',array('type'=>'hidden','value'=>$total_value)); ?>
        <?php echo $this->Form->input('Facturation.'.$i.'.TotalDisabled',array('style'=>"width:45px",'class'=>'form-control text-right','value'=>$total_value,'disabled'=>'disabled')); ?> j</div></td> 
        <?php if ($this->params->action == 'add') $frais = $activitesreelle['Activitesreelle']['FRAIS']; ?>
        <?php if ($this->params->action == 'edit') $frais = $activitesreelle['Facturation']['FRAIS']; ?>
        <td width='15px' style="text-align: center;"><div class="form-inline">
        <?php echo $this->Form->input('Facturation.'.$i.'.FRAIS',array('style'=>"width:45px",'type'=>'text','class'=>'form-control text-right','value'=>$frais)); ?> €</div></td>         
        <td style="display:none;">
        <?php if ($this->params->action == 'add') echo $this->Form->input('Facturation.'.$i.'.DATE',array('type'=>'hidden','value'=>isset($activitesreelle['Activitesreelle']['DATE']) ? $activitesreelle['Activitesreelle']['DATE'] : date('d/m/Y'))); ?>
        <?php if ($this->params->action == 'edit') echo $this->Form->input('Facturation.'.$i.'.DATE',array('type'=>'hidden','value'=>isset($activitesreelle['Facturation']['DATE']) ? $activitesreelle['Facturation']['DATE'] : date('d/m/Y'))); ?>    
        <?php if ($this->params->action == 'add') $userid = $activitesreelle['Activitesreelle']['utilisateur_id']; ?>
        <?php if ($this->params->action == 'edit') $userid = $activitesreelle['Facturation']['utilisateur_id']; ?>    
        <?php echo $this->Form->input('Facturation.'.$i.'.utilisateur_id',array('type'=>'hidden','value'=>$userid)); ?> 
        <?php $valVersion = $this->params->action == 'add' ? !isset($activitesreelles[0]['Activitesreelle']['VERSION']) ? 0 :$activitesreelles[0]['Activitesreelle']['VERSION'] + 1 : '0'; ?>                                    
        <?php $valVersion = $this->params->action == 'edit' ? !isset($activitesreelle['Facturation']['VERSION']) ? 0 : $activitesreelle['Facturation']['VERSION'] + 1 : $valVersion; ?>                        
        <?php echo $this->Form->input('Facturation.'.$i.'.VERSION',array('type'=>'hidden','class'=>'version','value'=>$valVersion)); ?> 
        <?php $valFTGAL = $this->params->action == 'add' ? !isset($activitesreelles[0]['Activitesreelle']['NUMEROFTGALILEI']) ? '' : $activitesreelles[0]['Activitesreelle']['NUMEROFTGALILEI']: ''; ?> 
        <?php $valFTGAL = $this->params->action == 'edit' ? !isset($activitesreelle['Facturation']['NUMEROFTGALILEI']) ? '' : $activitesreelle['Facturation']['NUMEROFTGALILEI']: $valFTGAL; ?>                                
        <?php echo $this->Form->input('Facturation.'.$i.'.NUMEROFTGALILEI',array('type'=>'hidden','class'=>'ftgalilei','value'=>$valFTGAL)); ?>   
        <?php if ($this->params->action == 'add') echo $this->Form->input('Facturation.'.$i.'.activitesreelle_id',array('type'=>'hidden','value'=>$activitesreelle['Activitesreelle']['id'])); ?>
        </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    <?php
    /**
     * Template de ligne à utiliser
     */
    ?>    
    <tr id="templateRow">
        <td><div class="row form-inline"><div class="col-md-10">
            <select name="data[Facturation][¤][activite_id]" id="Facturation¤ActiviteId" class="selectActivite form-control"> 
                <option value="">Choisir une activité</option>
                <?php foreach ($activites as $activite) : ?>
                    <option value="<?php echo $activite['Activite']['id']; ?>"><?php echo $activite['Projet']['NOM']; ?> - <?php echo $activite['Activite']['NOM']; ?></option>
                <?php endforeach; ?>
            </select></div>&nbsp;<span class="glyphicons bin cursor" id="deleteRow"></span></div>  
        </td>
        <td <?php echo $classLU; ?> width='15px' style="text-align: center;"><div class="form-inline"><?php echo $this->Form->input('Facturation.¤.LU',array('style'=>"width:45px",'class'=>'form-control text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du lundi",'value'=>"0.0")); ?> j</div></td>
        <td <?php echo $classMA; ?> width='15px' style="text-align: center;"><div class="form-inline"><?php echo $this->Form->input('Facturation.¤.MA',array('style'=>"width:45px",'class'=>'form-control text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mardi",'value'=>"0.0")); ?> j</div></td>
        <td <?php echo $classME; ?> width='15px' style="text-align: center;"><div class="form-inline"><?php echo $this->Form->input('Facturation.¤.ME',array('style'=>"width:45px",'class'=>'form-control text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mercredi",'value'=>"0.0")); ?> j</div></td>
        <td <?php echo $classJE; ?> width='15px' style="text-align: center;"><div class="form-inline"><?php echo $this->Form->input('Facturation.¤.JE',array('style'=>"width:45px",'class'=>'form-control text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du du jeudi",'value'=>"0.0")); ?> j</div></td>
        <td <?php echo $classVE; ?> width='15px' style="text-align: center;"><div class="form-inline"><?php echo $this->Form->input('Facturation.¤.VE',array('style'=>"width:45px",'class'=>'form-control text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du vendredi",'value'=>"0.0")); ?> j</div></td>
        <td class='week <?php echo $classSA; ?>' width='15px' style="text-align: center;"><div class="form-inline"><?php echo $this->Form->input('Facturation.¤.SA',array('style'=>"width:45px",'class'=>'form-control text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du samedi",'value'=>"0.0")); ?> j</div></td>
        <td class='week <?php echo $classDI; ?>' width='15px' style="text-align: center;"><div class="form-inline"><?php echo $this->Form->input('Facturation.¤.DI',array('style'=>"width:45px",'class'=>'form-control text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du dimanche",'value'=>"0.0")); ?> j</div></td>
        <td width='15px' style="text-align: center;"><div class="form-inline">
        <?php echo $this->Form->input('Facturation.¤.TOTAL',array('type'=>'hidden','value'=>"0.0")); ?>
        <?php echo $this->Form->input('Facturation.¤.TotalDisabled',array('style'=>"width:45px",'class'=>'form-control text-right','value'=>"0.0",'disabled'=>'disabled')); ?> j</div></td> 
        <td width='15px' style="text-align: center;"><div class="form-inline">
        <?php echo $this->Form->input('Facturation.¤.FRAIS',array('style'=>"width:45px",'type'=>'text','class'=>'form-control text-right','value'=>'0.00')); ?> €</div></td>         
        <td style="display:none;">
        <?php if ($this->params->action == 'add') echo $this->Form->input('Facturation.¤.DATE',array('type'=>'hidden','value'=>isset($activitesreelle['Activitesreelle']['DATE']) ? $activitesreelle['Activitesreelle']['DATE'] : date('d/m/Y'))); ?>
        <?php if ($this->params->action == 'edit') echo $this->Form->input('Facturation.¤.DATE',array('type'=>'hidden','value'=>isset($activitesreelle['Facturation']['DATE']) ? $activitesreelle['Facturation']['DATE'] : date('d/m/Y'))); ?>           
        <?php echo $this->Form->input('Facturation.¤.utilisateur_id',array('type'=>'hidden','value'=>$userid)); ?> 
        <?php $valVersion = $this->params->action == 'add' ? !isset($activitesreelles[0]['Activitesreelle']['VERSION']) ? 0 : $activitesreelles[0]['Activitesreelle']['VERSION'] + 1 : '0'; ?>              
        <?php $valVersion = $this->params->action == 'edit' ? !isset($activitesreelle['Facturation']['VERSION']) ? 0 : $activitesreelle['Facturation']['VERSION'] + 1 : $valVersion; ?>            
        <?php echo $this->Form->input('Facturation.¤.VERSION',array('type'=>'hidden','class'=>'version','value'=>$valVersion)); ?>
        <?php $valFTGAL = $this->params->action == 'add' ? !isset($activitesreelles[0]['Activitesreelle']['NUMEROFTGALILEI']) ? '' : $activitesreelles[0]['Activitesreelle']['NUMEROFTGALILEI']: ''; ?>             
        <?php $valFTGAL = $this->params->action == 'edit' ? !isset($activitesreelle['Facturation']['NUMEROFTGALILEI']) ? '' : $activitesreelle['Facturation']['NUMEROFTGALILEI']: $valFTGAL; ?>                    
        <?php echo $this->Form->input('Facturation.¤.NUMEROFTGALILEI',array('type'=>'hidden','class'=>'ftgalilei','value'=>$valFTGAL)); ?>   
        <?php if ($this->params->action == 'edit') echo $this->Form->input('Facturation.¤.id',array('type'=>'hidden')); ?> 
        <?php if ($this->params->action == 'add') echo $this->Form->input('Facturation.¤.activitesreelle_id',array('type'=>'hidden','value'=>$activitesreelle['Activitesreelle']['id'])); ?>
        <?php if ($this->params->action == 'add') echo $this->Form->input('Facturation.¤.new',array('type'=>'hidden','value'=>'new')); ?>
        </td>
    </tr>    
    </tbody>
</table>
<table class='tablemax'>
    <tr>   
        <td><label class="col-md-8 control-label" for="FacturationVersion">Version : </label></td>
        <?php $valVersion = $this->params->action == 'add' ? !isset($activitesreelles[0]['Activitesreelle']['VERSION']) ? 0 : $activitesreelles[0]['Activitesreelle']['VERSION'] + 1 : '0'; ?>         
        <?php $valVersion = $this->params->action == 'edit' ? !isset($activitesreelles[0]['Facturation']['VERSION']) ? 0 : $activitesreelles[0]['Facturation']['VERSION'] + 1 : $valVersion; ?>
        <td><?php echo $this->Form->input('VERSION',array('placeholder'=>'Version','style'=>'width:45px;','value'=>$valVersion,'class'=>'form-control')); ?></td>
        <td><label class="col-md- control-label inline" for="FacturationNUMEROFTGALILEI">N° feuille de temps GALILEI : </label></td>
        <?php $valFTGAL = $this->params->action == 'add' ? !isset($activitesreelles[0]['Activitesreelle']['NUMEROFTGALILEI']) ? '' : $activitesreelles[0]['Activitesreelle']['NUMEROFTGALILEI']: ''; ?>         
        <?php $valFTGAL = $this->params->action == 'edit' ? !isset($activitesreelles[0]['Facturation']['NUMEROFTGALILEI']) ? '' : $activitesreelles[0]['Facturation']['NUMEROFTGALILEI']: $valFTGAL; ?>        
        <td><?php echo $this->Form->input('NUMEROFTGALILEI',array('placeholder'=>'N° feuille temps GALILEI','value'=>$valFTGAL,'class'=>'form-control')); ?></td>
        <td><?php echo $this->Form->button('Ajouter une ligne', array('type'=>'button','class' => 'btn btn-sm btn-default','id'=>'FacturationAddRow')); ?></td>
    </tr>
</table>
    <?php $memo = $this->requestAction('entites/get_memo/'.userAuth('entite_id')) ?>
    <?php if($memo!=""): ?>
    <div id="container_message_erreur_total" name="container_message_erreur_total" class="bs-callout bs-callout-warning" style="display: block;">
        <ol style="display: block;">
            <li><label for="Activitesreelle0ActiviteId" style="display: block;"><?php echo $memo; ?></label></li>
        </ol>
    </div>
    <?php endif; ?>
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php $url = $this->Html->url(array('controller'=>'activitesreelles','action'=>'index','tous',userAuth('id'),date('m'))); ?>
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>  
<?php echo $this->Form->end(); ?>  
</div>
<script>
$(document).ready(function () {
    $(document).on('change','.day',function(e){
        e.preventDefault;
        var id = $(this).attr('id').substring(0,($(this).attr('id').length)-2);
        parseFloat($(this).val()) > 1 ? $(this).addClass('invalid') : $(this).removeClass('invalid');
        parseFloat($(this).val()) > 1 ? $(this).focus() : '';
        $('#'+id+'TOTAL').val(parseFloat($('#'+id+'LU').val())+parseFloat($('#'+id+'MA').val())+parseFloat($('#'+id+'ME').val())+parseFloat($('#'+id+'JE').val())+parseFloat($('#'+id+'VE').val())+parseFloat($('#'+id+'SA').val())+parseFloat($('#'+id+'DI').val()));
        $('#'+id+'TOTAL').val($('#'+id+'TOTAL').val().replace(',', '.'));
        $('#'+id+'TotalDisabled').val($('#'+id+'TOTAL').val());
    });
    $(document).on('change','#FacturationVERSION',function(e){
        e.preventDefault;
        $('.version').val($(this).val());
    });
    $(document).on('change','#FacturationNUMEROFTGALILEI',function(e){
        e.preventDefault;
        $('.ftgalilei').val($(this).val());
    });
    $(document).on('click','#deleteRow',function(e){
        e.preventDefault;
        $(this).parents().parent('tr').remove();
    });    
    $(document).on('click','#FacturationAddRow',function(e){
        e.preventDefault;
        $("#templateRow").clone().removeAttr("id").appendTo( $("#templateRow").parent());
        $("tr:last-child .selectActivite").attr('data-rule-required',"true").attr('data-msg-required',"Le nom de l'activité est obligatoire");
        $("tr:last-child :input").each(function() {
            var nameAttr = typeof $(this).attr('name') === "undefined" ? "" : $(this).attr('name');
            var idAttr = typeof $(this).attr('id') === "undefined" ? "" : $(this).attr('id');
            var newIndex = $('#FacturationTable tr').length-4; 
            if (nameAttr != "") $(this).attr('name',nameAttr.replace('¤',newIndex));
            if (idAttr != "") $(this).attr('id',idAttr.replace('¤',newIndex));
        });        
    });
});
</script>
