<div class="params index">
    <?php /* Changer le mot de passe administrateur */ ?>
    <?php echo $this->Form->create('Utilisateur',array('action'=>'saveAdmPassword','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
        <div class="control-group">
            <label class="control-label sstitre required" for="UtilisateurPasswordNew">Mot de passe administrateur : </label>
            <div class="controls">
                <?php echo $this->Form->input('password_new',array('type'=>'password','data-rule-required'=>'true','data-msg-required'=>"Le mot de passe est obligatoire",'data-rule-minlength'=>'5','data-msg-minlength'=>"Le mot de passe doit avoir au moins 5 caractères",'placeholder'=>'Mot de passe')); ?>
                &nbsp;<label class="sstitre horizontal form-inline" for="UtilisateurPassword">Confirmation </label>
                <?php echo $this->Form->input('password_confirm',array('type'=>'password','data-rule-equalto'=>'#UtilisateurPasswordNew','data-msg-equalto'=>"Les mots de passe ne sont pas identiques",'placeholder'=>'Confirmation du mot de passe','value'=>'')); ?>    
                <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>
            </div>
        </div> 
    <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>1)); ?>
    <?php echo $this->Form->end(); ?>  
    <?php /* Gérer url MINIDOC */ ?>
    <?php echo $this->Form->create('Parameter',array('action'=>'saveParam','id'=>'formValidate2','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
        <div class="control-group">
            <label class="control-label sstitre" for="ParameterParam">URL Minidoc : </label>
            <div class="controls">
                <?php echo $this->Form->input('param',array('class'=>'span20','type'=>'text','placeholder'=>'url de Minidoc','value'=>$urlminidoc['Parameter']['param'],'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>
            </div> 
        </div>
    <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$urlminidoc['Parameter']['id'])); ?>
    <?php echo $this->Form->end(); ?>
    <?php /* Gérer contact Webmaster */ ?>
    <?php echo $this->Form->create('Parameter',array('action'=>'saveParam','id'=>'formValidate3','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
        <div class="control-group">
            <label class="control-label sstitre" for="ParameterParam">Email contact : </label>
            <div class="controls">
                <?php echo $this->Form->input('param',array('class'=>'span10','type'=>'text','placeholder'=>'Email du contact','value'=>$contact['Parameter']['param'],'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>
            </div> 
        </div>
    <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$contact['Parameter']['id'])); ?>
    <?php echo $this->Form->end(); ?>
    <?php /* Gérer version du site à la place du fichier version dans elements */ ?>
    <?php echo $this->Form->create('Parameter',array('action'=>'saveParam','id'=>'formValidate4','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
        <div class="control-group">
            <label class="control-label sstitre" for="ParameterParam">Version : </label>
            <div class="controls">
                <?php echo $this->Form->input('param',array('class'=>'span7','type'=>'text','placeholder'=>'N° de version','value'=>$version['Parameter']['param'],'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>
            </div> 
        </div>
    <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$version['Parameter']['id'])); ?>
    <?php echo $this->Form->end(); ?>
    <?php /* Gérer l'instance du site */ ?>
    <?php echo $this->Form->create('Parameter',array('action'=>'saveParam','id'=>'formValidate4','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
        <div class="control-group">
            <label class="control-label sstitre" for="ParameterParam">Instance : </label>
            <div class="controls">
                <?php $instances = array('DEV'=>'DEVELOPPEMENT','INT'=>'INTEGRATION','DEMO'=>'DEMONSTRATION','FORM'=>'FORMATION','BAC'=>'BAC A SABLE','PROD'=>'PRODUCTION'); ?>
                <?php echo $this->Form->select('param', $instances,array('empty' => 'Choisir une instance...','default'=>$instance['Parameter']['param'])); ?>
                <?php //echo $this->Form->input('param',array('class'=>'span7','type'=>'text','placeholder'=>'Instance','value'=>$instance['Parameter']['param'],'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>
            </div> 
        </div>
    <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$instance['Parameter']['id'])); ?>
    <?php echo $this->Form->end(); ?>   
    <?php /* Gérer le gestionnaire d'annuaire */ ?>
    <?php echo $this->Form->create('Parameter',array('action'=>'saveParam','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
        <div class="control-group">
            <label class="control-label sstitre" for="ParameterParam">Email du gestionnaire d'annuaire : </label>
            <div class="controls">
                <?php echo $this->Form->input('param',array('class'=>'span10','type'=>'text','placeholder'=>'Gestionnaire d\'annuaire','value'=>$annuaire['Parameter']['param'],'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>
            </div> 
        </div>
    <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$annuaire['Parameter']['id'])); ?>
    <?php echo $this->Form->end(); ?>  
    <?php /* Gérer le valideur d'outil */ ?>
    <?php echo $this->Form->create('Parameter',array('action'=>'saveParam','id'=>'formValidate4','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
        <div class="control-group">
            <label class="control-label sstitre" for="ParameterParam">Email du valideur d'outil : </label>
            <div class="controls">
                <?php echo $this->Form->input('param',array('class'=>'span10','type'=>'text','placeholder'=>'Service manager','value'=>$valoutil['Parameter']['param'],'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
                <?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>
            </div> 
        </div>
    <?php echo $this->Form->input('id',array('type'=>'hidden','value'=>$valoutil['Parameter']['id'])); ?>
    <?php echo $this->Form->end(); ?>      
</div>
