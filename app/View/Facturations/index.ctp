<div class="facturations index">
        <nav class="navbar toolbar marginright20">
                <ul class="nav navbar-nav toolbar">
                <?php $defaultAction = $this->params->action == "search" ? 'index' : $this->params->action; ?>
                <?php
                $filtre_utilisateur = isset($this->params->pass[0]) ? $this->params->pass[0] : userAuth('id');
                $mois = date('m');
                $filtre_mois = isset($this->params->pass[1]) ? $this->params->pass[1] : $mois;
                $filtre_visible = isset($this->params->pass[2]) ? $this->params->pass[2] : 1;
                $filtre_indisponible = isset($this->params->pass[3]) ? $this->params->pass[3] : 0;
                $filtre_annee = isset($this->params->pass[4]) ? $this->params->pass[4] : date('Y');
                ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('facturations', 'add') && $this->params->action=='afacturer') : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4" rel="tooltip" data-title="Ajoutez une nouvelle facturation"></span>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical-only"></li>
                <?php endif; ?>
                 <li><?php echo $this->Html->link('A facturer', array('controller'=>'activitesreelles','action' => 'afacturer'),array('escape' => false,'class'=>'paddingtop3')); ?></li>
                 <?php if (areaIsVisible()) :?>
                 <li class="dropdown <?php echo filtre_is_actif($filtre_utilisateur,  userAuth('id')); ?>">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Utilisateurs <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => $defaultAction,'tous',$filtre_mois,$filtre_visible,$filtre_indisponible,$filtre_annee),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_utilisateur,'tous'))); ?></li>
                     <li><?php echo $this->Html->link('Moi', array('action' => $defaultAction,userAuth('id'),$filtre_mois,$filtre_visible,$filtre_indisponible,$filtre_annee),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_utilisateur,userAuth('id')))); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($utilisateurs as $utilisateur): ?>
                            <li><?php echo $this->Html->link($utilisateur['Utilisateur']['NOMLONG'], array('action' => $defaultAction,$utilisateur['Utilisateur']['id'],$filtre_mois,$filtre_visible,$filtre_indisponible,$filtre_annee),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_utilisateur,$utilisateur['Utilisateur']['id']))); ?></li>
                         <?php endforeach; ?>
                      </ul>
                </li>   
                <?php endif; ?>                  
                <li class="dropdown <?php echo filtre_is_actif($filtre_mois,$mois); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Mois <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => $defaultAction,$filtre_utilisateur,'tous',$filtre_visible,$filtre_indisponible,$filtre_annee),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_mois,'tous'))); ?></li>
                     <li class="divider"></li>
                     <li><?php echo $this->Html->link('Janvier', array('action' => $defaultAction,$filtre_utilisateur,'01',$filtre_visible,$filtre_indisponible,$filtre_annee),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_mois,'01'))); ?></li>
                     <li><?php echo $this->Html->link('Février', array('action' => $defaultAction,$filtre_utilisateur,'02',$filtre_visible,$filtre_indisponible,$filtre_annee),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_mois,'02'))); ?></li>
                     <li><?php echo $this->Html->link('Mars', array('action' => $defaultAction,$filtre_utilisateur,'03',$filtre_visible,$filtre_indisponible,$filtre_annee),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_mois,'03'))); ?></li>
                     <li><?php echo $this->Html->link('Avril', array('action' => $defaultAction,$filtre_utilisateur,'04',$filtre_visible,$filtre_indisponible,$filtre_annee),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_mois,'04'))); ?></li>
                     <li><?php echo $this->Html->link('Mai', array('action' => $defaultAction,$filtre_utilisateur,'05',$filtre_visible,$filtre_indisponible,$filtre_annee),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_mois,'05'))); ?></li>
                     <li><?php echo $this->Html->link('Juin', array('action' => $defaultAction,$filtre_utilisateur,'06',$filtre_visible,$filtre_indisponible,$filtre_annee),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_mois,'06'))); ?></li>
                     <li><?php echo $this->Html->link('Juillet', array('action' => $defaultAction,$filtre_utilisateur,'07',$filtre_visible,$filtre_indisponible,$filtre_annee),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_mois,'07'))); ?></li>
                     <li><?php echo $this->Html->link('Août', array('action' => $defaultAction,$filtre_utilisateur,'08',$filtre_visible,$filtre_indisponible,$filtre_annee),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_mois,'08'))); ?></li>
                     <li><?php echo $this->Html->link('Septembre', array('action' => $defaultAction,$filtre_utilisateur,'09',$filtre_visible,$filtre_indisponible,$filtre_annee),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_mois,'09'))); ?></li>
                     <li><?php echo $this->Html->link('Octobre', array('action' => $defaultAction,$filtre_utilisateur,'10',$filtre_visible,$filtre_indisponible,$filtre_annee),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_mois,'10'))); ?></li>
                     <li><?php echo $this->Html->link('Novembre', array('action' => $defaultAction,$filtre_utilisateur,'11',$filtre_visible,$filtre_indisponible,$filtre_annee),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_mois,'11'))); ?></li>
                     <li><?php echo $this->Html->link('Décembre', array('action' => $defaultAction,$filtre_utilisateur,'12',$filtre_visible,$filtre_indisponible,$filtre_annee),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_mois,'12'))); ?></li>
                      </ul>
                </li>
                <li class="dropdown <?php echo filtre_is_actif($filtre_annee,date('Y')); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Année <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('En cours', array('action' => $defaultAction,$filtre_utilisateur,$filtre_mois,$filtre_visible,$filtre_indisponible,date('Y')),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_annee,date('Y')))); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($annees as $annee): ?>
                            <li><?php echo $this->Html->link($annee[0]['ANNEE'], array('action' => $defaultAction,$filtre_utilisateur,$filtre_mois,$filtre_visible,$filtre_indisponible,$annee[0]['ANNEE']),array('class'=>'showoverlay'.subfiltre_is_actif($filtre_annee,$annee[0]['ANNEE']))); ?></li>
                         <?php endforeach; ?>
                      </ul>
                </li>                 
                <li class="dropdown <?php echo filtre_is_actif(array($filtre_visible,$filtre_indisponible),array('1','0')); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtres ... <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <?php
                     $inserse_visible = $filtre_visible == 0 ? 1 : 0;
                     $img_visible = $filtre_visible == 1 ? "unchecked bottom2" : "check bottom2";
                     $inverse_indisponible = $filtre_indisponible == 0 ? 1 : 0;
                     $img_indisponible = $filtre_indisponible == 1 ?  "unchecked bottom2" : "check bottom2";
                     ?>
                     <li><?php echo $this->Html->link('<span class="glyphicons '.$img_visible.'"></span> Non visible inclus ', array('action' => $defaultAction,$filtre_utilisateur,$filtre_mois,$inserse_visible,$filtre_indisponible,$filtre_annee),array('escape' => false)); ?></li>
                     <li><?php echo $this->Html->link('<span class="glyphicons '.$img_indisponible.'"></span> Indisponibilité', array('action' => $defaultAction,$filtre_utilisateur,$filtre_mois,$filtre_visible,$inverse_indisponible,$filtre_annee),array('escape' => false)); ?></li>                    
                      </ul>
                </li>                
                <li class="divider-vertical-only"></li>
                <li><?php echo $this->Html->link('<span class="ico-xls" data-container="body" rel="tooltip" data-title="Export Excel"></span>', array('action' => 'export_xls'),array('escape' => false)); ?></li>                 
                </ul> 
                <!--    
                <?php echo $this->Form->create("Facturation",array('controller'=>'facturations','action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?>     
                //-->
        </nav>
        <?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 marginright20"><strong>Filtre appliqué : </strong><em>Liste des facturations estimées de <?php echo $futilisateur; ?> <?php echo $fperiode; ?></em></div><?php } ?>        
        <div class="marginright10">
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" id="data">
	<thead>
            <tr>
			<th><?php echo 'Utilisateur'; ?></th>
			<th><?php echo 'Date'; ?></th>
 			<th><?php echo 'Réf. FT GALILEI'; ?></th>
			<th><?php echo 'Version'; ?></th>
                        <th><?php echo 'Activités'; ?></th>
			<th><?php echo 'Lu.'; ?></th>
			<th><?php echo 'Ma.'; ?></th>
			<th><?php echo 'Me.'; ?></th>
			<th><?php echo 'Je.'; ?></th>
			<th><?php echo 'Ve.'; ?></th>
			<th><?php echo 'Sa.'; ?></th>
			<th><?php echo 'Di.'; ?></th>
			<th><?php echo 'Total'; ?></th>
			<th class="actions">Actions</th>
	</tr>
	</thead>
        <tbody>  
        <?php if (count($facturations)>0): ?>
        <?php $r = 0; ?>
        <?php foreach ($groups as $group) : ?>
        <?php $row = $groups[$r][0]['NBACTIVITE']; ?>
        <?php $newline = true; ?>
        <?php if (isset($facturations)): ?>
	<?php foreach ($facturations as $facturation): ?>
            <?php if($facturation['Facturation']['utilisateur_id']==$group['Facturation']['utilisateur_id'] && $facturation['Facturation']['VERSION']==$group['Facturation']['VERSION'] && dateIsEqual($group['Facturation']['DATE'], $facturation['Facturation']['DATE'])): ?>
                 <tr>  
                 <?php if($row > 1 && $newline): ?>
                       <?php $newline = false; ?>
                       <td class="header" rowspan="<?php echo $row; ?>" style="vertical-align: middle;"><?php echo $group['Utilisateur']['NOM']." ".$group['Utilisateur']['PRENOM']; ?></td>
                       <td class="header" rowspan="<?php echo $row; ?>" style="vertical-align: middle;text-align: center;"><?php echo $group['Facturation']['DATE']; ?></td>
                       <td class="header" rowspan="<?php echo $row; ?>" style="vertical-align: middle;text-align: right;"><?php echo $group['Facturation']['NUMEROFTGALILEI']; ?></td>
                       <td class="header" rowspan="<?php echo $row; ?>" style="vertical-align: middle;text-align: right;"><?php echo $group['Facturation']['VERSION']; ?></td>     
                <?php elseif($row == 1  && $newline) : ?>
                       <?php $newline = false; ?>
                       <td class="header"><?php echo $facturation['Utilisateur']['NOMLONG']; ?></td>
                       <td class="header" style="text-align: center;" ><?php echo $group['Facturation']['DATE']; ?></td>
                       <td class="header" style="vertical-align: middle;text-align: right;"><?php echo $group['Facturation']['NUMEROFTGALILEI']; ?></td>
                       <td class="header" style="vertical-align: middle;text-align: right;"><?php echo $group['Facturation']['VERSION']; ?></td>                 
                <?php endif; ?>
                <?php $classnotvisible = $facturation['Facturation']['VISIBLE']==1 ? ' old-facturation' : ''; ?>
                <?php $nbdisable = 0; ?>
                <td class="<?php echo $classnotvisible; ?>  "><?php echo $facturation['Facturation']['projet_NOM'].' - '.$facturation['Activite']['NOM']; ?></td>    
                <?php $date = new DateTime(CUSDate($group['Facturation']['DATE'])); ?> 
                <?php $month = isset($this->params->pass[1]) ? $this->params->pass[1] : date('m'); ?>
                <?php $disabled = $month!= 'tous' && dateInMonth($date->format('d/m/Y'),$month) ? 'disable-date' : ''; ?>
                <?php $classLU = isFerie($date) ? 'class="ferie '.$disabled.$classnotvisible.'"' : 'class="'.$disabled.$classnotvisible.'"'; ?>
                <td style="text-align: center;" <?php echo $classLU; ?>><?php echo $facturation['Facturation']['LU']!=0 ? $facturation['Facturation']['LU'] : ""; ?></td> 
                <?php $nbdisable = $disabled != '' && $facturation['Facturation']['LU'] != 0 ? $facturation['Facturation']['LU'] : 0; ?>                
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $disabled = $month!= 'tous' && dateInMonth($date->format('d/m/Y'),$month) ? 'disable-date' : ''; ?>
                <?php $classMA = isFerie($date) ? 'class="ferie '.$disabled.$classnotvisible.'"' : 'class="'.$disabled.$classnotvisible.'"'; ?>               
                <td style="text-align: center;" <?php echo $classMA; ?>><?php echo $facturation['Facturation']['MA']!=0 ? $facturation['Facturation']['MA'] : ""; ?></td> 
                <?php $nbdisable = $disabled != '' && $facturation['Facturation']['MA'] != 0 ? $facturation['Facturation']['MA']+$nbdisable : $nbdisable; ?>             
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $disabled = $month!= 'tous' && dateInMonth($date->format('d/m/Y'),$month) ? 'disable-date' : ''; ?>
                <?php $classME = isFerie($date) ? 'class="ferie '.$disabled.$classnotvisible.'"' : 'class="'.$disabled.$classnotvisible.'"'; ?>              
                <td style="text-align: center;" <?php echo $classME; ?>><?php echo $facturation['Facturation']['ME']!=0 ? $facturation['Facturation']['ME'] : ""; ?></td> 
                <?php $nbdisable = $disabled != '' && $facturation['Facturation']['ME'] != 0 ? $facturation['Facturation']['ME']+$nbdisable : $nbdisable; ?>           
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $disabled = $month!= 'tous' && dateInMonth($date->format('d/m/Y'),$month) ? 'disable-date' : ''; ?>
                <?php $classJE = isFerie($date) ? 'class="ferie '.$disabled.$classnotvisible.'"' : 'class="'.$disabled.$classnotvisible.'"'; ?>               
                <td style="text-align: center;" <?php echo $classJE; ?>><?php echo $facturation['Facturation']['JE']!=0 ? $facturation['Facturation']['JE'] : ""; ?></td> 
                <?php $nbdisable = $disabled != '' && $facturation['Facturation']['JE'] != 0 ? $facturation['Facturation']['JE']+$nbdisable : $nbdisable; ?>             
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $disabled = $month!= 'tous' && dateInMonth($date->format('d/m/Y'),$month) ? 'disable-date' : ''; ?>
                <?php $classVE = isFerie($date) ? 'class="ferie '.$disabled.$classnotvisible.'"' : 'class="'.$disabled.$classnotvisible.'"'; ?>              
                <td style="text-align: center;" <?php echo $classVE; ?>><?php echo $facturation['Facturation']['VE']!=0 ? $facturation['Facturation']['VE'] : ""; ?></td> 
                <?php $nbdisable = $disabled != '' && $facturation['Facturation']['VE'] != 0 ? $facturation['Facturation']['VE']+$nbdisable : $nbdisable; ?>               
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $disabled = $month!= 'tous' && dateInMonth($date->format('d/m/Y'),$month) ? 'disable-date' : ''; ?>
                <?php $classSA = isFerie($date) ? ' ferie '.$classnotvisible.$disabled: ' '.$classnotvisible.$disabled; ?>  
                <td style="text-align: center;" class="week <?php echo $classSA; ?>"><?php echo $facturation['Facturation']['SA']!=0 ? $facturation['Facturation']['SA'] : ""; ?></td> 
                <?php $nbdisable = $disabled != '' && $facturation['Facturation']['SA'] != 0 ? $facturation['Facturation']['SA']+$nbdisable : $nbdisable; ?>                
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $disabled = $month!= 'tous' && dateInMonth($date->format('d/m/Y'),$month) ? 'disable-date' : ''; ?>
                <?php $classDI = isFerie($date) ? ' ferie '.$classnotvisible.$disabled: ' '.$classnotvisible.$disabled; ?>  
                <td style="text-align: center;" class="week <?php echo $classDI; ?>"><?php echo $facturation['Facturation']['DI']!=0 ? $facturation['Facturation']['DI'] : ""; ?></td> 
                <?php $nbdisable = $disabled != '' && $facturation['Facturation']['DI'] != 0 ? $facturation['Facturation']['DI']+$nbdisable : $nbdisable; ?>              
                <td style="text-align: center;" class="sstotal <?php echo $classnotvisible; ?>"><?php echo number_format((number_format(str_replace(',','.',$facturation['Facturation']['TOTAL']),1)-number_format($nbdisable,1)),1); ?></td> 
                <td style="text-align: center;">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('facturations', 'view')) : ?>
                    <?php echo '<span><span rel="tooltip" data-title="Cliquez pour avoir un aperçu"><span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Facturation :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($facturation['Facturation']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($facturation['Facturation']['modified']).'" data-trigger="click" style="cursor: pointer;"></span></span></span>'; ?>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('facturations', 'edit') && $facturation['Facturation']['VISIBLE']==0) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange" rel="tooltip" data-title="Modification de la facturation"></span>', array('action' => 'edit', $facturation['Facturation']['id'], $facturation['Facturation']['utilisateur_id']),array('escape' => false)); ?>
                    <?php if(isset($facturation['Facturation']['activitesreelle_id']) && $facturation['Facturation']['activitesreelle_id']!=''): ?>
                        <?php echo $this->Html->link('<span class="glyphicons unlock notchange" rel="tooltip" data-title="Déverouillez pour nouvelle saisie"></span>', array('controller'=>'activitesreelles','action' => 'deverouiller', $facturation['Facturation']['activitesreelle_id']),array('escape' => false)); ?>                    
                    <?php endif; ?>
                    <?php endif; ?>
                </td>   
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
        <?php $r++; ?>
        <?php endforeach; ?> 
        <?php endif; ?>             
        </tbody>
        <tfooter>
	<tr>
            <td colspan="12" class="footer" style="text-align:right;">Total :</td>
            <td class="footer" id="totalactivites" style="text-align:right;"></td>
            <td class="footer" width="90px" style="text-align:left;">jours</td>
	</tr>            
        </tfooter>        
	</table>
        </div>
</div>
<script>
    function sumOfColumns() {
        var tot = 0;
        $(".sstotal").each(function() {
          tot += parseFloat($(this).html());
        });
        return tot.toFixed(2);
     }
     
     $(document).ready(function () {
        $("#totalactivites").html(sumOfColumns());

        //setTimeout(function() {$('#ToRefresh').load('<?php echo $this->params->here; ?>');}, 60000); 
        $("[rel=tooltip]").tooltip({placement:'bottom',trigger:'hover',html:true});
    });
</script>