<div style="text-align: center;"><h2><em style='color:#CB0044;'>S</em>uivi d'<em style='color:#CB0044;'>A</em>ctivités, d'<em style='color:#CB0044;'>I</em>ndisponibilités, des <em style='color:#CB0044;'>L</em>ivrables et de la <em style='color:#CB0044;'>L</em>ogistique</h2></div>
<div style='margin-left:auto;margin-right:auto;width:500px;'>
<?php echo $this->Form->create('Utilisateur',array('action'=>'initmypassword','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>    
        <div class="initpassword_form">
            <div class="form-group">
            <label class="col-lg-4 control-label required" for="UtilisateurUsernamelost">Login de connexion : </label>
            <div class="col-lg-offset-4">
                <?php echo $this->Form->input('usernamelost',array('class'=>'form-control','data-rule-required'=>'true','data-msg-required'=>"Le login de connexion est obligatoire pour vous envoyer votre nouveau mot de passe par mail",'placeholder'=>'Login de connexion','data-rule-minlength'=>"2", 'data-msg-minlength'=>"Le login doit au moins avoir 2 caractères",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            </div>
            </div>
            <div class="form-group">
            <div class="col-lg-offset-4">
                <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel ','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Initialiser', array('class' => 'btn btn-sm btn-default','type'=>'submit')); ?> 
            </div>
            </div>                
        </div> 
<?php echo $this->Form->end(); ?>    
</div>
