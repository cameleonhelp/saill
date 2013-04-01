<div class="activitesreelles index" id="ToRefresh">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php $defaultEtat = 'facture'; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'add')) : ?>
                <li><?php echo $this->Html->link('<i class="icon-plus"></i>', array('action' => 'add'),array('escape' => false)); ?></li>
                <li class="divider-vertical"></li>
                <?php endif; ?>
                <?php if ($this->params->controller == "activitesreelles" && $this->params->action != "afacturer") : ?>
                <?php $defaultEtat = 'tous'; ?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => $this->params->action,'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Non facturé', array('action' => $this->params->action,'actif',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                         <li><?php echo $this->Html->link('Facturé', array('action' => $this->params->action,'facture',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                     </ul>
                </li>  
                <?php endif; ?>
                <?php if (areaIsVisible()) :?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Utilisateurs <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => $this->params->action,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($utilisateurs as $utilisateur): ?>
                            <li><?php echo $this->Html->link($utilisateur['Utilisateur']['NOMLONG'], array('action' => $this->params->action,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,$utilisateur['Utilisateur']['id'],isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous')); ?></li>
                         <?php endforeach; ?>
                      </ul>
                </li>   
                <?php endif; ?> 
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Mois <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => $this->params->action,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','tous')); ?></li>
                     <li class="divider"></li>
                     <li><?php echo $this->Html->link('Janvier', array('action' => $this->params->action,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','01')); ?></li>
                     <li><?php echo $this->Html->link('Février', array('action' => $this->params->action,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','02')); ?></li>
                     <li><?php echo $this->Html->link('Mars', array('action' => $this->params->action,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','03')); ?></li>
                     <li><?php echo $this->Html->link('Avril', array('action' => $this->params->action,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','04')); ?></li>
                     <li><?php echo $this->Html->link('Mai', array('action' => $this->params->action,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','05')); ?></li>
                     <li><?php echo $this->Html->link('Juin', array('action' => $this->params->action,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','06')); ?></li>
                     <li><?php echo $this->Html->link('Juillet', array('action' => $this->params->action,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','07')); ?></li>
                     <li><?php echo $this->Html->link('Août', array('action' => $this->params->action,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','08')); ?></li>
                     <li><?php echo $this->Html->link('Septembre', array('action' => $this->params->action,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','09')); ?></li>
                     <li><?php echo $this->Html->link('Octobre', array('action' => $this->params->action,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','10')); ?></li>
                     <li><?php echo $this->Html->link('Novembre', array('action' => $this->params->action,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','11')); ?></li>
                     <li><?php echo $this->Html->link('Décembre', array('action' => $this->params->action,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','12')); ?></li>                     
                      </ul>
                </li>  
                </ul> 
                <?php echo $this->Form->create("Activitesreelle",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('class'=>'span8','placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn">Rechercher</button>
                <?php echo $this->Form->end(); ?> 
                </div>
            </div>
        </div>
        <?php if ($this->params['action']=='index') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste de <?php echo $fetat; ?> de <?php echo $futilisateur; ?> <?php echo $fperiode; ?></em></code><?php } ?>        
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" id="data">
        <thead>
	<tr>
			<th><?php echo 'Agent'; ?></th>
			<th><?php echo 'Date'; ?></th>
                        <th><?php echo 'Activités'; ?></th>
			<th width="20px"><?php echo 'Lu.'; ?></th>
			<th width="20px"><?php echo 'Ma.'; ?></th>
			<th width="20px"><?php echo 'Me.'; ?></th>
			<th width="20px"><?php echo 'Je.'; ?></th>
			<th width="20px"><?php echo 'Ve.'; ?></th>
			<th width="20px"><?php echo 'Sa.'; ?></th>
			<th width="20px"><?php echo 'Di.'; ?></th>
			<th><?php echo 'Total'; ?></th>
			<th class="actions" width="90px"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
        <tbody>   
        <?php if (count($activitesreelles)>0): ?>
        <?php $r = 0; ?>
        <?php foreach ($groups as $group) : ?>
        <?php $row = $groups[$r][0]['NBACTIVITE']; ?>
        <?php if($row > 1 && count($activitesreelles)>1): ?>
            <tr>
                <td class="header" rowspan="<?php echo $row; ?>" style="vertical-align: middle;"><?php echo $group['Utilisateur']['NOM']." ".$group['Utilisateur']['PRENOM']; ?></td>
                <td class="header" rowspan="<?php echo $row; ?>" style="vertical-align: middle;text-align: center;"><?php echo $group['Activitesreelle']['DATE']; ?></td>
        <?php endif; ?>
        <?php foreach ($activitesreelles as $activitesreelle): ?>
            <?php if($activitesreelle['Activitesreelle']['utilisateur_id']==$group['Activitesreelle']['utilisateur_id'] && dateIsEqual($group['Activitesreelle']['DATE'], $activitesreelle['Activitesreelle']['DATE'])): ?>
                <?php if ($row==1): ?>
                <tr>
                <td class="header"><?php echo $activitesreelle['Utilisateur']['NOMLONG']; ?></td>
                <td class="header" style="text-align: center;" ><?php echo $group['Activitesreelle']['DATE']; ?></td>
                <?php endif; ?>
                <td><?php echo $activitesreelle['Activite']['NOM']; ?></td>  
                <!--calculer les jours fériés pour mettre le style week sur les jours fériés //-->
                <?php $date = new DateTime(CUSDate($group['Activitesreelle']['DATE'])); ?> 
                <?php $classLu = isFerie($date) ? 'class="ferie"' : ''; ?>
                <td style="text-align: center;" <?php echo $classLu; ?>><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['LU']>0 && $activitesreelle['Activitesreelle']['LU']<1) ? $activitesreelle['Activitesreelle']['LU_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['LU']!=0 ? $activitesreelle['Activitesreelle']['LU'] : ""; ?></span></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classMA = isFerie($date) ? 'class="ferie"' : ''; ?>                
                <td style="text-align: center;" <?php echo $classMA; ?>><sapn <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['MA']>0 && $activitesreelle['Activitesreelle']['MA']<1) ? $activitesreelle['Activitesreelle']['MA_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['MA']!=0 ? $activitesreelle['Activitesreelle']['MA'] : ""; ?></span></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classME = isFerie($date) ? 'class="ferie"' : ''; ?>                
                <td style="text-align: center;" <?php echo $classME; ?>><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['ME']>0 && $activitesreelle['Activitesreelle']['ME']<1) ? $activitesreelle['Activitesreelle']['ME_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['ME']!=0 ? $activitesreelle['Activitesreelle']['ME'] : ""; ?></span></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classJE = isFerie($date) ? 'class="ferie"' : ''; ?>                
                <td style="text-align: center;" <?php echo $classJE; ?>><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['JE']>0 && $activitesreelle['Activitesreelle']['JE']<1) ? $activitesreelle['Activitesreelle']['JE_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['JE']!=0 ? $activitesreelle['Activitesreelle']['JE'] : ""; ?></span></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classVE = isFerie($date) ? 'class="ferie"' : ''; ?>                
                <td style="text-align: center;" <?php echo $classVE; ?>><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['VE']>0 && $activitesreelle['Activitesreelle']['VE']<1) ? $activitesreelle['Activitesreelle']['VE_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['VE']!=0 ? $activitesreelle['Activitesreelle']['VE'] : ""; ?></span></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classSA = isFerie($date) ? ' ferie' : ''; ?> 
                <td style="text-align: center;" class="week <?php echo $classSA; ?>"><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['SA']>0 && $activitesreelle['Activitesreelle']['SA']<1) ? $activitesreelle['Activitesreelle']['SA_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['SA']!=0 ? $activitesreelle['Activitesreelle']['SA'] : ""; ?></span></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classDI = isFerie($date) ? ' ferie' : ''; ?>
                <td style="text-align: center;" class="week <?php echo $classDI; ?>"><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['DI']>0 && $activitesreelle['Activitesreelle']['DI']<1) ? $activitesreelle['Activitesreelle']['DI_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['DI']!=0 ? $activitesreelle['Activitesreelle']['DI'] : ""; ?></span></td> 
                <td style="text-align: center;" class="sstotal"><?php echo $activitesreelle['Activitesreelle']['TOTAL']; ?></td> 
                <td style="text-align: center;">
                <?php if ($this->params->action != "afacturer") : ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'view')) : ?>
                    <?php echo isset($activitesreelle['Activitesreelle']['action_id']) ? '<i class="icon-eye-open" rel="popover" data-title="<h3>Action :</h3>" data-content="<contenttitle>Objet: </contenttitle>'.h($activitesreelle['Action']['OBJET']).'<br/><contenttitle>Avancement: </contenttitle>'.h($activitesreelle['Action']['AVANCEMENT']).'%<br/><contenttitle>Crée le: </contenttitle>'.h($activitesreelle['Action']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($activitesreelle['Action']['modified']).'" data-trigger="click" style="cursor: pointer;"></i>' : "<i class='icon-blank'></i>"; ?>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'edit')) : ?>
                    <?php echo $this->Html->link('<i class="icon-pencil"></i>', array('action' => 'edit', $activitesreelle['Activitesreelle']['id']),array('escape' => false)); ?>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<i class="icon-trash"></i>', array('action' => 'delete', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette feuille de temps ?')); ?>                    
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'update')) : ?>
                    <?php $img = $activitesreelle['Activitesreelle']['VEROUILLE']==0 ? 'icon-thumbs-up' : 'icon-thumbs-down'; ?>
                    <?php echo $this->Form->postLink('<i class="'.$img.'"></i>', array('action' => 'updatefacturation', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir mettre à jour cette feuille de temps pour facturation ?')); ?>                    
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'duplicate')) : ?>
                    <?php echo $this->Html->link('<i class=" icon-tags"></i>', array('action' => 'autoduplicate', $activitesreelle['Activitesreelle']['id']),array('escape' => false)); ?>                    
                    <?php endif; ?>
                <?php else : ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'edit')) : ?>
                    <?php echo $this->Html->link('<i class="icon-ok-sign"></i>', array('action' => 'edit', $activitesreelle['Activitesreelle']['id']),array('escape' => false)); ?>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'update')) : ?>
                    <?php $img = 'icon-remove-sign'; ?>
                    <?php echo $this->Form->postLink('<i class="'.$img.'"></i>', array('action' => 'errorfacturation', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir mettre à jour cette feuille de temps pour correction ?')); ?>                    
                    <?php endif; ?>
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
            <td colspan="10" class="footer" style="text-align:right;">Total :</td>
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

        setInterval(function() {$('#ToRefresh').load('<?php echo $this->params->here; ?>');}, 30000); 
        $("[rel=tooltip]").tooltip({placement:'bottom',trigger:'hover',html:true});
    });
</script>