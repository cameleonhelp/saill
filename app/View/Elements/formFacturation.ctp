<?php 
    $date = isset($this->data['Activitesreelle']['DATE']) ? $this->data['Activitesreelle']['DATE'] : date('d/m/Y');
    $d = explode('/',$date);
    $day = $d[0];
    $mois = $d[1];
    $annee = $d[2];
    $debutsemaine = debutsem($annee,$mois,$day);
    $finsemaine = finsem($annee, $mois, $day);
?>

<table cellpadding="0" cellspacing="0" class="table table-bordered">
    <thead>
    <tr>
        <th class="text-center" colspan="11">Facturation de l'activité pour la semaine du <span id="ActionreelleDebut" class="clearboth"><?php echo $debutsemaine; ?></span> au <span id="ActionreelleFin" class="clearboth"><?php echo $finsemaine; ?></span></th>
    </tr>
    <tr>
        <th rowspan="2" width="30px"><label class="control-label sstitre required">Activité</label></th>
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
        <th rowspan="2">Version</th>
        <th rowspan="2">Action</th>
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
<?php echo $this->Form->create('Facturation',array('id'=>'formValidate','class'=>'form-horizontal','action'=>'save','inputDefaults' => array('label'=>false,'div' => false))); ?>        
    <tr>
        <td><?php echo $this->Form->select('activite_id',$activites,array('style'=>'width:50px !important;','data-rule-required'=>'true','selected' => $activitesreelle['Activitesreelle']['activite_id'],'data-msg-required'=>"Le nom de l'activité est obligatoire", 'empty' => 'Choisir une activité')); ?></td>
        <td <?php echo $classLU; ?> width='15px'><?php echo $this->Form->input('LU',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du lundi")); ?> j</td>
        <td <?php echo $classMA; ?> width='15px'><?php echo $this->Form->input('MA',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mardi")); ?> j</td>
        <td <?php echo $classME; ?> width='15px'><?php echo $this->Form->input('ME',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mercredi")); ?> j</td>
        <td <?php echo $classJE; ?> width='15px'><?php echo $this->Form->input('JE',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du du jeudi")); ?> j</td>
        <td <?php echo $classVE; ?> width='15px'><?php echo $this->Form->input('VE',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du vendredi")); ?> j</td>
        <td class='week <?php echo $classSA; ?>' width='15px'><?php echo $this->Form->input('SA',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du samedi")); ?> j</td>
        <td class='week <?php echo $classDI; ?>' width='15px'><?php echo $this->Form->input('DI',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du dimanche")); ?> j</td>
        <td width='15px'><?php echo $this->Form->input('TOTAL',array('class'=>'span2 text-right')); ?> j</td> 
        <td width='15px'><?php echo $this->Form->input('VERSION',array('class'=>'span2 text-right')); ?></td> 
        <td><?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?></td> 
    </tr>
    <?php echo $this->Form->input('DATE',array('type'=>'hidden','value'=>isset($activitesreelle['Activitesreelle']['DATE']) ? $activitesreelle['Activitesreelle']['DATE'] : date('d/m/Y'))); ?>
    <?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden')); ?> 
    <?php echo $this->Form->input('action_id',array('type'=>'hidden')); ?>
    <?php echo $this->Form->input('activite_id',array('type'=>'hidden')); ?> 
    <?php echo $this->Form->input('id',array('type'=>'hidden')); ?> 
   <?php echo $this->Form->end(); ?>  
    </tbody>
</table>
<script>
$(document).ready(function () {    
    $('.day').on('change',function(e){
        e.preventDefault;
        parseFloat($(this).val()) > 1 ? $(this).addClass('invalid') : $(this).removeClass('invalid');
        parseFloat($(this).val()) > 1 ? $(this).focus() : '';
        $('#FacturationTOTAL').val(parseFloat($('#FacturationLU').val())+parseFloat($('#FacturationMA').val())+parseFloat($('#FacturationME').val())+parseFloat($('#FacturationJE').val())+parseFloat($('#FacturationVE').val())+parseFloat($('#FacturationSA').val())+parseFloat($('#FacturationDI').val()));
    });
    

});
</script>
