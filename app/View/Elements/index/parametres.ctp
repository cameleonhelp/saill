<?php /* Changer le mot de passe administrateur */ ?>
<?php echo $this->Form->create('Utilisateur',array('action'=>'saveAdmPassword','role'=>'form','id'=>'formValidate','class'=>'form-inline','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group" style="width:98%">
        <label class="col-md-2 required" for="UtilisateurPasswordNew">Mot de passe administrateur : </label>
        <div class="col-md-offset-2">
         <?php echo $this->Form->input('password_new',array('class'=>'form-control','style'=>'width:200px;','type'=>'password','data-rule-required'=>'true','data-msg-required'=>"Le mot de passe est obligatoire",'data-rule-minlength'=>'5','data-msg-minlength'=>"Le mot de passe doit avoir au moins 5 caractères",'placeholder'=>'Mot de passe')); ?>
         <label class="required" for="UtilisateurPasswordConfirm">Confirmation </label>
         <?php echo $this->Form->input('password_confirm',array('class'=>'form-control','style'=>'width:200px;','type'=>'password','data-rule-equalto'=>'#UtilisateurPasswordNew','data-msg-equalto'=>"Les mots de passe ne sont pas identiques",'placeholder'=>'Confirmation','value'=>'')); ?>    
         <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>
         </div>
    </div>
<?php echo $this->Form->input('id',array('type'=>'hidden','value'=>1)); ?>
<?php echo $this->Form->end(); ?> 
<div class="marginbottom15"></div>
<?php /* Initialiser le mot de passe administrateur */ ?>
<?php echo $this->Form->create('Utilisateur',array('action'=>'initadminpassword','id'=>'formValidate','class'=>'form-inline','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group" style="width:98%">
        <label class="col-md-2" for="UtilisateurPasswordInit">Initialiser le mot de passe administrateur : </label>
        <div class="col-md-offset-2">
        <?php echo $this->Form->button('Initialiser', array('class' => 'btn btn-sm btn-primary','id'=>'UtilisateurPasswordInit','type'=>'submit')); ?>
        </div>
    </div> 
<?php echo $this->Form->input('id',array('type'=>'hidden','value'=>1)); ?>
<?php echo $this->Form->end(); ?> 
<div class="marginbottom15"></div>
<?php /* Gérer url MINIDOC */ ?>
<?php echo $this->Form->create('Parameter',array('action'=>'saveParam','id'=>'formValidate2','class'=>'form-inline','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group" style="width:98%">
        <label class="col-md-2" for="ParameterMinidoc">URL Minidoc : </label>
        <div class="col-md-offset-2">
            <?php echo $this->Form->input('param',array('class'=>'form-control','id'=>'ParameterMinidoc','style'=>'width:86%;','type'=>'text','placeholder'=>'url de Minidoc','value'=>$urlminidoc['Parameter']['param'],'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>
        </div> 
    </div>
<?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$urlminidoc['Parameter']['id'])); ?>
<?php echo $this->Form->end(); ?>
<div class="marginbottom15"></div>
<?php /* Gérer contact Webmaster */ ?>
<!--
<?php echo $this->Form->create('Parameter',array('action'=>'saveParam','id'=>'formValidate3','class'=>'form-inline','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group" style="width:98%">
        <label class="col-md-2" for="ParameterContact">Email contact : </label>
        <div class="col-md-offset-2">
            <?php echo $this->Form->input('param',array('class'=>'form-control','id'=>'ParameterContact','style'=>'width:86%;','type'=>'text','placeholder'=>'Email du contact','value'=>$contact['Parameter']['param'],'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>
        </div> 
    </div>
<?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$contact['Parameter']['id'])); ?>
<?php echo $this->Form->end(); ?>
<div class="marginbottom15"></div>
<?php /* Gérer version du site à la place du fichier version dans elements */ ?>
<?php echo $this->Form->create('Parameter',array('action'=>'saveParam','id'=>'formValidate4','class'=>'form-inline','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group" style="width:98%">
        <label class="col-md-2" for="ParameterVersion">Version : </label>
        <div class="col-md-offset-2">
            <?php echo $this->Form->input('param',array('class'=>'form-control','id'=>'ParameterVersion','style'=>'width:86%;','type'=>'text','placeholder'=>'N° de version','value'=>$version['Parameter']['param'],'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>
        </div> 
    </div>
<?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$version['Parameter']['id'])); ?>
<?php echo $this->Form->end(); ?>
<div class="marginbottom15"></div>
//-->
<?php /* Gérer l'instance du site */ ?>
<?php echo $this->Form->create('Parameter',array('action'=>'saveParam','id'=>'formValidate5','class'=>'form-inline','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group" style="width:98%">
        <label class="col-md-2" for="ParameterInstance">Instance : </label>
        <div class="col-md-offset-2">
            <?php $instances = array('DEV'=>'DEVELOPPEMENT','INT'=>'INTEGRATION','DEMO'=>'DEMONSTRATION','FORM'=>'FORMATION','BAC'=>'BAC A SABLE','PROD'=>'PRODUCTION'); ?>
            <?php echo $this->Form->select('param', $instances,array('class'=>'form-control','id'=>'ParameterInstance','style'=>'width:30%;','empty' => 'Choisir une instance...','default'=>$instance['Parameter']['param'])); ?>
            <?php //echo $this->Form->input('param',array('type'=>'text','placeholder'=>'Instance','value'=>$instance['Parameter']['param'],'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>
        </div> 
    </div>
<?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$instance['Parameter']['id'])); ?>
<?php echo $this->Form->end(); ?>
<div class="marginbottom15"></div>
<!--
<?php /* Gérer le gestionnaire d'annuaire */ ?>
<?php echo $this->Form->create('Parameter',array('action'=>'saveParam','id'=>'formValidate6','class'=>'form-inline','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group" style="width:98%">
        <label class="col-md-2" for="ParameterGestAnnu">Email du gestionnaire d'annuaire : </label>
        <div class="col-md-offset-2">
            <?php echo $this->Form->input('param',array('class'=>'form-control','id'=>'ParameterGestAnnu','style'=>'width:86%;','type'=>'text','placeholder'=>'Gestionnaire d\'annuaire','value'=>$annuaire['Parameter']['param'],'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>
        </div> 
    </div>
<?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$annuaire['Parameter']['id'])); ?>
<?php echo $this->Form->end(); ?>  
<div class="marginbottom15"></div>
<?php /* Gérer le valideur d'outil */ ?>
<?php echo $this->Form->create('Parameter',array('action'=>'saveParam','id'=>'formValidate7','class'=>'form-inline','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group" style="width:98%">
        <label class="col-md-2" for="ParameterValideur">Email du valideur d'outil : </label>
        <div class="col-md-offset-2">
            <?php echo $this->Form->input('param',array('class'=>'form-control','id'=>'ParameterValideur','style'=>'width:86%;','type'=>'text','placeholder'=>'Service manager','value'=>$valoutil['Parameter']['param'],'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>
        </div> 
    </div>
<?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$valoutil['Parameter']['id'])); ?>
<?php echo $this->Form->end(); ?> 
<div class="marginbottom15"></div>
<?php /* Gérer le valideur d'outil */ ?>
<?php echo $this->Form->create('Parameter',array('action'=>'saveParam','id'=>'formValidate8','class'=>'form-inline','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group" style="width:98%">
        <label class="col-md-2" for="ParameterGestEnv">Emails gestionnaires environnements  : </label>
        <div class="col-md-offset-2">
            <?php echo $this->Form->input('param',array('class'=>'form-control','id'=>'ParameterGestEnv','style'=>'width:86%;','type'=>'text','placeholder'=>'Emails des gestionnaires d\'environnements','value'=>isset($destmailenv['Parameter']['param']) ? $destmailenv['Parameter']['param'] : '','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>
        </div> 
    </div>
<?php echo $this->Form->input('id',array('type'=>'hidden','value'=>isset($destmailenv['Parameter']['id']) ? $destmailenv['Parameter']['id'] : '')); ?>
<?php echo $this->Form->end(); ?> 
<div class="marginbottom15"></div>  
//-->
<?php /* Gérer le developpeur d'outil */ ?>
<?php echo $this->Form->create('Parameter',array('action'=>'saveParam','id'=>'formValidate8','class'=>'form-inline','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group" style="width:98%">
        <label class="col-md-2" for="ParameterGestEnv">Emails développeurs  : </label>
        <div class="col-md-offset-2">
            <?php echo $this->Form->input('param',array('class'=>'form-control','id'=>'ParameterGestEnv','style'=>'width:86%;','type'=>'text','placeholder'=>'Emails des développeur de SAILL','value'=>isset($developpeur['Parameter']['param']) ? $developpeur['Parameter']['param'] : '','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>
        </div> 
    </div>
<?php echo $this->Form->input('id',array('type'=>'hidden','value'=>isset($developpeur['Parameter']['id']) ? $developpeur['Parameter']['id'] : '')); ?>
<?php echo $this->Form->end(); ?> 
<div class="marginbottom15"></div>    
<!--
<div class='block-panel block-panel-50-left'>
<?php /* Gérer la liste d'outil par défaut */ ?>
<?php echo $this->Form->create('Parameter',array('action'=>'saveParam','id'=>'formValidate9','class'=>'form-inline','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group" style="width:98%">
        <label class="col-md-4" for="ParameterTemplateOutil">Ouverture des droits par défaut sur les outils  : </label>
        <div class="col-md-8">
            <?php $selected = explode(',',$templateoutil['Parameter']['param']); ?>
            <?php echo $this->Form->select('param',$listoutil,array('multiple'=>'true','id'=>'ParameterTemplateOutil','class'=>"form-control multiselect size75", 'default' => $selected,'hiddenField' => false)); ?>               
            <div class="text-center margintop10"><?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?></div> 
        </div>
    </div>
<?php echo $this->Form->input('id',array('type'=>'hidden','value'=>isset($templateoutil['Parameter']['id']) ? $templateoutil['Parameter']['id'] : '')); ?>
<?php echo $this->Form->end(); ?> 
</div>    
<div class='block-panel block-panel-50-left'>
<?php /* Gérer la liste de groupe par défaut */ ?>
<?php echo $this->Form->create('Parameter',array('action'=>'saveParam','id'=>'formValidate9','class'=>'form-inline','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group" style="width:98%">
        <label class="col-md-4" for="ParameterTemplateGroupe">Ouverture des droits par défaut sur les groupes  : </label>
        <div class="col-md-8">
            <?php $selected = explode(',',$templategroupe['Parameter']['param']); ?>
            <?php echo $this->Form->select('param',$listgroup,array('multiple'=>'true','id'=>'ParameterTemplateGroupe','class'=>"form-control multiselect size75", 'default' => $selected,'hiddenField' => false)); ?>                               
            <div class="text-center margintop10"><?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?></div>
        </div> 
    </div>
<?php echo $this->Form->input('id',array('type'=>'hidden','value'=>isset($templategroupe['Parameter']['id']) ? $templategroupe['Parameter']['id'] : '')); ?>
<?php echo $this->Form->end(); ?> 
<div class="marginbottom15"></div>
//-->
</div>
<div style="clear:both;margin-top: 10px;">
<div class="form-group">
  <div class="btn-block-horizontal">
      <div class="block-horizontal"> 
        <?php $filename = WWW_ROOT.'maintenance.md'; ?>
        <?php $action = file_exists ($filename) ? 'closemaintenance' : 'openmaintenance'; ?>
        <?php $btnaction = file_exists ($filename) ? 'Ouvrir le site' : 'Fermer le site'; ?>
          <?php $confirm = file_exists ($filename) ? 'Voulez-vous ouvrir le site aux utilisateurs ?' : "Voulez-vous fermer le site pour maintenance ?\r\nPour ouvir le site :\n\r\tsoit vous avez la possibilité de cliquer sur le bouton Ouvrir le site\n\r\tsoit vous devrez supprimer le fichier maintenance.md à la racine du site"; ?>
        <?php $btnclass = file_exists ($filename) ? 'btn-success' : 'btn-danger'; ?>
        <?php echo $this->Html->link($btnaction,array('action'=>$action),array('class'=>'btn btn-sm pull-left  '.$btnclass),$confirm); ?>
        <?php echo $this->Html->link('Import de données en masse',array('action'=>'importCsvData'),array('class'=>'btn btn-sm btn-default pull-left showoverlay')); ?>
      </div>
  </div>
  <div class="marginbottom15"></div>
</div>  
</div>
