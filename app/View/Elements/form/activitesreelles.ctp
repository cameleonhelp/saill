<div class="">
    <?php 
    $date = isset($activitesreelles[0]['Activitesreelle']['DATE']) ? $activitesreelles[0]['Activitesreelle']['DATE'] : date('d/m/Y');
    $date = (isset($this->params->pass[1]) && is_date($this->params->pass[1])) ? CFRDate($this->params->pass[1]) : $date;
    $datedebut = $date;
    if ($this->params->action == "add" ) $userid = isset($this->params->pass[0]) ? $this->params->pass[0] : '';   
    if ($this->params->action == "edit" ) $userid = isset($activitesreelles[0]['Activitesreelle']['utilisateur_id']) ? $activitesreelles[0]['Activitesreelle']['utilisateur_id'] : '';
    $d = explode('/',$date);
    $day = $d[0];
    $mois = $d[1];
    $annee = $d[2];
    $debutsemaine = debutsem($annee,$mois,$day);
    $finsemaine = finsem($annee, $mois, $day);
?>
<?php echo $this->Form->create('Activitesreelle',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
<?php $nbjourouvresmax = 5; ?>
<table cellpadding="0" cellspacing="0" class="table table-bordered tablemax" id="ActivitesreelleTable">
    <thead>
    <tr>
        <th class="text-center" colspan="12">Répartition de l'activité pour la semaine du <span id="ActionreelleDebut" class="clearboth"><?php echo $debutsemaine; ?></span> au <span id="ActionreelleFin" class="clearboth"><?php echo $finsemaine; ?></span> de <?php echo $this->requestAction('utilisateurs/get_nomlong/'.$userid); ?></th>
    </tr>
    <tr>
        <th rowspan="2" style="min-width:200px;max-width:200px;width:200px !important;"><label class="required">Activité</label></th>
        <th rowspan="2" style="min-width:200px;max-width:200px;width:200px !important;"><label>Domaine</label></th>
        <?php $date = new DateTime(CUSDate($debutsemaine)); $LU = $date->format('d'); ?> 
        <?php $classLU = isFerie($date) ? 'class="ferie"' : ''; 
              $nbjourouvresmax = isFerie($date) ? $nbjourouvresmax-1 : $nbjourouvresmax; ?>
        <th <?php echo $classLU; ?> width='70px'>Lu.</th>
        <?php $date->add(new DateInterval('P1D')); $MA = $date->format('d'); ?> 
        <?php $classMA = isFerie($date) ? 'class="ferie"' : '';  
              $nbjourouvresmax = isFerie($date) ? $nbjourouvresmax-1 : $nbjourouvresmax; ?>
        <th <?php echo $classMA; ?> width='70px'>Ma.</th>
        <?php $date->add(new DateInterval('P1D')); $ME = $date->format('d'); ?>
        <?php $classME = isFerie($date) ? 'class="ferie"' : '';  
              $nbjourouvresmax = isFerie($date) ? $nbjourouvresmax-1 : $nbjourouvresmax; ?>
        <th <?php echo $classME; ?> width='70px'>Me.</th>
        <?php $date->add(new DateInterval('P1D')); $JE = $date->format('d'); ?> 
        <?php $classJE = isFerie($date) ? 'class="ferie"' : '';  
              $nbjourouvresmax = isFerie($date) ? $nbjourouvresmax-1 : $nbjourouvresmax; ?>
        <th <?php echo $classJE; ?> width='70px'>Je.</th>
        <?php $date->add(new DateInterval('P1D')); $VE = $date->format('d'); ?> 
        <?php $classVE = isFerie($date) ? 'class="ferie"' : '';  
              $nbjourouvresmax = isFerie($date) ? $nbjourouvresmax-1 : $nbjourouvresmax; ?>       
        <th <?php echo $classVE; ?> width='70px'>Ve.</th>
        <?php $date->add(new DateInterval('P1D')); $SA = $date->format('d'); ?> 
        <?php $classSA = isFerie($date) ? ' ferie' : ''; ?>        
        <th class='week <?php echo $classSA; ?>' width='70px'>Sa.</th>
        <?php $date->add(new DateInterval('P1D')); $DI = $date->format('d'); ?> 
        <?php $classDI = isFerie($date) ? ' ferie' : ''; ?>        
        <th class='week <?php echo $classDI; ?>' width='70px'>Di.</th>
        <th rowspan="2" width='70px'>Total</th>
        <th rowspan="2" width='70px'>Frais</th>
        <th rowspan="2" width='35px'></th>
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
    <?php if ($this->params->action=='edit') : ?>
    <?php $i=0; $j=0;?>
    <?php foreach($activitesreelles as $activitesreelle): ?>           
    <tr>
        <td style="vertical-align: top !important;padding-top:5px !important;">
            <div class="col-md-12 form-horizontal">
            <?php $tooltip = $this->params->action=='edit' ? " rel='tooltip' data-trigger='hover' data-placement='auto' title='".$activitesreelle['Activite']['NOM']."'" : ""; ?>
                <select name="data[Activitesreelle][<?php echo $i; ?>][activite_id]" class="form-control" data-rule-required="true" <?php echo $tooltip; ?> data-msg-required="Le nom de l'activité est obligatoire" id="Activitesreelle<?php echo $i; ?>ActiviteId"> 
                <option value="">Choisir une activité</option>
                <?php foreach ($activites as $activite) : ?>
                <?php $selected = ''; ?>
                <?php $selected = $activite['Activite']['id']==$activitesreelle['Activitesreelle']['activite_id'] ? 'selected="selected"' :''; ?>
                    <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?>><?php echo $activite['Projet']['NOM']; ?> - <?php echo $activite['Activite']['NOM']; ?></option>
                <?php endforeach; ?>
            </select>  
            <div>Commence le matin</div></div>
        </td>
        <td style="vertical-align: top !important;padding-top:5px !important;">
            <div class="col-md-12">
            <?php if ($this->params->action == 'edit') { ?>
                <?php $selected = isset($activitesreelle['Activitesreelle']['domaine_id']) ? $activitesreelle['Activitesreelle']['domaine_id'] : ''; ?>
                <?php echo $this->Form->select('Activitesreelle.'.$i.'.domaine_id',$domaines,array('class'=>'form-control','default' => $selected,'empty' => 'Choisir un domaine','rel'=>"tooltip",'data-trigger'=>"hover",'data-placement'=>"auto",'title'=>$activitesreelle['Domaine']['NOM'])); ?>
            <?php } else { ?>
                <?php echo $this->Form->select('Activitesreelle.'.$i.'.domaine_id',$domaines,array('class'=>'form-control','empty' => 'Choisir un domaine')); ?>
            <?php } ?>  
            </div>
        </td>
        <td <?php echo $classLU; ?> width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.'.$i.'.LU',array('style'=>"width:45px",'class'=>'form-control form-inline text-right day lu','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du lundi",'value'=>$activitesreelle['Activitesreelle']['LU'])); ?><div class="nomargin nopadding pull-right"> j</div></div>
            <?php $luchecked = $activitesreelle['Activitesreelle']['LU_TYPE'] ==1 ? 'checked' :''; ?>
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.LU_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>$luchecked)); ?>&nbsp;<label class='labelAfter' for='Activitesreelle<?php echo $i; ?>LUTYPE'></label>
            </div>
        </td>
        <td <?php echo $classMA; ?> width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.'.$i.'.MA',array('style'=>"width:45px",'class'=>'form-control text-right day ma','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mardi",'value'=>$activitesreelle['Activitesreelle']['MA'])); ?><div class="nomargin nopadding pull-right"> j</div></div>
            <?php $machecked = $activitesreelle['Activitesreelle']['MA_TYPE'] ==1 ? 'checked' :''; ?>
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.MA_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>$machecked)); ?>&nbsp;<label class='labelAfter' for='Activitesreelle<?php echo $i; ?>MATYPE'></label>
            </div>
        </td>
        <td <?php echo $classME; ?> width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.'.$i.'.ME',array('style'=>"width:45px",'class'=>'form-control text-right day me','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mercredi",'value'=>$activitesreelle['Activitesreelle']['ME'])); ?><div class="nomargin nopadding pull-right"> j</div></div>
            <?php $mechecked = $activitesreelle['Activitesreelle']['ME_TYPE'] ==1 ? 'checked' :''; ?>
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.ME_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>$mechecked)); ?>&nbsp;<label class='labelAfter' for='Activitesreelle<?php echo $i; ?>METYPE'></label>
            </div>
        </td>
        <td <?php echo $classJE; ?> width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.'.$i.'.JE',array('style'=>"width:45px",'class'=>'form-control text-right day je','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du du jeudi",'value'=>$activitesreelle['Activitesreelle']['JE'])); ?><div class="nomargin nopadding pull-right"> j</div></div>
            <?php $jechecked = $activitesreelle['Activitesreelle']['JE_TYPE'] ==1 ? 'checked' :''; ?>
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.JE_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>$jechecked)); ?>&nbsp;<label class='labelAfter' for='Activitesreelle<?php echo $i; ?>JETYPE'></label>
            </div>
        </td>
        <td <?php echo $classVE; ?> width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.'.$i.'.VE',array('style'=>"width:45px",'class'=>'form-control text-right day ve','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du vendredi",'value'=>$activitesreelle['Activitesreelle']['VE'])); ?><div class="nomargin nopadding pull-right"> j</div></div>
            <?php $vechecked = $activitesreelle['Activitesreelle']['VE_TYPE'] ==1 ? 'checked' :''; ?>
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.VE_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>$vechecked)); ?>&nbsp;<label class='labelAfter' for='Activitesreelle<?php echo $i; ?>VETYPE'></label>
            </div>
        </td>
        <td class='week <?php echo $classSA; ?>' width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.'.$i.'.SA',array('style'=>"width:45px",'class'=>'form-control text-right day sa','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du samedi",'value'=>$activitesreelle['Activitesreelle']['SA'])); ?><div class="nomargin nopadding pull-right"> j</div></div>
            <?php $sachecked = $activitesreelle['Activitesreelle']['SA_TYPE'] ==1 ? 'checked' :''; ?>
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.SA_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>$sachecked)); ?>&nbsp;<label class='labelAfter' for='Activitesreelle<?php echo $i; ?>SATYPE'></label>
            </div>
        </td>
        <td class='week <?php echo $classDI; ?>' width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.'.$i.'.DI',array('style'=>"width:45px",'class'=>'form-control text-right day di','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du dimanche",'value'=>$activitesreelle['Activitesreelle']['DI'])); ?><div class="nomargin nopadding pull-right"> j</div></div>
            <?php $dichecked = $activitesreelle['Activitesreelle']['DI_TYPE'] ==1 ? 'checked' :''; ?>
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.DI_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>$dichecked)); ?>&nbsp;<label class='labelAfter' for='Activitesreelle<?php echo $i; ?>DITYPE'></label>
            </div>
        </td>
        <td width='15px' style="text-align: center;">
            <div class="form-horizontal"><div class="form-inline">
                <?php echo $this->Form->input('Activitesreelle.'.$i.'.TOTAL',array('type'=>'hidden','data-rule-isZero'=>true,'data-msg-isZero'=>"Le total est incorrect changez une valeur de votre saisie.",'value'=>$activitesreelle['Activitesreelle']['TOTAL'])); ?><?php echo $this->Form->input('Activitesreelle.'.$i.'.TotalDisabled',array('style'=>"width:45px",'class'=>'form-control text-right total','for'=>'Activitesreelle'.$i.'TOTAL','disabled'=>'disabled','value'=>$activitesreelle['Activitesreelle']['TOTAL'])); ?><div class="nomargin nopadding pull-right"> j</div></div>
        </td>   
        <td width='15px' style="text-align: center;">
            <div class="form-horizontal"><div class="form-inline">
                <?php echo $this->Form->input('Activitesreelle.'.$i.'.FRAIS',array('type'=>'text','style'=>"width:45px",'class'=>'form-control text-right frais','for'=>'Activitesreelle'.$i.'FRAIS','value'=>isset($activitesreelle['Activitesreelle']['FRAIS']) ? $activitesreelle['Activitesreelle']['FRAIS'] : '' )); ?><div class="nomargin nopadding pull-right"> €</div></div>
        </td>         
        <td style="vertical-align: top !important;padding-top:5px !important;"> 
            <?php if ($i==0) : ?>
            <span class="glyphicons blank"></span>
            <?php else : ?>
            <span class="glyphicons minus cursor" id="deleteRow" action_id="<?php echo $activitesreelle['Activitesreelle']['id']; ?>"></span>
            <?php endif; ?>
            <span class="glyphicons plus cursor" id="addRow"></span>  
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.DATE',array('type'=>'hidden','value'=>$activitesreelle['Activitesreelle']['DATE'])); ?>
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.utilisateur_id',array('type'=>'hidden','value'=>$activitesreelle['Activitesreelle']['utilisateur_id'])); ?> 
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.action_id',array('type'=>'hidden','value'=>$activitesreelle['Activitesreelle']['action_id'])); ?>
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.VEROUILLE',array('type'=>'hidden','value'=>$activitesreelle['Activitesreelle']['VEROUILLE'])); ?>  
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.facturation_id',array('type'=>'hidden','value'=>$activitesreelle['Activitesreelle']['facturation_id'])); ?> 
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.id',array('type'=>'hidden','value'=>$activitesreelle['Activitesreelle']['id'])); ?> 
        </td>       
    </tr>    
    <?php $i++; $j+=14;?>
    <?php endforeach; ?>  
    <?php else : ?>
    <tr>
        <td style="vertical-align: top !important;padding-top:5px !important;">
            <div class="col-md-12 form-horizontal">
            <select name="data[Activitesreelle][0][activite_id]" class="form-control" data-rule-required="true" data-msg-required="Le nom de l'activité est obligatoire" id="Activitesreelle0ActiviteId"> 
                <option value="">Choisir une activité</option>
                <?php foreach ($activites as $activite) : ?>
                <?php $selected = ''; ?>
                <?php if ($this->params->action == 'edit') $selected = $activite['Activite']['id']==$activitesreelle['Activitesreelle']['activite_id'] ? 'selected="selected"' :''; ?>
                    <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?>><?php echo $activite['Projet']['NOM']; ?> - <?php echo $activite['Activite']['NOM']; ?></option>
                <?php endforeach; ?>
            </select>        
            <div>Commence le matin</div></div>
        </td>
        <td style="vertical-align: top !important;padding-top:5px !important;">
            <div class="col-md-12">
                <?php echo $this->Form->select('Activitesreelle.0.domaine_id',$domaines,array('class'=>'form-control','empty' => 'Choisir un domaine')); ?>
            </div>              
        </td>        
        <td <?php echo $classLU; ?> width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.0.LU',array('style'=>"width:45px",'class'=>'form-control text-right day lu','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du lundi",'value'=>'0.0')); ?><div class="nomargin nopadding pull-right"> j</div></div>
        <?php echo $this->Form->input('Activitesreelle.0.LU_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle0LUTYPE'></label>
        </td>
        <td <?php echo $classMA; ?> width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.0.MA',array('style'=>"width:45px",'class'=>'form-control text-right day ma','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mardi",'value'=>'0.0')); ?><div class="nomargin nopadding pull-right"> j</div></div>
        <?php echo $this->Form->input('Activitesreelle.0.MA_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle0MATYPE'></label>
        </td>
        <td <?php echo $classME; ?> width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.0.ME',array('style'=>"width:45px",'class'=>'form-control text-right day me','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mercredi",'value'=>'0.0')); ?><div class="nomargin nopadding pull-right"> j</div></div>
        <?php echo $this->Form->input('Activitesreelle.0.ME_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle0METYPE'></label>
        </td>
        <td <?php echo $classJE; ?> width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.0.JE',array('style'=>"width:45px",'class'=>'form-control text-right day je','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du du jeudi",'value'=>'0.0')); ?><div class="nomargin nopadding pull-right"> j</div></div>
        <?php echo $this->Form->input('Activitesreelle.0.JE_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle0JETYPE'></label>
        </td>
        <td <?php echo $classVE; ?> width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.0.VE',array('style'=>"width:45px",'class'=>'form-control text-right day ve','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du vendredi",'value'=>'0.0')); ?><div class="nomargin nopadding pull-right"> j</div></div>
        <?php echo $this->Form->input('Activitesreelle.0.VE_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle0VETYPE'></label>
        </td>
        <td class='week <?php echo $classSA; ?>' width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.0.SA',array('style'=>"width:45px",'class'=>'form-control text-right day sa','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du samedi",'value'=>'0.0')); ?><div class="nomargin nopadding pull-right"> j</div></div>
        <?php echo $this->Form->input('Activitesreelle.0.SA_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle0SATYPE'></label>
        </td>
        <td class='week <?php echo $classDI; ?>' width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.0.DI',array('style'=>"width:45px",'class'=>'form-control text-right day di','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du dimanche",'value'=>'0.0')); ?><div class="nomargin nopadding pull-right"> j</div></div>
        <?php echo $this->Form->input('Activitesreelle.0.DI_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle0DITYPE'></label>
        </td>
        <td width='15px' style="text-align: center;">
            <div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.0.TOTAL',array('type'=>'hidden','data-rule-isZero'=>true,'data-msg-isZero'=>"Le total est incorrect changez une valeur de votre saisie.",'value'=>'0.0')); ?><?php echo $this->Form->input('Activitesreelle.0.TotalDisabled',array('style'=>"width:45px",'class'=>'form-control text-right total','for'=>'Activitesreelle0TOTAL','disabled'=>'disabled','value'=>isset($this->data['Activitesreelle']['TOTAL']) ? $this->data['Activitesreelle']['TOTAL'] : "0.0")); ?><div class="nomargin nopadding pull-right"> j</div></div></td>        
        <td width='15px' style="text-align: center;">
            <div class="form-horizontal"><div class="form-inline">
                <?php echo $this->Form->input('Activitesreelle.0.FRAIS',array('style'=>"width:45px",'class'=>'form-control text-right frais','for'=>'Activitesreelle0FRAIS','value'=>$this->params->action == 'edit' ? $activitesreelle['Activitesreelle']['FRAIS'] : '0.00')); ?><div class="nomargin nopadding pull-right"> €</div></div>
        </td>            
            <td style="vertical-align: top !important;padding-top:5px !important;">    
            <span class="glyphicons blank"></span>
            <span class="glyphicons plus cursor" id="addRow"></span>             
            <?php echo $this->Form->input('Activitesreelle.0.DATE',array('type'=>'hidden','value'=>$datedebut)); ?>
            <?php echo $this->Form->input('Activitesreelle.0.utilisateur_id',array('type'=>'hidden','value'=>$userid)); ?> 
            <?php echo $this->Form->input('Activitesreelle.0.action_id',array('type'=>'hidden','value'=>isset($this->data['Activitesreelle']['action_id']) ? $this->data['Activitesreelle']['action_id'] : '')); ?>
            <?php echo $this->Form->input('Activitesreelle.0.VEROUILLE',array('type'=>'hidden','value'=>1)); ?> 
            <?php echo $this->Form->input('Activitesreelle.0.facturation_id',array('type'=>'hidden','value'=>'')); ?>             
        </td>       
    </tr> 
    <?php endif; ?>    
    <tr  id="templateRow">
        <td style="vertical-align: top !important;padding-top:5px !important;">
            <div class="col-md-12 form-horizontal">
            <select name="data[Activitesreelle][¤][activite_id]" class="form-control" id="Activitesreelle¤ActiviteId" class="selectActivite"> 
                <option value="">Choisir une activité</option>
                <?php foreach ($activites as $activite) : ?>
                    <option value="<?php echo $activite['Activite']['id']; ?>"><?php echo $activite['Projet']['NOM']; ?> - <?php echo $activite['Activite']['NOM']; ?></option>
                <?php endforeach; ?>
            </select>        
            <div>Commence le matin</div></div>
        </td>
        <td style="vertical-align: top !important;padding-top:5px !important;">            
            <div class="col-md-12">
            <?php echo $this->Form->select('Activitesreelle.¤.domaine_id',$domaines,array('class'=>'form-control','empty' => 'Choisir un domaine')); ?>  
            </div>              
        </td>         
        <td <?php echo $classLU; ?> width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.¤.LU',array('style'=>"width:45px",'class'=>'form-control text-right day lu','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du lundi",'value'=>'0.0')); ?><div class="nomargin nopadding pull-right"> j</div></div>
        <?php echo $this->Form->input('Activitesreelle.¤.LU_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle¤LUTYPE'></label>
        </td>
        <td <?php echo $classMA; ?> width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.¤.MA',array('style'=>"width:45px",'class'=>'form-control text-right day ma','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mardi",'value'=>'0.0')); ?><div class="nomargin nopadding pull-right"> j</div></div>
        <?php echo $this->Form->input('Activitesreelle.¤.MA_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle¤MATYPE'></label>
        </td>
        <td <?php echo $classME; ?> width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.¤.ME',array('style'=>"width:45px",'class'=>'form-control text-right day me','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mercredi",'value'=>'0.0')); ?><div class="nomargin nopadding pull-right"> j</div></div>
        <?php echo $this->Form->input('Activitesreelle.¤.ME_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle¤METYPE'></label>
        </td>
        <td <?php echo $classJE; ?> width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.¤.JE',array('style'=>"width:45px",'class'=>'form-control text-right day je','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du du jeudi",'value'=>'0.0')); ?><div class="nomargin nopadding pull-right"> j</div></div>
        <?php echo $this->Form->input('Activitesreelle.¤.JE_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle¤JETYPE'></label>
        </td>
        <td <?php echo $classVE; ?> width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.¤.VE',array('style'=>"width:45px",'class'=>'form-control text-right day ve','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du vendredi",'value'=>'0.0')); ?><div class="nomargin nopadding pull-right"> j</div></div>
        <?php echo $this->Form->input('Activitesreelle.¤.VE_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle¤VETYPE'></label>
        </td>
        <td class='week <?php echo $classSA; ?>' width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.¤.SA',array('style'=>"width:45px",'class'=>'form-control text-right day sa','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du samedi",'value'=>'0.0')); ?><div class="nomargin nopadding pull-right"> j</div></div>
        <?php echo $this->Form->input('Activitesreelle.¤.SA_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle¤SATYPE'></label>
        </td>
        <td class='week <?php echo $classDI; ?>' width='15px' style="text-align: center;"><div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.¤.DI',array('style'=>"width:45px",'class'=>'form-control text-right day di','min'=>0,'max'=>1,'step'=>0.5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du dimanche",'value'=>'0.0')); ?><div class="nomargin nopadding pull-right"> j</div></div>
        <?php echo $this->Form->input('Activitesreelle.¤.DI_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle¤DITYPE'></label>
        </td>
        <td width='15px' style="text-align: center;">
            <div class="form-horizontal"><div class="form-inline"><?php echo $this->Form->input('Activitesreelle.¤.TOTAL',array('type'=>'hidden','class'=>'totalhidden','value'=>'0.0')); ?><?php echo $this->Form->input('Activitesreelle.¤.TotalDisabled',array('style'=>"width:45px",'class'=>'form-control text-right total','for'=>'Activitesreelle¤TOTAL','disabled'=>'disabled','value'=>"0.0")); ?><div class="nomargin nopadding pull-right"> j</div></div></td>        
        <td width='15px' style="text-align: center;">
            <div class="form-horizontal"><div class="form-inline">
                <?php echo $this->Form->input('Activitesreelle.¤.FRAIS',array('style'=>"width:45px",'class'=>'form-control text-right frais','for'=>'Activitesreelle¤FRAIS','value'=>'0.00','type'=>'text')); ?><div class="nomargin nopadding pull-right"> €</div></div>
        </td>            
            <td style="vertical-align: top !important;padding-top:5px !important;">    
            <span class="glyphicons minus cursor" id="deleteRow"></span>
            <span class="glyphicons plus cursor" id="addRow"></span>            
            <?php echo $this->Form->input('Activitesreelle.¤.DATE',array('type'=>'hidden','value'=>$datedebut)); ?>
            <?php echo $this->Form->input('Activitesreelle.¤.utilisateur_id',array('type'=>'hidden','value'=>$userid)); ?> 
            <?php echo $this->Form->input('Activitesreelle.¤.action_id',array('type'=>'hidden','value'=>'')); ?>
            <?php echo $this->Form->input('Activitesreelle.¤.VEROUILLE',array('type'=>'hidden','value'=>1)); ?> 
            <?php echo $this->Form->input('Activitesreelle.¤.facturation_id',array('type'=>'hidden','value'=>'')); ?>             
        </td>       
    </tr> 
    </tr> 
    </tbody>
    <tfoot>
    <tr>
        <td colspan="2" class="footer" style="text-align:right;">Total :</td>
        <td class="footer" id="totallu" style="text-align:center;"></td>
        <td class="footer" id="totalma" style="text-align:center;"></td>
        <td class="footer" id="totalme" style="text-align:center;"></td>
        <td class="footer" id="totalje" style="text-align:center;"></td>
        <td class="footer" id="totalve" style="text-align:center;"></td>
        <td class="footer" id="totalsa" style="text-align:center;"></td>
        <td class="footer" id="totaldi" style="text-align:center;"></td>
        <td class="footer" id="totalactivites" style="text-align:center;"></td>
        <td colspan="2" class="footer" id="totalfrais" width="90px" style="text-align:center;"></td>
    </tr>            
    </tfoot>
</table>
    <div id="container_message_erreur_total" name="container_message_erreur_total" class="bs-callout bs-callout-danger" style="display: block;">
        <ul style="display: block;list-style: none;margin-left:-30px;margin-bottom:-7px;">
            <li><label for="Activitesreelle0ActiviteId" class="error" style="display: block;">Le total devrait être de <?php echo $nbjourouvresmax; ?> ce qui n'est pas le cas, votre saisie est incomplète ou il y a une erreur de saisie.</label></li>
            <li><label for="Activitesreelle0ActiviteId" class="error" style="display: block;">Vous pouvez continuer à faire votre saisie plus tard, il faudra pour valider cette feuille de temps que la semaine soit complète.</label></li>
        </ul>
    </div>
    <?php if (userAuth('profil_id')==1 || isAuthorized('activitesreelles', 'masse')) : ?>
    <div class="form-group" style='margin-left:2px;'>
    <?php echo $this->Form->input('saisietotal',array('type'=>'checkbox')); ?>&nbsp;<label class='labelAfter' for="ActivitesreelleSaisietotal"><em>Saisie pour ressources génériques ou saisie en masse dans la colonne total</em></label>
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
</div>
<?php echo $this->Form->end(); ?>   

<script>
$(document).ready(function () { 
    
    $("#container_message_erreur_total").hide();
    
    $(document).on('change','.day',function(e){
        e.preventDefault;
        var id = $(this).attr('id').substring(0,($(this).attr('id').length)-2); 
        parseFloat($(this).val()) > 1 ? $(this).addClass('invalid') : $(this).removeClass('invalid');
        parseFloat($(this).val()) > 1 ? $(this).focus() : '';
        $('#'+id+'TOTAL').val(parseFloat($('#'+id+'LU').val())+parseFloat($('#'+id+'MA').val())+parseFloat($('#'+id+'ME').val())+parseFloat($('#'+id+'JE').val())+parseFloat($('#'+id+'VE').val())+parseFloat($('#'+id+'SA').val())+parseFloat($('#'+id+'DI').val()));
        $('#'+id+'TotalDisabled').val($('#'+id+'TOTAL').val());
    });
    
    $(document).on('click','#ActivitesreelleSaisietotal',function(e){
        e.preventDefault;
        if($(this).is(':checked')){
            $(".day").prop('disabled', true);
            $(".total").prop('disabled', false);
        } else {
            $(".day").prop('disabled', false);
            $(".total").prop('disabled', true);            
        }
    });
    
    $(document).on('change','.lu',function(e){
        e.preventDefault;
        $("#totallu").html(sumOfColumns('lu','j'));
        $("#totalactivites").html(sumOfColumns('total','j'));
        if ($("#totallu").html()>1 || $("#totallu").html()<0) {$("#totallu").addClass('td-error')} else {$("#totallu").removeClass('td-error')}
        var totalmax = <?php echo number_format((float)$nbjourouvresmax, 2); ?>;
        if ($("#totalactivites").html() != totalmax.toFixed(2)+' j' && $("#totalactivites").html()!=0.00) {$("#totalactivites").addClass('td-error'); $("#container_message_erreur_total").fadeIn();} else {$("#totalactivites").removeClass('td-error'); $("#container_message_erreur_total").fadeOut();}
    });
    
    $(document).on('change','.total',function(e){
        forattr = $(this).attr('for');
        //$("'#"+forattr+"'").val($(this).val());
        newtotal = $(this).val();
        $('#'+forattr).val(newtotal);
    });
    
    $(document).on('change','.ma',function(e){
        e.preventDefault;
        $("#totalma").html(sumOfColumns('ma','j'));
        $("#totalactivites").html(sumOfColumns('total','j'));
        if ($("#totalma").html()>1 || $("#totalma").html()<0) {$("#totalma").addClass('td-error')} else {$("#totalma").removeClass('td-error')}
        var totalmax = <?php echo number_format((float)$nbjourouvresmax, 2); ?>;
        if ($("#totalactivites").html() != totalmax.toFixed(2)+' j' && $("#totalactivites").html()!=0.00) {$("#totalactivites").addClass('td-error'); $("#container_message_erreur_total").fadeIn();} else {$("#totalactivites").removeClass('td-error'); $("#container_message_erreur_total").fadeOut();}        
    });    
    
    $(document).on('change','.me',function(e){
        e.preventDefault;
        $("#totalme").html(sumOfColumns('me','j'));
        $("#totalactivites").html(sumOfColumns('total','j'));
        if ($("#totalme").html()>1 || $("#totalme").html()<0) {$("#totalme").addClass('td-error')} else {$("#totalme").removeClass('td-error')}
        var totalmax = <?php echo number_format((float)$nbjourouvresmax, 2); ?>;
        if ($("#totalactivites").html() != totalmax.toFixed(2)+' j' && $("#totalactivites").html()!=0.00){$("#totalactivites").addClass('td-error'); $("#container_message_erreur_total").fadeIn();} else {$("#totalactivites").removeClass('td-error'); $("#container_message_erreur_total").fadeOut();}        
    });
    
    $(document).on('change','.je',function(e){
        e.preventDefault;
        $("#totalje").html(sumOfColumns('je','j'));
        $("#totalactivites").html(sumOfColumns('total','j'));
        if ($("#totalje").html()>1 || $("#totalje").html()<0) {$("#totalje").addClass('td-error')} else {$("#totalje").removeClass('td-error')}
        var totalmax = <?php echo number_format((float)$nbjourouvresmax, 2); ?>;
        if ($("#totalactivites").html() != totalmax.toFixed(2)+' j' && $("#totalactivites").html()!=0.00) {$("#totalactivites").addClass('td-error'); $("#container_message_erreur_total").fadeIn();} else {$("#totalactivites").removeClass('td-error'); $("#container_message_erreur_total").fadeOut();}
    });
    
    $(document).on('change','.ve',function(e){
        e.preventDefault;
        $("#totalve").html(sumOfColumns('ve','j'));
        $("#totalactivites").html(sumOfColumns('total','j'));
        if ($("#totalve").html()>1 || $("#totalve").html()<0) {$("#totalve").addClass('td-error')} else {$("#totalve").removeClass('td-error')}
        var totalmax = <?php echo number_format((float)$nbjourouvresmax, 2); ?>;
        if ($("#totalactivites").html() != totalmax.toFixed(2)+' j' && $("#totalactivites").html()!=0.00) {$("#totalactivites").addClass('td-error'); $("#container_message_erreur_total").fadeIn();} else {$("#totalactivites").removeClass('td-error'); $("#container_message_erreur_total").fadeOut();}
    });
    
    $(document).on('change','.sa',function(e){
        e.preventDefault;
        $("#totalsa").html(sumOfColumns('sa','j'));
        $("#totalactivites").html(sumOfColumns('total','j'));
        if ($("#totalsa").html()>1 || $("#totalsa").html()<0) {$("#totalsa").addClass('td-error')} else {$("#totalsa").removeClass('td-error')}
    });
    
    $(document).on('change','.di',function(e){
        e.preventDefault;
        $("#totaldi").html(sumOfColumns('di','j'));
        $("#totalactivites").html(sumOfColumns('total','j'));
        if ($("#totaldi").html()>1 || $("#totaldi").html()<0) {$("#totaldi").addClass('td-error')} else {$("#totaldi").removeClass('td-error')}
    });
        
    $(document).on('click','#deleteRow',function(e){
        e.preventDefault;
        $(this).parent().parent('tr').remove();
        /*Suppresion de la ligne en base*/
        var id = typeof $(this).attr('action_id') === "undefined" ? "" : $(this).attr('action_id');
        if(id!=""){
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'activitesreelles','action'=>'deleteall')); ?>/",
                data: ({all_ids:id})
            }).done(function ( data ) {
                location.reload();
            });
        }
    });    
    $(document).on('click','#addRow',function(e){
        e.preventDefault;
        $("#templateRow").clone().removeAttr("id").appendTo( $("#templateRow").parent());
        $("tr:last-child .selectActivite").attr('data-rule-required',"true").attr('data-msg-required',"Le nom de l'activité est obligatoire");
        $("tr:last-child .totalhidden").attr('data-rule-isZero',"true").attr('data-msg-isZero',"Le total est incorrect changez une valeur de votre saisie.");
        $("tr:last-child :input").each(function() {
            var nameAttr = typeof $(this).attr('name') === "undefined" ? "" : $(this).attr('name');
            var idAttr = typeof $(this).attr('id') === "undefined" ? "" : $(this).attr('id');
            var forAttr = typeof $(this).attr('for') === "undefined" ? "" : $(this).attr('for');
            //var tabindexAttr = typeof $(this).attr('tabindex') === "undefined" ? "" : $(this).attr('tabindex');
            var newIndex = $('#ActivitesreelleTable tr').length-5; 
            if (nameAttr != "") $(this).attr('name',nameAttr.replace('¤',newIndex));
            if (idAttr != "") $(this).attr('id',idAttr.replace('¤',newIndex));   
            if (forAttr != "") $(this).attr('for',forAttr.replace('¤',newIndex)); 
            //if (tabindexAttr != "") $(this).attr('tabindex',tabindexAttr.replace('¤',(newIndex*14)));
        });  
        $("tr:last-child .labelAfter").each(function() {
            var forAttr = typeof $(this).attr('for') === "undefined" ? "" : $(this).attr('for');
            var newIndex = $('#ActivitesreelleTable tr').length-5; 
            if (forAttr != "") $(this).attr('for',forAttr.replace('¤',newIndex));            
        });         
    });    
    
    function sumOfColumns(id,type) {
        var tot = 0;
        $("."+id).each(function() {
          tot += parseFloat($(this).val());
        });
        if (isNaN(tot)){ tot = 0; }
        return tot.toFixed(2)+' '+type;
     }    
     
     $("#totallu").html(sumOfColumns('lu','j'));
     $("#totalma").html(sumOfColumns('ma','j'));
     $("#totalme").html(sumOfColumns('me','j'));
     $("#totalje").html(sumOfColumns('je','j'));
     $("#totalve").html(sumOfColumns('ve','j'));
     $("#totalsa").html(sumOfColumns('sa','j'));
     $("#totaldi").html(sumOfColumns('di','j'));
     $("#totalactivites").html(sumOfColumns('total','j'));
     $("#totalfrais").html(sumOfColumns('frais','€'));
     if ($("#totallu").html()>1 || $("#totallu").html()<0) {$("#totallu").addClass('td-error')} else {$("#totallu").removeClass('td-error')}
     if ($("#totalma").html()>1 || $("#totalma").html()<0) {$("#totalma").addClass('td-error')} else {$("#totalma").removeClass('td-error')}
     if ($("#totalme").html()>1 || $("#totalme").html()<0) {$("#totalme").addClass('td-error')} else {$("#totalme").removeClass('td-error')}
     if ($("#totalje").html()>1 || $("#totalje").html()<0) {$("#totalje").addClass('td-error')} else {$("#totalje").removeClass('td-error')}
     if ($("#totalve").html()>1 || $("#totalve").html()<0) {$("#totalve").addClass('td-error')} else {$("#totalve").removeClass('td-error')}
     if ($("#totalsa").html()>1 || $("#totalsa").html()<0) {$("#totalsa").addClass('td-error')} else {$("#totalsa").removeClass('td-error')}
     if ($("#totaldi").html()>1 || $("#totaldi").html()<0) {$("#totaldi").addClass('td-error')} else {$("#totaldi").removeClass('td-error')}
});
</script>
