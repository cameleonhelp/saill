<nav class="navbar toolbar ">        
        <ul class="nav navbar-nav toolbar">
        <?php 
        $pass0 = isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous';
        if($this->params->action == "afacturer"):
            $pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous';
            $pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : date('m');
        else:
            $pass1 = isset($this->params->pass[1]) ? $this->params->pass[1] : userAuth('id');
            $pass2 = isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous';
        endif;
        $pass3 = isset($this->params->pass[3]) ? $this->params->pass[3] : date('Y'); 
        $pass4 = isset($this->params->pass[4]) ? $this->params->pass[4] : 0;
        $passaction = $this->params->action;
        if (count($this->params->data) > 0) :
            $keyword = $this->params->data['Activitesreelle']['SEARCH'];
        elseif (isset($this->params->pass[5]) && $this->params->pass[5] !=''):
            $keyword = $this->params->pass[5];
        elseif (isset($keywords) && $keyword != ''):
            $keyword = $keywords;
        else :
            $keyword = '';
        endif;    
        ?>                        
        <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'add') && strtolower($this->params->controller)=='activitesreelles') : ?>
        <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4" rel="tooltip" data-title="Ajoutez une nouvelle feuille de temps"></span>', '#',array('escape' => false,'class'=>'','data-toggle'=>"modal", 'data-target'=>"#newftModal")); ?></li>
        <li class="divider-vertical-only"></li>
        <?php endif; ?>
        <?php if ($pass0 == "tous") : ?>
        <li class="dropdown <?php echo filtre_is_actif($pass0,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtres ... <b class="caret"></b></a>
             <ul class="dropdown-menu">
                 <li class="dropdown-header uppercase">Etats</li>
                 <li><?php echo $this->Html->link('Tous', array('action' => $passaction,'tous',$pass1,$pass2,$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'tous'))); ?></li>
                 <li><?php echo $this->Html->link('Non facturé', array('action' => $passaction,'actif',$pass1,$pass2,$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'actif'))); ?></li>
                 <li><?php echo $this->Html->link('Facturé', array('action' => $passaction,'facture',$pass1,$pass2,$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass0,'facture'))); ?></li>
                 <li class="divider"></li>
                 <li class="dropdown-header uppercase">Indisponibilités</li>
                 <?php
                    $inverse_indisponible = $pass4 == 1 ? 0 : 1;
                    $img_indisponible = $pass4 == 1 ?  "unchecked bottom2" : "check bottom2";
                 ?>  
                 <li><?php echo $this->Html->link('<span class="glyphicons '.$img_indisponible.'"></span> Indisponibilité', array('action' => $passaction,$pass0,$pass1,$pass2,$pass3,$inverse_indisponible,$keyword),array('escape' => false,'class'=>'showoverlay')); ?></li>                    
             </ul>
        </li> 
        <?php else : ?>
        <li><?php echo $this->Html->link('Facturé', array('controller'=>'facturations','action' => 'index'),array('escape' => false,'class'=>'paddingtop3')); ?></li>
        <?php endif; ?>
        <?php if (areaIsVisible()) :?>
        <li class="dropdown <?php echo filtre_is_actif($pass1,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Utilisateurs <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => $passaction,$pass0,'tous',$pass2,$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,'tous'))); ?></li>
             <li><?php echo $this->Html->link('Moi', array('action' => $passaction,$pass0,  userAuth('id'),$pass2,$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,  userAuth('id')))); ?></li>
             <li class="divider"></li>
                 <?php foreach ($utilisateurs as $utilisateur): ?>
                    <li><?php echo $this->Html->link($utilisateur['Utilisateur']['NOMLONG'], array('action' => $passaction,$pass0,$utilisateur['Utilisateur']['id'],$pass2,$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass1,$utilisateur['Utilisateur']['id']))); ?></li>
                 <?php endforeach; ?>
              </ul>
        </li>   
        <?php endif; ?> 
        <li class="dropdown <?php echo filtre_is_actif($pass2,'tous'); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Mois <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Tous', array('action' => $passaction,$pass0,$pass1,'tous',$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'tous'))); ?></li>
             <li class="divider"></li>
             <li><?php echo $this->Html->link('Janvier', array('action' => $passaction,$pass0,$pass1,'01',$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'01'))); ?></li>
             <li><?php echo $this->Html->link('Février', array('action' => $passaction,$pass0,$pass1,'02',$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'02'))); ?></li>
             <li><?php echo $this->Html->link('Mars', array('action' => $passaction,$pass0,$pass1,'03',$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'03'))); ?></li>
             <li><?php echo $this->Html->link('Avril', array('action' => $passaction,$pass0,$pass1,'04',$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'04'))); ?></li>
             <li><?php echo $this->Html->link('Mai', array('action' => $passaction,$pass0,$pass1,'05',$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'05'))); ?></li>
             <li><?php echo $this->Html->link('Juin', array('action' => $passaction,$pass0,$pass1,'06',$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'06'))); ?></li>
             <li><?php echo $this->Html->link('Juillet', array('action' => $passaction,$pass0,$pass1,'07',$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'07'))); ?></li>
             <li><?php echo $this->Html->link('Août', array('action' => $passaction,$pass0,$pass1,'08',$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'08'))); ?></li>
             <li><?php echo $this->Html->link('Septembre', array('action' => $passaction,$pass0,$pass1,'09',$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'09'))); ?></li>
             <li><?php echo $this->Html->link('Octobre', array('action' => $passaction,$pass0,$pass1,'10',$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'10'))); ?></li>
             <li><?php echo $this->Html->link('Novembre', array('action' => $passaction,$pass0,$pass1,'11',$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'11'))); ?></li>
             <li><?php echo $this->Html->link('Décembre', array('action' => $passaction,$pass0,$pass1,'12',$pass3,$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif($pass2,'12'))); ?></li>                     
              </ul>
        </li> 
        <li class="dropdown <?php echo filtre_is_actif(isset($this->params->pass[3]) ? $this->params->pass[3] : date('Y'),date('Y')); ?>">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Année <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('En cours', array('action' => $passaction,$pass0,$pass1,$pass2,date('Y'),$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[3]) ? $this->params->pass[3] : date('Y'),date('Y')))); ?></li>
             <li class="divider"></li>
                 <?php if (isset($annees)): ?>
                 <?php foreach ($annees as $annee): ?>
                    <?php if ($annee[0]['ANNEE']!=0): ?>
                    <li><?php echo $this->Html->link($annee[0]['ANNEE'], array('action' => $passaction,$pass0,$pass1,$pass2,$annee[0]['ANNEE'],$pass4,$keyword),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[3]) ? $this->params->pass[3] : date('Y'),$annee[0]['ANNEE']))); ?></li>
                    <?php endif; ?>
                 <?php endforeach; ?>
                 <?php endif; ?>
              </ul>
        </li>                  
        <?php if ($this->params->action == "afacturer") : ?>
        <li class="divider-vertical-only"></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicons check"></span> Actions groupées <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <li><?php echo $this->Html->link('Facturer', "#",array('id'=>'facturerlink','class'=>'showoverlay')); ?></li>
             <li><?php echo $this->Html->link('Rejeter', "#",array('id'=>'rejeterlink','class'=>'showoverlay')); ?></li>
             <li><?php echo $this->Html->link('Rejeter avec mail', "#",array('id'=>'sendrejeterlink','class'=>'showoverlay')); ?></li>
             </ul>
        </li>
        <li class="divider-vertical-only"></li>
        <li><?php echo $this->Html->link('<span class="ico-xls" rel="tooltip"  data-container="body" data-title="Export Excel"></span>', array('action' => 'export_xls'),array('escape' => false)); ?></li>  
        <?php else: ?>
        <?php if(userAuth('societe_id')==1 && $this->params->action != "afacturer"): ?>
        <li class="divider-vertical-only"></li>
        <li><?php echo $this->Html->link('<span class="ico-ics" rel="tooltip" data-title="Importez le fichier ICS issu de l\'outil RH"></span>', '#',array('escape' => false,'id'=>'importics','data-toggle'=>"modal", 'data-target'=>"#icsModal")); ?></li>                 
        <?php endif; ?>
        <?php endif; ?>
        <?php if ($this->params->action != "afacturer") : ?>
        <li class="divider-vertical-only"></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicons check"></span> Actions groupées <b class="caret"></b></a>
             <ul class="dropdown-menu">
             <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'update')) : ?>
             <li><?php echo $this->Html->link('Soumettre', "#",array('id'=>'soumettrelink','class'=>'showoverlay')); ?></li>
             <li><?php echo $this->Html->link('Supprimer', "#",array('id'=>'deletelink','class'=>'')); ?></li>
             <?php endif; ?>
             <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'deleteall')) : ?>
             <li><?php echo $this->Html->link('Supprimer', "#",array('id'=>'deletelink'), __('Etes-vous certain de vouloir supprimer ces feuilles de temps ?')); ?></li>
             <?php endif; ?>
             </ul>
        </li>   
        <?php endif; ?>                
        </ul> 
    <?php if ($this->params->controller == "activitesreelles" && $this->params->action != "afacturer") : ?>
        <ul class="nav navbar-nav toolbar pull-right">
            <li><?php echo $this->Html->link('<span class="glyphicons blue circle_question_mark size14 margintop4"></span>', '#',array('escape' => false,'data-toggle'=>"modal",'data-target'=>"#modalhelp")); ?></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                    <li>
                        <?php echo $this->Form->create("Activitesreelle",array('url' => array('action' => 'search',$pass0,$pass1,$pass2,$pass3,$pass4),'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                            <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;margin-left:3px;margin-right:-3px;display: inline-table;",'class'=>"form-control",'value'=>$keyword, 'rel'=>"tooltip", 'data-container'=>"body", 'data-title'=>Configure::read('search_tooltip'))); ?>
                            <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                        <?php echo $this->Form->end(); ?>                         
                    </li>
                </ul>
            </li>
        </ul>                             
    <?php elseif ($this->params->controller == "facturations") : ?>
         <ul class="nav navbar-nav toolbar pull-right">
            <li><?php echo $this->Html->link('<span class="glyphicons blue circle_question_mark size14 margintop4"></span>', '#',array('escape' => false,'data-toggle'=>"modal",'data-target'=>"#modalhelp")); ?></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle btn-expand" data-toggle="dropdown"><span class="glyphicons expand notchange" style="width:13px;"></span></a>
                <ul class="dropdown-menu" style="left: -205px;min-width: 250px;max-width: 250px;">
                    <li>
                        <?php echo $this->Form->create("Facturation",array('url' => array('action' => 'search',$pass0,$pass1,$pass2,$pass3,$pass4), 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                            <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;margin-left:3px;margin-right:-3px;display: inline-table;",'class'=>"form-control",'value'=>$keyword, 'rel'=>"tooltip", 'data-container'=>"body", 'data-title'=>"Recherche multi-critère en séparant par un <u><b>espace</b></u> les différents mots")); ?>
                            <button type="submit" class="btn form-btn showoverlay"><span class="glyphicons notchange search"></span></button>
                        <?php echo $this->Form->end(); ?>                         
                    </li>
                </ul>
            </li>
        </ul>                                       
    <?php endif; ?>                    
</nav> 
<?php echo $this->element('modals/help',array('helpcontent' => $this->element('hlp/hlp-activites'))); ?>
<?php if ($this->params['action']!='afacturer') { ?><div class="panel-body panel-filter"><strong>Filtre appliqué : </strong><em>Liste de <?php echo $fetat; ?> de <?php echo $futilisateur; ?> <?php echo $fperiode; ?></em></div><?php } ?>        
<?php if ($this->params['action']=='afacturer') { ?><div class="panel-body panel-filter marginbottom15"><strong>Filtre appliqué : </strong><em>Liste de <?php echo $fetat; ?> de <?php echo $futilisateur; ?> <?php echo $fperiode; ?></em></div><?php } ?>                
<?php if ($this->params['action']!='afacturer') : ?>
<div class="bs-callout bs-callout-info ">
<h4><small>Information</small></h4>
    Vous devez saisir <strong style="color:#428bca;text-decoration:underline;">des semaines entières, même si la semaine est à cheval sur le mois suivant</strong>, vous devez la compléter.<br>
    Si nécessaire une mise à jour est toujours possible, il vous suffit de nous contacter via <?php echo $this->Html->link('ce formulaire', array('controller'=>'contacts','action'=>'add')) ?>, en indiquant le jour de début de la semaine (lundi, colonne Date).<br>
    Les jours grisés sont du mois précédent et suivant, ils ne sont donc pas comptabilisés dans le total du mois affiché.<br>
    <strong style="color:#428bca;text-decoration:underline;">Il n'est pas nécessaire de saisir de l'activité sur un jour férié, celle-ci est toutefois possible pour les astreintes, comme pour les week-end.</strong>
</div>  
<?php endif; ?>        
<?php if(userAuth('societe_id')==1): ?>
<!--insert ICS modal //-->
<div class="modal fade" id="icsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Importation de fichier ICS</h4>
      </div>
      <?php echo $this->Form->create('Fileshared',array('action'=>'parseICS','id'=>'formValidate','class'=>'form-horizontal', 'style'=>'margin-bottom:-7px !important;','type' => 'file','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
      <div class="modal-body">
          <div class="form-group">
                <label for="FilesharedFile" class="col-md-4 control-label">Fichiers ICS à intégrer</label>
                <div class="col-md-offset-4">
                  <?php echo $this->Form->input('file', array('type' => 'file','size'=>"40")); ?><label for="FilesharedFile" class="pull-left margintop7 italic"><?php echo 'taille max de '.ini_get('upload_max_filesize'); ?></label>
                </div>
          </div>
          <div class="form-group">
                <label for="FilesharedUtilisateurId" class="col-md-4 control-label">Pour</label>
                <div class="col-md-offset-4 col-md-6">
                  <?php echo $this->Form->select('utilisateur_id',$icsutilisateurs,array('class'=>'form-control','data-rule-required'=>'true','default'=>  userAuth('id'),'selected'=>  userAuth('id'),'data-msg-required'=>"Le nom de l'utilisateur est obligatoire dans l'onglet Destinataire", 'empty' => 'Choisir un utilisateur')); ?>
                </div>
          </div>                  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true">Annuler</button>
        <?php echo $this->Form->button('Intégrer', array('class' => 'btn btn-sm btn-primary pull-right showoverlay','type'=>'submit')); ?>
      </div>
      <?php echo $this->Form->end(); ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /insert ICS modal //-->        
<?php endif; ?>  
<!--insert Add newactivite modal //-->
<div class="modal fade" id="newftModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Ajouter une nouvelle feuille de temps</h4>
      </div>
      <?php echo $this->Form->create('Activitesreelle',array('action'=>'newactivite','id'=>'formValidate','class'=>'form-horizontal', 'style'=>'margin-bottom:-7px !important;','type' => 'file','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
      <div class="modal-body">
          <div class="form-group">
                <label for="ActivitesreelleUtilisateurId" class="col-md-4 required">Pour</label>
                <div class="col-md-6">
                    <?php if (userAuth('WIDEAREA')==1): ?>
                    <?php  echo $this->Form->select('utilisateur_id',$newftutilisateurs,array('data-rule-required'=>'true','class'=>'form-control','default'=>  userAuth('id'),'data-msg-required'=>"Le nom de l'utilisateur est obligatoire dans l'onglet Destinataire", 'empty' => 'Choisir un utilisateur')); ?>                    
                    <?php else : ?>
                    <?php echo userAuth('NOMLONG'); ?><?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>userAuth('id'))); ?>
                    <?php endif; ?>                        
                </div>
          </div>    
          <div class="form-group">
                <label class="col-md-4 required" for="ActivitesreelleDATE">Date début de semaine : </label>
                <div class="col-md-5">
                  <div class="input-group" style="margin-left: 0px;">
                  <?php $today = new dateTime(); ?>
                  <?php echo $this->Form->input('DATE',array('type'=>'text','placeholder'=>'ex.: '.$today->format('d/m/Y'),'data-rule-required'=>'true','value'=>$today->format('d/m/Y'),'class'=>"form-control dateall",'data-msg-required'=>"La date de début de période est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                  <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#ActivitesreelleDATE"><span class="glyphicons circle_remove grey"></span></span>
                  <span class="input-group-addon date-addon-calendar btn-addon" data-target="#ActivitesreelleDATE"><span class="glyphicons calendar"></span></span>
                  </div>
                </div>
          </div>                   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true">Annuler</button>
        <?php echo $this->Form->button('Continuer', array('class' => 'btn btn-sm btn-primary pull-right showoverlay','type'=>'submit')); ?>
      </div>
      <?php echo $this->Form->end(); ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /insert Add newactivite modal //-->         
<div class="">
<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" id="data">
<thead>
<tr><th colspan="14">
<div class="text-center">
    <?php if($this->params->action != 'afacturer' && $pass2!='tous'): ?>
    <div class="badge <?php echo $get_state['class']; ?> pull-left" style="margin-top:4px;"><?php echo $get_state['msg']; ?></div>
    <?php endif; ?>
    <?php if($pass2!= 'tous'): ?>
    <?php echo $this->Form->button('<span class="glyphicons left_arrow" data-container="body" rel="tooltip" data-title="Mois précédent"></span>', array('id'=>"previousMonth",'type'=>'button','class' => 'btn  btn-sm btn-default','style'=>'margin-right:75px;')); ?>
    <?php endif; ?>
    <?php echo $pass2!= 'tous' ? strMonth($pass2)." ".$pass3 : 'Tous les mois de '.$pass3; ?>
    <?php if($pass2!= 'tous'): ?>
    <?php echo $this->Form->button('<span class="glyphicons right_arrow" data-container="body" rel="tooltip" data-title="Mois suivant"></span>', array('id'=>"nextMonth",'type'=>'button','class' => 'btn btn-sm btn-default','style'=>'margin-left:75px;')); ?>
    <?php echo $this->Form->button('<span class="glyphicons clock" data-container="body" rel="tooltip" data-title="Mois courant"></span>', array('id'=>"today",'type'=>'button','class' => 'btn  btn-sm btn-default pull-right')); ?>      
    <?php endif; ?>
</div>
</th></tr>
<tr>
                <th><?php echo 'Agent'; ?></th>
                <th><?php echo 'Identifiant'; ?></th>
                <th><?php echo 'Date'; ?></th>
                <?php $margeright = $this->params->action=='afacturer' ? '0px':'5px'; ?>
                <th style="text-align:center;width:15px !important;vertical-align: middle;padding-left:5px;padding-right:<?php echo $margeright; ?>;"><?php echo $this->Form->input('checkall',array('type'=>'checkbox','label'=>false)) ; ?>
                        <?php echo $this->Form->input('all_ids',array('type'=>'hidden')) ; ?>
                </th>	
                <th><?php echo 'Activités'; ?></th>
                <th class="calday"><?php echo 'Lu.'; ?></th>
                <th class="calday"><?php echo 'Ma.'; ?></th>
                <th class="calday"><?php echo 'Me.'; ?></th>
                <th class="calday"><?php echo 'Je.'; ?></th>
                <th class="calday"><?php echo 'Ve.'; ?></th>
                <th class="calday"><?php echo 'Sa.'; ?></th>
                <th class="calday"><?php echo 'Di.'; ?></th>
                <th><?php echo 'Total'; ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>   
<?php if (count($activitesreelles)>0): ?>
<?php $r = 0; ?>
<?php foreach ($groups as $group) : ?>
<?php $row = $groups[$r][0]['NBACTIVITE']; ?>
<?php if($row > 1 && count($activitesreelles)>1): ?>
    <?php $firstid = $group['Activitesreelle']['id'] ; ?>
    <tr>
        <td class="header" rowspan="<?php echo $row; ?>" style="vertical-align: middle;"><?php echo $group['Utilisateur']['NOM']." ".$group['Utilisateur']['PRENOM']; ?></td>
        <td class="header" rowspan="<?php echo $row; ?>" style="vertical-align: middle;"><?php echo $group['Utilisateur']['username']; ?></td>
        <td class="header" rowspan="<?php echo $row; ?>" style="vertical-align: middle;text-align: center;"><?php echo $group['Activitesreelle']['DATE']; ?></td>   
<?php endif; ?>
<?php if (isset($activitesreelles)): ?>
<?php foreach ($activitesreelles as $activitesreelle): ?>
    <?php if($activitesreelle['Activitesreelle']['utilisateur_id']==$group['Activitesreelle']['utilisateur_id'] && dateIsEqual($group['Activitesreelle']['DATE'], $activitesreelle['Activitesreelle']['DATE'])): ?>
        <?php if ($row==1): ?>
        <?php $firstid = $group['Activitesreelle']['id'] ; ?>
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
        <?php $nbdisable = 0; ?>
        <!--calculer les jours fériés pour mettre le style week sur les jours fériés //-->
        <?php $date = new DateTime(CUSDate($group['Activitesreelle']['DATE'])); ?>
        <?php $thismonth = isset($this->params->pass[2]) ? $this->params->pass[2] : date('m'); ?>
        <?php $disabled = $thismonth!= 'tous' && dateInMonth($date->format('d/m/Y'),$thismonth) ? 'disable-date' : ''; ?>
        <?php $classLu = isFerie($date) ? 'class="ferie '.$disabled.'"' : 'class="'.$disabled.'"'; ?>
        <td style="text-align: center;" <?php echo $classLu; ?>><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['LU']>0 && $activitesreelle['Activitesreelle']['LU']<1) ? $activitesreelle['Activitesreelle']['LU_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['LU']!=0 ? $activitesreelle['Activitesreelle']['LU'] : ""; ?></span></td> 
        <?php $nbdisable = $disabled != '' && $activitesreelle['Activitesreelle']['LU'] > 0 ? $activitesreelle['Activitesreelle']['LU'] : 0; ?>
        <?php $date->add(new DateInterval('P1D')); ?>
        <?php $disabled = $thismonth!= 'tous' && dateInMonth($date->format('d/m/Y'),$thismonth) ? 'disable-date' : ''; ?>
        <?php $classMA = isFerie($date) ? 'class="ferie '.$disabled.'"' : 'class="'.$disabled.'"'; ?>                
        <td style="text-align: center;" <?php echo $classMA; ?>><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['MA']>0 && $activitesreelle['Activitesreelle']['MA']<1) ? $activitesreelle['Activitesreelle']['MA_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['MA']!=0 ? $activitesreelle['Activitesreelle']['MA'] : ""; ?></span></td> 
        <?php $nbdisable = $disabled != '' && $activitesreelle['Activitesreelle']['MA'] > 0 ? $activitesreelle['Activitesreelle']['MA']+$nbdisable : $nbdisable; ?>
        <?php $date->add(new DateInterval('P1D')); ?>
        <?php $disabled = $thismonth!= 'tous' && dateInMonth($date->format('d/m/Y'),$thismonth) ? 'disable-date' : ''; ?>
        <?php $classME = isFerie($date) ? 'class="ferie '.$disabled.'"' : 'class="'.$disabled.'"'; ?>                
        <td style="text-align: center;" <?php echo $classME; ?>><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['ME']>0 && $activitesreelle['Activitesreelle']['ME']<1) ? $activitesreelle['Activitesreelle']['ME_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['ME']!=0 ? $activitesreelle['Activitesreelle']['ME'] : ""; ?></span></td> 
        <?php $nbdisable = $disabled != '' && $activitesreelle['Activitesreelle']['ME'] > 0 ? $activitesreelle['Activitesreelle']['ME']+$nbdisable : $nbdisable; ?>
        <?php $date->add(new DateInterval('P1D')); ?>
        <?php $disabled = $thismonth!= 'tous' && dateInMonth($date->format('d/m/Y'),$thismonth) ? 'disable-date' : ''; ?>
        <?php $classJE = isFerie($date) ? 'class="ferie '.$disabled.'"' : 'class="'.$disabled.'"'; ?>                
        <td style="text-align: center;" <?php echo $classJE; ?>><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['JE']>0 && $activitesreelle['Activitesreelle']['JE']<1) ? $activitesreelle['Activitesreelle']['JE_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['JE']!=0 ? $activitesreelle['Activitesreelle']['JE'] : ""; ?></span></td> 
        <?php $nbdisable = $disabled != '' && $activitesreelle['Activitesreelle']['JE'] > 0 ? $activitesreelle['Activitesreelle']['JE']+$nbdisable : $nbdisable; ?>
        <?php $date->add(new DateInterval('P1D')); ?>
        <?php $disabled = $thismonth!= 'tous' && dateInMonth($date->format('d/m/Y'),$thismonth) ? 'disable-date' : ''; ?>
        <?php $classVE = isFerie($date) ? 'class="ferie '.$disabled.'"' : 'class="'.$disabled.'"'; ?>                
        <td style="text-align: center;" <?php echo $classVE; ?>><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['VE']>0 && $activitesreelle['Activitesreelle']['VE']<1) ? $activitesreelle['Activitesreelle']['VE_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['VE']!=0 ? $activitesreelle['Activitesreelle']['VE'] : ""; ?></span></td> 
        <?php $nbdisable = $disabled != '' && $activitesreelle['Activitesreelle']['VE'] > 0 ? $activitesreelle['Activitesreelle']['VE']+$nbdisable : $nbdisable; ?>
        <?php $date->add(new DateInterval('P1D')); ?>
        <?php $disabled = $thismonth!= 'tous' && dateInMonth($date->format('d/m/Y'),$thismonth) ? 'disable-date' : ''; ?>
        <?php $classSA = isFerie($date) ? ' ferie '.$disabled: ' '.$disabled; ?> 
        <td style="text-align: center;" class="week <?php echo $classSA; ?>"><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['SA']>0 && $activitesreelle['Activitesreelle']['SA']<1) ? $activitesreelle['Activitesreelle']['SA_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['SA']!=0 ? $activitesreelle['Activitesreelle']['SA'] : ""; ?></span></td> 
        <?php $nbdisable = $disabled != '' && $activitesreelle['Activitesreelle']['SA'] > 0 ? $activitesreelle['Activitesreelle']['SA']+$nbdisable : $nbdisable; ?>
        <?php $date->add(new DateInterval('P1D')); ?>
        <?php $disabled = $thismonth!= 'tous' && dateInMonth($date->format('d/m/Y'),$thismonth) ? 'disable-date' : ''; ?>
        <?php $classDI = isFerie($date) ? ' ferie '.$disabled: ' '.$disabled; ?>
        <td style="text-align: center;" class="week <?php echo $classDI; ?>"><span <?php echo ($activitesreelle['Activite']['projet_id']==1 && $activitesreelle['Activitesreelle']['DI']>0 && $activitesreelle['Activitesreelle']['DI']<1) ? $activitesreelle['Activitesreelle']['DI_TYPE']==1 ? "rel='tooltip' data-title='Matin'" : "rel='tooltip' data-title='Après-midi'" : ""; ?>><?php echo $activitesreelle['Activitesreelle']['DI']!=0 ? $activitesreelle['Activitesreelle']['DI'] : ""; ?></span></td> 
        <?php $nbdisable = $disabled != '' && $activitesreelle['Activitesreelle']['DI'] > 0 ? $activitesreelle['Activitesreelle']['DI']+$nbdisable : $nbdisable; ?>
        <td style="text-align: center;" class="sstotal"><?php echo number_format((number_format(str_replace(',','.',$activitesreelle['Activitesreelle']['TOTAL']),1)-number_format($nbdisable,1)),1); ?></td> 
        <td style="text-align: center;">
        <?php if ($this->params->action != "afacturer") : ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'view')) : ?>
            <?php echo isset($activitesreelle['Activitesreelle']['action_id']) ? '<span><span rel="tooltip" data-title="Cliquez pour avoir un aperçu"><span class="glyphicons eye_open" data-rel="popover" data-title="<h3>Action :</h3>" data-content="<contenttitle>Objet: </contenttitle>'.h($activitesreelle['Action']['OBJET']).'<br/><contenttitle>Avancement: </contenttitle>'.h($activitesreelle['Action']['AVANCEMENT']).'%<br/><contenttitle>Crée le: </contenttitle>'.h($activitesreelle['Action']['created']).'<br/><contenttitle>Modifié le: </contenttitle>'.h($activitesreelle['Action']['modified']).'" data-trigger="click" style="cursor: pointer;"></span></span></span>' : "<span class='glyphicons blank'></span></span></span>"; ?>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'edit') && $activitesreelle['Activitesreelle']['VEROUILLE'] == 1 ) : ?>
            <?php $firstid = isset($firstid) ? $firstid : $activitesreelle['Activitesreelle']['id'] ; ?>
            <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange" rel="tooltip" data-title="Modification"></span>', array('action' => 'edit', $firstid),array('escape' => false,'class'=>'showoverlay')); ?>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'delete') && $activitesreelle['Activitesreelle']['VEROUILLE'] == 1) : ?>
            <?php echo $this->Form->postLink('<span class="glyphicons bin notchange" rel="tooltip" data-title="Suppression"></span>', array('action' => 'delete', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette feuille de temps ?')); ?>                    
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'update')) : ?>
            <?php $img = $activitesreelle['Activitesreelle']['VEROUILLE']==0 ? 'thumbs_up' : 'thumbs_down'; ?>
            <?php echo $this->Form->postLink('<span class="glyphicons showoverlay '.$img.' notchange" rel="tooltip" data-title="A soumettre pour facturation<br>si pouce en bas<br>Soumis pour facturation<br>si pouce en haut"></span>', array('action' => 'updatefacturation', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir mettre à jour cette feuille de temps pour facturation ?')); ?>                    
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'duplicate')) : ?>
            <?php //TODO : mettre l'appel à une modale //array('action' => 'autoduplicate', $activitesreelle['Activitesreelle']['id'])?>
            <?php echo $this->Html->link('<span class="glyphicons retweet notchange" rel="tooltip" data-title="Duplication"></span>', "#",array('escape' => false,'data-activitesreelleid'=>$activitesreelle['Activitesreelle']['id'],'data-date'=> CUSDate($activitesreelle['Activitesreelle']['DATE']),'data-toggle'=>"modal",'data-target'=>"#modalduplicate",'id'=>'duplicatelnk')); ?>                    
            <?php endif; ?>
        <?php else : ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'edit')) : ?>
            <?php echo $this->Html->link('<span class="glyphicons ok showoverlay notchange" rel="tooltip" data-title="Facturation"></span>', array('controller' => 'facturations','action' => 'add', $activitesreelle['Activitesreelle']['utilisateur_id'], $activitesreelle['Activitesreelle']['id']),array('escape' => false,'class'=>'showoverlay')); ?>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'update')) : ?>
            <?php $img = 'ban'; ?>
            <?php echo $this->Form->postLink('<span class="glyphicons '.$img.' notchange" rel="tooltip" data-title="Annulation (rejet)"></span>', array('action' => 'errorfacturation', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir mettre à jour cette feuille de temps pour correction ?')); ?>                    
            <?php echo $this->Form->postLink('<span class="glyphicons message_ban notchange" rel="tooltip" data-title="Annulation (rejet) avec envois de mail"></span>', array('action' => 'senddeverouiller', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir mettre à jour cette feuille de temps pour correction ?')); ?>                                     
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
<tfoot>
<tr>
    <?php $nbrows = $this->params->action == "afacturer" ? 12 : 12; ?>
    <td colspan="<?php echo $nbrows; ?>" class="footer admonition" style="text-align:right;">
        <?php if($this->params->action == "afacturer"): ?>
        <?php $memo = $this->requestAction('entites/get_memo/'.userAuth('entite_id')) ?>
        <?php $icon = isset($memo) && $memo!="" ? 'bell' : 'pencil';?>
        <div class="ribbon">
            <a href="#" role="button" data-toggle="modal" data-target="#infoModal">
            <div class="ribbon-content ribbon-td"><span class="glyphicons <?php echo $icon; ?> white"></span></div>
            <div class="ribbon-right"></div>
            </a>
        </div>
       <?php  endif; ?>
        Total :</td>
    <td class="footer" id="totalactivites" style="text-align:right;"></td>
    <td class="footer" style="text-align:left;">jours</td>
</tr>            
</tfoot>
</table> 
</div>
<!--info alert modal //-->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Enregistrement du mémo</h4>
      </div>
      <div class="modal-body">
        <form id="Parameter" method="POST" data-async data-target="#myModal1">
        <input type="hidden" name="InfroText" value="1">
        <table>
            <tbody>
                <tr><td>
                   <textarea style='width:530px;' id="memo"><?php echo isset($memo) && $memo!='' ? $memo : ''; ?></textarea>
                   </td></tr>
            </tbody>
        </table>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Annuler</button>
        <button type="button" class="btn btn-primary" id="InfroTextSubmit">Sauvegarder</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /info alert modal //-->
<div style="margin-bottom:30px;"></div>
<?php echo $this->element('modals/date'); ?>
<script>
    function sumOfColumns() {
        var tot = 0;
        $(".sstotal").each(function() {
          tot += parseFloat($(this).html());
        });
        return tot.toFixed(2);
     }
          
     $(document).ready(function () {
//        $("table").tablesorter({
//            headers: {
//                2: {sorter: 'fr-date'},
//                3: {sorter:false},
//                5: {sorter:false},
//                6: {sorter:false},
//                7: {sorter:false},
//                8: {sorter:false},
//                9: {sorter:false},
//                10: {sorter:false},
//                11: {sorter:false},
//                12: {sorter:false},
//                13: {sorter:false},
//            },
//            widthFixed : true,
//            widgets: ["zebra"],
//            widgetOptions : {           
//                zebra : [ "normal-row", "alt-row" ]
//            }
//        });          
         
         $("#totalactivites").html(sumOfColumns());
         $('#icsparser').hide();
         
         $("#previousMonth").on('click', function(e){
             e.preventDefault();
             var overlay = $('#overlay');
             overlay.show();               
             var m = <?php echo $pass2==1 ? 12 : $pass2-1; ?>;
             var a = <?php echo $pass2==1 ? $pass3-1 : $pass3; ?>;
             m = m < 10 ? "0"+m : m;
             var url = "<?php echo $this->webroot;?><?php echo $this->params->controller;?>/<?php echo $this->params->action;?>/<?php echo $pass0;?>/<?php echo $pass1;?>/"+m+"/"+a+"/<?php echo $pass4;?>/";
             location.href = url;
         });
         $("#nextMonth").on('click', function(e){
             e.preventDefault();
             var overlay = $('#overlay');
             overlay.show();                 
             var m = <?php echo $pass2==12 ? 1 : $pass2+1; ?>;
             var a = <?php echo $pass2==12 ? $pass3+1 : $pass3; ?>;
             m = m < 10 ? "0"+m : m;
             var url = "<?php echo $this->webroot;?><?php echo $this->params->controller;?>/<?php echo $this->params->action;?>/<?php echo $pass0;?>/<?php echo $pass1;?>/"+m+"/"+a+"/<?php echo $pass4;?>/";
             location.href = url;
         }); 
         $("#today").on('click', function(e){
             e.preventDefault();
             var overlay = $('#overlay');
             overlay.show();                
             var m = <?php echo date("m"); ?>;
             var a = <?php echo date("Y"); ?>;
             m = m < 10 ? "0"+m : m;
             var url = "<?php echo $this->webroot;?><?php echo $this->params->controller;?>/<?php echo $this->params->action;?>/<?php echo $pass0;?>/<?php echo $pass1;?>/"+m+"/"+a+"/<?php echo $pass4;?>/";
             location.href = url;
         });  
         
         $(document).on('propertychange keyup input paste focus', 'input.data_field', function(){
            var io = $(this).val().length ? 1 : 0 ;
            $(this).next('.icon_clear').stop().fadeTo(300,io);
         }).on('click', '.icon_clear', function() {
            $(this).delay(300).fadeTo(300,0).prev('input').val('');
         });

         $(document).on('click','#InfroTextSubmit',function(e){
            //e.preventDefault();
            var memo = tinymce.get('memo').getContent(); //$(this).parents().find('#memo').html();
            var id = "<?php echo userAuth('entite_id'); ?>";
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'entites','action'=>'set_memo')); ?>/",
                data: ({id:id,memo:memo})
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
        
        $(document).on('click','#sendrejeterlink',function(e){
            var ids = $("#all_ids").val();
            var overlay = $('#overlay');
            overlay.show();             
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo $this->Html->url(array('controller'=>'activitesreelles','action'=>'sendrejeter')); ?>/",
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
            if(confirm("Voulez-vous supprimer les saisies d'activité sélectionnées ?")){
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
            }
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
        
        $(document).on('keyup','#ActivitesreelleSEARCH',function (event){
            var url = "<?php echo $this->webroot;?>activitesreelles/search/<?php echo $pass0;?>/<?php echo $pass1;?>/<?php echo $pass2;?>/<?php echo $pass3;?>/<?php echo $pass4;?>/";
            $(this).parents('form').attr('action',url+$(this).val());
        });
        
        $(document).on('keyup','#FacturationSEARCH',function (event){
            var url = "<?php echo $this->webroot;?>facturations/search/<?php echo $pass0;?>/<?php echo $pass1;?>/<?php echo $pass2;?>/<?php echo $pass3;?>/<?php echo $pass4;?>/";
            $(this).parents('form').attr('action',url+$(this).val());
        });  
        
        $(document).on('click','#duplicatelnk',function(e){
            var days = 7;
            var date = new Date($(this).attr('data-date'));
            var res = date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            date = new Date(res);
            var day = date.getDate() < 10 ? "0"+date.getDate() : date.getDate();
            var month = (date.getMonth()+1) <10 ? "0"+(date.getMonth()+1) : (date.getMonth()+1);
            var cfrdate = day +'/'+ month +'/'+date.getFullYear();
            $('#modalduplicate #ActivitesreelleDATE').val(cfrdate);
        });        
    });
</script>