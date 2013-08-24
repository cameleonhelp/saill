<div class="activitesreelles index" id="ToRefresh">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                <ul class="nav">
                <?php $defaultEtat = $this->params->action == "afacturer" ? 'facture' : 'tous'; ?>
                <?php $defaultAction = $this->params->action == "search" ? 'index' : $this->params->action; 
                      $filtre_annee = isset($this->params->pass[3]) ? $this->params->pass[3] : date('Y'); ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'add') && strtolower($this->params->controller)=='activitesreelles') : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14" rel="tooltip" data-title="Ajoutez une nouvelle feuille de temps"></span>', array('action' => 'newactivite'),array('escape' => false,'class'=>'showoverlay')); ?></li>
                <li class="divider-vertical-only"></li>
                <?php endif; ?>
                <?php if ($defaultEtat == "tous") : ?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => $defaultAction,'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Non facturé', array('action' => $defaultAction,'actif',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                         <li><?php echo $this->Html->link('Facturé', array('action' => $defaultAction,'facture',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                     </ul>
                </li> 
                <?php else : ?>
                <li><?php echo $this->Html->link('Facturé', array('controller'=>'facturations','action' => 'index'),array('escape' => false)); ?></li>
                <?php endif; ?>
                <?php if (areaIsVisible()) :?>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Utilisateurs <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('Moi', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,  userAuth('id'),isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($utilisateurs as $utilisateur): ?>
                            <li><?php echo $this->Html->link($utilisateur['Utilisateur']['NOMLONG'], array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,$utilisateur['Utilisateur']['id'],isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                         <?php endforeach; ?>
                      </ul>
                </li>   
                <?php endif; ?> 
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Mois <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','tous',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                     <li class="divider"></li>
                     <li><?php echo $this->Html->link('Janvier', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','01',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('Février', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','02',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('Mars', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','03',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('Avril', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','04',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('Mai', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','05',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('Juin', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','06',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('Juillet', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','07',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('Août', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','08',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('Septembre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','09',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('Octobre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','10',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('Novembre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','11',$filtre_annee),array('class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('Décembre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','12',$filtre_annee),array('class'=>'showoverlay')); ?></li>                     
                      </ul>
                </li> 
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Année <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('En cours', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',date('Y')),array('class'=>'showoverlay')); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($annees as $annee): ?>
                            <?php if ($annee[0]['ANNEE']!=0): ?>
                            <li><?php echo $this->Html->link($annee[0]['ANNEE'], array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',$annee[0]['ANNEE']),array('class'=>'showoverlay')); ?></li>
                            <?php endif; ?>
                         <?php endforeach; ?>
                      </ul>
                </li>                  
                <?php if ($this->params->action == "afacturer") : ?>
                <li class="divider-vertical-only"></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicons check"></span> Actions groupées <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Facturer', "#",array('id'=>'facturerlink','class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('Rejeter', "#",array('id'=>'rejeterlink','class'=>'showoverlay')); ?></li>
                     </ul>
                </li>
                <li class="divider-vertical-only"></li>
                <li><?php echo $this->Html->link('<span class="ico-xls icon-top2" rel="tooltip" data-title="Export Excel"></span>', array('action' => 'export_xls'),array('escape' => false)); ?></li>  
                <?php else: ?>
                <?php if(userAuth('societe_id')==1 && $this->params->action != "afacturer"): ?>
                <li class="divider-vertical-only"></li>
                <li><?php echo $this->Html->link('<span class="ico-ics icon-top2" rel="tooltip" data-title="Importez le fichier ICS issu de l\'outil RH"></span>', '#',array('escape' => false,'id'=>'importics')); ?></li>                 
                <?php endif; ?>
                <?php endif; ?>
                <?php if ($this->params->action != "afacturer") : ?>
                <li class="divider-vertical-only"></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicons check"></span> Actions groupées <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'update')) : ?>
                     <li><?php echo $this->Html->link('Soumettre', "#",array('id'=>'soumettrelink','class'=>'showoverlay')); ?></li>
                     <?php endif; ?>
                     <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'deleteall')) : ?>
                     <li><?php echo $this->Html->link('Supprimer', "#",array('id'=>'deletelink'), __('Etes-vous certain de vouloir supprimer ces feuilles de temps ?')); ?></li>
                     <?php endif; ?>
                     </ul>
                </li>   
                <?php endif; ?>                
                </ul> 
                <?php if ($this->params->controller == "activitesreelles" && $this->params->action == "index") : ?>
                <?php echo $this->Form->create("Activitesreelle",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?>                    
                <?php elseif ($this->params->controller == "facturations") : ?>
                <?php echo $this->Form->create("Facturation",array('action' => 'search','class'=>'navbar-form clearfix pull-right','inputDefaults' => array('label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche dans tous les champs')); ?>
                    <button type="submit" class="btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?>                     
                <?php endif; ?>
                <ul class="nav pull-right">
                    <li><a href="#" rel="popover" data-title="Aide" data-placement="bottom" data-content="<?php echo $this->element('hlp/hlp-activites'); ?>"><span><span class="glyphicons blue circle_question_mark size14"></span></span></a></li>
                </ul>                    
                </div>
            </div>
        </div> 
        <?php if ($this->params['action']=='index') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste de <?php echo $fetat; ?> de <?php echo $futilisateur; ?> <?php echo $fperiode; ?></em></code><?php } ?>        
        <?php if ($this->params['action']=='afacturer') { ?><code class="text-normal"  style="margin-bottom: 10px;display: block;"><em>Liste de <?php echo $fetat; ?> de <?php echo $futilisateur; ?> <?php echo $fperiode; ?></em></code><?php } ?>                
        <div class="alert alert-info">
            Vous devez saisir des semaines entières, en ce qui concerne les jours ouvrés.<br>
            Si la semaine commence sur le mois courant et se termine sur le mois suivant vous devez saisir la semaine entière, même sur le mois suivant.
        </div>   
        <?php if(userAuth('societe_id')==1): ?>
        <div class="well well-small" id="icsparser">
        <?php echo $this->Form->create('Fileshared',array('action'=>'parseICS','id'=>'formValidate','class'=>'form-horizontal', 'style'=>'margin-bottom:-7px !important;','type' => 'file','inputDefaults' => array('label'=>false,'div' => false))); ?>
        <table width="450px" align="center"> 
            <tr>
            <td width="50px"><label class="control-label sstitre" for="FilesharedFile">Fichiers ICS à intégrer : </label></td>
            <td width="150px" style="text-align:left;">
                <?php echo $this->Form->input('file', array('type' => 'file','size'=>"40")); ?>  
            </td>
            <td width="50px"><label class="sstitre" for="FilesharedUtilisateurId" style="width:50px;">Pour : </label></td>
            <td width="150px" style="text-align:left;">
                    <?php echo $this->Form->select('utilisateur_id',$icsutilisateurs,array('data-rule-required'=>'true','default'=>  userAuth('id'),'data-msg-required'=>"Le nom de l'utilisateur est obligatoire dans l'onglet Destinataire", 'empty' => 'Choisir un utilisateur')); ?>
            </td>
            <td width="50px"><?php echo $this->Form->button('Intégrer', array('class' => 'btn btn-primary pull-right showoverlay','type'=>'submit')); ?></td>
            </tr>
        </table>
        <?php echo $this->Form->end(); ?>
        </div>
        <?php endif; ?>        
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" id="data">
        <thead>
	<tr>
                        <th><?php echo 'Agent'; ?></th>
                        <th><?php echo 'Identifiant'; ?></th>
			<th><?php echo 'Date'; ?></th>
                        <?php $margeright = $this->params->action=='afacturer' ? '0px':'5px'; ?>
                        <th style="text-align:center;width:15px !important;vertical-align: middle;padding-left:5px;padding-right:<?php echo $margeright; ?>;"><?php echo $this->Form->input('checkall',array('type'=>'checkbox','label'=>false)) ; ?>
                                <?php echo $this->Form->input('all_ids',array('type'=>'hidden')) ; ?>
                        </th>	
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
                <td class="header" rowspan="<?php echo $row; ?>" style="vertical-align: middle;"><?php echo $group['Utilisateur']['username']; ?></td>
                <td class="header" rowspan="<?php echo $row; ?>" style="vertical-align: middle;text-align: center;"><?php echo $group['Activitesreelle']['DATE']; ?></td>   
        <?php endif; ?>
        <?php if (isset($activitesreelles)): ?>
	<?php foreach ($activitesreelles as $activitesreelle): ?>
            <?php if($activitesreelle['Activitesreelle']['utilisateur_id']==$group['Activitesreelle']['utilisateur_id'] && dateIsEqual($group['Activitesreelle']['DATE'], $activitesreelle['Activitesreelle']['DATE'])): ?>
                <?php if ($row==1): ?>
                <tr>
                <td class="header"><?php echo $activitesreelle['Utilisateur']['NOMLONG']; ?></td>
                <td class="header"><?php echo $activitesreelle['Utilisateur']['username']; ?></td>
                <td class="header" style="text-align: center;" ><?php echo $group['Activitesreelle']['DATE']; ?></td>               
                <?php endif; ?>
                <?php $margeright = $this->params->action=='afacturer' ? '0px':'5px'; ?>
                <td style="text-align:center;padding-left:5px;padding-right:<?php echo $margeright; ?>;vertical-align: middle;"><?php echo $this->Form->input('id',array('type'=>'checkbox','label'=>false,'class'=>'idselect','value'=>$activitesreelle['Activitesreelle']['id'])) ; ?></td>                
                <td><?php echo $activitesreelle['Activitesreelle']['projet_NOM'].' - '.$activitesreelle['Activite']['NOM']; ?>
                <?php if($this->params->controller=='activitesreelles' && $activitesreelle['Domaine']['NOM']): ?>
                    <small class="muted">(<?php echo strtoupper($activitesreelle['Domaine']['NOM']); ?>)</small>
                <?php endif; ?>
                </td>  
                <!--calculer les jours fériés pour mettre le style week sur les jours fériés //-->
                <?php $date = new DateTime(CUSDate($group['Activitesreelle']['DATE'])); ?> 
                <?php $classLu = isFerie($date) ? 'class="ferie"' : ''; ?>
                <td style="text-align: center;" <?php echo $classLu; ?>><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['LU']>0 && $activitesreelle['Activitesreelle']['LU']<1) ? $activitesreelle['Activitesreelle']['LU_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['LU']!=0 ? $activitesreelle['Activitesreelle']['LU'] : ""; ?></span></td> 
                <?php $date->add(new DateInterval('P1D')); ?>
                <?php $classMA = isFerie($date) ? 'class="ferie"' : ''; ?>                
                <td style="text-align: center;" <?php echo $classMA; ?>><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['MA']>0 && $activitesreelle['Activitesreelle']['MA']<1) ? $activitesreelle['Activitesreelle']['MA_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['MA']!=0 ? $activitesreelle['Activitesreelle']['MA'] : ""; ?></span></td> 
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
                    <?php echo isset($activitesreelle['Activitesreelle']['action_id']) ? '<span><span rel="tooltip" data-title="Cliquez pour avoir un aperçu"><span class="glyphicons eye_open" rel="popover" data-title="<h3>Action :</h3>" data-content="<contenttitle>Objet: </contenttitle>'.h($activitesreelle['Action']['OBJET']).'<br/><contenttitle>Avancement: </contenttitle>'.h($activitesreelle['Action']['AVANCEMENT']).'%<br/><contenttitle>Crée le: </contenttitle>'.h($activitesreelle['Action']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($activitesreelle['Action']['modified']).'" data-trigger="click" style="cursor: pointer;"></span></span></span>' : "<span class='glyphicons blank'></span></span></span>"; ?>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'edit') && $activitesreelle['Activitesreelle']['VEROUILLE'] == 1 ) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil" rel="tooltip" data-title="Modification"></span>', array('action' => 'edit', $activitesreelle['Activitesreelle']['id']),array('escape' => false,'class'=>'showoverlay')); ?>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'delete') && $activitesreelle['Activitesreelle']['VEROUILLE'] == 1) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons bin" rel="tooltip" data-title="Suppression"></span>', array('action' => 'delete', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette feuille de temps ?')); ?>                    
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'update')) : ?>
                    <?php $img = $activitesreelle['Activitesreelle']['VEROUILLE']==0 ? 'thumbs_up' : 'thumbs_down'; ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons  '.$img.'" rel="tooltip" data-title="A soumettre pour factution<br>si pouce en bas<br>Soumis pour facturation<br>si pouce en haut"></span>', array('action' => 'updatefacturation', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir mettre à jour cette feuille de temps pour facturation ?')); ?>                    
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'duplicate') && $activitesreelle['Activitesreelle']['VEROUILLE'] == 1) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons retweet" rel="tooltip" data-title="Duplication"></span>', array('action' => 'autoduplicate', $activitesreelle['Activitesreelle']['id']),array('escape' => false,'class'=>'showoverlay')); ?>                    
                    <?php endif; ?>
                <?php else : ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons ok" rel="tooltip" data-title="Facturation"></span>', array('controller' => 'facturations','action' => 'add', $activitesreelle['Activitesreelle']['utilisateur_id'], $activitesreelle['Activitesreelle']['id']),array('escape' => false,'class'=>'showoverlay')); ?>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'update')) : ?>
                    <?php $img = 'ban'; ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons '.$img.'" rel="tooltip" data-title="Annulation (rejet)"></span>', array('action' => 'errorfacturation', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir mettre à jour cette feuille de temps pour correction ?')); ?>                    
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
            <?php $nbrows = $this->params->action == "afacturer" ? 12 : 12; ?>
            <td colspan="<?php echo $nbrows; ?>" class="footer admonition" style="text-align:right;">
                <?php if($this->params->action == "afacturer"): ?>
                <?php $memo = $this->requestAction('parameters/get_memofacturation') ?>
                <?php $icon = $memo['Parameter']['param']!="" ? 'bell' : 'pencil';?>
                    <a href="#myModal1" role="button" class="" data-toggle="modal"><div class="admonition-title cursor"  rel="tooltip" data-title="Ajout ou modification d'un memo"><span class='glyphicons <?php echo $icon; ?> white'></span></div></a>
               <?php  endif; ?>
                Total :</td>
            <td class="footer" id="totalactivites" style="text-align:right;"></td>
            <td class="footer" width="90px" style="text-align:left;">jours</td>
	</tr>            
        </tfooter>
	</table>  
        <div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Enregistrement du mémo</h3>
            </div>
            <div class="modal-body">
                <form id="Parameter" method="POST" data-async data-target="#myModal1">
                <input type="hidden" name="InfroText" value="1">
                <table>
                    <tbody>
                        <tr><td><span class="clearable">
                                    <input type='text' style='width:580px;' class="data_field" id="memo" value="<?php echo $memo['Parameter']['param']; ?>" />
                                <span class="icon_clear"><span class="glyphicons circle_remove grey top2"</span></span></td></tr>
                    </tbody>
                </table>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Annuler</button>
                <button class="btn btn-primary" data-dismiss="modal" id="InfroTextSubmit">Sauvegarder</button>
            </div>
        </div>
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
         $('#icsparser').hide();
         
         $(document).on('propertychange keyup input paste focus', 'input.data_field', function(){
            var io = $(this).val().length ? 1 : 0 ;
            $(this).next('.icon_clear').stop().fadeTo(300,io);
         }).on('click', '.icon_clear', function() {
            $(this).delay(300).fadeTo(300,0).prev('input').val('');
         });

         $(document).on('click','#InfroTextSubmit',function(e){
            //e.preventDefault();
            var memo = $(this).parents().find('#memo').val();
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'Parameters','action'=>'ajaxSaveParam')); ?>/",
                data: ({id:7,memo:memo})
            }).done(function ( data ) {
            location.reload();
            });
            return true;
        });
        
        $(document).on('show','#myModal1', function () {
            $(this).find('.modal-body').css({width:'600px',
                                       height:'auto', 
                                      'max-height':'100%'}); 
            $(this).css({'width': '630px','margin-left': function () {return -($(this).width() / 2);}})
            $(this).find("#memo").focus();
            //$('input:text:visible:first', this).focus();
        });
        
        $(document).on('click','#importics',function(e){
            $('#icsparser').fadeToggle('slow');
        });
        
        $(document).on('click','#facturerlink',function(e){
            var ids = $("#all_ids").val();
            var overlay = $('#overlay');
            overlay.show(); 
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'activitesreelles','action'=>'facturer')); ?>/",
                data: ({all_ids:ids})
            }).done(function ( data ) {
                location.reload();
                overlay.hide();
            });
            $(this).parents().find(':checkbox').prop('checked', false); 
            $("#all_ids").val('');
        });
        
        $(document).on('click','#rejeterlink',function(e){
            var ids = $("#all_ids").val();
            var overlay = $('#overlay');
            overlay.show();             
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'activitesreelles','action'=>'rejeter')); ?>/",
                data: ({all_ids:ids})     
            }).done(function ( data ) {
                location.reload();
                overlay.hide();                
            });
            $(this).parents().find(':checkbox').prop('checked', false); 
            $("#all_ids").val('');
        });  
        
        $(document).on('click','#soumettrelink',function(e){
            var ids = $("#all_ids").val();
            var overlay = $('#overlay');
            overlay.show();             
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'activitesreelles','action'=>'soumettre')); ?>/",
                data: ({all_ids:ids})     
            }).done(function ( data ) {
                location.reload();
                overlay.hide();                
            });
            $(this).parents().find(':checkbox').prop('checked', false); 
            $("#all_ids").val('');
        }); 
        
        $(document).on('click','#deletelink',function(e){
                var ids = $("#all_ids").val();
                var overlay = $('#overlay');
                overlay.show();            
                $.ajax({
                    dataType: "html",
                    type: "POST",
                    url: "<?php echo $this->Html->url(array('controller'=>'activitesreelles','action'=>'deleteall')); ?>/",
                    data: ({all_ids:ids})     
                }).done(function ( data ) {
                    location.reload();
                    overlay.hide();                
                }).succes(function(e){
                    overlay.hide();
                });
            $(this).parents().find(':checkbox').prop('checked', false); 
            $("#all_ids").val('');
        }); 
        
        $(document).on('click','#checkall',function(e){
            $(this).parents().find(':checkbox').prop('checked', this.checked);
            if ($(this).is(':checked')){
                $(".idselect").each(
                        function() {
                            if ($("#all_ids").val()==""){
                                $("#all_ids").val($(this).val());                    
                            }else{
                                $("#all_ids").val($("#all_ids").val()+"-"+$(this).val());
                            }
                        });          
            }else{
                $("#all_ids").val("");
            }
        });
        
        $(document).on('click','.idselect',function(e){
            if ($(this).is(':checked')){
                if ($("#all_ids").val()==""){
                    $("#all_ids").val($(this).val());                    
                }else{
                    $("#all_ids").val($("#all_ids").val()+"-"+$(this).val());
                }
            } else {
                var list = $("#all_ids").val();
                $("#all_ids").val("");
                tmp = list.replace($(this).val()+"-", "");
                if (tmp == list) tmp = list.replace("-"+$(this).val(), ""); 
                $("#all_ids").val(tmp);
            }
        });
    });
</script>