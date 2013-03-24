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
                                <?php echo $this->Form->select('societe_id',$societe,array('data-rule-required'=>'true','data-msg-required'=>"Le nom de la société est obligatoire dans l'onglet identité",'selected' => $this->data['Utilisateur']['societe_id'],'empty' => 'Choisir une société')); ?>
                            <?php } else { ?>
                                <?php echo $this->Form->select('societe_id',$societe,array('data-rule-required'=>'true','data-msg-required'=>"Le nom de la société est obligatoire dans l'onglet identité",'selected' => '','empty' => 'Choisir une société')); ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurCOMMENTAIRE">Commentaire : </label>
                        <div class="controls">
                            <?php echo $this->Form->input('COMMENTAIRE',array('type'=>'textarea',"readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
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
                            <?php echo $this->data['Section']['NOM']; ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurUtilisateurId">Hiérarchique : </label>
                        <div class="controls">
                            <?php echo $this->data['Utilisateur']['utilisateur_id']; ?>
                        </div>
                    </div>  
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurPasswordNew">Mot de passe : </label>
                        <div class="controls">
                            <?php echo $this->Form->input('password_new',array('type'=>'password','data-rule-minlength'=>'5','data-msg-minlength'=>"Le mot de passe doit avoir au moins 5 caractères",'placeholder'=>'Mot de passe')); ?>
                            &nbsp;<label class="sstitre horizontal form-inline" for="UtilisateurPassword">Confirmation </label>
                            <?php echo $this->Form->input('password_confirm',array('type'=>'password','data-rule-equalto'=>'#UtilisateurPasswordNew','data-msg-equalto'=>"Les mots de passe ne sont pas identiques",'placeholder'=>'Confirmation du mot de passe','value'=>'')); ?>    
                        </div>
                    </div>                      
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurACTIF">Actif : </label>
                        <div class="controls">
                            <?php echo $this->data['Utilisateur']['ACTIF'] ? 'Oui' : 'Non'; ?>
                        </div>
                    </div>                 
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurFINMISSION">Date de fin de mission : </label>
                        <div class="controls">
                            <?php echo empty($this->data['Utilisateur']['FINMISSION']) ? '' : $this->data['Utilisateur']['FINMISSION']; ?>
                        </div>
                    </div>                        
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurWORKCAPACITY">Capacité de travail : </label>
                        <div class="controls">
                            <?php echo $this->data['Utilisateur']['WORKCAPACITY']; ?> %
                        </div>
                    </div>                           
                     <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurHIERARCHIQUE">Est hiérarchique : </label>
                        <div class="controls">
                            <?php echo $this->data['Utilisateur']['HIERARCHIQUE'] ? 'Oui' : 'Non'; ?>
                        </div>
                    </div>  
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
                            <?php echo $this->data['Profil']['NOM']; ?>
                        </div>
                    </div>  
                    <div class="control-group">
                        <label class="control-label sstitre required" for="UtilisateurAssistanceId">Assistance : </label>
                        <div class="controls">
                            <?php echo $this->data['Assistance']['NOM']; ?>
                        </div>
                    </div>  
                    <div class="control-group">
                        <label class="control-label sstitre required" for="UtilisateurSiteId">Site : </label>
                        <div class="controls">
                            <?php echo $this->data['Site']['NOM']; ?>
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
                    <div class="control-group">
                        <label class="control-label sstitre" for="UtilisateurGESTIONABSENCES">Utilise le gestionnaire d'absence et plan de charge : </label>
                        <div class="controls">
                            <?php echo $this->data['Utilisateur']['GESTIONABSENCES'] ? 'Oui' : 'Non'; ?>
                        </div>
                    </div>                      
                    <hr/>
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
                            <?php echo $this->data['Domaine']['NOM']; ?>
                        </div>
                    </div><hr/>
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
    </div>    
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php $url = array('controller'=>'pages','action'=>'home'); ?>
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn','onclick'=>"location.href='".$this->Html->url($url)."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
            </div>
        </div>
    </div> 
<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>