<div style="text-align: center;"><h2><em style='color:#CB0044;'>S</em>uivi d'<em style='color:#CB0044;'>A</em>ctivités, d'<em style='color:#CB0044;'>I</em>ndisponibilités, des <em style='color:#CB0044;'>L</em>ivrables et de la <em style='color:#CB0044;'>L</em>ogistique</h2></div>
<div style='margin-left:auto;margin-right:auto;width:500px;'>
<?php echo $this->Form->create('Utilisateur',array('action'=>'login','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
        <div class="form-group">
        <label class="col-lg-4 control-label required" for="UtilisateurUsername">Login : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('username',array('data-rule-required'=>'true','placeholder'=>'Login','class'=>'form-control','data-rule-minlength'=>"2", 'data-msg-required'=>"Le login est obligatoire", 'data-msg-minlength'=>"Le login doit au moins avoir 2 caractères",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="form-group">
        <label class="col-lg-4 control-label required" for="UtilisateurPassword">Mot de passe : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('password',array('data-rule-required'=>'true','placeholder'=>'Mot de passe','class'=>'form-control','data-rule-minlength'=>"5", 'data-msg-required'=>"Le mot de passe est obligatoire", 'data-msg-minlength'=>"Le mot de passe doit au moins avoir 5 caractères",'type'=>'password','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="form-group">
        <div class="col-lg-offset-4">
        <?php echo $this->Form->input('remember_me',array('type'=>'checkbox')); ?>&nbsp;<label class='labelAfter' for="UtilisateurRememberMe">Se souvenir de moi</label>
        </div>
        </div>
        <div class="form-group">
        <div class="col-lg-offset-4">
            <?php echo $this->Form->button('Connexion', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?> 
        </div>
        </div>
<?php echo $this->Form->end(); ?>
    <div class="col-lg-offset-4">
        <?php echo $this->Html->link('Perte de mot de passe', array('controller'=>'utilisateurs','action'=>'initmypassword')); ?>
    </div>
</div>
