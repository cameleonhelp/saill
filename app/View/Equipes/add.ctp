<div class="marginright20">
<div class="equipes form">
<?php echo $this->Form->create('Equipe',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-4 required" for="EquipeAgent">Agent à ajouter : </label>
        <div class="col-lg-4">  	
            <?php echo $this->Form->select('agents',$utilisateurs,array('data-rule-required'=>'true','multiple'=>'true','class'=>"form-control multiselect size75",'data-msg-required'=>'Le nom de l\'agent est obligatoire','size'=>"10")); ?>
        </div>
    </div>
    <?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>  userAuth('id'))); ?> 
    <div style="clear:both;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php $url = array('controller'=>'pages','action'=>'home'); ?>
            <?php echo $this->Form->button('Annuler', array('type'=>'button','class' => 'btn btn-sm btn-default showoverlay','onclick'=>"location.href='".$this->Html->url($url)."'")); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>  
<?php echo $this->Form->end(); ?>    
</div>
</div>