<div class='row'>
<div class="row margintop15">
        <div class="col-md-6 column">
            <div class="bs-callout bs-callout-warning marginleft15">
            <h4><small>Information sur la connexion à SAILL</small></h4>
            La connexion à SAILL se fait dorénavant avec votre <b style="color:red;">compte de session Windows (LDAP)</b>.<br>
            Seul les personnes avec un compte SAILL peuvent se connecter. Si votre compte n'est pas référencé dans SAILL, vous devez en faire la demande auprès d'un administrateur.
            </div>              
        </div>
        <div class="col-md-6 column">
<?php echo $this->Form->create('Utilisateur',array('action'=>'login','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
        <div class="form-group">
        <label class="col-md-4 control-label required" for="UtilisateurUsername">Login : </label>
        <div class="col-md-5">
            <?php echo $this->Form->input('username',array('data-rule-required'=>'true','placeholder'=>'Login','class'=>'form-control','data-rule-minlength'=>"2", 'data-msg-required'=>"Le login est obligatoire", 'data-msg-minlength'=>"Le login doit au moins avoir 2 caractères",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="form-group">
        <label class="col-md-4 control-label required" for="UtilisateurPassword">Mot de passe : </label>
        <div class="col-md-5">
            <?php echo $this->Form->input('password',array('data-rule-required'=>'true','placeholder'=>'Mot de passe','class'=>'form-control','data-rule-minlength'=>"5", 'data-msg-required'=>"Le mot de passe est obligatoire", 'data-msg-minlength'=>"Le mot de passe doit au moins avoir 5 caractères",'type'=>'password','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="form-group">
        <div class="col-md-offset-4" style="padding-left:15px;">
        <?php echo $this->Form->input('remember_me',array('type'=>'checkbox')); ?>&nbsp;<label class='labelAfter' for="UtilisateurRememberMe">Se souvenir de moi</label>
        </div>
        </div>
        <div class="form-group">
        <div class="col-md-offset-4" style="padding-left:15px;">
            <?php echo $this->Form->button('Connexion', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?> 
        </div>
        </div>
        </div>
<?php echo $this->Form->end(); ?>
<!--    
        <div class="col-md-3 column">
        </div>
    //-->
</div>
</div>