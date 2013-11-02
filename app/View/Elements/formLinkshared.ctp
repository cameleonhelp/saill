<div class="marginright20">
<?php echo $this->Form->create('Linkshared',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
    <div class="form-group">
        <label class="col-lg-2  required" for="LinksharedNOM">Nom du lien : </label>
        <div class="col-lg-4">
            <?php echo $this->Form->input('NOM',array('type'=>'text','class'=>'form-control','placeholder'=>'Nom du lien','data-rule-required'=>'true','data-msg-required'=>"Le nom du domaine est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
        <div class="form-group">
        <label class="col-lg-2 required" for="LinksharedLINK">Lien : </label>
        <div class="col-lg-10">
            <?php echo $this->Form->input('LINK',array('class'=>'form-control','type'=>'text','placeholder'=>'Url du site','data-rule-required'=>'true','data-msg-required'=>"Le nom du domaine'url du site est obligatoire",'error' => array('attributes' => array('wrap' => 'span', 'style' => 'display:none;')))); ?>
        </div>
        </div>
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php $url = $this->Html->url(array('controller'=>'activitesreelles','action'=>'index','tous',userAuth('id'),date('m'))); ?>
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                
      </div>
    </div>  
    </div> 
<?php echo $this->Form->input('utilisateur_id',array('type'=>'hidden','value'=>userAuth('id'))); ?>
<?php if ($this->params->action == 'edit') echo $this->Form->input('id',array('type'=>'hidden')); ?>
<?php echo $this->Form->end(); ?>
</div>