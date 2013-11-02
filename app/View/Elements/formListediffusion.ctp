<div class="marginright20">
<?php echo $this->Form->create('Listediffusion',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2 required" for="ListediffusionNOM">Nom : </label>
        <div class="col-lg-5">
            <?php echo $this->Form->input('NOM',array('type'=>'text','class'=>'form-control','placeholder'=>'Nom de la liste de diffusion','data-rule-required'=>'true','data-msg-required'=>"Le nom de la liste de diffusion est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2" for="LivrableUtilisateurId">Gestionnaire : </label>
            <div class="col-lg-5">  
                <?php if ($this->params->action == 'add') : ?>
                <?php echo $this->Form->select('utilisateur_id',$utilisateurs,array('default' => userAuth('id'),'class'=>'form-control','empty' => 'Choisir un gestionnaire')); ?>
                <?php else : ?>
                <?php echo $this->Form->select('utilisateur_id',$utilisateurs,array('class'=>'form-control','empty' => 'Choisir un gestionnaire')); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
        <label class="col-lg-2" for="ListediffusionDESCRIPTION">Description : </label>
        <div class="col-lg-10">
            <?php echo $this->Form->input('DESCRIPTION',array('type'=>'textarea','error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>
<?php echo $this->Form->end(); ?>
</div>