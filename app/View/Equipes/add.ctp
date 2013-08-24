<div class="equipes form">
<?php echo $this->Form->create('Equipe',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('label'=>false,'div' => false))); ?>
    <div class="control-group">
        <label class="control-label sstitre required" for="EquipeAgent">Agent à ajouter : </label>
        <div class="controls">  	
            <?php echo $this->Form->select('agents',$utilisateurs,array('data-rule-required'=>'true','multiple'=>'true','data-msg-required'=>'Le nom de l\'agent est obligatoire','size'=>"10")); ?>
        </div>
    </div>
    <?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>  userAuth('id'))); ?> 
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container" style="margin-top:2px;text-align:center;">
                <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn showoverlay','onclick'=>"location.href='".goPrev()."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-primary','type'=>'submit')); ?>                
            </div>
        </div>
    </div>   
<?php echo $this->Form->end(); ?>    
</div>
