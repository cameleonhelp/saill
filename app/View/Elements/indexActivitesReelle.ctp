<div class="activitesreelles index" id="ToRefresh">
        <nav class="navbar toolbar marginright20">
                <ul class="nav navbar-nav toolbar">
                <?php $defaultEtat = $this->params->action == "afacturer" ? 'facture' : 'tous'; ?>
                <?php $defaultAction = $this->params->action == "search" ? 'index' : $this->params->action; 
                      $filtre_annee = isset($this->params->pass[3]) ? $this->params->pass[3] : date('Y'); 
                      $filtre_indisponible = isset($this->params->pass[4]) ? $this->params->pass[4] : 0;
                ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'add') && strtolower($this->params->controller)=='activitesreelles') : ?>
                <li><?php echo $this->Html->link('<span class="glyphicons plus size14 margintop4" rel="tooltip" data-title="Ajoutez une nouvelle feuille de temps"></span>', '#',array('escape' => false,'class'=>'','data-toggle'=>"modal", 'data-target'=>"#newftModal")); ?></li>
                <li class="divider-vertical-only"></li>
                <?php endif; ?>
                <?php if ($defaultEtat == "tous") : ?>
                <li class="dropdown <?php echo filtre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtres ... <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li class="dropdown-header uppercase">Etats</li>
                         <li><?php echo $this->Html->link('Tous', array('action' => $defaultAction,'tous',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','tous'))); ?></li>
                         <li><?php echo $this->Html->link('Non facturé', array('action' => $defaultAction,'actif',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','actif'))); ?></li>
                         <li><?php echo $this->Html->link('Facturé', array('action' => $defaultAction,'facture',isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[0]) ? $this->params->pass[0] : 'tous','facture'))); ?></li>
                         <li class="divider"></li>
                         <li class="dropdown-header uppercase">Indisponibilités</li>
                         <?php
                            $inverse_indisponible = $filtre_indisponible == 0 ? 1 : 0;
                            $img_indisponible = $filtre_indisponible == 1 ?  "unchecked bottom2" : "check bottom2";
                         ?>  
                         <li><?php echo $this->Html->link('<span class="glyphicons '.$img_indisponible.'"></span> Indisponibilité', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',$filtre_annee,$inverse_indisponible),array('escape' => false,'class'=>'showoverlay')); ?></li>                    
                     </ul>
                </li> 
                <?php else : ?>
                <li><?php echo $this->Html->link('Facturé', array('controller'=>'facturations','action' => 'index'),array('escape' => false,'class'=>'paddingtop3')); ?></li>
                <?php endif; ?>
                <?php if (areaIsVisible()) :?>
                <li class="dropdown <?php echo filtre_is_actif(isset($this->params->pass[1]) ? $this->params->pass[1] : userAuth('id'),'tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Utilisateurs <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[1]) ? $this->params->pass[1] : userAuth('id'),'tous'))); ?></li>
                     <li><?php echo $this->Html->link('Moi', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,  userAuth('id'),isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[1]) ? $this->params->pass[1] : userAuth('id'),  userAuth('id')))); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($utilisateurs as $utilisateur): ?>
                            <li><?php echo $this->Html->link($utilisateur['Utilisateur']['NOMLONG'], array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,$utilisateur['Utilisateur']['id'],isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[1]) ? $this->params->pass[1] : userAuth('id'),$utilisateur['Utilisateur']['id']))); ?></li>
                         <?php endforeach; ?>
                      </ul>
                </li>   
                <?php endif; ?> 
                <li class="dropdown <?php echo filtre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous','tous'); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Mois <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('Tous', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','tous',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous','tous'))); ?></li>
                     <li class="divider"></li>
                     <li><?php echo $this->Html->link('Janvier', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','01',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous','01'))); ?></li>
                     <li><?php echo $this->Html->link('Février', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','02',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous','02'))); ?></li>
                     <li><?php echo $this->Html->link('Mars', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','03',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous','03'))); ?></li>
                     <li><?php echo $this->Html->link('Avril', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','04',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous','04'))); ?></li>
                     <li><?php echo $this->Html->link('Mai', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','05',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous','05'))); ?></li>
                     <li><?php echo $this->Html->link('Juin', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','06',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous','06'))); ?></li>
                     <li><?php echo $this->Html->link('Juillet', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','07',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous','07'))); ?></li>
                     <li><?php echo $this->Html->link('Août', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','08',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous','08'))); ?></li>
                     <li><?php echo $this->Html->link('Septembre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','09',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous','09'))); ?></li>
                     <li><?php echo $this->Html->link('Octobre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','10',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous','10'))); ?></li>
                     <li><?php echo $this->Html->link('Novembre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','11',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous','11'))); ?></li>
                     <li><?php echo $this->Html->link('Décembre', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous','12',$filtre_annee,$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous','12'))); ?></li>                     
                      </ul>
                </li> 
                <li class="dropdown <?php echo filtre_is_actif(isset($this->params->pass[3]) ? $this->params->pass[3] : date('Y'),date('Y')); ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtre Année <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('En cours', array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',date('Y'),$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[3]) ? $this->params->pass[3] : date('Y'),date('Y')))); ?></li>
                     <li class="divider"></li>
                         <?php foreach ($annees as $annee): ?>
                            <?php if ($annee[0]['ANNEE']!=0): ?>
                            <li><?php echo $this->Html->link($annee[0]['ANNEE'], array('action' => $defaultAction,isset($this->params->pass[0]) ? $this->params->pass[0] : $defaultEtat,isset($this->params->pass[1]) ? $this->params->pass[1] : 'tous',isset($this->params->pass[2]) ? $this->params->pass[2] : 'tous',$annee[0]['ANNEE'],$filtre_indisponible),array('class'=>'showoverlay'.subfiltre_is_actif(isset($this->params->pass[3]) ? $this->params->pass[3] : date('Y'),$annee[0]['ANNEE']))); ?></li>
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
                     <?php endif; ?>
                     <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'deleteall')) : ?>
                     <li><?php echo $this->Html->link('Supprimer', "#",array('id'=>'deletelink'), __('Etes-vous certain de vouloir supprimer ces feuilles de temps ?')); ?></li>
                     <?php endif; ?>
                     </ul>
                </li>   
                <?php endif; ?>                
                </ul> 
                <?php if ($this->params->controller == "activitesreelles" && ($this->params->action == "index" || $this->params->action == "search")) : ?>
                <?php echo $this->Form->create("Activitesreelle",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 200px;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?>                   
                <?php elseif ($this->params->controller == "facturations") : ?>
                <?php echo $this->Form->create("Facturation",array('action' => 'search', 'class'=>'toolbar-form pull-right','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
                    <?php echo $this->Form->input('SEARCH',array('placeholder'=>'Recherche ...','style'=>"width: 160px !important;",'class'=>"form-control")); ?>
                    <button type="submit" class="btn form-btn showoverlay">Rechercher</button>
                <?php echo $this->Form->end(); ?>                                         
                <?php endif; ?> 
                <ul class="nav navbar-nav toolbar pull-right">
                    <li><?php echo $this->Html->link('<span class="glyphicons blue circle_question_mark size14 margintop4"></span>', '#',array('escape' => false,'class'=>'showoverlay','data-rel'=>"popover",'data-title'=>"Aide", 'data-placement'=>"bottom", 'data-content'=>$this->element('hlp/hlp-activites'))); ?></li>
                </ul>                    
            </nav> 
        <?php if ($this->params['action']=='index') { ?><div class="panel-body panel-filter marginbottom15 marginright20"><strong>Filtre appliqué : </strong><em>Liste de <?php echo $fetat; ?> de <?php echo $futilisateur; ?> <?php echo $fperiode; ?></em></div><?php } ?>        
        <?php if ($this->params['action']=='afacturer') { ?><div class="panel-body panel-filter marginbottom15 marginright20"><strong>Filtre appliqué : </strong><em>Liste de <?php echo $fetat; ?> de <?php echo $futilisateur; ?> <?php echo $fperiode; ?></em></div><?php } ?>                
        <?php if ($this->params['action']=='index') : ?>
        <div class="bs-callout bs-callout-info marginright20">
        <h4><small>Information</small></h4>
            Vous devez saisir <strong style="color:#428bca;text-decoration:underline;">des semaines entières, même si la semaine est à cheval sur le mois suivant</strong>, vous devez la compléter.<br>
            Si nécessaire une mise à jour est toujours possible, il vous suffit de nous contacter via <?php echo $this->Html->link('ce formulaire', array('controller'=>'contacts','action'=>'add')) ?>, en indiquant le jour de début de la semaine (lundi, colonne Date).<br>
            Les jours grisés sont du mois précédent et suivant, ils ne sont donc pas comptabilisés dans le total du mois affiché.
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
                        <label for="FilesharedFile" class="col-lg-4 control-label">Fichiers ICS à intégrer</label>
                        <div class="col-lg-offset-4">
                          <?php echo $this->Form->input('file', array('type' => 'file','size'=>"40")); ?><label for="FilesharedFile" class="pull-left margintop7 italic"><?php echo 'taille max de '.ini_get('upload_max_filesize'); ?></label>
                        </div>
                  </div>
                  <div class="form-group">
                        <label for="FilesharedUtilisateurId" class="col-lg-4 control-label">Pour</label>
                        <div class="col-lg-offset-4 col-lg-6">
                          <?php echo $this->Form->select('utilisateur_id',$icsutilisateurs,array('class'=>'form-control','data-rule-required'=>'true','default'=>  userAuth('id'),'data-msg-required'=>"Le nom de l'utilisateur est obligatoire dans l'onglet Destinataire", 'empty' => 'Choisir un utilisateur')); ?>
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
                        <label for="ActivitesreelleUtilisateurId" class="col-lg-4 required">Pour</label>
                        <div class="col-lg-6">
                            <?php if (userAuth('WIDEAREA')==1): ?>
                            <?php  echo $this->Form->select('utilisateur_id',$newftutilisateurs,array('data-rule-required'=>'true','class'=>'form-control','default'=>  userAuth('id'),'data-msg-required'=>"Le nom de l'utilisateur est obligatoire dans l'onglet Destinataire", 'empty' => 'Choisir un utilisateur')); ?>                    
                            <?php else : ?>
                            <?php echo userAuth('NOMLONG'); ?><?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>userAuth('id'))); ?>
                            <?php endif; ?>                        
                        </div>
                  </div>    
                  <div class="form-group">
                        <label class="col-lg-4 required" for="ActivitesreelleDATE">Date début de semaine : </label>
                        <div class="col-lg-5">
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
        <div class="marginright10">
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
                    <?php echo $this->Html->link('<span class="glyphicons pencil showoverlay notchange" rel="tooltip" data-title="Modification"></span>', array('action' => 'edit', $activitesreelle['Activitesreelle']['id']),array('escape' => false,'class'=>'showoverlay')); ?>
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'delete') && $activitesreelle['Activitesreelle']['VEROUILLE'] == 1) : ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons bin notchange" rel="tooltip" data-title="Suppression"></span>', array('action' => 'delete', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir supprimer cette feuille de temps ?')); ?>                    
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'update')) : ?>
                    <?php $img = $activitesreelle['Activitesreelle']['VEROUILLE']==0 ? 'thumbs_up' : 'thumbs_down'; ?>
                    <?php echo $this->Form->postLink('<span class="glyphicons showoverlay '.$img.' notchange" rel="tooltip" data-title="A soumettre pour facturation<br>si pouce en bas<br>Soumis pour facturation<br>si pouce en haut"></span>', array('action' => 'updatefacturation', $activitesreelle['Activitesreelle']['id']),array('escape' => false), __('Etes-vous certain de vouloir mettre à jour cette feuille de temps pour facturation ?')); ?>                    
                    <?php endif; ?>
                    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'duplicate')) : ?>
                    <?php echo $this->Html->link('<span class="glyphicons retweet showoverlay notchange" rel="tooltip" data-title="Duplication"></span>', array('action' => 'autoduplicate', $activitesreelle['Activitesreelle']['id']),array('escape' => false,'class'=>'showoverlay')); ?>                    
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
        <tfooter>
	<tr>
            <?php $nbrows = $this->params->action == "afacturer" ? 12 : 12; ?>
            <td colspan="<?php echo $nbrows; ?>" class="footer admonition" style="text-align:right;">
                <?php if($this->params->action == "afacturer"): ?>
                <?php $memo = $this->requestAction('parameters/get_memofacturation') ?>
                <?php $icon = $memo['Parameter']['param']!="" ? 'bell' : 'pencil';?>
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
        </tfooter>
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
                           <textarea style='width:530px;' id="memo"><?php echo isset($memo) ? $memo['Parameter']['param'] : ''; ?></textarea>
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
         $('#icsparser').hide();
         
         $(document).on('propertychange keyup input paste focus', 'input.data_field', function(){
            var io = $(this).val().length ? 1 : 0 ;
            $(this).next('.icon_clear').stop().fadeTo(300,io);
         }).on('click', '.icon_clear', function() {
            $(this).delay(300).fadeTo(300,0).prev('input').val('');
         });

         $(document).on('click','#InfroTextSubmit',function(e){
            //e.preventDefault();
            var memo = tinymce.get('memo').getContent(); //$(this).parents().find('#memo').html();
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