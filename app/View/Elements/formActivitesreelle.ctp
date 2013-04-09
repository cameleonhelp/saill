<?php 
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
            <?php if (userAuth('WIDEAREA')==1): ?>
            <?php echo $this->Form->select('utilisateur_id',$utilisateurs,array('data-rule-required'=>'true','default' => userAuth('id'),'data-msg-required'=>"Le nom de l'utilisateur est obligatoire", 'empty' => 'Choisir un utilisateur')); ?>                     
            <?php else : ?>
            <?php echo $nomlong['Utilisateur']['NOMLONG']; ?>
            <?php endif; ?>
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
            <select name="data[Activitesreelle][activite_id]" data-rule-required="true" data-msg-required="Le nom de l'activité est obligatoire" id="ActivitesreelleActiviteId"> 
                <option value="">Choisir une activité</option>
                <?php foreach ($activites as $activite) : ?>
                <?php $selected = ''; ?>
                <?php if ($this->params->action == 'edit') $selected = $activite['Activite']['id']==$this->data['Achat']['activite_id'] ? 'selected="selected"' :''; ?>
                    <option value="<?php echo $activite['Activite']['id']; ?>" <?php echo $selected; ?>><?php echo $activite['Projet']['NOM']; ?> - <?php echo $activite['Activite']['NOM']; ?></option>
                <?php endforeach; ?>
            </select>            
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
    <tr>
        <td><?php echo $this->data['Activite']['NOM']; ?></td>
        <td <?php echo $classLU; ?> width='15px'><?php echo $this->Form->input('LU',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du lundi")); ?> j</td>
        <td <?php echo $classMA; ?> width='15px'><?php echo $this->Form->input('MA',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mardi")); ?> j</td>
        <td <?php echo $classME; ?> width='15px'><?php echo $this->Form->input('ME',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du mercredi")); ?> j</td>
        <td <?php echo $classJE; ?> width='15px'><?php echo $this->Form->input('JE',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du du jeudi")); ?> j</td>
        <td <?php echo $classVE; ?> width='15px'><?php echo $this->Form->input('VE',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du vendredi")); ?> j</td>
        <td class='week <?php echo $classSA; ?>' width='15px'><?php echo $this->Form->input('SA',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du samedi")); ?> j</td>
        <td class='week <?php echo $classDI; ?>' width='15px'><?php echo $this->Form->input('DI',array('class'=>'span2 text-right day','data-rule-isAuthorize'=>true,'data-msg-isAuthorize'=>"Seul est autorisé 0, 0.5 ou 1 sur la journée du dimanche")); ?> j</td>
        <td width='15px'><?php echo $this->Form->input('TOTAL',array('type'=>'hidden')); ?><?php echo $this->Form->input('TotalDisabled',array('class'=>'span2 text-right','disabled'=>'disabled','value'=>$this->data['Activitesreelle']['TOTAL'])); ?> j</td>        
    </tr>
    <?php if($this->data['Activite']['projet_id']==1) { ?>
    <tr>
        <td>Commence le matin</td>
        <td <?php echo $classLU; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('LU_TYPE',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class='labelAfter' for='ActivitesreelleLUTYPE'></label></td>
        <td <?php echo $classMA; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('MA_TYPE',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class='labelAfter' for='ActivitesreelleMATYPE'></label></td>
        <td <?php echo $classME; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('ME_TYPE',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class='labelAfter' for='ActivitesreelleMETYPE'></label></td>
        <td <?php echo $classJE; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('JE_TYPE',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class='labelAfter' for='ActivitesreelleJETYPE'></label></td>
        <td <?php echo $classVE; ?> width='15px' style="text-align: center;"><?php echo $this->Form->input('VE_TYPE',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class='labelAfter' for='ActivitesreelleVETYPE'></label></td>
        <td class='week <?php echo $classSA; ?>'  width='15px' style="text-align: center;"><?php echo $this->Form->input('SA_TYPE',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class='labelAfter' for='ActivitesreelleSATYPE'></label></td>
        <td class='week <?php echo $classDI; ?>'  width='15px' style="text-align: center;"><?php echo $this->Form->input('DI_TYPE',array('type'=>'checkbox','class'=>'yesno')); ?>&nbsp;<label class='labelAfter' for='ActivitesreelleDITYPE'></label></td>
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
        $('#ActivitesreelleTotalDisabled').val(parseFloat($('#ActivitesreelleLU').val())+parseFloat($('#ActivitesreelleMA').val())+parseFloat($('#ActivitesreelleME').val())+parseFloat($('#ActivitesreelleJE').val())+parseFloat($('#ActivitesreelleVE').val())+parseFloat($('#ActivitesreelleSA').val())+parseFloat($('#ActivitesreelleDI').val()));});
    

});
</script>
