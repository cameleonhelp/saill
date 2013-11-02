<div class="marginright20">
<?php echo $this->Form->create('Utilisateur',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
<div class="panel-group" id="accordion">
  <div class="panel">
    <div class="panel-heading">
      <h3 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse0">
            <?php $classin = $this->params->action == 'add' ? 'in' : ''; ?>
            Identité
            <span class="pull-right badge badge-default"><?php echo h((isset($utilisateur['Utilisateur']['username']) && !empty($utilisateur['Utilisateur']['username']))) ? h($utilisateur['Utilisateur']['username']) : "Nouveau"; ?></span>
        </a>
    </div>
    <div id="collapse0" class="panel-collapse collapse <?php echo $classin ; ?>"> <!-- ajouter 'in' si on veux que le bloc soit ouvert //-->
        <div class="panel-body">
            <div class="form-group">
                <label class="col-lg-2 required" for="UtilisateurlNOM">Nom : </label>
                <div class="col-lg-4">
                    <?php echo $this->Form->input('NOM',array('data-rule-required'=>'true','class'=>'form-control','placeholder'=>'Nom de l\'utilisateur','data-msg-required'=>'Le nom de l\'utilisateur est obligatoire dans l\'onglet identité','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 required" for="UtilisateurlPRENOM">Prénom : </label>
                <div class="col-lg-4">
                    <?php echo $this->Form->input('PRENOM',array('data-rule-required'=>'true','class'=>'form-control','placeholder'=>'Prénom de l\'utilisateur','data-msg-required'=>'Le prénom de l\'utilisateur est obligatoire dans l\'onglet identité','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 required" for="UtilisateurNAISSANCE">Date de naissance : </label>
                <div class="col-lg-3" style="margin-left:15px;">
                    <div class="input-group">
                    <?php $today = new dateTime(); ?>
                    <?php echo $this->Form->input('NAISSANCE',array('type'=>'text','class'=>"form-control dateall",'placeholder'=>'ex.: '.$today->format('d/m/Y'),'data-rule-required'=>'true','data-msg-required'=>'La date de naissance de l\'utilisateur est obligatoire dans l\'onglet identité','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                    <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#UtilisateurNAISSANCE"><span class="glyphicons circle_remove grey"></span></span>
                    <span class="input-group-addon date-addon-calendar btn-addon" data-target="#UtilisateurNAISSANCE"><span class="glyphicons calendar"></span></span>
                    </div>                    
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 required" for="UtilisateurSocieteId">Société : </label>
                <div class="col-lg-3">
                    <?php if ($this->params->action == 'edit') { ?>
                        <?php echo $this->Form->select('societe_id',$societe,array('data-rule-required'=>'true','class'=>'form-control','data-msg-required'=>"Le nom de la société est obligatoire dans l'onglet identité",'selected' => $this->data['Utilisateur']['societe_id'],'empty' => 'Choisir une société')); ?>
                    <?php } else { ?>
                        <?php echo $this->Form->select('societe_id',$societe,array('data-rule-required'=>'true','class'=>'form-control','data-msg-required'=>"Le nom de la société est obligatoire dans l'onglet identité",'selected' => '','empty' => 'Choisir une société')); ?>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2" for="UtilisateurCOMMENTAIRE">Commentaire : </label>
                <div class="col-lg-10">
                <?php echo $this->Form->input('COMMENTAIRE',array('type'=>'textarea',"readonly"=>'true',"required"=>'false','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                </div>
           </div>                    
        </div>
    </div>
</div>
<?php if ($this->params->action == 'edit') : ?>
<div class="panel">
  <div class="panel-heading">
    <h3 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
          Administration
          <span class="pull-right badge badge-default">C : <?php echo h($utilisateur['Utilisateur']['CONGE']); ?> - RQ : <?php echo h($utilisateur['Utilisateur']['RQ']); ?> - VT : <?php echo h($utilisateur['Utilisateur']['VT']); ?></span>
      </a>
  </div>    
  <div id="collapse1" class="panel-collapse collapse">
      <div class="panel-body">		
          <div class="form-group">
                <label class="col-lg-2 required" for="UtilisateurSectionId">Section : </label>
                <div class="col-lg-3">
                  <?php if(userAuth('WIDEAREA')==1) : ?>
                      <?php echo $this->Form->select('section_id',$section,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le nom de la section est obligatoire dans l'onglet administration",'default' => $this->data['Utilisateur']['section_id'],'empty' => 'Choisir une section')); ?>
                  <?php else : ?>
                      <?php echo $this->data['Section']['NOM']; ?>
                  <?php endif; ?>
                </div>
          </div>
          <div class="form-group">
                <label class="col-lg-2" for="UtilisateurUtilisateurId">Hiérarchique : </label>
                <div class="col-lg-3">
                <?php if(userAuth('WIDEAREA')==1) : ?>
                    <?php echo $this->Form->select('utilisateur_id',$hierarchique,array('class'=>'form-control','default' => $this->data['Utilisateur']['utilisateur_id'],'empty' => 'Choisir un hiérarchique')); ?>
                <?php else : ?>
                    <?php echo isset($hierarchique['Utilisateur']['NOMLONG'])? $hierarchique['Utilisateur']['NOMLONG'] : ""; ?>
                <?php endif; ?>
                </div>
          </div>  
          <div class="form-group">
                <label class="col-lg-2" for="UtilisateurTjmagentId">TJM : </label>
                <div class="col-lg-3">
                <?php if(userAuth('WIDEAREA')==1) : ?>    
                    <?php echo $this->Form->select('tjmagent_id',$tjmagent,array('class'=>'form-control','default' => $this->data['Utilisateur']['tjmagent_id'],'empty' => 'Choisir un TJM pour l\'agent')); ?>
                <?php else : ?>
                    <?php echo isset($this->data['Tjmagent']['NOM'])? $this->data['Tjmagent']['NOM'] : ""; ?>
                <?php endif; ?>
                </div>
          </div>                           
          <div class="form-group">
              <label class="col-lg-2" for="UtilisateurACTIF">Actif : </label>
              <div class="col-lg-10">
                <?php echo $this->Form->input('ACTIF',array('class'=>'yesno')); ?>
                &nbsp;<label for="UtilisateurACTIF" class='labelAfter'></label>
              </div>
          </div>   
          <div class="form-group">
              <label class="col-lg-2" for="UtilisateurDATEDEBUTACTIF">Date de début de mission : </label>
                <div class="col-lg-3" style="margin-left:15px;">
                    <div class="input-group">
                    <?php $today = new dateTime(); ?>
                    <?php echo $this->Form->input('DATEDEBUTACTIF',array('type'=>'text','class'=>"form-control dateall",'placeholder'=>'ex.: '.$today->format('d/m/Y'),'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                    <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#UtilisateurDATEDEBUTACTIF"><span class="glyphicons circle_remove grey"></span></span>
                    <span class="input-group-addon date-addon-calendar btn-addon" data-target="#UtilisateurDATEDEBUTACTIF"><span class="glyphicons calendar"></span></span>
                    </div>                    
                </div>
          </div>             
          <div class="form-group">
              <label class="col-lg-2" for="UtilisateurFINMISSION">Date de fin de mission : </label>
                <div class="col-lg-3" style="margin-left:15px;">
                    <div class="input-group">
                    <?php $today = new dateTime(); ?>
                    <?php echo $this->Form->input('FINMISSION',array('type'=>'text','class'=>"form-control dateall",'placeholder'=>'ex.: '.$today->format('d/m/Y'),'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                    <span class="input-group-addon addon-middle date-addon-clean btn-addon" data-target="#UtilisateurFINMISSION"><span class="glyphicons circle_remove grey"></span></span>
                    <span class="input-group-addon addon-middle date-addon-default btn-addon" data-target="#UtilisateurFINMISSION" data-default="<?php echo "05/01/".(date('Y')+1); ?>"><span class="glyphicons clock"></span></span>
                    <span class="input-group-addon date-addon-calendar btn-addon" data-target="#UtilisateurFINMISSION"><span class="glyphicons calendar"></span></span>
                    </div>                    
                </div>
          </div>                        
          <div class="form-group">
              <label class="col-lg-2" for="UtilisateurWORKCAPACITY">Capacité de travail : </label>
              <div class="col-lg-2">
                  <?php echo $this->Form->select('WORKCAPACITY',$workcapacite,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"La capacité de travail est obligatoire dans l'onglet administration",'default' => $this->data['Utilisateur']['WORKCAPACITY'])); ?>
              </div>
          </div>  
          <?php if(userAuth('WIDEAREA')==1) : ?>
          <div class="form-group">
                <label class="col-lg-2" for="UtilisateurHIERARCHIQUE">Est hiérarchique : </label>
                <div class="col-lg-4">
                    <?php echo $this->Form->input('HIERARCHIQUE',array('class'=>'yesno')); ?>
                    &nbsp;<label for="UtilisateurHIERARCHIQUE" class='labelAfter'></label>
                </div>
          </div>  
          <div class="form-group">
                <label class="col-lg-2" for="UtilisateurWIDEAREA">Périmètre étendu : </label>
                <div class="col-lg-4">
                    <?php echo $this->Form->input('WIDEAREA',array('class'=>'yesno')); ?>
                    &nbsp;<label for="UtilisateurWIDEAREA" class='labelAfter'></label>
                </div>
          </div>    
          <?php endif; ?>          
          <div class="form-group">
                <label class="col-lg-2" for="UtilisateurCONGE">Congés : </label>
                <div class="col-lg-4">
                    <?php echo $this->Form->input('CONGE',array('class'=>'form-control size-fix-50')); ?>
                </div>
          </div>  
          <div class="form-group">
              <label class="col-lg-2" for="UtilisateurRQ">RQ : </label>
              <div class="col-lg-10">
                  <?php echo $this->Form->input('RQ',array('class'=>'form-control size-fix-50')); ?>
              </div>
          </div>                      
          <div class="form-group">
              <label class="col-lg-2" for="UtilisateurVT">VT (temps partiel) : </label>
              <div class="col-lg-10">
                  <?php echo $this->Form->input('VT',array('class'=>'form-control size-fix-50')); ?>&nbsp;<button class='btn btn-sm btn-default pull-right' rel='tooltip' data-title="Pensez à remettre les valeurs<br>par défaut avant de faire<br>la mise à jour de vos compteurs." id='updateCompteur'>Mettre à jour compteurs</button>
              </div>
          </div>                          
          <?php echo $this->element('suiviCongesAgent'); ?>
      </div>
  </div>
</div>
<div class="panel">
  <div class="panel-heading">
    <h3 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        Logistique
        <span class="pull-right badge badge-default">Matériel : <?php echo h($nbDotation[0][0]['nbDotation']); ?></span>
    </a>
</div>
<div id="collapse2" class="panel-collapse collapse">
    <div class="panel-body">
        <div class="form-group">
            <label class="col-lg-2 required" for="UtilisateurProfilId">Profil : </label>
            <div class="col-lg-3">
                <?php if(userAuth('WIDEAREA')==1) : ?>
                    <?php echo $this->Form->select('profil_id',$profil,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le profil est obligatoire dans l'onglet logistique",'default' => $this->data['Utilisateur']['profil_id'],'empty' => 'Choisir un profil')); ?>
                <?php else : ?>
                    <?php echo isset($this->data['Profil']['NOM'])? $this->data['Profil']['NOM'] : ""; ?>
                <?php endif; ?> 
            </div>
        </div>  
        <div class="form-group">
            <label class="col-lg-2 required" for="UtilisateurAssistanceId">Assistance : </label>
            <div class="col-lg-3">
                <?php if(userAuth('WIDEAREA')==1) : ?>    
                    <?php echo $this->Form->select('assistance_id',$assistance,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"L'assistance est obligatoire dans l'onglet logistique",'default' => $this->data['Utilisateur']['assistance_id'],'empty' => 'Choisir une assistance')); ?>
                <?php else : ?>
                    <?php echo isset($this->data['Assistance']['NOM'])? $this->data['Assistance']['NOM'] : ""; ?>
                <?php endif; ?> 
            </div>
        </div>  
        <div class="form-group">
            <label class="col-lg-2 required" for="UtilisateurSiteId">Site : </label>
            <div class="col-lg-3">
                <?php echo $this->Form->select('site_id',$site,array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le site est obligatoire dans l'onglet logistique",'default' => $this->data['Utilisateur']['site_id'],'empty' => 'Choisir un site')); ?>
            </div>
        </div> 
        <div class="form-group">
            <label class="col-lg-2" for="UtilisateurUsername">Identifiant (login) : </label>
            <div class="col-lg-10">
                <?php echo $this->Form->input('username',array('class'=>'form-control size-fix-150')); ?>
            </div>
        </div>  
        <div class="form-group">
            <label class="col-lg-2" for="UtilisateurMAIL">Email : </label>
            <div class="col-lg-10">
                <?php echo $this->Form->input('MAIL',array('class'=>'form-control size50')); ?>
            </div>
        </div>                      
        <div class="form-group">
            <label class="col-lg-2" for="UtilisateurTELEPHONE">Téléphone : </label>
            <div class="col-lg-10">
                <?php echo $this->Form->input('TELEPHONE',array('class'=>'form-control size-fix-150')); ?>
            </div>
        </div>  
        <?php if(userAuth('WIDEAREA')==1) : ?>
        <div class="form-group">
            <label class="col-lg-2" for="UtilisateurGESTIONABSENCES">Utilise le gestionnaire d'absence et plan de charge : </label>
            <div class="col-lg-4">
                <?php echo $this->Form->input('GESTIONABSENCES',array('class'=>'yesno')); ?>
                &nbsp;<label for="UtilisateurGESTIONABSENCES" class='labelAfter'></label>
            </div>
        </div>  
        <?php endif;  ?>                           
        <hr/>
        <?php if(isAuthorized('dotations', 'myprofil') || isAuthorized('dotations', 'add')): ?>
        <?php $userid = $this->params->action ==  'edit' ? $this->data['Utilisateur']['id'] : userAuth('id'); ?>
        <button type="button" class='btn btn-sm btn-default pull-right' onclick="location.href='<?php echo $this->Html->url('/dotations/add/'.$userid); ?>';">Ajouter une dotation</button><br>                   
        <?php endif; ?>                    
        <label class="sstitre">Liste des dotations</label>   
        <?php echo $this->element('tableDotation'); ?>
    </div>
</div>
</div> 
<div class="panel">
  <div class="panel-heading">
    <h3 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
        Affectation
        <span class="pull-right badge badge-default">Activités : <?php echo h($nbAffectation[0][0]['nbAffectation']); ?></span>
        </a>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="form-group">
                <label class="col-lg-2" for="UtilisateurDomaineId">Domaine : </label>
                <div class="col-lg-3">                            
                    <?php echo $this->Form->select('domaine_id',$domaine,array('class'=>'form-control','default' => $this->data['Utilisateur']['domaine_id'],'empty' => 'Choisir un domaine')); ?>
                </div>
            </div><hr/>
            <?php if(isAuthorized('affectations', 'add')): ?>
            <span  class='pull-right' style="margin-bottom:10px;">
            <button type="button" class='btn btn-sm btn-default' onclick="location.href='<?php echo $this->Html->url('/affectations/addIndisponibilite/'.$this->data['Utilisateur']['id']); ?>';">Ajouter indisponibilités</button>&nbsp;
            <button type="button" class='btn btn-sm btn-default' onclick="location.href='<?php echo $this->Html->url('/affectations/add/'.$this->data['Utilisateur']['id']); ?>';">Ajouter une activité</button>    
            </span>
            <?php endif; ?>            
            <label class="sstitre">Liste des activités</label> 
            <?php echo $this->element('tableAffectation'); ?>
        </div>
    </div>
</div>   
<div class="panel">
  <div class="panel-heading">
    <h3 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
        Ouverture des droits
        <span class="pull-right badge badge-default">Outils : <?php echo h($compteurs[0][0]['nboutil']); ?> - Partages : <?php echo h($compteurs[0][0]['nbpartage']); ?> - Listes de diffusion : <?php echo h($compteurs[0][0]['nbliste']); ?></span>
        </a>
    </div>
    <div id="collapse4" class="panel-collapse collapse">
        <div class="panel-body">
            <?php if(isAuthorized('utiliseoutils', 'add')) : ?>
            <button type="button" style="margin-bottom:10px;" class='btn btn-sm btn-default pull-right' onclick="location.href='<?php echo $this->Html->url('/utiliseoutils/add/'.$this->data['Utilisateur']['id']); ?>';">Ajouter une ouverture de droit</button>                    
            <?php endif; ?>            
            <label class="sstitre">Liste des droits et état avancement des demandes à mettre dans un tableau</label> 
            <?php echo $this->element('tableUtiliseOutil'); ?>
        </div>
    </div>
</div> 
<div class="panel">
  <div class="panel-heading">
    <h3 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
            Historique
            </a>
        </div>
        <div id="collapse5" class="panel-collapse collapse">
            <div class="panel-body">
                <?php echo $this->element('tableHistoryUtilisateur'); ?>
            </div>
        </div>
    </div> 
</div>  
<?php endif; ?>
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn btn-sm btn-default showoverlay','onclick'=>"location.href='".  goPrev()    ."'")); ?>&nbsp;
            <?php if ($this->params->action == 'edit') : ?>
                <?php echo $this->Html->link('Notifier Gest. Annuaire', array('controller'=>'utilisateurs','action'=>'sendmailgestannuaire',$this->data['Utilisateur']['id']), array('class' => 'btn btn-sm btn-default showoverlay')); ?>&nbsp;
            <?php endif; ?>            
            <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>     
<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>    
<?php echo $this->Form->end(); ?>
</div>