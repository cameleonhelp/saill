        <?php //filtres par défaut
        $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous';
        $pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous';
        $pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous';
        $pass3 = isset($this->params->pass[3]) ? $this->params->pass[3] : 'tous'; //userAuth('id');
        $passaction = $this->params['action'] == '' ? 'index' : $this->params['action'];
        if (count($this->params->data) > 0) :
            $keyword = $this->params->data['Action']['SEARCH'];
        elseif (isset($this->params->pass[4]) && $this->params->pass[4] !=''):
            $keyword = $this->params->pass[4];
        elseif (isset($keywords) && $keywords != ''):
            $keyword = $keywords;
        else :
            $keyword = '';
        endif;
        ?>       
        <?php $urlpost = $this->Html->url(array('controller'=>'actions','action'=>"ajax_update")); ?>
        <nav class="navbar toolbar">
                <ul class="nav navbar-nav toolbar">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'add')) : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4" rel="tooltip" data-container="body" data-title="Ajoutez une action"></span>', array('action' => 'add'),array('escape' => false,'class'=>'showoverlay')); ?></li>
                <li class="divider-vertical-only"></li>
                <?php endif; ?>
                <li class="dropdown <?php echo filtre_is_actif(isset($pass0) ? $pass0 : 'tous','tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Priorité <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => $passaction,'tous',isset($pass1) ? $pass1 : 'tous',isset($pass2) ? $pass2 : 'tous',$pass3,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass0) ? $pass0 : 'tous','tous'))); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Normale', array('action' => $passaction,'1',isset($pass1) ? $pass1 : 'tous',isset($pass2) ? $pass2 : 'tous',$pass3,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass0) ? $pass0 : 'tous','1'))); ?></li>
                         <li><?php echo $this->Html->link('Moyenne', array('action' => $passaction,'2',isset($pass1) ? $pass1 : 'tous',isset($pass2) ? $pass2 : 'tous',$pass3,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass0) ? $pass0 : 'tous','2'))); ?></li>
                         <li><?php echo $this->Html->link('Haute', array('action' => $passaction,'3',isset($pass1) ? $pass1 : 'tous',isset($pass2) ? $pass2 : 'tous',$pass3,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass0) ? $pass0 : 'tous','3'))); ?></li>
                     </ul>
                </li>
                <li class="dropdown <?php echo filtre_is_actif(isset($pass1) ? $pass1 : 'tous','tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Etats <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => $passaction,isset($pass0) ? $pass0 : 'tous','tous',isset($pass2) ? $pass2 : 'tous',$pass3,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass1) ? $pass1 : 'tous','tous'))); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Nouvelles', array('action' => $passaction,isset($pass0) ? $pass0 : 'tous','news',isset($pass2) ? $pass2 : 'tous',$pass3,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass1) ? $pass1 : 'tous','news'))); ?></li>
                         <li class="divider"></li>                         
                         <li><?php echo $this->Html->link('A faire', array('action' => $passaction,isset($pass0) ? $pass0 : 'tous','1',isset($pass2) ? $pass2 : 'tous',$pass3,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass1) ? $pass1 : 'tous','1'))); ?></li>
                         <li><?php echo $this->Html->link('En cours', array('action' => $passaction,isset($pass0) ? $pass0 : 'tous','2',isset($pass2) ? $pass2 : 'tous',$pass3,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass1) ? $pass1 : 'tous','2'))); ?></li>
                         <li><?php echo $this->Html->link('Terminée', array('action' => $passaction,isset($pass0) ? $pass0 : 'tous','3',isset($pass2) ? $pass2 : 'tous',$pass3,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass1) ? $pass1 : 'tous','3'))); ?></li>
                         <li><?php echo $this->Html->link('Livrée', array('action' => $passaction,isset($pass0) ? $pass0 : 'tous','4',isset($pass2) ? $pass2 : 'tous',$pass3,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass1) ? $pass1 : 'tous','4'))); ?></li>
                         <li><?php echo $this->Html->link('Annulée', array('action' => $passaction,isset($pass0) ? $pass0 : 'tous','5',isset($pass2) ? $pass2 : 'tous',$pass3,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass1) ? $pass1 : 'tous','5'))); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Todolist', array('action' => $passaction,isset($pass0) ? $pass0 : 'tous','6',isset($pass2) ? $pass2 : 'tous',$pass3,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass1) ? $pass1 : 'tous','6'))); ?></li>
                     </ul>
                </li>   
                <li class="dropdown <?php echo filtre_is_actif(isset($pass3) ? $pass3 : 'tous','tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Emetteur <b class="caret"></b></a>
                     <ul class="dropdown-menu dropdown-menu-form">                         
                         <li><?php echo $this->Html->link('Tous', array('action' => $passaction,isset($pass0) ? $pass0 : 'tous',isset($pass1) ? $pass1 : 'tous',$pass2,  'tous',$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass3) ? $pass3 : 'tous','tous'))); ?></li>
                         <li><?php echo $this->Html->link('Moi', array('action' => $passaction,isset($pass0) ? $pass0 : 'tous',isset($pass1) ? $pass1 : 'tous',$pass2,  userAuth('id'),$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass3) ? $pass3 : 'tous',userAuth('id')))); ?></li>
                         <li class="divider"></li>
                         <?php echo $this->Form->create("Action",array('url' => array('action' => $passaction,$pass0,$pass1,$pass2,$pass3))); ?>
                         <li style="text-align:center;"><?php echo $this->Html->link("Valider", "#",array('class'=>'btn btn-sm btn-default btnfilterresponsablre showoverlay',"style"=>"margin-bottom:5px;")); ?></li>
                         <?php foreach ($responsables as $responsable): ?>
                            <!--<li><?php echo $this->Html->link("<label  class='checkbox'><input type='checkbox'>".$responsable['Utilisateur']['NOMLONG']."</label>", array('action' => $passaction,isset($pass0) ? $pass0 : 'tous',isset($pass1) ? $pass1 : 'tous',$pass2,$responsable['Utilisateur']['id'],$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass3) ? $pass3 : 'tous',$responsable['Utilisateur']['id']))); ; ?></li>//-->
                         <li class='liselect' data-id="<?php echo $responsable['Utilisateur']['id']; ?>"><input type="checkbox" class='selectresponsable' data-id="<?php echo $responsable['Utilisateur']['id']; ?>" id="id<?php echo $responsable['Utilisateur']['id']; ?>"/> <label for="id<?php echo $responsable['Utilisateur']['id']; ?>"><?php echo $responsable['Utilisateur']['NOMLONG']; ?></label></li>
                         <?php endforeach; ?>
                         <input type='hidden' id='allResponsablesSelected' value="<?php echo $pass3!="tous" ? $pass3 : "" ?>">
                         <li style="text-align:center;"><?php echo $this->Html->link("Valider", "#",array('class'=>'btn btn-sm btn-default btnfilterresponsablre showoverlay',"style"=>"margin-top:5px;")); ?></li>
                         <?php echo $this->Form->end(); ?>
                     </ul>
                 </li>                      
                <?php if (areaIsVisible()) :?>                
                <li class="dropdown <?php echo filtre_is_actif(isset($pass2) ? $pass2 : 'tous',  'tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Destinataire <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><?php echo $this->Html->link('Tous', array('action' => $passaction,isset($pass0) ? $pass0 : 'tous',isset($pass1) ? $pass1 : 'tous','tous',$pass3,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass2) ? $pass2 : 'tous','tous'))); ?></li>
                         <li><?php echo $this->Html->link('Moi', array('action' => $passaction,isset($pass0) ? $pass0 : 'tous',isset($pass1) ? $pass1 : 'tous',  userAuth('id'),$pass3,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass2) ? $pass2 : 'tous',userAuth('id')))); ?></li>
                         <li class="divider"></li>
                         <li><?php echo $this->Html->link('Mon équipe', array('action' => $passaction,isset($pass0) ? $pass0 : 'tous',isset($pass1) ? $pass1 : 'tous',  'equipe',$pass3,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass2) ? $pass2 : 'tous','equipe'))); ?></li>
                         <li class="divider"></li>
                         <?php foreach ($responsables as $responsable): ?>
                            <li><?php echo $this->Html->link($responsable['Utilisateur']['NOMLONG'], array('action' => $passaction,isset($pass0) ? $pass0 : 'tous',isset($pass1) ? $pass1 : 'tous',$responsable['Utilisateur']['id'],$pass3,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($pass2) ? $pass2 : 'tous',$responsable['Utilisateur']['id']))); ; ?></li>
                         <?php endforeach; ?>
                     </ul>
                 </li>                 
                 <?php  endif; ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicons check"></span> Actions groupées <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Supprimer', "#",array('id'=>'deletelink','class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('Terminer', "#",array('id'=>'closelink','class'=>'showoverlay')); ?></li>
                     <li><?php echo $this->Html->link('CRA', "#",array('id'=>'cralink','class'=>'showoverlay')); ?></li>
                     </ul>
                </li>  
                 <li class="divider-vertical-only"></li>
                <li><?php echo $this->Html->link('<span class="ico-xls" rel="tooltip" data-container="body" data-title="Export Excel"></span>', array('action' => 'export_xls'),array('escape' => false)); ?></li>
                <li class="divider-vertical-only"></li>   
                <li><?php echo $this->Html->link('<span class="glyphicons eye_close size14 margintop4 notactive" rel="tooltip" data-title="Ouvrir ou fermer le détail des utilisateurs de cette page"></span>', "#",array('class'=>"md btn_eye_close",'escape' => false)); ?></li>
                <li class="divider-vertical-only"></li>                 
                </ul> 
                <ul class="nav navbar-nav toolbar pull-right">
                    <li><?php echo $this->Html->link('<span class="glyphicons blue circle_question_mark size14 margintop4"></span>', '#',array('escape' => false,'data-toggle'=>"modal",'data-target'=>"#modalhelp")); ?></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                        <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                            <li>
                                <?php echo $this->Form->create("Action",array('url' => array('action' => 'search',$pass0,$pass1,$pass2,$pass3), 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;margin-left:3px;margin-right:-3px;display: inline-table;",'class'=>"form-control",'value'=>$keyword, 'rel'=>"tooltip", 'data-container'=>"body", 'data-title'=>Configure::read('search_tooltip'))); ?>
                                    <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                                <?php echo $this->Form->end(); ?> 
                            </li>
                        </ul>
                    </li>
                </ul>
        </nav>
        <?php echo $this->element('modals/help',array('helpcontent' => $this->element('hlp/hlp-action'))); ?>
        <div class="panel-body panel-filter marginbottom15">
            <strong>Filtre appliqué : </strong><em>Liste des actions avec <?php echo $fpriorite; ?>, <?php echo $fetat; ?> ayant <?php echo $femetteur; ?> et pour destinataire <?php echo $fresponsable; ?></em></div>      
    <div>    
    <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover resizable" style="width:100%;" id="actionslist">
        <thead>
	<tr>
                        <th style="min-width:95px;"><?php echo $this->Paginator->sort('id','N°'); ?></th>
                        <th style="text-align:center;width:15px !important;vertical-align: middle;padding-left:5px;"><?php echo $this->Form->input('checkall',array('type'=>'checkbox','label'=>false)) ; ?>
                                <?php echo $this->Form->input('all_ids',array('type'=>'hidden')) ; ?>
                        </th>   
                        <th width="5px">&nbsp;</th>
			<th><?php echo $this->Paginator->sort('Domaine.NOM','Domaine'); ?></th>
			<th><?php echo $this->Paginator->sort('Utilisateur.NOMLONG','Emetteur'); ?></th>
                        <th><?php echo $this->Paginator->sort('Action.destinataire_nom','Destinataire'); ?></th>
			<th><?php echo $this->Paginator->sort('OBJET','Objet'); ?></th>
			<th><?php echo $this->Paginator->sort('AVANCEMENT','% avancement'); ?></th>
			<th width='80px'><?php echo $this->Paginator->sort('ECHEANCE','Echéance'); ?></th>
			<th width='50px'><?php echo $this->Paginator->sort('STATUT','Statut'); ?></th>
                        <th width='50px'><?php echo $this->Paginator->sort('CRA','CRA'); ?></th>
			<th ><?php echo $this->Paginator->sort('DUREEPREVUE','Charge prévue'); ?></th>
			<th width="50px"><?php echo $this->Paginator->sort('PRIORITE','Priorité'); ?></th>
			<th class="actions" width='80px'><?php echo __('Actions'); ?></th>
	</tr>
        </thead>
        <tbody>
        <?php if (isset($actions)): ?>
	<?php foreach ($actions as $action): ?>
	<tr>
                <td style="white-space:nowrap !important;"><?php echo $actid='A-'.strYear($action['Action']['created']).'-'.$action['Action']['id']; ?></td>
                <td style="text-align:center;"><?php echo $this->Form->input('id',array('type'=>'checkbox','label'=>false,'class'=>'idselect nopadding','value'=>$action['Action']['id'])) ; ?></td>  
                <?php $tooltip = $action['Action']['NIVEAU'] != null ? 'Risque identifié de niveau '.$action['Action']['NIVEAU'].' / 5' : 'Aucun risque identifié' ; ?>
                <?php $tooltip .= "<br/>".$action['Action']['COMMENTRISK'] ; ?>
                <td style="background-color:<?php echo colorNiveauRisque($action['Action']['NIVEAU']) ?>"><span class="cursor" style="display:block;" rel='tooltip' data-title="<?php echo $tooltip; ?>">&nbsp;</span></td>
                <td><?php echo h($action['Domaine']['NOM']); ?>&nbsp;</td>
		<td><?php echo h($action['Utilisateur']['NOM']." ".$action['Utilisateur']['PRENOM']); ?>&nbsp;</td>
                <?php $contributeurs = isset($action['Action']['CONTRIBUTEURS']) ? $this->requestAction('utilisateurs/get_nom',array('pass'=>array($action['Action']['CONTRIBUTEURS']))) : 'Aucun contributeur'; ?>
                <?php $contributeurs = $contributeurs != 'Aucun contributeur' ? ';'.$contributeurs : ''; ?>
                <td><?php echo h($action['Action']['destinataire_nom'].$contributeurs); ?>&nbsp;</td>
                <!--<td data-pk="<?php echo $action['Action']['id']; ?>" data-field="OBJET" class="editable">-->
                <td><?php echo $this->Html->link($action['Action']['OBJET'],"#",array('class'=>'editable actobjet','id'=>"OBJET",'data-inputclass'=>"autowidth",'data-type'=>"text",'data-pk'=>$action['Action']['id'],'data-title'=>"Objet de l'action ".$actid,'data-url'=>$urlpost)); ?>
                    <?php // echo h($action['Action']['OBJET']); ?>
                    <?php if($action['Action']['NEW']==1): ?>
                    <span class="pull-right"><span class="glyphicons asterisk size8 orange" rel="tooltip" data-title="Nouvelle action en date du <?php echo h($action['Action']['created']); ?>"></span></span>&nbsp;
                    <?php endif; ?>                    
                </td>
                <?php $style = styleBarre(h($action['Action']['AVANCEMENT'])); ?>
		<td style="text-align:center;">
                    <div style="display:inline-table;min-width:90px;max-width:120px;">
                    <div class="progress-group margintop5">
                    <span class="glyphicons-progress circle_minus progress-bar-font reculer showoverlay"  idaction="<?php echo $action['Action']['id']; ?>" avancement="<?php echo isset($action['Action']['AVANCEMENT']) ? $action['Action']['AVANCEMENT'] : '0'; ?>"></span>
                    <div class="progress thin thin-col-82" style="min-width:50px;max-width:80px !important;">
                      <div class="progress-bar progress-bar-<?php echo $style; ?> thin" id="progress1"  rel="tooltip" title="Avancement à : <?php echo h($action['Action']['AVANCEMENT']); ?>%" data-value="<?php echo h($action['Action']['AVANCEMENT']); ?>" data-step="5" style="width: <?php echo h($action['Action']['AVANCEMENT']); ?>%;"><?php echo $action['Action']['AVANCEMENT'] > 0 ? $action['Action']['AVANCEMENT']."%" : ''; ?></div>
                    </div> 
                    <span class="glyphicons-progress circle_plus progress-bar-font avancer showoverlay" idaction="<?php echo $action['Action']['id']; ?>" avancement="<?php echo isset($action['Action']['AVANCEMENT']) ? $action['Action']['AVANCEMENT'] : '0'; ?>"></span>
                    </div>     
                    </div>
                </td>
                <?php $classtd = enretard($action['Action']['ECHEANCE'],$action['Action']['STATUT']) ? "class='td-error'" : ""; ?>
		<td <?php echo $classtd; ?> style="text-align:center;">
                    <?php echo $this->Html->link($action['Action']['ECHEANCE'],"#",array('class'=>'editable actecheance','id'=>"ECHEANCE",'data-type'=>"date",'data-pk'=>$action['Action']['id'],'data-title'=>"Echéance de l'action ".$actid,'data-url'=>$urlpost)); ?>
                    <?php // echo h($action['Action']['ECHEANCE']); ?></td>
		<td style="text-align:center;"><?php $image = isset($action['Action']['STATUT']) ? etatAction(h($action['Action']['STATUT'])) : 'blank' ; ?>
                    <a href="#" class="changeetat cursor showoverlay" idaction="<?php echo $action['Action']['id']; ?>" ><span class="glyphicons <?php echo $image; ?> notchange" rel="tooltip" data-title="<?php echo etatTooltip(h($action['Action']['STATUT'])); ?>"></span></a></td>
		<td style="text-align:center;"><?php $image = (isset($action['Action']['CRA']) && $action['Action']['CRA']==true) ? 'ok_2' : 'ok_2 disabled' ; ?>
                    <a href="#" class="incra cursor showoverlay" idaction="<?php echo $action['Action']['id']; ?>" ><span class="glyphicons <?php echo $image; ?> notchange" rel="tooltip" data-title="Visible dans le CRA ou non"></span></a></td>               
                <td style="text-align:center;">
                    <div style="display:inline-table;width:70px;">
                    <a href="#" class="moins cursor showoverlay" style="float:left;margin-left: 3px;margin-right:2px;" idaction="<?php echo $action['Action']['id']; ?>" duree="<?php echo $action['Action']['DUREEPREVUE']; ?>"><span class="glyphicons circle_minus notchange top3"></sapn></a>
                    <span rel="tooltip" data-title="<?php echo CHours2Days($action['Action']['DUREEPREVUE']); ?> jour(s)" style="float: left;width: 55%;"><?php echo h($action['Action']['DUREEPREVUE']); ?> h</span>
                    <a href="#" class="plus cursor showoverlay" style="float:left;" idaction="<?php echo $action['Action']['id']; ?>" duree="<?php echo $action['Action']['DUREEPREVUE']; ?>"><span class="glyphicons circle_plus notchange top3"></a>
                    </div>
                    </td>
		<td style="text-align:center;" class="<?php echo $action['Action']['PRIORITE']; ?>"><?php echo h($action['Action']['PRIORITE']); ?>&nbsp;</td>
		<td class="actions">
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'view')) : ?>
                    <?php echo '<span class="glyphicons eye_open cursor"></span>'; ?>&nbsp;
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'edit')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange" rel="tooltip" data-title="Modification"></span>', array('action' => 'edit', $action['Action']['id']),array('escape' => false,'class'=>'showoverlay')); ?>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'delete')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons bin notchange" rel="tooltip" data-title="Suppression"></span>', array('action' => 'delete', $action['Action']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette action ?')); ?>                    
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'duplicate')) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons showoverlay retweet notchange" rel="tooltip" data-title="Duplication"></span>', array('action' => 'dupliquer', $action['Action']['id']),array('escape' => false), __('Etes-vous certain de vouloir dupliquer cette action ? Cette action vous sera attribuée.')); ?>
                    <?php endif; ?>  
                    <?php echo $this->Html->link('<span class="glyphicons envelope showoverlay notchange" rel="tooltip" data-title="Notifier au destinataire"></span>', array('action' => 'notifier', $action['Action']['id']),array('escape' => false,'class'=>'showoverlay')); ?>
                </td>
	</tr>
        <tr class="trhidden" style="display:none;">
            <td colspan="15" align="center">
                <table cellpadding="0" cellspacing="0" class="table table-hidden" style="margin-bottom:-3px;">
                    <tr><th>Date de début</th><th>Commentaire</th><th>Bilan/Résultat</th><th>Modifié le</th></tr>
                    <tr><td><?php echo h($action['Action']['DEBUT']); ?>&nbsp;</td>
                        <td><?php //echo $this->Html->link($action['Action']['COMMENTAIRE'],"#",array('class'=>'editable actcommentaire','id'=>"COMMENTAIRE",'data-type'=>"textarea",'data-pk'=>$action['Action']['id'],'data-title'=>"Commentaire de l'action ".$actid,'data-url'=>$urlpost)); ?>
                            <?php echo $action['Action']['COMMENTAIRE']; ?></td>
                        <td><?php echo $action['Action']['BILAN']; ?></td><td><?php echo $action['Action']['modified']; ?></td></tr>
                </table>
            </td>
        </tr>  
        <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
	</table>
        </div>
	<div class="pull-left"><?php echo $this->Paginator->counter('Page {:page} sur {:pages}'); ?></div>
	<div class="pull-right"><?php echo $this->Paginator->counter('Nombre total d\'éléments : {:count}'); ?></div>     
        <div class='text-center'>
        <ul class="pagination pagination-sm">
	<?php
                echo "<li>".$this->Paginator->first('<<', true, null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
		echo "<li>".$this->Paginator->prev('<', array(), null, array('class' => 'prev disabled showoverlay','escape'=>false))."</li>";
		echo "<li>".$this->Paginator->numbers(array('separator' => '','class'=>'showoverlay'))."</li>";
		echo "<li>".$this->Paginator->next('>', array(), null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
                echo "<li>".$this->Paginator->last('>>', true, null, array('class' => 'disabled showoverlay','escape'=>false))."</li>";
	?>
        </ul>
        </div>
        <div id="content-timeline" >
        <?php if(count($actions) >0): ?>
        <br>
        <?php $events = $this->requestAction('actions/timelinedata'); ?>
        <?php $myTeam = $this->requestAction('equipes/allMyTeam/'.userAuth('id')); ?>
        <script type="text/javascript">
        $(document).ready(function(){
            var events = [
            <?php 
                foreach($events as $event):
                    $color = '#049CDB';
                    foreach($myTeam as $user):
                        if ($user['Equipe']['agent']==$event['id']):
                            $color = (isset($user['Equipe']['COLOR']) && $user['Equipe']['COLOR']!='') ? $user['Equipe']['COLOR'] :$color;
                        endif;
                    endforeach;
                    $start = $event['start'];
                    $end = $event['end'];
                    echo "{dates: [new Date(".$start."),new Date(".$end.")], descr:'test', title:\"".h($event['title'])."\", description:\"".$event['description']."\",attrs: {fill: '".$color."',stroke: '".$color."'},color:\"".substr($color,1)."\"},";
                endforeach;
            ?>
            ];
            var timeline = new Chronoline(document.getElementById("chronotime"), events,{animated: true,draggable: true,tooltips:true}); 
            $('#to-today').click(function(e){e.preventDefault(); timeline.goToToday();});
        });
        </script>
        <div id="chronotime" class="timeline-tgt"></div>
        <?php endif; ?>
        <div style="text-align:center;"><?php echo $this->Html->link('⇡ Aujourd\'hui ⇡',"",array('id'=>"to-today",'class'=>'btn btn-sm btn-default')); ?></div>        
        </div>
<script>
$(document).ready(function () {    
    $.fn.editable.defaults.mode = 'popup'; //popup ou inline
    $.fn.datepicker.dates['fr'] = {
        days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"],
        daysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"],
        daysMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa", "Di"],
        months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
        monthsShort: ["Jan", "Fév", "Mar", "Avr", "Mai", "Juin", "Juil", "Août", "Sep", "Oct", "Nov", "Déc"],
        today: "Aujourd'hui",
        clear: "Supprimer"
    };    
    
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var date = <?php echo isset($action['Action']['ECHEANCE']) ? $action['Action']['ECHEANCE'] : date('d/m/Y'); ?> ;

    $('.actobjet').editable();
    $('.actcommentaire').editable({
        mode: 'inline' //'inline'
    });
    $('.actecheance').editable({
        format: 'yyyy-mm-dd',    
        viewformat: 'dd/mm/yyyy',    
        datepicker: {
            date: date,
            weekStart: 1,
            todayBtn:'linked',
            
        },  
        placement: 'left',
        container:'body',
        title: 'Choisir une échéance',
        clear:false,
        //emptytext:'Aucune date renseignée',
        mode: 'popup' //'inline'
    });
    
    $("[rel=popover]").popover({placement:'auto',container:'#chronotime',trigger:'click',html:true});  
    
    var popoverOpened = null;
    $(function() { 
        $('[rel=popover]').popover({
            html: true,
            placement:'auto',
            trigger: 'click',
            container: "#chronotime"
        });
        $('[rel=popover]').unbind("click");
        $('[rel=popover]').bind("click", function(e) {
            e.stopPropagation();
            if($(this).equals(popoverOpened)) return;
            if(popoverOpened !== null) {
                popoverOpened.popover("hide");            
            }
            $(this).popover('show');
            popoverOpened = $(this);
            e.preventDefault();
        });

        $(document).click(function(e) {
            if(popoverOpened !== null) {
                popoverOpened.popover("hide");   
                popoverOpened = null;
            }        
        });
    });    


    
    $(document).on('click','.eye_open',function(e){
        $(this).parents('tr').next('.trhidden').fadeToggle();
    });
  
    $(document).on('click','.btn_eye_close',function(e){
        var overlay = $('#overlay');
        overlay.show();         
        $('.trhidden').toggle('slow', "easeOutBounce");
        $(this).toggleClass('filtreactif');     
        $('.eye_close').toggleClass('margintop4');    
        overlay.hide(); 
    });   
    
    $(document).on('click','.liselect',function(e){
        e.stopPropagation(); 
    });
    
    //TODO : faire une function pour mettre en surbrillance l'id dnas le champ caché
    $('.liselect').removeClass('subfilteractif');
    $('.selectresponsable').prop('checked',false);
    var ids = $("#allResponsablesSelected").val().split('-');
//    console.log(ids);
    $('.liselect').each(
                        function() {
                            if (inArray($(this).attr("data-id"),ids)){
                                $(this).addClass('subfilteractif');
                                $(this).find('.selectresponsable').prop('checked','checked');
                            }
                        }); 
    
    $(document).on('click','.btnfilterresponsablre',function(e){ 
        var ids = $("#allResponsablesSelected").val();
        var overlay = $('#overlay');
        <?php $action = $passaction == 'index' ? '/index' : $passaction; ?>
        var url = "<?php echo $this->Html->url(array('controller'=>'actions','action'=>$passaction),true); ?><?php echo $action; ?>/<?php echo $pass0; ?>/<?php echo $pass1; ?>/<?php echo $pass2; ?>/"+ids+"/<?php echo $keyword; ?>";
        $(this).parents('form').attr('action',url).submit();
    });
    
    $(document).on('click','.selectresponsable',function(e){
        var id = $(this).attr('data-id');
        var allselected = $("#allResponsablesSelected").val();
        if ($(this).is(':checked')){
            if (allselected==""){
                allselected = id;                    
            }else{
                allselected += "-"+id;
            }
        } else {
            $("#allResponsablesSelected").val("");
            tmp = allselected.replace(id+"-", "");
            if (tmp == allselected) tmp = allselected.replace("-"+id, ""); 
            allselected = tmp;
        }
        $("#allResponsablesSelected").val(allselected);
    });
    
    $(document).on('click','.avancer',function(e){
        var id = $(this).attr('idaction');
        var avancement = parseInt($(this).attr('avancement'))+10;
        var $bar = $(this).parent().find('.bar');
        if (avancement <= 100){
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'progressavancement')); ?>/",
                data: ({id:id,avancement:avancement})
            }).done(function ( data ) {
                location.reload();
            });
        }
    }); 
    
    $(document).on('click','.reculer',function(e){
        var id = $(this).attr('idaction');
        var avancement = parseInt($(this).attr('avancement'))-10;
        var $bar = $(this).parent().find('.bar'); 
        if (avancement >= 0){
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'progressavancement')); ?>/",
                data: ({id:id,avancement:avancement})
            }).done(function ( data ) {
                location.reload();
            });
        }
    }); 
    
    $(document).on('click','.changeetat',function(e){
        var id = $(this).attr('idaction');
        $.ajax({
            dataType: "html",
            type: "POST",
            url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'progressstatut')); ?>/",
            data: ({id:id})
        }).done(function ( data ) {
            location.reload();
        });
    }); 
    
    $(document).on('click','.incra',function(e){
        var id = $(this).attr('idaction');
        $.ajax({
            dataType: "html",
            type: "POST",
            url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'incra')); ?>/",
            data: ({all_ids:id})
        }).done(function ( data ) {
            location.reload();
        });
    });    
    
    $(document).on('click','.plus',function(e){
        var id = $(this).attr('idaction');
        var duree = parseInt($(this).attr('duree'))+2;
        var $bar = $(this).parent().find('.bar');
        $.ajax({
            dataType: "html",
            type: "POST",
            url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'progressduree')); ?>/",
            data: ({id:id,duree:duree})
        }).done(function ( data ) {
            location.reload();
        });
    }); 
    
    $(document).on('click','.moins',function(e){
        var id = $(this).attr('idaction');
        var duree = parseInt($(this).attr('duree'))-2;
        var $bar = $(this).parent().find('.bar');   
        if(duree >= 0){
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'progressduree')); ?>/",
                data: ({id:id,duree:duree})
            }).done(function ( data ) {
                location.reload();
            });
        }
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
        
        $(document).on('click','#deletelink',function(e){
            if(confirm("Voulez-vous supprimer toutes les actions sélectionnées ?")){
                var ids = $("#all_ids").val();
                var overlay = $('#overlay');
                overlay.show(); 
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'deleteall'),true); ?>",
                    data: {all_ids:ids},                        
                    dataType: "text"
                }).done(function() {
                    location.reload();
                }).fail(function(event,request,settings) {
                    console.log('DEL-ERROR');console.log(event);console.log(event.status);console.log(request);console.log(settings);console.log(ids);return true;
                }).always(function() {
                    $(this).parents().find(':checkbox').prop('checked', false); 
                    $("#all_ids").val('');                      
                    overlay.hide();
                }); 
            }                
        });    
        
        $(document).on('click','#closelink',function(e){
            if(confirm("Voulez-vous clore toutes les actions sélectionnées ?")){
                var ids = $("#all_ids").val();
                var overlay = $('#overlay');
                overlay.show(); 
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'closeall'),true); ?>",
                    data: {all_ids:ids},                        
                    dataType: "text"
                }).done(function() {
                    location.reload();
                }).fail(function(event,request,settings) {
                    console.log('CLOSE-ERROR');console.log(event);console.log(event.status);console.log(request);console.log(settings);return true;
                }).always(function() {
                    $(this).parents().find(':checkbox').prop('checked', false); 
                    $("#all_ids").val('');                      
                    overlay.hide();
                }); 
            }
        });  
        
        $(document).on('click','#cralink',function(e){
            if(confirm("Voulez-vous modifier ces actions en ce qui concerne leur apparition dans le CRA ?")){
                var ids = $("#all_ids").val();
                var overlay = $('#overlay');
                overlay.show(); 
                $.ajax({
                    type: "POST",
                    url: "<?php echo $this->Html->url(array('controller'=>'actions','action'=>'incra'),true); ?>",
                    data: {all_ids:ids},                        
                    dataType: "text"
                }).done(function() {
                    location.reload();
                }).fail(function(event,request,settings) {
                    console.log('CRA-ERROR');console.log(event);console.log(event.status);console.log(request);console.log(settings);return true;
                }).always(function() {
                    $(this).parents().find(':checkbox').prop('checked', false); 
                    $("#all_ids").val('');                      
                    overlay.hide();
                });               
            }            
        });  
        
        $(document).on('keyup','#ActionSEARCH',function (event){
            var url = "<?php echo $this->webroot;?>actions/search/<?php echo $pass0;?>/<?php echo $pass1;?>/<?php echo $pass2;?>/<?php echo $pass3;?>/";
            $(this).parents('form').attr('action',url+$(this).val());
        }); 
});
</script>