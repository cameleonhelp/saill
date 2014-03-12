    <div class="">
        <?php echo $this->Form->create('Entite',array('id'=>'formValidate','class'=>'form-horizontal','inputDefaults' => array('error'=>false,'label'=>false,'div' => false))); ?>
        <div class="form-group">
            <label class="col-md-2 required" for="EntiteNOM">Nom du cercle : </label>
            <div class="col-md-10">
                <?php echo $this->Form->input('NOM',array('class'=>'form-control','placeholder'=>'Nom du cercle','data-rule-required'=>'true','data-msg-required'=>"Le nom du cercle de visibilité est obligatoire")); ?>   
            </div>
        </div>          
        <div class="form-group">
            <label class="col-md-2" for="EntiteMAILGESTENV">Mail du gestionnaire d'environnement : </label>
            <div class="col-md-10">
                <?php echo $this->Form->input('MAILGESTENV',array('class'=>'form-control','placeholder'=>'Email du (ou des) gestionnaire(s) d\'environnement')); ?>   
            </div>
        </div>         
        <div class="form-group">
            <label class="col-md-2" for="EntiteCOMMENTAIRE">Commentaire : </label>
            <div class="col-md-10">
                <?php echo $this->Form->input('COMMENTAIRE',array('type'=>'textarea')); ?>   
            </div>
        </div>          
    <div style="clear:both;margin-top: 10px;">
    <div class="form-group">
      <div class="btn-block-horizontal">
            <?php echo $this->Form->button('Annuler', array('type'=>'submit','class' => 'btn btn-sm btn-default showoverlay cancel','value'=>'cancel','div' => false, 'name' => 'cancel')); ?>&nbsp;<?php echo $this->Form->button('Enregistrer', array('class' => 'btn btn-sm btn-primary','type'=>'submit')); ?>                 
      </div>
    </div>  
    </div> 
    <?php echo $this->Form->end(); ?>
    </div>