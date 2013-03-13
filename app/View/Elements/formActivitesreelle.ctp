<?php 
function debutsem($year,$month,$day) {
    $num_day      = date('w', mktime(0,0,0,$month,$day,$year));
    $premier_jour = mktime(0,0,0, $month,$day-(!$num_day?7:$num_day)+1,$year);
    $datedeb      = date('d/m/Y', $premier_jour);
    return $datedeb;
}

function finsem($year,$month,$day) {
    $num_day      = date('w', mktime(0,0,0,$month,$day,$year));
    $dernier_jour = mktime(0,0,0, $month,7-(!$num_day?7:$num_day)+$day,$year);
    $datedeb      = date('d/m/Y', $dernier_jour);
    return $datedeb;
}

function joursemaine($usdate){
    $jour = date('d', $usdate);
    return $jour;
}

function CUSDate($frdate){
    $day = explode('/',$frdate);
    return $day[2]."-".$day[1]."-".$day[0];
}

    $date = isset($this->data['Activitesreelle']['DATE']) ? $this->data['Activitesreelle']['DATE'] : date('d/m/Y');
    $d = explode('/',$date);
    $day = $d[0];
    $mois = $d[1];
    $annee = $d[2];
    $debutsemaine = debutsem($annee,$mois,$day);
    $finsemaine = finsem($annee, $mois, $day);
?>
<?php echo $this->Form->create('Activitesreelle',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
<?php if ($this->params->action == 'add') { ?>
<table>
    <tr>
        <td><label class="control-label sstitre required" for="ActivitesreelleUtilisateurId">Pour : </label></td>
        <td>
            <?php echo $this->Form->select('utilisateur_id',$utilisateurs,array('data-rule-required'=>'true','data-msg-required'=>"Le nom de l'utilisateur est obligatoire", 'empty' => 'Choisir un utilisateur')); ?>                     
        </td>
        <td></td>
        <td></td>        
    </tr>
    <tr>
        <td><label class="control-label sstitre required" for="ActivitesreelleDATE">Date début de semaine : </label></td>
        <td>
            <div class="input-append date" data-date="<?php echo empty($this->data['Activitesreelle']['DATE']) ? date('d/m/Y') : $this->data['Activitesreelle']['DATE']; ?>" data-date-format="dd/mm/yyyy">
                <?php $today = date('d/m/Y'); ?>
                <?php echo $this->Form->input('DATE',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true','data-rule-required'=>'true','data-msg-required'=>"La date de début de l'activité est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
                <span class="add-on"><i class="glyphicon_calendar"></i></span>
            </div>             
        </td>
        <td><label class="control-label sstitre required" for="ActivitesreelleActiviteId">Activité : </label></td>
        <td>
            <?php echo $this->Form->select('activite_id',$activites,array('data-rule-required'=>'true','data-msg-required'=>"Le nom de l'activité est obligatoire", 'empty' => 'Choisir une activité')); ?>          
        </td>        
    </tr>
</table>
<?php } ?>
<?php if ($this->params->action == 'edit') { ?>
<table cellpadding="0" cellspacing="0" class="table table-bordered">
    <thead>
    <tr>
        <th class="text-center" colspan="9">Répartition de l'activité pour la semaine du <span id="ActionreelleDebut" class="clearboth"><?php echo $debutsemaine; ?></span> au <span id="ActionreelleFin" class="clearboth"><?php echo $finsemaine; ?></span></th>
    </tr>
    <tr>
        <th rowspan="2">Activité</th>
        <th width='70px'>Lu.</th>
        <th width='70px'>Ma.</th>
        <th width='70px'>Me.</th>
        <th width='70px'>Je.</th>
        <th width='70px'>Ve.</th>
        <th class='week' width='70px'>Sa.</th>
        <th class='week' width='70px'>Di.</th>
        <th rowspan="2" width='70px'>Total</th>
    </tr>
    <tr>
        <?php $date = new DateTime(CUSDate($debutsemaine)); ?>    
        <th><?php echo $date->format('d'); ?></th>
        <?php $date->add(new DateInterval('P1D')); ?>   
        <th><?php echo $date->format('d'); ?></th>
        <?php $date->add(new DateInterval('P1D')); ?> 
        <th><?php echo $date->format('d'); ?></th>
        <?php $date->add(new DateInterval('P1D')); ?> 
        <th><?php echo $date->format('d'); ?></th>
        <?php $date->add(new DateInterval('P1D')); ?> 
        <th><?php echo $date->format('d'); ?></th>
        <?php $date->add(new DateInterval('P1D')); ?> 
        <th class='week'><?php echo $date->format('d'); ?></th>
        <?php $date->add(new DateInterval('P1D')); ?> 
        <th class='week'><?php echo $date->format('d'); ?>  </th>
    </tr> 
    </thead>
    <tbody>
    <tr>
        <td><?php echo $this->data['Activite']['NOM']; ?></td>
        <td width='15px'><?php echo $this->Form->input('LU',array('class'=>'span2 text-right day','data-rule-max'=>'1.0','data-msg-max'=>"Le maximum doit être de 1 sur la journée du lundi")); ?> j</td>
        <td width='15px'><?php echo $this->Form->input('MA',array('class'=>'span2 text-right day','data-rule-max'=>'1.0','data-msg-max'=>"Le maximum doit être de 1 sur la journée du mardi")); ?> j</td>
        <td width='15px'><?php echo $this->Form->input('ME',array('class'=>'span2 text-right day','data-rule-max'=>'1.0','data-msg-max'=>"Le maximum doit être de 1 sur la journée du mercredi")); ?> j</td>
        <td width='15px'><?php echo $this->Form->input('JE',array('class'=>'span2 text-right day','data-rule-max'=>'1.0','data-msg-max'=>"Le maximum doit être de 1 sur la journée du jeudi")); ?> j</td>
        <td width='15px'><?php echo $this->Form->input('VE',array('class'=>'span2 text-right day','data-rule-max'=>'1.0','data-msg-max'=>"Le maximum doit être de 1 sur la journée du vendredi")); ?> j</td>
        <td class='week' width='15px'><?php echo $this->Form->input('SA',array('class'=>'span2 text-right day','data-rule-max'=>'1.0','data-msg-max'=>"Le maximum doit être de 1 sur la journée du samedi")); ?> j</td>
        <td class='week' width='15px'><?php echo $this->Form->input('DI',array('class'=>'span2 text-right day','data-rule-max'=>'1.0','data-msg-max'=>"Le maximum doit être de 1 sur la journée du dimanche")); ?> j</td>
        <td width='15px'><?php echo $this->Form->input('TOTAL',array('class'=>'span2 text-right')); ?> j</td>        
    </tr>
    <?php if($this->data['Activite']['projet_id']==1) { ?>
    <tr>
        <td>Commence le matin</td>
        <td width='15px' style="text-align: center;"><?php echo $this->Form->input('LU_TYPE',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class='labelAfter' for='ActivitesreelleLUTYPE'></label></td>
        <td width='15px' style="text-align: center;"><?php echo $this->Form->input('MA_TYPE',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class='labelAfter' for='ActivitesreelleMATYPE'></label></td>
        <td width='15px' style="text-align: center;"><?php echo $this->Form->input('ME_TYPE',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class='labelAfter' for='ActivitesreelleMETYPE'></label></td>
        <td width='15px' style="text-align: center;"><?php echo $this->Form->input('JE_TYPE',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class='labelAfter' for='ActivitesreelleJETYPE'></label></td>
        <td width='15px' style="text-align: center;"><?php echo $this->Form->input('VE_TYPE',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class='labelAfter' for='ActivitesreelleVETYPE'></label></td>
        <td width='15px' style="text-align: center;"><?php echo $this->Form->input('SA_TYPE',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class='labelAfter' for='ActivitesreelleSATYPE'></label></td>
        <td width='15px' style="text-align: center;"><?php echo $this->Form->input('DI_TYPE',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class='labelAfter' for='ActivitesreelleDITYPE'></label></td>
        <td width='15px'>&nbsp;</td>        
    </tr>    
    <?php } ?>
    <?php echo $this->Form->input('DATE',array('type'=>'hidden','value'=>isset($this->data['Activitesreelle']['DATE']) ? $this->data['Activitesreelle']['DATE'] : date('d/m/Y'))); ?>
    <?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden')); ?> 
    <?php echo $this->Form->input('action_id',array('type'=>'hidden')); ?>
    <?php echo $this->Form->input('activite_id',array('type'=>'hidden')); ?> 
    <?php echo $this->Form->input('id',array('type'=>'hidden')); ?> 
    </tbody>
</table>
<?php } ?>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php $url = $this->Session->read('history'); ?>
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url($url[0])."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                  
                <?php if ($this->params->action == 'edit') echo $this->Form->button('Dupliquer pour la semaine suivante', array('class' => 'btn btn-inverse pull-right','type'=>'button','onclick'=>"location.href='".$this->Html->url('/activitesreelles/duplicate/'.$this->request->data['Activitesreelle']['id'])."'")); ?>
            </div>
        </div>
    </div>  
<?php echo $this->Form->end(); ?>   

<script>
$(document).ready(function () {    
    $('.day').on('change',function(e){
        e.preventDefault;
        parseFloat($(this).val()) > 1 ? $(this).addClass('invalid') : $(this).removeClass('invalid');
        parseFloat($(this).val()) > 1 ? $(this).focus() : '';
        $('#ActivitesreelleTOTAL').val(parseFloat($('#ActivitesreelleLU').val())+parseFloat($('#ActivitesreelleMA').val())+parseFloat($('#ActivitesreelleME').val())+parseFloat($('#ActivitesreelleJE').val())+parseFloat($('#ActivitesreelleVE').val())+parseFloat($('#ActivitesreelleSA').val())+parseFloat($('#ActivitesreelleDI').val()));
    });
    

});
</script>
