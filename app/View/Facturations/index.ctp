<div class="facturations index">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php $defaultAction = $this->params->action == "search" ? 'index' : $this->params->action; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('facturations', 'add')) : ?>
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                <?php endif; ?>
                 <li><?php echo $this->Html->link('A facturer', array('controller'=>'activitesreelles','action' => 'afacturer'),array('escape' => false)); ?></li>
                 <?php if (areaIsVisible()) :?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Utilisateurs <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => $defaultAction,'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous')); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($utilisateurs as $utilisateur): ?>
                            <li><?php echo $this->Html->link($utilisateur['Utilisateur']['NOMLONG'], array('action' => $defaultAction,$utilisateur['Utilisateur']['id'],isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous')); ?></li>
                         <?php endforeach; ?>
                      </ul>
                </li>   
                <?php endif; ?> 
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Mois <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous')); ?></li>
                     <li class="divider"></li>
                     <li><?php echo $this->Html->link('Janvier', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','01')); ?></li>
                     <li><?php echo $this->Html->link('Février', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','02')); ?></li>
                     <li><?php echo $this->Html->link('Mars', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','03')); ?></li>
                     <li><?php echo $this->Html->link('Avril', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','04')); ?></li>
                     <li><?php echo $this->Html->link('Mai', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','05')); ?></li>
                     <li><?php echo $this->Html->link('Juin', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','06')); ?></li>
                     <li><?php echo $this->Html->link('Juillet', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','07')); ?></li>
                     <li><?php echo $this->Html->link('Août', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','08')); ?></li>
                     <li><?php echo $this->Html->link('Septembre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','09')); ?></li>
                     <li><?php echo $this->Html->link('Octobre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','10')); ?></li>
                     <li><?php echo $this->Html->link('Novembre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','11')); ?></li>
                     <li><?php echo $this->Html->link('Décembre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','12')); ?></li>                     
                      </ul>
                </li>  
                </ul> 
                <?php echo $this->Form->create("Facturation",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('class'=>'span8','placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn">Rechercher</button>
                <?php echo $this->Form->end(); ?>                     
                </div>
            </div>
        </div>
        <?php if ($this->params['action']=='index') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste des facturations de <?php echo $futilisateur; ?> <?php echo $fperiode; ?></em></code><?php } ?>        
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
                <td><?php echo $facturation['Activite']['NOM']; ?></td>  
                <?php $date = new DateTime(CUSDate($group['Facturation']['DATE'])); ?> 
                <?php $classLu = isFerie($date) ? 'class="ferie"' : ''; ?>
                <td style="text-align: center;" <?php echo $classLu; ?>><?php echo $facturation['Facturation']['LU']!=0 ? $facturation['Facturation']['LU'] : ""; ?></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classMA = isFerie($date) ? 'class="ferie"' : ''; ?>                
                <td style="text-align: center;" <?php echo $classMA; ?>><?php echo $facturation['Facturation']['MA']!=0 ? $facturation['Facturation']['MA'] : ""; ?></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classME = isFerie($date) ? 'class="ferie"' : ''; ?>                
                <td style="text-align: center;" <?php echo $classME; ?>><?php echo $facturation['Facturation']['ME']!=0 ? $facturation['Facturation']['ME'] : ""; ?></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classJE = isFerie($date) ? 'class="ferie"' : ''; ?>                
                <td style="text-align: center;" <?php echo $classJE; ?>><?php echo $facturation['Facturation']['JE']!=0 ? $facturation['Facturation']['JE'] : ""; ?></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classVE = isFerie($date) ? 'class="ferie"' : ''; ?>                
                <td style="text-align: center;" <?php echo $classVE; ?>><?php echo $facturation['Facturation']['VE']!=0 ? $facturation['Facturation']['VE'] : ""; ?></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classSA = isFerie($date) ? ' ferie' : ''; ?> 
                <td style="text-align: center;" class="week <?php echo $classSA; ?>"><?php echo $facturation['Facturation']['SA']!=0 ? $facturation['Facturation']['SA'] : ""; ?></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classDI = isFerie($date) ? ' ferie' : ''; ?>
                <td style="text-align: center;" class="week <?php echo $classDI; ?>"><?php echo $facturation['Facturation']['DI']!=0 ? $facturation['Facturation']['DI'] : ""; ?></td> 
                <td style="text-align: center;" class="sstotal"><?php echo $facturation['Facturation']['TOTAL']; ?></td> 
                <td style="text-align: center;">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('facturations', 'view')) : ?>
                    <?php echo '<i class="icon-eye-open" rel="popover" data-title="<h3>Facturation :</h3>" data-content="<contenttitle>Crée le: </contenttitle>'.h($facturation['Facturation']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($facturation['Facturation']['modified']).'" data-trigger="click" style="cursor: pointer;"></i>'; ?>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('facturations', 'edit')) : ?>
                    <?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $facturation['Facturation']['id'], $facturation['Facturation']['utilisateur_id']),array('escape' => false)); ?>
                    <?php endif; ?>
                </td>                 
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
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
<script>
    function sumOfColumns() {
        var tot = 0;
        $(".sstotal").each(function() {
          tot += parseFloat($(this).html());
        });
        return tot;
     }
     
     $(document).ready(function () {
        $("#totalactivites").html(sumOfColumns());

        setInterval(function() {$('#ToRefresh').load('<?php echo $this->params->here; ?>');}, 60000); 
        $("[rel=tooltip]").tooltip({placement:'bottom',trigger:'hover',html:true});
    });
</script>