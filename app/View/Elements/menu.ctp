<div class="dropdown clearfix">
  <?php  $controller = $this->params['controller'] != 'pages' ? strtolower($this->params['controller'].'_'.$this->params['action']) : strtolower($this->params['controller'].'_'.$this->params['pass'][0]);?>  
  <!-- classes pour rendre le menu actif si en se situe sur le controller //-->  
  <?php $classProfil = in_array($controller,array('utilisateurs_profil')) ? 'active' : ''; ?>
  <?php $classLogout = in_array($controller,array('utilisateurs_logout')) ? 'active' : ''; ?>
  <?php $classHome = in_array($controller,array('pages_home')) ? 'active' : ''; ?>
  <?php $classAction = in_array($controller,array('actions_index','actions_add','actions_edit','actions_delete','actions_search','actionslivrables_add')) ? 'active' : ''; ?>
  <?php $classActvitereelle = in_array($controller,array('activitesreelles_index','activitesreelles_add','activitesreelles_edit','activitesreelles_delete','activitesreelles_search')) ? 'active' : ''; ?>  
  <?php $classLinkShared = in_array($controller,array('linkshareds_index','linkshareds_add','linkshareds_edit','linkshareds_delete','linkshareds_search')) ? 'active' : ''; ?>
  <?php $classLivrable = in_array($controller,array('livrables_index','livrables_add','livrables_edit','livrables_delete','livrables_search')) ? 'active' : ''; ?>
  <?php $classCalendardAbs = in_array($controller,array('activitesreelles_absences')) ? 'active' : ''; ?>
  <?php $classSections = in_array($controller,array('sections_index','sections_add','sections_edit','sections_delete','sections_search')) ? 'active' : ''; ?> 
  <?php $classSocietes = in_array($controller,array('societes_index','societes_add','societes_edit','societes_delete','societes_search')) ? 'active' : ''; ?> 
  <?php $classSites = in_array($controller,array('sites_index','sites_add','sites_edit','sites_delete','sites_search')) ? 'active' : ''; ?>               
  <?php $classDossierPartages = in_array($controller,array('dossierpartages_index','dossierpartages_add','dossierpartages_edit','dossierpartages_delete','dossierpartages_search')) ? 'active' : ''; ?> 
  <?php $classDomaines = in_array($controller,array('domaines_index','domaines_add','domaines_edit','domaines_delete','domaines_search')) ? 'active' : ''; ?>               
  <?php $classOutils = in_array($controller,array('outils_index','outils_add','outils_edit','outils_delete','outils_search')) ? 'active' : ''; ?>    
  <?php $classAssistances = in_array($controller,array('assistances_index','assistances_add','assistances_edit','assistances_delete','assistances_search')) ? 'active' : ''; ?> 
  <?php $classListeDiffusions = in_array($controller,array('listediffusions_index','listediffusions_add','listediffusions_edit','listediffusions_delete','listediffusions_search')) ? 'active' : ''; ?>               
  <?php $classProfils = in_array($controller,array('profils_index','profils_add','profils_edit','profils_delete','profils_search')) ? 'active' : ''; ?>  
  <?php $classAutorisations = in_array($controller,array('autorisations_index','autorisations_add','autorisations_edit','autorisations_delete','autorisations_search')) ? 'active' : ''; ?>                
  <?php $classTypeMateriels = in_array($controller,array('typemateriels_index','typemateriels_add','typemateriels_edit','typemateriels_delete','typemateriels_search')) ? 'active' : ''; ?> 
  <?php $classMessages = in_array($controller,array('messages_index','messages_add','messages_edit','messages_delete','messages_search')) ? 'active' : ''; ?>
  <?php $classAdministration = in_array('active',array($classSections,$classSocietes,$classSites,$classDossierPartages,$classAutorisations,$classDomaines,$classOutils,$classAssistances,$classProfils,$classListeDiffusions,$classTypeMateriels,$classMessages)) ? 'active' : ''; ?>               
  <?php $classContrats = in_array($controller,array('contrats_index','contrats_add','contrats_edit','contrats_delete','contrats_search')) ? 'active' : ''; ?> 
  <?php $classProjets = in_array($controller,array('projets_index','projets_add','projets_edit','projets_delete','projets_search')) ? 'active' : ''; ?> 
  <?php $classActivites = in_array($controller,array('activites_index','activites_add','activites_edit','activites_delete','activites_search')) ? 'active' : ''; ?>               
  <?php $classTJMProjets = in_array($controller,array('tjmcontrats_index','tjmcontrats_add','tjmcontrats_edit','tjmcontrats_delete','tjmcontrats_search')) ? 'active' : ''; ?> 
  <?php $classTJMAgents = in_array($controller,array('tjmagents_index','tjmagents_add','tjmagents_edit','tjmagents_delete','tjmagents_search')) ? 'active' : ''; ?>               
  <?php $classAchats = in_array($controller,array('achats_index','achats_add','achats_edit','achats_delete','achats_search')) ? 'active' : ''; ?>    
  <?php $classPlanDeCharge = in_array($controller,array('plancharges_index','plancharges_add','plancharges_edit','plancharges_delete','plancharges_search')) ? 'active' : ''; ?>      
  <?php $classFacturationTodo = in_array($controller,array('activitesreelles_afacturer','facturations_add')) ? 'active' : ''; ?>        
  <?php $classFacturationDo = in_array($controller,array('facturations_index','facturations_add','facturations_delete','facturations_search')) ? 'active' : ''; ?> 
  <?php $classFacturation = in_array('active',array($classFacturationTodo,$classFacturationDo)) ? 'active' : ''; ?>        
  <?php $classBudget = in_array('active',array($classFacturation,$classPlanDeCharge,$classContrats,$classProjets,$classActivites,$classAchats,$classTJMProjets,$classTJMAgents)) ? 'active' : ''; ?>  
  <?php $classUtilisateurs = in_array($controller,array('utilisateurs_index','utilisateurs_add','utilisateurs_edit','utilisateurs_delete','utilisateurs_search','dotations_add','dotations_edit','dotations_delete','affectations_add','affectations_edit','affectations_delete')) ? 'active' : ''; ?> 
  <?php $classMateriels = in_array($controller,array('materielinformatiques_index','materielinformatiques_add','materielinformatiques_edit','materielinformatiques_delete','materielinformatiques_search')) ? 'active' : ''; ?>               
  <?php $classPetitMateriels = in_array($controller,array('materielautres_index','materielautres_add','materielautres_edit','materielautres_delete','materielautres_search')) ? 'active' : ''; ?>               
  <?php $classUtiliseOutils = in_array($controller,array('utiliseoutils_index','utiliseoutils_add','utiliseoutils_edit','utiliseoutils_delete','utiliseoutils_search')) ? 'active' : ''; ?>    
  <?php $classLogistique = in_array('active',array($classPetitMateriels,$classUtilisateurs,$classMateriels,$classUtiliseOutils)) ? 'active' : ''; ?> 
  <?php $classCRAActions = in_array($controller,array('actions_rapport')) ? 'active' : ''; ?>               
  <?php $classCRAActivites = in_array($controller,array('activitesreelles_rapport')) ? 'active' : ''; ?>    
  <?php $classCRAFacturations = in_array($controller,array('facturations_rapport')) ? 'active' : ''; ?>    
  <?php $classRapports = in_array('active',array($classCRAActions,$classCRAActivites,$classCRAFacturations)) ? 'active' : ''; ?> 
  <?php $classContactUs = in_array($controller,array('contacts_add')) ? 'active' : ''; ?>               
  <?php $classAddFavorites = 'notactive'; ?>  
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" style="display: block; position: static; margin-bottom: 15px; margin-left: -20px; margin-top: 15px;">
      <li class="dropdown-menu-nolink sstitre text-center"><?php echo userAuth('username'); ?></li>
    <?php if (userAuth('profil_id')!='2') : ?>
    <li class="<?php echo $classProfil; ?>"><?php echo $this->Html->link('<i class="glyphicon_user"></i> Mon profil',array('controller'=>'utilisateurs','action'=>'profil',userAuth('id')),array('escape' => false)); ?></li>
    <?php endif; ?>
    <li class="<?php echo $classLogout; ?>"><?php echo $this->Html->link('<i class="glyphicon_power"></i> Se déconnecter',array('controller'=>'utilisateurs','action'=>'logout'),array('escape' => false)); ?></li>           
    <li class="divider"></li>
    <li class="<?php echo $classHome; ?>"><?php echo $this->Html->link('<i class="glyphicon_home"></i> Accueil',array('controller'=>'pages','action'=>'home'),array('escape' => false)); ?></li>                
    <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'index')) : ?>
    <li class="divider"></li>                
    <li class="<?php echo $classAction; ?>"><?php echo $this->Html->link('<i class="glyphicon_stopwatch"></i> Actions',array('controller'=>'actions','action'=>'index','tous','6',userAuth('id')),array('escape' => false)); ?></li>
    <?php endif; ?>
    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'index')) : ?>
    <?php $mois = date('m'); ?>
    <li class="<?php echo $classActvitereelle; ?>"><?php echo $this->Html->link('<i class="icon-tasks"></i> Feuille de temps',array('controller'=>'activitesreelles','action'=>'index','tous',userAuth('id'),$mois),array('escape' => false)); ?></li>    
    <?php endif; ?>  
    <li class="<?php echo $classLinkShared; ?>"><?php echo $this->Html->link('<i class="glyphicon_link"></i> Liens partagés',array('controller'=>'linkshareds','action'=>'index'),array('escape' => false)); ?></li>
    <?php if (userAuth('profil_id')!='2' && isAuthorized('livrables', 'index')) : ?>
    <li class="<?php echo $classLivrable; ?>"><?php echo $this->Html->link('<i class="glyphicon_inbox"></i> Livrables',array('controller'=>'livrables','action'=>'index','week','tous',userAuth('id')),array('escape' => false)); ?></li>
    <?php endif; ?>
    <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'absences')) : ?>    
    <li class="<?php echo $classCalendardAbs; ?>"><?php echo $this->Html->link('<i class="glyphicon_beach_umbrella"></i> Absences équipe',array('controller'=>'activitesreelles','action'=>'absences'),array('escape' => false)); ?></li>
    <?php endif; ?>    
    
    <?php if (userAuth('profil_id')!='2' && (isAuthorized('messages', 'index') || isAuthorized('profils', 'index') || isAuthorized('autorisations', 'index') || isAuthorized('assistances', 'index') || isAuthorized('domaines', 'index') || isAuthorized('listediffusions', 'index') || isAuthorized('outils', 'index') || isAuthorized('dossierpartages', 'index') || isAuthorized('sections', 'index') || isAuthorized('sites', 'index') || isAuthorized('societes', 'index') || isAuthorized('typemateriels', 'index'))) : ?> 
    <li class="divider"></li>
    <li  class="dropdown-submenu  <?php echo $classAdministration; ?>"><a href="#"><i class="glyphicon_lock"></i> Administration</a>
        <ul class="dropdown-menu">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('messages', 'index')) : ?>
            <li class="<?php echo $classMessages; ?>"><?php echo $this->Html->link('Messages',array('controller'=>'messages','action'=>'index'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && (isAuthorized('profils', 'index') || isAuthorized('assistances', 'index') || isAuthorized('autorisations', 'index') || isAuthorized('domaines', 'index') || isAuthorized('listediffusions', 'index') || isAuthorized('outils', 'index') || isAuthorized('dossierpartages', 'index') || isAuthorized('sections', 'index') || isAuthorized('sites', 'index') || isAuthorized('societes', 'index') || isAuthorized('typemateriels', 'index'))) : ?> 
            <li class="divider"></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('profils', 'index')) : ?>
            <li class="<?php echo $classProfils; ?>"><?php echo $this->Html->link('Profils',array('controller'=>'profils','action'=>'index'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('autorisations', 'index')) : ?>            
            <li class="<?php echo $classAutorisations; ?>"><?php echo $this->Html->link('Autorisations',array('controller'=>'autorisations','action'=>'index','tous'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && (isAuthorized('assistances', 'index') || isAuthorized('domaines', 'index') || isAuthorized('listediffusions', 'index') || isAuthorized('outils', 'index') || isAuthorized('dossierpartages', 'index') || isAuthorized('sections', 'index') || isAuthorized('sites', 'index') || isAuthorized('societes', 'index') || isAuthorized('typemateriels', 'index'))) : ?> 
            <li class="divider"></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('assistances', 'index')) : ?>
            <li class="<?php echo $classAssistances; ?>"><?php echo $this->Html->link('Assistances',array('controller'=>'assistances','action'=>'index'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('domaines', 'index')) : ?>
            <li class="<?php echo $classDomaines; ?>"><?php echo $this->Html->link('Domaines',array('controller'=>'domaines','action'=>'index'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('listediffusions', 'index')) : ?>
            <li class="<?php echo $classListeDiffusions; ?>"><?php echo $this->Html->link('Listes de diffusion',array('controller'=>'listediffusions','action'=>'index'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('outils', 'index')) : ?>
            <li class="<?php echo $classOutils; ?>"><?php echo $this->Html->link('Outils',array('controller'=>'outils','action'=>'index'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('dossierpartages', 'index')) : ?>
            <li class="<?php echo $classDossierPartages; ?>"><?php echo $this->Html->link('Partages réseaux',array('controller'=>'dossierpartages','action'=>'index'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('sections', 'index')) : ?>
            <li class="<?php echo $classSections; ?>"><?php echo $this->Html->link('Sections',array('controller'=>'sections','action'=>'index'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('sites', 'index')) : ?>
            <li class="<?php echo $classSites; ?>"><?php echo $this->Html->link('Sites',array('controller'=>'sites','action'=>'index'),array('escape' => false)); ?></li>                        
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('societes', 'index')) : ?>
            <li class="<?php echo $classSocietes; ?>"><?php echo $this->Html->link('Sociétés',array('controller'=>'societes','action'=>'index'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('typemateriels', 'index')) : ?>
            <li class="<?php echo $classTypeMateriels; ?>"><?php echo $this->Html->link('Types de matérel',array('controller'=>'typemateriels','action'=>'index'),array('escape' => false)); ?></li>
            <?php endif; ?>
        </ul>
    </li>
    <?php endif; ?>
    <?php if (userAuth('profil_id')!='2' && (isAuthorized('utilisateurs', 'index') || isAuthorized('materielinformatiques', 'index') || isAuthorized('utiliseoutils', 'index'))) : ?> 
    <li  class="dropdown-submenu <?php echo $classLogistique; ?>"><a href="#"><i class="glyphicon_imac"></i> Logistique</a>
        <ul class="dropdown-menu">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('utilisateurs', 'index')) : ?>
            <li class="<?php echo $classUtilisateurs; ?>"><?php echo $this->Html->link('Utilisateurs',array('controller'=>'utilisateurs','action'=>'index','actif','allsections'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('materielinformatiques', 'index')) : ?>
            <li class="<?php echo $classMateriels; ?>"><?php echo $this->Html->link('Postes informatique',array('controller'=>'materielinformatiques','action'=>'index','En stock','tous','toutes'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('utiliseoutils', 'index')) : ?>
            <li class="<?php echo $classUtiliseOutils; ?>"><?php echo $this->Html->link('Ouvertures des droits',array('controller'=>'utiliseoutils','action'=>'index','tous','tous'),array('escape' => false)); ?></li>
            <?php endif; ?>
        </ul>
    </li>
    <?php endif; ?>
    <?php if (userAuth('profil_id')!='2' && (isAuthorized('contrats', 'index') || isAuthorized('projets', 'index') || isAuthorized('activites', 'index')  || isAuthorized('achats', 'index') || isAuthorized('tjmcontrats', 'index')  || isAuthorized('tjmagents', 'index') || isAuthorized('plancharges', 'index')  || isAuthorized('facturations', 'index'))) : ?>
    <li  class="dropdown-submenu <?php echo $classBudget; ?>"><a href="#"><i class="glyphicon_euro"></i> Budget</a>
        <ul class="dropdown-menu">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('contrats', 'index')) : ?>
            <li class="<?php echo $classContrats; ?>"><?php echo $this->Html->link('Contrats',array('controller'=>'contrats','action'=>'index','actif'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('projets', 'index')) : ?>
            <li class="<?php echo $classProjets; ?>"><?php echo $this->Html->link('Projets',array('controller'=>'projets','action'=>'index','actif','tous'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('activites', 'index')) : ?>
            <li class="<?php echo $classActivites; ?>"><?php echo $this->Html->link('Activités',array('controller'=>'activites','action'=>'index','actif','tous'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && (isAuthorized('achats', 'index') || isAuthorized('tjmcontrats', 'index')  || isAuthorized('tjmagents', 'index') || isAuthorized('plancharges', 'index')  || isAuthorized('facturations', 'index'))) : ?>
            <li class="divider"></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('achats', 'index')) : ?>
            <li class="<?php echo $classAchats; ?>"><?php echo $this->Html->link('Achats',array('controller'=>'achats','action'=>'index','toutes'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && (isAuthorized('tjmcontrats', 'index')  || isAuthorized('tjmagents', 'index') || isAuthorized('plancharges', 'index')  || isAuthorized('facturations', 'index'))) : ?>
            <li class="divider"></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('tjmcontrats', 'index')) : ?>
            <li class="<?php echo $classTJMProjets; ?>"><?php echo $this->Html->link('TJM Contrats',array('controller'=>'tjmcontrats','action'=>'index'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('tjmagents', 'index')) : ?>
            <li class="<?php echo $classTJMAgents; ?>"><?php echo $this->Html->link('TJM Agents',array('controller'=>'tjmagents','action'=>'index'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('plancharges', 'index')) : ?>
            <li class="divider"></li>
            <li class="<?php echo $classPlanDeCharge; ?>"><?php echo $this->Html->link('Plan de charge',array('controller'=>'plancharges','action'=>'index'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('facturations', 'index')) : ?>            
            <li class="divider"></li>
            <li  class="dropdown-submenu <?php echo $classFacturation; ?>"><a href="#">Facturation</a>
            <ul class="dropdown-menu">
                <?php if (userAuth('profil_id')!='2' && isAuthorized('contrats', 'index')) : ?>
                <li class="<?php echo $classFacturationTodo; ?>"><?php echo $this->Html->link('A facturer',array('controller'=>'activitesreelles','action'=>'afacturer'),array('escape' => false)); ?></li>
                <?php endif; ?>
                <?php if (userAuth('profil_id')!='2' && isAuthorized('contrats', 'index')) : ?>
                <li class="<?php echo $classFacturationDo; ?>"><?php echo $this->Html->link('Facturé',array('controller'=>'facturations','action'=>'index'),array('escape' => false)); ?></li>
                <?php endif; ?>
            </ul>
            </li>
            <?php endif; ?>
        </ul>
    </li>
    <?php endif; ?>
    
    <li class="divider"></li>
    <li  class="dropdown-submenu <?php echo $classRapports; ?>"><a href="#"><i class="glyphicon_charts"></i> Rapports</a>
        <ul class="dropdown-menu">
            <?php if (userAuth('profil_id')!='2' && isAuthorized('actions', 'rapports')) : ?>
            <li class="<?php echo $classCRAActions; ?>"><?php echo $this->Html->link('Actions',array('controller'=>'actions','action'=>'rapport'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('activitesreelles', 'rapports')) : ?>
            <li class="<?php echo $classCRAActivites; ?>"><?php echo $this->Html->link('Activités réelles',array('controller'=>'activitesreelles','action'=>'rapport'),array('escape' => false)); ?></li>
            <?php endif; ?>
            <?php if (userAuth('profil_id')!='2' && isAuthorized('facturations', 'rapports')) : ?>
            <li class="<?php echo $classCRAFacturations; ?>"><?php echo $this->Html->link('Facturations',array('controller'=>'facturations','action'=>'rapport'),array('escape' => false)); ?></li>            
            <?php endif; ?>
        </ul>
    </li>
    <li class="divider"></li>
    <li class="<?php echo $classContactUs; ?>"><?php echo $this->Html->link('<i class="glyphicon_envelope"></i> Nous contacter',array('controller'=>'contacts','action'=>'add'),array('escape' => false)); ?></li>
    <li class="<?php echo $classAddFavorites; ?> jQueryBookmark"><?php echo $this->Html->link('<i class="glyphicon_star"></i> Ajouter aux favoris',array('action'=>"#"),array('escape' => false)); ?></li>
    <li  class="dropdown-menu-nolink sstitre text-center">Version : <?php echo $this->element('version') ?></li>
  </ul>
</div>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
  $(".jQueryBookmark").click(function(e){
    e.preventDefault(); // this will prevent the anchor tag from going the user off to the link
    <?php 
        $root = strpos(ROOT,'/')!==false ? explode('/',ROOT) : explode('\\',ROOT);
        $last = count($root)-1;            
        $urlSite = str_replace('\\','/',FULL_BASE_URL.DS.$root[$last].DS);    
    ?>
    var bookmarkUrl = '<?php echo $urlSite; ?>';
    var bookmarkTitle = 'SNCF - OSACT';

    if (navigator.userAgent.toLowerCase().indexOf('chrome') > -1) { 
            alert("Cette fonction n'est pas disponible sur Chrome\n\r. Cliquez sur l'étoile pour ajouter cette adresse à vos favoris\n\rou utilisez le raccourci clavier Ctrl-D (Command+D pour Macs) pour créer le favoris.");      
    }else if (window.sidebar) { // For Mozilla Firefox Bookmark
        window.sidebar.addPanel(bookmarkTitle, bookmarkUrl,"");
    } else if( window.external || document.all) { // For IE Favorite
        window.external.AddFavorite( bookmarkUrl, bookmarkTitle);
    } else if(window.opera) { // For Opera Browsers
        $("a.jQueryBookmark").attr("href",bookmarkUrl);
        $("a.jQueryBookmark").attr("title",bookmarkTitle);
        $("a.jQueryBookmark").attr("rel","sidebar");
    } else { // for other browsers which does not support
         alert('Votre navigateur ne supporte pas cette fonction.');
         return false;
    }
  });
});
</script>