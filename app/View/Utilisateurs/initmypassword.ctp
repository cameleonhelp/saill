<div style="text-align: center;"><h2><em style='color:#CB0044;'>S</em>uivi d'<em style='color:#CB0044;'>A</em>ctivités, d'<em style='color:#CB0044;'>I</em>ndisponibilités, des <em style='color:#CB0044;'>L</em>ivrables et de la <em style='color:#CB0044;'>L</em>ogistique</h2></div>
<div style='margin-left:auto;margin-right:auto;width:500px;'>
<?php echo $this->Form->create('Utilisateur',array('action'=>'initmypassword','id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>    
        <div class="initpassword_form">
            <div class="control-group">
            <label class="control-label sstitre required" for="UtilisateurUsernamelost">Login de connexion : </label>
            <div class="controls">
                <?php echo $this->Form->input('usernamelost',array('data-rule-required'=>'true','data-msg-required'=>"Le login de connexion est obligatoire pour vous envoyer votre nouveau mot de passe par mail",'placeholder'=>'Login de connexion','data-rule-minlength'=>"2", 'data-msg-minlength'=>"Le login doit au moins avoir 2 caractères",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
            </div>
            </div>
            <div class="control-group">
            <div class="controls">
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn showoverlay','onclick'=>"location.href='".goPrev()."'")); ?>&nbsp;<?php echo $this->Form->button('Initialiser', array('class' => 'btn','type'=>'submit')); ?> 
            </div>
            </div>                
        </div> 
<?php echo $this->Form->end(); ?>    
</div>
