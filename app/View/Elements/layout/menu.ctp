  <?php  $controller = $this->params['controller'] != 'pages' ? strtolower($this->params['controller'].'_'.$this->params['action']) : strtolower($this->params['controller'].'_'.$this->params['pass'][0]);?>  
  <!-- classes pour rendre le menu actif si en se situe sur le controller //-->  
  <?php $active = 'active'; ?>
  <?php $divactive = 'active_head'; ?>
  <?php $classProfil = in_array($controller,array('utilisateurs_profil')) ? $active : ''; ?>
  <?php $classLogout = in_array($controller,array('utilisateurs_logout')) ? $active : ''; ?>
  <?php $classHome = in_array($controller,array('pages_home')) ? $active : ''; ?>
  <?php $classAction = in_array($controller,array('actions_index','actions_add','actions_edit','actions_delete','actions_search','actionslivrables_add')) ? $active : ''; ?>
  <?php $classActvitereelle = in_array($controller,array('activitesreelles_index','activitesreelles_add','activitesreelles_edit','activitesreelles_newactivite','activitesreelles_delete','activitesreelles_search')) ? $active : ''; ?>  
  <?php $classLinkShared = in_array($controller,array('linkshareds_index','linkshareds_add','linkshareds_edit','linkshareds_delete','linkshareds_search')) ? $active : ''; ?>
  <?php $classLivrable = in_array($controller,array('livrables_index','livrables_add','livrables_edit','livrables_delete','livrables_search')) ? $active : ''; ?>
  <?php $classCalendardAbs = in_array($controller,array('activitesreelles_absences')) ? $active : ''; ?>
  <?php $classDemandeAbs = in_array($controller,array('demandeabsences_index','demandeabsences_add','demandeabsences_edit','demandeabsences_delete')) ? $active : ''; ?>  
  <?php $classGeneralites = in_array($active,array($classAction,$classActvitereelle,$classLinkShared,$classLivrable,$classCalendardAbs,$classDemandeAbs)) ? $divactive : ''; ?>               
  <?php $classSections = in_array($controller,array('sections_index','sections_add','sections_edit','sections_delete','sections_search')) ? $active : ''; ?> 
  <?php $classSocietes = in_array($controller,array('societes_index','societes_add','societes_edit','societes_delete','societes_search')) ? $active : ''; ?> 
  <?php $classSites = in_array($controller,array('sites_index','sites_add','sites_edit','sites_delete','sites_search')) ? $active : ''; ?>               
  <?php $classDossierPartages = in_array($controller,array('dossierpartages_index','dossierpartages_add','dossierpartages_edit','dossierpartages_delete','dossierpartages_search')) ? $active : ''; ?> 
  <?php $classDomaines = in_array($controller,array('domaines_index','domaines_add','domaines_edit','domaines_delete','domaines_search')) ? $active : ''; ?>               
  <?php $classOutils = in_array($controller,array('outils_index','outils_add','outils_edit','outils_delete','outils_search')) ? $active : ''; ?>    
  <?php $classAssistances = in_array($controller,array('assistances_index','assistances_add','assistances_edit','assistances_delete','assistances_search')) ? $active : ''; ?> 
  <?php $classListeDiffusions = in_array($controller,array('listediffusions_index','listediffusions_add','listediffusions_edit','listediffusions_delete','listediffusions_search')) ? $active : ''; ?>               
  <?php $classProfils = in_array($controller,array('profils_index','profils_add','profils_edit','profils_delete','profils_search')) ? $active : ''; ?>  
  <?php $classParameters = in_array($controller,array('parameters_index','parameters_importcsvdata')) ? $active : ''; ?>    
  <?php $classLog = in_array($controller,array('parameters_logfiles')) ? $active : ''; ?>    
  <?php $classParametersSave = in_array($controller,array('parameters_savebdd')) ? $active : ''; ?>    
  <?php $classParametersRestore = in_array($controller,array('parameters_restorebdd','parameters_listebackup')) ? $active : ''; ?>    
  <?php $classAutorisations = in_array($controller,array('autorisations_index','autorisations_add','autorisations_edit','autorisations_delete','autorisations_search')) ? $active : ''; ?>                
  <?php $classTypeMateriels = in_array($controller,array('typemateriels_index','typemateriels_add','typemateriels_edit','typemateriels_delete','typemateriels_search')) ? $active : ''; ?> 
  <?php $classMessages = in_array($controller,array('messages_index','messages_add','messages_edit','messages_delete','messages_search')) ? $active : ''; ?>
  <?php $classApplications = in_array($controller,array('applications_index','applications_add','applications_edit','applications_delete','applications_search')) ? $active : ''; ?>
  <?php $classArchitectures = in_array($controller,array('architectures_index','architectures_add','architectures_edit','architectures_delete','architectures_search')) ? $active : ''; ?>
  <?php $classChassis = in_array($controller,array('chassis_index','chassis_add','chassis_edit','chassis_delete','chassis_search')) ? $active : ''; ?>
  <?php $classComposants = in_array($controller,array('composants_index','composants_add','composants_edit','composants_delete','composants_search')) ? $active : ''; ?>
  <?php $classCpus = in_array($controller,array('cpuses_index','cpuses_add','cpuses_edit','cpuses_delete','cpuses_search')) ? $active : ''; ?>
  <?php $classCoutsuos = in_array($controller,array('coutuos_index','coutuos_add','coutuos_edit','coutuos_delete','coutuos_search')) ? $active : ''; ?>
  <?php $classEtats = in_array($controller,array('etats_index','etats_add','etats_edit','etats_delete','etats_search')) ? $active : ''; ?>
  <?php $classEnvSNCF = in_array($controller,array('dsitenvs_index','dsitenvs_add','dsitenvs_edit','dsitenvs_view','dsitenvs_delete','dsitenvs_search')) ? $active : ''; ?>
  <?php $classLocalites = in_array($controller,array('localites_index','localites_add','localites_edit','localites_delete','localites_search')) ? $active : ''; ?>
  <?php $classLots = in_array($controller,array('lots_index','lots_add','lots_edit','lots_delete','lots_search')) ? $active : ''; ?>
  <?php $classModeles = in_array($controller,array('modeles_index','modeles_add','modeles_edit','modeles_delete','modeles_search')) ? $active : ''; ?>
  <?php $classMWS = in_array($controller,array('mws_index','mws_add','mws_edit','mws_delete','mws_search')) ? $active : ''; ?>
  <?php $classNFS = in_array($controller,array('nfs_index','nfs_add','nfs_edit','nfs_delete','nfs_search')) ? $active : ''; ?>
  <?php $classPerimetres = in_array($controller,array('perimetres_index','perimetres_add','perimetres_edit','perimetres_delete','perimetres_search')) ? $active : ''; ?>
  <?php $classPhases = in_array($controller,array('phases_index','phases_add','phases_edit','phases_delete','phases_search')) ? $active : ''; ?>
  <?php $classPuissances = in_array($controller,array('puissances_index','puissances_add','puissances_edit','puissances_delete','puissancess_search')) ? $active : ''; ?>
  <?php $classTypes = in_array($controller,array('types_index','types_add','types_edit','types_delete','types_search')) ? $active : ''; ?>
  <?php $classUsages = in_array($controller,array('usages_index','usages_add','usages_edit','usages_delete','usages_search')) ? $active : ''; ?>
  <?php $classVersions = in_array($controller,array('versions_index','versions_add','versions_edit','versions_delete','versions_search')) ? $active : ''; ?>
  <?php $classVolumetries = in_array($controller,array('volumetries_index','volumetries_add','volumetries_edit','volumetries_delete','volumetries_search')) ? $active : ''; ?>
  <?php $classEnvOutils = in_array($controller,array('envoutils_index','envoutils_add','envoutils_edit','envoutils_delete','envoutils_search')) ? $active : ''; ?>
  <?php $classEnvVersions = in_array($controller,array('envversions_index','envversions_add','envversions_edit','envversions_delete','envversions_search')) ? $active : ''; ?>
  <?php $classEntites = in_array($controller,array('entites_index','entites_add','entites_edit','entites_delete','entites_search')) ? $active : ''; ?>
  <?php $classAdministration = in_array($active,array($classLog,$classParametersRestore,$classEntites,$classParametersSave,$classParameters,$classSections,$classSocietes,$classSites,$classDossierPartages,$classAutorisations,$classDomaines,$classOutils,$classAssistances,$classProfils,$classListeDiffusions,$classTypeMateriels,$classMessages)) ? $divactive : ''; ?>               
  <?php $classAdminEnv = in_array($active,array($classEnvVersions,$classEnvOutils,$classVolumetries,$classVersions,$classUsages,$classTypes,$classPuissances,$classPhases,$classPerimetres,$classEtats,$classNFS,$classMWS,$classModeles,$classLots,$classLocalites,$classCoutsuos,$classCpus,$classComposants,$classChassis,$classArchitectures,$classApplications)) ? $divactive : ''; ?>              
  <?php $classContrats = in_array($controller,array('contrats_index','contrats_add','contrats_edit','contrats_delete','contrats_search')) ? $active : ''; ?> 
  <?php $classProjets = in_array($controller,array('projets_index','projets_add','projets_edit','projets_delete','projets_search')) ? $active : ''; ?> 
  <?php $classCentrecouts = in_array($controller,array('centrecouts_index','centrecouts_add','centrecouts_edit','centrecouts_delete','centrecouts_search')) ? $active : ''; ?> 
  <?php $classActivites = in_array($controller,array('activites_index','activites_add','activites_edit','activites_delete','activites_search','historybudgets_add','historybudgets_edit','historybudgets_delete')) ? $active : ''; ?>               
  <?php $classTJMProjets = in_array($controller,array('tjmcontrats_index','tjmcontrats_add','tjmcontrats_edit','tjmcontrats_delete','tjmcontrats_search')) ? $active : ''; ?> 
  <?php $classTJMAgents = in_array($controller,array('tjmagents_index','tjmagents_add','tjmagents_edit','tjmagents_delete','tjmagents_search')) ? $active : ''; ?>               
  <?php $classAchats = in_array($controller,array('achats_index','achats_add','achats_edit','achats_delete','achats_search')) ? $active : ''; ?>    
  <?php $classPlanDeCharge = in_array($controller,array('plancharges_index','plancharges_add','plancharges_edit','plancharges_delete','plancharges_search','detailplancharges_add','detailplancharges_edit')) ? $active : ''; ?>      
  <?php $classFacturationTodo = in_array($controller,array('activitesreelles_afacturer','facturations_add')) ? $active : ''; ?>        
  <?php $classFacturationDo = in_array($controller,array('facturations_index','facturations_delete','facturations_search')) ? $active : ''; ?> 
  <?php $classFacturation = in_array($active,array($classFacturationTodo,$classFacturationDo)) ? $divactive : ''; ?>        
  <?php $classBudget = in_array($active,array($classPlanDeCharge,$classContrats,$classProjets,$classCentrecouts,$classActivites,$classAchats,$classTJMProjets,$classTJMAgents)) ? $divactive : ''; ?>  
  <?php $classUtilisateurs = in_array($controller,array('utilisateurs_index','utilisateurs_add','utilisateurs_edit','utilisateurs_delete','utilisateurs_search','dotations_add','dotations_edit','dotations_delete','affectations_add','affectations_edit','affectations_delete')) ? $active : ''; ?> 
  <?php $classMateriels = in_array($controller,array('materielinformatiques_index','materielinformatiques_add','materielinformatiques_edit','materielinformatiques_delete','materielinformatiques_search')) ? $active : ''; ?>               
  <?php $classPetitMateriels = in_array($controller,array('materielautres_index','materielautres_add','materielautres_edit','materielautres_delete','materielautres_search')) ? $active : ''; ?>               
  <?php $classUtiliseOutils = in_array($controller,array('utiliseoutils_index','utiliseoutils_add','utiliseoutils_edit','utiliseoutils_delete','utiliseoutils_search')) ? $active : ''; ?>    
  <?php $classLogistique = in_array($active,array($classPetitMateriels,$classUtilisateurs,$classMateriels,$classUtiliseOutils)) ? $divactive : ''; ?> 
  <?php $classCRAActions = in_array($controller,array('actions_rapport','actions_export_doc')) ? $active : ''; ?> 
  <?php $classCRAActionsProjet = in_array($controller,array('actions_rapportprojet')) ? $active : ''; ?>
  <?php $classCRARisques = in_array($controller,array('actions_risques')) ? $active : ''; ?> 
  <?php $classCRAActions7 = in_array($controller,array('actions_last7days')) ? $active : ''; ?>
  <?php $classCRALogistique = in_array($controller,array('rapports_logistique')) ? $active : ''; ?>
  <?php $classCRASaisie = in_array($controller,array('rapports_etatsaisie')) ? $active : ''; ?>  
  <?php $classCRASS2I = in_array($controller,array('rapports_ss2i')) ? $active : ''; ?>  
  <?php $classFACTSNCF = in_array($controller,array('rapports_factscnf')) ? $active : ''; ?>  
  <?php $classCRAExpBesoin = in_array($controller,array('expressionbesoins_rapport')) ? $active : ''; ?> 
  <?php $classCRAIntApp = in_array($controller,array('intergrationapplicatives_rapport')) ? $active : ''; ?>  
  <?php $classCRAActivites = in_array($controller,array('activitesreelles_rapport','activitesreelles_export_doc')) ? $active : ''; ?>    
  <?php $classCRAFacturations = in_array($controller,array('facturations_rapport','facturations_export_doc')) ? $active : ''; ?>   
  <?php $classCRAPlancharges = in_array($controller,array('plancharges_rapport','plancharges_export_doc')) ? $active : ''; ?>  
  <?php $classCRAPlanchargesAgents = in_array($controller,array('plancharges_rapportagent')) ? $active : ''; ?> 
  <?php $classCRADashboard = in_array($controller,array('dashboards_index','dashboards_export_doc')) ? $active : ''; ?> 
  <?php $classCRAbien = in_array($controller,array('biens_rapport')) ? $active : ''; ?>   
  <?php $classRapports = in_array($active,array($classCRAExpBesoin,$classCRAbien,$classCRAIntApp,$classFACTSNCF,$classCRAPlanchargesAgents,$classCRAActions,$classCRAActionsProjet,$classCRARisques,$classCRAActivites,$classCRASaisie,$classCRASS2I,$classCRAFacturations,$classCRAPlancharges,$classCRADashboard,$classCRAActions7,$classCRALogistique)) ? $divactive : ''; ?> 
  <?php $classContactUs = in_array($controller,array('contacts_add')) ? $active : ''; ?>  
  <?php $classChangelog = in_array($controller,array('changelogdemandes_add','changelogdemandes_changelog','changelogdemandes_listetodo','changelogreponses_add','changelogreponses_view','changelogdemandes_edit','changelogdemandes_index','changelogversions_index')) ? $active : ''; ?> 
  <?php $classAddFavorites = 'notactive'; ?>  
  <?php $classBiens = in_array($controller,array('biens_index','biens_add','biens_edit','biens_delete','biens_search','biens_export_xls')) ? $active : ''; ?>    
  <?php $classLogiciels = in_array($controller,array('logiciels_index','logiciels_add','logiciels_edit','logiciels_delete','logiciels_search','logiciels_export_xls')) ? $active : ''; ?>      
  <?php $classIntApp = in_array($controller,array('intergrationapplicatives_add','intergrationapplicatives_export_xls','intergrationapplicatives_index','intergrationapplicatives_edit','intergrationapplicatives-delete','intergrationapplicatives_search')) ? $active : ''; ?>        
  <?php $classExpBesoin = in_array($controller,array('expressionbesoins_index','expressionbesoins_delete','expressionbesoins_search','expressionbesoins_add','expressionbesoins_edit','expressionbesoins_export_xls')) ? $active : ''; ?> 
  <?php $classEnvironnement = in_array($active,array($classBiens,$classLogiciels,$classIntApp,$classExpBesoin,$classEnvSNCF)) ? $divactive : ''; ?>      
  <?php $classDivers = in_array($active,array($classContactUs,$classAddFavorites,$classChangelog)) ? $divactive : ''; ?> 
  <div class="panel-group" id="menu" style="margin-bottom: 30px;padding-bottom: 45px;overflow-y: auto;">
    <div class="panel panel-default">
      <div class="panel-heading panel-menu <?php echo $classGeneralites; ?>">
        <h3 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#menu" href="#generalites">
            Généralités
          </a>
          <span class="glyphicons pull-right <?php echo classChevron($classGeneralites); ?> notchange"></span>  
        </h3>
      </div>
      <div id="generalites" class="panel-collapse collapse panel-menu-content <?php echo classActive($classGeneralites); ?>">
        <div class="panel-body">
          <ul>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'index')) : ?>               
                <li class="<?php echo $classAction; ?>"><?php echo $this->Html->link('Actions',array('controller'=>'actions','action'=>'index','tous','6',userAuth('id')),array('class'=>'showoverlay','escape' => false)); ?></li>
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'index')) : ?>
                <?php $mois = date('m'); ?>
                <li class="<?php echo $classActvitereelle; ?>"><?php echo $this->Html->link('Feuille de temps',array('controller'=>'activitesreelles','action'=>'index','tous',userAuth('id'),$mois),array('class'=>'showoverlay','escape' => false)); ?></li>    
                <?php endif; ?>  
                <li class="<?php echo $classLinkShared; ?>"><?php echo $this->Html->link('Liens partagés',array('controller'=>'linkshareds','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('livrables', 'index')) : ?>
                <li class="<?php echo $classLivrable; ?>"><?php echo $this->Html->link('Livrables',array('controller'=>'livrables','action'=>'index','week','tous',userAuth('id')),array('class'=>'showoverlay','escape' => false)); ?></li>
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'absences')) : ?>    
                <li class="divider"></li>
                <li class="<?php echo $classCalendardAbs; ?>"><?php echo $this->Html->link('Calendrier équipe',array('controller'=>'activitesreelles','action'=>'absences'),array('class'=>'showoverlay','escape' => false)); ?></li>
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('demandeabsences', 'index')) : ?>    
                <li class="<?php echo $classDemandeAbs; ?>"><?php echo $this->Html->link('Absences prestataires',array('controller'=>'demandeabsences','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
                <?php endif; ?>          </ul>
        </div>
      </div>
    </div>  
<?php if (userAuth('profil_id')!='2' && (isAuthorized('messages', 'index') || isAuthorized('profils', 'index') || isAuthorized('autorisations', 'index') || isAuthorized('assistances', 'index') || isAuthorized('domaines', 'index') || isAuthorized('listediffusions', 'index') || isAuthorized('outils', 'index') || isAuthorized('dossierpartages', 'index') || isAuthorized('sections', 'index') || isAuthorized('sites', 'index') || isAuthorized('societes', 'index') || isAuthorized('typemateriels', 'index'))) : ?>       
    <div class="panel panel-default">
      <div class="panel-heading panel-menu <?php echo $classAdministration; ?>">
        <h3 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#menu" href="#administration">
            Administration
          </a>
          <span class="glyphicons pull-right <?php echo classChevron($classAdministration); ?> notchange"></span>  
        </h3>
      </div>
      <div id="administration" class="panel-collapse collapse panel-menu-content <?php echo classActive($classAdministration); ?>">
        <div class="panel-body">
          <ul>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('messages', 'index')) : ?>
            <li class="<?php echo $classMessages; ?>"><?php echo $this->Html->link('Messages',array('controller'=>'messages','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('parameters', 'index')) : ?> 
            <li class="divider"></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('parameters', 'index')) : ?>
            <li class="<?php echo $classParameters; ?>"><?php echo $this->Html->link('Paramètres du site',array('controller'=>'parameters','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <li class="<?php echo $classLog; ?>"><?php echo $this->Html->link('Journaux',array('controller'=>'parameters','action'=>'logfiles'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <li class="divider"></li>
            <li class="<?php echo $classParametersSave; ?>"><?php echo $this->Html->link('Sauvegarder',array('controller'=>'parameters','action'=>'savebdd'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <li class="<?php echo $classParametersRestore; ?>"><?php echo $this->Html->link('Restaurer',array('controller'=>'parameters','action'=>'listebackup'),array('class'=>'showoverlay','escape' => false)); ?></li>            
            <?php endif; ?>            
            <?php if (userAuth('profil_id')!='2' && (isAuthorized('profils', 'index') || isAuthorized('assistances', 'index') || isAuthorized('autorisations', 'index'))) : ?> 
            <li class="divider"></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('profils', 'index')) : ?>
            <li class="<?php echo $classProfils; ?>"><?php echo $this->Html->link('Profils',array('controller'=>'profils','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('autorisations', 'index')) : ?>            
            <li class="<?php echo $classAutorisations; ?>"><?php echo $this->Html->link('Autorisations',array('controller'=>'autorisations','action'=>'index','tous'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('entites', 'index')) : ?>            
            <li class="<?php echo $classEntites; ?>"><?php echo $this->Html->link('Cercles de visibilité',array('controller'=>'entites','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && (isAuthorized('assistances', 'index') || isAuthorized('domaines', 'index') || isAuthorized('listediffusions', 'index') || isAuthorized('outils', 'index') || isAuthorized('dossierpartages', 'index') || isAuthorized('sections', 'index') || isAuthorized('sites', 'index') || isAuthorized('societes', 'index') || isAuthorized('typemateriels', 'index'))) : ?> 
            <li class="divider"></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('assistances', 'index')) : ?>
            <li class="<?php echo $classAssistances; ?>"><?php echo $this->Html->link('Assistances',array('controller'=>'assistances','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('domaines', 'index')) : ?>
            <li class="<?php echo $classDomaines; ?>"><?php echo $this->Html->link('Domaines',array('controller'=>'domaines','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('listediffusions', 'index')) : ?>
            <li class="<?php echo $classListeDiffusions; ?>"><?php echo $this->Html->link('Listes de diffusion',array('controller'=>'listediffusions','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('outils', 'index')) : ?>
            <li class="<?php echo $classOutils; ?>"><?php echo $this->Html->link('Outils',array('controller'=>'outils','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('dossierpartages', 'index')) : ?>
            <li class="<?php echo $classDossierPartages; ?>"><?php echo $this->Html->link('Partages réseaux',array('controller'=>'dossierpartages','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('sections', 'index')) : ?>
            <li class="<?php echo $classSections; ?>"><?php echo $this->Html->link('Sections',array('controller'=>'sections','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('sites', 'index')) : ?>
            <li class="<?php echo $classSites; ?>"><?php echo $this->Html->link('Sites',array('controller'=>'sites','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>                        
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('societes', 'index')) : ?>
            <li class="<?php echo $classSocietes; ?>"><?php echo $this->Html->link('Sociétés',array('controller'=>'societes','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('typemateriels', 'index')) : ?>
            <li class="<?php echo $classTypeMateriels; ?>"><?php echo $this->Html->link('Types de matériel',array('controller'=>'typemateriels','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>  
          </ul>
        </div>
      </div>
    </div>
<?php endif; ?>      
<?php if (userAuth('profil_id')!='2' && (isAuthorized('applications', 'index') || isAuthorized('architectures', 'index') || isAuthorized('chassis', 'index') || isAuthorized('composants', 'index') || isAuthorized('couts', 'index') || isAuthorized('coutuos', 'index')  || isAuthorized('etats', 'index') || isAuthorized('localites', 'index') || isAuthorized('lots', 'index') || isAuthorized('modeles', 'index') || isAuthorized('mws', 'index') 
            || isAuthorized('nfs', 'index') || isAuthorized('envoutils', 'index') || isAuthorized('perimetres', 'index') || isAuthorized('phases', 'index') || isAuthorized('puissances', 'index')  || isAuthorized('types', 'index') || isAuthorized('usages', 'index') || isAuthorized('versions', 'index') || isAuthorized('envversions', 'index') || isAuthorized('volumetries', 'index'))) : ?>
    <div class="panel panel-default">
      <div class="panel-heading panel-menu <?php echo $classAdminEnv; ?>">
        <h3 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#menu" href="#administrationenv">
            Admin. gest. conf.
          </a>
          <span class="glyphicons pull-right <?php echo classChevron($classAdminEnv); ?> notchange"></span>  
        </h3>
      </div>
      <div id="administrationenv" class="panel-collapse collapse panel-menu-content <?php echo classActive($classAdminEnv); ?>">
        <div class="panel-body">
          <ul>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('applications', 'index')) : ?>
            <li class="<?php echo $classApplications; ?>"><?php echo $this->Html->link('Applications',array('controller'=>'applications','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>   
            <?php if (userAuth('profil_id')!='2' && isAuthorized('architectures', 'index')) : ?>
            <li class="<?php echo $classArchitectures; ?>"><?php echo $this->Html->link('Architectures',array('controller'=>'architectures','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>  
            <?php if (userAuth('profil_id')!='2' && isAuthorized('composants', 'index')) : ?>
            <li class="<?php echo $classComposants; ?>"><?php echo $this->Html->link('Composants',array('controller'=>'composants','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>  
            <?php if (userAuth('profil_id')!='2' && isAuthorized('cpuses', 'index')) : ?>
            <li class="<?php echo $classCpus; ?>"><?php echo $this->Html->link('CPUs',array('controller'=>'cpuses','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>             
            <?php if (userAuth('profil_id')!='2' && isAuthorized('etats', 'index')) : ?>
            <li class="<?php echo $classEtats; ?>"><?php echo $this->Html->link('Etats',array('controller'=>'etats','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('localites', 'index')) : ?>
            <li class="<?php echo $classLocalites; ?>"><?php echo $this->Html->link('Localités',array('controller'=>'localites','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>   
            <?php if (userAuth('profil_id')!='2' && isAuthorized('lots', 'index')) : ?>
            <li class="<?php echo $classLots; ?>"><?php echo $this->Html->link('Lots',array('controller'=>'lots','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>   
            <?php if (userAuth('profil_id')!='2' && isAuthorized('modeles', 'index')) : ?>
            <li class="<?php echo $classModeles; ?>"><?php echo $this->Html->link('Modèles',array('controller'=>'modeles','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>  
            <?php if (userAuth('profil_id')!='2' && isAuthorized('nfs', 'index')) : ?>
            <li class="<?php echo $classNFS; ?>"><?php echo $this->Html->link('NFS',array('controller'=>'nfs','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>     
            <?php if (userAuth('profil_id')!='2' && isAuthorized('envoutils', 'index')) : ?>
            <li class="<?php echo $classEnvOutils; ?>"><?php echo $this->Html->link('Outils',array('controller'=>'envoutils','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>  
            <?php if (userAuth('profil_id')!='2' && isAuthorized('perimetres', 'index')) : ?>
            <li class="<?php echo $classPerimetres; ?>"><?php echo $this->Html->link('Périmètres',array('controller'=>'perimetres','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>              
            <?php if (userAuth('profil_id')!='2' && isAuthorized('phases', 'index')) : ?>
            <li class="<?php echo $classPhases; ?>"><?php echo $this->Html->link('Phases',array('controller'=>'phases','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>  
            <?php if (userAuth('profil_id')!='2' && isAuthorized('types', 'index')) : ?>
            <li class="<?php echo $classTypes; ?>"><?php echo $this->Html->link('Type d\'env.',array('controller'=>'types','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?> 
            <?php if (userAuth('profil_id')!='2' && isAuthorized('usages', 'index')) : ?>
            <li class="<?php echo $classUsages; ?>"><?php echo $this->Html->link('Usages',array('controller'=>'usages','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>           
            <?php if (userAuth('profil_id')!='2' && isAuthorized('volumetries', 'index')) : ?>
            <li class="<?php echo $classVolumetries; ?>"><?php echo $this->Html->link('Volumétries',array('controller'=>'volumetries','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>                
            <li class="divider"></li>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('chassis', 'index')) : ?>
            <li class="<?php echo $classChassis; ?>"><?php echo $this->Html->link('Chassis',array('controller'=>'chassis','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>           
            <?php if (userAuth('profil_id')!='2' && isAuthorized('mws', 'index')) : ?>
            <li class="<?php echo $classMWS; ?>"><?php echo $this->Html->link('Middlewares',array('controller'=>'mws','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('puissances', 'index')) : ?>
            <li class="<?php echo $classPuissances; ?>"><?php echo $this->Html->link('Puissances',array('controller'=>'puissances','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>            
            <?php if (userAuth('profil_id')!='2' && isAuthorized('versions', 'index') && false) : ?>
            <li class="<?php echo $classVersions; ?>"><?php echo $this->Html->link('Versions Applicatives',array('controller'=>'versions','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>  
            <?php if (userAuth('profil_id')!='2' && isAuthorized('envversions', 'index') && false) : ?>
            <li class="<?php echo $classEnvVersions; ?>"><?php echo $this->Html->link('Versions Outils.',array('controller'=>'envversions','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>      
          </ul>
        </div>
      </div>
    </div>
<?php endif; ?>  
<?php if (userAuth('profil_id')!='2' && (isAuthorized('utilisateurs', 'index') || isAuthorized('materielinformatiques', 'index') || isAuthorized('utiliseoutils', 'index'))) : ?> 
    <div class="panel panel-default">
      <div class="panel-heading panel-menu <?php echo $classLogistique; ?>">
        <h3 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#menu" href="#logistique">
            Logistique
          </a>
          <span class="glyphicons pull-right <?php echo classChevron($classLogistique); ?> notchange"></span>  
        </h3>
      </div>
      <div id="logistique" class="panel-collapse collapse panel-menu-content <?php echo classActive($classLogistique); ?>">
        <div class="panel-body">
          <ul>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('utilisateurs', 'index')) : ?>
            <li class="<?php echo $classUtilisateurs; ?>"><?php echo $this->Html->link('Utilisateurs',array('controller'=>'utilisateurs','action'=>'index','actif','allsections'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('materielinformatiques', 'index')) : ?>
            <li class="<?php echo $classMateriels; ?>"><?php echo $this->Html->link('Postes informatiques',array('controller'=>'materielinformatiques','action'=>'index','En stock','tous','toutes'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('utiliseoutils', 'index')) : ?>
            <li class="<?php echo $classUtiliseOutils; ?>"><?php echo $this->Html->link('Ouvertures des droits',array('controller'=>'utiliseoutils','action'=>'index','tous','tous'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
<?php endif; ?>   
<?php if (userAuth('profil_id')!='2' && (isAuthorized('contrats', 'index') || isAuthorized('projets', 'index') || isAuthorized('activites', 'index')  || isAuthorized('achats', 'index') || isAuthorized('tjmcontrats', 'index')  || isAuthorized('tjmagents', 'index') || isAuthorized('plancharges', 'index'))) : ?>
    <div class="panel panel-default">
      <div class="panel-heading panel-menu <?php echo $classBudget; ?>">
        <h3 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#menu" href="#budget">
            Budget
          </a>
          <span class="glyphicons pull-right <?php echo classChevron($classBudget); ?> notchange"></span>  
        </h3>
      </div>
      <div id="budget" class="panel-collapse collapse panel-menu-content <?php echo classActive($classBudget); ?>">
        <div class="panel-body">
          <ul>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('contrats', 'index')) : ?>
            <li class="<?php echo $classContrats; ?>"><?php echo $this->Html->link('Contrats',array('controller'=>'contrats','action'=>'index','actif'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('centrecouts', 'index')) : ?>
            <li class="<?php echo $classCentrecouts; ?>"><?php echo $this->Html->link('Centres de coûts',array('controller'=>'centrecouts','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>            
            <?php if (userAuth('profil_id')!='2' && isAuthorized('projets', 'index')) : ?>
            <li class="<?php echo $classProjets; ?>"><?php echo $this->Html->link('Projets',array('controller'=>'projets','action'=>'index','actif','tous'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('activites', 'index')) : ?>
            <li class="<?php echo $classActivites; ?>"><?php echo $this->Html->link('Activités',array('controller'=>'activites','action'=>'index','actif','tous'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && (isAuthorized('achats', 'index') || isAuthorized('tjmcontrats', 'index')  || isAuthorized('tjmagents', 'index') || isAuthorized('plancharges', 'index')  || isAuthorized('facturations', 'index'))) : ?>
            <li class="divider"></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('achats', 'index')) : ?>
            <li class="<?php echo $classAchats; ?>"><?php echo $this->Html->link('Achats',array('controller'=>'achats','action'=>'index','toutes'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && (isAuthorized('tjmcontrats', 'index')  || isAuthorized('tjmagents', 'index') || isAuthorized('plancharges', 'index')  || isAuthorized('facturations', 'index'))) : ?>
            <li class="divider"></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('tjmcontrats', 'index')) : ?>
            <li class="<?php echo $classTJMProjets; ?>"><?php echo $this->Html->link('TJM Contrats',array('controller'=>'tjmcontrats','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('tjmagents', 'index')) : ?>
            <li class="<?php echo $classTJMAgents; ?>"><?php echo $this->Html->link('TJM Agents',array('controller'=>'tjmagents','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'index')) : ?>
            <li class="divider"></li>
            <li class="<?php echo $classPlanDeCharge; ?>"><?php echo $this->Html->link('Plan de charge',array('controller'=>'plancharges','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?> 
          </ul>
        </div>
      </div>
    </div>
<?php endif; ?>   
<?php if(userAuth('profil_id')!='2' && (isAuthorized('facturations', 'index'))): ?>
    <div class="panel panel-default">
      <div class="panel-heading panel-menu <?php echo $classFacturation; ?>">
        <h3 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#menu" href="#facturation">
            Facturation
          </a>
          <span class="glyphicons pull-right <?php echo classChevron($classFacturation); ?> notchange"></span>  
        </h3>
      </div>
      <div id="facturation" class="panel-collapse collapse panel-menu-content <?php echo classActive($classFacturation); ?>">
        <div class="panel-body">
          <ul>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('contrats', 'index')) : ?>
                <li class="<?php echo $classFacturationTodo; ?>"><?php echo $this->Html->link('A facturer',array('controller'=>'activitesreelles','action'=>'afacturer'),array('class'=>'showoverlay','escape' => false)); ?></li>
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('contrats', 'index')) : ?>
                <li class="<?php echo $classFacturationDo; ?>"><?php echo $this->Html->link('Facturé',array('controller'=>'facturations','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
                <?php endif; ?>   
          </ul>
        </div>
      </div>
    </div>
<?php endif; ?>   
<?php if (userAuth('profil_id')!='2' && (isAuthorized('biens', 'index') || isAuthorized('logiciels', 'index') || isAuthorized('intergrationapplicatives', 'index')  || isAuthorized('expressionbesoins', 'index'))) : ?> 
    <div class="panel panel-default">
      <div class="panel-heading panel-menu <?php echo $classEnvironnement; ?>">
        <h3 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#menu" href="#environnements">
            Gestion de configurations
          </a>
          <span class="glyphicons pull-right <?php echo classChevron($classEnvironnement); ?> notchange"></span>  
        </h3>
      </div>
      <div id="environnements" class="panel-collapse collapse panel-menu-content <?php echo classActive($classEnvironnement); ?>">
        <div class="panel-body">
          <ul>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('biens', 'index')) : ?>
            <li class="<?php echo $classBiens; ?>"><?php echo $this->Html->link('Biens',array('controller'=>'biens','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('logiciels', 'index')) : ?>
            <li class="<?php echo $classLogiciels; ?>"><?php echo $this->Html->link('Logiciels',array('controller'=>'logiciels','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <li class="divider"></li>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('intergrationapplicatives', 'index')) : ?>
            <li class="<?php echo $classIntApp; ?>"><?php echo $this->Html->link('Intégration App.',array('controller'=>'intergrationapplicatives','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>     
            <li class="divider"></li>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('expressionbesoins', 'index')) : ?>
            <li class="<?php echo $classExpBesoin; ?>"><?php echo $this->Html->link('Environnements',array('controller'=>'expressionbesoins','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?> 
            <?php if (userAuth('profil_id')!='2' && isAuthorized('dsitenvs', 'index')) : ?>
            <li class="<?php echo $classEnvSNCF; ?>"><?php echo $this->Html->link('Environnements SNCF',array('controller'=>'dsitenvs','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>             
          </ul>
        </div>
      </div>
    </div>
<?php endif; ?>  
<?php if(userAuth('profil_id')!='2' && (isAuthorized('actions', 'rapports') || isAuthorized('activitesreelles', 'rapports') || isAuthorized('facturations', 'rapports') || isAuthorized('plancharges', 'rapports'))) : ?>
    <div class="panel panel-default">
      <div class="panel-heading panel-menu <?php echo $classRapports; ?>">
        <h3 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#menu" href="#rapports">
            Rapports
          </a>
          <span class="glyphicons pull-right <?php echo classChevron($classRapports); ?> notchange"></span>  
        </h3>
      </div>
      <div id="rapports" class="panel-collapse collapse panel-menu-content <?php echo classActive($classRapports); ?>">
        <div class="panel-body">
          <ul>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'rapports')) : ?>
            <li class="<?php echo $classCRAActions; ?>"><?php echo $this->Html->link('CRA Actions par agents',array('controller'=>'actions','action'=>'rapport'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <li class="<?php echo $classCRAActionsProjet; ?>"><?php echo $this->Html->link('CRA Actions par projets',array('controller'=>'actions','action'=>'rapportprojet'),array('class'=>'showoverlay','escape' => false)); ?></li>            
            <li class="<?php echo $classCRAActions7; ?>"><?php echo $this->Html->link('Actions 7 derniers jours',array('controller'=>'actions','action'=>'last7days'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <li class="<?php echo $classCRARisques; ?>"><?php echo $this->Html->link('Risques',array('controller'=>'actions','action'=>'risques'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <li class="divider"></li>
            <li class="<?php echo $classCRALogistique; ?>"><?php echo $this->Html->link('Logistique',array('controller'=>'rapports','action'=>'logistique'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <li class="divider"></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'rapports')) : ?>
            <li class="<?php echo $classCRAActivites; ?>"><?php echo $this->Html->link('Activités réelles',array('controller'=>'activitesreelles','action'=>'rapport'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <li class="<?php echo $classCRASaisie; ?>"><?php echo $this->Html->link('Etat saisie',array('controller'=>'rapports','action'=>'etatsaisie'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <li class="divider"></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('facturations', 'rapports')) : ?>
            <li class="<?php echo $classCRAFacturations; ?>"><?php echo $this->Html->link('Facturations estimées',array('controller'=>'facturations','action'=>'rapport'),array('class'=>'showoverlay','escape' => false)); ?></li>            
            <li class="<?php echo $classCRASS2I; ?>"><?php echo $this->Html->link('Facturation SS2I',array('controller'=>'rapports','action'=>'ss2i'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <li class="<?php echo $classFACTSNCF; ?>"><?php echo $this->Html->link('Facturation agents SNCF',array('controller'=>'rapports','action'=>'factscnf'),array('class'=>'showoverlay','escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'rapports')) : ?>
            <li class="<?php echo $classCRAPlancharges; ?>"><?php echo $this->Html->link('Plan de charges projet',array('controller'=>'plancharges','action'=>'rapport'),array('class'=>'showoverlay','escape' => false)); ?></li>            
            <li class="<?php echo $classCRAPlanchargesAgents; ?>"><?php echo $this->Html->link('Plan de charges agent',array('controller'=>'plancharges','action'=>'rapportagent'),array('class'=>'showoverlay','escape' => false)); ?></li>            
            <?php endif; ?>   
            <?php if (userAuth('profil_id')!='2' && (isAuthorized('facturations', 'rapports') || isAuthorized('plancharges', 'rapports'))) : ?>
            <li class="divider"></li>
            <li class="<?php echo $classCRADashboard; ?>"><?php echo $this->Html->link('Tableau de bord',array('controller'=>'dashboards','action'=>'index'),array('class'=>'showoverlay','escape' => false)); ?></li>            
            <?php endif; ?>    
            <?php if (userAuth('profil_id')!='2' && (isAuthorized('expressionbesoins', 'rapports') || isAuthorized('intergrationapplicatives', 'rapports'))) : ?>
            <li class="divider"></li>
            <li class="<?php echo $classCRAIntApp; ?>"><?php echo $this->Html->link('Intégration App.',array('controller'=>'intergrationapplicatives','action'=>'rapport'),array('class'=>'showoverlay','escape' => false)); ?></li>            
            <li class="<?php echo $classCRAExpBesoin; ?>"><?php echo $this->Html->link('Environnements',array('controller'=>'expressionbesoins','action'=>'rapport'),array('class'=>'showoverlay','escape' => false)); ?></li>                        
            <li class="<?php echo $classCRAbien; ?>"><?php echo $this->Html->link('Px70 et PVU',array('controller'=>'biens','action'=>'rapport'),array('class'=>'showoverlay','escape' => false)); ?></li>                        
            <?php endif; ?>  
          </ul>
        </div>
      </div>
    </div>
<?php endif; ?>  
    <div class="panel panel-default">
      <div class="panel-heading panel-menu <?php echo $classDivers; ?>">
        <h3 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#menu" href="#divers">
            Divers
          </a>
          <span class="glyphicons pull-right <?php echo classChevron($classDivers); ?> notchange"></span>  
        </h3>
      </div>
      <div id="divers" class="panel-collapse collapse panel-menu-content <?php echo classActive($classDivers); ?>">
        <div class="panel-body">
            <ul>
                <li class="<?php echo $classContactUs; ?>"><?php echo $this->Html->link('Nous contacter',array('controller'=>'contacts','action'=>'add'),array('class'=>'showoverlay','escape' => false)); ?></li>
                <li class="<?php echo $classChangelog; ?>"><?php echo $this->Html->link('Changements SAILL',array('controller'=>'changelogdemandes','action'=>'add'),array('class'=>'showoverlay','escape' => false)); ?></li>
                <li  class="margintop5 text-center text-muted text-italic text-medium">Version : <?php echo Configure::read('versionapp'); ?></li>
            </ul>
        </div>
      </div>
    </div>     
  </div>
