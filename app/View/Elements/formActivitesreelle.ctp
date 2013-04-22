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
<?php echo $this->Form->create('Activitesreelle',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
<table cellpadding="0" cellspacing="0" class="table table-bordered" id="ActivitesreelleTable">
    <thead>
    <tr>
        <th class="text-center" colspan="10">Répartition de l'activité pour la semaine du <span id="ActionreelleDebut" class="clearboth"><?php echo $debutsemaine; ?></span> au <span id="ActionreelleFin" class="clearboth"><?php echo $finsemaine; ?></span></th>
    </tr>
    <tr>
        <th rowspan="2"><label class="control-label sstitre required">Activité</label></th>
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
        <td>
            <select name="data[Activitesreelle][<?php echo $i; ?>][activite_id]" data-rule-required="true" data-msg-required="Le nom de l'activité est obligatoire" id="Activitesreelle<?php echo $i; ?>ActiviteId"> 
                <option value="">Choisir une activité</option>
                <?php foreach ($activites as $activite) : ?>
                <?php $selected = ''; ?>
                <?php $selected = $activite['Activite']['id']==$activitesreelle['Activitesreelle']['activite_id'] ? 'selected="selected"' :''; ?>
                    <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?>><?php echo $activite['Projet']['NOM']; ?> - <?php echo $activite['Activite']['NOM']; ?></option>
                <?php endforeach; ?>
            </select>        
            <br/>
            Commence le matin
        </td>
        <td <?php echo $classLU; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.'.$i.'.LU',array('class'=>'span2 text-right day','tabindex'=>$j,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du lundi",'value'=>$activitesreelle['Activitesreelle']['LU'])); ?> j<br />
            <?php $luchecked = $activitesreelle['Activitesreelle']['LU_TYPE'] ==1 ? 'checked' :''; ?>
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.LU_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>$luchecked,'tabindex'=>$j+7)); ?>&nbsp;<label class='labelAfter' for='Activitesreelle<?php echo $i; ?>LUTYPE'></label>
        </td>
        <td <?php echo $classMA; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.'.$i.'.MA',array('class'=>'span2 text-right day','tabindex'=>$j+1,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mardi",'value'=>$activitesreelle['Activitesreelle']['MA'])); ?> j<br />
            <?php $machecked = $activitesreelle['Activitesreelle']['MA_TYPE'] ==1 ? 'checked' :''; ?>
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.MA_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>$machecked,'tabindex'=>$j+8)); ?>&nbsp;<label class='labelAfter' for='Activitesreelle<?php echo $i; ?>MATYPE'></label>
        </td>
        <td <?php echo $classME; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.'.$i.'.ME',array('class'=>'span2 text-right day','tabindex'=>$j+2,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mercredi",'value'=>$activitesreelle['Activitesreelle']['ME'])); ?> j<br />
            <?php $mechecked = $activitesreelle['Activitesreelle']['ME_TYPE'] ==1 ? 'checked' :''; ?>
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.ME_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>$mechecked,'tabindex'=>$j+9)); ?>&nbsp;<label class='labelAfter' for='Activitesreelle<?php echo $i; ?>METYPE'></label>
        </td>
        <td <?php echo $classJE; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.'.$i.'.JE',array('class'=>'span2 text-right day','tabindex'=>$j+3,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du du jeudi",'value'=>$activitesreelle['Activitesreelle']['JE'])); ?> j<br />
            <?php $jechecked = $activitesreelle['Activitesreelle']['JE_TYPE'] ==1 ? 'checked' :''; ?>
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.JE_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>$jechecked,'tabindex'=>$j+10)); ?>&nbsp;<label class='labelAfter' for='Activitesreelle<?php echo $i; ?>JETYPE'></label>
        </td>
        <td <?php echo $classVE; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.'.$i.'.VE',array('class'=>'span2 text-right day','tabindex'=>$j+4,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du vendredi",'value'=>$activitesreelle['Activitesreelle']['VE'])); ?> j<br />
            <?php $vechecked = $activitesreelle['Activitesreelle']['VE_TYPE'] ==1 ? 'checked' :''; ?>
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.VE_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>$vechecked,'tabindex'=>$j+11)); ?>&nbsp;<label class='labelAfter' for='Activitesreelle<?php echo $i; ?>VETYPE'></label>
        </td>
        <td class='week <?php echo $classSA; ?>' width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.'.$i.'.SA',array('class'=>'span2 text-right day','tabindex'=>$j+5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du samedi",'value'=>$activitesreelle['Activitesreelle']['SA'])); ?> j<br />
            <?php $sachecked = $activitesreelle['Activitesreelle']['SA_TYPE'] ==1 ? 'checked' :''; ?>
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.SA_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>$sachecked,'tabindex'=>$j+12)); ?>&nbsp;<label class='labelAfter' for='Activitesreelle<?php echo $i; ?>SATYPE'></label>
        </td>
        <td class='week <?php echo $classDI; ?>' width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.'.$i.'.DI',array('class'=>'span2 text-right day','tabindex'=>$j+6,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du dimanche",'value'=>$activitesreelle['Activitesreelle']['DI'])); ?> j<br />
            <?php $dichecked = $activitesreelle['Activitesreelle']['DI_TYPE'] ==1 ? 'checked' :''; ?>
            <?php echo $this->Form->input('Activitesreelle.'.$i.'.DI_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>$dichecked,'tabindex'=>$j+13)); ?>&nbsp;<label class='labelAfter' for='Activitesreelle<?php echo $i; ?>DITYPE'></label>
        </td>
        <td width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.'.$i.'.TOTAL',array('type'=>'hidden','value'=>$activitesreelle['Activitesreelle']['TOTAL'])); ?><?php echo $this->Form->input('Activitesreelle.'.$i.'.TotalDisabled',array('class'=>'span2 text-right','disabled'=>'disabled','value'=>$activitesreelle['Activitesreelle']['TOTAL'])); ?> j</td>        
        <td> 
            <?php if ($i==0) : ?>
            <i class="icon-blank"></i>
            <?php else : ?>
            <i class="icon-minus cursor" id="deleteRow"></i>
            <?php endif; ?>
            <i class="icon-plus cursor" id="addRow"></i>
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
        <td>
            <select name="data[Activitesreelle][0][activite_id]" data-rule-required="true" data-msg-required="Le nom de l'activité est obligatoire" id="Activitesreelle0ActiviteId"> 
                <option value="">Choisir une activité</option>
                <?php foreach ($activites as $activite) : ?>
                <?php $selected = ''; ?>
                <?php if ($this->params->action == 'edit') $selected = $activite['Activite']['id']==$activitesreelle['Activitesreelle']['activite_id'] ? 'selected="selected"' :''; ?>
                    <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?>><?php echo $activite['Projet']['NOM']; ?> - <?php echo $activite['Activite']['NOM']; ?></option>
                <?php endforeach; ?>
            </select>        
            <br/>
            &nbsp;&nbsp;&nbsp;Commence le matin
        </td>
        <td <?php echo $classLU; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.0.LU',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du lundi",'value'=>'0.0')); ?> j<br />
        <?php echo $this->Form->input('Activitesreelle.0.LU_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle0LUTYPE'></label>
        </td>
        <td <?php echo $classMA; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.0.MA',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mardi",'value'=>'0.0')); ?> j<br />
        <?php echo $this->Form->input('Activitesreelle.0.MA_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle0MATYPE'></label>
        </td>
        <td <?php echo $classME; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.0.ME',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mercredi",'value'=>'0.0')); ?> j<br />
        <?php echo $this->Form->input('Activitesreelle.0.ME_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle0METYPE'></label>
        </td>
        <td <?php echo $classJE; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.0.JE',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du du jeudi",'value'=>'0.0')); ?> j<br />
        <?php echo $this->Form->input('Activitesreelle.0.JE_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle0JETYPE'></label>
        </td>
        <td <?php echo $classVE; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.0.VE',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du vendredi",'value'=>'0.0')); ?> j<br />
        <?php echo $this->Form->input('Activitesreelle.0.VE_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle0VETYPE'></label>
        </td>
        <td class='week <?php echo $classSA; ?>' width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.0.SA',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du samedi",'value'=>'0.0')); ?> j<br />
        <?php echo $this->Form->input('Activitesreelle.0.SA_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle0SATYPE'></label>
        </td>
        <td class='week <?php echo $classDI; ?>' width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.0.DI',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du dimanche",'value'=>'0.0')); ?> j<br />
        <?php echo $this->Form->input('Activitesreelle.0.DI_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle0DITYPE'></label>
        </td>
        <td width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.0.TOTAL',array('type'=>'hidden','value'=>'0.0')); ?><?php echo $this->Form->input('Activitesreelle.0.TotalDisabled',array('class'=>'span2 text-right','disabled'=>'disabled','value'=>isset($this->data['Activitesreelle']['TOTAL']) ? $this->data['Activitesreelle']['TOTAL'] : "0.0")); ?> j</td>        
        <td>    
            <i class="icon-blank"></i>
            <i class="icon-plus cursor" id="addRow"></i>            
            <?php echo $this->Form->input('Activitesreelle.0.DATE',array('type'=>'hidden','value'=>$datedebut)); ?>
            <?php echo $this->Form->input('Activitesreelle.0.utilisateur_id',array('type'=>'hidden','value'=>$userid)); ?> 
            <?php echo $this->Form->input('Activitesreelle.0.action_id',array('type'=>'hidden','value'=>isset($this->data['Activitesreelle']['action_id']) ? $this->data['Activitesreelle']['action_id'] : '')); ?>
            <?php echo $this->Form->input('Activitesreelle.0.VEROUILLE',array('type'=>'hidden','value'=>1)); ?> 
            <?php echo $this->Form->input('Activitesreelle.0.facturation_id',array('type'=>'hidden','value'=>'')); ?>             
        </td>       
    </tr> 
    <?php endif; ?>    
    <tr  id="templateRow">
        <td>
            <select name="data[Activitesreelle][¤][activite_id]" id="Activitesreelle¤ActiviteId" class="selectActivite"> 
                <option value="">Choisir une activité</option>
                <?php foreach ($activites as $activite) : ?>
                    <option value="<?php echo $activite['Activite']['id']; ?>"><?php echo $activite['Projet']['NOM']; ?> - <?php echo $activite['Activite']['NOM']; ?></option>
                <?php endforeach; ?>
            </select>        
            <br/>
            &nbsp;&nbsp;&nbsp;Commence le matin
        </td>
        <td <?php echo $classLU; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.¤.LU',array('class'=>'span2 text-right day','tabindex'=>1,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du lundi",'value'=>'0.0')); ?> j<br />
        <?php echo $this->Form->input('Activitesreelle.¤.LU_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle¤LUTYPE'></label>
        </td>
        <td <?php echo $classMA; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.¤.MA',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'tabindex'=>2,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mardi",'value'=>'0.0')); ?> j<br />
        <?php echo $this->Form->input('Activitesreelle.¤.MA_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle¤MATYPE'></label>
        </td>
        <td <?php echo $classME; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.¤.ME',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'tabindex'=>3,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mercredi",'value'=>'0.0')); ?> j<br />
        <?php echo $this->Form->input('Activitesreelle.¤.ME_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle¤METYPE'></label>
        </td>
        <td <?php echo $classJE; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.¤.JE',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'tabindex'=>4,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du du jeudi",'value'=>'0.0')); ?> j<br />
        <?php echo $this->Form->input('Activitesreelle.¤.JE_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle¤JETYPE'></label>
        </td>
        <td <?php echo $classVE; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.¤.VE',array('class'=>'span2 text-right day','tabindex'=>5,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du vendredi",'value'=>'0.0')); ?> j<br />
        <?php echo $this->Form->input('Activitesreelle.¤.VE_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle¤VETYPE'></label>
        </td>
        <td class='week <?php echo $classSA; ?>' width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.¤.SA',array('class'=>'span2 text-right day','tabindex'=>6,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du samedi",'value'=>'0.0')); ?> j<br />
        <?php echo $this->Form->input('Activitesreelle.¤.SA_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle¤SATYPE'></label>
        </td>
        <td class='week <?php echo $classDI; ?>' width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.¤.DI',array('class'=>'span2 text-right day','tabindex'=>7,'data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du dimanche",'value'=>'0.0')); ?> j<br />
        <?php echo $this->Form->input('Activitesreelle.¤.DI_TYPE',array('type'=>'checkbox','class'=>'yesno','checked'=>'checked')); ?>&nbsp;<label class='labelAfter' for='Activitesreelle¤DITYPE'></label>
        </td>
        <td width='15px' style="text-align: center;"><?php echo $this->Form->input('Activitesreelle.¤.TOTAL',array('type'=>'hidden','value'=>'0.0')); ?><?php echo $this->Form->input('Activitesreelle.¤.TotalDisabled',array('class'=>'span2 text-right','disabled'=>'disabled','value'=>"0.0")); ?> j</td>        
        <td>    
            <i class="icon-minus cursor" id="deleteRow"></i>
            <i class="icon-plus cursor" id="addRow"></i>            
            <?php echo $this->Form->input('Activitesreelle.¤.DATE',array('type'=>'hidden','value'=>$datedebut)); ?>
            <?php echo $this->Form->input('Activitesreelle.¤.utilisateur_id',array('type'=>'hidden','value'=>$userid)); ?> 
            <?php echo $this->Form->input('Activitesreelle.¤.action_id',array('type'=>'hidden','value'=>'')); ?>
            <?php echo $this->Form->input('Activitesreelle.¤.VEROUILLE',array('type'=>'hidden','value'=>1)); ?> 
            <?php echo $this->Form->input('Activitesreelle.¤.facturation_id',array('type'=>'hidden','value'=>'')); ?>             
        </td>       
    </tr> 
    </tr> 
    </tbody>
</table>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container" style="margin-top:2px;text-align:center;">
            <?php $url = $this->Session->read('history'); ?>
            <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url($url[0])."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                 
        </div>
    </div>
</div>  
<?php echo $this->Form->end(); ?>   

<script>
$(document).ready(function () {    
    $(document).on('change','.day',function(e){
        e.preventDefault;
        var id = $(this).attr('id').substring(0,($(this).attr('id').length)-2); 
        parseFloat($(this).val()) > 1 ? $(this).addClass('invalid') : $(this).removeClass('invalid');
        parseFloat($(this).val()) > 1 ? $(this).focus() : '';
        $('#'+id+'TOTAL').val(parseFloat($('#'+id+'LU').val())+parseFloat($('#'+id+'MA').val())+parseFloat($('#'+id+'ME').val())+parseFloat($('#'+id+'JE').val())+parseFloat($('#'+id+'VE').val())+parseFloat($('#'+id+'SA').val())+parseFloat($('#'+id+'DI').val()));
        $('#'+id+'TotalDisabled').val($('#'+id+'TOTAL').val());
    });
    $(document).on('click','#deleteRow',function(e){
        e.preventDefault;
        $(this).parent().parent('tr').remove();
    });    
    $(document).on('click','#addRow',function(e){
        e.preventDefault;
        $("#templateRow").clone().removeAttr("id").appendTo( $("#templateRow").parent());
        $("tr:last-child .selectActivite").attr('data-rule-required',"true").attr('data-msg-required',"Le nom de l'activité est obligatoire");
        $("tr:last-child :input").each(function() {
            var nameAttr = typeof $(this).attr('name') === "undefined" ? "" : $(this).attr('name');
            var idAttr = typeof $(this).attr('id') === "undefined" ? "" : $(this).attr('id');
            //var tabindexAttr = typeof $(this).attr('tabindex') === "undefined" ? "" : $(this).attr('tabindex');
            var newIndex = $('#ActivitesreelleTable tr').length-5; 
            if (nameAttr != "") $(this).attr('name',nameAttr.replace('¤',newIndex));
            if (idAttr != "") $(this).attr('id',idAttr.replace('¤',newIndex));     
            //if (tabindexAttr != "") $(this).attr('tabindex',tabindexAttr.replace('¤',(newIndex*14)));
        });  
        $("tr:last-child .labelAfter").each(function() {
            var forAttr = typeof $(this).attr('for') === "undefined" ? "" : $(this).attr('for');
            var newIndex = $('#ActivitesreelleTable tr').length-5; 
            if (forAttr != "") $(this).attr('for',forAttr.replace('¤',newIndex));            
        });         
    });    
});
</script>
