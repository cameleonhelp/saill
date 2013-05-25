<?php echo $this->Form->create('Utilisateur',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
<!--<div class="btn-group pull-right" data-toggle="buttons-radio">
    <button class="btn" id="expand" onclick="$('.collapse').collapse('show');return false;"><i class="icon-resize-full"></i></button>
    <button class="btn btn-inverse disabled" id="collapse" onclick="$('.collapse').collapse('hide');return false;"><i class="icon-resize-small icon-white"></i></button>
    </div>//-->
<div class="accordion" style="clear:both;" id="accordion2" name="accordion2">
        <div class="accordion-group">
            <?php $classin = $this->params->action == 'add' ? 'in' : ''; ?>
            <div class="accordion-heading"> 
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse0">
                Identité
                <span class="pull-right"><?php echo h((isset($utilisateur['Utilisateur']['username']) && !empty($utilisateur['Utilisateur']['username']))) ? h($utilisateur['Utilisateur']['username']) : "Nouveau"; ?></span>
                </a>
            </div>
            <div id="collapse0" class="accordion-body collapse <?php echo $classin ; ?>"> <!-- ajouter 'in' si on veux que le bloc soit ouvert //-->
                <div class="accordion-inner">
                    <div class="control-group">
                        <label class="control-label sstitre  required" for="UtilisateurlNOM">Nom : </label>
                        <div class="controls">
                            <?php echo $this->Form->input('NOM',array('data-rule-required'=>'true','placeholder'=>'Nom de l\'utilisateur','class'=>'span8','data-msg-required'=>'Le nom de l\'utilisateur est obligatoire dans l\'onglet identité','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label sstitre  required" for="UtilisateurlPRENOM">Prénom : </label>
                        <div class="controls">
                            <?php echo $this->Form->input('PRENOM',array('data-rule-required'=>'true','placeholder'=>'Prénom de l\'utilisateur','class'=>'span8','data-msg-required'=>'Le prénom de l\'utilisateur est obligatoire dans l\'onglet identité','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label sstitre  required" for="UtilisateurNAISSANCE">Date de naissance : </label>
                        <div class="controls">
                            <div class="input-append date" data-date="<?php echo empty($this->data['Utilisateur']['NAISSANCE']) ? date('d/m/Y') : $this->data['Utilisateur']['NAISSANCE']; ?>" data-date-format="dd/mm/yyyy">
                            <?php $today = date('d/m/Y'); ?>
                            <?php echo $this->Form->input('NAISSANCE',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true','data-rule-required'=>'true','data-msg-required'=>'La date de naissance de l\'utilisateur est obligatoire dans l\'onglet identité','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
                            <span class="add-on"><i class="glyphicon_calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label sstitre  required" for="UtilisateurSocieteId">Société : </label>
                        <div class="controls">
                            <?php if ($this->params->action == 'edit') { ?>
                                <?php echo $this->Form->select('societe_id',$societe,array('data-rule-required'=>'true','data-msg-required'=>"Le nom de la société est obligatoire dans l'onglet identité",'default' => $this->data['Utilisateur']['societe_id'],'empty' => 'Choisir une société')); ?>
                            <?php } else { ?>
                                <?php echo $this->Form->select('societe_id',$societe,array('data-rule-required'=>'true','data-msg-required'=>"Le nom de la société est obligatoire dans l'onglet identité",'default' => '','empty' => 'Choisir une société')); ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurCOMMENTAIRE">Commentaire : </label>
                        <div class="controls">
                            <?php echo $this->Form->input('COMMENTAIRE',array('type'=>'textarea',"readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                        </div>
                    </div>  
                    <?php if($this->params->action=="add" && userAuth('profil_id')<6 && isAuthorized('utilisateurs', 'add')): ?>
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurProfilId"></label>
                        <div class="controls">
                            <?php echo $this->Form->input('profil_id',array('type'=>'checkbox','value'=>'-1')); ?>&nbsp;<label class='labelAfter' for="UtilisateurProfilId">Compte générique</label>
                        </div>
                    </div>  
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php if ($this->params->action == 'edit') { ?>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse1">
                Administration
                <span class="pull-right">C : <?php echo h($utilisateur['Utilisateur']['CONGE']); ?> - RQ : <?php echo h($utilisateur['Utilisateur']['RQ']); ?> - VT : <?php echo h($utilisateur['Utilisateur']['VT']); ?></span>
                </a>
            </div>
            <div id="collapse1" class="accordion-body collapse">
                <div class="accordion-inner">		
                    <div class="control-group">
                        <label class="control-label sstitre  required" for="UtilisateurSectionId">Section : </label>
                        <div class="controls">
                        <?php if(userAuth('WIDEAREA')==1) : ?>
                            <?php echo $this->Form->select('section_id',$section,array('data-rule-required'=>'true','data-msg-required'=>"Le nom de la section est obligatoire dans l'onglet administration",'default' => $this->data['Utilisateur']['section_id'],'empty' => 'Choisir une section')); ?>
                        <?php else : ?>
                            <?php echo $this->data['Section']['NOM']; ?>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurUtilisateurId">Hiérarchique : </label>
                        <div class="controls">
                        <?php if(userAuth('WIDEAREA')==1) : ?>
                            <?php echo $this->Form->select('utilisateur_id',$hierarchique,array('default' => $this->data['Utilisateur']['utilisateur_id'],'empty' => 'Choisir un hiérarchique')); ?>
                        <?php else : ?>
                            <?php echo isset($hierarchique['Utilisateur']['NOMLONG'])? $hierarchique['Utilisateur']['NOMLONG'] : ""; ?>
                        <?php endif; ?>
                        </div>
                    </div>  
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurTjmagentId">TJM : </label>
                        <div class="controls">
                        <?php if(userAuth('WIDEAREA')==1) : ?>    
                            <?php echo $this->Form->select('tjmagent_id',$tjmagent,array('default' => $this->data['Utilisateur']['tjmagent_id'],'empty' => 'Choisir un TJM pour l\'agent')); ?>
                        <?php else : ?>
                            <?php echo isset($this->data['Tjmagent']['NOM'])? $this->data['Tjmagent']['NOM'] : ""; ?>
                        <?php endif; ?>
                        </div>
                    </div>                      
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurACTIF">Actif : </label>
                        <div class="controls">
                            <?php echo $this->Form->input('ACTIF',array('class'=>'yesno')); ?>
                            &nbsp;<label class='labelAfter'></label>
                        </div>
                    </div>                 
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurFINMISSION">Date de fin de mission : </label>
                        <div class="controls">
                            <div class="input-append date" data-date="<?php echo empty($this->data['Utilisateur']['FINMISSION']) ? date('d/m/Y') : $this->data['Utilisateur']['FINMISSION']; ?>" data-date-format="dd/mm/yyyy">
                            <?php $today = date('d/m/Y'); ?>
                            <?php echo $this->Form->input('FINMISSION',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
                            <button class="btninput datedefault" type="button" id="default" name="default" rel="tooltip" title="Date par défaut :<br/><?php echo "05/01/".(date('Y')+1); ?>"><i class="icon-flag"></i></button>
                            <span class="add-on"><i class="glyphicon_calendar"></i></span>
                            </div>
                        </div>
                    </div>                        
                    <div class="control-group">
                        <label class="control-label sstitre required" for="UtilisateurWORKCAPACITY">Capacité de travail : </label>
                        <div class="controls">
                            <?php echo $this->Form->select('WORKCAPACITY',$workcapacite,array('data-rule-required'=>'true','data-msg-required'=>"La capacité de travail est obligatoire dans l'onglet administration",'default' => $this->data['Utilisateur']['WORKCAPACITY'])); ?>
                        </div>
                    </div>   
                    <?php if(userAuth('WIDEAREA')==1) : ?>
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurHIERARCHIQUE">Est hiérarchique : </label>
                        <div class="controls">
                            <?php echo $this->Form->input('HIERARCHIQUE',array('class'=>'yesno')); ?>
                            &nbsp;<label class='labelAfter'></label>
                        </div>
                    </div>  
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurWIDEAREA">Périmètre étendu : </label>
                        <div class="controls">
                            <?php echo $this->Form->input('WIDEAREA',array('class'=>'yesno')); ?>
                            &nbsp;<label class='labelAfter'></label>
                        </div>
                    </div>    
                    <?php endif; ?>
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurCONGE">Congés : </label>
                        <div class="controls">
                            <?php echo $this->Form->input('CONGE'); ?>
                        </div>
                    </div>  
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurRQ">RQ : </label>
                        <div class="controls">
                            <?php echo $this->Form->input('RQ'); ?>
                        </div>
                    </div>                      
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurVT">VT (temps partiel) : </label>
                        <div class="controls">
                            <?php echo $this->Form->input('VT'); ?>
                        </div>
                    </div>                          
                    <?php echo $this->element('suiviCongesAgent'); ?>
                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2">
                Logistique
                <span class="pull-right">Matériel : <?php echo h($nbDotation[0][0]['nbDotation']); ?></span>
                </a>
            </div>
            <div id="collapse2" class="accordion-body collapse">
                <div class="accordion-inner">
                    <div class="control-group">
                        <label class="control-label sstitre required" for="UtilisateurProfilId">Profil : </label>
                        <div class="controls">
                        <?php if(userAuth('WIDEAREA')==1) : ?>
                            <?php echo $this->Form->select('profil_id',$profil,array('data-rule-required'=>'true','data-msg-required'=>"Le profil est obligatoire dans l'onglet logistique",'default' => $this->data['Utilisateur']['profil_id'],'empty' => 'Choisir un profil')); ?>
                        <?php else : ?>
                            <?php echo isset($this->data['Profil']['NOM'])? $this->data['Profil']['NOM'] : ""; ?>
                        <?php endif; ?>                        
                        </div>
                    </div>  
                    <div class="control-group">
                        <label class="control-label sstitre required" for="UtilisateurAssistanceId">Assistance : </label>
                        <div class="controls">
                        <?php if(userAuth('WIDEAREA')==1) : ?>    
                            <?php echo $this->Form->select('assistance_id',$assistance,array('data-rule-required'=>'true','data-msg-required'=>"L'assistance est obligatoire dans l'onglet logistique",'default' => $this->data['Utilisateur']['assistance_id'],'empty' => 'Choisir une assistance')); ?>
                        <?php else : ?>
                            <?php echo isset($this->data['Assistance']['NOM'])? $this->data['Assistance']['NOM'] : ""; ?>
                        <?php endif; ?>                        
                        </div>
                    </div>  
                    <div class="control-group">
                        <label class="control-label sstitre required" for="UtilisateurSiteId">Site : </label>
                        <div class="controls">
                            <?php echo $this->Form->select('site_id',$site,array('data-rule-required'=>'true','data-msg-required'=>"Le site est obligatoire dans l'onglet logistique",'default' => $this->data['Utilisateur']['site_id'],'empty' => 'Choisir un site')); ?>
                        </div>
                    </div> 
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurUsername">Identifiant (login) : </label>
                        <div class="controls">
                            <?php echo $this->Form->input('username'); ?>
                        </div>
                    </div>  
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurMAIL">Email : </label>
                        <div class="controls">
                            <?php echo $this->Form->input('MAIL'); ?>
                        </div>
                    </div>                      
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurTELEPHONE">Téléphone : </label>
                        <div class="controls">
                            <?php echo $this->Form->input('TELEPHONE'); ?>
                        </div>
                    </div>  
                    <?php if(userAuth('WIDEAREA')==1) : ?>
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurGESTIONABSENCES">Utilise le gestionnaire d'absence et plan de charge : </label>
                        <div class="controls">
                            <?php echo $this->Form->input('GESTIONABSENCES',array('class'=>'yesno')); ?>
                            &nbsp;<label class='labelAfter'></label>
                        </div>
                    </div>  
                    <?php endif;  ?>
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurDATEDEBUTACTIF">Date de début du compte actif : </label>
                        <div class="controls">
                            <div class="input-append date" data-date="<?php echo empty($this->data['Utilisateur']['DATEDEBUTACTIF']) ? date('d/m/Y') : $this->data['Utilisateur']['DATEDEBUTACTIF']; ?>" data-date-format="dd/mm/yyyy">
                            <?php $today = date('d/m/Y'); ?>
                            <?php echo $this->Form->input('DATEDEBUTACTIF',array('type'=>'text','placeholder'=>'ex.: '.$today,'class'=>"span5","readonly"=>'true','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                            <button class="btninput dateremove" type="button" id="remove" name="remove" rel="tooltip" data-title="Effacer la date"><i class="glyphicon_remove_only"></i></button>
                            <span class="add-on"><i class="glyphicon_calendar"></i></span>
                            </div>
                        </div>
                    </div> 
                    <hr/>
                    <?php if(isAuthorized('dotations', 'add')): ?>
                    <button type="button" class='btn btn-inverse pull-right' onclick="location.href='<?php echo $this->Html->url('/dotations/add/'.$this->data['Utilisateur']['id']); ?>';">Ajouter une dotation</button>                    
                    <?php endif; ?>
                    <label class="sstitre">Liste des dotations</label>   
                    <?php echo $this->element('tableDotation'); ?>
                </div>
            </div>
        </div> 
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse3">
                Affectation
                <span class="pull-right">Activités : <?php echo h($nbAffectation[0][0]['nbAffectation']); ?></span>
                </a>
            </div>
            <div id="collapse3" class="accordion-body collapse">
                <div class="accordion-inner">
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurDomaineId">Domaine : </label>
                        <div class="controls">                            
                            <?php echo $this->Form->select('domaine_id',$domaine,array('default' => $this->data['Utilisateur']['domaine_id'],'empty' => 'Choisir un domaine')); ?>
                        </div>
                    </div><hr/>
                    <?php if(isAuthorized('affectations', 'add')): ?>
                    <span  class='pull-right'>
                    <button type="button" class='btn btn-inverse' onclick="location.href='<?php echo $this->Html->url('/affectations/addIndisponibilite/'.$this->data['Utilisateur']['id']); ?>';">Ajouter indisponibilités</button>&nbsp;
                    <button type="button" class='btn btn-inverse' onclick="location.href='<?php echo $this->Html->url('/affectations/add/'.$this->data['Utilisateur']['id']); ?>';">Ajouter une activité</button>    
                    </span>
                    <?php endif; ?>
                    <label class="sstitre"><h4>Liste des activités</h4></label> 
                    <?php echo $this->element('tableAffectation'); ?>
                </div>
            </div>
        </div>   
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse4">
                Ouverture des droits
                <span class="pull-right">Outils : <?php echo h($compteurs[0][0]['nboutil']); ?> - Partages : <?php echo h($compteurs[0][0]['nbpartage']); ?> - Listes de diffusion : <?php echo h($compteurs[0][0]['nbliste']); ?></span>
                </a>
            </div>
            <div id="collapse4" class="accordion-body collapse">
                <div class="accordion-inner">
                    <?php if(isAuthorized('utiliseoutils', 'add')) : ?>
                    <button type="button" class='btn btn-inverse pull-right' onclick="location.href='<?php echo $this->Html->url('/utiliseoutils/add/'.$this->data['Utilisateur']['id']); ?>';">Ajouter une ouverture de droit</button>                    
                    <?php endif; ?>
                    <label class="sstitre">Liste des droits et état avancement des demandes à mettre dans un tableau</label> 
                    <?php echo $this->element('tableUtiliseOutil'); ?>
                </div>
            </div>
        </div> 
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse5">
                Historique
                </a>
            </div>
            <div id="collapse5" class="accordion-body collapse">
                <div class="accordion-inner">
                    <?php echo $this->element('tableHistoryUtilisateur'); ?>
                </div>
            </div>
        </div> 
    <?php } ?>
    </div>    
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".goPrev()."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
            </div>
        </div>
    </div> 
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>